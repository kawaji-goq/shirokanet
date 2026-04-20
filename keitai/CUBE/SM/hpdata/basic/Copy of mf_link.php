<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	if($_REQUEST["cate"]==NULL) {
		$_REQUEST["cate"]=1;
	}
$linkcatedata=$dbobj->GetData("select * from link_cate where cate_id= ".$_REQUEST["cate"]." and view_chk <>0");
$menudata=$dbobj->GetData("select * from  menu_data where data_code ='link' and use_chk=1");
$linkdatalist=$dbobj->GetList("select * from link_data where cate_id= ".$_REQUEST["cate"]." and view_chk <>0");
?><eta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
.style6 {color: #999999}
.style7 {
	color: #999999;
	font-size: 12px;
}
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
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="600" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2"><p><?php echo $menudata["data_name"] ?></p></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="texttitle_1"><?php echo $linkcatedata["cate_name"] ?></td>
                  </tr>
                </table>
                <table width="97%" border="0" cellspacing="1" cellpadding="1">
                    <?php
																				for($ldi=0;$linkdatalist[$ldi]["data_id"]!=NULL;$ldi++) {
																				?>
																				<tr>
                      <td width="3%" align="left" valign="top"><span class="style7">¢£</span></td>
                      <td width="97%" align="left" valign="top" class="text2"><a href="<?php echo $linkdatalist[$ldi]["url"] ?>" target="<?php echo $linkdatalist[$ldi]["link_type"] ?>"><?php echo $linkdatalist[$ldi]["data_name"] ?></a></td>
                    </tr>
																				<?php
																				}
																				?>
                    <tr>
                      <td align="left" valign="top" class="text2 style6">&nbsp;</td>
                      <td align="left" valign="top" class="text2">&nbsp;</td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>
