@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Carreras</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    {{-- <li class="breadcrumb-item"><a href="{{route('admin.alumnos.index')}}">Alumnos</a></li> --}}
                    <li class="breadcrumb-item active" aria-current="page">Carreras</li>
                </ol>
            </nav>
        </div>

        <div>
            <a href="{{route("admin.carreras.create")}}" class="btn btn-success">Agregar carrera</a>
        </div>

    </div>

</div>

@if (Session::has('created'))
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Carrera agregada</strong></h4>
                    <p>Carrera "{{Session::get('created')}}" agregada</p>
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('body')
        <div class="row mt-3">
            <div class="col">
                <table class="table table-hover table-borderless">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Carrera</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carreras as $carrera)
                            <tr>
                                <th scope="row">{{$carrera->id}}</th>
                                <td>{{$carrera->carrera}}</td>
                                <td>{{$carrera->nombre}}</td>
                                <td class="align-middle">

                                    
                                    
                                    {{-- <a href="#" onclick="document.getElementById('destroy-carrera-{{ $carrera->id }}').submit()"> --}}
                                    <a href="#" onclick="destroyCarrera({{ $carrera->id }})">
                                        {{-- <span class="material-icons text-danger">delete</span> --}}
                                        <button type="button" class="btn btn-danger btn-sm">Eliminar</button>
                                    </a>
                                    
                                    
                                    <form class="d-none" id="destroy-carrera-{{ $carrera->id }}" action="{{ route('admin.carreras.destroy', $carrera->id) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                    </form>




                                    {{-- <a href="{{route("admin.carreras.areas.show", $carrera->id)}}">
                                            <span class="material-icons">create</span>
                                    </a> --}}
                                    <a href="{{route("admin.carreras.areas.index", ['carreraid'=>$carrera->id])}}">
                                        <button type="button" class="btn btn-primary btn-sm">Areas</button>
                                    </a>

                                    <a href="{{route('admin.carreras.edit', $carrera->id)}}">
                                        <button type="button" class="btn btn-primary btn-sm">Editar</button>
                                    </a>

                                    
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
        let destroyCarrera = (carreraid) => {
            console.log(carreraid)
            let form = document.getElementById(`destroy-carrera-${carreraid}`)

            // Swal.fire('Any fool can use a computer')
            Swal.fire({
                title: '¿Eliminar carrera?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Eliminar`,
                // denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit()
                // Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
            })

            // console.log(form)
        }
    </script>
@endpush