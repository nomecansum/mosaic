<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ImageUpload;

use Illuminate\Support\Facades\File;

use App\Models\users;

class ImageUploadController extends Controller
{

    public function procesar_import(Request $r){

        //dd($r->all());
            if(isset($r->id_cliente)){
                $directorio=public_path().'plantillas'.$r->id_cliente.'/';

                if(!File::exists($directorio)) {
                    File::makeDirectory($directorio);
                }

                $files = $r->file('file');
                foreach($files as $file){
                    $file->move($directorio,$file->getClientOriginalName());
                    if(File::extension($file->getClientOriginalName())=='xls' || File::extension($file->getClientOriginalName())=='xlsx'){
                        $fichero_plantilla=$directorio.$file->getClientOriginalName();
                    }
                }
            }
            if (isset($fichero_plantilla)){ //A jugar
                if(File::extension($fichero_plantilla)=='xls'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }if (isset($fichero_plantilla)){ //A jugar
                if(File::extension($fichero_plantilla)=='xls'){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                }else{
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                }

                $spreadsheet = $reader->load($fichero_plantilla);
                        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();$spreadsheet = $reader->load($fichero_plantilla);
                        $highestRow = $spreadsheet->getActiveSheet()->getHighestRow();


                        for ($i = 2; $i <= $highestRow; $i++) {
                            $emp = $this->fila_to_object($spreadsheet,$i,$r->id_cliente);
                            if($emp==false){//sacabo
                            break;
                            } else{
                            //A insertar el usuario
                            $user_svc = new users;

                            }

                            //Validamos el form
                            $validator=$user_svc->validar_request_empleado($emp,'texto');
                            if ($validator!==true){
                            $errores.=$validator;
                            }
                            $cuenta_usuarios++;
                            }


                }
            }
        }
        function fila_to_object($spreadsheet,$i,$cliente){

            $emp_svc = new users;
            $fila = $spreadsheet->setActiveSheetIndex(0)->rangeToArray('A'.$i.':Q'.$i)[0];
            //error_log(json_encode($fila));
            $vacio=true;
            for($n=0;$n<17;$n++){
            if($fila[$n]<>''){
            $vacio=false;
                }
            }
                if ($vacio){ //Fila vacio, ya no hay mas que procesar
                return false;
                }

                $emp = new Request([
                'id' => intval($fila[0]),
                'id_cliente' => intval($fila[1]),
                'name' => $fila[2],
                'email' => $fila[3],
                'email_verified_at' => $fila[4],
                'password' => intval($fila[5]),
                'remember_token' => $fila[6],
                'created_at' => $fila[7],
                'updated_at' => $fila[8],
                'img_usuario' => $fila[9],
                'cod_nivel' => intval($fila[10]),
                'theme' => $fila[11],
                'collapse' => intval($fila[12]),
                'val_timezone' => $fila[13],
                'last_login' => $fila[14]

            ]);

            return $emp;
        }

    function fileCreate()
    {
        return view('users.import');
    }
    function fileStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = $image->getClientOriginalName();
        $image->move(public_path('uploads/import'),$imageName);


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
}
