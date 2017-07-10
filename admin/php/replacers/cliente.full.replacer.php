<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $cliente->id, $html);
$html = str_replace('${title}', $cliente->razon_social, $html);
$html = str_replace('${razonSocial}', htmlspecialchars($cliente->razon_social), $html);
$html = str_replace('${email}', $cliente->email, $html);
$html = str_replace('${horario}', htmlspecialchars($cliente->horario), $html);
$html = str_replace('${telefono}', $cliente->telefono, $html);
$html = str_replace('${cuit}', $cliente->cuit, $html);
$html = str_replace('${direccion}', htmlspecialchars($cliente->direccion), $html);

$html = str_replace('${provinciaToSelect}', Provincia::toSelect($cliente), $html);
$html = str_replace('${localidadToSelect}', Localidad::toSelect($cliente->localidad->provincia->id, $cliente), $html);


$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
