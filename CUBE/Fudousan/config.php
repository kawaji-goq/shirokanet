<?php 
header("Content-type: text/html; charset=euc-jp");

ini_set("display_errors",1);
session_start(); 
//session_start();
//$dbname="dbname=".str_replace("www.","",$_SERVER['HTTP_HOST']);

mb_language("Japanese");
$JAPANESEDATE=date("Y-m-d",time());
$session_id=session_id();

