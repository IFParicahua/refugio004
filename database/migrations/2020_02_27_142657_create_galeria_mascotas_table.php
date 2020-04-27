<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaMascotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_mascotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_mascota');
            $table->integer('prioridad');
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('pkmascota');
            $table->foreign('pkmascota')->references('id')->on('mascotas');
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
        Schema::dropIfExists('galeria_mascotas');
    }
}
