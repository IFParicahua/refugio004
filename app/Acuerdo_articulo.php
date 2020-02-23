<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Acuerdo_articulo extends Model
{
    protected $table = 'acuerdo_articulos';

    public function articuloSolicitud()
    {
        return $this->belongsTo(
            'App\Solicitud_acuerdo',
            'pkacuerdo'
        );
    }
}
