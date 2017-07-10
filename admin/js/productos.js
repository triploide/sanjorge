var Productos = (function (w, $, undefined) {

    function init () {
        boxes();
        estado();
        borrar();
        dtInit();
        borrarModalInit();
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
        imagen: {
            data: {
                'noImage':'imagen-no-disponible.jpg',
                'path': 'content/productos/'
            },
            render: function (imagen) {
                var time = (new Date).getTime();
                imagen = imagen || this.data.noImage;
                imagen += '?'+time
                return '\
                    <a href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title="<img width=\'120\' src=\''+BASE_URL+this.data.path+imagen+'\' class=\'online\'>" data-html="true">\
                         <img style="width:30px; border: solid 1px #ccc" src="'+BASE_URL+this.data.path+'thumb/'+imagen+'"\
                    </a>\
                ';
            }
        },
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
        acciones: function (row) {
            return '\
                <a href="producto/'+row.slug+'" title="Editar" rel="tooltip" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>\
                <a href="producto/'+row.slug+'/historial" title="Historial" rel="tooltip" class="btn btn-success btn-sm"><i class="fa fa-clock-o"></i></a>\
                <a data-id="'+row.id+'" title="Borrar" rel="tooltip" class="borrar btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>\
            ';
        }
        //fin label
    };
    //fin labels

    //Data Table
    function dtInit() {
        var categoria = ($('#categoria').length)?$('#categoria').val():'';
        dataTable = $('#datatable').DataTable({
             "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: BASE_URL + 'admin/php/providers/productos.provider.php',
                data: function(d) {
                    d.categoria = categoria;
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
                        return formatData.imagen.render(row.imagen)
                    },
                    targets: 0
                },
                {
                    render: function(data, type, row) {
                        return row.codigo
                    },
                    targets: 1
                },
                {
                    render: function ( data, type, row ) {
                        return formatData.shortenerText(row.nombre, 55);
                    },
                    targets: 2
                },
                {
                    render: function(data, type, row) {
                        return row.stock
                    },
                    targets: 3
                },
                {
                    render: function ( data, type, row ) {
                        return formatData.labelMap.render(row)
                    },
                    targets: 4
                },
                {
                    render: function(data, type, row) {
                        return row.categoria
                    },
                    targets: 5
                },
                {
                    render: function(data, type, row) {
                        return formatData.acciones(row);
                    },
                    targets: 6
                },
                { 
                    sortable: false,
                    targets: [0,6]
                }
            ],
            order: [[ 1, "asc" ]]
        });
    }
    //fin Data Table

    //ESTADO
    function estado () {
        var $this, estado_id, estado, waiting = false;
        $('#datatable').on('click', '.estado', function () {
            $this = $(this);
            estado_id = ($this.data('estado') == 1)?2:1;
            if (!waiting) {
                waiting = true;
                $.ajax({
                    type:'post',
                    url:BASE_URL+'admin/php/controllers/producto.controller.php',
                    data:{id:$this.data('id'), estado_id:estado_id, estadoSwitcher:1},
                    success: function () {
                        estado = formatData.labelMap.getLabel(estado_id);
                        $this.data('estado', estado_id)
                            .removeClass('label-succes label-warning')
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
                    url: BASE_URL+'admin/php/erasers/producto.eraser.php',
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
        $('#modalBorrar .modal-title .text').html('Borrar Producto');
        $('#modalBorrar .modal-title .jarviswidget-loader').hide();
        $('#modalBorrar .modal-body .content').html('<p>¿Está seguro que desea borrar este producto?</p>');
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
        Box.small({title:'El producto <br>se cargó con éxito'}).success().showIfHash('new');
        Box.small({title:'El producto <br>se editó con éxito'}).success().showIfHash('edit');
    }
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Productos.init();
});