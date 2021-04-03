<?php

namespace App\Http\Controllers\Admin\Alumnos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\UsersImport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;

use App\User;
use App\UserProfile;
use App\Carrera;

Use Exception;
class AlumnosController extends Controller
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
        $users = User::with('profile')->orderBy('id','DESC')->get();

        
        // return $users;
        return view('admin.Alumnos.index',compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carreras = Carrera::all();
        return view('admin.Alumnos.create',compact(['carreras']));
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
            'name'=> ['required', 'string'],
            'apaterno'=> ['required', 'string'],
            'amaterno'=> ['required', 'string'],
            'matricula'=> ['required', 'numeric','unique:users_profile,matricula'],
            'semestre'=> ['required', 'numeric'],
            'grupo'=> ['required', 'numeric'],
            'email'=> ['required', 'string'],
            'carreraid'=> ['required', 'numeric']
        ]);

        return $request->all();

        $name = $request->post('name') ;
        $apaterno = $request->post('apaterno') ;
        $amaterno = $request->post('amaterno') ;
        
        $matricula = $request->post('matricula') ;
        $semestre = $request->post('semestre') ;
        $grupo = $request->post('grupo') ;
        $carreraid = $request->post('carreraid') ;
        
        $email = $request->post('email') ;


        $password = $matricula.$semestre ;

        // return $password;
        

        $alumno = new User;

        $alumno->name = $name;
        $alumno->apaterno = $apaterno;
        $alumno->amaterno = $amaterno;
        $alumno->email = $matricula."@uabc.edu.mx";
        $alumno->password = Hash::make($password);
        $alumno->save();

        // return $alumno;

        $alumno_profile = new UserProfile;

        $alumno_profile->matricula = $matricula;
        $alumno_profile->semestre = $semestre;
        $alumno_profile->email = $email;
        $alumno_profile->carrera = $carreraid;
        $alumno_profile->user_id = $alumno->id;
        $alumno_profile->save();



        // return $request->all();
        // return redirect()->route( 'clients.show' )->with( [ 'id' => $id ] );
        return redirect()->route('admin.alumnos.index')->with( [ 'success-matricula-store' => $matricula ] );
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
        $alumno = User::with('profile')->find($id);
        $carreras = Carrera::all();


        return view('admin.Alumnos.edit',compact(['alumno','carreras']));
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
        $alumno = User::with('profile')->find($id);
        $userprofile = UserProfile::where('user_id', $alumno->id)->first();

        $matriculaEnDB =  $userprofile->matricula;
        $matricula = $request->post('matricula') ;

        // return $matricula == $matriculaEnDB ? 'Son iguales' : 'no son iguales';

        // return 'ds';
        // $userprofileid = $alumno->profile->id;

        // $alumno->profile->semestre = 187;
        // $alumno->save();

        // return 'lele';

        // return $alumno->profile->matricula;

        $this->validate($request, [
            'name'=> ['required', 'string'],
            'apaterno'=> ['required', 'string'],
            'amaterno'=> ['required', 'string'],
            // 'matricula'=> ['required', 'numeric',"unique:users_profile,matricula,71"],
            'semestre'=> ['required', 'numeric'],
            'grupo'=> ['required', 'numeric'],
            'email'=> ['required', 'string'],
            'carrera'=> ['required', 'numeric']
        ]);

        
        if(!is_null($request->post('password'))){
            // return 'no vacio';
            $this->validate($request, [
                'password'=> ['required', 'min:8']
            ]); 
            $password = $request->post('password') ;
        }else{
            // return 'vacio';
        }

        // return 'lala';

        $name = $request->post('name') ;
        $apaterno = $request->post('apaterno') ;
        $amaterno = $request->post('amaterno') ;
        $email = $request->post('email');
        
        $alumno->name = $name;
        $alumno->apaterno = $apaterno;
        $alumno->amaterno = $amaterno;

        if(!is_null($request->post('password'))){
            $alumno->password = Hash::make($password);
        }

        if( !($matricula == $matriculaEnDB) ){

            $alumno->email = $matricula.'@uabc.edu.mx' ;
            
        }
        
        try
        {
            //write your codes here
            $alumno->save();
        }
        catch(Exception $e)
        {
        //    dd($e->getCode());
            return back()->withInput()->with('duplicatematricula', 'La matricula con la que esta intentando actualizar el formmulario ya se encunetra registrada');
        }
        // $alumno->email = $email;
        // $alumno->password = ;


        // $matricula = $request->post('matricula') ;
        $semestre = $request->post('semestre') ;
        $grupo = $request->post('grupo') ;
        $email = $request->post('email');
        $carrera = $request->post('carrera');
        
        
        $userprofile->matricula = $matricula;
        $userprofile->semestre = $semestre;
        $userprofile->email = $email;
        $userprofile->carrera = $carrera;
        $userprofile->save();




        // $carreraid = $request->post('carreraid') ;
        


        // $password = $matricula.$semestre;
        // $userprofile->matricula = $matricula;
        // $userprofile->save();

        

        // return 'lelo';
        return redirect()->route('admin.alumnos.edit',$alumno->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $area= Area::find($id)->delete();
        // User::with('profile')->orderBy('id','DESC')->get();
        $alumno = User::with('profile')->find($id);
        $matricula = $alumno->profile->matricula;
        // return $alumno;

        // $alumno->

        $alumno->delete();

        return redirect()->route('admin.alumnos.index')->with( [ 'success-matricula-deleted' => $matricula ] );

    }

    public function readExcel(Request $request){
        // $x = 'nenennex';
        // return redirect()->route('admin.alumnos.index', compact('x'));
        // return $request->file('file')->getRealPath();
        $file = $request->file('file');
        $students = Excel::toArray([], $file)[0]; // Obtener todos los alumnos
        // return $students;
        array_shift($students); // Quitar la cabezera


        $notAddedBecauseWrongType = [];
        $originalStudentsCount = count($students);
        for ($i=0; $i < $originalStudentsCount ; $i++) { 
            $student = $students[$i];
            if(is_null($student[0])){
                unset($students[$i]);
            }else{
                return $student;
                // Aqui pon codigo para validad si la matricula y el semestre sean numeros
                
                if( !is_numeric($student[0]) || !is_numeric($student[4]) || !is_numeric($student[5]) || !is_numeric($student[7]) ){
                    array_push($notAddedBecauseWrongType, $student);
                    unset($students[$i]);
                }
            }
        }

        return $notAddedBecauseWrongType;

        $students = array_values($students);

        // return $students;

        // Apartir de aqui $students solo tiene informacion y ya se puede usar


        // return Carrera::all('carrera')[0]->carrera;
        $carrerasDisponibles = [];
        foreach(Carrera::all('carrera') as $row){
            $carrera = $row->carrera;
            array_push($carrerasDisponibles, $carrera);
            
            // if(!in_array($carrera,$carrerasDisponibles)){
            // }
        }

        $carrerasExcel = [];
        foreach($students as $student){
            if(!in_array($student[5],$carrerasExcel) && !is_null($student[0]) ){
                array_push($carrerasExcel,$student[5]);
            }
        }

        // return $carrerasExcel;

        $inExcelButNotAvailable=[];

        foreach($carrerasExcel as $carreraExcel){
            if(!in_array($carreraExcel,$carrerasDisponibles)){
                array_push($inExcelButNotAvailable, $carreraExcel);
            }
        }
        // return $carreraExcel;
        
        if(count($inExcelButNotAvailable)!=0){
            // return 'nono';
            // return redirect()->back()->with(['status' => 'Alumnos agregados correctamente', 'duplicateStudents'=> []]);
            // return redirect()->back()->with('success',$inExcelButNotAvailable);
            // return redirect()->back()->with(['success' => $inExcelButNotAvailable, 'energy'=> 'nenenene']);
            return redirect()->back()->withErrors(['carreraInExcelButNotInDatabase' => $inExcelButNotAvailable, 'cc' => 123]);
        }
        
        // return 'nene';
        // return $inExcelButNotAvailable;
        // return $carrerasDisponibles;
        // return $carrerasExcel;

        
        // Codigo para guardar
        $duplicateStudents=[];
        // return $students;
        foreach($students as $student ){
            // return $student;
            $user = new User;
            $kk = $student;
            // $user->matricula = $student[0];
            $user->name = $student[1];
            $user->apaterno = $student[2];
            $user->amaterno = $student[3];
            $user->email = $student[0].'@uabc.edu.mx';
            // $user->password = Hash::make('password123');
            // strval($student[0])+strval($student[4])
            // $user->password = Hash::make($student[0]+$student[4]);
            $user->password = Hash::make(strval($student[0]).strval($student[4]));
            try{
                $user->save();

                $userprofile = new UserProfile;
                $userprofile->matricula = $student[0];
                $userprofile->semestre = $student[4];
                $userprofile->carrera = $student[5];
                $userprofile->email = $student[6];
                $userprofile->grupo = $student[7];
                $userprofile->user_id = $user->id;
                $userprofile->save();
            }catch(\Exception $e){
                $errorCode = $e->errorInfo[1];;   // insert query
                if($errorCode == 1062){
                    array_push($duplicateStudents, $student);
                }else{
                    return 'Error: ' . $errorCode . 'desconocido';
                }
                // return 'error';
            }
            // return 'ne';

            

            
        }
        
        // return $duplicateStudents;
        // return $students;

        return redirect()->back()->with(['status' => 'Alumnos agregados correctamente', 'duplicateStudents'=> $duplicateStudents]);

        // $x->move('/home/oto/Documents/salvar','keke.xlsx');
        // sleep(8);
        
    }
}
