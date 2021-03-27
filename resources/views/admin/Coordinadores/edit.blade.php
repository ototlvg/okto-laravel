@extends('layouts.admin')

@section('container')
    <div class="container mb-5">
        <div class="row mt-3 mb-3">
            <div class="col d-flex justify-content-center">
                <h3>Editar coordinador</h3>
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

                {{-- {{$coordinador}} --}}

            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form class="w-100" method="POST" action="{{route('admin.coordinadores.update',$coordinador->id)}}">
                    @csrf
                    @method('put')

                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input name="name" type="text" class="form-control" id="name" required value="{{ empty( old('name') ) ? $coordinador->name : old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="apaterno">Apellido</label>
                        <input name="apaterno" type="text" class="form-control" id="apaterno" required value="{{ empty( old('apaterno') ) ? $coordinador->apaterno : old('apaterno') }}">
                    </div>
                    <div class="form-group">
                        <label for="amaterno">Apellido Materno</label>
                        <input name="amaterno" type="text" class="form-control" id="amaterno" required value="{{ empty( old('amaterno') ) ? $coordinador->amaterno : old('amaterno') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email" required value="{{ empty( old('email') ) ? $coordinador->email : old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Password (Dejar vacio si no se quiere modificar la contraseña)</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="La contraseña NO se modificara">
                    </div>

                    <div class="form-group">
                        <label for="noempleado">No. empleado</label>
                        <input name="noempleado" type="number" class="form-control" id="noempleado" required value="{{ empty( old('noempleado') ) ? $coordinador->noempleado : old('noempleado') }}">
                    </div>

                    <div class="form-group">
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



                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection