@extends('layouts.app')

@push('style')
    <style>
        .icons{
            font-size: 5em
        }
    </style>
@endpush

@section('content')

    <div class="container px-4">

        <div class="row mb-4">
            <div class="col-12">
                <h1 class="m-0">Resultados</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('alumno.areas.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Resultados</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$area->nombre}}</li>
                </ol>
            </nav>
        </div>

        <div class="w-100 bg-white p-5 border">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    @if(!($maxIteration == 0))
                        {{-- <p>Puntaje {{$puntaje}}</p> --}}
                        <h3 class="m-0"><span class="badge bg-primary">Puntaje {{$puntaje}}</span></h3>
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Iteraciones: {{$iteration}}
                            </a>
                        
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @for ($i = 0; $i < $maxIteration; $i++)
                                    <li><a class="dropdown-item" href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>($i+1)])}}">{{$i+1}}</a></li>
                                @endfor
                            </ul>
                        </div>
                    
                    @else
                        <div class="w-100 d-flex flex-wrap">
                            <i class="bi bi-exclamation-circle-fill w-100 text-center icons text-warning"></i>
                            <p class="w-100 text-center m-0">Aun no has respondido el cuestionario</p>
                        </div>

                    @endif
                    {{-- <h3><span class="badge bg-secondary">Puntaje {{$puntaje}}</span></h3> --}}
                </div>
            </div>
    
            @if ( !($maxIteration == 0) )
                {{-- <div class="row">
                    <div class="col w-100 d-flex justify-content-end">
                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Iteraciones: {{$iteration}}
                            </a>
                        
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @for ($i = 0; $i < $maxIteration; $i++)
                                    <li><a class="dropdown-item" href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>($i+1)])}}">{{$i+1}}</a></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div> --}}
    
                <div class="row">
                    <div class="col-12">

                        @if (count($preguntas) != 0)
                            @foreach ($preguntas as $pregunta)
                                <div class="question">
                                    <div class="d-flex mb-4">
                                        {{$loop->index+1}}. {{$pregunta->pregunta}}
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @foreach ($pregunta->respuestas as $respuesta)
                                            <div class="alert alert-{{$respuesta->alert}} w-100 p-2" role="alert">
                                                {{$respuesta->respuesta}}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="w-100">
                                <i class="d-block bi bi-exclamation-circle-fill w-100 text-center icons text-warning"></i>
                                <p class="w-100 text-center  text-secondary fs-5">Las preguntas que se contestaron en su momento han sido borradas por el coordinador</p>
                            </div>
                        @endif
    
                        
    
                    </div>
                </div>
            @else
                <p class="w-100 text-center text-secondary">No hay respuestas</p>
            @endif

        </div>

        
    </div>
    
@endsection