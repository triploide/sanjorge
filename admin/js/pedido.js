var Pedido = (function (w, $, undefined) {

    function init () {
        dtInit();
        $('#left-panel li[data-nav="pedidos"]').addClass('active');
    }

    var dataTable, currentRow = 0,
        responsiveHelper_dt_basic = undefined,
        breakpointDefinition = {
            tablet : 1024,
            phone : 480
        },
        estados = [
            
        ];
    ;
    //labels
    var formatData = {
        shortenerText: function (text, length) {
            length = length || 34;
            return (text.length > length)?'<a href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title=\''+text+'\' data-html="false">'+text.substring(0, length)+'...'+'</a>':text;
        }
        //fin label
    };
    //fin labels

    //Data Table
    function dtInit() {
        var pedido_id = $('#pedido_id').val();
        dataTable = $('#datatable').DataTable({
             "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: BASE_URL + 'admin/php/providers/items.provider.php',
                data: function(d) {
                    d.pedido_id = pedido_id;
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
                        return row.codigo
                    },
                    targets: 0
                },
                {
                    render: function(data, type, row) {
                        return formatData.shortenerText(row.producto)
                    },
                    targets: 1
                },
                {
                    render: function(data, type, row) {
                        return row.categoria
                    },
                    targets: 2
                },
                {
                    render: function(data, type, row) {
                        return row.ubicacion
                    },
                    targets: 3
                },
                {
                    render: function(data, type, row) {
                        return parseInt(row.cantidad).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    },
                    targets: 4
                },
                {
                    render: function(data, type, row) {
                        return '$ ' + parseInt(row.precio).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    },
                    targets: 5
                },
                {
                    render: function(data, type, row) {
                        return '$ ' + parseInt(row.total).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    },
                    targets: 6
                }
            ],
            order: [[ 1, "desc" ]]
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
    Pedido.init();
});