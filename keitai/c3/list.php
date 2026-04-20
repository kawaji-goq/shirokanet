<?php
header("Content-type: text/html; charset=shift-jis");

$path = '/var/www/html/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//include "CUBE/Fudousan/config.php";
include "CUBE/Fudousan/keitai/c3/list.php";
?>
