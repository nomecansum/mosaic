<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Exception;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class CustomersController extends Controller
{
    //
    public function index()
    {
        $clientesObjects = DB::table('clientes')
        ->select('clientes.nom_cliente',
        'clientes.token_1uso',
        'clientes.img_logo',
        'clientes.id_cliente'
        )->paginate(20);

        /* ->select('clientes.nom_cliente',
         'clientes.nom_contacto', 'clientes.img_logo','clientes.val_apikey',
         'clientes.token_1uso','clientes.tel_cliente','clientes.CIF',
         'clientes.fec_borrado','clientes.id_cliente','clientes.mca_appmovil',
         'clientes.mca_vip','clientes.locked','clientes.cod_tipo_cliente') */



        return view('customers.index',compact('clientesObjects'));
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        //$Grupos = Grupo::pluck('grupo','id_grupo')->all();
        $clientes = Cliente::all();

        return view('customers.create', compact('clientes'));
    }

    /**
     * Show the form for editing the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */

    public function edit($id)
    {
        $clientes = Cliente::findOrFail($id);

    	return view('customers.edit',compact('clientes'));
    }
    /**
     * Update the specified users in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */

    public function update(Request $request)
    {
        //dd($request->all());

        $img_logo = "";
        $data = $this->getData($request);

        if ($request->hasFile('img_logo')) {
            $file = $request->file('img_logo');
            $path = public_path().'/img/customers/';
            $img_logo = uniqid().rand(000000,999999).'.'.$file->getClientOriginalExtension();
            $file->move($path,$img_logo);
        }

            $data['img_logo']=$img_logo;

            if($request->id_cliente==0){
            //Insert
            $clientes=Cliente::create($data);
            } else {
            //Update
            $clientes = Cliente::findOrFail($id);
            $clientes->update($data);
            }

            return [
            'title' => "Clientes",
            'message' => 'Cliente '.$request->nom_cliente. ' actualizado con exito',
            //'url' => url('sections')
            ];

            // flash('Usuario '.$request->name. 'actualizado con exito')->success();
            // return redirect()->route('users.users.index');
            try {} catch (Exception $exception) {
            // flash('ERROR: Ocurrio un error actualizando el usuario '.$request->name.' '.$exception->getMessage())->error();
            // return back()->withInput();

            return [
            'title' => "Clientes",
            'error' => 'ERROR: Ocurrio un error actualizando el cliente '.$request->nom_cliente.' '.$exception->getMessage(),
            //'url' => url('sections')
            ];

        }
    }

    /**
     * Remove the specified users from the storage.
     *
     * @param int $id
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $clientes = Cliente::findOrFail($id);
            $clientes->delete();

            flash('Cliente '.$id. ' eliminado con exito')->success();
            return redirect()->back();
        } catch (Exception $exception) {
            flash('ERROR: Ocurrio un error al eliminar el cliente '.$id.' '.$exception->getMessage())->error();
            return back()->withInput();
                //->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [

            'nom_cliente' => 'nullable|string|min:1|max:500',
            'nom_contacto' => 'nullable|string|min:1|max:500',
            'img_logo' => 'nullable|string|min:1|max:250',
            'val_apikey' => 'nullable|string|min:1|max:500',
            'token_1uso' => 'nullable|string|min:1|max:100',
            'tel_cliente' => 'nullable|string|min:1|max:20',
            'CIF' => 'nullable|string|min:1|max:20',
            'fec_borrado' => 'nullable|date_format:j/n/Y g:i A',
            'mca_appmovil' => 'nullable',
            'mca_vip' => 'nullable',
            'cod_tipo_cliente' => 'nullable',

        ];


        $data = $request->validate($rules);




        return $data;
    }
}
