<?php
$ad_link=new Ad_Links($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_link->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_link->UpdateDataList($_POST);
	
}
$lim="";
$linkcatedata=$ad_link->GetCateList(0,$lim,$setnum,$orderby);
if($_GET["cate_id"]==NULL) {
$_GET["cate_id"]=1;
}
$linkcatedat=$dbobj->GetData("select * from link_cate where cate_id =".$_GET["cate_id"]);

$linkcdata=$ad_link->ChangeLay($linkcatedata,3);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=link_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if($_SERVER['HTTP_HOST']==""){
?><div>
<table width="800" border="0" cellpadding="1" cellspacing="1">
				<tr>
								<td colspan="2" align="left">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　リンク管理　&gt;&gt;　
																																				<?php
											 echo $linkcatedat["cate_name"];
											
											?>
																												　
																												リンクデータ一覧</strong></p>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
				<tr>
								<td colspan="2" align="left">&nbsp;</td>
				</tr>
				<tr>
								<td width="11" align="left" valign="top">&nbsp;</td>
								<td align="left" valign="top">
												<form id="form1" name="form1" method="post" action="">
																<table width="100%" border="0">
																				<tr>
																								<td>
																												<table width="600" border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																																<tr>
																																				<th width="40" align="left" bgcolor="#ECECEC">&nbsp;</th>
																																				<th width="349" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
																																				<th width="89" align="left" bgcolor="#ECECEC">公開</th>
																																				<th colspan="2" align="left" bgcolor="#ECECEC">
																																								<div align="center"></div>
																																				</th>
																																</tr>
																																<?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkdata=$ad_link->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkdata[$linkrow];$linkrow++){ 
$linkddata=new Ary_Viewer($linkdata[$linkrow]);
?>
																																<tr>
																																				<td width="40" align="left" valign="top" bgcolor="#FFFFFF">
																																								<input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkddata->Moji("turn"); ?>" size="6" />
																																				</td>
																																				<td align="left" valign="top" bgcolor="#FFFFFF">
																																								<?php $linkddata->Moji("data_name"); ?>
																																								<input name="data_id[<?php echo $linkrow; ?>]" type="hidden" id="data_id[<?php echo $linkrow; ?>]" value="<?php echo $linkdata[$linkrow]["data_id"];?>" />
																																				</td>
																																				<td width="89" align="left" valign="top" bgcolor="#FFFFFF">
																																								<select name="view_chk[<?php echo $linkrow; ?>]">
																																												<option value="1"<?php if($linkdata[$linkrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
																																												<option value="0"<?php if($linkdata[$linkrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
																																								</select>
																																				</td>
																																				<td width="42" align="left" valign="top" bgcolor="#FFFFFF">
																																								<input type="button" name="Submit" value="修正" onclick="location.replace('?PID=link_d_up&amp;data_id=<?php echo $linkdata[$linkrow]["data_id"];?>')" />
																																				</td>
																																				<td width="44" align="left" valign="top" bgcolor="#FFFFFF">
																																								<input type="button" name="Submit" value="削除" onclick="delchk('<?php $linkddata->Moji("data_name"); ?>','<?php echo $linkdata[$linkrow]["data_id"];?>')" />
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
																								</td>
																				</tr>
																				<tr>
																								<td>&nbsp;</td>
																				</tr>
																				<tr>
																								<td align="left">
																												<input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
																												<input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=link_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
																								</td>
																				</tr>
																</table>
												</form>
								</td>
				</tr>
</table>
<br></div>
<?php
}
else {
?>
<div>
<table width="800" border="0" align="left" cellpadding="1" cellspacing="1">
  <tr>
  		<td colspan="3" align="left">
  				<table width="700" border="0" align="left">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　リンク管理　&gt;&gt;　<?php
											 echo $linkcatedat["cate_name"];
											
											?>　リンクデータ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td colspan="3" align="left">&nbsp;</td>
    </tr>
  <tr>
    <td width="200" align="left" valign="top">
      <table width="200" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        
        <tr>
          <th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
          </tr>
        <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkcatedata=$ad_link->GetCateList($_GET["link_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkcatedata[$linkrow];$linkrow++){ 
$linkcate=new Ary_Viewer($linkcatedata[$linkrow]);
?>
        <tr>
          <td align="left" valign="top" bgcolor="#FFFFFF"> ・<a href="?PID=link_details&cate_id=<?php echo $linkcatedata[$linkrow]["cate_id"];?>"><?php $linkcate->Moji("cate_name"); ?>
            </a>
              <input name="cate_id[<?php echo $linkrow; ?>]" type="hidden" id="cate_id[<?php echo $linkrow; ?>]" value="<?php echo $linkcatedata[$linkrow]["cate_id"];?>" />
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
        <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF"><a href="?PID=link_category">■カテゴリを編集する</a></td>
        </tr>
      </table>
    </td>
    <td width="11" align="left" valign="top">&nbsp;</td>
    <td width="579" align="left" valign="top">
      <form id="form1" name="form1" method="post" action="">
          <table width="100%" border="0">
          <tr>
              <td>
                  <table width="500" border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                      <tr>
                          <th width="30" align="left" bgcolor="#ECECEC">&nbsp;</th>
                          <th width="258" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                          <th width="89" align="left" bgcolor="#ECECEC">公開</th>
                          <th colspan="2" align="left" bgcolor="#ECECEC">
                              <div align="center"></div>
                          </th>
                      </tr>
                      <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkdata=$ad_link->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkdata[$linkrow];$linkrow++){ 
$linkddata=new Ary_Viewer($linkdata[$linkrow]);
?>
                      <tr>
                          <td width="30" align="left" valign="top" bgcolor="#FFFFFF">
                              <input name="turn[<?php echo $linkrow; ?>]" type="text" id="turn[<?php echo $linkrow; ?>]" value="<?php $linkddata->Moji("turn"); ?>" size="6" />
                          </td>
                          <td align="left" valign="top" bgcolor="#FFFFFF">
                              <?php $linkddata->Moji("data_name"); ?>
                              <input name="data_id[<?php echo $linkrow; ?>]" type="hidden" id="data_id[<?php echo $linkrow; ?>]" value="<?php echo $linkdata[$linkrow]["data_id"];?>" />
                          </td>
                          <td width="89" align="left" valign="top" bgcolor="#FFFFFF">
                              <select name="view_chk[<?php echo $linkrow; ?>]">
                                  <option value="1"<?php if($linkdata[$linkrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                                  <option value="0"<?php if($linkdata[$linkrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
                              </select>
                          </td>
                          <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
                              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=link_d_up&amp;data_id=<?php echo $linkdata[$linkrow]["data_id"];?>')" />
                          </td>
                          <td width="45" align="left" valign="top" bgcolor="#FFFFFF">
                              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $linkddata->Moji("data_name"); ?>','<?php echo $linkdata[$linkrow]["data_id"];?>')" />
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
              </td>
              </tr>
          <tr>
            <td>&nbsp;</td>
            </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
              <input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=link_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
            </td>
            </tr>
        </table>
      </form>
    </td>
  </tr>
</table></div>
<?php
}
?>
