var Cliente = (function (window, $, undefined) {

    var selectLocalidadDefualt = '<select name="localidad"><option value="">Elegir</option></select>';

    function init () {
        $('[data-nav="clientes"]').addClass('active');
        localidadesByProvincia();
    }

    function localidadesByProvincia() {
        var provincia_id;
        $('select[name="provincia"]').on('change', function() {
            provincia_id = $(this).val();
            if (provincia_id == '') {
                $('select[name="localidad"]').replaceWith(selectLocalidadDefualt);
            } else {
                $('#loader-localidad').show();
                $.ajax({
                    url: 'php/providers/localidadesByProvincia.provider.php',
                    type: 'get',
                    data: {provincia_id: provincia_id},
                    success: function (response) {
                        $('#loader-localidad').hide();
                        $('select[name="localidad"]').replaceWith(response);
                    }
                });
            }
        });
    }

    return {
        init : function () {
            init();
        }
    }
})(window, jQuery, undefined);

Cliente.init();