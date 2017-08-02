<?php

$response = array();

if (!isset($_FILES['csv']) || !$_FILES['csv']['size']) {
    response('Faltó adjuntar el archivo o el archivo está dañado');
}

if (($gestor = fopen($_FILES['csv']['tmp_name'], "r")) === FALSE) {
    response('Faltó adjuntar el archivo o el archivo está dañado');
}

if (pathinfo($_FILES['csv']['name'], PATHINFO_EXTENSION) != 'csv') {
    response('El archivo debe ser del tipo csv');
}

if (!isset($resposne['message'])) {
    if ( ($datos = fgetcsv($gestor, 1000, ",")) !== FALSE ) {
        if (count($datos) != 4) {
            response('El archivo debe tener tres columnas (código, nombre, precio y categoría)');
        }
    } else {
        response('El archivo no es válido');
    }
}

function response($message) {
    $response = array('error' => true, 'message' => $message);
    header('Content-Type: application/json');
    echo(json_encode($response));
    exit;
}

