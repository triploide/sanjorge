<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array('mensaje');

$data = Doctrine_Query::create()
    ->select('i.*')
    ->from('ImportacionLog as i')
    ->where('i.id_importacion = ?', $_GET['id_importacion'])
    ->andWhere('i.tipo = ?', $_GET['tipo'])
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;

$recordsTotal = Doctrine_Query::create()
    ->select('count(i.id)')
    ->from('ImportacionLog as i')
    ->where('i.id_importacion = ?', $_GET['id_importacion'])
    ->andWhere('i.tipo = ?', $_GET['tipo'])
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
