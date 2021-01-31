@extends('layouts.admin')

@section('container')
        @if (Session::has('status'))
            <p>
                {{Session::get('status')}}
            </p>
        @endif

        @if (Session::has('duplicateStudents'))
            <p>Alumnos duplicados</p>
            @foreach (Session::get('duplicateStudents') as $item)
                <p class="m-0">Los siguientes alumnos no fueron agregados, ya existen en la base de datos</p>
                <p>Matricula: {{$item[0]}}</p>
            @endforeach
        @endif


        {{-- @error('name')
            <p>{{ $message }}</p>
        @enderror --}}

        {{-- @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach --}}

            
        @if ($errors->has('carreraInExcelButNotInDatabase'))
            <p>Estas carreras se encuentran en la hoja de calculo, pero aun no estan registradas en base de datos</p>
            <p>Ningun alumno de los que se acaban de tratar de subir a sido registrado</p>
            <p>{{$errors->get('carreraInExcelButNotInDatabase')[0]}}</p>
        @endif



    <form action="{{route('admin.alumnos.excel')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" id="">
        <button type="submit">Enviar</button>
    </form>
@endsection