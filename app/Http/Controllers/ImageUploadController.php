<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;

class ImageUploadController extends Controller
{
    public function fileCreate()
    {
        return view('users.import');
    }
    public function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/import'),$imageName);


    }
    public function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');
        
        $path=public_path().'/uploads/import'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
