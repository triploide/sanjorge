<?php require 'php/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <?php include(INC.'admin/tpl/partials/head.tpl') ?>
</head>
<body>
    <?php include(INC.'admin/tpl/partials/header.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/nav.tpl'); ?>
    
    <?php include(INC.'admin/tpl/stock/create.tpl'); ?>

    <?php include(INC.'admin/tpl/partials/footer.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/scripts.tpl'); ?>

    <textarea id="itemTpl" class="hidden"><?php include('tpl/stock/_row.tpl'); ?></textarea>

    <script src="js/plugin/datatables/i18n/spanish.js"></script>
    <script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

    <script type="text/javascript">
        var codigosAutocomplete = <?php include('php/autocompletes/productosByCodigo.autocomplete.php'); ?>;
        var nombresAutocomplete = <?php include('php/autocompletes/productosByNombre.autocomplete.php'); ?>;
    </script>

    <script src="js/stock-create.js"></script>
</body>
</html>