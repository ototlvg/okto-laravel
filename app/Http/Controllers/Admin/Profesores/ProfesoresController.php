<?php

namespace App\Http\Controllers\Admin\Profesores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profesor;

class ProfesoresController extends Controller
{
    public function index(){
        $profesores = Profesor::all();
        // return $profesores;
        return view('admin.Profesores.index', compact('profesores'));
    }

    public function indexCarreras($profesorid){
        return view('admin.Profesores.carreras', compact('profesorid'));
    }
}
