<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bitacora;
use Illuminate\Http\Request;
use Exception;
use DB;
use Carbon\Carbon;

use App\users;

class BitacorasController extends Controller
{

    /**
     * Display a listing of the bitacoras.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {

        $bitacoras = Bitacora::join('users','bitacora.id_usuario','users.id')->paginate(20);
        //dd($bitacoras);
            //->join('users','bitacora.id_usuario','users.id')
            //->join('clientes','clientes.id','users.id_cliente')

            //->get();

        $usuarios=$bitacoras->pluck('name','id_usuario')->unique();

        $modulos=$bitacoras->pluck('id_modulo')->unique();

        return view('bitacoras.index', ['bitacora' => $bitacoras], compact('bitacoras','usuarios','modulos'));

    }

    public function search(Request $r)
    {

            //D($r->modulos);//

            if (isset($r->fechas) && $r->fechas[0]!=null && $r->fechas[1]!=null){
                $fechas=explode(" - ",$r->fechas);
                //$fechas[0]=Carbon::parse(Carbon::createFromFormat('d/m/Y', $fechas[0]))->format('Y-m-d');
                //$fechas[1]=Carbon:/:parse(Carbon::createFromFormat('d/m/Y', $fechas[1]))->format('Y-m-d');

                $fechas[0]=Carbon::parse($fechas[0]);
                $fechas[1]=Carbon::parse($fechas[1]);
            } else {
                $fechas=null;
            }

            //dd($fechas);//
            //dd($fechas[0].' '.$fechas[1]);//

            $bitacoras=Bitacora::join('users','bitacora.id_usuario','users.id')

            ->when($r->tipo_log, function($query) use ($r) {
               return  $query->where('status', $r->tipo_log);
              })
            ->when($r->usuario, function($query) use ($r) {
                return  $query->where('id_usuario', $r->usuario);
               })
            ->when($fechas, function($query) use ($fechas) {
                return  $query->whereBetween('fecha', [$fechas[0],$fechas[1]]);
               })
            ->when($r->modulos, function($query) use ($r) {
                return  $query->whereIn('id_modulo', $r->modulos);
                })
            ->when($r->accion, function($query) use ($r) {
                return  $query->where('accion', 'LIKE', '%' . $r->accion . '%');
                })
            ->orderby('fecha','desc')
            ->get();

            $usuarios=$bitacoras->pluck('id_usuario')->unique()->toArray();

            $modulos=$bitacoras->pluck('id_modulo')->unique()->toArray();

            return view('bitacoras.fill_table', ['bitacora' => $bitacoras], compact('bitacoras', 'usuarios', 'modulos'));
            try {} catch (Exception $exception) {
            flash('ERROR: Ocurrio un error al hacer la busqueda '.$exception->getMessage())->error();
            return back()->withInput();
        }
    }

    protected function getData(Request $request)
    {
        $rules = [
            'id_usuario' => 'required|string|min:1|max:100',
            'id_modulo' => 'required|string|min:1|max:50',
            'accion' => 'required|string|min:1|max:200',
            'status' => 'required|string|min:1|max:10',
            'fecha' => 'required|date_format:j/n/Y g:i A',
        ];


        $data = $request->validate($rules);




        return $data;
    }

}
