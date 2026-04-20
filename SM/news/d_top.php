<?php
$ad_news=new Admin_News($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_news->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_upata"]=="更新する") {

	$ad_news->UpdateDataList($_POST);
	
}
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=news&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
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
											<p><strong>　<?php echo $menudata[1]["data_name"]; ?> &gt;&gt;　データ一覧</strong></p>
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
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="50" align="left" bgcolor="#ECECEC">&nbsp;</th>
            <th width="180" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <th width="243" align="left" bgcolor="#ECECEC"><?php if($newssetting["data_comm_chk"]==1) {?><strong>名前</strong><?php }?></th>
            <th width="100" align="left" bgcolor="#ECECEC">
            		<div align="left">公開</div>
            </th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=news_add&cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$newsdata=$ad_news->GetDataList(0,$lim,$setnum,$orderby);
for($newsrow=0;$newsdata[$newsrow];$newsrow++){ 
$newsddata=new Ary_Viewer($newsdata[$newsrow]);
?>
          <tr>
            <td width="50" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $newsrow; ?>]" type="text" id="turn[<?php echo $newsrow; ?>]" value="<?php $newsddata->Moji("turn"); ?>" size="6" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php $newsddata->Moji("title"); ?>
              <input name="news_id[<?php echo $newsrow; ?>]" type="hidden" id="news_id[<?php echo $newsrow; ?>]" value="<?php echo $newsdata[$newsrow]["news_id"];?>" />
            </td>
               <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($newssetting["cate_comm_chk"]==1) {?> <?php $newsddata->Moji("data_name"); ?><?php
			}
			?>
            </td>
         <td width="100" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $newsrow; ?>]">
                <option value="1"<?php if($newsdata[$newsrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($newsdata[$newsrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=news_up&news_id=<?php echo $newsdata[$newsrow]["news_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $newsddata->LMoji("title"); ?>','<?php echo $newsdata[$newsrow]["news_id"];?>')" />
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left">
              <input name="btm_upata" type="submit" id="btm_upata" value="更新する" />
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
