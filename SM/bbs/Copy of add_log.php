<?php 

$bbsobj=new Cube_BBS($dbobj);

if($_REQUEST["mode"]=="addition") {
	$fupobj=new Upload();
	$fupobj->fdata=$_FILES["uploadfile"];
	$fupobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/files/";
	$fupobj->rpath="/tmp//files/";
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/files/");
	$upfile=$fupobj->Upfile("");
	$bbsobj->Add_Log($_REQUEST,$upfile);
}

$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->Get_UpSledList(5);
$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
$logdata=$bbsobj->Get_LastLogData($_REQUEST["sled_id"],3);

?><script language="javascript">
function datachk(frm) {
	var alertchk=0;
	var alerttxt="";
	
	if(frm.comment.value==null||frm.comment.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"本文を入力して下さい。\n";
	}
	
	
	if(alertchk==0) {
		res=confirm("この内容で作成してもよろしいですか？");
		if(res) {
			frm.mode.value="addition";
			frm.submit();
		}
	}
	else {
		alert(alerttxt);
	}
}

</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<div id="bbs">
	<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
		
		<tr>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
										<tr>
												<td width="4%"><img src="/GW/img/template/icon_bbs.jpg" width="40" height="42"></td>
												<td width="96%" class="title"><font color="#333333">BBS書き込み</font></td>
										</tr>
								</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		
		<tr>
			<td width="220" valign="top">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
									<td>
											<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
													<tr>
															<td>
																	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
																			<tr>
																					<td><strong><span class="subtitle">最近の書き込み</span></strong></td>
																			</tr>
																	</table>
															</td>
													</tr>
													<?php 
				$rows=0;
				while($updata2[$rows]["sled_id"]!=NULL) {
				?>
													<tr>
															<td bgcolor="#FFFFFF">
																	<table width="100%"  border="0" cellspacing="1" cellpadding="1">
																			<tr>
																					<td><?php echo str_replace("-",".",$updata2[$rows]["last_update"]); ?>
																									<?php
																if(time()-strtotime($updata2[$rows]["last_update"])<60*60*24*3) {
																?>
																									<font color="#FF0000"><strong>New!</strong></font>
																									<?php
																}
																?>
																					</td>
																			</tr>
																			<tr>
																					<td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata2[$rows]["sled_id"] ?>"><?php echo $updata2[$rows]["sled_name"] ?></a>(<?php echo $updata2[$rows]["maxcount"] ?>)</td>
																			</tr>
																	</table>
															</td>
													</tr>
													<?php 
					$rows++;
				}
				?>
											</table>
									</td>
							</tr>
							<tr>
									<td>&nbsp;</td>
							</tr>
							<tr>
									<td>
											<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
													<tr>
															<td bgcolor="#DCDCFF"><strong>テーマ一覧
																					<?php $updata=$bbsobj->Get_TehmaList2(10);  ?>
															</strong></td>
													</tr>
													<tr>
															<td valign="top" bgcolor="#FFFFFF">
																	<table width="100%" border="0" cellpadding="5" cellspacing="0">
																			<?php 
				$rows=0;
				while($updata[$rows]["sled_id"]!=NULL) {
				?>
																			<tr>
																					<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"><?php echo $updata[$rows]["sled_name"];?></a><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"> (
																											<?php
										$themamax=$dbobj->GetData("select count(sled_id) as maxcount from bbs_sled where parents=".$updata[$rows]["sled_id"]);							
																	 echo $themamax["maxcount"] ?>
																							) </a>
																									<div align="right"></div>
																					</td>
																			</tr>
																			<?php 				
					$rows++;
				}
				?>
																	</table>
															</td>
													</tr>
													<tr>
															<td valign="top" bgcolor="#FFFFFF"><a href="index.php?PID=add_theme"><img src="/GW/img/template/addthema.jpg" border="0"></a><br>
																	<a href="index.php?PID=bbs_allsled"><img src="/GW/img/template/display_allthema.jpg" width="169" height="23" border="0"></a></td>
													</tr>
											</table>
									</td>
							</tr>
					</table>
			</td>
			<td valign="top">
					<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
							<tr bgcolor="#DCDCFF">
									<td>
											<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
													<tr>
															<td height="40" bgcolor="#EFF6FF"><font color="#333333" class="sledtitle"><?php echo $sleddata["sled_name"];?></span>
																			
															</td>
													</tr>
													<tr>
															<td><span class="nickname"><?php echo $sleddata["master_name"]?></span><?php echo str_replace("-",".",$sleddata["registdate"]);?></td>
													</tr>
													<tr>
															<td bgcolor="#FFFFFF" class="comment">
																	<table width="100%" border="0" cellspacing="3" cellpadding="3">
																			<tr>
																					<td><?php echo $sleddata["master_comment"]?></td>
																			</tr>
																	</table>
															</td>
													</tr>
													<?php 
				$rows=0;
				while($logdata[$rows]["log_id"]!=NULL) {
				?>
													<tr>
															<td><?php echo $logdata[$rows]["writer"];?><?php echo str_replace("-",".",$logdata[$rows]["writetime"]);?></td>
													</tr>
													<tr>
															<td>
																	<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" bgcolor="#FFFFFF">
																			<tr>
																					<td width="100%" colspan="2" bgcolor="#FFFFFF" class="comment"><?php echo nl2br($logdata[$rows]["comment"]);?></td>
																			</tr>
																			<tr>
																					<td colspan="2">
																							<div align="right"></div>
																					</td>
																			</tr>
																	</table>
															</td>
													</tr>
													<?php 
					$rows++;
				}
				?>
													<tr>
															<td>&nbsp;</td>
													</tr>
													<tr>
															<td bgcolor="#FFFFFF">
																	<?php 
							if($_REQUEST["mode"]!="addition") {
							?>
																	<table width="100%"  border="0" cellspacing="1" cellpadding="2">
																			<form action="" method="post" enctype="multipart/form-data" name="form1">
																					
																					<tr>
																							<td><?php echo $logindata["member_name"] ?>　
																									<input name="writer" type="hidden" id="writer" value="<?php echo $logindata["member_name"] ?>　">
																									<br>
																									<input name="noname" type="checkbox" id="noname" value="1">
																									<font color="#FF0000">※
																										匿名を希望の方はこちらにチェックを入れてください。</font></td>
																					</tr>
																					
																					<tr>
																							<td bgcolor="#FFFFFF">
																									<textarea name="comment" rows="10" id="comment" style="width:98%;"></textarea>
																							</td>
																					</tr>
																					
																					<tr>
																							<td>添付</td>
																					</tr>
																					<tr>
																							<td>
																									<input name="uploadfile" type="file" id="uploadfile">
																							</td>
																					</tr>
																					<tr>
																							<td>
																									<input name="mode" type="hidden" id="mode">
																							</td>
																					</tr>
																					<tr>
																							<td>
																									<input name="btm_post" type="button" id="btm_post" value="投稿する" onClick="datachk(this.form)">
																							</td>
																					</tr>
																			</form>
																	</table>
																	<?php 
							}
							else {
							
							?>
																	<table width="100%"  border="0" cellspacing="2" cellpadding="2">
																			<form name="form1" method="post" action="">
																					<tr>
																							<td>&nbsp;</td>
																					</tr>
																					<tr>
																							<td>
																									<div align="center">以下の内容で投稿しました。</div>
																							</td>
																					</tr>
																					<tr>
																							<td>&nbsp;</td>
																					</tr>
																					<tr>
																							<td>名前</td>
																					</tr>
																					<tr>
																							<td><?php 
											if($_REQUEST["noname"]!=1) {
												echo $_REQUEST["writer"]; 
											}
											else {
												echo "匿名";
											}?>
																							</td>
																					</tr>
																					<tr>
																							<td>本文</td>
																					</tr>
																					<tr>
																							<td><?php echo nl2br($_REQUEST["comment"]);?></td>
																					</tr>
																					<tr>
																							<td>添付</td>
																					</tr>
																					<tr>
																							<td><?php echo $upfile[0]["filepath"]; ?></td>
																					</tr>
																					<tr>
																							<td>
																									<input type="button" name="Submit" value="テーマへ戻る"  onClick="location.replace('?PID=bbs_sled&sled_id=<?php echo $_REQUEST["sled_id"];?>');">
																							</td>
																					</tr>
																			</form>
																	</table>
																	<?php 
							}
							?>
															</td>
													</tr>
											</table>
											</td>
							</tr>
					</table>
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp; </td>
		</tr>
		<tr>
			<td colspan="2">&nbsp; </td>
		</tr>
	</table>
</div>
<?php 

?>
