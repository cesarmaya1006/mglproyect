@extends('intranet.layout.app')

@section('cssPagina')

@endsection

@section('tituloPagina')
<i class="fas fa-user-shield mr-3" aria-hidden="true"></i> Configuración - Áreas
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
<li class="breadcrumb-item active">Áreas</li>
@endsection

@section('botones_card')
    @can('areas.create')
        @if ($usuario->licencia||
             (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray()))||
             ($usuario->licencia ==0 &&$usuario->grupos_user->count()&&$usuario->grupos_user[0]->empresas[0]->areas->count()<3)||
             ($usuario->licencia ==0 &&$usuario->empresas_user->count()&&$usuario->empresas_user[0]->areas->count()<3))
            <a href="{{ route('areas.create') }}" class="btn btn-primary btn-xs btn-sombra text-center pl-5 pr-5 float-md-end">
                <i class="fa fa-plus-circle mr-3" aria-hidden="true"></i>Nuevo Registro
            </a>
        @endif
    @endcan
@endsection
@section('cuerpoPagina')
@can('areas.index')
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
        <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}">
            <option value="">Elija grupo</option>
        </select>
    </div>
    @else
    <div class="col-12 col-md-3 form-group">
        <label for="empresa_id">Empresa</label>
        <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}">
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
<div class="row" id="caja_tabla_areas">
    <div class="col-12 table-responsive">
        <table class="table display table-striped table-hover table-sm  tabla-borrando tabla_data_table" id="tablaAreas">
            <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Area</th>
                    <th class="text-center">Area Superior</th>
                    <th class="text-center">Dependencias</th>
                    <td></td>
                </tr>
            </thead>
            <tbody id="tbody_areas">

            </tbody>
        </table>
    </div>
</div>
@else
<div class="row d-flex justify-content-center">
    <div class="col-12 col-md-6">
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-ban"></i> Sin Acceso!</h5>
            El rol de su usuario no tiene permisos de acceso para esta vista, Comuniquese con el administrador del sistema.
        </div>
    </div>
</div>
@endcan
@endsection

@section('footer_card')
<input type="hidden" name="titulo_tabla" id="titulo_tabla" value="Listado de Áreas">
<input type="hidden" id="control_dataTable" value="1">
<input type="hidden" id="areas_edit" data_url="{{ route('areas.edit', ['id' => 1]) }}">
<input type="hidden" id="areas_destroy" data_url="{{ route('areas.destroy', ['id' => 1]) }}">
<input type="hidden" id="id_areas_getDependencias" data_url="{{ route('areas.getDependencias', ['id' => 1]) }}">
@csrf @method('delete')
@endsection

@section('modales')
<!-- Modales  -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Listado de dependencias</h5>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modales  -->
@endsection

@section('scriptPagina')
@include('intranet.layout.script_datatable')
<script src="{{ asset('js/intranet/empresas/area/index.js') }}"></script>
@endsection
