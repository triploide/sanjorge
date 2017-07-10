<?php
if(!isset($_FILES) || !count($_FILES)) exit();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');

include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');
include_once(INC.'admin/php/classes/FileImage.php');


$relativePath = 'content/tmp/productos/';
$ruta = INC.$relativePath;
$url = URL.$relativePath;
$response = array();

//validaciones
for ($i=0, $l=count($_FILES['files']['name']); $i<$l; $i++) {
    $nombre = $_POST['imgprefix'].'-'.(Imagen::lastId()+1);
    
    $ext = explode('.', $_FILES['files']['name'][$i]);
    $ext = '.'.$ext[count($ext)-1];
    $ext = strtolower($ext);
    $ext = ($ext == '.jpeg')?'.jpg':$ext;
    
    if ($ext == '.jpg' || $ext == '.gif' || $ext == '.png' ) {

        //dimensionamiento y creacion de las imagenes
        $fileImage = new FileImage($_FILES['files']['tmp_name'][$i], 90);
        if ($fileImage->ancho > 1280) $fileImage->ajustarAncho(1280);
        $fileImage->save($ruta.$nombre);

        $fileImage = new FileImage($_FILES['files']['tmp_name'][$i], 70);
        $fileImage->escalar(256, 256);
        $fileImage->recortarDesdeElCentro(256, 256);
        $fileImage->save($ruta.'thumb/'.$nombre);
        
        $image = new Imagen();
        $image->src = $nombre.'.'.$fileImage->extension;
        $image->save();

        $imageToArray = $image->toArray();
        $imageToArray['src'] = $url.'thumb/'.$nombre.'.'.$fileImage->extension;

        //respuesta
        $response[] = $imageToArray;
    }
}

header("Content-type: application/json");
echo(json_encode($response));
