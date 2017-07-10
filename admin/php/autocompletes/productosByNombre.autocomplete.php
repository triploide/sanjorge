<?php
if (!defined('CONFIG')) include '../includes/config.php';

$restuls = Doctrine_Query::create()
        ->select('p.*, p.nombre as label')
        ->from('Producto as p')
        ->where('p.id_estado <> ?', EstadoProducto::BORRADO)
        ->orderBy('p.nombre')
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

echo(json_encode($restuls));
?>