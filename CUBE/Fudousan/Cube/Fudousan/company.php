<?php
include "/tmp/CUBE/Fudousan/config.php";
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
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?>/ 　会社概要</title>
<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.left2 {
	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	font-weight: bolder;
	color: #000000;
}
.text {
	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
.st {
	font-size:14px;
	font-weight:bold;
}
.text1 {
	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
-->
</style>
</head>
<body>
<?php
include "/tmp/CUBE/Fudousan/template/header.php";
?>
<div id="company">
		<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" alt="" width="25" height="650" /></td>
						<td align="left" valign="top"><table width="768" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="img/company/CompanyHeader.jpg" alt="" width="768" height="41" /></td>
								</tr>
								<tr>
										<td width="49" rowspan="6" background="img/company/ConpanyLeft.jpg"><img src="img/company/ConpanyLeft.jpg" alt="" width="49" height="80" /></td>
										<td width="673" valign="top"><img src="img/company/Goaisatsu.jpg" alt="" width="673" height="67" /></td>
										<td width="46" rowspan="6" background="img/company/CompanyRight.jpg"><img src="img/company/CompanyRight.jpg" alt="" width="46" height="80" /></td>
								</tr>
								<tr>
										<td><table width="673" border="0" cellspacing="0" cellpadding="3">
												<tr>
														<td width="361" align="left" valign="top" class="goaisatsutext"><?php echo nl2br($tenpodata["goaisatsu"]) ?></td>
														<td width="300"><?php if($tenpodata["goaisatsuphoto"]!=NULL) {?>
																<img src="<?php echo $tenpodata["goaisatsuphoto"] ?>?<?php echo time();?>" alt="" width="300" height="214" />
																<?php }?></td>
												</tr>
										</table></td>
								</tr>
								<tr>
										<td><img src="img/company/Gaiyou.jpg" alt="" width="673" height="60" /></td>
								</tr>
								<tr>
										<td><table border="0" cellspacing="0" cellpadding="3">
												<tr>
														<td width="370" align="left" valign="top"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
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
																		<td width="110" height="20" align="center" valign="top"><table width="100%" border="0" align="center" cellpadding="3" cellspacing="2">
																				<tr>
																						<td align="center" valign="middle" nowrap="nowrap"><div align="left">
																								<?php $company1data->Moji("data_name"); ?>
																						</div></td>
																				</tr>
																		</table></td>
																		<td width="468" align="left" valign="top" class="text1"><table width="100%" border="0" cellspacing="2" cellpadding="3">
																				<tr>
																						<td><?php echo $textobj->printc($company1datadata[$company1row]["data_comm"]); ?></td>
																				</tr>
																		</table></td>
																</tr>
																<?php 
}
/*&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;&uarr;*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　会社概要 一覧終了　　　　　　　　　　　　　 */
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?>
														</table></td>
														<td width="300" valign="top"><?php if($tenpodata["tenpophoto"]!=NULL) {?>
																<img src="<?php echo $tenpodata["tenpophoto"] ?>?<?php echo time();?>" alt="" width="300" height="214" />
																<?php }?></td>
												</tr>
										</table></td>
								</tr>
								
								<tr>
										<td><?php
										
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　スタッフ紹介一覧開始　　　    　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
								
unset($staffdata);
$staffdata=$staffobj->GetDataList(1,"",0,"turn"); 
if($staffdata[0][0]!=NULL){
								?><img src="img/company/Staff.jpg" alt="" width="673" height="62" name="staff" />	<?php
}
?></td>
								</tr>
							
								<tr>
										<td><table width="673" border="0" cellspacing="0" cellpadding="0">
												<?php 

for($staffrow=0;!is_null($staffdata[$staffrow]["data_id"]);$staffrow++){ 
?>
												<tr>
														<td width="100"><div align="right">
																<?php 
																																				if($staffdata[$staffrow]["data_image"]!=NULL) {
																																				?>
																<img src="<?php echo $staffdata[$staffrow]["data_image"] ?>?<?php echo time();?>" alt="" />
																<?php 
																																				}
																																				?>
														</div></td>
														<td width="20">&nbsp;</td>
														<td width="553" valign="top"><table width="553" border="0" cellpadding="3" cellspacing="0">
																<tr>
																		<td width="547" height="25" class="stafftitle"><?php echo $staffdata[$staffrow]["data_post"]; ?>　<?php echo $staffdata[$staffrow]["data_name"]; ?></td>
																</tr>
																<tr>
																		<td class="staffcomment"><?php echo nl2br($staffdata[$staffrow]["data_comm"]); ?></td>
																</tr>
														</table></td>
												</tr>
												<tr>
														<td colspan="3">&nbsp;</td>
												</tr>
												<tr>
														<td colspan="3"><img src="img/company/StaffLine.jpg" alt="" width="671" height="1" /></td>
												</tr>
												<tr>
														<td colspan="3">&nbsp;</td>
												</tr>
												<tr> </tr>
												<?php
															}
															?>
										</table></td>
								</tr>
								<tr>
										<td colspan="3" background="img/company/ConpanyLeft.jpg"><img src="img/company/CompanyFooter.jpg" alt="" width="768" height="48" /></td>
								</tr>
						</table></td>
						<td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" alt="" width="25" height="71" /></td>
				</tr>
		</table>
</div>
<?php
include "/tmp/CUBE/Fudousan/template/footer.php";
?>
<map name="Map3" id="Map3">
		<area shape="rect" coords="16,3,94,38" href="index.php" />
		<area shape="rect" coords="95,3,181,39" href="#" />
		<area shape="rect" coords="183,3,269,39" href="#" />
		<area shape="rect" coords="270,3,382,39" href="#" />
</map>
</body>
</html>
