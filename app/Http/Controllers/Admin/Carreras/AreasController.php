<?php

namespace App\Http\Controllers\Admin\Carreras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Area;
use App\Carrera;
class AreasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->get('carreraid');
        $areas = Area::where('carrera_id', $id)->get();
        $areascount = $areas->count();
        $carrera = Carrera::find($id);

        $carreraid = $id;

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
        // return view('admin.Carreras.Areas.agregarArea');
        return view('admin.Carreras.Areas.agregarArea', compact('carreraid'));
    }

    public function agregarAreaACarrera($carreraid){  // Esto es un get, retornna el form para agregar un area
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
