<?php

namespace App\Http\Controllers\Admin\Carreras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Area;
use App\Carrera;
class AreasController extends Controller
{
    public function __construct(){
        // $this->middleware('guest:admin');
        $this->middleware('auth:admin');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return 'xxxxx';
        $carreraid = $request->get('carreraid');
        $carrera = Carrera::find($carreraid);

        if(empty($carrera)){
            return redirect()->back();
        }
        
        $areas = Area::where('carrera_id', $carreraid)->get();
        $areascount = $areas->count();

        // return $areas;
        // return $areas;
        // if($areas->isEmpty()){
        //     return redirect()->back();
        // }

        return view('admin.Carreras.Areas.areas', compact('areas', 'carreraid', 'areascount', 'carrera'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carreraid = $request->get('carreraid');
        
        $areas = Area::where('carrera_id', $carreraid)->get();
        $areascount = $areas->count();

        if($areascount == 3){
            return redirect()->route('admin.carreras.areas.index');
        }

        // return $carreraid;
        // return view('admin.Carreras.Areas.agregarArea');
        return view('admin.Carreras.Areas.agregarArea', compact('carreraid'));
    }

    public function agregarAreaACarrera($carreraid)
    {  // Esto es un get, retornna el form para agregar un area
        
        return view('admin.Carreras.Areas.agregarArea', compact('carreraid'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'nombre'=>'required',
        ]);
            
        $areaname= $request->get('nombre');
        $carreraid= $request->get('carreraid');

        $areascount = Area::where('carrera_id', $carreraid)->count();

        if($areascount == 3){
            return redirect()->route('admin.carreras.areas.index');
        }

        // return $areascount;

        $area = new Area;

        $area->nombre = $areaname;
        $area->carrera_id = $carreraid;
        $area->save();

        // return redirect()->route('areas.show', ['area' => $carreraid]);
        return redirect()->route('admin.carreras.areas.index', ['carreraid'=>$carreraid]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'showsda';
        // $areas = Area::where('carrera_id', $id)->get();
        // $areascount = $areas->count();
        // $carrera = Carrera::find($id);

        // $carreraid = $id;

        // return view('admin.Carreras.Areas.areas', compact('areas', 'carreraid', 'areascount', 'carrera'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newname = $request->get('newname');
        $areaid = $id;

        $area = Area::find($areaid);
        $area->nombre = $newname;
        $area->save();


        // return $areaid;

        return redirect()->back();
        return $request->get('newname');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area= Area::find($id)->delete();
        // $area->save();
        return redirect()->back();
    }
}
