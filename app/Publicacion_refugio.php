<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publicacion_refugio extends Model
{
    protected $table = 'publicacion_refugios';

    public function publicacionRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
}
