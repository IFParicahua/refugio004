<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refugio extends Model
{
    public function refugiotipo(){
        return $this->belongsTo(
            'App\Tipo_refugio',
            'pktipo',
            'id'
        );
    }
    public function refugioPersona()
    {
        return $this->hasOne(
            'App\Persona',
            'pkpersona'
        );
    }
}
