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
$staffobj=new Site_Staff($dbobj);
$re1obj=new RealEstate($dbobj);
$textobj=new Cube_TextEdit("EUCJP", "EUCJP");
if($_GET["sort"]!=NULL) {
	$_SESSION["sort"]=$_GET["sort"];
}

if($_GET["cid"]!=NULL) {
	$_SESSION["cid"]=$_GET["cid"];
	
}

if($_REQUEST["seach_bukken_x"]!=NULL) {
	$_SESSION["madori"]=$_REQUEST["madori"];
	$_SESSION["lowcost"]=$_REQUEST["lowcost"];
	$_SESSION["hicost"]=$_REQUEST["hicost"];
	$_SESSION["keyword"]=$_REQUEST["keyword"];
	$_SESSION["chiiki"]=$_REQUEST["chiiki"];
	unset($_SESSION["page"]);
}


$re1obj->type=$_SESSION["cid"];
$re1data=$re1obj->GetReList(1,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);
$comobj=new Site_Company($dbobj);
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
<title><?php echo $tenpodata["pagetitle"];?>/会社案内</title>
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="office_info">
	<tr>
		<td class="office_top">
			<strong>会社案内</strong>
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="office_info_in">
				<tr>
					<td colspan="2" class="office_in_head">
						おしらせ
					</td>
				</tr>
				<tr>
					<td width="60%" valign="top" class="office_in_left"><?php echo nl2br($tenpodata["goaisatsu"]) ?></td>
					<td width="40%" valign="top" class="office_in_right"><?php
					if($tenpodata["goaisatsuphoto"]!=""){?>
					<img src="<?php echo $tenpodata["goaisatsuphoto"] ?>?<?php echo time();?>" alt="" width="100%"/>
					<?php
					}
					?>					</td>
				</tr>
				<tr>
					<td colspan="2" class="office_in_head">
						会社概要
					</td>
				</tr>
				<tr>
					<td width="60%" valign="top" class="office_in_left">
						<table class="office_data">
						
						<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　会社概要 一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;&darr;*/ 
//　　　　　　　　　　　　　　　　　
$company1datadata=$comobj->GetDataList(1,$lim,$setnum,$orderby);
for($company1row=0;$company1datadata[$company1row];$company1row++){ 
$company1data=new Ary_Viewer($company1datadata[$company1row]);
?>
							<tr>
								<td class="office_data_title"><?php $company1data->Moji("data_name"); ?></td>
							</tr>
							<tr>
								<td class="office_data_data"><?php echo $company1datadata[$company1row]["data_comm"]; ?></td>
							</tr><?php 
}
/*&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　会社概要 一覧終了　　　　　　　　　　　　　 */
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?>
						</table>
					</td>
					<td width="40%" valign="top" class="office_in_right"><?php if($tenpodata["tenpophoto"]!=NULL) {?>
                      <img src="<?php echo $tenpodata["tenpophoto"] ?>?<?php echo time();?>" alt="" width="100%" />
                      <?php }?></td>
				</tr>
				<?php
										
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　スタッフ紹介一覧開始　　　    　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
								
unset($staffdata);
$staffdata=$staffobj->GetDataList(1,"",0,"turn"); 
if($staffdata[0][0]!=NULL){
?>
				<tr>
					<td colspan="2" class="office_in_head">
						スタッフ紹介
					</td>
				</tr>
<?php
}
?><?php 

for($staffrow=0;!is_null($staffdata[$staffrow]["data_id"]);$staffrow++){ 
?><tr>
					<td colspan="2" class="office_data_staff">
						<strong><?php echo $staffdata[$staffrow]["data_post"]; ?>　<?php echo $staffdata[$staffrow]["data_name"]; ?></strong><br><br><?php echo nl2br($staffdata[$staffrow]["data_comm"]); ?>
					</td>
				</tr>
<?php
}
?>		  </table>
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