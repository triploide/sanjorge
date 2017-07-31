<?php
require '../../includes/configClientes.php';
require INC . 'admin/php/classes/ProductoPdf.php';

$data = Doctrine_Query::create()
    ->select('p.id, c.value as categoria, p.codigo as codigo, p.nombre as producto, p.precio as precio')
    ->from('Producto as p')
    ->innerJoin('p.categoria as c')
    ->where('p.id_estado = ?', EstadoProducto::VISIBLE)
    ->orderBy('c.value, p.nombre')
    ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

//var_dump($data); exit;

$header = array(
    array(
        'value'=>'Categoría',
        'width' => 65
    ),
    array(
        'value'=>'Código',
        'width' => 30
    ),
    array(
        'value'=>'Producto',
        'width' => 65
    ),
    array(
        'value'=>'Precio',
        'width' => 30
    )
);

$pdf = new ProductoPdf(date('d-m-Y'));
$pdf->money = array('precio');
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->fancyTable($header, $data);
$pdf->IncludeJS("print('true')");
$pdf->Output();
?>