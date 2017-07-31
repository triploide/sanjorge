<?php
session_start();

if (!isset($_SESSION) || !isset($_SESSION['cliente']) || $_SESSION['cliente'] != 'validUser') {
    header('location: '.URL.'clientes/acceder');
    exit();
}
if (!$usuLog = Doctrine::getTable('Cliente')->find($_SESSION['cliente_id'])) {
    header('location: '.URL.'clientes/acceder');
    exit();
}
