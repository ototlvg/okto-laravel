@extends('layouts.profesor')

@push('style')
    <style>
        .container{
            max-width: 700px !important;
        }

        .formatear{
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }
    </style>
@endpush

@section('container')
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header bg-secondary text-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-wrap flex-column">
                            <strong>{{$post->tema}}</strong>
                            <p class="m-0 fs-s">{{ date('d-M-y', strtotime($post->updated_at)) }}</p>
                        </div>
                        <div class="d-flex">
                            {{-- <a class="btn btn-primary btn-sm me-1" href="{{route('profesor.guia.show',$post->id)}}" role="button"> <i class="bi bi-eye-fill"></i> </a> --}}
                            <a class="btn btn-primary btn-sm me-1" href="{{route('profesor.guia.edit',$post->id)}}" role="button"> <i class="bi bi-pencil-square"></i> </a>
                            <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </div>
                    {{-- Featured --}}
                </div>
                <div class="card-body">
                    {{-- <p class="card-text">{{$post->descripcion}}</p> --}}

                    <pre class="formatear"><p class="m-0">{{$post->descripcion}}</p></pre>
                </div>
            </div>
        </div>
    </div>
@endsection