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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    @yield('style-area')

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
        <a class="navbar-brand" href="#">Coordinador</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.profesores.index")}}">Profesores<span class="sr-only">(current)</span></a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.preguntas.index")}}">Preguntas<span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{route("coordinador.logout")}}">Logout<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    @yield('container')


      <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    @yield('script-area')
</body>
</html>