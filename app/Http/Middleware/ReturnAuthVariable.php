<?php

namespace App\Http\Middleware;

use Closure;

use View;
use Illuminate\Support\Facades\Auth;

class ReturnAuthVariable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard) // $guard se lo puse yo, puede tener cualquier nombre esto ya es tema de mw exclusivamente
    {
        // dd($guard);
        $authUser = Auth::guard($guard)->user();
        View::share('authUser', $authUser);
        // dd($authUser);
        return $next($request);
    }
}
