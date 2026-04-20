<?php
$ad_banner=new Admin_Banner($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_banner->DeleteOneData($_GET["delid"]);
	
}
if($_GET["pmode"]=="datacopy"&&$_GET["copyid"]!=NULL) {

	$ad_banner->CopyData($_GET["copyid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_banner->UpdateDataList($_POST);
	
}
$bannersetting=$ad_banner->LoadSetting();
$bannercatedata=$ad_banner->GetCateList(0,$lim,$setnum,$orderby);
$bannercdata=$ad_banner->ChangeLay($bannercatedata,4);

?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=banner&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
function datacopy(name,id) {
	var res=confirm(name+"を複製しますか？");
	if(res) {
		location.href="?PID=banner&pmode=datacopy&cate_id=<?php echo $_GET["cate_id"];?>&copyid="+id;
	}	
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
  <tr>
    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
    <td width="412" align="left">
      <p><strong>　バナー　&gt;&gt;　データ一覧</strong></p>
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
      <table width="100%" border="0" align="center">

        <tr>
          <th height="20" align="left"><strong>ｶﾃｺﾞﾘ名</strong></th>
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
?>        <tr>
          <td align="left" valign="top">
            <a href='index.php?PID=banner&cate_id=<?php echo $bannercatedata[$bannerrow]["cate_id"]; ?>'><?php $bannercate->Moji("cate_name"); ?></a>
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
      <?php
	if($_GET["cate_id"]!=NULL) {
	?>
        <table width="500" border="0" align="center" cellpadding="2" cellspacing="1">
          <tr>
          		<th width="48" align="left">表示順</th>
            <th width="253" align="left"><strong>タイトル</strong></th>
            <th width="89" align="left">
            		<div align="center">状態</div>
            </th>
            <th colspan="2" align="left">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=banner_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$bannerdata=$ad_banner->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($bannerrow=0;$bannerdata[$bannerrow];$bannerrow++){ 
$bannerddata=new Ary_Viewer($bannerdata[$bannerrow]);
?>
          <tr>
          		<td width="48" align="left" valign="top">
              <input name="turn[<?php echo $bannerrow; ?>]" type="text" id="turn[<?php echo $bannerrow; ?>]" value="<?php echo $bannerdata[$bannerrow]["turn"]; ?>" size="6" />
            </td>
            <td align="left" valign="top">
              	<a href="?PID=banner_up&data_id=<?php echo $bannerdata[$bannerrow]["data_id"];?>">
              <?php $bannerddata->Moji("data_name"); ?>
              <input name="data_id[<?php echo $bannerrow; ?>]" type="hidden" id="data_id[<?php echo $bannerrow; ?>]" value="<?php echo $bannerdata[$bannerrow]["data_id"];?>" />
            		</a></td>
            <td width="89" align="left" valign="top">
              <select name="view_chk[<?php echo $bannerrow; ?>]">
                <option value="1"<?php if($bannerdata[$bannerrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($bannerdata[$bannerrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
               <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($bannerdata[$bannerrow]["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?>  </select>
            </td>
            <td width="42" align="left" valign="top">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=banner_up&amp;data_id=<?php echo $bannerdata[$bannerrow]["data_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php echo str_replace("\r\n","",$bannerdata[$bannerrow]["data_name"]); ?>','<?php echo $bannerdata[$bannerrow]["data_id"];?>')" />
            </td>
          </tr>
          <tr>
            <td colspan="5" align="left" valign="top" class="line"></td>
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
      <?php
	  }
	  ?>
</td></form>
  </tr>
</table>
