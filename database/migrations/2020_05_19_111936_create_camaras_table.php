<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCamarasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('camaras', function (Blueprint $table) {

            Schema::create('camaras', function (Blueprint $table) {
                $table->id();
                $table->string('url',300)->nullable();
                $table->string('ip',300)->nullable();
                $table->string('username',50)->nullable();
                $table->string('password',50)->nullable();
                $table->integer('status')->nullable();
                $table->string('etiqueta',100)->nullable();
                $table->string('thumbnail',300)->nullable();
                $table->integer('port')->nullable();
                $table->string('val_color',10)->nullable();
                $table->timestamps();
            });

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('camaras', function (Blueprint $table) {
            //
        });
    }
}
