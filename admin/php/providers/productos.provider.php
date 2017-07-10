<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$orderColumn = array(
    0,
    'codigo',
    'nombre',
    'stock',
    'estado',
    'categoria',
    0
);

$data = Doctrine_Query::create()
    ->select('p.*, p.id_estado as estado, c.value as categoria, i.src as imagen')
    ->from('Producto as p')
    ->innerJoin('p.categoria as c')
    ->leftJoin('p.imagenes as i')
    ->where('p.id_estado <> ?', EstadoProducto::BORRADO)
    ->limit($_GET['length'])
    ->offset($_GET['start'])
    ->groupBy('p.id')
    ->orderBy('i.orden desc')
    ->orderBy($orderColumn[$_GET['order'][0]['column']].' '.$_GET['order'][0]['dir']);
;
if ($_GET['categoria']) $data->where('c.slug = ?', $_GET['categoria']);

$recordsTotal = Doctrine_Query::create()
    ->select('count(p.id)')
    ->from('Producto as p')
    ->innerJoin('p.categoria as c')
    ->where('p.id_estado <> ?', EstadoProducto::BORRADO)
;
if ($_GET['categoria']) $recordsTotal->where('c.slug = ?', $_GET['categoria']);
$recordsFiltered = $recordsTotal->copy();

//busqueda
if ($_GET['search']['value']) {
    $searchTerm = array('%'.$_GET['search']['value'].'%', $_GET['search']['value'].'%');
    $data->andWhere('c.nombre like ? or c.codigo like ?', $searchTerm);
    $recordsFiltered->andWhere('c.value like "'.$_GET['search']['value'].'%"');
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
