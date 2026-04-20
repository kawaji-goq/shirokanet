<?php 
$ad_banner=new Admin_Banner($dbobj);
$bannersetting=$ad_banner->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_banner->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_banner->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=banner_category&pmode=delete&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
  <tr>
    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
    <td width="412" align="left">
      <p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
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
$bannercatedata=$ad_banner->GetCateList($_GET["banner_id"],$lim,$setnum,$orderby);
for($bannerrow=0;$bannercatedata[$bannerrow];$bannerrow++){ 
$bannercate=new Ary_Viewer($bannercatedata[$bannerrow]);
?>
        <tr>
          <td colspan="2" align="left" valign="top"> <a href='index.php?PID=banner&amp;cate_id=<?php echo $bannercatedata[$bannerrow]["cate_id"]; ?>'>
            <?php $bannercate->Moji("cate_name"); ?>
            </a>
              <input name="cate_id[<?php echo $bannerrow; ?>]" type="hidden" id="cate_id[<?php echo $bannerrow; ?>]" value="<?php echo $bannercatedata[$bannerrow]["cate_id"];?>" />
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
              <?php if($bannersetting["cate_comm_chk"]==1) {?>
              <strong>内容</strong>
              <?php }
		  ?>
            </th>
            <th width="15%" align="left">公開</th>
            <th colspan="2" align="left">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=banner_add'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$bannercatedata=$ad_banner->GetCateList($_GET["banner_id"],$lim,$setnum,$orderby);
for($bannerrow=0;$bannercatedata[$bannerrow];$bannerrow++){ 
$bannercate=new Ary_Viewer($bannercatedata[$bannerrow]);
?>
          <tr>
            <td width="9%" align="center" valign="top">
              <input name="turn[<?php echo $bannerrow; ?>]" type="text" id="turn[<?php echo $bannerrow; ?>]" value="<?php $bannercate->Moji("turn"); ?>" size="6" />
            </td>
            <td width="27%" align="left" valign="top">
              <?php $bannercate->Moji("cate_name"); ?>
              <input name="cate_id[<?php echo $bannerrow; ?>]" type="hidden" id="cate_id[<?php echo $bannerrow; ?>]" value="<?php echo $bannercatedata[$bannerrow]["cate_id"];?>" />
            </td>
            <td align="left" valign="top">
              <?php if($bannersetting["cate_comm_chk"]==1) {?>
              <?php $bannercate->Moji("cate_comm"); ?>
              <?php
			}?>
            </td>
            <td align="left" valign="top">
              <select name="view_chk[<?php echo $bannerrow; ?>]">
                <option value="1"<?php if($bannercatedata[$bannerrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($bannercatedata[$bannerrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="7%" align="left" valign="top">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=banner_up&amp;cate_id=<?php echo $bannercatedata[$bannerrow]["cate_id"];?>')" />
            </td>
            <td align="left" valign="top">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $bannercate->Moji("cate_name"); ?>','<?php echo $bannercatedata[$bannerrow]["cate_id"];?>')" />
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
