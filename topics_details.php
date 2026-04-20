<?php
if(preg_match("/\D/i",$_REQUEST["blog_id"],$res))
{
	exit();
}
else
{

include "CUBE/Fudousan/topics_details.php";

}
?>
