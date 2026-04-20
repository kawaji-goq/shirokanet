<?php
ini_set("display_errors",1);
//include "Cube/Fudousan/config.php";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "CUBE/ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);
mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	//echo $usedb;
	$dbobj=Cube_DB :: UseDB($usedb);	
	//echo $usedb;
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	//echo $dbobj->name;
	
	//if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
	//}
$dbobj->Connect();
//exit("aaa");
$re1obj=new Keitai_RealEstate($dbobj);

$tenpodata=$dbobj->GetData("select * from tenpo_data");

?><html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件検索</title>
</head>
<body>
<?php
include "template/header.php";
?>
<marquee>
『ﾓﾊﾞｲﾙｻｲﾄ』 へようこそ
</marquee>
<div align="left">
  <p>▼賃貸物件検索<br>
   <a href="c1/list.php?reid=fudousan" accesskey="1">ｱﾊﾟｰﾄ･ﾏﾝｼｮﾝ</a><br>
   <a href="./c2/list.php?reid=fudousan" accesskey="2">一戸建借家 </a><br>
   <a href="./c3/list.php?reid=fudousan" accesskey="3">貸店舗・事務所・借地</a><br>
  ▼売買物件検索<br>
   <a href="./b1/list.php?reid=fudousan" accesskey="4">一戸建売家・ﾏﾝｼｮﾝ</a><br>
   <a href="./b2/list.php?reid=fudousan" accesskey="5">売土地</a><br>
   <a href="./b3/list.php?reid=fudousan" accesskey="6">事業用</a><br>
   <a href="company.php" accesskey="7">会社案内</a><br>
   <a href="./toiawase.php?reid=fudousan" accesskey="8">お問い合わせ</a></p>
</div>
<?php
include "template/footer.php";
?>

</body>
</html>
