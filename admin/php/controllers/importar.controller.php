<?php
require '../includes/config.php';
require INC.'admin/php/validators/csv.validator.php';

rewind($gestor);

$categorias = Doctrine_Query::create()
    ->select('c.id, c.value')
    ->from('Categoria as c INDEXBY c.value')
    ->execute(array(), Doctrine::HYDRATE_ARRAY)
;

$productosCollection = new Doctrine_Collection('Producto');

$importacion = new Importacion;
$importacion->fecha = date('Y-m-d');

while (($cols = fgetcsv($gestor, 1000, ",")) !== FALSE) {
    $cols = array_map('trim', $cols);
    if ($cols[0]) {
        if (!$cols[1]) {
            $importacion->logs[] = createLog('El nombre para el producto ' . $cols[0] . ' no es válido.');
        } elseif (!$precio = validarCosto($cols[2])) {
            $importacion->logs[] = createLog('El precio para el producto ' . $cols[0] . ' no es válido.');
        } elseif (!$categoria = validarCategoria($cols[3])) {
            $importacion->logs[] = createLog('La categoría seccionada para el producto ' . $cols[0] . ' no es válida.');
        } else {
            if (!$producto = Doctrine::getTable('Producto')->findOneByCodigo($cols[0])) {
                $importacion->logs[] = createLog('Código del nuevo producto: ' . $cols[0], 1);
                $importacion->total_nuevos++;
                $producto = new Producto;
                $producto->codigo = $cols[0];
                $producto->nombre = $cols[1];
                $producto->id_categoria = $categoria['id'];
            }
            $producto->precio = $precio;
            $productosCollection[] = $producto;
        }
    }
}

$importacion->total_errores = count($importacion->logs);
$importacion->total_general = count($productosCollection);
$importacion->save();
$productosCollection->save();

fclose($gestor);

header('location: '.URL.'admin/importaciones-listado#success');

function createLog($mensaje, $tipo=false)
{
    $error = new ImportacionLog;
    $error->mensaje = $mensaje;
    if ($tipo) $error->tipo = $tipo;
    return $error;
}

function validarCategoria($value)
{
    global $categorias;
    $isValid = true;
    if (!$value) $isValid = false;
    if (!isset($categorias[$value])) {
        $categoria = new Categoria;
        $categoria->value = $value;
        $categoria->save();
        $categoria = $categoria->toArray();
    } else {
        $categoria = $categorias[$value];
    }
    return ($isValid)?$categoria:false;
}

function validarCosto($precio)
{
    $isValid = true;
    if (!$precio) $isValid = false;
    $precio = preg_replace('/\D/', '', $precio);
    if (!is_numeric($precio)) $isValid = false;
    return ($isValid)?$precio:false;
}
