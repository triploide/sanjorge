<?php
require '../includes/config.php';
require INC . 'admin/php/classes/StockPdf.php';

$stock = Doctrine::getTable('StockLog')->find($_GET['id']);

$data = Doctrine_Query::create()
        ->select('i.id, p.codigo as codigo, p.nombre as nombre, i.cantidad as cantidad, i.costo as costo, cantidad*costo as total')
        ->from('StockItem as i')
        ->innerJoin('i.producto as p')
        ->where('i.id_stock_log = ?', $_GET['id'])
        ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

$header = array(
    array(
        'value'=>'Nº',
        'width' => 10
    ),
    array(
        'value'=>'Código',
        'width' => 25
    ),
    array(
        'value'=>'Nombre',
        'width' => 70
    ),
    array(
        'value'=>'Cantidad',
        'width' => 25
    ),
    array(
        'value'=>'Costo',
        'width' => 30
    ),
    array(
        'value'=>'Total',
        'width' => 30
    )
);

$fecha = preg_replace('/([0-9]{4})-([0-9]{2})-([0-9]{2})/', '$3-$2-$1', $stock->fecha);

$pdf = new StockPdf($fecha);
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->fancyTable($header, $data);
$pdf->IncludeJS("print('true')");
$pdf->Output();
?>