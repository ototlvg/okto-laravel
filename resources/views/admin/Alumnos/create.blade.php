@extends('layouts.admin')

@section('container')
    <main class="container">

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
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" value="{{old('name')}}" required>
                    </div>
                    {{-- @if($errors->has('name'))
                        <div class="ui yellow message">
                            <p>{{$errors->first('name')}}</p>
                        </div>
                    @endif --}}

                    <div class="form-group">
                        <label for="apaterno">Apellido Paterno</label>
                        <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{old('apaterno')}}">
                    </div>

                    <div class="form-group">
                        <label for="amaterno">Apellido Materno</label>
                        <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{old('amaterno')}}">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        <input name="matricula" type="number" class="form-control" id="matricula" required value="{{old('matricula')}}">
                    </div>

                    <div class="form-group">
                        <label for="semestre">Semestre</label>
                        <input name="semestre" type="number" class="form-control" id="semestre" required value="{{old('semestre')}}">
                    </div>

                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        <input name="grupo" type="number" class="form-control" id="grupo" required value="{{old('grupo')}}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" required value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="carrera">Programa educativo</label>
                        <select class="custom-select" name="carreraid">
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

                    <button class="btn btn-primary">Guardar</button>
                </form>

            </div>
        </div>
    </main>
@endsection