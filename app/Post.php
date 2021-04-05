<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function area(){
        return $this->belongsTo('App\Area','area_id','id');
    }

    public function profesor(){
        return $this->belongsTo('App\Profesor','profesor_id','id');
    }
}
