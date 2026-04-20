<?php
header("Content-type: text/html; charset=shift-jis");
ini_set("display_errros",1);
$path="/var/www/html/";
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
include "CUBE/Fudousan/config.php";
include "/var/www/html/CUBE/Fudousan/keitai/c1/list.php";
