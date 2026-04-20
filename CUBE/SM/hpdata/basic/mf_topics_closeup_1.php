<?php
session_start();
	include "Cube/Fudousan/config.php";
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
			$dbobj->user="admin";
			$dbobj->pass="itc7310";
	}
	
	$dbobj->Connect();
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	if($_REQUEST["blog_id"]!=NULL) {
		$blogdata=$dbobj->GetData("select * from blog_data where blog_id = ".$_REQUEST["blog_id"]." and view_chk=1");
	}
	else {
		$blogdata=$dbobj->GetData("select * from blog_data where view_chk = 1");
	}
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<meta name="keywords" content="岩国駅前を活性化する会,岩国駅,商工会,中央通り,本通,中通り,商店街,麻里布,開業,イベント,ショップ,設立,助成,空き店舗,駅前,出店,アーケード,新規事業">
<meta name="description" content="岩国駅前を活性化する会　山口県岩国市の駅前通りの活性化・イベント実施・自治連合会他活動案内">
<title>岩国駅前を活性化する会　山口県岩国市駅前通りの開発・活性化・イベントの実施など　/　活動報告・トピックス /「第52回岩国祭開催。例年を上回る来場数を達成」</title>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/prototype.js"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/lightbox.js"></script>
<link rel="stylesheet" href="/JSLIBS/lightbox/2.03.3/css/lightbox.css" type="text/css" media="screen" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
-->
</style></head>

<body>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php include"tmp_left_topics.html" ?></td>
      </tr>
    </table>
    <table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td align="left" valign="top"><img src="img/main/title_closeup.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2" ><span class="textmenu">活動報告・トピックス</span>&gt;<a href="mf_topics_lineup.php?cate_id=<?php echo $_REQUEST["cate_id"];?>&year=<?php echo $blogdata["ryear"]; ?>&month=<?php echo $blogdata["rmonth"]; ?>"><?php echo $blogdata["ryear"]; ?>年<?php echo $blogdata["rmonth"]; ?>月</a>&gt;カテゴリ：<?php 
														$blogcatedata=$dbobj->GetData("select * from blog_cate where cate_id = ".$blogdata["cate_id"]);														
														echo $blogcatedata["cate_name"];
														 ?></td>
            </tr>
            
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2">&nbsp;</td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2"><table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><!--&lt;前のページ&gt; &lt; 1  2  3  4  5  6  7  8  9  次の10件&gt; &lt;次のページ&gt;--> </td>
                  </tr>
                </table></td>
            </tr>
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2"><?php echo date("Y年m月d日",strtotime($blogdata["rdate"]));?>　　<a href="mf_topics_lineup.php"></a></td>
            </tr>
            <tr>
              <td colspan="2" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top"><span class="texttitle_20">■<?php echo $blogdata["title"] ?></span><br />
                    <p class="text2"><?php echo $blogdata["comm"];?>
                        <?php if($blogdata["image"]!=NULL) {?>
                        <br />
                        <img src="<?php echo $blogdata["image"];?>" alt="<?php echo strip_tags($blogdata["text1"]);?>" /><br />
                        <?php }?>
                        <?php echo $blogdata["text1"];?>
                        <?php if($blogdata["data_image2"]!=NULL) {?>
                        <br />
                        <img src="<?php echo $blogdata["data_image2"];?>" alt="<?php echo strip_tags($blogdata["text2"]);?>" /><br />
                        <?php }?>
                        <span><?php echo $blogdata["text2"];?></span>
                        <?php if($blogdata["data_image3"]!=NULL) {?>
                        <br />
                        <img src="<?php echo $blogdata["data_image3"];?>" alt="<?php echo strip_tags($blogdata["text3"]);?>" /><br />
                        <?php }?>
                        <span><?php echo $blogdata["text3"];?></span></p>
                      </td>
              </tr>
            <tr>
              <td colspan="2" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td align="left" valign="top">&nbsp;</td>
                <td align="center" valign="top" class="text2">&nbsp;</td>
              </tr>
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="center" valign="top" class="text2"><table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td><!--&lt;前のページ&gt; &lt; 1  2  3  4  5  6  7  8  9  次の10件&gt; &lt;次のページ&gt;--> </td>
                  </tr>
                </table></td>
              </tr>

              <tr>
                <td colspan="2" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>
</body>
</html>
