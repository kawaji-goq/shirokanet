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
$re1obj=new RealEstate($dbobj);
$re1obj->type=$_SESSION["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =2");
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$tenpodata=$dbobj->GetData("select * from tenpo_data");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">。
<meta name="robots" content="noarchive">
<?php
}
?>
<title><?php echo $tenpodata["pagetitle"];?>/賃貸物件</title>
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
<table border="0" cellpadding="0" cellspacing="0" align="center" class="Searchtype" style="margin-top:10px;">
	<tr>
		<td colspan="3" class="Searchtype_top">
			<img src="img/BukkenSearchCategoryHeader.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td colspan="3" class="Searchtype_head">
			<img src="img/rent.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_blue" value="アパート&#13;&#10;マンション" onClick="location.href='/iphone/chintai.php?cid=1'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_blue" value="戸建て住宅" onClick="location.href='/iphone/chintai.php?cid=2'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_blue" value="業務用物件" onClick="location.href='/iphone/chintai.php?cid=3'"/></td>
	</tr>
	<tr>
		<td colspan="3" class="Searchtype_head">
			<img src="img/buy.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_red" value="戸建て住宅&#13;&#10;マンション" onClick="location.href='/iphone/baibai.php?cid=4'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_red" value="業務用物件" onClick="location.href='/iphone/baibai.php?cid=6'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_red" value="土地" onClick="location.href='/iphone/baibai.php?cid=5'"/></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="Narrowing" style="margin-top:10px;">
<form id="form1" name="form1" method="post" action="">
	<tr>
		<td colspan="5" class="Narrowing_top">
			<img src="img/BukkenSearchHeader.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td align="center" class="Narrowing_middle_left">
			間取り
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="madori" name="madori" class="Narrowing_select">
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4ＤＫ以上</option>
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>指定無し</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" class="Narrowing_middle_left">
			地域
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="chiiki" name="chiiki" class="Narrowing_select">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++)
{
?>
				<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
<?php
}
?>
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="Narrowing_middle_left">賃料</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle"> 〜</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="hicost" id="hicost" value="<?php echo $_SESSION["hicost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle">万円</td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="Narrowing_submit">
				<tr>
					<td align="center" class="Narrowing_bottom_left">キーワード</td>
					<td align="center" class="Narrowing_bottom_middle"><input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" class="Narrowing_keyword"/></td>
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input type="hidden" name="cid" id="cid" value="2" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="2" />
</form>
</table>
<table border="0" cellpadding="0" cellspacing="0" class="bukken_detail">
	<tr>
		<td class="bukken_detail_title"><strong><font color="#FFFFFF" style="font-size:12px;">賃貸物件　<?php echo $re1data["syumoku"] ?></font><font color="#333333" style="font-size:12px;"></font></strong></td>
		<td class="bukken_detail_button"><input type="button" name="seach_contact" id="seach_contact"  value="この物件の問い合わせをする" class="link" onClick="location.href='/iphone/contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"/></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkendata" style="margin-top:10px;">
	<tr>
		<td width="50%" class="bukkendata_top_h20" style=" border-left:none; -webkit-border-top-left-radius: 3px; -webkit-border-top-right-radius: 3px;"><?php echo $bsetdata["photo_name"] ?></td>
		<td width="50%" class="bukkendata_top_h20" style=" border-left:none; -webkit-border-top-left-radius: 3px; -webkit-border-top-right-radius: 3px;"><?php echo $bsetdata["madorizu_name"] ?></td>
	</tr>
	<tr>
		<td align="center" valign="top" class="bukkendata_middle_h20" style="border-top:none; border-left:none; -webkit-border-bottom-left-radius: 3px; -webkit-border-bottom-right-radius: 3px;">
<?php
if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL)
{
?>
			<img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" style="max-width:150px" />
<?php
}
if($re1data["photo1"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"])."?".time();; ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]; ?>" border="0" style="max-width:150px" />
</a>
<?php
}
if($re1data["photo2"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo2"])."?".time();; ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]; ?>" border="0" style="max-width:150px" />
</a>
<?php
}
if($re1data["photo3"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo3"])."?".time();; ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]; ?>" border="0" style="max-width:150px" />
</a>
<?php
}
if($re1data["photo4"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo4"])."?".time();; ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]; ?>" border="0" style="max-width:150px" />
</a>
<?php
}
if($re1data["photo5"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo5"])."?".time();; ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"]; ?>" border="0" style="max-width:150px" />
</a>
<?php
}
?>
		</td>
		<td align="center" valign="top" class="bukkendata_middle_h20" style="border-top:none; border-left:none; -webkit-border-bottom-left-radius: 3px; -webkit-border-bottom-right-radius: 3px;">
<?php
if($re1data["madorizu1"]==NULL&&$re1data["madorizu2"]==NULL)
{
?>
			<img src="<?php echo "/img/noimage_300_300.gif"; ?>" border="0" style="max-width:150px" />
<?php
}
if($re1data["madorizu1"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu1"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time(); ?>" border="0" style="max-width:150px" /></a>
<?php
}
if($re1data["madorizu2"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu2"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"]."?".time(); ?>" border="0" style="max-width:150px" /></a>
<?php
}
?>
			</a>
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkendata_info" style="margin-top:10px;">
	<tr>
		<td colspan="2" class="bukkendata_top">
			物件情報
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["madori_name"] ?><br><?php echo $bsetdata["senyumenseki_name"] ?>
		</td>
		<td class="bukkendata_top_right">
<?php
if($re1data["madori"]!=NULL&&$re1data["madori"]!=0)
{
	echo $re1data["madori"].$re1data["madori_tani"]; }else{ echo "-";
}
?>
                                                        <br />
<?php
if($re1data["senyumenseki"]!=NULL)
{
	echo $re1data["senyumenseki"]."m<sup>2</sup><br />（約".number_format($re1data["senyumenseki"]*0.3025,2)."坪）";
}
else
{
	echo "-";
}
?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["reikin_name"] ?><br><?php echo $bsetdata["shikikin_name"] ?>
		</td>
		<td class="bukkendata_top_right">
<?php
	if($re1data["kakaku"]!=NULL)
	{
		echo "<span class=\"list_price\">".number_format($re1data["kakaku"],1)."</span><span class=\"list_price_tani\">万円</span>";
	}
	else
	{
		echo "-";
	}
?>
						<br />
<?php 
	if($re1data["kanrihi"]!=NULL)
	{
?>
						<?php echo number_format($re1data["kanrihi"],0); ?>円
<?php 
	}
	else
	{
		echo "-";
	}
?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["kakaku_name"] ?><br><?php echo $bsetdata["kanrihi_name"] ?>
		</td>
		<td class="bukkendata_top_right">
<?php if($re1data["reikin"]!=NULL){echo $re1data["reikin"]."ヶ月 ";} ?>
<?php
	if($re1data["reikin_tani"]!=NULL)
	{
		echo $re1data["reikin_tani"]."万円";
	}
	else
	{
		echo "-";
	}
?>
						<br />
<?php
	if($re1data["shikikin"]!=NULL || $re1data["sikikintani"]!=NULL)
	{
		if($re1data["shikikin"]!=NULL)
		{
			echo $re1data["shikikin"]."ヶ月 ";
		}
?>
<?php 
		if($re1data["sikikintani"]!=NULL)
		{
			echo $re1data["sikikintani"]."万円";
		}
	}
	else
	{
		echo "-";
	}
?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["jyusyo_name"] ?>
		</td>
		<td class="bukkendata_top_right">
			<?php echo $re1data["jyusyo1"].$re1data["jyusyo2"];if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];} ?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["ensen_name"] ?>
		</td>
		<td class="bukkendata_top_right">
			<?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."駅";} ?>
			<?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
			<?php if($re1data["ekiho"]!=NULL) {echo "・徒歩".$re1data["ekiho"]."分";} ?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["syumoku_name"] ?><br><?php echo $bsetdata["kouzou_name"] ?>
		</td>
		<td class="bukkendata_top_right">
			<?php echo $re1data["syumoku"]; ?><br />
			<?php echo $re1data["kouzou"]; ?>
		</td>
	</tr>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["chiku_nen_name"] ?>
		</td>
		<td class="bukkendata_top_right">
<?php 
	if($re1data["chiku_nen"]!=NULL || $re1data["chiku_tsuki"]!=NULL)
	{
		if($re1data["chiku_nen"]!=NULL)
		{
			echo $re1data["chiku_nen"]."年";
		}
		if($re1data["chiku_tsuki"]!=NULL)
		{
			echo $re1data["chiku_tsuki"]."月";
		}
	}
	else
	{
		echo "-";
	}
?> 
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkendata_info" style="margin-top:10px;">
	<tr>
		<td colspan="2" class="bukkendata_top">
			その他詳細情報
		</td>
	</tr>
<?php
if($bsetdata["bukken_id_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["bukkenn_id"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_top_left">
			<?php echo $bsetdata["bukken_id_name"] ?>
		</td>
		<td class="bukkendata_top_right">
			<?php echo $re1data["bukkenn_id"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["bukken_mei_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["bukken_mei"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["bukken_mei_name"] ?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["bukken_mei"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["syumoku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["syumoku"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["syumoku_name"] ?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["syumoku"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["jyusyo_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["jyusyo1"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["jyusyo_name"] ?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"] ?>
		</td>
	</tr>
<?php
	}
}
if($bukkensetdata["nodata_view"]==1||$re1data["ensen"]!=NULL||$re1data["eki"]!=NULL||$re1data["ekiho"]!=NULL||$re1data["basutei"]!=NULL||$re1data["basu"]!=NULL||$re1data["basu_ho"]!=NULL||$re1data["kuruma"]!=NULL||$re1data["kyori"]!=NULL)
{
?>
	<tr>
		<td class="bukkendata_middle_left">
			交通
		</td>
		<td class="bukkendata_middle_right">
<?php
	if($bsetdata["ensen_view"]==1)
	{
		if($re1data["eki"]!=NULL)
		{
			echo $re1data["eki"]."駅";
		}
		if($re1data["ensen"]!=NULL)
		{
			echo "[".$re1data["ensen"]."]";
		}
		if($re1data["ekiho"]!=NULL)
		{
			echo " 徒歩 ".$re1data["ekiho"]." 分";
		}
		if($re1data["kyori"]!=NULL)
		{
			echo " 距離 ".$re1data["kyori"]."m";
		}																																								}
	if($bsetdata["basu_view"]==1)
	{
		if($re1data["basutei"]!=NULL)
		{
			echo "<br />バス停 ".$re1data["basutei"];
		}
		if($re1data["basu"]!=NULL)
		{
			echo "[乗車時間".$re1data["basu"]."分]";
		}
		if($re1data["basu_ho"]!=NULL)
		{
			echo " から徒歩 ".$re1data["basu_ho"]." 分";
		}
	}
	if($bsetdata["kuruma_view"]==1)
	{
		if($re1data["kuruma"]!=NULL)
		{
			echo "<br />車で".$re1data["kuruma"]."分";
		}
	}
?>
		</td>
	</tr>
<?php
}
if($bsetdata["syougakkouku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||str_replace("小学校","",$re1data["syougakkouku"])!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["syougakkouku_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if(str_replace("小学校","",$re1data["syougakkouku"])!=NULL)
		{
			echo str_replace("小学校","",$re1data["syougakkouku"])."小学校";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["chuugakouku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||str_replace("中学校","",$re1data["chuugakouku"])!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["chuugakouku_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if(str_replace("中学校","",$re1data["chuugakouku"])!=NULL)
		{
			echo str_replace("中学校","",$re1data["chuugakouku"])."中学校";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["kakaku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kakaku"]!=0)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["kakaku_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["kakaku"]!=NULL)
		{
			echo "<span class=\"bukken_detail_price\">".number_format($re1data["kakaku"],1)."</span> <span class=\"bukken_detail_price_tani\">万円</span>";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["madori_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["madori"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["madori_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["madori"].$re1data["madori_tani"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["madori_syousai_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["madori_syousai"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["madori_syousai_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["madori_syousai"]; ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["senyumenseki_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["senyumenseki"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["senyumenseki_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php if($re1data["senyumenseki"]!=NULL) { echo $re1data["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data["senyumenseki"]*0.3025,2)."坪）";} ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["barukoni_houkou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["barukoni_houkou"]!=NULL||$re1data["barukoni_menseki"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["barukoni_houkou_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["barukoni_houkou"]!=NULL)
		{
			echo "方向".$re1data["barukoni_houkou"]." ";
		}
		if($re1data["barukoni_menseki"]!=NULL)
		{
			echo "面積".$re1data["barukoni_menseki"]."m<sup>2</sup>";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["shikikin_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["shikikin"]!=NULL||$re1data["sikikintani"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["shikikin_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php 
		if($re1data["shikikin"]!=NULL)
		{
			echo $re1data["shikikin"]."ヶ月　";
		}
		if($re1data["sikikintani"]!=NULL)
		{
			echo $re1data["sikikintani"]."万円";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["kanrihi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kanrihi"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["kanrihi_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php if($re1data["kanrihi"]!=NULL){ echo number_format($re1data["kanrihi"],0)."円";} ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["reikin_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["reikin"]!=NULL||$re1data["reikin_tani"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["reikin_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["reikin"]!=NULL)
		{
			echo $re1data["reikin"]."ヶ月　";
		}
		if($re1data["reikin_tani"]!=NULL)
		{
			echo $re1data["reikin_tani"]."万円";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["syuzenhi_tsumitate_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["syuzenhi_tsumitate"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["syuzenhi_tsumitate_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php if($re1data["syuzenhi_tsumitate"]!=NULL){ echo $re1data["syuzenhi_tsumitate"]."円";} ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["kyouekihi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kyouekihi"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["kyouekihi_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php if($re1data["kyouekihi"]!=NULL){ echo number_format($re1data["kyouekihi"],0)."円";} ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["hosyoukin_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin_kakaku"]!=NULL||$re1data["hosyoukin_kikan"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["hosyoukin_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["hosyoukin_kikan"]!=NULL)
		{
			echo $re1data["hosyoukin_kikan"]."ヶ月　";
		}
		if($re1data["hosyoukin_kakaku"]!=NULL)
		{
			echo $re1data["hosyoukin_kakaku"]."万円";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["zappi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL||$re1data["zappi2"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["zappi_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["zappi2"]!=NULL)
		{
			echo $re1data["zappi2"]."　";
		}
		if($re1data["zappi"]!=NULL)
		{
			echo number_format($re1data["zappi"],0)."円";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["chusyajou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["chusya_ryoukin"]!=NULL||$re1data["chusyajou"]!=NULL)
	{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["chusyajou_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["chusyajou"]; ?>
<?php
		if($re1data["chusya_ryoukin"]!=NULL)
		{
			echo number_format($re1data["chusya_ryoukin"],0)."円";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["kouzou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kouzou"]!=NULL)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["kouzou_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["kouzou"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["kaisou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kaisou"]!=NULL||$re1data["chijoukaisou"]!=NULL||$re1data["chikakaisou"]!=NULL)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["kaisou_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["kaisou"]!=NULL)
		{
			echo $re1data["kaisou"]."階";
		}
?>
<?php
		if($re1data["chijoukaisou"]!=NULL)
		{
			echo "地上".$re1data["chijoukaisou"]."階建";
		}
?>
<?php
		if($re1data["chikakaisou"]!=NULL)
		{
			echo "地下".$re1data["chikakaisou"]."階建";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["chiku_nen_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["chiku_nen"]!=NULL||$re1data["chiku_tsuki"]!=NULL)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["chiku_nen_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($re1data["chiku_nen"])
		{
			echo $re1data["chiku_nen"]."年";
		}
		if($re1data["chiku_tsuki"])
		{
			echo $re1data["chiku_tsuki"]."月";
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["genkyou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["genkyou_name"]?>
		</td>
		<td class="bukkendata_middle_right">
<?php
		if($osusumedata[$i]["genkyou"]=="商談中")
		{
?>
			<font color="#FF0000"> 【商談中】</font>
<?php
		}
		else if($osusumedata[$i]["genkyou"]=="成約済")
		{
?>
			<font color="#FF0000"> 【成約済】</font>
<?php
		}
		else
		{
			echo $re1data["genkyou"];
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["hikiwatashi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]!=NULL)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["hikiwatashi_name"]?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["hikiwatashi"] ?>
<?php
		if($re1data["hikiwatashi_nen"]!=NULL)
		{
			echo $re1data["hikiwatashi_nen"]."年";
		}
		if($re1data["hikiwatashi_tsuki"]!=NULL)
		{
			echo $re1data["hikiwatashi_tsuki"]."月";
		}
?>
			<?php echo $re1data["hikiwatashi_syun"] ?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["setsubi_naka_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]==1||$re1data["setsubi_naka1"]==1||$re1data["setsubi_naka2"]==1||$re1data["setsubi_naka3"]==1||$re1data["setsubi_naka4"]==1||$re1data["setsubi_naka5"]==1||$re1data["setsubi_naka6"]==1||$re1data["setsubi_naka7"]==1||$re1data["setsubi_naka8"]==1||$re1data["setsubi_naka9"]==1||$re1data["setsubi_naka10"]==1||$re1data["setsubi_naka11"]==1||$re1data["setsubi_naka12"]==1||$re1data["setsubi_naka13"]==1||$re1data["setsubi_naka14"]==1||$re1data["setsubi_naka15"]==1||$re1data["setsubi_naka16"]==1||$re1data["setsubi_naka17"]==1||$re1data["setsubi_naka18"]==1||$re1data["setsubi_naka19"]==1||$re1data["setsubi_naka20"]==1)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["setsubi_naka_name"]?>
		</td>
		<td class="bukkendata_middle_right" style="padding-top:5px;">
<?php
		if($re1data["setsubi_naka1"]==1)
		{
?>
			給湯<br>
<?php
		}
		if($re1data["setsubi_naka2"]==1)
		{
?>
			冷蔵庫<br>
<?php
		}
		if($re1data["setsubi_naka3"]==1)
		{
?>
			オール電化<br>
<?php
		}
		if($re1data["setsubi_naka4"]==1)
		{
?>
			照明<br>
<?php
		}
		if($re1data["setsubi_naka5"]==1)
		{
?>
			有線<br>
<?php
		}
		if($re1data["setsubi_naka6"]==1)
		{
?>
			ケーブルテレビ対応<br>
<?php
		}
		if($re1data["setsubi_naka7"]==1)
		{
?>
			インターネット対応<br>
<?php
		}
		if($re1data["setsubi_naka8"]==1)
		{
?>
			テレビ<br>
<?php
		}
		if($re1data["setsubi_naka9"]==1)
		{
?>
			居間フローリング<br>
<?php
		}
		if($re1data["setsubi_naka10"]==1)
		{
?>
			システムキッチン<br>
<?php
		}
		if($re1data["setsubi_naka11"]==1)
		{
?>
			室内洗濯機<br>
<?php
		}
		if($re1data["setsubi_naka12"]==1)
		{
?>
			ウォッシュレット<br>
<?php
		}
		if($re1data["setsubi_naka13"]==1)
		{
?>
			風呂トイレ別<br>
<?php
		}
		if($re1data["setsubi_naka14"]==1)
		{
?>
			シャワー<br>
<?php
		}
		if($re1data["setsubi_naka15"]==1)
		{
?>
			シャンプードレッサー<br>
<?php
		}
		if($re1data["setsubi_naka16"]==1)
		{
?>
			エアコン付<br>
<?php
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["setsumi_soto_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["setsubi_soto1"]==1||$re1data["setsubi_soto2"]==1||$re1data["setsubi_soto3"]==1||$re1data["setsubi_soto4"]==1||$re1data["setsubi_soto5"]==1||$re1data["setsubi_soto6"]==1||$re1data["setsubi_soto7"]==1||$re1data["setsubi_soto8"]==1||$re1data["setsubi_soto9"]==1||$re1data["setsubi_soto10"]==1)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["setsumi_soto_name"]?>
		</td>
		<td class="bukkendata_middle_right" style="padding-top:5px;">
<?php
		if($re1data["setsubi_soto1"]==1)
		{
?>
			駐輪場<br>
<?php
		}
		if($re1data["setsubi_soto2"]==1)
		{
?>
			駐車場2台以上可<br>
<?php
		}
		if($re1data["setsubi_soto3"]==1)
		{
?>
			オートロック<br>
<?php
		}
		if($re1data["setsubi_soto4"]==1)
		{
?>
			エレベータ<br>
<?php
		}
		if($re1data["setsubi_soto5"]==1)
		{
?>
			宅配ボックス<br>
<?php
		}
?>
		</td>
	</tr>
<?php
	}
}
if($bsetdata["jouken_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["jouken1"]==1||$re1data["jouken2"]==1||$re1data["jouken3"]==1||$re1data["jouken4"]==1||$re1data["jouken5"]==1||$re1data["jouken6"]==1||$re1data["jouken7"]==1||$re1data["jouken8"]==1||$re1data["jouken9"]==1||$re1data["jouken10"]==1)
	{ 
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["jouken_name"]?>
		</td>
		<td class="bukkendata_middle_right" style="padding-top:5px;">
<?php
		if($re1data["jouken1"]==1)
		{
?>
			法人希望・限定<br>
<?php
		}
		if($re1data["jouken2"]==1)
		{
?>
			女性専用<br>
<?php
		}
		if($re1data["jouken3"]==1)
		{
?>
			ペット相談可<br>
<?php
		}
		if($re1data["jouken4"]==1)
		{
?>
			ピアノ相談可<br>
<?php
		}
?>
		</td>
	</tr>
<?php
	}
}
$setsubi_othernum=$re1data["setsubi_other1"]+$re1data["setsubi_other2"]+$re1data["setsubi_other3"]+$re1data["setsubi_other4"]+$re1data["setsubi_other5"]+$re1data["setsubi_other6"]+$re1data["setsubi_other7"]+$re1data["setsubi_other8"]+$re1data["setsubi_other9"]+$re1data["setsubi_other10"];
if($setsubi_othernum>0)
{
?>
	<tr>
		<td class="bukkendata_middle_left">
			給排水・ガス
		</td>
		<td class="bukkendata_middle_right">
<?php
	if($re1data["setsubi_other1"]==1)
	{
?>
			上水道<br>
<?php
	}
	if($re1data["setsubi_other2"]==1)
	{
?>
			井戸<br>
<?php
	}
	if($re1data["setsubi_other3"]==1)
	{
?>
			下水道<br>
<?php
	}
	if($re1data["setsubi_other4"]==1)
	{
?>
			浄化槽<br>
<?php
	}
	if($re1data["setsubi_other5"]==1)
	{
?>
			汲取<br>
<?php
	}
	if($re1data["setsubi_other6"]==1)
	{
?>
			都市ガス<br>
<?php
	}
	if($re1data["setsubi_other7"]==1)
	{
?>
			プロパンガス<br>
<?php
	}
	if($re1data["setsubi_other8"]==1)
	{
?>
			集中プロパンガス<br>
<?php
	}
?>
		</td>
	</tr>
<?php
}
if($re1data["torihikitaiyou"]!=NULL)
{
?>
	<tr>
		<td class="bukkendata_middle_left">
			<?php echo $bsetdata["torihikitaiyou_name"] ?>
		</td>
		<td class="bukkendata_middle_right">
			<?php echo $re1data["torihikitaiyou"];?>
		</td>
	</tr>
<?php
}
if($re1data["torihikitaiyou"]!=NULL)
{
?>
	<tr>
		<td class="bukkendata_middle_left">
			備考
		</td>
		<td class="bukkendata_middle_right">
			<?php echo nl2br($re1data["bikou"]); ?>
		</td>
	</tr>
<?php
}
?>
	<tr>
		<td class="bukkendata_bottom_left">
			登録年月日
		</td>
		<td class="bukkendata_bottom_right">
			<?php echo $re1data["tourokubi"]; ?>
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
