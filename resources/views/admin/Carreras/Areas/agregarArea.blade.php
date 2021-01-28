@extends('layouts.admin')

@section('style-area')
    <style>
        .loco{
            background: red !important;
        }
    </style>
@endsection

@section('container')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form class="w-100" method="POST" action="{{route('admin.carreras.areas.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre del area</label>
                        <input name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ingenieria mecatronica" required>

                        <input class="d-none" type="number" name="carreraid" value="{{$carreraid}}">
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
    </div>
@endsection