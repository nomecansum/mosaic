<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Niveles_accesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveles_acceso')->insert([

            'cod_nivel' => '1',
            'val_nivel_acceso' => '1',
            'des_nivel_acceso' => 'Acceso unitario',
            'cod_cliente' => null
        ]);

        DB::table('niveles_acceso')->insert([

            'cod_nivel' => '2',
            'val_nivel_acceso' => '10',
            'des_nivel_acceso' => 'Informes',
            'cod_cliente' => null
        ]);

        DB::table('niveles_acceso')->insert([

            'cod_nivel' => '3',
            'val_nivel_acceso' => '50',
            'des_nivel_acceso' => 'Validador',
            'cod_cliente' => null
        ]);

        DB::table('niveles_acceso')->insert([

            'cod_nivel' => '4',
            'val_nivel_acceso' => '100',
            'des_nivel_acceso' => 'Administrador',
            'cod_cliente' => null
        ]);

        DB::table('niveles_acceso')->insert([

            'cod_nivel' => '5',
            'val_nivel_acceso' => '200',
            'des_nivel_acceso' => 'Superadmin',
            'cod_cliente' => null
        ]);
    }
}
