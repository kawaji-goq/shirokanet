<?php
$ad_blog=new Admin_Blog($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_blog->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_upata"]=="更新する") {

	$ad_blog->UpdateDataList($_POST);
	
}
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=blog_list&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
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
											<p><strong>　ブログ &gt;&gt;　データ一覧</strong></p>
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
        	<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
									<td valign="top">
											<table width="700" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
													<tr>
													    <th width="100" align="left" bgcolor="#ECECEC">登録日</th>
															<th width="393" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
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
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$blogdata=$ad_blog->GetDataList($_GET["cate_id"],$lim,$setnum,"rdate desc");
for($blogrow=0;$blogdata[$blogrow];$blogrow++){ 
$blogddata=new Ary_Viewer($blogdata[$blogrow]);
?>
													<tr>
													    <td width="100" align="left" valign="top" bgcolor="#FFFFFF"><a href="?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>">
													        <?php $blogddata->Moji("rdate"); ?>
													    </a></td>
															<td align="left" valign="top" bgcolor="#FFFFFF">
																	<input name="turn[<?php echo $blogrow; ?>]" type="hidden" id="turn[<?php echo $blogrow; ?>]" value="<?php $blogddata->Moji("turn"); ?>" size="6" />
															
																	<a href="?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>"><?php $blogddata->Moji("title"); ?>
																	</a>
																	<input name="blog_id[<?php echo $blogrow; ?>]" type="hidden" id="blog_id[<?php echo $blogrow; ?>]" value="<?php echo $blogdata[$blogrow]["blog_id"];?>" />
															</td>
															<td width="89" align="left" valign="top" bgcolor="#FFFFFF">
																	<select name="view_chk[<?php echo $blogrow; ?>]">
																			<option value="1"<?php if($blogdata[$blogrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
																			<option value="0"<?php if($blogdata[$blogrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
																	</select>
															</td>
															<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
																	<input type="button" name="Submit" value="編集" onclick="location.replace('?PID=blog_dup&blog_id=<?php echo $blogdata[$blogrow]["blog_id"];?>')" />
															</td>
															<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
																	<input type="button" name="Submit" value="削除" onclick="delchk('<?php echo trim($blogdata[$blogrow]["title"]); ?>','<?php echo $blogdata[$blogrow]["blog_id"];?>')" />
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
															<td width="80%">&nbsp;</td>
															<td width="20%">&nbsp;</td>
													</tr>
													<tr>
															<td align="left">
																	<input name="btm_upata" type="submit" id="btm_upata" value="更新する" />
																	<input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=blog_dadd&cate_id=<?php echo $_GET["cate_id"];?>'" />
																	<input name="bbtm_regist" type="button" id="bbtm_regist" value="カテゴリ一覧" onclick="location.replace('?PID=blog')" />
															</td>
															<td>&nbsp;</td>
													</tr>
											</table>
									</td>
							</tr>
					</table>
        	</form>
    </td>
  </tr>
</table>
