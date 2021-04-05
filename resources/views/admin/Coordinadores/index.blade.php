@extends('layouts.admin')


@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Coordinadores</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.alumnos.index')}}">Alumnos</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Coordinadores</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{route("admin.coordinadores.create")}}" class="btn btn-success">Agregar coordinador</a>
        </div>

    </div>

</div>

@if (Session::has('success-email-store'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>coordinador Agregado</strong></h4>
                    <p>Se agrego el nombre de la carrera "{{Session::get('success-email-store')}}"</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@if (Session::has('success-email-update'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>coordinador modificado</strong></h4>
                    <p>Se amodifico el nombre de la carrera "{{Session::get('success-email-update')}}"</p>
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
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coordinadores as $coordinador)
                            <tr>
                                <th scope="row">{{$coordinador->id}}</th>
                                <td class="align-middle">{{$coordinador->name}}</td>
                                <td class="align-middle">{{$coordinador->apaterno}} {{$coordinador->amaterno}}</td>
                                <td class="align-middle">{{$coordinador->carrera->nombre}}</td>
                                <td class="align-middle">
                                    {{-- <a href="{{route("admin.delete.coordinador", $coordinador->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}
                                    {{-- <a href="#" onclick="document.getElementById('destroy-coordinador-{{ $coordinador->id }}').submit()"> --}}
                                    {{-- <a href="#" onclick="deleteCoordinador({{$coordinador->id}})">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}

                                    <span>
                                        <button type="button" class="btn btn-danger" onclick="deleteCoordinador({{$coordinador->id}})">
                                            <i class="bi bi-trash-fill"></i>
                                            Eliminar
                                        </button>
                                    </span>

                                    <form class="d-none" id="destroy-coordinador-{{ $coordinador->id }}" action="{{ route('admin.coordinadores.destroy', $coordinador->id) }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    </form>

                                    <a href="{{route('admin.coordinadores.edit',$coordinador->id)}}">
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
        let deleteCoordinador = (coordinadorid) => {
            

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
                        let form = document.getElementById('destroy-coordinador-'+coordinadorid)
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