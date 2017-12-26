<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParteOnlinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parte_onlines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('emergencia_id')->unsigned();
            $table->foreign('emergencia_id')->references('id')->on('emergencias');
            $table->integer('cia_id')->unsigned();
            $table->foreign('cia_id')->references('id')->on('cias');
            $table->integer('numero');
            $table->integer('obac_cia')->unsigned();
            $table->foreign('obac_cia')->references('id')->on('usuarios');
            $table->integer('obac_cbi')->unsigned();
            $table->foreign('obac_cbi')->references('id')->on('usuarios');
            $table->integer('usuario_responsable')->unsigned();
            $table->foreign('usuario_responsable')->references('id')->on('usuarios');
            $table->string('anexo_direccion',200)->nullable();
            $table->string('tipo',200)->nullable();
            $table->string('afectado',200)->nullable();
            $table->string('run_afectado',200)->nullable();
            $table->string('relacion',200)->nullable();
            $table->string('seguro',200)->nullable();
            $table->text('causa')->nullable();
            $table->text('origen')->nullable();
            $table->text('danio')->nullable();
            $table->text('info')->nullable();
            $table->text('trabajo')->nullable();
            $table->integer('op_rescate')->nullable();
            $table->integer('lesionados')->nullable();
            $table->integer('vehiculos')->nullable();
            $table->enum('estado',['C', 'T'])->default('C');
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
        Schema::dropIfExists('parte_onlines');
    }
}
