<?php
session_start();
include "ITC/modules.php";

$usedb="postgresql";
$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->name=str_replace("www.","",$_SERVER['SERVER_NAME']);
$dbobj->Connect();
$newbdata=$dbobj->GetList($newbsql);

if($_REQUEST["year"]==NULL) {
	$_REQUEST["year"]=date("Y");
}
if($_REQUEST["month"]==NULL) {
	$_REQUEST["month"]=date("m");
}

$topicsdata=$dbobj->GetData("select * from blog_data where blog_id= ".$_REQUEST["blog_id"]." and view_chk = 1");
$topicsnxdata=$dbobj->GetData("select * from blog_data where blog_id > ".$_REQUEST["blog_id"]." and view_chk = 1 and cate_id=".$topicsdata["cate_id"]." order by blog_id");
$topicsbfdata=$dbobj->GetData("select * from blog_data where blog_id < ".$_REQUEST["blog_id"]." and view_chk = 1 and cate_id=".$topicsdata["cate_id"]." order by blog_id desc");

if($_REQUEST["year"]==NULL&&$_REQUEST["month"]==NULL&&$topicsdata["cate_id"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where view_chk = 1 order by rdate desc");
	$_REQUEST["year"]=$newbloglistdata["ryear"];
	$_REQUEST["month"]=$newbloglistdata["rmonth"];
}
else if($_REQUEST["year"]==NULL&&$_REQUEST["month"]==NULL&&$topicsdata["cate_id"]!=NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where view_chk = 1 and  cate_id=".$topicsdata["cate_id"]." order by rdate desc");
	$_REQUEST["year"]=$newbloglistdata["ryear"];
	$_REQUEST["month"]=$newbloglistdata["rmonth"];
}
else if($_REQUEST["year"]==NULL&&$topicsdata["cate_id"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_REQUEST["month"]." and view_chk = 1 order by rdate desc");
	$_REQUEST["year"]=$newbloglistdata["ryear"];
}else if($_REQUEST["year"]==NULL&&$topicsdata["cate_id"]!=NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where rmonth=".$_REQUEST["month"]." and  cate_id=".$topicsdata["cate_id"]." and view_chk = 1 order by rdate desc");
	$_REQUEST["year"]=$newbloglistdata["ryear"];
}
else if($_REQUEST["month"]==NULL&&$topicsdata["cate_id"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_REQUEST["year"]." and view_chk = 1 order by rdate desc");
	$_REQUEST["month"]=date("m");
}
else if($_REQUEST["month"]==NULL&&$topicsdata["cate_id"]==NULL) {
	$newbloglistdata=$dbobj->GetData("select * from blog_data where  ryear = ".$_REQUEST["year"]." and view_chk = 1 and  cate_id=".$topicsdata["cate_id"]." order by rdate desc");
	$_REQUEST["month"]=date("m");
}

if($topicsdata["cate_id"]!=NULL) {
$newblogsql="select * from blog_data where rmonth=".$_REQUEST["month"]." and ryear = ".$_REQUEST["year"]." and view_chk = 1 and cate_id=".$topicsdata["cate_id"]."  order by rdate desc";
}
else {
$newblogsql="select * from blog_data where rmonth=".$_REQUEST["month"]." and ryear = ".$_REQUEST["year"]." and view_chk = 1 order by rdate desc";
}

$newblogdata=$dbobj->GetList($newblogsql);
if($topicsdata["cate_id"]!=NULL) {
$yearlist=$dbobj->GetList("select distinct ryear from blog_data where view_chk = 1 and cate_id=".$topicsdata["cate_id"]." order by ryear desc");
}
else {
$yearlist=$dbobj->GetList("select distinct ryear from blog_data where view_chk = 1 order by ryear desc");
	
}
if($topicsdata["cate_id"]!=NULL) {
$monthlist=$dbobj->GetList("select distinct rmonth from blog_data where view_chk = 1 and ryear = ".$_REQUEST["year"]." and cate_id=".$topicsdata["cate_id"]." order by rmonth desc");
}
else {
$monthlist=$dbobj->GetList("select distinct rmonth from blog_data where view_chk = 1 and ryear = ".$_REQUEST["year"]." order by rmonth desc");
}
$catelist=$dbobj->GetList("select * from blog_cate where view_chk = 1 order by turn");
if($topicsdata["cate_id"]!=NULL){
	$catedata=$dbobj->GetData("select * from blog_cate where view_chk=1 and cate_id = ".$topicsdata["cate_id"]);
}
else {
	$catedata["cate_name"]="地域情報・トピックス";
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title><?php echo $tenpodata["pagetitle"];?></title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<style>
#topics .text img{
	margin-top:10px;
	margin-bottom:10px;
}
#topics .title{
	color:#666666;
	font-size:18px;
	font-weight:bold;
	line-height:30px;
	
}

#topics .cate a{
	color:#666666;
	font-size:12px;
	font-weight:bold;
}

#topics .text{
	color:#666666;
	font-size:12px;
	line-height:18px;
}
#topics .navi a{
	color:#6666CC;
	font-size:12px;
	line-height:18px;
}
#topics .navi{
	color:#666666;
	font-size:12px;
	line-height:18px;
}
#topics .date{
	color:#6666CC;
	font-size:12px;
	font-weight:bold;
}

#topics .maintitle{
	color:#333333;
	font-size:13px;
	font-weight:bold;
	line-height:30px;
}


</style>
</head>

<body>
<div id="topics">
<table width="796" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
				<td colspan="4"><img src="img/template/border1.jpg" width="796" height="15"></td>
		</tr>
		<tr>
				<td width="17" rowspan="4" background="img/template/border2.jpg"><img src="img/template/border2.jpg" width="17" height="29"></td>
				<td colspan="2"><img src="img/template/header.jpg" width="760" height="68" border="0" usemap="#Map">
						<map name="Map">
								<area shape="rect" coords="-5,-4,303,64" href="tempo.php" alt="和木不動産">
								<area shape="rect" coords="588,1,790,82" href="#" alt="不動産売買・賃貸仲介ニューインディア保険代理店　ＴＥＬ0827-52-2729">
						</map>
				</td>
				<td width="17" rowspan="6" background="img/template/border3.jpg"><img src="img/template/border3.jpg" width="18" height="24"></td>
		</tr>
		<tr>
				<td colspan="2">
						<script src="flashtopics.js"></script>
						<br>
						<img src="img/pre/sp0.jpg" width="12" height="8"></td>
		</tr>
		<tr>
				<td colspan="2" valign="top"><img src="img/topics/head.jpg" width="760" height="140"></td>
		</tr>
		
		<tr>
				<td width="556" valign="top">
						<table width="556" border="0" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3" width="556"><img src="img/topics/border1.jpg" width="556" height="40"></td>
								</tr>
								<tr>
										<td width="18" background="img/topics/border2.jpg"><img src="img/topics/border2.jpg" width="18" height="35"></td>
										<td width="511">
												<table width="511" border="0" cellpadding="0" cellspacing="0">
														<tr>
																<td>
																		<table width="511" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																						<td class="maintitle"><?php echo $topicsdata["ryear"];?>年<?php echo $topicsdata["rmonth"];?>月 <?php echo $catedata["cate_name"]; ?></td>
																						</tr>
																		</table>
																</td>
																</tr>
														<tr>
																<td>
																		<table width="100%" border="0" cellspacing="0" cellpadding="0">
																				<tr>
																						<td><span class="date"><?php echo str_replace("-","/",$topicsdata["rdate"]);?></span> 　　</td>
																						<td class="navi">&nbsp;</td>
																				</tr>
																		</table>
																</td>
														</tr>
														<tr>
																<td class="title">■<?php echo $topicsdata["title"];?></td>
																</tr>
														<tr>
																<td height="300" valign="top" class="text"><span><?php echo $topicsdata["comm"];?><?php if($topicsdata["image"]!=NULL) {?>
																		<br>
																		<img src="<?php echo $topicsdata["image"];?>" alt="<?php echo strip_tags($topicsdata["text1"]);?>"><br>
																		<?php }?>
																		<?php echo $topicsdata["text1"];?>
																		<?php if($topicsdata["data_image2"]!=NULL) {?>
																		<br>
																				<img src="<?php echo $topicsdata["data_image2"];?>" alt="<?php echo strip_tags($topicsdata["text2"]);?>"><br>
																				<?php }?>
																				<span><?php echo $topicsdata["text2"];?></span><?php if($topicsdata["data_image3"]!=NULL) {?>
																				<br>
																				<img src="<?php echo $topicsdata["data_image3"];?>" alt="<?php echo strip_tags($topicsdata["text3"]);?>"><br>
																				<?php }?>
																				<span><?php echo $topicsdata["text3"];?></span><br>
																</span><br>
																		</td>
																</tr>
														<tr>
																<td>
																		<div align="center"></div>
																</td>
																</tr>
												</table>
										</td>
										<td width="27" background="img/topics/border3.jpg"><img src="img/topics/border3.jpg" width="27" height="28"></td>
								</tr>
								<tr>
										<td colspan="3" width="556"><img src="img/topics/border4.jpg" width="555" height="30"></td>
								</tr>
						</table>
						<br>
				</td>
				<td width="200" align="right" valign="top">
						<table width="200" border="0" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="img/topics/cate_box1.jpg" width="200" height="40"></td>
								</tr>
								<tr>
										<td width="16" rowspan="2" background="img/topics/cate_box2.jpg"><img src="img/topics/cate_box2.jpg" width="16" height="5"></td>
										<td><img src="img/template/spacer.jpg" width="176" height="5"></td>
										<td width="8" rowspan="2" background="img/topics/cate_box3.jpg"><img src="img/topics/cate_box3.jpg" width="8" height="22"></td>
								</tr>
								<tr>
										<td valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<?php
												for($ci=0;$catelist[$ci]["cate_id"]!=NULL;$ci++) {
												?>
														<tr>
																<td width="14" height="20" valign="top"><img src="img/topics/icon.jpg" width="15" height="13"></td>
																<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics.php?cate_id=<?php echo $catelist[$ci]["cate_id"];?>&year=<?php echo $_REQUEST["year"];?>&month=<?php echo $_REQUEST["month"];?>"><?php echo $catelist[$ci]["cate_name"] ?></a></td>
														</tr>
														<?php
														}
														?>
												</table>
										</td>
								</tr>
								<tr>
										<td colspan="3"><img src="img/topics/cate_box4.jpg" width="200" height="13"></td>
								</tr>
						</table>
						<table width="200" border="0" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="img/topics/topicslist.jpg" width="200" height="39"></td>
								</tr>
								<tr>
										<td width="16" rowspan="2" background="img/topics/cate_box2.jpg"><img src="img/topics/cate_box2.jpg" width="16" height="5"></td>
										<td><img src="img/link/linkcateboxsp.jpg" width="176" height="3"></td>
										<td width="8" rowspan="2" background="img/topics/cate_box3.jpg"><img src="img/topics/cate_box3.jpg" width="8" height="22"></td>
								</tr>
								<tr>
										<td valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<?php
												for($mi=0;$newblogdata[$mi]["blog_id"]!=NULL;$mi++) {
												?>
														<tr>
																<td width="14" height="20" valign="top"><img src="img/topics/listicon.jpg" width="15" height="16"></td>
																<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$mi]["blog_id"];?>"><?php echo $newblogdata[$mi]["title"];?></a></td>
														</tr>
														<?php
														}
														?>
												</table>
										</td>
								</tr>
								<tr>
										<td colspan="3"><img src="img/topics/cate_box4.jpg" width="200" height="13"></td>
								</tr>
						</table>
						<table width="200" border="0" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="img/topics/month_box1.jpg" width="200" height="39"></td>
								</tr>
								<tr>
										<td width="16" rowspan="2" background="img/topics/cate_box2.jpg"><img src="img/topics/cate_box2.jpg" width="16" height="5"></td>
										<td><img src="img/link/linkcateboxsp.jpg" width="176" height="3"></td>
										<td width="8" rowspan="2" background="img/topics/cate_box3.jpg"><img src="img/topics/cate_box3.jpg" width="8" height="22"></td>
								</tr>
								<tr>
										<td valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<?php
												for($mi=0;$monthlist[$mi]["rmonth"]!=NULL;$mi++) {
												?>
														<tr>
																<td width="14" height="20" valign="top"><img src="img/topics/icon.jpg" width="15" height="13"></td>
																<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics.php?year=<?php echo $_REQUEST["year"];?>&month=<?php echo $monthlist[$mi]["rmonth"];?>&cate_id=<?php echo $topicsdata["cate_id"];?>"><?php echo $_REQUEST["year"] ?>年<?php echo $monthlist[$mi]["rmonth"] ?>月 (<?php
																if($topicsdata["cate_id"]!=NULL) {
																$numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_REQUEST["year"]." and rmonth=".$monthlist[$mi]["rmonth"]." and view_chk= 1 and cate_id=".$topicsdata["cate_id"]."");
																}
																else {
																$numdata=$dbobj->GetData("select count(rmonth) as monthnum from blog_data where ryear = ".$_REQUEST["year"]." and rmonth=".$monthlist[$mi]["rmonth"]." and view_chk= 1");
																	
																}
																echo $numdata["monthnum"];
																?>)</a></td>
														</tr>
														<?php
														}
														?>
												</table>
										</td>
								</tr>
								<tr>
										<td colspan="3"><img src="img/topics/cate_box4.jpg" width="200" height="13"></td>
								</tr>
						</table>
						<table width="200" border="0" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="img/topics/year_box1.jpg" width="200" height="41"></td>
								</tr>
								<tr>
										<td width="16" rowspan="2" background="img/topics/cate_box2.jpg"><img src="img/topics/cate_box2.jpg" width="16" height="28"></td>
										<td><img src="img/link/linkcateboxsp.jpg" width="176" height="3"></td>
										<td width="8" rowspan="2" background="img/topics/cate_box3.jpg"><img src="img/topics/cate_box3.jpg" width="8" height="22"></td>
								</tr>
								<tr>
										<td valign="top">
												<table width="100%" border="0" cellpadding="0" cellspacing="0">
														<?php
												for($yi=0;$yearlist[$yi]["ryear"]!=NULL;$yi++) {
												?>
														<tr>
																<td width="14" height="20" valign="top"><img src="img/topics/icon.jpg" width="15" height="13"></td>
																<td width="95%" height="20" align="left" valign="middle" class="cate"><a href="topics.php?year=<?php echo $yearlist[$yi]["ryear"]; ?>&month=<?php echo $_REQUEST["month"]; ?>&cate_id=<?php echo $topicsdata["cate_id"]; ?>"><?php echo $yearlist[$yi]["ryear"]; ?>年</a></td>
														</tr>
														<?php
														}
														?>
												</table>
										</td>
								</tr>
								<tr>
										<td colspan="3"><img src="img/topics/cate_box4.jpg" width="200" height="13"></td>
								</tr>
						</table>
						<img src="img/template/spacer.jpg" width="9" height="5"><br>
						<?php
$bannerobj=new Site_Banner($dbobj);
$bannerlist=$bannerobj->GetDataList(2,$lim,$setnum,$orderby); 
						for($bi=0;$bannerlist[$bi]["data_id"]!=NULL;$bi++) {
						?>
						<?php
						if($bannerlist[$bi]["url"]!=NULL) {
						?>
						<a href="<?php echo $bannerlist[$bi]["url"] ?>" target="<?php echo $bannerlist[$bi]["target"] ?>"><img src="<?php echo $bannerlist[$bi]["data_image"] ?>" width="200" border="0"></a> <img src="img/template/spacer.jpg" width="9" height="9"><br>
						<?php
						}
						else {
						?>
						<img src="<?php echo $bannerlist[$bi]["data_image"] ?>" width="200" border="0"> <img src="img/template/spacer.jpg" width="9" height="9"><br>
						<?php
						}
						}
						?>
				</td>
		</tr>
		<tr>
				<td colspan="4"><img src="img/template/footer.jpg" width="796" height="48" border="0" usemap="#Mapfoot"></td>
		</tr>
</table>
<p><br>
</p>

</div>
<map name="Mapfoot"><area shape="rect" coords="582,11,796,43" href="http://www.itcube.jp" target="_blank" alt="有限会社　アイティーキューブ">
</map>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-3201972-1";
urchinTracker();
</script>
</body>
</html>
