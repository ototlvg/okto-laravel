@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <p>Area - {{$area->nombre}}</p>
        </div>
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
    </div>
@endsection