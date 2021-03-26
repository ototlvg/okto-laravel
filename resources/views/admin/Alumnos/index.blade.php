@extends('layouts.admin')

@section('container')
        <main class="container mt-3">
            <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between">
                    <div class="h3 align-items-center d-flex">Alumno</div>
                    {{-- <button class="btn btn-success">Añadir alumno</button> --}}
                    <a href="{{route("admin.alumnos.create")}}" class="btn btn-success">Añadir alumno</a>
                </div>
            </div>


            @if (Session::has('status'))
                <p>
                    {{Session::get('status')}}
                </p>
            @endif
    
            @if (Session::has('duplicateStudents'))
                <p>Alumnos duplicados</p>
                @foreach (Session::get('duplicateStudents') as $item)
                    <p class="m-0">Los siguientes alumnos no fueron agregados, ya existen en la base de datos</p>
                    <p>Matricula: {{$item[0]}}</p>
                @endforeach
            @endif
    
    
            {{-- @error('name')
                <p>{{ $message }}</p>
            @enderror --}}
    
            {{-- @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach --}}
    
                
            @if ($errors->has('carreraInExcelButNotInDatabase'))
                <p>Estas carreras se encuentran en la hoja de calculo, pero aun no estan registradas en base de datos</p>
                <p>Ningun alumno de los que se acaban de tratar de subir a sido registrado</p>
                <p>{{$errors->get('carreraInExcelButNotInDatabase')[0]}}</p>
            @endif

            <div class="row mb-3">
                <div class="col">
                    <form action="{{route('admin.alumnos.excel')}}" method="post" enctype="multipart/form-data" class="w-100 d-flex">
                        @csrf
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="file">
                            <label class="custom-file-label" for="customFile">Subida masiva de usuarios excel</label>
                        </div>
                          
                        <button type="submit" class="btn btn-success ml-2">Cargar</button>
                    </form>

                    {{-- <form action="{{route('admin.alumnos.excel')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="">
                        <button type="submit">Enviar</button>
                    </form> --}}

                </div>
            </div>

            <div class="row">
                <div class="col">
                    <table class="table table-hover border">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Matricula</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{$user->id}}</th>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->apaterno}}</td>
                                    <td>{{$user->amaterno}}</td>
                                    <td>{{$user->profile->semestre}}</td>
                                    <td>{{$user->profile->carrera}}</td>
                                    <td>{{$user->profile->matricula}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
@endsection