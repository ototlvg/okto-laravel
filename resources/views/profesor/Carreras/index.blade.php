@extends('layouts.profesor')

@section('style-area')
    <style>
        .container{
            max-width: 600px;
        }
    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row mt-3 mb-3">
            <div class="col text-center">
                <p class="mb-0 fw-bold">Carreras</p>
            </div>
        </div>
        <div class="row">
            <div class="col">

                
                <div class="accordion" id="accordionExample">
                    @foreach ($profesor->carreras as $carrera)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $loop->index }}" aria-expanded="true" aria-controls="collapse{{ $loop->index }}">
                                    {{$carrera->nombre}}
                                </button>
                            </h2>


                        @if ($loop->index)
                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                        @else
                            <div id="collapse{{ $loop->index }}" class="accordion-collapse collapse show" aria-labelledby="heading{{ $loop->index }}" data-bs-parent="#accordionExample">
                        @endif
                                <div class="accordion-body">
                                    @foreach ($carrera->areas as $area)
                                        {{-- <button type="button" class="btn btn-primary">{{$area->nombre}}</button> --}}
                                        {{-- <p>{{$area}}</p> --}}
                                        <a class="btn btn-primary" href="{{route('profesor.guia.index', ['area' => $area->id])}}" role="button">{{$area->nombre}}</a>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                

                
                  
    
    
            </div>
        </div>
    </div>
@endsection