<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PreguntaRespuesta extends Model
{
    protected $table = 'preguntas_respuestas';

    public function question(){
        return $this->hasOne('App\Pregunta', 'id', 'pregunta_id');
    }
}
