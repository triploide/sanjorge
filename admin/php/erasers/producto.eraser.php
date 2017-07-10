<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$producto = Doctrine::getTable('Producto')->find($_POST['id']);
$producto->id_estado = EstadoProducto::BORRADO;
$producto->save();

$response = array('success' => true);
header('Content-Type: application/json');
echo(json_encode($response));
