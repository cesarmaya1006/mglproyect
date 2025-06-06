@extends('intranet.layout.app')
@section('php_funciones')
    @php
        function sub_menu($Array_1, $x, $empresas)
        {
            foreach ($Array_1 as $sub_menu_array) {
                echo '<tr>';
                echo '<td style="padding-left: ' .
                    $x .
                    'px;"><i class="fa fa-arrow-right" aria-hidden="true"></i> ' .
                    $sub_menu_array['nombre'] .
                    '</td>';
                foreach ($empresas as $empresa) {
                    echo '
                        <td class="text-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckIndeterminate">
                                    No
                                </label>
                            </div>
                        </td>
                    ';
                }
                echo '</tr>';
                if (count($sub_menu_array['submenu']) > 0) {
                    sub_menu($sub_menu_array['submenu'], $x + 20, $empresas);
                }
            }
        }
    @endphp
@endsection
@section('cssPagina')

@endsection
@section('tituloPagina')
    <i class="fas fa-grip-horizontal" aria-hidden="true"></i> Menú - Empresas
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Inicio</a></li>
    <li class="breadcrumb-item"><a href="#">Menú - Empresas</a></li>
@endsection
@section('titulo_card')
    Menú - Empresas
@endsection
@section('botones_card')

@endsection
@section('cuerpoPagina')
    @can('permisos_menus_empresas.index')
        <div class="row d-flex justify-content-md-center">
            <div class="col-12 table-responsive">
                <input type="hidden" id="id_permisos_menus_empresas_store" data_url="{{route('menu.empresa.store')}}">
                @csrf
                <table class="table table-striped table-hover table-sm tabla_data_table_m tabla-borrando" id="tabla-data">
                    <thead>
                        <tr>
                            <th>Menú</th>
                            @foreach ($empresas as $id => $empresa)
                                <th class="text-center" style="width:1px;white-space:nowrap; max-width: 200px;">
                                    {{ utf8_encode(ucwords(strtolower(utf8_decode($empresa)))) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($menus as $key => $menu)
                            @if ($menu['menu_id'] != 0)
                                @break
                            @endif
                        <tr>
                            <td class="font-weight-bold" style="width:1px;white-space:nowrap;">
                                <i class="fa fa-arrows-alt"></i>
                                    {{ utf8_encode(ucfirst(strtolower(utf8_decode($menu['nombre'])))) }}
                            </td>
                            @foreach ($empresas as $id => $empresa)
                                <td class="text-center">
                                    <input type="checkbox" class="menu_empresa" name="menu_empresa[]"
                                        data-menuid={{ $menu['id'] }} 
                                        value="{{ $id }}"
                                        {{ in_array($id, array_column($menusEmpresas[$menu['id']], 'id')) ? 'checked' : '' }}>
                                </td>
                            @endforeach
                        </tr>
                        
                        @endforeach
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
@endsection

@section('modales')
@endsection

@section('scriptPagina')
    @include('intranet.layout.script_datatable')
    <script src="{{ asset('js/intranet/configuracion/menu_empresa/index.js') }}"></script>
@endsection
