<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad_horario extends Model
{
    protected $table = 'actividad_horarios';
    public function horarioActividad()
    {
        return $this->belongsTo(
            'App\Actividad',
            'pkactividad'
        );
    }
}
