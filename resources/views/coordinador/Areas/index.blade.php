@extends('layouts.coordinador')

@section('container')
{{-- {{$coordinador}} --}}
    <div class="container">
        @foreach ($areas as $area)
            {{-- <p>{{$area->nombre}}</p>    --}}
            <a href="{{route('coordinador.areas.edit',$area->id)}}">{{$area->nombre}}</a>
        @endforeach
        

        
    </div>
@endsection

@section('script-area')
    {{-- <script>
        window.carreraid = {!! json_encode($coordinador->carrera_id) !!};
    </script> --}}
    {{-- <script src="{{asset('js/preguntas.js')}}"></script> --}}
@endsection