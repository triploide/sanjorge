<?php
include_once('../includes/config.php');

$cliente = ($_POST['id'])
    ? Doctrine::getTable('Cliente')->find($_POST['id'])
    : new Cliente();

$cliente->razon_social = $_POST['razon_social'];
$cliente->email = $_POST['email'];
if ($_POST['password']) $cliente->pass = $_POST['password'];
$cliente->horario = $_POST['horario'];
$cliente->telefono = $_POST['telefono'];
$cliente->cuit = $_POST['cuit'];
$cliente->direccion = $_POST['direccion'];
if ($_POST['id_localidad'])  $cliente->nombre = $_POST['localidad'];
$cliente->save();

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'admin/clientes'.$accion);

