<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camaras;
use Illuminate\Support\Facades\Storage;
use Faker\Provider\Image;

class CamarasController extends Controller
{
    //
    public function index(){

        $camaras=camaras::all();
        return view('camaras.index',compact('camaras'));
    }

    public function savesnapshot($id){

        $camara=camaras::find($id);

        $url = "http://".$camara->ip.':'.$camara->port."/cam/1/frame.jpg";
        $contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        //$name="/img/camaras/".$id.".jpg";
        Image::make($url)->save(public_path('/img/camaras/' . $id.'.jpg'));

        //Storage::disk('public')->put($name, $contents);
        $camara->thumbnail=$id.'.jpg';
        $camara->save();
    }
}
