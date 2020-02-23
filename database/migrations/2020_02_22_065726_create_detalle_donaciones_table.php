<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleDonacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_donaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('articulo');
            $table->boolean('estado');
            $table->unsignedBigInteger('pkdonacion');
            $table->foreign('pkdonacion')->references('id')->on('publicacion_refugios');
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
        Schema::dropIfExists('detalle_donaciones');
    }
}
