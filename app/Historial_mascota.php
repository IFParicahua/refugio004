<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial_mascota extends Model
{
    protected $table = 'historial_mascotas';
    public function historialMascota()
    {
        return $this->belongsTo(
            'App\Mascota',
            'pkmascota'
        );
    }
}
