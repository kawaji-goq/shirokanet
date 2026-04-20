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
  				<table width="100%" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="452" align="left">
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="top">
      <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
        
        <tr>
          <th width="62%" align="left" valign="top"><strong>ｶﾃｺﾞﾘ名</strong></th>
          <th width="38%" align="left" valign="top">&nbsp;</th>
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
          <td colspan="2" align="left" valign="top"> <a href='index.php?PID=blog_details&amp;cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"]; ?>'>
            <?php $blogcate->Moji("cate_name"); ?>
            </a>
              <input name="cate_id[<?php echo $blogrow; ?>]" type="hidden" id="cate_id[<?php echo $blogrow; ?>]" value="<?php echo $blogcatedata[$blogrow]["cate_id"];?>" />
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
    </td>
    <form id="form1" name="form1" method="post" action="">
      <td valign="top">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="2">
          <tr>
            <th align="center">表示順</th>
            <th width="25%" align="left"><strong>ｶﾃｺﾞﾘ名</strong></th>
            <th width="25%" align="left">
              <?php if($blogsetting["cate_comm_chk"]==1) {?>
              <strong>内容</strong>
              <?php }
		  ?>
            </th>
            <th width="15%" align="left">公開</th>
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
            <td width="9%" align="center" valign="top">
              <input name="turn[<?php echo $blogrow; ?>]" type="text" id="turn[<?php echo $blogrow; ?>]" value="<?php $blogcate->Moji("turn"); ?>" size="6" />
            </td>
            <td width="27%" align="left" valign="top">
              <?php $blogcate->Moji("cate_name"); ?>
              <input name="cate_id[<?php echo $blogrow; ?>]" type="hidden" id="cate_id[<?php echo $blogrow; ?>]" value="<?php echo $blogcatedata[$blogrow]["cate_id"];?>" />
            </td>
            <td align="left" valign="top">
              <?php if($blogsetting["cate_comm_chk"]==1) {?>
              <?php $blogcate->Moji("cate_comm"); ?>
              <?php
			}?>
            </td>
            <td align="left" valign="top">
              <select name="view_chk[<?php echo $blogrow; ?>]">
                <option value="1"<?php if($blogcatedata[$blogrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($blogcatedata[$blogrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="7%" align="left" valign="top">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=blog_up&amp;cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" />
            </td>
            <td align="left" valign="top">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php echo trim($blogcatedata[$blogrow]["cate_name"]); ?>','<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" />
            </td>
          </tr>
          <tr>
            <td colspan="6" align="center" valign="top" class="line">&nbsp;</td>
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
      </td>
    </form>
  </tr>
</table>
