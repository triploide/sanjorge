var Importaciones = (function (w, $, undefined) {

    function init () {
        boxes();
        borrar();
        dtInit();
        borrarModalInit();
        $('#left-panel li[data-nav="importar"]').addClass('active');
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
        normalizeDate: function (date) {
            return (!date)?'':date.replace(/.*([0-9]{4})-([0-9]{2})-([0-9]{2}).*/, '$3-$2-$1');
        },
        acciones: function (row) {
            return '\
                <a href="/admin/importaciones/'+row.id+'" title="Ver" rel="tooltip" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>\
                <a data-id="'+row.id+'" title="Borrar" rel="tooltip" class="borrar btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>\
            ';
        }
        //fin label
    };
    //fin labels

    //Data Table
    function dtInit() {
        dataTable = $('#datatable').DataTable({
            "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: BASE_URL + 'admin/php/providers/importaciones.provider.php',
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
                        return formatData.normalizeDate(row.fecha);
                    },
                    targets: 0
                },
                {
                    render: function ( data, type, row ) {
                        return row.total_errores;
                    },
                    targets: 1
                },
                {
                    render: function(data, type, row) {
                        return row.total_nuevos;
                    },
                    targets: 2
                },
                {
                    render: function ( data, type, row ) {
                        return row.total_general;
                    },
                    targets: 3
                },
                {
                    render: function(data, type, row) {
                        return formatData.acciones(row);
                    },
                    targets: 4
                },
                { 
                    sortable: false,
                    targets: [4]
                }
            ],
            order: [[ 0, "desc" ]]
        });
    }
    //fin Data Table

    //borrar
    function borrar () {
        var id;
        $('#datatable').on('click', '.borrar', function (event) {
            $this = $(this);
            id = $(this).attr('data-id');
            event.preventDefault();
            borrarModalInit();
            $('#modalBorrar').modal('show');
            $('#modalBorrar .action').click(function () {
                $('#modalBorrar .modal-footer button').unbind('click');
                loaderModalInit();
                $.ajax({
                    type:'post',
                    url: BASE_URL+'admin/php/erasers/importacion.eraser.php',
                    data:{'id':id},
                    success: function (response) {
                        $('#modalBorrar').modal('hide');
                        if (response.success) {
                            $this.parents('tr').fadeOut(
                                500,
                                function () {
                                    $this.parents('tr').remove();
                                    if ($('#datatable tbody tr').length == 0) {
                                        dataTable.ajax.reload();
                                    }
                                }
                            );
                        } else {
                            Box.small({title: response.error}).error().show();
                        }
                    }
                });
            });
        });
    }
    //fin borrar

    //modal   
    function borrarModalInit () {
        $('#modalBorrar .modal-title .text').html('Borrar Importación');
        $('#modalBorrar .modal-title .jarviswidget-loader').hide();
        $('#modalBorrar .modal-body .content').html('<p>¿Está seguro que desea borrar esta importación?</p>');
        $('#modalBorrar button.action').attr('data-id', false);
        $('#modalBorrar .modal-footer button').attr('disabled', false);
        $('#modalBorrar .modal-footer button.btn-default').show();
        $('#modalBorrar .modal-dialog').css('width', '');
    }

    function loaderModalInit() {
        $('#modalBorrar .modal-title .jarviswidget-loader').show();
        $('#modalBorrar .modal-body .content').html('Por favor espere...');
        $('#modalBorrar .modal-footer button').attr('disabled', true);
    }
    //fin modal
    
    function boxes () {
        Box.small({title:'La importación <br>se realizó con éxito'}).success().showIfHash('success');
    }
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Importaciones.init();
});