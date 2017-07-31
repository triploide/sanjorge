<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$pedido = Doctrine::getTable('Pedido')->find($_POST['id']);
$pedido->items->delete();
$pedido->delete();

$response = array('success' => true);
header('Content-Type: application/json');
echo(json_encode($response));
