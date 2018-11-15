<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('patente',10)->unique();
            $table->string('clave');
            $table->string('modelo');
            $table->string('marca');
            $table->integer('anio');
            $table->integer('cia_id')->unsigned();
            $table->foreign('cia_id')->references('id')->on('cias');
            $table->integer('orden')->nullable();
            $table->enum('estado',['A','I'])->default('A');
            $table->enum('activacion',['S','N'])->default('N');
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
        Schema::dropIfExists('vehiculos');
    }
}
