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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" /> 
<title>物件検索</title> 
<meta name="keywords" content="不動産,スマートフォン,物件.検索" /> 
<meta name="description" content="スマホで不動産物件検索" /> 
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no"/>
<style type="text/css">
<!--
.style1 {font-size: small}
-->
</style>
</head> 
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > 店舗情報</h1>

</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div>
<img src="img/main/ttl_company.jpg" width="100%" /></div>



<div id="button">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="50%" align="center" valign="middle"><a href="<?php echo $tenpodata["goaisatsuphoto"] ?>?<?php echo time();?>" rel="lightbox"><img src="<?php echo $tenpodata["goaisatsuphoto"] ?>?<?php echo time();?>" width="80%" border="0" /></a></td>
    <td width="50%" align="center" valign="middle"><a href="<?php echo $tenpodata["tenpophoto"] ?>?<?php echo time();?>" rel="lightbox"><img src="<?php echo $tenpodata["tenpophoto"] ?>?<?php echo time();?>" width="80%" border="0" /></a></td>
  </tr>
</table>




</div>
<div id="button"><a href="contact_it.php"><img src="img/main/contactbutton.jpg" width="45%" style="margin-top:2%;" /></a></div>
<div id="button">
<img src="img/main/company_t1.jpg" width="100%" /></div>

<div id="contents">
<p class="s">「土地・家屋の販売や、貸家・アパートの管理・斡旋・紹介」
など、地域に密着した最新の情報提供とお客様のニーズに対応したきめ細かな事業を展開しております。
  <br />
  常にお客様の立場に立って誠実と熱意をモットーにした経営は多くの皆様の信用と信頼を得ております。
  <br />
  不動産のことならなんでもお気軽にご相談下さい。
必ずや皆様のご期待・ご要望にお答えして参ります。</p></div>

<div id="button">
<img src="img/main/company_t2.jpg" width="100%" /></div>

<div id="contents">
  <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0" id="table-01">
    <tr>
      <td width="25%" align="left" valign="top" class="s style1">会社名</td>
      <td width="70%" align="left" valign="top" class="s style1">WebDesign　ITCube<br />
有限会社アイティーキューブ</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="s style1">所在地</td>
      <td align="left" valign="top" class="s style1">〒 730-0017<br />
        山口健岩国市今津町4-3-5<br />
        TEL <a href="tel:0827227310">0827-22-7310</a><br />
        FAX 0827-22-7310<br />
        http://itcube.jp<br />
        広島営業所<br />
        〒 730-0843<br />
        広島市中区舟入本町3-22<br />
        シンコウビル<br />
        TEL <a href="tel:0827227310">0827-22-7310</a><br />
        FAX 0827-22-7310<br />
      <a href="http://itcube.jp" target="_blank">http://itcube.jp</a></td>
    </tr>
    <tr>
      <td align="left" valign="top" class="s style1">E-mail</td>
      <td align="left" valign="top" class="s style1"><a href="mailto:info@itcube.jp">info@itcube.jp</a></td>
    </tr>
    <tr>
      <td align="left" valign="top" class="s style1">免許情報</td>
      <td align="left" valign="top" class="s style1">古物商許可証<br />
        [第741021000236号/山口県公安委員会]<br />
        質屋許可証<br />
      [第741020000004号/山口県公安委員会]</td>
    </tr>
    <tr>
      <td align="left" valign="top" class="s style1">その他</td>
      <td align="left" valign="top" class="s style1">&nbsp;</td>
    </tr>
  </table>
</div>

<div id="button">
<img src="img/main/company_t3.jpg" width="100%" /></div>

<div id="contents">
  <p><strong>係長　田中</strong></p>
  <p class="s"><br />
    
    家づくりは、人生最大のお買い物です。
    そんな大イベントをお手伝いさせて頂けることに、感謝の気持ちでいっぱいです。<br />
    まだまだ勉強すべきことがたくさんの私ですが、 どんな時も「笑顔」を忘れず、何事にも取組みたいと思います。
    <br />
    そしてお客様に、ご満足頂き、「笑顔」が絶えない家になるように・・・そんな家づくりが私の夢であり、務めだと考えています。</p>
</div>



<div id="footer">
<?php include"footer.html" ?>

</div>













</body> 
</html> 