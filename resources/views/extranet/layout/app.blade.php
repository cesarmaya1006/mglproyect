<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/sistema/logo_peque.png') }}">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('admilte/dist/css/adminlte.css')}}" />
    <title>MGL - Tech</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @endif
    <style>
        label{
            font-size: 0.8em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="row">
        <div class="col-12">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="{{route('extranet.index')}}">
                                    <img src="{{asset('imagenes/sistema/mgl_logo.png')}}" alt="" width="30" height="24">
                                </a>
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" href="{{route('extranet.index')}}">Inicio</a>
                                        </li>
                                    </ul>
                                    <a class="nav-link" href="#" style="margin-right: 10px;">Acceso</a>
                                    <a class="nav-link" href="{{route('extranet.registro')}}" style="margin-right: 10px;">Registrarse</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row" style="background-image: url('{{asset('imagenes/sistema/fondo1.png')}}');">
                    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.85);min-height: 92vh;">@yield('cuerpoPagina')</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
