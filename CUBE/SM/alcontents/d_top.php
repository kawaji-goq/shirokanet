<?php
$ad_contents1=new Admin_Contents1($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_contents1->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_contents1->UpdateDataList($_POST);
	
}
$lim="";
$contents1catedata=$ad_contents1->GetCateList(0,$lim,$setnum,$orderby);
$contents1cdata=$ad_contents1->ChangeLay($contents1catedata,4);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=alcontents_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td colspan="2" valign="top">
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[7]["data_name"]; ?>　&gt;&gt;　詳細データ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
  		<td colspan="2" valign="top">&nbsp;</td>
 		</tr>
  <tr>
    <td width="10" valign="top">&nbsp;</td>
      <form id="form1" name="form1" method="post" action="">
    <td width="500" valign="top">
      <?php
	if($_GET["cate_id"]!=NULL) {
	?>
        <table width="686" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="30" align="left" bgcolor="#ECECEC">&nbsp;</th>
            <th width="349" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <th width="91" align="left" bgcolor="#ECECEC">メニュー表示</th>
            <th width="89" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=alcontents_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$contents1data=$ad_contents1->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($contents1row=0;$contents1data[$contents1row];$contents1row++){ 
$contents1ddata=new Ary_Viewer($contents1data[$contents1row]);
?>
          <tr>
            <td width="30" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $contents1row; ?>]" type="text" id="turn[<?php echo $contents1row; ?>]" value="<?php $contents1ddata->Moji("turn"); ?>" size="6" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php $contents1ddata->Moji("data_name");
														if($contents1data[$contents1row]["osusume_chk"]==0&&$contents1data[$contents1row]["view_chk"]==1){
															if($_GET["cate_id"]==1){
															echo "<br><a href=\"http://www.e-altus.com/kounyuguide.php?cid=".$contents1data[$contents1row]["data_id"]."\" target=\"_blank\">http://www.e-altus.com/kounyuguide.php?cid=".$contents1data[$contents1row]["data_id"]."</a>";
															}
															else if($_GET["cate_id"]==2){
																		echo "<br><a href=\"http://www.e-altus.com/baikyakuguide.php?cid=".$contents1data[$contents1row]["data_id"]."\" target=\"_blank\">http://www.e-altus.com/kounyuguide.php?cid=".$contents1data[$contents1row]["data_id"]."</a>";
															}
														
														}
														 ?>
              <input name="data_id[<?php echo $contents1row; ?>]" type="hidden" id="data_id[<?php echo $contents1row; ?>]" value="<?php echo $contents1data[$contents1row]["data_id"];?>" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
            				<div align="center">
            								<input name="data_osusume_chk[<?php echo $contents1row; ?>]" type="checkbox" id="data_osusume_chk[<?php echo $contents1row; ?>]" value="1"<?php if($contents1data[$contents1row]["osusume_chk"]==1){ echo " checked";}?>>
            								</div>
            </td>
            <td width="89" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $contents1row; ?>]">
                <option value="1"<?php if($contents1data[$contents1row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($contents1data[$contents1row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=alcontents_d_up&amp;data_id=<?php echo $contents1data[$contents1row]["data_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $contents1ddata->LMoji("data_name"); ?>','<?php echo $contents1data[$contents1row]["data_id"];?>')" />
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
<table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
            </td>
            </tr>
        </table>      <?php
	  }
	  ?>
</td>
      </form>
  </tr>
</table>
