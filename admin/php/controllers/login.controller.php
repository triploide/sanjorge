<?php
session_start();
include_once('../bootstrap.php');
if ($user = Usuario::checkLogin($_POST['usuario'], $_POST['pass'])) {
    $_SESSION['chisel_log'] = 'validUser';
    $_SESSION['chisel_user_id'] = $user->id;
    header('location: ../../');
} else {
    session_destroy();
    header('location: ../../login#error');
    exit();
}
