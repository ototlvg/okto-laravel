<?php

namespace App\Http\Controllers\Admin\Coordinadores;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Coordinador;
use Illuminate\Support\Facades\Hash;
use App\Carrera;

class CoordinadoresController extends Controller
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
        $coordinadores = Coordinador::orderBy('id','DESC')->get();
        // return $coordinadores;
        return view('admin.Coordinadores.index', compact('coordinadores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('admin.Coordinadores.agregarCoordinador', compact('carreras'));
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
            'noempleado'=>'required|numeric|unique:coordinadores,noempleado',
            'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            'email'=>'required|email|unique:coordinadores,email'
        ]);

        $name = $request->get('name');
        $apaterno = $request->get('apaterno');
        $amaterno = $request->get('amaterno');
        $noempleado = $request->get('noempleado');
        $email = $request->get('email');
        $carreraid = $request->get('carreraid');

        $coordinador = new Coordinador;

        $coordinador->name = $name;
        $coordinador->apaterno = $apaterno;
        $coordinador->amaterno = $amaterno;
        $coordinador->noempleado = $noempleado;
        $coordinador->email = $email;
        // $coordinador->email = $noempleado."@uabc.edu";
        $coordinador->carrera_id = $carreraid;
        $coordinador->password = Hash::make('password');
        $coordinador->save();


        // return redirect()->route('admin.coordinadores.index');
        return redirect()->route('admin.coordinadores.index')->with( [ 'success-email-store' => $email ] );
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
        $coordinador = Coordinador::find($id);

        if(empty($coordinador)){
            return redirect()->route('admin.coordinadores.index');
        }

        $carreras = Carrera::all();
        // return $coordinador;
        return view('admin.Coordinadores.edit',compact(['coordinador','carreras']));

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
        // return $request->get('carreraid');
        $password = $request->get('password');

        $passwordAvailable = !empty($password);

        if($passwordAvailable){
            $this->validate($request, [
                'password'=>'required|min:8',
            ]);
        }

        // return $password;

        $this->validate($request, [
            'name'=>'required',
            'apaterno'=>'required',
            'amaterno'=>'required',
            'noempleado'=>"required|numeric|unique:coordinadores,noempleado,{$id}",
            'carreraid'=>'required|numeric',
            // 'edad'=>'required',
            // 'sexo'=>'required',
            'email'=>"required|email|unique:coordinadores,email,{$id}"
        ]);
            
        $name = $request->get('name');
        $apaterno = $request->get('apaterno');
        $amaterno = $request->get('amaterno');
        $noempleado = $request->get('noempleado');
        $carreraid = $request->get('carreraid');
        $email = $request->get('email');
            

        $coordinador = Coordinador::find($id);
        $coordinador->name = $name;
        $coordinador->apaterno = $apaterno;
        $coordinador->amaterno = $amaterno;
        $coordinador->noempleado = $noempleado;
        $coordinador->carrera_id = $carreraid;
        $coordinador->email = $email;
        
        if($passwordAvailable){
            $coordinador->password = Hash::make($password);
        }

        $coordinador->save();
        


        // return redirect()->route( 'clients.show' )->with( [ 'id' => $id ] );
        return redirect()->route('admin.coordinadores.index')->with( [ 'success-email-update' => $email ] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coordinador = Coordinador::find($id);
        // return $coordinador;
        $coordinador->delete();
        return redirect()->route('admin.coordinadores.index');
    }
}
