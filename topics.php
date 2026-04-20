<?php
if(preg_match("/\D/i",$_REQUEST["blog_id"],$res))
{
	exit();
}
else if(preg_match("/\D/i",$_REQUEST["year"],$res))
{
	exit();
}else if(preg_match("/\D/i",$_REQUEST["month"],$res))
{
	
	exit();

}
else
{

include "CUBE/Fudousan/topics.php";

}
?>
