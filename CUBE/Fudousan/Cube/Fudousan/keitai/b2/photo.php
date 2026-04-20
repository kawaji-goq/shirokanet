<?php

//include "Cube/Fudousan/config.php";
include "ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);

mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	
	$dbobj=Cube_DB :: UseDB($usedb);	
	
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	
	if($usedb=="mysql") {
			$dbobj->user="admin";
			$dbobj->pass="itc7310";
	}
$dbobj->Connect();

$re1obj=new Keitai_RealEstate($dbobj);
$re1data=$re1obj->GetReData($_GET["bid"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<TITLE>写真一覧</TITLE>
</head>

<body>
<?php
include "../template/header.php";
?>
写真<br>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"])&&$re1data["photo1"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"])&&$re1data["photo2"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"])&&$re1data["photo3"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"])&&$re1data["photo4"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<?php 
if(@file_exists("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"])&&$re1data["photo5"]!=NULL) {
	$fdata=(pathinfo("../../tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]));
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<br>
<a href="/keitai/b2/list.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&page=<?php echo $page;?>">戻る</a>
</body>
</html>
