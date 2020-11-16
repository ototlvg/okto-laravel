@extends('layouts.coordinador')

@section('container')
{{-- {{$coordinador}} --}}
    <div class="container">
        <div id="app">

        </div>
    </div>
@endsection

@section('script-area')
    <script>
        // window.coordinador = {!! json_encode($coordinador) !!};
        // window.coordinador = {!! json_encode($coordinador->carrera_id) !!};
        window.carreraid = {!! json_encode($coordinador->carrera_id) !!};
    </script>
    <script src="{{asset('js/profesores.js')}}"></script>
@endsection