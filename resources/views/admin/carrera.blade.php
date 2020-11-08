@extends('layouts.admin')

@section('container')
    <div class="container">
        <h2 class="row m-0 mt-3 mb-3">
            <div class="col pl-0">Areas - {{$carrera->nombre}}</div>
            <div class="col d-flex justify-content-end pr-0"><button type="button" class="btn btn-success m0">Agregar area</button></div>
        </h2>

        <div id="app">

        </div>
    </div>
@endsection

@section('script-area')
    <script>
        
        window.carrera = {!! json_encode($carrera) !!};
        /* console.log(window.carrera) */

    </script>
    <script src="{{ asset('js/carrera.js') }}" defer></script>
@endsection