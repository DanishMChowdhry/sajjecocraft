<?php

namespace App\Http\Controllers;

use App\Helpers\ImageHelper;
use Illuminate\Http\Request;

class CkeditorController extends Controller
{
   public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
               $img= ImageHelper::uploadImage($request->file('upload'), 'images/uploads');
                $CKEditorFuncNum = $request->input('CKEditorFuncNum');
                $url = 'https://sajjecocraft.com/public/'.$img;
                $msg = 'Image uploaded successfully'.$url;
                $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

                @header('Content-type: text/html; charset=utf-8');
                echo $response;
        }
        return false;
    }
}
