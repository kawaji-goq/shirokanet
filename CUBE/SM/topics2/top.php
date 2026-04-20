<?php 
$ad_blog=new Admin_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_blog->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_blog->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=blog&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td colspan="2" valign="top">
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
    		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
						
						<tr>
								<th height="20" align="left"><strong>ｶﾃｺﾞﾘ名</strong></th>
						</tr>
						<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$blogcatedata=$ad_blog->GetCateList($_GET["blog_id"],$lim,$setnum,$orderby);
for($blogrow=0;$blogcatedata[$blogrow];$blogrow++){ 
$blogcate=new Ary_Viewer($blogcatedata[$blogrow]);
?>
						<tr>
								<td align="left" valign="top"> <a href="index.php?PID=blog_list&cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"] ?>">
										<?php $blogcate->Moji("cate_name"); ?>
										</a>
												<input name="cate_id[<?php echo $blogrow; ?>]" type="hidden" id="cate_id[<?php echo $blogrow; ?>]" value="<?php echo $blogcatedata[$blogrow]["cate_id"];?>" />
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
    <td valign="top">
      <form id="form1" name="form1" method="post" action="">
        <table width="500" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr>
            <th width="49" align="center">表示順</th>
            <th width="240" align="left"><strong>ｶﾃｺﾞﾘ名</strong></th>
            <th width="89" align="left">公開</th>
            <th colspan="2" align="left">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=blog_add'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$blogcatedata=$ad_blog->GetCateList($_GET["blog_id"],$lim,$setnum,$orderby);
for($blogrow=0;$blogcatedata[$blogrow];$blogrow++){ 
$blogcate=new Ary_Viewer($blogcatedata[$blogrow]);
?>
          <tr>
            <td align="center" valign="top">
              <input name="turn[<?php echo $blogrow; ?>]" type="text" id="turn[<?php echo $blogrow; ?>]" value="<?php $blogcate->Moji("turn"); ?>" size="6" />
            </td>
            <td height="20" align="left" valign="top">
              <a href="?PID=blog_up&cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"];?>"><?php $blogcate->Moji("cate_name"); ?></a>
              <input name="cate_id[<?php echo $blogrow; ?>]" type="hidden" id="cate_id[<?php echo $blogrow; ?>]" value="<?php echo $blogcatedata[$blogrow]["cate_id"];?>" />
            </td>
            <td align="left" valign="top">
              <select name="view_chk[<?php echo $blogrow; ?>]">
                <option value="1"<?php if($blogcatedata[$blogrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($blogcatedata[$blogrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=blog_up&amp;cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" />
            </td>
            <td width="44" align="left" valign="top">
            		<input type="button" name="Submit" value="削除" onclick="delchk('<?php  echo $blogcatedata[$blogrow]["cate_name"]; ?>','<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" /></td>
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
