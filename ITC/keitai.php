<?php 
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
		$emojilist["HITO"]="&#xE6B1;";
		$emojilist["MEMO"]="&#xE689;";
		$emojilist["BBS1"]="&#xE691;";
		$emojilist["RES1"]="&#xE719;";
		$emojilist["TOKEI"]="&#xE6BA;";
		$emojilist["SEARCH"]="&#xE6DC;";
			$emojilist["WALK"]="&#xE698;";
		$emojilist["MONEY"]="&#xE6D6;";
		$emojilist["P"]="&#xE66C;";
		$emojilist["CAMERA"]="&#xE381;";
		$emojilist["MEMO"]="&#xE689;";
				
			
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
		$emojilist["HITO"]="&#xE4FB;";
		$emojilist["MEMO"]="&#xE569;";
		$emojilist["BBS1"]="&#xE560;";
		$emojilist["RES1"]="&#xE52E;";
		$emojilist["TOKEI"]="&#xE594;";
		$emojilist["SEARCH"]="&#xE518;";
		$emojilist["WALK"]="&#xE4EE;";
		$emojilist["MONEY"]="&#xE4C7;";
		$emojilist["P"]="&#xE4A6;";
		$emojilist["CAMERA"]="&#xE515;";
		$emojilist["MEMO"]="&#xE561;";
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
		$emojilist["HITO"]="&#xE201;";
		$emojilist["MEMO"]="&#xE301;";
		$emojilist["BBS1"]="&#xE148;";
		$emojilist["RES1"]="&#xE23A;";
		$emojilist["TOKEI"]="&#xE025;";
$emojilist["SEARCH"]="&#xE114;";
		$emojilist["WALK"]="&#xE536;";
		$emojilist["MONEY"]="&#xE12F;";
		$emojilist["P"]="&#xE14F;";
		$emojilist["CAMERA"]="&#xE008;";
		$emojilist["MEMO"]="&#xE301;";
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
?>