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
        <div class="row mt-3">
            <div class="col text-center">
                <p class="fw-bold mb-0">Editar comentario</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <p>{{$post->area->carrera->nombre}} - {{$post->area->nombre}}  - Comentario</p>
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