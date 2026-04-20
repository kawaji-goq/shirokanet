<?php
header("Content-type: text/html; charset=sjis");
ini_set("display_errors",0);
//include "Cube/Fudousan/config.php";
$path = $_SERVER["DOCUMENT_ROOT"];
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include $_SERVER["DOCUMENT_ROOT"]."/CUBE/ITC/modules.php";

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

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 

if($_GET['article_turn']!=NULL) {
	$_SESSION['article_turn']=$_GET['article_turn'];
}

/*
 * ページ番号
 */
if($page==NULL) {
	$page=1;
 
}
$_SESSION["lim"]=5;
$re1obj->type=3;
$re1data=$re1obj->GetReList(1,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);
?>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件リスト</title>
</head>
<body>
<?php
include "../template/header.php";
?><div align="center"><font color="RED">物件リスト</font>
</div>
<hr>
<div align="left">
<font color="#FF6600">検索条件</font><br>

価格：<a href="/keitai/c3/srch_cost.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php
if($lowcost!=NULL&&$lowcost!=0&&$hicost!=NULL) {
	echo $lowcost."万円以上".$hicost."万円未満";
}
else if($lowcost!=NULL&&$hicost==NULL){
	echo $lowcost."万円以上";
}
else if(($lowcost==NULL||$lowcost==0)&&$hicost!=NULL) {
	echo $hicost."万円未満";
}
else {
	echo "指定無し";
}
?>
</a><br>
地域：<a href="/keitai/c3/srch_chiki.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php
if($chiiki!=NULL) {
	$chiikidata=$dbobj->GetData("select * from re_area where area_id=".$chiiki);
	echo mb_convert_encoding($chiikidata["area_name"],"SJIS","EUC-JP");
}
else {
	echo "指定無し";
}
?>
</a><a href="/keitai/c3/srch_chiki.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"></a><br>
<div align="left"> 	<font color="#FF0000">該当物件<?php echo $re1obj->numrows; ?>件</font><br>
		
		<hr>
		<?php 
$re1rows=0;
while($re1data[$re1rows]["id"]!=NULL) {
	 kecho($re1data[$re1rows]["syumoku"]); ?>
		<br>
		<a href="http://map.mobile.yahoo.co.jp/msearch?p=<?php echo urlencode(mb_convert_encoding($re1data[$re1rows]["jyusyo1"],"sjis","euc-jp").mb_convert_encoding($re1data[$re1rows]["jyusyo2"],"sjis","euc-jp").mb_convert_encoding($re1data[$re1rows]["jyusyo3"],"sjis","euc-jp"));?>&r=0&k=">
		<?php 
	kecho($re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]);
	if($re1data[$re1rows]["jyusyo3"]!=NULL&&$re1data[$re1rows]["jyusyo2"]!=NULL) {
		echo "-";
	}
	kecho($re1data[$re1rows]["jyusyo3"]);
	 ?>
		</a> <br>
		<?php echo $Emoji["TRAIN"];;?>
		<?php 
	kecho($re1data[$re1rows]["eki"]);
	if($re1data[$re1rows]["ensen"]!=NULL) {
		kecho("[".$re1data[$re1rows]["ensen"]."]");
	}	
	?>
		<br>
		<?php 
	if($re1data[$re1rows]["ekiho"]!=0) {
	?>
		<?php echo $Emoji["WALK"];;?> 徒歩
		<?php 
	kecho($re1data[$re1rows]["ekiho"]);
	?>
分/
<?php 
	}
	?>
<strong> <font color="#0000FF">
<?php
	if($re1data[$re1rows]["madori"]!=0) {
		kecho($re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"]);
	}
	?>
</span></font></strong><br>
<?php echo $Emoji["MONEY"];;?>
<?php 
	if($re1data[$re1rows]["kakaku"]!=0) {
		kecho(($re1data[$re1rows]["kakaku"]));echo "万円";
	} ?>
</span><br>
<?php echo $Emoji["P"];;?>
<?php 
	kecho($re1data[$re1rows]["chusyajou"]);
	if($re1data[$re1rows]["chusya_ryoukin"]!=0) {
		 kecho("(".number_format($re1data[$re1rows]["chusya_ryoukin"]));echo "円)";
	}
?>
<br>
<?php 
if($re1data[$re1rows]["photo1"]!=NULL||$re1data[$re1rows]["photo2"]!=NULL||$re1data[$re1rows]["photo3"]!=NULL||$re1data[$re1rows]["photo4"]!=NULL||$re1data[$re1rows]["photo5"]!=NULL) {?>
<?php echo $Emoji["CAMERA"];;?> <a href="/keitai/b1/photo.php?bid=<?php echo $re1data[$re1rows]["id"];?>&madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&page=<?php echo $page;?>">外観写真</a><br>
<?php 
}
?>
<?php 
if($re1data[$re1rows]["madorizu1"]!=NULL||file_exists($re1data[$re1rows]["madorizu2"])) {
?>
<?php echo $Emoji["MEMO"];;?> <a href="/keitai/b1/madoriimage.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>&madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&page=<?php echo $page;?>">間取り図</a><br>
<?php 
}
?>
<hr>
<?php
			$re1rows++;
			
			if($re1rows>10) {
				exit();
			}
			
		}
		?>
		<?php
		if($_REQUEST["page"]>1) {
			echo "<a href=\"list.php?page=".($_REQUEST["page"]-1)."&madori=".$madori."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">&lt;&lt;前の5件</a><br>";
		}
		else {
			echo "<font color=\"#CCCCCC\">&lt;&lt;前の5件</font><br>";
		}
		$pagecount_rows=1;
		while($maxpage>=$pagecount_rows) {
		
			if($pagecount_rows!=$_REQUEST["page"]) {
				echo "<a href=\"list.php?page=".$pagecount_rows."&madori=".$madori."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">".$pagecount_rows."</a>";
			}
			else {
				echo "<font color=\"#FF0000\">".$pagecount_rows."</font>";
			}			
			$pagecount_rows++;
		}
		
		if($maxpage>$_REQUEST["page"]) {
			echo "<br><a href=\"list.php?page=".($_REQUEST["page"]+1)."&madori=".$madori."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">次の5件&gt;&gt;</a>";
		}
		else {
			echo "<br><font color=\"#CCCCCC\">次の5件&gt;&gt;</font>";
		}
		
		?>
		<br>
		<font color="#FF6600">検索条件</font><br>
 価格：<a href="/keitai/c3/srch_cost.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php

if($lowcost!=NULL&&$lowcost!=0&&$hicost!=NULL) {

	echo $lowcost."万円以上".$hicost."万円未満";
	
}
else if($lowcost!=NULL&&$hicost==NULL){

	echo $lowcost."万円以上";
	
}
else if(($lowcost==NULL||$lowcost==0)&&$hicost!=NULL) {

	echo $hicost."万円未満";
	
}
else {
	echo "指定無し";
}

?>
</a><br>
地域：<a href="/keitai/c3/srch_chiki.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php
if($chiiki!=NULL) {
	$chiikidata=$dbobj->GetData("select * from re_area where area_id=".$chiiki);
	echo mb_convert_encoding($chiikidata["area_name"],"SJIS","EUC-JP");
}
else {
	echo "指定無し";
}
?>
</a><a href="/keitai/c3/srch_chiki.php?madori=<?php echo $madori;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"></a><br>
		<br>
		<?php echo $Emoji["HOME"];;?> <a href="/keitai/index.php">TOPへ戻る</a><br>
  </div>
</div>
<?php
include "../template/footer.php";
?>
</body>
</html>
