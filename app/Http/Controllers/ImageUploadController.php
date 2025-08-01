<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ImageUploadHelper;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function index()
    {
        return view('image_upload.index');
    }

    public function upload(Request $request)
{
    $uploadMode = $request->input('upload_mode', 'local');

    $request->validate([
        'image' => 'required|image|max:5120',
    ]);

    $image = $request->file('image');
    $url = ImageUploadHelper::upload($image);

    if ($uploadMode === 'api') {
        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }

    return redirect()->back()->with('image_url', $url);
}
}
