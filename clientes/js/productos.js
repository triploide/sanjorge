var Productos = (function (w, $, undefined) {

    function init () {
        dtInit();
        listeners();
        agregarProducto();
        removerProducto();
    }

    function listeners () {
        $('#categoria').on('change', function() {
            dataTable.ajax.reload();
        });
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
                'path': '/content/productos/'
            },
            render: function (imagen) {
                var time = (new Date).getTime();
                imagen = imagen || this.data.noImage;
                imagen += '?'+time
                return '\
                    <a href="javascript:void(0);" rel="tooltip" data-placement="top" data-original-title="<img width=\'120\' src=\''+this.data.path+imagen+'\' class=\'online\'>" data-html="true">\
                         <img style="width:30px; border: solid 1px #ccc" src="'+this.data.path+'thumb/'+imagen+'"\
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
        acciones: function (row) {
            var agregar = '<a href="agregar-producto" data-id="'+row.id+'" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i></a>';
            var remover = '<a href="remover-producto" data-id="'+row.id+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
            return (Object.keys(productosAgregados).indexOf(row.id) == -1) ? agregar: remover;
        }
        //fin label
    };
    //fin labels

    //Data Table
    function dtInit() {
        var categoria;
        dataTable = $('#datatable').DataTable({
             "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                "t"+
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            "autoWidth" : true,
            processing: false,
            serverSide: true,
            stateSave: false,
            ajax: {
                url: '/productos/json',
                data: function(d) {
                    categoria = ($('#categoria').length)?$('#categoria').val():'';
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
                        return '$ ' + parseInt(row.precio).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                    },
                    targets: 3
                },
                {
                    render: function(data, type, row) {
                        return row.categoria
                    },
                    targets: 4
                },
                {
                    render: function(data, type, row) {
                        return formatData.acciones(row);
                    },
                    targets: 5
                },
                { 
                    sortable: false,
                    targets: [0,5]
                }
            ],
            order: [[ 1, "asc" ]]
        });
    }
    //fin Data Table

    function agregarProducto () {
        var totalItems;
        $('#datatable').on('click', 'a[href="agregar-producto"]',function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.find('i').toggleClass('fa-spin fa-spinner');
            $.ajax({
                url: '/carrito/agregar',
                type: 'post',
                data: {producto_id: $this.data('id')},
                success: function (response) {
                    $this.replaceWith('<a href="remover-producto" data-id="'+$this.data('id')+'" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>');
                    $("#nav-pedido").effect("shake", {distance: 5, times: 2});
                    totalItems = $("#nav-pedido .badge").text() || 0;
                    $("#nav-pedido .badge").text(totalItems*1+1);
                }
            });
        });
    }

    function removerProducto () {
        var totalItems;
        $('#datatable').on('click', 'a[href="remover-producto"]',function (e) {
            e.preventDefault();
            var $this = $(this);
            $this.find('i').toggleClass('fa-spin fa-spinner');
            $.ajax({
                url: '/carrito/remover',
                type: 'post',
                data: {producto_id: $this.data('id')},
                success: function (response) {
                    $this.replaceWith('<a href="agregar-producto" data-id="'+$this.data('id')+'" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i></a>');
                    //$("#nav-pedido").effect("shake", {distance: 5, times: 2});
                    totalItems = $("#nav-pedido .badge").text()*1;
                    totalItems = --totalItems || '';
                    $("#nav-pedido .badge").text(totalItems);
                }
            });
        });
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