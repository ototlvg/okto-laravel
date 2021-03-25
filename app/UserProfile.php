<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profile';
    public $timestamps = false;

    public function carrera(){
        return $this->hasOne('App\Carrera', 'carrera', 'carrera');
    }
}
