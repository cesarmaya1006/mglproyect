
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js"></script>

<script>
    function asignarDataTableAjax(table_id, titulo_tabla) {
        $(table_id).DataTable({
            scrollX: true
            , lengthMenu: [5, 10, 15, 25, 50, 75, 100]
            , pageLength: 5
            , dom: "lBfrtip"
            , buttons: [
                "excel"
                , {
                    extend: "pdfHtml5"
                    , pageSize: "Legal"
                    , title: $("#titulo_tabla").val()
                , }
            , ]
            , language: {
                sProcessing: "Procesando..."
                , sLengthMenu: "Mostrar _MENU_ resultados"
                , sZeroRecords: "No se encontraron resultados"
                , sEmptyTable: "Ningún dato disponible en esta tabla"
                , sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_"
                , sInfoEmpty: "Mostrando resultados del 0 al 0 de un total de 0 registros"
                , sInfoFiltered: "(filtrado de un total de _MAX_ registros)"
                , sSearch: "Buscar:"
                , sLoadingRecords: "Cargando..."
                , oPaginate: {
                    sFirst: "Primero"
                    , sLast: "Último"
                    , sNext: "Siguiente"
                    , sPrevious: "Anterior"
                , }
            , }
        , });
    }

    function vaciarTabla(table_id, tbody) {
        respuesta_tabla_html = '';
        $(table_id).DataTable().destroy();
        $(tbody).html(respuesta_tabla_html);
    };

</script>
<script>
    $(document).ready(function() {
        $(".tabla_data_table").DataTable({
            scrollX: true
            , lengthMenu: [5, 10, 15, 25, 50, 75, 100]
            , pageLength: 10
            , dom: "lBfrtip"
            , buttons: [
                "excel"
                , {
                    extend: "pdfHtml5"
                    , pageSize: "Legal"
                    , title: $("#titulo_tabla").val()
                , }
            , ]
            , language: {
                sProcessing: "Procesando..."
                , sLengthMenu: "Mostrar _MENU_ resultados"
                , sZeroRecords: "No se encontraron resultados"
                , sEmptyTable: "Ningún dato disponible en esta tabla"
                , sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_"
                , sInfoEmpty: "Mostrando resultados del 0 al 0 de un total de 0 registros"
                , sInfoFiltered: "(filtrado de un total de _MAX_ registros)"
                , sSearch: "Buscar:"
                , sLoadingRecords: "Cargando..."
                , oPaginate: {
                    sFirst: "Primero"
                    , sLast: "Último"
                    , sNext: "Siguiente"
                    , sPrevious: "Anterior"
                , }
            , }
        , });

        $(".tabla_data_table_inicial_opt").DataTable({
            pageLength: $(this).attr('data_pageLength')
            , layout: {
                top2Start: {
                    pageLength: {
                        menu: [5, 10, 25, 50, 100]
                    }
                }
                , top2End: null
                , topStart: {
                    buttons: [{
                        extend: 'excel'
                        , title: $(this).attr('data_titulo')
                    }, {
                        extend: 'pdf'
                        , title: $(this).attr('data_titulo')
                    }]
                }
                , topEnd: {
                    search: {
                        placeholder: 'Buscar'
                    }
                }
            }
            , language: {
                sProcessing: "Procesando..."
                , sLengthMenu: "Mostrar _MENU_ resultados"
                , sZeroRecords: "No se encontraron resultados"
                , sEmptyTable: "Ningún dato disponible en esta tabla"
                , sInfo: "Mostrando resultados _START_-_END_ de  _TOTAL_"
                , sInfoEmpty: "Mostrando resultados del 0 al 0 de un total de 0 registros"
                , sInfoFiltered: "(filtrado de un total de _MAX_ registros)"
                , sSearch: "Buscar:"
                , sLoadingRecords: "Cargando..."
                , oPaginate: {
                    sFirst: "Primero"
                    , sLast: "Último"
                    , sNext: "Siguiente"
                    , sPrevious: "Anterior"
                , }
            , }
        , });
    });

</script>
