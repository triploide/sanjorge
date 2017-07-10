<?php
if (!defined('CONFIG')) include('../includes/config.php');
$html = file_get_contents(INC.'admin/tpl/clientes/form.tpl');
if (isset($_GET['id'])) {
    if ($cliente = Doctrine::getTable('Cliente')->find($_GET['id'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'admin/php/replacers/cliente.full.replacer.php');
    } else {
        $html = file_get_contents('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'admin/php/replacers/cliente.void.replacer.php');
}
echo($html);
