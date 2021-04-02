@extends('layouts.app')

@section('style-area')
    <style>
        .circle{
            width: 70px;
            height: 70px;
            background-color: skyblue;
            border-radius: 50%;
            font-size: 1.5em;
        }
    </style>
@endsection

@section('content')
    <div class="container p-4">
        
        <div class="row">
            @foreach ($areas as $area)
                <div class="col">

                    <div class="card w-100 mb-5" style="width: 18rem;">
                        <div class="card-header w-100 d-flex justify-content-center p-5">

                            <div class="circle d-flex align-items-center justify-content-center">{{$area->nombre[0]}}</div>

                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title w-100 text-center mb-3">{{$area->nombre}}</h5>
                            {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}

                            <div class="d-flex flex-column flex-wrap w-100 align-items-center">
                                <a href="{{route('alumno.areas.survey.show',$area->id)}}" class="btn btn-primary mb-3">Realizar examen</a>
                                <a href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>0])}}" class="btn btn-success mb-3">Ver resultados</a>
                                <a href="#" class="btn btn-secondary">Ver guia de estudios</a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection