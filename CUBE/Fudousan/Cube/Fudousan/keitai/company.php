<?php

//include "Cube/Fudousan/config.php";
include "ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);

mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	
	$dbobj=Cube_DB :: UseDB($usedb);	
	
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	
	if($usedb=="mysql") {
			$dbobj->user="admin";
			$dbobj->pass="itc7310";
	}
$dbobj->Connect();

$re1obj=new Keitai_RealEstate($dbobj);
$comobj=new Site_Company($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$staffobj=new Site_Staff($dbobj);

/*
 *
	*/

$textobj=new Cube_KeitaiTextEdit("SJIS", "EUCJP");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>会社案内</title>
</head>

<body>
<div align="center">会社案内</div>
<hr>
<strong><font color="#0000FF">ごあいさつ</font></strong><br>
<div>
<?php
$textobj->printShortStr($tenpodata["goaisatsu"],30, "･･･");
?>
<a href="goaisatsu.php">more</a><br>
<br>
</div>
<strong><font color="#0000FF">会社概要</font></strong><br>
<div>
<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　会社概要 一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/ 
//　　　　　　　　　　　　　　　　　
$company1datadata=$comobj->GetDataList(1,$lim,$setnum,$orderby);
for($company1row=0;$company1datadata[$company1row];$company1row++){ 
$company1data=new Ary_Viewer($company1datadata[$company1row]);
?>  
<div align="left">
<font color="#CC6600"><?php 
$textobj->printt($company1datadata[$company1row]["data_name"]."<br>");
?></font>
<?php 
$textobj->printc($company1datadata[$company1row]["data_comm"]."<br>"); ?>
</div>
<?php 
}
/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　会社概要 一覧終了　　　　　　　　　　　　　 */
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/****************************************************************/
?></div>
<br>
<strong><font color="#0000FF">スタッフ紹介</font></strong>
<div align="left"><?php 
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　スタッフ紹介一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
unset($staffdata);
$staffdata=$staffobj->GetDataList(1,"",0,"turn"); 
for($staffrow=0;!is_null($staffdata[$staffrow]["data_id"]);$staffrow++){ 
?>	
<div align="left"><font color="#CC6600"><?php 
$textobj->printt($staffdata[$staffrow]["data_post"]." ".$staffdata[$staffrow]["data_name"]);
?></font><br>

    <?php if($staffdata[$staffrow]["data_image"]!=NULL) {?>
    <img src="<?php echo $staffdata[$staffrow]["data_image"] ?>?<?php echo time();?>" />
    <br>
    <?php }
?>

<?php 
$textobj->printShortStr($staffdata[$staffrow]["data_comm"],20, "･･･");
 ?>
<a href="staff.php?data_id=<?php echo $staffdata[$staffrow]["data_id"] ?>">more</a><br>
<hr></div><?php
}
?>
</div>
<a href="mailto:<?php echo mb_convert_encoding($tenpodata["email"],"sjis","eucjp"); ?>"></a><br>
<br> 

  <a href="index.php">TOPへ戻る</a><br>
  <hr>
<br>
</body>
</html>
