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
            'nocontrol'=>'required|numeric|unique:carreras,carrera',
        ]);

        $nombre = $request->get('carrera');
        $nocontrol = $request->get('nocontrol');
        $c = new Carrera;
        $c->nombre = $nombre;
        $c->carrera = $nocontrol;
        $c->save();
        return redirect()->route('admin.carreras.index')->with([ 'created' => $nombre ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carrera = Carrera::find($id);

        if(empty($carrera)){
            return redirect()->back();
        }

    
        return view('admin.Carreras.edit',compact(['carrera']));
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
        $this->validate($request, [
            'name'=> ['required', 'string']
        ]);

        $carreranum = $request->get('carrera');
        $name = $request->get('name');
        $carrera = Carrera::find($id);
        $carrera->nombre = $name;
        // $carrera->carrera = $carreranum;
        $carrera->save();


        // return redirect()->route( 'clients.show' )->with( [ 'id' => $id ] );
        // in PHP
        // $id = session()->get( 'id' );
        // // in Blade
        // {{ session()->get( 'id' ) }}
        return redirect()->route('admin.carreras.index');
        

        // return $id;
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
