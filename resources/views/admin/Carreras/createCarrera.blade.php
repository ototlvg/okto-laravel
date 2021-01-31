@extends('../../layouts.admin')

@section('container')
    <div class="container mt-5">
        <div class="row d-flex justify-content-center">
            <div class="col-4">
                <form class="w-100" method="POST" action="{{route('admin.carreras.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre de la carrera</label>
                        <input name="carrera" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre de la carrera" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Numero de Control</label>
                        <input name="nocontrol" type="text" class="form-control" id="exampleInputPassword1" placeholder="Ingresa numero de control" required>
                        @if ($errors->any())
                            <p>{{$errors->all()[0]}}</p>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form>
            </div>
        </div>
        

    </div>
@endsection