@extends('layouts.admin')

@section('header')
    
<div class="row">

    <div class="col-12 d-flex justify-content-between align-items-center">

        <div>
            <h1 class="m-0">Areas</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb  m-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.carreras.index')}}">Carreras</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Areas</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$carrera->nombre}}</li>
                </ol>
            </nav>
        </div>

        <div>
            @if ($areascount < 3)
                <a href="{{route('admin.carreras.areas.create', ['carreraid' => $carreraid])}}" class="btn btn-success">Agregar area</a>        
            @endif
        </div>

    </div>

</div>

@endsection


@section('body')

    {{-- <div class="row">

        <div class="col-12">
            <h2 class="row">
                <div class="col pl-0">Areas - {{$carrera->nombre}}</div>
                @if ($areascount < 3)
                    <div class="col d-flex justify-content-end pr-0">
                        <a href="{{route('admin.carreras.areas.create', ['carreraid' => $carreraid])}}" class="btn btn-success m0">Agregar area</a>
                    </div>
                @endif
            </h2>

        </div>

    </div> --}}

    <div class="row">
        <div class="col-12">
            <table class="table table-borderless table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Area</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($areas as $area)
                        <tr>
                            <th class="align-middle" scope="row">{{$area->id}}</th>
                            <td class="align-middle">{{$area->nombre}}</td>
                            <td class="align-middle">
                                {{-- <a href="#" onclick="deleteArea({{$area->id}})">
                                    <span class="material-icons text-danger pointer">remove_circle</span>
                                </a> --}}
                                <span>
                                    <button type="button" class="btn btn-danger" onclick="deleteArea({{$area->id}})">
                                        <i class="bi bi-trash-fill"></i>
                                        Eliminar
                                    </button>
                                </span>
                                <form onclick="" class="d-none" action="{{route('admin.carreras.areas.destroy',$area->id)}}" id="area_delete_{{$area->id}}" method="POST">
                                    @method('delete')
                                    @csrf
                                    {{-- <input type="number" name="areaid" value="{{$a rea->id}}"> --}}
                                </form>


                                <span>
                                    <button type="button" class="btn btn-primary" onclick="updateName({{$area->id}},'{{$area->nombre}}')">
                                        <i class="bi bi-pencil-square"></i>
                                        Editar
                                    </button>
                                </span>


                                {{-- <a href="#">
                                    <span class="material-icons edit pointer" onclick="updateName({{$area->id}},'{{$area->nombre}}')">remove_circle</span>
                                </a> --}}
                                {{-- <p>{{$area->id}}</p> --}}
                                <form class="d-none" action="{{route('admin.carreras.areas.update',$area->id)}}" id="area_{{$area->id}}" method="POST">
                                    @method('put')
                                    @csrf
                                    {{-- <input type="number" name="areaid" value="{{$area->id}}"> --}}
                                </form>
                            </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

@endsection

@push('script')
    <script src="{{asset('js/sweetalert2.js')}}"></script>
@endpush

@push('script')
    <script>
        let updateName = (areaid,name) => {
            console.log(areaid)
            console.log(name)
            

            let form = document.getElementById('area_'+areaid)

            console.log(form)

            Swal.fire({
                
            title: 'Editar nombre',
            input: 'text',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            inputValue: name,
            confirmButtonText: 'Look up',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                console.log('payaso')
                console.log(login)

                if(login == ''){
                    return false
                }

                let el = document.createElement("input");
                el.name = 'newname'
                el.value = login

                form.appendChild(el);

                form.submit()



                // return fetch(`//api.github.com/users/${login}`)
                // .then(response => {
                //     if (!response.ok) {
                //     throw new Error(response.statusText)
                //     }
                //     return response.json()
                // })
                // .catch(error => {
                //     Swal.showValidationMessage(
                //     `Request failed: ${error}`
                //     )
                // })
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                // if (result.isConfirmed) {
                //     Swal.fire({
                //     title: `${result.value.login}'s avatar`,
                //         imageUrl: result.value.avatar_url
                //     })
                // }
            })
        }

        let deleteArea = (areaid) => {
            console.log(areaid)

            Swal.fire(
                {
                    title: '¿Estas seguro?',
                    text: "El area asi como los estudiantes asociados seran eliminados sin la posibilidad de poder recuperarlos",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('area_delete_'+areaid)
                        console.log(form)
                        form.submit()

                        // Swal.fire(
                        //     'Deleted!',
                        //     'Your file has been deleted.',
                        //     'success'
                        // )
                }
            })

            // let form = document.getElementById('area_delete_'+areaid)
            // console.log(form)
            // form.submit()
        }
    </script>
@endpush