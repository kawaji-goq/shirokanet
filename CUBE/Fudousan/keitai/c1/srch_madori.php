<?php
header("Content-type: text/html; charset=sjis");

ini_set("display_errors",0);
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
</head>
<body>
<?php
include "../template/header.php";
?><div align="center"><font color="red"><?php echo $Emoji["SEARCH"];?>L‚³‚©‚ç’T‚·</font></div>
<hr>
<a href="/keitai/c1/list.php?madori=1&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">1‚q,‚j,‚c‚j,‚k‚c‚j<br>
</a><a href="/keitai/c1/list.php?madori=2&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">2‚c‚j,‚k‚c‚j</a><br>
<a href="/keitai/c1/list.php?madori=3&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">3‚c‚j,‚k‚c‚j</a><br>
<a href="/keitai/c1/list.php?madori=4&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">4‚c‚jˆÈã</a><br>
<a href="/keitai/c1/list.php?madori=&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">w’è–³‚µ</a><br>
<br>

E<a href="/keitai/c1/srch_cost.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >‰¿Ši‚Åi‚é</a><br>
E<a href="/keitai/c1/srch_chiki.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">’nˆæ‚Åi‚é</a> <br>
<br>
<a href="/keitai/c1/list.php">–ß‚é</a><br>
<a href="/keitai/index.php">TOP‚Ö–ß‚é</a><br>
<?php
include "../template/footer.php";
?>
</body>
</html>
