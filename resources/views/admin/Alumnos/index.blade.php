@extends('layouts.admin')

@section('container')
    <form action="{{route('admin.alumnos.excel')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <button type="submit">Enviar</button>
    </form>
@endsection