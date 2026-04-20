<?php
header("Content-type: text/html; charset=shift-jis");

//$_SERVER["DOCUMENT_ROOT"] = $path = '/var/www/vhosts/sougou-net.jp/httpdocs/';
$path = '/var/www/html/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "CUBE/Fudousan/keitai/index.php";
