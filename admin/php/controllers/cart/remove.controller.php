<?php
session_start();
unset($_SESSION['cart'][$_POST['producto_id']]);
header('Content-Type: application/json');
echo(json_encode(array('success' => true)));
