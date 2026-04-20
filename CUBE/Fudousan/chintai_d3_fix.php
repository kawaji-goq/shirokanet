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
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =3");
$tenpodata=$dbobj->GetData("select * from tenpo_data");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">。
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?> /賃貸<?php echo $re1data["syumoku"] ?> <?php echo $re1data["bukken_mei"] ?><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"] ?></title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.st{
	font-size:14px;
	font-weight:bold;
}
-->
</style><script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/prototype.js"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/lightbox.js"></script>
<link rel="stylesheet" href="/JSLIBS/lightbox/2.03.3/css/lightbox.css" type="text/css" media="screen" />

</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="768" border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="5"><img src="img/bukken/BukkenSearchCategoryHeader.jpg" width="768" height="39" /></td>
                </tr>
                <tr>
                    <td width="91" bgcolor="#FAFBFC"><img src="img/bukken/BukkenSearchCategoryRent.jpg" width="91" height="25" border="0" /></td>
                    <td width="286" bgcolor="#FAFBFC">
                        <p><a href="chintai.php?cid=1">・アパート・マンション</a>　<a href="chintai.php?cid=2">・戸建て</a>　<a href="chintai.php?cid=3">・事業用</a></p>
                    </td>
                    <td width="86" bgcolor="#FAFBFC"><img src="img/bukken/BukkenSearchCategoryBuy.jpg" width="86" height="25" /></td>
                    <td width="294" bgcolor="#FAFBFC"><a href="baibai.php?cid=4">・戸建て・マンション</a>　<a href="baibai.php?cid=6">・事業用物件</a>　<a href="baibai.php?cid=5">・土地</a></td>
                    <td width="11" align="right"><img src="img/bukken/BukkenSearchCategoryRight.jpg" width="11" height="25" /></td>
                </tr>
                <tr>
                    <td colspan="5"><img src="img/bukken/BukkenSearchCategoryFooter.jpg" width="768" height="6" /></td>
                </tr>
            </table>
            <table width="768" border="0" cellpadding="0" cellspacing="0">
                <form id="form1" name="form1" method="post" action="chintai.php">
                    <tr>
                        <td colspan="3"><img src="img/bukken/BukkenSearchHeader.jpg" width="768" height="40" /></td>
                    </tr>
                    <tr>
                        <td width="10" background="img/bukken/BukkenSearchLeft.jpg" bgcolor="#FAFBFC"><img src="img/bukken/BukkenSearchLeft.jpg" width="9" height="54" /></td>
                        <td width="747" bgcolor="#FAFBFC">
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td colspan="2">
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="67" align="right"><img src="img/bukken/BukkenSearchChiiki.jpg" width="39" height="23" /></td>
                                                <td>
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
                                                <td><img src="img/bukken/BukkenSearchChinryou.jpg" width="49" height="23" /></td>
                                                <td>
                                                    <input name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" size="8" />
                                                </td>
                                                <td><img src="img/bukken/BukkenSearchNami.jpg" width="19" height="23" /></td>
                                                <td>
                                                    <input id="hicost" size="8" name="hicost" value="<?php echo $_SESSION["hicost"];?>" />
                                                </td>
                                                <td><img src="img/bukken/BukkenSearchManen.jpg" width="30" height="23" /></td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="11%"><img src="img/bukken/BukkenSearchKeyword.jpg" width="67" height="20" /></td>
                                    <td width="136">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td>
                                                    <input name="keyword" id="keyword" size="40" value="<?php echo $_SESSION["keyword"];?>" />
                                                </td>
                                                <td>
                                                    <input name="cid" type="hidden" id="cid" value="3" />
                                                </td>
                                                <td>
                                                    <input type="image" name="seach_bukken" id="seach_bukken" src="img/bukken/kensaku.jpg" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="11" align="right" background="img/bukken/BukkenSearchRight.jpg"><img src="img/bukken/BukkenSearchRight.jpg" width="11" height="54" /></td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="img/bukken/BukkenSearchFooter.jpg" width="768" height="6" /></td>
                    </tr>
                </form>
            </table>
            <img src="/img_f/spacer.jpg" width="10" height="13" />
            <table width="100%" border="0" cellpadding="1" cellspacing="0" bgcolor="#FFFFFF">
                <tbody>
                    <tr>
                        <td>
                            <table cellspacing="0" cellpadding="0" width="100%" border="0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <table border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td width="20"><img src="/img_f/ver2/syuybetsu_bg1.jpg" width="20" height="25" /></td>
                                                    <td align="left" background="/img_f/ver2/syuybetsu_bg2.jpg"><strong><font color="#FFFFFF" class="bukken_detail_title">賃貸物件　<?php echo $re1data["syumoku"] ?></font><font color="#333333" class="bukken_detail_title"></font></strong></td>
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
                                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">一覧に戻る</a></td>
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
                                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">この物件の問い合わせをする</a></td>
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
                                                                    <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">印刷する</a></td>
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
            </table><div id="bukken">

            <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td colspan="2" bgcolor="#CCCCCC" height="1"></td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCEE" class="bukkentablelist">
                                <tr bgcolor="#FFFFFF" class="font12">
                                    <th width="17%" rowspan="2" align="center" valign="middle" bgcolor="#ECECFF"><span class="st"><?php echo $bsetdata["senyumenseki_name"] ?></span></th>
                                    <th width="30%" bgcolor="#ECECFF">
                                        <div align="center"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                    </th>
                                    <th colspan="3" bgcolor="#ECECFF">
                                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="30%" bgcolor="#ECECFF" class="font12">
                                        <div align="center"><span class="st"><?php echo $bsetdata["kakaku_name"] ?></span><br />
                                                <?php echo $bsetdata["kanrihi_name"] ?></div>
                                    </th>
                                    <th width="17%" align="center" bgcolor="#ECECFF" class="font12"><?php echo $bsetdata["reikin_name"] ?><br />
                                            <?php echo $bsetdata["shikikin_name"] ?></th>
                                    <th width="17%" bgcolor="#ECECFF" class="font12">
                                        <div align="center">
                                            <p><?php echo $bsetdata["syumoku_name"] ?><br />
                                                    <?php echo $bsetdata["kouzou_name"] ?></p>
                                        </div>
                                    </th>
                                    <th width="19%" bgcolor="#ECECFF" class="font12">
                                        <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                                    </th>
                                </tr>
                                <tr>
                                    <td colspan="5" bgcolor="#FFFFFF"></td>
                                </tr>
                                <tr>
                                    <td width="17%" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
                                      <span class="st">  <?php if($re1data["senyumenseki"]!=NULL) {echo $re1data["senyumenseki"]."m<sup>2</sup><br />（約".number_format($re1data["senyumenseki"]*0.3025,1)."坪）";}else{ echo "-";}?></span>                                    </td>
                                    <td width="30%" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data["jyusyo1"].$re1data["jyusyo2"];if($re1data["banchichk"]==1) {echo $re1data["jyusyo3"];} ?></td>
                                    <td colspan="3" bgcolor="#FFFFFF" class="font12">
                                        <div align="center"><?php if($re1data["eki"]!=NULL) {echo $re1data["eki"]."駅";} ?>
                                                <?php if($re1data["ensen"]!=NULL) {echo "(".$re1data["ensen"].")";} ?>
                                                <?php if($re1data["ekiho"]!=NULL) {echo "・徒歩".$re1data["ekiho"]."分";} ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#FFFFFF" class="font12">
                                        <table width="65%" border="0" align="left" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td>
                                                    <div align="right">
                                                        <?php if($re1data["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?><br />
                                                        <?php
																				if($re1data["kanrihi"]!=NULL) {
																				?>
                                                        <?php echo numberformat($re1data["kanrihi"]); ?>円
                                                        <?php
																								}
																								else {
																								echo "-";
																								}
																								?>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["reikin"]!=NULL){echo $re1data["reikin"]."ヶ月 ";} ?>
                                        <?php
																																		if($re1data["reikin_tani"]!=NULL){
																																		echo $re1data["reikin_tani"]."万円";
																																		}
																																		?>
                                        <br />
                                        <?php
																																		if($re1data["shikikin"]!=NULL){
																																			echo $re1data["shikikin"]."ヶ月 ";
																																			}
																																			 ?>
                                        <?php
																																		if($re1data["sikikintani"]!=NULL){
																																			echo $re1data["sikikintani"]."万円";
																																		}?>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                        <div align="center"><?php echo $re1data["syumoku"]; ?><br />
                                                <?php echo $re1data["kouzou"]; ?></div>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                        <?php
																																								if($re1data["chiku_nen"]!=NULL){
																																									echo $re1data["chiku_nen"]."年";
																																								}
																																									if($re1data["chiku_tsuki"]!=NULL){
																																									echo $re1data["chiku_tsuki"]."月";
																																								} ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2">
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
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="50%" valign="top">
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
                                        <th width="100" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["syumoku_name"] ?></div>
                                        </th>
                                        <td bgcolor="#ffffff"><?php echo $re1data["syumoku"] ?></td>
                                    </tr>
                                    <?php
																			}
																		}
																		?>
                                    <?php
																		if($bsetdata["jyusyo_view"]==1) {
																			if($bukkensetdata["nodata_view"]==1||$re1data["jyusyo1"]!=NULL||$re1data["jyusyo2"]!=NULL||$re1data["todouhuken"]!=NULL) {
																		?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["jyusyo_name"] ?></div>
                                        </th>
                                        <td bgcolor="#ffffff">
                                            <table cellspacing="1" cellpadding="1" width="100%" border="0">
                                                <tbody>
                                                    <tr>
                                                        <td height="20">
                                                            <?php
																												echo $re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"];
																												if($re1data["banchichk"]==1) {
																												echo $re1data["jyusyo3"];
																												} ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <a href="#" onclick="window.open('./mapout_fix.php?name=<?php echo urlencode(mb_convert_encoding($re1data["bukken_mei"],"utf8","euc-jp"));?>&amp;address=<?php echo urlencode(mb_convert_encoding($re1data["todouhuken"].$re1data["jyusyo1"].$re1data["jyusyo2"],"utf8","euc-jp"));if($re1data["banchichk"]==1) {echo urlencode(mb_convert_encoding($re1data["jyusyo3"],"utf8","euc-jp"));}?>','maps','width=640,height=540')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a></td>
                                    </tr>
                                    <?php
																			}
																		}
																		?>
                                    <?php
														if($bukkensetdata["nodata_view"]==1||$re1data["ensen"]!=NULL||$re1data["eki"]!=NULL||$re1data["ekiho"]!=NULL||$re1data["basutei"]!=NULL||$re1data["basu"]!=NULL||$re1data["basu_ho"]!=NULL||$re1data["kuruma"]!=NULL||$re1data["kyori"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left">交通 </div>
                                        </th>
                                        <td>
                                            <?php

														if($bsetdata["ensen_view"]==1) {

														?>
                                            <?php if($re1data["eki"]!=NULL) { echo $re1data["eki"]."駅";}
																		 if($re1data["ensen"]!=NULL) {echo "[".$re1data["ensen"]."]";}
																		 if($re1data["ekiho"]!=NULL) {echo " 徒歩 ".$re1data["ekiho"]." 分";}
																			if($re1data["kyori"]!=NULL) {echo " 距離 ".$re1data["kyori"]."m";}
															}
														if($bsetdata["basu_view"]==1) {
														?>
                                                            <?php
																				 if($re1data["basutei"]!=NULL) { echo "<br />バス停 ".$re1data["basutei"];}
																		 if($re1data["basu"]!=NULL) {echo "[乗車時間".$re1data["basu"]."分]";}
																		  if($re1data["basu_ho"]!=NULL) {echo " から徒歩 ".$re1data["basu_ho"]." 分";}
																				?>
                                                            <?php
															}
														if($bsetdata["kuruma_view"]==1) {
														?>
                                            <?php if($re1data["kuruma"]!=NULL) { echo "<br />車で".$re1data["kuruma"]."分";}
																		 ?>
                                            <?php
															}

														?>
                                        </td>
                                    </tr>
                                    <?php
														}
														?>
                                    <?php
														if($bsetdata["syougakkouku_view"]==1){
														if($bukkensetdata["nodata_view"]==1||str_replace("小学校","",$re1data["syougakkouku"])!=NULL) {
														?>
                                    <tr>
                                        <th width="100" valign="top" bgcolor="#ECECFF" class="font14">
                                            <div align="left"><?php echo $bsetdata["syougakkouku_name"] ?></div>
                                        </th>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <?php
														if(str_replace("小学校","",$re1data["syougakkouku"])!=NULL) {
																																																								echo str_replace("小学校","",$re1data["syougakkouku"])."小学校";
																																																								}?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["chuugakouku_view"]==1){
														if($bukkensetdata["nodata_view"]==1||str_replace("中学校","",$re1data["chuugakouku"])!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["chuugakouku_name"] ?></div>
                                        </th>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <?php
																																																								if(str_replace("中学校","",$re1data["chuugakouku"])!=NULL) {
																																																									echo str_replace("中学校","",$re1data["chuugakouku"])."中学校";
																																																								}?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["kakaku_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["kakaku"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" bgcolor="#ECECFF">
                                            <div align="left"><span class="st"><?php echo $bsetdata["kakaku_name"] ?></span></div>
                                        </th>
                                        <td bgcolor="#ffffff" class="st">
                                            <?php
																																												if($re1data["kakaku"]!=NULL) {
																																												echo "<span class=\"bukken_detail_price\">".numberformat($re1data["kakaku"])."</span> <span class=\"bukken_detail_price_tani\">万円</span>";
																																												} ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["menseki_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["menseki"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["menseki_name"] ?></div>
                                        </th>
                                        <td bgcolor="#ffffff">
                                            <?php if($re1data["menseki"]!=NULL) { echo $re1data["menseki"]."m<sup>2</sup>　（約".number_format($re1data["menseki"]*0.3025,2)."坪）";} ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["senyumenseki_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["senyumenseki"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left"><span class="st"><?php echo $bsetdata["senyumenseki_name"] ?></span></div>
                                        </th>
                                        <td>
                                           <span class="st"> <?php if($re1data["senyumenseki"]!=NULL) { echo $re1data["senyumenseki"]."m<sup>2</sup>　（約".number_format($re1data["senyumenseki"]*0.3025,2)."坪）";} ?></span>                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["chusyajou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["chusyajou"]!=NULL||$re1data["chusya_ryoukin"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["chusyajou_name"] ?></div>
                                        </th>
                                        <td><?php echo $re1data["chusyajou"]; ?>
                                                <?php
																				if($re1data["chusya_ryoukin"]!=NULL) {echo numberformat($re1data["chusya_ryoukin"])."円";}

																				?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["shikikin_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["shikikin"]!=NULL||$re1data["sikikintani"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["shikikin_name"] ?></div>
                                        </th>
                                        <td>
                                            <?php
																		if($re1data["shikikin"]!=NULL) { echo $re1data["shikikin"]."ヶ月　";}
																		if($re1data["sikikintani"]!=NULL){ echo $re1data["sikikintani"]."万円";}
																		 ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["reikin_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["reikin"]!=NULL||$re1data["reikin_tani"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["reikin_name"] ?></div>
                                        </th>
                                        <td>
                                            <?php
																		if($re1data["reikin"]!=NULL) { echo $re1data["reikin"]."ヶ月　";}
																		if($re1data["reikin_tani"]!=NULL){ echo $re1data["reikin_tani"]."万円";}
																		 ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["kanrihi_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["kanrihi"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th width="100" nowrap="nowrap" bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["kanrihi_name"] ?></div>
                                        </th>
                                        <td>
                                            <?php if($re1data["kanrihi"]!=NULL){ echo numberformat($re1data["kanrihi"])."円";} ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
																		if($bsetdata["kyouekihi_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["kyouekihi"]!=NULL) {
					?>
                                    <tr>
                                        <th align="right" valign="top" bgcolor="#ECECFF" class="font14">
                                            <div align="left"><?php echo $bsetdata["kyouekihi_name"] ?>
                                                <!--共益費 -->
                                            </div>
                                        </th>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <div align="left"><span class="realestate_bgcolor3">
                                                <?php if($re1data["kyouekihi"]!=NULL){ echo numberformat($re1data["kyouekihi"])."円";} ?>
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
                                            <div align="left"><?php echo $bsetdata["syuzenhi_tsumitate_name"] ?>
                                                <!--修繕積立金 -->
                                            </div>
                                        </th>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <div align="left">
                                                <?php if($re1data["syuzenhi_tsumitate"]!=NULL){ echo numberformat($re1data["syuzenhi_tsumitate"])."円";} ?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
					}
										}
					if($bsetdata["zappi_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["zappi"]!=NULL||$re1data["zappi2"]!=NULL) {
					?>
                                    <tr>
                                        <th align="right" valign="top" bgcolor="#ECECFF" class="font14">
                                            <div align="left"><?php echo $bsetdata["zappi_name"] ?>
                                                <!--その他利用料 -->
                                            </div>
                                        </th>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <div align="left"><?php
																																																				if($re1data["zappi2"]!=NULL) {
																																																					echo $re1data["zappi2"]."　";
																																																				}
																																																				if($re1data["zappi"]!=NULL) {echo numberformat($re1data["zappi"])."円"; }?>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
					}
					}

														if($bsetdata["hosyoukin_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["hosyoukin"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["hosyoukin_name"] ?></div>
                                        </th>
                                        <td>
                                            <?php
																		if($re1data["hosyoukin_kikan"]!=NULL) { echo $re1data["hosyoukin_kikan"]."ヶ月　";}
																		if($re1data["hosyoukin_kakaku"]!=NULL){ echo $re1data["hosyoukin_kakaku"]."万円";}
																		 ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["kenrikin_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["kenrikin"]!=NULL) {
														?>
                                    <tr bgcolor="#ffffff">
                                        <th bgcolor="#ECECFF">
                                            <div align="left"><?php echo $bsetdata["kenrikin_name"] ?></div>
                                        </th>
                                        <td>
                                            <?php if($re1data["kenrikin"]!=NULL){ echo numberformat($re1data["kenrikin"])."円";} ?>
                                        </td>
                                    </tr>
                                    <?php
																}
															}
															?>
                                    <?php
														if($bsetdata["tatemono_chintaisyaku_kubun_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["tatemono_chintaisyaku_kubun"]!=NULL) {
														?>
                                    <?php
																}
															}
															?>
                                </tbody>
                            </table>
                        </td>
                        <td width="50%" valign="top">
                            <div align="center">
                                <table width="98%" border="0" align="right" cellpadding="10" cellspacing="1" bgcolor="#CCCCEE" class="bukkentable">
                                    <tbody>
                                        <?php
														if($bsetdata["kaisou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["kaisou"]!=NULL||$re1data["chijoukaisou"]!=NULL||$re1data["chikakaisou"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th width="100" valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["kaisou_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left">
                                                    <?php if($re1data["kaisou"]!=NULL) {echo $re1data["kaisou"]."階";} ?>
                                                    <?php if($re1data["chijoukaisou"]!=NULL) {echo "地上".$re1data["chijoukaisou"]."階建";} ?>
                                                    <?php if($re1data["chikakaisou"]!=NULL) {echo "地下".$re1data["chikakaisou"]."階建";} ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
															?>
                                        <?php
														if($bsetdata["kouzou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["kouzou"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["kouzou_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php echo $re1data["kouzou"] ?></div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
															?>
                                        <?php
														if($bsetdata["chiku_nen_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["chiku_nen"]!=NULL||$re1data["chiku_tsuki"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th width="100" valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php
																		if($re1data["chiku_nen"]) {
																			echo $re1data["chiku_nen"]."年";
																		}
																		if($re1data["chiku_tsuki"]) {
																			echo $re1data["chiku_tsuki"]."月";
																		}?></div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
														if($bsetdata["chimoku_view"]==1) {
															if($bukkensetdata["nodata_view"]==1||$re1data["chimoku"]!=NULL) {
														?>
                                        <tr>
                                            <th valign="top" bgcolor="#ECECFF" class="font14">
                                                <div align="left"><?php echo $bsetdata["chimoku_name"] ?></div>
                                            </th>
                                            <td bgcolor="#FFFFFF" class="font12">
                                                <div align="left"><?php echo $re1data["chimoku"];?> </div>
                                            </td>
                                        </tr>
                                        <?php
														}
														}
														if($bsetdata["youtochiiki_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["youtochiiki"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th width="100" valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["youtochiiki_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php echo $re1data["youtochiiki"]; ?></div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
					if($bsetdata["toshikeikaku_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["toshikeikaku"]!=NULL) {
					?>
                                        <tr>
                                            <th valign="top" bgcolor="#ECECFF" class="font14">
                                                <div align="left"><?php echo $bsetdata["toshikeikaku_name"] ?></div>
                                            </th>
                                            <td bgcolor="#FFFFFF" class="font12">
                                                <div align="left"><?php echo $re1data["toshikeikaku"];?>&nbsp;</div>
                                            </td>
                                        </tr>
                                        <?php
					}
}
					if($bsetdata["tatemono_chintaisyaku_kubun_view"]==1) {
														if($bukkensetdata["nodata_view"]==1||$re1data["tatemono_chintaisyaku_kubun"]!=NULL) {
					?>
                                        <tr>
                                            <th valign="top" bgcolor="#ECECFF" class="font14">
                                                <div align="left"><?php echo $bsetdata["tatemono_chintaisyaku_kubun_name"] ?>
                                                    <!--賃貸借区分 -->
                                                </div>
                                            </th>
                                            <td bgcolor="#FFFFFF" class="font12">
                                                <div align="left"><?php echo $re1data["tatemono_chintaisyaku_kubun"];?> </div>
                                            </td>
                                        </tr>
                                        <?php
					}
					}
														if($bsetdata["genkyou_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["genkyou"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th width="100" valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["genkyou_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left">
                                                  <?php

																						if($osusumedata[$i]["genkyou"]=="商談中") {
																						?>
                                                  <font color="#FF0000"> 【商談中】</font>
                                                  <?php
																						}
																						else if($osusumedata[$i]["genkyou"]=="成約済") {
																						?>
                                                  <font color="#FF0000"> 【成約済】</font>
                                                  <?php
																						}
																						else {

																echo $re1data["genkyou"];
																}?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
																}
															}
															?>
                                        <?php
														if($bsetdata["hikiwatashi_view"]==1){
														if($bukkensetdata["nodata_view"]==1||$re1data["hikiwatashi_nen"]!=NULL||$re1data["hikiwatashi_tsuki"]!=NULL||$re1data["hikiwatashi_syun"]!=NULL) {
														?>
                                        <tr bgcolor="#ffffff">
                                            <th valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["hikiwatashi_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php echo $re1data["hikiwatashi"] ?>
                                                        <?php if($re1data["hikiwatashi_nen"]!=NULL) {echo $re1data["hikiwatashi_nen"]."年";} ?>
                                                        <?php if($re1data["hikiwatashi_tsuki"]!=NULL) {echo $re1data["hikiwatashi_tsuki"]."月";} ?>
                                                        <?php echo $re1data["hikiwatashi_syun"] ?></div>
                                            </td>
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
                                            <th valign="top" bgcolor="#ECECFF">
                                                <div align="left"><?php echo $bsetdata["setsudou_name"] ?></div>
                                            </th>
                                            <td valign="top">
                                                <div align="left">
                                                    <table border="0" cellspacing="0" cellpadding="3">
                                                        <?php
																								if($re1data["setsudou_joukyou"]!=NULL) {
																								?>
                                                        <tr>
                                                            <td>状況</td>
                                                            <td> <?php echo $re1data["setsudou_joukyou"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou1=str_replace(" ","",$re1data["setsudou1"]);
																								$setsudou1=str_replace("　","",$setsudou1);

																								if(trim($setsudou1)!=NULL&&trim($setsudou1)!="m"&&trim($setsudou1)!="0m") {
																								?>
                                                        <tr>
                                                            <td>接道1</td>
                                                            <td> <?php echo $re1data["setsudou1"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou2=str_replace(" ","",$re1data["setsudou2"]);
																								$setsudou2=str_replace("　","",$setsudou2);

																								if(trim($setsudou2)!=NULL&&trim($setsudou2)!="m"&&trim($setsudou2)!="0m") {
																								?>
                                                        <tr>
                                                            <td>接道2</td>
                                                            <td> <?php echo $re1data["setsudou2"];?> </td>
                                                        </tr>
                                                        <?php
																								}
																								?>
                                                        <?php
																								$setsudou3=str_replace(" ","",$re1data["setsudou3"]);
																								$setsudou3=str_replace("　","",$setsudou3);

																								if(trim($setsudou3)!=NULL&&trim($setsudou3)!="m"&&trim($setsudou3)!="0m") {
																								?>
                                                        <tr>
                                                            <td>接道3</td>
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
                                                            <th align="left" valign="top" nowrap="nowrap" bgcolor="#ECECFF">給排水・ガス</th>
                                                            <td align="left"><?php if($re1data["setsubi_other1"]==1){ ?>
                                                                  上水道
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other2"]==1){ ?>
                                                                    井戸
                                                                    <?php }?>
                                                                    <?php if($re1data["setsubi_other3"]==1){ ?>
                                                                   下水道 <?php }?>
                                                                    <?php if($re1data["setsubi_other4"]==1){ ?>
                                                                    浄化槽
<?php }?>
                                                                    <?php if($re1data["setsubi_other5"]==1){ ?>
                                                                  汲取
                                                                    <?php }?><br>
                                                                    <?php if($re1data["setsubi_other6"]==1){ ?>
                                                                    都市ガス <?php }?>
                                                                    <?php if($re1data["setsubi_other7"]==1){ ?>
                                                                    プロパンガス<?php }?>
                                                                    <?php if($re1data["setsubi_other8"]==1){ ?>
                                                                    集中プロパンガス<?php }?>
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
                                                            <th align="left" nowrap="nowrap" bgcolor="#ECECFF"><span class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></span></th>
                                                            <td align="left"><?php echo $re1data["torihikitaiyou"];?></td>
                                                        </tr>
																																																								<?php
																																																								}
																																																								?>
                                        <tr bgcolor="#ffffff">
                                            <th width="100" valign="top" bgcolor="#ECECFF">
                                                <div align="left">備考</div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php echo nl2br($re1data["bikou"]); ?></div>
                                            </td>
                                        </tr>
                                        <tr bgcolor="#ffffff">
                                            <th valign="top" bgcolor="#ECECFF">
                                                <div align="left">登録年月日</div>
                                            </th>
                                            <td valign="top">
                                                <div align="left"><?php echo $re1data["tourokubi"]; ?></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <a href="#" onclick="window.open('/photo.php?photo=<?php echo "/tmp/bukken_data/".$re1data["id"]."/".str_replace("300","",$re1data["photo1"]); ?>','photo')"><br />
                            </a></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" valign="top"><br />
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
										?>
</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <br />
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
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
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="history.back()">一覧に戻る</a></td>
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
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="contact.php?bid=<?php echo $_GET["bid"]; ?>&amp;rurl=<?php echo urlencode($PHP_SELF."?".$_SERVER['QUERY_STRING']);?>">この物件の問い合わせをする</a></td>
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
                                            <td height="17" background="/img_f/ver2/btm_back_list_bg.jpg"><a href="#" onclick="print()">印刷する</a></td>
                                        </tr>
                                        <tr>
                                            <td height="4" background="/img_f/ver2/btm_back_list4.jpg"><img src="/img_f/ver2/btm_print4.jpg" width="49" height="4" /></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>

<?php
include "CUBE/Fudousan/template/footer.php";
?>
</body>
</html>
