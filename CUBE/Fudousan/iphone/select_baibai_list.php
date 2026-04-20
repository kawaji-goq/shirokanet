<?php
session_start();
$_SESSION["toiawase"]="";
include "Cube/Fudousan/config.php";
include "ITC/modules.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

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
	
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	$re1obj=new RealEstate($dbobj);
	
	if($_REQUEST["seach_bukken_x"]!=NULL) {
		
		$_SESSION["madori"]=$_REQUEST["madori"];
		$_SESSION["lowcost"]=$_REQUEST["lowcost"];
		$_SESSION["hicost"]=$_REQUEST["hicost"];
		$_SESSION["keyword"]=$_REQUEST["keyword"];
		$_SESSION["chiiki"]=$_REQUEST["chiiki"];
		$_SESSION["page"]=1;
	}
	
	if($_GET["sort"]!=NULL) {
		
		$_GET["sort"]=str_replace("update","",str_replace("delete","",str_replace("select","",str_replace("drop","",$_GET["sort"]))));
		$_SESSION["sort"]=$_GET["sort"];
		
	}
	else if($_SESSION["sort"]==NULL) {
		
		$_SESSION["sort"]="kakaku";
		
	}
	
	if($_GET["cid"]!=NULL) {
		
		if($_SESSION["cid"]!=$_GET["cid"]) {
			
			$_SESSION["madori"]="";
			$_SESSION["lowcost"]="";
			$_SESSION["hicost"]="";
			$_SESSION["keyword"]="";
			$_SESSION["chiiki"]="";
			$_SESSION["page"]=1;
			
		}
		
		$_SESSION["cid"]=$_GET["cid"];
		
	}

	$re1obj->type=$_SESSION["cid"];
	$re1data=$re1obj->GetReList(2,$_SESSION["sort"]);
	$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" /> 
<title><?php echo $tenpodata["pagetitle"];?>/Êª·ï¸¡º÷</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<style type="text/css">
<!--
.style1 {font-size: small}
.style3 {
	color: #c36;
	font-weight: bold;
}
-->
</style>
</head> 
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > <a href="chintai_mian.php">¥¸¥ã¥ó¥ëÀßÄê</a> > <a href="select_main_chintai.php">¾ò·ïÀßÄê</a> > <span class="style3">¸¡º÷·ë²Ì¡Ê<?php echo count($re1data) ?>·ï¡Ë</span></h1>

</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div>
<img src="img/main/ttl_chintai.jpg" width="100%" /></div>


<?php
switch($_REQUEST["cid"]) {
	case 4:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =4");
?>
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:2% auto 2% auto; cursor:hand; " onClick="location.href='/iphone2/detail_baibai_a.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
  <tr>
    <td width="32%" align="center" valign="middle">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='90%'>";
	}
	else
	{
?>
<img src="img/main/noimage.jpg" width="90%" border="0" /><?php
	}
?>	</td>
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."Ëü±ß" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "¡¡";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
	}
	else
	{
		echo "-";
	}
?>
	  </span></p>
      <a href="#"></a></td>
    <td width="10%" valign="middle"><img src="img/main/alterna/more.jpg" width="100%" border="0" /></td>
  </tr>
</table>
<hr  />

</div>
<?php
}
?>
<?php
	break;
	case 5:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
?>
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:2% auto 2% auto; cursor:hand; " onClick="location.href='/iphone2/detail_baibai_b.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
  <tr>
    <td width="32%" align="center" valign="middle">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='90%'>";
	}
	else
	{
?>
                        	<img src="img/main/noimage.jpg" width="90%" border="0" />
<?php
	}
?>
	</td>
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."Ëü±ß" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "¡¡";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
	}
	else
	{
		echo "-";
	}
?>
	  </span></p>
      <a href="#"></a></td>
    <td width="10%" valign="middle"><img src="img/main/alterna/more.jpg" width="100%" border="0" /></td>
  </tr>
</table>
<hr  />

</div>
<?php
}
?>
<?php
	break;
	case 6:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");
?>
<?php
for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++)
{
?>
<div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:2% auto 2% auto; cursor:hand; " onClick="location.href='/iphone2/detail_baibai_c.php?bid=<?php echo $re1data[$re1rows]["id"]; ?>'">
  <tr>
    <td width="32%" align="center" valign="middle">
<?php
	if(@file_exists("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"])&&$re1data[$re1rows]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/".str_replace("300","list",$fdata["basename"])."' border='0' width='90%'>";
	}
	else
	{
?>
<img src="img/main/noimage.jpg" width="90%" border="0" /><?php
	}
?>	</td>
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."Ëü±ß" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."±Ø";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "ÅÌÊâ".$re1data[$re1rows]["ekiho"]."Ê¬";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "¡¡";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>¡ÊÌó".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."ÄÚ¡Ë";
	}
	else
	{
		echo "-";
	}
?>
	  </span></p>
      <a href="#"></a></td>
    <td width="10%" valign="middle"><img src="img/main/alterna/more.jpg" width="100%" border="0" /></td>
  </tr>
</table>
<hr  />

</div>
<?php
}
?>
<?php
	break;
}
?>
<table border="0" align="center" cellpadding="3" cellspacing="0" style="padding-top:10px;" width="90%">
	<tr>
		<td colspan="2">
			<div align="center">
<?php 
if($maxpage>1&&$maxpage!=NULL&&$maxpage!=0)
{
	for($prows=1;$prows<=$maxpage;$prows++)
	{ 
		if($prows==$_SESSION["page"])
		{
			echo '¡¡<span><strong>'.$prows.'</strong></span>¡¡';
		}
		else
		{
			echo "¡¡<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\"><strong>".$prows."</strong></a>¡¡";
		}
	}
}
?>
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%" nowrap="nowrap">
			<div align="left">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]-1;?>"><strong>¡ã Á°¤Î10·ï</strong></a>
<?php
}
?>
			</div>
		</td>
		<td width="50%" nowrap="nowrap">
			<div align="right">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]+1;?>"><strong>¼¡¤Î10·ï ¡ä</strong></a>
				<?php } ?>
			</div>
		</td>
	</tr>
</table>
<div id="footer">
<?php include"footer.html" ?>

</div>













</body> 
</html> 