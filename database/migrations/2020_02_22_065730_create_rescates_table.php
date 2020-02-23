<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rescates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('estado_salud');
            $table->integer('peso_rescatado');
            $table->integer('edad_rescatado');
            $table->date('f_rescate');
            $table->string('lugar_rescate');
            $table->string('detalle_rescate');
            $table->unsignedBigInteger('pkpersona');
            $table->foreign('pkpersona')->references('id')->on('personas');
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
        Schema::dropIfExists('rescates');
    }
}
