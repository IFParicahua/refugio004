<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud_acuerdo extends Model
{
    protected $table = 'solicitud_acuerdos';

    public function solicitudEmpresa()
    {
        return $this->belongsTo(
            'App\Empresa',
            'pkempresa'
        );
    }
    public function solicitudRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
}
