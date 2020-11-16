@extends('layouts.admin')

@section('container')
    <div class="container">

    
        <div class="row mt-3">
            <div class="h3 col align-items-center d-flex">Coordinadores</div>
            <div class="col justify-content-end d-flex">
                <a href="{{route("crud.index")}}" class="btn btn-success">Agregar coordinador</a>
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
                                    <a href="{{route("admin.delete.coordinador", $coordinador->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a>
                                    <a href="#">
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