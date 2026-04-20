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
<title>岩国駅前を活性化する会　山口県岩国市駅前通りの開発・活性化・イベントの実施など　/会員の皆様へ /「平成20年度第5回定例会議議定書について」</title>
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
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td align="left" valign="top"><img src="img/main/title_member.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="texttitle_1">定例会議について</td>
            </tr>
            <tr>
              <td align="left" valign="top">&nbsp;</td>
              <td align="center" valign="top" class="text2">＜ 1  2  3＞</td>
            </tr>
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2">6月3日</td>
            </tr>
            <tr>
              <td colspan="2" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
            </tr>
          </table>
            <table width="97%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top"><span class="texttitle_20">■定例会議について</span><br />
                    <p class="text2">（※参考）<span class="texttitle_1">岩国市議会平成19年3月定例会に岩国市交通事業の設置に関わる議案が上程予定</span><br />
                        <span class="text2"><a title="w:岩国市" href="http://ja.wikipedia.org/wiki/%E5%B2%A9%E5%9B%BD%E5%B8%82"><br />
                      </a>岩国市議会[1]の開設しているWebページに、2007年2月27日開会予定の平成19年第1回岩国市議会定例会（3月定例会）の議事日程[2]の項目として、「日程 第35   議案第54号　岩国市交通事業の設置等に関する条例の一部を改正する条例」が記載された。</span></p>                
                    <p class="text2">この記載が、岩国市交通局が100%出資の事業委託会社の設立を計画の記事と符合する内容なのかどうかは即断できないが、岩国市が所管している交通事業（傘下の地方公営企業である岩国市交通局も含まれるものと推測される）を営む上での根拠となる何らかの設置条例の改定が議会審議の対象となるのは、ほぼ間違いないものと思われる。</p>
                    <p class="text2"><br />
                      <br />
                      <a href="img/topics/photo/08/080603.jpg"rel="lightbox"><img src="img/topics/photo/08/080603.jpg" width="300" height="225" border="0" /></a><br />
                </p></td>
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
                <td align="center" valign="top" class="text2">＜ 1  2  3  ＞</td>
              </tr>

              <tr>
                <td colspan="2" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="img/main/title_lower.jpg" width="640" height="18" /></td>
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
