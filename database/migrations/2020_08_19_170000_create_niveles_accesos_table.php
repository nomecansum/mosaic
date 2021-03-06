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
            $table->string('des_nivel_acceso',200)->nullable()->default('Acceso unitario');
            $table->timestamps();

            $table->bigInteger('id_cliente')->unsigned()->nullable();
            $table->foreign('id_cliente')->references('id_cliente')->on('clientes');

            /* $table->dropForeign('niveles_acceso_cliente_id_cliente_foreign');
            $table->foreign('id_cliente')
            ->references('id_cliente')->on('clientes')
            ->onDelete('cascade'); */

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
