<?php
ini_set("display_errors",1);
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
	
	if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
	}
$dbobj->Connect();
$tenpodata=$dbobj->GetData("select * from tenpo_data");

$re1obj=new RealEstate($dbobj);
$_GET["blog_id"]=intval($_GET["blog_id"]);
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
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">¡£
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?> / News ¥È¥Ô¥Ã¥¯¥¹</title>
<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--

.left2 {	font-family: "£Í£Ó £Ð¥´¥·¥Ã¥¯", Osaka, "¥Ò¥é¥®¥Î³Ñ¥´ Pro W3";
	font-size: 12px;
	font-weight: bolder;
	color: #000000;
}
.text {	font-family: "£Í£Ó £Ð¥´¥·¥Ã¥¯", Osaka, "¥Ò¥é¥®¥Î³Ñ¥´ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
.st {	font-size:14px;
	font-weight:bold;
}
-->
</style>
</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?>
<div id="topics">
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td valign="top">
                        <table width="556" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3" width="556"><img src="img/topics/TopicsHeader.jpg" width="558" height="41" /></td>
                            </tr>
                            <tr>
                                <td width="18" background="img/topics/TopicsLeft.jpg"><img src="img/topics/TopicsLeft.jpg" width="20" height="43" /></td>
                                <td width="511">
                                    <table width="511" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <table width="511" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td class="maintitle"><span class="yearmonth"><?php echo $topicsdata["ryear"];?>Ç¯<?php echo $topicsdata["rmonth"];?>·î <?php echo $catedata["cate_name"]; ?></span></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?> <tr>
                                            <td><img src="img/topics/TopicsLine.jpg" width="507" height="13" /></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    
                                                    <tr>
                                                        <td><span class="date"><?php echo str_replace("-","/",$newblogdata[$mi]["rdate"]);?></span></td>
                                                        <td class="navi">
                                                            <div align="center">¡¡</div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td class="title">¢£<?php echo $newblogdata[$mi]["title"];?></td>
                                        </tr>
                                        <tr>
                                            <td valign="top">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td valign="top" class="text"><span><?php echo $newblogdata[$mi]["comm"];?>
                                                        <?php if($newblogdata[$mi]["image"]!=NULL) {?>
                                                        <br />
                                                        <br />
                                                       <div align="center"> <img src="<?php echo $newblogdata[$mi]["image"];?>?<?php echo time();?>" alt="<?php echo strip_tags($newblogdata[$mi]["title"]);?>" /></div><br />
                                                        <?php }?>
                                            </span><br />
                                            </td>
                                        </tr>
																																								<?php
																																								}
																																								?>
                                        <tr>
                                            <td>
                                                <div align="center"></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="24" background="img/topics/TopicsRight.jpg"><img src="img/topics/TopicsRight.jpg" width="24" height="43" /></td>
                            </tr>
                            <tr>
                                <td colspan="3" width="556"><img src="img/topics/TopicsFoot.jpg" width="558" height="27" /></td>
                            </tr>
                        </table>
                    </td>
                    <td valign="top">
                        <table width="200" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsList.jpg" width="210" height="41" /></td>
                            </tr>
                            
                            <tr>
                                <td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                                <td width="163" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?>
                                        <tr>
                                            <td width="14" height="20" valign="top"><img src="img/topics/icon1.jpg" width="14" height="20" /></td>
                                            <td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>"><?php echo $newblogdata[$mi]["title"];?></a></td>
                                        </tr>
                                        <tr>
                                            <td height="5" colspan="2" valign="top"></td>
                                            </tr>
                                        <?php
														}
														?>
                                    </table>
                                </td>
                                <td width="28" align="right" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                            </tr>
                        </table>
                        <table width="200" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsMonthlyHeader.jpg" width="210" height="43" /></td>
                            </tr>
                            
                            <tr>
                                <td width="16" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                                <td width="163" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <?php
												for($mi=0;$monthlist[$mi]["rmonth"]!=NULL;$mi++) {
												?>
                                        <tr>
                                            <td width="14" height="20" valign="top"><img src="img/topics/icon2.jpg" width="14" height="20" /></td>
                                            <td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics.php?year=<?php echo $_GET["year"];?>&amp;month=<?php echo $monthlist[$mi]["rmonth"];?>"><?php echo $_GET["year"] ?>Ç¯<?php echo $monthlist[$mi]["rmonth"] ?>·î (<?php
																$numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_GET["year"]." and rmonth=".$monthlist[$mi]["rmonth"]." and view_chk= 1");
																echo $numdata["monthnum"];
																?>
                                                )</a></td>
                                        </tr>
                                        <?php
														}
														?>
                                    </table>
                                </td>
                                <td width="8" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                            </tr>
                        </table>
                        <table width="200" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsYearHeader.jpg" width="210" height="46" /></td>
                            </tr>
                            
                            <tr>
                                <td width="19" background="img/topics/TopicsMenuLeft.jpg"><img src="img/topics/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                                <td width="163" valign="top">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <?php
												for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++) {
												?>
                                        <tr>
                                            <td width="14" height="20" valign="top"><img src="img/topics/icon3.jpg" width="14" height="20" /></td>
                                            <td width="163" height="20" align="left" valign="middle" class="cate"><a href="topics.php?year=<?php echo $yearlist[$yi]["ryear"]; ?>"><?php echo $yearlist[$yi]["ryear"]; ?>Ç¯</a></td>
                                        </tr>
                                        <?php
														}
														?>
                                    </table>
                                </td>
                                <td width="28" background="img/topics/TopicsMenuRight.jpg"><img src="img/topics/TopicsMenuRight.jpg" width="28" height="20" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="img/topics/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
</div>
<?php
include "CUBE/Fudousan/template/footer.php";
?>
<map name="Map3" id="Map3">
  <area shape="rect" coords="16,3,94,38" href="index.php" />
  <area shape="rect" coords="95,3,181,39" href="#" />
  <area shape="rect" coords="183,3,269,39" href="#" />
  <area shape="rect" coords="270,3,382,39" href="#" />
</map>
</body>
</html>
