<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriaRefugiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('galeria_refugios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('foto_refugio');
            $table->string('descr_refugio')->nullable();
            $table->integer('prioridad');
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
        Schema::dropIfExists('galeria_refugios');
    }
}
