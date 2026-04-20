<?php
include "initial.php";
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$newbsql="select * from bukken where del_chk <> 1 order by tourokubi desc limit 20";
$osusumedata=$dbobj->GetList($newbsql);
$osusumedata=$dbobj->GetList("select * from bukken where osusume=1 and del_chk<>1");

	function syubetsuchk($bunrui,$syumoku) {
	switch($bunrui) {
		case 1:
			switch($syumoku) {
				case "¥¢¥Ñ¡¼¥È":
					return "";
					break;
				case "¥Þ¥ó¥·¥ç¥ó":
					return "";
					break;
				case "Âß²È":
					return 2;
					break;
				case "¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 2;
					break;
				case "¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 2;
					break;
				case "´Ö¼Ú¤ê":
					return 2;
					break;
				case "Å¹ÊÞ¡Ê°ì¸Í·ú¡Ë":
					return 3;
					break;
				case "Å¹ÊÞ¡Ê·úÊª°ìÉô¡Ë":
					return 3;
					break;
				case "»öÌ³½ê":
					return 3;
					break;
				case "Å¹ÊÞ¡¦»öÌ³½ê":
					return 3;
					break;
				case "¹©¾ì":
					return 3;
					break;
				case "ÁÒ¸Ë":
					return 3;
					break;
				case "¥Þ¥ó¥·¥ç¥ó":
					return 3;
					break;
				case "Î¹´Û":
					return 3;
					break;
				case "ÎÀ":
					return 3;
					break;
				case "ÊÌÁñ":
					return 3;
					break;
				case "ÅÚÃÏ":
					return 3;
					break;
				case "¥Ó¥ë":
					return 3;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ¡Ê°ì¸Í·ú¡Ë":
					return 3;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ¡Ê·úÊª°ìÉô¡Ë":
					return 3;
					break;
				case "¤½¤ÎÂ¾":
					return 3;
					break;
			}	
		break;
		case 2:
			switch($syumoku) {
				case "¿·ÃÛ°ì¸Í·ú½»Âð":
					return 4;
					break;
				case "Ãæ¸Å°ì¸Í·ú½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 4;
					break;
				case "Ãæ¸Å¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 4;
					break;
				case "¿·ÃÛ¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "Ãæ¸Å¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "¿·ÃÛ¸øÃÄ½»Âð":
					return 4;
					break;
				case "Ãæ¸Å¸øÃÄ½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¸ø¼Ò½»Âð":
					return 4;
					break;
				case "Ãæ¸Å¸ø¼Ò½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "Ãæ¸Å¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "Ãæ¸Å¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "ÇäÃÏ":
					return 5;
					break;
				case "¼ÚÃÏ¸¢¾ùÅÏ":
					return 5;
					break;
				case "ÄìÃÏ¸¢¾ùÅÏ":
					return 5;
					break;
				case "Å¹ÊÞ":
					return 6;
					break;
				case "Å¹ÊÞÉÕ½»Âð":
					return 6;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ":
					return 6;
					break;
				case "»öÌ³½ê":
					return 6;
					break;
				case "Å¹ÊÞ»öÌ³½ê":
					return 6;
					break;
				case "Å¹ÊÞ¡¦»öÌ³½ê":
					return 6;
					break;
				case "¥Ó¥ë":
					return 6;
					break;
				case "¹©¾ì":
					return 6;
					break;
				case "ÁÒ¸Ë":
					return 6;
					break;
				case "ÎÀ":
					return 6;
					break;
				case "Î¹´Û":
					return 6;
					break;
				case "¥Û¥Æ¥ë":
					return 6;
					break;
				case "ÊÌÁñ":
					return 6;
					break;
				case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
					return 6;
					break;
				case "¤½¤ÎÂ¾":
					return 6;
					break;
			}		
		break;
	}
}

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
		$_SESSION["page"]="";
	}
	$_SESSION["cid"]=$_GET["cid"];
}

$re1obj->type=$_SESSION["cid"];
$re1data=$re1obj->GetReList(2,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);

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
}?>
<title><?php echo $tenpodata["pagetitle"];?> / ¤ª¤¹¤¹¤áÊª·ï</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
.st{
	font-size:14px;
	font-weight:bold;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
-->
</style>
</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?>

<div class="search_link">
    <table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
            <td align="left" valign="top">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="img/template/TopOsusumeHeader2.jpg" width="768" height="33" /></td>
                    </tr>
                    <tr>
                        <td width="20" background="img/top/TopContentsLeft.jpg">&nbsp;</td>
                        <td width="728">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                            <table width="720" border="0" align="right" cellpadding="0" cellspacing="0" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
																												<?php
																												for($i=0;$osusumedata[$i]["id"]!=NULL;$i+=4) {
																												
																												?>
                                <tr>
                                    <td width="180" valign="top">
                                        <?php 
																																								if($osusumedata[$i]["id"]!=NULL) {
																																								?>
                                        <table border="0" align="center" cellpadding="0" cellspacing="0" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"> <a href="<?php if($osusumedata[$i]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$i]["bunrui"],$osusumedata[$i]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$i]["id"]; ?><?php }else if($osusumedata[$i]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$i]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[$i]["id"]."/".$osusumedata[$i]["photo1"])&&$osusumedata[$i]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[$i]["id"]."/".$osusumedata[$i]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$osusumedata[$i]["jyusyo1"].$osusumedata[$i]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[$i]["jyusyo1"].$osusumedata[$i]["jyusyo2"];?>" /></a><a href="<?php if($osusumedata[$i]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$i]["bunrui"],$osusumedata[$i]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$i]["id"]; ?><?php }else if($osusumedata[$i]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$i]["id"]; }?>">
                                                    <?php
}
?>
                                                    </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td>
                                                          <?php 
																						if($osusumedata[$i]["bunrui"]==1) {
																						?>
                                                          <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                          <?php
																						}
																						else {
																						?>
                                                          <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                          <?php
																						}
																						?>
                                                        </td>
                                                        <td>
                                                          <div align="center"> <font color="#FF0000">
                                                            <?php 
																						if($osusumedata[$i]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
        ¡Ú¾¦ÃÌÃæ¡Û
        <?php
																						}
																						else if($osusumedata[$i]["genkyou"]=="À®ÌóºÑ") {
																						?>
        ¡ÚÀ®ÌóºÑ¡Û
        <?php
																						}
																						?>
                                                        </font></div></td>
                                                      </tr>
                                                    </table></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right" class="osusumebukkenprice<?php echo $osusumedata[$i]["bunrui"];?>"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[$i]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[$i]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[$i]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[$i]["eki"]!=NULL) {echo $osusumedata[$i]["eki"]."±Ø";} ?>[<?php echo $osusumedata[$i]["ensen"];?>]</td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php 
																																															if($osusumedata[$i]["banchichk"]){
																																																$jyusyo[$i]=mb_convert_kana($osusumedata[$i]["jyusyo1"].$osusumedata[$i]["jyusyo2"].$osusumedata[$i]["jyusyo3"],"K","euc-jp");
																																																}
																																																else {
																																																				$jyusyo[$i]=mb_convert_kana($osusumedata[$i]["jyusyo1"].$osusumedata[$i]["jyusyo2"],"K","euc-jp");
																																																}
																																																echo chunk_split($jyusyo[$i],26,"<br>");
																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[$i]["madori"]!=NULL&&$osusumedata[$i]["madori"]!=0){echo $osusumedata[$i]["madori"].$osusumedata[$i]["madori_tani"];}else if($osusumedata[$i]["senyumenseki"]!=NULL) {echo $osusumedata[$i]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[$i]["menseki"]!=NULL) {echo $osusumedata[$i]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php if($osusumedata[$i+1]["id"]!=NULL) {?>
                                        <table border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[$i+1]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$i+1]["bunrui"],$osusumedata[$i+1]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$i+1]["id"]; ?><?php }else if($osusumedata[$i+1]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$i+1]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[$i+1]["id"]."/".$osusumedata[$i+1]["photo1"])&&$osusumedata[$i+1]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[$i+1]["id"]."/".$osusumedata[$i+1]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$osusumedata[$i+1]["jyusyo1"].$osusumedata[$i+1]["jyusyo2"]."\" />";
}
else {
?><img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[$i+1]["jyusyo1"].$osusumedata[$i+1]["jyusyo2"];?>" /><?php
}
?></a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" border="0" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td>
                                                      <?php 
																						if($osusumedata[$i+1]["bunrui"]==1) {
																						?>
                                                      <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						else {
																						?>
                                                      <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						?>
                                                    </td>
                                                    <td>
                                                      <div align="center"> <font color="#FF0000">
                                                        <?php 
																						if($osusumedata[$i+1]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
        ¡Ú¾¦ÃÌÃæ¡Û
        <?php
																						}
																						else if($osusumedata[$i+1]["genkyou"]=="À®ÌóºÑ") {
																						?>
        ¡ÚÀ®ÌóºÑ¡Û
        <?php
																						}
																						?>
                                                    </font></div></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[$i+1]["bunrui"];?>" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[$i+1]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[$i+1]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[$i+1]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[$i+1]["eki"]!=NULL) {echo $osusumedata[$i+1]["eki"]."±Ø";} ?>[<?php echo $osusumedata[$i+1]["ensen"];?>]</td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php 
																																																if($osusumedata[$i+1]["banchichk"]){
																																																				$jyusyo[$i+1]=mb_convert_kana($osusumedata[$i+1]["jyusyo1"].$osusumedata[$i+1]["jyusyo2"].$osusumedata[$i+1]["jyusyo3"],"K","euc-jp");
																																																}
																																																else {
																																																				$jyusyo[$i+1]=mb_convert_kana($osusumedata[$i+1]["jyusyo1"].$osusumedata[$i+1]["jyusyo2"],"K","euc-jp");
																																																}
																																																echo chunk_split($jyusyo[$i+1],26,"<br>");;

																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[$i+1]["madori"]!=NULL&&$osusumedata[$i+1]["madori"]!=0){echo $osusumedata[$i+1]["madori"].$osusumedata[$i+1]["madori_tani"];}else if($osusumedata[$i+1]["senyumenseki"]!=NULL) {echo $osusumedata[$i+1]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[$i+1]["menseki"]!=NULL) {echo $osusumedata[$i+1]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php if($osusumedata[$i+2]["id"]!=NULL) {?>
                                        <table border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[$i+2]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$i+2]["bunrui"],$osusumedata[$i+2]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$i+2]["id"]; ?><?php }else if($osusumedata[$i+2]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$i+2]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[$i+2]["id"]."/".$osusumedata[$i+2]["photo1"])&&$osusumedata[$i+2]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[$i+2]["id"]."/".$osusumedata[$i+2]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$osusumedata[$i+2]["jyusyo1"].$osusumedata[$i+2]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[$i+2]["jyusyo1"].$osusumedata[$i+2]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td>
                                                      <?php 
																						if($osusumedata[$i+2]["bunrui"]==1) {
																						?>
                                                      <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						else {
																						?>
                                                      <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						?>
                                                    </td>
                                                    <td>
                                                      <div align="center"> <font color="#FF0000">
                                                        <?php 
																						if($osusumedata[$i+2]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
        ¡Ú¾¦ÃÌÃæ¡Û
        <?php
																						}
																						else if($osusumedata[$i+2]["genkyou"]=="À®ÌóºÑ") {
																						?>
        ¡ÚÀ®ÌóºÑ¡Û
        <?php
																						}
																						?>
                                                    </font></div></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[$i+2]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[$i+2]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[$i+2]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[$i+2]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[$i+2]["eki"]!=NULL) {echo $osusumedata[$i+2]["eki"]."±Ø";} ?>[<?php echo $osusumedata[$i+2]["ensen"];?>]</td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php 
																																																if($osusumedata[$i+2]["banchichk"]){
																																																				$jyusyo[$i+2]=mb_convert_kana($osusumedata[$i+2]["jyusyo1"].$osusumedata[$i+2]["jyusyo2"].$osusumedata[$i+2]["jyusyo3"],"K","euc-jp");
																																																}
																																																else {
																																																				$jyusyo[$i+2]=mb_convert_kana($osusumedata[$i+2]["jyusyo1"].$osusumedata[$i+2]["jyusyo2"],"K","euc-jp");
																																																}
																																																echo chunk_split($jyusyo[$i+2],26,"<br>");

																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[$i+2]["madori"]!=NULL&&$osusumedata[$i+2]["madori"]!=0){echo $osusumedata[$i+2]["madori"].$osusumedata[$i+2]["madori_tani"];}else if($osusumedata[$i+2]["senyumenseki"]!=NULL) {echo $osusumedata[$i+2]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[$i+2]["menseki"]!=NULL) {echo $osusumedata[$i+2]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php if($osusumedata[$i+3]["id"]!=NULL) {?>
                                        <table border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[$i+3]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$i+3]["bunrui"],$osusumedata[$i+3]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$i+3]["id"]; ?><?php }else if($osusumedata[$i+3]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$i+3]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[$i+3]["id"]."/".$osusumedata[$i+3]["photo1"])&&$osusumedata[$i+3]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[$i+3]["id"]."/".$osusumedata[$i+3]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$osusumedata[$i+3]["jyusyo1"].$osusumedata[$i+3]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[$i+3]["jyusyo1"].$osusumedata[$i+3]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td>
                                                      <?php 
																						if($osusumedata[$i+3]["bunrui"]==1) {
																						?>
                                                      <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						else {
																						?>
                                                      <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                      <?php
																						}
																						?>
                                                    </td>
                                                    <td>
                                                      <div align="center"> <font color="#FF0000">
                                                        <?php 
																						if($osusumedata[$i+3]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
        ¡Ú¾¦ÃÌÃæ¡Û
        <?php
																						}
																						else if($osusumedata[$i+3]["genkyou"]=="À®ÌóºÑ") {
																						?>
        ¡ÚÀ®ÌóºÑ¡Û
        <?php
																						}
																						?>
                                                    </font></div></td>
                                                  </tr>
                                                </table></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[$i+3]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[$i+3]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[$i+3]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[$i+3]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[$i+3]["eki"]!=NULL) {echo $osusumedata[$i+3]["eki"]."±Ø";} ?>[<?php echo $osusumedata[$i+3]["ensen"];?>]</td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php 
																																																if($osusumedata[$i+3]["banchichk"]){
																																																				$jyusyo[$i+3]=mb_convert_kana($osusumedata[$i+3]["jyusyo1"].$osusumedata[$i+3]["jyusyo2"].$osusumedata[$i+3]["jyusyo3"],"K","euc-jp");
																																																}
																																																else {
																																																				$jyusyo[$i+3]=mb_convert_kana($osusumedata[$i+3]["jyusyo1"].$osusumedata[$i+3]["jyusyo2"],"K","euc-jp");
																																																}
																																																echo chunk_split($jyusyo[$i+3],26,"<br>");

																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[$i+3]["madori"]!=NULL&&$osusumedata[$i+3]["madori"]!=0){echo $osusumedata[$i+3]["madori"].$osusumedata[$i+3]["madori_tani"];}else if($osusumedata[$i+3]["senyumenseki"]!=NULL&&$osusumedata[$i+3]["senyumenseki"]!=0) {echo $osusumedata[$i+3]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[$i+3]["menseki"]!=NULL) {echo $osusumedata[$i+3]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="3" colspan="4">&nbsp;</td>
                                </tr>
																																<?php
																																}
																																?>
                            </table>
                        </td>
                        <td width="20" background="img/top/TopContentsRight.jpg">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="img/top/TopContentsBottom.jpg" width="768" height="13" /></td>
                    </tr>
                </table>
            </td>
            <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
        </tr>
    </table>
		<?php
include "CUBE/Fudousan/template/footer.php";
?>
</div>
</body>
</html>
