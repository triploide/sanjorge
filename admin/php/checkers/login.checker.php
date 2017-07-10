<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['chisel_log']) || $_SESSION['chisel_log'] != 'validUser') {
    session_destroy();
    header('location: '.URL.'admin/login');
    exit();
}
if (!$usuLog = Doctrine::getTable('Usuario')->find($_SESSION['chisel_user_id'])) {
    session_destroy();
    header('location: '.URL.'admin/login');
    exit();
}
