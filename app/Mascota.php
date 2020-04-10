<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';

    public function MascotaRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
    public function MascotaRaza()
    {
        return $this->belongsTo(
            'App\Raza',
            'pkraza'
        );
    }
    public function MascotaEstado()
    {
        return $this->belongsTo(
            'App\Estado_mascota',
            'pkestado'
        );
    }
    public function MascotaSize()
    {
        return $this->belongsTo(
            'App\Size_pet',
            'pksize'
        );
    }
    public function Persona()
    {
        return $this->belongsTo(
            'App\Persona',
            'pkresponsable'
        );
    }
}
