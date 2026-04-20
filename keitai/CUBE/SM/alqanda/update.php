<?php 

$ad_qanda=new Admin_QA($dbobj);
$qandasetting=$ad_qanda->LoadSetting();
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
<table width="900" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
								<td colspan="3" align="left" valign="top">
												<table width="700" border="0" align="left">
																<tr>
																				<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
																				<td width="412" align="left">
																								<p><strong>　<?php echo $menudata[8]["data_name"]; ?>　&gt;&gt;　カテゴリ更新</strong></p>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
				<tr>
								<td width="200" valign="top">
												<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
																<tr>
																				<th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
																</tr>
																<?php
$qandadata=$dbobj->GetList("select * from qanda_cate where parents_id = ".$_GET["cid"]." order by turn");
for($qandarow=0;$qandadata[$qandarow];$qandarow++){ 
?>
																<tr>
																				<td align="left" valign="top" bgcolor="#FFFFFF"> <a href="index.php?PID=al_qa_details&cid=<?php echo $_REQUEST["cid"]."&cate_id=".$qandadata[$qandarow]["cate_id"] ?>"> <?php echo $qandadata[$qandarow]["cate_name"]; ?> </a></td>
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
								<td valign="top">
												<table border="0" align="left" cellpadding="0" cellspacing="0">
																<tr>
																				<td>
																								<form action="" method="post" enctype="multipart/form-data" name="update_form" id="update_form">
																												<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">

																																<tr>
																																				<td>
																																								<?php 
if($_REQUEST["pmode"]=="update") {
	$ad_qanda->UpdateOneCate($_POST);
	$qandacdata=$ad_qanda->GetDetailsCate($_GET["cate_id"]);
?>
																																								<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																																												<tr>
																																																<th width="138" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
																																																<td width="547" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["cate_name"];?></td>
																																												</tr>
																																												<?php
		 if($qandasetting["cate_image_chk"]==1) {
		 ?>
																																												<tr>
																																																<th align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<?php 
							if($qandacdata["cate_image"]!=NULL){
							$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$qandacdata["cate_image"]));
							
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
							
							?>
																																																				<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$qandacdata["cate_image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/>
																																																				<?php 
							}
							?>
																																																</td>
																																												</tr>
																																												<?php
		  }
		  ?>
																																												<?php
		 if($qandasetting["cate_comm_chk"]==1) {
		 ?>
																																												<tr>
																																																<th width="138" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["cate_comm"];?> </td>
																																												</tr>
																																												<?php
		  }
		  ?>
																																												<tr>
																																																<th width="138" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<?php 
			
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
																																																				<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=al_qa&cid=<?php echo $_REQUEST["cid"];?>')">
																																																</td>
																																												</tr>
																																								</table>
																																								<?php
		}
		else {
			$qandacdata=$ad_qanda->GetDetailsCate($_GET["cate_id"]);
		?>
																																								<table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																																												<tr>
																																																<th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
																																																<td width="400" align="left" bgcolor="#FFFFFF">
																																																				<input name="cate_name" type="text" id="cate_name" value="<?php echo $qandacdata["cate_name"];?>" size="40">
																																																</td>
																																												</tr>
																																												<?php
		 if($qandasetting["cate_image_chk"]==1) {
		 ?>
																																												<tr>
																																																<th rowspan="2" align="left" valign="top" bgcolor="#ECECEC">イメージ画像</th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<?php if($qandacdata["cate_image"]!=NULL){
							$pdata=(getimagesize($_SERVER['DOCUMENT_ROOT'].$qandacdata["cate_image"]));
							
							if($pdata[0]>400) {
								 $pdata[0]=400;
							}
							 
							 ?>
																																																				<img src="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$qandacdata["cate_image"];?>" alt="image" width="<?php echo $pdata[0];?>px"/><br />
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
		  ?>
																																												<?php
		 if($qandasetting["cate_comm_chk"]==1) {
		 ?>
																																												<tr>
																																																<th width="100" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<textarea name="cate_comm" cols="50" rows="15" id="cate_comm"><?php echo $qandacdata["cate_comm"];?></textarea>
																																																</td>
																																												</tr>
																																												<?php
		  }
		  ?>
																																												<tr>
																																																<th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<select name="view_chk" id="view_chk">
																																																								<option value="1"<?php if($qandacdata["view_chk"]==1){echo " selected";}?>>公開する</option>
																																																								<option value="0"<?php if($qandacdata["view_chk"]==0){echo " selected";}?> >公開しない</option>
																																																				</select>
																																																</td>
																																												</tr>
																																												<tr>
																																																<td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
																																																<td align="left" valign="top" bgcolor="#FFFFFF">
																																																				<input name="bbtm_regist" type="button" id="bbtm_regist" value="更新する" onClick="datachk()">
																																																				<input name="pmode" type="hidden" id="pmode" value="update">
																																																				<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
																																																				<input name="cid" type="hidden" id="cid" value="<?php echo $_REQUEST["cid"];?>">
																																																				<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=al_qa&cid=<?php echo $_REQUEST["cid"];?>')" />
																																																</td>
																																												</tr>
																																								</table>
																																								<?php 
		}
		?>
																																				</td>
																																</tr>
																												</table>
																								</form>
																				</td>
																</tr>
												</table>
								</td>
				</tr>
</table>
