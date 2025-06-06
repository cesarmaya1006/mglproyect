@extends('intranet.layout.app')
@section('css_pagina')
@endsection
@section('tituloPagina')
    <i class="fas fa-industry" aria-hidden="true"></i> Empresas
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Empresas</a></li>
@endsection
@section('titulo_card')
    Listado de Empresas - {{ $usuario->grupos_user[0]->empresas->count() }}
@endsection
@section('botones_card')
    @can('empresa.create')
        @if ($usuario->licencia||
             (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||
             in_array("Administrador", $usuario->getRoleNames()->toArray()))||
             ($usuario->licencia==0 && $usuario->grupos_user[0]->empresas->count() < 1))
            <a href="{{ route('empresa.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>Nuevo Registro
            </a>
        @endif
    @endcan
@endsection
@section('cuerpoPagina')
    @can('empresa.index')
        <div class="row">
            <div class="col-12 col-md-3 form-group">
                <label for="emp_grupo_id">Grupo Empresarial</label>
                <select id="emp_grupo_id" class="form-control form-control-sm" data_url="{{ route('empresa.getEmpresas') }}">
                    <option value="">Elija un Grupo Empresarial</option>
                    @if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray()))
                        <option value="x">Sin grupo Empresarial</option>
                    @endif
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">
                            {{ $grupo->grupo }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <input type="hidden" id="datos_tabla"
                data_url_empresa_edit="{{ route('empresa.edit', 1) }}"
                data_url_empresa_activar="{{ route('empresa.activar', 1) }}">
        @can('empresa.edit')
            <input type="hidden" id="permiso_empresa_edit" value="1">
        @else
            <input type="hidden" id="permiso_empresa_edit" value="0">
        @endcan
        @can('empresa.activar')
            <input type="hidden" id="permiso_empresa_activar" value="1">
        @else
            <input type="hidden" id="permiso_empresa_activar" value="0">
        @endcan

        <div class="row" id="caja_tabla_empresas">
            <div class="col-12">
                <div class="col-12">
                    <div class="col-12">
                        <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Grupos Empresariales">
                        <table class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table" id="tablaEmpresas">
                            <thead>
                                <tr>
                                    <th class="text-center">Id</th>
                                    <th>Identificación</th>
                                    <th>Empresa</th>
                                    <th>Correo Electrónico</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Estado</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody id="tbody_empresas">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
    @include('intranet.layout.script_datatable')
    <script src="{{ asset('js/intranet/empresas/empresa/index.js') }}"></script>
@endsection
