<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActividadHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actividad_horarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('f_inicio_actividad')->nullable();
            $table->date('f_fin_actividad')->nullable();
            $table->time('h_inicio_actividad');
            $table->time('h_fin_actividad')->nullable();
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
        Schema::dropIfExists('actividad_horarios');
    }
}
