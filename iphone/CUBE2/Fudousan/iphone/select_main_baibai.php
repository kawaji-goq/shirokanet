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
	
$_SESSION["lim"]=100000;
$sessionpage=$_SESSION["page"];
$getpage=$_GET["page"];
$_SESSION["page"]=1;
$_GET["page"]=1;
$listnum=$re1obj->GetReList(2,$_SESSION["sort"]);
$_SESSION["page"]=$sessionpage;
$_GET["page"]=$getpage;
$_SESSION["lim"]=NULL;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
<head> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" /> 
<title>物件検索</title> 
<meta name="keywords" content="不動産,スマートフォン,物件.検索" /> 
<meta name="description" content="スマホで不動産物件検索" /> 
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
</head> 
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > <a href="baibai_mian.php">ジャンル設定</a> > <span class="style3"><?php if($_SESSION["cid"] == 1){echo "アパート・マンション";} ?><?php if($_SESSION["cid"] == 2){echo "戸建て物件";} ?><?php if($_SESSION["cid"] == 3){echo "業務用物件";} ?><?php if($_SESSION["cid"] == 4){echo "戸建て・マンション";} ?><?php if($_SESSION["cid"] == 5){echo "土地";} ?><?php if($_SESSION["cid"] == 6){echo "業務用物件";} ?>検索結果（<?php echo count($listnum) ?>件）</span></h1>

</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div>
<img src="img/main/ttl_chintai_jk.jpg" width="100%" /></div>
<?php
switch($_REQUEST["cid"]) {
	case 4:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =4");
?>
<form id="form1" name="form1" method="post" action="">
<div id="button2">
間取り<select id="madori" name="madori" style="width:50%; font-size:15px;">
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>指定無し</option>
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4ＤＫ以上</option>
			</select>
</div>
<div id="button2">
地域<select id="chiiki" name="chiiki" style="width:50%; font-size:15px;">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++)
{
?>
				<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
<?php
}
?>
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
			</select>
</div>
<div id="button">
価格<select id="lowcost" name="lowcost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["lowcost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["lowcost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["lowcost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["lowcost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["lowcost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["lowcost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["lowcost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["lowcost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["lowcost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>〜<select id="hicost" name="hicost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["hicost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["hicost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["hicost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["hicost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["hicost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["hicost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["hicost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["hicost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["hicost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>
</div>
<div id="button2">
キーワード<input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" style="width:50%; font-size:15px;"/>
</div>
<div id="button">
  <input type="image" src="img/main/go.jpg" border="0" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link" width="90%" />
</div>
<input type="hidden" name="cid" id="cid" value="4" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="4" />
</form>
<?php
	break;
	case 5:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
?>
<form id="form1" name="form1" method="post" action="">
<div id="button2">
間取り<select id="madori" name="madori" style="width:50%; font-size:15px;">
				<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>指定無し</option>
				<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
				<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
				<option value="4"<?php if($_SESSION["madori"]==4){echo " selected";}?>>4ＤＫ以上</option>
			</select>
</div>
<div id="button2">
地域<select id="chiiki" name="chiiki" style="width:50%; font-size:15px;">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++)
{
?>
				<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
<?php
}
?>
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
			</select>
</div>
<div id="button">
価格<select id="lowcost" name="lowcost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["lowcost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["lowcost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["lowcost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["lowcost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["lowcost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["lowcost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["lowcost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["lowcost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["lowcost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>〜<select id="hicost" name="hicost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["hicost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["hicost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["hicost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["hicost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["hicost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["hicost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["hicost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["hicost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["hicost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>
</div>
<div id="button2">
キーワード<input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" style="width:50%; font-size:15px;"/>
</div>
<div id="button">
  <input type="image" src="img/main/go.jpg" border="0" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link" width="90%"/>
</div>
<input type="hidden" name="cid" id="cid" value="5" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="5" />
</form>
<p>
  <?php
	break;
	case 6:
	$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");
?>
</p>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="">
<div id="button2">
地域<select id="chiiki" name="chiiki" style="width:50%; font-size:15px;">
<?php
$arealist=$dbobj->GetList("select * from re_area order by turn");
for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++)
{
?>
				<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
<?php
}
?>
				<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
			</select>
</div>
<div id="button">
価格<select id="lowcost" name="lowcost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["lowcost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["lowcost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["lowcost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["lowcost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["lowcost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["lowcost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["lowcost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["lowcost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["lowcost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>〜<select id="hicost" name="hicost" style="width:35%; font-size:12px;">
  <option value="" <?php if($_SESSION["hicost"] == ""){ echo "selected=\"selected\""; } ?>>指定しない</option>
  <option value="500" <?php if($_SESSION["hicost"] == "500"){ echo "selected=\"selected\""; } ?>>500万円以上</option>
  <option value="1000" <?php if($_SESSION["hicost"] == "1000"){ echo "selected=\"selected\""; } ?>>1000万円以上</option>
  <option value="1500" <?php if($_SESSION["hicost"] == "1500"){ echo "selected=\"selected\""; } ?>>1500万円以上</option>
  <option value="2000" <?php if($_SESSION["hicost"] == "2000"){ echo "selected=\"selected\""; } ?>>2000万円以上</option>
  <option value="2500" <?php if($_SESSION["hicost"] == "2500"){ echo "selected=\"selected\""; } ?>>2500万円以上</option>
  <option value="3000" <?php if($_SESSION["hicost"] == "3000"){ echo "selected=\"selected\""; } ?>>3000万円以上</option>
  <option value="3500" <?php if($_SESSION["hicost"] == "3500"){ echo "selected=\"selected\""; } ?>>3500万円以上</option>
  <option value="4000" <?php if($_SESSION["hicost"] == "4000"){ echo "selected=\"selected\""; } ?>>4000万円以上</option>
</select>
</div>
<div id="button2">
キーワード<input type="text" name="keyword" id="keyword" value="<?php echo $_SESSION["keyword"];?>" style="width:50%; font-size:15px;"/>
</div>
<div id="button">
  <input type="image" src="img/main/go.jpg" border="0" name="seach_bukken" id="seach_bukken"  value="　検索　" class="link" width="90%" />
</div>
<input type="hidden" name="cid" id="cid" value="6" />
<input type="hidden" name="seach_bukken_x" id="seach_bukken_x" value="6" />
</form>
<?php
	break;
}
?>
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
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."万円" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "　";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."万円" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "　";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
    <td width="58%" valign="top"><p class="font31 style1"><?php echo number_format($re1data[$re1rows]["kakaku"],0)."万円" ?></p>
	<p class="s"><?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"];if($re1data[$re1rows]["banchichk"]==1) {echo $re1data[$re1rows]["jyusyo3"];} ?></p>
      <p class="xs"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
					<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
					<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "徒歩".$re1data[$re1rows]["ekiho"]."分";} ?><br />
<?php 
	if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0)
	{
		echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];
	}
	else
	{
		echo "-";
	}
		echo "　";
	if($re1data[$re1rows]["senyumenseki"]!=NULL)
	{
		echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>（約".number_format($re1data[$re1rows]["senyumenseki"]*0.3025,2)."坪）";
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
			echo '　<span><strong>'.$prows.'</strong></span>　';
		}
		else
		{
			echo "　<a href=\"?cid=".$_SESSION["cid"]."&page=".$prows."\"><strong>".$prows."</strong></a>　";
		}
	}
}
?>
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%" nowrap="nowrap" style="padding-top:10px;">
			<div align="left">
<?php
if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1)
{
?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]-1;?>"><strong>＜ 前の10件</strong></a>
<?php
}
?>
			</div>
		</td>
		<td width="50%" nowrap="nowrap">
			<div align="right">
				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
				<a href="?cid=<?php echo $_SESSION["cid"];?>&page=<?php echo $_SESSION["page"]+1;?>"><strong>次の10件 ＞</strong></a>
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