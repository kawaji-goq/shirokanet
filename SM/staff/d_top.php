<?php
$ad_staff=new Admin_Staff($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_staff->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_staff->UpdateDataList($_POST);
	
}
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=staff_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[5]["data_name"]; ?>　&gt;&gt;　データ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="left"><font color="#FF0000">※</font>の項目は必須です。</td>
  </tr>
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="49" align="left" bgcolor="#ECECEC">&nbsp;</th>
            <th width="173" align="left" bgcolor="#ECECEC"><strong>名前</strong></th>
            <th width="260" align="left" bgcolor="#ECECEC"><?php if($staffsetting["data_comm_chk"]==1) {?><strong>名前</strong><?php }?></th>
            <th width="89" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=staff_d_add&cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$staffdata=$ad_staff->GetDataList(0,$lim,$setnum,$orderby);
for($staffrow=0;$staffdata[$staffrow];$staffrow++){ 
$staffddata=new Ary_Viewer($staffdata[$staffrow]);
?>
          <tr>
            <td width="49" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $staffrow; ?>]" type="text" id="turn[<?php echo $staffrow; ?>]" value="<?php $staffddata->Moji("turn"); ?>" size="6" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php $staffddata->Moji("data_name"); ?>
              <input name="data_id[<?php echo $staffrow; ?>]" type="hidden" id="data_id[<?php echo $staffrow; ?>]" value="<?php echo $staffdata[$staffrow]["data_id"];?>" />
            </td>
               <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($staffsetting["cate_comm_chk"]==1) {?> <?php $staffddata->Moji("data_name"); ?><?php
			}
			?>
            </td>
         <td width="89" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $staffrow; ?>]">
                <option value="1"<?php if($staffdata[$staffrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($staffdata[$staffrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=staff_d_up&data_id=<?php echo $staffdata[$staffrow]["data_id"];?>')" />
            </td>
            <td width="44" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $staffddata->Moji("data_name"); ?>','<?php echo $staffdata[$staffrow]["data_id"];?>')" />
            </td>
          </tr>
          <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
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
