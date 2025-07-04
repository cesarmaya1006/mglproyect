<div class="row mt-4">
    @if ((in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray())))

    @else
        @if (in_array("Administrador Empresa", $usuario->getRoleNames()->toArray()))
            @if ($usuario->grupos_user->count())
                <div class="col-12 col-md-3 form-group">
                    <label class="requerido" for="emp_grupo_id">Grupo Empresarial</label>
                    <select id="emp_grupo_id" class="form-control form-control-sm" data_url="{{ route('empresa.getEmpresas') }}">
                            <option value="">Elija un Grupo Empresarial</option>
                            @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id }}" {{ isset($cargo_edit)? ($cargo_edit->area->empresa->grupo_id==$grupo->id?'selected':''):'' }}>{{ $grupo->grupo }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 form-group" id="caja_empresas">
                    <label for="empresa_id" id="label_empresa_id">Empresa</label>
                    <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}">
                        @if (isset($cargo_edit))
                            <option value="">Elija empresa</option>
                            @foreach ($cargo_edit->area->empresa->grupo->empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{$cargo_edit->area->empresa_id==$empresa->id? 'selected':''}}>{{ $empresa->empresa }}</option>
                            @endforeach
                        @else
                            <option value="">Elija grupo</option>
                        @endif
                    </select>
                </div>
            @else
                <div class="col-12 col-md-3 form-group">
                    <label class="requerido" for="empresa_id">Empresa</label>
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
        @endif
    @endif
    <div class="col-12 col-md-3 form-group" id="caja_empresas">
        <label class="requerido" for="area_id">Área</label>
        <select id="area_id" name="area_id" class="form-control form-control-sm">
            @if (isset($cargo_edit))
                <option value="">Elija área</option>
                @foreach ($cargo_edit->area->empresa->areas as $area)
                    <option value="{{ $area->id }}" {{$cargo_edit->area_id==$area->id? 'selected':''}}>
                        {{ $area->area }}
                    </option>
                @endforeach
            @else
                <option value="">Elija Empresa</option>
            @endif
        </select>
    </div>
    <div class="col-12 col-md-3 form-group" id="caja_cargo_nueva">
        <label class="requerido" for="cargo">Nombre del Cargo</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('cargo', $cargo_edit->cargo ?? '') }}" name="cargo" id="cargo" >
    </div>
</div>







