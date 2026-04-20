<?php 
$ad_banner=new Admin_Banner($dbobj);
$bannercdata=$ad_banner->GetDetailsCate($_GET["cate_id"]);
$bannersetting=$ad_banner->LoadSetting();

?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?2");
	if(res) {
		document.infoform1.submit();
	}
}
function datachk2() {
	res=confirm("この内容で登録してもよろしいですか?");
	if(res) {
		document.infoform1.pmode.value="registandback";
		document.infoform1.submit();
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
  <tr>
    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
    <td width="412" align="left">
      <p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ登録</strong></p>
    </td>
  </tr>
</table>
<table width="700" border="0" align="center">
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="infoform1" id="infoform1">
<?php 
if($_REQUEST["pmode"]=="registandback") {
	$new_id=$ad_banner->AdditionData($_POST);
	$bannerdata=$ad_banner->GetDetailsData($new_id);
	$bannercdata=$ad_banner->GetDetailsCate($bannerdata["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=banner&cate_id=<?php echo $_GET["cate_id"];?>')
	</script>
	<?php
}
else if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_banner->AdditionData($_POST);
	$bannerdata=$ad_banner->GetDetailsData($new_id);
	$bannercdata=$ad_banner->GetDetailsCate($bannerdata["cate_id"]);
	
?>
        <table width="600" border="0" align="center">
          <tr>
            <th align="left">カテゴリ名</th>
            <td align="left"><?php echo $bannercdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left"><strong>タイトル</strong></th>
            <td width="400" align="left">
             <?php echo $_POST["new_data_name"];?></td>
          </tr>
 <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>
						<?php
						}
						?>
         <?php 
		 if($bannersetting["data_image_chk"]==1) {
		 ?>          <tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <?php if($bannerdata["data_image"]!=NULL){;?>
              <img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$bannerdata["data_image"];?>" alt="image" />
              <?php }?>
</td>
          </tr>
		  <?php
		  }
		  ?>
							       <?php 
		 if($bannersetting["data_image_chk3"]==1) {
		 ?><?php }?>
 <?php 
		 if($bannersetting["data_comm_chk"]==1) {
		 ?>		  <?php
		  }
		  ?><?php 
		 if($bannersetting["data_additional_chk"]==1) {
		 ?><?php
		  }
		  ?>
          <tr>
          		<th align="left" valign="top">リンク先</th>
          		<td align="left" valign="top"><?php echo $_POST["url"];?></td>
          		</tr>
          <tr>
            <th width="100" align="left" valign="top">公開</th>
            <td align="left" valign="top"><?php 
			switch($_POST["new_view_chk"]) {
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
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=banner_add&cate_id=<?php echo $_REQUEST["cate_id"];?>')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=banner&cate_id=<?php echo $_GET["cate_id"];?>')" />
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="600" border="0" align="center">
          <tr>
            <th align="left">カテゴリ名</th>
            <td align="left"><?php echo $bannercdata["cate_name"];?></td>
          </tr>
          <tr>
            <th width="100" align="left"><strong>タイトル</strong></th>
            <td width="400" align="left">
              	<input name="new_data_name" type="text" id="new_data_name" value="" size="50">
            </td>
          </tr>
 <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>
						<?php
						}
						?>
    
     <tr>
            <th align="left" valign="top">イメージ画像</th>
            <td align="left" valign="top">
              <input name="imagefile" type="file" id="imagefile">
            </td>
          </tr>

          <tr>
          		<th align="left" valign="top">リンク先</th>
          		<td align="left" valign="top">
          				<input name="url" type="text" id="url" size="50" />
          		</td>
          		</tr>
<?php 
		 if($bannersetting["data_comm_chk"]==1) {
		 ?><?php
		  }
		  ?><?php 
		 if($bannersetting["data_additional_chk"]==1) {
		 ?><?php
		  }
		  ?>
										<?php 
		 if($bannersetting["data_osusume_chk"]==1) {
		 ?>
										<?php
										}
										?>		          
										<tr>
												<th align="left" valign="top">ブラウザ</th>
												<td align="left" valign="top">
														<select name="target" id="target">
																<option>現在のウィンドウ</option>
																<option value="_blank">新しいウィンドウ</option>
														</select>
												</td>
										</tr>
										<tr>
            <th width="100" align="left" valign="top">状態</th>
            <td align="left" valign="top">
              <select name="new_view_chk" id="new_view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
  <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($bannerdata[$bannerrow]["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?>              </select>
            </td>
          </tr>
          <tr>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onClick="datachk()">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録して一覧に戻る" onclick="datachk2()" />
              <input name="pmode" type="hidden" id="pmode" value="regist">
              <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=banner&cate_id=<?php echo $_GET["cate_id"];?>')" />
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
