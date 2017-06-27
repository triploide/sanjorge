var Categorias = (function (window, $, undefined) {

    function init () {
        $('[data-nav="categorias"]').addClass('active');
        dtInit();
        add();
        borrar();
    }

    var formatData = {
        labelMap: {
            data: {
                1:{i: 1,'label':'success','value':'Visible'},
                2:{i: 2,'label':'warning','value':'Oculta'}
            },
            getLabel: function (estado) {
                return this.data[estado];
            },
            render : function (row) {
                var estado = this.data[row.estado_id];
                return '<span data-id="'+row.slug+'" data-estado="'+estado.i+'" class="estado switch-state label label-'+estado.label+'">'+estado.value+'</span>'
            }
        },
        acciones: function (row) {
            return '\
                <a href="'+BASE_URL+'admin/categorias/'+row.slug+'" class="btn btn-primary btn-sm" title="Editar" rel="tooltip"><i class="fa fa-pencil"></i></a>\
                <a data-id="'+row.id+'" class="borrar btn btn-danger btn-sm" title="Borrar" rel="tooltip"><i class="fa fa-trash-o"></i></a>\
            ';
        }
    }
    
    //tpl
    function getTplRow () {
        if (tplRow == undefined) {
            tplRow = $('#tplRowTag').val();
        }
        return tplRow;
    }
    //fin tpl

    //Data Table
    function dtInit () {
        var start = (Cookie.readCookie('tableCategorias') != null)?Cookie.readCookie('tableCategorias')*10:0;
        var options = {
            columnDefs: [
                {
                    render: function ( data, type, row ) {return row.value;},
                    targets: 0
                },
                {
                    render: function ( data, type, row ) {return row.total_posts},
                    targets: 1
                },
                {
                    render: function ( data, type, row ) {return formatData.labelMap.render(row)},
                    targets: 2
                },
                {
                    render: function ( data, type, row ) {return formatData.acciones(row)},
                    targets: 3
                }
            ],
            ordering: false,
            displayStart: start
        }
        dataTable = $('#datatable').dataTable($.extend(options, datatableDefault));
        //paginado
        dataTable.on('page.dt', function () {
            var page = dataTable.api().page.info().page
            Cookie.createCookie('datatable', page);
        });
    }
    
    //borrar
    function borrar () {
        var id;
        $('#datatable').on('click', '.borrar', function (event) {
            id = $(this).attr('data-id');
            event.preventDefault();
            $('#modal-borrar').modal('show');
            $('#modal-borrar .action').off('click').on('click', function () {
                $('#modal-borrar .modal-footer button').unbind('click');
                $('#modal-borrar').addClass('loading');
                $.ajax({
                    type:'post',
                    url: BASE_URL+'admin/php/erasers/categoria.eraser.php',
                    data:{'id':id},
                    success: function (response) {
                        if (response.success) {
                            $('#modal-borrar').removeClass('loading').modal('hide');
                            $('#row'+id).fadeOut(
                                500,
                                function () {
                                    $('#row'+id).remove();
                                    if ($('#datatables tbody tr').length == 0) {
                                        dataTable.ajax.reload();
                                    }
                                }
                            );
                        } else {
                            Box.small(reponse.message).success().show();
                        }
                    }
                });
            });
        });
    }
    //fin borrar
    
    //funciones
    function add() {
        var data;
        $('a[href="agregar-categoria"]').on('click', function(event) {
            event.preventDefault();
            addModalInit();
            $('#modal-form').modal('show');
            $('#modal-form .action').off('click').on('click', function () {
                data = $('#modal-form form').serialize();
                $('#modal-form form #value').val('');
                $('#modal-form .modal-footer button').unbind('click');
                $('#modal-form').addClass('loading');
                save(data, function (tag) {
                    $('#modal-form').removeClass('loading').modal('hide');
                    var html = getTplRow().replace(/\$\{id\}/g, tag.id)
                        .replace(/\$\{value\}/g, tag.value)
                        .replace(/\$\{acciones\}/g, formatData.acciones(tag));
                    $('#datatable .dataTables_empty').parents('tr').remove();
                    $('#datatable tbody').prepend(html).find('tr:first td').animate({backgroundColor: "#ecf3f8"}, 700, 'easeOutCubic', function() {
                        $('#datatable tbody tr:first td').animate({backgroundColor: "#fff"}, 800, 'easeInCubic')
                    });
                    onAddComplete();
                });
            });
        });
    }
    
    function save (data, callback) {
        $.ajax({
            type:'post',
            url:BASE_URL+'admin/php/controllers/categoria.controller.php',
            data:data,
            success: function (response) {
                callback(response);
            }
        });
    }
    //fin funciones
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

Categorias.init();