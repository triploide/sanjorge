<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${title}', 'Nuevo Cliente', $html);
$html = str_replace('${provinciaToSelect}', Provincia::toSelect(), $html);
$html = str_replace('${localidadToSelect}', '<select name="localidad"><option value="">Elegir</option></select>', $html);
$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
