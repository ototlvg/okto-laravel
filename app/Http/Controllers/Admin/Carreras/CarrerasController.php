<?php

namespace App\Http\Controllers\Admin\Carreras;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Carrera;

class CarrerasController extends Controller
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
    public function index()
    {
        $carreras = Carrera::all();
        return view("admin.Carreras.index", compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.Carreras.createCarrera");
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
            'carrera'=>'required',
            'nocontrol'=>'required|numeric',
        ]);

        $nombre = $request->get('carrera');
        $nocontrol = $request->get('nocontrol');
        $c = new Carrera;
        $c->nombre = $nombre;
        $c->carrera = $nocontrol;
        $c->save();
        return redirect()->route('admin.carreras.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $carrera = Carrera::find($id)->delete();
        // return $carrera;
        return redirect()->route('admin.carreras.index');
    }
}
