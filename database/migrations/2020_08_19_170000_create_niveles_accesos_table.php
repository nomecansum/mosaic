<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNivelesAccesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('niveles_acceso', function (Blueprint $table) {

            $table->id('cod_nivel');

            $table->integer('val_nivel_acceso');
            $table->string('des_nivel_acceso',200)->nullable();
            $table->timestamps();

            $table->bigInteger('cod_cliente')->unsigned()->nullable();
            //$table->foreign('cod_cliente')->references('id')->on('clientes');

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
