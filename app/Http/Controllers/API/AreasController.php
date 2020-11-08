<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Area;
use App\Carrera;
use App\AreaCarrera;
class AreasController extends Controller
{
    public function getAreas(){
        $areas = Area::all();
        return $areas;
    }
    public function getAgregados(Request $request){
        $idcarrera = $request->get('idcarrera');

        return Carrera::find($idcarrera)->areasAgregadas;


        // $ac = new AreaCarrera;
        // $ac->area_id = 2;
        // $ac->carrera_id =1;
        // $ac->save();
        
        // $ac = AreaCarrera::where('area_id', 1)->where('carrera_id',1)->delete();
    }

    public function storeArea(Request $request){
        $idcarrera = $request->get("idcarrera");
        $idarea = $request->get("idarea");

        $ac = new AreaCarrera;
        $ac->area_id = $idarea;
        $ac->carrera_id = $idcarrera;
        $ac->save();
        return $idarea;
    }

    public function deleteArea(Request $request){
        $idcarrera = $request->get("idcarrera");
        $idarea = $request->get("idarea");

        $ac = AreaCarrera::where('area_id', $idarea)->where('carrera_id',$idcarrera)->delete();
        return "Hola mundo";
    }
}
