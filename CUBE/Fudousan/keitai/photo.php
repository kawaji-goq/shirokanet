<?php
include $_SERVER["DOCUMENT_ROOT"]."/config.php";

include "ITC/modules.php";

mb_internal_encoding("SJIS");

$usedb="postgresql";
$dbobj=Cube_DB :: UseDB($usedb);	$dbobj->name=str_replace("www.","",$_SERVER['HTTP_HOST']);
$dbobj->charcode="euc-jp";
$dbobj->Connect();

$re1obj=new Keitai_RealEstate($dbobj);
$re1data=$re1obj->GetReData($_GET["bid"]);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<TITLE>無題ドキュメント</TITLE>
</head>

<body>
写真<br>
<?php 
if($re1data["photo1"]!=NULL) {
?>
<img src="<?php echo $re1data["photo1"]; ?>">
<?php
}
?>
<br>
<a href="/keitai/newtopics.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">戻る</a>
</body>
</html>
