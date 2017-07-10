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
    $('#stock tbody')
        .on('keydown', 'input', function (e) {
            if(e.keyCode==13) {
                e.preventDefault();
                addItem();
            }
            if (e.keyCode==9 && $(this).attr('name') == 'cantidad') {
                e.preventDefault();
                addItem();
            }
            if(e.keyCode == 46) removeItem($(this));
        });
    inputsListeners($('#stock tbody tr:last'))
    $('#left-panel li[data-nav="stock"]').addClass('active');
    tabIndex();
    $('#stock').on('keypress', 'input[data-type="float"]',function (e) {
        if (e.which == 44) {
            $(this).val($(this).val() + '.');
        }
        if (e.which != 46 && e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    $('#stock').on('keypress', 'input[data-type="int"]',function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
});

function tabIndex () {
    $('.jarviswidget-fullscreen-btn').attr('tabindex', '-1');
}

function inputsListeners ($tr) {
    $tr.find('input[name="nombre"]').autocomplete({
        source:nombresAutocomplete,
        response: function (event, ui) {
            if (ui.content.length) {
                $(event.target).parents('tr').find('input[name="codigo"]').val(ui.content[0].codigo);
                $(event.target).parents('tr').find('input[name="costo"]').val(ui.content[0].costo);
                $(this).data({currentItem:ui.content[0]})
            }
        },
        focus: function (event, ui) {
            event.target.value = ui.item.label;
            $(event.target).parents('tr').find('input[name="codigo"]').val(ui.item.codigo);
            $(event.target).parents('tr').find('input[name="costo"]').val(ui.item.costo);
            return false;
        },
        select: function (event, ui) {
            var $tr = $(event.target).parents('tr');
            event.target.value = ui.item.label;
            $tr.find('input[name="codigo"]').val(ui.item.codigo);
            $tr.find('input[name="cantidad"]').val(ui.item.minimo);
            $tr.find('input[name="producto"]').val(ui.item.id);
            $tr.find('input[name="costo"]').val(ui.item.costo);
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
    $('#formStock').submit(function (event) {
        $('#stock tr').each(function (i) {
            if (i) {
                response.items.push({
                    producto: $(this).find('input[name="producto"]').val(),
                    cantidad: $(this).find('input[name="cantidad"]').val(),
                    costo: $(this).find('input[name="costo"]').val()
                });
            }
        });
        $('#formStock').append('<input type="hidden" name="items" value="'+JSON.stringify(response).replace(/"/g, "'")+'" />');
        return true;
    });
}

function addItem() {
    var html = itemTpl.replace('${item}', 0).replace('${producto}', 0).replace(/\$\{[a-zA-Z0-9_-]+\}/g, '');
    $('#stock tbody').append(html)
    /*$('#stock tbody tr:last').find('.stock').spinner({
        spin: function(event, ui) {
            $(this).change();
        }
    });*/
    $('#stock tbody tr:last input:first').focus();
    inputsListeners($('#stock tbody tr:last'));
}

function removeItem (a) {
    $(a).parents('tr').remove();
    $('#stock tbody tr:last input:first').focus();
}