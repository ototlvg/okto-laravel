@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Editar carrera</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.carreras.index')}}">Carreras</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Editar</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$carrera->nombre}}</li>
                </ol>
            </nav>
        </div>

        {{-- <div>
            <a href="{{route("admin.carreras.create")}}" class="btn btn-success">Agregar carrera</a>
        </div> --}}

    </div>

</div>

@endsection


@section('body')
    
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- <p>{{$carrera}}</p> --}}

        <form action="{{route('admin.carreras.update',$carrera->id)}}" method="POST">
            @csrf
            @method('put')
            <input required type="text" name="name" id="" class="form-control" value="{{ empty( old('name') ) ? $carrera->nombre : old('name') }}">
            <input required type="number" name="carrera" id="" class="form-control d-none" value="{{ empty( old('carrera') ) ? $carrera->carrera : old('carrera') }}">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    
@endsection