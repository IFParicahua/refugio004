<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enlaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('link');
            $table->string('identificador');
            $table->unsignedBigInteger('pkcuenta');
            $table->foreign('pkcuenta')->references('id')->on('tipo_cuentas');
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
        Schema::dropIfExists('enlaces');
    }
}
