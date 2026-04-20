<?php
$ad_info1=new Admin_Info1($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_info1->DeleteOneData($_GET["delid"]);
	
}
if($_GET["pmode"]=="datacopy"&&$_GET["copyid"]!=NULL) {

	$ad_info1->CopyData($_GET["copyid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_info1->UpdateDataList($_POST);
	
}
$info1setting=$ad_info1->LoadSetting();
$info1catedata=$ad_info1->GetCateList(0,$lim,$setnum,$orderby);
$info1cdata=$ad_info1->ChangeLay($info1catedata,4);

?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=info1_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
function datacopy(name,id) {
	var res=confirm(name+"を複製しますか？");
	if(res) {
		location.href="?PID=info1_details&pmode=datacopy&cate_id=<?php echo $_GET["cate_id"];?>&copyid="+id;
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
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td width="10" valign="top">&nbsp;</td>
    <td width="500" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td width="200" valign="top">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        <tr>
          <th width="58%" align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
          <th width="42%" align="left" valign="top" bgcolor="#ECECFF">
          		<input type="button" name="Submit" value="カテゴリ管理" onclick="location.href='?PID=info1_category'" /></th>
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
          <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF">
					<?php
					if($info1catedata[$info1row][0]==5){
					?>
            <a href='index.php?PID=plist&cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'><?php $info1cate->Moji("cate_name"); ?></a>
						<?php
					}
					else{
						?>
            <a href='index.php?PID=info1_details&cate_id=<?php echo $info1catedata[$info1row]["cate_id"]; ?>'><?php $info1cate->Moji("cate_name"); ?></a>
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
    <td valign="top"><?php
	if($_GET["cate_id"]!=NULL) {
	?><table width="500" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
       <tr>
       		<th width="43" align="left" bgcolor="#ECECEC">ｵｽｽﾒ</th>
            <th align="left" bgcolor="#ECECEC">表示順</th>
            <th align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <th width="89" align="left" bgcolor="#ECECEC">
            		<div align="center">状態</div>
            </th>
            <th colspan="3" align="left" bgcolor="#ECECEC">
              <div align="center">
              		</div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info1data=$ad_info1->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($info1row=0;$info1data[$info1row];$info1row++){ 
$info1ddata=new Ary_Viewer($info1data[$info1row]);
?>
          <tr>
          		<td width="43" align="center" valign="middle" bgcolor="#FFFFFF">
          				<input name="data_osusume_chk[<?php echo $info1row; ?>]" type="checkbox" id="data_osusume_chk[<?php echo $info1row; ?>]" value="1"<?php if($info1data[$info1row]["osusume_chk"]==1) { echo " checked";}?> />
          		</td>
            <td width="48" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $info1row; ?>]" type="text" id="turn[<?php echo $info1row; ?>]" value="<?php echo $info1data[$info1row]["turn"]; ?>" size="6" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              	<a href="?PID=info1_d_up&data_id=<?php echo $info1data[$info1row]["data_id"];?>">
              <?php $info1ddata->Moji("data_name"); ?>
              <input name="data_id[<?php echo $info1row; ?>]" type="hidden" id="data_id[<?php echo $info1row; ?>]" value="<?php echo $info1data[$info1row]["data_id"];?>" />
            		</a></td>
            <td width="89" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $info1row; ?>]">
                <option value="1"<?php if($info1data[$info1row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($info1data[$info1row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
               <?php 
		 if($info1setting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($info1data[$info1row]["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?>  </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=info1_d_up&amp;data_id=<?php echo $info1data[$info1row]["data_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
            		<input type="button" name="Submit" value="複製" onclick="datacopy('<?php echo str_replace("\r\n","",$info1data[$info1row]["data_name"]); ?>','<?php echo $info1data[$info1row]["data_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php echo str_replace("\\n","",str_replace("\\r","",$info1data[$info1row]["data_name"])); ?>','<?php echo $info1data[$info1row]["data_id"];?>')" />
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
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=info1_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
              
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
