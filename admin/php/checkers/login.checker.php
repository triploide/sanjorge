<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 'validUser') {
    header('location: '.URL.'admin/login');
    exit();
}
if (!$usuLog = Doctrine::getTable('Usuario')->find($_SESSION['admin_id'])) {
    header('location: '.URL.'admin/login');
    exit();
}
