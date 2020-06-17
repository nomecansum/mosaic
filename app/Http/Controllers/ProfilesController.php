<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Validator;
use Auth;

class ProfilesController extends Controller
{
    //

    public function profiles()
	{
		$nivel_acceso = \DB::table('niveles_acceso')->where('cod_nivel',Auth::user()->cod_nivel)->first()->val_nivel_acceso;
		$niveles =
		  DB::table('niveles_acceso')
			->where('val_nivel_acceso','<=',$nivel_acceso)
			->get();
		return view('permisos.profiles',compact('niveles','nivel_acceso'));
    }

    public function getProfiles(Request $r)
    {
        $nivel_acceso = \DB::table('niveles_acceso')->where('cod_nivel',Auth::user()->cod_nivel)->first()->val_nivel_acceso;
		$niveles = DB::table('niveles_acceso')
				->join('clientes','niveles_acceso.id_cliente','clientes.id_cliente')
                ->where('val_nivel_acceso', '<=', $nivel_acceso)
                ->where('id_cliente', $r->cli)
                ->get();
        return $niveles;
    }

	public function profilesEdit($id)
	{
	    $nivel_acceso = \DB::table('niveles_acceso')->where('cod_nivel',Auth::user()->num_nivel_acceso)->first()->val_nivel_acceso;
        $niveles =
          DB::table('niveles_acceso')
            ->where('val_nivel_acceso','<=',$nivel_acceso)
            ->get();
		$n = DB::table('niveles_acceso')->where('cod_nivel',$id)->first();
		return view('permisos.profiles',compact('n', 'niveles', 'nivel_acceso'));
	}
	public function profilesSave(Request $r)
	{
		//dd($r);
		if ($r->id!=0) {
			DB::table('niveles_acceso')->where('cod_nivel',$r->id)->update(
				[
				    'des_nivel_acceso' => $r->des_nivel_acceso,
				    'val_nivel_acceso' => $r->num_nivel_acceso
				]
			);

			$n = DB::table('niveles_acceso')->where('cod_nivel',$r->id)->first();
		}
		else
		{
			$n = DB::table('niveles_acceso')->insert(
				[
					'val_nivel_acceso' => $r->num_nivel_acceso,
					'des_nivel_acceso' => $r->des_nivel_acceso
				]
			);
			$n = DB::table('niveles_acceso')->where('des_nivel_acceso',$r->des_nivel_acceso)->orderby('cod_nivel','desc')->first();
		}


		if($r->hereda_de && $r->hereda_de!=''){
			DB::table('secciones_perfiles')
			->where('id_perfil',$n->cod_nivel)
			->delete();

			$padre=DB::table('secciones_perfiles')->where('id_perfil',$r->hereda_de)->get();
			foreach($padre as $p){
				DB::table('secciones_perfiles')->insert([
					'id_seccion' => $p->id_seccion,
					'id_perfil' => $n->cod_nivel,
					'mca_read' => $p->mca_read,
					'mca_write' => $p->mca_write,
					'mca_create' => $p->mca_create,
					'mca_delete' => $p->mca_delete,
				]);
			}
		}
        else
        {
            DB::table('secciones_perfiles')
            ->where('id_perfil',$n->cod_nivel)
            ->delete();

            $padre = DB::table('secciones_perfiles')->where('id_perfil',1)->get();
            foreach($padre as $p){
                DB::table('secciones_perfiles')->insert([
                    'id_seccion' => $p->id_seccion,
                    'id_perfil' => $n->cod_nivel,
                    'mca_read' => $p->mca_read,
                    'mca_write' => $p->mca_write,
                    'mca_create' => $p->mca_create,
                    'mca_delete' => $p->mca_delete,
                ]);
            }
        }
		savebitacora("Creaado perfil ".$r->des_nivel_acceso,Auth::user()->id,"Secciones","OK");
		return [
            'title' => "Perfiles",
            'message' => "Perfil ".$r->des_nivel_acceso.': Guardado',
            'url' => url('profiles')
        ];
	}
	public function profilesDelete($id)
	{
		savebitacora("Eliminado perfil ".$id." ".DB::table('niveles_acceso')->where('cod_nivel',$id)->value('des_nivel_acceso'),Auth::user()->id,"Perfiles","OK");
		DB::table('niveles_acceso')->where('cod_nivel',$id)->delete();
		flash('Perfil '.$id.' Borrado')->success();
		return redirect('profiles');
	}
	

}
