<?php

if(preg_match("/\D/i",$_REQUEST["cid"],$res))
{
	exit();
}
else
{
	include "/tmp/CUBE/Fudousan/chintai.php";
}
?>
