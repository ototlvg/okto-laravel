<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Layouts</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @yield('style-area')

</head>
<body>
    {{-- w-100 d-flex justify-content-lg-between flex-wrap --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="{{route("admin.carreras.index")}}">Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav w-100 d-flex justify-content-lg-between">
                <div class="d-lg-flex">
                    @auth('admin')
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route("admin.carreras.index")}}">Carreras</a>
                        </li>
        
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route("admin.coordinadores.index")}}">Coordinadores</a>
                        </li>
        
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route("admin.profesores.index")}}">Profesores</a>
                        </li>
        
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.alumnos.index')}}">Alumnos</a>
                        </li>
                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.login')}}">Iniciar sesion</a>
                        </li>
                    @endauth
                </div>

                <div class="d-lg-flex">
                    @auth('admin')
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route("admin.logout")}}">Logout</a>
                        </li>
                    @endauth
                </div>
            </ul>
        </div>
    </nav>

    @yield('container')


      <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script-area')
</body>
</html>