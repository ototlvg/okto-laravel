<?php

namespace App\Http\Middleware;

use Closure;

use App\User;

use Illuminate\Support\Facades\Auth;

class checkAlumnoAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        // dd('neee');
        $userid = Auth::id();

        $user = User::with('profile')->find($userid);

        $areasObj = $user->profile->getRelationValue('carrera')->areas;

        $areas = [];

        foreach($areasObj as $area){
            array_push($areas, $area->id);
        }

        

        if(false){
            dd('el area que se esta intentando ingresar no existe');
            // return redirect()->route('alumno.areas.index')->with('areaNot',true);
        }

        // if( !($area->carrera->carrera == $user->profile->carrera) ){ // Esto comprueba que el area en la que el alumno eesta inteentando entrar sea deee su carrera
        //     return redirect()->back();
        // }


        return $next($request);
    }
}
