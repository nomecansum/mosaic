<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\niveles_acceso;
use App\Models\users;
use Illuminate\Http\Request;
use Exception;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\Cliente;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;




class UsersController extends Controller
{
    public function index_import(){

        return view('users.import');

    }

    public function import()
    {
        Excel::import(new UsersImport, 'users.xlsx');

        return redirect('/')->with('success', 'All good!');
    }

    public function subir_adjuntos(Request $r){
		//dd($r);
		try{
			if(isset($r->cod_cliente)){
				$directorio=public_path().'/uploads/incidents/justificantes_validar/'.$r->cod_cliente.'/';
				if(!File::exists($directorio)) {
					File::makeDirectory($directorio);
				}

				$file = $r->file('file');
				$file->move($directorio,$file->getClientOriginalName());
				$original=$file->getClientOriginalName();
				$extension=File::extension($file->getClientOriginalName());
				$newfile=$r->cod_cliente.'_'.Str::random(24).'.'.$extension;
				rename($directorio.$original, $directorio.$newfile);
				//Ahora a guardar el adjunto
				/* DB::table('cur_adjuntos_incidencia')
				->insert([
					"fic_adjunto"=>basename($newfile),
					"fic_original"=>basename($original),
					"cod_incidencia"=>$r->cod_incidencia,
					"cod_empleado"=>$r->cod_empleado,
					"fec_incidencia"=>Carbon::parse($r->fec_dia),
					"fecha"=>Carbon::now()
				]); */

				return response()->json(array('success' => true, 'filename'=>$original,'newfilename'=>$newfile));
			}
		} catch(\Exception $e){
		response()->json([
			"error" => "Error subiendo adjunto ".mensaje_excepcion($e),
			"TS" => Carbon::now()->format('Y-m-d h:i:s')
			],400)->throwResponse();
		return response()->json(array('error' => false));
		}

	}

    /**
     * Display a listing of the users.
     *
     * @return Illuminate\View\View
     */
    public function index()
    {
        $usersObjects = DB::table('users')->paginate(20);
        //->join('niveles_acceso','users.cod_nivel', 'niveles_acceso.cod_nivel')
        //->paginate(25);
        //$usersObjects = users::with('grupo','perfile')->paginate(25);

        return view('users.index', ['users' => $usersObjects],compact('usersObjects'));
    }

    /**
     * Show the form for creating a new users.
     *
     * @return Illuminate\View\View
     */
    public function create()
    {
        //$Grupos = Grupo::pluck('grupo','id_grupo')->all();
        $Perfiles = niveles_acceso::all();

        return view('users.create', compact('Perfiles'));
    }

    /**
     * Store a new users in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        //Vamos a comprbar el email, porque no puedo pasarlo por el validado
        if(DB::table('users')->where('email',$request->email)->exists()){
            flash('ERROR: El e-mail ya existe '.$request->email)->error();
            return back()->withInput();
        }

        $data = $this->getData($request);


        $img_usuario = "";
        try {
             if ($request->hasFile('img_usuario')) {
                $file = $request->file('img_usuario');
                $path = public_path().'/img/users/';
                $img_usuario = uniqid().rand(000000,999999).'.'.$file->getClientOriginalExtension();
                $file->move($path,$img_usuario);
            }

            $data['img_usuario']=$img_usuario;
            $data["password"]=Hash::make($data["password"]);
            $data["cod_nivel"]=$request->cod_nivel;

            users::create($data);
            return [
                'title' => "Usuarios",
                'message' => 'Usuario '.$request->name. ' creado con exito',
                'url' => url('users')
            ];
        } catch (Exception $exception) {
            return [
                'title' => "Usuarios",
                'error' => 'ERROR: Ocurrio un error creando el usuario '.$request->name.' '.$exception->getMessage(),
                //'url' => url('sections')
            ];
            // flash('ERROR: Ocurrio un error creando el usuario '.$request->name.' '.$exception->getMessage())->error();
            // return back()->withInput();
        }
    }

    /**
     * Display the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function show($id)
    {
        $users = DB::table('users')
        ->leftjoin('niveles_acceso','users.cod_nivel', 'niveles_acceso.cod_nivel')
        ->where('id',$id)
        -first();

        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified users.
     *
     * @param int $id
     *
     * @return Illuminate\View\View
     */
    public function edit($id,Request $r)
    {
        $users = users::findOrFail($id);

        $Perfiles = niveles_acceso::all();

        $clientescombo = Cliente::all();

        $timezone = users::get('val_timezone');


        return view('users.edit', compact('users','Perfiles','clientescombo', 'timezone'));
    }

    /**
     * Update the specified users in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse | Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        $img_usuario = "";
        $data = $this->getData($request);
        try {
            if ($request->hasFile('img_usuario')) {
                $file = $request->file('img_usuario');
                $path = public_path().'/img/users/';
                $img_usuario = uniqid().rand(000000,999999).'.'.$file->getClientOriginalExtension();
                $file->move($path,$img_usuario);
            }

            $data['img_usuario']=$img_usuario;

            if (isset($request->password)){
                $data["password"]=Hash::make($request->password);
            }
            $users = users::findOrFail($id);
            $users->update($data);
            return [
                'title' => "Usuarios",
                'message' => 'Usuario '.$request->name. ' actualizado con exito',
                //'url' => url('sections')
            ];
            // flash('Usuario '.$request->name. 'actualizado con exito')->success();
            // return redirect()->route('users.users.index');
        } catch (Exception $exception) {
            // flash('ERROR: Ocurrio un error actualizando el usuario '.$request->name.' '.$exception->getMessage())->error();
            // return back()->withInput();
            return [
                'title' => "Usuarios",
                'error' => 'ERROR: Ocurrio un error actualizando el usuario '.$request->name.' '.$exception->getMessage(),
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
            $users = users::findOrFail($id);
            $users->delete();

            flash('Usuario '.$id. ' eliminado con exito')->success();
            return redirect()->route('users.users.index');
        } catch (Exception $exception) {
            flash('ERROR: Ocurrio un error al eliminar el usuario '.$id.' '.$exception->getMessage())->error();
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
            'collapse' => 'nullable|numeric|min:-2147483648|max:2147483647',
            'email' => 'required|string|min:1|max:255',
            'email_verified_at' => 'nullable|date_format:j/n/Y g:i A',
            'id_grupo' => 'nullable',
            'id_perfil' => 'nullable',
            'name' => 'required|string|min:1|max:255',
            'password' => 'required|string|min:1|max:255',
            'remember_token' => 'nullable|string|min:0|max:100',
            'theme' => 'nullable|string|min:0|max:150',
            'val_timezone' => 'nullable|string|min:0|max:100',
            'id_cliente' => 'nullable|numeric|min:0|max:2147483647',
        ];
        $data = $request->validate($rules);
        return $data;
    }

}

