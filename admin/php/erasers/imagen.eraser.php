<?php
include('../includes/definer.php');
include(INC.'admin/php/bootstrap.php');
$imagesPath = 'content/'.$_POST['folder'].'/';
$imagesTmpPath = 'content/tmp/'.$_POST['folder'].'/';

$imagen = Doctrine::getTable('imagen')->find($_POST['id']);
foreach (rglob(INC.$imagesPath.$imagen->src) as $img) {
    @unlink($img);
}
foreach (rglob(INC.$imagesTmpPath.$imagen->src) as $img) {
    @unlink($img);
}
$imagen->delete();

function rglob($pattern, $flags = 0) {
    $files = glob($pattern, $flags); 
    foreach (glob(dirname($pattern).'/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, rglob($dir.'/'.basename($pattern), $flags));
    }
    return $files;
}

