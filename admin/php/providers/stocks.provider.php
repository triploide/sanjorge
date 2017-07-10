<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'fecha',
    'costo',
    0
);

$data = Doctrine_Query::create()
    ->select('s.id, s.fecha, SUM(i.costo*i.cantidad) as costo')
    ->from('StockLog as s')
    ->innerJoin('s.items as i')
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('s.id')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(s.id)')
    ->from('StockLog as s')
;
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $fechas = explode(',', $_GET['search']['value']);
    $data->andWhere('s.fecha >=  ? and s.fecha <= ?', $fechas);
    $recordsFiltered->andWhere('s.fecha >=  ? and s.fecha <= ?', $fechas);
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
