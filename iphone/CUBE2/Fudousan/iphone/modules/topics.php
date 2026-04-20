<?php
session_start();
$_SESSION["toiawase"]="";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);


include "CUBE/Fudousan/config.php";
include "CUBE/ITC/modules.php";
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
	
//	if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
//	}
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
<!DOCTYPE html>
<html lang="ja">
<head>
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
<?php
}
?>
<title><?php echo $tenpodata["pagetitle"];?>/トピックス</title>
<meta name="description" content="ごくすぽ本店｜スポーツ・ゴルフ用品の総合通販サイト">
<meta name="keywords" content="通販,インターネット通販,オンラインショッピング,ごくすぽ,ごくすぽ本店,gokuspo,ゴクスポ">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="/iphone/icon/icon.PNG">
<link rel="stylesheet" type="text/css" href="css/fudousan.css" >
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">

</head>
<body bgcolor="#DDDDDD"><a href="/iphone/index.php"><?php if($tenpodata["headerimage"]) {?><img src="<?php echo $tenpodata["headerimage"] ?>" border="0" width="100%"><?php }?></a>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="物件検索" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="会社案内" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="トピックス" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="お問合せ" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="topics">
	<tr>
		<td class="topics_top">
			<strong>トピックス</strong>
		</td>
	</tr>
	<tr>
		<td class="topics_head">
			<?php echo $topicsdata["ryear"];?>年<?php echo $topicsdata["rmonth"];?>月 <?php echo $catedata["cate_name"]; ?>
		</td>
	</tr>
<?php
for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++)
{
?>
	<tr>
		<td class="topics_body_time">
			<strong><?php echo str_replace("-","/",$newblogdata[$mi]["rdate"]);?></strong>
		</td>
	</tr>
	<tr>
		<td class="topics_body_title">
			■<?php echo $newblogdata[$mi]["title"];?>
		</td>
	</tr>
	<tr>
		<td class="topics_body_body">
			<?php echo $newblogdata[$mi]["comm"];?>
		</td>
	</tr>
	<tr>
		<td align="center" class="topics_body_img">
			<img src="<?php echo $newblogdata[$mi]["image"];?>?<?php echo time();?>" alt="<?php echo strip_tags($newblogdata[$mi]["title"]);?>" style="max-width:95%" />
		</td>
	</tr>
<?php
}
?>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="topics_list">
	<tr>
		<td class="topics_top_list">
			<strong>トピックス一覧</strong>
		</td>
	</tr>
	<tr>
		<td>
			<table>
<?php
for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++)
{
?>
				<tr>
					<td class="topics_list_body">
						<a href="/iphone/topics_details.php?blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>"><?php echo $newblogdata[$mi]["title"];?></a>
					</td>
				</tr>
<?php
}
?>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="topics_month">
	<tr>
		<td class="topics_top_month">
			<strong>月間トピックス</strong>
		</td>
	</tr>
	<tr>
		<td>
			<table>
<?php
for($mi=0;$monthlist[$mi]["rmonth"]!=NULL;$mi++)
{
?>
				<tr>
					<td class="topics_month_body">
						<a href="/iphone/topics.php?year=<?php echo $_GET["year"];?>&amp;month=<?php echo $monthlist[$mi]["rmonth"];?>"><?php echo $_GET["year"] ?>年<?php echo $monthlist[$mi]["rmonth"] ?>月 (<?php $numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_GET["year"]." and rmonth=".$monthlist[$mi]["rmonth"]." and view_chk= 1"); echo $numdata["monthnum"]; ?>
                                                )</a>
					</td>
				</tr>
<?php
}
?>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="topics_year">
	<tr>
		<td class="topics_top_year">
			<strong>年間トピックス</strong>
		</td>
	</tr>
	<tr>
		<td>
			<table>
<?php
for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++)
{
?>
				<tr>
					<td class="topics_year_body">
						<a href="/iphone/topics.php?year=<?php echo $yearlist[$yi]["ryear"]; ?>"><?php echo $yearlist[$yi]["ryear"]; ?>年</a>
					</td>
				</tr>
<?php
}
?>
			</table>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="物件検索" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="会社案内" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="トピックス" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="お問合せ" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr>
		<td align="center" style="font-size:9px; color:#555555">copyright(c)2007 ITCUBE-FUDOUSAN all reserved.</td>
	</tr>
	<tr>
		<td align="center"><img src="/iphone/img/footerlogo.jpg" border="0" style="margin-top:1px;"></td>
	</tr>
</table>
</body>
</html>
