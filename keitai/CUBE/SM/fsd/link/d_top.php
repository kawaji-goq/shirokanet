<?php
$ad_link=new Ad_Links($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_link->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_link->UpdateDataList($_POST);
	
}

$linkcatedata=$ad_link->GetCateList(0,$lim,$setnum,$orderby);
$linkcdata=$ad_link->ChangeLay($linkcatedata,3);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=link_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="1" cellspacing="1">
  <tr>
  		<td colspan="2" align="left">
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　リンク管理　&gt;&gt;　リンクデータ一覧</strong></p>
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

        <form id="form1" name="form1" method="post" action="">        <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
            <tr>
                <td width="51" align="left" valign="top" bgcolor="#ECECEC"><strong>表示順</strong></td>
                <td width="102" align="left" valign="top" nowrap bgcolor="#ECECEC">&nbsp;</td>
                <td width="256" align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                <td width="102" align="left" valign="top" bgcolor="#ECECEC"><strong>公開設定</strong></td>
                <td width="53" align="left" valign="top" bgcolor="#ECECEC"><strong>削除</strong></td>
            </tr>
        </table><?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkdata=$ad_link->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkdata[$linkrow];$linkrow++){ 
$linkddata=new Ary_Viewer($linkdata[$linkrow]);
?>
          <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
              <tr>
                  <td width="51" rowspan="4" align="left" valign="top" bgcolor="#FFFFFF">
                      <input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkddata->Moji("turn"); ?>" size="6" />
                  </td>
                  <td width="102" align="left" valign="top" nowrap bgcolor="#FFFFFF"><strong>タイトル</strong></td>
                  <td width="256" align="left" valign="top" bgcolor="#FFFFFF">
                      <input name="textfield" type="text" value="<?php $linkddata->Moji("data_name"); ?>" size="40">
                      <input name="data_id[<?php echo $linkrow; ?>]" type="hidden" id="data_id[<?php echo $linkrow; ?>]" value="<?php echo $linkdata[$linkrow]["data_id"];?>" />
                  </td>
                  <td width="102" rowspan="4" align="left" valign="top" bgcolor="#FFFFFF">
                      <select name="view_chk[<?php echo $linkrow; ?>]">
                          <option value="1"<?php if($linkdata[$linkrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                          <option value="0"<?php if($linkdata[$linkrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
                      </select>
                  </td>
                  <td width="53" rowspan="4" align="left" valign="top" bgcolor="#FFFFFF">
                      <input type="button" name="Submit" value="削除" onClick="delchk('<?php $linkddata->Moji("data_name"); ?>','<?php echo $linkdata[$linkrow]["data_id"];?>')" />
                  </td>
              </tr>
              <tr>
                  <td width="102" align="left" valign="top" nowrap bgcolor="#FFFFFF"><strong>URL</strong></td>
                  <td width="256" align="left" valign="top" bgcolor="#FFFFFF">
                      <input name="textfield" type="text" value="<?php $linkddata->Moji("url"); ?>" size="40">
                  </td>
              </tr>
              <tr>
                  <td width="102" align="left" valign="top" nowrap bgcolor="#FFFFFF"><strong>ウィンドウ　　　</strong></td>
                  <td width="256" align="left" valign="top" bgcolor="#FFFFFF">
                      <select name="select">
                          <option value="_blank">新規ウィンドウで開く</option>
                          <option value="_self">同じウィンドウで開く</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td align="left" valign="top" nowrap bgcolor="#FFFFFF">&nbsp;</td>
                  <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                  </tr>
          </table>
          <table width="100%" border="0" cellspacing="1" cellpadding="2">
              <tr>
                  <td>&nbsp;</td>
              </tr>
          </table>
          <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
        <table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
              <input type="button" name="Submit" value="新規追加" onClick="location.href='?PID=link_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
