@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Profesores</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.alumnos.index')}}">Alumnos</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Profesores</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{route("admin.profesores.create")}}" class="btn btn-success">Agregar profesor</a>
        </div>

    </div>

</div>

@if (Session::has('success-noempleado-update'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Profesor modificado</strong></h4>
                    El profesor con No. Empleado "{{Session::get('success-noempleado-update')}}" a sido modificado
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (Session::has('success-noemplado-store'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Profesor modificado</strong></h4>
                    El profesor con No. Empleado "{{Session::get('success-noemplado-store')}}" a sido agregado
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (Session::has('success-password-update'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Profesor modificado</strong></h4>
                    El profesor con No. Empleado "{{Session::get('success-noempleado-update')}}" a sido modificado
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (Session::has('deleted'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Profesor modificado</strong></h4>
                    El usuario con No. de empleado "{{Session::get('deleted')}}" a sido eliminado
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('body')
    
        

        {{-- <div class="row">
            <div class="col">
                @if ( session()->has( 'success-email-update' ) )
                    El usuario con correo {{session()->get( 'success-email-update' )}} a sido modificado
                @endif

                @if ( session()->has( 'success-email-store' ) )
                    El usuario con correo {{session()->get( 'success-email-store' )}} a sido creado
                @endif
                
                @if ( session()->has( 'success-password-update' ) )
                    contraseña actualizada
                @endif


            </div>
        </div> --}}

        <div class="row mt-3">
            <div class="col">
                <table class="table table-borderless table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesores as $profesor)
                            <tr>
                                <th class="align-middle" scope="row">{{$profesor->id}}</th>
                                <td class="align-middle">{{$profesor->name}}</td>
                                <td class="align-middle">{{$profesor->apaterno}} {{$profesor->amaterno}}</td>
                                <td class="align-middle">
                                    {{-- <a href="{{route("admin.profesores.destroy", $profesor->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}

                                    {{-- <a href="#" onclick="document.getElementById('destroy-profesor-{{ $profesor->id }}').submit()"> --}}
                                    {{-- <a href="#" onclick="deleteProfesor({{ $profesor->id }})">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}
                                    <span>
                                        <button type="button" class="btn btn-danger" onclick="deleteProfesor({{ $profesor->id }})">
                                            <i class="bi bi-trash-fill"></i>
                                            Eliminar
                                        </button>
                                    </span>
                                    <form class="d-none" id="destroy-profesor-{{ $profesor->id }}" action="{{ route('admin.profesores.destroy', $profesor->id) }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    </form>


                                    <a href="{{route("admin.profesores.edit", $profesor->id)}}">
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
        let deleteProfesor = (profesorid) => {
            console.log(profesorid)
            
            Swal.fire(
                {
                    title: '¿Estas seguro?',
                    text: "El profesor sera eliminado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('destroy-profesor-'+profesorid)
                        console.log(form)
                        form.submit()

                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                }
            })
        }
    </script>
@endpush