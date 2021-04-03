@extends('layouts.app')

@section('style-area')
    <style>
        .circle{
            width: 90px;
            height: 90px;
            background-color: white;
            border-radius: 50%;
            font-size: 1.5em;
            border: 2px solid rgba(0,0,0,0.1);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .gon{
            width: 60px;
            height: 60px;
            clip-path: polygon(30% 0%, 70% 0%, 100% 30%, 100% 70%, 70% 100%, 30% 100%, 0% 70%, 0% 30%);
            background-color: red;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
        
        .gon-1{
            background-color: #00873c;
        }

        .gon-2{
            background-color: #ffa008;
        }

        .gon-3{
            background-color: #20639B;
        }

    </style>
@endsection

@section('content')
    <div class="container px-4">

        <div class="row mb-4">
            <div class="col-12">
                <h1 class="m-0">Areas</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>
            </div>
        </div>

        
        <div class="row">
            @foreach ($areas as $area)
                <div class="col">

                    <div class="card w-100 mb-5 p-3" style="width: 18rem;">
                        <div class="card-header w-100 d-flex justify-content-center border-0">

                            <div class="circle d-flex align-items-center justify-content-center">

                                <div class="gon gon-{{ $loop->index+1 }}">
                                    {{$area->nombre[0]}}
                                </div>

                            </div>

                        </div>
                        <div class="card-body pt-0">
                            <div class="w-100 mb-3">
                                <h5 class="card-title w-100 text-center m-0">{{$area->nombre}}</h5>
                                <div id="emailHelp" class="m-0 form-text w-100 text-center">Materia</div>
                            </div>  

                            {{-- <div class="d-flex flex-column flex-wrap w-100 align-items-center">
                                <a href="{{route('alumno.areas.survey.show',$area->id)}}" class="btn btn-primary mb-3">Realizar examen</a>
                                <a href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>0])}}" class="btn btn-success mb-3">Ver resultados</a>
                                <a href="#" class="btn btn-secondary">Ver guia de estudios</a>
                            </div> --}}

                            <div class="d-flex flex-column flex-lg-row flex-wrap w-100 align-items-center justify-content-between">
                                <a href="{{route('alumno.areas.survey.show',$area->id)}}" class="btn btn-primary mb-3 mb-lg-0">Simulador</a>
                                <a href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>0])}}" class="btn btn-success mb-3 mb-lg-0">Resultados</a>
                                <a href="#" class="btn btn-secondary mb-3 mb-lg-0">Guia</a>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
@endsection