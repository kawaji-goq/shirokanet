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
$linkobj=new Links($dbobj);
if($_GET["cate_id"]==NULL) {
	$_GET["cate_id"]=1;
}
$cateddata=$linkobj->GetDetailsCate($_GET["cate_id"]);

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
}?><title><?php echo $tenpodata["pagetitle"];?> / リンク <?php echo $cateddata["cate_name"];?></title>
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

.left2 {	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	font-weight: bolder;
	color: #000000;
}
.text {	font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
}
.st {	font-size:14px;
	font-weight:bold;
}
.text1 {font-family: "ＭＳ Ｐゴシック", Osaka, "ヒラギノ角ゴ Pro W3";
	font-size: 12px;
	line-height: 18px;
	color: #333333;
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
            <table width="768" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="558" valign="top">
                        <table width="556" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3" width="556"><img src="img/link/TopicsHeader.jpg" width="558" height="41" /></td>
                            </tr>
                            <tr>
                                <td width="18" background="img/link/TopicsLeft.jpg"><img src="img/link/TopicsLeft.jpg" width="20" height="43" /></td>
                                <td width="508">
                                    <table width="512" border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="30" colspan="2" style="font-size:16px;color:#666666;font-weight:bold;"><?php echo $cateddata["cate_name"];?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><img src="img/link/TopicsLine.jpg" width="507" height="13" /></td>
                                        </tr>
                                        <?php
/*-------------------　リンクデータ一覧　-------------------*/
//この部分は変更しないでください。 


$linkdatalist=$linkobj->GetSubDataList($_GET["cate_id"]);
for($linkdatarow=0;$linkdatalist[$linkdatarow];$linkdatarow++){ 
$linkdata=new Ary_Viewer($linkdatalist[$linkdatarow]);
/*-------------------　リンクデータ一覧↓　-------------------*/
?>
                                        <tr>
                                            <td width="14"><img src="img/link/link_icon.jpg" width="16" height="18" /></td>
                                            <td width="502" class="title"> <a href="<?php $linkdata->Moji("url") ?>" target="_blank">
                                                <?php $linkdata->Moji("data_name") ?>
                                            </a> </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td class="text1">
                                                <?php $linkdata->Moji("data_comm") ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><img src="img/link/TopicsLine.jpg" width="507" height="13" /></td>
                                        </tr>
                                        <?php 
/*-------------------　リンクデータ一覧↑　-------------------*/
}
/*-------------------　リンクデータ一覧 終了-------------------*/
?>
                                    </table>
                                </td>
                                <td width="22" background="img/link/TopicsRight.jpg"><img src="img/link/TopicsRight.jpg" width="24" height="43" /></td>
                            </tr>
                            <tr>
                                <td colspan="3" width="556"><img src="img/link/TopicsFoot.jpg" width="558" height="27" /></td>
                            </tr>
                        </table>
                        <br />
                    </td>
                    <td width="210" align="right" valign="top">
                        <table width="210" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td colspan="3"><img src="img/link/TopicsList.jpg" width="210" height="41" /></td>
                            </tr>
                            
                            <tr>
                                <td width="19" background="img/link/TopicsMenuLeft.jpg"><img src="img/link/TopicsMenuLeft.jpg" width="19" height="20" /></td>
                                <td width="163" valign="top">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <?php
/*-------------------　リンクカテゴリ一覧 開始-------------------*/
$linkcatedata=$dbobj->GetList("select * from link_cate where view_chk=1 order by turn");
for($linkrow=0;$linkcatedata[$linkrow];$linkrow++){ 
$linkddata=new Ary_Viewer($linkcatedata[$linkrow]);
/*-------------------　リンクカテゴリ一覧↓　-------------------*/
?>
                                        <tr>
                                            <td width="14" height="20" valign="top"><img src="img/link/linkcatebox_icon.jpg" width="14" height="16" /></td>
                                            <td width="175" height="20" align="left" valign="middle" class="cate_title"><a href="?cate_id=<?php echo $linkcatedata[$linkrow]["cate_id"];?>"><?php echo $linkcatedata[$linkrow]["cate_name"];?></a></td>
                                        </tr>
                                        <?php 
/*-------------------　リンクカテゴリ一覧↑　-------------------*/
}
/*-------------------　リンクカテゴリ一覧 終了-------------------*/
?>
                                    </table>
                                </td>
                                <td width="28" background="img/link/TopicsMenuRight.jpg"><img src="img/link/TopicsMenuRight.jpg" width="28" height="20" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><img src="img/link/TopicsMenuFoot.jpg" width="210" height="21" /></td>
                            </tr>
                        </table>
                        <br />
                    </td>
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
