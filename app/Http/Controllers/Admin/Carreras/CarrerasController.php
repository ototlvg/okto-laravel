<?php

namespace App\Http\Controllers\Admin\Carreras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Carrera;

class CarrerasController extends Controller
{
    public function index(){
        $carreras = Carrera::all();
        return view("admin.Carreras.index", compact('carreras'));
    }

    public function showAgregar(){
        return view("admin.agregar_carrera");
    }

    public function showCarrera($idcarrera){
        $carrera = Carrera::find($idcarrera);
        return view("admin.carrera", compact("carrera"));
    }

    public function deleteCarrera($carreraid){
        $carrera = Carrera::find($carreraid);
        $carrera->delete();
        return redirect()->route('admin.carreras');
        // $carrera = Carrera::find($idcarrera);
        // return view("admin.carrera", compact("carrera"));
    }

    public function storeCarrera(Request $request){

        $this->validate($request, [
            'carrera'=>'required',
            'nocontrol'=>'required|numeric',
        ]);

        $nombre = $request->get('carrera');
        $nocontrol = $request->get('nocontrol');
        $c = new Carrera;
        $c->nombre = $nombre;
        $c->nocontrol = $nocontrol;
        $c->save();
        return redirect()->route('admin.carreras');
    }

    
}
