<?php
header("Content-type: text/html; charset=shift-jis");
ini_set("display_errors",1);
$_SERVER["DOCUMENT_ROOT"] = $path = '/var/www/vhosts/miyamoto-fu.jp/httpdocs/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//include "CUBE/Fudousan/config.php";
include "CUBE/Fudousan/keitai/c1/madoriimage.php";
?>