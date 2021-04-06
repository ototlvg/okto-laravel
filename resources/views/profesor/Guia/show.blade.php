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

        .profile-icon{
            width: 40px;
            height: 40px;
            background-color: tomato;
            display: flex;
            border-radius: 50%;
            flex-grow: 0;
            flex-shrink: 0;
            justify-content: center;
            align-items: center;
            margin-right: 10px;
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
    <div class="row">
        <div class="col">
            <form action="{{route('profesor.guia.comentario.store')}}" class="d-flex" method="POST">
                @csrf
                {{-- <div class="profile-icon">
                    <span>P</span>
                </div> --}}
                <input type="number" name="postid" value="{{$post->id}}" class="d-none">
                <textarea name="comment" class="form-control" name="" id="" cols="30" rows="1" required></textarea>
                <button type="submit" class="btn btn-success ms-3">Guardar</button>
            </form>
            
        </div>
    </div>
@endsection

@push('script')
    <script>
        
    </script>
@endpush