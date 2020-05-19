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
            $table->integer('id_seccion',11)->nullable();
            $table->integer('cod_usuario',11)->nullable();
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
        Schema::dropIfExists('permisos_usuarios');
    }
}
