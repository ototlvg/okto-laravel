@extends('layouts.coordinador')

@section('container')
{{-- {{$coordinador}} --}}
    <div class="container">
        <div id="app">
            <p>Coco</p>
        </div>
    </div>
@endsection

@section('script-area')
    {{-- <script>
        window.carreraid = {!! json_encode($coordinador->carrera_id) !!};
    </script> --}}
    <script src="{{asset('js/preguntas.js')}}"></script>
@endsection