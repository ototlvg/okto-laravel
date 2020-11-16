<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Profesor;
use App\Carrera;
use App\CarreraProfesor;

class ProfesoresController extends Controller
{
    public function getProfesores(){
        $profesores= Profesor::all();
        return $profesores;
    }

    public function getAgregados(Request $request){
        $carreraid = $request->get('carreraid');

        return Carrera::find($carreraid)->profesores;
    }

    public function addProfesorToCarrera(Request $request){
        $carreraid = $request->get('carreraid');
        $profesorid = $request->get('profesorid');


        $carreraprofe = new CarreraProfesor;
        $carreraprofe->carrera_id = $carreraid;
        $carreraprofe->profesor_id = $profesorid;
        $carreraprofe->save();

        return $profesorid;
    }

    public function deleteCarreraFromProfesor(Request $request){
        $carreraid = $request->get("carreraid");
        $profesorid = $request->get("profesorid");

        $ac = CarreraProfesor::where('profesor_id', $profesorid)->where('carrera_id',$carreraid)->delete();
        return $profesorid;
    }
}
