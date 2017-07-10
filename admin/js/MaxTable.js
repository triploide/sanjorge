var MaxTable = (function (w, $, undefined) {
    var events = {};

    function create($table) {
        var reponsiveHelper = undefined,
        datatableDefault = {
            sDom: "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>t<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
            autoWidth : true, processing: false, serverSide: true, stateSave: false, language: dtLanguage,
            preDrawCallback: function() {
                if (!reponsiveHelper) {
                    reponsiveHelper = new ResponsiveDatatablesHelper($table, {tablet : 1024, phone : 480});
                }
            },
            rowCallback: function(nRow, aData) {
                reponsiveHelper.createExpandIcon(nRow);
                dispatchEvent('rowCallback', nRow, aData);
            },
            drawCallback: function(oSettings) {
                $('a[rel="tooltip"]').tooltip();
                reponsiveHelper.respond();
                dispatchEvent('drawCallback', oSettings);
            }
        }
    }

    function addEvent(eventType, callback) {
        events[eventType].push(callback);
    }

    function dispatchEvent(eventType,a,b,c,d) {
        for (var i in events[eventType]) {
            events[eventType][i](a,b,c,d);
        }
    }

    return {
        create: function (name) {
            create(name);
        },
        on: function(eventType, callback) {
            function addEvent(eventType, callback);
        }
    }

})(window, jQuery);