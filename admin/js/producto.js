var Producto = (function (window, $, undefined) {

    var superboxItem =  $('#superboxItem').val(),
        formImagen = $('#formImagen').val()
    ;

    function init () {
        $('[data-nav="productos"]').addClass('active');

        ajaxFileUpload(); //carga de imagenes
        $('#sliderImagenes').sortable({
            start: function(e, ui){
                ui.placeholder.height(30);
            },
            update: function (e, ui) {
                ordenar();
            }
        });
        $('.superbox-list').show();
        toggleSliderEmpty();
        listeners();
        togglePrecio();
    }

    //listeners
    function listeners () {
        $('.saveForm').on('click', function () {
            var textareaNames = ['contenido'];
            $('.summernote').each(function (i) {
                $('textarea[name="'+textareaNames[i]+'"]').val($(this).summernote('code'));
            })
            $('#form').submit();
        });
        $('#sliderImagenes').on('click', '.btn-danger', function () {
            borrar($(this));
        });
        $('#tipo-precio').on('change', function() {
            togglePrecio();
        });
        $('input[data-type="float"]').on('keypress', function (e) {
            if (e.which == 44) {
                $(this).val($(this).val() + '.');
            }
            if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    }

    //toggle precio
    function togglePrecio() {
        if ($('#tipo-precio').val() == 1) {
            $('input[name="margen"]').attr('disabled', false);
            $('input[name="precio"]').attr('disabled', true);
            $('input[name="precio"]').val('');
        } else {
            $('input[name="precio"]').attr('disabled', false);
            $('input[name="margen"]').attr('disabled', true);
            $('input[name="margen"]').val('');
        }
    }

    //cargar imagen
    function ajaxFileUpload () {
        var html;
        $('#imagesUploader').ajaxForm({
            beforeSend: function() {
                $('#slider .widget-toolbar, #ribbon .jarviswidget-loader').show();
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                $('#slider .widget-toolbar .progress').attr('data-original-title', percentVal);
                $('#slider .progress-bar').width(percentVal).html(percentVal);
            },
            success: function (imagenes) {
                if (imagenes.length) {
                    html = '';
                    for (var i=0, l=imagenes.length; i<l; i++) {
                        html += superboxItem.replace('${src}', imagenes[i].src)
                            .replace(/\$\{id\}/g, imagenes[i].id);
                        Imagenes[imagenes[i].id] = imagenes[i];
                    }
                    $('#sliderImagenes').append(html);
                    $('#sliderImagenes').find('.superbox-list:hidden').fadeIn();
                    toggleSliderEmpty();
                }
                $('#sliderImagenes')
                    .sortable( 'destroy' )
                    .sortable({
                        start: function(e, ui){
                            ui.placeholder.height(30);
                        },
                        update: function (e, ui) {
                            ordenar();
                        }
                    });
                $('#slider .widget-toolbar, #slider .jarviswidget-loader').hide();
                $('#slider .widget-toolbar .progress').attr('data-original-title', '0%');
                $('#slider .progress-bar').width('0%').html('0%');
            }
        });
    }

    //ordenar
    function ordenar () {
        var data = '', id;
        $('#sliderImagenes .sortable').each(function (i) {
            data += '&orden[]='+i;
            data += '&id[]='+$(this).attr('data-id');
        })
        $.ajax({
            type:'POST',
            url:BASE_URL+'admin/php/controllers/ordenar.controller.php',
            data: 'tabla=imagen'+data
        })    
    }

    //borrar
    function borrar ($this) {
        var id = $this.data('id');
        borrarModalInit();
        $('#modalBorrar').modal('show');
        $('#modalBorrar button.action').unbind('click').click(function () {
            loaderModalInit();
            $.ajax({
                type:'post',
                url: BASE_URL+'admin/php/erasers/imagen.eraser.php',
                data:{id:id, folder: 'productos'},
                success: function () {
                    $('#modalBorrar').modal('hide');
                    $this.parent().fadeOut(
                        500,
                        function () {
                            $this.parent().remove();
                            toggleSliderEmpty();
                        }
                    )
                        
                }
            })
        })
    }

    //chequear si hay imagenes
    function toggleSliderEmpty () {
        if ($('#sliderImagenes .superbox-list').length != 0) {
            $('#sliderImagenes .empty').hide();
        } else {
            $('#sliderImagenes .empty').show();
        }
    }
    
    //modal
    function borrarModalInit () {
        $('#modalBorrar .modal-title .text').html('Borrar');
        $('#modalBorrar .modal-title .jarviswidget-loader').hide();
        $('#modalBorrar .modal-body .content').html('<p>¿Est&aacute; seguro que desea borrar esta imagen?</p>');
        $('#modalBorrar button.action').removeClass('btn-success').addClass('btn-danger').html('Borrar');
        $('#modalBorrar .modal-footer button').attr('disabled', false);
        $('#modalBorrar .modal-footer button.btn-default').show();
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
        },
        forceUpload: function (el) {
            $(el).parents('form').find('input[type="submit"]').trigger('click');
        }
    }
})(window, jQuery, undefined);

Producto.init();