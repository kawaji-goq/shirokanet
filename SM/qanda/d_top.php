<?php
$ad_qanda=new Admin_QA($dbobj);

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {
	$ad_qanda->DeleteOneData($_GET["delid"]);
}
if($_REQUEST["btm_up_data"]=="更新する") {

	$ad_qanda->UpdateDataList($_POST);
	
}

$qandacatedata=$ad_qanda->GetCateList(0,$lim,$setnum,$orderby);
$qandacdata=$ad_qanda->ChangeLay($qandacatedata,4);
?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=qanda_details&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
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
											<p><strong>　<?php echo $menudata[8]["data_name"]; ?>　&gt;&gt;　データ一覧</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
  		<td>
  				<table width="700" border="0" align="center" cellpadding="5" cellspacing="5">
							<?php 
			for($catenum=0;$qandacdata[$catenum];$catenum++) {
			?>
							<tr>
									<td width="25%" align="left"><a href="?PID=qanda_details&cate_id=<?php echo $qandacdata[$catenum][0]["cate_id"]; ?>"><?php echo $qandacdata[$catenum][0]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=qanda_details&cate_id=<?php echo $qandacdata[$catenum][1]["cate_id"]; ?>"><?php echo $qandacdata[$catenum][1]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=qanda_details&cate_id=<?php echo $qandacdata[$catenum][2]["cate_id"]; ?>"><?php echo $qandacdata[$catenum][2]["cate_name"]; ?></a></td>
									<td width="25%" align="left"><a href="?PID=qanda_details&cate_id=<?php echo $qandacdata[$catenum][3]["cate_id"]; ?>"><?php echo $qandacdata[$catenum][3]["cate_name"]; ?></a></td>
							</tr>
							<?php
		  }
		  ?>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="30" align="left" bgcolor="#ECECEC">&nbsp;</th>
            <th width="461" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <th width="89" align="left" bgcolor="#ECECEC">
                <div align="center">公開</div>
            </th>
            <th colspan="2" align="left" bgcolor="#ECECEC">
              <div align="center">
                <input type="button" name="Submit" value="新規追加" onclick="location.href='?PID=qanda_d_add&cate_id=<?php echo $_GET["cate_id"];?>'" />
              </div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$qandadata=$ad_qanda->GetDataList($_GET["cate_id"],$lim,$setnum,$orderby);
for($qandarow=0;$qandadata[$qandarow];$qandarow++){ 
$qandaddata=new Ary_Viewer($qandadata[$qandarow]);
?>
          <tr>
            <td width="30" align="center" bgcolor="#FFFFFF">
                <div align="center">
                    <input name="turn[<?php echo $qandarow; ?>]" type="text" id="turn[<?php echo $qandarow; ?>]" value="<?php $qandaddata->Moji("turn"); ?>" size="6" />
                    </div>
            </td>
            <td align="left" bgcolor="#FFFFFF">
              <?php $qandaddata->Moji("data_name"); ?>
              <input name="data_id[<?php echo $qandarow; ?>]" type="hidden" id="data_id[<?php echo $qandarow; ?>]" value="<?php echo $qandadata[$qandarow]["data_id"];?>" />
            </td>
            <td width="89" align="left" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $qandarow; ?>]">
                <option value="1"<?php if($qandadata[$qandarow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($qandadata[$qandarow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="42" align="left" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="修正" onclick="location.replace('?PID=qanda_d_up&data_id=<?php echo $qandadata[$qandarow]["data_id"];?>')" />
            </td>
            <td width="42" align="left" bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="削除" onclick="delchk('<?php $qandaddata->Moji("data_name"); ?>','<?php echo $qandadata[$qandarow]["data_id"];?>')" />
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
