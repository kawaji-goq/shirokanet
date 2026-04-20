<?php 
$ad_banner=new Admin_Banner($dbobj);
$bannersetting=$ad_banner->LoadSetting();
?>
<script language="javascript">
function datachk() {

	res=confirm("この内容で更新してもよろしいですか?");
	
	if(res) {
		document.update_form.submit();
	}
}
function datachk2() {

	res=confirm("この内容で更新してもよろしいですか?");
	document.update_form.pmode.value="updateandback";
	if(res) {
		document.update_form.submit();
	}
}	
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="center">
		<tr>
				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
				<td width="412" align="left">
						<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ更新</strong></p>
				</td>
		</tr>
</table>
<table width="700" border="0" align="center">
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td width="690">
						<form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
								<?php 
if($_REQUEST["pmode"]=="updateandback") {
	$ad_banner->UpdateOneData($_POST);
	$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	$bannercdata=$ad_banner->GetDetailsCate($_REQUEST["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=banner&cate_id=<?php echo $_REQUEST["cate_id"];?>');
	</script>
	<?php
}
else if($_REQUEST["pmode"]=="update") {
	$ad_banner->UpdateOneData($_POST);
	$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
	$bannercdata=$ad_banner->GetDetailsCate($bannerdata["cate_id"]);
}

$bannerdata=$ad_banner->GetDetailsData($_REQUEST["data_id"]);
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
														<input name="data_name" type="text" id="data_name" value="<?php echo $bannerdata["data_name"];?>" size="50">
												</td>
										</tr>
 <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>
						<?php
						}
						?>
										
										<tr>
												<th rowspan="2" align="left" valign="top">イメージ画像</th>
												<td align="left" valign="top">
														<?php if($bannerdata["data_image"]!=NULL){
														$pdata1=(getimagesize($_SERVER['DOCUMENT_ROOT'].$bannerdata["data_image"]));
														if($pdata1[0]>400) {
															 $pdata1[0]=400;
														}
														?>
														<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$bannerdata["data_image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata1[0];?>px" />
														<input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $bannerdata["data_image"] ?>" />
														<br />
														<label>
														<input name="delimage" type="checkbox" id="delimage" value="1" />
														写真削除</label>
														<?php }?>												</td>
										</tr>
										<tr>
												<td align="left" valign="top">
														<input name="imagefile" type="file" id="imagefile">
												</td>
										</tr>
		
										           <?php 
		 if($bannersetting["data_image_chk3"]==1) {
		 ?>
<?php
										}
										?>
										<tr>
												<th align="left" valign="top">リンク先</th>
												<td align="left" valign="top">
														<input name="url" type="text" id="url" size="50" value="<?php echo $bannerdata["url"];?>"/>
												</td>
										</tr>
										<?php 
		 if($bannersetting["data_comm_chk"]==1) {
		 ?>
										<?php
		  }
		  ?>
										<?php 
		 if($bannersetting["data_additional_chk"]==1) {
		 ?>
										<?php
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
														<select name="target">
																<option value="_self"<?php if($bannerdata["target"]=="_self") { echo " selected";}?>>現在のウィンドウ</option>
																<option value="_blank"<?php if($bannerdata["target"]=="_blank") { echo " selected";}?>>新しいウィンドウ</option>
														</select>
												</td>
										</tr>
										<tr>
												<th width="100" align="left" valign="top">状態</th>
												<td align="left" valign="top">
														<select name="view_chk" id="view_chk">
																<option value="1"<?php if($bannerdata["view_chk"]==1){echo " selected";}?>>公開する</option>
																<option value="0"<?php if($bannerdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
														  <?php 
		 if($bannersetting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($bannerdata["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?></select>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top">&nbsp;</td>
												<td align="left" valign="top">
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
														<input name="bbtm_regist2" type="button" id="bbtm_regist2" value="更新して一覧に戻る" onclick="datachk2()" />
														<input name="pmode" type="hidden" id="pmode" value="update">
														<input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
														<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $bannerdata["cate_id"];?>" />
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=banner&cate_id=<?php echo $bannerdata["cate_id"];?>')" />
												</td>
										</tr>
								</table>
								<?php 
		?>
						</form>
				</td>
		</tr>
</table>
