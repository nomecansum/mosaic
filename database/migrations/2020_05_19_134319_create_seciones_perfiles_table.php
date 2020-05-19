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
            $table->integer('id_seccion',11)->nullable();
            $table->integer('id_perfil',11)->nullable();
            $table->integer('mca_read',11)->nullable();
            $table->integer('mca_write',11)->nullable();
            $table->integer('mca_create',11)->nullable();
            $table->integer('mca_delete',11)->nullable();
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
