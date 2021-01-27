<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            // return redirect(RouteServiceProvider::HOME);
            
            if($guard == 'admin'){
                return redirect('/admin/carreras'); // La url directa
            }else if($guard == 'coordinador'){
                return redirect('/coordinador/profesores');
            }else{
                return redirect('/home');
            }
        }

        return $next($request);
    }
}
