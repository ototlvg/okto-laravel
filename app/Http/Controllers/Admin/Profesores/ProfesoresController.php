<?php

namespace App\Http\Controllers\Admin\Profesores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Carrera;
use App\Profesor;

class ProfesoresController extends Controller
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
        $profesores = Profesor::all();
        // return $profesores;
        return view('admin.Profesores.index', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('admin.Profesores.agregarProfesor', compact('carreras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return 'Hola2323';
        $this->validate($request, [
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'noempleado'=>'required|numeric|unique:profesores,noempleado',
            // 'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            'email'=>'required|email|unique:profesores,email'
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


        return redirect()->route('admin.profesores.index');
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
        // return 'Hola';
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
        // return 'coco';
        // $email = $request->get('email');

        $password = $request->get('password');
        $passwordAvailable = !empty($password);

        if($passwordAvailable){
            $this->validate($request, [
                'password'=>'required|min:8',
            ]);
        }


        $this->validate($request, [
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'noempleado'=>"required|numeric|unique:profesores,noempleado,{$id}",
            // 'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            "email'=>'required|email|unique:profesores,email,{$id}"
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

        if($passwordAvailable){
            $profesor->password = Hash::make($password);
        }

        $profesor->save();


        // return redirect()->route('admin.profesores.index');

        if($passwordAvailable){
            return redirect()->route('admin.profesores.index')->with( [ 'success-email-update' => $email, 'success-password-update' => 1] );
        }else{
            return redirect()->route('admin.profesores.index')->with( [ 'success-email-update' => $email ] );
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'Hola';
        // Este requiere una peticion tipo DELETE para que funcione
        $profesor = Profesor::find($id);
        // return $profesor;
        $profesor->delete();
        return redirect()->route('admin.profesores.index');
    }
}
