<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaCorrecta extends Model
{
    protected $table = 'respuestas_correctas';

    public function respuesta(){
        return $this->hasOne('App\Respuesta', 'id', 'respuesta_id');
    }
}
