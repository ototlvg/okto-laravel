<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profile';
    public $timestamps = false;

    public function carrera(){ // TX1 Hacen lo mismo, pero tienen diferente nombre
        return $this->hasOne('App\Carrera', 'carrera', 'carrera');
    }

    public function career(){ // TX1 Hacen lo mismo, pero tienen diferente nombre
        return $this->hasOne('App\Carrera', 'carrera', 'carrera');
    }
}
