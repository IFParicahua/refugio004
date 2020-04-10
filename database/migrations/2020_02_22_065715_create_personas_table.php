<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom_persona');
            $table->string('apellido');
            $table->string('dir_persona',500)->nullable();
            $table->integer('telefono');
            $table->string('CI');
            $table->string('genero_persona');
            $table->date('f_nac_persona')->nullable();
            $table->unsignedBigInteger('pkuser')->nullable();
            $table->foreign('pkuser')->references('id')->on('users');
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
        Schema::dropIfExists('personas');
    }
}
