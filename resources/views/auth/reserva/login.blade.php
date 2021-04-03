<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="{{asset('css/normalize.css')}}"> --}}
    <style>
        @media (min-width: 992px) { 
            .flex-lg-grow-3{
                flex-grow: 3 !important;
            }
         }

         #Capa_1{
             width: 80%;
             fill:white;
         }

        .bg-uabc{
            background-color: #00873c !important;
        }

        .grid-container{
            min-height: 100vh;
            /* background-color: red; */
            display: grid;
            grid-template-rows: 0.1fr 1fr;
            grid-template-columns: 1fr;
        }

        .grid-item--top{
            padding: 3em;
            display: flex;
            justify-content: center;
            width: 100%;
            
        }

        .grid-item--body{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 4em;
        }

        @media (min-width: 992px) { 
            .grid-item--body{
                padding: 10em;
            }
        }


        @media (min-width: 992px) { 
            .grid-container{
                /* background-color: red; */
                grid-template-rows: 1fr;
                grid-template-columns: 0.5fr 1fr;
            }
        }

        .version-user{
            letter-spacing: 16px
        }

        .title-software{
            letter-spacing: 1px
        }

        /* @include('svg.logo') */
    </style>
</head>

    <div class="grid-container">

        <div class="grid-item grid-item--top bg-uabc">
            {{-- <p>S</p> --}}
            <div class="w-100 d-flex justify-content-center align-items-center align-content-center flex-column">
                @include('svg.logo')
                <p class="m-0 mt-2 text-white title-software">SOFTARE DE SIMULACION CENEVAL</p>
                <p class="m-0 mt-3 text-white version-user">ALUMNO</p>
            </div>
        </div>

        <div class="grid-item grid-item--body d-flex flex-wrap">
            <h1 class="w-100 text-secondary">Iniciar sesion</h1>
            {{-- {{  str_replace("@uabc.edu.mx", "",old('email')) }} --}}
            <form class="w-100" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="matricula" class="form-label">Matricula</label>
                    {{-- <input type="number" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="matricula" name="email" required> --}}
                    <input type="number" class="form-control @error('email') is-invalid @enderror" value="{{ str_replace("@uabc.edu.mx", "",old('email')) }}" id="matricula" name="email" required>
                    <div id="emailHelp" class="form-text">Ingresa tu matricula escolar</div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- <div class="mb-3 form-check">
                  <input type="checkbox" class="form-check-input" id="exampleCheck1">
                  <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div> --}}
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>

    </div>

{{-- https://stackoverflow.com/questions/30058556/including-svg-contents-in-laravel-5-blade-template --}}
<body>
    

    
</body>
</html>