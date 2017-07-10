<?php
require '../includes/config.php';
require INC . 'admin/php/classes/PedidoPdf.php';

$pedido = Doctrine::getTable('Pedido')->find($_GET['id']);

$data = Doctrine_Query::create()
    ->select('p.codigo as codigo, p.nombre as producto, p.ubicacion as ubicacion, i.cantidad as cantdidad, i.precio as precio, i.precio*i.cantidad as total')
    ->from('Item as i')
    ->innerJoin('i.producto as p')
    ->where('i.id_pedido = ?', $_GET['id'])
    ->groupBy('i.id')
    ->orderBy('p.codigo')
    ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

//var_dump($data); exit;

$header = array(
    array(
        'value'=>'Código',
        'width' => 20
    ),
    array(
        'value'=>'Producto',
        'width' => 60
    ),
    array(
        'value'=>'Ubicación',
        'width' => 25
    ),
    array(
        'value'=>'Cantidad',
        'width' => 25
    ),
    array(
        'value'=>'Precio',
        'width' => 30
    ),
    array(
        'value'=>'Total',
        'width' => 30
    )
);

$pdf = new PedidoPdf($pedido);
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->fancyTable($header, $data);
$pdf->IncludeJS("print('true')");
$pdf->Output();
?>