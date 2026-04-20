<?php
if(preg_match("/\D/i",$_REQUEST["bid"],$res))
{
	exit();
}
else
{

	include "CUBE/Fudousan/chintai_d2.php";

}
?>
