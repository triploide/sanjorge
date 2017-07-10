<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $producto->id, $html);
$html = str_replace('${title}', $producto->nombre, $html);
$html = str_replace('${nombre}', htmlspecialchars($producto->nombre), $html);
$html = str_replace('${codigo}', $producto->codigo, $html);
$html = str_replace('${ubicacion}', $producto->ubicacion, $html);
$html = str_replace('${stock}', $producto->stock, $html);
$html = str_replace('${precio}', $producto->precio, $html);
$html = str_replace('${margen}', $producto->margen, $html);

$html = str_replace('${categoriaToSelect}', Categoria::toSelect($producto), $html);
$html = str_replace('${estadoToSelect}', EstadoProducto::toSelect($producto), $html);

//margen
if ($producto->margen == 0) {
    $html = str_replace('${selectedPrecio}', 'selected', $html);
} else {
    $html = str_replace('${selectedMargen}', 'selected', $html);
}
$html = str_replace('${costo}', $producto->costo, $html);

//imagenes
$images = '';
$data = array();
foreach ($producto->imagenes() as $img) {
    $images .= $imagesTpl;
    $images = str_replace('${id}', $img->id, $images);
    $images = str_replace('${src}', URL.'content/productos/thumb/'.$img->src, $images);
    $data[$img['id']] = $img;
}
$html = str_replace('${data}', 'var Imagenes = '.json_encode($data), $html);
$html = str_replace('${imagenes}', $images, $html);
$html = str_replace('${imgprefix}', time() . '' . rand(1, 99999), $html);

$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
