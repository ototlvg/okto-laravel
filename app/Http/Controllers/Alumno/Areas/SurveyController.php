<?php

namespace App\Http\Controllers\Alumno\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pregunta;
use App\PreguntaRespuesta;
use App\Area;

use Illuminate\Support\Facades\Auth;

class SurveyController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest');
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
        $areaid = $request->post('areaid');

        $maxItem = PreguntaRespuesta::orderBy('iteration', 'desc')->where('area_id',$areaid)->value('iteration');

        // return $maxItem;

        if(is_null($maxItem)){
            $iteration = 1;
        }else{
            $iteration = $maxItem+1;
        }

        $userid = Auth::id();
        $preguntas = Pregunta::where('area_id',$areaid)->orderBy('id', 'ASC')->get();

        // return $request->post('pregunta_46');
        $arr = [];
        foreach ($preguntas as $pregunta) {
            $preguntaid = $pregunta->id;
            $respuestaid = $request->post('pregunta_'.$pregunta->id);

            $pr = new PreguntaRespuesta;
            $pr->pregunta_id = $preguntaid;
            $pr->respuesta_id = $respuestaid;
            $pr->area_id = $areaid;
            $pr->user_id = $userid;
            $pr->iteration = $iteration;
            
            $pr->save();

            // array_push($arr,"preguntaid: {$pregunta_id}, respuestaid: {$respuesta_id}");
        }

        // return $arr;
        // return 'exito';
        return redirect()->route('alumno.areas.survey.results', ['areaid' => $areaid, 'iteration' => ($iteration)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $preguntas = Pregunta::where('area_id',$id)->orderBy('id', 'ASC')->with('respuestas')->get();
        $areaid = $id;
        $area = Area::find($areaid);
        // return $preguntas;
        // return 'Omega xis ' . $id;
        return view('alumno.Areas.Survey.survey', compact('preguntas','areaid','area'));
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

    public function results($areaid,$iteration){
        $userid = Auth::id();

        $area = Area::find($areaid);

        $maxIteration = PreguntaRespuesta::where('user_id',$userid)->where('area_id',$areaid)->max('iteration');
        
        $numberOfCorrectAnswers = 0;
        $questions = Pregunta::with('respuestas','respuesta_correcta')->where('area_id',$areaid)->orderBy('id','ASC')->get();
        $results = PreguntaRespuesta::where('user_id',$userid)->where('area_id',$areaid)->where('iteration',$iteration)->orderBy('id','ASC')->get();

        for ($i=0; $i < count($questions); $i++) { 
            $question = $questions[$i];



            $question->respuesta_alumno = $results[$i];

            if($question->respuesta_alumno->respuesta_id == $question->respuesta_correcta->respuesta_id){
                $correctAnswer = true;
                $numberOfCorrectAnswers++;
            }else{
                $correctAnswer = false;
            }

            // $obj = (object) ['status' => $correctAnswer, 'respuesta_id' => $question->respuesta_correcta->respuesta_id];

            // $question->correct_answer = $obj;

            if($correctAnswer){
                foreach ($question->respuestas as $respuesta) {
                    if($respuesta->id == $question->respuesta_correcta->respuesta_id){
                        // $respuesta->alert = 'green';
                        $respuesta->alert = 'success';
                    }else{
                        // $respuesta->alert = 'white';
                        $respuesta->alert = 'light';
                    }
                }
            }else{
                foreach ($question->respuestas as $respuesta) {
                    if($respuesta->id == $question->respuesta_correcta->respuesta_id){
                        // $respuesta->alert = 'green';
                        $respuesta->alert = 'success';
                    }elseif($respuesta->id == $question->respuesta_alumno->respuesta_id){
                        // $respuesta->alert = 'red';
                        $respuesta->alert = 'danger';
                    }else{
                        // $respuesta->alert = 'white';
                        $respuesta->alert = 'light';
                    }
                }

            }

            // $question->respuesta_alumno = $results[$i];
            // $question->respuesta_correcta = $question->respuesta_correcta->respuesta_id;
        }
        

        
        // return $results;
        // return $questions;
        $puntaje = $numberOfCorrectAnswers . '/' . count($questions);
        // return $numberOfCorrectAnswers;

        $preguntas = $questions;

        // return $preguntas;

        return view('alumno.Areas.Survey.resultados', compact(['preguntas', 'puntaje', 'maxIteration','area']));


        
        // $final = [];
        // $results = PreguntaRespuesta::with('question.respuesta_correcta.respuesta')->where('user_id',$userid)->where('area_id',$areaid)->where('iteration',$iteration)->get();
        // $numberOfCorrectAnswers = 0;
        
        // foreach ($results as $result) {
        //     $correct = $result->respuesta_id == $result->question->respuesta_correcta->respuesta_id;

        //     if($correct){
        //         $numberOfCorrectAnswers++;
        //     }


        //     $pregunta = $result->question->pregunta;
        //     $respuesta = $result->question->respuesta_correcta->respuesta->respuesta;
        //     array_push($final, $object = (object) ['pregunta' => $pregunta, 'respuesta'=>$respuesta, 'correcto' => $correct]);
        // }

        // $puntaje = $numberOfCorrectAnswers . '/' . count($results);

        // return view('alumno.Areas.Survey.resultados', compact(['final', 'puntaje']));

        // return $puntaje;
    }
}
