<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integer('id')->unsigned()->unique();
            $table->string('dv',1);
            $table->integer('rol')->nullable()->unique();
            $table->string('nombres');
            $table->string('apellidop');
            $table->string('apellidom');
            $table->integer('telefono');
            $table->string('direccion');
            $table->integer('cia_id')->unsigned();
            $table->foreign('cia_id')->references('id')->on('cias');
            $table->integer('cargo_id')->unsigned();
            $table->foreign('cargo_id')->references('id')->on('cargos');
            $table->string('email',150)->unique()->nullable();
            $table->enum('conductor',['S','N'])->default('N');
            $table->string('password');
            $table->enum('estado',['A','I'])->default('A');
            $table->rememberToken();
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
