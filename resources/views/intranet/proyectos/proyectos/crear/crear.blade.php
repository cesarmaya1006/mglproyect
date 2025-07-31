@extends('intranet.layout.app')
@section('css_pagina')

@endsection
@section('phpPagina')

@endsection
@section('tituloPagina')
    <i class="fas fa-project-diagram mr-3" aria-hidden="true"></i> Modulo Proyectos
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('proyectos.index') }}">proyectos</a></li>
    <li class="breadcrumb-item active">crear proyecto</li>
@endsection
@section('titulo_card')
    Proyectos Crear
@endsection
@section('botones_card')
    <a href="{{route('proyectos.index')}}" class="btn btn-success btn-sm mini_sombra pl-5 pr-5 float-md-end" style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection
@section('cuerpoPagina')
    @can('proyectos.create')
    <div class="row d-flex justify-content-center">
        <form class="col-12 form-horizontal" action="{{ route('proyectos.store') }}" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            @csrf
            @method('post')
            @include('intranet.proyectos.proyectos.crear.form')
            <div class="row mt-5">
                <div class="col-12 col-md-6 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                    <button type="submit" class="btn btn-primary btn-sm btn-sombra pl-sm-5 pr-sm-5"
                        style="font-size: 0.8em;">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    @else
        <div class="row d-flex justify-content-center">
            <div class="col-12 col-md-6">
                <div class="alert alert-warning alert-dismissible mini_sombra">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Sin Acceso!</h5>
                    <p style="text-align: justify">Su usuario no tiene permisos de acceso para esta vista, Comuniquese con el
                        administrador del sistema.</p>
                </div>
            </div>
        </div>
    @endcan
@endsection

@section('footer_card')
@endsection

@section('modales')
@endsection

@section('scriptPagina')
    <script src="{{ asset('js/intranet/proyectos/proyectos/crear.js') }}"></script>
@endsection
