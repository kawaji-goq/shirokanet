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

$tenpodata=$dbobj->GetData("select * from tenpo_data");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件検索</title>
</head>

<body>
<div align="center">お問い合わせ</div>
<hr>
<?php echo mb_convert_encoding($tenpodata["name"],"sjis","eucjp"); ?><br>
<?php echo mb_convert_encoding($tenpodata["jyusyo"],"sjis","eucjp");?><br>
<a href="tel:<?php echo mb_convert_encoding($tenpodata["denwa"],"sjis","eucjp");?>"><?php echo mb_convert_encoding($tenpodata["denwa"],"sjis","eucjp");?></a><br>
<a href="mailto:<?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?>"><?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?></a><br>
<br> 

  <a href="index.php">TOPへ戻る</a><br>
  <hr>
<br>
</body>
</html>
