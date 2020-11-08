<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:coordinador');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home_admin');
        return 'Home del Coordinador!!!';
//        $x= Auth::id();
//        dd($x);
    }
}
