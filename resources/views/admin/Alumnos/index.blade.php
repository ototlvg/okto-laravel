@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Alumnos</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.alumnos.index')}}">Alumnos</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Alumnos</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{route("admin.alumnos.create")}}" class="btn btn-success">Añadir alumno</a>
        </div>

    </div>

</div>

<div class="row">
    <div class="col-12 mt-4">

        
        {{-- <label class="custom-file-label" for="customFile">Subida masiva de usuarios excel</label> --}}
        <form action="{{route('admin.alumnos.excel')}}" method="post" enctype="multipart/form-data" class="w-100 d-flex justify-content-between align-items-center">
            @csrf
            <div class="flex-grow-1">
                <label for="formFile" class="form-label">Subida masiva de usuarios excel</label>
                <input class="form-control" type="file" id="formFile" name="file" required>
            </div>

            {{-- <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="file" required>
            </div> --}}
              
            <button type="submit" class="btn btn-success ml-2 align-self-end ms-3">Cargar</button>
        </form>
    </div>
</div>

@if ($errors->any())

    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>
                    @if ($errors->has('carreraInExcelButNotInDatabase'))
                        <h4><strong>Carreras no disponibles</strong></h4>
                        <p>Estas carreras se encuentran en la hoja de calculo, pero aun no estan registradas en base de datos</p>
                        <ul>
                            @foreach ($errors->get('carreraInExcelButNotInDatabase') as $item)
                                <li>{{$item}}</li>
                            @endforeach
                        </ul>
                        <p>Ningun alumno de los que se acaban de tratar de subir a sido registrado</p>
                        {{-- <p>{{$errors->get('carreraInExcelButNotInDatabase')[0]}}</p> --}}
                    @endif

                    @if ($errors->has('file'))
                        <h4><strong>Archivo no valido</strong></h4>
                        <p>Se debe de subir un archivo de hoja de calculos (excel) con el formato especificado</p>
                    @endif
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>

    
    
@endif

@if (Session::has('status') && Session::get('status')!=0)
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Alumnos agregados</strong></h4>
                    <p>Cantidad de alumnos nuevos registrados: {{Session::get('status')}}</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (Session::has('duplicateStudents') && count(Session::get('duplicateStudents'))!=0)
    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Alumnos duplicados</strong></h4>
                    <p>Los alumnos con las siguientes matriculas ya se encuentran registrados en la base de datos:</p>
                    <ul>
                        @foreach (Session::get('duplicateStudents') as $item)
                            {{-- <p class="m-0">Los siguientes alumnos no fueron agregados, ya existen en la base de datos</p>
                            <p>Matricula: </p> --}}
                            <li>{{$item[0]}}</li>
                        @endforeach
                    </ul>
                    @if (Session::get('status')==0)
                        <p>Ningun alumno de los que se acaban de tratar de subir a sido registrado</p>
                    @endif
                    {{-- <p>{{$errors->get('carreraInExcelButNotInDatabase')[0]}}</p> --}}
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    {{-- @if (Session::has('duplicateStudents'))
        <p>Alumnos duplicados</p>
        @foreach (Session::get('duplicateStudents') as $item)
            <p class="m-0">Los siguientes alumnos no fueron agregados, ya existen en la base de datos</p>
            <p>Matricula: {{$item[0]}}</p>
        @endforeach
    @endif --}}
@endif

@if ( session()->has( 'success-matricula-deleted' ) )
    
    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Alumno eliminado</strong></h4>
                    <p>El alumno con matricula {{session()->get( 'success-matricula-deleted' )}} a sido eliminado</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if ( session()->has( 'success-matricula-store' ) )
    {{-- El usuario con correo {{session()->get( 'success-email-store' )}} a sido creado --}}
    {{-- <p>Alumno con matricula {{Session::get('success-matricula-store')}}</p> --}}
    <div class="row mt-4">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Alumno agregado</strong></h4>
                    <p>Alumno con matricula {{Session::get('success-matricula-store')}} agregado</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif



@endsection

@section('body')
        
            {{-- <div class="row mb-3">
                <div class="col-12 d-flex justify-content-between">
                    <div class="h3 align-items-center d-flex">Alumno</div>
                    <a href="{{route("admin.alumnos.create")}}" class="btn btn-success">Añadir alumno</a>
                </div>
            </div> --}}

            {{-- <div class="row d-flex justify-content-center">
                <div class="col-4">
                    @if ($errors->has('file'))
                        <p>Debes de subir un archivo</p>
                    @endif
                </div>
            </div> --}}

            <div class="row">
                <div class="col">
                    {{-- @if ( session()->has( 'success-matricula-deleted' ) )
                        El usuario con matricula {{session()->get( 'success-matricula-deleted' )}} a sido eliminado
                    @endif --}}
    
                    {{-- @if ( session()->has( 'success-matricula-store' ) )
                        <p>Alumno con matricula {{Session::get('success-matricula-store')}}</p>
                    @endif --}}

                    {{-- @if (Session::has('status'))
                        <p>
                            {{Session::get('status')}}
                        </p>
                    @endif --}}
            
                    {{-- @if (Session::has('duplicateStudents'))
                        <p>Alumnos duplicados</p>
                        @foreach (Session::get('duplicateStudents') as $item)
                            <p class="m-0">Los siguientes alumnos no fueron agregados, ya existen en la base de datos</p>
                            <p>Matricula: {{$item[0]}}</p>
                        @endforeach
                    @endif --}}
            
            
                    {{-- @error('name')
                        <p>{{ $message }}</p>
                    @enderror --}}
            
                    {{-- @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach --}}
            
                        
                    {{-- @if ($errors->has('carreraInExcelButNotInDatabase'))
                        <p>Estas carreras se encuentran en la hoja de calculo, pero aun no estan registradas en base de datos</p>
                        <p>Ningun alumno de los que se acaban de tratar de subir a sido registrado</p>
                        <p>{{$errors->get('carreraInExcelButNotInDatabase')[0]}}</p>
                    @endif --}}

                </div>
            </div>
            
            <div class="row">
                <div class="col">
                    <table class="table table-hover table-borderless">
                        <thead>
                            <tr>
                                <th scope="col" class="d-none d-lg-table-cell">ID</th>
                                <th scope="col" class="d-none d-lg-table-cell">Nombre</th>
                                <th scope="col" class="d-none d-lg-table-cell">Apellido Paterno</th>
                                <th scope="col" class="d-none d-lg-table-cell">Apellido Materno</th>
                                <th scope="col">Semestre</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Matricula</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row" class="d-none d-lg-table-cell align-middle">{{$user->id}}</th>
                                    <td class="d-none d-lg-table-cell align-middle">{{$user->name}}</td>
                                    <td class="d-none d-lg-table-cell align-middle">{{$user->apaterno}}</td>
                                    <td class="d-none d-lg-table-cell align-middle">{{$user->amaterno}}</td>
                                    <td class="align-middle">{{$user->profile->semestre}}</td>
                                    <td class="align-middle">{{$user->profile->carrera}}</td>
                                    <td class="align-middle">{{$user->profile->matricula}}</td>
                                    <td class="align-middle">
                                        <span>
                                            <button type="button" class="btn btn-danger" onclick="deleteAlumno({{$user->id}})">
                                                <i class="bi bi-trash-fill"></i>
                                                Eliminar
                                            </button>
                                        </span>
                                        <form class="d-none" id="alumno-delete-{{$user->id}}" action="{{route('admin.alumnos.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>

                                        <a href="{{route('admin.alumnos.edit',$user->id)}}">
                                            <button type="button" class="btn btn-primary">
                                                <i class="bi bi-pencil-square"></i>
                                                Editar
                                            </button>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        
@endsection

@push('script')
    <script src="{{asset('js/sweetalert2.js')}}"></script>
@endpush

@push('script')
    <script>

        let deleteAlumno = (alumnoid) => {
            

            
            Swal.fire(
                {
                    title: '¿Estas seguro?',
                    text: "El alumno sera eliminado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('alumno-delete-'+alumnoid)
                        console.log(form)
                        form.submit()
                }
            })

        }

    </script>
@endpush