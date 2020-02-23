<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria_mascota extends Model
{
    protected $table = 'galeria_mascotas';
    public function galeriaMascota()
    {
        return $this->belongsTo(
            'App\Mascota',
            'pkmascota'
        );
    }
}
