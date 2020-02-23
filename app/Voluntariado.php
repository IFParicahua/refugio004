<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voluntariado extends Model
{
    public function voluntarioPersona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkpersona'
        );
    }
    public function voluntarioActividad()
    {
        return $this->belongsTo(
            'App\Actividad',
            'pkactividad'
        );
    }
}
