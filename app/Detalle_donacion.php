<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_donacion extends Model
{
    protected $table = 'detalle_donaciones';

    public function detallePublicacion()
    {
        return $this->belongsTo(
            'App\Publicacion_refugio',
            'pkdonacion'
        );
    }
}
