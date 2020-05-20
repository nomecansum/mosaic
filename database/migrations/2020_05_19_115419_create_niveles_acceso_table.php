<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesAccesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('niveles_acceso', function (Blueprint $table) {

            $table->id('cod_nivel');
            $table->integer('val_nivel_acceso',11);
            $table->string('des_nivel_acceso',200)->nullable();
            $table->timestamps();

            $table->integer('cod_cliente')->unsigned()->nullable();
            $table->foreign('cod_cliente')->references('cod_cliente')->on('clientes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('niveles_acceso', function (Blueprint $table) {
            //
        });
    }
}