<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Nuevo
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;


class CoordinadorLoginController extends Controller
{
    use RedirectsUsers, ThrottlesLogins; // Agregados para Limitar el numero de Intentos

    protected $redirectTo = 'dasdsa';

    public function __construct()
    {
        $this->middleware('guest:coordinador')->except('logout');
    }

    public function showLoginForm(){
        return view('auth.login_coordinador');
    }

    public function login(Request $request){
        // $request->merge(['email' => $request->post('email').'@uabc.edu.mx']);
        // return $request->post('email');
        // Validate the form data
        $this->validate($request, [
            // 'email' => 'required|email',
            'email' => 'required',
             'password' => 'required|min:6'
         ]);

         // Limitar el intento de Accesos
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        // Attempt to log the user in
        if(Auth::guard('coordinador')->attempt(['noempleado'=>$request->email, 'password' => $request->password], $request->remember)){
            return redirect()->intended(route('coordinador.profesores.index'));
        }

        // return redirect()->back()->withInput($request->only('email')); // If unsuccesfull, the redirect to their intendet location

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request); // tttl

        return $this->sendFailedLoginResponse($request);
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
    public function username()
    {
        return 'email';
    }

    public function logout()
    {
        Auth::guard('coordinador')->logout();
        return redirect()->route('coordinador.login');
    }


}
