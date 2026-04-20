<?php
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
*/
$flobj=new Acts($dbobj);

if($_REQUEST["mode"]=="delete") {

	$delrows=0;
	
	while($_REQUEST["delact"][$delrows]!=NULL) {
		$delsql="delete from act where act_id = '".$_REQUEST["delact"][$delrows]."'";
		$result=$dbobj->Query($delsql);
		
		if($result) {
			@unlink($_REQUEST["delact"][$delrows]);
		}
		
		$delrows++;
	}
}
if($_REQUEST["mode"]=="viewng") {

	$delrows=0;
	
	while($_REQUEST["delact"][$delrows]!=NULL) {
		$delsql="update act set view_chk= 0 where act_id = '".$_REQUEST["delact"][$delrows]."'";
		$result=$dbobj->Query($delsql);
		
		$delrows++;
	}
}
if($_REQUEST["mode"]=="viewok") {

	$delrows=0;
	
	while($_REQUEST["delact"][$delrows]!=NULL) {
		$delsql="update act set view_chk= 1 where act_id = '".$_REQUEST["delact"][$delrows]."'";
		$result=$dbobj->Query($delsql);
		
		if($result) {
			@unlink($_REQUEST["delact"][$delrows]);
		}
		
		$delrows++;
	}
}
$fldata=$flobj->Get_CateList2(0);
$fdata=$flobj->GetActList($_REQUEST["cate_id"]);
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<script language="javascript">
function delchk(frm) {
	switch(frm.status_chk.value) {
		case "1":
				res=confirm("選択した活動を公開にしてもよろしいですか？");
				if(res) {
					frm.mode.value="viewok";
					frm.submit();
				}
			break;
		case "2":
				res=confirm("選択した活動を非公開にしてもよろしいですか？");
				if(res) {
					frm.mode.value="viewng";
					frm.submit();
				}
			break;
		case "3":
				res=confirm("選択した活動を削除してもよろしいですか？");
				if(res) {
					frm.mode.value="delete";
					frm.submit();
				}
			break;
	}
	/*
	*/
	
}
</script>
<div id="act">
	<table width="740" border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="2" align="left" valign="top">
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
					<tr>
						<td width="35"><img src="/members/img/topics_pt.gif" width="35" height="31"></td>
						<td>
							<div id="tree"><span class="top">活動予定・報告管理</span>　<span class="gt">>></span>　<span class="sub"><?php echo $fcdata["cate_name"]; ?></span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp;			</td>
		</tr>
		<tr>
			<td align="left" valign="top"><strong> 活動予定・報告種別 </strong></td>
			<td align="left" valign="top">
				<div align="left"><strong>活動予定・報告一覧</strong></div>
			</td>
		</tr>
		<tr>
			<td width="200" align="left" valign="top">
				<table width="100%"  border="0" cellpadding="2" cellspacing="2" background="/members/img/message_bg1.gif" class="menu">
					<tr>
						<td colspan="2">
							<input type="button" name="Submit" value="活動予定・報告種別管理" onClick="window.location.href='index.php?PID=act_cate'">
						</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?>
						<td colspan="2"><a href="index.php?PID=act&cate_id=<?php echo $fldata[$flrows]["cate_id"];?>"><?php echo $fldata[$flrows]["cate_name"];?></a></td>
					</tr>
					<?php 
					$flrows++;
				}
				?>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</td>
			<td width="520" align="center" valign="top">
				<table width="100%"  border="0" cellspacing="1" cellpadding="1">
					<form name="form1" method="post" action="">
						<tr>
							<td colspan="2" valign="top">
								<table width="100%"  border="0" cellspacing="2" cellpadding="2">
									<tr>
										<th width="10">&nbsp;</th>
										<th>
											<div align="left">活動予定・報告名</div>
										</th>
										<th>
											<div align="left">登録日時</div>
										</th>
										<th width="50">
											<div align="left"></div>
										</th>
										<th>状態</th>
										<th>&nbsp;</th>
										<th>&nbsp;</th>
									</tr>
									<?php 
								$frows=0;
								while($fdata[$frows]["act_id"]!=NULL) {
								?>
									<tr>
										<td width="10" align="center">
											<input name="delact[]" type="checkbox" id="delact[]" value="<?php echo $fdata[$frows]["act_id"] ?>">
										</td>
										<td><?php echo $fdata[$frows]["act_name"] ?></td>
										<td><?php echo $fdata[$frows]["registdate"] ?></td>
										<td>
											<table border="0" align="center" cellpadding="0" cellspacing="0">
												<tr>
													<td>
														<div align="center">
															<?php 
													
													switch($fdata[$frows]["act_type"]) {
														case "jpg":
															$viewicon=$fdata[$frows]["act_path"];
															break;
														case "gif":
															$viewicon=$fdata[$frows]["act_path"];
															break;
														case "png":
															$viewicon=$fdata[$frows]["act_path"];
															break;
														case "bmp":
															$viewicon=$fdata[$frows]["act_path"];
															break;
														case "doc":
															$viewicon="/img2/word.gif";
															break;
														case "xls":
															$viewicon="/img2/excel.gif";
															break;
														case "pdf":
															$viewicon="/img2/pdf.gif";
															break;
														default:
															$viewicon="/members/img/file_ic.gif";
															break;
														}	
													?>
														<a href="<?php echo $fdata[$frows]["act_path"]; ?>" target="_blank" type="application/x-msdownload"><img src="<?php echo $fdata[$frows]["act_path"]; ?>" alt="<?php echo $fdata[$frows]["act_name"] ?>" width="50" border="0" /></a></div>
													</td>
												</tr>
											</table>
										</td>
										<td align="center"><?php switch($fdata[$frows]["view_chk"]) {
											case 0:
												echo "非公開";
												break;
											case 1:
												echo "公開";
												break;
										} ?></td>
										<td align="center">
											<input type="button" name="Submit" value="プレビュー" onClick="window.open('/admin/tool/preview.php?act_id=<?php echo $fdata[$frows]["act_id"] ?>')">
										</td>
										<td align="center">
											<input name="btm_up" type="button" id="btm_up" value="修正" onClick="window.location.href='index.php?PID=act_up&act_id=<?php echo $fdata[$frows]["act_id"];?>'">
										</td>
									</tr>
									<tr>
										<td colspan="7" class="line"></td>
									</tr>
									<?php 
									$frows++;
								}
								?>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input name="mode" type="hidden" id="mode">
							</td>
						</tr>
						<tr>
							<td width="50%" colspan="2">
								<input name="btm_add" type="button" id="btm_add" value="新規活動を登録する" onClick="window.location.href='index.php?PID=act_add&cate_id=<?php echo $_REQUEST["cate_id"];?>'">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table width="100%"  border="0" cellspacing="3" cellpadding="3">
                                	<tr>
                                		<td width="25%">
                                			<div align="right">選択した活動を</div>
                                		</td>
                                		<td width="23%">
                                			<select name="status_chk" id="status_chk">
                                				<option value="1" selected>公開にする</option>
                                				<option value="2">非公開にする</option>
                                				<option value="3">削除する</option>
                               				</select>
</td>
                               		    <td width="52%">
                               		    	<input name="btm_del" type="button" id="btm_del" value="実行" onClick="delchk(this.form)">
                               		    </td>
                                	</tr>
                                	</table>
</td>
						</tr>
					</form>
				</table>
			</td>
		</tr>
	</table>
</div>
