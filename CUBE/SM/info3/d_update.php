<?php 
$ad_info3=new Admin_Info3($dbobj);
$info3setting=$ad_info3->LoadSetting();
?>
<script type="text/javascript" src="/fckeditor/fckeditor.js"></script><script language="javascript">
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
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
				<td>
						<table width="700" border="0" align="center">
								<tr>
										<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
										<td width="412" align="left">
												<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　詳細データ更新</strong></p>
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
if($_REQUEST["pmode"]=="updateandback") {
	$ad_info3->UpdateOneData($_POST);
	$info3data=$ad_info3->GetDetailsData($_REQUEST["data_id"]);
	$info3cdata=$ad_info3->GetDetailsCate($_REQUEST["cate_id"]);
	?>
	<script type="text/javascript">
	location.replace('?PID=info3_details&cate_id=<?php echo $_REQUEST["cate_id"];?>');
	</script>
	<?php
}
else if($_REQUEST["pmode"]=="update") {
	$ad_info3->UpdateOneData($_POST);
	$info3data=$ad_info3->GetDetailsData($_REQUEST["data_id"]);
	$info3cdata=$ad_info3->GetDetailsCate($info3data["cate_id"]);
}

$info3data=$ad_info3->GetDetailsData($_REQUEST["data_id"]);
$info3cdata=$ad_info3->GetDetailsCate($info3data["cate_id"]);

?>
								<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<th align="left" bgcolor="#ECECEC">カテゴリ名</th>
												<td align="left" bgcolor="#FFFFFF"><?php echo $info3cdata["cate_name"];?></td>
										</tr>
										<tr>
												<th width="138" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
												<td width="547" align="left" bgcolor="#FFFFFF">
														<textarea name="data_name" cols="50" rows="4" id="data_name"><?php echo $info3data["data_name"];?></textarea>
												</td>
										</tr>
 <?php 
		 if($info3setting["option_chk"]==1) {
		 ?>          	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">メーカー名</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="maker" type="text" id="maker" value="<?php echo $info3data["maker"];?>" size="50" />
         			</td>
         			</tr>
         	<tr>
         			<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">メーカーロゴ</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<?php if($info3data["maker_logo"]!=NULL){
														$pdatalogo=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$info3data["maker_logo"]));
														if($pdatalogo[0]>400) {
															 $pdatalogo[0]=400;
														}
														?>
									<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info3data["maker_logo"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdatalogo[0];?>px" />
									<input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $info3data["maker_logo"] ?>" />
									<br />
									<label>
									<input name="delmakerlogo" type="checkbox" id="delmakerlogo" value="1" />
写真削除</label>
									<?php }?>
</td>
         			</tr>
         	<tr>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="maker_logo" type="file" id="maker_logo" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">商品名</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="item_name" type="text" id="item_name" size="50" value="<?php echo $info3data["item_name"];?>" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">&nbsp;</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="option" type="text" id="option" size="40" value="<?php echo $info3data["option"];?>" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">商品コード</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="item_code" type="text" id="item_code" value="<?php echo $info3data["item_code"];?>" />
         			</td>
         			</tr>
         	<tr>
         			<th align="left" valign="top" bgcolor="#ECECEC">通常価格</th>
         			<td align="left" valign="top" bgcolor="#FFFFFF">
         					<input name="maker_price" type="text" id="maker_price" size="20" value="<?php if($info3data["maker_price"]!=0){echo $info3data["maker_price"];}else {echo $info3data["maker_price_sub"];}?>"/>
         			</td>
         			</tr>
         	<tr>
         		<th align="left" valign="top" bgcolor="#ECECEC"> 販売価格</th>
         		<td align="left" valign="top" bgcolor="#FFFFFF">
         				<input name="price" type="text" id="price" size="20" value="<?php if($info3data["price"]!=0){echo $info3data["price"];}else {echo $info3data["price_sub"];}?>"/>
         		</td>
         		</tr>
						<?php
						}
						?>
										<?php 
		 if($info3setting["data_image_chk"]==1) {
		 ?>
										<tr>
												<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<?php if($info3data["data_image"]!=NULL){
														$pdata1=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image"]));
														if($pdata1[0]>400) {
															 $pdata1[0]=400;
														}
														?>
														<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image"];?>?<?php echo time();?>" alt="image" width="<?php echo $pdata1[0];?>px" />
														<input name="oldphoto" type="hidden" id="oldphoto" value="<?php echo $info3data["data_image"] ?>" />
														<br />
														<label>
														<input name="delimage" type="checkbox" id="delimage" value="1" />
														写真削除</label>
														<?php }?>
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
		 if($info3setting["data_image_chk2"]==1) {
		 ?>
										<tr>
												<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像2</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<?php 
														if($info3data["data_image2"]!=NULL){
														$pdata2=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image2"]));
														if($pdata2[0]>400) {
															 $pdata2[0]=400;
														}														
														?>
														<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image2"];?>" alt="image" width="<?php echo $pdata2[0];?>px"/>
														<input name="oldphoto2" type="hidden" id="oldphoto2" value="<?php echo $info3data["data_image2"] ?>" />
														<br />
														<label>
														<input name="delimage2" type="checkbox" id="delimage2" value="1" />
														写真削除</label>
														<?php 
														}
														?>
												</td>
										</tr>
										
										<tr>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="imagefile2" type="file" id="imagefile2" />
												</td>
										</tr>
										           <?php 
															 }
		 if($info3setting["data_image_chk3"]==1) {
		 ?>										<tr>
												<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像3</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<?php 
														if($info3data["data_image3"]!=NULL){
														$pdata3=(getimagesize("http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image3"]));
														if($pdata3[0]>400) {
															 $pdata3[0]=400;
														}														
														?>
														<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$info3data["data_image3"];?>" alt="image" width="<?php echo $pdata3[0];?>px"/>
														<input name="oldphoto3" type="hidden" id="oldphoto3" value="<?php echo $info3data["data_image3"] ?>" />
														<br />
														<label>
														<input name="delimage3" type="checkbox" id="delimage3" value="1" />
														写真削除</label>
														<?php 
														}
														?>
												</td>
										</tr>
										
										<tr>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="imagefile3" type="file" id="imagefile3" />
												</td>
										</tr>
<?php
										}
										?>
										<tr>
												<th align="left" valign="top" bgcolor="#ECECEC">リンク先</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="url" type="text" id="url" size="50" value="<?php echo $info3data["url"];?>"/>
												</td>
										</tr>
										<?php 
		 if($info3setting["data_comm_chk"]==1) {
		 ?>
										<tr>
												<th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong>

		<script type="text/javascript">
<!--

function on_load() {
    //==================================================================
    // FCK Editor
    
    var oFCKeditor = new FCKeditor( 'data_comm' );
    
    oFCKeditor.BasePath = '/fckeditor/';
    oFCKeditor.Width = '500';
    oFCKeditor.Height = '400';
    oFCKeditor.ToolbarSet = 'Mymenu2';
    oFCKeditor.ReplaceTextarea();
}

// -->

</script></th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<textarea name="data_comm" cols="60" rows="20" id="data_comm"><?php echo $info3data["data_comm"];?></textarea>
												</td>
										</tr>
										<?php
		  }
		  ?>
										<?php 
		 if($info3setting["data_additional_chk"]==1) {
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
$info3subdatalist=$ad_info3->GetSubDataList($info3data["data_id"]);
for($info3subrow=0;$info3subdatalist[$info3subrow];$info3subrow++){ 
?>
																<tr>
																		<td width="31%" align="left" valign="top">
																				<textarea name="sub_title[<?php echo $info3subrow; ?>]" rows="4" id="sub_title[<?php echo $info3subrow ?>]"><?php echo $info3subdatalist[$info3subrow]["data_name"];?></textarea>
																		</td>
																		<td width="69%" align="left" valign="top">
																				<textarea name="sub_comm[<?php echo $info3subrow ?>]" cols="30" rows="4" id="sub_comm[<?php echo $info3subrow ?>]"><?php echo $info3subdatalist[$info3subrow]["data_comm"];?></textarea>
																				<input name="sub_num[<?php echo $info3subrow ?>]" type="hidden" id="sub_num[<?php echo $info3subrow ?>]" value="<?php echo $info3subdatalist[$info3subrow]["sub_id"];?>" />
																		</td>
																</tr>
																<?php
				}
				?>
																<tr>
																		<td align="left" valign="top">
																				<textarea name="sub_title[<?php echo $info3subrow; ?>]" rows="4" id="sub_title[<?php echo $info3subrow ?>]"><?php echo $info3subdatalist[$info3subrow]["data_name"];?></textarea>
																		</td>
																		<td align="left" valign="top">
																				<textarea name="sub_comm[<?php echo $info3subrow ?>]" cols="30" rows="4" id="sub_comm[<?php echo $info3subrow ?>]"><?php echo $info3subdatalist[$info3subrow]["data_comm"];?></textarea>
																				<input name="sub_num[<?php echo $info3subrow ?>]" type="hidden" id="sub_num[<?php echo $info3subrow ?>]" value="1" />
																		</td>
																</tr>
														</table>
												</td>
										</tr>
										<?php
		  }
		  ?>
										<?php 
		 if($info3setting["data_osusume_chk"]==1) {
		 ?>
										<?php
										}
										?>
										<tr>
												<th width="138" align="left" valign="top" bgcolor="#ECECEC">状態</th>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<select name="view_chk" id="view_chk">
																<option value="1"<?php if($info3data["view_chk"]==1){echo " selected";}?>>公開する</option>
																<option value="0"<?php if($info3data["view_chk"]==0){echo " selected";}?> >公開しない</option>
														  <?php 
		 if($info3setting["option_chk"]==1) {
		 ?>   <option value="2"<?php if($info3data["view_chk"]==2) {echo " selected";}?>>販売停止</option>
            <?php
						}
						?></select>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
												<td align="left" valign="top" bgcolor="#FFFFFF">
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
														<input name="bbtm_regist2" type="button" id="bbtm_regist2" value="更新して一覧に戻る" onclick="datachk2()" />
														<input name="pmode" type="hidden" id="pmode" value="update">
														<input name="data_id" type="hidden" id="data_id" value="<?php echo $_REQUEST["data_id"];?>">
														<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $info3data["cate_id"];?>" />
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=info3_details&cate_id=<?php echo $info3data["cate_id"];?>')" />
												</td>
										</tr>
								</table>
								<?php 
		?>
						</form><script type="text/javascript">
on_load();
</script>
				</td>
		</tr>
</table>
