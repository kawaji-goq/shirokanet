<?php 
$ad_info1=new Admin_Info1($dbobj);
$info1setting=$ad_info1->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_info1->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_info1->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=info1_category&pmode=delete&delid="+id;
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
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td width="10" valign="top">&nbsp;</td>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="top">
      <table width="200" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        
        <tr>
          <th align="left" valign="top" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
          </tr>
        <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info1catedata=$ad_info1->GetCateList($_GET["info1_id"],$lim,$setnum,$orderby);
for($info1row=0;$info1catedata[$info1row];$info1row++){ 
$info1cate=new Ary_Viewer($info1catedata[$info1row]);
?>
        <tr>
          <td align="left" valign="top" bgcolor="#FFFFFF"><?php
					if($info1catedata[$info1row][0]==5&&str_replace("www.","",$_SERVER['HTTP_HOST'])=="atom-net.jp"){
					?>
										<a href='index.php?PID=plist&amp;cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'>
												<?php $info1cate->Moji("cate_name"); ?>
												</a>
										<?php
					}
					else{
						?>
										<a href='index.php?PID=info1_details&amp;cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'>
												<?php $info1cate->Moji("cate_name"); ?>
												</a>
										<?php
					}
					?>
<input name="cate_id[<?php echo $info1row; ?>]" type="hidden" id="cate_id[<?php echo $info1row; ?>]" value="<?php echo $info1catedata[$info1row]["cate_id"];?>" />
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
    <td valign="top">&nbsp;</td>
    <form id="form1" name="form1" method="post" action="">
      <td valign="top">
        <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="center" bgcolor="#ECECEC">表示順</th>
            <th width="95" align="left" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
            <th width="122" align="left" bgcolor="#ECECEC">
              <?php if($info1setting["cate_comm_chk"]==1) {?>
              <strong>内容</strong>
              <?php }
		  ?>
            </th>
            <th width="89" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=info1_add'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info1catedata=$ad_info1->GetCateList($_GET["info1_id"],$lim,$setnum,$orderby);
for($info1row=0;$info1catedata[$info1row];$info1row++){ 
$info1cate=new Ary_Viewer($info1catedata[$info1row]);
?>
          <tr>
            <td width="30" align="center" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $info1row; ?>]" type="text" id="turn[<?php echo $info1row; ?>]" value="<?php $info1cate->Moji("turn"); ?>" size="6" />
            </td>
            <td width="95" align="left" valign="top" bgcolor="#FFFFFF">
              <?php $info1cate->Moji("cate_name"); ?>
              <input name="cate_id[<?php echo $info1row; ?>]" type="hidden" id="cate_id[<?php echo $info1row; ?>]" value="<?php echo $info1catedata[$info1row]["cate_id"];?>" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($info1setting["cate_comm_chk"]==1) {?>
              <?php $info1cate->Moji("cate_comm"); ?>
              <?php
			}?>
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $info1row; ?>]">
                <option value="1"<?php if($info1catedata[$info1row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($info1catedata[$info1row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=info1_up&cate_id=<?php echo $info1catedata[$info1row]["cate_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
						<?php
						if($info1catedata[$info1row]["cate_id"]!=5&&str_replace("www.","",$_SERVER['HTTP_HOST'])=="atom-net.jp"){
						?>
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $info1cate->Moji("cate_name"); ?>','<?php echo $info1catedata[$info1row]["cate_id"];?>')" />
							<?php
}
?>
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
