<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ asset('imagenes/sistema/logo_peque.png') }}">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>MGL - Tech</title>
    <style>
    label.requerido:after {
        content: ' *';
        color: red;
    }
    .form-control-sm{
        border: 1px solid black;
    }
    </style>
    @include('includes.tailwindcss')
    <style>
        label{
            font-size: 0.8em;
            font-weight: bold;
        }
    </style>
    <link rel="stylesheet" href="{{asset('admilte/dist/css/adminlte.css')}}" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    @yield('cssPagina')
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
                                    <a class="nav-link" href="{{route('extranet.acceso')}}" style="margin-right: 10px;">Acceso</a>
                                    <a class="nav-link" href="{{route('extranet.registro')}}" style="margin-right: 10px;">Registrarse</a>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row" style="background-image: url('{{asset('imagenes/sistema/fondo1.png')}}');">
                    <div class="col-12">
                        @include('includes.mensaje')
                        @include('includes.error-form')
                    </div>
                    <div class="col-12" style="background-color: rgba(255, 255, 255, 0.85);min-height: 92vh;">@yield('cuerpoPagina')</div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.min.js" integrity="sha384-RuyvpeZCxMJCqVUGFI0Do1mQrods/hhxYlcVfGPOfQtPJh0JCw12tUAZ/Mv10S7D" crossorigin="anonymous"></script>
    @yield('scriptPagina');
</body>

</html>
