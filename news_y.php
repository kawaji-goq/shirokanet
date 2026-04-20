<?php
//ページの一番上に貼り付けて下さい。
include "Cube/Fudousan/config.php";
include "ITC/modules.php";
	$usedb="postgresql";
	$dbobj=Cube_DB :: UseDB($usedb);	$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	$dbobj->Connect();
	$newsobj=new Site_News($dbobj);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<title><?php echo $tenpodata["name"];?>物件検索システム</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<style type="text/css">
<!--
.left2 {	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	font-weight: bolder;
	color: #000000;
}
.text {	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
.st {	font-size:14px;
	font-weight:bold;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div align="center">
		<?php
include "Cube/Fudousan/template/header.php";
?>
</div>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
				<td><img src="img_f/title_newstopics.jpg" width="800" height="38" /></td>
		</tr>
		<tr>
				<td background="img_f/line2.jpg">
						<table width="700"  border="0" align="center" cellpadding="0" cellspacing="0" class="text">
								<tr align="left" valign="top">
										<td colspan="3">&nbsp;</td>
								</tr>
								<tr align="left" valign="top">
										<td width="150">
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr valign="middle">
																<th height="23" colspan="2" align="left" background="img/page_news/news_150.jpg" class="textbold12"><?php echo $_REQUEST["year"];?>年の記事一覧</th>
														</tr>
														<?php
//この部分は変更しないでください。 
$newsdata=$newsobj->YearData($_REQUEST["year"]);
for($newsrow=0;$newsdata[$newsrow];$newsrow++){ 
$news=new Ary_Viewer($newsdata[$newsrow]);
/*-------------------　新着情報一覧開始　-------------------*/
?>
														<tr valign="middle">
																<td width="13" align="left" valign="top" class="mainmenu3">●</td>
																<td width="137" align="left" valign="top" class="mainmenu3"><a href="news_y.php?news_id=<?php $news->LMoji("news_id");?>&amp;year=<?php echo $_REQUEST["year"];?>&amp;month=<?php echo $_REQUEST["month"];?>">
																		<?php $news->Moji("title"); ?>
																</a></td>
														</tr>
														<?php
}
?>
												</table>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
																<th height="23" colspan="2" align="left" valign="middle" background="img/page_news/news_150.jpg" class="textbold12">月間アーカイブ</th>
														</tr>
														<?php 
			  $newsrmonthlist=$newsobj->RMonthList($_REQUEST["year"]);
			  for($newsmrows=0;!is_null($newsrmonthlist[$newsmrows]);$newsmrows++) {
			  ?>
														<tr>
																<td width="13" align="left" valign="middle" class="mainmenu1">&nbsp;</td>
																<td width="137" align="left" valign="middle" class="mainmenu3"><a href="news_m.php?year=<?php echo $newsrmonthlist[$newsmrows]["ryear"];?>&amp;month=<?php echo $newsrmonthlist[$newsmrows]["rmonth"];?>"><?php echo $newsrmonthlist[$newsmrows]["ryear"];?>年<?php echo $newsrmonthlist[$newsmrows]["rmonth"];?>月</a></td>
														</tr>
														<?php
				  }?>
												</table>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
																<th height="23" colspan="2" align="left" valign="middle" background="img/page_news/news_150.jpg" class="textbold12">年間アーカイブ</th>
														</tr>
														<?php 
$newsryearlist=$newsobj->RYearList($_REQUEST["year"]);
for($newsrrows=0;!is_null($newsryearlist[$newsrrows]);$newsrrows++) {
?>
														<tr>
																<td width="13" align="left" valign="middle" class="mainmenu1">&nbsp;</td>
																<td width="137" align="left" valign="middle" class="mainmenu3"><a href="news_y.php?year=<?php echo $newsryearlist[$newsrrows]["ryear"];?>"><?php echo $newsryearlist[$newsrrows]["ryear"];?>年</a></td>
														</tr>
														<?php
				  }?>
														<tr>
																<td align="left" valign="middle" class="mainmenu1">&nbsp;</td>
																<td align="left" valign="middle" class="mainmenu1">&nbsp;</td>
														</tr>
												</table>
										</td>
										<td width="12">&nbsp;</td>
										<td>
												<?php
		  if(is_null($_REQUEST["news_id"])||$_REQUEST["news_id"]=="") {
			$newsdata=$newsobj->YearData($_REQUEST["year"]);
		  for($i=0;$i<1;$i++) {
		  $newsddata=new Ary_Viewer($newsdata[$i]);
		 		  	} 
		  }
		  else {
		  	$newsdata=$newsobj->GetDetailsData($_REQUEST["news_id"]);
		  $newsddata=new Ary_Viewer($newsdata);
			}
 ?>
												<table width="100%"  border="0" cellspacing="0" cellpadding="0">
														<tr>
																<td height="23" align="left" valign="middle" background="img/page_news/news355.jpg" class="mainmenu2"><?php echo $newsddata->Date("rdate","年","月","日");?></td>
														</tr>
														<tr>
																<td align="left" valign="top" class="mainmenu2" height="10"></td>
														</tr>
														<tr>
																<td align="left" valign="top" class="mainmenu2"><?php echo $newsddata->Moji("title");?></td>
														</tr>
														<tr>
																<td align="left" valign="top" class="mainmenu2" height="10"></td>
														</tr>
														<tr>
																<td align="left" valign="top"><span class="text12"><?php echo $newsddata->Moji("comm");?></span><br />
																				<?php echo $newsddata->Image("image");?></td>
														</tr>
												</table>
										</td>
								</tr>
						</table>
						<br />
								<div>
										<div align="center"><br />
										</div>
								</div>
				</td>
		</tr>
		<tr>
				<td height="38" background="img_f/line3.jpg">&nbsp;</td>
		</tr>
</table>
<?php
include "Cube/Fudousan/template/footer.php";
?>
</body>
</html>
