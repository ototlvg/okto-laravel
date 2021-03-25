<?php

namespace App\Http\Controllers\Profesor\Guia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Carrera;
use App\Area;
use App\Post;

class GuiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:profesor');
        // $this->middleware('returnAuthVariable:profesor');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $areaid = $request->get('area');
        $area = Area::with('carrera')->find($areaid);

        // return $area;

        $posts = Post::where('area_id',$areaid)->orderBy('id','DESC')->get();

        // $carrera = Carrera::find($carreraid);

        // return $area;




        return view('profesor.Guia.index',compact(['area','posts']));
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
        $profesor = Auth::guard('profesor')->user();

        $profesorid = $profesor->id;
        // return $profesorid;
        $areaid = $request->post('areaid');
        $tema = $request->post('tema');
        $descripcion = $request->post('descripcion');

        // return $tema;

        $post = new Post;
        $post->tema = $tema;
        $post->descripcion = $descripcion;
        $post->area_id = $areaid;
        $post->profesor_id = $profesorid;
        $post->save();

        return redirect()->back();

        // return $areaid;


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
        $post = Post::with('area.carrera')->find($id);
        // return $post;
        return view('profesor.Guia.edit',compact(['post']));
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
        // return 'lolo';
        $postid = $id;

        $post = Post::with('area')->find($postid);

        // return $post;

        $tema = $request->post('tema');
        $descripcion = $request->post('descripcion');

        // return $descripcion;

        // $post = Post::find($postid);
        $post->tema = $tema;
        $post->descripcion = $descripcion;
        $post->save();

        return redirect()->route('profesor.guia.index', ['area' => $post->area->id]);
        
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
