<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';
    public function enlace()
    {
        return $this->hasMany(
            'App\Enlace',
            'pkpersona',
            'id'
        );
    }
    public function empresa(){
        return $this->hasOne('App\Empresa','pkpersona');
    }
    public function refugio(){
        return $this->hasOne('App\Refugio','pkpersona');
    }
}
