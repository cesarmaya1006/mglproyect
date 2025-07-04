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
        vaciarTabla('#tablaEmpleados','#tbody_empleados');
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
                console.log(respuesta.empleados);
                respuesta_tabla_html_fin = '';
                if (respuesta.empleados.length > 0) {
                    respuesta_tabla_html_fin += llenarTablaEmpleados(respuesta.empleados);
                    $("#tbody_empleados").html(respuesta_tabla_html_fin);
                    asignarDataTableAjax('#tablaEmpleados','Tabla Empleados');
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------

});


function llenarTablaEmpleados(empleados){
    respuesta_tabla_html = '';
    var empleados_edit_ini = $('#empleados_edit').attr("data_url");
    empleados_edit_ini = empleados_edit_ini.substring(0, empleados_edit_ini.length - 1);
    const empleados_edit_fin = empleados_edit_ini;

    const permiso_empleados_edit = $('#permiso_empleados_edit').val();
    const folderFotos = $('#empleados_edit').attr("data_foto");
    //================================================================================
    $.each(empleados, function(index, empleado) {
        respuesta_tabla_html += '<tr>';
        respuesta_tabla_html += '<td class="text-center">' + empleado .id + '</td>';
        respuesta_tabla_html += '<td>' + empleado.cargo.area.area + '</td>';
        respuesta_tabla_html += '<td>' + empleado.cargo.cargo + '</td>';
        respuesta_tabla_html += '<td>' + empleado.nombres + '</td>';
        respuesta_tabla_html += '<td>' + empleado.apellidos + '</td>';
        respuesta_tabla_html += '<td>' + empleado.tipo_docu.abreb_id + ' - ' + empleado.identificacion + '</td>';
        respuesta_tabla_html += '<td>' + empleado.usuario.email + '</td>';
        respuesta_tabla_html += '<td>' + empleado.telefono + '</td>';
        respuesta_tabla_html += '<td>' + empleado.direccion + '</td>';
        respuesta_tabla_html += '<td class="text-center">' + empleado.vinculacion + '</td>';

        if (empleado.lider == 1) {
            estado_bg = "success";
            estado = "Si";
        } else {
            estado_bg = "gray";
            estado = "No";
        }
        respuesta_tabla_html += '<td class="text-center">' + estado +"</td>";

        if (empleado.estado == 1) {
            estado_bg = "success";
            estado = "Activo";
        } else {
            estado_bg = "gray";
            estado = "Inactivo";
        }
        respuesta_tabla_html += '<td class="text-center"><span class="btn-xs pl-3 pr-3 text-center bg-' +estado_bg +' rounded">' +estado +"</span></td>";

        respuesta_tabla_html += '<td class="text-center"><img src="' + folderFotos + '/' + empleado.foto + '" class="rounded-circle"/></td>';



        respuesta_tabla_html +='<td class="d-flex justify-content-evenly align-cargos-center">';
        if (permiso_empleados_edit==1) {
            respuesta_tabla_html += '<a href="' + empleados_edit_fin + empleado.id + '" class="btn-accion-tabla tooltipsC"';
            respuesta_tabla_html += 'title="Editar este registro">';
            respuesta_tabla_html += '<i class="fas fa-pen-square"></i>';
            respuesta_tabla_html += '</a>';
        }

        if (permiso_empleados_edit==0) {
            respuesta_tabla_html += '<span class="text-danger">---</span>';
        }
        respuesta_tabla_html += '</td>';
        respuesta_tabla_html += '</tr>';
    });
    //================================================================================
    return respuesta_tabla_html;
}
