<?php

function safe($str)
{
    return strip_tags(trim($str));
}

function readJSON($path)
{
    if(!file_exists($path)) {
        return FALSE;
    }

    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path)
{
    $create = fopen($path, "w");// or die("Change your permision folder for application and CRUZ folder to 777 --> $path");
    fwrite($create, $string);
    fclose($create);
    
    return $path;
}

function label($str)
{
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}

?>