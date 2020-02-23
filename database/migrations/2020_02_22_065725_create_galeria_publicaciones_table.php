<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaPublicacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_publicaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('img_publicacion');
            $table->integer('prioridad');
            $table->unsignedBigInteger('pkpublicacion');
            $table->foreign('pkpublicacion')->references('id')->on('publicaciones');
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
        Schema::dropIfExists('galeria_publicaciones');
    }
}
