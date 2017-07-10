<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${titulo}', 'Nueva categoría', $html);
$html = preg_replace('/\${*[A-Za-z0-9]*\}*/', '', $html);
