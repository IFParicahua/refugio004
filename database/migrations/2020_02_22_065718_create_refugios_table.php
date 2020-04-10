<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefugiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refugios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_refugio');
            $table->integer('capacidad');
            $table->string('dir_refugio',500);
            $table->string('desc_refugio',500)->nullable();
            $table->unsignedBigInteger('pktipo');
            $table->foreign('pktipo')->references('id')->on('tipo_refugios');
            $table->unsignedBigInteger('pkpersona');
            $table->foreign('pkpersona')->references('id')->on('personas');
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
        Schema::dropIfExists('refugios');
    }
}
