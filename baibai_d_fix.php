<?php
if(preg_match("/\D/i",$_REQUEST["bid"],$res))
{
	exit();
}
else
{

include "CUBE/Fudousan/baibai_d_fix.php";

}
?>
