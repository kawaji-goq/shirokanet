<?
session_start();
$_SESSION["toiawase"]="";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "CUBE/Fudousan/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include "ITC/modules.php";
mb_internal_encoding("EUC-JP");

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

//if($usedb=="mysql") {
$dbobj->user="goq";
$dbobj->pass="itc2011";
//}

$dbobj->Connect();
$tenpodata=$dbobj->GetData("select * from tenpo_data");

if($usedb=="postgresql"){
	$dbobj->Query("VACUUM");
}

$newsobj=new Site_News($dbobj);

if($toposusumerandom==1) {

	$osusumedata=$dbobj->GetList("select * from bukken where osusume=1 and del_chk<>1 order by random() limit 12");
	
	if($osusumedata[0][0]==""){
	
		$osusumedata=$dbobj->GetList("select * from bukken where osusume=1 and del_chk<>1 order by RAND() limit 12");
		
	}
}
else {
$osusumedata=$dbobj->GetList("select * from bukken where osusume=1 and del_chk<>1 order by tourokubi desc,id desc limit 12");
}

	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newbsql="select * from bukken where del_chk <> 1 order by tourokubi desc limit $nblim";
	$newbdata=$dbobj->GetList($newbsql);
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);

	function syubetsuchk($bunrui,$syumoku) {
	switch($bunrui) {
		case 1:
			switch($syumoku) {
				case "¥¢¥Ñ¡¼¥È":
					return "";
					break;
				case "¥Þ¥ó¥·¥ç¥ó":
					return "";
					break;
				case "Âß²È":
					return 2;
					break;
				case "¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 2;
					break;
				case "¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 2;
					break;
				case "´Ö¼Ú¤ê":
					return 2;
					break;
				case "Å¹ÊÞ¡Ê°ì¸Í·ú¡Ë":
					return 3;
					break;
				case "Å¹ÊÞ¡Ê·úÊª°ìÉô¡Ë":
					return 3;
					break;
				case "»öÌ³½ê":
					return 3;
					break;
				case "Å¹ÊÞ¡¦»öÌ³½ê":
					return 3;
					break;
				case "¹©¾ì":
					return 3;
					break;
				case "ÁÒ¸Ë":
					return 3;
					break;
				case "¥Þ¥ó¥·¥ç¥ó":
					return 3;
					break;
				case "Î¹´Û":
					return 3;
					break;
				case "ÎÀ":
					return 3;
					break;
				case "ÊÌÁñ":
					return 3;
					break;
				case "ÅÚÃÏ":
					return 3;
					break;
				case "¥Ó¥ë":
					return 3;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ¡Ê°ì¸Í·ú¡Ë":
					return 3;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ¡Ê·úÊª°ìÉô¡Ë":
					return 3;
					break;
				case "¤½¤ÎÂ¾":
					return 3;
					break;
			}	
		break;
		case 2:
			switch($syumoku) {
				case "¿·ÃÛ°ì¸Í·ú½»Âð":
					return 4;
					break;
				case "Ãæ¸Å°ì¸Í·ú½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 4;
					break;
				case "Ãæ¸Å¥Æ¥é¥¹¥Ï¥¦¥¹":
					return 4;
					break;
				case "¿·ÃÛ¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "Ãæ¸Å¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "¿·ÃÛ¸øÃÄ½»Âð":
					return 4;
					break;
				case "Ãæ¸Å¸øÃÄ½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¸ø¼Ò½»Âð":
					return 4;
					break;
				case "Ãæ¸Å¸ø¼Ò½»Âð":
					return 4;
					break;
				case "¿·ÃÛ¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "Ãæ¸Å¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
					return 4;
					break;
				case "Ãæ¸Å¥¿¥¦¥ó¥Ï¥¦¥¹":
					return 4;
					break;
				case "ÇäÃÏ":
					return 5;
					break;
				case "¼ÚÃÏ¸¢¾ùÅÏ":
					return 5;
					break;
				case "ÄìÃÏ¸¢¾ùÅÏ":
					return 5;
					break;
				case "Å¹ÊÞ":
					return 6;
					break;
				case "Å¹ÊÞÉÕ½»Âð":
					return 6;
					break;
				case "½»ÂðÉÕÅ¹ÊÞ":
					return 6;
					break;
				case "»öÌ³½ê":
					return 6;
					break;
				case "Å¹ÊÞ»öÌ³½ê":
					return 6;
					break;
				case "Å¹ÊÞ¡¦»öÌ³½ê":
					return 6;
					break;
				case "¥Ó¥ë":
					return 6;
					break;
				case "¹©¾ì":
					return 6;
					break;
				case "ÁÒ¸Ë":
					return 6;
					break;
				case "ÎÀ":
					return 6;
					break;
				case "Î¹´Û":
					return 6;
					break;
				case "¥Û¥Æ¥ë":
					return 6;
					break;
				case "ÊÌÁñ":
					return 6;
					break;
				case "¥ê¥¾¡¼¥È¥Þ¥ó¥·¥ç¥ó":
					return 6;
					break;
				case "¤½¤ÎÂ¾":
					return 6;
					break;
			}		
		
		break;
		
	}
}

	$tenpodata=$dbobj->GetData("select * from tenpo_data");
function chunk_text($str, $chunklen, $endtag){
    $new_str="";
		mb_internal_encoding("EUC-JP");
    $length=mb_strlen($str);
    for($i=0; $i<$length; $i+=$chunklen){
        $new_str.=mb_substr($str, $i, $chunklen).$endtag;
    }
    return $new_str;
}
if($tenpodata["status"]==1) {
	?>
	<script language="javascript">
	location.replace('maintenance.php');
	</script>
	<?php
}

if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') != true && strpos($_SERVER['HTTP_USER_AGENT'], 'Android') != true)
{
//	header("location: http://cubes.jp/index.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<title><?php echo $tenpodata["pagetitle"];?></title>
<meta name="description" content="¤´¤¯¤¹¤ÝËÜÅ¹¡Ã¥¹¥Ý¡¼¥Ä¡¦¥´¥ë¥ÕÍÑÉÊ¤ÎÁí¹çÄÌÈÎ¥µ¥¤¥È">
<meta name="keywords" content="ÄÌÈÎ,¥¤¥ó¥¿¡¼¥Í¥Ã¥ÈÄÌÈÎ,¥ª¥ó¥é¥¤¥ó¥·¥ç¥Ã¥Ô¥ó¥°,¤´¤¯¤¹¤Ý,¤´¤¯¤¹¤ÝËÜÅ¹,gokuspo,¥´¥¯¥¹¥Ý">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">

<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="/iphone/icon/icon.PNG">
<link rel="stylesheet" type="text/css" href="/iphone/css/fudousan.css" >

<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
</head>
<body bgcolor="#DDDDDD"><a href="/iphone/index.php"><?php if($tenpodata["headerimage"]) {?><img src="<?php echo $tenpodata["headerimage"] ?>" border="0" width="100%"><?php }?></a>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="Êª·ï¸¡º÷" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="²ñ¼Ò°ÆÆâ" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¥È¥Ô¥Ã¥¯¥¹" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¤ªÌä¹ç¤»" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:1px;">
	<tr>
		<td align="center"><?php if($tenpodata["topimage"]) {?><img src="<?php echo $tenpodata["topimage"];?>?<?php echo time();?>" width="99%" style="margin-top:1px;"><?php }?></td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="Search">
	<tr>
		<td colspan="3" class="Search_top_blue"><strong>ÄÂÂßÊª·ï¤òÃµ¤¹</strong></td>
	</tr>
	<tr>
		<td class="Search_bottom_left"><input type="button" class="Search_button_blue" value="¥¢¥Ñ¡¼¥È&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/chintai.php?cid=1'"/></td>
		<td class="Search_bottom_middle"><input type="button" class="Search_button_blue" value="¸Í·ú¤Æ½»Âð" onClick="location.href='/iphone/chintai.php?cid=2'"/></td>
		<td class="Search_bottom_right"><input type="button" class="Search_button_blue" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/chintai.php?cid=3'"/></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="Search">
	<tr>
		<td colspan="3" class="Search_top_red"><strong>ÇäÇãÊª·ï¤òÃµ¤¹</strong></td>
	</tr>
	<tr>
		<td class="Search_bottom_left"><input type="button" class="Search_button_red" value="¸Í·ú¤Æ½»Âð&#13;&#10;¥Þ¥ó¥·¥ç¥ó" onClick="location.href='/iphone/baibai.php?cid=4'"/></td>
		<td class="Search_bottom_middle"><input type="button" class="Search_button_red" value="¶ÈÌ³ÍÑÊª·ï" onClick="location.href='/iphone/baibai.php?cid=6'"/></td>
		<td class="Search_bottom_right"><input type="button" class="Search_button_red" value="ÅÚÃÏ" onClick="location.href='/iphone/baibai.php?cid=5'"/></td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="Topics">
	<tr>
		<td class="Topics_top"><strong>NEWS&amp;TOPICS</strong></td>
	</tr>
<?php
for($bi=0;$newblogdata[$bi]["blog_id"]!=NULL;$bi++)
{
	$newblogdata[$bi]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi]["comm"]);
	$newblogdata[$bi+1]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi+1]["comm"]);
	$newblogdata[$bi]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi]["comm"]);
	$newblogdata[$bi+1]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi+1]["comm"]);

}
?>
	<tr>
	  <td class="Topics_bottom"><table border="0" align="center" cellpadding="0" cellspacing="0"class="Topics">
          <?php
for($bi=0;$newblogdata[$bi]["blog_id"]!=NULL;$bi++)
{
	$newblogdata[$bi]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi]["comm"]);
	$newblogdata[$bi+1]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi+1]["comm"]);
	$newblogdata[$bi]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi]["comm"]);
	$newblogdata[$bi+1]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi+1]["comm"]);

?>
          <tr onClick="location='/iphone/topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>'" style="cursor:hand;">
            <?php
	if(file_exists($_SERVER['DOCUMENT_ROOT'].$newblogdata[$bi]["image"])&&$newblogdata[$bi]["image"]!=NULL){
	?>
            <td rowspan="2" align="center" class="Topics_middle_left"><img src="<?php echo $newblogdata[$bi]["image"];?>?<?php echo time();?>" border="0" style="max-width:84px;"></td>
            <?php
		}
		?>
            <td class="Topics_middle_right_up"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?>
                <?php if(((time()-strtotime($newblogdata[$bi]["rdate"])))/(3600*24)<=7){ ?>
                <font color="#FF0000">New!</font>
                <?php } ?></td>
          </tr>
          <tr onClick="location='/iphone/topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>'" style="cursor:hand;">
            <td class="Topics_middle_right_up"><span class="Topics_middle_right_down"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"]),"NRKHVS","EUC-JP"),0,60,"Ž¥Ž¥Ž¥"))); ?></span></td>
          </tr>
          <?php
}
?>
        </table></td>
  </tr>
	<tr>
		<td class="Topics_bottom">¡¡</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" align="center" class="Reco" style="cursor:hand;" onClick="location='<?php if($osusumedata[$bi]["bunrui"]==1) {?>/iphone/chintai_d<?php echo syubetsuchk($osusumedata[$bi]["bunrui"],$osusumedata[$bi]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$bi]["id"]; ?><?php }else if($osusumedata[$bi]["bunrui"]==2){?>/iphone/baibai_d.php<?php echo "?bid=".$osusumedata[$bi]["id"]; }?>'">
	<tr>
		<td class="Reco_top"><strong>¤ª¤¹¤¹¤áÊª·ï</strong></td>
	</tr>
<?php
for($bi=0;$osusumedata[$bi]["id"]!=NULL && $bi < 8;$bi++)
{
?>

<?php
}
?>
	<tr>
	  <td class="Reco_bottom"><table border="0" align="center" cellpadding="0" cellspacing="0" onClick="location='<?php if($osusumedata[$bi]["bunrui"]==1) {?>/iphone/chintai_d<?php echo syubetsuchk($osusumedata[$bi]["bunrui"],$osusumedata[$bi]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$bi]["id"]; ?><?php }else if($osusumedata[$bi]["bunrui"]==2){?>/iphone/baibai_d.php<?php echo "?bid=".$osusumedata[$bi]["id"]; }?>'" class="Reco" style="cursor:hand;">
        <?php
for($bi=0;$osusumedata[$bi]["id"]!=NULL && $bi < 8;$bi++)
{
?>
        <tr>
          <td rowspan="4" align="center" class="Reco_middle_left"><?php
	if(file_exists("../tmp/bukken_data/".$osusumedata[$bi]["id"]."/".$osusumedata[$bi]["photo1"])&&$osusumedata[$bi]["photo1"]!=NULL)
	{
		$fdata=(pathinfo("../tmp/bukken_data/".$osusumedata[$bi]["id"]."/".$osusumedata[$bi]["photo1"]));
		echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' alt=\"".$osusumedata[$bi]["jyusyo1"].$osusumedata[$bi]["jyusyo2"]."\" style=\"max-width:84px;\" />";
	}
	else
	{
?>
              <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[$bi]["jyusyo1"].$osusumedata[$bi]["jyusyo2"];?>" style="max-width:84px;" /></a><a href="<?php if($osusumedata[$bi]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[$bi]["bunrui"],$osusumedata[$bi]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[$bi]["id"]; ?><?php }else if($osusumedata[$bi]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[$bi]["id"]; }?>">
              <?php
	}
?>
              </a><br>
              <?php 
	if($osusumedata[$bi]["bunrui"]==1)
	{
?>
              <font color="#428CFA" size="0"><strong>ÄÂÂßÊª·ï</strong></font><br>
              <?php
	}
	else
	{
?>
              <font color="#FF52C8" size="0"><strong>ÇäÇãÊª·ï</strong></font><br>
              <?php
	}
?>
              <font color="#FF0000">
              <?php 
	if($osusumedata[$bi]["genkyou"]=="¾¦ÃÌÃæ")
	{
?>
                ¡Ú¾¦ÃÌÃæ¡Û
                <?php
	}
	else if($osusumedata[$bi]["genkyou"]=="À®ÌóºÑ")
	{
?>
                ¡ÚÀ®ÌóºÑ¡Û
                <?php
	}
?>
            </font> </td>
          <td class="Reco_middle_right_up"><?php 
	if($osusumedata[$bi]["bunrui"]==1)
	{
?>
              <font color="#428CFA" size="0"><?php echo number_format($osusumedata[$bi]["kakaku"],1);?>Ëü±ß</font>
              <?php
	}
	else
	{
?>
              <font color="#FF52C8" size="0"><?php echo number_format($osusumedata[$bi]["kakaku"],1);?>Ëü±ß</font>
              <?php
	}
?>
          </td>
        </tr>
        <tr>
          <td class="Reco_middle_right_down"><?php if($osusumedata[$bi]["eki"]!=NULL) {echo $osusumedata[$bi]["eki"]."±Ø";} ?>
              <?php if( $osusumedata[$bi]["ensen"]!=NULL){?>
            [<?php echo $osusumedata[$bi]["ensen"];?>]
            <?php }?></td>
        </tr>
        <tr>
          <td class="Reco_middle_right_down"><?php
if($osusumedata[$bi]["banchichk"])
{
	$jyusyo[$bi]=mb_convert_kana($osusumedata[$bi]["jyusyo1"].$osusumedata[$bi]["jyusyo2"].$osusumedata[$bi]["jyusyo3"],"ka");
}
else
{
	$jyusyo[$bi]=mb_convert_kana($osusumedata[$bi]["jyusyo1"].$osusumedata[$bi]["jyusyo2"],"ka");																																																}
echo chunk_text($jyusyo[$bi],12,"<br>");
?>
          </td>
        </tr>
        <tr>
          <td class="Reco_middle_right_down"><?php if($osusumedata[$bi]["madori"]!=NULL&&$osusumedata[$bi]["madori"]!=0){echo $osusumedata[$bi]["madori"].$osusumedata[$bi]["madori_tani"];}else if($osusumedata[$bi]["senyumenseki"]!=NULL) {echo $osusumedata[$bi]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[$bi]["menseki"]!=NULL) {echo $osusumedata[$bi]["menseki"]."m<sup>2</sup>";} ?></td>
        </tr>
        <?php
}
?>
      </table></td>
  </tr>
	<tr>
		<td class="Reco_bottom">¡¡</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="Êª·ï¸¡º÷" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="²ñ¼Ò°ÆÆâ" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¥È¥Ô¥Ã¥¯¥¹" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="¤ªÌä¹ç¤»" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr>
		<td align="center" style="font-size:9px; color:#555555">copyright(c)2007 ITCUBE-FUDOUSAN all reserved.</td>
	</tr>
	<tr>
		<td align="center"><img src="/iphone/img/footerlogo.jpg" border="0" style="margin-top:1px;"></td>
	</tr>
</table>
</body>
</html>
