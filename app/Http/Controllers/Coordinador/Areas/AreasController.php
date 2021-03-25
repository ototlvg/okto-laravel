<?php

namespace App\Http\Controllers\Coordinador\Areas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Area;
use App\Coordinador;

class AreasController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
        // $this->middleware('guest');
        $this->middleware('auth:coordinador');
        $this->middleware('returnAuthVariable:coordinador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authc = Auth::guard('coordinador')->user();
        $coordinadorid = $authc->id;
        // dd($coordinador);
        // return $coordinadorid;
        $coordinador = Coordinador::where('id', $coordinadorid)->with('carrera.areas')->first();
        // return $coordinador;
        $areas = $coordinador->carrera->areas;
        // return $areas;
        // return $coordinador;

        // return $coordinador->with('carrera')->first();
        // return $coordinadorid;
        return view('coordinador.Areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $areaid = $id;
        return view('coordinador.Areas.edit', compact('areaid'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
