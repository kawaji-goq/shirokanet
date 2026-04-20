<?php 
header("Content-type: text/html; charset=euc-jp");

ini_set("display_errors",0);
session_start(); 
/* ?>

<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">

<?php */ 
/************データベース名定義****************/
//接続先DB

//session_start();
$dbname="dbname=".str_replace("www.","",$_SERVER['HTTP_HOST']);

//以下変更はしない

mb_language("Japanese");
$JAPANESEDATE=date("Y-m-d",time());
$session_id=session_id();

function kecho($txt) {
	echo mb_convert_encoding($txt,"sjis","euc-jp");
}
?>
