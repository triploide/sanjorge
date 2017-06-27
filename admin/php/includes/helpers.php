<?php

function include_template($tpl, $vars=array())
{
    if (count($vars)) extract($vars);
    include($tpl);
    foreach ($vars as $var) {
        $GLOBALS[$var] = null;
    }
}

function str_random($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
