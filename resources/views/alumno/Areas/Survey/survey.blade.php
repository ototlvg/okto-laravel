@extends('layouts.app')

@section('content')
    <div class="container px-4">

        <div class="row mb-4">
            <div class="col-12">
                <h1 class="m-0">Areas</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('alumno.areas.index')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Simulador</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <p>Area - {{$area->nombre}}</p>
        </div>
        @if (count($preguntas) == 0)
            
            <div class="row">
                <p>No hay preguntas</p>
            </div>

        @else

            <div class="row">
                <div class="col-12">
                    <form action="{{route('alumno.areas.survey.store')}}" method="POST" class="needs-validation">
                        @csrf
                        @foreach ($preguntas as $pregunta)
                            <div class="question">
                                <p class="m-0">{{$pregunta->pregunta}}</p>
                                
                                <div class="answers">
        
                                    @foreach ($pregunta->respuestas as $respuesta)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="pregunta_{{$pregunta->id}}" id="respuesta_{{$respuesta->id}}" value="{{$respuesta->id}}" required>
                                            <label class="form-check-label" for="respuesta_{{$respuesta->id}}">
                                                {{$respuesta->respuesta}}
                                            </label>
                                        </div>
                                    @endforeach
        
        
        
                                    {{-- <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Default radio
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Default checked radio
                                        </label>
                                    </div> --}}
                                </div>
                            </div>
                        @endforeach
                        
                        <input type="number" name="areaid" id="" value="{{$areaid}}" class="d-none">
                        <button type="submit" class="btn btn-primary">Terminar</button>
                    </form>
                </div>
            </div>


        @endif
    </div>
@endsection