<?php
session_start();
$_SESSION["toiawase"]="";
include "Cube/Fudousan/config.php";
include "ITC/modules.php";
	include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

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
$tenpodata=$dbobj->GetData("select * from tenpo_data");

$re1obj=new RealEstate($dbobj);

if($_GET["blog_id"]!=NULL) {
	$topicsdata=$dbobj->GetData("select * from blog_data where blog_id= ".$_GET["blog_id"]." and view_chk = 1");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
		
}
else if($_GET["year"]!=NULL&&$_GET["month"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where view_chk = 1 and ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
	$_GET["blog_id"]=$topicsdata["blog_id"];
}
else if($_GET["year"]!=NULL){
	$topicsdata=$dbobj->GetData("select * from blog_data where view_chk = 1 and ryear=".$_GET["year"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else if($_GET["month"]!=NULL) {
$_GET["year"]=date("Y");
	$topicsdata=$dbobj->GetData("select * from blog_data where view_chk = 1 and ryear=".$_GET["year"]." and rmonth=".$_GET["month"]." order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
else {
	$topicsdata=$dbobj->GetData("select * from blog_data where view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["blog_id"]=$topicsdata["blog_id"];
		$_GET["year"]=$topicsdata["ryear"];
		$_GET["month"]=$topicsdata["rmonth"];
}
if($_GET["blog_id"]!=NULL) {
$topicsnxdata=$dbobj->GetData("select * from blog_data where blog_id > ".$_GET["blog_id"]." and view_chk = 1  order by blog_id");
$topicsbfdata=$dbobj->GetData("select * from blog_data where blog_id < ".$_GET["blog_id"]." and view_chk = 1  order by blog_id desc");

if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
	$_GET["month"]=$newbloglistdata["rmonth"];
}
else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]." and view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}else if($_GET["year"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_GET["month"]." and view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["year"]=$newbloglistdata["ryear"];
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}
else if($_GET["month"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc");
	$_GET["month"]=date("m");
}

$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and ryear = ".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc";
$newblogdata=$dbobj->GetList($newblogsql);
$yearlist=$dbobj->GetList("select distinct ryear from blog_data where view_chk = 1 order by ryear desc");
$monthlist=$dbobj->GetList("select distinct rmonth from blog_data where view_chk = 1 and ryear = ".$_GET["year"]." order by rmonth desc");
}
$catelist=$dbobj->GetList("select * from blog_cate where view_chk = 1 order by turn");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head> 
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
<?php
}
?>
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" /> 
<title>物件検索</title> 
<meta name="keywords" content="不動産,スマートフォン,物件.検索" /> 
<meta name="description" content="スマホで不動産物件検索" /> 
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<style type="text/css">
<!--
.style1 {font-size: small}
-->
</style>
</head> 
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > トピックス</h1>
</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div style="margin:0 0 1% 0;">
<img src="img/topics/ttl.jpg" width="100%" /></div>



<div >
<a href="topics.php"><img src="img/topics/3_1.jpg" width="25%" border="0" /></a><a href="topics_month.php"><img src="img/topics/3_2.jpg" width="25%" border="0" /></a><img src="img/topics/3_3.jpg" width="25%" border="0" /><img src="img/topics/3_4.jpg" width="25%" /></div>


<?php
for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++) {
?>
<div >
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="topics" onclick="location='topics_year_month.php?year=<?php echo $yearlist[$yi]["ryear"]; ?>'">
  <tr>
    <td>
      <h2 style="font-size:14px; padding-left:10px;">
		<?php echo $yearlist[$yi]["ryear"]; ?>年
	  </h2>
	</td>
	<td width="10%"><img src="img/main/alterna/more.jpg" width="100%" border="0" /></td>
  </tr>
</table><hr class="hrt"></div>
<?php
}
?>


<div id="footer">
<?php include"footer.html" ?>

</div>













</body> 
</html> 