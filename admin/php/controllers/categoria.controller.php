<?php
include_once('../includes/config.php');

$categoria = ($_POST['id'])
    ? Doctrine::getTable('Categoria')->find($_POST['id'])
    : new Categoria();

$categoria->value = $_POST['value'];
$categoria->save();

header('location: '.URL.'admin/categorias#success');
