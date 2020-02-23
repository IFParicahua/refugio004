<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donacion extends Model
{
    protected $table = 'donaciones';
    public function donacionPersona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkpersona'
        );
    }
    public function donacionRefugios()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
}
