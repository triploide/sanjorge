<?php
include_once('../includes/definer.php');
include_once(INC.'admin/php/bootstrap.php');

echo Localidad::toSelect($_GET['provincia_id']);
