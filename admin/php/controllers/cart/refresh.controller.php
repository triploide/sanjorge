<?php
session_start();

$_SESSION['cart'][$_POST['producto_id']]['cantidad'] = $_POST['cantidad'];

header('Content-Type: application/json');
echo(json_encode($_SESSION['cart']));
