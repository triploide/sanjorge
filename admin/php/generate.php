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


//categorias
function createProduct($i)
{
    $productos = array('Aliquam', 'Aenean', 'Praesent', 'Venenatis', 'Posuere', 'Pharetra');
    $producto = new Producto();
    $producto->nombre = $productos[$i];
    $producto->codigo = rand(100, 900);
    $producto->stock = rand(10, 50);
    $producto->costo = rand(500, 5000);
    $producto->ubicacion = rand(1, 20);
    $tipoPrecio = rand(0, 1);
    if ($tipoPrecio) {
        $margen = rand(30, 70);
        $producto->precio = ceil( ($margen*$producto->costo/100) + $producto->costo);
        $producto->margen = $margen;
    } else {
        $producto->precio = $producto->costo + rand(1000, 3000);
        $producto->margen = null;
    }
    return $producto;
}

$data = array('Lorem', 'Ipsum', 'Consectetur');
$collection = new Doctrine_Collection('Categoria');
foreach ($data as $key => $value) {
    $n = new Categoria();
    $n->value = $value;
    $n->productos[] = createProduct($key+$key);
    $n->productos[] = createProduct($key+$key+1);
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
