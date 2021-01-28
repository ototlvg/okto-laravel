@extends('layouts.admin')

@section('container')
    <div class="container">

    
        <div class="row mt-3">
            <div class="h3 col align-items-center d-flex">Profesores</div>
            <div class="col justify-content-end d-flex">
                {{-- <a href="{{route("profesorescrud.index")}}" class="btn btn-success">Agregar profesor</a> --}}
                <a href="{{route("admin.profesores.create")}}" class="btn btn-success">Agregar profesor</a>
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
                        @foreach ($profesores as $profesor)
                            <tr>
                                <th scope="row">{{$profesor->id}}</th>
                                <td>{{$profesor->name}}</td>
                            <td>{{$profesor->apaterno}} {{$profesor->amaterno}}</td>
                                <td>
                                    {{-- <a href="{{route("admin.profesores.destroy", $profesor->id)}}">
                                        <span class="material-icons text-danger">delete</span>
                                    </a> --}}

                                    <a href="#" onclick="document.getElementById('destroy-profesor-{{ $profesor->id }}').submit()">
                                        <span class="material-icons text-danger">delete</span>
                                    </a>
                                    <form class="d-none" id="destroy-profesor-{{ $profesor->id }}" action="{{ route('admin.profesores.destroy', $profesor->id) }}" method="POST">
                                       @csrf
                                       @method('delete')
                                    </form>


                                    <a href="{{route("admin.profesores.edit", $profesor->id)}}">
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