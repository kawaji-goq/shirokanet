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

		$dbobj->user="goq";//
			$dbobj->pass="itc2011";
	}
$dbobj->Connect();
$tenpodata=$dbobj->GetData("select * from tenpo_data");

$re1obj=new RealEstate($dbobj);
$qaobj=new Site_QA($dbobj);

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
<meta name="robots" content="noindex,nofollow">¡£
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?> / ¤è¤¯¤¢¤ë¼ÁÌä</title>
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

.left2 {	font-family: "£Í£Ó £Ð¥´¥·¥Ã¥¯", Osaka, "¥Ò¥é¥®¥Î³Ñ¥´ Pro W3";
	font-size: 12px;
	font-weight: bolder;
	color: #000000;
}
.text {	font-family: "£Í£Ó £Ð¥´¥·¥Ã¥¯", Osaka, "¥Ò¥é¥®¥Î³Ñ¥´ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
.st {	font-size:14px;
	font-weight:bold;
}
-->
</style>
</head>
<body>
<?php
include "CUBE/Fudousan/template/header.php";
?><div id="qanda">
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="678" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3"><img src="img/qanda/QandAHeader.jpg" width="768" height="57" /></td>
                </tr>
                <tr>
                    <td width="49" rowspan="5" background="img/company/ConpanyLeft.jpg"><img src="img/qanda/QandALeft.jpg" width="49" height="154" /></td>
                    <td width="675">
                        <table width="673" cellpadding="5" cellspacing="1">
                            <?php
/****************************************************************/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ÎÉ¤¯¤¢¤ë¼ÁÌä°ìÍ÷³«»Ï¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­*/
if($_GET["cate_id"]==NULL){
	$_GET["cate_id"]=0;
}
$qadatadata=$qaobj->GetDataList(1,$lim,$setnum,$orderby); 
for($qarow=0;$qadatadata[$qarow];$qarow++){ 
$qadata=new Ary_Viewer($qadatadata[$qarow]);

?>
                            
                            <tr>
                                <td width="35" valign="top"><img src="img/qanda/QandAQIcon.jpg" width="35" height="21" /></td>
                                <td width="618" valign="top" class="q">
                                    <?php $qadata->Moji("data_name"); ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td width="35" valign="top"><img src="img/qanda/QandAAIcon.jpg" width="35" height="21" /></td>
                                <td width="618" class="a"><?php echo $qadatadata[$qarow]["data_comm"]; ?></td>
                            </tr>
                            <tr>
                                <td colspan="2" background="img/qanda/line.jpg" height="10"></td>
                            </tr>
                            <?php 
}
/*¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡ÎÉ¤¯¤¢¤ë¼ÁÌä¥«¥Æ¥´¥ê°ìÍ÷½ªÎ»¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/****************************************************************/
?>
                        </table>
                    </td>
                    <td width="46" rowspan="5" background="img/qanda/QandARight.jpg"> <img src="img/qanda/QandARight.jpg" width="46" height="144" /></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="3"><img src="img/qanda/QandAfooter.jpg" width="768" height="40" /></td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
</div>
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
