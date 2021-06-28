<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profesor Layout</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    <style>
        .body{
            min-height: 100vh;
        }
        .bg-uabc{
            background-color: #00873c !important;
        }

        img{
            max-width: 100%;
        }

        .logo-uabc{
            max-width: 100%;
        }

        #Capa_1{
            max-width: 100%;
            fill: white;
            /* width: 50%; */
            width: 150px;

        }

        .container-logo{
            /* width: 45%; */
            /* padding: 0.2em; */
            margin-right: 0.8em;
            display: flex;
            align-content: center;
        }
        .subtitle{
            font-size: 9px;
            margin: 0;
            margin-top: 2px;
            letter-spacing: 12px;
            width: 100%;
            text-align: center;
        }

        .navbar{
            border-bottom: 5px solid #f1a631;
        }
        
        body{
            background-color: #f2f2f0
        }

        .container{
            max-width: 700px !important;
        }
    </style>
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}

    @yield('style-area')
    @stack('style')

</head>
<body class="d-flex flex-column body">
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-uabc text-white w-100">
        <div class="container-fluid p-0 px-3">


            <div class="container-logo">
                <a class="navbar-brand m-0" href="{{route('home')}}">
                    @include('svg.logo')
                    {{-- <p class="m-0 fs-5">CENEVAL</p> --}}
                    <p class="subtitle">PROFESOR</p>
                    {{-- <img class="logo-uabc" src="{{asset('assets/img/uabc-logo-gray')}}" alt=""> --}}
                </a>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-lg-between">
                    
                    @auth('profesor')
                        <div class="left d-lg-flex flex-wrap">
                            <li class="nav-item">
                                {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                                <a class="nav-link" href="{{route("profesor.carreras.index")}}">Carreras</a>
                            </li>
                            <li class="nav-item">
                                {{-- <a class="nav-link" href="#">Link</a> --}}
                                <a class="nav-link" href="{{route("profesor.perfil.index")}}">Perfil</a>
                            </li>
                        </div>
                    @else
                        <li class="nav-item">
                            <a class="nav-link active" href="{{route("login")}}">Iniciar sesion</a>
                        </li>
                    @endauth

                    <div class="right">
                        @auth('profesor')
                            <div class="nav-item">
                                <a class="nav-link" href="{{route("profesor.logout")}}">Logout</a>
                            </div>
                        @endauth
                    </div>

                </ul>
            </div>
        </div>
    </nav>

    <main class="main flex-grow-1 container my-5 border bg-white p-5">
        @yield('container')
    </main>

    <!-- Scripts -->
    
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    @yield('script-area')
    @stack('script')
</body>
</html>