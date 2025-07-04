@extends('intranet.layout.app')
@section('css_pagina')
@endsection
@section('phpPagina')
    @php
        $crearBoton = false;
        $cantempleados =0;
        if ($usuario->licencia||in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())) {
            $crearBoton = true;
        } else {
            if ($usuario->grupos_user->count()) {
                foreach ($usuario->grupos_user as $grupo) {
                    foreach ($grupo->empresas as $empresa) {
                        foreach ($empresa->areas as $area) {
                            foreach ($area->cargos as $cargo) {
                                $cantempleados+= $cargo->empleados->count();
                            }
                        }
                    }
                }
            } else {
                foreach ($usuario->empresas_user as $empresa) {
                    foreach ($empresa->areas as $area) {
                        foreach ($area->cargos as $cargo) {
                                $cantempleados+= $cargo->empleados->count();
                        }
                    }
                }
            }
            if ($cantempleados < 10) {
                $crearBoton = true;
            }
        }
    @endphp
@endsection
@section('tituloPagina')
    <i class="fas fa-user-tie mr-3" aria-hidden="true"></i> Configuración Empleados - {{ $cantempleados }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item active">empleados</li>
@endsection
@section('titulo_card')
    @if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray()))
        Listado de Empleados por Empresas
    @else
        Listado de Empleados
    @endif
@endsection
@section('botones_card')
    @can('empleados.create')
        @if ($crearBoton)
            <a href="{{ route('empleados.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>Nuevo Registro
            </a>
        @endif
    @endcan
@endsection
@section('cuerpoPagina')
    @can('empleados.index')
    <div class="row">
        @if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())||$usuario->grupos_user->count())
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
        @endif
        @if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())||$usuario->grupos_user->count())
        <div class="col-12 col-md-3 form-group d-none" id="caja_empresas">
            <label for="empresa_id">Empresa</label>
            <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('empleados.getEmpleadosEmpresa') }}">
                <option value="">Elija grupo</option>
            </select>
        </div>
        @else
        <div class="col-12 col-md-3 form-group">
            <label for="empresa_id">Empresa</label>
            <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('empleados.getEmpleadosEmpresa') }}">
                <option value="">Elija una Empresa</option>
                @foreach ($grupos as $empresa)
                <option value="{{ $empresa->id }}">
                    {{ $empresa->empresa }}
                </option>
                @endforeach
            </select>
        </div>
        @endif
    </div>
    <hr>
    <div class="row d-flex justify-content-md-center pl-md-2 pr-md-2">
        <input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Empleados">
        <input type="hidden" id="control_dataTable" value="1">
        <input type="hidden" id="empleados_edit" data_url="{{ route('empleados.edit', ['id' => 1]) }}" data_foto="{{ asset('imagenes/usuarios/') }}">

        @csrf @method('delete')
        <div class="col-12 table-responsive sombra">
            @csrf
            <table class="table display table-bordered table-striped table-hover table-sm tabla-borrando tabla_data_table" id="tablaEmpleados">
                <thead>
                    <tr>
                        <th class="text-center">Id</th>
                        <th class="text-center">Area</th>
                        <th class="text-center">Cargo</th>
                        <th class="text-center">Nombres</th>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">Identificación</th>
                        <th class="text-center">Correo Electrónico</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Vinculacion</th>
                        <th class="text-center">Lider de Proyectos</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Foto</th>
                        <td></td>
                    </tr>
                </thead>
                <tbody id="tbody_empleados">

                </tbody>
            </table>
        </div>
    </div>
    @can('empleados.edit')
        <input type="hidden" id="permiso_empleados_edit" value="1">
    @else
        <input type="hidden" id="permiso_empleados_edit" value="0">
    @endcan


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
    @include('intranet.layout.datatable')
    <script src="{{ asset('js/intranet/configuracion/empleados/index.js') }}"></script>
@endsection
