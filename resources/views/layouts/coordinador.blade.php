<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coordinador Layout</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <style>
        .body{
            min-height: 100vh;
        }
    </style>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @yield('style-area')

</head>
<body class="d-flex flex-column body">

    {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="#">Coordinador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.profesores.index")}}">Profesores</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.preguntas.index")}}">Preguntas</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.areas.index")}}">Areas</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.logout")}}">Logout</a>
                </li>
            </ul>
        </div>
    </nav> --}}

    
    
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-danger w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Coordinador</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-lg-between">

                    <div class="left d-lg-flex flex-wrap">
                        <li class="nav-item">
                            {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                            <a class="nav-link" href="{{route("coordinador.profesores.index")}}">Profesores</a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="#">Link</a> --}}
                            <a class="nav-link" href="{{route("coordinador.areas.index")}}">Areas</a>
                        </li>
                    </div>

                    <div class="right">
                        <div class="nav-item">
                            <a class="nav-link" href="{{route("coordinador.logout")}}">Logout</a>
                        </div>
                    </div>

                </ul>
            </div>
        </div>
    </nav>

    <main class="main flex-grow-1">
        @yield('container')
    </main>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @yield('script-area')
</body>
</html>