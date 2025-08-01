<?php

namespace App\Http\Controllers;

use Helpers\NumberToWords;
use Illuminate\Http\Request;
use App\Models\CustomerEnquiry;
use Barryvdh\DomPDF\Facade\Pdf; // Import the facade here

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customerId = auth()->id(); // get logged in user id

        // Get unique enquiries for this user, ordered by newest first
        $orders = CustomerEnquiry::where('customer_id', $customerId)->select('enquiry_id', 'customer_id')->groupBy('enquiry_id', 'customer_id')->orderBy('created_at', 'desc')->get();

        // Attach items/products to each order
        $orders->map(function ($order) {
            $order->items = CustomerEnquiry::where('enquiry_id', $order->enquiry_id)->get();
            return $order;
        });

        return view('main_pages.orders', compact('orders'));
    }
    public function generateFromEnquiry($enquiry_id)
    {
        // Fetch all items for the enquiry
        $items = CustomerEnquiry::where('enquiry_id', $enquiry_id)->get();

        if ($items->isEmpty()) {
            abort(404, 'Enquiry not found');
        }

        // Calculate totals
        $subtotal = $items->sum('subtotal');
        $gstAmount = round($subtotal * 0.18, 2);
        $totalWithGST = $subtotal + $gstAmount;
        $totalInWords = NumberToWords::convertNumberToWords($totalWithGST);

        // Get basic customer data from first item
        $customer = $items->first();

        $pdf = PDF::loadView('pdf.enquiry_invoice', [
            'items' => $items,
            'subtotal' => $subtotal,
            'gstAmount' => $gstAmount,
            'totalWithGST' => $totalWithGST,
            'totalInWords' => $totalInWords,
            'enquiryId' => $enquiry_id,
            'customer' => $customer,
            'created_at' => $customer->created_at,
        ])->setPaper('a4');

        return $pdf->download("enquiry_invoice_{$enquiry_id}.pdf");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function showEnquiries()
    {
        // Get all unique enquiry_ids
        $enquiries = CustomerEnquiry::select('enquiry_id', 'customer_id')->groupBy('enquiry_id', 'customer_id')->orderBy('created_at', 'desc')->get();

        // For each enquiry, get the related products (items)
        $enquiriesWithItems = $enquiries->map(function ($enquiry) {
            $enquiry->items = CustomerEnquiry::where('enquiry_id', $enquiry->enquiry_id)->get();
            return $enquiry;
        });

        return view('main_pages.orders', ['enquiries' => $enquiriesWithItems]);
    }
}
