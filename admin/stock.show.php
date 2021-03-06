<?php require 'php/includes/config.php'; ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <?php include(INC.'admin/tpl/partials/head.tpl') ?>
</head>
<body>
    <?php include(INC.'admin/tpl/partials/header.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/nav.tpl'); ?>
    
    <?php include(INC.'admin/tpl/stock/show.tpl'); ?>

    <?php include(INC.'admin/tpl/partials/footer.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/scripts.tpl'); ?>

    <input type="hidden" name="id_stock_log" id="id_stock_log" value="<?php echo($_GET['id']) ?>">

    <script src="js/plugin/datatables/i18n/spanish.js"></script>
    <script src="js/plugin/datatables/jquery.dataTables.min.js"></script>
    <script src="js/plugin/datatables/dataTables.colVis.min.js"></script>
    <script src="js/plugin/datatables/dataTables.tableTools.min.js"></script>
    <script src="js/plugin/datatables/dataTables.bootstrap.min.js"></script>
    <script src="js/plugin/datatable-responsive/datatables.responsive.min.js"></script>

    <script src="js/stock-show.js"></script>
</body>
</html>