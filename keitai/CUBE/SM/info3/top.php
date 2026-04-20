<?php 
$ad_info3=new Admin_Info3($dbobj);
$info3setting=$ad_info3->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_info3->DeleteCate($_GET["delid"]);
	?><script language="javascript">
		location.replace("?PID=info3_category");
</script>
	<?php
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_info3->UpdateCateList($_POST);
	?><script language="javascript">
		location.replace("?PID=info3_category");
</script>
	<?php
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=info3_category&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td colspan="3" valign="top">
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td width="200" valign="top">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info3catedata=$ad_info3->GetCateList($_GET["info3_id"],$lim,$setnum,$orderby);
for($info3row=0;$info3catedata[$info3row];$info3row++){ 
$info3cate=new Ary_Viewer($info3catedata[$info3row]);
?>
        
        <tr>
          <td align="left" valign="top" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></td>
        </tr>
        <tr>
          <td align="left" valign="top" bgcolor="#FFFFFF">
            <?php $info3cate->Moji("cate_name"); ?>
            <input name="cate_id[<?php echo $info3row; ?>]" type="hidden" id="cate_id[<?php echo $info3row; ?>]" value="<?php echo $info3catedata[$info3row]["cate_id"];?>" />
          </td>
        </tr>
        <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報１カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
      </table>
    </td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="500" valign="top">
      <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="49" align="center" bgcolor="#ECECEC">表示順</th>
            <th width="240" align="left" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
            <th width="89" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=info3_add'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info3catedata=$ad_info3->GetCateList($_GET["info3_id"],$lim,$setnum,$orderby);
for($info3row=0;$info3catedata[$info3row];$info3row++){ 
$info3cate=new Ary_Viewer($info3catedata[$info3row]);
?>
          <tr>
            <td align="center" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $info3row; ?>]" type="text" id="turn[<?php echo $info3row; ?>]" value="<?php $info3cate->Moji("turn"); ?>" size="6" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php $info3cate->Moji("cate_name"); ?>
              <input name="cate_id[<?php echo $info3row; ?>]" type="hidden" id="cate_id[<?php echo $info3row; ?>]" value="<?php echo $info3catedata[$info3row]["cate_id"];?>" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $info3row; ?>]">
                <option value="1"<?php if($info3catedata[$info3row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($info3catedata[$info3row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=info3_up&amp;cate_id=<?php echo $info3catedata[$info3row]["cate_id"];?>')" />
            </td>
            <td width="44" align="left" valign="top" bgcolor="#FFFFFF">
            		<input type="button" name="Submit" value="削除" onclick="delchk('<?php echo str_replace("\r","",str_replace("\n","",str_replace("\\r","",str_replace("\\n","",$info3catedata[$info3row]["cate_name"])))); ?>','<?php echo $info3catedata[$info3row]["cate_id"];?>')" /></td>
          </tr>
          <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報１カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
        </table>
        <table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
