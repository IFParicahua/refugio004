<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudAcuerdosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_acuerdos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('f_solicitud');
            $table->boolean('estado');
            $table->string('detalle');
            $table->unsignedBigInteger('pkrefugio');
            $table->foreign('pkrefugio')->references('id')->on('refugios');
            $table->unsignedBigInteger('pkempresa');
            $table->foreign('pkempresa')->references('id')->on('empresas');
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
        Schema::dropIfExists('solicitud_acuerdos');
    }
}
