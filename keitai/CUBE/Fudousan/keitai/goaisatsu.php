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
$comobj=new Site_Company($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$staffobj=new Site_Staff($dbobj);

$textobj=new Cube_KeitaiTextEdit("SJIS", "EUCJP");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ごあいさつ</title>
</head>

<body>

<hr>
<div align="left"><strong><font color="#0000FF">ごあいさつ</font></strong></div>
<br>
<div>
<?php
$textobj->printc($tenpodata["goaisatsu"]);
?>
</div>
<a href="mailto:<?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?>"></a><br>
<br>
<a href="company.php">会社案内へ戻る</a><br> 

<a href="index.php">TOPへ戻る</a><br>
<hr>
<br>
</body>
</html>
