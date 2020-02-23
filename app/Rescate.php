<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rescate extends Model
{
    public function rescatePersona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkpersona'
        );
    }
}
