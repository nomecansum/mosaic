<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            'id' => '100',
            'cod_cliente' => null,
            'name' => 'Manolo',
            'email' => 'nomecansum@gmail.com',
            'email_verified_at' => null,
            'password' => '12345678',
            'remember_token' => null,
            'img_usuario' => null,
            'cod_nivel' => '5'
        ]);

        DB::table('users')->insert([

            'id' => '101',
            'cod_cliente' => null,
            'name' => 'caca',
            'email' => 'caca@caca.es',
            'email_verified_at' => null,
            'password' => '12345678',
            'remember_token' => null,
            'img_usuario' => null,
            'cod_nivel' => '1'
        ]);
    }
}
