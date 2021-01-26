<?php

function safe($str)
{
    return strip_tags(trim($str));
}

function readJSON($path)
{
    $string = file_get_contents($path);
    $obj = json_decode($string);
    return $obj;
}

function createFile($string, $path)
{
    $create = fopen($path, "w") or die("Unable to open file!");
    fwrite($create, $string);
    fclose($create);

    return $path;
}

function label($str)
{
    if (substr($str, -3) == '_id') {
        $str = substr($str, 0, -3); 
    }else if(substr($str, -4) == '_img'){
        $str = substr($str, 0, -4);
    }
    $label = str_replace('_', ' ', $str);
    $label = ucwords($label);
    return $label;
}

?>
