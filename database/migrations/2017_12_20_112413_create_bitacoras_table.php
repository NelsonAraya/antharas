<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha_salida');
            $table->date('fecha_llegada');
            $table->time('hora_salida');
            $table->time('hora_llegada');
            $table->integer('kmsalida');
            $table->integer('kmllegada');
            $table->integer('vehiculo_id')->unsigned();
            $table->foreign('vehiculo_id')->references('id')->on('vehiculos');
            $table->integer('conductor_id')->unsigned();
            $table->foreign('conductor_id')->references('id')->on('usuarios');
            $table->integer('obac_id')->unsigned()->nullable();
            $table->foreign('obac_id')->references('id')->on('usuarios');
            $table->string('servicio',10);
            $table->string('direccion',200);
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
        Schema::dropIfExists('bitacoras');
    }
}
