<?php
session_start();
include("./lib/mobile_class_7.php");
$agenttype=($_SERVER['HTTP_USER_AGENT']);

if(substr_count($agenttype,"DoCoMo")!=0) {
	header("Location:./coupon_k.php");
}
else if(substr_count($agenttype,"KDDI")!=0) {
	header("Location:./coupon_k.php");
}
else if(substr_count($agenttype,"J-PHONE")!=0) {
	header("Location:./coupon_k.php");
}
else if(substr_count($agenttype,"vodafone")!=0) {
	header("Location:./coupon_k.php");
}
else if(substr_count($agenttype,"SoftBank")!=0) {
	header("Location:./coupon_k.php");
}
else {

mb_internal_encoding("EUC-JP");
//include "../config/config.php";
include "ITC/modules.php";

$usedb="postgresql";
$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->name=$_GET["dname"];
$dbobj->Connect();
if($_GET["coupon_id"]!=NULL) {
$today=explode("-",date("Y-m-d"));
//echo "select * from promo_coupon where stime  < ".mktime(0,0,0,$today[1],$today[2]+1,$today[0])." and etime > ".mktime(0,0,0,$today[1],$today[2]-1,$today[0])." and coupon_id=".$_GET["coupon"]."";
$coupondata=$dbobj->GetData("select * from promo_coupon where coupon_id=".$_GET["coupon_id"]."");
if($coupondata["coupon_id"]!=NULL) {
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<title>クーポン</title>
</head>
<body>
<div align="center"><img src="http://www.strawberrycones.com/coupon/images/t1_coupon.gif" />
</div>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<p>画面に表示されたクーポン券をプリンタで印刷して、スタッフにお渡しください。</p>
				</td>
		</tr>
		<tr>
				<td>&nbsp;</td>
		</tr>
</table>
<table width="600" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#FF9900">
		<tr>
				<td bgcolor="#FFFFCC"><strong><font color="#FF6600"><?php 
echo $coupondata["pc_title"];
?></font>
				</strong></td>
		</tr>
		<tr>
				<td bgcolor="#FFFFFF">
						<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1">
								<tr>
										<td bgcolor="#FFFFFF">
												<?php 
echo nl2br($coupondata["pc_comm"]);
?>
										</td>
								</tr>
								<tr>
										<td bgcolor="#FFFFFF">
												<div align="right">有効期限　
														<?php 
echo date("Y年m月d日",$coupondata["stime"])."〜".date("Y年m月d日",$coupondata["etime"]);
?>
												</div>
										</td>
								</tr>
						</table>
				</td>
		</tr>
</table>
<br />
<br />
<center>
<table width="250" border="0" cellpadding="0" cellspacing="1" bgcolor="#666666">
		<tr>
				<td height="300" align="left" valign="top" bgcolor="#FFFFFF">
						<div align="center"><img src="http://j-plan.co.jp/img_f/t1_coupon_r1_c1.gif" width="178" height="31" /><br />
						</div>
						<fieldset><legend><?php 
						$DECODE_DATA=$emoji_obj->emj_decode($coupondata["k_title"]);
echo $Emoji["ticket"]." <font color=\"#FF6600\">".$DECODE_DATA["web"]."</font>";
?></legend>
<br>
<?php 
						$DECODE_DATA=$emoji_obj->emj_decode($coupondata["k_comm"]);
echo $DECODE_DATA["web"];
?><br />
有効期限<br />
<?php 
echo date("Y年m月d日",$coupondata["stime"])."〜<br>".date("Y年m月d日",$coupondata["etime"]);
?></fieldset>
</td>
		</tr>
</table>
</center>

</body>
</html>
<?php
}
}
}
?>