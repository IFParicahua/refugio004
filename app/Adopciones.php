<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adopciones extends Model
{
    protected $table = 'adopciones';

    public function adopcionPersona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkpersona'
        );
    }
    public function adopcionEstado()
    {
        return $this->belongsTo(
            'App\Estado_adopcion',
            'pkestado'
        );
    }
    public function adopcionMascota()
    {
        return $this->hasOne(
            'App\Mascota',
            'pkmascota'
        );
    }
}
