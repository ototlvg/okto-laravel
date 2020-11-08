@extends('layouts.admin')

@section('container')
    <div class="container">
        <div id="app">

        </div>
    </div>
@endsection

@section('script-area')
    <script>
        window.profesorid = {!! json_encode($profesorid) !!};
    </script>
    <script src="{{asset('js/carreras.js')}}"></script>
@endsection