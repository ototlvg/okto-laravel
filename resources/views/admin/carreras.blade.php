@extends('layouts.admin')

@section('container')
    <div class="container">

    
        <div class="row mt-3">
            <div class="h3 col align-items-center d-flex">Carreras</div>
            <div class="col justify-content-end d-flex">
                <a href="{{route("admin.showAgregar")}}" class="btn btn-success">Agregar carrera</a>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No. Control</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carreras as $carrera)
                            <tr>
                                <th scope="row">{{$carrera->id}}</th>
                                <td>{{$carrera->nocontrol}}</td>
                                <td>{{$carrera->nombre}}</td>
                                <td>
                                    <a href="#">
                                        <span class="material-icons">delete</span>
                                    </a>
                                    <a href="{{route("admin.showCarrera", $carrera->id)}}">
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