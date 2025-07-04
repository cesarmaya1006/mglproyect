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
                if (respuesta.areasPadre.length > 0) {
                    var respuesta_html = "";
                    respuesta_html += '<option value="">Elija área</option>';
                    $.each(respuesta.areasPadre, function (index, item) {
                        respuesta_html += '<option value="' + item.id + '">' + item.area + "</option>";
                    });
                    $("#area_id").html(respuesta_html);
                }
            },
            error: function () {},
        });
    });
    //--------------------------------------------------------------------------


});

