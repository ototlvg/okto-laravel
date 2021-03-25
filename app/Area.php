<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    public function carrera(){
        return $this->belongsTo('App\Carrera','carrera_id','id');
    }
}
