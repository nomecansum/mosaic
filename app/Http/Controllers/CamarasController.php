<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camaras;
use Illuminate\Support\Facades\Storage;
use Image;

class CamarasController extends Controller
{
    //
    public function index(){

        $camaras=camaras::all();
        return view('camaras.index',compact('camaras'));
    }

    public function savesnapshot($id){

                // $contents = file_get_contents($url,0, stream_context_create(["http"=>["timeout"=>1]]));
        // $name = substr($url, strrpos($url, '/') + 1);
        //$name="/img/camaras/".$id.".jpg";
        $camara=camaras::find($id);
        try{
            $url = "http://".$camara->ip.':'.$camara->port."/cam/1/frame.jpg";
            Image::make($url)->save(public_path('/img/camaras/' . $id.'.jpg'));
            $camara->thumbnail=$id.'.jpg';
            $camara->status=1;
            $camara->save();
        } catch(\Exception $e){
            $camara->status=0;
            $camara->save();
        }

    }

    public function status($id,$status){
        $camara=camaras::find($id);
        $camara->status=$status;
        $camara->save();
    }

    public function edit($id){
        if($id==0){
            $camara=new camaras;
            $camara->id=0;
        } else {
            $camara=camaras::find($id);
        }

        return view('camaras.edit',compact('camara'));

    }

    public function ver_camara($id){
        $camara=camaras::find($id);
        $url_camara=explode("?",$camara->url);
        $url=$url_camara[0]."?800X600";
        return view('camaras.view',compact('camara','url'));

    }

    public function delete($id){
        $camara=camaras::find($id);
        $camara->delete();
        flash('Camara '.$camara->etiqueta.' Borrada')->success();
        return redirect('/camaras');

    }

    public function update(Request $r){
        try{


            if($r->id==0){
                $camara=camaras::create($r->all());
            } else {
                $camara=camaras::find($r->id);
                $camara->update($r->all());
            }
            $camara->save();
            return [
                'title' => "Camaras",
                'message' => 'Camara '.$r->etiqueta. ' actualizada',
                'url' => url('camaras')
            ];
        } catch (Exception $exception) {
            return [
                'title' => "Camaras",
                'error' => 'ERROR: Ocurrio un error actualizando el usuario '.$r->name.' '.mensaje_excepcion($exception),
                //'url' => url('sections')
            ];

        }
    }
}
