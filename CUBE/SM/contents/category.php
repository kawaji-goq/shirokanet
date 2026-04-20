<?php 
$ad_contents=new Admin_Info1($dbobj);
$contentssetting=$ad_contents->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_contents->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {
for($i=0;$_REQUEST["cate_id"][$i]!=NULL;$i++) {
	$dbobj->Query("update info1_cate set cate_name = '".$_REQUEST["cate_name"][$i]."',turn=".$_REQUEST["turn"][$i].",view_chk=".$_REQUEST["view_chk"][$i]." where cate_id=".$_REQUEST["cate_id"][$i]);
}

	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=contents_category&pmode=delete&contents_id=<?php echo $_REQUEST["contents_id"];?>&delid="+id;
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
											<p><strong>　コンテンツ　&gt;&gt;　カテゴリ一覧</strong></p>
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
										<th width="74" align="center" bgcolor="#ECECEC">表示順</th>
										<th width="413" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
										<th width="89" align="left" bgcolor="#ECECEC">公開</th>
										<th align="left" bgcolor="#ECECEC">
												  <div align="center">編集</div>
										</th>
								  <th align="left" bgcolor="#ECECEC">
								      <div align="center">削除</div>
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
$contentscatedata=$ad_contents->GetCateList($_GET["contents_id"],$lim,$setnum,$orderby);
for($contentsrow=0;$contentscatedata[$contentsrow];$contentsrow++){ 
$contentscate=new Ary_Viewer($contentscatedata[$contentsrow]);
?>
								<tr>
										<td width="74" align="center" valign="top" bgcolor="#FFFFFF">
												<input name="turn[<?php echo $contentsrow; ?>]" type="text" id="turn[<?php echo $contentsrow; ?>]" value="<?php $contentscate->Moji("turn"); ?>" size="6" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<input name="cate_name[<?php echo $contentsrow; ?>]" type="text" id="cate_name[<?php echo $contentsrow; ?>]" value="<?php $contentscate->Moji("cate_name"); ?>" size="40">
												<input name="cate_id[<?php echo $contentsrow; ?>]" type="hidden" id="cate_id[<?php echo $contentsrow; ?>]" value="<?php echo $contentscatedata[$contentsrow]["cate_id"];?>" />
										</td>
										<td align="left" valign="top" bgcolor="#FFFFFF">
												<select name="view_chk[<?php echo $contentsrow; ?>]">
														<option value="1"<?php if($contentscatedata[$contentsrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
														<option value="0"<?php if($contentscatedata[$contentsrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
												</select>
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="編集" onclick="location.href='?PID=contents_details&contents_id=<?php echo $contentscatedata[$contentsrow]["parents_id"];?>&cate_id=<?php echo $contentscatedata[$contentsrow]["cate_id"];?>'" />
										</td>
										<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="削除" onclick="delchk('<?php $contentscate->LMoji("cate_name"); ?>','<?php echo $contentscatedata[$contentsrow]["cate_id"];?>')" />
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
    				<table width="100%" border="0" cellpadding="2" cellspacing="1">
								<tr>
										<td width="80%">&nbsp;</td>
										<td width="20%">&nbsp;</td>
								</tr>
								<tr>
										<td align="left">
												<input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
												<input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=contents_add&cate_id=<?php echo $_REQUEST["contents_id"];?>'" />
												<input name="bbtm_regist" type="button" id="bbtm_regist" value="コンテンツ一覧" onclick="location.replace('?PID=contents')" />
										</td>
										<td>&nbsp;</td>
								</tr>
						</table>
						</form>
    		</td>
  </tr>
</table>
