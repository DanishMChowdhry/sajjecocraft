<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadHelper
{
    /**
     * Upload an image file to the given disk and path.
     *
     * @param  \Illuminate\Http\UploadedFile  $file
     * @param  string  $directory
     * @param  string  $disk
     * @return string  URL of uploaded image
     */
    public static function upload(UploadedFile $file, string $directory = 'uploads', string $disk = 'public'): string
    {
        $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($directory, $filename, $disk);
        return Storage::disk($disk)->url($path);
    }
}
