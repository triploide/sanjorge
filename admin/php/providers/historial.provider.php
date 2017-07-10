<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

$producto = Doctrine::getTable('Producto')->findOneBySlug($_GET['producto']);

$sql = '
    select h.*, h.id_estado as estado, c.value as categoria from producto_version as h
    inner join categoria as c on h.id_categoria = c.id
    where h.id = :producto_id and h.id_estado <> 3
    order by h.version desc
    limit 10
';

$pdo = Doctrine_Manager::getInstance()->getCurrentConnection()->getDbh();
$stmt = $pdo->prepare($sql);
$stmt->execute(array(':producto_id' => $producto->id));
$data = $stmt->fetchAll(PDO::FETCH_ASSOC); 

$restul = array(
    'recordsTotal'=>count($data),
    'recordsFiltered'=>count($data),
    'data'=>$data
);

header('Content-Type: application/json');
echo(json_encode($restul));
