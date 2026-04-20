<?php
function GetAgent() {
	if(strstr($_SERVER['HTTP_USER_AGENT'],"DoCoMo")){
	  $env["type"] = 'i';
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"VODAFONE")){
	  $env["type"] = 'vf';
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"SoftBank")){
	  $env["type"] = 'sb';
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"J-PHONE")){
	  $env["type"] = 'jp';
	}elseif(strstr($_SERVER['HTTP_USER_AGENT'],"KDDI")){
	  $env["type"] = 'ez';
	}else{
	  $env["type"] = 'other';
	}
	return $env;
}
function texttomap($str1,$str) {
preg_match_all("/\<map>(.+?)<\/map>/x",$str, $retxt);
for($i=0;$retxt[0][$i]!=NULL;$i++){
		$repbtext='<a href="#" onclick="window.open(\'./mapout.php?name='.urlencode(mb_convert_encoding($str1,"utf8","euc-jp")).'&address='.urlencode(mb_convert_encoding($retxt[1][$i],"utf8","euc-jp")).'\',\'maps\',\'width=640,height=540\')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a>';
	 $str=str_replace($retxt[0][$i],$repbtext,$str);
}
return $str;
}

?>