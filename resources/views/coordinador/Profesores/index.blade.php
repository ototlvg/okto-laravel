@extends('layouts.coordinador')

@section('style-area')
    {{-- <style>
        .wrapper{
            min-height: 100vh;
            max-width: 1020px;
            margin: 0 auto;
        }
    </style> --}}
@endsection

@section('container')
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