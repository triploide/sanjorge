<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'fecha',
    'cliente',
    'total',
    'estado',
    0
);

$data = Doctrine_Query::create()
    ->select('p.id, p.fecha, c.razon_social as cliente, p.total, p.id_estado as estado')
    ->from('Pedido as p')
    ->innerJoin('p.cliente as c')
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('p.id')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(p.id)')
    ->from('Pedido p')
;
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $fechas = explode(',', $_GET['search']['value']);
    $data->andWhere('p.fecha >=  ? and p.fecha <= ?', $fechas);
    $recordsFiltered->andWhere('p.fecha >=  ? and p.fecha <= ?', $fechas);
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
