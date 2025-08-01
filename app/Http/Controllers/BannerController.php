<?php

namespace App\Http\Controllers;

use App\Models\Banners;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutBanner = Banners::find(1);
        $blogBanner = Banners::find(2);

        return view('banner.index', compact('aboutBanner', 'blogBanner'));
    }



    public function updateAbout(Request $request)
    {
        // dd($request);
        $banner = Banners::find(1);

        if (!$banner) {
            return redirect()->route('banners')->with('error', 'About Banner not found.');
        }

        if ($request->hasFile('image')) {
            $image_path = ImageHelper::uploadImage($request->file('image'), 'images/banners');
            $banner->image = $image_path;
            $banner->save();
        }

        return redirect()->route('banners')->with('status', 'About Banner updated successfully.');
    }

    public function updateBlog(Request $request)
    {
        $banner = Banners::find(2);

        if (!$banner) {
            return redirect()->route('banners')->with('error', 'Blog Banner not found.');
        }

        if ($request->hasFile('image')) {
            $image_path = ImageHelper::uploadImage($request->file('image'), 'images/banners');
            $banner->image = $image_path;
            $banner->save();
        }

        return redirect()->route('banners')->with('status', 'Blog Banner updated successfully.');
    }
}
