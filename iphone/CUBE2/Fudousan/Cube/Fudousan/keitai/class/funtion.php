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
?>