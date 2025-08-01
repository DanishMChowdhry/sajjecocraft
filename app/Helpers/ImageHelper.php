<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function uploadImage($file, $path = 'uploads/images')
    {
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
            return $path . '/' . $filename;
        }

        return null;
    }
}
