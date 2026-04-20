<?php 
$ad_contents2=new Admin_Contents2($dbobj);
$contents2setting=$ad_contents2->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_contents2->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_contents2->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=contents2_category&pmode=delete&delid="+id;
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
											<p><strong>　<?php echo $menudata[7]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td width="200" valign="top">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        <tr>
          <th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
        </tr>
        <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$contents2catedata=$ad_contents2->GetCateList($_GET["contents2_id"],$lim,$setnum,$orderby);
for($contents2row=0;$contents2catedata[$contents2row];$contents2row++){ 
$contents2cate=new Ary_Viewer($contents2catedata[$contents2row]);
?>
        <tr>
          <td align="left" valign="top" bgcolor="#FFFFFF"> <a href="index.php?PID=contents2_details&cate_id=<?php echo $contents2catedata[$contents2row]["cate_id"] ?>">
            <?php $contents2cate->Moji("cate_name"); ?>
            </a>
              <input name="cate_id[<?php echo $contents2row; ?>]" type="hidden" id="cate_id[<?php echo $contents2row; ?>]" value="<?php echo $contents2catedata[$contents2row]["cate_id"];?>" />
          </td>
        </tr>
        <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報２カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
      </table>
    </td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="500" valign="top">
    		<form id="form1" name="form1" method="post" action="">
    				<table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<th width="42" align="center" bgcolor="#ECECEC">表示順</th>
										<th width="160" align="left" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
										<th width="178" align="left" bgcolor="#ECECEC">公開</th>
										<th colspan="2" align="left" bgcolor="#ECECEC">
												<div align="center">
														<input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=contents2_add'" />
												</div>
										</th>
								</tr>
								<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$contents2catedata=$ad_contents2->GetCateList($_GET["contents2_id"],$lim,$setnum,$orderby);
for($contents2row=0;$contents2catedata[$contents2row];$contents2row++){ 
$contents2cate=new Ary_Viewer($contents2catedata[$contents2row]);
?>
								<tr>
										<td width="42" align="center" valign="top" bgcolor="#FFFFFF">
												<input name="turn[<?php echo $contents2row; ?>]" type="text" id="turn[<?php echo $contents2row; ?>]" value="<?php $contents2cate->Moji("turn"); ?>" size="6" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<?php $contents2cate->Moji("cate_name"); ?>
												<input name="cate_id[<?php echo $contents2row; ?>]" type="hidden" id="cate_id[<?php echo $contents2row; ?>]" value="<?php echo $contents2catedata[$contents2row]["cate_id"];?>" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<select name="view_chk[<?php echo $contents2row; ?>]">
														<option value="1"<?php if($contents2catedata[$contents2row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
														<option value="0"<?php if($contents2catedata[$contents2row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
												</select>
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="修正" onclick="location.replace('?PID=contents2_up&amp;cate_id=<?php echo $contents2catedata[$contents2row]["cate_id"];?>')" />
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="削除" onclick="delchk('<?php $contents2cate->LMoji("cate_name"); ?>','<?php echo $contents2catedata[$contents2row]["cate_id"];?>')" />
										</td>
								</tr>
								<?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報２カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
						</table>
    				<table width="100%" border="0">
								<tr>
										<td width="80%">&nbsp;</td>
										<td width="20%">&nbsp;</td>
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
