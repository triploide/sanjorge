<?php
include_once('../includes/config.php');

$pedido = Doctrine::getTable('Pedido')->find($_POST['id']);
$pedido->id_estado = $_POST['estado_id'];
$pedido->save();
header('Content-Type: application/json');
echo(json_encode(array('success' => true)));
