@if (session('mensaje'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Mensaje del sistema!</h5>
        {{ utf8_encode(utf8_decode(session('mensaje'))) }}
    </div>
@elseif (session('errores'))
    <div class="alert alert-danger alert-dismissible" data-auto-dismiss="3000">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error! - Mensaje del sistema</h5>
        {{ utf8_encode(utf8_decode(session('errores'))) }}
    </div>
@endif
