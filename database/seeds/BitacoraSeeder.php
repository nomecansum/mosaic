<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class BitacoraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bitacora')->insert([

            'id_bitacora' => '100',
            'id_usuario' => null,
            'id_modulo' => 'Usuarios',
            'accion' => 'Editados los datos del usuario: Pepe Bajo Gracía',
            'status' => 'ok',
            'fecha' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('bitacora')->insert([

            'id_bitacora' => '101',
            'id_usuario' => null,
            'id_modulo' => 'Usuarios',
            'accion' => 'Creado nuevo usuario con nombre: Esther Asin',
            'status' => 'ok',
            'fecha' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('bitacora')->insert([

            'id_bitacora' => '102',
            'id_usuario' => null,
            'id_modulo' => 'Usuarios',
            'accion' => 'Eliminado un usuario',
            'status' => 'ok',
            'fecha' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('bitacora')->insert([

            'id_bitacora' => '103',
            'id_usuario' => null,
            'id_modulo' => 'Usuarios',
            'accion' => 'Se ha cambiado su contraseña',
            'status' => 'error',
            'fecha' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('bitacora')->insert([

            'id_bitacora' => '104',
            'id_usuario' => null,
            'id_modulo' => 'Usuarios',
            'accion' => 'Se ha cambiado su contraseña',
            'status' => 'ok',
            'fecha' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
