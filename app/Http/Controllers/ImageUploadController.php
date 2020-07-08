<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;
use Illuminate\Support\Facades\File;
use App\Models\users;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class ImageUploadController extends Controller
{
        function fila_to_object($spreadsheet,$i,$cliente){

            $emp_svc = new users;
            $fila = $spreadsheet->setActiveSheetIndex(0)->rangeToArray('A'.$i.':E'.$i)[0];
            //error_log(json_encode($fila));
            $vacio=true;
            for($n=0;$n<5;$n++){
            if($fila[$n]<>''){
            $vacio=false;
                }
            }
                if ($vacio){ //Fila vacio, ya no hay mas que procesar
                return false;
                }

                $emp = new Request([
                'name' => $fila[0],
                'email' => $fila[1],
                'password' => $fila[2],
                'img_usuario' => $fila[3],
                'cod_nivel' => intval($fila[4]),
            ]);

            return $emp;
        }

    function fileCreate()
    {
        return view('users.import');
    }

    function fileStore(Request $request)
    {

        $directorio = public_path().'/uploads/import/'.Auth::user()->id_cliente.'/';
        if(!File::exists($directorio)) {
            File::makeDirectory($directorio);
        }
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        $file->move($directorio,$fileName);
        if(File::extension($file->getClientOriginalName())=='xls' || File::extension($file->getClientOriginalName())=='xlsx'){
            //Es un excel, a procesarlo
            $fichero_plantilla=$directorio.$file->getClientOriginalName();
        }

        if (isset($fichero_plantilla)){
            if(File::extension($fichero_plantilla)=='xls')
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                else $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

                $spreadsheet = $reader->load($fichero_plantilla);
                $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();
                //Validar los datos
                //Vuelta de comprobacion
                $errores = "";
                $cuenta_usuarios = 0;
                $mensajes_adicionales = "";

                for ($i = 2; $i <= $highestRow; $i++)
                {
                    $emp = $this->fila_to_object($spreadsheet, $i, $request->cod_cliente);
                    if($emp == false)
                    {
                    	//fin del fichero
                        break;
                    }
                    else
                    {
                        $validator=$this->getData($emp);
                        if ($validator !== true)
                            $errores .= $validator;
                        $cuenta_usuarios++;

                    }

                }
                //Vuelta buena
                try{
                    DB::beginTransaction();
                    $nombres_usuarios = "";
                    $mensajes_adicionales="";
                    for ($i = 2; $i < ($cuenta_usuarios+2); $i++)
                    {
                        $emp = $this->fila_to_object($spreadsheet,$i,$request->cod_cliente);
                        //Aqui hay que procesar los usuarios para insertarlos en la bdd, primero comprobando la imagen si existe o no


                        //Al fina, una vez insertado el usuario se saca el ID que le ha tocado para ponerlo en el mensaje ed salida
                        $id=0;  //Esto solo es para que no falle ahora, luego se quita

                        //savebitacora("Creado usuario en importacion " . $id . " " . $emp->name);
                        $nombres_usuarios .= "[".$id."] " . $emp->name . "<br>";

                        try {

                            if (File::exists('img_usuario')) {
                               $path = public_path().'/uploads/import/'.Auth::user()->id_cliente.'/';
                               $img_usuario = uniqid().rand(000000,999999).'.'.$file->getClientOriginalExtension();
                               $file->move($path,$img_usuario);
                           }

                       } catch (Exception $exception) {

                           // flash('ERROR: Ocurrio un error creando el usuario '.$request->name.' '.$exception->getMessage())->error();
                           // return back()->withInput();
                       }

                        users::create($validator);
                    }

                    DB::commit();
                    //Borramos el excel y la carpeta de importacion
                    File::deleteDirectory($directorio);

                    return [
                        'title' => 'Importación de usuarios finalizada con exito',
                        'message' => $cuenta_usuarios . " empleados importados correctamente:<br>" . $nombres_usuarios . "<br>" . $mensajes_adicionales,
                        'tipo' => 'ok'
                    ];
                } catch (Exception $e){
                    DB::rollback();
                    savebitacora("Error usuario en importación ".$emp->name." " . $e->getMessage(), null);
                    return [
                        'title' => 'Error comprobando los datos de usuarios',
                        'message' => "Error usuario en importación " . $emp->name . " " . $e->getMessage(),
                        'tipo' => 'error'
                    ];
                }

        }

        return;

    }
    function fileDestroy(Request $request)
    {
        $filename =  $request->get('filename');

        $path=public_path().'/uploads/import'.$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    function getData(Request $request){

        $rules = [
            'email' => ['required','email', Rule::unique('users','email')],
            'cod_nivel' => 'required|numeric|min:0|max:1000',
            'name' => 'required|string|min:1|max:255',
            'password' => 'required|string|min:1|max:255',
            'img_usuario' => 'nullable|string|max:255',
        ];
        $validator = Validator::make($request->all(), $rules,[]);
        if($validator->fails()) {
            $mensaje_error = implode("<br>",$validator->messages()->all());
            return $mensaje_error;
        }else return true;

        return $request;
    }


}
