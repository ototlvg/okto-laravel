@extends('layouts.coordinador')

@section('style-area')
    <style>
        .icon-survey{
            font-size: 8em !important;
        }
        .card-survey{
            /* width: 35%; */
            transition: all 0.3s;
        }

        .card-survey:hover{
            color: #0d6efd;
            border-color: #0d6efd;
        }

        .pointer{
            cursor: pointer;
        }

        .survey_title{
            /* height: 100px; */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .maximo{
            color: red !important;
        }
        .lelele{
            margin-top: 1em;
            margin-right: 1em !important;
        }
    </style>
@endsection

@section('container')
    <div class="container">
        {{-- @foreach ($areas as $area)
            <a href="{{route('coordinador.areas.edit',$area->id)}}">{{$area->nombre}}</a>
        @endforeach --}}
    </div>

    <div class="container">

        <div class="row mt-4">
            <div class="h3 col align-items-center d-flex m-0 justify-content-center">Areas</div>
        </div>
        
        <div class="row">
            <div class="w-100 d-flex">
                @foreach ($areas as $area)
                    <div class="d-flex justify-content-center w-100 lelele">
                        <div class="card card-survey p-3 flex-grow-1">
                            <div class="header w-100 text-center">
                                <i class="bi bi-eyeglasses icon-survey"></i>
                            </div>
                            <div class="card-body d-flex flex-wrap justify-content-center">
                                <p class="text-center survey_title w-100">{{$area->nombre}}</p>
                                
                                <a href="{{route('coordinador.areas.edit',$area->id)}}"><button type="button" class="btn btn-primary">Modificar</button></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

@endsection

@section('script-area')
    {{-- <script>
        window.carreraid = {!! json_encode($coordinador->carrera_id) !!};
    </script> --}}
    {{-- <script src="{{asset('js/preguntas.js')}}"></script> --}}
@endsection