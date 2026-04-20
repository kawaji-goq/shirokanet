<?php
session_start();
ini_set("display_errors",1);
$_SERVER["DOCUMENT_ROOT"] = "/home/xb658521/sougou-net.jp/public_html/";

include $_SERVER["DOCUMENT_ROOT"]."/CUBE/Fudousan/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/CUBE/ITC/modules.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	
	$dbobj=Cube_DB :: UseDB('mysql');
	
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
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
}?><title><?php echo $tenpodata["pagetitle"];?> / Êª·ï¤ò¼Ú¤ê¤ë</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<style type="text/css">
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
</style>
</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?>
<?php
switch($_REQUEST["cid"]) {
	case 1:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");

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
		  
		            <table width="768" border="0" cellpadding="0" cellspacing="0">
		                <form id="form1" name="form1" method="post" action="">
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
                                                  <td><img src="img/bukken/BukkenSearchMadori.jpg" width="67" height="23" /></td>
                                                  <td>
                                                      <select id="madori" name="madori">
                                                          <option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1£Ò,£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
                                                          <option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
                                                          <option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3£Ä£Ë,£Ì£Ä£Ë</option>
                                                          <option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4£Ä£Ë°Ê¾å</option>
                                                          <option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>»ØÄêÌµ¤·</option>
                                                      </select>
                                                  </td>
                                                  <td><img src="img/bukken/BukkenSearchChiiki.jpg" width="39" height="23" /></td>
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
                                                          <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
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
                                                      <input name="cid" type="hidden" id="cid" value="1" />
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
		  
            <table width="768"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
              
                <tr>
                    <td width="184" height="30" bgcolor="#FFFFFF"><font color="#FF6600">¡ü¥¢¥Ñ¡¼¥È¡¦¥Þ¥ó¥·¥ç¥óÊª·ï°ìÍ÷ </font></td>
                    <td width="400" bgcolor="#FFFFFF">
                        <div align="center"></div>
                    </td>
                    <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" bgcolor="#FFFFFF">
                        <table border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                                <td width="100" nowrap="nowrap">
                                    <div align="right">
                                        <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;¡¡Á°¤Î10·ï </a>
                                        <?php }?>
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <?php 
if($maxpage>1&&$maxpage!=NULL&&$maxpage!=0){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
			}
			else {
		  		echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
			}
		  
		  }
}				?>
                                    </div>
                                </td>
                                <td width="100" nowrap="nowrap">
                                    <div align="left">
                                        <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> ¼¡¤Î10·ï¡¡&gt;&gt;</a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
		  
		          <table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="bukkentablelist">
                <tr bgcolor="#FFFFFF" class="font12">
                    <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><?php echo $bsetdata["photo_name"] ?></th>
                    <th width="13%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=madori<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>,mnum<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>"><?php echo $bsetdata["madori_name"] ?></a><br />
                    </span><?php echo $bsetdata["senyumenseki_name"] ?></th>
                    <th width="23%" bgcolor="#EBEBEB">
                        <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                    </th>
                    <th colspan="3" bgcolor="#EBEBEB">
                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                    </th>
                    <th width="11%" rowspan="2" bgcolor="#EBEBEB">
                        <div align="center">¾ÜºÙ</div>
                    </th>
                </tr>
                <tr>
                    <th width="23%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></span><br />
                        <?php echo $bsetdata["kanrihi_name"] ?></div>
                    </th>
                    <th width="13%" align="center" bgcolor="#EBEBEB" class="font12"><?php echo $bsetdata["reikin_name"] ?><br />
                    <?php echo $bsetdata["shikikin_name"] ?></th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center">
                            <p><?php echo $bsetdata["syumoku_name"] ?><br />
                            <?php echo $bsetdata["kouzou_name"] ?></p>
                        </div>
                    </th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                    </th>
                </tr>
                <tr>
                    <td colspan="7" bgcolor="#FFFFFF"></td>
                </tr>
                <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                <tr>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"> <a href="chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                        <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("","",$fdata["basename"])."' border='0' width='70'>";
}
else {
?>
                        <img src="/img/noimage_120_120.gif" width="70" border="0" />
                        <?php
}
?>
                    </a></td>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="st">
                        <?php 
																														if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0) {
																														echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"]; }else{ echo "-";}?>
                        <br />
                        </span>
                        <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup><br />¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?>
                    </td>
                    <td width="23%" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></td>
                    <td colspan="3" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
                            <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                            <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
                        </div>
                    </td>
                    <td rowspan="2" align="center" bgcolor="#FFFFFF">
                        <div align="center">
                            <div align="center"><a href="chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" >¾ÜºÙ</a></div>
                        <a href="chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" ></a></div>
                    <a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>"></a></td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#FFFFFF" class="font12">
                        <div align="center">
                            <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div align="right">
                                            <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?><br />
                                            <?php 
																				if($re1data[$re1rows]["kanrihi"]!=NULL) {
																				?>
                                            <?php echo numberformat($re1data[$re1rows]["kanrihi"]); ?>±ß
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
                        </div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <?php if($re1data[$re1rows]["reikin"]!=NULL){echo $re1data[$re1rows]["reikin"]."¥ö·î ";} ?>
                        <?php 
																																		if($re1data[$re1rows]["reikin_tani"]!=NULL){
																																		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
																																		}
																																		?>
                        <br />
                        <?php 
																																		if($re1data[$re1rows]["shikikin"]!=NULL){
																																			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
																																			}
																																			 ?>
                        <?php 
																																		if($re1data[$re1rows]["sikikintani"]!=NULL){
																																			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
																																		}?>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
                        <?php echo $re1data[$re1rows]["kouzou"]; ?></div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                                <?php 
																																								if($re1data[$re1rows]["chiku_nen"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_nen"]."Ç¯";
																																								}
																																									if($re1data[$re1rows]["chiku_tsuki"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_tsuki"]."·î";
																																								} ?> 
                    </td>
                </tr>
                <?php 
														}
														?>
            </table>
		  </td>
		  <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
		</tr>
</table>
<?php 

break;
case 2:
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =2");

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
        
            <table width="768" border="0" cellpadding="0" cellspacing="0">
                <form id="form1" name="form1" method="post" action="">
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
                                                <td><img src="img/bukken/BukkenSearchMadori.jpg" width="67" height="23" /></td>
                                                <td>
                                                    <select id="madori" name="madori">
                                                        <option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1£Ò,£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
                                                        <option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2£Ë,£Ä£Ë,£Ì£Ä£Ë</option>
                                                        <option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3£Ä£Ë,£Ì£Ä£Ë</option>
                                                        <option value="4"
                                                            <?php if($_SESSION["madori"]==4){echo " selected";}?>>
                                                            4£Ä£Ë°Ê¾å</option>
                                                        <option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>»ØÄêÌµ¤·</option>
                                                    </select>
                                                </td>
                                                <td><img src="img/bukken/BukkenSearchChiiki.jpg" width="39" height="23" /></td>
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
                                                        <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
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
                                                    <input name="cid" type="hidden" id="cid" value="2" />
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
            <table width="768"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
                <tr>
                    <td width="184" height="30" bgcolor="#FFFFFF"><font color="#FF6600">¡ü¸Í·ú¤ÆÊª·ï°ìÍ÷ </font></td>
                    <td width="400" bgcolor="#FFFFFF">
                        <div align="center"></div>
                    </td>
                    <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" bgcolor="#FFFFFF">
                        <table border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                                <td width="100" nowrap="nowrap">
                                    <div align="right">
                                        <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;¡¡Á°¤Î10·ï </a>
                                        <?php }?>
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
			}
			else {
		  		echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
			}
		  
		  }
}				?>
                                    </div>
                                </td>
                                <td width="100" nowrap="nowrap">
                                    <div align="left">
                                        <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> ¼¡¤Î10·ï¡¡&gt;&gt;</a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="bukkentablelist">
                <tr bgcolor="#FFFFFF" class="font12">
                    <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><?php echo $bsetdata["photo_name"] ?></th>
                    <th width="13%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=madori<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>,mnum<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>"><?php echo $bsetdata["madori_name"] ?></a><br />
                    </span><?php echo $bsetdata["senyumenseki_name"] ?></th>
                    <th width="23%" bgcolor="#EBEBEB">
                        <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                    </th>
                    <th colspan="3" bgcolor="#EBEBEB">
                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                    </th>
                    <th width="11%" rowspan="2" bgcolor="#EBEBEB">
                        <div align="center">¾ÜºÙ</div>
                    </th>
                </tr>
                <tr>
                    <th width="23%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></span><br />
                                <?php echo $bsetdata["kanrihi_name"] ?></div>
                    </th>
                    <th width="13%" align="center" bgcolor="#EBEBEB" class="font12"><?php echo $bsetdata["reikin_name"] ?><br />
                    <?php echo $bsetdata["shikikin_name"] ?></th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center">
                            <p><?php echo $bsetdata["syumoku_name"] ?><br />
                                    <?php echo $bsetdata["kouzou_name"] ?></p>
                        </div>
                    </th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                    </th>
                </tr>
                <tr>
                    <td colspan="7" bgcolor="#FFFFFF"></td>
                </tr>
                <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                <tr>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"> <a href="chintai_d2.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                        <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("","",$fdata["basename"])."' border='0' width='70'>";
}
else {
?>
                        <img src="/img/noimage_120_120.gif" width="70" border="0" />
                        <?php
}
?>
                    </a></td>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="st">
                        <?php 
																														if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0) {
																														echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"]; }else{ echo "-";}?>
                        <br />
                        </span>
                            <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup><br />¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?>
                    </td>
                    <td width="23%" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></td>
                    <td colspan="3" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
                                <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                                <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
                        </div>
                    </td>
                    <td rowspan="2" align="center" bgcolor="#FFFFFF">
                        <div align="center">
                            <div align="center"><a href="chintai_d2.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" >¾ÜºÙ</a></div>
                            <a href="chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" ></a></div>
                        <a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>"></a></td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#FFFFFF" class="font12">
                        <div align="center">
                            <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div align="right">
                                            <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".$re1data[$re1rows]["kakaku"]."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?>
                                            <br />
                                            <?php 
																				if($re1data[$re1rows]["kanrihi"]!=NULL) {
																				?>
                                            <?php echo number_format($re1data[$re1rows]["kanrihi"]); ?>±ß
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
                        </div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <?php if($re1data[$re1rows]["reikin"]!=NULL){echo $re1data[$re1rows]["reikin"]."¥ö·î ";} ?>
                        <?php 
																																		if($re1data[$re1rows]["reikin_tani"]!=NULL){
																																		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
																																		}
																																		?>
                        <br />
                        <?php 
																																		if($re1data[$re1rows]["shikikin"]!=NULL){
																																			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
																																			}
																																			 ?>
                        <?php 
																																		if($re1data[$re1rows]["sikikintani"]!=NULL){
																																			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
																																		}?>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
                                <?php echo $re1data[$re1rows]["kouzou"]; ?></div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <?php 
																																								if($re1data[$re1rows]["chiku_nen"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_nen"]."Ç¯";
																																								}
																																									if($re1data[$re1rows]["chiku_tsuki"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_tsuki"]."·î";
																																								} ?> 
                    </td>
                </tr>
                <?php 
														}
														?>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
<span class="search_link">
<?php 
		break;
		case 3:
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =3");
		
		?>
</span>
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
        
            <table width="768" border="0" cellpadding="0" cellspacing="0">
                <form id="form1" name="form1" method="post" action="">
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
                                                        <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>»ØÄêÌµ¤·</option>
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
                                                    <input name="page" type="hidden" id="page" value="1" />
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
        
            <table width="768"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
                <tr>
                    <td width="184" height="30" bgcolor="#FFFFFF"><font color="#FF6600">¡ü»ö¶ÈÍÑÊª·ï°ìÍ÷ </font></td>
                    <td width="400" bgcolor="#FFFFFF">
                        <div align="center"></div>
                    </td>
                    <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3" bgcolor="#FFFFFF">
                        <table border="0" align="center" cellpadding="3" cellspacing="0">
                            <tr>
                                <td width="100" nowrap="nowrap">
                                    <div align="right">
                                        <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;¡¡Á°¤Î10·ï </a>
                                        <?php }?>
                                    </div>
                                </td>
                                <td>
                                    <div align="center">
                                        <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
			}
			else {
		  		echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
			}
		  
		  }
}				?>
                                    </div>
                                </td>
                                <td width="100" nowrap="nowrap">
                                    <div align="left">
                                        <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> ¼¡¤Î10·ï¡¡&gt;&gt;</a>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        
            <table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="bukkentablelist">
                <tr bgcolor="#FFFFFF" class="font12">
                    <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><?php echo $bsetdata["photo_name"] ?></th>
                    <th width="13%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB" class="st"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=senyumenseki<?php if($_SESSION["sort"]=="senyumenseki") { echo " desc";}?>"><?php echo $bsetdata["senyumenseki_name"] ?></a></span></th>
                    <th width="23%" bgcolor="#EBEBEB">
                        <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                    </th>
                    <th colspan="3" bgcolor="#EBEBEB">
                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                    </th>
                    <th width="11%" rowspan="2" bgcolor="#EBEBEB">
                        <div align="center">¾ÜºÙ</div>
                    </th>
                </tr>
                <tr>
                    <th width="23%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></span><br />
                                <?php echo $bsetdata["kanrihi_name"] ?></div>
                    </th>
                    <th width="13%" align="center" bgcolor="#EBEBEB" class="font12"><?php echo $bsetdata["reikin_name"] ?><br />
                    <?php echo $bsetdata["shikikin_name"] ?></th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center">
                            <p><?php echo $bsetdata["syumoku_name"] ?><br />
                                    <?php echo $bsetdata["kouzou_name"] ?></p>
                        </div>
                    </th>
                    <th width="13%" bgcolor="#EBEBEB" class="font12">
                        <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                    </th>
                </tr>
                <tr>
                    <td colspan="7" bgcolor="#FFFFFF"></td>
                </tr>
                <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                <tr>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"> <a href="chintai_d3.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                        <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("","",$fdata["basename"])."' border='0' width='70'>";
}
else {
?>
                        <img src="/img/noimage_120_120.gif" width="70" border="0" />
                        <?php
}
?>
                    </a></td>
                    <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF" class="st"><span class="st">
                        <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup><br />¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";}else{ echo "-";}?></span>
                    </td>
                    <td width="23%" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></td>
                    <td colspan="3" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
                                <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                                <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "¡¦ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?>
                        </div>
                    </td>
                    <td rowspan="2" align="center" bgcolor="#FFFFFF">
                        <div align="center">
                            <div align="center"><a href="chintai_d3.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">¾ÜºÙ</a></div>
                            <a href="chintai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" ></a></div>
                        <a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>"></a></td>
                </tr>
                <tr>
                    <td align="right" bgcolor="#FFFFFF" class="font12">
                        <div align="center">
                            <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div align="right">
                                            <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".$re1data[$re1rows]["kakaku"]."</span><span class=\"list_price_tani\">Ëü±ß</span>"; }else {echo "-";}?>
                                            <br />
                                            <?php 
																				if($re1data[$re1rows]["kanrihi"]!=NULL) {
																				?>
                                            <?php echo number_format($re1data[$re1rows]["kanrihi"]); ?>±ß
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
                        </div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <?php if($re1data[$re1rows]["reikin"]!=NULL){echo $re1data[$re1rows]["reikin"]."¥ö·î ";} ?>
                        <?php 
																																		if($re1data[$re1rows]["reikin_tani"]!=NULL){
																																		echo $re1data[$re1rows]["reikin_tani"]."Ëü±ß";
																																		}
																																		?>
                        <br />
                        <?php 
																																		if($re1data[$re1rows]["shikikin"]!=NULL){
																																			echo $re1data[$re1rows]["shikikin"]."¥ö·î ";
																																			}
																																			 ?>
                        <?php 
																																		if($re1data[$re1rows]["sikikintani"]!=NULL){
																																			echo $re1data[$re1rows]["sikikintani"]."Ëü±ß";
																																		}?>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                        <div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
                                <?php echo $re1data[$re1rows]["kouzou"]; ?></div>
                    </td>
                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                                <?php 
																																								if($re1data[$re1rows]["chiku_nen"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_nen"]."Ç¯";
																																								}
																																									if($re1data[$re1rows]["chiku_tsuki"]!=NULL){ 
																																									echo $re1data[$re1rows]["chiku_tsuki"]."·î";
																																								} ?> 
                    </td>
                </tr>
                <?php 
														}
														?>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
<?php 
break;
}
?>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
				<td width="25" background="img/template/TemplateLeft.jpg">&nbsp;</td>
				<td bgcolor="#FFFFFF">
						<table width="700"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
								<tr>
										<td bgcolor="#FFFFFF">&nbsp;</td>
								</tr>
								<tr>
										<td bgcolor="#FFFFFF">
												<div align="center">
												    <table border="0" cellpadding="3" cellspacing="0">
                    <tr>
                        <td width="100" nowrap="nowrap">
                            <div align="right">
                                <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
                                <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;¡¡Á°¤Î10·ï </a>
                                <?php }?>
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo '¡¡<span class="nowpagenum">'.$prows.'</span>¡¡';
			}
			else {
		  		echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>¡¡";
			}
		  
		  }
}				?>
                            </div>
                        </td>
                        <td width="100" nowrap="nowrap">
                            <div align="left">
                                <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> ¼¡¤Î10·ï¡¡&gt;&gt;</a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                </table>
												</div>
										</td>
								</tr>
						</table>
						<div class="search_link"></div>
				<img src="img_f/spacer.jpg" width="10" height="13" /></td>
				<td width="25" background="img/template/TemplateRight.jpg">&nbsp;</td>
		</tr>
</table>
<?php
include "CUBE/Fudousan/template/footer.php";
?>
<map name="Map3" id="Map3">
  <area shape="rect" coords="16,3,94,38" href="index.php" />
  <area shape="rect" coords="95,3,181,39" href="#" />
  <area shape="rect" coords="183,3,269,39" href="#" />
  <area shape="rect" coords="270,3,382,39" href="#" />
</map>
</body>
</html>
