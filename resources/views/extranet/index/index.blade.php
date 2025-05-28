@extends('extranet.layout.app')
@section('cuerpoPagina')
<div class="row">
    <div class="col-12">
        <div class="row d-flex justify-content-center pt-5">
            <div class="col-12 col-md-8 mt-5 rounded-3" style="min-height: 600px; background-image: url('{{asset('imagenes/sistema/fondo_registro.jpg')}}');background-size: auto 600px;;background-repeat: no-repeat;">
                <a class="text-white pt-3 pb-3 bg-dark rounded-4" href="{{route('extranet.registro')}}" style="text-decoration: none;position: relative;left: 50%;top:40%;padding-left: 30px; padding-right: 30px;font-size: 1.2em;font-weight: bold; border: solid 1px white;">Registrate para una prueba Gratis</a>
            </div>
        </div>
    </div>
</div>
@endsection
