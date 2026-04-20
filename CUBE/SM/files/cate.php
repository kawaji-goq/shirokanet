<?php 
$flobj=new Files($dbobj);
if($_REQUEST["mode"]=="delete") {

	$delrows=0;
	while($_REQUEST["delfile"][$delrows]!=NULL) {
		$delsql="delete from file_dir where dir_id = ".$_REQUEST["delfile"][$delrows]."";
		$result=$dbobj->Query($delsql);
		$delrows++;
	}
	
}

$fldata=$flobj->Get_CateList();
$fdata=$flobj->GetFileList($_REQUEST["dir_id"]);
$fcdata=$flobj->Get_CateData($_REQUEST["dir_id"]);

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script language="javascript">
function delchk(frm) {
	res=confirm("選択したファイルを削除してもよろしいですか？");
	
	if(res) {
		frm.mode.value="delete";
		frm.submit();
	}
	
}
</script>
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
				<td colspan="2" align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
				<td colspan="2" align="left" valign="top">
						<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
								<tr>
										<td width="4%"><img src="/GW/img/template/icon_file.jpg" width="40" height="42"></td>
										<td width="96%" class="title"><font color="#333333">ファイル管理</font></td>
								</tr>
						</table>
				</td>
		</tr>
		<tr>
				<td width="220" align="left" valign="top">
				    <table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF" class="menu">
            <tr>
                <td colspan="2"><a href="?PID=files_cate"><strong>フォルダ一覧</strong></a> (
                        <?php 
$sumfiledata=$dbobj->GetData("select sum(files_size) as sumsize from files");
$sumsize = $sumfiledata["sumsize"];
												echo number_format(($sumsize*100/50000),2); ?>
                    ％使用) </td>
            </tr>
            <?php
				$flrows=0;
				while($fldata[$flrows]["dir_id"]!=NULL) {
				?>
            <tr>
                <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="index.php?PID=files&dir_id=<?php echo $fldata[$flrows]["dir_id"];?>"><?php echo $fldata[$flrows]["dir_name"];?></a></td>
            </tr>
            <?php 
					$flrows++;
				}
				?>
            <tr>
                <td colspan="2" bgcolor="#FFFFFF"><a href="?PID=files_cateadd"><img src="/SM/img/files/catereg.jpg" width="154" height="23" border="0"></a><br>
                    <a href="?PID=files_cate"><img src="/SM/img/files/cateedit.jpg" width="154" height="22" border="0"></a></td>
            </tr>
        </table>
				</td>
				<td align="left" valign="top">
						<form name="form2" method="post" action="">
								<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
										<tr>
												<td bgcolor="#DCDCFF"><strong>フォルダ</strong><strong>一覧</strong></td>
										</tr>
										<tr>
												<td height="100" valign="top" bgcolor="#FFFFFF">
														<table width="100%"  border="0" cellspacing="1" cellpadding="1">
																<tr>
																		<td colspan="2">
																				<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC">
																						<tr>
																								<td width="5%" bgcolor="#ECECEC">
																										<div align="center">削</div>
																								</td>
																								<td width="85%" bgcolor="#ECECEC">
																										<div align="left">フォルダ名</div>
																								</td>
																								<td width="10%" bgcolor="#ECECEC">
																										<div align="center">修正</div>
																								</td>
																						</tr>
																						<?php
				$flrows=0;
				while($fldata[$flrows]["dir_id"]!=NULL) {
				?>
																						<tr>
																								<td width="5%" bgcolor="#FFFFFF">
																										<div align="center">
																												<input name="delfile[]" type="checkbox" id="delfile[]" value="<?php echo $fldata[$flrows]["dir_id"] ?>" />
																												</div>
																								</td>
																								<td bgcolor="#FFFFFF"><a href="index.php?PID=files_cateup&amp;cate_id=<?php echo $fldata[$flrows]["dir_id"] ?>"><?php echo $fldata[$flrows]["dir_name"];?></a></td>
																								<td width="10%" bgcolor="#FFFFFF">
																										<input name="btm_up" type="button" id="btm_up" value="修正する" onclick="window.location.href='index.php?PID=files_cateup&amp;cate_id=<?php echo $fldata[$flrows]["dir_id"] ?>'" />
																								</td>
																						</tr>
																						<?php 
					$flrows++;
				}
				?>
																				</table>
																		</td>
																</tr>
																<tr>
																		<td height="17" colspan="2">&nbsp;</td>
																</tr>
																<tr>
																		<td width="50%" colspan="2">
																				<input name="btm_del" type="submit" id="btm_del" value="選択したフォルダを削除する" onclick="delchk(this.form)" />
																				<input name="btm_add" type="button" id="btm_add" value="フォルダを登録する" onclick="window.location.href='index.php?PID=files_cateadd'" />
																				<input name="mode" type="hidden" id="mode" />
																		</td>
																</tr>
														</table>
												</td>
										</tr>
								</table>
						</form>
				</td>
		</tr>
</table>
