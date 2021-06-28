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

    {{-- {{$post->area->id}} --}}

    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center bg-white"">
                <div>
                    <h5 class="card-title fs-3">{{$post->tema}}</h5>


                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('profesor.carreras.index')}}">{{$post->area->carrera->nombre}}</a></li>
                            {{-- <li class="breadcrumb-item"><a href="{{route('profesor.guia.index')}}">{{$post->area->nombre}} </a></li> --}}
                            <li class="breadcrumb-item"><a href="{{route('profesor.guia.index', ['area' => $post->area->id])}}">{{$post->area->nombre}} </a></li>
                            <li class="breadcrumb-item active" aria-current="page">Guia</li>
                        </ol>
                    </nav>

                </div>
    
                <div class="d-flex">
                    <a class="btn btn-primary me-1" href="{{route('profesor.guia.edit',$post->id)}}" role="button"> <i class="bi bi-pencil-square"></i> </a>
                    <button type="button" class="btn btn-danger" onclick="destroyPost({{ $post->id }})"><i class="bi bi-trash-fill"></i></button>
                    
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="row">
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header bg-secondary text-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-wrap flex-column">
                            <strong>{{$post->tema}}</strong>
                            <p class="m-0 fs-s">{{ date('d-M-y', strtotime($post->updated_at)) }}</p>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-primary btn-sm me-1" href="{{route('profesor.guia.edit',$post->id)}}" role="button"> <i class="bi bi-pencil-square"></i> </a>
                            <button type="button" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></button>
                        </div>  
                    </div>
                </div>
                <div class="card-body">

                    <pre class="formatear"><p class="m-0">{{$post->descripcion}}</p></pre>
                </div>
            </div>
        </div>
    </div> --}}


    <div class="row mb-4">
        <div class="col">
            <textarea name="" id="" cols="30" rows="5" disabled class="form-control">{{$post->descripcion}}</textarea>
        </div>
    </div>

    <form class="d-none" id="destroy-post-{{ $post->id }}" action="{{ route('profesor.guia.destroy', $post->id) }}" method="POST">
        @csrf
        @method('delete')
    </form>


    <div class="row">
        <div class="col">
            <form action="{{route('profesor.guia.comentario.store')}}" class="d-flex" method="POST">
                @csrf
                <input type="number" name="postid" value="{{$post->id}}" class="d-none">
                <textarea name="comment" class="form-control" name="" id="" cols="30" rows="1" required></textarea>
                <button type="submit" class="btn btn-success ms-3">Agregar</button>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="{{asset('js/sweetalert2.js')}}"></script>
@endpush

@push('script')
    <script>
        let destroyPost = (postid) => {
            console.log(postid)
            let form = document.getElementById(`destroy-post-${postid}`)

            // Swal.fire('Any fool can use a computer')
            Swal.fire({
                title: '¿Eliminar post?',
                // showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: `Eliminar`,
                // denyButtonText: `Don't save`,
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                form.submit()
                // Swal.fire('Saved!', '', 'success')
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
            })

            // console.log(form)
        }
    </script>
@endpush