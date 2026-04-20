<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	
	$newsobj=new Site_News($dbobj);
	
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);


	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newslist=$dbobj->GetList("select * from news_data where order by rdate desc");
	for($tni=0;$newslist[$tni]["news_id"]!=NULL;$tni++){
				if((time()-strtotime($newslist[$tni]["rdate"]))>$newslist[$tni]["viewday"]*24*60*60) {
						$dbobj->Query("update news_data set view_chk = 0 where news_id = ".$newslist[$tni]["news_id"]);
				}
	}
	$newslist="";
	$newslist=$dbobj->GetList("select * from news_data order by rdate desc");
	$bloglist=$dbobj->GetList("select * from blog_data order by rdate desc limit 5");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<title><?php echo $tenpodata["pagetitle"];?></title>
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
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
.style1 {	color: #999999;
	font-size: 12px;
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
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
     <?php if($tenpodata["topimage"]) {?> <tr>
        <td align="left" valign="top"><img src="<?php echo $tenpodata["topimage"];?>?<?php echo time();?>" width="640" height="300" ></td>
      </tr><?php }?><?php if($tenpodata["header"]!=NULL) {?>
      <tr>
          <td align="left" valign="top"><?php echo $tenpodata["header"] ?></td>
      </tr><?php
						}
						?>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_guide.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="2%" align="left" valign="middle">&nbsp;</td>
              <td align="left" valign="middle"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                    <?php
																					for($tni=0;$newslist[$tni]["news_id"]!=NULL;$tni++){
																					$exdate=explode("-",$newslist[$tni]["rdate"]);																		
																				?><tr>
                      <td width="15%" align="left" valign="middle" class="text_small"><?php echo $exdate[0]; ?>年<?php echo number_format($exdate[1]); ?>月<?php echo number_format($exdate[2]); ?>日</td>
                      <td width="85%" align="left" valign="top" class="text2"><a href="?PID=hp_basic_news&news_id=<?php echo $newslist[$tni]["news_id"] ?>"><?php echo $newslist[$tni]["title"] ?></a><?php 
																						if((time()-strtotime($newslist[$tni]["rdate"]))<=$newslist[$tni]["newday"]*24*60*60) {
																						?><img src="/img/main/new.jpg" width="29" height="13" /><?php }?></td>
                    </tr><?php
																				}
																				?>

                    <tr>
                        <td align="left" valign="middle" class="text_small">&nbsp;</td>
                        <td align="left" valign="top" class="text2">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left" valign="middle" class="text_small">
                            <table width="200" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="10">&nbsp;</td>
                                    <td width="12"><font color="#FF00FF"><span class="style1"><font color="#FF0099">■</font></span></font></td>
                                    <td width="178" class="text2"><font color="#FF00FF"><a href="?PID=hp_basic_news_reg"><font color="#FF0099">新しい記事を書く</font></a></font></td>
                                </tr>
                            </table>
                        </td>
                        </tr>
																				
                              </table>
                </td>
            </tr>
            
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="left" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_news.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <?php
																					for($tni=0;$bloglist[$tni]["blog_id"]!=NULL;$tni++){
																					$exdate=explode("-",$bloglist[$tni]["rdate"]);																		
																				?><tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                  <td width="13%" align="left" valign="top"><table width="70" height="52" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td><?php if($bloglist[$tni]["image"]!=NULL) {?><A href="?PID=hp_basic_blog_closeup&blog_id=<?php echo $bloglist[$tni]["blog_id"] ?>"><img src="<?php echo $bloglist[$tni]["image"];?>?<?php echo time();?>" width="70" height="52" border="0" /></A><?php }?></td>
                    </tr>
                    </table></td>
                  <td width="85%" align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td align="left" valign="top" class="text_small"><?php echo $exdate[0] ?>年<?php echo $exdate[1] ?>月<?php echo $exdate[2] ?>日</td>
                    </tr>
                    <tr>
                      <td align="left" valign="top" class="text2"><A href="?PID=hp_basic_blog_closeup&blog_id=<?php echo $bloglist[$tni]["blog_id"] ?>"><?php echo $bloglist[$tni]["title"] ?></A></td>
                    </tr>
                    <tr>
                      <td align="left" valign="top"><p class="text2"><?php echo mb_strimwidth(mb_convert_kana(strip_tags($bloglist[$tni]["comm"]),"NRKHVS","EUC-JP"),0,180,"･･･"); ?></p>
                      </td>
                    </tr>
																				
                    </table></td>
              </tr><?php
																				}
																				?>
              <tr>
                <td colspan="3" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
              </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="18" /></td>
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
