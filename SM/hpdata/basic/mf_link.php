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
	
$linkacatedata=$dbobj->GetData("select * from link_cate where cate_id= ".$_REQUEST["cate"]."");
$menudata=$dbobj->GetData("select * from  menu_data where data_code ='link' and use_chk=1");
$linkdatalist=$dbobj->GetList("select * from link_data where cate_id= ".$_REQUEST["cate"]."");


class MyAd_Links extends Admin_Links{
	function UpdateDataList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["data_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="data_name";
			$tdata[]="'".$data["data_name"][$i]."'";
			$field[]="url";
			$tdata[]="'".$data["url"][$i]."'";
			$field[]="link_type";
			$tdata[]="".$data["link_type"][$i]."";
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			
			$db->Update($bname."_data",$field,$tdata," where data_id = ".$data["data_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		} 
	}
}
$ad_link=new MyAd_Links($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_link->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="¹¹¿·¤¹¤ë") {

	$ad_link->UpdateDataList($_POST);
	
}

$linkcatedata=$ad_link->GetCateList(0,$lim,$setnum,$orderby);
$linkcdata=$ad_link->ChangeLay($linkcatedata,3);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"¤òºï½ü¤·¤Æ¤â¤è¤í¤·¤¤¤Ç¤¹¤«¡©");
	
	if(res) {
		location.href="?PID=hp_basic_link_d&pmode=delete&cate=<?php echo $_GET["cate"];?>&delid="+id;
	}
	
}
</script><eta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
                    <td class="texttitle_1"><?php echo $linkacatedata["cate_name"] ?></td>
                  </tr>
                </table>
                    <form id="form1" name="form1" method="post" action="">
                        <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                                <td width="51" align="left" valign="top" bgcolor="#ECECEC">
                                    <div align="center"><strong>É½¼¨½ç</strong></div>
                                </td>
                                <td width="102" align="left" valign="top" nowrap bgcolor="#ECECEC">&nbsp;</td>
                                <td width="256" align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                                <td width="102" align="left" valign="top" bgcolor="#ECECEC">
                                    <div align="center"><strong>¸ø³«ÀßÄê</strong></div>
                                </td>
                                <td width="53" align="left" valign="top" bgcolor="#ECECEC">
                                    <div align="center"><strong>ºï½ü</strong></div>
                                </td>
                            </tr>
                        </table>
                        <?php
/****************************************************************/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷³«»Ï¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­*/
$linkdata=$ad_link->GetDataList($_GET["cate"],$lim,$setnum,$orderby);
for($linkrow=0;$linkdata[$linkrow];$linkrow++){ 
$linkddata=new Ary_Viewer($linkdata[$linkrow]);
?>
                        <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                                <td width="51" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF">
                                    <div align="center">
                                        <input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkddata->Moji("turn"); ?>" size="6" />
                                        </div>
                                </td>
                                <td width="102" align="left" valign="middle" nowrap bgcolor="#FFFFFF"><strong>¥¿¥¤¥È¥ë</strong></td>
                                <td width="256" align="left" valign="middle" bgcolor="#FFFFFF">
                                    <input name="data_name[<?php echo $linkrow; ?>]" type="text" value="<?php $linkddata->Moji("data_name"); ?>" size="40">
                                    <input name="data_id[<?php echo $linkrow; ?>]" type="hidden" id="data_id[<?php echo $linkrow; ?>]" value="<?php echo $linkdata[$linkrow]["data_id"];?>" />
                                </td>
                                <td width="102" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF">
                                    <div align="center">
                                        <select name="view_chk[<?php echo $linkrow; ?>]">
                                            <option value="1"<?php if($linkdata[$linkrow]["view_chk"]==1) {echo " selected";}?>>¸ø³«¤¹¤ë</option>
                                            <option value="0"<?php if($linkdata[$linkrow]["view_chk"]==0) {echo " selected";}?>>¸ø³«¤·¤Ê¤¤</option>
                                        </select>
                                        </div>
                                </td>
                                <td width="53" rowspan="3" align="left" valign="top" bgcolor="#FFFFFF">
                                    <div align="center">
                                        <input type="button" name="Submit" value="ºï½ü" onClick="delchk('<?php $linkddata->Moji("data_name"); ?>','<?php echo $linkdata[$linkrow]["data_id"];?>')" />
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="102" align="left" nowrap bgcolor="#FFFFFF"><strong>URL</strong></td>
                                <td width="256" align="left" bgcolor="#FFFFFF">
                                    <input name="url[<?php echo $linkrow; ?>]" type="text" value="<?php $linkddata->Moji("url"); ?>" size="40" style="ime-mode:disabled;">
                                </td>
                            </tr>
                            <tr>
                                <td align="left" nowrap bgcolor="#FFFFFF"><strong>¥¦¥£¥ó¥É¥¦</strong></td>
                                <td align="left" bgcolor="#FFFFFF">
                                    <select name="link_type[<?php echo $linkrow; ?>]">
                                        <option value="0"<?php if($linkdata[$linkrow]["link_type"]==0){ echo " selected";}?>>¿·µ¬¥¦¥£¥ó¥É¥¦¤Ç³«¤¯</option>
                                        <option value="1"<?php if($linkdata[$linkrow]["link_type"]==1){ echo " selected";}?>>Æ±¤¸¥¦¥£¥ó¥É¥¦¤Ç³«¤¯</option>
                                    </select>
                                </td>
                                </tr>
                        </table>
                        <table width="100%" border="0" cellspacing="1" cellpadding="2">
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                        <?php 
				}
				/*¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷½ªÎ»¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/****************************************************************/
				?>
                        <table width="100%" border="0">
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <input name="btm_up_data" type="submit" id="btm_up_data" value="¹¹¿·¤¹¤ë" />
                                    <input type="button" name="Submit" value="¿·µ¬ÅÐÏ¿" onClick="location.href='?PID=hp_basic_link_reg&cate_id=<?php echo $_GET["cate"];?>'" />
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form>
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
