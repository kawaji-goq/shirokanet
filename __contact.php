<?php
if(preg_match("/\D/i",$_REQUEST["cid"],$res))
{
	exit();
}
else if(preg_match("/\D/i",$_REQUEST["bid"],$res))
{
	exit();
}
else if(preg_match("/\D/i",$_REQUEST["page"],$res))
{
	exit();
}
else if(preg_match("/\D/i",$_REQUEST["page"],$res))
{
	exit();
}
else  if(preg_match("/\D/i",$_REQUEST["lowcost"],$res))
{
	exit();
}
else  if(preg_match("/\D/i",$_REQUEST["hicost"],$res))
{
	exit();
}
else if(preg_match("/\D/i",$_REQUEST["madori"],$res))
{
	exit();
}
else if(
		$_REQUEST["sort"]!="madori,mnum"&&
		$_REQUEST["sort"]!=""&&
		$_REQUEST["sort"]!="todouhuken,jyusyo1,jyusyo2,jyusyo3"&&
		$_REQUEST["sort"]!="kakaku"&&
		$_REQUEST["sort"]!="menseki"&&
		$_REQUEST["sort"]!="menseki desc"&&
		$_REQUEST["sort"]!="madori desc,mnum desc"&&
		$_REQUEST["sort"]!=""&&
		$_REQUEST["sort"]!="senyumenseki"&&
		$_REQUEST["sort"]!="senyumenseki desc"&&
		$_REQUEST["sort"]!="kakaku desc"&&
		$_REQUEST["sort"]!="todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc"&&
		$_REQUEST["sort"]!="kakaku desc"
		)
{
	exit();
}
else
{
	
	$_REQUEST["keyword"] = pg_escape_string($_REQUEST["keyword"]);
	include "CUBE/Fudousan/contact.php";
}
?>
