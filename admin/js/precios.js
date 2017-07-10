var itemTpl, enterPress = false;

$(document).ready(function () {
    itemTpl = $('#itemTpl').val();
    save();
    $('.addItem').click(addItem);
    $('body').on('keydown', function (e) {
        if (e.ctrlKey && e.keyCode==13) {
            e.preventDefault();
            $('#formPedido').submit();
        }
    })
    $('#precios tbody')
        .on('keydown', 'input', function (e) {
            if(e.keyCode==13) {
                e.preventDefault();
                addItem();
            }
            if(e.keyCode == 46) removeItem($(this));
        });
    inputsListeners($('#precios tbody tr:last'))
    $('#left-panel li[data-nav="precios"]').addClass('active');
    tabIndex();
    $('#precios').on('change', 'select[name="tipo_precio"]', function() {
        togglePrecio(this);
    });
    $('#precios').on('keypress', 'input[data-type="float"]',function (e) {
        if (e.which == 44) {
            $(this).val($(this).val() + '.');
        }
        if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});

//toggle precio
function togglePrecio(self) {
    var $row = $(self).parents('tr'), realvalue;
    if ($(self).val() == 1) {
        realvalue = $row.find('input[name="margen"]').data('realvalue');
        $row.find('input[name="margen"]').attr('disabled', false).val(realvalue);
        $row.find('input[name="precio"]').attr('disabled', true);
        $row.find('input[name="precio"]').val('');
    } else {
        realvalue = $row.find('input[name="precio"]').data('realvalue');
        $row.find('input[name="precio"]').attr('disabled', false).val(realvalue);
        $row.find('input[name="margen"]').attr('disabled', true);
        $row.find('input[name="margen"]').val('');
    }
}

function tabIndex () {
    $('.jarviswidget-fullscreen-btn').attr('tabindex', '-1');
}

function precio ($tr, item) {
    var $select = $tr.find('select'),
        val = (!item.margen)?2:1;
    $select.val(val);
    togglePrecio($select);
    if (!item.margen) {
        $tr.find('input[name="precio"]').val(item.precio).data('realvalue', item.precio);
        $tr.find('input[name="margen"]').data('realvalue', '');
    } else {
        $tr.find('input[name="margen"]').val(item.margen).data('realvalue', item.margen);
        $tr.find('input[name="precio"]').data('realvalue', '');
    }
}

function inputsListeners ($tr) {
    $tr.find('input[name="nombre"]').autocomplete({
        source:nombresAutocomplete,
        response: function (event, ui) {
            if (ui.content.length) {
                $(event.target).parents('tr').find('input[name="codigo"]').val(ui.content[0].codigo);
                $(this).data({currentItem:ui.content[0]})
            }
        },
        focus: function (event, ui) {
            event.target.value = ui.item.label;
            $(event.target).parents('tr').find('input[name="codigo"]').val(ui.item.codigo);
            return false;
        },
        select: function (event, ui) {
            var $tr = $(event.target).parents('tr');
            event.target.value = ui.item.label;
            $tr.find('input[name="codigo"]').val(ui.item.codigo);
            $tr.find('input[name="cantidad"]').val(ui.item.minimo);
            $tr.find('input[name="producto"]').val(ui.item.id);
            $tr.find('input[name="costo"]').val(ui.item.costo);
            precio($tr, ui.item);
            return false;
        },
        change: function (event, ui) {
            if (ui.item == null) {
                var $tr = $(event.target).parents('tr'), item = $(this).data('currentItem');
                event.target.value = item.label;
                $tr.find('input[name="nombre"]').val(item.nombre)
                $tr.find('input[name="codigo"]').val(item.codigo);
                $tr.find('input[name="cantidad"]').val(item.minimo);
                $tr.find('input[name="producto"]').val(item.id);
                $tr.find('input[name="costo"]').val(item.costo);
                precio($tr, item);
            }
        },
        _renderItem: function( ul, item ) {
            return $( "<li>" )
            .append( "<a>" + item.label+"</a>" )
            .appendTo( ul );
        }
    });
    
    $tr.find('input[name="codigo"]').autocomplete({
        source:codigosAutocomplete,
        response: function (event, ui) {
            if (ui.content.length) {
                $(event.target).parents('tr').find('input[name="nombre"]').val(ui.content[0].nombre);
                $(event.target).parents('tr').find('input[name="costo"]').val(ui.content[0].costo);
                $(this).data({currentItem:ui.content[0]})
            }
        },
        focus: function (event, ui) {
            event.target.value = ui.item.label;
            $(event.target).parents('tr').find('input[name="nombre"]').val(ui.item.nombre);
            $(event.target).parents('tr').find('input[name="costo"]').val(ui.item.costo);
            return false;
        },
        select: function (event, ui) {
            var $tr = $(event.target).parents('tr');
            event.target.value = ui.item.label;
            $tr.find('input[name="nombre"]').val(ui.item.nombre)
            $tr.find('input[name="codigo"]').val(ui.item.codigo);
            $tr.find('input[name="cantidad"]').val(ui.item.minimo);
            $tr.find('input[name="producto"]').val(ui.item.id);
            $tr.find('input[name="costo"]').val(ui.item.costo);
            precio ($tr, ui.item)
            return false;
        },
        change: function (event, ui) {
            if (ui.item == null) {
                var $tr = $(event.target).parents('tr'), item = $(this).data('currentItem');
                event.target.value = item.label;
                $tr.find('input[name="nombre"]').val(item.nombre)
                $tr.find('input[name="codigo"]').val(item.codigo);
                $tr.find('input[name="cantidad"]').val(item.minimo);
                $tr.find('input[name="producto"]').val(item.id);
                $tr.find('input[name="costo"]').val(item.costo);
                precio ($tr, item)
            }
        },
        _renderItem: function( ul, item ) {
            return $( "<li>" )
            .append( "<a>" + item.label+"</a>" )
            .appendTo( ul );
        }
    });
}

function save () {
    var response = {
        items: new Array()
    };
    $('#form').submit(function (event) {
        $('#precios tr').each(function (i) {
            if (i) {
                response.items.push({
                    producto: $(this).find('input[name="producto"]').val(),
                    costo: $(this).find('input[name="costo"]').val(),
                    tipo_precio: $(this).find('select[name="tipo_precio"]').val(),
                    margen: $(this).find('input[name="margen"]').val(),
                    precio: $(this).find('input[name="precio"]').val()
                });
            }
        });
        $('#form').append('<input type="hidden" name="items" value="'+JSON.stringify(response).replace(/"/g, "'")+'" />');
        return true;
    });
}

function addItem() {
    var html = itemTpl.replace('${item}', 0).replace('${producto}', 0).replace(/\$\{[a-zA-Z0-9_-]+\}/g, '');
    $('#precios tbody').append(html);
    $('#precios tbody tr:last input:first').focus();
    inputsListeners($('#precios tbody tr:last'));
}

function removeItem (a) {
    $(a).parents('tr').remove();
    $('#previos tbody tr:last input:first').focus();
}