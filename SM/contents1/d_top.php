<?php
$ad_contents1=new Admin_Contents1($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_contents1->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_contents1->UpdateDataList($_POST);
	
}

$contents1catedata=$ad_contents1->GetCateList(0,$lim,$setnum,$orderby);
$contents1cdata=$ad_contents1->ChangeLay($contents1catedata,4);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=contents1_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td colspan="3" valign="top">
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[7]["data_name"]; ?>　&gt;&gt;　詳細データ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
  		<td colspan="3" valign="top">
  				<table width="700" border="0" align="center" cellpadding="5" cellspacing="5">
							<?php 
			for($catenum=0;$contents1cdata[$catenum];$catenum++) {
			?>
							<tr>
									<td width="25%" align="left"><a href="?PID=contents1_details&cate_id=<?php echo $contents1cdata[$catenum][0]["cate_id"]; ?>"><?php echo $contents1cdata[$catenum][0]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=contents1_details&cate_id=<?php echo $contents1cdata[$catenum][1]["cate_id"]; ?>"><?php echo $contents1cdata[$catenum][1]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=contents1_details&cate_id=<?php echo $contents1cdata[$catenum][2]["cate_id"]; ?>"><?php echo $contents1cdata[$catenum][2]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=contents1_details&cate_id=<?php echo $contents1cdata[$catenum][3]["cate_id"]; ?>"><?php echo $contents1cdata[$catenum][3]["cate_name"]; ?></a></td>
							</tr>
							<?php
		  }
		  ?>
					</table>
  		</td>
 		</tr>
  <tr>
    <td width="200" valign="top">
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
        <tr>
          <th width="58%" align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
          <th width="42%" align="left" bgcolor="#ECECFF"><input type="button" name="Submit" value="カテゴリ管理" onclick="location.href='?PID=contents1_category'" /></th>
        </tr>
        <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報２カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$contents1catedata=$ad_contents1->GetCateList($_GET["contents1_id"],$lim,$setnum,$orderby);
for($contents1row=0;$contents1catedata[$contents1row];$contents1row++){ 
$contents1cate=new Ary_Viewer($contents1catedata[$contents1row]);
?>
        <tr>
          <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF">
            <a href="index.php?PID=contents1_details&cate_id=<?php echo $contents1catedata[$contents1row]["cate_id"] ?>"><?php $contents1cate->Moji("cate_name"); ?></a>
            <input name="cate_id[<?php echo $contents1row; ?>]" type="hidden" id="cate_id[<?php echo $contents1row; ?>]" value="<?php echo $contents1catedata[$contents1row]["cate_id"];?>" />
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
      <td width="10" valign="top">&nbsp;</td>
      <form id="form1" name="form1" method="post" action="">
    <td width="500" valign="top">
      <?php
	if($_GET["cate_id"]!=NULL) {
	?>
        <table width="500" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="30" align="left" bgcolor="#ECECEC">&nbsp;</th>
            <th width="87" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <th width="167" align="left" bgcolor="#ECECEC">
              <?php if($contents1setting["data_comm_chk"]==1) {?>
              <strong>内容</strong>
              <?php }?>
            </th>
            <th width="89" align="left" bgcolor="#ECECEC">公開</th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=contents1_d_add&amp;cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$contents1data=$ad_contents1->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($contents1row=0;$contents1data[$contents1row];$contents1row++){ 
$contents1ddata=new Ary_Viewer($contents1data[$contents1row]);
?>
          <tr>
            <td width="30" align="left" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $contents1row; ?>]" type="text" id="turn[<?php echo $contents1row; ?>]" value="<?php $contents1ddata->Moji("turn"); ?>" size="6" />
            </td>
            <td width="87" align="left" valign="top" bgcolor="#FFFFFF">
              <?php $contents1ddata->Moji("data_name"); ?>
              <input name="data_id[<?php echo $contents1row; ?>]" type="hidden" id="data_id[<?php echo $contents1row; ?>]" value="<?php echo $contents1data[$contents1row]["data_id"];?>" />
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($contents1setting["cate_comm_chk"]==1) {?>
              <?php $contents1ddata->Moji("data_comm"); ?>
              <?php
			}
			?>
            </td>
            <td width="89" align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $contents1row; ?>]">
                <option value="1"<?php if($contents1data[$contents1row]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($contents1data[$contents1row]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=contents1_d_up&amp;data_id=<?php echo $contents1data[$contents1row]["data_id"];?>')" />
            </td>
            <td width="42" align="left" valign="top" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $contents1ddata->LMoji("data_name"); ?>','<?php echo $contents1data[$contents1row]["data_id"];?>')" />
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
            </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
            </td>
            </tr>
        </table>      <?php
	  }
	  ?>
</td>
      </form>
  </tr>
</table>
