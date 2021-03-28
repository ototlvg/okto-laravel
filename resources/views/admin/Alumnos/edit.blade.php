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

                <form action="{{route('admin.alumnos.update',$alumno->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{ empty( old('name') ) ? $alumno->name : old('name') }}">
                    </div>
                    {{-- @if($errors->has('name'))
                        <div class="ui yellow message">
                            <p>{{$errors->first('name')}}</p>
                        </div>
                    @endif --}}

                    <div class="form-group">
                        <label for="apaterno">Apellido Paterno</label>
                        {{-- <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{old('apaterno')}}"> --}}
                        <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{ empty( old('apaterno') ) ? $alumno->apaterno : old('apaterno') }}">
                    </div>

                    <div class="form-group">
                        <label for="amaterno">Apellido Materno</label>
                        {{-- <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{old('amaterno')}}"> --}}
                        <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{ empty( old('amaterno') ) ? $alumno->amaterno : old('amaterno') }}">
                    </div>

                    <div class="form-group">
                        <label for="matricula">Matricula</label>
                        {{-- <input name="matricula" type="number" class="form-control" id="matricula" required value="{{old('matricula')}}"> --}}
                        <input name="matricula" type="text" class="form-control" id="matricula" required value="{{ empty( old('matricula') ) ? $alumno->profile->matricula : old('matricula') }}">
                    </div>

                    <div class="form-group">
                        <label for="semestre">Semestre</label>
                        {{-- <input name="semestre" type="number" class="form-control" id="semestre" required value="{{old('semestre')}}"> --}}
                        <input name="semestre" type="text" class="form-control" id="semestre" required value="{{ empty( old('semestre') ) ? $alumno->profile->semestre : old('semestre') }}">
                    </div>

                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        {{-- <input name="grupo" type="number" class="form-control" id="grupo" required value="{{old('grupo')}}"> --}}
                        <input name="grupo" type="text" class="form-control" id="grupo" required value="{{ empty( old('grupo') ) ? $alumno->profile->grupo : old('grupo') }}">
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>
                        {{-- <input name="email" type="text" class="form-control" id="email" required value="{{old('email')}}"> --}}
                        <input name="email" type="text" class="form-control" id="email" required value="{{ empty( old('email') ) ? $alumno->profile->email : old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        {{-- <input name="email" type="text" class="form-control" id="email" required value="{{old('email')}}"> --}}
                        <input name="password" type="text" class="form-control" id="password">
                    </div>

                    <div class="form-group">
                        <label for="carrera">Programa educativo</label>
                        {{-- <select class="custom-select" name="carreraid">
                            <option selected value="">Open this select menu</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{$carrera->carrera}}">{{$carrera->nombre}}</option>
                            @endforeach
                        </select> --}}
                        <select name="carreraid" id="carreraid" class="form-select" required>
                            @if (!empty(old('carreraid')))
                                @foreach ($carreras as $carrera)
                                    <option value="{{$carrera->carrera}}" {{ $alumno->profile->carrera == old('carreraid') ? 'selected' : '' }}>{{$carrera->nombre}}</option>
                                @endforeach
                            @else
                                @foreach ($carreras as $carrera)
                                    <option value="{{$carrera->carrera}}" {{ $alumno->profile->carrera == $carrera->carrera ? 'selected' : '' }}>{{$carrera->nombre}}</option>
                                @endforeach
                            @endif
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