<div class="row">
    <input type="hidden" name="empresa_id" value="{{ $usuario->empleado->cargo->area->empresa_id }}">
    <div class="col-12 col-md-4 form-group" id="caja_empleados">
        <label class="requerido" for="empleado_id">Lider del Proyecto </label>
        <select id="empleado_id" name="empleado_id" class="form-control form-control-sm" required>
            <option value="">Elija un Lider</option>
                @foreach ($lideres as $empleado)
                    <option value="{{$empleado->id}}">{{$empleado->nombres.' '. $empleado->apellidos.'   ---    ' .   $empleado->cargo->cargo }}</i></option>
                @endforeach
        </select>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12 col-md-2 form-group">
        <label class="requerido" for="fec_creacion">Fecha Proyecto</label>
        <input class="form-control form-control-sm" type="date" name="fec_creacion" id="fec_creacion" value="{{ date('Y-m-d') }}" required>
        <small id="helpId" class="form-text text-muted">Fecha creación proyecto</small>
    </div>
    <div class="col-12 col-md-4 form-group">
        <label class="requerido" for="titulo">Titulo Proyecto</label>
        <input type="text" class="form-control form-control-sm" name="titulo" id="titulo" aria-describedby="helpId" onkeyup="mayus(this);" required>
        <small id="helpId" class="form-text text-muted">Titulo Proyecto</small>
    </div>
    <div class="col-12 col-md-6 form-group">
        <label for="titulo">Documento Adjunto</label>
        <input type="file" class="form-control form-control-sm" name="docu_proyecto" id="docu_proyecto" aria-describedby="helpId" >
        <small id="helpId" class="form-text text-muted">Documento adjunto al proyecto (Opcional)</small>
    </div>
    <div class="col-12 form-group">
        <label class="requerido" for="titulo">Objetivo del Proyecto</label>
        <textarea class="form-control form-control-sm" id="objetivo" name="objetivo" style="resize: none;" rows="3" aria-describedby="helpId" placeholder="Ingrese el objetivo de proyecto" required></textarea>
        <small id="helpId" class="form-text text-muted">Objetivo del Proyecto</small>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-12">
        <h6><strong>Componente Financiero</strong></h6>
    </div>
    <div class="col-12 col-md-2 form-group">
        <label for="presupuesto">Presupuesto Inicial</label>
        <input type="number" min="0" value="0.00" step="0.01" class="form-control form-control-sm text-end" name="presupuesto" id="presupuesto">
        <small id="helpId" class="form-text text-muted">Presupuesto inicial del proyecto (Opcional)</small>
    </div>
</div>
<hr>


