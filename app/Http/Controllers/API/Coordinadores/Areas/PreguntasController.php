<?php

namespace App\Http\Controllers\API\Coordinadores\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Pregunta;
use App\Respuesta;
use App\RespuestaCorrecta;

class PreguntasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areaid = $request->get('areaid');

        // return $areaid;

        // $preguntas = Pregunta::with(['respuestas','respuesta_correcta'])->where('area_id',$areaid)->get();

        $preguntas = Pregunta::where('area_id',$areaid)->with(['respuestas','respuesta_correcta.respuesta'])->orderBy('id', 'DESC')->get();

        return $preguntas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $question = $request->post('question');
        $areaid = $request->post('areaid');

        // return $question['respuesta_correcta']['respuesta'];
        // return $question['pregunta'];

        $pregunta = new Pregunta();
        $pregunta->pregunta = $question['pregunta'];
        $pregunta->area_id= $areaid;
        $pregunta->save();

        $preguntaid = $pregunta->id;

        $respuestas = $question['respuestas'];

        foreach($respuestas as $respuesta){
            $r = new Respuesta();
            $r->item = $respuesta['item'];
            $r->pregunta_id = $preguntaid;
            $r->respuesta = $respuesta['respuesta'];

            
            $r->save();

            if($question['respuesta_correcta']['respuesta'] == $r->respuesta){
                $rc= new RespuestaCorrecta;
                $rc->respuesta_id = $r->id;
                $rc->pregunta_id = $preguntaid;
                $rc->save();
            }
        }
        
        $obj = Pregunta::with(['respuestas','respuesta_correcta'])->find($preguntaid);
        return $obj;
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $id;
        // return $request->get('question');
        $question = Pregunta::find($id);
        $question->pregunta = $request->get('question');
        $question->save();
        return $question;
    }

    public function addAnswer(Request $request)
    {
        $areaid = $request->post('areaid');
        $questionid = $request->post('questionid');
        
        // $respuesta = new Respuesta;

        $maxItemValueQuestion = Respuesta::where('pregunta_id', $questionid)->orderBy('item', 'desc')->first()->item;

        $respuesta = new Respuesta;

        $respuesta->item = $maxItemValueQuestion+1;
        $respuesta->respuesta = 'Modifique el texto';
        $respuesta->pregunta_id = $questionid;
        $respuesta->save();
        

        // $respuesta->

        return $respuesta;
    }

    public function updateAnswer(Request $request)
    {
        $answerid = $request->post('answerid');
        $respuesta = $request->post('answer');

        $answer = Respuesta::find($answerid);
        $answer->respuesta = $respuesta;
        $answer->save();

        return $answer;
    }
    
    public function updateCorrectAnswer(Request $request)
    {
        $newCorrectAnswerId = $request->post('newCorrectAnswerId');
        $questionid = $request->post('questionid');

        $rc = RespuestaCorrecta::where('pregunta_id',$questionid)->first();
        $rc->respuesta_id = $newCorrectAnswerId;
        $rc->save();
        // return 'lelelele';
        return $newCorrectAnswerId;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'shampoo';
        $question = Pregunta::find($id);
        $question->delete();
        return $question;
    }

    public function destroyAnswer($id)
    {
        $answer = Respuesta::find($id);
        $answer->delete();
        return $id;
    }

}
