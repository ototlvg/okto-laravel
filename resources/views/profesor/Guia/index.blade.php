@extends('layouts.profesor')

@section('style-area')
    <style>
        .container{
            max-width: 700px !important;
        }
        .formatear{
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        .fs-s{
            font-size: 12px
        }
    </style>
@endsection

@section('container')
    <div class="container">

        <div class="row mt-3">
            <div class="col">
                <p class="mb-0 text-center fw-bold">Guia</p>
            </div>
        </div>

        <div class="row">
            <div class="col text-center">
                <p>{{$area->carrera->nombre}} - {{$area->nombre}}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <form class="d-flex w-100 flex-wrap" action="{{route('profesor.guia.store')}}" method="POST">
                    @csrf
                    {{-- <div class="row w-100 mb-3">
                        <div class="col-12"> --}}
                            <input type="text" name="tema" id="" class="form-control mb-3" placeholder="Tema" required>
                        {{-- </div>
                    </div> --}}

                    {{-- <div class="row w-100">
                        <div class="col-12"> --}}
                            <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3" placeholder="Descripcion" required></textarea>
                        {{-- </div>
                    </div> --}}

                    <div class="w-100 mt-3 d-flex justify-content-end">
                        {{-- <div class="col-12 d-flex justify-content-end"> --}}
                            <button type="submit" class="btn btn-success">Guardar</button>
                        {{-- </div> --}}
                    </div>

                    <input type="number" name="areaid" id="" value="{{$area->id}}" class="d-none">

                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <p>Comentarios</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @foreach ($posts as $post)
                <div class="card mb-3">
                        <div class="card-header bg-secondary text-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex flex-wrap flex-column">
                                    <strong>{{$post->tema}}</strong>
                                    <p class="m-0 fs-s">{{ date('d-M-y', strtotime($post->updated_at)) }}</p>
                                    
                                </div>
                                <div class="d-flex">
                                    {{-- <button type="button" class="btn btn-primary btn-sm me-1"><i class="bi bi-pencil-square text-light"></i></button> --}}
                                    {{-- <a class="btn btn-primary btn-sm me-1" href="{{route('profesor.guia.edit',[$post->id,'coco'=>8.2])}}" role="button"><i class="bi bi-pencil-square text-light"></i></a> --}}
                                    <a class="btn btn-primary btn-sm me-1" href="{{route('profesor.guia.edit',$post->id)}}" role="button"><i class="bi bi-pencil-square text-light"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                                </div>
                            </div>
                            {{-- Featured --}}
                        </div>
                        <div class="card-body">
                            {{-- <p class="card-text">{{$post->descripcion}}</p> --}}

                            <pre class="formatear"><p class="m-0">{{$post->descripcion}}</p></pre>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection