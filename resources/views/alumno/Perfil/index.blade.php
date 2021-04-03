@extends('layouts.app')

@section('content')

    <div class="container px-4">

      <div class="row mb-4">
        <div class="col-12">
            <h1 class="m-0">Perfil</h1>
        </div>
    </div>

        {{-- <p>{{$user}}</p> --}}
        {{-- <p>{{$user->profile->getRelationValue('carrera')->nombre}}</p> --}}
        <div class="row">
            <div class="col">
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Nombre</div>
                        {{$user->name}}
                      </div>
                      {{-- <span class="badge bg-primary rounded-pill">14</span> --}}
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Apellidos</div>
                        {{$user->apaterno}} {{$user->amaterno}}
                      </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Matricula</div>
                        {{$user->profile->matricula}}
                      </div>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Correo</div>
                        {{$user->profile->email}}
                      </div>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Semestre</div>
                        {{$user->profile->semestre}} semestre
                      </div>
                    </li>
                    
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                      <div class="ms-2 me-auto">
                        <div class="fw-bold">Carrera</div>
                        {{$user->profile->career->nombre}} carrera
                      </div>
                    </li>


                  </ol>
            </div>
        </div>
        
    </div>
    
@endsection