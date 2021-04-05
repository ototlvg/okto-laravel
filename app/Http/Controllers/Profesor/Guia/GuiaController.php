<?php

namespace App\Http\Controllers\Profesor\Guia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Carrera;
use App\Area;
use App\Post;
use App\Profesor;

class GuiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:profesor');
        // $this->middleware('returnAuthVariable:profesor');
    }

    public function canEditDeletePost($profesor,$post)
    {
        if($profesor->id != $post->profesor_id){
            return false;
        }else{
            return true;
        }
    }

    public function canSeePost($profesor,$post){
        $post->area->carrera_id;

        // return $profesor;
        $carrerasid = [];
        foreach($profesor->carreras as $carrera){
            array_push($carrerasid,$carrera->id);
        }

        if(in_array($post->area->carrera_id,$carrerasid)){
            return true;
        }else{
            return false;
        }
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

        $posts = Post::with('profesor')->where('area_id',$areaid)->orderBy('id','DESC')->get();
        // return $posts[0]->profesor;
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
        // return 'hola';
        $profesorid = Auth::guard('profesor')->id();
        $profesor = Profesor::with('carreras')->find($profesorid);

        $post = Post::with('area')->find($id);

        
        if(empty($post)){
            return 'El post no existe';
        }

        if(!$this->canSeePost($profesor,$post)){
            return 'Este post pertenece a una carrera la cual no esta adjunto , por lo que no puedes verlo, comuniquese con el coordinador de la carrera para que lo agregue';
        }

        // return $post;
        return view('profesor.Guia.show',compact(['post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Auth::guard('profesor')->user();
        $post = Post::with('area.carrera')->find($id);

        if(empty($post)){
            return 'El post no existe';
        }
        
        if(!$this->canEditDeletePost($profesor,$post)){
            return 'Este post no ha sido creado por usted, por lo que no puedes eliminarlo';
        }

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
        $profesor = Auth::guard('profesor')->user();
        $post = Post::with('area')->find($id);

        if(empty($post)){
            return 'El post no existe';
        }
        
        if(!$this->canEditDeletePost($profesor,$post)){
            return 'Este post no ha sido creado por usted, por lo que no puedes eliminarlo';
        }
        // return 'lolo';

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
    public function destroy($id) // destruye un post
    {
        $profesor = Auth::guard('profesor')->user();
        $post = Post::find($id);

        if(empty($post)){
            return 'El post no existe';
        }
        
        if(!$this->canEditDeletePost($profesor,$post)){
            return 'Este post no ha sido creado por usted, por lo que no puedes eliminarlo';
        }

        $post->delete();

        return redirect()->route('profesor.guia.index',['area'=> $post->area_id])->with(['deletedPost'=>$post->tema]);
    }
}
