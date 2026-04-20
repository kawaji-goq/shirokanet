<?php

//include "Cube/Fudousan/config.php";
include "ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include  "ITC/keitai.php";

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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 

if($_GET['article_turn']!=NULL) {
	$_SESSION['article_turn']=$_GET['article_turn'];
}

/*
 * ƒy[ƒW”Ô†
 */
if($page==NULL) {
	$page=1;
 
}
$_SESSION["lim"]=5;
$re1obj->type=1;
$re1data=$re1obj->GetReList(1,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>•¨ŒŒŸõ</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<?php
include "../template/header.php";
?><div align="center"><?php echo $Emoji["SEARCH"];?><span class="style1">‰¿Ši‘Ñ‚©‚ç’T‚·</span></div>
<hr>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=0&hicost=3&chiiki=<?php echo $chiiki;?>" > 3–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=3&hicost=4&chiiki=<?php echo $chiiki;?>" > 3–œ‰~`4–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=4&hicost=5&chiiki=<?php echo $chiiki;?>" >4–œ‰~`5–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=5&hicost=6&chiiki=<?php echo $chiiki;?>" >5–œ‰~`6–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=6&hicost=7&chiiki=<?php echo $chiiki;?>" >6–œ‰~`7–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=7>&hicost=8&chiiki=<?php echo $chiiki;?>" >7–œ‰~`8–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=8&hicost=9&chiiki=<?php echo $chiiki;?>" >8–œ‰~`9–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=9&hicost=10&chiiki=<?php echo $chiiki;?>" >9–œ‰~`10–œ‰~–¢–</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=10&hicost=&chiiki=<?php echo $chiiki;?>" >10–œ‰~ˆÈã</a><br>
<a href="/keitai/c1/list.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=&hicost=&chiiki=<?php echo $chiiki;?>">w’è–³‚µ
</a><br>
<br>
E<a href="/keitai/c1/srch_madori.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >L‚³‚Åi‚é</a><br>
E<a href="/keitai/c1/srch_cost.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >‰¿Ši‚Åi‚é</a><br>
E<a href="/keitai/c1/srch_chiki.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">’nˆæ‚Åi‚é</a>
<br>
<a href="/keitai/c1/list.php">–ß‚é</a><br>
<a href="/keitai/index.php">TOP‚Ö–ß‚é</a><br>
<?php
include "../template/footer.php";
?>
</body>
</html>
