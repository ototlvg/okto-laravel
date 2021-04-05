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
             fill:#00873c;
         }

        .bg-uabc{
            background-color: #00873c !important;
        }

        .text-uabc{
            color: #00873c;
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

        <div class="grid-item grid-item--top bg-white">
            {{-- <p>S</p> --}}
            <div class="w-100 d-flex justify-content-center align-items-center align-content-center flex-column">
                @include('svg.logo')
                <p class="m-0 mt-2 text-dark title-software">SOFTARE DE SIMULACION CENEVAL</p>
                <p class="m-0 mt-3 text-dark version-user">ADMIN</p>
            </div>
        </div>

        <div class="grid-item grid-item--body d-flex flex-wrap bg-uabc">
            <h1 class="w-100 text-white">Iniciar sesion</h1>
            {{-- {{  str_replace("@uabc.edu.mx", "",old('email')) }} --}}
            <form class="w-100" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="mb-3">
                    <label for="matricula" class="form-label text-white">Correo</label>
                    {{-- <input type="number" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="matricula" name="email" required> --}}
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    <div id="emailHelp" class="form-text text-dark">Ingresar correo</div>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-white">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="form-check-label text-white" for="remember">
                    {{ __('Recuerdame') }}
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
            </form>
        </div>

    </div>

{{-- https://stackoverflow.com/questions/30058556/including-svg-contents-in-laravel-5-blade-template --}}
<body>
    

    
</body>
</html>