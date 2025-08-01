<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageApiController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // 5MB max
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        $url = asset('storage/' . $path);

        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }
}
