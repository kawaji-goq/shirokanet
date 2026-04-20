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

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件検索</title>
</head>
<body>
<?php
include "../template/header.php";
?><div align="center"><font color="red"><?php echo $Emoji["SEARCH"];?>広さから探す</font></div>
<hr>
 <a href="/keitai/c2/list.php?madori=1&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">1Ｒ,Ｋ,ＤＫ,ＬＤＫ<br>
</a>
 <a href="/keitai/c2/list.php?madori=2&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">2ＤＫ,ＬＤＫ</a><br>
 <a href="/keitai/c2/list.php?madori=3&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">3ＤＫ,ＬＤＫ</a><br> 
 <a href="/keitai/c2/list.php?madori=4&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">4ＤＫ以上</a><br>
 <a href="/keitai/c2/list.php?madori=&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">指定無し</a><br>
<br>

・<a href="/keitai/c2/srch_cost.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >価格で絞る</a><br>
・<a href="/keitai/c2/srch_chiki.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">地域で絞る</a> <br>
<br> 
<a href="/keitai/c2/list.php">戻る</a><br>
 <a href="/keitai/index.php">TOPへ戻る</a><br>
<?php
include "../template/footer.php";
?>
</body>
</html>
