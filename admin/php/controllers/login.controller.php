<?php
session_start();
include_once('../bootstrap.php');
if ($user = Usuario::checkLogin($_POST['usuario'], $_POST['pass'])) {
    $_SESSION['admin'] = 'validUser';
    $_SESSION['admin_id'] = $user->id;
    header('location: ../../');
} else {
    session_destroy();
    header('location: ../../login#error');
    exit();
}
