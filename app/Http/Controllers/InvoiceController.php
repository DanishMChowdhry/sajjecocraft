<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use Helpers\NumberToWords;
use Illuminate\Http\Request;
use App\Models\CustomerEnquiry;
use Barryvdh\DomPDF\Facade\Pdf; // Import the facade here
use Gloudemans\Shoppingcart\Facades\Cart; // Make sure this is included
use Illuminate\Support\Facades\File;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->get();
        return view('invoice.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = User::where('role', 'customer')->get();
        $products = Product::orderBy('created_at', 'desc')->where('stock', '>', 0)->where('status', '=', 'active')->get();

        return view('invoice.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'order_id' => 'required|unique:invoices,order_id',
            'customer' => 'required|exists:users,id,role,customer',
            'products' => 'required|array',
            'products.*.selected' => 'nullable|in:1',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        // Prepare product data to be stored as JSON and calculate total
        $productsData = [];
        $total = 0;

        // Loop through each product selected
        foreach ($request->input('products') as $productId => $productData) {
            // Check if the product is selected
            if (isset($productData['selected']) && $productData['selected'] == 1) {
                // Get the product details from the database
                $product = Product::find($productId);

                // Ensure the product exists before adding it to the products data
                if ($product) {
                    $productTotal = $product->discounted_rates * $productData['quantity']; // Calculate total for this product

                    // Add product details to the products data
                    $productsData[] = [
                        'name' => $product->name,
                        'main_image' => $product->main_image, // Assuming 'main_image' is a column in your products table
                        'price' => $product->selling_price, // Assuming 'selling_price' is the offer price
                        'discounted_price' => $product->discounted_rates, // Include the discounted rate here
                        'quantity' => $productData['quantity'], // The quantity selected in the form
                        'total' => $productTotal, // Store product's total value
                    ];

                    // Add the product's total to the overall total
                    $total += $productTotal;
                    // Decrease the stock by the quantity of the product sold
                    $product->stock = $product->stock - $productData['quantity'];

                    // Save the updated product stock
                    $product->save();
                }
            }
        }

        // Retrieve the selected customer using the User model
        $customer = User::findOrFail($request->input('customer'));

        // Create the invoice
        $invoice = Invoice::create([
            'customer_name' => $customer->name,
            'order_id' => $request->input('order_id'),
            'product_json' => json_encode($productsData), // Store the product data as JSON
            'total' => $total, // Store the calculated total amount
        ]);

        // Redirect or return response after saving the invoice
        return redirect()->route('invoices.index')->with('success', 'Invoice created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function generateInvoicePDF(Request $request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        $subtotal = $invoice->total;
        $gstAmount = $invoice->total * 0.18;
        $totalWithGST = $invoice->total + $gstAmount;
        $totalInWords = NumberToWords::convertNumberToWords($totalWithGST);
        $pdf = PDF::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'totalInWords' => $totalInWords,
            'subtotal' => $subtotal,
            'totalWithGST' => $totalWithGST,
            'gstAmount' => $gstAmount,
        ]);

        return $pdf->download('invoice_' . $invoice->order_id . '.pdf');
    }


    public function storeFromCartAndGeneratePDF(Request $request)
    {
        $cartItems = Cart::content();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $enquiryId = time(); // Unique group id

        // Get guest info from form or fallback default values
        $guestName = $request->input('name', 'Guest');
        $guestPhone = $request->input('phone', 'N/A');
        $guestAddress = $request->input('address', 'N/A');

        // Prepare product data for PDF and calculations
        $productsData = [];
        $total = 0;

        foreach ($cartItems as $item) {
            $productTotal = $item->price * $item->qty;

            $productsData[] = [
                'name' => $item->name,
                'main_image' => $item->options->image ?? null,
                'price' => $item->options->selling_price ?? $item->price,
                'discounted_price' => $item->price,
                'quantity' => $item->qty,
                'total' => $productTotal,
            ];

            $total += $productTotal;
        }

        try {
            // Save each item as CustomerEnquiry
            foreach ($cartItems as $item) {
                $enquiry = new CustomerEnquiry();

                $enquiry->customer_id = 0; // no logged-in user
                $enquiry->enquiry_id = $enquiryId;
                $enquiry->product_id = $item->id;
                $enquiry->product_name = $item->name;
                $enquiry->product_image = $item->options->image ?? null;
                $enquiry->price = $item->price;
                $enquiry->quantity = $item->qty;
                $enquiry->subtotal = $item->price * $item->qty;

                $enquiry->guest_name = $guestName;
                $enquiry->guest_phone = $guestPhone;
                $enquiry->guest_address = $guestAddress;

                $enquiry->save();
            }

            // Calculations for invoice PDF
            $subtotal = $total;
            $gstAmount = $subtotal * 0.18;
            $totalWithGST = $subtotal + $gstAmount;

            // Convert total amount to words - implement your own or use a package
            $totalInWords = NumberToWords::convertNumberToWords($totalWithGST);

            // Fake invoice object to send to PDF view (you don't have an actual Invoice model here)
            $invoice = (object) [
                'order_id' => $enquiryId,
                'customer_name' => $guestName,
                'product_json' => json_encode($productsData),
                'created_at' => now(),
            ];

            $pdf = Pdf::loadView('pdf.invoice', [
                'invoice' => $invoice,
                'totalInWords' => $totalInWords,
                'subtotal' => $subtotal,
                'totalWithGST' => $totalWithGST,
                'gstAmount' => $gstAmount,
            ]);

            Cart::destroy();

            return $pdf->download('invoice_' . $enquiryId . '.pdf');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }
  public function shareInvoiceOnWhatsapp(Request $request)
{
    $cartItems = Cart::content();

    if ($cartItems->isEmpty()) {
        return back()->with('error', 'Your cart is empty.');
    }

    $enquiryId = time(); // Unique ID based on timestamp
    $guestName = $request->input('name', 'Guest');
    $guestPhone = $request->input('phone', 'N/A');
    $guestAddress = $request->input('address', 'N/A');

    $productsData = [];
    $total = 0;

    foreach ($cartItems as $item) {
        $productTotal = $item->price * $item->qty;

        $productsData[] = [
            'name' => $item->name,
            'main_image' => $item->options->image ?? null,
            'price' => $item->options->selling_price ?? $item->price,
            'discounted_price' => $item->price,
            'quantity' => $item->qty,
            'total' => $productTotal,
        ];

        $total += $productTotal;
    }

    try {
        // Save enquiry entries
        foreach ($cartItems as $item) {
            $enquiry = new CustomerEnquiry();
            $enquiry->customer_id = 0;
            $enquiry->enquiry_id = $enquiryId;
            $enquiry->product_id = $item->id;
            $enquiry->product_name = $item->name;
            $enquiry->product_image = $item->options->image ?? null;
            $enquiry->price = $item->price;
            $enquiry->quantity = $item->qty;
            $enquiry->subtotal = $item->price * $item->qty;
            $enquiry->guest_name = $guestName;
            $enquiry->guest_phone = $guestPhone;
            $enquiry->guest_address = $guestAddress;
            $enquiry->save();
        }

        // Calculate invoice values
        $subtotal = $total;
        $gstAmount = $subtotal * 0.18;
        $totalWithGST = $subtotal + $gstAmount;
        $totalInWords = NumberToWords::convertNumberToWords($totalWithGST); // Adjust as per your implementation

        $invoice = (object)[
            'order_id' => $enquiryId,
            'customer_name' => $guestName,
            'product_json' => json_encode($productsData),
            'created_at' => now(),
        ];

        // Generate PDF
        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'totalInWords' => $totalInWords,
            'subtotal' => $subtotal,
            'totalWithGST' => $totalWithGST,
            'gstAmount' => $gstAmount,
        ]);

        // Ensure folder exists
        $folderPath = public_path('invoices');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0775, true);
        }

        // Save PDF
        $fileName = 'invoice_' . $enquiryId . '.pdf';
        $filePath = $folderPath . '/' . $fileName;
        $pdf->save($filePath);

        // Public URL to PDF
        $invoiceUrl = asset('invoices/' . $fileName);

        // Destroy cart after saving
        Cart::destroy();

        // Send WhatsApp message (replace this block with real API integration)
        $whatsappMessage = "Hi $guestName, your invoice is ready.\nView/download it here: $invoiceUrl";


        // URL encode the message
        $encodedMessage = urlencode($whatsappMessage);

        // Create WhatsApp URL (no phone number)
        $whatsappUrl = "https://wa.me/?text=$encodedMessage";

        // Redirect to WhatsApp
        return redirect($whatsappUrl);

        return back()->with('success', 'Invoice generated and shared via WhatsApp link.');

    } catch (\Exception $e) {
        return back()->with('error', 'Something went wrong. ' . $e->getMessage());
    }
}


    



public function downloadInvoice($order_id)
{
    $invoice = Invoice::where('order_id', $order_id)->first();

    if (!$invoice) {
        abort(404, 'Invoice not found');
    }
        $subtotal = $invoice->total;
        $gstAmount = $invoice->total * 0.18;
        $totalWithGST = $invoice->total + $gstAmount;
        $totalInWords = NumberToWords::convertNumberToWords($totalWithGST);
        $pdf = PDF::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'totalInWords' => $totalInWords,
            'subtotal' => $subtotal,
            'totalWithGST' => $totalWithGST,
            'gstAmount' => $gstAmount,
        ]);

        return $pdf->download('invoice_' . $invoice->order_id . '.pdf');
}

}