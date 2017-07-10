<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$stock = Doctrine::getTable('StockLog')->find($_POST['id']);
$stock->items->delete();
$stock->delete();

$response = array('success' => true);
header('Content-Type: application/json');
echo(json_encode($response));
