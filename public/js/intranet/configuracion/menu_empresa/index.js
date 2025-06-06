
$('.menu_empresa').on('change', function() {
    var data = {
        menu_id: $(this).data('menuid'),
        empresa_id: $(this).val(),
        _token: $('input[name=_token]').val()
    };
    if ($(this).is(':checked')) {
        data.estado = 1
    } else {
        data.estado = 0
    }
    ajaxRequest('/admin/_menus_rol', data);
});

function ajaxRequest(url, data) {
    const url_t = $('#id_permisos_menus_empresas_store').attr('data_url');

    $.ajax({
        url: url_t,
        type: 'POST',
        data: data,
        success: function(respuesta) {
            Sistema.notificaciones(respuesta.respuesta, 'Sistema', 'success');
        }
    });
}
