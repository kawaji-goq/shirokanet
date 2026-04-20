<?php

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
$re1obj=new RealEstate($dbobj);
$re1obj->type=$_REQUEST["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");

switch($re1data["syumoku"]) {
	case "ÇäÃÏ":
		$btype=3;
		break;
	case "¼ÚÃÏ¸¢¾ùÅÏ":
		$btype=3;
		break;
	case "¿·ÃÛ°ì¸Í·ú½»Âð":
		$btype=1;
		break;
	case "Ãæ¸Å°ì¸Í·ú½»Âð":
		$btype=1;
		break;
	case "¿·ÃÛ¥Æ¥é¥¹¥Ï¥¦¥¹":
		$btype=1;
		break;
	case "Ãæ¸Å¥Æ¥é¥¹¥Ï¥¦¥¹":
		$btype=1;
		break;
	case "¿·ÃÛ¥Þ¥ó¥·¥ç¥ó":
		$btype=1;
		break;
	case "Ãæ¸Å¥Þ¥ó¥·¥ç¥ó":
		$btype=1;
		break;
	case "¿·ÃÛ°ì¸Í·ú¤Æ":
		$btype=1;
		break;
	case "¿·ÃÛ¸øÃÄ½»Âð":
		$btype=1;
		break;
	case "Ãæ¸Å¸øÃÄ½»Âð":
		$btype=1;
		break;
	case "¿·ÃÛ¸ø¼Ò½»Âð":
		$btype=1;
		break;
	case "Ãæ¸Å¸ø¼Ò½»Âð":
		$btype=1;
		break;
	case "¿·ÃÛ¥¿¥¦¥ó¥Ï¥¦¥¹":
		$btype=1;
		break;
	case "Ãæ¸Å¥¿¥¦¥ó¥Ï¥¦¥¹":
		$btype=1;
		break;
	case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
		$btype=1;
		break;
	case "Å¹ÊÞ":
		$btype=4;
		break;
	case "Å¹ÊÞÉÕ½»Âð":
		$btype=4;
		break;
	case "½»ÂðÉÕÅ¹ÊÞ":
		$btype=4;
		break;
	case "»öÌ³½ê":
		$btype=4;
		break;
	case "Å¹ÊÞ»öÌ³½ê":
		$btype=4;
		break;
	case "¥Ó¥ë":
		$btype=4;
		break;
	case "¹©¾ì":
		$btype=4;
		break;
	case "¥Þ¥ó¥·¥ç¥ó":
		$btype=4;
		break;
	case "ÁÒ¸Ë":
		$btype=4;
		break;
	case "¥¢¥Ñ¡¼¥È":
		$btype=4;
		break;
	case "ÎÀ":
		$btype=4;
		break;
	case "Î¹´Û":
		$btype=4;
		break;
	case "¥Û¥Æ¥ë":
		$btype=4;
		break;
	case "ÊÌÁñ":
		$btype=4;
		break;
	case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
		$btype=4;
		break;
	case "¤½¤ÎÂ¾":
		$btype=4;
		break;
	case "Å¹ÊÞ":
		$btype=4;
		break;
	case "»öÌ³½ê":
		$btype=4;
		break;
	case "Å¹ÊÞ¡¦»öÌ³½ê":
		$btype=4;
		break;
	case "¤½¤ÎÂ¾":
		$btype=4;
		break;
}
$tenpodata=$dbobj->GetData("select * from tenpo_data");

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
}?><title><?php echo $tenpodata["pagetitle"];?> / ÇäÇã<?php echo $re1data["syumoku"] ?> <?php echo $re1data["bukken_mei"] ?>¡¡<?php echo $re1data["jyusyo1"].$re1data["jyusyo2"] ?></title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>

<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<style type="text/css">
<!--
.st{
	font-size:14px;
	font-weight:bold;
}
-->
</style>

<link href="fudousan.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?>
<div>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg">&nbsp;</td>
        <td align="left" valign="top">
            <table width="768" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="left" valign="top">
                        <table width="768" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="5"><img src="img/bukken/BukkenSearchCategoryHeader.jpg" width="768" height="39" /></td>
                            </tr>
                            <tr>
                                <td width="91" bgcolor="#FAFBFC"><img src="img/bukken/BukkenSearchCategoryRent.jpg" width="91" height="25" border="0" /></td>
                                <td width="286" bgcolor="#FAFBFC">
                                    <p><a href="chintai.php?cid=1">¡¦¥¢¥Ñ¡¼¥È¡¦¥Þ¥ó¥·¥ç¥ó</a>¡¡<a href="chintai.php?cid=2">¡¦¸Í·ú¤Æ</a>¡¡<a href="chintai.php?cid=3">¡¦»ö¶ÈÍÑ</a></p>
                                </td>
                                <td width="86" bgcolor="#FAFBFC"><img src="img/bukken/BukkenSearchCategoryBuy.jpg" width="86" height="25" /></td>
                                <td width="294" bgcolor="#FAFBFC"><a href="baibai.php?cid=4">¡¦¸Í·ú¤Æ¡¦¥Þ¥ó¥·¥ç¥ó</a>¡¡<a href="baibai.php?cid=6">¡¦»ö¶ÈÍÑÊª·ï</a>¡¡<a href="baibai.php?cid=5">¡¦ÅÚÃÏ</a></td>
                                <td width="11" align="right"><img src="img/bukken/BukkenSearchCategoryRight.jpg" width="11" height="25" /></td>
                            </tr>
                            <tr>
                                <td colspan="5"><img src="img/bukken/BukkenSearchCategoryFooter.jpg" width="768" height="6" /></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg">&nbsp;</td>
    </tr>
</table>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="768" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <?php
if($btype==1) {
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =4");

?>
                        <table width="99%" border="0" align="center" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
                        		<tbody>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td colspan="2">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="20"><img src="/img_f/ver2/syuybetsu_bg1.jpg" width="20" height="25" /></td>
                                                                <td align="left" background="/img_f/ver2/syuybetsu_bg2.jpg"><nobr><strong><font color="#FFFFFF" class="bukken_detail_title">ÇäÇãÊª·ï¡¡<?php echo $re1data["syumoku"] ?></font><font color="#333333" class="bukken_detail_title"></font></strong></nobr></td>
                                                                <td width="20">
                                                                    <div align="right"><img src="/img_f/ver2/syuybetsu_bg3.jpg" width="20" height="25" /></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <div align="right">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                        <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                                                    <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" id="bukken">
                            <tbody>
                                <tr>
                                    <td colspan="2" valign="top">
                                        <table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCEE" class="bukkentablelist">
                                            <tr bgcolor="#FFFFFF" class="font12">
                                                <th width="18%" rowspan="2" align="center" valign="middle" bgcolor="#ECECFF"><span class="st"><?php echo $bsetdata["madori_name"] ?><strong><br />
                                                </strong></span><?php echo $bsetdata["senyumenseki_name"] ?></th>
                                                <th width="36%" height="25" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                                </th>
                                                <th colspan="2" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="36%" height="25" bgcolor="#ECECFF" class="font12">
                                                    <div align="center"><strong><span class="st"><?php echo $bsetdata["kakaku_name"] ?></span></strong></div>
                                                </th>
                                                <th width="22%" align="center" bgcolor="#ECECFF" class="font12"> <?php echo $bsetdata["youtochiiki_name"] ?></th>
                                                <th width="24%" align="center" bgcolor="#ECECFF" class="font12"><?php echo $bsetdata["chiku_nen_name"] ?></th>
                                            </tr>
                                            <tr>
                                                <td colspan="4" bgcolor="#FFFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="st">
                                                    <?php
																														if($re1data["madori"]!=NULL&&$re1data["madori"]!=0) {
																														echo $re1data["madori"].$re1data["madori_tani"]; }else{ echo "-";}?>
                                                   </span> <br />
                                                    <?php if($re1data["senyumenseki"]!=NULL) {echo $re1data["senyumenseki"]."m<sup>2</sup><br />¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?>
                                                </td>
                                                <td width="36%" height="25" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"]; if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];}?></td>
                                                <td colspan="2" bgcolor="#FFFFFF" class="font12">
                                                    <div align="center"><?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."±Ø";} ?>
                                                            <?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
                                                            <?php if($re1data["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data["ekiho"]."Ê¬";} ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25" align="right" bgcolor="#FFFFFF" class="font12">
                                                    <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <div align="right">
                                                                    <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data["kakaku"])."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data["youtochiiki"]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12">
                                                    <?php
																																								if($re1data["chiku_nen"]!=NULL){
																																									echo $re1data["chiku_nen"]."Ç¯";
																																								}
																																									if($re1data["chiku_tsuki"]!=NULL){
																																									echo $re1data["chiku_tsuki"]."·î";
																																								} ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">
                                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                            <tbody>
                                                <tr bgcolor="#eec2bb">
                                                    <th width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["madorizu_name"] ?></div>
                                                    </th>
                                                    <th width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["photo_name"] ?></div>
                                                    </th>
                                                </tr>
                                                <tr bgcolor="#ffffff">
                                                    <td>
                                                        <div align="center">
                                                            <?php if($re1data["madorizu1"]==NULL&&$re1data["madorizu2"]==NULL) {?>
                                                            <img src="<?php if($re1data["madorizu1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																				}
																																				 ?>
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu1"])."?".time(); ?>" rel="lightbox">
                                                            <?php if($re1data["madorizu1"]!=NULL){  ?>
                                                            <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time(); ?>" border="0" />
                                                            <?php }
																																				?>
                                                        </a></div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <?php if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL) {?>
                                                            <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																				}
																																				 ?>
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"])."?".time(); ?>" rel="lightbox">
                                                            <?php
																																												if($re1data["photo1"]!=NULL){
																																												 ?>
                                                            <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																}
																																												 ?>
                                                        </a></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td width="50%" align="left" valign="top">
                                        <table width="98%" border="0" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                            <tbody>
                                                <?php
														if($bsetdata["bukken_id_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukkenn_id"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["bukken_id_name"]?></div>
                                                    </th>
                                                    <td width="221" valign="top">
                                                        <div align="left"><?php echo $re1data["bukkenn_id"] ?></div>
                                                    </td>
                                                </tr>
                                                <?php
																		}
																		}
														if($bsetdata["bukken_mei_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukken_mei"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["bukken_mei_name"]?></div>
                                                    </th>
                                                    <td valign="top">
                                                        <div align="left"><?php echo $re1data["bukken_mei"] ?></div>
                                                    </td>
                                                </tr>
                                                <?php
																		}
																		}
														if($bsetdata["syumoku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["syumoku"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["syumoku_name"] ?></div>
                                                    </th>
                                                    <td><?php echo $re1data["syumoku"] ?></td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["jyusyo_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["jyusyo1"]!=NULL&&$re1data["jyusyo2"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th width="108" bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["jyusyo_name"] ?> </div>
                                                    </th>
                                                    <td>
                                                        <table cellspacing="1" cellpadding="1" width="100%" border="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <?php
																												echo $re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"];
																												if($re1data["banchichk"]==1) {
																												echo $re1data["jyusyo3"];
																												} ?>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <a href="#" onclick="window.open('./mapout.php?name=<?php echo urlencode(mb_convert_encoding($re1data["bukken_mei"],"utf8","euc-jp"));?>&amp;address=<?php echo urlencode(mb_convert_encoding($re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"],"utf8","euc-jp"));if($re1data["banchichk"]==1) {echo urlencode(mb_convert_encoding($re1data["jyusyo3"],"utf8","euc-jp"));}?>','maps','width=640,height=540')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a></td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <tr bgcolor="#ffffff">
                                                    <th width="108" bgcolor="#ECECFF">
                                                        <div align="left">¸òÄÌ </div>
                                                    </th>
                                                    <td>
                                                        <?php

														if($bsetdata["ensen_view"]==1) {

														?>
                                            <?php if($re1data["eki"]!=NULL) { echo $re1data["eki"]."±Ø";}
																		 if($re1data["ensen"]!=NULL) {echo "[".$re1data["ensen"]."]";}
																		 if($re1data["ekiho"]!=NULL) {echo " ÅÌÊâ ".$re1data["ekiho"]." Ê¬";}
																			if($re1data["kyori"]!=NULL) {echo " µ÷Î¥ ".$re1data["kyori"]."m";}
															}
														if($bsetdata["basu_view"]==1) {
														?>
                                                            <?php
																				 if($re1data["basutei"]!=NULL) { echo "<br />¥Ð¥¹Ää ".$re1data["basutei"];}
																		 if($re1data["basu"]!=NULL) {echo "[¾è¼Ö»þ´Ö".$re1data["basu"]."Ê¬]";}
																		  if($re1data["basu_ho"]!=NULL) {echo " ¤«¤éÅÌÊâ ".$re1data["basu_ho"]." Ê¬";}?>
                                                            <?php
															}
														if($bsetdata["kuruma_view"]==1) {
														?>
                                            <?php if($re1data["kuruma"]!=NULL) { echo "<br />¼Ö¤Ç".$re1data["kuruma"]."Ê¬";}
																		 ?>
                                            <?php
															}

														?>
                                        </td>
                                                </tr>
                                                <?php
														if($bsetdata["kakaku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kakaku"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th width="108" bgcolor="#ECECFF">
                                                        <div align="left" class="st"><?php echo $bsetdata["kakaku_name"] ?></div>
                                                    </th>
                                                    <td class="st">
                                                        <?php
																																																								if($re1data["kakaku"]!=NULL) {
																																																								echo "<span class=\"bukken_detail_price\">".numberformat($re1data["kakaku"])."</span> <span class=\"bukken_detail_price_tani\">Ëü±ß</span>";
																																																								} ?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["syougakkouku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
														?>
                                                <tr>
                                                    <th valign="top" bgcolor="#ECECFF" class="font14">
                                                        <div align="left"><?php echo $bsetdata["syougakkouku_name"] ?> </div>
                                                    </th>
                                                    <td bgcolor="#FFFFFF" class="font12">
                                                        <div align="left">
                                                            <?php
														if(str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
																																																								echo str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])."¾®³Ø¹»";
																																																								}?>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["chuugakouku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><span class="font14"><?php echo $bsetdata["chuugakouku_name"] ?></span></div>
                                                    </th>
                                                    <td bgcolor="#FFFFFF" class="font12">
                                                        <div align="left">
                                                            <?php
																																																								if(str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
																																																									echo str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])."Ãæ³Ø¹»";
																																																								}?>
                                                            </div>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["madori_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["madori"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th width="108" bgcolor="#ECECFF">
                                                        <div align="left" class="st"><?php echo $bsetdata["madori_name"] ?></div>
                                                    </th>
                                                    <td class="st"><?php echo $re1data["madori"].$re1data["madori_tani"]; ?></td>
                                                </tr>
<?php 																									}
						if($bukkensetdata["nodata_view"]==1||$re1data["madori"]!=NULL) {
?>                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["madori_syousai_name"] ?></div>
                                                    </th>
                                                    <td><?php echo $re1data["madori_syousai"]; ?></td>
                                                </tr>
                                                <?php
																																																}
																																																}
																																																?>
                                                <?php
														if($bsetdata["menseki_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["menseki"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["menseki_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php if($re1data["menseki"]!=NULL) { echo $re1data["menseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["menseki"]*0.3025,2)."ÄÚ¡Ë";} ?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["senyumenseki_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["senyumenseki"]!=NULL||$re1data["senyumenseki2"]!=NULL) {
																if($re1data["senyumenseki"]!=NULL&&$re1data["senyumenseki2"]!=NULL) {
?>
															<tr bgcolor="#ffffff">
																			<th bgcolor="#ECECFF"><div align="left"><?php
echo $bsetdata["senyumenseki_name"];?></div></th>
																			<td>
																							<?php
																							echo $re1data["senyumenseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";?>
																			</td>
															</tr>
															<tr bgcolor="#ffffff">
																			<th bgcolor="#ECECFF"><div align="left"><?php
echo "ÀìÍ­ÌÌÀÑ";
?></div></th>
																			<td>
																							<?php
																						if($re1data["senyumenseki2"]!=NULL){
																									echo $re1data["senyumenseki2"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki2"]*0.3025,2)."ÄÚ¡Ë";
																							}?>
																			</td>
															</tr>
															<?php
																}else {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php
if($re1data["senyumenseki"]!=NULL) { echo $bsetdata["senyumenseki_name"];}else if($re1data["senyumenseki2"]!=NULL){echo "ÀìÍ­ÌÌÀÑ";}																																																								?></div>
                                                    </th>
                                                    <td>
                                                        <?php
																																																								if($re1data["senyumenseki"]!=NULL&&$re1data["senyumenseki2"]!=NULL) {
																																																									echo $re1data["senyumenseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ<br />".$re1data["senyumenseki2"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki2"]*0.3025,2)."ÄÚ¡Ë";
																																																								}
																																																								else if($re1data["senyumenseki"]!=NULL) {
																																																								echo $re1data["senyumenseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
																																																								}
																																																								else if($re1data["senyumenseki2"]!=NULL){
																																																										echo $re1data["senyumenseki2"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki2"]*0.3025,2)."ÄÚ¡Ë";
																																																								} ?>
                                                    </td>
                                                </tr>
                                                <?php
																																																}
																}
																}
																?>
                                                <?php
														if($bsetdata["shidoumenseki_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["shidoumenseki"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["shidoumenseki_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php if($re1data["shidoumenseki"]!=NULL) { echo $re1data["shidoumenseki"]."m<sup>2</sup>";} ?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["kenpei_ritsu_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kenpei_ritsu"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["kenpei_ritsu_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php if($re1data["kenpei_ritsu"]!=NULL) {echo $re1data["kenpei_ritsu"]."%";} ?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["youseki_ritsu_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["youseki_ritsu"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["youseki_ritsu_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php if($re1data["youseki_ritsu"]!=NULL) {echo $re1data["youseki_ritsu"]."%";} ?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["kaisou_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kaisou"]!=NULL||$re1data["chijoukaisou"]!=NULL||$re1data["chikakaisou"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["kaisou_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php if($re1data["kaisou"]!=NULL) {echo $re1data["kaisou"]."³¬";} ?>
                                                        <?php if($re1data["chijoukaisou"]!=NULL) {echo "ÃÏ¾å".$re1data["chijoukaisou"]."³¬";} ?>
                                                        <?php if($re1data["chikakaisou"]!=NULL) {echo "ÃÏ²¼".$re1data["chikakaisou"]."³¬";} ?>
<?php if($re1data["kosu"]!=NULL) {echo "<br />¸Í¿ô¡¡".$re1data["kosu"]."¸Í";} ?>

                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["kouzou_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kouzou"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["kouzou_name"] ?></div>
                                                    </th>
                                                    <td><?php echo $re1data["kouzou"] ?></td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["chiku_nen_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["chiku_nen"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                                                    </th>
                                                    <td>
                                                        <?php
																		if($re1data["chiku_nen"]) {
																			echo $re1data["chiku_nen"]."Ç¯";
																		}
																		if($re1data["chiku_tsuki"]) {
																			echo $re1data["chiku_tsuki"]."·î";
																		}?>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
																?>
                                                <?php
														if($bsetdata["chusyajou_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["chusyajou"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["chusyajou_name"]; ?></div>
                                                    </th>
                                                    <td><?php echo $re1data["chusyajou"]; ?>
                                                            <?php
																				if($re1data["chusya_ryoukin"]!=NULL) {echo numberformat($re1data["chusya_ryoukin"])."±ß";}

																				?>
                                                    </td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["tochi_kenri_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["tochi_kenri"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["tochi_kenri_name"]; ?></div>
                                                    </th>
                                                    <td><?php echo $re1data["tochi_kenri"];?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["hosyoukin_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["hosyoukin_name"]; ?></div>
                                                    </th>
                                                    <td>
                                                        <?php
																		if($re1data["hosyoukin_kikan"]!=NULL) { echo $re1data["hosyoukin_kikan"]."¥ö·î¡¡";}
																		if($re1data["hosyoukin_kakaku"]!=NULL){ echo $re1data["hosyoukin_kakaku"]."Ëü±ß";}
																		 ?>
                                                    </td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["kenrikin_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kenrikin"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <th bgcolor="#ECECFF">
                                                        <div align="left"><?php echo $bsetdata["kenrikin_name"]; ?></div>
                                                    </th>
                                                    <td>
                                                        <div align="left">
                                                            <?php if($re1data["kenrikin"]!=NULL){ echo numberformat($re1data["kenrikin"])."±ß";} ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
														}
														}
					if($bsetdata["shikikin_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["shikikin"]!=NULL) {
					?>
                                                <tr>
                                                    <th width="108" valign="top" bgcolor="#ECECFF" class="font14">
                                                        <div align="right" class="font14">
                                                            <div align="left"><?php echo $bsetdata["shikikin_name"] ?></div>
                                                        </div>
                                                    </th>
                                                    <td bgcolor="#FFFFFF" class="font12">
                                                        <div align="left"><span class="realestate_bgcolor3">
                                                            <?php
																			if($re1data["shikikin"]!=NULL){ $re1data["shikikin"]."¥ö·î";}?>
                                                            </span> <span class="realestate_bgcolor3">
                                                            <?php 	if($re1data["sikikintani"]!=NULL){ echo numberformat($re1data["sikikintani"])."Ëü±ß";}?>
                                                        </span></div>
                                                    </td>
                                                </tr>
                                                <?php
					}
					}
					if($bsetdata["kanrihi_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kanrihi"]!=NULL) {
					?>
                                                <tr>
                                                    <th align="right" valign="top" bgcolor="#ECECFF" class="font14">
                                                        <div align="left"><?php echo $bsetdata["kanrihi_name"] ?></div>
                                                    </th>
                                                    <td bgcolor="#FFFFFF" class="font12">
                                                        <div align="left"><span class="realestate_bgcolor3">
                                                            <?php 	if($re1data["kanrihi"]!=NULL){ echo numberformat($re1data["kanrihi"])."±ß";}?>
                                                        </span></div>
                                                    </td>
                                                </tr>
                                                <?php
}
					}
					if($bsetdata["syuzenhi_tsumitate_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["syuzenhi_tsumitate"]!=NULL) {
					?>
                                                <tr>
                                                    <th align="right" valign="top" bgcolor="#ECECFF" class="font14">
                                                        <div align="left"><?php echo $bsetdata["syuzenhi_tsumitate_name"] ?></div>
                                                    </th>
                                                    <td bgcolor="#FFFFFF" class="font12">
                                                        <div align="left">
                                                            <?php 	if($re1data["syuzenhi_tsumitate"]!=NULL){ echo numberformat($re1data["syuzenhi_tsumitate"])."±ß";}?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
}
					}
?>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td width="50%" align="right" valign="top">
                                        <table width="98%" border="0" align="right" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE">
                                            <tbody>
                                                <?php
														if($bsetdata["toshikeikaku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["toshikeikaku"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td width="100" align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["toshikeikaku_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["toshikeikaku"];?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["youtochiiki_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["youtochiiki"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["youtochiiki_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["youtochiiki"]; ?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["chimoku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["chimoku"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["chimoku_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["chimoku"];?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["chisei_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["chisei"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["chisei_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["chisei"]; ?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["kokudohou_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["kokudohou"]!=NULL) {
														?>
																<tr bgcolor="#ffffff">
																				<td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["kokudohou_name"]; ?></td>
																				<td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["kokudohou"]; ?></td>
																</tr>
														<?php
														}
														}
														?>
                                                <?php
														if($bsetdata["syakuchikikan_chidai_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["syakuchikikan_chidai"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["syakuchikikan_chidai_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["syakuchikikan_chidai"]; ?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["syakuchikikan_chidai_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL||$re1data["zappi2"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["zappi_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php
																																																				if($re1data["zappi2"]!=NULL) {
																																																					echo $re1data["zappi2"]."¡¡";
																																																				}
																																																				if($re1data["zappi"]!=NULL) {echo numberformat($re1data["zappi"])."±ß"; }?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["genkyou_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["genkyou_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php

																						if($osusumedata[$i]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                      <font color="#FF0000"> ¡Ú¾¦ÃÌÃæ¡Û</font>
                                                      <?php
																						}
																						else if($osusumedata[$i]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                      <font color="#FF0000"> ¡ÚÀ®ÌóºÑ¡Û</font>
                                                      <?php
																						}
																						else {

																echo $re1data["genkyou"];
																} ?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                                <?php
														if($bsetdata["hikiwatashi_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]!=NULL) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF"><?php echo $bsetdata["hikiwatashi_name"]; ?></td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["hikiwatashi"] ?>
                                                            <?php if($re1data["hikiwatashi_nen"]!=NULL) {echo $re1data["hikiwatashi_nen"]."Ç¯";} ?>
                                                            <?php if($re1data["hikiwatashi_tsuki"]!=NULL) {echo $re1data["hikiwatashi_tsuki"]."·î";} ?>
                                                            <?php echo $re1data["hikiwatashi_syun"] ?></td>
                                                </tr>
                                                <?php
														}
														}
														?>
                                              <?php
														if($bsetdata["setsudou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["setsudou_joukyou"]!=NULL||$re1data["setsudou1"]!=NULL||$re1data["setsudou2"]!=NULL||$re1data["setsudou3"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <td valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["setsudou_name"] ?></div>
                                            </td>
                                            <td valign="top">
                                                <div align="left">
                                                    <table border="0" cellspacing="0" cellpadding="3">
                                                        <?php
																								if($re1data["setsudou_joukyou"]!=NULL) {
																								?>
                                                        <tr>
                                                            <td>¾õ¶·</td>
                                                            <td> <?php echo $re1data["setsudou_joukyou"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou1=str_replace(" ","",$re1data["setsudou1"]);
																								$setsudou1=str_replace("¡¡","",$setsudou1);

																								if(trim($setsudou1)!=NULL&&trim($setsudou1)!="m"&&trim($setsudou1)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»1</td>
                                                            <td> <?php echo $re1data["setsudou1"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou2=str_replace(" ","",$re1data["setsudou2"]);
																								$setsudou2=str_replace("¡¡","",$setsudou2);

																								if(trim($setsudou2)!=NULL&&trim($setsudou2)!="m"&&trim($setsudou2)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»2</td>
                                                            <td> <?php echo $re1data["setsudou2"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou3=str_replace(" ","",$re1data["setsudou3"]);
																								$setsudou3=str_replace("¡¡","",$setsudou3);

																								if(trim($setsudou3)!=NULL&&trim($setsudou3)!="m"&&trim($setsudou3)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»3</td>
                                                            <td> <?php echo $re1data["setsudou3"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
															?>
                                                <?php

														if($bsetdata["setsubi_naka_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]==1||$re1data["setsubi_naka1"]==1||$re1data["setsubi_naka2"]==1||$re1data["setsubi_naka3"]==1||$re1data["setsubi_naka4"]==1||$re1data["setsubi_naka5"]==1||$re1data["setsubi_naka6"]==1||$re1data["setsubi_naka7"]==1||$re1data["setsubi_naka8"]==1||$re1data["setsubi_naka9"]==1||$re1data["setsubi_naka10"]==1||$re1data["setsubi_naka11"]==1||$re1data["setsubi_naka12"]==1||$re1data["setsubi_naka13"]==1||$re1data["setsubi_naka14"]==1||$re1data["setsubi_naka15"]==1||$re1data["setsubi_naka16"]==1||$re1data["setsubi_naka17"]==1||$re1data["setsubi_naka18"]==1||$re1data["setsubi_naka19"]==1||$re1data["setsubi_naka20"]==1) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                        <div align="left"><span class="font14"><?php echo $bsetdata["setsubi_naka_name"]?></span><br />
                                                            ¡Ê¥¢¥¤¥³¥ó¤Ë¥Þ¥¦¥¹¤ò¾è¤»¤ë¤ÈÀâÌÀ¤¬½Ð¤Þ¤¹¡Ë <br />
                                                            <br />
                                                            <a href="#" onclick="javascript:window.open('iconhyou.php','new','width=450,height=700,resizable=1,scrollbars=1')">Ž±Ž²ŽºŽÝ¤ÎÀâÌÀ</a></div>
                                                    </td>
                                                    <td align="left" valign="top">
                                                        <div align="left">
                                                            <?php if($re1data["setsubi_naka1"]==1){ ?>
                                                            <img src="/img/icon/gas.jpg" alt="µëÅò" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka2"]==1){ ?>
                                                            <img src="/img/icon/coldstorage.jpg" alt="ÎäÂ¢¸Ë" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka3"]==1){ ?>
                                                            <img src="/img/icon/denka.jpg" alt="¥ª¡¼¥ëÅÅ²½" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka4"]==1){ ?>
                                                            <img src="/img/icon/light.jpg" alt="¾ÈÌÀ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka5"]==1){ ?>
                                                            <img src="/img/icon/usen.jpg" alt="Í­Àþ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka6"]==1){ ?>
                                                            <img src="/img/icon/catv.jpg" alt="¥±¡¼¥Ö¥ë¥Æ¥ì¥Ó" width="38" height="38" border="0" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka7"]==1){ ?>
                                                            <img src="/img/icon/internet.jpg" alt="¥¤¥ó¥¿¡¼¥Í¥Ã¥ÈÂÐ±þ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka8"]==1){ ?>
                                                            <img src="/img/icon/tv.jpg" alt="TV" width="38" height="38" border="0" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka9"]==1){ ?>
                                                            <img src="/img/icon/floor.jpg" alt="µï´Ö¥Õ¥í¡¼¥ê¥ó¥°" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka10"]==1){ ?>
                                                            <img src="/img/icon/systemkichen5.jpg" alt="¥·¥¹¥Æ¥à¥­¥Ã¥Á¥ó" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka11"]==1){ ?>
                                                            <img src="/img/icon/indoor.jpg" alt="¼¼ÆâÀöÂõµ¡" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka12"]==1){ ?>
                                                            <img src="/img/icon/wash.jpg" alt="¥¦¥©¥Ã¥·¥å¥ì¥Ã¥È" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka13"]==1){ ?>
                                                            <img src="/img/icon/separate.jpg" alt="É÷Ï¤¥È¥¤¥ìÊÌ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka14"]==1){ ?>
                                                            <img src="/img/icon/shower.jpg" alt="¥·¥ã¥ï¡¼" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka15"]==1){ ?>
                                                            <img src="/img/icon/shanp.jpg" alt="¥·¥ã¥ó¥×¡¼¥É¥ì¥Ã¥µ¡¼" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka16"]==1){ ?>
                                                            <img src="/img/icon/aircon.jpg" alt="¥¨¥¢¥³¥óÉÕ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka17"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka18"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka19"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_naka20"]==1){ ?>
                                                            <?php }?>
                                                            <br />
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
																						}
																}
														if($bsetdata["setsumi_soto_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["setsubi_soto1"]==1||$re1data["setsubi_soto2"]==1||$re1data["setsubi_soto3"]==1||$re1data["setsubi_soto4"]==1||$re1data["setsubi_soto5"]==1||$re1data["setsubi_soto6"]==1||$re1data["setsubi_soto7"]==1||$re1data["setsubi_soto8"]==1||$re1data["setsubi_soto9"]==1||$re1data["setsubi_soto10"]==1) {  														?>
                                                <tr bgcolor="#ffffff">
                                                    <td width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                        <div align="left"><span class="font14"><?php echo $bsetdata["setsumi_soto_name"]?></span></div>
                                                    </td>
                                                    <td align="left" valign="top">
                                                        <div align="left">
                                                            <?php if($re1data["setsubi_soto1"]==1){ ?>
                                                            <img src="/img/icon/park_bcl.jpg" alt="ÃóÎØ¾ì" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto2"]==1){ ?>
                                                            <img src="/img/icon/park_car.jpg" alt="Ãó¼Ö¾ì2Âæ°Ê¾å²Ä" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto3"]==1){ ?>
                                                            <img src="/img/icon/autolock.jpg" alt="¥ª¡¼¥È¥í¥Ã¥¯" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto4"]==1){ ?>
                                                            <img src="/img/icon/ev.jpg" alt="¥¨¥ì¥Ù¡¼¥¿" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto5"]==1){ ?>
                                                            <img src="/img/icon/post.jpg" alt="ÂðÇÛ¥Ü¥Ã¥¯¥¹" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto6"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto7"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto8"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto9"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["setsubi_soto10"]==1){ ?>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
																}
																}
														if($bsetdata["jouken_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["jouken1"]==1||$re1data["jouken2"]==1||$re1data["jouken3"]==1||$re1data["jouken4"]==1||$re1data["jouken5"]==1||$re1data["jouken6"]==1||$re1data["jouken7"]==1||$re1data["jouken8"]==1||$re1data["jouken9"]==1||$re1data["jouken10"]==1) {
														?>
                                                <tr bgcolor="#ffffff">
                                                    <td width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                        <div align="left"><span class="font14"><?php echo $bsetdata["jouken_name"]?></span></div>
                                                    </td>
                                                    <td align="left" valign="top">
                                                        <div align="left">
                                                            <?php if($re1data["jouken1"]==1){ ?>
                                                            <img src="/img/icon/company.jpg" alt="Ë¡¿Í´õË¾¡¦¸ÂÄê" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["jouken2"]==1){ ?>
                                                            <img src="/img/icon/woman.jpg" alt="½÷À­ÀìÍÑ" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["jouken3"]==1){ ?>
                                                            <img src="/img/icon/pet.jpg" alt="¥Ú¥Ã¥ÈÁêÃÌ²Ä" width="38" height="38" />
                                                            <?php }?>
                                                            <?php if($re1data["jouken4"]==1){ ?>
                                                            <img src="/img/icon/piano.jpg" alt="¥Ô¥¢¥ÎÁêÃÌ²Ä" width="38" height="38" border="0" />
                                                            <?php }?>
                                                            <?php if($re1data["jouken5"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["jouken6"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["jouken7"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["jouken8"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["jouken9"]==1){ ?>
                                                            <?php }?>
                                                            <?php if($re1data["jouken10"]==1){ ?>
                                                            <?php }?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php
																						}
																}

																								$setsubi_othernum=$re1data["setsubi_other1"]+$re1data["setsubi_other2"]+$re1data["setsubi_other3"]+$re1data["setsubi_other4"]+$re1data["setsubi_other5"]+$re1data["setsubi_other6"]+$re1data["setsubi_other7"]+$re1data["setsubi_other8"]+$re1data["setsubi_other9"]+$re1data["setsubi_other10"];

														if($setsubi_othernum>0) {
														?><tr bgcolor="#ffffff">
                                                            <td align="left" valign="top" nowrap="nowrap" bgcolor="#ECECFF">µëÇÓ¿å¡¦¥¬¥¹</td>
                                                            <td align="left"><?php if($re1data["setsubi_other1"]==1){ ?>
                                                                  ¾å¿åÆ»
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other2"]==1){ ?>
                                                                    °æ¸Í
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other3"]==1){ ?>
                                                                   ²¼¿åÆ» <?php }?>
                                                                    <?php if($re1data["setsubi_other4"]==1){ ?>
                                                                    ¾ô²½Áå
<?php }?>
                                                                    <?php if($re1data["setsubi_other5"]==1){ ?>
                                                                  µâ¼è
                                                                    <?php }?><br>
                                                                    <?php if($re1data["setsubi_other6"]==1){ ?>
                                                                    ÅÔ»Ô¥¬¥¹ <?php }?>
                                                                    <?php if($re1data["setsubi_other7"]==1){ ?>
                                                                    ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other8"]==1){ ?>
                                                                    ½¸Ãæ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other9"]==1){ ?>
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other10"]==1){ ?>
                                                                    <?php }?>
                                                            </td>
                                                        </tr><?php
																																																								}

														if($re1data["torihikitaiyou"]!=NULL) {
														?>
                                                        <tr bgcolor="#ffffff">
                                                            <td align="left" nowrap="nowrap" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></span></td>
                                                            <td align="left"><?php echo $re1data["torihikitaiyou"];?></td>
                                                        </tr>
																																																								<?php
																																																								}
																																																								?>                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF">È÷¹Í</td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["bikou"]; ?></td>
                                                </tr>
                                                <tr bgcolor="#ffffff">
                                                    <td align="left" valign="top" bgcolor="#ECECFF">ÅÐÏ¿Æü</td>
                                                    <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["tourokubi"]; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top">
                                        <?php
										if($re1data["madorizu2"]!=NULL||$re1data["photo2"]!=NULL||$re1data["photo3"]!=NULL||$re1data["photo4"]!=NULL||$re1data["photo5"]!=NULL){
										?>
                                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE">
                                            <tbody>
                                                <tr bgcolor="#eec2bb">
                                                    <td width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["madorizu_name"] ?></div>
                                                    </td>
                                                    <td width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["photo_name"] ?></div>
                                                    </td>
                                                </tr>
                                                <tr bgcolor="#ffffff">
                                                    <td valign="top" bgcolor="#ffffff">
                                                        <div align="center"> <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu2"])."?".time(); ?>" rel="lightbox">
                                                            <?php
																																																																												if($re1data["madorizu2"]!=NULL){
																																												 ?>
                                                            <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"]."?".time(); ?>" border="0" />
                                                            <?php
																																												 }
																																												 ?>
                                                        </a></div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <?php
																																												if($re1data["photo2"]!=NULL){
																																												 ?>
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo2"])."?".time(); ?>" rel="lightbox"><img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]."?".time(); ?>" border="0" /></a>
                                                            <?php
																																												 }
																																												 ?>
                                                            <?php
																																												if($re1data["photo3"]!=NULL){
																																												 ?>
                                                            <br />
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo3"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]."?".time(); ?>" border="0" /></a>
                                                            <?php
																																												 }
																																												 ?>
                                                            <?php
																																												if($re1data["photo4"]!=NULL){
																																												 ?>
                                                            <br />
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo4"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]."?".time(); ?>" border="0" /></a>
                                                            <?php
																																												 }
																																												 ?>
                                                            <?php
																																												if($re1data["photo5"]!=NULL){
																																												 ?>
                                                            <br />
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo5"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"]."?".time(); ?>" border="0" /></a>
                                                            <?php
																																												 }
																																												 ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <?php
										}
										?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="left" valign="top">&nbsp;</td>
                                </tr>
                            </tbody>
                        </table>
                        <table border="0" align="right" cellpadding="0" cellspacing="0">
                            <tr>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                            <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                            <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                        </tr>
                                        <tr>
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                        </tr>
                                        <tr>
                                            <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                            <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                            <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                        </tr>
                                        <tr>
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                        </tr>
                                        <tr>
                                            <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                        </tr>
                                    </table>
                                    <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                <td>
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                            <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                            <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                        </tr>
                                        <tr>
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                        </tr>
                                        <tr>
                                            <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <br />
                        <div align="left">
                            <?php
}
else if($btype==2) {
?><br />
                            <?php
}
else if($btype==3){
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");

?>
                        </div>
                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><img src="/img_f/ver2/syuybetsu_bg1.jpg" width="20" height="25" /></td>
                                                <td align="left" background="/img_f/ver2/syuybetsu_bg2.jpg"><strong><font color="#FFFFFF" class="bukken_detail_title">ÇäÇãÊª·ï¡¡<?php echo $re1data["syumoku"] ?></font><font color="#333333" class="bukken_detail_title"></font></strong></td>
                                                <td width="20">
                                                    <div align="right"><img src="/img_f/ver2/syuybetsu_bg3.jpg" width="20" height="25" /></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <div align="right">
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                                            </tr>
                                                        </table>
                                                        <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                                    <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" id="bukken">
                            <tbody>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCEE" class="bukkentablelist">
                                            <tr bgcolor="#FFFFFF" class="font12">
                                                <th width="18%" rowspan="2" align="center" valign="middle" bgcolor="#ECECFF">
                                                    <div align="center"><span class="st"><?php echo $bsetdata["menseki_name"] ?></span></div>
                                                </th>
                                                <th width="36%" height="25" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                                </th>
                                                <th colspan="2" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="36%" height="25" align="right" bgcolor="#ECECFF" class="st">
                                                    <div align="center"><strong><?php echo $bsetdata["kakaku_name"] ?><br />
                                                    </strong></div>
                                                </th>
                                                <th width="22%" bgcolor="#ECECFF" class="font12">
                                                    <div align="center"><?php echo $bsetdata["syumoku_name"] ?></div>
                                                </th>
                                                <th width="24%" bgcolor="#ECECFF" class="font12">
                                                    <div align="center"><?php echo $bsetdata["chimoku_name"] ?></div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"> <span class="st">
                                                    <?php if($re1data["menseki"]!=NULL) {echo $re1data["menseki"]."m<sup>2</sup><br />¡ÊÌó".number_format($re1data["menseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?></span></td>
                                                <td height="25" bgcolor="#FFFFFF"><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"]; if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];}?></td>
                                                <td colspan="2" align="center" bgcolor="#FFFFFF" class="font12"><?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."±Ø";} ?>
                                                        <?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
                                                        <?php if($re1data["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data["ekiho"]."Ê¬";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25" align="right" bgcolor="#FFFFFF" class="st">
                                                    <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <div align="right">
                                                                    <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data["kakaku"])."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data["syumoku"]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12">
                                                    <?php if($re1data["chimoku"]!=NULL){ echo $re1data["chimoku"];}else{ echo "-";} ?>
                                                </td>
                                            </tr>
                                            <?php
																						?>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE">
                                            <tbody>
                                                <tr bgcolor="#eec2bb">
                                                    <td width="688" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["photo_name"] ?></div>
                                                    </td>
                                                </tr>
                                                <tr bgcolor="#ffffff">
                                                    <td valign="top">
                                                        <div align="center">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td width="50%" align="center" valign="top">
                                                                        <?php if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL) {?>
                                                                        <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                                        <?php
																																				}
																																				 ?>
                                                                        <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"])."?".time(); ?>" rel="lightbox">
                                                                        <?php
																																												if($re1data["photo1"]!=NULL){
																																												 ?>
                                                                        <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                                        <?php
																																}
																																												 ?>
                                                                    </a></td>
                                                                    <td width="50%" align="center" valign="top">
                                                                        <?php if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL) {?>
                                                                        <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                                        <?php
																																				}
																																				 ?>
                                                                        <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo2"])."?".time(); ?>" rel="lightbox">
                                                                        <?php
																																												if($re1data["photo2"]!=NULL){
																																												 ?>
                                                                        <img src="<?php if($re1data["photo2"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                                        <?php
																																}
																																												 ?>
                                                                    </a></td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="50%" align="center" valign="top">
                                                    <table width="98%" border="0" align="left" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                                        <tbody>
                                                            <?php
														if($bsetdata["bukken_id_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukkenn_id"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["bukken_id_name"]?></div>
                                                                </th>
                                                                <td valign="top">
                                                                    <div align="left"><?php echo $re1data["bukkenn_id"] ?></div>
                                                                </td>
                                                            </tr>
                                                            <?php
																		}
																		}
														if($bsetdata["bukken_mei_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukken_mei"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" bgcolor="#ECECFF">
                                                                    <div align="left"><span align="left"><?php echo $bsetdata["bukken_mei_name"]?></span> </div>
                                                                </th>
                                                                <td valign="top">
                                                                    <div align="left"><?php echo $re1data["bukken_mei"] ?></div>
                                                                </td>
                                                            </tr>
                                                            <?php
																		}
																		}
														if($bsetdata["syumoku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["syumoku"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["syumoku_name"] ?></div>
                                                                </th>
                                                                <td align="left" valign="top"><?php echo $re1data["syumoku"] ?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["jyusyo_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["jyusyo1"]!=NULL||$re1data["jyusyo2"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <table cellspacing="1" cellpadding="1" width="100%" border="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <?php
																												echo $re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"];
																												if($re1data["banchichk"]==1) {
																												echo $re1data["jyusyo3"];
																												} ?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <a href="#" onclick="window.open('./mapout.php?name=<?php echo urlencode(mb_convert_encoding($re1data["bukken_mei"],"utf8","euc-jp"));?>&amp;address=<?php echo urlencode(mb_convert_encoding($re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"],"utf8","euc-jp"));if($re1data["banchichk"]==1) {echo urlencode(mb_convert_encoding($re1data["jyusyo3"],"utf8","euc-jp"));}?>','maps','width=640,height=540')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a> </td>
                                                            </tr>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left">¸òÄÌ </div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php

														if($bsetdata["ensen_view"]==1) {

														?>
                                            <?php if($re1data["eki"]!=NULL) { echo $re1data["eki"]."±Ø";}
																		 if($re1data["ensen"]!=NULL) {echo "[".$re1data["ensen"]."]";}
																		 if($re1data["ekiho"]!=NULL) {echo " ÅÌÊâ ".$re1data["ekiho"]." Ê¬";}
																			if($re1data["kyori"]!=NULL) {echo " µ÷Î¥ ".$re1data["kyori"]."m";}
															}
														if($bsetdata["basu_view"]==1) {
														?>
                                            <?php
																				 if($re1data["basutei"]!=NULL) { echo "<br />".$re1data["basutei"];}
																		 if($re1data["basu"]!=NULL) {echo "[".$re1data["basu"]."Ê¬]";}
																		  if($re1data["basu_ho"]!=NULL) {echo " ÅÌÊâ ".$re1data["basu_ho"]." Ê¬";}?>
                                            <?php
															}
														if($bsetdata["kuruma_view"]==1) {
														?>
                                            <?php if($re1data["kuruma"]!=NULL) { echo "<br />¼Ö¤Ç".$re1data["kuruma"]."Ê¬";}
																		 ?>
                                            <?php
															}

														?>
                                        </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["kakaku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["kakaku"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["kakaku_name"] ?></div>
                                                                </th>
                                                                <td align="left" valign="top" class="st">
                                                                    <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"bukken_detail_price\">".numberformat($re1data["kakaku"])."</span> <span class=\"bukken_detail_price_tani\">Ëü±ß</span>";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["syougakkouku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["syougakkouku"]!=NULL||str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
														?>
                                                            <tr>
                                                                <th align="left" valign="top" bgcolor="#ECECFF" class="font14">
                                                                    <div align="left"><?php echo $bsetdata["syougakkouku_name"] ?></div>
                                                                </th>
                                                                <td bgcolor="#FFFFFF" class="font12">
                                                                    <div align="left">
                                                                        <?php
														if(str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
																																																								echo str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])."¾®³Ø¹»";
																																																								}?>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["chuugakouku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["chuugakouku"]!=NULL||str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["chuugakouku_name"] ?></span></div>
                                                                </th>
                                                                <td bgcolor="#FFFFFF" class="font12">
                                                                    <div align="left">
                                                                        <?php
																																																								if(str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
																																																									echo str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])."Ãæ³Ø¹»";
																																																								}?>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["menseki_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["menseki"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span  class="st"><?php echo $bsetdata["menseki_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top" class="st">
                                                                    <?php if($re1data["menseki"]!=NULL) { echo $re1data["menseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["menseki"]*0.3025,2)."ÄÚ¡Ë";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["tsubotanka_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["tsubotanka"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["tsubotanka_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["tsubotanka"]!=NULL) { echo $re1data["tsubotanka"]."Ëü±ß";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["shidoumenseki_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["shidoumenseki"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["shidoumenseki_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["shidoumenseki"]!=NULL) { echo $re1data["shidoumenseki"]."m<sup>2</sup>";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["kenpei_ritsu_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["kenpei_ritsu"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kenpei_ritsu_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["kenpei_ritsu"]!=NULL) {echo $re1data["kenpei_ritsu"]."%";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["youseki_ritsu_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["youseki_ritsu"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["youseki_ritsu_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["youseki_ritsu"]!=NULL) {echo $re1data["youseki_ritsu"]."%";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["hosyoukin_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin_kikan"]!=NULL||$re1data["hosyoukin_kakaku"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["hosyoukin_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php
																		if($re1data["hosyoukin_kikan"]!=NULL) { echo $re1data["hosyoukin_kikan"]."¥ö·î¡¡";}
																		if($re1data["hosyoukin_kakaku"]!=NULL){ echo $re1data["hosyoukin_kakaku"]."Ëü±ß";}
																		 ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["kenrikin_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["kenrikin"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kenrikin_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["kenrikin"]!=NULL) { echo numberformat($re1data["kenrikin"])."±ß";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["tochi_kenri_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["tochi_kenri"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["tochi_kenri_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["tochi_kenri"];?></td>
                                                            </tr>
                                                            <?php
															}
																}
														?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="50%" align="center" valign="top">
                                                    <table width="98%" border="0" align="right" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE">
                                                        <tbody>
                                                            <?php
														if($bsetdata["toshikeikaku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["toshikeikaku"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["toshikeikaku_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["toshikeikaku"];?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["youtochiiki_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["youtochiiki"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["youtochiiki_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["youtochiiki"]; ?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["chimoku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["chimoku"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["chimoku_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["chimoku"];?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["chisei_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["chisei"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["chisei_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["chisei"]; ?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["kokudohou_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["kokudohou"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["kokudohou_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["kokudohou"]; ?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["syakuchikikan_chidai_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["syakuchikikan_chidai"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["syakuchikikan_chidai_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["syakuchikikan_chidai"]; ?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["zappi_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["zappi_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php
																																																				if($re1data["zappi2"]!=NULL) {
																																																					echo $re1data["zappi2"]."¡¡";
																																																				}
																																																				if($re1data["zappi"]!=NULL) {echo numberformat($re1data["zappi"])."±ß"; }?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["genkyou_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["genkyou_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php

																						if($osusumedata[$i]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                  <font color="#FF0000"> ¡Ú¾¦ÃÌÃæ¡Û</font>
                                                                  <?php
																						}
																						else if($osusumedata[$i]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                  <font color="#FF0000"> ¡ÚÀ®ÌóºÑ¡Û</font>
                                                                  <?php
																						}
																						else {

																echo $re1data["genkyou"];}?></td>
                                                            </tr>
                                                            <?php
															}
																}
														if($bsetdata["hikiwatashi_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["hikiwatashi_name"] ?></span></td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["hikiwatashi"] ?>
                                                                        <?php if($re1data["hikiwatashi_nen"]!=NULL) {echo $re1data["hikiwatashi_nen"]."Ç¯";} ?>
                                                                        <?php if($re1data["hikiwatashi_tsuki"]!=NULL) {echo $re1data["hikiwatashi_tsuki"]."·î";} ?>
                                                                        <?php echo $re1data["hikiwatashi_syun"] ?></td>
                                                            </tr>
                                                            <?php
															}
																}
?>                                               <?php
														if($bsetdata["setsudou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["setsudou_joukyou"]!=NULL||$re1data["setsudou1"]!=NULL||$re1data["setsudou2"]!=NULL||$re1data["setsudou3"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <td valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["setsudou_name"] ?></div>
                                            </td>
                                            <td valign="top">
                                                <div align="left">
                                                    <table border="0" cellspacing="0" cellpadding="3">
                                                        <?php
																								if($re1data["setsudou_joukyou"]!=NULL) {
																								?>
                                                        <tr>
                                                            <td>¾õ¶·</td>
                                                            <td> <?php echo $re1data["setsudou_joukyou"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou1=str_replace(" ","",$re1data["setsudou1"]);
																								$setsudou1=str_replace("¡¡","",$setsudou1);

																								if(trim($setsudou1)!=NULL&&trim($setsudou1)!="m"&&trim($setsudou1)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»1</td>
                                                            <td> <?php echo $re1data["setsudou1"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou2=str_replace(" ","",$re1data["setsudou2"]);
																								$setsudou2=str_replace("¡¡","",$setsudou2);

																								if(trim($setsudou2)!=NULL&&trim($setsudou2)!="m"&&trim($setsudou2)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»2</td>
                                                            <td> <?php echo $re1data["setsudou2"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou3=str_replace(" ","",$re1data["setsudou3"]);
																								$setsudou3=str_replace("¡¡","",$setsudou3);

																								if(trim($setsudou3)!=NULL&&trim($setsudou3)!="m"&&trim($setsudou3)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»3</td>
                                                            <td> <?php echo $re1data["setsudou3"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
															?>
                                                          <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF">¾ò·ïÅù</td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["jouken"]; ?></td>
                                                            </tr>
<?php											$setsubi_othernum=$re1data["setsubi_other1"]+$re1data["setsubi_other2"]+$re1data["setsubi_other3"]+$re1data["setsubi_other4"]+$re1data["setsubi_other5"]+$re1data["setsubi_other6"]+$re1data["setsubi_other7"]+$re1data["setsubi_other8"]+$re1data["setsubi_other9"]+$re1data["setsubi_other10"];

														if($setsubi_othernum>0) {
														?><tr bgcolor="#ffffff">
                                                            <td align="left" valign="top" nowrap="nowrap" bgcolor="#ECECFF">µëÇÓ¿å¡¦¥¬¥¹</td>
                                                            <td align="left"><?php if($re1data["setsubi_other1"]==1){ ?>
                                                                  ¾å¿åÆ»
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other2"]==1){ ?>
                                                                    °æ¸Í
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other3"]==1){ ?>
                                                                   ²¼¿åÆ» <?php }?>
                                                                    <?php if($re1data["setsubi_other4"]==1){ ?>
                                                                    ¾ô²½Áå
<?php }?>
                                                                    <?php if($re1data["setsubi_other5"]==1){ ?>
                                                                  µâ¼è
                                                                    <?php }?><br>
                                                                    <?php if($re1data["setsubi_other6"]==1){ ?>
                                                                    ÅÔ»Ô¥¬¥¹ <?php }?>
                                                                    <?php if($re1data["setsubi_other7"]==1){ ?>
                                                                    ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other8"]==1){ ?>
                                                                    ½¸Ãæ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other9"]==1){ ?>
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other10"]==1){ ?>
                                                                    <?php }?>
                                                            </td>
                                                        </tr><?php
																																																								}

														if($re1data["torihikitaiyou"]!=NULL) {
														?>
                                                        <tr bgcolor="#ffffff">
                                                            <td align="left" nowrap="nowrap" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></span></td>
                                                            <td align="left"><?php echo $re1data["torihikitaiyou"];?></td>
                                                        </tr>
																																																								<?php
																																																								}
																																																								?>                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF">È÷¹Í</td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["bikou"]; ?></td>
                                                            </tr>
                                                            <tr bgcolor="#ffffff">
                                                                <td align="left" valign="top" bgcolor="#ECECFF">ÅÐÏ¿Æü</td>
                                                                <td align="left" valign="top" bgcolor="#ffffff"><?php echo $re1data["tourokubi"]; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <?php
						if($re1data["photo3"]!=NULL||$re1data["photo4"]!=NULL||$re1data["photo5"]!=NULL) {
						?>
                        <table width="99%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE">
                            <tbody>
                                <tr bgcolor="#eec2bb">
                                    <td bgcolor="#ECECFF">
                                        <div align="center">³°´Ñ¿Þ</div>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top">
                                        <div align="center">
                                            <?php
																																												if($re1data["photo3"]!=NULL){
																																												 ?>
                                            <br />
                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo3"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]; ?>" border="0" /></a>
                                            <?php
																																												 }
																																												 ?>
                                            <?php
																																												if($re1data["photo4"]!=NULL){
																																												 ?>
                                            <br />
                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo4"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]; ?>" border="0" /></a>
                                            <?php
																																												 }
																																												 ?>
                                            <?php
																																												if($re1data["photo5"]!=NULL){
																																												 ?>
                                            <br />
                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo5"])."?".time(); ?>" rel="lightbox"> <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"]; ?>" border="0" /></a>
                                            <?php
																																												 }
																																												 ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
						}
						?>
                        <div>
                            <div align="center"><br />
                            </div>
                        </div>
                        <br />
                        <br />
                        <div>
                            <div align="center">
                                <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td>
                                                <div align="left">
                                                    <table border="0" align="right" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                                                        <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                                                        <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                            <td>
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                                                        <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                                                        <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                                                    </tr>
                                                                </table>
                                                                <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                                            <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                            <td>
                                                                <table border="0" cellspacing="0" cellpadding="0">
                                                                    <tr>
                                                                        <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                                                        <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                                                        <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </table>
                            </div>
                        </div>
                        <?php
}
else if($btype==4) {
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");

?>
                        <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
                        		<tbody>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                                <td width="20"><img src="/img_f/ver2/syuybetsu_bg1.jpg" width="20" height="25" /></td>
                                                                <td align="left" background="/img_f/ver2/syuybetsu_bg2.jpg"><strong><font color="#FFFFFF" class="bukken_detail_title">ÇäÇãÊª·ï¡¡<?php echo $re1data["syumoku"] ?></font><font color="#333333" class="bukken_detail_title"></font></strong></td>
                                                                <td width="20">
                                                                    <div align="right"><img src="/img_f/ver2/syuybetsu_bg3.jpg" width="20" height="25" /></div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <div align="right">
                                                            <table border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                    <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                        <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                                                    <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                                                    <td>
                                                                        <table border="0" cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                                                                <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                                                                <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <table width="99%" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFFFFF" id="bukken">
                            <tbody>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCEE" class="bukkentablelist">
                                            <tr bgcolor="#FFFFFF" class="font12">
                                                <th width="18%" rowspan="2" align="center" valign="middle" bgcolor="#ECECFF">
                                                    <div align="center"><span class="st"><?php echo $bsetdata["senyumenseki_name"] ?></span></div>
                                                </th>
                                                <th width="35%" height="25" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                                </th>
                                                <th colspan="2" bgcolor="#ECECFF">
                                                    <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th width="35%" height="25" align="right" bgcolor="#ECECFF" class="st">
                                                    <div align="center"><strong><?php echo $bsetdata["kakaku_name"] ?><br />
                                                    </strong></div>
                                                </th>
                                                <th width="22%" bgcolor="#ECECFF" class="font12">
                                                    <div align="center"><?php echo $bsetdata["syumoku_name"] ?></div>
                                                </th>
                                                <th width="25%" bgcolor="#ECECFF" class="font12">
                                                    <div align="center"><?php echo $bsetdata["chimoku_name"] ?></div>
                                                </th>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="st"><?php if($re1data["senyumenseki"]!=NULL) {echo $re1data["senyumenseki"]."m<sup>2</sup><br />¡¡¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?></span></td>
                                                <td height="25" bgcolor="#FFFFFF"><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"]; if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];}?></td>
                                                <td colspan="2" align="center" bgcolor="#FFFFFF" class="font12"><?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."±Ø";} ?>
                                                        <?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
                                                        <?php if($re1data["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data["ekiho"]."Ê¬";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25" align="right" bgcolor="#FFFFFF" class="st">
                                                    <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td height="20">
                                                                <div align="right">
                                                                    <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data["kakaku"])."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data["syumoku"]; ?></td>
                                                <td align="center" bgcolor="#FFFFFF" class="font12">
                                                    <?php if($re1data["chimoku"]!=NULL){ echo $re1data["chimoku"];}else{ echo "-";} ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                            <tbody>
                                                <tr bgcolor="#eec2bb">
                                                    <th width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["madorizu_name"] ?></div>
                                                    </th>
                                                    <th width="50%" bgcolor="#ECECFF">
                                                        <div align="center"><?php echo $bsetdata["photo_name"] ?></div>
                                                    </th>
                                                </tr>
                                                <tr bgcolor="#ffffff">
                                                    <td>
                                                        <div align="center">
                                                            <?php if($re1data["madorizu1"]==NULL&&$re1data["madorizu2"]==NULL) {?>
                                                            <img src="<?php if($re1data["madorizu1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																				}
																																				 ?>
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu1"])."?".time(); ?>" rel="lightbox">
                                                            <?php if($re1data["madorizu1"]!=NULL){  ?>
                                                            <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"]."?".time(); ?>" border="0" />
                                                            <?php }
																																				?>
                                                        </a></div>
                                                    </td>
                                                    <td>
                                                        <div align="center">
                                                            <?php if($re1data["photo1"]==NULL&&$re1data["photo2"]==NULL) {?>
                                                            <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																				}
																																				 ?>
                                                            <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"])."?".time(); ?>" rel="lightbox">
                                                            <?php
																																												if($re1data["photo1"]!=NULL){
																																												 ?>
                                                            <img src="<?php if($re1data["photo1"]!=NULL){ echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();}else {echo "/img/noimage_300_300.gif";} ?>" border="0" />
                                                            <?php
																																}
																																												 ?>
                                                        </a></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">&nbsp;</td>
                                </tr>
                                <tr bgcolor="#ffffff">
                                    <td valign="top" bgcolor="#ffffff">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="50%" align="center" valign="top">
                                                    <table width="98%" border="0" align="left" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                                        <tbody>
                                                            <?php
														if($bsetdata["bukken_id_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukkenn_id"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["bukken_id_name"]?></div>
                                                                </th>
                                                                <td valign="top">
                                                                    <div align="left"><?php echo $re1data["bukkenn_id"] ?></div>
                                                                </td>
                                                            </tr>
                                                            <?php
																		}
																		}
														if($bsetdata["bukken_mei_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["bukken_mei"]!=NULL) {
														?>
                                                            <tr bgcolor="#ffffff">
                                                                <th bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["bukken_mei_name"]?></div>
                                                                </th>
                                                                <td valign="top">
                                                                    <div align="left"><?php echo $re1data["bukken_mei"] ?></div>
                                                                </td>
                                                            </tr>
                                                            <?php
																		}
																		}
																						if($bsetdata["syumoku_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["syumoku"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["syumoku_name"] ?></div>
                                                                </th>
                                                                <td align="left" valign="top"><?php echo $re1data["syumoku"] ?></td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["jyusyo_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["jyusyo1"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><?php echo $bsetdata["jyusyo_name"] ?> </div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <table cellspacing="1" cellpadding="1" width="100%" border="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td>
                                                                                    <?php
																												echo $re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"];
																												if($re1data["banchichk"]==1) {
																												echo $re1data["jyusyo3"];
																												} ?>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <a href="#" onclick="window.open('./mapout.php?name=<?php echo urlencode(mb_convert_encoding($re1data["bukken_mei"],"utf8","euc-jp"));?>&amp;address=<?php echo urlencode(mb_convert_encoding($re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"],"utf8","euc-jp"));if($re1data["banchichk"]==1) {echo urlencode(mb_convert_encoding($re1data["jyusyo3"],"utf8","euc-jp"));}?>','maps','width=640,height=540')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a> </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["ensen_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["ensen"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left">¸òÄÌ </div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php

														if($bsetdata["ensen_view"]==1) {

														?>
                                            <?php if($re1data["eki"]!=NULL) { echo $re1data["eki"]."±Ø";}
																		 if($re1data["ensen"]!=NULL) {echo "[".$re1data["ensen"]."]";}
																		 if($re1data["ekiho"]!=NULL) {echo " ÅÌÊâ ".$re1data["ekiho"]." Ê¬";}
																			if($re1data["kyori"]!=NULL) {echo " µ÷Î¥ ".$re1data["kyori"]."m";}
															}
														if($bsetdata["basu_view"]==1) {
														?>
                                            <?php
																				 if($re1data["basutei"]!=NULL) { echo "<br />".$re1data["basutei"];}
																		 if($re1data["basu"]!=NULL) {echo "[".$re1data["basu"]."Ê¬]";}
																		  if($re1data["basu_ho"]!=NULL) {echo " ÅÌÊâ ".$re1data["basu_ho"]." Ê¬";}?>
                                            <?php
															}
														if($bsetdata["kuruma_view"]==1) {
														?>
                                            <?php if($re1data["kuruma"]!=NULL) { echo "<br />¼Ö¤Ç".$re1data["kuruma"]."Ê¬";}
																		 ?>
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
																						if($bsetdata["kakaku_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["kakaku"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th width="100" align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left" class="st"><?php echo $bsetdata["kakaku_name"] ?></div>
                                                                </th>
                                                                <td align="left" valign="top" class="st">
                                                                    <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"bukken_detail_price\">".numberformat($re1data["kakaku"])."</span> <span class=\"bukken_detail_price_tani\">Ëü±ß</span>";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["syougakkouku_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
																						?>
                                                            <tr>
                                                                <th align="left" valign="top" bgcolor="#ECECFF" class="font14">
                                                                    <div align="left"><?php echo $bsetdata["syougakkouku_name"] ?> </div>
                                                                </th>
                                                                <td bgcolor="#FFFFFF" class="font12">
                                                                    <div align="left">
                                                                        <?php
														if(str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])!=NULL) {
																																																								echo str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])."¾®³Ø¹»";
																																																								}?>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["chuugakouku_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["chuugakouku_name"] ?></span></div>
                                                                </th>
                                                                <td bgcolor="#FFFFFF" class="font12">
                                                                    <div align="left">
                                                                        <?php
																																																								if(str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])!=NULL) {
																																																									echo str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])."Ãæ³Ø¹»";
																																																								}?>
                                                                        </div>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["menseki_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["menseki"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span><?php echo $bsetdata["menseki_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["menseki"]!=NULL) { echo $re1data["menseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["menseki"]*0.3025,2)."ÄÚ¡Ë";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["senyumenseki_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["senyumenseki"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="st"><?php echo $bsetdata["senyumenseki_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top" class="st">
                                                                    <?php if($re1data["senyumenseki"]!=NULL) { echo $re1data["senyumenseki"]."m<sup>2</sup>¡¡¡ÊÌó".number_format($re1data["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["shidoumenseki_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["shidoumenseki"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["shidoumenseki_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["shidoumenseki"]!=NULL) { echo $re1data["shidoumenseki"]."m<sup>2</sup>";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["kenpei_ritsu_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["kenpei_ritsu"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kenpei_ritsu_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["kenpei_ritsu"]!=NULL) {echo $re1data["kenpei_ritsu"]."%";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["youseki_ritsu_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["youseki_ritsu"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["youseki_ritsu_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["youseki_ritsu"]!=NULL) {echo $re1data["youseki_ritsu"]."%";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["kaisou_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["kaisou"]!=NULL||$re1data["chijoukaisou"]!=NULL||$re1data["chikakaisou"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kaisou_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["kaisou"]!=NULL) {echo $re1data["kaisou"]."³¬";} ?>
                                                                    <?php if($re1data["chijoukaisou"]!=NULL) {echo "ÃÏ¾å".$re1data["chijoukaisou"]."³¬";} ?>
                                                                    <?php if($re1data["chikakaisou"]!=NULL) {echo "ÃÏ²¼".$re1data["chikakaisou"]."³¬";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
																						}
																						}
																						?>
                                                            <?php
																						if($bsetdata["kouzou_view"]==1) {
																						if($bukkensetdata["nodata_view"]==1||$re1data["kouzou"]!=NULL) {
																						?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kouzou_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top"><?php echo $re1data["kouzou"] ?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["chiku_nen_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["chiku_nen"]!=NULL||$re1data["chiku_tsuki"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["chiku_nen_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top"><?php echo $re1data["chiku_nen"]."Ç¯".$re1data["chiku_tsuki"]."·î";?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["hosyoukin_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin_kikan"]!=NULL||$re1data["hosyoukin_kikan"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["hosyoukin_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php
																		if($re1data["hosyoukin_kikan"]!=NULL) { echo $re1data["hosyoukin_kikan"]."¥ö·î¡¡";}
																		if($re1data["hosyoukin_kakaku"]!=NULL){ echo $re1data["hosyoukin_kakaku"]."Ëü±ß";}
																		 ?>
                                                                </td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["kenrikin_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["kenrikin"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["kenrikin_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top">
                                                                    <?php if($re1data["kenrikin"]!=NULL){ echo numberformat($re1data["kenrikin"])."±ß";} ?>
                                                                </td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["chusyajou_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["chusyajou"]!=NULL||$re1data["chusya_ryoukin"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <th align="left" valign="top" bgcolor="#ECECFF">
                                                                    <div align="left"><span class="font14"><?php echo $bsetdata["chusyajou_name"] ?></span></div>
                                                                </th>
                                                                <td align="left" valign="top"><?php echo $re1data["chusyajou"]; ?>
                                                                        <?php
																				if($re1data["chusya_ryoukin"]!=NULL) {echo numberformat($re1data["chusya_ryoukin"])."±ß";}

																				?>
                                                                </td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                        </tbody>
                                                    </table>
                                                </td>
                                                <td width="50%" align="center" valign="top">
                                                    <table width="98%" border="0" align="right" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE">
                                                        <tbody>
                                                            <?php
if($bsetdata["tochi_kenri_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["tochi_kenri"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["tochi_kenri_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["tochi_kenri"];?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["toshikeikaku_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["toshikeikaku"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["toshikeikaku_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["toshikeikaku"];?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["youtochiiki_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["youtochiiki"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["youtochiiki_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["youtochiiki"]; ?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["chimoku_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["chimoku"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["chimoku_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["chimoku"];?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["chisei_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["chisei"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["chisei_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["chisei"]; ?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["kokudohou_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["kokudohou"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["kokudohou_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["kokudohou"]; ?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["syakuchikikan_chidai_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["syakuchikikan_chidai"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["syakuchikikan_chidai_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["syakuchikikan_chidai"]; ?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["zappi_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["zappi_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php
																																																				if($re1data["zappi2"]!=NULL) {
																																																					echo $re1data["zappi2"]."¡¡";
																																																				}
																																																				if($re1data["zappi"]!=NULL) {echo numberformat($re1data["zappi"])."±ß"; }?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["genkyou_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["genkyou_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php

																						if($osusumedata[$i]["genkyou"]=="¾¦ÃÌÃæ") {
																						?><font color="#FF0000">
        ¡Ú¾¦ÃÌÃæ¡Û</font>
        <?php
																						}
																						else if($osusumedata[$i]["genkyou"]=="À®ÌóºÑ") {
																						?><font color="#FF0000">
        ¡ÚÀ®ÌóºÑ¡Û</font>
        <?php
																						}
																						else {

																echo $re1data["genkyou"];
																}?></td>
                                                            </tr>
                                                            <?php
}
}
?>
                                                            <?php
if($bsetdata["hikiwatashi_view"]==1) {
if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi"]!=NULL) {
?>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["hikiwatashi_name"] ?></span></td>
                                                                <td align="left" valign="top"><?php echo $re1data["hikiwatashi"] ?>
                                                                        <?php if($re1data["hikiwatashi_nen"]!=NULL) {echo $re1data["hikiwatashi_nen"]."Ç¯";} ?>
                                                                        <?php if($re1data["hikiwatashi_tsuki"]!=NULL) {echo $re1data["hikiwatashi_tsuki"]."·î";} ?>
                                                                        <?php echo $re1data["hikiwatashi_syun"] ?></td>
                                                            </tr>
                                                            <?php
}
}
?><?php
														if($bsetdata["setsudou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["setsudou_joukyou"]!=NULL||$re1data["setsudou1"]!=NULL||$re1data["setsudou2"]!=NULL||$re1data["setsudou3"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <td valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["setsudou_name"] ?></div>
                                            </td>
                                            <td valign="top">
                                                <div align="left">
                                                    <table border="0" cellspacing="0" cellpadding="3">
                                                        <?php
																								if($re1data["setsudou_joukyou"]!=NULL) {
																								?>
                                                        <tr>
                                                            <td>¾õ¶·</td>
                                                            <td> <?php echo $re1data["setsudou_joukyou"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou1=str_replace(" ","",$re1data["setsudou1"]);
																								$setsudou1=str_replace("¡¡","",$setsudou1);

																								if(trim($setsudou1)!=NULL&&trim($setsudou1)!="m"&&trim($setsudou1)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»1</td>
                                                            <td> <?php echo $re1data["setsudou1"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou2=str_replace(" ","",$re1data["setsudou2"]);
																								$setsudou2=str_replace("¡¡","",$setsudou2);

																								if(trim($setsudou2)!=NULL&&trim($setsudou2)!="m"&&trim($setsudou2)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»2</td>
                                                            <td> <?php echo $re1data["setsudou2"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou3=str_replace(" ","",$re1data["setsudou3"]);
																								$setsudou3=str_replace("¡¡","",$setsudou3);

																								if(trim($setsudou3)!=NULL&&trim($setsudou3)!="m"&&trim($setsudou3)!="0m") {
																								?>
                                                        <tr>
                                                            <td>ÀÜÆ»3</td>
                                                            <td> <?php echo $re1data["setsudou3"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
																					$setsubi_othernum=$re1data["setsubi_other1"]+$re1data["setsubi_other2"]+$re1data["setsubi_other3"]+$re1data["setsubi_other4"]+$re1data["setsubi_other5"]+$re1data["setsubi_other6"]+$re1data["setsubi_other7"]+$re1data["setsubi_other8"]+$re1data["setsubi_other9"]+$re1data["setsubi_other10"];

														if($setsubi_othernum>0) {
														?><tr bgcolor="#ffffff">
                                                            <td align="left" valign="top" nowrap="nowrap" bgcolor="#ECECFF">µëÇÓ¿å¡¦¥¬¥¹</td>
                                                            <td align="left"><?php if($re1data["setsubi_other1"]==1){ ?>
                                                                  ¾å¿åÆ»
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other2"]==1){ ?>
                                                                    °æ¸Í
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other3"]==1){ ?>
                                                                   ²¼¿åÆ» <?php }?>
                                                                    <?php if($re1data["setsubi_other4"]==1){ ?>
                                                                    ¾ô²½Áå
<?php }?>
                                                                    <?php if($re1data["setsubi_other5"]==1){ ?>
                                                                  µâ¼è
                                                                    <?php }?><br>
                                                                    <?php if($re1data["setsubi_other6"]==1){ ?>
                                                                    ÅÔ»Ô¥¬¥¹ <?php }?>
                                                                    <?php if($re1data["setsubi_other7"]==1){ ?>
                                                                    ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other8"]==1){ ?>
                                                                    ½¸Ãæ¥×¥í¥Ñ¥ó¥¬¥¹<?php }?>
                                                                    <?php if($re1data["setsubi_other9"]==1){ ?>
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other10"]==1){ ?>
                                                                    <?php }?>
                                                            </td>
                                                        </tr><?php
																																																								}

														if($re1data["torihikitaiyou"]!=NULL) {
														?>
                                                        <tr bgcolor="#ffffff">
                                                            <td align="left" nowrap="nowrap" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></span></td>
                                                            <td align="left"><?php echo $re1data["torihikitaiyou"];?></td>
                                                        </tr>
																																																								<?php
																																																								}
																																																								?>                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF">È÷¹Í</td>
                                                                <td align="left" valign="top"><?php echo $re1data["bikou"]; ?></td>
                                                            </tr>
                                                            <tr bgcolor="#ffffff">
                                                                <td width="100" align="left" valign="top" bgcolor="#ECECFF">ÅÐÏ¿Æü</td>
                                                                <td align="left" valign="top"><?php echo $re1data["tourokubi"]; ?></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <br />
                        <br />
                        <div>
                            <div align="center">
                                <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <?php
										if($re1data["madorizu2"]!=NULL||$re1data["photo2"]!=NULL||$re1data["photo3"]!=NULL||$re1data["photo4"]!=NULL||$re1data["photo5"]!=NULL){
										?>
                                                <table width="98%" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#CCCCEE">
                                                    <tbody>
                                                        <tr bgcolor="#eec2bb">
                                                            <td width="50%" bgcolor="#ECECFF">
                                                                <div align="center"><?php echo $bsetdata["madorizu_name"] ?></div>
                                                            </td>
                                                            <td width="50%" bgcolor="#ECECFF">
                                                                <div align="center"><?php echo $bsetdata["photo_name"] ?></div>
                                                            </td>
                                                        </tr>
                                                        <tr bgcolor="#ffffff">
                                                            <td valign="top" bgcolor="#ffffff">
                                                                <div align="center"> <a href="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["madorizu2"])."?".time(); ?>" rel="lightbox">
                                                                    <?php
																																																																												if($re1data["madorizu2"]!=NULL){
																																												 ?>
                                                                    <img src="<?php  echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"]."?".time(); ?>" border="0" />
                                                                    <?php
																																												 }
																																												 ?>
                                                                </a></div>
                                                            </td>
                                                            <td>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php
										}
										?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table border="0" align="right" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_list2.jpg" width="28" height="25" /></td>
                                                    <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_list1.jpg" width="59" height="4" /></td>
                                                    <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_list3.jpg" width="13" height="25" /></td>
                                                </tr>
                                                <tr>
                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">°ìÍ÷¤ËÌá¤ë</a></td>
                                                </tr>
                                                <tr>
                                                    <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_list4.jpg" width="59" height="4" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td width="11"><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="28" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact1.jpg" width="28" height="25" /></td>
                                                    <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_back_cibtact2.jpg" width="156" height="4" /></td>
                                                    <td width="13" rowspan="3"><img src="/img_f/ver2/btm_back_cibtact3.jpg" width="13" height="25" /></td>
                                                </tr>
                                                <tr>
                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">¤³¤ÎÊª·ï¤ÎÌä¤¤¹ç¤ï¤»¤ò¤¹¤ë</a></td>
                                                </tr>
                                                <tr>
                                                    <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_back_cibtact4.jpg" width="156" height="4" /></td>
                                                </tr>
                                            </table>
                                            <a href=" contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>'"></a></td>
                                        <td><img src="/img_f/ver2/bd_spacer.jpg" width="11" height="25" /></td>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="34" rowspan="3"><img src="/img_f/ver2/btm_print1.jpg" width="34" height="25" /></td>
                                                    <td background="/img_f/ver2/btm_back_list1.jpg"><img src="/img_f/ver2/btm_print2.jpg" width="49" height="4" /></td>
                                                    <td width="13" rowspan="3"><img src="/img_f/ver2/btm_print3.jpg" width="17" height="25" /></td>
                                                </tr>
                                                <tr>
                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">°õºþ¤¹¤ë</a></td>
                                                </tr>
                                                <tr>
                                                    <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                            </div>
                        </div>
                        <?php
}

?>
                    </td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table></div>
<?php
include "CUBE/Fudousan/template/footer.php";
?>
</body>
</html>
