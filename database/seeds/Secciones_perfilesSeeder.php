<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Secciones_perfilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secciones_perfiles')->insert([
            'id_seccion' => '6',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '107'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '9',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '108'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '11',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '260'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '15',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '264'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '12',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '267'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '8',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '269'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '1',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '270'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '89',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '282'
        ]);

        DB::table('secciones_perfiles')->insert([

            'id_seccion' => '90',
            'id_perfil' => '5',
            'mca_read' => '1',
            'mca_write' => '1',
            'mca_create' => '1',
            'mca_delete' => '1',
            'cod_seccion_perfil' => '283'
        ]);
    }
}
