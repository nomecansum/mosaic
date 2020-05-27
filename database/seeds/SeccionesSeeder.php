<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secciones')->insert([

            'cod_seccion' => '1',
            'des_seccion' => 'Usuarios',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '8',
            'des_seccion' => 'Secciones',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '9',
            'des_seccion' => 'Permisos',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '6',
            'des_seccion' => 'Perfiles',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '15',
            'des_seccion' => 'Dashboard',
            'des_grupo' => 'Operativos',
            'icono' => 'mdi mdi-alarm-check',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '12',
            'des_seccion' => 'Configuracion',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '90',
            'des_seccion' => 'Clientes',
            'des_grupo' => 'Configuracion',
            'icono' => 'mdi mdi-settings-box',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '89',
            'des_seccion' => 'Camaras',
            'des_grupo' => 'Operativos',
            'icono' => 'mdi mdi-alarm-check',
            'val_tipo' => 'Seccion'
        ]);

        DB::table('secciones')->insert([

            'cod_seccion' => '11',
            'des_seccion' => 'Bitacora',
            'des_grupo' => 'Operativos',
            'icono' => 'mdi mdi-alarm-check',
            'val_tipo' => 'Seccion'
        ]);
    }
}
