@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <p>Area - {{$area->nombre}}</p>

                @if(!($maxIteration == 0))
                    <p>Puntaje {{$puntaje}}</p>

                @endif
                {{-- <h3><span class="badge bg-secondary">Puntaje {{$puntaje}}</span></h3> --}}
            </div>
        </div>

        @if ( !($maxIteration == 0) )
            <div class="row">
                <div class="col w-100 d-flex justify-content-end">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Iteraciones
                        </a>
                    
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @for ($i = 0; $i < $maxIteration; $i++)
                                <li><a class="dropdown-item" href="{{route('alumno.areas.survey.results',['areaid'=>$area->id,'iteration'=>($i+1)])}}">{{$i+1}}</a></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    @foreach ($preguntas as $pregunta)
                        <div class="question">
                            <div class="d-flex mb-4">
                                {{$pregunta->pregunta}}
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
                    

                </div>
            </div>
        @else
            <p>No hay reespustas</p>
        @endif
        
    </div>
    
@endsection