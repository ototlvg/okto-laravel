<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    protected $table = 'carreras';

    public function areasAgregadas(){
        // return $this->belongsToMany("App\Area", "area_carrera", "carrera_id", "area_id");
    }

    public function profesores(){
        return $this->belongsToMany("App\Profesor", 'carrera_profesor', 'carrera_id', 'profesor_id');
    }

    
}
