<?php
if (!defined('CONFIG')) include '../includes/config.php';

$restuls = Doctrine_Query::create()
        ->select('p.*, p.codigo as label')
        ->from('Producto as p')
        ->where('p.id_estado <> ?', EstadoProducto::BORRADO)
        ->orderBy('p.codigo')
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

echo(json_encode($restuls));
