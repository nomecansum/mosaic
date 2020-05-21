<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_usuarios', function (Blueprint $table) {
            $table->id('cod_permiso_usuario');
            $table->integer('id_seccion')->nullable();
            $table->integer('cod_usuario')->nullable();
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
        Schema::dropIfExists('permisos_usuarios');
    }
}
