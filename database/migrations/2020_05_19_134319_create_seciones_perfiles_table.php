<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecionesPerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seciones_perfiles', function (Blueprint $table) {
            $table->id('cod_seccion_perfil');
            $table->integer('id_seccion')->nullable();
            $table->integer('id_perfil')->nullable();
            $table->integer('mca_read')->nullable();
            $table->integer('mca_write')->nullable();
            $table->integer('mca_create')->nullable();
            $table->integer('mca_delete')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seciones_perfiles');
    }
}
