$(document).ready(function () {
    //--------------------------------------------------------------------------
    $("#emp_grupo_id").on("change", function () {
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                console.log(respuesta);
                if (respuesta.empresas.length > 0) {
                    var respuesta_html = "";
                    respuesta_html += '<option value="">Elija empresa</option>';
                    $.each(respuesta.empresas, function (index, item) {
                        respuesta_html += '<option value="' + item.id + '">' + item.empresa + "</option>";
                    });
                    $("#empresa_id").html(respuesta_html);
                    $("#caja_empresas").removeClass("d-none");
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------
    $("#empresa_id").on("change", function () {
        vaciarTabla();
        const data_url = $(this).attr("data_url");
        const id = $(this).val();
        var data = {
            id: id,
        };
        $.ajax({
            url: data_url,
            type: "GET",
            data: data,
            success: function (respuesta) {
                console.log(respuesta.cargos);
                respuesta_tabla_html_fin = '';
                if (respuesta.cargos.length > 0) {
                    respuesta_tabla_html_fin += llenarTablaCargos_emp(respuesta.cargos);
                    $("#tbody_cargos").html(respuesta_tabla_html_fin);
                    asignarDataTableAjax();
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------

});

function llenarTablaCargos(cargos){
    respuesta_tabla_html = '';

    var cargos_edit_ini = $('#cargos_edit').attr("data_url");
    cargos_edit_ini = cargos_edit_ini.substring(0, cargos_edit_ini.length - 1);
    const cargos_edit_fin = cargos_edit_ini;

    var cargos_destroy_ini = $('#cargos_destroy').attr("data_url");
    cargos_destroy_ini = cargos_destroy_ini.substring(0,cargos_destroy_ini.length - 1);
    const cargos_destroy_fin = cargos_destroy_ini;

    const permiso_cargos_edit = $('#permiso_cargos_edit').val();
    const permiso_cargos_destroy = $('#permiso_cargos_destroy').val();
    //================================================================================
    $.each(cargos, function(index, cargo) {
        respuesta_tabla_html += '<tr>';
        respuesta_tabla_html += '<td class="text-center">' + cargo .id + '</td>';
        respuesta_tabla_html += '<td class="text-center">' + cargo.area.area + '</td>';
        respuesta_tabla_html += '<td class="text-center">' + cargo.cargo + '</td>';
        respuesta_tabla_html +='<td class="d-flex justify-content-evenly align-cargos-center">';
        if (permiso_cargos_edit==1) {
            respuesta_tabla_html += '<a href="' + cargos_edit_fin + cargo.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += '</a>';
        }
        if (permiso_cargos_destroy == 1) {
            respuesta_tabla_html += '<form action="' + cargos_destroy_fin + cargo.id + '" class="d-inline form-eliminar" method="POST">';
            respuesta_html += '<input type="hidden" name="_token" value="'+$("input[name=_token]").val()+'" autocomplete="off">';
            respuesta_tabla_html += '<input type="hidden" name="_method" value="delete">';
            respuesta_tabla_html += '<button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">';
            respuesta_tabla_html += '<i class="fa fa-fw fa-trash text-danger"></i>';
            respuesta_tabla_html += '</button>';
            respuesta_tabla_html += '</form>';
        }
        if (permiso_cargos_edit==0 && permiso_cargos_destroy == 0) {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += '</td>';
        respuesta_tabla_html += '</tr>';
    });
    //================================================================================
    $("#tbody_cargos").html(respuesta_tabla_html);
    asignarDataTableAjax();
}
function llenarTablaCargos_emp(cargos){
    respuesta_tabla_html = '';

    var cargos_edit_ini = $('#cargos_edit').attr("data_url");
    cargos_edit_ini = cargos_edit_ini.substring(0, cargos_edit_ini.length - 1);
    const cargos_edit_fin = cargos_edit_ini;

    var cargos_destroy_ini = $('#cargos_destroy').attr("data_url");
    cargos_destroy_ini = cargos_destroy_ini.substring(0,cargos_destroy_ini.length - 1);
    const cargos_destroy_fin = cargos_destroy_ini;

    const permiso_cargos_edit = $('#permiso_cargos_edit').val();
    const permiso_cargos_destroy = $('#permiso_cargos_destroy').val();
    //================================================================================
    $.each(cargos, function(index, cargo) {
        respuesta_tabla_html += '<tr>';
        respuesta_tabla_html += '<td class="text-center">' + cargo .id + '</td>';
        respuesta_tabla_html += '<td class="text-center">' + cargo.area.area + '</td>';
        respuesta_tabla_html += '<td class="text-center">' + cargo.cargo + '</td>';
        respuesta_tabla_html +='<td class="d-flex justify-content-evenly align-cargos-center">';
        if (permiso_cargos_edit==1) {
            respuesta_tabla_html += '<a href="' + cargos_edit_fin + cargo.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += '</a>';
        }
        if (permiso_cargos_destroy == 1) {
            respuesta_tabla_html += '<form action="' + cargos_destroy_fin + cargo.id + '" class="d-inline form-eliminar" method="POST">';
            respuesta_tabla_html += '<input type="hidden" name="_token" value="'+$("input[name=_token]").val()+'" autocomplete="off">';
            respuesta_tabla_html += '<input type="hidden" name="_method" value="delete">';
            respuesta_tabla_html += '<button type="submit" class="btn-accion-tabla eliminar tooltipsC" title="Eliminar este registro">';
            respuesta_tabla_html += '<i class="fa fa-fw fa-trash text-danger"></i>';
            respuesta_tabla_html += '</button>';
            respuesta_tabla_html += '</form>';
        }
        if (permiso_cargos_edit==0 && permiso_cargos_destroy == 0) {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += '</td>';
        respuesta_tabla_html += '</tr>';
    });
    //================================================================================
    return respuesta_tabla_html;
}
