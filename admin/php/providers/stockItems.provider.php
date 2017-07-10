<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'codigo',
    'producto',
    'costo',
    'cantidad',
    'total',
);

$data = Doctrine_Query::create()
    ->select('i.costo, i.cantidad, i.costo*i.cantidad as total, p.nombre as producto, p.codigo as codigo')
    ->from('StockItem as i')
    ->innerJoin('i.producto as p')
    ->innerJoin('i.log as s WITH s.id = ?', $_GET['id_stock_log'])
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('i.id')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(i.id)')
    ->from('StockItem i')
    ->innerJoin('i.log as s WITH s.id = ?', $_GET['id_stock_log'])
;
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('p.value like "'.$_GET['search']['value'].'%"');
    $recordsFiltered->andWhere('p.value like "'.$_GET['search']['value'].'%"');
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
