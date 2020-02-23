<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcuerdoArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acuerdo_articulos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('articulo');
            $table->integer('cantidad');
            $table->unsignedBigInteger('pkacuerdo');
            $table->foreign('pkacuerdo')->references('id')->on('solicitud_acuerdos');
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
        Schema::dropIfExists('acuerdo_articulos');
    }
}
