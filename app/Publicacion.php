<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion extends Model
{
    protected $table = 'publicaciones';

    public function publicacionEmpresa()
    {
        return $this->belongsTo(
            'App\Empresa',
            'pkempresa'
        );
    }
}
