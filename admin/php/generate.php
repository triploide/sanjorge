<?php
set_time_limit(0);
ini_set("memory_limit","500M");
include_once('bootstrap.php');

Doctrine_Core::createTablesFromModels('models');

//estado pedido
$data = array('Entregado', 'Pendiente', 'Cancelado');
$collection = new Doctrine_Collection('EstadoPedido');
foreach ($data as $value) {
    $n = new EstadoPedido();
    $n->value = $value;
    $collection[] = $n;
}
//--------------

//estado producto
$data = array('Visible', 'Oculto', 'Borrado');
$collection = new Doctrine_Collection('EstadoProducto');
foreach ($data as $value) {
    $n = new EstadoProducto();
    $n->value = $value;
    $collection[] = $n;
}
//--------------

//permisos
$data = array('Productos', 'Stock', 'Pedidos', 'Clientes', 'Categorias');
$collection = new Doctrine_Collection('Permiso');
foreach ($data as $value) {
    $n = new Permiso();
    $n->value = $value;
    $collection[] = $n;
}
//--------------

//usuario
$admin = new Usuario();
$admin->nombre = 'Admin';
$admin->nick = 'admin';
$admin->pass = 'admin';
$admin->permisos = $collection;
//---------

Doctrine_Manager::connection()->flush();
