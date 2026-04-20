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
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<meta name="keywords" content="岩国駅前を活性化する会,岩国駅,商工会,中央通り,本通,中通り,商店街,麻里布,開業,イベント,ショップ,設立,助成,空き店舗,駅前,出店,アーケード,新規事業">
<meta name="description" content="岩国駅前を活性化する会　山口県岩国市の駅前通りの活性化・イベント実施・自治連合会他活動案内">
<title>岩国駅前を活性化する会　山口県岩国市駅前通りの開発・活性化・イベントの実施など　/　活動報告・トピックス/カテゴリ「イベント」一覧</title>
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
.style3 {line-height: 18px; font-size: 12px;}
.style4 {line-height: 18px; color:#333333; font-size: 14px;}
.style5 {color: #666666}
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
          <td width="600" height="35" align="left" valign="middle" background="img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2"><p>活動報告・トピックス　一覧</p>
                </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2"><p><span class="texttitle_1">イベント　一覧</span><br />
	</td>
            </tr>
          </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="center" valign="top" class="text2">＜ 1  2  3  4  5  6  7  8  9  次の10件＞</td>
              </tr>
            </table>
            <?php include"tmp_contents_sub.html" ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td width="13%" align="left" valign="top"><table width="70" height="52" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="img/index/subimg_2.jpg" width="70" height="52" /></td>
                    </tr>
                </table></td>
                <td width="85%" align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" class="text_small">2008年6月3日</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="text2">第52回岩国祭開催。例年を上回る来場数を達成！</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><p class="text2">岩国まつりは、毎年10月第3土曜・日曜日に岩国駅周辺を中心に、全市をあげて繰・・・</p></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td width="13%" align="left" valign="top"><table width="70" height="52" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><img src="img/index/subimg_3.jpg" width="70" height="52" /></td>
                    </tr>
                </table></td>
                <td width="85%" align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" class="text_small">2008年6月3日</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="text2">第52回岩国祭開催。例年を上回る来場数を達成！</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><p class="text2">岩国まつりは、毎年10月第3土曜・日曜日に岩国駅周辺を中心に、全市をあげて繰・・・</p></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
            <?php include"tmp_contents_sub.html" ?>
          <?php include"tmp_contents_sub.html" ?>
          <?php include"tmp_contents_sub.html" ?>
          <?php include"tmp_contents_sub.html" ?>
          <?php include"tmp_contents_sub.html" ?>
          <?php include"tmp_contents_sub.html" ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="center" valign="top" class="text2">＜ 1  2  3  4  5  6  7  8  9  次の10件＞</td>
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
