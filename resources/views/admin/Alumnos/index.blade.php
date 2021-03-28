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

            <div class="row">
                <div class="col">
                    @if ( session()->has( 'success-matricula-deleted' ) )
                        El usuario con matricula {{session()->get( 'success-matricula-deleted' )}} a sido eliminado
                    @endif
    
                    @if ( session()->has( 'success-matricula-store' ) )
                        {{-- El usuario con correo {{session()->get( 'success-email-store' )}} a sido creado --}}
                        <p>Alumno con matricula {{Session::get('success-matricula-store')}}</p>
                    @endif

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

                </div>
            </div>



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
                                <th scope="col">Acciones</th>
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
                                    <td>
                                        <a href="#">
                                            <span class="material-icons text-danger" onclick="deleteAlumno({{$user->id}})">delete</span>
                                            {{-- <i class="material-icons text-danger" onclick="deleteAlumno($user->id)"></i> --}}
                                        </a>
                                        <form class="d-none" id="alumno-delete-{{$user->id}}" action="{{route('admin.alumnos.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>

                                        <a href="{{route('admin.alumnos.edit',$user->id)}}">
                                            {{-- <span class="material-icons text-danger" onclick="deleteAlumno({{$user->id}})">delete</span> --}}
                                            {{-- <i class="material-icons text-danger" onclick="deleteAlumno($user->id)"></i> --}}
                                            <span class="material-icons">create</span>
                                        </a>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
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
                    text: "El coordinador sera eliminado",
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