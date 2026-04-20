<?php 
$ad_staff=new Admin_Staff($dbobj);
$staffsetting=$ad_staff->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
	
}
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    		<table width="700" border="0" align="center">
						<tr>
								<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
								<td width="412" align="left">
										<p><strong>　<?php echo $menudata[5]["data_name"]; ?>　&gt;&gt;　データ更新</strong></p>
								</td>
						</tr>
				</table>
    </td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_staff->UpdateOneData($_POST);
	$staffdata=$ad_staff->GetDetailsData($_GET["data_id"]);
							if($fudousanschk["use_chk"]==1) { 
?>
<script language="javascript">
location.replace("?PID=company");
</script>
<?php
}
else {
?>
<script language="javascript">
location.replace("?PID=staff");
</script>
<?php
}

?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td align="left" bgcolor="#FFFFFF"> <?php echo $_POST["data_title"];?></td>
          </tr>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">肩書き</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["data_post"];?></td>
          </tr>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">名前</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["data_name"];?></td>
          </tr>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">フリガナ</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["data_kana"];?></td>
          </tr>
          
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td width="547" align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($staffdata["data_image"]!=NULL){
							$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$staffdata["data_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
							?>
              <img src="<?php echo $staffdata["data_image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/>
              <?php }?>
</td>
          </tr>
         <?php 
		 if($staffsetting["data_comm_chk"]==1) {
		 ?> <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["data_comm"];?>            </td>
          </tr><?php
		  }
		  ?>
         <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php 
			
			switch($_POST["view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=staff_details')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
			$staffdata=$ad_staff->GetDetailsData($_GET["data_id"]);
		?>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<?php
if($fudousanschk["use_chk"]!=1){
?>
          <tr>
            <th align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="547" align="left" bgcolor="#FFFFFF">
              <textarea name="data_title" cols="50" id="data_title" style="width:98%;"><?php echo $staffdata["data_title"];?></textarea>
            </td>
          </tr>
										<?php
										}
										?>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">肩書き</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="data_post" type="text" id="data_post" value="<?php echo $staffdata["data_post"];?>" style="width:98%;" />
            </td>
          </tr>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">名前</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><input name="data_name" type="text" id="data_name" value="<?php echo $staffdata["data_name"];?>" style="width:98%;" /></td>
          </tr>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">フリガナ</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="data_kana" type="text" id="data_kana" value="<?php echo $staffdata["data_kana"];?>" style="width:98%;" />
            </td>
          </tr>
          
         <?php 
		 if($staffsetting["data_image_chk"]==1) {
		 ?>
         <tr>
           <th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <?php 
						 if($staffdata["data_image"]!=NULL){
							$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$staffdata["data_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
						 ?>
             <img src="<?php echo $staffdata["data_image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
               <label>
               <input name="delimage" type="checkbox" id="delimage" value="1" />
               写真削除</label><?php }?>
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
		 if($staffsetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="data_comm" cols="50" rows="5" id="data_comm" style="width:98%;"><?php echo $staffdata["data_comm"];?></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($staffsetting["data_additional_chk"]==1) {
		 ?><?php
		  }
		  ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1"<?php if($staffdata["view_chk"]==1){echo " selected";}?>>公開する</option>
                <option value="0"<?php if($staffdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="update">
              <input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $staffdata["cate_id"];?>" />
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="もどる" onclick="history.back()" />
            </td>
          </tr>
        </table>
        <?php 
		}
		?>
      </form>
    </td>
  </tr>
</table>
