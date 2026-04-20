<?php 

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
		location.href="?PID=link_category&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="710" border="0" align="left" cellpadding="1" cellspacing="1">
  <tr>
  		<td colspan="2" align="left">
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="ÊÔ½¸Ãæ¤Î¥¨¥ê¥¢" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>¡¡¥ê¥ó¥¯´ÉÍý¡¡&gt;&gt;¡¡¥«¥Æ¥´¥ê°ìÍ÷</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
    </tr>
  <tr>
    <td width="10" align="left" valign="top">&nbsp;</td>
    <td width="500" align="left" valign="top">
      	<table border="0" align="center">
        
        <tr>
          <td>
            <form id="form1" name="form1" method="post" action="">
              <table border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                  <th width="50" align="center" bgcolor="#ECECEC">É½¼¨½ç</th>
                  <th width="150" align="left" bgcolor="#ECECEC"><strong>Ž¶ŽÃŽºŽÞŽØÌ¾</strong></th>
                  <th width="100" align="left" bgcolor="#ECECEC">¸ø³«</th>
                  <th align="left" bgcolor="#ECECEC">
                    <div align="center">ÊÔ½¸</div>
                  </th>
                  <th align="left" bgcolor="#ECECEC">ºï½ü</th>
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
                  <td width="50" align="center" valign="top" bgcolor="#FFFFFF">
                    <input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkcate->Moji("turn"); ?>" size="6" />
                  </td>
                  <td width="150" align="left" valign="top" bgcolor="#FFFFFF">
                    <input name="cate_name[<?php echo $linkrow; ?>]" type="text" id="cate_name[<?php echo $linkrow; ?>]" value="<?php $linkcate->Moji("cate_name"); ?>" size="40">
                    
                    <input name="cate_id[<?php echo $linkrow; ?>]" type="hidden" id="cate_id[<?php echo $linkrow; ?>]" value="<?php echo $linkcatedata[$linkrow]["cate_id"];?>" />
                  </td>
                  <td align="left" valign="top" bgcolor="#FFFFFF">
                    <select name="view_chk[<?php echo $linkrow; ?>]">
                      <option value="1"<?php if($linkcatedata[$linkrow]["view_chk"]==1) {echo " selected";}?>>¸ø³«¤¹¤ë</option>
                      <option value="0"<?php if($linkcatedata[$linkrow]["view_chk"]==0) {echo " selected";}?>>¸ø³«¤·¤Ê¤¤</option>
                    </select>
                  </td>
                  <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
                    <input type="button" name="Submit" value="ÊÔ½¸" onclick="location.replace('?PID=link_details&cate_id=<?php echo $linkcatedata[$linkrow]["cate_id"];?>')" />
                  </td>
                  <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
                    <input type="button" name="Submit" value="ºï½ü" onclick="delchk('<?php $linkcate->Moji("cate_name"); ?>','<?php echo $linkcatedata[$linkrow]["cate_id"];?>')" />
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
                    <input name="btm_add_data" type="button" id="btm_add_data" value="¿·µ¬ÅÐÏ¿" onClick="location.href='?PID=link_add'"/>
                    <input type="button" name="Submit" value="¥Ú¡¼¥¸ÀßÄê" onClick="location.href='?PID=pagesetting'">
                  </td>
                  </tr>
              </table>
            </form>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
