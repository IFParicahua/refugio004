<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enlace extends Model
{
    protected $table = 'enlaces';


    public function tipoCuenta(){
        return $this->belongsTo(
            'App\Tipo_cuenta',
            'pkcuenta',
            'id'
        );
    }
    public function enlacePersona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkpersona'
        );
    }
}
