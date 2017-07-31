<?php
include_once('../../includes/definer.php');
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
    ->select('p.id, p.codigo, p.stock, p.nombre, p.precio, p.slug, p.id_estado as estado, c.value as categoria, i.src as imagen')
    ->from('Producto as p')
    ->innerJoin('p.categoria as c')
    ->leftJoin('p.imagenes as i')
    ->where('stock > 0')
    ->andWhere('p.id_estado = ?', EstadoProducto::VISIBLE)
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
if ($searchTerm = $_GET['search']['value']) {
    $searchTerm = array_fill(0,2,'%'.$searchTerm.'%');
    $data->andWhere('p.nombre like ? or p.codigo like ?', $searchTerm);
    $recordsFiltered->andWhere('p.nombre like ? or p.codigo like ?', $searchTerm);
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
