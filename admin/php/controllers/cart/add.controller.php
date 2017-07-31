<?php
session_start();

if (!isset($_SESSION['cart']) || !in_array($_POST['producto_id'], $_SESSION['cart'])) {
    $_SESSION['cart'][$_POST['producto_id']] = array(
        'cantidad' => 1,
        'producto_id' => $_POST['producto_id']
    );
}

header('Content-Type: application/json');
echo(json_encode($_SESSION['cart']));
