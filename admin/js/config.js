function sortableTableInit(nRow, aData) {};
function sortable() {};

var dataTable,
    responsiveHelper_dt_basic = undefined,
    breakpointDefinition = {
        tablet : 1024,
        phone : 480
    },
    datatableDefault = {
        "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
            "t"+
            "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
        "autoWidth" : true,
        processing: false,
        serverSide: true,
        stateSave: false,
        ajax: BASE_URL+'admin/prensa/categorias/categorias.json',
        language: dtLanguage,
        "preDrawCallback" : function() {
            if (!responsiveHelper_dt_basic) {
                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#tableCategorias'), breakpointDefinition);
            }
        },
        "rowCallback" : function(nRow, aData) {
            responsiveHelper_dt_basic.createExpandIcon(nRow);
            sortableTableInit(nRow, aData);
        },
        "drawCallback" : function(oSettings) {
            $('a[rel="tooltip"]').tooltip();
            responsiveHelper_dt_basic.respond();
            sortableTable();
        }
    }
;