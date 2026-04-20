<?php
header("Content-type: text/html; charset=euc-jp");
$_SERVER["DOCUMENT_ROOT"] = "/home/xb464987/shirokanet.com/public_html";
session_start();
ini_set("display_errors",1);
include $_SERVER["DOCUMENT_ROOT"]."/CUBE/Fudousan/config.php";


include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/CUBE/ITC/modules.php";
mb_internal_encoding("EUC-JP");
$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->host='mysql203.xbiz.ne.jp';

$dbobj->name='xb464987_shirokanetjp';
$dbobj->user="xb464987_shiroka";
$dbobj->pass="xrhHKXtm63hYRH";
$dbobj->Connect();
$tenpodata=$dbobj->GetData("select * from tenpo_data");
