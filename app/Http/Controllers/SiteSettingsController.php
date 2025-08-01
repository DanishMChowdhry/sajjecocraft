<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use App\Models\SiteSettings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $info = SiteSettings::findorFail(1);
        return view('sitesettings.index', compact('info'));
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
        $info = SiteSettings::findorFail(1);

        $info->title = $request->input('title');
        $info->phone_number = $request->input('phone_number');
        $info->email_address = $request->input('email_address');
        $info->address = $request->input('address');
        $info->description = $request->input('description');
        $info->facebook = $request->input('facebook');
        $info->youtube = $request->input('youtube');
        $info->linkedin = $request->input('linkedin');
        $info->instagram = $request->input('instagram');
        $info->meta_description = $request->input('meta_description');
        $info->meta_keywords = $request->input('meta_keywords');
        $info->meta_author = $request->input('meta_author');
        $info->canonical_url = $request->input('canonical_url');
        $info->og_title = $request->input('og_title');
        $info->og_description = $request->input('og_description');
        $info->og_url = $request->input('og_url');
        $info->og_type = $request->input('og_type');
        $info->og_site_name = $request->input('og_site_name');
        $info->twitter_card = $request->input('twitter_card');
        $info->twitter_title = $request->input('twitter_title');
        $info->twitter_description = $request->input('twitter_description');
        $info->twitter_url = $request->input('twitter_url');
        $info->twitter_site = $request->input('twitter_site');
        $info->twitter_creator = $request->input('twitter_creator');
        $info->latitude = $request->input('latitude');
        $info->longitude = $request->input('longitude');
        $info->map_link = $request->input('map_link');
        $info->gst = $request->input('gst');
        $info->account_holder_name = $request->input('account_holder_name');
        $info->bank_name = $request->input('bank_name');
        $info->account_number = $request->input('account_number');
        $info->ifsc_code = $request->input('ifsc_code');
        $info->bank_address = $request->input('bank_address');
        $info->account_type = $request->input('account_type');
        $info->upi_id = $request->input('upi_id');
        $info->upi_number = $request->input('upi_number');

        if ($request->hasFile('logo_light_image')) {
            $logo_light_image_path = ImageHelper::uploadImage($request->file('logo_light_image'), 'images/logo_light_image');
            $info->logo_light_image = $logo_light_image_path;
        }
        if ($request->hasFile('logo_dark_image')) {
            $logo_dark_image_path = ImageHelper::uploadImage($request->file('logo_dark_image'), 'images/logo_dark_image');
            $info->logo_dark_image = $logo_dark_image_path;
        }
        if ($request->hasFile('favicon_image')) {
            $favicon_image_path = ImageHelper::uploadImage($request->file('favicon_image'), 'images/favicon_image');
            $info->favicon_image = $favicon_image_path;
        }
        if ($request->hasFile('og_image')) {
            $og_image_path = ImageHelper::uploadImage($request->file('og_image'), 'images/og_image');
            $info->og_image = $og_image_path;
        }
        if ($request->hasFile('twitter_image')) {
            $twitter_image_path = ImageHelper::uploadImage($request->file('twitter_image'), 'images/twitter_image');
            $info->twitter_image = $twitter_image_path;
        }
        if ($request->hasFile('upi_qr_code_image')) {
            $upi_qr_code_image_path = ImageHelper::uploadImage($request->file('upi_qr_code_image'), 'images/upi_qr_code_image');
            $info->upi_qr_code_image = $upi_qr_code_image_path;
        }

        $info->save();
        return redirect()->route('site_settings.index')->with('status', 'Site Settings Updated Successfully');
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
}
