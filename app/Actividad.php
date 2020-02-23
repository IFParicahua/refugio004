<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    protected $table = 'actividades';

    public function actividadRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }

    public function actividadTipo()
    {
        return $this->belongsTo(
            'App\Tipo_horario',
            'pktipo_horario'
        );
    }
}
