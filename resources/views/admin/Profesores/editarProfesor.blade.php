@extends('layouts.admin')

@section('container')
    <div class="container mb-5">
        <div class="row mt-3 mb-3">
            <div class="col d-flex justify-content-center">
                <h3>Editar profesor</h3>
            </div>
        </div>
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
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form class="w-100" method="post" action="{{route("admin.profesores.update",$profesor->id)}}">
                    @csrf
                    @method('PUT')
                    {{-- {{ method_field('put') }} --}}
                    {{-- Esto se agrega para que funcione --}}
                    <input name="_method" type="hidden" value="PUT"> 
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        @if(old('name'))
                            <input name="name" type="text" class="form-control" id="name" required value="{{old('name')}}">
                        @else
                            <input name="name" type="text" class="form-control" id="name" required value="{{$profesor->name}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="apaterno">Apellido</label>
                        @if(old('apaterno'))
                            <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{old('apaterno')}}">
                        @else
                            <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{$profesor->apaterno}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="amaterno">Apellido Materno</label>
                        @if(old('amaterno'))
                            <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{old('amaterno')}}">
                        @else
                            <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{$profesor->amaterno}}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required value="{{$profesor->email}}">
                    </div>

                    <div class="form-group">
                        <label for="password">password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>

                    <div class="form-group">
                        <label for="noempleado">No. empleado</label>
                        @if(old('noempleado'))
                            <input name="noempleado" type="number" class="form-control" id="noempleado" required value="{{old('noempleado')}}">
                        @else
                            <input name="noempleado" type="number" class="form-control" id="noempleado" required value="{{$profesor->noempleado}}">
                        @endif
                    </div>
                    {{-- <div class="form-group">
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
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection