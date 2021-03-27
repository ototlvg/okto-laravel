@extends('layouts.admin')

@section('container')
    <main class="container">

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
    </main>
@endsection