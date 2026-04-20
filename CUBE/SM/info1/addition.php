<?php 
$ad_info1=new Admin_Info1($dbobj);
$info1setting=$ad_info1->LoadSetting();

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
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ登録</strong></p>
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
	$newid=$ad_info1->AdditionCate($_POST);
	$info1cdata=$ad_info1->GetDetailsCate($newid);

?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_cate_name"];?></td>
          </tr>
   <?php
		 if($info1setting["cate_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <?php 
							if($info1cdata["cate_image"]!=NULL){
							$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$info1cdata["cate_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
														
							?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["cate_image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/>
              <?php }?>
</td>
          </tr><?php
		  }
		  ?>
   <?php
		 if($info1setting["cate_image_chk2"]==1) {
		 ?>          <tr>
          		<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像2</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF">
          				<?php if($info1cdata["image2"]!=NULL){
								$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$info1cdata["cate_image"]));
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
								
									?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info1cdata["image2"];?>" alt="image" width="<?php echo $pdata[0];?>px"/>
									<?php }?>
</td>
          		</tr>
							<?php
							}
							if($info1setting["cate_comm_chk"]==1) {
							?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
           <?php echo $_POST["new_cate_comm"];?>            </td>
          </tr><?php
					}
							 if($info1setting["cate_link_chk"]==1) {

					?>
          <tr>
          		<th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF"><?php echo $_POST["url"];?></td>
          		</tr>
          <tr>
					<?php
					}
					
					?>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
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
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=info1_add')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=info1_category')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="new_cate_name" cols="50" id="new_cate_name"></textarea>
            </td>
          </tr>
         <?php
		 if($info1setting["cate_image_chk"]==1) {
		 ?><tr>
            <th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr><?php
		  }
		  ?><?php
		 if($info1setting["cate_image_chk2"]==1) {
		 ?>
          <tr>
          		<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像2</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF">
          				<input name="imagefile2" type="file" id="imagefile2" />
          		</td>
          		</tr>
          
					<?php
					}
							 if($info1setting["cate_comm_chk"]==1) {

					?>
            <tr><th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <textarea name="new_cate_comm" cols="50" rows="10" id="new_cate_comm"></textarea>
              <br />
              <input name="html_chk" type="checkbox" id="html_chk" value="1" />
              <label for="html_chk">改行にBRを使用する</label>
            </td>
          </tr><?php
					}
							 if($info1setting["cate_link_chk"]==1) {

					?>
          
          <tr>
          		<th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
          		<td align="left" valign="top" bgcolor="#FFFFFF">
          				<input name="url" type="text" id="url" size="40" />
          		</td>
          		</tr>
					<?php
					}
					?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
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
              <input name="cate_id" type="hidden" id="cate_id" value="0">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info1_category')" />
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
