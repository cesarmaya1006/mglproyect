@if (isset($empresa_edit))
    <div class="row">
        <div class="col-12">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" name="estado" id="estado" value="{{$empresa_edit->estado?'1':'0'}}" {{$empresa_edit->estado?'checked':''}}>
                <label class="form-check-label" id="labelCheck" for="estado">{{$empresa_edit->estado?'Empresa Activa':'Empresa Inactiva'}}</label>
            </div>
        </div>
    </div>
    <br>
@endif
<div class="row">
    <div class="col-12 col-md-2 form-group mb-4">
        <label for="emp_grupo_id">Grupo Empresarial</label>
        <select id="emp_grupo_id" class="form-control form-control-sm" name="emp_grupo_id">
            @if (in_array("Super Administrador", $usuario->getRoleNames()->toArray())||in_array("Administrador", $usuario->getRoleNames()->toArray()))
                <option value="">Sin grupo empresarial</option>
            @endif
            @foreach ($grupos as $grupo)
                <option value="{{ $grupo->id }}" {{isset($empresa_edit)?$empresa_edit->emp_grupo_id == $grupo->id?'selected':'':''}}>
                    {{ $grupo->grupo }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-2 form-group mb-4">
        <label class="requerido" for="tipo_documento_id">Tipo de identificación</label>
        <select id="tipo_documento_id" class="form-control form-control-sm" name="tipo_documento_id" required>
            <option value="">Elija tipo</option>
            @foreach ($tiposdocu as $tipoDocu)
                <option value="{{ $tipoDocu->id }}" {{isset($empresa_edit)?$empresa_edit->tipo_documento_id == $tipoDocu->id?'selected':'':''}}>
                    {{ $tipoDocu->abreb_id }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12 col-md-2 form-group mb-4">
        <label class="requerido" for="identificacion">Identificación</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('identificacion', $empresa_edit->identificacion ?? '') }}" name="identificacion" id="identificacion" required>
    </div>
    <div class="col-12 col-md-4 form-group mb-4">
        <label class="requerido" for="empresa">Nombre Empresa</label>
        <input type="text" class="form-control form-control-sm" value="{{ old('empresa', $empresa_edit->empresa ?? '') }}" name="empresa" id="empresa" required>
    </div>
    <div class="col-12 col-md-4 form-group mb-4">
        <label class="requerido" for="email">Correo Electrónico</label>
        <input type="email" class="form-control form-control-sm" value="{{ old('email', $empresa_edit->email ?? '') }}" name="email" id="email" required>
    </div>
    <div class="col-12 col-md-2 form-group mb-4">
        <label class="requerido" for="telefono">Teléfono</label>
        <input type="tel" class="form-control form-control-sm" value="{{ old('telefono', $empresa_edit->telefono ?? '') }}" name="telefono" id="telefono" required>
    </div>
    <div class="col-12 col-md-4 form-group mb-4">
        <label class="requerido" for="direccion">Dirección</label>
        <input type="tel" class="form-control form-control-sm" value="{{ old('direccion', $empresa_edit->direccion ?? '') }}" name="direccion" id="direccion" required>
    </div>
    <div class="col-12 col-md-6 form-group mb-4">
        <div class="row">
            <div class="col-12 form-group mb-4">
                <label for="logo" class="requerido">Logo Empresarial</label>
                <input type="file" class="form-control" id="logo" name="logo" placeholder="logo" accept="image/png,image/jpeg" onchange="mostrar()">
            </div>
            <div class="col-12">
                <div class="row d-flex justify-content-center">
                    <div class="col-10 col-md-6">
                        <img class="img-fluid fotoEmpresa" id="fotoEmpresa" src="{{ isset($empresa_edit) ?($empresa_edit->logo!=null?asset('/imagenes/empresas/'.$empresa_edit->logo) : asset('/imagenes/empresas/empresa1.png')) : asset('/imagenes/empresas/empresa1.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

