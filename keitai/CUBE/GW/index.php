<?php 
session_start(); 
mb_language("japanese");
mb_internal_encoding("euc-jp");
$_SESSION["new_htmldata"]="";
include "ITC/modules.php";
if($_SESSION["GW"]["domain"]==NULL&&$_REQUEST["domain"]!=NULL) {
	$_SESSION["GW"]["domain"]=$_REQUEST["domain"];
}
else if($_SESSION["GW"]["domain"]==NULL) {
	exit('<script language="javascript">location.replace("logon.php");</script>');
}
else {
	$_SESSION["GW"]["domain"]=$_SESSION["GW"]["domain"];
}

//print_r($_SESSION);
$usedb="postgresql";
//echo "koko1";

$adminobj=Cube_DB :: UseDB($usedb);
$adminobj->name="itcube_admin";
$adminobj->Connect();
//echo "koko2";
$domaindata=$adminobj->GetData("select * from domain where domain_name = '".$_SESSION["GW"]["domain"]."'");
$dbobj=Cube_DB :: UseDB($domaindata["dbtype"]);
$dbobj->name=$domaindata["dbname"];
$dbobj->Connect();

if($_REQUEST["logout"]==1) {
	$_SESSION["GW"]["login_id"]="";
	$_SESSION["GW"]["login_pw"]="";
	
}

include "./login.php";
if($_SESSION["DomainData"]["domain_name"]=="itcube.jp") {
$debagtype=1;
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title><?php if(	$tenpodata["sm_title"]!=NULL) {echo $tenpodata["gwpc_title"]; }else { echo "グループウェア"; } ?></title>
<link href="style.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {	font-size: 12px
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
}
.bukkentable td{
	background-color:#FFFFFF;	
}
.bukkentable th {
	background-color:#ececFF;
	font-weight:normal;
}

-->
</style>
</head>
<body>
 <a name="top"></a>
		<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
						<td align="left" valign="top"><img src="img/template/head1.jpg" width="9" height="75"></td>
						<td align="left" valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="314"><img src="img/template/head2.jpg" width="314" height="75" border="0" usemap="#Map3Map"></td>
												<td background="img/template/head3.jpg">&nbsp;</td>
												<td width="430"><img src="img/template/head4.jpg" width="430" height="75" border="0" usemap="#MapMap"></td>
										</tr>
								</table>
								<map name="MapMap">
										<area shape="rect" coords="347,47,425,75" href="?logout=1">
										<area shape="rect" coords="262,46,342,72" href="http://<?php echo $_SERVER["HTTP_HOST"];?>" target="_blank">
										<area shape="rect" coords="196,44,250,73" href="index.php">
								</map>
								<map name="Map3Map">
										<area shape="rect" coords="17,17,163,65" href="index.php">
								</map>
						</td>
						<td align="left" valign="top"><img src="img/template/head5.jpg" width="9" height="75"></td>
				</tr>
				<tr>
						<td width="9" height="600" align="left" valign="top" background="img/template/left.jpg" ><img src="img/template/left.jpg" width="9" height="839"></td>
						<td align="left" valign="top">
								<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-x;">
										<tr align="left" valign="middle" background="/CUBE_IMG/0707icon/srice_r3_c5_r1_c1.jpg">
												<td height="41">
														<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="background-repeat:repeat-x;">
																<form action="http://www.google.co.jp/search" method="get" name="form1" id="form1" target="_blank">
																		<tr>
																				<td colspan="5">
																				    <div align="right"><a href="#" onclick="javascript:window.external.AddFavorite('http://<?php echo $_SESSION["DomainData"]["domain_name"];?>/GW/logon.php?admin_id=<?php echo $logindata["login_id"];?>&admin_pass=<?php echo $logindata["login_pw"];?>&btm_login=%A5%ED%A5%B0%A5%A4%A5%F3','<?php if(	$tenpodata["sm_title"]!=NULL) {echo $tenpodata["sm_title"]; }else { echo "ホームページ管理ツール"; } ?>')">グループウェアのURLをブックマークする</a></div>
																				</td>
																		</tr>
																		<tr>
																				<td width="50" background="img/template/head_line1.jpg">&nbsp;																				</td>
																				<td background="img/template/head_line2.jpg"><span class="style3"><?php echo $_SESSION["MEMDATA"]["member_name"];?></span></td>
																				<td width="86" background="img/template/head_line3.jpg">&nbsp;</td>
																				<td width="140" align="left" valign="middle" background="img/template/head_line2.jpg">
																						<input name="q" type="text" id="q" />
																				</td>
																				<td width="50">
																						<input type="image" name="imageField" src="img/template/head_line4.jpg" />
																				</td>
																		</tr>
																</form>
														</table>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top"><a href="#" onclick="selmenu('gw')"><img src="/SM/img/template/tabmenu/gw_title.jpg" width="96" height="17" border="0" /></a></td>
										</tr>
										<tr>
												<td align="left" valign="top" bgcolor="#E0E0C4"><span style="display:block;"><a href="index.php"><img src="/SM/img/template/tabmenu/gw_1.jpg" width="79" height="62" border="0" ></a><a href="index.php?PID=schedule"><img src="/SM/img/template/tabmenu/gw_3.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=todo"><img src="/SM/img/template/tabmenu/gw_15.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=files"><img src="/SM/img/template/tabmenu/gw_5.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=bbs"><img src="/SM/img/template/tabmenu/gw_4.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=address"><img src="/SM/img/template/tabmenu/gw_12.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=keitai"><img src="/SM/img/template/tabmenu/gw_9.jpg" width="79" height="62" border="0"></a><a href="index.php?PID=member"><img src="/SM/img/template/tabmenu/gw_6.jpg" width="79" height="62" border="0"></a></span></td>
										</tr>
										<?php
										if($fudousanchk["use_chk"]==1) { 
										?>
										<tr>
												<td align="left" valign="top">&nbsp;</td>
										</tr>
										<?php
										}
										?>
										<tr>
												<td align="left" valign="top"><?php
						switch($_REQUEST["PID"]) {
						case "member":
						include ("./member/correct.php");
						break;
						case "c1":
						include ("./c1search.php");
						break;
						case "c2":
						include ("./c2search.php");
						break;
						case "c3":
						include ("./c3search.php");
						break;
						case "b1":
						include ("./b1search.php");
						break;
						case "b2":
						include ("./b2search.php");
						break;
						case "b3":
						include ("./b3search.php");
						break;
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
						case "up_log":
							$pagetype="gw";
							include ("./bbs/up_log.php");

							break;
						case "up_topics":
							$pagetype="gw";
							include ("./bbs/up_topics.php");

							break;
						case "up_theme":
							$pagetype="gw";
							include ("./bbs/up_thema.php");
							break;
case "files":
include ("./files/top.php");
break;
case "schedule":
include ("./schedule/top.php");
break;
case "sche_add":
include ("./schedule/addition.php");
break;
case "sche_add2":
include ("./schedule/addition2.php");
break;
case "sche_add3":
include ("./schedule/addition3.php");
break;
case "sche_up1":
include ("./schedule/update1.php");
break;
case "sche_up2":
include ("./schedule/update2.php");
break;
case "sche_up3":
include ("./schedule/update3.php");
break;
case "sche_up":
include ("./schedule/update2.php");
break;
case "sche_d":
include ("./schedule/detail.php");
break;
case "ScheduleSearch":
include ("./schedule/search.php");
break;
case "keitai":
include ("./keitai/index.php");
break;
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

case "telmemo":
include ("./telmemo/top.php");
break;
case "convertcsv":
include ("./convertcsv.php");
break;
case "address_top":
include ("./address/index.php");
					$pagetype="gw";
break;
case "address":
					$pagetype="gw";
include ("./address/index.php");
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
default:
include("./top.php");
break;
}
?>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top">&nbsp;</td>
										</tr>
								</table>
						</td>
						<td width="9" align="left" valign="top" background="img/template/right.jpg"><img src="img/template/right.jpg" width="9" height="147"></td>
				</tr>
				<tr>
						<td align="left" valign="top">
								<p><img src="img/template/foot1.jpg" width="9" height="73"></p>
								<p>&nbsp;</p>
						</td>
						<td align="left" valign="top">
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="370"><img src="img/template/foot2.jpg" width="370" height="73" border="0" usemap="#Map4Map"></td>
												<td background="img/template/foot3.jpg">&nbsp;</td>
												<td width="369"><img src="img/template/foot4.jpg" width="369" height="73" border="0" usemap="#Map5Map"></td>
										</tr>
								</table>
						</td>
						<td align="left" valign="top"><img src="img/template/foot5.jpg" width="9" height="73"></td>
				</tr>
</table>
								<map name="Map4Map">
										<area shape="rect" coords="11,7,153,48" href="index.php">
								</map>
								<map name="Map5Map">
										<area shape="rect" coords="130,20,194,46" href="index.php">
										<area shape="rect" coords="205,21,281,46" alt="" href="http://<?php echo $_SERVER["HTTP_HOST"];?>" target="_blank">
										<area shape="rect" coords="298,21,359,42" href="?logout=1">
								</map>
		
		<map name="Map2">
		<area shape="rect" coords="15,1,388,50" href="index.php">
		<area shape="rect" coords="526,17,577,38" href="#">
		<area shape="rect" coords="587,19,665,40" href="http://<?php echo $_SESSION["GW"]["domain"];?>">
		<area shape="rect" coords="677,17,746,41" href="/?logout=1">
</map>

<map name="Map">
		<area shape="rect" coords="347,47,425,75" href="?logout=1">
<area shape="rect" coords="262,46,342,72" href="http://<?php echo $_SERVER["HTTP_HOST"];?>" target="_blank"><area shape="rect" coords="196,44,250,73" href="index.php">
</map>
<map name="Map3"><area shape="rect" coords="23,22,169,70" href="index.php">
</map>
<map name="Map4">
		<area shape="rect" coords="11,7,153,48" href="index.php">
</map>
<map name="Map5">
		<area shape="rect" coords="130,20,194,46" href="index.php">
		<area shape="rect" coords="205,21,281,46" alt="" href="http://<?php echo $_SERVER["HTTP_HOST"];?>" target="_blank">
				<area shape="rect" coords="298,21,359,42" href="?logout=1">
</map></body>
</html>
