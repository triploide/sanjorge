var Pedido = (function (w, $, undefined) {

    function init () {
        stepperInit();
        removerProducto();
        listeners();
    }

    function stepperInit () {
        $("input[type='number']").stepper().on('keypress', function (e) {
            e.preventDefault();
            return false;
        }).on('change', function () {
            var $this = $(this);
            $.ajax({
                url: '/carrito/refrescar',
                type: 'post',
                data: {producto_id: $this.data('id'), cantidad: $this.val()}
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
                    $this.parents('tr').remove()
                    totalItems = $("#nav-pedido .badge").text()*1;
                    totalItems = --totalItems || '';
                    $("#nav-pedido .badge").text(totalItems);
                    actualizarTotal();
                    if (!$('#datatable tbody tr').length) {
                        $('#datatable tbody').append('<tr style="height: 100px"><td colspan="6" style="text-align: center; vertical-align:middle">No hay productos seleccionados</td><tr>')
                        $('#datatable tfoot').hide();
                        $('#btn-pedido').hide();
                    }
                }
            });
        });
    }

    function listeners () {
        $('input[name="cantidad[]"]').on('change', function () {
            actualizarTotal();
        });
        $('a[href="hacer-pedido"]').on('click', function (e) {
            e.preventDefault();
            hacerPedido();
        })
    }

    function actualizarTotal () {
        var precio, cantidad, total, totalFinal = 0;
        $('#datatable tbody tr').each(function () {
            precio = $(this).find('.precio').text().replace(/[^0-9]+/g, '');
            cantidad = $(this).find('.cantidad').val();
            totalFinal += parseInt(precio * cantidad);
            total = parseInt(precio * cantidad).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            $(this).find('.total').text('$ ' + total);
        });
        totalFinal = totalFinal.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        $('#datatable .total-final strong').text('$ ' + totalFinal)
    }

    function hacerPedido () {
        $('a[href="hacer-pedido"]').attr('disabled', true);
        $('a[href="hacer-pedido"] span.fa').show();
        $('a[href="hacer-pedido"] span.text').text('Espere...');
        if (!$('a[href="hacer-pedido"]').is(':disabled')) {
            var data = [], producto_id, cantidad;
            $('#datatable tbody tr').each(function () {
                producto_id = $(this).find('.cantidad').data('id');
                cantidad = $(this).find('.cantidad').val();
                data.push('producto_id[]='+producto_id+'&cantidad[]='+cantidad);
            });
            $.ajax({
                url: '/carrito/comprar',
                type: 'post',
                data: data.join('&'),
                success: function () {
                    location.href = '/clientes/pedido/exito'
                }
            });
        }
    }
    
    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

$(document).ready(function () {
    Pedido.init();
});