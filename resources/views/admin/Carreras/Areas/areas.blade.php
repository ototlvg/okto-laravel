@extends('layouts.admin')


@section('container')
<div class="container">
    {{-- <h1>{{$areascount}}</h1> --}}
    <div class="row">

        <div class="col-12">
            <h2 class="row m-0 mt-3 mb-3">
                <div class="col pl-0">Areas - {{$carrera->nombre}}</div>
                @if ($areascount < 3)
                    <div class="col d-flex justify-content-end pr-0">
                        <a href="{{route('admin.carreras.area.agregar', $carreraid)}}" class="btn btn-success m0">Agregar area</a>
                    </div>     
                @endif
            </h2>

        </div>

    </div>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Area</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <th scope="row">{{$area->id}}</th>
                            <td>{{$area->nombre}}</td>
                            <td>
                                <a href="#">
                                    <span class="material-icons text-danger pointer">remove_circle</span>
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