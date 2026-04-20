<?php
session_start();
ini_set("display_errors",0);
//exit();
$_SESSION=$_SESSION;
mb_language("japanese");
mb_internal_encoding("euc-jp");
ini_set("session.gc_maxlifetime", "1440");
//有効期間を昔に 
header("Expires", "-1"); 
//通常のHTTP/1.1 no-cache ヘッダ 
header("Cache-Control", "no-store, no-cache, must-revalidate"); 
//IE用拡張ヘッダ 
header("Cache-Control", "post-check=0, pre-check=0"); 
//通常のHTTP/1.0 no-cache ヘッダ 
header("Pragma", "no-cache");

include "conf.php";
include "/tmp/CUBE/ITC/login.php";

$usedb="postgresql";
$adminobj=Cube_DB :: UseDB($usedb);
$adminobj->name="itcube_admin";
$adminobj->pass="itc2011";
$adminobj->user="goq";
$adminobj->Connect();
$loginobj=new Login($adminobj);


if($_COOKIE["login_id"]!=""){
	$_SESSION["login_id"]=$_COOKIE["login_id"];
}
if($_COOKIE["login_pass"]!=""){
	$_SESSION["login_pass"]=$_COOKIE["login_pass"];
}

if($_GET["logout"]==1){
	unset($_SESSION["login_id"],$_SESSION["login_pass"]);
	unset($_SESSION["loginmode"]);
	unset($_SESSION);
	unset($_COOKIE);
	session_unset($_SESSION["login_id"],$_SESSION["login_pass"],$_SESSION["loginmode"]);
	session_unset($_SESSION["GW"]);
	//$_SESSION="";
}
else {
	$_SESSION["login_id"]=$_SESSION["login_id"];
	$_SESSION["login_pass"]=$_SESSION["login_pass"];
	$expire = time() + 60*60*24*30; // 15分有効
	setcookie('login_id', $_SESSION["login_id"], $expire);
	setcookie('login_pass',$_SESSION["login_pass"], $expire);
}
if($_GET["loginid"]!=NULL||$_GET["password"]!=NULL) {
	
	$_SESSION["login_id"]=$_GET["loginid"];
	$_SESSION["login_pass"]=$_GET["password"];
	$expire = time() + 60*60*24*30; // 15分有効
	setcookie('login_id', $_GET["loginid"], $expire);
	setcookie('login_pass', $_GET["password"], $expire);
	
}

if(($_SESSION["login_id"]=="n-build.com"&&$_SESSION["login_pass"]=="itc7310")||($_SESSION["login_pass"]=="klvlmuwo"&&$_SESSION["login_id"]=="build.itcube.ne.jp")){
	
	$_SESSION["DomainData"]=$adminobj->GetData("select * from domain where domain_name = 'n-build.com'");
	$_SESSION["login_id"]="n-build.com";
	$_SESSION["login_pass"]="klvlmuwo";
}

if($loginobj->Check($_SESSION["login_id"],$_SESSION["login_pass"])==0){
	
	$dbobj=Cube_DB :: UseDB($_SESSION["DomainData"]["dbtype"]);
	
	$dbobj->name=$_SESSION["DomainData"]["dbname"];

		$dbobj->user="goq";
		$dbobj->pass="itc2011";
	//echo $dbobj->name;
	
	$dbobj->Connect();
	if($_SESSION["vacc"]==NULL){
		if($domaindata["dbtype"]=="postgresql"){
			$dbobj->Query("VACUUM");
			$_SESSION["vacc"]=time();
	
		}
	}

	$dbobj->Query("update lastupdate set lastupdate='".time()."'");

	$loginsql="select * from member where login_id = '".$_SESSION["login_id"]."' and login_pw = '".$_SESSION["login_pass"]."'";
	$loginresult=$dbobj->Query($loginsql);
	$loginresultnumrows=$dbobj->NumRows($loginresult);
	
	if($loginresultnumrows!=0) {
		$logindata=$dbobj->FetchArray($loginresult,0);
		$_SESSION["mem_id"]=$logindata["member_id"];
	}	
	
	$ad_company=new Admin_Company($dbobj);

	$comcate=$ad_company->GetCateList("",$lim,$setnum,$orderby);
	$comcatesep=$ad_company->ChangeLay($comcate,4);

	$menuobj=new Site_Menu($dbobj);
	$menudata=$menuobj->GetSelDataList();
	$fudousanchk=$dbobj->GetData("select * from options where options_id = 3");
	$promochk=$dbobj->GetData("select * from options where options_id = 4");
	$spotchk=$dbobj->GetData("select * from options where options_id = 5");
	$fudousan2chk=$dbobj->GetData("select * from options where options_id = 6");
	$fudousan3chk=$dbobj->GetData("select * from options where options_id = 7");
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$fudousanschk=$dbobj->GetData("select * from options where options_id = 1");
	$basicchk=$dbobj->GetData("select * from options where options_id = 2");	
	$newbasicchk=$dbobj->GetData("select * from options where options_id = 99");
	$newcmschk=$dbobj->GetData("select * from options where options_id = 100");
	$realestatechk=$dbobj->GetData("select * from options where options_id = 101");
echo $newcmschk["use_chk"]["use_chk"];
	if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="marunitech.co.jp") {
		$basicchk["use_chk"]=1;
	}
	if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="sejour.co.jp") {
		$sejourchk["use_chk"]=1;
	}
	
	function noreturn($txt) {
		return str_replace("\r","",str_replace("\n","",$txt));
	}

function converttxt($text) {

		global $nyear;
		$text=str_replace("\"/tmp/","\"http://stk.itcube.ne.jp/tmp/",$text);
		$text=str_replace("\"img/","\"/img/",$text);
		$text=str_replace("'/tmp/","'http://stk.itcube.ne.jp/tmp/",$text);
		$text=str_replace("'img/","'/img/",$text);
	
		$text=str_replace("href=\"/","href=\"",$text);
		$text=str_replace("href=\"stk_common.css","href=\"/stk_common.css",$text);
	
		for($i=0;substr_count($text,"topics_commentary.php?")!=0;$i++) {
			$spos=strpos($text,"topics_commentary.php",0);		
			$fpos=strpos($text,"\">",$spos);		
			$stxt=strstr($text,"topics_commentary.php");
			$otxt=str_replace($stxt,"",$text);
			$ftxt=strstr($stxt,"\">");
			$stxt=str_replace($ftxt,"",$stxt);
			
			$stxt=str_replace("?blog_id=","",$stxt);
			$stxt=str_replace("topics_commentary.php","topics_commentary",$stxt);
			$text=$otxt.$stxt.".php".$ftxt;
			if($i>20) {
				exit();
			}
		}
		
		for($i=0;substr_count($text,"topics.php?")!=0;$i++) {
			$spos=strpos($text,"topics.php",0);		
			$fpos=strpos($text,"\">",$spos);
			$stxt=strstr($text,"topics.php");
			$otxt=str_replace($stxt,"",$text);
			$ftxt=strstr($stxt,"\">");
			$stxt=str_replace($ftxt,"",$stxt);
			$stxt=str_replace("?","",$stxt);
			$stxt=str_replace("&","",$stxt);
			$stxt=str_replace("cate_id=","c",$stxt);
			$stxt=str_replace("year=","y",$stxt);
			$stxt=str_replace("month=","m",$stxt);
			$stxt=str_replace("topics.php","topics",$stxt);
			$text=$otxt.$stxt.".php".$ftxt;
			if($i>20) {
				exit();
			}
		}
	
	return $text;
	
}

$debagtype=0;

if($_SESSION["DomainData"]["domain_name"]=="itcube.jp"||$_SESSION["DomainData"]["domain_name"]=="cubes.jp") {
$debagtype=1;
	
}

	function numberformat($number) {
			if($number==(int)($number)) {
					return $number=number_format($number);
			}
			else {
				for($i=0;!is_int($number*pow(10,$i));$i++) {
						if(substr_count(($number*pow(10,$i)),".")==0){						
							return number_format($number,$i);
							break;
						}
						if($i>10) {
							return $number;
							break;
						}
				}
		}
}
function numberreplace($number) {	
		$number=str_replace(",","",$number);
		$number=str_replace("、","",$number);
		$number=str_replace("円","",$number);
		$number=str_replace("\\","",$number);
		$number=str_replace("￥","",$number);
		$number=str_replace("万","",$number);
		$number=str_replace("千","",$number);
		return $number;
}

if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="afiss.net"){
	$basicchk["use_chk"]=1;
}
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="re.332049.com"){
	$basicchk["use_chk"]=1;
	$basic2=1;
}

if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="job-cardiwakuni.com"){
	$basicchk["use_chk"]=1;
}

if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="yusaku.k-farm.net") {
	$basicchk["use_chk"]==0;
}
if($_GET["loginmode"]!=NULL){

	if($_GET["loginmode"]=="su"){
	   $_SESSION["editmode"]="webmaster";
	}
	else {
	   $_SESSION["editmode"]="admin";
	
	}
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Expires" content="Thu, 01 Dec 1994 16:00:00 GMT">  
<meta http-equiv="Expires" content="0">
<style type="text/css">
<!--
.st {	font-size:14px;
	font-weight:bold;
}
#helper a:link ,#helper a:visited {
font-weight:bold;
	color:#FF0000;
	text-decoration: none;	
}
#helper a:hover,#helper a:active{
font-weight:bold;
	color:#FF6600;
	text-decoration: none;
}
.nowpagenum {
	font-size:16px;
	color:#FF3300;
	font-weight:bold;
}
-->
</style>
<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>


 <script type="text/javascript"> //'Image',
 CKEDITOR.config.toolbar = [ ['Source'] ,['Cut','Copy','Paste','PasteText'] ,['Undo','Redo'] ,['Bold','Italic','Underline','Strike'] ,['Link','Unlink','Image'] ,'/',['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] ,['Table','HorizontalRule','SpecialChar'] ,['FontSize','TextColor','BGColor'] ,['Maximize','-','About'] ]; // テキストエリアの幅 
CKEDITOR.config.width  = '90%'; // テキストエリアの高さ 
CKEDITOR.config.filebrowserBrowseUrl = '/kcfinder/browse.php?type=files';
CKEDITOR.config.filebrowserImageBrowseUrl = '/kcfinder/browse.php?type=images';
CKEDITOR.config.filebrowserUploadUrl = '/kcfinder/upload.php?type=files';
CKEDITOR.config.filebrowserImageUploadUrl = '/kcfinder/upload.php?type=images';
CKEDITOR.config.resize_enabled = false;
</script>
<title><?php if(	$tenpodata["sm_title"]!=NULL) {echo $tenpodata["sm_title"]; }else { echo "ホームページ管理ツール"; } ?></title>

<script type="text/javascript"><!--
function selchange(frm) {
	newsid=document.form2.news.selectedIndex;
//	alert(newsid);
	if(frm.news.options[newsid].value==0) {
		document.all("tb_sub_news").style.display="none";
	}
	else {
		document.all("tb_sub_news").style.display="block";
	}
	
	sekouid=frm.sekou.selectedIndex;
	
	if(frm.sekou.options[sekouid].value==0) {
		document.all("tb_sub_sekou").style.display="none";
	}
	else {
		document.all("tb_sub_sekou").style.display="block";
	}
	
	sekouinfo_id=frm.sekou_info.selectedIndex;
	
	if(frm.sekou_info.options[sekouinfo_id].value==0) {
		document.all("tb_sub_sekouinfo").style.display="none";
	}
	else {
		document.all("tb_sub_sekouinfo").style.display="block";
	}
	
	linkid=frm.link.selectedIndex;
	
	if(frm.link.options[linkid].value==0) {
		document.all("tb_sub_link").style.display="none";
	}
	else {
		document.all("tb_sub_link").style.display="block";
	}
}

function sub_menu(id) {
	window.location.href="index.php?PID="+id;
}
function analyticsopen(domain) {

	window.open("http://siteadmin.itcube.ne.jp/analytics.php?domain="+domain,"new1","width=300,height=100");
	
}
function selmenu(id) {
	switch(id) {
		case "hp":
			document.all("GWMENU").style.display="none";
			document.all("PROMOMENU").style.display="none";
			document.all("HPMENU").style.display="block";
			document.all("FUDOUSANMENU").style.display="none";
	//		document.all("SPOTMENU").style.display="none";
			break;
		case "gw":
			document.all("GWMENU").style.display="block";
			document.all("PROMOMENU").style.display="none";
			document.all("HPMENU").style.display="none";
			document.all("FUDOUSANMENU").style.display="none";
		//	document.all("SPOTMENU").style.display="none";
			break;
		case "promo":
			document.all("GWMENU").style.display="none";
			document.all("PROMOMENU").style.display="block";
			document.all("HPMENU").style.display="none";
			document.all("FUDOUSANMENU").style.display="none";
		//	document.all("SPOTMENU").style.display="none";
			break;
		case "fudousan":
			document.all("PROMOMENU").style.display="none";
			document.all("GWMENU").style.display="none";
			document.all("HPMENU").style.display="none";
			document.all("FUDOUSANMENU").style.display="block";
		//	document.all("SPOTMENU").style.display="none";
			break;
		case "spot":
			document.all("PROMOMENU").style.display="none";
			document.all("GWMENU").style.display="none";
			document.all("HPMENU").style.display="none";
			document.all("FUDOUSANMENU").style.display="none";
		//	document.all("SPOTMENU").style.display="block";
			break;
		default:
			document.all("GWMENU").style.display="block";
			document.all("PROMOMENU").style.display="none";
			document.all("HPMENU").style.display="none";
			document.all("FUDOUSANMENU").style.display="none";
	//		document.all("SPOTMENU").style.display="none";
			break;
	}
}
// --></script>
<style>
td {
	text-align:left;
}
</style>
<link href="/GW/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {
	font-size: 12px
}
.noime{
ime-mode:disabled;
}
div{
	margin:0;
	padding:0;
}
#gwmenutab span{
}
#gwmenutab .rcontent {
	display:none;
	padding:0em;
	border-top-style: solid;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-right-width: 1px;
	border-right-color: #CCCCCC;
	border-left-width: 1px;
	border-left-color: #CCCCCC;
	background:#F7F8F2;
	margin-top: 0em;
	margin-right: 0em;
	margin-bottom: 0em;
	margin-left: 0em;
	border-top-width: 0px;
	border-bottom-width: 0px;
}

#gwmenutab span.rtop,

#gwmenutab span.rbottom {
	display:none;
	background: #fff;
	margin: 0px;
	padding-top: 0px;
	padding-right: 0em;
	padding-bottom: 0px;
	padding-left: 0em;
}

#gwmenutab span.rtop span,

#gwmenutab span.rbottom span {
	display:none;
	height: 1px;
	overflow: hidden;
	background: #F7F8F2;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: none;
	border-left-style: solid;
	border-top-color: #CCCCCC;
	border-right-width: 1px;
	border-right-color: #CCCCCC;
	border-left-width: 1px;
	border-left-color: #CCCCCC;
	border-bottom-color: #CCCCCC;
}

#gwmenutab span.r1{
	margin-top: 0px;
	margin-right: 5px;
	margin-bottom: 0;
	margin-left: 5px;
	padding-top: 0px;
	padding-right: 0px;
	padding-bottom: 0px;
	padding-left: 0px;
	background-color: #CCCCCC;
}

#gwmenutab span.r2{margin: 0 3px;}

#gwmenutab span.r3{margin: 0 2px;}

#gwmenutab span.rtop span.r4, span.rbottom span.r4{margin: 0 1px;height: 2px;}

#GWMENU{
	background-color:#E0E0C4;
}
#HPMENU{
	background-color:#DDD1DF;
}

#FUDOUSANMENU{
	background-color:#D9F8D6;
}
#PROMOMENU{
	background-color:#D7E9FF;
}
.list_price{
	font-weight:bolder;
	font-size:24px;
	color:#FF6600;
}
.list_price_tani{
	font-weight:bolder;
	font-size:14px;
	color:#FF6600;
}
.bukken_detail_title {
	font-size:15px;
}
.bukken_detail_price {
	font-size:25px;
	color:#FF6600;
	
}
.bukken_detail_price_tani {
	font-size:14px;
	color:#FF6600;
}

.bukken_detail_madori {
	font-size:16px;
}
.madori_detail{
	font-size:16px;
}
.bukkentable{
	background-color:#CCCCEE;	
	max-width:800px;
}
.bukkentable th {
	background-color:#ececFF;
	font-weight:normal;
}

-->
</style>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/lightbox.js"></script>
<link rel="stylesheet" href="/JSLIBS/lightbox/2.03.3/css/lightbox.css" type="text/css" media="screen" />

</head>
<body> 
<!--
<?php
print_r($_COOKIE);

?>-->
<div align="center"> <a href="index.php"></a> 
  <table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
    <tr> 
      <td align="left" valign="top"><img src="img/template/head1.jpg" width="9" height="75"></td> 
    	<td align="left" valign="top">
    			<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
									<td width="314"><a href="index.php"><img src="img/template/head2.jpg" width="314" height="75" border="0"></a></td>
									<td background="img/template/head3.jpg">&nbsp;</td>
									<td width="430" align="right"><img src="img/template/head4.jpg" width="430" height="75" border="0" usemap="#SM_HEADMap" /></td>
							</tr>
					</table>
    	</td>
    	<td width="9" align="left" valign="top"><img src="img/template/head5.jpg" width="9" height="75"></td>
    </tr> 
    <tr> 
      <td width="8" align="left" valign="top" background="img/template/left.jpg" ><img src="img/template/left.jpg" width="9" height="839"></td> 
      <td align="left" valign="top">
      		<table width="100%"  border="0" cellpadding="0" cellspacing="0">
							<tr align="left" valign="middle" background="/CUBE_IMG/0707icon/srice_r3_c5_r1_c1.jpg">
									<td height="41">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-x;">
													<form action="http://www.google.co.jp/search" method="get" name="searchform1" id="searchform1" target="_blank">
															<tr>
																	<td colspan="5">
																			<div align="right"></div>
																	</td>
															</tr>
															<tr>
																	<td width="50" background="/GW/img/template/head_line1.jpg">
																			<div align="left"></div>
																	</td>
																	<td background="/GW/img/template/head_line2.jpg"><span class="style3"><?php echo $_SESSION["DomainData"]["name"];?></span></td>
																	<td width="86" background="/GW/img/template/head_line3.jpg">&nbsp;</td>
																	<td width="140" align="left" valign="middle" background="/GW/img/template/head_line2.jpg">
																			<input name="q" type="text" id="q" /></td>
																	<td width="50">
																			<input type="image" name="imageField" src="/GW/img/template/head_line4.jpg" />
																	</td>
															</tr>
													</form>
											</table>
											</td>
							</tr>
							
							<?php
							
							if($newbasicchk["use_chk"]==1||$newcmschk["use_chk"]==1){
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top"><?php
																							
																							if($_SESSION["loginmode"]=="webmaster"){
																							
																							?>
                       		<div align="right">
																											<?php if($_SERVER['QUERY_STRING']!=NULL){
																											?>
																											<a href="?<?php echo $_SERVER['QUERY_STRING'];?>&loginmode=su">製作者用管理 </a>　｜　<a href="?<?php echo $_SERVER['QUERY_STRING'];?>&loginmode=ad">通常管理</a> 
                           <?php
																									}
																									else{
																												?>		<a href="?loginmode=su">製作者用管理 </a>　｜　<a href="?loginmode=ad">通常管理</a> 
												<?php
																						}
																									?></div>
																									<?php
																									}?>
																							
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div>
                       <div id="FUDOUSANMENU" style="display:none;"></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>

<?php								


							}else if($realestatechk["use_chk"]==1){
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                   		<td align="left" valign="top"><div id ="HPMENU" style="display:none;"></div>
                   				<div id="GWMENU" style="display:none;"></div>
		<div id="FUDOUSANMENU" style="display:block;"><a href="index.php?PID=topics"><img src="img/template/tabmenu/re_12.jpg" width="71" height="62" border="0" /></a><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=link_category&amp;cate_id=2"><img src="img/template/tabmenu/re_14.jpg" width="71" height="62" border="0" /></a><a href="index.php?PID=qanda"><img src="img/template/tabmenu/re_15.jpg" width="71" height="62" border="0" /></a><?php if($_SERVER["HTTP_HOST"]=="hayashi.itcube.ne.jp") {?><a href="?PID=roomguide"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re1.jpg" width="73" height="62" border="0" /></a><a href="?PID=buyguide"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re2.jpg" width="73" height="62" border="0" /></a><a href="?PID=sellguide"><img src="http://siteadmin.itcube.ne.jp/img/newtab/new_re3.jpg" width="70" height="62" border="0" /></a><a href="?PID=recruits"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re4.jpg" width="69" height="62" border="0" /></a>
		<?php }?><a href="index.php?PID=company"><img src="img/template/tabmenu/re_13.jpg" width="71" height="62" border="0" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div><div id="PROMOMENU" style="display:none;"></div></td>
                   		</tr>
               </table>
							    </td>
							    </tr>

<?php								


							}
							else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="afiss.net") {
	
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top">  <div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div>
                       <div id="FUDOUSANMENU" style="display:none;"></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>

<?php							
	}
	else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="truck-kagoshima.com"){
		?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top">
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0" /></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=address"><img src="/SM/img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0" /></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0" /></a></div><div id="FUDOUSANMENU" style="display:block;"><a href="?PID=re_c1&rq=1&cid=1"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_1.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=2"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_2.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=3"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_3.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=4"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_7.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=5"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_4.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=6"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_5.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=7"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_6.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=re_c1&rq=1&cid=8"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_8.jpg" alt="" width="79" height="62" border="0" /></a><a href="?PID=company"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/re_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
		<?php
	}
	else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
		?>
		<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td width="750" align="left" valign="top">
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div><div id="FUDOUSANMENU" style="display:block;"></div><div><a href="?PID=news"><img src="http://siteadmin.itcube.ne.jp/img/fnews.jpg" width="65" height="60" border="0" /></a><a href="/SM/"><img src="http://siteadmin.itcube.ne.jp/img/ftopics.jpg" width="65" height="60" border="0" /></a><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
									<?php
	}	else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="jyuken1101.co.jp"){
		?>
		<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td width="750" align="left" valign="top">
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div><div id="FUDOUSANMENU" style="display:block;"><div><a href="?PID=sekou_list"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re5.jpg" width="73" height="62" border="0" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=toppage"><img src="img/template/tabmenu/re_12.jpg" width="71" height="62" border="0" /></a><a href="index.php?PID=qanda"><img src="img/template/tabmenu/re_15.jpg" width="71" height="62" border="0" /></a>
                         <!-- <a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a>--><a href="?PID=company"><img src="img/template/tabmenu/re_13.jpg" width="71" height="62" border="0" /></a></div>
                       </div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
									<?php
	}

	else if($_SESSION["DomainData"]["dbtype"]=="mysql"&&$basicchk["use_chk"]==1) {
	
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top">
																							<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div>
                       <div id="FUDOUSANMENU" style="display:none;"></div>
                       <div id="PROMOMENU" style="display:none;"></div>
																							</td>
                   </tr>
               </table>
							    </td>
							    </tr>
<?php							
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="golf.cubes.jp") {
	
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top">
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"></div>
                       <div id="FUDOUSANMENU" style="display:none;"></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>

<?php							
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="fsd-net.com") {
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td align="left" valign="top">
<div id ="HPMENU" style="display:none;"><a href="?PID=topics" onclick="<?php if($menudata[1]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[1]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[1]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_1.jpg" width="79" height="62" border="0" /></a><a href="?PID=link"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=pagesetting"><img src="img/template/tabmenu/hp_15.jpg" width="79" height="62" border="0" /></a></div>
                       <div id="GWMENU" style="display:none;"></div>
                       <div id="FUDOUSANMENU" style="display:none;"></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>

<?php							
}							
	else if($_SESSION["DomainData"]["dbtype"]=="mysql"&&$sejourchk["use_chk"]==1) {
?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   
                   <tr>
                       <td width="750" align="left" valign="top">
<div id ="HPMENU" style="display:none;"></div>
                       <div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0" /></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=address"><img src="/SM/img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0" /></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0" /></a></div><div id="FUDOUSANMENU" style="display:none;"><?php if($_SERVER['HTTP_HOST']=="ark-plan.com") {?><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><?php }?><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_setting"></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div>
                       <div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
<?php							
}
else if($_SESSION["DomainData"]["dbtype"]=="mysql"||($_SESSION["DomainData"]["domain_name"]=="cubes.jp")||(str_replace("www.","",$_SERVER['HTTP_HOST'])=="yusaku.k-farm.net")) {
							$dbobj->Query("update link_setting set data_comm_chk=1");
							$dbobj->Query("update link_setting set cate_comm_chk=0");
							?>
							<tr >
							    <td align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                   <tr >
                       <td width="750" align="left" valign="top">
                           <table border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                   <td><a href="#" onclick="selmenu('hp')"><img src="img/template/tabmenu/hp_title.jpg" width="96" height="17" border="0" /></a></td>
                                   <?php
										?>
                                   <td><a href="#" onclick="selmenu('fudousan')"><img src="img/template/tabmenu/re_title.jpg" width="96" height="17" border="0" /></a></td>
                                   <td><a href="#" onclick="selmenu('promo')"></a></td>
                                   <td><a href="#" onclick="selmenu('spot')"></a></td>
                               </tr>
                           </table>                       </td>
                   </tr>
                   <tr>
                       <td height="62" align="left" valign="top">
<div id ="HPMENU" style="display:block;"><?php if($_SERVER['HTTP_HOST']=="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com") {?>
				<a href="?PID=topics"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_colmn.jpg" width="79" height="62" border="0" /></a><a href="?PID=alnews"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_news.jpg" width="79" height="62" border="0" /></a>
<?php }else {?><a href="?PID=topics"><img src="img/template/tabmenu/hp_13.jpg" width="79" height="62" border="0" /></a><?php }?><a href="?PID=company"><img src="img/template/tabmenu/hp_2.jpg" width="79" height="62" border="0" /></a>  <?php if($_SERVER['HTTP_HOST']=="arkplan.itcube.ne.jp"||$_SERVER['HTTP_HOST']=="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com") {
}else {?><a href="?PID=qanda"><img src="img/template/tabmenu/hp_5.jpg" width="79" height="62" border="0" /></a><?php }?><?php if($_SERVER['HTTP_HOST']=="") {?><a href="?PID=link_category"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_link.jpg" width="79" height="62" border="0" /></a><a href="?PID=link_category&cate_id=2"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0" /></a>
<?php }else {?></a><?php }?><a href="?PID=link_category">
<img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0" /></a>
<?php if($_SERVER['HTTP_HOST']=="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com") {?>
<a href="?PID=alcontents_details&cate_id=1"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_02.jpg" width="79" height="62" border="0" /></a><a href="?PID=al_qa&cid=1"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_kounyuqa.jpg" width="79" height="62" border="0" /></a><a href="?PID=alcontents_details&cate_id=2"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_01.jpg" width="79" height="62" border="0" /></a><a href="?PID=al_qa&cid=2"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/hp_al_baikyakuqa.jpg" width="79" height="62" border="0" /></a>
  <?php }?><?php if($_SERVER['HTTP_HOST']=="arkplan.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="ark-plan.com") {
}else {?>
  <a href="?PID=al_fp"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/topflash.jpg" width="71" height="58" border="0" /></a><a href="?PID=setting"><img src="img/template/tabmenu/hp_15.jpg" width="79" height="62" border="0" /></a><?php }?></div>
<div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0" /></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=address"><img src="/SM/img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0" /></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0" /></a></div><div id="FUDOUSANMENU" style="display:block;"><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_inputcsv"><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0" /></a><?php if($_SESSION["DomainData"]["domain_name"]=="cubes.jp") {?><a href="?PID=pop"><img src="img/template/tabmenu/re_11.jpg" width="79" height="62" border="0" alt="物件の一覧を印刷します。" /></a><?php }?><?php if(str_replace("www.","",$_SERVER["HTTP_HOST"])!="e-altus.com") {?><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a><?php }?><?php if($_SERVER["HTTP_HOST"]=="hayashi.itcube.ne.jp") {?><a href="?PID=roomguide"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re1.jpg" width="73" height="62" border="0" /></a><a href="?PID=buyguide"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re2.jpg" width="73" height="62" border="0" /></a><a href="?PID=sellguide"><img src="http://siteadmin.itcube.ne.jp/img/newtab/new_re3.jpg" width="70" height="62" border="0" /></a><a href="?PID=recruits"><img src="http://siteadmin.itcube.ne.jp//img/newtab/new_re4.jpg" width="69" height="62" border="0" /></a>
		<?php }?></div><div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
<?php 							}

	else {
							if($fudousan2chk["use_chk"]!=1&&$fudousan3chk["use_chk"]!=1&&$fudousanschk["use_chk"]!=1) { 
?>							<tr >
									<td width="750" align="left" valign="top"><table border="0" cellspacing="0" cellpadding="0">
                                      <tr>
                                        <td><a href="#" onclick="selmenu('gw')"><img src="img/template/tabmenu/gw_title.jpg" width="96" height="17" border="0" /></a></td>
                                        <td><a href="#" onclick="selmenu('hp')"><img src="img/template/tabmenu/hp_title.jpg" width="96" height="17" border="0" /></a></td>
                                        <?php
										if($fudousanchk["use_chk"]==1) { 
										?><td><a href="#" onclick="selmenu('fudousan')"><img src="img/template/tabmenu/re_title.jpg" width="96" height="17" border="0" /></a></td><?php }?><?php
										if($promochk["use_chk"]==1) { 
										?><td><a href="#" onclick="selmenu('promo')"><img src="img/template/tabmenu/sale_title.jpg" width="96" height="17" border="0" /></a></td>
                                        <?php }?>
                                        <td><a href="#" onclick="selmenu('spot')"></a></td>
                                      </tr>
                                    </table>
									    <a href="#" onclick="selmenu('promo')"></a></td>
							</tr>
							<tr>
									<td align="left" valign="top"><div id ="HPMENU" style="display:block;"><a href="#" onclick="<?php if($menudata[1]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[1]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[1]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_1.jpg" width="79" height="62" border="0"></a><?php if($_SESSION["login_id"]=="kappou-ueki"){?><a href="#" onclick="<?php if($menudata[6]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[6]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[6]["data_name"]); ?>は使用できません。')<?php }?>"><img src="http://siteadmin.itcube.ne.jp/sm/img/hp_21.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[7]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[7]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[7]["data_name"]); ?>は使用できません。')<?php }?>"><img src="http://siteadmin.itcube.ne.jp/sm/img/hp_20.jpg" width="79" height="62" border="0"></a><a href="?PID=info3"><img src="http://siteadmin.itcube.ne.jp/sm/img/hp_19.jpg" width="79" height="62" border="0"></a><?php }else{?><a href="#" onclick="<?php if($menudata[6]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[6]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[6]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_8.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[7]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[7]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[7]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_9.jpg" width="79" height="62" border="0"></a><?php }?><a href="#" onclick="<?php if($menudata[8]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[8]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[8]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_5.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[2]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[2]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[2]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_2.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[3]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[3]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[3]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_3.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[7]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[5]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[5]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_6.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[4]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[4]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[4]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_7.jpg" width="79" height="62" border="0"></a><a href="#" onclick="<?php if($menudata[9]["use_chk"]==1){ ?>sub_menu('<?php echo noreturn($menudata[9]["data_code"]); ?>')<?php } else { ?>alert('<?php echo noreturn($menudata[9]["data_name"]); ?>は使用できません。')<?php }?>"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0"></a><a href="?PID=setting"><img src="img/template/tabmenu/hp_15.jpg" width="79" height="62" border="0" /></a></div><div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" ></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0"></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0"></a><a href="?PID=address"><img src="img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0"></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0"></a></div>
<div id="FUDOUSANMENU" style="display:none;"><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。"></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0"></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0"></a><a href="?PID=re_setting"></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div><div id="PROMOMENU" style="display:none;"><a href="?PID=promo_dmtemp"><img src="img/template/tabmenu/sale_4.jpg" width="79" height="62" border="0"></a><a href="?PID=promo_dm_reg"><img src="img/template/tabmenu/sale_1.jpg" width="79" height="62" border="0" /></a><a href="?PID=promo_dm"><img src="img/template/tabmenu/sale_2.jpg" width="79" height="62" border="0"></a><a href="?PID=promo_coupon&page=1"><img src="img/template/tabmenu/sale_6.jpg" width="79" height="62" border="0"></a><a href="?PID=promo_customer"><img src="img/template/tabmenu/sale_3.jpg" width="79" height="62" border="0"></a><a href="?PID=promo_setting"><img src="img/template/tabmenu/sale_5.jpg" width="79" height="62" border="0"></a></div><div id="SPOTMENU" style="display:none;"><table border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td width="70" height="65" align="center"><a href="?PID=spot_visiter">来訪者数<br />
						管理</a></td>
				<td width="70" align="center">&nbsp;</td>
				<td width="70" align="center">&nbsp;</td>
				<td width="70" align="center">&nbsp;</td>
				<td width="70" align="center">&nbsp;</td>
		</tr>
</table>
</div></td>
							</tr>
					<?php
					}
					else if($fudousan2chk["use_chk"]==1) { 
							$dbobj->Query("update link_setting set data_comm_chk=1");
							$dbobj->Query("update link_setting set cate_comm_chk=0");

							?>
							<tr>
									<td align="left" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
															<td>
																	<table border="0" cellspacing="0" cellpadding="0">
																			<tr>
																					<td><a href="#" onclick="selmenu('gw')"><img src="img/template/tabmenu/gw_title.jpg" width="96" height="17" border="0" /></a></td>
																					<td><a href="#" onclick="selmenu('hp')"><img src="img/template/tabmenu/hp_title.jpg" width="96" height="17" border="0" /></a></td>
																					<?php
										?>
																					<td><a href="#" onclick="selmenu('fudousan')"><img src="img/template/tabmenu/re_title.jpg" width="96" height="17" border="0" /></a></td>
																					<td><a href="#" onclick="selmenu('promo')"></a></td>
																					<td><a href="#" onclick="selmenu('spot')"></a></td>
																			</tr>
																	</table>
															</td>
													</tr>
													<tr>
															<td>
<div id="HPMENU" style="display:none"><a href="index.php"></a><a href="?PID=blog"><img src="img/template/tabmenu/hp_1.jpg" width="79" height="62" border="0"></a><a href="?PID=company1"><img src="img/template/tabmenu/hp_2.jpg" width="79" height="62" border="0"></a><a href="?PID=qanda"><img src="img/template/tabmenu/hp_5.jpg" width="79" height="62" border="0" ></a><a href="?PID=link"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0" ></a><a href="?PID=contents1"><img src="img/template/tabmenu/hp_11.jpg" width="79" height="62" border="0"></a><a href="?PID=contents2"><img src="img/template/tabmenu/hp_12.jpg" width="79" height="62" border="0"></a><a href="?PID=banner&cate_id=2"><img src="img/template/tabmenu/hp_10.jpg" width="79" height="62" border="0"></a></div>
<div id="FUDOUSANMENU" style="display:none;"><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。"></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0"></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0"></a><a href="?PID=re_setting"></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div>
<div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" ></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0"></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=mail"></a><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0"></a><a href="?PID=address"><img src="img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0"></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0"></a></div>
<div id="PROMOMENU" style="display:none;"></div>
															</td>
													</tr>
							<tr>
									<td align="left" valign="top">&nbsp;</td>
													</tr>
											</table>
						</td>
							</tr>
							<?php
							}else if($fudousan3chk["use_chk"]==1) { 
							$dbobj->Query("update link_setting set data_comm_chk=1");
							$dbobj->Query("update link_setting set cate_comm_chk=0");
							?>
							<tr>
									<td align="left" valign="top">
											<table width="100%" border="0" cellpadding="0" cellspacing="0">
													<tr>
															<td>
																	<table border="0" cellspacing="0" cellpadding="0">
																			<tr>
																					<td><a href="#" onclick="selmenu('gw')"><img src="img/template/tabmenu/gw_title.jpg" width="96" height="17" border="0" /></a></td>
																					<td><a href="#" onclick="selmenu('hp')"><img src="img/template/tabmenu/hp_title.jpg" width="96" height="17" border="0" /></a></td>
																					<?php
										?>
																					<td><a href="#" onclick="selmenu('fudousan')"><img src="img/template/tabmenu/re_title.jpg" width="96" height="17" border="0" /></a></td>
																			
																					<td><a href="#" onclick="selmenu('promo')"></a></td>
																					<td><a href="#" onclick="selmenu('spot')"></a></td>
																			</tr>
																	</table>
															</td>
													</tr>
													<tr>
															<td>
																	<div id="HPMENU" style="display:none;"><a href="?PID=news"><img src="img/template/tabmenu/hp_1.jpg" width="79" height="62" border="0" /></a><a href="?PID=company1"><img src="img/template/tabmenu/hp_2.jpg" width="79" height="62" border="0" /></a><a href="?PID=qanda"><img src="img/template/tabmenu/hp_5.jpg" width="79" height="62" border="0"></a><a href="?PID=link"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0"  /></a><a href="?PID=contents1"><img src="img/template/tabmenu/hp_11.jpg" width="79" height="62" border="0" /></a><a href="?PID=contents2"><img src="img/template/tabmenu/hp_12.jpg" width="79" height="62" border="0" /></a><a href="?PID=banner&cate_id=2"></a></div>
																	<div id="FUDOUSANMENU" style="display:none;"><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_setting"></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div>
<div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0" /></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=address"><img src="img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0" /></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0" /></a></div>
																	<div id="PROMOMENU" style="display:none;"></div>
															</td>
													</tr>
											</table>
									</td>
							</tr>
							<?php
															}
															?>
                   <?php
							if($fudousanschk["use_chk"]==1) { 
							?>							<tr>
							    <td height="75" align="left" valign="top">
							        <table width="100%"  border="0" cellpadding="0" cellspacing="0">

                   <tr >
                       <td width="750" align="left" valign="top">
                           <table border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                   <td><a href="#" onclick="selmenu('gw')"><img src="img/template/tabmenu/gw_title.jpg" width="96" height="17" border="0" /></a></td>
                                   <td><a href="#" onclick="selmenu('hp')"><img src="img/template/tabmenu/hp_title.jpg" width="96" height="17" border="0" /></a></td>
                                   <?php
										if($fudousanschk["use_chk"]==1) { 
										?>
                                   <td><a href="#" onclick="selmenu('fudousan')"><img src="img/template/tabmenu/re_title.jpg" width="96" height="17" border="0" /></a></td>
                                   <?php 
																																			}
																																			?>
                                   <?php
										if($promochk["use_chk"]==1) { 
										?>
                                   <td><a href="#" onclick="selmenu('promo')"></a></td>
                                   <?php }?>
                                   <td><a href="#" onclick="selmenu('spot')"></a></td>
                               </tr>
                           </table>
                       </td>
                   </tr>
                   <tr>
                       <td height="62" align="left" valign="top"><div id ="HPMENU" style="display:none;"><a href="?PID=topics"><img src="img/template/tabmenu/hp_13.jpg" width="79" height="62" border="0" /></a><a href="?PID=company"><img src="img/template/tabmenu/hp_2.jpg" width="79" height="62" border="0" /></a><a href="?PID=qanda"><img src="img/template/tabmenu/hp_5.jpg" width="79" height="62" border="0" /></a><a href="?PID=link_category"><img src="img/template/tabmenu/hp_4.jpg" width="79" height="62" border="0" />
  </a><a href="?PID=setting"><img src="img/template/tabmenu/hp_15.jpg" width="79" height="62" border="0" /></a></div>
                       <div id="GWMENU" style="display:none;"><a href="index.php"><img src="img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=schedule"><img src="img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0" /></a><?php
	if($debagtype==1) {?><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><?php } ?><a href="index.php?PID=files"><img src="img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=bbs"><img src="img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0" /></a><a href="?PID=address"><img src="/SM/img/template/tabmenu/gw_12.jpg" border="0" /></a><a href="index.php?PID=keitai"><img src="img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=members"><img src="img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0" /></a><a href="index.php?PID=group"><img src="img/template/tabmenu/gw_7.jpg" width="79" height="62" border="0" /></a><a href="#" onclick="analyticsopen('<?php echo $_SESSION["DomainData"]["domain_name"];?>');"><img src="img/template/tabmenu/gw_10.jpg" width="79" height="62" border="0" /></a></div><div id="FUDOUSANMENU" style="display:none;"><a href="index.php?PID=re_c1&rq=1"><img src="img/template/tabmenu/re_1.jpg" width="79" height="62" border="0" alt="アパート・マンションの賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c2&rq=1"><img src="img/template/tabmenu/re_2.jpg" width="79" height="62" border="0" alt="戸建の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_c3&rq=1"><img src="img/template/tabmenu/re_3.jpg" width="79" height="62" border="0" alt="事業用の賃貸物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b1&rq=1"><img src="img/template/tabmenu/re_4.jpg" width="79" height="62" border="0" alt="マンション・戸建の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b2&rq=1"><img src="img/template/tabmenu/re_5.jpg" width="79" height="62" border="0" alt="土地の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_b3&rq=1"><img src="img/template/tabmenu/re_6.jpg" width="79" height="62" border="0" alt="事業用の売買物件の登録・修正・削除が出来ます。" /></a><a href="index.php?PID=re_inputcsv"><img src="img/template/tabmenu/re_7.jpg" width="79" height="62" border="0" alt="レインズのデータを取り込みます。" /></a><a href="index.php?PID=re_tenpo_up"><img src="img/template/tabmenu/re_8.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_area"><img src="img/template/tabmenu/re_9.jpg" width="79" height="62" border="0" /></a><a href="?PID=re_setting"></a><a href="?PID=re_setting"><img src="img/template/tabmenu/re_10.jpg" width="79" height="62" border="0" /></a></div><div id="PROMOMENU" style="display:none;"></div></td>
                   </tr>
               </table>
							    </td>
							    </tr>
                   <?php
					}
					else if($fudousan2chk["use_chk"]==1) { 
							?>
                   <?php
							}else if($fudousan3chk["use_chk"]==1) { 
							?>
                   <?php
															}
															}
															?>
							<tr>
							    <td align="left" valign="top">&nbsp;</td>
				    </tr>
							<tr>
									<td height="400" align="left" valign="top"><?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="daitobaseball.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/daitobaseballcom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="ohkura-linen.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/ohkura-linencom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="togo-karaoke.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/togo-karaokecom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="hiroshige.co.jp"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/hiroshigecojp.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="matsue.laut-japan.jp"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/matsuelaut-japancom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="miyajima.laut-japan.jp"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/cmsgoqcojp.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="pritak.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/pritakcom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="truck-kagoshima.com"){
	include "./domains/truck-kagoshimacom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="wmfnz.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/wmfnzcom.php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="otakejc.com"){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/otakejccom.php";
}
else if(file_exists("./domains/".str_replace(".","",str_replace("www.","",$_SERVER['HTTP_HOST'])).".php")){
	include "./hpdata/newbasic/class/myclass.php";
	include "./domains/".str_replace(".","",str_replace("www.","",$_SERVER['HTTP_HOST'])).".php";
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="332049.com"){
	include "./hpdata/newbasic/class/myclass.php";

	switch($_REQUEST["PID"]){
			/* 携帯 */
		case "keitai":
		include ("./keitai/index.php");
		$pagetype="gw";
		break;
	
		/* 新着情報 */
		case "news_reg":
		include "./hpdata/newbasic/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/newbasic/mf_news.php";
		$pagetype="hp";
		break;
case "hp_basic_link_category":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/newbasic/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/newbasic/mf_link.php";
		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/newbasic/mf_link_reg.php";
		
		$pagetype="hp";
		break;
		case "link_d_up":
		include "./link/d_update.php";
		$pagetype="hp";
		break;
		case "domain":
		include "./domain/top.php";
		break;
		
		/* ブログコンテンツ */
		case "blog":
		$pagetype="hp";
		
		include "./blog2/top.php";
		
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		
		include "./hpdata/newbasic/mf_blog_lineup.php";
		
		break;
		
		case "blog_add":
		$pagetype="hp";
		include "./blog2/addition.php";
		break;
		case "blog_up":
		$pagetype="hp";
		include "./blog2/update.php";
		break;
		case "blog_list":
		$pagetype="hp";
		
		include "./blog2/d_top.php";
		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		
		break;
		
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/newbasic/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_banner.php";
		break;
		case "banner_add":
		$pagetype="hp";
		include "./banner/d_addition.php";
		break;
		case "banner_up":
		$pagetype="hp";
		include "./banner/d_update.php";
		break;
		case "vup":
		$pagetype="hp";
		include "./vup/top.php";
		break;
		case "vup_d":
		$pagetype="hp";
		include "./vup/details.php";
		break;
		case "tenpo":
		$pagetype="gw";
		include ("./tenpo/index.php");
		break;
		case "contents_category":
			include "./hpdata/newbasic/mf_contents_category.php";
		$pagetype="hp";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/newbasic/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
		include "./hpdata/newbasic/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){

		include "./hpdata/newbasic/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
		include "./hpdata/newbasic/mf_about.php";
}
		}
		$pagetype="hp";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {

		include "./hpdata/newbasic/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/newbasic/mf_plist_reg.php";
		$pagetype="hp";
break;

case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
	include "./hpdata/newbasic/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/newbasic/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/newbasic/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/newbasic/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/newbasic/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/newbasic/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/newbasic/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents_category.php";
		}
		else {
				include "./hpdata/newbasic/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/newbasic/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/newbasic/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/newbasic/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/newbasic/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/newbasic/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/newbasic/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/newbasic/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/newbasic/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/newbasic/mf_link_reg.php";
		$pagetype="hp";
		break;	
		
		default:
		
		include "./hpdata/newbasic/index.php";
		$pagetype="hp";
		break;
			
	}	

}
else if($newcmschk["use_chk"]["use_chk"]==1) {
		include "./hpdata/newbasic/class/myclass.php";
		include "./domains/cmsgoqcojp.php";
		
}
else if($newbasicchk["use_chk"]==1) {
	
	include "./hpdata/newbasic/class/myclass.php";
	switch($_REQUEST["PID"]){
			/* 携帯 */
		case "keitai":
		include ("./keitai/index.php");
		$pagetype="gw";
		break;	
case "designsetting":
		include ("./hpdata/newbasic/mf_designsetting.php");
		$pagetype="gw";
		break;			/* 新着情報 */
		case "news_reg":
		include "./hpdata/newbasic/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/newbasic/mf_news.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_category":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;		
		case "link":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_link_category.php";
		break;
		case "hp_basic_link_category_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_link_category_reg.php";
		break;		
		case "link_add":
		include "./hpdata/newbasic/mf_link_reg.php";
		$pagetype="hp";
		break;
		case "link_up":
		include "./link/update.php";
		$pagetype="hp";
		break;
		case "hp_basic_link_d":
		include "./hpdata/newbasic/mf_link.php";		
		$pagetype="hp";
		break;
		case "hp_basic_link_reg":
		include "./hpdata/newbasic/mf_link_reg.php";		
		$pagetype="hp";
		break;
		case "link_d_up":
		include "./link/d_update.php";
		$pagetype="hp";
		break;
		case "domain":
		include "./domain/top.php";
		break;
		
		/* ブログコンテンツ */
		case "blog":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_lineup.php";
		break;
		case "basic_blog_lineup":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_lineup.php";		
		break;		
		case "hp_basic_blog_cate":
		$pagetype="hp";		
		include "./hpdata/newbasic/mf_blog_cate.php";		
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_cate_reg.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_reg.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";		
		include "./hpdata/newbasic/mf_blog_closeup.php";		
		break;
		case "blog_dadd":
		$pagetype="hp";
		include "./blog2/d_addition.php";
		break;
		case "basic_blog_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_reg.php";
		break;
		case "hp_basic_blog_cate":
		$pagetype="hp";
		
		include "./blog2/d_update.php";
		break;
		case "hp_basic_blog_closeup":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_closeup.php";
		break;
		case "hp_basic_blog_cate_reg":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_blog_cate_reg.php";
		break;
		case "patternlist":
		$pagetype="hp";
		
		include "./hpdata/newbasic/patternlist.php";
		
		break;
		/* ブログコンテンツ */
		
		case "news_setting":
		$pagetype="hp";
		include "./news/setting.php";
		break;
		case "banner":
		$pagetype="hp";
		include "./hpdata/newbasic/mf_banner.php";
		break;
		case "banner_add":
		$pagetype="hp";
		include "./banner/d_addition.php";
		break;
		case "banner_up":
		$pagetype="hp";
		include "./banner/d_update.php";
		break;
		case "vup":
		$pagetype="hp";
		include "./vup/top.php";
		break;
		case "vup_d":
		$pagetype="hp";
		include "./vup/details.php";
		break;
		case "tenpo":
		$pagetype="gw";
		include ("./tenpo/index.php");
		break;
		case "contents_category":
			include "./hpdata/newbasic/mf_contents_category.php";
		$pagetype="hp";
		break;
		case "contents_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_freelist_up.php";
		}
		else {
		include "./hpdata/newbasic/mf_list.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
		include "./hpdata/newbasic/mf_about.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/newbasic/mf_plist.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
		include "./hpdata/newbasic/mf_about.php";
}
		}
		$pagetype="hp";
		break;
case "contents_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {

		include "./hpdata/newbasic/mf_list_reg.php";
}		
		$pagetype="hp";
break;
case "contents_plist_reg":
		include "./hpdata/newbasic/mf_plist_reg.php";
		$pagetype="hp";
break;
case "contents_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about.php";
		}
		else {
	include "./hpdata/newbasic/mf_list_up.php";
}		
		$pagetype="hp";
break;

case "contents_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_plist_up.php";
		}
		else {
	include "./hpdata/newbasic/mf_plist_up.php";
}		
		$pagetype="hp";
break;
		case "link_category":
		include "./hpdata/newbasic/mf_link_category.php";
		$pagetype="hp";
		break;
		case "link_category_reg":
		
			include "./hpdata/newbasic/mf_link_category_reg.php";
		$pagetype="hp";
		break;
		case "link_d":
		include "./hpdata/newbasic/mf_link.php";
		$pagetype="hp";
		break;
		case "banner":
		include "./hpdata/newbasic/mf_banner.php";
		$pagetype="hp";
		break;
		case "news":
		include "./hpdata/newbasic/mf_news.php";
		$pagetype="hp";
		break;
		case "news_reg":
		include "./hpdata/newbasic/mf_news_reg.php";
		$pagetype="hp";
		break;
		case "contents_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents_category_up.php";
		}
		
		$pagetype="hp";
		break;
		case "blog_lineup":
		include "./hpdata/newbasic/mf_blog_lineup.php";
		$pagetype="hp";
		break;
		case "blog_closeup":
		include "./hpdata/newbasic/mf_blog_closeup.php";
		$pagetype="hp";
		break;
		case "menu":
		include "./hpdata/newbasic/mf_menu.php";
		$pagetype="hp";
		break;
		case "pagesetting":
		include "./hpdata/newbasic/mf_pagesetting.php";
		$pagetype="hp";
		break;
		case "blog_cate":
		include "./hpdata/newbasic/mf_blog_cate.php";
		$pagetype="hp";
		break;
		case "blog_cate_reg":
		include "./hpdata/newbasic/mf_blog_cate_reg.php";
		$pagetype="hp";
		break;
		case "blog_reg":
		
		include "./hpdata/newbasic/mf_blog_reg.php";
		$pagetype="hp";
		
		break;
		case "contact":
		
		include "./hpdata/newbasic/mf_contact.php";
		$pagetype="hp";
		
		break;
		
		case "link_reg":
		
		include "./hpdata/newbasic/mf_link_reg.php";
		$pagetype="hp";
		break;
	
case "contents2_list_reg":
		if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about2.php";
		}
		else {

		include "./hpdata/newbasic/mf_list2_reg.php";
}		
		$pagetype="hp";
break;
case "contents2_plist_reg":
		include "./hpdata/newbasic/mf_plist2_reg.php";
		$pagetype="hp";
break;

case "contents2_list_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about2.php";
		}
		else {
	include "./hpdata/newbasic/mf_list2_up.php";
}		
		$pagetype="hp";
break;

case "contents2_plist_up":
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_plist2_up.php";
		}
		else {
	include "./hpdata/newbasic/mf_plist2_up.php";
}		
		$pagetype="hp";
break;
		case "contents2_category_reg":
		
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents2_category_reg.php";
		}
		
		$pagetype="hp";
		break;
		case "contents2_category_up":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents2_category_up.php";
		}
		
		$pagetype="hp";
		break;
				case "contents2_category":
		if($_SESSION["editmode"]=="webmaster"){
				include "./hpdata/newbasic/su/mf_contents2_category.php";
		}
		else {
		include "./hpdata/newbasic/mf_contents2_category.php";
		}
		$pagetype="hp";
		break;
		case "contents2_details":
		if($_REQUEST["pattern"]=="freelist"){
			if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_freelist2_up.php";
		}
		else {
		include "./hpdata/newbasic/mf_list2.php";
		}
			}
			elseif($_REQUEST["pattern"]=="freepage"){
				if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about2.php";
		}
		else {
		include "./hpdata/newbasic/mf_about2.php";
					}
				}
				else if($_REQUEST["pattern"]=="plist"){
		include "./hpdata/newbasic/mf_plist2.php";
					}
					else if($_REQUEST["pattern"]=="ppage") {
	if($_SESSION["editmode"]=="webmaster"){
		include "./hpdata/newbasic/su/mf_about2.php";
		}
		else {
		include "./hpdata/newbasic/mf_about2.php";
}
		}
		$pagetype="hp";
		break;
		default:
		if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="smart-spice.jp") {
				include "./hpdata/newbasic/mf_menu.php";
		}
		else {
			include "./hpdata/newbasic/index.php";
		}
		$pagetype="hp";
		break;
			
	}	
}else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="sejour.co.jp") {
	switch($_REQUEST["PID"]){
		case "topics":
						include "./hpdata/sejour/topics.php";
					$pagetype="hp";
						break;
		case "room":
						include "./hpdata/sejour/room.php";
					$pagetype="hp";
						break;
		case "rest":
						include "./hpdata/sejour/rest.php";
					$pagetype="hp";
						break;
		case "topics":
						include "./hpdata/sejour/topics.php";
					$pagetype="hp";
						break;
		case "topics_cu":
						include "./hpdata/sejour/topics_cu.php";
					$pagetype="hp";
						break;
		case "topics_closeup":
						include "./hpdata/sejour/topics_closeup.php";
					$pagetype="hp";
						break;
		case "topics_cu_reg":
						include "./hpdata/sejour/topics_regist.php";
					$pagetype="hp";
						break;
			case "tmp_reservation":
						include "./hpdata/sejour/tmp_reservation.php";
					$pagetype="hp";
						break;
	case "cp":
						include "./hpdata/sejour/cp.php";
					$pagetype="hp";
						break;
	case "cp_reg":
						include "./hpdata/sejour/cp_reg.php";
					$pagetype="hp";
						break;
	case "cp_cate":
						include "./hpdata/sejour/cp_cate.php";
					$pagetype="hp";
						break;
	case "cp_cate_reg":
						include "./hpdata/sejour/cp_cate_reg.php";
					$pagetype="hp";
						break;						
	case "cp_turn":
						include "./hpdata/sejour/cp_turn.php";
					$pagetype="hp";
						break;						
		case "contact":
						include "./hpdata/sejour/contact.php";
					$pagetype="hp";
						break;
		case "banner":
						include "./hpdata/sejour/banner.php";
					$pagetype="hp";
						break;
		case "banner_mg":
						include "./hpdata/sejour/banner_mg.php";
					$pagetype="hp";
						break;
		case "room_cate":
						include "./hpdata/sejour/room_cate.php";
					$pagetype="hp";
						break;
		case "room_cate_reg":
						include "./hpdata/sejour/room_cate_reg.php";
					$pagetype="hp";
						break;
		case "room_turn":
						include "./hpdata/sejour/room_turn.php";
					$pagetype="hp";
						break;
		case "room_reg":
						include "./hpdata/sejour/room_reg.php";
					$pagetype="hp";
						break;
		case "map":
						include "./hpdata/sejour/map.php";
					$pagetype="hp";
						break;
		default:
						include "./hpdata/sejour/index.php";
					$pagetype="hp";
						break;
	} 	
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="golf.cubes.jp") {
	switch($_REQUEST["PID"]){
		case "topics":
						include "./hpdata/hanbai/topics.php";
					$pagetype="hp";
						break;
		case "topics_reg":
						include "./hpdata/hanbai/topics_reg.php";
					$pagetype="hp";
						break;
		case "topics_up":
						include "./hpdata/hanbai/topics_up.php";
					$pagetype="hp";
						break;
		default:
						include "./hpdata/hanbai/topics.php";
					$pagetype="hp";
						break;
	} 	
}
else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="marunitech.co.jp") {
	switch($_REQUEST["PID"]){
		case "company":
						include "./hpdata/maruni/company.php";
					$pagetype="hp";
						break;
		case "businesscategory":
						include "./hpdata/maruni/businesscategory.php";
					$pagetype="hp";
						break;
		case "businesscategory2":
						include "./hpdata/maruni/businesscategory2.php";
					$pagetype="hp";
						break;
		case "businesscategory3":
						include "./hpdata/maruni/businesscategory3.php";
					$pagetype="hp";
						break;
		case "construction":
						include "./hpdata/maruni/construction.php";
					$pagetype="hp";
						break;
		case "construction_machine":
						include "./hpdata/maruni/construction_machine.php";
					$pagetype="hp";
						break;
		case "construction_other":
						include "./hpdata/maruni/construction_other.php";
					$pagetype="hp";
						break;
		case "construction_processing":
						include "./hpdata/maruni/construction_processing.php";
					$pagetype="hp";
						break;
		case "contact":
						include "./hpdata/maruni/contact.php";
					$pagetype="hp";
						break;
		case "dynamicbalance":
						include "./hpdata/maruni/dynamicbalance.php";
					$pagetype="hp";
						break;
		case "link":
						include "./hpdata/maruni/link.php";
					$pagetype="hp";
						break;
		case "link_fuct":
						include "./hpdata/maruni/link_fuct.php";
					$pagetype="hp";
						break;
		case "link_other":
						include "./hpdata/maruni/link_other.php";
					$pagetype="hp";
						break;
		case "link_reg":
						include "./hpdata/maruni/link_reg.php";
					$pagetype="hp";
						break;
		case "recruit":
						include "./hpdata/maruni/recruit.php";
					$pagetype="hp";
						break;
		case "topics":
						include "./hpdata/maruni/topics.php";
					$pagetype="hp";
						break;
		case "topics_reg":
						include "./hpdata/maruni/topics_reg.php";
					$pagetype="hp";
						break;
		case "topics_up":
						include "./hpdata/maruni/topics_up.php";
					$pagetype="hp";
						break;
		default:
						include "./hpdata/maruni/index.php";
					$pagetype="hp";
						break;
	} 	
}
/* else 	if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="fsd-net.com") {
		   switch($_REQUEST["PID"]) {
								   		case "link":
								include "./link/d_top.php";
					$pagetype="hp";
						break;
		   		case "link_category":
					$pagetype="hp";
						include "./link/category.php";
						break;
		   		case "link_add":
						include "./link/addition.php";
					$pagetype="hp";
						break;
		   		case "link_up":
						include "./link/update.php";
					$pagetype="hp";
						break;
		   		case "link_details":
					include "./link/d_top.php";
							
					$pagetype="hp";
					break;
		   		case "link_d_add":
						include "./link/d_addition.php";
					$pagetype="hp";
					break;
		   		case "link_d_up":
						include "./link/d_update.php";
					$pagetype="hp";
						break;		   case "blog":
						$pagetype="hp";
						
							include "./fsd/blog/d_top.php";
						
						break;
		   case "blog_add":
						$pagetype="hp";
							include "./fsd/blog/addition.php";
						break;
		   case "blog_up":
						$pagetype="hp";
							include "./fsd/blog/update.php";
						break;
		   case "blog_list":
						$pagetype="hp";
							include "./fsd/blog/d_top.php";

						break;
						case "pagesetting":
					$pagetype="hp";
							include ("./fsd/setting/top.php");
							break;
		   case "blog_dadd":
						$pagetype="hp";
							include "./fsd/blog/d_addition.php";
						break;
		   case "blog_dup":
						$pagetype="hp";
							include "./fsd/blog/d_update.php";
						break;
					default:
							include "./fsd/blog/d_top.php";
					$pagetype="hp";
				}
		
	} */
	else {
		   switch($_REQUEST["PID"]) {
						//group ware
					/* todo */
					/*
						case "todo":
							$pagetype="gw";
							include ("./todo/box.php");
							break;
							
						case "plist":
							$pagetype="hp";
							include ("./plist/mf_plist.php");
							break;
												
						case "plist_reg":
							$pagetype="hp";
							include ("./plist/mf_plist_reg.php");
							break;

						case "plist_up":
							$pagetype="hp";
							include ("./plist/mf_plist_up.php");
							break;

						case "todo_endbox":
							$pagetype="gw";
							include ("./todo/endbox.php");
							break;
						case "todo_doing":
							$pagetype="gw";
							include ("./todo/doingbox.php");
							break;
						case "todo_readbox":
							$pagetype="gw";
							include ("./todo/readbox.php");
							break;
						case "todo_orderunendbox":
							$pagetype="gw";
							include ("./todo/orderunend.php");
							break;
						case "todo_orderendbox":
							$pagetype="gw";
							include ("./todo/orderend.php");
							break;
						case "todo_d":
							$pagetype="gw";
							include ("./todo/detail.php");
							break;
						case "todo_add":
							$pagetype="gw";
							include ("./todo/addition.php");
							break;
						case "todo_res":
							$pagetype="gw";
							include ("./todo/res.php");
							break;
						case "todo_del":
							$pagetype="gw";
							include ("./todo/delete.php");
							break;
						case "todo_up":
							include ("./todo/update.php");
							$pagetype="gw";
							break;*/
							

//group ware
								case "todo_cate_reg":
					$pagetype="gw";
							include ("./todo/cate_reg.php");
							break;							
								case "todo_cate_up":
					$pagetype="gw";
							include ("./todo/cate_up.php");
							break;							
						case "todo":
					$pagetype="gw";
							include ("./todo/box.php");
							break;
						case "todo_endbox":
					$pagetype="gw";
							include ("./todo/endbox.php");
							break;
						case "todo_doing":
					$pagetype="gw";
							include ("./todo/doingbox.php");
							break;
						case "todo_readbox":
					$pagetype="gw";
							include ("./todo/readbox.php");
							break;
						case "todo_orderunendbox":
					$pagetype="gw";
							include ("./todo/orderunend.php");
							break;
						case "todo_orderendbox":
					$pagetype="gw";
							include ("./todo/orderend.php");
							break;
						case "todo_d":
					$pagetype="gw";
							include ("./todo/detail.php");
							break;
						case "todo_add":
					$pagetype="gw";
							include ("./todo/addition.php");
							break;
						case "todo_res":
					$pagetype="gw";
							include ("./todo/res.php");
							break;
						case "todo_del":
					$pagetype="gw";
							include ("./todo/delete.php");
							break;
						case "todo_up":
							include ("./todo/update.php");
					$pagetype="gw";
							break;

					/* 携帯 */
			 case "keitai":
					include ("./keitai/index.php");
					$pagetype="gw";
					break;
					/* トピックスここから */
				case "topics_list":
					$pagetype="hp";
					if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="ark-plan.com"||str_replace("www.","",$_SERVER['HTTP_HOST'])=="arkplan.itcube.ne.jp"){
						include "./topics3/d_top.php";
					}
					else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
					include "./topics2/d_top.php";
						}
						else {
					include "./topics/d_top.php";
						}
					break;
		   case "topics":
					$pagetype="hp";
						if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="ark-plan.com"||str_replace("www.","",$_SERVER['HTTP_HOST'])=="arkplan.itcube.ne.jp"){
						include "./topics3/d_addition.php";
					}
					else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
								include "./topics2/d_addition.php";
						}
						else {
							include "./topics/d_addition.php";
						}
					break;
		   		case "topics_dadd":
					$pagetype="hp";
										if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="ark-plan.com"||str_replace("www.","",$_SERVER['HTTP_HOST'])=="arkplan.itcube.ne.jp"){
						include "./topics3/d_addition.php";
					}
					else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
					include "./topics2/d_addition.php";
						}
						else {
					include "./topics/d_addition.php";
						}
					break;
		   		case "topics_dup":
					$pagetype="hp";
					if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="ark-plan.com"||str_replace("www.","",$_SERVER['HTTP_HOST'])=="arkplan.itcube.ne.jp"){
						include "./topics3/d_update.php";
					}
					else if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
						include "./topics2/d_update.php";
					}
					else {
						include "./topics/d_update.php";
					}
					break;			
					/*  トピックスここまで*/		
						case "pagesetting":
							$pagetype="hp";
							include ("./pagesetting/top.php");
							break;
					/* 新着情報 */
					case "news":
					
					if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
					include "./news2/d_top.php";
					}
					else if($basicchk["use_chk"]==1) {
								include "./news2/d_top.php";
							
							}
							else {	
								include "./news/d_top.php";
							}
						$pagetype="hp";
					break;
		   		case "news_add":
					if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
							include "./news2/d_addition.php";
					}
					else if($basicchk["use_chk"]==1) {
								include "./news2/d_addition.php";
							
							}
							else {	
								include "./news/d_addition.php";
							}
					$pagetype="hp";
					break;
		   		case "news_up":
					if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
					
								include "./news2/d_update.php";
						
					}
					else 	if($basicchk["use_chk"]==1) {
								include "./news2/d_update.php";
							
							}
							else {	
								include "./news/d_update.php";
							}
					$pagetype="hp";
					break;
					/* 新着ここまで */
		   		case "info1":
					$pagetype="hp";
					include "./info1/category.php";
					break;
		   		case "info1_detailslist_src":
					$pagetype="hp";
						include "./info1/detailslist_src.php";
					break;
		   		case "info1_category":
					$pagetype="hp";
					include "./info1/category.php";
					break;
		   		case "info1_setting":
					$pagetype="hp";
					include "./info1/setting.php";
					break;
		   		case "info1_add":
					$pagetype="hp";
					include "./info1/addition.php";
					break;
		   		case "info1_up":
					$pagetype="hp";
					include "./info1/update.php";
					break;
		   		case "info1_details":
					$pagetype="hp";
					include "./info1/d_top.php";
					break;
		   		case "info1_d_add":
					$pagetype="hp";
					include "./info1/d_addition.php";
					break;
		   		case "info1_d_up":
					$pagetype="hp";
					include "./info1/d_update.php";
					break;
		   		case "info2":
					include "./info2/category.php";
					$pagetype="hp";
					break;
		   		case "info2_detailslist_src":
					include "./info2/detailslist_src.php";
					$pagetype="hp";
					break;
		   		case "info2_category":
					include "./info2/category.php";
					$pagetype="hp";
					break;
		   		case "info2_setting":
					$pagetype="hp";
					include "./info2/setting.php";
					break;
		   		case "info2_add":
					$pagetype="hp";
					include "./info2/addition.php";
					break;
		   		case "info2_up":
					$pagetype="hp";
					include "./info2/update.php";
					break;
		   		case "info2_details":
					$pagetype="hp";
					include "./info2/d_top.php";
					break;
		   		case "info2_d_add":
					$pagetype="hp";
					include "./info2/d_addition.php";
					break;
		   		case "info2_d_up":
					$pagetype="hp";
					include "./info2/d_update.php";
					break;
									
		   		case "info3":
					include "./info3/category.php";
					$pagetype="hp";
					break;
		   		case "info3_detailslist_src":
					include "./info3/detailslist_src.php";
					$pagetype="hp";
					break;
		   		case "info3_category":
					include "./info3/category.php";
					$pagetype="hp";
					break;
		   		case "info3_setting":
					$pagetype="hp";
					include "./info3/setting.php";
					break;
		   		case "info3_add":
					$pagetype="hp";
					include "./info3/addition.php";
					break;
		   		case "info3_up":
					$pagetype="hp";
					include "./info3/update.php";
					break;
		   		case "info3_details":
					$pagetype="hp";
					include "./info3/d_top.php";
					break;
		   		case "info3_d_add":
					$pagetype="hp";
					include "./info3/d_addition.php";
					break;
		   		case "info3_d_up":
					$pagetype="hp";
					include "./info3/d_update.php";
					break;
					
		   		case "qanda":
					$pagetype="hp";
					include "./qanda/d_top.php";
					break;
		   		case "qanda_category":
					include "./qanda/category.php";
					$pagetype="hp";
					break;
		   		case "qanda_setting":
					include "./qanda/setting.php";
					$pagetype="hp";
					break;
		   		case "qanda_add":
					include "./qanda/addition.php";
					break;
		   		case "qanda_up":
					$pagetype="hp";
					include "./qanda/update.php";
					break;
		   		case "qanda_details":
					include "./qanda/d_top.php";
					$pagetype="hp";
					break;
		   		case "qanda_d_add":
					include "./qanda/d_addition.php";
					$pagetype="hp";
					break;
					$pagetype="hp";
		   		case "qanda_d_up":
					include "./qanda/d_update.php";
					break;
		   		case "staff":
					$pagetype="hp";
					include "./staff/d_top.php";
					break;
		   		case "staff_setting":
					include "./staff/setting.php";
					$pagetype="hp";
					break;
		   		case "staff_add":
					include "./staff/d_addition.php";
					$pagetype="hp";
					break;
		   		case "staff_up":
					$pagetype="hp";
					include "./staff/d_update.php";
					break;
		   		case "staff_details":
					$pagetype="hp";
					include "./staff/d_top.php";
					break;
		   		case "staff_d_add":
					$pagetype="hp";
						include "./staff/d_addition.php";
						break;
		   		case "staff_d_up":
						include "./staff/d_update.php";
					$pagetype="hp";
						break;
		   		case "setting":
							if($basicchk["use_chk"]==1) {
								include "./setting/basic.php";
							}
							else {
								include "./setting/top.php";
							}
							$pagetype="hp";
						break;
		   		case "company":
					$pagetype="hp";
						include "./company/top.php";
						break;		
		   		case "company1":
					$pagetype="hp";
						include "./company1/top.php";
						break;
		   		case "company1_details":
					$pagetype="hp";
						include "./company1/details.php";
						break;
		   		case "company1_list_src":
					$pagetype="hp";
						include "./company1/list_src.php";
						break;
		   		case "company1_setting":
					$pagetype="hp";
						include "./company1/setting.php";
						break;
		   		case "company2":
					$pagetype="hp";
						include "./company2/top.php";
						break;
		   		case "company2_detailslist_src":
					$pagetype="hp";
						include "./company2/detailslist_src.php";
						break;
		   		case "company2_list_src":
					$pagetype="hp";
						include "./company2/list_src.php";
						break;
		   		case "company2_setting":
					$pagetype="hp";
						include "./company2/setting.php";
						break;
		   		case "company3":
					$pagetype="hp";
						include "./company3/top.php";
						break;
		   		case "company3_setting":
					$pagetype="hp";
						include "./company3/setting.php";
						break;
		   		case "link":
							if($basicchk["use_chk"]==1) {
								include "./link2/category.php";
								
							}else if($_SERVER['HTTP_HOST']=="arkplan.itcube.ne.jp"){
								include "./link3/d_top.php";
							}
							else {
								include "./link/top.php";
						}
					$pagetype="hp";
						break;
		   		case "link_category":
					$pagetype="hp";
							if($basicchk["use_chk"]==1) {
								if($_SERVER['HTTP_HOST']=="altus.itcube.ne.jp"||str_replace("www.","",$_SERVER["HTTP_HOST"])=="e-altus.com"){
										$_REQUEST["cate_id"]=1;
										include "./link2/d_top.php";
								}
								else {
										include "./link2/category.php";
									}
							}
							else {
									include "./link/category.php";
						}
						break;
		   		case "link_add":
							if($basicchk["use_chk"]==1) {
						include "./link2/addition.php";
								
							}else {
						include "./link/addition.php";
						}
					$pagetype="hp";
						break;
		   		case "link_up":
						include "./link/update.php";
					$pagetype="hp";
						break;
		   		case "link_details":
							if($basicchk["use_chk"]==1) {
					include "./link2/d_top.php";
								
							}else {
					include "./link/d_top.php";
						}
							
					$pagetype="hp";
					break;
		   		case "link_d_add":
							if($basicchk["use_chk"]==1) {
						include "./link2/d_addition.php";
								
							}else if($_SERVER['HTTP_HOST']=="arkplan.itcube.ne.jp") {
							
						include "./link3/d_addition.php";
							}
							else {
						include "./link/d_addition.php";
						}
					$pagetype="hp";
					break;
		   		case "link_d_up":
						include "./link/d_update.php";
					$pagetype="hp";
						break;
		   		case "domain":
						include "./domain/top.php";
						break;
						//group ware
						case "message":
					$pagetype="gw";
							include ("./message/box.php");
							break;
						case "message_sendbox":
					$pagetype="gw";
							include ("./message/sendbox.php");
							break;
						case "message_readbox":
					$pagetype="gw";
							include ("./message/readbox.php");
							break;
						case "message_d":
					$pagetype="gw";
							include ("./message/detail.php");
							break;
						case "mes_add":
					$pagetype="gw";
							include ("./message/addition.php");
							break;
						case "message_res":
					$pagetype="gw";
							include ("./message/res.php");
							break;
						case "message_del":
					$pagetype="gw";
							include ("./message/delete.php");
							break;
						case "mes_up":
							include ("./message/update.php");
					$pagetype="gw";
							break;
						case "pageup":
					$pagetype="gw";
							include ("./page_up.php");
							break;
						case "bbs":
					$pagetype="gw";
							include ("./bbs/allsled.php");
							break;
						case "bbs_sled":
					$pagetype="gw";
							include ("./bbs/sled.php");
							break;
						case "add_log":
					$pagetype="gw";
							include ("./bbs/add_log.php");
							break;
						case "bbs_allsled":
					$pagetype="gw";
							include ("./bbs/allsled.php");
							break;
						case "del_log":
					$pagetype="gw";
							include ("./bbs/del_log.php");
							break;
						case "add_theme":
					$pagetype="gw";
							include ("./bbs/add_theme.php");
							break;
						case "bbs_addtopics":
					$pagetype="gw";
							include ("./bbs/add_topics.php");
							break;
						case "bbs_topics":
					$pagetype="gw";
							include ("./bbs/alltopics.php");
							break;
						case "del_theme":
							$pagetype="gw";
							include ("./bbs/del_thema.php");
							break;
						case "del_topics":
							$pagetype="gw";
							include ("./bbs/del_topics.php");

							break;
						case "up_theme":
							$pagetype="gw";
							include ("./bbs/up_thema.php");

							break;
						case "up_log":
							$pagetype="gw";
							include ("./bbs/up_log.php");

							break;
						case "up_topics":
							$pagetype="gw";
							include ("./bbs/up_topics.php");

							break;
						case "files":
					$pagetype="gw";
							include ("./files/top.php");
							break;
						case "files_cate":
					$pagetype="gw";
							include ("./files/cate.php");
							break;
						case "files_cateup":
							include ("./files/cate_update.php");
					$pagetype="gw";
							break;
						case "files_cateadd":
					$pagetype="gw";
							include ("./files/cate_addition.php");
							break;
						case "files_add":
					$pagetype="gw";
							include ("./files/addition.php");
							break;
						case "files_up":
							include ("./files/update.php");
					$pagetype="gw";
							break;
						case "schedule":
							include ("./schedule/top.php");
					$pagetype="gw";
							break;
						case "sche_d":
							include ("./schedule/detail.php");
					$pagetype="gw";
							break;
						case "sche_up":
							include ("./schedule/update2.php");
					$pagetype="gw";
							break;
						case "sche_up1":
					$pagetype="gw";
							include ("./schedule/update1.php");
							break;
						case "sche_up2":
					$pagetype="gw";
							include ("./schedule/update2.php");
							break;
						case "sche_up3":
					$pagetype="gw";
							include ("./schedule/update3.php");
							break;
						case "sche_add":
					$pagetype="gw";
							include ("./schedule/addition.php");
							break;
						case "sche_attend":
					$pagetype="gw";
							include ("./schedule/attend.php");
							break;
						case "sche_add2":
					$pagetype="gw";
							include ("./schedule/addition2.php");
							break;
						case "sche_add3":
					$pagetype="gw";
							include ("./schedule/addition3.php");
							break;
						case "sche_mail_send":
							include ("./schedule/mail_send.php");
					$pagetype="gw";
							break;
				case "ScheduleSearch":
				include ("./schedule/search.php");
									$pagetype="gw";
				break;
						case "act":
							include ("./act/top.php");
					$pagetype="gw";
							break;
						case "act_cate":
							include ("./act/cate.php");
					$pagetype="gw";
							break;
						case "act_cateup":
					$pagetype="gw";
							include ("./act/cate_update.php");
							break;
						case "act_cateadd":
							include ("./act/cate_addition.php");
					$pagetype="gw";
							break;
						case "act_add":
							include ("./act/addition.php");
							break;
						case "act_up":
							include ("./act/update.php");
							break;
						case "pageedit":
							include ("./pageedit.php");
					$pagetype="gw";
							break;
						case "toppage":
							include ("./toppage.php");
							break;
						case "group":
					$pagetype="gw";
							include ("./group/index.php");
							break;
						case "group_add":
					$pagetype="gw";
							include ("./group/addition.php");
							break;
						case "group_up":
							include ("./group/update.php");
						$pagetype="gw";
						break;
	/*
	 *メール配信
		*/					
						case "mail":
							include ("./mail/index.php");
					$pagetype="gw";
							break;
						case "mail_template":
							include ("./mail/temp.php");
					$pagetype="gw";
							break;
						case "mailtemp_reg":
							include ("./mail/tempregist.php");
							$pagetype="gw";
							break;
						case "mailtemp_up":
							include ("./mail/tempupdate.php");
							$pagetype="gw";
							break;
	/*
	 *ユーザー管理
	 */					
					case "members":
							include "./members/index.php";
					$pagetype="gw";
							break;
						case "members_add":
							include "./members/addition.php";
					$pagetype="gw";
							break;
						case "members_correct":
							include "./members/correction.php";
					$pagetype="gw";
							break;
						case "members_del":
					$pagetype="gw";
							include "./members/delete.php";
							break;
						/*
						 *fudousan
							*/
						//fudousan
						case "re_inputcsv":
					$pagetype="fudousan";
							include "./realestate/inputcsv.php";
							break;
						case "re_c1":
						$pagetype="fudousan";
						include "./realestate/c1/top.php";
							break;
						case "re_c1_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c1/replace2.php";
					}
					else {
							include "./realestate/c1/replace.php";
						}
							break;
						case "re_c1_del":
					$pagetype="fudousan";
							include "./realestate/c1/delete.php";
							break;			
						case "re_c1_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c1/addition2.php";
					}
					else {
							include "./realestate/c1/addition.php";
						}
							break;
						case "re_c1_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c1/copy2.php";
					}
					else {
							include "./realestate/c1/copy.php";
						}
							break;
						case "re_c1_set":
					$pagetype="fudousan";
							include "./realestate/c1/setting.php";
							break;
						case "re_c2_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c2/copy2.php";
					}
					else {
							include "./realestate/c2/copy.php";
						}
							break;
						case "re_c3_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c3/copy2.php";
					}
					else {
							include "./realestate/c3/copy.php";
						}
							break;
						case "re_b1_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b1/copy2.php";
					}
					else {
							include "./realestate/b1/copy.php";
						}
							break;
						case "re_b2_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b2/copy2.php";
					}
					else {
							include "./realestate/b2/copy.php";
						}
							break;
						case "re_b3_copy":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b3/copy2.php";
					}
					else {
							include "./realestate/b3/copy.php";
						}
							break;
						case "re_c2":
					$pagetype="fudousan";
							include "./realestate/c2/top.php";
							break;
						case "re_c2_set":
					$pagetype="fudousan";
							include "./realestate/c2/setting.php";
							break;
						case "re_c2_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c2/addition2.php";
					}
					else {
							include "./realestate/c2/addition.php";
						}
							break;
						case "re_c2_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c2/replace2.php";
					}
					else {
							include "./realestate/c2/replace.php";
						}
							break;
						case "re_c2_del":
					$pagetype="fudousan";
							include "./realestate/c2/delete.php";
							break;			
						case "re_c3_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/c3/addition2.php";
					}
					else {
							include "./realestate/c3/addition.php";
						}
							break;
						case "re_c3":
					$pagetype="fudousan";
							include "./realestate/c3/top.php";
							break;
						case "re_c3_set":
					$pagetype="fudousan";
							include "./realestate/c3/setting.php";
							break;
						case "re_c3_rep":
						$pagetype="fudousan";
						if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
								include "./realestate/c3/replace2.php";
						}
						else {
							include "./realestate/c3/replace.php";
						}
							break;
						case "re_c3_del":
					$pagetype="fudousan";
							include "./realestate/c3/delete.php";
							break;			
						case "re_b1":
					$pagetype="fudousan";
							include "./realestate/b1/top.php";
							break;
						case "re_b1_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b1/replace2.php";
					}
					else {
							include "./realestate/b1/replace.php";
						}
							break;
						case "re_b1_del":
					$pagetype="fudousan";
							include "./realestate/b1/delete.php";
							break;			
						case "re_b1_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b1/addition2.php";
					}
					else {
							include "./realestate/b1/addition.php";
						}
							break;
						case "re_b1_set":
					$pagetype="fudousan";
							include "./realestate/b1/setting.php";
							break;
						case "re_b2":
					$pagetype="fudousan";
							include "./realestate/b2/top.php";
							break;
						case "re_b2_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b2/addition2.php";
					}
					else {
							include "./realestate/b2/addition.php";
						}
							break;
						case "re_b2_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b2/replace2.php";
					}
					else {
							include "./realestate/b2/replace.php";
						}
							break;
						case "re_b2_del":
					$pagetype="fudousan";
							include "./realestate/b2/delete.php";
							break;			
						case "re_b2_set":
					$pagetype="fudousan";
							include "./realestate/b2/setting.php";
							break;
						case "re_b3":
					$pagetype="fudousan";
							include "./realestate/b3/top.php";
							break;
						case "re_b3_rep":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b3/replace2.php";
					}
					else {
							include "./realestate/b3/replace.php";
						}
							break;
						case "re_b3_del":
					$pagetype="fudousan";
							include "./realestate/b3/delete.php";
							break;			
						case "re_b3_add":
					$pagetype="fudousan";
					if($fudousanschk["use_chk"]==1||$_SESSION["DomainData"]["dbtype"]=="mysql") { 
							include "./realestate/b3/addition2.php";
					}
					else {
							include "./realestate/b3/addition.php";
						}
							break;
						case "re_b3_set":
					$pagetype="fudousan";
							include "./realestate/b3/setting.php";
							break;
						case "re_tenpo_up":
					$pagetype="fudousan";
							include "./realestate/tenpo.php";
							break;			
						case "re_area":
					$pagetype="fudousan";
							include "./realestate/area/top.php";
							break;
						case "re_area_clist":
					$pagetype="fudousan";
							include "./realestate/area/clist.php";
							break;
						case "re_area_up":
					$pagetype="fudousan";
							include "./realestate/area/update.php";
							break;
						case "re_chiikilist":
					$pagetype="fudousan";
							include "./realestate/area/update.php";
							break;
						case "re_area_chiiki_reg":
					$pagetype="fudousan";
							include "./realestate/area/creg.php";
							break;
						case "re_area_del":
					$pagetype="fudousan";
							include "./realestate/area/delete.php";
							break;
						case "re_setting":
					$pagetype="fudousan";
							include "./realestate/c1/setting.php";
							break;
						case "re_osetting":
					$pagetype="fudousan";
							include "./realestate/oset.php";
							break;
							/*
							 * 販促
								*/
						case "promo_dm":
					$pagetype="promo";
							include "./promo/dm.php";
							break;
						case "promo_dm_reg":
					$pagetype="promo";
							include "./promo/dm_reg.php";
							break;
						case "promo_dm_up":
					$pagetype="promo";
							include "./promo/dm_up.php";
							break;
						case "promo_dm_copy":
					$pagetype="promo";
							include "./promo/dm_copy.php";
							break;
						case "promo_dm_del":
					$pagetype="promo";
							include "./promo/dm_del.php";
							break;
						case "promo_dm_preview":
					$pagetype="promo";
							include "./promo/dm_preview.php";
							break;
						case "promo_customer":
					$pagetype="promo";
							include "./promo/customer.php";
							break;
						case "promo_customer_reg":
					$pagetype="promo";
							include "./promo/customer_reg.php";
							break;
						case "promo_customer_up":
					$pagetype="promo";
							include "./promo/customer_up.php";
							break;
						case "promo_customer_del":
					$pagetype="promo";
							include "./promo/customer_del.php";
							break;
						case "promo_dmtemp":
					$pagetype="promo";
							include "./promo/dmtemp.php";
							break;
						case "promo_dmtemp_reg":
					$pagetype="promo";
							include "./promo/dmtemp_reg.php";
							break;
						case "promo_dmtemp_up":
					$pagetype="promo";
							include "./promo/dmtemp_up.php";
							break;
						case "promo_dmtemp_del":
					$pagetype="promo";
							include "./promo/dmtemp_del.php";
							break;
						case "promo_setting":
					$pagetype="promo";
							include "./promo/setting.php";
							break;
						case "promo_coupon":
					$pagetype="promo";
							include "./promo/coupon.php";
							break;
						case "promo_coupon_reg":
					$pagetype="promo";
							include "./promo/coupon_reg.php";
							break;
						case "promo_coupon_up":
					$pagetype="promo";
							include "./promo/coupon_up.php";
							break;
						case "promo_coupon_del":
					$pagetype="promo";
							include "./promo/coupon_del.php";
							break;
						case "spot_visiter":
					$pagetype="spot";
							include "./spot/visiter.php";
							break;
						case "spot_vister_reg":
					$pagetype="spot";
							include "./spot/visiter_reg.php";
							break;
						case "spot_visiter_up":
					$pagetype="spot";
							include "./spot/visiter_up.php";
							break;
/* コンテンツ */							
		   		case "contents":
					$pagetype="hp";
					include "./contents/top.php";
					break;
		   		case "contents_detailslist_src":
					$pagetype="hp";
						include "./contents/detailslist_src.php";
					break;
		   		case "contents_category":
					$pagetype="hp";
					include "./contents/category.php";
					break;
		   		case "contents_setting":
					$pagetype="hp";
					include "./contents/setting.php";
					break;
		   		case "contents_add":
					$pagetype="hp";
					include "./contents/addition.php";
					break;
		   		case "contents_up":
					$pagetype="hp";
					include "./contents/update.php";
					break;
		   		case "contents_details":
					$pagetype="hp";
					include "./contents/d_top.php";
					break;
		   		case "contents_d_add":
					$pagetype="hp";
					include "./contents/d_addition.php";
					break;
		   		case "contents_d_up":
					$pagetype="hp";
					include "./contents/d_update.php";
					break;
							
/* コンテンツ終了 */
  		case "contents1":
					$pagetype="hp";
					include "./contents1/category.php";
					break;
		   		case "contents1_detailslist_src":
					$pagetype="hp";
						include "./contents1/detailslist_src.php";
					break;
		   		case "contents1_category":
					$pagetype="hp";
					include "./contents1/category.php";
					break;
		   		case "contents1_setting":
					$pagetype="hp";
					include "./contents1/setting.php";
					break;
		   		case "contents1_add":
					$pagetype="hp";
					include "./contents1/addition.php";
					break;
		   		case "contents1_up":
					$pagetype="hp";
					include "./contents1/update.php";
					break;
		   		case "contents1_details":
					$pagetype="hp";
					include "./contents1/d_top.php";
					break;
		   		case "contents1_d_add":
					$pagetype="hp";
					include "./contents1/d_addition.php";
					break;
		   		case "contents1_d_up":
					$pagetype="hp";
					include "./contents1/d_update.php";
					break;
		   		case "contents2":
					$pagetype="hp";
					include "./contents2/category.php";
					break;
		   		case "contents2_detailslist_src":
					$pagetype="hp";
					include "./contents2/detailslist_src.php";
					break;
		   		case "contents2_category":
					$pagetype="hp";
					include "./contents2/category.php";
					break;
		   		case "contents2_setting":
					$pagetype="hp";
					include "./contents2/setting.php";
					break;
		   		case "contents2_add":
					$pagetype="hp";
					include "./contents2/addition.php";
					break;
		   		case "contents2_up":
					$pagetype="hp";
					include "./contents2/update.php";
					break;
		   		case "contents2_details":
					$pagetype="hp";
					include "./contents2/d_top.php";
					break;
		   		case "contents2_d_add":
					$pagetype="hp";
					include "./contents2/d_addition.php";
					break;
		   		case "contents2_d_up":
					$pagetype="hp";
					include "./contents2/d_update.php";
					break;
					/* ブログコンテンツ */
		   case "blog":
						$pagetype="hp";
						
						if($basicchk["use_chk"]==1) {
							include "./blog2/top.php";
						}
						else {
							include "./blog/top.php";
						}
						
						break;
		   case "blog_add":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/addition.php";
						}
						else {
							include "./blog/addition.php";
						}
						break;
		   case "blog_up":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/update.php";
						}
						else {
							include "./blog/update.php";
						}
						break;
		   case "blog_list":
						$pagetype="hp";

						if($basicchk["use_chk"]==1) {
							include "./blog2/d_top.php";
						}
						else {
							include "./blog/d_top.php";
						}

						break;
		   case "blog_dadd":
						$pagetype="hp";
						if($basicchk["use_chk"]==1) {
							include "./blog2/d_addition.php";
						}
						else {
							include "./blog/d_addition.php";
						}
						break;
		   case "blog_dup":
						$pagetype="hp";

						if($basicchk["use_chk"]==1) {
							include "./blog2/d_update.php";
						}
						else {
							include "./blog/d_update.php";
						}

						break;
					
					/* ブログコンテンツ */
					
		   		case "news_setting":
					$pagetype="hp";
					include "./news/setting.php";
					break;
					case "banner":
					$pagetype="hp";
					if($basicchk["use_chk"]==1) {
						include "./banner2/d_update.php";
						
					}
					else {
						include "./banner/d_top.php";
					}
					break;
		   		case "banner_add":
					$pagetype="hp";
					include "./banner/d_addition.php";
					break;
		   		case "banner_up":
					$pagetype="hp";
					include "./banner/d_update.php";
					break;
		   		case "vup":
					$pagetype="hp";
					include "./vup/top.php";
					break;
		   		case "vup_d":
					$pagetype="hp";
					include "./vup/details.php";
					break;
case "address_top":
include ("./address/index.php");
					$pagetype="gw";
break;
case "address":
					$pagetype="gw";
include ("./address/tantou.php");
break;
case "address_regist":
include ("./address/regist.php");
					$pagetype="gw";
break;
case "address_update":
include ("./address/update.php");
					$pagetype="gw";
break;
case "address_delete":
include ("./address/delete.php");
					$pagetype="gw";
break;
case "address_tantou":
					$pagetype="gw";
				include ("./address/tantou.php");
break;
case "address_inputcsv":
					$pagetype="gw";
					include ("./address/inputcsv.php");
break;
case "tenpo":
					$pagetype="gw";
include ("./tenpo/index.php");
break;
case "hp_basic_contents_category":
						include "./hpdata/basic/mf_contents_category.php";
					$pagetype="hp";
break;
case "hp_contents_details":
						include "./hpdata/basic/mf_about.php";
					$pagetype="hp";
break;
case "hp_basic_link_category":
						include "./hpdata/basic/mf_link_category.php";
					$pagetype="hp";
break;
case "hp_basic_link_category_reg":
						include "./hpdata/basic/mf_link_category_reg.php";
					$pagetype="hp";
break;
case "hp_basic_link_d":
						include "./hpdata/basic/mf_link.php";
					$pagetype="hp";
break;
case "hp_basic_banner":
						include "./hpdata/basic/mf_banner.php";
					$pagetype="hp";
break;
case "hp_basic_news":
						include "./hpdata/basic/mf_news.php";
					$pagetype="hp";
break;
case "hp_basic_news_reg":
						include "./hpdata/basic/mf_news_reg.php";
					$pagetype="hp";
break;
case "hp_basic_contents_category_reg":
						include "./hpdata/basic/mf_contents_category_reg.php";
					$pagetype="hp";
break;
case "basic_blog_lineup":
						include "./hpdata/basic/mf_blog_lineup.php";
					$pagetype="hp";
break;
case "hp_basic_blog_closeup":
						include "./hpdata/basic/mf_blog_closeup.php";
					$pagetype="hp";
break;
case "hp_basic_menu":
						include "./hpdata/basic/mf_menu.php";
					$pagetype="hp";
break;
case "hp_basic_pagesetting":
						include "./hpdata/basic/mf_pagesetting.php";
					$pagetype="hp";
break;
case "hp_basic_blog_cate":
						include "./hpdata/basic/mf_blog_cate.php";
					$pagetype="hp";
break;
case "hp_basic_blog_cate_reg":
						include "./hpdata/basic/mf_blog_cate_reg.php";
					$pagetype="hp";
break;
case "basic_blog_reg":
						include "./hpdata/basic/mf_blog_reg.php";
					$pagetype="hp";
break;
case "hp_basic_contact":
						include "./hpdata/basic/mf_contact.php";
					$pagetype="hp";
break;

case "hp_basic_link_reg":
						include "./hpdata/basic/mf_link_reg.php";
					$pagetype="hp";
break;
case "pop":
$pagetype="fudousan";
include ("./realestate/pop/poptop.php");
	break;
case "selpop":
					$pagetype="fudousan";
include ("./realestate/pop/selpop2.php");
	
	break;
case "popselect":
					$pagetype="fudousan";
include ("./realestate/pop/popselectc1.php");
	
	break;
case "popselectc1":
					$pagetype="fudousan";
include ("./realestate/pop/popselectc1.php");
	
	break;	
case "popselectc2":
					$pagetype="fudousan";
include ("./realestate/pop/popselectc2.php");
	
	break;	
case "popselectc3":
					$pagetype="fudousan";
include ("./realestate/pop/popselectc3.php");
	
	break;	
case "popselectb1":
					$pagetype="fudousan";
include ("./realestate/pop/popselectb1.php");
	
	break;	
case "popselectb2":
					$pagetype="fudousan";
include ("./realestate/pop/popselectb2.php");
	
	break;	
case "popselectb3":
					$pagetype="fudousan";
include ("./realestate/pop/popselectb3.php");
	
	break;	
case "popreg":
					$pagetype="fudousan";
include ("./realestate/pop/popreg.php");
	
	break;	
case "popdesign":
					$pagetype="fudousan";
include ("./realestate/pop/selpopdsign.php");
	
	break;	

	case "alcontents":
					$pagetype="hp";
						include "./alcontents/category.php";
						break;
	case "alcontents_details":
					$pagetype="hp";
						include "./alcontents/d_top.php";
						break;
						
	case "alcontents_d_add":
					$pagetype="hp";
						include "./alcontents/d_addition.php";
						break;
	case "alcontents_d_up":
					$pagetype="hp";
						include "./alcontents/d_update.php";
						break;
	case "alcontents_up":
					$pagetype="hp";
						include "./alcontents/d_update.php";
						break;
						
	case "roomguide":
					$pagetype="hp";
						include "./roomguide/index.php";
						break;
	case "buyguide":
					$pagetype="hp";
						include "./buyguide/index.php";
						break;
	case "sellguide":
					$pagetype="hp";
						include "./sellguide/index.php";
						break;
	case "recruits":
					$pagetype="hp";
						include "./recruits/index.php";
						break;
										/* 新着情報 */
					case "alnews":
							
								include "./alnews/d_top.php";
							
						$pagetype="hp";
					break;
		   		case "alnews_add":
								include "./alnews/d_addition.php";
							
					$pagetype="hp";
					break;
		   		case "alnews_up":
								$pagetype="hp";
								include "./alnews/d_update.php";
							break;
   		case "al_qa":
					$pagetype="hp";
					include "./alqanda/category.php";
					break;
		   		case "al_qa_category":
					include "./alqanda/category.php";
					$pagetype="hp";
					break;
		   		case "al_qa_setting":
					include "./alqanda/setting.php";
					$pagetype="hp";
					break;
		   
						case "al_qa_add":	
						$pagetype="hp";
					include "./alqanda/addition.php";
					break;
		   		case "al_qa_up":
					$pagetype="hp";
					include "./alqanda/update.php";
					break;
		   		case "al_qa_details":
					include "./alqanda/d_top.php";
					$pagetype="hp";
					break;
		   		case "al_qa_d_add":
					include "./alqanda/d_addition.php";
					$pagetype="hp";
					break;
				
		   		case "al_qa_d_up":
					include "./alqanda/d_update.php";	
					$pagetype="hp";
					break;
	  		case "al_fp":
					include "./alflashphoto/index.php";	
					$pagetype="hp";
					break;

					default:
						if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="nest-h.com"){
							include "./topics2/d_top.php";
						}
						else 	if($basicchk["use_chk"]==1) {
										include "./hpdata/basic/index.php";
					$pagetype="hp";
					}
					else if($_SESSION["DomainData"]["dbtype"]=="mysql"||$_SESSION["DomainData"]["domain_name"]=="cubes.jp") {
					$pagetype="hp";
					include "./topics/d_top.php";
}
else {
					$pagetype="gw";
						include "./top.php";

}
						break;
		   }
							
				}	
if($realestatechk["use_chk"]==1){
	$pagetype="fudousan";
}
		   ?></td>
							</tr>
							<tr>
									<td align="left" valign="top">&nbsp;</td>
							</tr>
					</table>
      </td> 
      <td width="10" align="left" valign="top" background="img/template/right.jpg"><img src="img/template/right.jpg" width="9" height="839"></td> 
    </tr> 
    <tr> 
      <td align="left" valign="top"><img src="img/template/foot1.jpg" width="9" height="73"></td> 
    	<td align="left" valign="top">
    			<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
									<td width="370"><img src="img/template/foot2.jpg" width="370" height="73"></td>
									<td background="img/template/foot3.jpg"><img src="img/template/foot3.jpg" width="11" height="73"></td>
									<td width="369"><img src="img/template/foot4.jpg" width="369" height="73" border="0" usemap="#footMap2"></td>
							</tr>
					</table>
    	</td>
    	<td align="left" valign="top"><img src="img/template/foot5.jpg" width="9" height="73"></td>
    </tr> 
  </table> 
</div> 
<map name="Map3" id="Map3">
		<area shape="rect" coords="89,5,157,78" href="?PID=re_area">
</map>
<map name="footMap2" id="footMap2">
		<area shape="rect" coords="295,20,357,44" href="?logout=1" />
<area shape="rect" coords="131,19,193,43" href="index.php" />
<area shape="rect" coords="199,22,280,42" href="http://<?php echo $_SESSION["DomainData"]["domain_name"];?>" target="_blank" />
</map>											<map name="SM_HEADMap" id="SM_HEADMap">
													<area shape="rect" coords="346,43,427,80" href="?logout=1" />
													<area shape="rect" coords="199,44,258,73" href="index.php" />
											<area shape="rect" coords="265,43,339,70" target="_blank" href="http://<?php echo $_SERVER['HTTP_HOST'];?>" /></map>
<script type="text/javascript">
selmenu('<?php echo $pagetype ?>');
</script>

</body>
</html>
<?php
}
else {
?>
<script language="JavaScript" type="text/javascript">
location.replace("/GW/");
</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>フジテクノ管理ページ</title>
<script type="text/javascript"><!--
function selchange(frm) {
	newsid=document.form2.news.selectedIndex;
//	alert(newsid);
	if(frm.news.options[newsid].value==0) {
		document.all("tb_sub_news").style.display="none";
	}
	else {
		document.all("tb_sub_news").style.display="block";
	}
	
	sekouid=frm.sekou.selectedIndex;
	
	if(frm.sekou.options[sekouid].value==0) {
		document.all("tb_sub_sekou").style.display="none";
	}
	else {
		document.all("tb_sub_sekou").style.display="block";
	}
	
	sekouinfo_id=frm.sekou_info.selectedIndex;
	
	if(frm.sekou_info.options[sekouinfo_id].value==0) {
		document.all("tb_sub_sekouinfo").style.display="none";
	}
	else {
		document.all("tb_sub_sekouinfo").style.display="block";
	}
	
	linkid=frm.link.selectedIndex;
	
	if(frm.link.options[linkid].value==0) {
		document.all("tb_sub_link").style.display="none";
	}
	else {
		document.all("tb_sub_link").style.display="block";
	}
}

// --></script>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#CCCCCC"> 
<div align="center"> <a name="top" id="top"></a> 
  <table width="100%" border="0" cellpadding="0" cellspacing="0" id="container"> 
    <tr> 
      <td valign="bottom"> <div align="center"><a href="index.php"><img src="/CUBE_IMG/loginheader.jpg" width="715" height="79" border="0" usemap="#MapMap" align="ホームページ管理ツール"></a></div> </td> 
    </tr> 
    <tr> 
      <td> <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0"> 
          <tr> 
            <td width="" height="400" valign="top"> <div align="center"> 
                <div id="div"> 
                  <table width="100%" border="0" align="center"> 
                    <tr> 
                      <td valign="top">&nbsp;</td> 
                    </tr> 
                    <tr> 
                      <td valign="top">&nbsp;</td> 
                    </tr> 
                    <tr> 
                      <td valign="top">&nbsp;</td> 
                    </tr> 
                    <tr> 
                      <td height="400" valign="top"> <table width="400"  border="0" align="center" cellpadding="2" cellspacing="2"> 
                          <form name="loginform1" id="loginform1" method="get" action=""> 
                            <tr> 
                              <td>ログインID</td> 
                              <td> <input name="loginid" type="text" id="loginid" value="<?php echo $_GET["loginid"] ;?>" size="30"> </td> 
                            </tr> 
                            <tr> 
                              <td>パスワード</td> 
                              <td> <input name="password" type="password" id="password" value="<?php echo $_GET["password"] ;?>" size="30"> </td> 
                            </tr> 
                            <tr> 
                              <td>&nbsp;</td> 
                              <td> <input name="btm_login" type="submit" id="btm_login" value="ログイン"> </td> 
                            </tr> 
                          </form> 
                        </table> </td> 
                    </tr> 
                    <tr> 
                      <td height="20">&nbsp;</td> 
                    </tr> 
                  </table> 
                </div> 
              </div> </td> 
          </tr> 
        </table> </td> 
    </tr> 
    <tr> 
      <td>&nbsp; </td> 
    </tr> 
    <tr> 
      <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"> 
          <tr> 
            <td width="35%" background="/image/temp/footer_bg.gif"><img src="img/siteadmin/footer_itc_logo.gif" width="247" height="18"></td> 
            <td width="65%" align="right" valign="bottom" background="/image/temp/footer_bg.gif">&nbsp;</td> 
          </tr> 
          <tr> 
            <td colspan="2"> <div align="right"><a href="http://itcube.jp" target="_blank"> 
                <!-- --> 
                </a></div> </td> 
          </tr> 
        </table> </td> 
    </tr> 
  </table> 
  <map name="MapMap" id="MapMap"> 
    <area shape="rect" coords="498,51,550,80" href="index.php" alt="HOMEへ戻る"> 
    <area shape="rect" coords="553,50,628,80" href="s" target="_blank" alt="サイトを見る"> 
    <area shape="rect" coords="634,52,704,78" href="/?logout=1" alt="ログアウト"> 
  </map> 
</div> 
</body>
</html>
<?php

}
?>
