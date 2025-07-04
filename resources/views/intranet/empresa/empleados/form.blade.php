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
                                <option value="{{ $grupo->id }}" {{ isset($empleado_edit)? ($empleado_edit->cargo->area->empresa->grupo_id==$grupo->id?'selected':''):'' }}>{{ $grupo->grupo }}</option>
                            @endforeach
                    </select>
                </div>
                <div class="col-12 col-md-3 form-group" id="caja_empresas">
                    <label class="requerido" for="empresa_id" id="label_empresa_id">Empresa</label>
                    <select id="empresa_id" class="form-control form-control-sm" data_url="{{ route('areas.getAreas') }}">
                        @if (isset($empleado_edit))
                            <option value="">Elija empresa</option>
                            @foreach ($empleado_edit->cargo->area->empresa->grupo->empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{$empleado_edit->cargo->area->empresa_id==$empresa->id? 'selected':''}}>{{ $empresa->empresa }}</option>
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
        <select id="area_id" class="form-control form-control-sm" data_url="{{ route('empleados.getCargosAreas') }}">
            @if (isset($empleado_edit))
                <option value="">Elija área</option>
                @foreach ($empleado_edit->cargo->area->empresa->areas as $area)
                    <option value="{{ $area->id }}" {{$empleado_edit->cargo->area_id==$area->id? 'selected':''}}>
                        {{ $area->area }}
                    </option>
                @endforeach
            @else
                <option value="">Elija Empresa</option>
            @endif
        </select>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="cargo_id">Cargo</label>
        <select id="cargo_id" name="cargo_id" class="form-control form-control-sm" required>
            @if (isset($empleado_edit))
                <option value="">Elija cargo</option>
                @foreach ($empleado_edit->cargo->area->cargos as $cargo)
                    <option value="{{ $cargo->id }}" {{$empleado_edit->cargo_id==$cargo->id? 'selected':''}}>
                        {{ $cargo->cargo }}
                    </option>
                @endforeach
            @else
                <option value="">Elija Área</option>
            @endif
        </select>
    </div>
</div>
<hr style="border: 1px solid black">
<div class="row">
    <div class="col-12 col-md-2 form-group">
        <label class="requerido" for="tipo_documento_id">Tipo de identificación</label>
        <select id="tipo_documento_id" class="form-control form-control-sm" name="tipo_documento_id" required>
            <option value="">Elija tipo</option>
            @foreach ($tiposdocu as $tipoDocu)
                <option value="{{ $tipoDocu->id }}" {{isset($empleado_edit)?$empleado_edit->tipo_documento_id == $tipoDocu->id?'selected':'':''}}>
                    {{ $tipoDocu->abreb_id .' - ' . $tipoDocu->tipo_id}}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-2 form-group">
        <label class="requerido" for="identificacion">Identificación</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('identificacion', $empleado_edit->identificacion ?? '') }}" name="identificacion" id="identificacion" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="nombres">Nombres</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('nombres', $empleado_edit->nombres ?? '') }}" name="nombres" id="nombres" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="apellidos">Apellidos</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('apellidos', $empleado_edit->apellidos ?? '') }}" name="apellidos" id="apellidos" required>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label class="requerido" for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" value="{{ old('email', $empleado_edit->usuario->email ?? '') }}" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="telefono">Teléfono</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('telefono', $empleado_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
    </div>
    <div class="col-12 col-md-3 form-group">
        <label class="requerido" for="direccion">Dirección</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('direccion', $empleado_edit->direccion ?? '') }}" name="direccion" id="direccion" required>
    </div>
    <div class="col-12 col-md-2 form-group">
        <label class="requerido" for="vinculacion">Fecha Vinculación</label>
        <input type="date" class="form-control form-control-sm" value="{{ old('vinculacion', $empleado_edit->vinculacion ??  date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"  name="vinculacion" id="vinculacion" required>
    </div>
    @isset($empleado_edit)
        <div class="col-12 mb-3">
            <h6>Estado:</h6>
            @if ($empleado_edit->estado === 1)
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="estado"  name="estado" checked>
                    <label class="form-check-label" for="estado">Activo</label>
                </div>
            @else
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="estado" name="estado" >
                    <label class="form-check-label" for="estado">Inactivo</label>
                </div>
            @endif
        </div>
        <hr>
    @endisset
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-6">
        <div class="row">
            @if (session('rol_principal_id')<3)
                <div class="col-12">
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="mgl" id="mgl" {{isset($empleado_edit)?$empleado_edit->mgl ?'checked':'':''}}>
                            <label class="form-check-label" for="mgl">
                                Usuario MGL
                            </label>
                        </div>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" name="lider" id="lider" {{isset($empleado_edit)?$empleado_edit->lider ?'checked':'':''}}>
                        <label class="form-check-label" for="lider">
                            Lider de Proyectos
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6">
        <div class="row">
            <div class="col-12 form-group">
                <label for="foto" class="requerido">Fotografía</label>
                <input type="file" class="form-control form-control-sm" id="foto" name="foto" placeholder="Foto del usuario" accept="image/png,image/jpeg" onchange="mostrar()">
                <small id="helpId" class="form-text text-muted">Fotografía</small>
            </div>
            <div class="col-12">
                <div class="row d-flex justify-content-evenly">
                    <div class="col-6 col-md-4">
                        <img class="img-fluid fotoUsuario" id="fotoUsuario" src="{{ isset($empleado_edit) ?($empleado_edit->foto!=null?asset('/imagenes/usuarios/'.$empleado_edit->foto) : asset('/imagenes/usuarios/usuario-inicial.jpg')) : asset('/imagenes/usuarios/usuario-inicial.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>







