<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mascotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_mascota');
            $table->string('indicacion_cuidado',500)->nullable();
            $table->date('f_nacimiento');
            $table->string('genero');
            $table->string('especie');
            $table->decimal('peso', 8, 2);
            $table->string('desc_mascota',500)->nullable();
            $table->unsignedBigInteger('pksize');
            $table->foreign('pksize')->references('id')->on('size_pets');
            $table->unsignedBigInteger('pkestado');
            $table->foreign('pkestado')->references('id')->on('estado_mascotas');
            $table->unsignedBigInteger('pkraza');
            $table->foreign('pkraza')->references('id')->on('razas');
            $table->unsignedBigInteger('pkrefugio')->nullable();
            $table->foreign('pkrefugio')->references('id')->on('refugios');
            $table->unsignedBigInteger('pkresponsable')->nullable();
            $table->foreign('pkresponsable')->references('id')->on('personas');
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
        Schema::dropIfExists('mascotas');
    }
}
