<?php

namespace App\Http\Controllers\API\Admin\Profesores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Carrera;
use App\Profesor;
use App\CarreraProfesor;
class CarrerasController extends Controller
{
    public function getCarreras(){
        $carreras = Carrera::all();
        return $carreras;
    }
    public function getAgregados(Request $request){
        $carreraid = $request->get('carreraid');
        $profesorid = $request->get('profesorid');

        return Profesor::find($profesorid)->carreras;


        // $ac = new AreaCarrera;
        // $ac->area_id = 2;
        // $ac->carrera_id =1;
        // $ac->save();
        
        // $ac = AreaCarrera::where('area_id', 1)->where('carrera_id',1)->delete();
    }

    public function storeCarrera(Request $request){
        $carreraid = $request->get("carreraid");
        $profesorid = $request->get("profesorid");

        $cp = new CarreraProfesor;
        $cp->carrera_id = $carreraid;
        $cp->profesor_id = $profesorid;
        $cp->save();
        return $profesorid;

        // $idcarrera = $request->get("idcarrera");
        // $idarea = $request->get("idarea");

        // $ac = new AreaCarrera;
        // $ac->area_id = $idarea;
        // $ac->carrera_id = $idcarrera;
        // $ac->save();
        // return $idarea;
    }

    public function deleteCarrera(Request $request){
        $profesorid = $request->get("profesorid");
        $carreraid = $request->get("carreraid");

        $ac = CarreraProfesor::where('profesor_id', $profesorid)->where('carrera_id',$carreraid)->delete();
        if($ac){ // Si retorna true significa que se elimino correctamente
            return $carreraid;

        }

        // $idcarrera = $request->get("idcarrera");
        // $idarea = $request->get("idarea");

        // $ac = AreaCarrera::where('area_id', $idarea)->where('carrera_id',$idcarrera)->delete();
        // return "Hola mundo";
    }
}
