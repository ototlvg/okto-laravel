@extends('layouts.profesor')

@section('style-area')
    <style>
        
    </style>
@endsection

@section('container')
    <div class="container">

        {{-- <div class="d-flex justify-content-between align-items-center bg-white mb-4">
            <div>
                <h5 class="card-title fs-3">Carreras</h5>
                <h6 class="card-subtitle mb-2 text-muted">Lista de carreras disponibles</h6>
            </div>

            <div>
                <a href="http://corvus.com/empresa/users/create">
                    <button type="button" class="btn btn-success">Añadir</button>
                </a>
            </div>
        </div> --}}



        <div class="row mb-4">
            <div class="col">
                <div>
                    <h5 class="card-title fs-3">Carreras</h5>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item active" aria-current="page">Lista de carreras disponibles</li>
                        </ol>
                      </nav>
                </div>
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