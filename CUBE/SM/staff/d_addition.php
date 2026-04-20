<?php 
$ad_staff=new Admin_Staff($dbobj);
$staffsetting=$ad_staff->LoadSetting();

?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?");
	if(res) {
		document.form1.submit();
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
											<p><strong>　<?php echo $menudata[5]["data_name"]; ?>　&gt;&gt;　データ登録</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_staff->AdditionData($_POST);
	$staffdata=$ad_staff->GetDetailsData($newid);
if($fudousanschk["use_chk"]!=1){
?>
<script language="javascript">
history.go(-2);
</script>
<?php
}
else {
?>

<script language="javascript">
location.replace("?PID=company");
</script>
<?php
}
?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          
          <tr>
            <th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="547" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_data_title"];?></td>
          </tr>
 
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">肩書き</th>
           <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["new_data_post"];?></td>
         </tr>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">名前</th>
           <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["new_data_name"];?></td>
         </tr>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">フリガナ</th>
           <td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["new_data_kana"];?></td>
         </tr>
         <?php 
		 if($staffsetting["data_image_chk"]==1) {
		 ?>         <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php if($staffdata["data_image"]!=NULL){
							$pdata=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$staffdata["data_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
							
							?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$staffdata["data_image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata[0];?>px"/>
              <?php }?>
</td>
          </tr>
		  <?php
		  }
		  ?>         <?php 
		 if($staffsetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["new_data_comm"];?>            </td>
          </tr>		  <?php
		  }
		  ?><?php 
		 if($staffsetting["data_additional_chk"]==1) {
		 ?>
          <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">追記</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <table width="100%" border="0">
                <?php
				for($i=0;$_REQUEST["sub_num"][$i]!=NULL;$i++){
					if($_REQUEST["sub_title"][$i]!=NULL||$_REQUEST["sub_comm"][$i]!=NULL) {
				?><tr>
                  <td width="35%" align="left" valign="top">
                    <?php echo $_REQUEST["sub_title"][$i]; ?>                  </td>
                  <td width="65%" align="left" valign="top">
                     <?php echo $_REQUEST["sub_comm"][$i]; ?>                  </td>
                </tr>
				<?php
					}
				}
				?>
              </table>
            </td>
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=staff_d_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=staff_details&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <?php
if($fudousanschk["use_chk"]!=1){
?>

          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="new_data_title" cols="50" id="new_data_title" style="width:98%;"></textarea>
            </td>
          </tr>
         <?php
									} 
		 if($staffsetting["data_image_chk"]==1) {
		 ?>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">肩書き</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <textarea name="new_data_post" id="new_data_post" style="width:98%;"></textarea>
           </td>
         </tr>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">名前</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <input name="new_data_name" type="text" id="new_data_name"  style="width:98%;"/>
           </td>
         </tr>
         <tr>
           <th align="left" valign="top" bgcolor="#ECECEC">フリガナ</th>
           <td align="left" valign="top" bgcolor="#FFFFFF">
             <input name="new_data_kana" type="text" id="new_data_kana" style="width:98%;" />
           </td>
         </tr>
         <tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($staffsetting["data_comm_chk"]==1) {
		 ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="new_data_comm" cols="50" rows="10" id="new_data_comm" style="width:98%;"></textarea>
            </td>
          </tr><?php
		  }
		  ?><?php 
		 if($staffsetting["data_additional_chk"]==1) {
		 ?>
          <?php
		  }
		  ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="new_view_chk" id="new_view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="1">
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
