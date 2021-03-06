@extends('layouts.admin')

@push('style')
    <style>
        .container{
            max-width: 500px !important;
        }
    </style>
@endpush

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Agregar profesor</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.profesores.index')}}">Profesores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">{{$coordinador->name}}</li> --}}
                    {{-- <li class="breadcrumb-item active" aria-current="page">{{$carrera->nombre}}</li> --}}
                </ol>
            </nav>
        </div>

    </div>

</div>


@if ($errors->any())
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Problemas encontrados</strong></h4>
                    {{-- <p>Los alumnos con las siguientes matriculas no han sido agregados:</p> --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>       
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('body')
        <div class="row">
            <div class="col-12">
                {{-- <form class="w-100" method="POST" action="{{route('profesorescrud.store')}}"> --}}
                <form class="w-100" method="POST" action="{{route('admin.profesores.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name" class="mb-2">Nombre</label>
                        @if(old('name'))
                            <input name="name" type="text" class="form-control" id="name" required value="{{old('name')}}">
                        @else
                            <input name="name" type="text" class="form-control" id="name" required>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label for="apaterno" class="mb-2">Apellido</label>
                        @if(old('apaterno'))
                            <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{old('apaterno')}}">
                        @else
                            <input name="apaterno" type="text" class="form-control" id="apaterno" required>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label for="amaterno" class="mb-2">Apellido Materno</label>
                        @if(old('amaterno'))
                            <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{old('amaterno')}}">
                        @else
                            <input name="amaterno" type="text" class="form-control" id="amaterno" required>
                        @endif
                    </div>
                    <div class="form-group mb-4">
                        <label for="email" class="mb-2">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="noempleado" class="mb-2">No. empleado</label>
                        @if(old('noempleado'))
                            <input name="noempleado" type="number" class="form-control" id="noempleado" required value="{{old('noempleado')}}">
                        @else
                            <input name="noempleado" type="number" class="form-control" id="noempleado" required>
                        @endif
                    </div>
                    {{-- <div class="form-group mb-4">
                        <label for="carrera">Programa educativo</label>
                        <select class="custom-select" name="carreraid" required>
                            <option selected>Open this select menu</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->id}}">{{$carrera->nombre}}</option>
                            @endforeach
                        </select>
                        @if($errors->has('carreraid'))
                            <div class="ui yellow message errorValidacion">
                                <p>{{$errors->first('carreraid')}}</p>
                            </div>
                        @endif
                    </div> --}}
                    <button type="submit" class="btn btn-success w-100 p-2">Guardar</button>
                </form>
            </div>
        </div>
    
@endsection