<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function registro_activista(){
        return view('auth.registrouser');
    }

    public function registro_empresa(){
        return view('auth.registroemp');
    }

    public function registro_refugio(){
        return view('auth.registroref');
    }
}
