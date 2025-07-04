<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
@extends('intranet.layout.app')
@section('css_pagina')
@endsection
@section('tituloPagina')
    <i class="fas fa-project-diagram mr-3" aria-hidden="true"></i> Configuración Áreas
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="{{ route('areas.index') }}">Áreas</a></li>
    <li class="breadcrumb-item active">Áreas - Crear</li>
@endsection
@section('titulo_card')
    <i class="fa fa-plus-square mr-3" aria-hidden="true"></i> Crear Área
@endsection
@section('botones_card')
    <a href="{{route('areas.index')}}" class="btn btn-success btn-xs mini_sombra pl-5 pr-5 float-md-end" style="font-size: 0.8em;">
        <i class="fas fa-reply mr-2"></i>
        Volver
    </a>
@endsection
@section('cuerpoPagina')
    @can('areas.create')
        @if ($usuario->licencia||(in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray()))||
             ($usuario->licencia ==0 &&$usuario->grupos_user->count()&&$usuario->grupos_user[0]->empresas[0]->areas->count()<3)||
             ($usuario->licencia ==0 &&$usuario->empresas_user->count()&&$usuario->empresas_user[0]->areas->count()<3))
             <div class="row d-flex justify-content-center">
            <form class="col-12 form-horizontal" action="{{ route('areas.store') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
                @csrf
                @method('post')
                @include('intranet.empresa.area.form')
                <div class="row mt-5">
                    <div class="col-12 mb-4 mb-md-0 d-grid gap-2 d-md-block ">
                        <button type="submit" class="btn btn-primary btn-xs mini_sombra pl-sm-5 pr-sm-5" style="font-size: 0.8em;">Guardar</button>
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
        @endif
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
<script src="{{ asset('js/intranet/empresa/area/crear.js') }}"></script>
@endsection
