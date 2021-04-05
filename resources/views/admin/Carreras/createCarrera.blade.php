@extends('../../layouts.admin')

@push('style')
    <style>
        .container{
            max-width: 500px !important;
        }
    </style>
@endpush

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Agregar carrera</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.carreras.index')}}">Carreras</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Agregar</li>
                </ol>
            </nav>
        </div>

        {{-- <div>
            <a href="{{route("admin.carreras.create")}}" class="btn btn-success">Agregar carrera</a>
        </div> --}}

    </div>

</div>

@if ($errors->any())
    <div class="row mt-4">
        <div class="col-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <div>
                    <h4><strong>Problemas encontrados</strong></h4>
                    {{-- <p>Los alumnos con las siguientes matriculas no han sido agregados:</p> --}}
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>       
                </div>

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
@endif

@endsection

@section('body')

        <div class="row d-flex">
            <div class="col-12">
                <form class="w-100" method="POST" action="{{route('admin.carreras.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="mb-2">Nombre de la carrera</label>
                        <input name="carrera" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre de la carrera" required>
                    </div>
                    <div class="form-group mb-4">
                        <label for="exampleInputPassword1" class="mb-2">Numero de Control</label>
                        <input name="nocontrol" type="number" class="form-control" id="exampleInputPassword1" placeholder="Ingresa numero de control" required>
                        @if ($errors->any())
                            <p>{{$errors->all()[0]}}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success w-100 p-2">Guardar</button>
                </form>
            </div>
        </div>
        

    
@endsection