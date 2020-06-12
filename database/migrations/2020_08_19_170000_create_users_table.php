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
            $table->string('val_timezone',200)->nullable();

            $table->bigInteger('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes')->nullable();

            $table->bigInteger('cod_nivel')->unsigned()->nullable();
            $table->foreign('cod_nivel')->references('cod_nivel')->on('niveles_acceso')->nullable();

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
