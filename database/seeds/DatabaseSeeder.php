<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Niveles_accesoSeeder::class);

        $this->call(SeccionesSeeder::class);

        $this->call(Secciones_perfilesSeeder::class);

        $this->call(usersSeeder::class);
    }
}
