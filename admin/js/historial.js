var Historial = (function (w, $, undefined) {

    function init () {
        dtInit();
        $('#left-panel li[data-nav="productos"]').addClass('active');
    }

    var dataTable, currentRow = 0,
        responsiveHelper_dt_basic = undefined,
        breakpointDefinition = {
            tablet : 1024,
            phone : 480
        }
    ;
    //labels
    var formatData = {
        shortenerText: function (text, length) {
            length = length || 34;
            return (text.length > length)?'<a href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title=\''+text+'\' data-html="false">'+text.substring(0, length)+'...'+'</a>':text;
        },
        normalizeDate: function (date) {
            return (!date)?'':date.replace(/.*([0-9]{4})-([0-9]{2})-([0-9]{2}).*/, '$3-$2-$1');
        },
        labelMap: {
            data: {
                1:{i: 1,'label':'success','value':'Visible'},
                2:{i: 2,'label':'warning','value':'Oculto'}
            },
            getLabel: function (estado) {
                return this.data[estado];
            },
            render : function (row) {
                var estado = this.data[row.estado];
                return '<span data-id="'+row.id+'" data-estado="'+estado.i+'" class="estado switch-state label label-'+estado.label+'">'+estado.value+'</span>'
            }
        },
        //fin label
    };
    //fin labels

    //Data Table
    function dtInit() {
        var producto = $('#producto').val();
        dataTable = $('#datatable').DataTable({
             "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: BASE_URL + 'admin/php/providers/historial.provider.php',
                data: function(d) {
                    d.producto = producto;
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
                    render: function(data, type, row) {
                        return row.codigo
                    },
                    targets: 0
                },
                {
                    render: function ( data, type, row ) {
                        return formatData.shortenerText(row.nombre, 55);
                    },
                    targets: 1
                },
                {
                    render: function(data, type, row) {
                        return row.stock
                    },
                    targets: 2
                },
                {
                    render: function(data, type, row) {
                        return row.costo
                    },
                    targets: 3
                },
                {
                    render: function(data, type, row) {
                        return row.margen
                    },
                    targets: 4
                },
                {
                    render: function(data, type, row) {
                        return row.precio
                    },
                    targets: 5
                },
                {
                    render: function(data, type, row) {
                        return row.ubicacion
                    },
                    targets: 6
                },
                {
                    render: function ( data, type, row ) {
                        return formatData.labelMap.render(row)
                    },
                    targets: 7
                },
                {
                    render: function(data, type, row) {
                        return row.categoria
                    },
                    targets: 8
                },
            ],
            orderable: false,
            //order: [[ 1, "desc" ]]
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
    Historial.init();
});