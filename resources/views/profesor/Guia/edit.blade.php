@extends('layouts.profesor')

@section('style-area')
    <style>
        .container{
            max-width: 700px !important;
        }
    </style>
@endsection

@section('container')
    <div class="container">
        {{-- <div class="row mt-3">
            <div class="col text-center">
                <p class="fw-bold mb-0">Editar comentario</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <p>{{$post->area->carrera->nombre}} - {{$post->area->nombre}}  - Comentario</p>
            </div>
        </div> --}}

        <div class="row mb-4">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center bg-white"">
                    <div>
                        {{-- <h5 class="card-title fs-3">{{$post->tema}}</h5> --}}
                        <h5 class="card-title fs-3">Editar guia</h5>
    
    
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('profesor.carreras.index')}}">{{$post->area->carrera->nombre}}</a></li>
                                {{-- <li class="breadcrumb-item"><a href="{{route('profesor.guia.index')}}">{{$post->area->nombre}} </a></li> --}}
                                <li class="breadcrumb-item"><a href="{{route('profesor.guia.index', ['area' => $post->area->id])}}">{{$post->area->nombre}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Editar guia</li>
                            </ol>
                        </nav>
    
                    </div>
        
                    <div>
                        <a class="btn btn-danger me-1" href="{{route('profesor.guia.show',$post->id)}}" role="button"><i class="bi bi-pencil-square me-1"></i>Cancelar</a>
                        {{-- <button type="button" class="btn btn-danger" onclick="destroyPost({{ $post->id }})"><i class="bi bi-trash-fill"></i></button> --}}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col">
                {{-- {{$post->descripcion}} --}}
                <form class="d-flex w-100 flex-wrap" action="{{route('profesor.guia.update', $post->id)}}" method="POST">
                    @csrf
                    @method('PUT')


                            <input type="text" name="tema" id="" class="form-control mb-3" placeholder="Tema" value="{{$post->tema}}">

                            <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="15" required>{{$post->descripcion}}</textarea>

                    <div class="w-100 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection