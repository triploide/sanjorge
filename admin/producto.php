<?php include('php/includes/config.php'); ?>
<!DOCTYPE html>
<html lang="es-ar">
<head>
    <?php include(INC.'admin/tpl/partials/head.tpl') ?>
</head>
<body>
    <?php include(INC.'admin/tpl/partials/header.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/nav.tpl'); ?>
    
    <?php include(INC.'admin/php/printers/producto.printer.php'); ?>

    <?php include(INC.'admin/tpl/partials/footer.tpl'); ?>
    <?php include(INC.'admin/tpl/partials/scripts.tpl'); ?>

    <?php include(INC.'admin/tpl/modals/borrar.tpl'); ?>

    <!-- tpls -->
    <textarea class="hidden" id="superboxItem"><?php include('tpl/plugins/superbox-item.tpl'); ?></textarea>
    <textarea class="hidden" id="formImagen"><?php include('tpl/plugins/formImagen.tpl'); ?></textarea>
    <!-- /tpls -->

    <!-- PAGE RELATED PLUGIN(S) -->
    <script src="js/plugin/jquery-form/jquery-form.min.js"></script>
    <script src="js/Replacer.js"></script>

    <script src="js/producto.js"></script>
</body>
</html>