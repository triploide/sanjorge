<?php
require '../includes/config.php';

$items = json_decode(str_replace("'", '"', stripslashes($_POST['items'])) );

$stockLog = new StockLog();
$stockLog->fecha = date('Y-m-d');

//items
$productosCollection = new Doctrine_Collection('Producto');
foreach ($items->items as $item) {
    if ($item->producto) {
        $costo = (float)$item->costo;
        $stockItem = new StockItem();
        $producto = Doctrine::getTable('producto')->find($item->producto);
        $producto->stock += (int)$item->cantidad;
        $producto->costo = $costo;
        //precio
        if ($producto->margen == 0)  {
            $producto->precio = (float)$costo;
        } else {
            $producto->precio = ceil( ($producto->margen*$costo/100) + $costo);
        }

        $productosCollection[] = $producto;
        
        $stockItem->costo = $costo;
        $stockItem->cantidad = $item->cantidad;
        $stockItem->id_producto = $item->producto;
        $stockLog->items[] = $stockItem;
    }
}
$stockLog->save();
$productosCollection->save();
header('location: '.URL.'admin/stock-listado/log#new');

