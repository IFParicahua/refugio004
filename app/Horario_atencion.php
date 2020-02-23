<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Horario_atencion extends Model
{
    protected $table = 'horario_atenciones';

    public function horarioRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
}
