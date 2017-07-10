<?php
if (!defined('CONFIG')) include('../includes/config.php');
$html = file_get_contents(INC.'admin/tpl/categorias/form.tpl');
if (isset($_GET['slug'])) {
    if ($categoria = Doctrine::getTable('Categoria')->findOneBySlug($_GET['slug'])) {
        $accion = 'Editar';
        $icon = 'pencil';
        include(INC.'admin/php/replacers/categoria.full.replacer.php');
    } else {
        $html = Archivo::leer('tpl/error-404.tpl');
    }
} else {
    $accion = 'Cargar';
    $icon = 'plus';
    include(INC.'admin/php/replacers/categoria.void.replacer.php');
}
echo($html);
