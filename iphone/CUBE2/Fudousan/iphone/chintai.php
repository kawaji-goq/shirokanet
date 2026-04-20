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

$tenpodata=$dbobj->GetData("select * from tenpo_data");

if($_GET["sort"]!=NULL) {
	$_GET["sort"]=str_replace("update","",str_replace("delete","",str_replace("select","",str_replace("drop","",$_GET["sort"]))));
	$_SESSION["sort"]=$_GET["sort"];
}
else if($_SESSION["sort"]==NULL) {
	$_SESSION["sort"]="photo1";
}

if($_GET["cid"]!=NULL) {
	if($_SESSION["cid"]!=$_GET["cid"]) {
		$_SESSION["madori"]="";
		$_SESSION["lowcost"]="";
		$_SESSION["hicost"]="";
		$_SESSION["keyword"]="";
		$_SESSION["chiiki"]="";
		$_SESSION["page"]=1;
	}
	$_SESSION["cid"]=$_GET["cid"];
}

if($_REQUEST["seach_bukken_x"]!=NULL) {
	$_SESSION["madori"]=$_REQUEST["madori"];
	$_SESSION["lowcost"]=$_REQUEST["lowcost"];
	$_SESSION["hicost"]=$_REQUEST["hicost"];
	$_SESSION["keyword"]=$_REQUEST["keyword"];
	$_SESSION["chiiki"]=$_REQUEST["chiiki"];
	$_SESSION["page"]=1;
}

if($_REQUEST["btm_hikaku"]=="ÁªÂò¤·¤¿Êª·ï¤òÈæ³Ó¤¹¤ë") {

	for($a=0;$_REQUEST["comparison"][$a]!=NULL;$a++) {
		$chksql="select * from hikaku where sessionid = '".session_id()."' and bid=".$_REQUEST["comparison"][$a]."";
		$res=$dbobj->Query($chksql);
		$resrows=$dbobj->NumRows($res);
		if($resrows==0) {
			$selsql="select max(hikaku_id) as maxid from hikaku";
			$rdata=$dbobj->GetData($selsql);
		
			$maxid=$rdata["maxid"]+1;
			$inssql="insert into hikaku(hikaku_id,sessionid,cid,bid,rtime) values(".$maxid.",'".session_id()."',".$_SESSION["cid"].",".$_REQUEST["comparison"][$a].",'".date("Y-m-d H:i:s",time())."')";
			$res=$dbobj->Query($inssql);
		}
	}
}

$re1obj->type=$_SESSION["cid"];
$re1data=$re1obj->GetReList(1,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);
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
<title>¥¢¥¤¥Æ¥£¡¼¥­¥å¡¼¥ÖÉÔÆ°»º/ÄÂÂßÊª·ï</title>
<meta name="description" content="¤´¤¯¤¹¤ÝËÜÅ¹¡Ã¥¹¥Ý¡¼¥Ä¡¦¥´¥ë¥ÕÍÑÉÊ¤ÎÁí¹çÄÌÈÎ¥µ¥¤¥È">
<meta name="keywords" content="ÄÌÈÎ,¥¤¥ó¥¿¡¼¥Í¥Ã¥ÈÄÌÈÎ,¥ª¥ó¥é¥¤¥ó¥·¥ç¥Ã¥Ô¥ó¥°,¤´¤¯¤¹¤Ý,¤´¤¯¤¹¤ÝËÜÅ¹,gokuspo,¥´¥¯¥¹¥Ý">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="/iphone/icon/icon.PNG">
<link rel="stylesheet" type="text/css" href="css/fudousan.css" >

<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
</head>
<body bgcolor="#DDDDDD"><a href="/iphone/index.php"><img src="img/header.jpg" width="100%" border="0" style="margin-top:1px;"></a>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="Êª·ï¸¡º÷" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="²ñ¼Ò°ÆÆâ" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¥È¥Ô¥Ã¥¯¥¹" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¤ªÌä¹ç¤»" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<?php
switch($_REQUEST["cid"]) {
	case 1:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");
?>
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
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_blue" value="¥¢¥Ñ¡¼¥È&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/chintai.php?cid=1'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_blue" value="¸Í·ú¤Æ½»Âð" onClick="location.href='/iphone/chintai.php?cid=2'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_blue" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/chintai.php?cid=3'"/></td>
	</tr>
	<tr>
		<td colspan="3" class="Searchtype_head">
			<img src="img/buy.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_red" value="¸Í·ú¤Æ½»Âð&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/baibai.php?cid=4'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_red" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/baibai.php?cid=6'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_red" value="ÅÚÃÏ" onClick="location.href='/iphone/baibai.php?cid=5'"/></td>
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
			´Ö¼è¤ê
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="madori" name="madori" class="Narrowing_select">
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1£Ò,£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4£Ä£Ë°Ê¾å</option>
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" class="Narrowing_middle_left">
			ÃÏ°è
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
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="Narrowing_middle_left">ÄÂÎÁ</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle"> ¡Á</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="hicost" id="hicost" value="<?php echo $_SESSION["hicost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle">Ëü±ß</td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="Narrowing_submit">
				<tr>
					<td align="center" class="Narrowing_bottom_left">¥­¡¼¥ï¡¼¥É</td>
					<td align="center" class="Narrowing_bottom_middle"><input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" class="Narrowing_keyword"/></td>
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="¡¡¸¡º÷¡¡" class="link"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input type="hidden" name="cid" id="cid" value="1" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="1" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">¡ü¥¢¥Ñ¡¼¥È¡¦¥Þ¥ó¥·¥ç¥óÊª·ï°ìÍ÷ </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
	<tr>
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on">
				<tr>
					<td rowspan="7" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
						<a href="/iphone/chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='100'>";
	}
	else
	{
?>
                        	<img src="/img/noimage_120_120.gif" style="max-width:150px;" border="0" />
<?php
	}
?>
						</a><br><br><input type="button" class="chintai_link" value="¾ÜºÙ" onClick="location.href='/iphone/chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "ÄÂÎÁ ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#428CFA>".number_format($re1data[$re1rows]["kakaku"],1)."Ëü±ß</font></strong>";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_kanrihi">
<?php 
	echo "´ÉÍýÈñ¡¡";
	if($re1data[$re1rows]["kanrihi"]!=NULL)
	{
?>
						<?php echo number_format($re1data[$re1rows]["kanrihi"],0); ?>±ß
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
					<td class="bukkenlist_reikin">
<?php
	echo "Îé¶â¡¡¡¡";
	if($re1data[$re1rows]["reikin"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin"]."¥ö·î ";
	}
	if($re1data[$re1rows]["reikin_tani"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_shikikin">
<?php
	echo "Éß¶â¡¡¡¡";
	if($re1data[$re1rows]["shikikin"]!=NULL || $re1data[$re1rows]["sikikintani"]!=NULL)
	{
		if($re1data[$re1rows]["shikikin"]!=NULL)
		{
			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
		}
?>
<?php 
		if($re1data[$re1rows]["sikikintani"]!=NULL)
		{
			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
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
					<td class="bukkenlist_zyusyo">
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_madori">
<?php 
if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
{
	echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
}
else
{
	echo "-";
}
echo "¡¡";
if($re1data[$re1rows]["senyumenseki"]!=NULL)
{
	echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
}
else
{
	echo "-";
}
?>
					</td>
				</tr>
			</table>
<?php
}
?>
		</td>
	</tr>
</table>
<table border="0" align="center" cellpadding="3" cellspacing="0" style="padding-top:10px;">
	<tr>
		<td width="100" nowrap="nowrap">
			<div align="right">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]-1;?>">¡ã Á°¤Î10·ï</a>
<?php
}
?>
			</div>
		</td>
		<td>
			<div align="center">
<?php 
if($maxpage>1&&$maxpage!=NULL&&$maxpage!=0)
{
	for($prows=1;$prows<=$maxpage;$prows++)
	{ 
		if($prows==$_SESSION["page"])
		{
			echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
		}
		else
		{
			echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
		}
	}
}
?>
			</div>
		</td>
		<td width="100" nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]+1;?>">¼¡¤Î10·ï ¡ä</a>
				<?php } ?>
			</div>
		</td>
	</tr>
</table>
<?php
	break;
	case 2:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =2");
?>
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
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_blue" value="¥¢¥Ñ¡¼¥È&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/chintai.php?cid=1'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_blue" value="¸Í·ú¤Æ½»Âð" onClick="location.href='/iphone/chintai.php?cid=2'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_blue" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/chintai.php?cid=3'"/></td>
	</tr>
	<tr>
		<td colspan="3" class="Searchtype_head">
			<img src="img/buy.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_red" value="¸Í·ú¤Æ½»Âð&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/baibai.php?cid=4'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_red" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/baibai.php?cid=6'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_red" value="ÅÚÃÏ" onClick="location.href='/iphone/baibai.php?cid=5'"/></td>
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
			´Ö¼è¤ê
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="madori" name="madori" class="Narrowing_select">
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1£Ò,£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4£Ä£Ë°Ê¾å</option>
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" class="Narrowing_middle_left">
			ÃÏ°è
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="chiiki" name="chiiki" class="Narrowing_select">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++) {
?>
				<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
<?php
}
?>
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="Narrowing_middle_left">ÄÂÎÁ</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle"> ¡Á</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="hicost" id="hicost" value="<?php echo $_SESSION["hicost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle">Ëü±ß</td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="Narrowing_submit">
				<tr>
					<td align="center" class="Narrowing_bottom_left">¥­¡¼¥ï¡¼¥É</td>
					<td align="center" class="Narrowing_bottom_middle"><input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" class="Narrowing_keyword"/></td>
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="¡¡¸¡º÷¡¡" class="link"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input type="hidden" name="cid" id="cid" value="2" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="2" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">¡ü¸Í·ú¤ÆÊª·ï°ìÍ÷ </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on" <?php if($re1rows==0){?>style="margin-top:5px;"<?php }?>>
				<tr>
					<td rowspan="7" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
						<a href="/iphone/chintai_d2.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='100'>";
	}
	else
	{
?>
                        	<img src="/img/noimage_120_120.gif" style="max-width:150px;" border="0" />
<?php
	}
?>
						</a><br><br><input type="button" class="chintai_link" value="¾ÜºÙ" onClick="location.href='/iphone/chintai2_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "ÄÂÎÁ ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#428CFA>".number_format($re1data[$re1rows]["kakaku"],1)."Ëü±ß</font></strong>";
	}
	else
	{
		echo "-";
	}
?>
					</td>
					
				</tr>
				<tr>
					<td class="bukkenlist_kanrihi">
<?php
	echo "´ÉÍýÈñ¡¡";
	if($re1data[$re1rows]["kanrihi"]!=NULL)
	{
?>
						<?php echo number_format($re1data[$re1rows]["kanrihi"],0); ?>±ß
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
					<td class="bukkenlist_reikin">
<?php
	echo "Îé¶â¡¡¡¡";
	if($re1data[$re1rows]["reikin"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin"]."¥ö·î ";
	}
	if($re1data[$re1rows]["reikin_tani"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_shikikin">
<?php
	echo "Éß¶â¡¡¡¡";
	if($re1data[$re1rows]["shikikin"]!=NULL || $re1data[$re1rows]["sikikintani"]!=NULL)
	{
		if($re1data[$re1rows]["shikikin"]!=NULL)
		{
			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
		}
		if($re1data[$re1rows]["sikikintani"]!=NULL)
		{
			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
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
					<td class="bukkenlist_zyusyo">
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan" style="-webkit-border-top-right-radius: 3px;">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_madori">
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "¡¡";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
			</table>
<?php
}
?>
		</td>
	</tr>
</table>
<table border="0" align="center" cellpadding="3" cellspacing="0" style="padding-top:10px;">
	<tr>
		<td width="100" nowrap="nowrap">
			<div align="right">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]-1;?>">¡ã Á°¤Î10·ï</a>
<?php
}
?>
			</div>
		</td>
		<td>
			<div align="center">
<?php 
if($maxpage>1&&$maxpage!=NULL&&$maxpage!=0)
{
	for($prows=1;$prows<=$maxpage;$prows++)
	{ 
		if($prows==$_SESSION["page"])
		{
			echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
		}
		else
		{
			echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
		}
	}
}
?>
			</div>
		</td>
		<td width="100" nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]+1;?>">¼¡¤Î10·ï ¡ä</a>
				<?php } ?>
			</div>
		</td>
	</tr>
</table>
<?php
	break;
	case 3:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =3");
?>
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
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_blue" value="¥¢¥Ñ¡¼¥È&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/chintai.php?cid=1'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_blue" value="¸Í·ú¤Æ½»Âð" onClick="location.href='/iphone/chintai.php?cid=2'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_blue" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/chintai.php?cid=3'"/></td>
	</tr>
	<tr>
		<td colspan="3" class="Searchtype_head">
			<img src="img/buy.jpg" width="100%" border="0">
		</td>
	</tr>
	<tr>
		<td class="Searchtype_middle_left"><input type="button" class="Searchtype_button_red" value="¸Í·ú¤Æ½»Âð&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/baibai.php?cid=4'"/></td>
		<td class="Searchtype_middle_middle"><input type="button" class="Searchtype_button_red" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/baibai.php?cid=6'"/></td>
		<td class="Searchtype_middle_right"><input type="button" class="Searchtype_button_red" value="ÅÚÃÏ" onClick="location.href='/iphone/baibai.php?cid=5'"/></td>
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
			´Ö¼è¤ê
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="madori" name="madori" class="Narrowing_select">
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1£Ò,£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3£Ä£Ë,£Ì£Ä£Ë</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4£Ä£Ë°Ê¾å</option>
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="center" class="Narrowing_middle_left">
			ÃÏ°è
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
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
			</select>
		</td>
	</tr>
	<tr>
		<td class="Narrowing_middle_left">ÄÂÎÁ</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle"> ¡Á</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="hicost" id="hicost" value="<?php echo $_SESSION["hicost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle">Ëü±ß</td>
	</tr>
	<tr>
		<td colspan="5">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="Narrowing_submit">
				<tr>
					<td align="center" class="Narrowing_bottom_left">¥­¡¼¥ï¡¼¥É</td>
					<td align="center" class="Narrowing_bottom_middle"><input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" class="Narrowing_keyword"/></td>
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="¡¡¸¡º÷¡¡" class="link"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input type="hidden" name="cid" id="cid" value="3" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="3" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">¡ü»ö¶ÈÍÑÊª·ï°ìÍ÷ </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
	<tr>
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on" <?php if($re1rows==0){?>style="margin-top:5px;"<?php }?>>
				<tr>
					<td rowspan="7" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
						<a href="/iphone/chintai_d3.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='100'>";
	}
	else
	{
?>
                        	<img src="/img/noimage_120_120.gif" style="max-width:150px;" border="0" />
<?php
	}
?>
						</a><br><br><input type="button" class="chintai_link" value="¾ÜºÙ" onClick="location.href='/iphone/chintai_d3.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "ÄÂÎÁ ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#428CFA>".number_format($re1data[$re1rows]["kakaku"],1)."Ëü±ß</font></strong>";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_kanrihi">
<?php 
	echo "´ÉÍýÈñ¡¡";
	if($re1data[$re1rows]["kanrihi"]!=NULL)
	{
?>
						<?php echo number_format($re1data[$re1rows]["kanrihi"],0); ?>±ß
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
					<td class="bukkenlist_reikin">
<?php
	echo "Îé¶â¡¡¡¡";
	if($re1data[$re1rows]["reikin"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin"]."¥ö·î ";
	}
	if($re1data[$re1rows]["reikin_tani"]!=NULL)
	{
		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_shikikin">
<?php
	echo "Éß¶â¡¡¡¡";
	if($re1data[$re1rows]["shikikin"]!=NULL || $re1data[$re1rows]["sikikintani"]!=NULL)
	{
		if($re1data[$re1rows]["shikikin"]!=NULL)
		{
			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
		}
		if($re1data[$re1rows]["sikikintani"]!=NULL)
		{
			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
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
					<td class="bukkenlist_zyusyo">
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan" style="-webkit-border-top-right-radius: 3px;">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_madori">
<?php
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
	}
	else
	{
		echo "-";
	}
?>
					</td>
				</tr>
			</table>
<?php
}
?>
		</td>
	</tr>
</table>
<table border="0" align="center" cellpadding="3" cellspacing="0" style="padding-top:10px;">
	<tr>
		<td width="100" nowrap="nowrap">
			<div align="right">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]-1;?>">¡ã Á°¤Î10·ï</a>
<?php
}
?>
			</div>
		</td>
		<td>
			<div align="center">
<?php 
if($maxpage>1&&$maxpage!=NULL&&$maxpage!=0)
{
	for($prows=1;$prows<=$maxpage;$prows++)
	{ 
		if($prows==$_SESSION["page"])
		{
			echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
		}
		else
		{
			echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
		}
	}
}
?>
			</div>
		</td>
		<td width="100" nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="../iphone_buck_up/?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]+1;?>">¼¡¤Î10·ï ¡ä</a>
				<?php } ?>
			</div>
		</td>
	</tr>
</table>
<?php
	break;
}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="Êª·ï¸¡º÷" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="²ñ¼Ò°ÆÆâ" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¥È¥Ô¥Ã¥¯¥¹" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¤ªÌä¹ç¤»" onClick="location.href='/iphone/contact.php'">
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