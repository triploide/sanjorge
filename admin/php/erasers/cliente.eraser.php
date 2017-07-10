<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$cliente = Doctrine::getTable('Cliente')->find($_POST['id']);
$cliente->estado = 2;
$cliente->save();

header('Content-Type: application/json');
echo(json_encode(array('success' => true)));
