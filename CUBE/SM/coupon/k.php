<?php
session_start();
$agenttype=($_SERVER['HTTP_USER_AGENT']);

mb_internal_encoding("EUC-JP");
include "ITC/modules.php";
/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<?php  
*/


class Docomo {
	
	function Docomo() {
		
	}
	function EMoji() {
		$emojilist["1"]="&#xE6E2;";
		$emojilist["2"]="&#xE6E3;";
		$emojilist["3"]="&#xE6E4;";
		$emojilist["4"]="&#xE6E5;";
		$emojilist["5"]="&#xE6E6;";
		$emojilist["6"]="&#xE6E7;";
		$emojilist["7"]="&#xE6E8;";
		$emojilist["8"]="&#xE6E9;";
		$emojilist["9"]="&#xE6EA;";
		$emojilist["0"]="&#xE6EB;";
		$emojilist["TEL"]="&#xE687;";
		$emojilist["FAX"]="&#xE689;";
		$emojilist["CORP"]="&#xE664;";
		$emojilist["KEITAI"]="&#xE688;";
		$emojilist["HOME"]="&#xE663;";
		$emojilist["MAIL"]="&#xE6D3;";
		$emojilist["MAP"]="&#xE6DE;";
		$emojilist["HITOKAGE"]="&#xE6B1;";
		$emojilist["TOKEI"]="&#xE6BA;";
		$emojilist["PARKING"]="&#xE66C;";
		$emojilist["YEN"]="&#xE6D6;";
		$emojilist["KAMERA"]="&#xE681;";
		$emojilist["SHOKUJI"]="&#xE66F;";
		$emojilist["PC"]="&#xE716;";
		$emojilist["massage"]="&#xE721;";
		$emojilist["tshirt"]="&#xE70E;";
		$emojilist["ticket"]="&#xE67E;";
		return $emojilist;
	}
	
}

class Au{
	function Au() {
		
	}
	function EMoji() {
		$emojilist["1"]="&#xE522;";
		$emojilist["2"]="&#xE523;";
		$emojilist["3"]="&#xE524;";
		$emojilist["4"]="&#xE525;";
		$emojilist["5"]="&#xE526;";
		$emojilist["6"]="&#xE527;";
		$emojilist["7"]="&#xE528;";
		$emojilist["8"]="&#xE529;";
		$emojilist["9"]="&#xE52A;";
		$emojilist["0"]="&#xE5AC;";
		$emojilist["TEL"]="&#xE596;";
		$emojilist["FAX"]="&#xE520;";
		$emojilist["CORP"]="&#xE4AD;";
		$emojilist["KEITAI"]="&#xE588;";
		$emojilist["HOME"]="&#xE4AB;";
		$emojilist["MAIL"]="&#xE521;";
		$emojilist["MAP"]="&#xEB2C;";
		$emojilist["HITOKAGE"]="&#xE4FC;";
		$emojilist["TOKEI"]="&#xE594;";
		$emojilist["PARKING"]="&#xE4A6;";
		$emojilist["YEN"]="&#xE4C7;";
		$emojilist["KAMERA"]="&#xE515;";
		$emojilist["SHOKUJI"]="&#xEAB4;";
		$emojilist["PC"]="&#xE5B8;";
		$emojilist["massage"]="&#xE4FB;";
		$emojilist["tshirt"]="&#xEB77;";
		$emojilist["ticket"]="&#xE49E;";
		return $emojilist;
	}
	
}

class SoftBank {
	function SoftBank() {
	}
	function EMoji() {
		$emojilist["1"]="&#xE21C;";
		$emojilist["2"]="&#xE21D;";
		$emojilist["3"]="&#xE21E;";
		$emojilist["4"]="&#xE21F;";
		$emojilist["5"]="&#xE220;";
		$emojilist["6"]="&#xE221;";
		$emojilist["7"]="&#xE222;";
		$emojilist["8"]="&#xE223;";
		$emojilist["9"]="&#xE224;";
		$emojilist["0"]="&#xE225;";
		$emojilist["TEL"]="&#xE009;";
		$emojilist["FAX"]="&#xE00B;";
		$emojilist["CORP"]="&#xE038;";
		$emojilist["KEITAI"]="&#xE00A;";
		$emojilist["HOME"]="&#xE036;";
		$emojilist["MAIL"]="&#xE103;";
		$emojilist["MAP"]="";
		$emojilist["HITOKAGE"]="&#xE426;";
		$emojilist["TOKEI"]="&#xE026;";
		$emojilist["PARKING"]="&#xE14F;";
		$emojilist["YEN"]="&#xE12F;";
		$emojilist["KAMERA"]="&#xE008;";
		$emojilist["SHOKUJI"]="&#xE043;";
		$emojilist["PC"]="&#xE00C;";
		$emojilist["massage"]="&#xE31E;";
		$emojilist["tshirt"]="&#xE006;";
		$emojilist["ticket"]="&#xE125;";
		return $emojilist;
	}
}

/*
		$ftype1=pathinfo($image1_name);
		$photo1_m=$nowtime."1_m.".$ftype1["extension"];
		$photo1_l=$nowtime."1_l.".$ftype1["extension"];
		$photo1_s=$nowtime."1_s.".$ftype1["extension"];
		@unlink("../tmp/temp_l.".$ftype1);
		@unlink("../tmp/temp_m.".$ftype1);
		@unlink("../tmp/temp_s.".$ftype1);
		move_uploaded_file($image1,"../tmp/temp_l.".$ftype1["extension"]);

*/
function Kemoji() {
	if(strstr($_SERVER['HTTP_USER_AGENT'],"DoCoMo")) {
		$type="docomo";
	}
	else if(strstr($_SERVER['HTTP_USER_AGENT'],"KDDI")) {
		$type="au";
	}
	else if(strstr($_SERVER['HTTP_USER_AGENT'],"J-PHONE")) {
		$type="softbank";
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"VODAFONE")){
		$type= "softbank";
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"SoftBank")){
		$type="softbank";	
	}
	switch($type) {
		case "docomo":
			$obj=new Docomo();
			break;
		case "au":
			$obj=new Au();
			break;
		case "softbank":
			$obj=new SoftBank();
			break;
		default:
			$obj=new SoftBank();
			break;
	}
	$data=$obj->EMoji();
	return $data;
}
$Emoji=Kemoji();
$usedb="postgresql";
$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->name="j-plan.co.jp";
$dbobj->Connect();
if($_GET["coupon_id"]!=NULL) {
$today=explode("-",date("Y-m-d"));
//echo "select * from promo_coupon where stime  < ".mktime(0,0,0,$today[1],$today[2]+1,$today[0])." and etime > ".mktime(0,0,0,$today[1],$today[2]-1,$today[0])." and coupon_id=".$_GET["coupon"]."";
$coupondata=$dbobj->GetData("select * from promo_coupon where coupon_id=".$_GET["coupon_id"]."");
if($coupondata["coupon_id"]!=NULL) {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<title>クーポン</title>
</head>
<body>
<center><img src="http://j-plan.co.jp/img_f/t1_coupon_r1_c1.gif" width="178" height="31">
</center>
<fieldset><legend><?php 
echo $Emoji["ticket"]." <font color=\"#FF6600\">".$coupondata["k_title"]."</font>";
?></legend>
<br>
<?php 
echo nl2br($coupondata["k_comm"]);
?><br />
有効期限<br />
<?php 
echo date("Y年m月d日",$coupondata["stime"])."〜<br>".date("Y年m月d日",$coupondata["etime"]);
?></fieldset>
</body>
</html>
<?php
}
}
?>