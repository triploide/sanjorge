<?php
if (!defined('CONFIG')) include('../includes/config.php');
$html = file_get_contents(INC.'admin/tpl/productos/form.tpl');
$imagesTpl = file_get_contents(INC.'admin/tpl/plugins/superbox-item.tpl');
if (isset($_GET['slug'])) {
    if ($producto = Doctrine::getTable('Producto')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'admin/php/replacers/producto.full.replacer.php');
    } else {
        $html = file_get_contents('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'admin/php/replacers/producto.void.replacer.php');
}
echo($html);
