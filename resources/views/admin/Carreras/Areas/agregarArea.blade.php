@extends('layouts.admin')

@section('style-area')
    <style>
        .loco{
            background: red !important;
        }

        .admin_container_body{
            background-color: #f2f2f0 !important;
            border: none !important;
        }
    </style>
@endsection

@section('body')
        <div class="row d-flex justify-content-center">
            <div class="col-4 p-5 bg-white border">
                <form class="w-100" method="POST" action="{{route('admin.carreras.areas.store')}}">
                    @csrf
                    <div class="form-group mb-4">
                        <label for="exampleInputEmail1" class="mb-2">Nombre del area</label>
                        <input name="nombre" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ingenieria mecatronica" required>

                        <input class="d-none" type="number" name="carreraid" value="{{$carreraid}}">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Guardar</button>
                </form>
            </div>
        </div>
        
@endsection