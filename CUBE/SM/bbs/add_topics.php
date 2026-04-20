<?php 
$bbsobj=new Cube_BBS($dbobj);

if($_REQUEST["mode"]=="addtion") {
	$fupobj=new Upload();
	$fupobj->fdata=$_FILES["uploadfile"];
	$fupobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/files/";
	$fupobj->rpath="/tmp/files/";
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/files/");
	$upfile=$fupobj->Upfile("");
	$bbsobj->Add_Theme($_REQUEST,$upfile);
	?>
	<script language="javascript">
	location.replace("?PID=bbs_topics&sled_id=<?php echo $_REQUEST["sled_id"];?>");
	</script>
	<?php
}

$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);

?>
<script language="javascript">
function datachk(frm) {
	var alertchk=0;
	var alerttxt="";
	if(frm.sled_name.value==null||frm.sled_name.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"テーマ名を入力して下さい。\n";
	}
	
	if(frm.master_comment.value==null||frm.master_comment.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"本文を入力して下さい。\n";
	}
	
	
	if(alertchk==0) {
		res=confirm("この内容で作成してもよろしいですか？");
		if(res) {
			frm.mode.value="addtion";
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
			<form name="add_theme_form" method="post" action="">
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
												<td width="96%" class="title"><font color="#333333">新規テーマ作成</font></td>
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
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
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
				$bbsreadstatus[$rows]=$bbsobj->get_ReadCheck($updata2[$rows]["sled_id"],$logindata["member_id"]);
				?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                            <tr>
                                                <td><?php echo str_replace("-",".",$updata2[$rows]["last_update"]); ?>
                                                        <?php
																if($bbsreadstatus[$rows]["read_status"]!=1) {
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
                </table>
			</td>
			<td valign="top">
					<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
									<td width="10"><img src="img/template/bbs/thema_bg1.jpg" width="10" height="8"></td>
									<td background="img/template/bbs/thema_bg2.jpg"><img src="img/template/bbs/thema_bg2.jpg" width="262" height="8"></td>
									<td width="10"><img src="img/template/bbs/thema_bg3.jpg" width="10" height="8"></td>
							</tr>
							<tr>
									<td width="10" background="img/template/bbs/thema_bg4.jpg"><img src="img/template/bbs/thema_bg4.jpg" width="10" height="20"></td>
									<td background="img/template/bbs/thema_bg5.jpg" bgcolor="#ECECEC">
											<table width="100%"  border="0" cellpadding="0" cellspacing="0">
													<tr>
															<td><font color="#333333" class="sledtitle"><a name="topicstitle" href="#"><?php echo $sleddata["sled_name"];?></a></font></td>
															<td>
																	<div align="right"></div>
															</td>
													</tr>
											</table>
									</td>
									<td width="10" background="img/template/bbs/thema_bg6.jpg"><img src="img/template/bbs/thema_bg6.jpg" width="10" height="20"></td>
							</tr>
							<tr>
									<td width="10"><img src="img/template/bbs/thema_bg7.jpg" width="10" height="8"></td>
									<td background="img/template/bbs/thema_bg8.jpg"><img src="img/template/bbs/thema_bg8.jpg" width="262" height="8"></td>
									<td width="10"><img src="img/template/bbs/thema_bg9.jpg" width="10" height="8"></td>
							</tr>
					</table>
					<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
	<tr>
			<td>&nbsp;</td>
	</tr>
	<tr>
								<td bgcolor="#DCDCFF">
										<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0">
<?php 
						if($_REQUEST["mode"]!="addtion") {
						?>
												<tr>
														<td bgcolor="#EFF6FF">
																<table width="100%"  border="0" cellpadding="2" cellspacing="2">
																	
																				<tr>
																						<td><strong>タイトル</strong></td>
																				</tr>
																				<tr>
																						<td>
																								<input name="sled_name" type="text" id="sled_name" style="width:50%;" value="">
																						</td>
																				</tr>
								</table>
						</td>
				</tr>
												<tr>
														<td><?php echo $logindata["member_name"] ?>　
																<input name="master_name" type="hidden" id="master_name" value="<?php echo $logindata["member_name"] ?>　">
																<br>
																<input name="noname" type="checkbox" id="noname" value="1">
																<font color="#FF0000">※ 匿名を希望の方はこちらにチェックを入れてください。</font></td>
												</tr>
												<tr>
														<td>
																<table width="100%"  border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																				<tr>
																						<td>本文</td>
																				</tr>
																				<tr>
																						<td>
																								<textarea name="master_comment" rows="10" id="master_comment" style="width:90%;"></textarea>
																						</td>
																				</tr>
																				<tr>
																						<td>添付</td>
																				</tr>
																				<tr>
																						<td>
																								<input name="uploadfile" type="file" id="uploadfile">
																								<input name="mode" type="hidden" id="mode">
																								<input name="sled_id" type="hidden" id="sled_id" value="<?php echo $_REQUEST["sled_id"];?>">
																						</td>
																				</tr>
																				<tr>
																						<td>
																								<input name="btm_post" type="button" id="btm_post" value="書き込む" onClick="datachk(this.form)">
																								<input type="button" name="Submit" value="戻る" onClick="history.back()">
																						</td>
																				</tr>
																</table>
														</td>
												</tr>
												<?php 
							}
							else {
							?><tr>
														<td>
																<table width="100%"  border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																				<tr>
																						<td>&nbsp;</td>
																				</tr>
																				<tr>
																						<td>
																								<div align="center">以下の内容でテーマを追加しました。</div>
																						</td>
																				</tr>
																				<tr>
																						<td>&nbsp;</td>
																				</tr>
																</table>
														</td>
												</tr>
												<tr>
														<td bgcolor="#EFF6FF">
																<table width="100%"  border="0" cellpadding="2" cellspacing="2">
																				<tr>
																						<td>テーマ名</td>
																				</tr>
																				<tr>
																						<td> <?php echo $_REQUEST["sled_name"]; ?> </td>
																				</tr>
																</table>
														</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td bgcolor="#FFFFFF">
																<table width="100%"  border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																		<tr>
																				<td>本文</td>
																		</tr>
																		<tr>
																				<td>
																						<?php 
											echo nl2br($_REQUEST["master_comment"]);
											?>
																				</td>
																		</tr>
																		<tr>
																				<td>添付</td>
																		</tr>
																		<tr>
																				<td><?php echo $upfile[0]["filepath"]; ?></td>
																		</tr>
																</table>
														</td>
												</tr>
												<?php
							}
							?>
		</table>
								</td>
						</tr>
				</table>
				</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp; </td>
		</tr></form>
	</table>
</div>
<?php 

?>
