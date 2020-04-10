<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('razonsocial');
            $table->string('sigla');
            $table->integer('nit');
            $table->string('dir_empresa',500);
            $table->string('desc_empresa',500)->nullable();
            $table->unsignedBigInteger('pkrubro');
            $table->foreign('pkrubro')->references('id')->on('rubros');
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
        Schema::dropIfExists('empresas');
    }
}
