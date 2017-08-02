<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    'fecha',
    'total_errores',
    'total_nuevos',
    'total_general',
    0,
);

$data = Doctrine_Query::create()
    ->select('i.*')
    ->from('Importacion as i')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(i.id)')
    ->from('Importacion as i')
;
$recordsFiltered = $recordsTotal->copy();

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
