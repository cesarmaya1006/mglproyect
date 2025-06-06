
$('.menu_rol').on('change', function() {
    var data = {
        menu_id: $(this).data('menuid'),
        rol_id: $(this).val(),
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
    const url_t = $('#rutaMenuRol').attr('data_url');

    $.ajax({
        url: url_t,
        type: 'POST',
        data: data,
        success: function(respuesta) {
            Sistema.notificaciones(respuesta.respuesta, 'Sistema', 'success');
        }
    });
}
