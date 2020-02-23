<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeria_refugio extends Model
{
    protected $table = 'galeria_refugios';

    public function galeriaRefugio()
    {
        return $this->belongsTo(
            'App\Refugio',
            'pkrefugio'
        );
    }
}
