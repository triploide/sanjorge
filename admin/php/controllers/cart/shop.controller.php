<?php
require '../../bootstrap.php';
session_start();

$productos = Doctrine_Query::create()
    ->select('*')
    ->from('Producto')
    ->whereIn('id', $_POST['producto_id'])
    ->orderBy('FIND_IN_SET(id, "'.  implode(',', $_POST['producto_id']).'")')
    ->execute();

$pedido = new Pedido;
$pedido->save();

$itemsCollection = new Doctrine_Collection('Item');

$totalFinal = 0; $costoFinal = 0;
for ($i=0, $l=count($_POST['producto_id']); $i<$l; $i++) {
    $item = new Item;
    $item->id_pedido = $pedido->id;
    $item->id_producto = $_POST['producto_id'][$i];
    $item->cantidad = $_POST['cantidad'][$i];
    $item->costo = $productos[$i]->costo;
    $item->precio = $productos[$i]->precio;
    $itemsCollection[] = $item;

    $totalFinal += $productos[$i]->precio * $_POST['cantidad'][$i];
    $costoFinal += $productos[$i]->costo * $_POST['cantidad'][$i];
}

$itemsCollection->save();

$pedido->fecha = date('Y-m-d');
$pedido->total = $totalFinal;
$pedido->costo = $costoFinal;
$pedido->id_cliente  = $_SESSION['cliente_id'];
$pedido->id_estado  = EstadoPedido::PENDIENTE;
$pedido->save();

unset($_SESSION['cart']);

header('Content-Type: application/json');
echo(json_encode(array('success' => true)));
