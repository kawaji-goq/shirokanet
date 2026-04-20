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
}?>
<title><?php echo $tenpodata["pagetitle"];?> / 物件を買う</title>
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
<?php
switch($_REQUEST["cid"]) {
	case 4:
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =4");
?>
<div class="search_link">
    <table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
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
                                                                        <option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
                                                                        <option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
                                                                        <option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
                                                                        <option value="4"
                                                                        <?php if($_SESSION["madori"]==4){echo " selected";}?>>
                                                                            4ＤＫ以上</option>
                                                                        <option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>指定無し</option>
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
                                                                        <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
                                                                    </select>
                                                                </td>
                                                                <td><img src="img/bukken/BukkenSearchKakaku.jpg" width="49" height="23" /></td>
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
                                                                    <input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
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
                                    <td width="184" height="30" bgcolor="#FFFFFF"><font color="#FF6600">●戸建て・マンション物件一覧 </font></td>
                                    <td width="400" bgcolor="#FFFFFF">&nbsp;</td>
                                    <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td colspan="3" bgcolor="#FFFFFF">
                                        <table border="0" align="center" cellpadding="3" cellspacing="0">
                                            <tr>
                                                <td width="100" nowrap="nowrap">
                                                    <div align="right">
                                                        <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]>1){  ?><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a><?php }?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div align="center">
                                                        <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo "　".$prows."　";
			}
			else {
		  		echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
			}
		  
		  }
}				?>
                                                    </div>
                                                </td>
                                                <td width="100" nowrap="nowrap">
                                                    <div align="left">
                                                        <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                                        <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
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
                                    <th width="10%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><?php echo $bsetdata["photo_name"] ?></th>
                                    <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=madori<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>,mnum<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>"><?php echo $bsetdata["madori_name"] ?></a><strong><br />
                                    </strong></span><?php echo $bsetdata["senyumenseki_name"] ?></th>
                                    <th width="28%" bgcolor="#EBEBEB">
                                        <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                                    </th>
                                    <th colspan="2" bgcolor="#EBEBEB">
                                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                    </th>
                                    <th width="12%" rowspan="2" bgcolor="#EBEBEB">
                                        <div align="center">詳細</div>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="28%" bgcolor="#EBEBEB" class="font12">
                                        <div align="center"><strong><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></span></strong></div>
                                    </th>
                                    <th width="18%" align="center" bgcolor="#EBEBEB" class="font12"> <?php echo $bsetdata["youtochiiki_name"] ?></th>
                                    <th width="18%" align="center" bgcolor="#EBEBEB" class="font12"> <?php echo $bsetdata["chiku_nen_name"] ?></th>
                                </tr>
                                <tr>
                                    <td colspan="6" bgcolor="#FFFFFF"></td>
                                </tr>
                                <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                                <tr>
                                    <td width="10%" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"> <a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                                        <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='70'>";
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
                                       </span> <br />
                                        <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup><br />（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";}else{ echo "-";}?>
                                    </td>
                                    <td width="28%" align="left" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?></td>
                                    <td colspan="2" bgcolor="#FFFFFF" class="font12">
                                        <div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
                                                <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                                                <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
                                        </div>
                                    </td>
                                    <td rowspan="2" align="center" bgcolor="#FFFFFF"><a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">詳細</a></td>
                                </tr>
                                <tr>
                                    <td align="right" bgcolor="#FFFFFF" class="font12">
                                        <div align="center">
                                            <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td>
                                                        <div align="right">
                                                            <?php 
																																																												if($re1data[$re1rows]["kakaku"]!=NULL) {
																																																												echo "<span class=\"list_price\">";
																																																												echo numberformat($re1data[$re1rows]["kakaku"]);
																																																												echo "</span><span class=\"list_price_tani\">万円</span>"; 
																																																												}else {
																																																													echo "-";
																																																												}?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                    <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["youtochiiki"]; ?></td>
                                    <td align="center" bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data[$re1rows]["chiku_nen"]!=NULL){ echo $re1data[$re1rows]["chiku_nen"]."年";}else{ echo "-";} ?>
                                    </td>
                                </tr>
                                <?php 
														}
														?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
        </tr>
    </table>
		  <?php
		break;
		case 5:
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
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
                                                            <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
                                                        </select>
                                                    </td>
                                                    <td><img src="img/bukken/BukkenSearchKakaku.jpg" width="49" height="23" /></td>
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
                                                        <input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
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
                        <td width="184" height="30" bgcolor="#FFFFFF"><font color="#FF6600">●土地物件一覧 </font></td>
                        <td width="400" bgcolor="#FFFFFF">&nbsp;</td>
                        <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3" bgcolor="#FFFFFF">
                            <table border="0" align="center" cellpadding="3" cellspacing="0">
                                <tr>
                                    <td width="100" nowrap="nowrap">
                                        <div align="right">
                                            <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]>1){  ?>
                                            <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a>
                                            <?php }?>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo "　".$prows."　";
			}
			else {
		  		echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
			}
		  
		  }
}				?>
                                        </div>
                                    </td>
                                    <td width="100" nowrap="nowrap">
                                        <div align="left">
                                            <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                            <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
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
                        <th width="15%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><?php echo $bsetdata["photo_name"] ?></th>
                        <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB">
                            <div align="center"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=menseki<?php if($_SESSION["sort"]=="menseki") { echo " desc";}?>"><?php echo $bsetdata["menseki_name"] ?></a></span></div>
                        </th>
                        <th width="26%" bgcolor="#EBEBEB">
                            <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                        </th>
                        <th colspan="2" bgcolor="#EBEBEB">
                            <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                        </th>
                        <th width="11%" rowspan="2" bgcolor="#EBEBEB">
                            <div align="center">詳細</div>
                        </th>
                    </tr>
                    <tr>
                        <th width="26%" align="right" bgcolor="#EBEBEB" class="st">
                            <div align="center"><strong><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a><br />
                              </strong></div>
                        </th>
                        <th width="17%" bgcolor="#EBEBEB" class="font12">
                            <div align="center"><?php echo $bsetdata["syumoku_name"] ?></div>
                        </th>
                        <th width="17%" bgcolor="#EBEBEB" class="font12">
                            <div align="center"><?php echo $bsetdata["chimoku_name"] ?></div>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                    </tr>
                    <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                    <tr>
                        <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                            <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='70'>";
}
else {
?>
                            <img src="/img/noimage_120_120.gif" width="70" border="0" />
                            <?php
}
?>
                          </a></td>
                        <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><span class="st">
                            <?php if($re1data[$re1rows]["menseki"]!=NULL) {echo $re1data[$re1rows]["menseki"]."m<sup>2</sup><br />（約".number_format($re1data[$re1rows]["menseki"]*0.3025,2)."坪）";}else{ echo "-";}?>
                          </span></td>
                        <td bgcolor="#FFFFFF"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?></td>
                        <td colspan="2" align="center" bgcolor="#FFFFFF" class="font12"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
                              <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                              <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
                        </td>
                        <td rowspan="2" align="center" bgcolor="#FFFFFF"><a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" >詳細</a></td>
                    </tr>
                    <tr>
                        <td align="right" bgcolor="#FFFFFF" class="st">
                            <div align="center">
                                <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            <div align="right">
                                                <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                        <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["syumoku"]; ?></td>
                        <td align="center" bgcolor="#FFFFFF" class="font12">
                            <?php if($re1data[$re1rows]["chimoku"]!=NULL){ echo $re1data[$re1rows]["chimoku"];}else{ echo "-";} ?>
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
case 6:
		$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");

	?>
  <table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
          <td width="25" height="30" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
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
                      </td>
                  </tr>
                  <tr>
                      <td align="left" valign="top">
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
                                                                      <option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
                                                                  </select>
                                                              </td>
                                                              <td><img src="img/bukken/BukkenSearchKakaku.jpg" width="49" height="23" /></td>
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
                                                                  <input name="cid" type="hidden" id="cid" value="<?php echo $_SESSION["cid"];?>" />
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
                      </td>
                  </tr>
                  <tr>
                      <td height="30" align="left" valign="middle">
                          <table width="768"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
                              <tr>
                                  <td width="184" bgcolor="#FFFFFF"><font color="#FF6600">●事業用物件一覧 </font></td>
                                  <td width="400" bgcolor="#FFFFFF">&nbsp;</td>
                                  <td width="184" bgcolor="#FFFFFF">&nbsp;</td>
                              </tr>
                              <tr>
                                  <td colspan="3" bgcolor="#FFFFFF">
                                      <table border="0" align="center" cellpadding="3" cellspacing="0">
                                          <tr>
                                              <td width="100" nowrap="nowrap">
                                                  <div align="right">
                                                      <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]>1){  ?>
                                                      <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a>
                                                      <?php }?>
                                                  </div>
                                              </td>
                                              <td>
                                                  <div align="center">
                                                      <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo "　".$prows."　";
			}
			else {
		  		echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
			}
		  
		  }
}				?>
                                                  </div>
                                              </td>
                                              <td width="100" nowrap="nowrap">
                                                  <div align="left">
                                                      <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                                      <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
                                                      <?php } ?>
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                                </tr>
                          </table>
                      </td>
                  </tr>
                  <tr>
                      <td align="left" valign="top">
                          <table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" class="bukkentablelist">
                              <tr bgcolor="#FFFFFF" class="font12">
                                  <th width="11%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB"><strong><?php echo $bsetdata["photo_name"] ?></strong></th>
                                  <th width="14%" rowspan="2" align="center" valign="middle" bgcolor="#EBEBEB">
                                      <div align="center"><span class="st"><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=senyumenseki<?php if($_SESSION["sort"]=="senyumenseki") { echo " desc";}?>"><?php echo $bsetdata["senyumenseki_name"] ?></a></span></div>
                                  </th>
                                  <th width="28%" bgcolor="#EBEBEB">
                                      <div align="center" class="st"><a href="?cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&amp;sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                                  </th>
                                  <th colspan="2" bgcolor="#EBEBEB">
                                      <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                                  </th>
                                  <th width="11%" rowspan="2" bgcolor="#EBEBEB">
                                      <div align="center">詳細</div>
                                  </th>
                              </tr>
                              <tr>
                                  <th width="28%" bgcolor="#EBEBEB" class="st">
                                      <div align="center"><strong><a href="?cid=<?php echo $_SESSION["cid"];?>&amp;sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></strong></div>
                                  </th>
                                  <th width="18%" bgcolor="#EBEBEB" class="font12">
                                      <div align="center"><?php echo $bsetdata["syumoku_name"] ?><br />
                                              <?php echo $bsetdata["kouzou_name"] ?></div>
                                  </th>
                                  <th width="18%" bgcolor="#EBEBEB" class="font12">
                                      <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                                  </th>
                              </tr>
                              <tr>
                                  <td colspan="6" align="center" valign="middle" bgcolor="#FFFFFF"></td>
                              </tr>
                              <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
                              <tr>
                                  <td width="11%" rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF"><a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                                      <?php
if(@file_exists("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='70'>";
}
else {
?>
                                      <img src="/img/noimage_120_120.gif" width="70" border="0" />
                                      <?php
}
?>
                                  </a></td>
                                  <td rowspan="2" align="center" valign="middle" bgcolor="#FFFFFF">
                                     <span class="st"> <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup><br />（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";}else{ echo "-";}?></span>                                  </td>
                                  <td bgcolor="#FFFFFF" ><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"]; if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];}?></td>
                                  <td colspan="2" bgcolor="#FFFFFF" class="font12">
                                      <div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
                                              <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                                              <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
                                                  </div>
                                  </td>
                                  <td rowspan="2" bgcolor="#FFFFFF">
                                      <div align="center"><a href="baibai_d.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>" >詳細</a></div>
                                  </td>
                              </tr>
                              <tr>
                                  <td align="right" bgcolor="#FFFFFF" class="st">
                                      <table width="75%" border="0" align="left" cellpadding="0" cellspacing="0">
                                          <tr>
                                              <td>
                                                  <div align="right">
                                                      <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?>
                                                  </div>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                                  <td align="center" bgcolor="#FFFFFF" class="font12"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
                                          <?php echo $re1data[$re1rows]["kouzou"]; ?></td>
                                  <td align="center" bgcolor="#FFFFFF" class="font12">
                                      <?php if($re1data[$re1rows]["chiku_nen"]!=NULL){ echo $re1data[$re1rows]["chiku_nen"]."年";}else{ echo "-";} ?>
                                  </td>
                              </tr>
                              <?php
																						}
																						?>
                          </table>
                      </td>
                  </tr>
              </table>
          </td>
          <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg">&nbsp;</td>
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
                                              <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a>
                                              <?php }?>
                                          </div>
                                      </td>
                                      <td>
                                          <div align="center">
                                              <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo "　".$prows."　";
			}
			else {
		  		echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
			}
		  
		  }
}				?>
                                          </div>
                                      </td>
                                      <td width="100" nowrap="nowrap">
                                          <div align="left">
                                              <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                                              <a href="?cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
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
</div>
</body>
</html>
