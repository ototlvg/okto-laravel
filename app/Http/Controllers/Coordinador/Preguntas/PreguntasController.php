<?php

namespace App\Http\Controllers\Coordinador\Preguntas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreguntasController extends Controller
{
    public function index(){
        return view('coordinador.Preguntas.index');
    }
}
