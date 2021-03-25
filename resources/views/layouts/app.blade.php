<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

    @yield('style-area')
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Alumno</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-lg-between">
                        
                        @auth('web')
                            <div class="left d-lg-flex flex-wrap">
                                <li class="nav-item">
                                    {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                                    <a class="nav-link" href="{{route("home")}}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route("alumno.areas.index")}}">Areas</a>
                                </li>
                            </div>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route("login")}}">Iniciar sesion</a>
                            </li>
                        @endauth
    
                        <div class="right">
                            @auth('web')
                                <div class="nav-item">
                                    {{-- <a class="nav-link" href="{{route("coordinador.logout")}}">Logout</a> --}}
                                    <a class="nav-link" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                
                            @endauth
                        </div>
    
                    </ul>
                </div>
            </div>
        </nav>

        <main class="my-4 w-100">
            @yield('content')
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>
</body>
</html>