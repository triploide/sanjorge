var Pedidos = (function (w, $, undefined) {

    function init () {
        dtInit();
        estado();
        borrar();
        borrarModalInit();
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
        },
        normalizeDate: function (date) {
            return (!date)?'':date.replace(/.*([0-9]{4})-([0-9]{2})-([0-9]{2}).*/, '$3-$2-$1');
        },
        labelMap: {
            data: {
                1:{i:1, label:'success', value:'Entregado'},
                2:{i:2, label:'warning', value:'Pendiente'},
                3:{i:3, label:'danger', value:'Cancelado'}
            },
            getLabel: function (estado) {
                return this.data[estado];
            },
            render : function (row) {
                var estado = this.data[row.estado];
                return '<span data-id="'+row.id+'" data-estado="'+estado.i+'" class="estado switch-state label label-'+estado.label+'">'+estado.value+'</span>'
            }
        },
        acciones: function (row) {
            return '\
                <a href="pedidos/'+row.id+'" title="Ver" rel="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>\
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
                url: BASE_URL + 'admin/php/providers/pedidos.provider.php',
                /*data: function(d) {
                    d.designId = di;
                }*/
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
                        return formatData.normalizeDate(row.fecha)
                    },
                    targets: 0
                },
                {
                    render: function(data, type, row) {
                        return row.cliente
                    },
                    targets: 1
                },
                {
                    render: function(data, type, row) {
                        return row.total
                    },
                    targets: 2
                },
                {
                    render: function(data, type, row) {
                        return formatData.labelMap.render(row)
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

    //ESTADO
    function nextState(state) {
        if (--state == 0) state=3;
        return state;
    }
    function estado () {
        var $this, estado_id, estado, waiting = false;
        $('#datatable').on('click', '.estado', function () {
            $this = $(this);
            estado_id = nextState($this.data('estado'));
            if (!waiting) {
                waiting = true;
                $.ajax({
                    type:'post',
                    url:BASE_URL+'admin/php/controllers/pedido.controller.php',
                    data:{id:$this.data('id'), estado_id:estado_id, estadoSwitcher:1},
                    success: function () {
                        estado = formatData.labelMap.getLabel(estado_id);
                        $this.data('estado', estado_id)
                            .removeClass('label-succes label-warning label-danger')
                            .addClass('label-'+estado.label)
                            .text(estado.value);
                        waiting = false;
                    }
                });
            }
        });
    }
    //FIN ESTADO

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
                    url: BASE_URL+'admin/php/erasers/pedido.eraser.php',
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
        $('#modalBorrar .modal-title .text').html('Borrar Pedido');
        $('#modalBorrar .modal-title .jarviswidget-loader').hide();
        $('#modalBorrar .modal-body .content').html('<p>¿Está seguro que desea borrar este pedido?</p>');
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
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Pedidos.init();
});