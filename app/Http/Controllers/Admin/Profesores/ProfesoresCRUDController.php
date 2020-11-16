<?php

namespace App\Http\Controllers\Admin\Profesores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Carrera;
use App\Profesor;
class ProfesoresCRUDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carreras = Carrera::all();
        return view('admin.Profesores.agregarProfesor', compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'noempleado'=>'required|numeric',
            // 'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            'email'=>'required|email|unique:profesores,email,'
        ]);

        $name = $request->get('name');
        $apaterno = $request->get('apaterno');
        $amaterno = $request->get('amaterno');
        $noempleado = $request->get('noempleado');
        $email = $request->get('email');

        $profesor = new Profesor;

        $profesor->name = $name;
        $profesor->apaterno = $apaterno;
        $profesor->amaterno = $amaterno;
        $profesor->noempleado = $noempleado;
        $profesor->email = $email;
        $profesor->password = Hash::make('password');
        $profesor->save();


        return redirect()->route('admin.profesores');
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
        $profesor = Profesor::find($id);
        // return $profesor;
        return view('admin.Profesores.editarProfesor', compact('profesor'));
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
        // return 'Coco'
        $email = $request->get('email');
        $this->validate($request, [
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'noempleado'=>'required|numeric',
            // 'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            "email'=>'required|email|unique:profesores,email,$email"
        ]);

        $name = $request->get('name');
        $apaterno = $request->get('apaterno');
        $amaterno = $request->get('amaterno');
        $noempleado = $request->get('noempleado');
        $email = $request->get('email');

        $profesor = Profesor::find($id);

        $profesor->name = $name;
        $profesor->apaterno = $apaterno;
        $profesor->amaterno = $amaterno;
        $profesor->noempleado = $noempleado;
        $profesor->email = $email;
        // $profesor->password = Hash::make('password');
        $profesor->save();


        return redirect()->route('admin.profesores');
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

    public function deleteProfesor($profesorid){
        $profesor = Profesor::find($profesorid);
        $profesor->delete();
        return redirect()->route('admin.profesores');
    }
}
