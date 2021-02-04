<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $table = 'preguntas';

    public function respuestas(){
        return $this->hasMany('App\Respuesta', 'pregunta_id', 'id');
    }

    public function respuesta_correcta(){
        return $this->hasOne('App\RespuestaCorrecta', 'pregunta_id', 'id');
    }
}
