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

    <div class="col-12">
        <h1 class="m-0">Agregar alumno</h1>
    </div>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.alumnos.index')}}">Alumnos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Agregar</li>
        </ol>
    </nav>

</div>

@endsection

@section('body')
        
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

            </div>
        </div>

        <div class="row">
            <div class="col">

                <form action="{{route('admin.alumnos.store')}}" method="POST">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="name" class="mb-2">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" required>
                    </div>
                    {{-- @if($errors->has('name'))
                        <div class="ui yellow message">
                            <p>{{$errors->first('name')}}</p>
                        </div>
                    @endif --}}

                    <div class="form-group mb-4">
                        <label for="apaterno" class="mb-2">Apellido Paterno</label>
                        <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{old('apaterno')}}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="amaterno" class="mb-2">Apellido Materno</label>
                        <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{old('amaterno')}}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="matricula" class="mb-2">Matricula</label>
                        <input name="matricula" type="number" class="form-control" id="matricula" required value="{{old('matricula')}}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="semestre class="mb-2"">Semestre</label>
                        <input name="semestre" type="number" class="form-control" id="semestre" required value="{{old('semestre')}}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="grupo" class="mb-2">Grupo</label>
                        <input name="grupo" type="number" class="form-control" id="grupo" required value="{{old('grupo')}}">
                    </div>


                    <div class="form-group mb-4">
                        <label for="email" class="mb-2">Email</label>
                        <input name="email" type="text" class="form-control" id="email" required value="{{old('email')}}">
                    </div>

                    <div class="form-group mb-4">
                        <label for="carrera" class="mb-2">Programa educativo</label>
                        <select class="custom-select w-100" name="carreraid">
                            <option selected value="">Open this select menu</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->carrera}}">{{$carrera->nombre}}</option>
                            @endforeach
                        </select>
                        {{-- @if($errors->has('carreraid'))
                            <div class="ui yellow message errorValidacion">
                                <p>{{$errors->first('carreraid')}}</p>
                            </div>
                        @endif --}}
                    </div>

                    <button class="btn btn-primary w-100 p-2">Guardar</button>
                </form>

            </div>
        </div>
        
@endsection