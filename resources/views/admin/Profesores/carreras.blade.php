@extends('layouts.admin')

@section('body')
    <div id="app">

    </div>
@endsection

@section('script-area')
    <script>
        window.profesorid = {!! json_encode($profesorid) !!};
    </script>
    <script src="{{asset('js/carreras.js')}}"></script>
@endsection