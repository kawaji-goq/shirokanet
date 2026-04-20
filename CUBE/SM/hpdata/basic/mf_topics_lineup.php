<?php

	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$tenpodata=$dbobj->GetData("select * from tenpo_data");


if($_GET["year"]==""&&$_GET["month"]==""&&$_GET["cate_id"]==NULL) {
$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc, blog_id desc";
}
else if($_GET["year"]==NULL&&$_GET["month"]==NULL) {
$newblogsql="select * from blog_data where cate_id=".$_GET["cate_id"]." and view_chk = 1 order by rdate desc, blog_id desc";
}
else if($_GET["year"]==NULL&&$_GET["cate_id"]==NULL) {
$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and view_chk = 1 order by rdate desc, blog_id desc";
}else if($_GET["month"]==NULL&&$_GET["cate_id"]==NULL) {
$newblogsql="select * from blog_data where ryear=".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc";
}
else if($_GET["month"]==NULL) {
$newblogsql="select * from blog_data where cate_id=".$_GET["cate_id"]." and ryear=".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc";
}
else if($_GET["year"]==NULL) {
$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and  cate_id=".$_GET["cate_id"]." and view_chk = 1 order by rdate desc, blog_id desc";
}
else if($_GET["cate_id"]==NULL) {
$newblogsql="select * from blog_data where rmonth=".$_GET["month"]." and ryear=".$_GET["year"]." and view_chk = 1 order by rdate desc, blog_id desc";
	
}
$newblogdata=$dbobj->GetList($newblogsql);

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
</style>
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
              <td width="622" class="text2"><p>活動報告・トピックス　一覧</p></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="top">&nbsp;</td>
              <td align="left" valign="top" class="text2"><p><span class="texttitle_1"><?php if($_GET["year"]!=NULL) {echo $_GET["year"] ?>年<?php } if($_GET["month"]!=NULL) {echo $_GET["month"]; ?>月 <?php } ?><?php 
														if($_GET["cate_id"]!=NULL) {
														$blogcatedata=$dbobj->GetData("select * from blog_cate where cate_id = ".$_GET["cate_id"]);														
														echo $blogcatedata["cate_name"];
														}
														 ?></span><br />
                      <br />
              </p></td>
            </tr>
          </table>
              <?php
														for($bi=0;$newblogdata[$bi]["blog_id"]!=NULL;$bi++) {
													$news=new Ary_Viewer($newblogdata[$bi]);	 
														?>
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td width="13%" align="left" valign="top"><table width="70" height="52" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><a href="topics_details.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo $news->Image("image2");?></a></td>
                    </tr>
                </table></td>
                <td width="85%" align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" class="text_small"><?php echo str_replace("-","/",$newblogdata[$bi]["rdate"]); ?></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="text2"><a href="mf_topics_closeup_1.php?blog_id=<?php echo $newblogdata[$bi]["blog_id"]; ?>"><?php echo $newblogdata[$bi]["title"]; ?></a></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><p class="text2"><span class="text"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($newblogdata[$bi]["comm"],"KHSA")),0,110,"・・・","EUC-JP"); ?></span></p>
                      </td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="3" align="center" valign="top"><img src="img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table><?php
														}
														?>
          </td>
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
