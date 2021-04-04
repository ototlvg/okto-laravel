@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Editar coordinador</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.coordinadores.index')}}">Coordinadores</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$coordinador->name}}</li>
                    {{-- <li class="breadcrumb-item active" aria-current="page">{{$carrera->nombre}}</li> --}}
                </ol>
            </nav>
        </div>

        {{-- <div>
            <a href="{{route("admin.carreras.create")}}" class="btn btn-success">Agregar carrera</a>
        </div> --}}

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
                <form class="w-100" method="POST" action="{{route('admin.coordinadores.update',$coordinador->id)}}">
                    @csrf
                    @method('put')

                    <div class="form-group mb-4">
                        <label for="name" class="mb-2">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{ empty( old('name') ) ? $coordinador->name : old('name') }}">
                    </div>
                    <div class="form-group mb-4">
                        <label for="apaterno" class="mb-2">Apellido</label>
                        <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{ empty( old('apaterno') ) ? $coordinador->apaterno : old('apaterno') }}">
                    </div>
                    <div class="form-group mb-4" class="mb-2">
                        <label for="amaterno">Apellido Materno</label>
                        <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{ empty( old('amaterno') ) ? $coordinador->amaterno : old('amaterno') }}">
                    </div>

                    <div class="form-group mb-4" class="mb-2">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required value="{{ empty( old('email') ) ? $coordinador->email : old('email') }}">
                    </div>

                    <div class="form-group mb-4" class="mb-2">
                        <label for="password">Password (Dejar vacio si no se quiere modificar la contraseña)</label>
                        <input minlength="8" name="password" type="password" class="form-control" id="password" placeholder="La contraseña NO se modificara">
                    </div>

                    <div class="form-group mb-4" class="mb-2">
                        <label for="noempleado">No. empleado</label>
                        <input name="noempleado" type="number" class="form-control" id="noempleado" required value="{{ empty( old('noempleado') ) ? $coordinador->noempleado : old('noempleado') }}">
                    </div>

                    <div class="form-group mb-4" class="mb-2">
                        <label class="mb-2" for="gender">Programa educativo</label>
                        <select name="carreraid" id="carreraid" class="form-select" required>
                            @if (!empty(old('carreraid')))
                                @foreach ($carreras as $carrera)
                                    <option value="{{$carrera->id}}" {{ $carrera->id == old('carreraid') ? 'selected' : '' }}>{{$carrera->nombre}}</option>
                                @endforeach
                            @else
                                @foreach ($carreras as $carrera)
                                    <option value="{{$carrera->id}}" {{ $carrera->id == $coordinador->carrera_id ? 'selected' : '' }}>{{$carrera->nombre}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>



                    <button type="submit" class="btn btn-success w-100 p-3">Guardar</button>
                </form>
            </div>
        </div>
    
@endsection