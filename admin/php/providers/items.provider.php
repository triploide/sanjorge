<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'codigo',
    'producto',
    'categoria',
    'ubicacion',
    'cantidad',
    'precio',
    'total'
);

$data = Doctrine_Query::create()
    ->select('i.id, i.cantidad, i.precio, i.precio*i.cantidad as total, p.codigo as codigo, p.nombre as producto, c.value as categoria, p.ubicacion as ubicacion')
    ->from('Item as i')
    ->innerJoin('i.producto as p')
    ->innerJoin('p.categoria as c')
    ->where('i.id_pedido = ?', $_GET['pedido_id'])
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('i.id')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(i.id)')
    ->from('Item as i')
    ->where('i.id_pedido = ?', $_GET['pedido_id'])
;
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $searchTerm = '%'.$_GET['search']['value'].'%';
    $data->andWhere('p.nombre like  ?', $searchTerm);
    $recordsFiltered->andWhere('p.nombre like ?', $searchTerm);
}

//ejecuto los dql
$recordsTotal = $recordsTotal->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$recordsFiltered = $recordsFiltered->execute(array(), Doctrine::HYDRATE_SINGLE_SCALAR);
$data = $data->execute(array(), Doctrine::HYDRATE_ARRAY);

$restul = array(
    'recordsTotal'=>$recordsTotal,
    'recordsFiltered'=>$recordsFiltered,
    'data'=>$data
);

header('Content-Type: application/json');
echo(json_encode($restul));
