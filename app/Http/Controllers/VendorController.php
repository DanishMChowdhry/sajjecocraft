<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendor = Vendor::all();
        return view('vendor.index', compact('vendor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->address = $request->address;
        $vendor->company_name = $request->company_name;
        $vendor->company_website = $request->company_website;
        $vendor->gst = $request->gst;
        $vendor->account_holder_name = $request->account_holder_name;
        $vendor->bank_name = $request->bank_name;
        $vendor->account_number = $request->account_number;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->bank_address = $request->bank_address;
        $vendor->account_type = $request->account_type;
        $vendor->parking_charges = $request->parking_charges;
        $vendor->operational_charges = $request->operational_charges;
        $vendor->transport = $request->transport;
        $vendor->dead_stock = $request->dead_stock;
        $vendor->branding = $request->branding;
        $vendor->damage_and_shrinkege = $request->damage_and_shrinkege;
        $vendor->profit = $request->profit;
        $vendor->save();
        return redirect()->route('vendor.index')->with('status', 'Vendor created successfully');
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
        $vendor = Vendor::find($id);
        return view('vendor.edit', compact('vendor'));
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
        $vendor = Vendor::find($id);
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->phone = $request->phone;
        $vendor->address = $request->address;
        $vendor->company_name = $request->company_name;
        $vendor->company_website = $request->company_website;
        $vendor->gst = $request->gst;
        $vendor->account_holder_name = $request->account_holder_name;
        $vendor->bank_name = $request->bank_name;
        $vendor->account_number = $request->account_number;
        $vendor->ifsc_code = $request->ifsc_code;
        $vendor->bank_address = $request->bank_address;
        $vendor->account_type = $request->account_type;
         $vendor->parking_charges = $request->parking_charges;
        $vendor->operational_charges = $request->operational_charges;
        $vendor->transport = $request->transport;
        $vendor->dead_stock = $request->dead_stock;
        $vendor->branding = $request->branding;
        $vendor->damage_and_shrinkege = $request->damage_and_shrinkege;
        $vendor->profit = $request->profit;
        $vendor->save();
        return redirect()->route('vendor.index')->with('status', 'Vendor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vendor::find($id)->delete();
        return redirect()->route('vendor.index')->with('status', 'Vendor deleted successfully');
    }
}
