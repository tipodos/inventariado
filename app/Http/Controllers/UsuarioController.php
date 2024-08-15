<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //
    public function movimiento(){
        return view('movimiento');
    }
    
    public function material(){
        return view('material');
    }

    public function herramienta(){
        return view('herramienta');
    }

    public function lista(){
        return view('lista');
    }

    public function usuario(){
        return view('usuario');
    }

}
