<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    public function personaUsuario()
    {
        return $this->belongsTo(
            'App\User',
            'pkuser'
        );
    }
}
