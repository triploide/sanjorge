<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$importacion = Doctrine::getTable('Importacion')->find($_POST['id']);
$importacion->logs->delete();
$importacion->delete();

$response = array('success' => true);
header('Content-Type: application/json');
echo(json_encode($response));
