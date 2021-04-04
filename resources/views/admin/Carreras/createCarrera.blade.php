@extends('../../layouts.admin')

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

        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form class="w-100" method="POST" action="{{route('admin.carreras.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de la carrera</label>
                        <input name="carrera" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre de la carrera" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Numero de Control</label>
                        <input name="nocontrol" type="text" class="form-control" id="exampleInputPassword1" placeholder="Ingresa numero de control" required>
                        @if ($errors->any())
                            <p>{{$errors->all()[0]}}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
        

    
@endsection