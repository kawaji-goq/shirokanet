<?php
header("Content-type: text/html; charset=sjis");

ini_set("display_errors",1);
//include "Cube/Fudousan/config.php";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "CUBE/ITC/modules.php";
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

$tenpodata=$dbobj->GetData("select * from tenpo_data");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>•¨ŒŒŸõ</title>
</head>

<body>
<div align="center">‚¨–â‚¢‡‚í‚¹</div>
<hr>
<?php echo mb_convert_encoding($tenpodata["name"],"sjis","eucjp"); ?><br>
øÅ<?php echo mb_convert_encoding($tenpodata["jyusyo"],"sjis","eucjp");?><br>
øè<a href="tel:<?php echo mb_convert_encoding($tenpodata["denwa"],"sjis","eucjp");?>"><?php echo mb_convert_encoding($tenpodata["denwa"],"sjis","eucjp");?></a><br>
ùw<a href="mailto:<?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?>"><?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?></a><br>
<br> 
øÄ
  <a href="index.php">TOP‚Ö–ß‚é</a><br>
  <hr>
<br>
</body>
</html>
