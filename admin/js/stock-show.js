var Stocks = (function (w, $, undefined) {

    function init () {
        dtInit();
        $('#left-panel li[data-nav="stock"]').addClass('active');
    }

    var dataTable, currentRow = 0,
        responsiveHelper_dt_basic = undefined,
        breakpointDefinition = {
            tablet : 1024,
            phone : 480
        }
    ;

    //Data Table
    function dtInit() {
        var id_stock_log = $('#id_stock_log').val();
        dataTable = $('#datatable').DataTable({
             "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: BASE_URL + 'admin/php/providers/stockItems.provider.php',
                data: function(d) {
                    d.id_stock_log = id_stock_log;
                }
            },
            language: dtLanguage,
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_dt_basic) {
                    responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#datatable'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow, aData) {
                responsiveHelper_dt_basic.createExpandIcon(nRow);
            },
            fnDrawCallback: function(oSettings) {
                $('a[rel="tooltip"]').tooltip();
                $('.datatable_filter input').focus();
                responsiveHelper_dt_basic.respond();
            },
            columnDefs: [
                {
                    render: function ( data, type, row ) {
                        return row.codigo;
                    },
                    targets: 0
                },
                {
                    render: function ( data, type, row ) {
                        return row.producto;
                    },
                    targets: 1
                },
                {
                    render: function(data, type, row) {
                        return row.costo
                    },
                    targets: 2
                },
                {
                    render: function(data, type, row) {
                        return row.cantidad;
                    },
                    targets: 3
                },
                {
                    render: function(data, type, row) {
                        return row.total;
                    },
                    targets: 4
                },
            ],
            order: [[ 0, "desc" ]]
        });
    }
    //fin Data Table
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Stocks.init();
});