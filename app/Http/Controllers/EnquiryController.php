<?php

namespace App\Http\Controllers;

use Helpers\NumberToWords;
use Illuminate\Http\Request;
use App\Models\CustomerEnquiry;
use Barryvdh\DomPDF\Facade\Pdf;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Call the static method directly on the model
        $groupedEnquiries = CustomerEnquiry::getGroupedEnquiries();


        return view('enquiries.index', compact('groupedEnquiries'));

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

    public function downloadPdf($enquiryId)
    {
        $enquiries = CustomerEnquiry::where('enquiry_id', $enquiryId)->get();

        if ($enquiries->isEmpty()) {
            return redirect()->back()->with('error', 'No enquiry found with this ID.');
        }

        // Use guest/customer info from first enquiry (assuming same for all items)
        $first = $enquiries->first();

        $guestName = $first->guest_name ?? 'Guest';
        $guestPhone = $first->guest_phone ?? 'N/A';
        $guestAddress = $first->guest_address ?? 'N/A';

        // Prepare product data for PDF
        $productsData = $enquiries->map(function ($item) {
            return [
                'name' => $item->product_name,
                'main_image' => $item->product_image,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'total' => $item->subtotal,
            ];
        })->toArray();

        $total = $enquiries->sum('subtotal');
        $subtotal = $total;
        $gstAmount = $subtotal * 0.18;
        $totalWithGST = $subtotal + $gstAmount;

        // Convert total amount to words - implement your own or use a package
        $totalInWords = NumberToWords::convertNumberToWords($totalWithGST);

        // Fake invoice object for PDF view
        $invoice = (object) [
            'order_id' => $enquiryId,
            'customer_name' => $guestName,
            'product_json' => json_encode($productsData),
            'created_at' => $first->created_at,
        ];

        $pdf = Pdf::loadView('pdf.invoice', [
            'invoice' => $invoice,
            'totalInWords' => $totalInWords,
            'subtotal' => $subtotal,
            'totalWithGST' => $totalWithGST,
            'gstAmount' => $gstAmount,
        ]);

        return $pdf->download('enquiry_invoice_' . $enquiryId . '.pdf');
    }

}
