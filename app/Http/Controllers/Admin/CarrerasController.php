<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carrera;

class CarrerasController extends Controller
{
    public function index(){
        $carreras = Carrera::all();
        return view("admin.carreras", compact('carreras'));
    }

    public function showAgregar(){
        return view("admin.agregar_carrera");
    }

    public function showCarrera($idcarrera){
        $carrera = Carrera::find($idcarrera);
        return view("admin.carrera", compact("carrera"));
    }

    public function storeCarrera(Request $request){
        $nombre = $request->get('carrera');
        $nocontrol = $request->get('nocontrol');
        $c = new Carrera;
        $c->nombre = $nombre;
        $c->nocontrol = $nocontrol;
        $c->save();
        
        return redirect()->route('admin.carreras');
    }

    
}
