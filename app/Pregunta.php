<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    public function respuestas(){
        // return $this->hasMany('App\Respuesta', 'pregunta_id', 'id')->orderBy('id', 'DESC');
        return $this->hasMany('App\Respuesta', 'pregunta_id', 'id')->orderBy('id', 'ASC');
    }

    public function respuesta_correcta(){
        return $this->hasOne('App\RespuestaCorrecta', 'pregunta_id', 'id');
    }
}
