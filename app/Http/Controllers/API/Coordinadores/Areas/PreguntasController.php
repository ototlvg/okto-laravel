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

        $preguntas = Pregunta::where('area_id',$areaid)->with(['respuestas','respuesta_correcta'])->get();

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
