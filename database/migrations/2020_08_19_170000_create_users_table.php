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
            $table->rememberToken();
            $table->string('img_usuario')->nullable();
            $table->string('theme',150)->nullable();
            $table->integer('collapse')->default('0');
            $table->dateTime('last_login')->nullable();
            $table->timestamps();

            $table->bigInteger('cod_cliente')->unsigned()->nullable();
            $table->foreign('cod_cliente')->references('id')->on('clientes');

            $table->bigInteger('cod_nivel')->unsigned()->default('1');//No funciona en formulario. seeder con niveles_acceso?
            $table->foreign('cod_nivel')->references('cod_nivel')->on('niveles_accesos');
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
