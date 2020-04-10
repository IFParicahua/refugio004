<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdopcionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adopciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('f_adopcion');
            $table->string('desc_adopcion');
            $table->unsignedBigInteger('pkpersona');
            $table->foreign('pkpersona')->references('id')->on('personas');
            $table->unsignedBigInteger('pkmascota');
            $table->foreign('pkmascota')->references('id')->on('mascotas');
            $table->unsignedBigInteger('pkestado');
            $table->foreign('pkestado')->references('id')->on('estado_adopciones');
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
        Schema::dropIfExists('adopciones');
    }
}
