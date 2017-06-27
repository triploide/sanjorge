<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['chisel_log']) || $_SESSION['chisel_log'] != 'validUser') {
    session_destroy();
    header('location: '.URL_CHISEL.'login');
    exit();
}
if (!$usuLog = Doctrine::getTable('users')->find($_SESSION['chisel_user_id'])) {
    session_destroy();
    header('location: '.URL_CHISEL.'login');
    exit();
}
if ($usuLog->id_estado != State::VISIBLE) {
    session_destroy();
    header('location: '.URL_CHISEL.'login');
    exit();
}
