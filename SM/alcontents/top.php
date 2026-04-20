<?php 
$ad_contents=new Admin_Info1($dbobj);
$contentssetting=$ad_contents->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

//	$ad_contents->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

//	$ad_contents->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=contents&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="710" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td colspan="2" valign="top">
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　コンテンツ　&gt;&gt;　コンテンツ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td width="10" valign="top">&nbsp;</td>
    <td width="500" valign="top">
    		<form id="form1" name="form1" method="post" action="">
    				<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<th width="494" align="left" bgcolor="#ECECEC"><strong>コンテンツ名</strong></th>
										<th width="89" align="left" bgcolor="#ECECEC">公開</th>
										<th colspan="2" align="left" bgcolor="#ECECEC">
												<div align="center"></div>
										</th>
								</tr>
								<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
if($_GET["contents_id"]==NULL) {
	$_GET["contents_id"]=0;
}
$contentscatedata=$dbobj->GetList("select * from menu_data where data_code ='contents' order by turn");
for($contentsrow=0;$contentscatedata[$contentsrow];$contentsrow++){ 
$contentscate=new Ary_Viewer($contentscatedata[$contentsrow]);
?>
								<tr>
										<td align="left" valign="top" bgcolor="#FFFFFF"><?php $contentscate->Moji("data_name"); ?>
												<input name="cate_id[<?php echo $contentsrow; ?>]" type="hidden" id="cate_id[<?php echo $contentsrow; ?>]" value="<?php echo $contentscatedata[$contentsrow]["data_id"];?>" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<select name="view_chk[<?php echo $contentsrow; ?>]">
														<option value="1"<?php if($contentscatedata[$contentsrow]["use_chk"]==1) {echo " selected";}?>>公開する</option>
														<option value="0"<?php if($contentscatedata[$contentsrow]["use_chk"]==0) {echo " selected";}?>>公開しない</option>
												</select>
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="編集" onclick="location.replace('?PID=contents_category&contents_id=<?php echo $contentscatedata[$contentsrow]["data_comm"];?>')" />
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="削除" onclick="delchk('<?php $contentscate->LMoji("data_name"); ?>','<?php echo $contentscatedata[$contentsrow]["data_comm"];?>')" />
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
												<input name="bbtm_regist" type="button" id="bbtm_regist" value="ページ設定" onclick="location.replace('?PID=pagesetting')" />
										</td>
										<td>&nbsp;</td>
								</tr>
						</table>
						</form>
    		</td>
  </tr>
</table>
