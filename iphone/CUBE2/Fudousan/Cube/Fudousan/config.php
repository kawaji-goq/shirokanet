<?php  
ini_set('display_errors',0);
/* ?>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">

<?php */ 
/************データベース名定義****************/
//接続先DB

session_start();
$dbname="dbname=".str_replace("www.","",$_SERVER['HTTP_HOST']);

//以下変更はしない

mb_language("Japanese");
$JAPANESEDATE=date("Y-m-d",time());
$session_id=session_id();

function kecho($txt) {
	echo mb_convert_encoding($txt,"sjis","euc-jp");
}
$agenttype=($_SERVER['HTTP_USER_AGENT']);

if(substr_count($agenttype,"DoCoMo")!=0) {
	header("Location:./keitai/index.php");
}
else if(substr_count($agenttype,"KDDI")!=0) {
	header("Location:./keitai/index.php");
}
else if(substr_count($agenttype,"J-PHONE")!=0) {
	header("Location:./keitai/index.php");
}
else if(substr_count($agenttype,"vodafone")!=0) {
	header("Location:./keitai/index.php");
}
else if(substr_count($agenttype,"SoftBank")!=0) {
	header("Location:./keitai/index.php");
}
else if(substr_count($agenttype,"Google ")!=0) {
	header("Location:./gkeitai/index.php");
}

?>
