<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titulo_actividad');
            $table->string('img_actividad');
            $table->string('desc_actividad');
            $table->integer('estado');
            $table->integer('cupos');
            $table->unsignedBigInteger('pkrefugio');
            $table->string('dia')->nullable();
            $table->foreign('pkrefugio')->references('id')->on('refugios');
	        $table->unsignedBigInteger('pktipo_horario');
            $table->foreign('pktipo_horario')->references('id')->on('tipo_horarios');
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
        Schema::dropIfExists('actividades');
    }
}
