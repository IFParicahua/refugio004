<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    public function empresaPersona()
    {
        return $this->hasOne(
            'App\Persona',
            'pkpersona'
        );
    }
    public function empresaRubro()
    {
        return $this->belongsTo(
            'App\Rubro',
            'pkrubro'
        );
    }
}
