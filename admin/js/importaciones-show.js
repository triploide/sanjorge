var Importaciones = (function (w, $, undefined) {

    function init () {
        dtInit();
        $('#left-panel li[data-nav="importar"]').addClass('active');
    }

    var dataTable, currentRow = 0,
        responsiveHelper_dt_basic = undefined,
        breakpointDefinition = {
            tablet : 1024,
            phone : 480
        }
    ;

    var dataTableOptions = {
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        processing: false,
        serverSide: true,
        stateSave: false,
        language: dtLanguage,
        fnDrawCallback: function(oSettings) {
            $('a[rel="tooltip"]').tooltip();
            $('.datatable_filter input').focus();
        },
        columnDefs: [
            {
                render: function ( data, type, row ) {
                    return (row.tipo == 1) ? 'Nuevo Producto' : 'Error';
                },
                targets: 0
            },
            {
                render: function ( data, type, row ) {
                    return row.mensaje;
                },
                targets: 1
            }
        ],
        order: [[ 0, "desc" ]]
    }
    

    //Data Table
    function dtInit() {
        var id_importacion = $('#id_importacion').val();
        var dataTableNuevosOptions = jQuery.extend(true, {}, dataTableOptions);
        dataTableNuevosOptions.ajax = {
            'url': '/admin/php/providers/importacionesLogs.provider.php',
            'data': {'tipo': 1, 'id_importacion': id_importacion}
        }
        $('#datatable-nuevos').DataTable(dataTableNuevosOptions);

        var dataTableErroresOptions = jQuery.extend(true, {}, dataTableOptions);
        dataTableErroresOptions.ajax = {
            'url': '/admin/php/providers/importacionesLogs.provider.php',
            'data': {'tipo': 2, 'id_importacion': id_importacion}
        }
        $('#datatable-errores').DataTable(dataTableErroresOptions);
    }
    //fin Data Table

    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Importaciones.init();
});