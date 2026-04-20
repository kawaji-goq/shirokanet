<?php 
$ad_info2=new Admin_Info2($dbobj);
$info2setting=$ad_info2->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_info2->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_info2->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=info2_category&pmode=delete&delid="+id;
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
$info2catedata=$ad_info2->GetCateList($_GET["info2_id"],$lim,$setnum,$orderby);
for($info2row=0;$info2catedata[$info2row];$info2row++){ 
$info2cate=new Ary_Viewer($info2catedata[$info2row]);
?>
        <tr>
          <td align="left" valign="top" bgcolor="#FFFFFF"> <a href="index.php?PID=info2_details&cate_id=<?php echo $info2catedata[$info2row]["cate_id"] ?>">
            <?php $info2cate->Moji("cate_name"); ?>
            </a>
              <input name="cate_id[<?php echo $info2row; ?>]" type="hidden" id="cate_id[<?php echo $info2row; ?>]" value="<?php echo $info2catedata[$info2row]["cate_id"];?>" />
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
										<th width="249" align="left" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
										<th width="89" align="left" bgcolor="#ECECEC">公開</th>
										<th colspan="2" align="left" bgcolor="#ECECEC">
												<div align="center">
														<input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=info2_add'" />
												</div>
										</th>
								</tr>
								<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info2catedata=$ad_info2->GetCateList($_GET["info2_id"],$lim,$setnum,$orderby);
for($info2row=0;$info2catedata[$info2row];$info2row++){ 
$info2cate=new Ary_Viewer($info2catedata[$info2row]);
?>
								<tr>
										<td width="42" align="center" valign="top" bgcolor="#FFFFFF">
												<input name="turn[<?php echo $info2row; ?>]" type="text" id="turn[<?php echo $info2row; ?>]" value="<?php $info2cate->Moji("turn"); ?>" size="6" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<?php $info2cate->Moji("cate_name"); ?>
												<input name="cate_id[<?php echo $info2row; ?>]" type="hidden" id="cate_id[<?php echo $info2row; ?>]" value="<?php echo $info2catedata[$info2row]["cate_id"];?>" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<select name="view_chk[<?php echo $info2row; ?>]">
														<option value="1"<?php if($info2catedata[$info2row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
														<option value="0"<?php if($info2catedata[$info2row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
												</select>
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="修正" onclick="location.replace('?PID=info2_up&amp;cate_id=<?php echo $info2catedata[$info2row]["cate_id"];?>')" />
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="削除" onclick="delchk('<?php $info2cate->Moji("cate_name"); ?>','<?php echo $info2catedata[$info2row]["cate_id"];?>')" />
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
