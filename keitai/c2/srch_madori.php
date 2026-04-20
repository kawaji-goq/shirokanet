<?php
header("Content-type: text/html; charset=shift-jis");

$_SERVER["DOCUMENT_ROOT"] = $path = '/var/www/vhosts/miyamoto-fu.jp/httpdocs/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
//include "CUBE/Fudousan/config.php";
include "CUBE/Fudousan/keitai/c2/srch_madori.php";
?>