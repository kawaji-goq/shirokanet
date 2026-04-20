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
$ad_link=new Ad_Links($dbobj);

class bsad_Links extends Ad_Links{
	function UpdateCateList($data) {
		$db=$this->dbobj;
		$bname=$this->bname;
	
		for($i=0;$data["cate_id"][$i]!=NULL;$i++) {
			if($data["turn"][$i]==NULL) {
				$data["turn"][$i]=0;
			}
			$field[]="turn";
			$tdata[]=$data["turn"][$i];
			$field[]="cate_name";
			$tdata[]="'".$data["cate_name"][$i]."'";
			$field[]="view_chk";
			$tdata[]=$data["view_chk"][$i];
			$db->Update($bname."_cate",$field,$tdata," where cate_id = ".$data["cate_id"][$i]);
			unset($field,$tdata);
				$db->Query("update lastupdate set lastupdate=".time()."");
		} 
	}
}

$ad_link=new bsad_Links($dbobj);

$linksetting=$ad_link->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_link->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="¹¹¿·¤¹¤ë") {

	$ad_link->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"¤òºï½ü¤·¤Æ¤â¤è¤í¤·¤¤¤Ç¤¹¤«¡©");
	
	if(res) {
		location.href="?PID=hp_basic_link_category&pmode=delete&delid="+id;
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
              <td width="622" class="text2">
                  <p>¥ê¥ó¥¯¥«¥Æ¥´¥êÊÔ½¸</p>
              </td>
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
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td>
                                <form id="form1" name="form1" method="post" action="">
                                    <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                        <tr>
                                            <th width="68" align="center" bgcolor="#ECECEC">
                                                <div align="center">É½¼¨½ç</div>
                                            </th>
                                            <th width="394" align="left" bgcolor="#ECECEC"><strong>¥«¥Æ¥´¥êÌ¾</strong></th>
                                            <th width="89" align="left" bgcolor="#ECECEC">
                                                <div align="center">¸ø³«ÀßÄê</div>
                                            </th>
                                            <th align="left" bgcolor="#ECECEC">
                                                <div align="center">ºï½ü</div>
                                            </th>
                                        </tr>
                                        <?php
/****************************************************************/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷³«»Ï¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
/*¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­¢­*/
$linkcatedata=$ad_link->GetCateList($_GET["link_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkcatedata[$linkrow];$linkrow++){ 
$linkcate=new Ary_Viewer($linkcatedata[$linkrow]);
?>
                                        <tr>
                                            <td width="68" align="center" valign="middle" bgcolor="#FFFFFF">
                                                <div align="center">
                                                    <input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkcate->Moji("turn"); ?>" size="6" />
                                                    </div>
                                            </td>
                                            <td width="394" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <input name="cate_name[<?php echo $linkrow; ?>]" type="text" id="cate_name[<?php echo $linkrow; ?>]" value="<?php $linkcate->Moji("cate_name"); ?>" size="40">
                                                <input name="cate_id[<?php echo $linkrow; ?>]" type="hidden" id="cate_id[<?php echo $linkrow; ?>]" value="<?php echo $linkcatedata[$linkrow]["cate_id"];?>" />
                                            </td>
                                            <td align="left" valign="middle" bgcolor="#FFFFFF">
                                                <div align="center">
                                                    <select name="view_chk[<?php echo $linkrow; ?>]">
                                                        <option value="1"<?php if($linkcatedata[$linkrow]["view_chk"]==1) {echo " selected";}?>>¸ø³«¤¹¤ë</option>
                                                        <option value="0"<?php if($linkcatedata[$linkrow]["view_chk"]==0) {echo " selected";}?>>¸ø³«¤·¤Ê¤¤</option>
                                                    </select>
                                                    </div>
                                            </td>
                                            <td width="42" align="left" valign="middle" bgcolor="#FFFFFF">
                                                <div align="center">
                                                    <input type="button" name="Submit" value="ºï½ü" onclick="delchk('<?php $linkcate->Moji("cate_name"); ?>','<?php echo $linkcatedata[$linkrow]["cate_id"];?>')" />
                                                    </div>
                                            </td>
                                        </tr>
                                        <?php 
				}
				/*¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬¢¬*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡»Ü¹©¼ÂÀÓ¥«¥Æ¥´¥ê°ìÍ÷½ªÎ»¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/*¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡¡*/
				/****************************************************************/
				?>
                                    </table>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" align="left">
                                                <input name="btm_up_data" type="submit" id="btm_up_data" value="¹¹¿·¤¹¤ë" />
                                                <input name="btm_add_data" type="button" id="btm_add_data" value="¿·µ¬ÅÐÏ¿" onClick="location.href='?PID=hp_basic_link_category_reg'"/>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            </td>
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
