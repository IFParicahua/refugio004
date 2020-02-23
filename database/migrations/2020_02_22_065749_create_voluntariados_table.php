<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoluntariadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voluntariados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('observacion');
            $table->boolean('estado');
            $table->unsignedBigInteger('pkpersona');
            $table->foreign('pkpersona')->references('id')->on('personas');
            $table->unsignedBigInteger('pkactividad');
            $table->foreign('pkactividad')->references('id')->on('actividades');
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
        Schema::dropIfExists('voluntariados');
    }
}
