<?php
session_start();
$_SESSION["toiawase"]="";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

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
	
//	if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
//	}
	
	$dbobj->Connect();
	
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	$re1obj=new RealEstate($dbobj);
	
	if($_REQUEST["seach_bukken_x"]!=NULL) {
		
		$_SESSION["madori"]=$_REQUEST["madori"];
		$_SESSION["lowcost"]=$_REQUEST["lowcost"];
		$_SESSION["hicost"]=$_REQUEST["hicost"];
		$_SESSION["keyword"]=$_REQUEST["keyword"];
		$_SESSION["chiiki"]=$_REQUEST["chiiki"];
		$_SESSION["page"]=1;
		
	}
	
	if($_GET["sort"]!=NULL) {
		
		$_GET["sort"]=str_replace("update","",str_replace("delete","",str_replace("select","",str_replace("drop","",$_GET["sort"]))));
		$_SESSION["sort"]=$_GET["sort"];
		
	}
	else if($_SESSION["sort"]==NULL) {
		
		$_SESSION["sort"]="kakaku";
		
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

	$re1obj->type=$_SESSION["cid"];
	$re1data=$re1obj->GetReList(2,$_SESSION["sort"]);
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
<title><?php echo $tenpodata["pagetitle"];?>/販売物件</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
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
<?php
switch($_REQUEST["cid"]) {
	case 4:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =4");
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
			<select id="madori" name="madori">
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
			<select id="chiiki" name="chiiki">
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
		<td class="Narrowing_middle_left">価格</td>
		<td class="Narrowing_middle_middle">
			<input type="number" name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" class="Narrowing_text"/>
		</td>
		<td width="30" class="Narrowing_middle_middle"> ~</td>
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
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link_red"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="<?php echo $_SESSION["cid"];?>" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">●戸建て・マンション物件一覧  </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
	<tr>
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on" <?php if($re1rows==0){?>style="margin-top:5px;"<?php }?> onClick="location='/iphone/baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
				<tr>
					<td rowspan="4" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
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
						<br><br><input type="button" class="baibai_link" value="詳細">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "価格 ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#FF52C8>".number_format($re1data[$re1rows]["kakaku"],0)."万円</font></strong>";
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
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan" style="-webkit-border-top-right-radius: 3px;">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
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
echo "　";
if($re1data[$re1rows]["senyumenseki"]!=NULL)
{
	echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
		<td nowrap="nowrap">
			<div align="right">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">＜ 前</a>
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
			echo '　<span class="nowpagenum">'.$prows.'</span>　';
		}
		else
		{
			echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
		}
	}
}
?>
			</div>
		</td>
		<td nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>">次 ＞</a>
				<?php } ?>
			</div>
	  </td>
	</tr>
</table>
<?php
	break;
	case 5:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
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
			地域
		</td>
		<td colspan="4" align="center" class="Narrowing_middle_middle">
			<select id="chiiki" name="chiiki">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++) {
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
		<td width="30" class="Narrowing_middle_middle"> ~</td>
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
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link_red"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="<?php echo $_SESSION["cid"];?>" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">●土地物件一覧 </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
	<tr>
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on" <?php if($re1rows==0){?>style="margin-top:5px;"<?php }?> onClick="location='/iphone/baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
				<tr>
					<td rowspan="4" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
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
						<br><br><input type="button" class="baibai_link" value="詳細">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "価格 ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#FF52C8>".number_format($re1data[$re1rows]["kakaku"],0)."万円</font></strong>";
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
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan" style="-webkit-border-top-right-radius: 3px;">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_madori">
<?php 
if($re1data[$re1rows]["senyumenseki"]!=NULL)
{
	echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">＜ 前の10件</a>
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
			echo '　<span class="nowpagenum">'.$prows.'</span>　';
		}
		else
		{
			echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
		}
	}
}
?>
			</div>
		</td>
		<td width="100" nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>">次の10件 ＞</a>
				<?php } ?>
			</div>
		</td>
	</tr>
</table>
<?php
	break;
	case 6:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");
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
		<td width="30" class="Narrowing_middle_middle"> ~</td>
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
					<td align="center" class="Narrowing_bottom_right"><input type="submit" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link_red"/></td>
				</tr>
			</table>
		</td>
	</tr>
<input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="<?php echo $_SESSION["cid"];?>" />
</form>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="margin-top:10px;">
	<tr>
		<td height="30" bgcolor="#FFFFFF" style="padding-left:5px;"><font color="#FF6600">●事業用物件一覧 </font></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist" style="margin-top:10px;">
	<tr>
		<td colspan="6" style="border-top:solid; border-top-color:#BBBBBB; border-top-width:1px;">
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="bukkenlist_on" <?php if($re1rows==0){?>style="margin-top:5px;"<?php }?> onClick="location='/iphone/baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
				<tr>
					<td rowspan="4" width="40%" class="bukkenlist_img"<?php if($re1rows==0){?> style="-webkit-border-top-left-radius: 3px;"<?php } ?>>
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
						<br><br><input type="button" class="baibai_link" value="詳細">
					</td>
					<td class="bukkenlist_chinryou"<?php if($re1rows==0){?> style="-webkit-border-top-right-radius: 3px;"<?php } ?>>
<?php
	echo "価格 ";
	if($re1data[$re1rows]["kakaku"]!=NULL)
	{
		echo "<strong><font color=#FF52C8>".number_format($re1data[$re1rows]["kakaku"],0)."万円</font></strong>";
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
						<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_engan" style="-webkit-border-top-right-radius: 3px;">
						<?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
					</td>
				</tr>
				<tr>
					<td class="bukkenlist_madori">
<?php 
if($re1data[$re1rows]["senyumenseki"]!=NULL)
{
	echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">＜ 前の10件</a>
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
			echo '　<span class="nowpagenum">'.$prows.'</span>　';
		}
		else
		{
			echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
		}
	}
}
?>
			</div>
		</td>
		<td width="100" nowrap="nowrap">
			<div align="left">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>">次の10件 ＞</a>
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
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102425275-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>
