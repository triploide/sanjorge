<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'razon_social'
);

$data = Doctrine_Query::create()
    ->select('c.id, c.razon_social, c.horario, c.email, p.value as provincia, l.value as localidad')
    ->from('Cliente as c')
    ->leftJoin('c.localidad as l')
    ->leftJoin('l.provincia as p')
    ->where('c.estado = 1')
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('c.id')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(c.id)')
    ->from('Cliente c')
    ->where('c.estado = 1')
;
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $data->andWhere('c.razon_social like "'.$_GET['search']['value'].'%"');
    $recordsFiltered->andWhere('c.razon_social like "'.$_GET['search']['value'].'%"');
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
