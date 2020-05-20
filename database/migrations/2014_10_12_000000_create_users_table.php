<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at');
            $table->string('password');
            $table->rememberToken('remember_token',100);
            $table->string('img_usuario',200);
            $table->string('theme',150);
            $table->integer('collapse',11);
            $table->dateTime('last_login');
            $table->integer('nivel_acceso',11)->default('1');
            $table->timestamps();

            $table->integer('cod_cliente')->unsigned();
            $table->foreign('cod_cliente')->references('cod_cliente')->on('clientes');

            $table->integer('cod_nivel',11)->default('1')->unsigned();
            $table->foreign('cod_nivel')->references('cod_nivel')->on('niveles_acceso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
