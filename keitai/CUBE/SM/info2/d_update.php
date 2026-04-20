<?php 
$ad_info2=new Admin_Info2($dbobj);
$info2setting=$ad_info2->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
	
}
</script>
<script type="text/javascript" src="/FCK/fckeditor.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[7]["data_name"]; ?>　&gt;&gt;　詳細データ更新</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="690">
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_info2->UpdateOneData($_POST);
	$info2data=$ad_info2->GetDetailsData($_GET["data_id"]);
	$info2cdata=$ad_info2->GetDetailsCate($info2data["cate_id"]);
?>
<?php
		}
			$info2data=$ad_info2->GetDetailsData($_GET["data_id"]);
			$info2cdata=$ad_info2->GetDetailsCate($info2data["cate_id"]);
		?>
<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
            <td align="left" bgcolor="#FFFFFF"><?php echo $info2cdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="552" align="left" bgcolor="#FFFFFF">
              <textarea name="data_name" cols="50" id="data_name"><?php echo $info2data["data_name"];?></textarea>
            </td>
          </tr>
         <?php 
		 if($info2setting["data_image_chk"]==1) {
		 ?>
         <tr>
           <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php if($info2data["data_image"]!=NULL){;?>
             <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info2data["data_image"];?>" alt="image" />
             <input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $info2data["data_image"] ?>" />
             <br />
               <label>
               <input name="delimage" type="checkbox" id="delimage" value="1" />
               写真削除</label> <?php }?>
</td>
         </tr>
         <tr>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr>
          <?php
		  }
		  ?><?php 
		 if($info2setting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong>

		<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor('data_comm');
    
    oFCKeditor.BasePath = '/FCK/';
    oFCKeditor.Width = '500';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu2';
    oFCKeditor.ReplaceTextarea();
}

// -->

</script></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm" cols="50" rows="15" id="data_comm"><?php echo $info2data["data_comm"];?></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($info2setting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">追記</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <table width="100%" border="0">
               <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　情報１追記一覧開始　　　　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$info2subdatalist=$ad_info2->GetSubDataList($info2data["data_id"]);
for($info2subrow=0;$info2subdatalist[$info2subrow];$info2subrow++){ 
?> <tr>
                  <td width="31%" align="left" valign="top">
                    <textarea name="sub_title[<?php echo $info2subrow; ?>]" id="sub_title[<?php echo $info2subrow ?>]"><?php echo $info2subdatalist[$info2subrow]["data_name"];?></textarea>
                  </td>
                  <td width="69%" align="left" valign="top">
                    <textarea name="sub_comm[<?php echo $info2subrow ?>]" cols="30" rows="4" id="sub_comm[<?php echo $info2subrow ?>]"><?php echo $info2subdatalist[$info2subrow]["data_comm"];?></textarea>
                    <input name="sub_num[<?php echo $info2subrow ?>]" type="hidden" id="sub_num[<?php echo $info2subrow ?>]" value="<?php echo $info2subdatalist[$info2subrow]["sub_id"];?>" />
                  </td>
                </tr>
               <?php
				}
				?>               <tr>
                 <td align="left" valign="top">
                   <textarea name="sub_title[<?php echo $info2subrow; ?>]" id="sub_title[<?php echo $info2subrow ?>]"><?php echo $info2subdatalist[$info2subrow]["data_name"];?></textarea>
                 </td>
                 <td align="left" valign="top">
                   <textarea name="sub_comm[<?php echo $info2subrow ?>]" cols="30" rows="4" id="sub_comm[<?php echo $info2subrow ?>]"><?php echo $info2subdatalist[$info2subrow]["data_comm"];?></textarea>
                   <input name="sub_num[<?php echo $info2subrow ?>]" type="hidden" id="sub_num[<?php echo $info2subrow ?>]" value="1" />
                 </td>
               </tr>
              </table>
            </td>
          </tr><?php
		  }
		  ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($info2data["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($info2data["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $info2data["cate_id"];?>" />
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info2_details&cate_id=<?php echo $info2data["cate_id"];?>')" />
            </td>
          </tr>
        </table>
				<?php 
		 if($info2setting["data_comm_chk"]==1) {
		 ?>
<script type="text/javascript">
on_load();
</script>        <?php 
}
		?>
      </form>
    </td>
  </tr>
</table>
