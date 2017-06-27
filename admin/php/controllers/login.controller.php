<?php
session_start();
include_once('../bootstrap.php');
if ($user = User::checkLogin($_POST['user'], $_POST['pass'])) {
    if ($user->state_id == State::VISIBLE) {
        $_SESSION['chisel_log'] = 'validUser';
        $_SESSION['chisel_user_id'] = $user->id;
        header('location: ../../');
    } else {
        session_destroy();
        header('location: ../../login#banned');
        exit();
    }
} else {
    session_destroy();
    header('location: ../../login#error');
    exit();
}
