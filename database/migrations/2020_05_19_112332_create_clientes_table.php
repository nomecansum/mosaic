<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('cod_cliente');
            $table->string('nom_cliente',500)->nullable();
            $table->string('nom_contacto',500)->nullable();
            $table->string('img_logo',250)->nullable();
            $table->tinyInteger('locked',1);
            $table->string('val_apikey',500)->nullable();
            $table->integer('num_max_empleados',11)->nullable();
            $table->integer('cod_supracliente',11)->nullable();
            $table->string('token_1uso',100)->nullable();
            $table->enum('mca_actualizacion',['A','B','M'])->nullable();
            $table->enum('completado',['S','N'])->nullable();
            $table->enum('mca_appmovil',['S','N'])->nullable();
            $table->string('tel_cliente',20)->nullable();
            $table->string('CIF',20)->nullable();
            $table->dateTime('fec_caducidad')->nullable();
            $table->dateTime('fec_borrado')->nullable();
            $table->enum('mca_vip',['S','N'])->nullable();
            $table->string('customer_stripe',100)->nullable();
            $table->integer('cod_tipo_cliente',11)->nullable();
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
        Schema::dropIfExists('clientes');
    }
}
