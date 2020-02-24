<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicacionRefugiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publicacion_refugios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo');
            $table->string('desc_publicacion_donacion');
            $table->string('valor_donacion')->nullable();
            $table->integer('estado_public');
            $table->string('tipo_publicacion');
            $table->boolean('prioridad');
            $table->unsignedBigInteger('pkrefugio');
            $table->foreign('pkrefugio')->references('id')->on('refugios');
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
        Schema::dropIfExists('publicacion_refugios');
    }
}
