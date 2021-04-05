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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

    <!-- Fonts -->
    {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">

    <style>
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
    </style>

    @yield('style-area')

    @stack('style')

</head>
<body>
    {{-- w-100 d-flex justify-content-lg-between flex-wrap --}}

    <nav class="navbar navbar-expand-lg navbar-dark bg-uabc text-white w-100">
        <div class="container-fluid p-0 px-3">


            <div class="container-logo">
                <a class="navbar-brand m-0" href="{{route('admin.carreras.index')}}">
                    @include('svg.logo')
                    {{-- <p class="m-0 fs-5">CENEVAL</p> --}}
                    <p class="subtitle">ADMIN</p>
                    {{-- <img class="logo-uabc" src="{{asset('assets/img/uabc-logo-gray')}}" alt=""> --}}
                </a>
            </div>


            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-lg-between">
                    
                    

                    @auth('admin')
                        <div class="left d-lg-flex flex-wrap">
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
                        </div>
                    @else
                        <li class="nav-item active">
                            <a class="nav-link" href="{{route('admin.login')}}">Iniciar sesion</a>
                        </li>
                    @endauth

                    <div class="right">
                        @auth('admin')
                            <div class="nav-item">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{route("admin.logout")}}">Logout</a>
                                </li>
                            </div>
                            
                        @endauth
                    </div>

                </ul>
            </div>
        </div>
    </nav>

    <main class="container pt-4">
        <div class="w-100 mb-4">
            @yield('header')
        </div>
        <div class="w-100 bg-white border p-4 admin_container_body">
            @yield('body')
        </div>
        {{-- @yield('body-manual') --}}
    </main>


      <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    @yield('script-area')

    @stack('script')

</body>
</html>