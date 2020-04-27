<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        return view('view.index');
    }
    public function adopciones(){
        return view('view.adopciones');
    }

    public function pet_info(){
        return view('view.pet');
    }

    public function donaciones(){
        return view('view.donaciones');
    }

    public function actividades(){
        return view('view.actividades');
    }

    public function refugios(){
        return view('view.refugios');
    }

    public function refugio(){
        return view('view.refugio');
    }

}
