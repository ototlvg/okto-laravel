<?php

namespace App\Http\Controllers\Admin\Coordinadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Coordinador;
class CoordinadoresController extends Controller
{
    public function index(){
        $coordinadores = Coordinador::all();
        // return $coordinadores;
        return view('admin.Coordinadores.index', compact('coordinadores'));
    }
}



