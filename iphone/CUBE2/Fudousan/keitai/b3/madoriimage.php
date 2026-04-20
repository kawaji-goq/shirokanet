<?php

ini_set("display_errors",1);
//include "Cube/Fudousan/config.php";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "/tmp/CUBE/ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);
mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	//echo $usedb;
	$dbobj=Cube_DB :: UseDB($usedb);	
	//echo $usedb;
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	//echo $dbobj->name;
	
	//if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
	//}
$dbobj->Connect();
$re1obj=new Keitai_RealEstate($dbobj);
$re1data=$re1obj->GetReData($_GET["bid"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<TITLE>ŠÔæ‚è‰æ‘œ</TITLE>
</head>

<body>
<?php
include "../template/header.php";
?>Ê^<br>
<?php 


if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"])&&$re1data["madorizu1"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"])&&$re1data["madorizu2"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<br>
<a href="/keitai/b3/list.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&page=<?php echo $page;?>">–ß‚é</a>
</body>
</html>
