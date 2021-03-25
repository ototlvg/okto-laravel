@extends('layouts.profesor')

@section('style-area')
    <style>
        
    </style>
@endsection

@section('container')
    <div class="container">
        <div class="row">
            <div class="col">
                <p>{{$profesor->name}}</p>
            </div>
        </div>
    </div>
@endsection