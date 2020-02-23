<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria_publicacion extends Model
{
    protected $table = 'galeria_publicaciones';

    public function galeriaPublicacion()
    {
        return $this->belongsTo(
            'App\Publicacion',
            'pkpublicacion'
        );
    }
}
