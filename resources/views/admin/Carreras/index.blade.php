@extends('layouts.admin')

@section('container')
    <div class="container">

    
        <div class="row mt-3">
            <div class="h3 col align-items-center d-flex">Carreras</div>
            <div class="col justify-content-end d-flex">
                <a href="{{route("admin.carreras.create")}}" class="btn btn-success">Agregar carrera</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table">
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
                                <td>
                                    {{-- <a href="{{route("admin.deleteCarrera", $carrera->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}

                                    <a href="#" onclick="document.getElementById('destroy-carrera-{{ $carrera->id }}').submit()">
                                        <span class="material-icons text-danger">delete</span>
                                    </a>
                                    <form class="d-none" id="destroy-carrera-{{ $carrera->id }}" action="{{ route('admin.carreras.destroy', $carrera->id) }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    </form>

                                    {{-- <a href="{{route("admin.carreras.areas.show", $carrera->id)}}">
                                            <span class="material-icons">create</span>
                                    </a> --}}
                                    <a href="{{route("admin.carreras.areas.index", ['carreraid'=>$carrera->id])}}">
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