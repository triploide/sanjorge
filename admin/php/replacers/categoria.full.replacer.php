<?php
$html = str_replace('${accion}', $accion, $html);
$html = str_replace('${icon}', $icon, $html);
$html = str_replace('${id}', $categoria->id, $html);
$html = str_replace('${value}', $categoria->value, $html);
$html = str_replace('${titulo}', $categoria->value, $html);
$html = preg_replace('/\${*[A-Za-z0-9_]*\}*/', '', $html);
