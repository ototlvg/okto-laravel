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
        $users = User::with('profile')->get();
        // return $users;
        return view('admin.Alumnos.index',compact('users'));
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
        //
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
        //
    }

    public function readExcel(Request $request){
        // $x = 'nenennex';
        // return redirect()->route('admin.alumnos.index', compact('x'));
        // return $request->file('file')->getRealPath();
        $file = $request->file('file');
        $students = Excel::toArray([], $file)[0]; // Obtener todos los alumnos
        // return $students;
        array_shift($students); // Quitar la cabezera

        $originalStudentsCount = count($students);
        for ($i=0; $i < $originalStudentsCount ; $i++) { 
            $student = $students[$i];
            if(is_null($student[0])){
                unset($students[$i]);
            }else{
                // Aqui pon codigo para validad si la matricula y el semestre sean numeros
            }
        }

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
