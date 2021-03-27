@extends('layouts.admin')

@section('container')
    <div class="container">

    
        <div class="row mt-3">
            <div class="h3 col align-items-center d-flex">Coordinadores</div>
            <div class="col justify-content-end d-flex">
                <a href="{{route("admin.coordinadores.create")}}" class="btn btn-success">Agregar coordinador</a>
            </div>
        </div>

        <div class="row">
            <div class="col">
                @if ( session()->has( 'success-email-update' ) )
                    El usuario con correo {{session()->get( 'success-email-update' )}} a sido modificado
                @endif

                @if ( session()->has( 'success-email-store' ) )
                    El usuario con correo {{session()->get( 'success-email-store' )}} a sido creado
                @endif


            </div>
        </div>

        <div class="row mt-3">
            <div class="col">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Carrera</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coordinadores as $coordinador)
                            <tr>
                                <th scope="row">{{$coordinador->id}}</th>
                                <td>{{$coordinador->name}}</td>
                            <td>{{$coordinador->apaterno}} {{$coordinador->amaterno}}</td>
                                <td>
                                    {{-- <a href="{{route("admin.delete.coordinador", $coordinador->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}
                                    {{-- <a href="#" onclick="document.getElementById('destroy-coordinador-{{ $coordinador->id }}').submit()"> --}}
                                    <a href="#" onclick="deleteCoordinador({{$coordinador->id}})">
                                        <span class="material-icons text-danger">delete</span>
                                    </a>
                                    <form class="d-none" id="destroy-coordinador-{{ $coordinador->id }}" action="{{ route('admin.coordinadores.destroy', $coordinador->id) }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    </form>

                                    <a href="{{route('admin.coordinadores.edit',$coordinador->id)}}">
                                        <span class="material-icons">create</span>
                                    </a>

                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
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