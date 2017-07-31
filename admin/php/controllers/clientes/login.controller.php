<?php
session_start();
require '../../bootstrap.php';
require '../../includes/definer.php';
if ($user = Cliente::checkLogin($_POST['usuario'], $_POST['pass'])) {
    $_SESSION['cliente'] = 'validUser';
    $_SESSION['cliente_id'] = $user->id;
    header('location: ' . URL . 'clientes/productos');
} else {
    session_destroy();
    header('location: ' . URL . 'clientes/acceder#error');
    exit();
}
