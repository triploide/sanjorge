<?php
include_once('../includes/config.php');

$imagesTmpPath = 'content/tmp/productos/';
$imagesFinalPath = 'content/productos/';

$producto = ($_POST['id'])
    ? Doctrine::getTable('Producto')->find($_POST['id'])
    : new Producto();

//estado
if (isset($_POST['estadoSwitcher'])) {
    $producto->id_estado = $_POST['estado_id'];
    $producto->save();
    header('Content-Type: application/json');
    echo(json_encode(array('success' => true)));
    exit;
}

$costo = (float)$_POST['costo'];
$margen = (float)$_POST['margen'];

$producto->nombre = $_POST['nombre'];
$producto->codigo = $_POST['codigo'];
$producto->ubicacion = $_POST['ubicacion'];
$producto->costo = $_POST['costo'];
$producto->stock = $_POST['stock'];
$producto->id_categoria = $_POST['categoria'];
$producto->id_estado = $_POST['estado'];

//precio
if ($_POST['tipo_precio'] == 1)  {
    $producto->precio = ceil( ($margen*$costo/100) + $costo);
    $producto->margen = $margen;
} else {
    $producto->precio = (float)$_POST['precio'];
    $producto->margen = null;
}

$producto->save();

//imagenes
if (isset($_POST['imgprefix'])) {
    $i = Imagen::lastId();   
    foreach (glob(INC.$imagesTmpPath.$_POST['imgprefix'].'-*') as $img) {
        $imageTmpName = str_replace(INC.$imagesTmpPath, '', $img);
        $ext = explode('.', $img);
        $imageFinalName = $producto->slug.'.'.$i.'.'.end($ext);
        
        $imageModel = Doctrine::getTable('Imagen')->findOneBySrc($imageTmpName);
        $imageModel->src = $imageFinalName;
        $producto->imagenes[] = $imageModel;
        rename(INC.$imagesTmpPath.$imageTmpName, INC.$imagesFinalPath.$imageFinalName);
        rename(INC.$imagesTmpPath.'thumb/'.$imageTmpName, INC.$imagesFinalPath.'thumb/'.$imageFinalName);
        $i++;
    }
    $producto->save();
}

$accion = ($_POST['id'])?'#edit':'#new';
header('location: '.URL.'admin/productos'.$accion);

