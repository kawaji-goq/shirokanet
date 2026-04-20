<?php
session_start();
include "/tmp/CUBE/Fudousan/config.php";
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

if($usedb=="mysql") {
$dbobj->user="goq";
$dbobj->pass="itc2011";
}

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

if(strpos($_SERVER['HTTP_USER_AGENT'], 'iPhone') != false || strpos($_SERVER['HTTP_USER_AGENT'], 'Android') != false)
{
	header("location: /iphone/index.php");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">
<meta name="robots" content="noarchive">
<?php
}?>
<title><?php echo $tenpodata["pagetitle"];?></title>
<style type="text/css">
<!--
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">
<?php if($_SESSION["visit"]==NULL){?>
<style type="text/css">
#dispcaution {
	position:absolute;
	left:176px;
	top:35px;
	width:600px;
	height:200px;
	z-index:1;
}
body{
	
}
</style>
<script language="javascript" src="/js/prototype.js"></script>
<script language="javascript" src="/js/scriptaculous.js?Load=effect"></script>
<script language="javascript">
function dispclose() {
	new Effect.Fade("dispcaution",{duration:1,delay:1});
}
function setposition() {
	var wi=document.body.clientWidth;
	document.all("dispcaution").style.left=((wi)/2)-300;
	document.all("dispcaution").style.top=200;
}
function dispopen() {
	 setposition();
	new Effect.Appear("dispcaution",{duration:2});
}
</script>
<?php
}

?>
<meta name="verify-v1" content="<?php echo $wmcode; ?>" />
<link rel="alternate" media="handheld" href="http://www.<?php echo $_SERVER["HTTP_HOST"];?>/keitai/" />
</head>
<body<?php 
if($_SESSION["visit"]==NULL&&str_replace("www.","",$_SERVER["HTTP_HOST"])=="cubes.jp"){?> onLoad="dispopen();"<?php }else{ ?><?php } if($_SESSION["visit"]==NULL){?> onResize="setposition();"<?php }?>>
<?php if($_SESSION["visit"]==NULL&&str_replace("www.","",$_SERVER["HTTP_HOST"])=="cubes.jp"){?><div id="dispcaution" style="display:none;">
		<table width="100%" height="100%" border="0" cellpadding="20" cellspacing="0">
				<tr>
						<td valign="top" bgcolor="#FFFFFF">
								<div align="center"><strong><h2>¤´Ãí°Õ</h2><font color="#FF0000">										¤³¤Î¥µ¥¤¥È¤Ë·ÇºÜ¤µ¤ì¤Æ¤¤¤ëÊª·ï¤Ï¥µ¥ó¥×¥ë¤Ç¤¹¡£<br><br>
										Êª·ï¤Ë´Ø¤¹¤ë¤ªÌä¤¤¹ç¤ï¤»¤Ë¤Ï¤ªÅú¤¨¤Ç¤­¤Þ¤»¤ó¤Î¤Ç¤´Î»¾µ¤¯¤À¤µ¤¤¡£<br>		
										<br>		
										<br>
										<a href="#" onClick="dispclose()">ÊÄ¤¸¤ë</a></font></strong></div>
						</td>
				</tr>
		</table>
</div><?php
}
?>
<?php
$_SESSION["visit"]=1;

include "/tmp/CUBE/Fudousan/template/header.php";
?>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" rowspan="5" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="71"></td>
        <td><a href="index.php"></a>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td colspan="3"><img src="img/top/TopImageTop.jpg" width="562" height="3"></td>
                    <td rowspan="2">
                        <table width="100%" border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td><img src="img/top/TopBUkkenMenuChintai.jpg" width="206" height="157" border="0" usemap="#Map"></td>
                            </tr>
                            <tr>
                                <td><img src="img/top/TopBukkenMenuLine.jpg" width="206" height="4"></td>
                            </tr>
                            <tr>
                                <td><img src="img/top/TopBukkenMenuBaibai.jpg" width="206" height="156" border="0" usemap="#Map3"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="5"><img src="img/top/TopImageLeft.jpg" width="5" height="314"></td>
                    <td width="550" valign="top"><?php if($tenpodata["topimage"]) {?><img src="<?php echo $tenpodata["topimage"];?>?<?php echo time();?>" width="550" height="308"><?php }?></td>
                    <td><img src="img/top/TopImageCenter.jpg" width="7" height="314"></td>
                </tr>
            </table>
        </td>
        <td width="25" rowspan="5" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71"></td>
    </tr>
    <?php
if($tenpodata["blog_url"]==NULL&&$tenpodata["loanurl"]==NULL){
	if($newblogdata[0]["blog_id"]!=NULL) {
				?>
    <tr>
        <td>
            <div id="toptopics"><?php
												?>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="img/top/TopNewsTopicsHeader.jpg" width="768" height="33" border="0" usemap="#topiccs"></td>
                    </tr>
                    <tr>
                        <td width="20" background="img/top/TopContentsLeft.jpg">&nbsp;</td>
                        <td width="728" valign="top">
                            <table width="728" border="0" cellspacing="0" cellpadding="0">
                                <?php
														for($bi=0;$newblogdata[$bi]["blog_id"]!=NULL;$bi+=2) { 
															$newblogdata[$bi]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi]["comm"]);
															$newblogdata[$bi+1]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi+1]["comm"]);
															$newblogdata[$bi]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi]["comm"]);
															$newblogdata[$bi+1]["comm"]=@str_replace("\&nbsp;"," ",$newblogdata[$bi+1]["comm"]);
														?>
                                <tr>
                                    <td width="359" valign="top">
                                        <?php if($newblogdata[$bi]["image2"]!=NULL) {?>
                                        <table width="353" border="0" cellpadding="0" cellspacing="0">
                                            
                                            <tr>
                                                <td>
                                                    <table width="353" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="97" rowspan="2" valign="middle">
                                                                <div align="center"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><img src="<?php echo $newblogdata[$bi]["image2"];?>?<?php echo time();?>" border="0"></a></div>
                                                            </td>
                                                            <td width="22" valign="top"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                            <td width="234" height="20" align="left" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a><?php if(((time()-strtotime($newblogdata[$bi]["rdate"])))/(3600*24)<=7){ ?>
                                                                <font color="#FF0000">New!</font> 
                                                            <?php }
																																																												?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">&nbsp;</td>
                                                            <td height="50" align="left" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"]),"NRKHVS","EUC-JP"),0,60,"Ž¥Ž¥Ž¥"))); ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="256"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                            </tr>
                                        </table>
                                        <?php 
																				}
																				else if($newblogdata[$bi]["blog_id"]!=NULL){
																				?>
                                        <table width="98%" border="0" cellpadding="0" cellspacing="0">

                                            
                                            <tr>
                                                <td>
                                                    <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td width="8%" valign="top"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                            <td width="92%" height="20" align="left" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a><?php if(((time()-strtotime($newblogdata[$bi]["rdate"])))/(3600*24)<=7){ ?>
                                                                <font color="#FF0000">New!</font> 
                                                            <?php }?></td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">&nbsp;</td>
                                                            <td height="50" align="left" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"]),"NRKHVS","EUC-JP"),0,60,"Ž¥Ž¥Ž¥"))); ?></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                            </tr>
                                        </table>
                                        <?php
																				}
																				?>
                                    </td>
                                    <td width="10" height="50">&nbsp;</td>
                                    <td width="359" valign="top">
                                        <?php if($newblogdata[$bi+1]["blog_id"]!=NULL) {?>
                                        <?php if($newblogdata[$bi+1]["image2"]!=NULL) {?>
                                        <table border="0" cellpadding="0" cellspacing="0">
                                            <?php
														?>
                                            
                                            <tr>
                                                <td>
                                                    <table border="0" cellpadding="0" cellspacing="0">
                                                        <?php
														?>
                                                        <tr>
                                                            <td width="96" rowspan="2" valign="middle">
                                                                <div align="center"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi+1]["blog_id"]; ?>"><img src="<?php echo $newblogdata[$bi+1]["image2"];?>?<?php echo time();?>" border="0"></a></div>
                                                            </td>
                                                            <td width="22" valign="middle"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                            <td width="230" height="20" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi+1]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi+1]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a><?php if(((time()-strtotime($newblogdata[$bi+1]["rdate"])))/(3600*24)<=7){ ?>
                                                            <font color="#FF0000">New!</font>
                                                            <?php }?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">&nbsp;</td>
                                                            <td height="50" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi+1]["comm"]),"NRKHVS","EUC-JP"),0,60,"¡¦¡¦¡¦"))); ?></td>
                                                        </tr>
                                                        <?php
														?>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="252"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                            </tr>
                                            <?php
														?>
                                        </table>
                                        <?php }
																																								else if($newblogdata[$bi+1]["blog_id"]!=NULL){?>
                                        <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                            <?php
														?>

                                            
                                            <tr>
                                                <td>
                                                    <table width="98%" border="0" cellpadding="0" cellspacing="0">
                                                        <?php
														?>
                                                        <tr>
                                                            <td width="9%" valign="middle"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                            <td width="91%" height="20" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi+1]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi+1]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a><?php if(((time()-strtotime($newblogdata[$bi+1]["rdate"])))/(3600*24)<=7){ ?>
                                                            <font color="#FF0000">New!</font>
                                                            <?php }?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td valign="top">&nbsp;</td>
                                                            <td height="50" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi+1]["comm"]),"NRKHVS","EUC-JP"),0,60,"¡¦¡¦¡¦"))); ?></td>
                                                        </tr>
                                                        <?php
														?>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="100%"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                            </tr>
                                            <?php
														?>
                                        </table>
                                        <?php }
																																								}?>
                                    </td>
                                </tr>
                                <?php
														}
														?>
                            </table>
                        </td>
                        <td width="20" background="img/top/TopContentsRight.jpg">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="img/top/TopContentsBottom.jpg" width="768" height="13"></td>
                    </tr>
                </table>
                <map name="topiccsMap">
                    <area shape="rect" coords="580,6,762,28" href="topics.php">
                </map>
            </div>
        </td>
    </tr>
    <?php
				}
				}
				else {
				?>
    <tr>
        <td>
            <div id="div">
                <table width="768" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="560">
                            <table width="559" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td colspan="3"><img src="img/top/TopNewsTopicsHeader2.jpg" width="560" height="33" border="0" usemap="#topiccsMap2Map"></td>
                                </tr>
                                <tr>
                                    <td width="20" background="img/top/TopNewsTopicsLeft2.jpg"><img src="img/top/TopNewsTopicsLeft2.jpg" width="20" height="154"></td>
                                    <td width="520" valign="top">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <?php
														for($bi=0;$newblogdata[$bi]["blog_id"]!=NULL;$bi++) { 
														if($bi>1) {
															break;
														}
																												$newblogdata[$bi]["comm"]=@str_replace("&nbsp;"," ",$newblogdata[$bi]["comm"]);
														?>
                                            <tr>
                                              <td height="50" valign="top">
                                                    <?php if($newblogdata[$bi]["image2"]!=NULL) {?>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <table width="520" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td width="97" rowspan="2" valign="middle">
                                                                            <div align="center"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><img src="<?php echo $newblogdata[$bi]["image2"];?>?<?php echo time();?>" border="0"></a></div>                                                                        </td>
                                                                        <td width="31" valign="top"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                                        <td width="392" height="20" align="left" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a>
                                                                                <?php if(((time()-strtotime($newblogdata[$bi]["rdate"])))/(3600*24)<=7){ ?>
                                                                                <font color="#FF0000">New!</font>
                                                                                <?php }
																																																												?>                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top">&nbsp;</td>
                                                                        <td height="48" align="left" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"]),"NRKHVS","EUC-JP"),0,180,"Ž¥Ž¥Ž¥"))); ?></td>
                                                                    </tr>
                                                                </table>                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="256"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                                        </tr>
                                                    </table>
                                                    <?php 
																																								}
																																								else{
																																								?>
                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <table width="520" border="0" cellpadding="0" cellspacing="0">
                                                                    <tr>
                                                                        <td width="40" valign="top"><img src="img/top/toptopicsicon.jpg" width="22" height="16"></td>
                                                                        <td width="470" height="20" align="left" valign="middle" class="topicstitle"><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["title"]),"NRKHVS","EUC-JP"),0,40,"Ž¥Ž¥Ž¥"); ?></a>
                                                                                <?php if(((time()-strtotime($newblogdata[$bi]["rdate"])))/(3600*24)<=7){ ?>
                                                                                <font color="#FF0000">New!</font>
                                                                                <?php }?>                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td valign="top">&nbsp;</td>
                                                                        <td height="50" align="left" valign="top" class="topicstext"><?php echo str_replace("&£ò£á£ò£ò;","&rarr;",str_replace("&£ì£á£ò£ò;","&larr;",mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"]),"NRKHVS","EUC-JP"),0,180,"Ž¥Ž¥Ž¥"))); ?></td>
                                                                    </tr>
                                                                </table>                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="100%"><img src="img/top/TopTopicsLine.jpg" width="353" height="2"></td>
                                                        </tr>
                                                    </table>
                                                    <?php
																																								}
																																								?></td>
                                            </tr>
                                            <?php
														}
														?>
                                        </table>
                                    </td>
                                    <td width="20" background="img/top/TopNewsTopicsRight2.jpg"><img src="img/top/TopNewsTopicsRight2.jpg" width="20" height="154"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><img src="img/top/TopNewsTopicsFoot2.jpg" width="560" height="16"></td>
                                </tr>
                            </table>
                            <map name="topiccsMap2Map">
                                <area shape="rect" coords="580,6,762,28" href="topics.php">
                            </map>
                        </td>
                        <td width="208" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0"><?php 				
																												if($tenpodata["blog_url"]!=NULL){
?>
                                <tr>
                                    <td><a href="<?php echo $tenpodata["blog_url"]; ?>" target="_blank"><img src="img/top/blog_banner.jpg" width="205" height="50" border="0"></a></td>
                                </tr>
																																<?php
																																}
																																if($tenpodata["loanurl"]!=NULL) {
																																?>
                                <tr>
                                    <td><a href="<?php echo $tenpodata["loanurl"]; ?>" target="_blank"><img src="img/top/loanbanner.jpg" width="205" height="153" border="0"></a></td>
                                </tr>
																																<?php
																																}
																																?>
                            </table>
                        </td>
                    </tr>
                </table>
                <map name="topiccsMapMap">
                    <area shape="rect" coords="580,6,762,28" href="topics.php">
                </map>
            </div>
            <map name="topiccsMap2">
                <area shape="rect" coords="580,6,762,28" href="topics.php">
            </map>
        </td>
    </tr>
				<?php
				}
				?>
    <tr>
        <td>
            <?php
										$today=explode("-",date("Y-m-d"));
										$oldday=date("Y-m-d",mktime(0,0,0,$today[1],$today[2]-365,$today[0]));
										
										if($topnewsrandom==1&&$usedb=="postgresql") {
											$newbsql="select * from bukken where tourokubi >= '".$oldday."' and del_chk <>1 order by random() limit 8";
										}
										else {
											$newbsql="select * from bukken where tourokubi >= '".$oldday."' and del_chk <>1 order by tourokubi desc,id desc limit 8";
										}
										if($_SERVER['HTTP_HOST']=="saito-s.jp"){
										//	echo $newbsql;
										}
										$newbdata=$dbobj->GetList($newbsql);
										if($newbdata[0]["id"]!=NULL){
										?>
            <div id="topnewbukken">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="img/top/TopNewBukkenHeader.jpg" width="768" height="33" border="0" usemap="#newbukken"></td>
                    </tr>
                    <tr>
                        <td width="20" background="img/top/TopContentsLeft.jpg">&nbsp;</td>
                        <td width="728">
                            <table width="720" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
<?php
for($i=0;$newbdata[$i]["id"]!=NULL;$i+=4) {
if($i>50) {
exit();
}
?>
                                <tr>
                                    <td width="180" valign="top">
<?php
if($newbdata[$i]["id"]!=NULL) {
?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                        		<tr>
                                        				<td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                        				<td width="160" height="102"><div align="center"><a href="<?php if($newbdata[$i]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($newbdata[$i]["bunrui"],$newbdata[$i]["syumoku"]); ?>.php<?php echo "?bid=".$newbdata[$i]["id"]; ?><?php }else if($newbdata[$i]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i]["id"]; }?>">
                                        						<?php
if(@file_exists("./tmp/bukken_data/".$newbdata[$i]["id"]."/".$newbdata[$i]["photo1"])&&$newbdata[$i]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$newbdata[$i]["id"]."/".$newbdata[$i]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".trim(str_replace("300","",$fdata["basename"]))."' border='0' width='145' alt=\"".$newbdata[$i]["jyusyo1"].$newbdata[$i]["jyusyo2"]."\" />";
}
else {
?>
                                        						<img src="/img/noimage_120_120.gif" alt="" border="0" /></a><a href="<?php if($newbdata[$i]["bunrui"]==1) {?>chintai_d.php<?php echo "?bid=".$newbdata[$i]["id"]; ?><?php }else if($newbdata[$i]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i]["id"]; }?>">
                                        								<?php
}
?>
                                        								</a></div></td>
                                        				<td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="160" height="25" valign="bottom"><table width="160" border="0" cellspacing="0" cellpadding="0">
                                        						<tr>
                                        								<td width="90"><?php 
																						if($newbdata[$i]["bunrui"]==1){
																							?>
                                        										<img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                        										<?php
																						}
																						else {
																						?>
                                        										<img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                        										<?php
																						}
																						?></td>
                                        								<td width="70"><div align="center"> <font color="#FF0000">
                                        										<?php 
																						if($newbdata[$i]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                        										¡Ú¾¦ÃÌÃæ¡Û
                                        										<?php
																						}
																						else if($newbdata[$i]["genkyou"]=="À®ÌóºÑ"){
																						?>
                                        										¡ÚÀ®ÌóºÑ¡Û
                                        										<?php
																						}
																						?>
                                        										</font></div></td>
                                        								</tr>
                                     						</table></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="160" height="25"><table width="160" border="0" cellpadding="5" cellspacing="0" class="newbukkenprice" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                        						<tr>
                                        								<td width="150" height="25" align="right"><strong><font color="#FFFFFF">
                                        										<?php 
																																																												if($newbdata[$i]["kakaku"]>=1000) {
																																																												echo numberformat($newbdata[$i]["kakaku"]);
																																																												}else {
																																																													echo $newbdata[$i]["kakaku"];
																																																												}
																																																												?>
                                        										Ëü±ß</font></strong></td>
                                        								</tr>
                                        						</table></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="160" height="25"><?php if($newbdata[$i]["eki"]!=NULL) {echo $newbdata[$i]["eki"]."±Ø";}?>
                                        						<?php if( $newbdata[$i]["ensen"]!=NULL){?>[<?php echo $newbdata[$i]["ensen"];?>]<?php }?></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="160" height="25"><?php 
																																																if($newbdata[$i]["banchichk"]){
																																																				$jyusyo[$i]=mb_convert_kana($newbdata[$i]["jyusyo1"].$newbdata[$i]["jyusyo2"].$newbdata[$i]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[$i]=mb_convert_kana($newbdata[$i]["jyusyo1"].$newbdata[$i]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[$i],12,"<br>");;

																																																?></td>
                                     				</tr>
                                        		<tr>
                                        				<td width="160" height="25"><?php if($newbdata[$i]["madori"]!=NULL&&$newbdata[$i]["madori"]!=0){echo $newbdata[$i]["madori"].$newbdata[$i]["madori_tani"];}else if($newbdata[$i]["senyumenseki"]!=NULL) {echo $newbdata[$i]["senyumenseki"]."m<sup>2</sup>";}else if($newbdata[$i]["menseki"]!=NULL) {echo $newbdata[$i]["menseki"]."m<sup>2</sup>";} ?></td>
                                     				</tr>
                                        		<tr>
                                        				<td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                     				</tr>
                                     		</table>                                        <?php
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php
																		if($newbdata[$i+1]["id"]!=NULL) {
																		 ?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102">
                                                    <div align="center"><a href="<?php if($newbdata[$i+1]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($newbdata[$i+1]["bunrui"],$newbdata[$i+1]["syumoku"]); ?>.php<?php echo "?bid=".$newbdata[$i+1]["id"]; ?><?php }else if($newbdata[$i+1]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+1]["id"]; }?>">
                                                        <?php
if(@file_exists("./tmp/bukken_data/".$newbdata[$i+1]["id"]."/".$newbdata[$i+1]["photo1"])&&$newbdata[$i+1]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$newbdata[$i+1]["id"]."/".$newbdata[$i+1]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".trim(str_replace("300","",$fdata["basename"]))."' border='0' width='145' alt=\"".$newbdata[$i+1]["jyusyo1"].$newbdata[$i+1]["jyusyo2"]."\" />";
}
else {
?>
                                                        <img src="/img/noimage_120_120.gif" border="0" /></a><a href="<?php if($newbdata[$i+1]["bunrui"]==1) {?>chintai_d.php<?php echo "?bid=".$newbdata[$i+1]["id"]; ?><?php }else if($newbdata[$i+1]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+1]["id"]; }?>">
                                                        <?php
}
?>
                                                    </a></div>
                                                </td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
<?php 
																						if($newbdata[$i+1]["bunrui"]==1) {?>                                                                
<img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
</td>
                                                            <td>
                                                                <div align="center">
                                                                    <font color="#FF0000">
                                                                    <?php 
																						if($newbdata[$i+1]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($newbdata[$i+1]["genkyou"]=="À®ÌóºÑ"){
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                    </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="newbukkenprice" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF">
                                                                <?php 
																																																												if($newbdata[$i+1]["kakaku"]>=1000) {
																																																												echo numberformat($newbdata[$i+1]["kakaku"]);
																																																												}else {
																																																													echo $newbdata[$i+1]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+1]["eki"]!=NULL) {echo $newbdata[$i+1]["eki"]."±Ø";}?>
                                                    <?php if( $newbdata[$i+1]["ensen"]!=NULL){?>
                                                    [<?php echo $newbdata[$i+1]["ensen"];?>]
                                                    <?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($newbdata[$i+1]["banchichk"]){
																																																				$jyusyo[$i+1]=mb_convert_kana($newbdata[$i+1]["jyusyo1"].$newbdata[$i+1]["jyusyo2"].$newbdata[$i+1]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[$i+1]=mb_convert_kana($newbdata[$i+1]["jyusyo1"].$newbdata[$i+1]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[$i+1],12,"<br>");;

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+1]["madori"]!=NULL&&$newbdata[$i+1]["madori"]!=0){echo $newbdata[$i+1]["madori"].$newbdata[$i+1]["madori_tani"];}else if($newbdata[$i+1]["senyumenseki"]!=NULL) {echo $newbdata[$i+1]["senyumenseki"]."m<sup>2</sup>";}else if($newbdata[$i+1]["menseki"]!=NULL) {echo $newbdata[$i+1]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php
																		if($newbdata[$i+2]["id"]!=NULL) {
																		 ?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center">
                                                    <div align="center"><a href="<?php if($newbdata[$i+2]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($newbdata[$i+2]["bunrui"],$newbdata[$i+2]["syumoku"]); ?>.php<?php echo "?bid=".$newbdata[$i+2]["id"]; ?><?php }else if($newbdata[$i+2]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+2]["id"]; }?>">
                                                        <?php
																				 if(@file_exists("./tmp/bukken_data/".$newbdata[$i+2]["id"]."/".$newbdata[$i+2]["photo1"])&&$newbdata[$i+2]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$newbdata[$i+2]["id"]."/".$newbdata[$i+2]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$newbdata[$i+2]["jyusyo1"].$newbdata[$i+2]["jyusyo2"]."\" />";
}
else {
?>
                                                        <img src="/img/noimage_120_120.gif" border="0" /></a><a href="<?php if($newbdata[$i]["bunrui"]==1) {?>chintai_d.php<?php echo "?bid=".$newbdata[$i+2]["id"]; ?><?php }else if($newbdata[$i+2]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+2]["id"]; }?>">
                                                        <?php
}
?>
                                                    </a></div>
                                                </td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($newbdata[$i+2]["bunrui"]==1) {?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center">
                                                                    <font color="#FF0000">
                                                                    <?php 
																						if($newbdata[$i+2]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($newbdata[$i+2]["genkyou"]=="À®ÌóºÑ"){
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                    </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="newbukkenprice">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF">
                                                                <?php 
																																																												if($newbdata[$i+2]["kakaku"]>=1000) {
																																																												echo numberformat($newbdata[$i+2]["kakaku"]);
																																																												}else {
																																																													echo $newbdata[$i+2]["kakaku"];
																																																												}
																																																												?>
                                                                Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+2]["eki"]!=NULL) {echo $newbdata[$i+2]["eki"]."±Ø";}?>
                                                    <?php if( $newbdata[$i+2]["ensen"]!=NULL){?>
                                                    [<?php echo $newbdata[$i+2]["ensen"];?>]
                                                    <?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($newbdata[$i+2]["banchichk"]){
																																																				$jyusyo[$i+2]=mb_convert_kana($newbdata[$i+2]["jyusyo1"].$newbdata[$i+2]["jyusyo2"].$newbdata[$i+2]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[$i+2]=mb_convert_kana($newbdata[$i+2]["jyusyo1"].$newbdata[$i+2]["jyusyo2"],"ka");
																																																}
																																																echo chunk_split($jyusyo[$i+2],23,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+2]["madori"]!=NULL&&$newbdata[$i+2]["madori"]!=0){echo $newbdata[$i+2]["madori"].$newbdata[$i+2]["madori_tani"];}else if($newbdata[$i+2]["senyumenseki"]!=NULL) {echo $newbdata[$i+2]["senyumenseki"]."m<sup>2</sup>";}else if($newbdata[$i+2]["menseki"]!=NULL) {echo $newbdata[$i+2]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php
																		}
																		?>
                                    </td>
                                    <td width="180" valign="top">
                                        <?php
																		if($newbdata[$i+3]["id"]!=NULL) {
																		 ?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"> <a href="<?php if($newbdata[$i+3]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($newbdata[$i+3]["bunrui"],$newbdata[$i+3]["syumoku"]); ?>.php<?php echo "?bid=".$newbdata[$i+3]["id"]; ?><?php }else if($newbdata[$i+3]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+3]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$newbdata[$i+3]["id"]."/".$newbdata[$i+3]["photo1"])&&$newbdata[$i+3]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$newbdata[$i+3]["id"]."/".$newbdata[$i+3]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."' border='0' width='145' alt=\"".$newbdata[$i+3]["jyusyo1"].$newbdata[$i+3]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" /></a><a href="<?php if($newbdata[$i+3]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($newbdata[$i+3]["bunrui"],$newbdata[$i+3]["syumoku"]); ?>.php<?php echo "?bid=".$newbdata[$i+3]["id"]; ?><?php }else if($newbdata[$i+3]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$newbdata[$i+3]["id"]; }?>">
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($newbdata[$i+3]["bunrui"]==1) {?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center">
                                                                    <font color="#FF0000">
                                                                    <?php 
																						if($newbdata[$i+3]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($newbdata[$i+3]["genkyou"]=="À®ÌóºÑ"){
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                    </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="newbukkenprice">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF">
                                                                <?php 
																																																												if($newbdata[$i+3]["kakaku"]>=1000) {
																																																												echo numberformat($newbdata[$i+3]["kakaku"]);
																																																												}else {
																																																													echo $newbdata[$i+3]["kakaku"];
																																																												}
																																																												?>
                                                                Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+3]["eki"]!=NULL) {echo $newbdata[$i+3]["eki"]."±Ø";}?>
                                                    <?php if( $newbdata[$i+3]["ensen"]!=NULL){?>
                                                    [<?php echo $newbdata[$i+3]["ensen"];?>]
                                                    <?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($newbdata[$i+3]["banchichk"]){
																																																				$jyusyo[$i+3]=mb_convert_kana($newbdata[$i+3]["jyusyo1"].$newbdata[$i+3]["jyusyo2"].$newbdata[$i+3]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[$i+3]=mb_convert_kana($newbdata[$i+3]["jyusyo1"].$newbdata[$i+3]["jyusyo2"],"ka");
																																																}
																																																echo chunk_split($jyusyo[$i+3],23,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($newbdata[$i+3]["madori"]!=NULL&&$newbdata[$i+3]["madori"]!=0){echo $newbdata[$i+3]["madori"].$newbdata[$i+3]["madori_tani"];}else if($newbdata[$i+3]["senyumenseki"]!=NULL) {echo $newbdata[$i+3]["senyumenseki"]."m<sup>2</sup>";}else if($newbdata[$i+3]["menseki"]!=NULL) {echo $newbdata[$i+3]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php
																		}
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php
																																}
										?>
                            </table>
                        </td>
                        <td width="20" background="img/top/TopContentsRight.jpg">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="img/top/TopContentsBottom.jpg" width="768" height="13"></td>
                    </tr>
                </table>
            </div><?php
												}
												?>
        </td>
    </tr>
    <tr>
        <td><?php 
													if($osusumedata[0]["id"]!=NULL){

								?>
            <div id="toposusumebukken">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td colspan="3"><img src="img/top/TopOsusumeHeader.jpg" width="768" height="33" border="0" usemap="#osusumebukken"></td>
                    </tr>
                    <tr>
                        <td width="20" background="img/top/TopContentsLeft.jpg">&nbsp;</td>
                        <td width="728">
                            <table width="720" border="0" align="right" cellpadding="0" cellspacing="0" summary="¡¡">
                                <tr>
                                    <td width="180" valign="top">
                                        <?php if($osusumedata[0]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¡¡">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="170" height="102" align="center"> <a href="<?php if($osusumedata[0]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[0]["bunrui"],$osusumedata[0]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[0]["id"]; ?><?php }else if($osusumedata[0]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[0]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[0]["id"]."/".$osusumedata[0]["photo1"])&&$osusumedata[0]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[0]["id"]."/".$osusumedata[0]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[0]["jyusyo1"].$osusumedata[0]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[0]["jyusyo1"].$osusumedata[0]["jyusyo2"];?>" /></a><a href="<?php if($osusumedata[0]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[0]["bunrui"],$osusumedata[0]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[0]["id"]; ?><?php }else if($osusumedata[0]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[0]["id"]; }?>">
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[0]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[0]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[0]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice" summary="¡¡">
                                                        <tr>
                                                            <td height="25" align="right" class="osusumebukkenprice<?php echo $osusumedata[0]["bunrui"];?>"><strong><font color="#FFFFFF"><strong><font color="#FFFFFF">
                                                            		<?php 
																																																												if($osusumedata[0]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[0]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[0]["kakaku"];
																																																												}
																																																												?>
                                                            </font></strong>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[0]["eki"]!=NULL) {echo $osusumedata[0]["eki"]."±Ø";} ?>
																								<?php if( $osusumedata[0]["ensen"]!=NULL){?>
                                                		[<?php echo $osusumedata[0]["ensen"];?>]
                                                		<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[0]["banchichk"]){
																																																	mb_internal_encoding("EUC-JP");
																																																				$jyusyo[0]=mb_convert_kana($osusumedata[0]["jyusyo1"].$osusumedata[0]["jyusyo2"].$osusumedata[0]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[0]=mb_convert_kana($osusumedata[0]["jyusyo1"].$osusumedata[0]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[0],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[0]["madori"]!=NULL&&$osusumedata[0]["madori"]!=0){echo $osusumedata[0]["madori"].$osusumedata[0]["madori_tani"];}else if($osusumedata[0]["senyumenseki"]!=NULL) {echo $osusumedata[0]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[0]["menseki"]!=NULL) {echo $osusumedata[0]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180">
                                        <?php if($osusumedata[1]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="170" height="102" align="center"><a href="<?php if($osusumedata[1]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[1]["bunrui"],$osusumedata[1]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[1]["id"]; ?><?php }else if($osusumedata[1]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[1]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[1]["id"]."/".$osusumedata[1]["photo1"])&&$osusumedata[1]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[1]["id"]."/".$osusumedata[1]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[1]["jyusyo1"].$osusumedata[1]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[1]["jyusyo1"].$osusumedata[1]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" border="0" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[1]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[1]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[1]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[1]["bunrui"];?>" summary="¡¡">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[1]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[1]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[1]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[1]["eki"]!=NULL) {echo $osusumedata[1]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[1]["ensen"]!=NULL){?>
[<?php echo $osusumedata[1]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[1]["banchichk"]){
																																																				$jyusyo[1]=mb_convert_kana($osusumedata[1]["jyusyo1"].$osusumedata[1]["jyusyo2"].$osusumedata[1]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[1]=mb_convert_kana($osusumedata[1]["jyusyo1"].$osusumedata[1]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[1],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[1]["madori"]!=NULL&&$osusumedata[1]["madori"]!=0){echo $osusumedata[1]["madori"].$osusumedata[1]["madori_tani"];}else if($osusumedata[1]["senyumenseki"]!=NULL) {echo $osusumedata[1]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[1]["menseki"]!=NULL) {echo $osusumedata[1]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180">
                                        <?php if($osusumedata[2]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[2]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[2]["bunrui"],$osusumedata[2]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[2]["id"]; ?><?php }else if($osusumedata[2]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[2]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[2]["id"]."/".$osusumedata[2]["photo1"])&&$osusumedata[2]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[2]["id"]."/".$osusumedata[2]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[2]["jyusyo1"].$osusumedata[2]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[2]["jyusyo1"].$osusumedata[2]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[2]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[2]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[2]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[2]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[2]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[2]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[2]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[2]["eki"]!=NULL) {echo $osusumedata[2]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[2]["ensen"]!=NULL){?>
[<?php echo $osusumedata[2]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[2]["banchichk"]){
																																																				$jyusyo[2]=mb_convert_kana($osusumedata[2]["jyusyo1"].$osusumedata[2]["jyusyo2"].$osusumedata[2]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[2]=mb_convert_kana($osusumedata[2]["jyusyo1"].$osusumedata[2]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[2],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[2]["madori"]!=NULL&&$osusumedata[2]["madori"]!=0){echo $osusumedata[2]["madori"].$osusumedata[2]["madori_tani"];}else if($osusumedata[2]["senyumenseki"]!=NULL) {echo $osusumedata[2]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[2]["menseki"]!=NULL) {echo $osusumedata[2]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td width="180">
                                        <?php if($osusumedata[3]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[3]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[3]["bunrui"],$osusumedata[3]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[3]["id"]; ?><?php }else if($osusumedata[3]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[3]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[3]["id"]."/".$osusumedata[3]["photo1"])&&$osusumedata[3]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[3]["id"]."/".$osusumedata[3]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[3]["jyusyo1"].$osusumedata[3]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[3]["jyusyo1"].$osusumedata[3]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[3]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[3]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[3]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[3]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[3]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[3]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[3]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[3]["eki"]!=NULL) {echo $osusumedata[3]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[3]["ensen"]!=NULL){?>
[<?php echo $osusumedata[3]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[3]["banchichk"]){
																																																				$jyusyo[3]=mb_convert_kana($osusumedata[3]["jyusyo1"].$osusumedata[3]["jyusyo2"].$osusumedata[3]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[3]=mb_convert_kana($osusumedata[3]["jyusyo1"].$osusumedata[3]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[3],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[3]["madori"]!=NULL&&$osusumedata[3]["madori"]!=0){echo $osusumedata[3]["madori"].$osusumedata[3]["madori_tani"];}else if($osusumedata[3]["senyumenseki"]!=NULL&&$osusumedata[3]["senyumenseki"]!=0) {echo $osusumedata[3]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[3]["menseki"]!=NULL) {echo $osusumedata[3]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="3" colspan="4"><img src="img/template/space.jpg" alt="¥¹¥Ú¡¼¥¹" width="4" height="5" /></td>
                                </tr>
                                <tr>
                                    <td valign="top">
                                        <?php if($osusumedata[4]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¡¡">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"> <a href="<?php if($osusumedata[4]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[4]["bunrui"],$osusumedata[4]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[4]["id"]; ?><?php }else if($osusumedata[4]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[4]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[4]["id"]."/".$osusumedata[4]["photo1"])&&$osusumedata[4]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[4]["id"]."/".$osusumedata[4]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[4]["jyusyo1"].$osusumedata[4]["jyusyo2"]."\" />";
}
else {
?>
                                                </a><a href="<?php if($osusumedata[4]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[4]["bunrui"],$osusumedata[4]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[4]["id"]; ?><?php }else if($osusumedata[4]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[4]["id"]; }?>"><img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[4]["jyusyo1"].$osusumedata[4]["jyusyo2"];?>" /></a><a href="<?php if($osusumedata[4]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[4]["bunrui"],$osusumedata[4]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[4]["id"]; ?><?php }else if($osusumedata[4]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[4]["id"]; }?>">
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[4]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[4]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[4]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[4]["bunrui"];?>" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[4]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[4]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[4]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                <?php if($osusumedata[4]["eki"]!=NULL) {echo $osusumedata[4]["eki"]."±Ø";} ?>
                                                <?php if( $osusumedata[4]["ensen"]!=NULL){?>
[<?php echo $osusumedata[4]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                				<?php 
																																																if($osusumedata[4]["banchichk"]){
																																																				$jyusyo[4]=mb_convert_kana($osusumedata[4]["jyusyo1"].$osusumedata[4]["jyusyo2"].$osusumedata[4]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[4]=mb_convert_kana($osusumedata[4]["jyusyo1"].$osusumedata[4]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[4],12,"<br>");

																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[4]["madori"]!=NULL&&$osusumedata[4]["madori"]!=0){echo $osusumedata[4]["madori"].$osusumedata[4]["madori_tani"];}else if($osusumedata[4]["senyumenseki"]!=NULL) {echo $osusumedata[4]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[4]["menseki"]!=NULL) {echo $osusumedata[4]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td>
                                        <?php if($osusumedata[5]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[5]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[5]["bunrui"],$osusumedata[5]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[5]["id"]; ?><?php }else if($osusumedata[5]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[5]["id"]; }?>">
                                                    <?php
if(@file_exists("./tmp/bukken_data/".$osusumedata[5]["id"]."/".$osusumedata[5]["photo1"])&&$osusumedata[5]["photo1"]!=NULL) {
	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[5]["id"]."/".$osusumedata[5]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[5]["jyusyo1"].$osusumedata[5]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[5]["jyusyo1"].$osusumedata[5]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" border="0" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[5]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[5]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[5]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[5]["bunrui"];?>" summary="ÉÔÆ°»ºÊª·ï¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[5]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[5]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[5]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[5]["eki"]!=NULL) {echo $osusumedata[5]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[5]["ensen"]!=NULL){?>
[<?php echo $osusumedata[5]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[5]["banchichk"]){
																																																				$jyusyo[5]=mb_convert_kana($osusumedata[5]["jyusyo1"].$osusumedata[5]["jyusyo2"].$osusumedata[5]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[5]=mb_convert_kana($osusumedata[5]["jyusyo1"].$osusumedata[5]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[5],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[5]["madori"]!=NULL&&$osusumedata[5]["madori"]!=0){echo $osusumedata[5]["madori"].$osusumedata[5]["madori_tani"];}else if($osusumedata[5]["senyumenseki"]!=NULL) {echo $osusumedata[5]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[5]["menseki"]!=NULL) {echo $osusumedata[5]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td>
                                        <?php if($osusumedata[6]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[6]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[6]["bunrui"],$osusumedata[6]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[6]["id"]; ?><?php }else if($osusumedata[6]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[6]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[6]["id"]."/".$osusumedata[6]["photo1"])&&$osusumedata[6]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[6]["id"]."/".$osusumedata[6]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[6]["jyusyo1"].$osusumedata[6]["jyusyo2"]."\" />";
}
else {
?>
                                                <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[6]["jyusyo1"].$osusumedata[6]["jyusyo2"];?>" /></a><a href="<?php if($osusumedata[6]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[6]["bunrui"],$osusumedata[6]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[6]["id"]; ?><?php }else if($osusumedata[6]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[6]["id"]; }?>">
                                                <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[6]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[6]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[6]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[6]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[6]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[6]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[6]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[6]["eki"]!=NULL) {echo $osusumedata[6]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[6]["ensen"]!=NULL){?>
[<?php echo $osusumedata[6]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                				<?php 
																																																if($osusumedata[6]["banchichk"]){
																																																				$jyusyo[6]=mb_convert_kana($osusumedata[6]["jyusyo1"].$osusumedata[6]["jyusyo2"].$osusumedata[6]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[6]=mb_convert_kana($osusumedata[6]["jyusyo1"].$osusumedata[6]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[6],12,"<br>");

																																																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                				<?php if($osusumedata[6]["madori"]!=NULL&&$osusumedata[6]["madori"]!=0){echo $osusumedata[6]["madori"].$osusumedata[6]["madori_tani"];}else if($osusumedata[6]["senyumenseki"]!=NULL) {echo $osusumedata[6]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[6]["menseki"]!=NULL) {echo $osusumedata[6]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                    <td>
                                        <?php if($osusumedata[7]["id"]!=NULL) {?>
                                        <table width="170" border="0" align="center" cellpadding="0" cellspacing="0" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border1.jpg" alt="border" width="170" height="6" /></td>
                                            </tr>
                                            <tr>
                                                <td width="5" rowspan="6" background="img/index/bukken_border2.jpg"><img src="img/index/bukken_border2.jpg" alt="border" width="5" height="15" /></td>
                                                <td width="160" height="102" align="center"><a href="<?php if($osusumedata[7]["bunrui"]==1) {?>chintai_d<?php echo syubetsuchk($osusumedata[7]["bunrui"],$osusumedata[3]["syumoku"]); ?>.php<?php echo "?bid=".$osusumedata[7]["id"]; ?><?php }else if($osusumedata[7]["bunrui"]==2){?>baibai_d.php<?php echo "?bid=".$osusumedata[7]["id"]; }?>">
                                                    <?php
																				 if(@file_exists("./tmp/bukken_data/".$osusumedata[7]["id"]."/".$osusumedata[7]["photo1"])&&$osusumedata[7]["photo1"]!=NULL) {

	$fdata=(pathinfo("./tmp/bukken_data/".$osusumedata[7]["id"]."/".$osusumedata[7]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/top".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='145' alt=\"".$osusumedata[7]["jyusyo1"].$osusumedata[7]["jyusyo2"]."\" />";
}
else {
?>
                                                    <img src="/img/noimage_120_120.gif" border="0" alt="<?php echo $osusumedata[7]["jyusyo1"].$osusumedata[7]["jyusyo2"];?>" />
                                                    <?php
}
?>
                                                </a></td>
                                                <td width="5" rowspan="6" background="img/index/bukken_border3.jpg"><img src="img/index/bukken_border3.jpg" alt="border" width="5" height="15" /></td>
                                            </tr>
                                            <tr>
                                                <td height="25" valign="bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                            <td>
                                                                <?php 
																						if($osusumedata[7]["bunrui"]==1) {
																						?>
                                                                <img src="img/index/cbukken.jpg" alt="ÄÂÂßÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						else {
																						?>
                                                                <img src="img/index/bbukken.jpg" alt="ÇäÇãÊª·ï" width="55" height="13" />
                                                                <?php
																						}
																						?>
                                                            </td>
                                                            <td>
                                                                <div align="center"> <font color="#FF0000">
                                                                    <?php 
																						if($osusumedata[7]["genkyou"]=="¾¦ÃÌÃæ") {
																						?>
                                                                    ¡Ú¾¦ÃÌÃæ¡Û
                                                                    <?php
																						}
																						else if($osusumedata[7]["genkyou"]=="À®ÌóºÑ") {
																						?>
                                                                    ¡ÚÀ®ÌóºÑ¡Û
                                                                    <?php
																						}
																						?>
                                                                </font></div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <table width="100%" border="0" cellpadding="5" cellspacing="0" class="osusumebukkenprice<?php echo $osusumedata[7]["bunrui"];?>" summary="¥ì¥¤¥¢¥¦¥ÈÍÑ¥Æ¡¼¥Ö¥ë">
                                                        <tr>
                                                            <td height="25" align="right"><strong><font color="#FFFFFF"><?php 
																																																												if($osusumedata[7]["kakaku"]>=1000) {
																																																												echo numberformat($osusumedata[7]["kakaku"]);
																																																												}else {
																																																													echo $osusumedata[7]["kakaku"];
																																																												}
																																																												?>Ëü±ß</font></strong></td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php if($osusumedata[7]["eki"]!=NULL) {echo $osusumedata[7]["eki"]."±Ø";} ?>
                                                		<?php if( $osusumedata[7]["ensen"]!=NULL){?>
[<?php echo $osusumedata[7]["ensen"];?>]
<?php }?></td>
                                            </tr>
                                            <tr>
                                                <td height="25"><?php 
																																																if($osusumedata[7]["banchichk"]){
																																																				$jyusyo[7]=mb_convert_kana($osusumedata[7]["jyusyo1"].$osusumedata[7]["jyusyo2"].$osusumedata[7]["jyusyo3"],"ka");
																																																}
																																																else {
																																																				$jyusyo[7]=mb_convert_kana($osusumedata[7]["jyusyo1"].$osusumedata[7]["jyusyo2"],"ka");
																																																}
																																																echo chunk_text($jyusyo[7],12,"<br>");

																																																?></td>
                                            </tr>
                                            <tr>
                                                <td height="25">
                                                    <?php if($osusumedata[7]["madori"]!=NULL&&$osusumedata[7]["madori"]!=0){echo $osusumedata[7]["madori"].$osusumedata[7]["madori_tani"];}else if($osusumedata[7]["senyumenseki"]!=NULL&&$osusumedata[7]["senyumenseki"]!=0) {echo $osusumedata[7]["senyumenseki"]."m<sup>2</sup>";}else if($osusumedata[7]["menseki"]!=NULL) {echo $osusumedata[7]["menseki"]."m<sup>2</sup>";} ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"><img src="img/index/bukken_border4.jpg" alt="border" width="170" height="9" /></td>
                                            </tr>
                                        </table>
                                        <?php 
																		}
																		?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="20" background="img/top/TopContentsRight.jpg">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="3"><img src="img/top/TopContentsBottom.jpg" width="768" height="13"></td>
                    </tr>
                </table>
            </div><?php
												}
												?>
        </td>
    </tr>
</table>
<?php

$_SESSION["visit"]=1;
include "/tmp/CUBE/Fudousan/template/footer.php";

?>
<map name="Map2">
    <area shape="rect" coords="337,5,448,37" href="#">
</map>
<map name="Map">
    <area shape="rect" coords="12,70,160,93" href="chintai.php?cid=1">
    <area shape="rect" coords="13,91,159,116" href="chintai.php?cid=2">
    <area shape="rect" coords="12,115,160,139" href="chintai.php?cid=3">
</map>
<map name="Map3">
    <area shape="rect" coords="12,69,165,92" href="baibai.php?cid=4">
    <area shape="rect" coords="13,91,165,115" href="baibai.php?cid=6">
    <area shape="rect" coords="12,115,165,139" href="baibai.php?cid=5">
</map>
<map name="newbukken">
    <area shape="rect" coords="636,6,751,35" href="newbukken.php">
</map>
<map name="osusumebukken">
    <area shape="rect" coords="613,6,765,34" href="osusumebukken.php">
</map>

<map name="topiccs"><area shape="rect" coords="580,6,762,28" href="topics.php">
</map>
</body>
</html>
<?php

?>
