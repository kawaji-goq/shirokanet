<?php 
$ad_qanda=new Admin_QA($dbobj);
$qandasetting=$ad_qanda->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_qanda->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_qanda->UpdateCateList($_POST);
	
}

?>
<script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=qanda_category&pmode=delete&delid="+id;
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
											<p><strong>　<?php echo $menudata[8]["data_name"]; ?>　&gt;&gt;　カテゴリ一覧</strong></p>
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
            <th width="50" align="center" bgcolor="#ECECEC">表示順</th>
            <th width="150" align="left" bgcolor="#ECECEC"><strong>ｶﾃｺﾞﾘ名</strong></th>
            <th align="left" bgcolor="#ECECEC"><?php if($qandasetting["cate_comm_chk"]==1) {?><strong>内容</strong><?php }
		  ?></th>
            <th width="100" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=qanda_add'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$qandacatedata=$ad_qanda->GetCateList($_GET["qanda_id"],$lim,$setnum,$orderby);
for($qandarow=0;$qandacatedata[$qandarow];$qandarow++){ 
$qandacate=new Ary_Viewer($qandacatedata[$qandarow]);
?><tr>
            <td width="50" align="center" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $qandarow; ?>]" type="text" id="turn[<?php echo $qandarow; ?>]" value="<?php $qandacate->Moji("turn"); ?>" size="6" />
            </td>
            <td width="150" align="left" valign="top" bgcolor="#FFFFFF"><?php $qandacate->Moji("cate_name"); ?>
            <input name="cate_id[<?php echo $qandarow; ?>]" type="hidden" id="cate_id[<?php echo $qandarow; ?>]" value="<?php echo $qandacatedata[$qandarow]["cate_id"];?>" />
</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
               <?php if($qandasetting["cate_comm_chk"]==1) {?><?php $qandacate->Moji("cate_comm"); ?><?php
			}?>
            </td>
			
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $qandarow; ?>]">
                <option value="1"<?php if($qandacatedata[$qandarow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($qandacatedata[$qandarow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=qanda_up&cate_id=<?php echo $qandacatedata[$qandarow]["cate_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $qandacate->Moji("cate_name"); ?>','<?php echo $qandacatedata[$qandarow]["cate_id"];?>')" />
            </td>
          </tr><?php 
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
