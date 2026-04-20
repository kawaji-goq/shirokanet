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
$re1obj=new RealEstate($dbobj);
$re1obj->type=$_SESSION["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =2");
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$tenpodata=$dbobj->GetData("select * from tenpo_data");

$_SESSION["lim"]=100000;
$sessionpage=$_SESSION["page"];
$getpage=$_GET["page"];
$_SESSION["page"]=1;
$_GET["page"]=1;
$listnum=$re1obj->GetReList(1,$_SESSION["sort"]);
$_SESSION["page"]=$sessionpage;
$_GET["page"]=$getpage;
$_SESSION["lim"]=NULL;
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
<title><?php echo $tenpodata["pagetitle"];?>/物件検索</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<style type="text/css">
<!--
.style1 {font-size: small}
.style3 {
	color: #c36;
	font-weight: bold;
}
-->
</style>
</head> 
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > <a href="chintai_mian.php">ジャンル設定</a> > <span class="style3"><a href="select_main_chintai.php?cid=<?php echo $_SESSION["cid"] ?>"><?php if($_SESSION["cid"] == 1){echo "アパート・マンション";} ?><?php if($_SESSION["cid"] == 2){echo "戸建て物件";} ?><?php if($_SESSION["cid"] == 3){echo "業務用物件";} ?><?php if($_SESSION["cid"] == 4){echo "戸建て・マンション";} ?><?php if($_SESSION["cid"] == 5){echo "土地";} ?><?php if($_SESSION["cid"] == 6){echo "業務用物件";} ?>検索結果（<?php echo count($listnum) ?>件)一覧</a> > 詳細</span></h1>

</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div>
<img src="img/main/ttl_detail.jpg" width="100%" /></div>

<div id="button"><a href="/iphone2/contact_it.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>"><img src="img/main/contact.jpg" width="75%" border="0" ></a> 
<div id="clear"></div>
</div>



<div id="button">
<img src="img/main/detail2.jpg" width="100%" /></div>









<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:2% auto 2% auto;">
  <tr>
    <td width="50%" align="center" valign="middle">
<?php
if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL&&$re1data["photo3"]==NULL&&$re1data["photo4"]==NULL&&$re1data["photo5"]==NULL)
{
?>
<img src="img/main/noimage.jpg" border="0" width="90%"/>
<?php
}
if($re1data["photo1"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]; ?>" border="0" width="90%" />
</a>
<?php
}
if($re1data["photo2"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo2"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]; ?>" border="0" width="90%" />
</a>
<?php
}
if($re1data["photo3"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo3"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]; ?>" border="0" width="90%" />
</a>
<?php
}
if($re1data["photo4"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo4"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]; ?>" border="0" width="90%" />
</a>
<?php
}
if($re1data["photo5"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo5"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"]; ?>" border="0" width="90%" />
</a>
<?php
}
?>
	</td>
    <td width="50%" align="center" valign="middle">
<?php
if($re1data["madorizu1"]==NULL&&$re1data["madorizu2"]==NULL)
{
?>
<img src="img/main/noimage.jpg" border="0" width="90%"/>
<?php
}
if($re1data["madorizu1"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu1"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time(); ?>" border="0" width="90%" /></a>
<?php
}
if($re1data["madorizu2"]!=NULL)
{
?>
<a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu2"])."?".time(); ?>" rel="lightbox">
<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"]."?".time(); ?>" border="0" width="90%" /></a>
<?php
}
?>
	</td>
  </tr>
</table>


</div>

<div id="button">
<img src="img/main/ttl_datail2.jpg" width="100%" /></div>

<div id="button">

<?php $x = 0; ?>
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" id="table-01">
  <tr>
    <td width="30%" align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
<?php echo $bsetdata["madori_name"] ?><br>
<?php
if($bsetdata["madori_syousai_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["madori_syousai"]!=NULL)
	{
		echo $bsetdata["madori_syousai_name"]."<br>";
	}
}		
?>
<?php echo $bsetdata["senyumenseki_name"] ?>
	</td>
    <td width="70%" align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
<?php
if($re1data["madori"]!=NULL&&$re1data["madori"]!=0)
{
	echo $re1data["madori"].$re1data["madori_tani"]; }else{ echo "-";
}
?><br>
<?php
if($bsetdata["madori_syousai_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["madori_syousai"]!=NULL)
	{
		echo $re1data["madori_syousai"]."<br>";
	}
}		
?>
<?php
if($re1data["senyumenseki"]!=NULL)
{
	echo $re1data["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data["senyumenseki"]*0.3025,2)."坪）";
}
else
{
	echo "-";
}
?>
	</td>
  </tr>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
<?php echo $bsetdata["reikin_name"] ?><br><?php echo $bsetdata["shikikin_name"] ?>
<?php
if($bsetdata["syuzenhi_tsumitate_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["syuzenhi_tsumitate"]!=NULL)
	{
		echo "<br>".$bsetdata["syuzenhi_tsumitate_name"];
	}
}		
?>
<?php
if($bsetdata["kyouekihi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kyouekihi"]!=NULL)
	{
		echo "<br>".$bsetdata["kyouekihi_name"];
	}
}		
?>
<?php
if($bsetdata["hosyoukin_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin_kakaku"]!=NULL||$re1data["hosyoukin_kikan"]!=NULL)
	{
		echo "<br>".$bsetdata["hosyoukin_name"];
	}
}		
?>
<?php
if($bsetdata["zappi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL||$re1data["zappi2"]!=NULL)
	{
		echo "<br>".$bsetdata["zappi_name"];
	}
}		
?>
	</td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
<?php
if($bsetdata["syuzenhi_tsumitate_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["syuzenhi_tsumitate"]!=NULL)
	{
		if($re1data["syuzenhi_tsumitate"]!=NULL)
		{
			echo "<br>".$re1data["syuzenhi_tsumitate"]."円";
		}
	}
}		
?>
<?php
if($bsetdata["kyouekihi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kyouekihi"]!=NULL)
	{
		if($re1data["kyouekihi"]!=NULL)
		{
			echo "<br>".number_format($re1data["kyouekihi"],0)."円";
		}
	}
}		
?>
<?php
if($bsetdata["hosyoukin_view"]==1)
{ 
	if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin_kakaku"]!=NULL||$re1data["hosyoukin_kikan"]!=NULL)
	{
		if($re1data["kyouekihi"]!=NULL)
		{
			if($re1data["hosyoukin_kikan"]!=NULL)
			{
				echo "<br>".$re1data["hosyoukin_kikan"]."ヶ月　";
			}
			if($re1data["hosyoukin_kakaku"]!=NULL)
			{
				if($re1data["hosyoukin_kikan"]!=NULL)
				{
					echo "<br>".$re1data["hosyoukin_kakaku"]."万円";
				}
				else
				{
					echo $re1data["hosyoukin_kakaku"]."万円";
				}
			}
		}
	}
}		
?>
<?php
if($bsetdata["zappi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL||$re1data["zappi2"]!=NULL)
	{
		if($re1data["zappi2"]!=NULL)
		{
			echo "<br>".$re1data["zappi2"]."　";
		}
		if($re1data["zappi"]!=NULL)
		{
			if($re1data["zappi2"]!=NULL)
			{
				echo number_format($re1data["zappi"],0)."円";
			}
			else
			{
				echo "<br>".number_format($re1data["zappi"],0)."円";
			}
		}
	}
}		
?>
	</td>
  </tr>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["kakaku_name"] ?><br><?php echo $bsetdata["kanrihi_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
<?php
	if($re1data["kakaku"]!=NULL)
	{
		echo "<span class=font31>".number_format($re1data["kakaku"],1)."万円</span>";
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
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["jyusyo_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"];if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];} ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["ensen_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
	<?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."駅";} ?>
	<?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
	<?php if($re1data["ekiho"]!=NULL) {echo "・徒歩".$re1data["ekiho"]."分";} ?>
	</td>
  </tr>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["syumoku_name"] ?><br><?php echo $bsetdata["kouzou_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["syumoku"]; ?><br /><?php echo $re1data["kouzou"]; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["chiku_nen_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
<?php
if($bukkensetdata["nodata_view"]==1||$re1data["ensen"]!=NULL||$re1data["eki"]!=NULL||$re1data["ekiho"]!=NULL||$re1data["basutei"]!=NULL||$re1data["basu"]!=NULL||$re1data["basu_ho"]!=NULL||$re1data["kuruma"]!=NULL||$re1data["kyori"]!=NULL)
{
?>
<?php
if($bsetdata["genkyou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["genkyou_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["hikiwatashi_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]!=NULL)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["hikiwatashi_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["bukken_id_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["bukkenn_id"]!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["bukken_id_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["bukkenn_id"] ?></td>
  </tr>
<?php
	}
}
?>
<?php
if($bsetdata["bukken_mei_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["bukken_mei"]!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["bukken_mei_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["bukken_mei"] ?></td>
  </tr>
<?php
	}
}
?>
<?php
if($bukkensetdata["nodata_view"]==1||$re1data["ensen"]!=NULL||$re1data["eki"]!=NULL||$re1data["ekiho"]!=NULL||$re1data["basutei"]!=NULL||$re1data["basu"]!=NULL||$re1data["basu_ho"]!=NULL||$re1data["kuruma"]!=NULL||$re1data["kyori"]!=NULL)
{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">交通</td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
		}
	}
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
?>
<?php
if($bsetdata["chusyajou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["chusya_ryoukin"]!=NULL||$re1data["chusyajou"]!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["chusyajou_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["kaisou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["kaisou"]!=NULL||$re1data["chijoukaisou"]!=NULL||$re1data["chikakaisou"]!=NULL)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["kaisou_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["barukoni_houkou_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["barukoni_houkou"]!=NULL||$re1data["barukoni_menseki"]!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["barukoni_houkou_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["syougakkouku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||str_replace("小学校","",$re1data["syougakkouku"])!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["syougakkouku_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["chuugakouku_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||str_replace("中学校","",$re1data["chuugakouku"])!=NULL)
	{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["chuugakouku_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["setsubi_naka_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]==1||$re1data["setsubi_naka1"]==1||$re1data["setsubi_naka2"]==1||$re1data["setsubi_naka3"]==1||$re1data["setsubi_naka4"]==1||$re1data["setsubi_naka5"]==1||$re1data["setsubi_naka6"]==1||$re1data["setsubi_naka7"]==1||$re1data["setsubi_naka8"]==1||$re1data["setsubi_naka9"]==1||$re1data["setsubi_naka10"]==1||$re1data["setsubi_naka11"]==1||$re1data["setsubi_naka12"]==1||$re1data["setsubi_naka13"]==1||$re1data["setsubi_naka14"]==1||$re1data["setsubi_naka15"]==1||$re1data["setsubi_naka16"]==1||$re1data["setsubi_naka17"]==1||$re1data["setsubi_naka18"]==1||$re1data["setsubi_naka19"]==1||$re1data["setsubi_naka20"]==1)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["setsubi_naka_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["setsumi_soto_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["setsubi_soto1"]==1||$re1data["setsubi_soto2"]==1||$re1data["setsubi_soto3"]==1||$re1data["setsubi_soto4"]==1||$re1data["setsubi_soto5"]==1||$re1data["setsubi_soto6"]==1||$re1data["setsubi_soto7"]==1||$re1data["setsubi_soto8"]==1||$re1data["setsubi_soto9"]==1||$re1data["setsubi_soto10"]==1)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["setsumi_soto_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($bsetdata["jouken_view"]==1)
{
	if($bukkensetdata["nodata_view"]==1||$re1data["jouken1"]==1||$re1data["jouken2"]==1||$re1data["jouken3"]==1||$re1data["jouken4"]==1||$re1data["jouken5"]==1||$re1data["jouken6"]==1||$re1data["jouken7"]==1||$re1data["jouken8"]==1||$re1data["jouken9"]==1||$re1data["jouken10"]==1)
	{ 
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["jouken_name"]?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
$setsubi_othernum=$re1data["setsubi_other1"]+$re1data["setsubi_other2"]+$re1data["setsubi_other3"]+$re1data["setsubi_other4"]+$re1data["setsubi_other5"]+$re1data["setsubi_other6"]+$re1data["setsubi_other7"]+$re1data["setsubi_other8"]+$re1data["setsubi_other9"]+$re1data["setsubi_other10"];
if($setsubi_othernum>0)
{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">給排水・ガス</td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">
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
?>
<?php
if($re1data["torihikitaiyou"]!=NULL)
{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $bsetdata["torihikitaiyou_name"] ?></td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["torihikitaiyou"];?></td>
  </tr>
<?php
}
?>
<?php
if($re1data["torihikitaiyou"]!=NULL)
{
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">備考</td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo nl2br($re1data["bikou"]); ?></td>
  </tr>
<?php
}
?>
  <tr>
    <td align="left" valign="top" <?php $x++; if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1">登録年月日</td>
    <td align="left" valign="top" <?php if($x % 2 == 0){ echo "bgcolor=\"#F0F9FD\""; }  ?> class="s style1"><?php echo $re1data["tourokubi"]; ?></td>
  </tr>
<?php
}
?>
</table>

</div>


<div id="footer">
<?php include"footer.html" ?>

</div>













</body> 
</html> 