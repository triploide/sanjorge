<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$categoria = Doctrine::getTable('Categoria')->find($_POST['id']);

$response = array('success' => true);
if($categoria->hasProductos()) {
    $response['success'] = false;
    $response['error'] = 'No se puede borrar una categoría que contiene productos';
} else {
    $categoria->estado = 2;
    $categoria->save();
}

header('Content-Type: application/json');
echo(json_encode($response));
