<?php
$ad_qanda=new Admin_QA($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_qanda->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_qanda->UpdateDataList($_POST);
	
}

$qandacatedata=$ad_qanda->GetCateList(0,$lim,$setnum,$orderby);
$qandacdata=$ad_qanda->ChangeLay($qandacatedata,4);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=al_qa_details&pmode=delete&cid=<?php echo $_REQUEST["cid"];?>&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="900" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
								<td colspan="3" valign="top">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　カテゴリ一覧</strong></p>
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
$qandadata=$dbobj->GetList("select * from qanda_cate where parents_id = ".$_GET["cid"]." order by turn");
for($qandarow=0;$qandadata[$qandarow];$qandarow++){ 
?>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF"> <a href="index.php?PID=al_qa_details&cid=<?php echo $_REQUEST["cid"]."&cate_id=".$qandadata[$qandarow]["cate_id"] ?>">
																								<?php echo $qandadata[$qandarow]["cate_name"]; ?>
																								</a>
																												<input name="cate_id[<?php echo $qandarow; ?>]" type="hidden" id="cate_id[<?php echo $qandarow; ?>]" value="<?php echo $qandadata[$qandarow]["cate_id"];?>" />
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
								<td valign="top">
												<form id="form1" name="form1" method="post" action="">
																<table width="690" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																				<tr>
																								<th width="44" align="left" bgcolor="#ECECEC">&nbsp;</th>
																								<th width="437" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																								<th width="89" align="left" bgcolor="#ECECEC">
																												<div align="center">公開</div>
																								</th>
																								<th colspan="2" align="left" bgcolor="#ECECEC">
																												<div align="center">
																																<input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=al_qa_d_add&cid=<?php echo $_GET["cid"];?>&cate_id=<?php echo $_REQUEST["cate_id"];?>'" />
																												</div>
																								</th>
																				</tr>
																				<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$qandadata=$dbobj->GetList("select * from qanda_data where cate_id = ".$_REQUEST["cate_id"]." order by turn");
for($qandarow=0;$qandadata[$qandarow];$qandarow++){ 
$qandaddata=new Ary_Viewer($qandadata[$qandarow]);
?>
																				<tr>
																								<td width="44" align="center" bgcolor="#FFFFFF">
																												<div align="center">
																																<input name="turn[<?php echo $qandarow; ?>]" type="text" id="turn[<?php echo $qandarow; ?>]" value="<?php $qandaddata->Moji("turn"); ?>" size="6" />
																												</div>
																								</td>
																								<td align="left" bgcolor="#FFFFFF">
																												<?php $qandaddata->Moji("data_name"); ?>
																												<input name="data_id[<?php echo $qandarow; ?>]" type="hidden" id="data_id[<?php echo $qandarow; ?>]" value="<?php echo $qandadata[$qandarow]["data_id"];?>" />
																								</td>
																								<td width="89" align="left" bgcolor="#FFFFFF">
																												<select name="view_chk[<?php echo $qandarow; ?>]">
																																<option value="1"<?php if($qandadata[$qandarow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
																																<option value="0"<?php if($qandadata[$qandarow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
																												</select>
																								</td>
																								<td width="42" align="left" bgcolor="#FFFFFF">
																												<input type="button" name="Submit" value="修正" onclick="location.replace('?PID=al_qa_d_up&cid=<?php echo $_REQUEST["cid"];?>&cate_id=<?php echo $_REQUEST["cate_id"];?>&data_id=<?php echo $qandadata[$qandarow]["data_id"];?>')" />
																								</td>
																								<td width="42" align="left" bgcolor="#FFFFFF">
																												<input type="button" name="Submit" value="削除" onclick="delchk('<?php $qandaddata->Moji("data_name"); ?>','<?php echo $qandadata[$qandarow]["data_id"];?>')" />
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
																</table>
												</form>
								</td>
				</tr>
</table>
