<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('valor_donacion')->nullable();
            $table->string('desc_donacion');
            $table->boolean('estado');
            $table->unsignedBigInteger('pkpersona')->nullable();
            $table->foreign('pkpersona')->references('id')->on('personas');
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
        Schema::dropIfExists('donaciones');
    }
}
