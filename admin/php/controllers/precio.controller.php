<?php
include_once('../includes/config.php');

$items = json_decode(str_replace("'", '"', stripslashes($_POST['items'])));

foreach ($items->items as $item) {
    if ($item->producto) {
        $producto = Doctrine::getTable('Producto')->find($item->producto);
        $costo = (float)$item->costo;
        $margen = (float)$item->margen;
        //precio
        if ($item->tipo_precio == 1)  {
            $producto->precio = ceil(($margen*$costo/100) + $costo);
            $producto->margen = $margen;
        } else {
            $producto->precio = (float)$item->precio;
            $producto->margen = null;
        }
        $producto->save();
    }
}

header('location: '.URL.'admin/productos');

