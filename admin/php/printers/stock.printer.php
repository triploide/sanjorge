<?php
$html = file_get_contents(INC.'tpl/stock.tpl');
$itemHtml = file_get_contents(INC.'tpl/stock-item.tpl');
include(INC.'php/replacers/stock.replacer.php');
echo($html);
