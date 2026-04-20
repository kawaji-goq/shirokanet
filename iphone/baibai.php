<?php
header("Content-type: text/html; charset=euc-jp");
ini_set("display_errors",1);
$path = '/var/www/html/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
include "Fudousan/iphone/modules/baibai.php";
ini_set("display_errors",0);

?>
                                                                                           
