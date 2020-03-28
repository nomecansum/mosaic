<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\camaras;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cuenta=camaras::count();
        $paginas=intdiv($cuenta,6);
        $resto=fmod($cuenta,6);
        return view('home',compact('cuenta'));
    }

    public function mosaico_camaras($pagina=1){
        $camaras=camaras::all()->chunk(6);
        return $camaras->toJson();
    }
}
