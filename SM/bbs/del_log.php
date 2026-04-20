<?php 

$bbsobj=new Cube_BBS($dbobj);

if($_REQUEST["mode"]=="addition") {
	$fupobj=new Upload();
	$fupobj->fdata=$_FILES["uploadfile"];
	$upfile=$fupobj->Upfile();
	$bbsobj->Add_Log($_REQUEST,$upfile);
}

$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
$logdata=$bbsobj->Get_SelLog($_REQUEST["log_id"]);

?><script language="javascript">

function datachk(frm) {
	var alertchk=0;
	var alerttxt="";
	
	if(frm.comment.value==null||frm.comment.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"本文を入力して下さい。\n";
	}
	
	if(frm.writer.value==null||frm.writer.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"名前を入力してください。";
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

function delchk(frm) {
	alerttxt="";
	alertchk=0;
	if(frm.del_name.value=="") {
		alerttxt="お名前が入力されていません\n";
		alertchk=1;
	}
	if(frm.del_reason.value=="") {
		alerttxt=alerttxt+"削除依頼の理由が入力されていません\n";
		alertchk=1;
	}
	
	if(alertchk==0) {
		res=confirm("この内容で削除依頼を送信してよろしいですか？");
		if(res) {
			frm.mode.value="del_logs";
			frm.submit();
		}
	}
	else {
		alert(alerttxt);
	}
	
}
</script>
<script language="javascript">

function datachk(frm) {
	var alertchk=0;
	var alerttxt="";
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
function delchk(frm) {
	alerttxt="";
	alertchk=0;
	if(alertchk==0) {
		res=confirm("この内容で削除を送信してよろしいですか？");
		if(res) {
			frm.mode.value="del_logs";
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
				<td colspan="2">&nbsp; </td>
		</tr>
		<tr>
			<td colspan="2">
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
							<tr>
									<td width="4%"><img src="/GW/img/template/icon_bbs.jpg" width="40" height="42"></td>
									<td width="96%" class="title"><font color="#333333">BBS書き込み削除</font></td>
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
				<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
						<tr>
								<td valign="top" bgcolor="#DCDCFF">
										<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
												<tr>
														<td height="40" bgcolor="#EFF6FF">
																<font color="#333333" class="sledtitle"><?php echo $sleddata["sled_name"];?></font></td>
												</tr>
												<tr>
														<td><?php echo $sleddata["master_name"]?><?php echo str_replace("-",".",$sleddata["registdate"]);?></td>
												</tr>
												<tr>
														<td bgcolor="#FFFFFF">
																<table width="100%" border="0" cellspacing="3" cellpadding="3">
																		<tr>
																				<td><?php echo $sleddata["master_comment"]?></td>
																		</tr>
																</table>
																</td>
												</tr>
												<?php 
								?><tr>
														<td><?php echo $logdata["writer"];?><?php echo str_replace("-",".",$logdata["writetime"]);?></td>
												</tr>
												<?php 
							if($_REQUEST["mode"]!="del_logs") {
							?>
												<tr>
														<form name="delform" method="post" action=""><td bgcolor="#FFFFFF">
																<table width="100%" border="0" cellspacing="3" cellpadding="3">
																		<tr>
																				<td><?php echo nl2br($logdata["comment"]);?></td>
																		</tr>
																		<tr>
																				<td>
																						<input type="button" name="Submit" value="削除する" onClick="delchk(this.form)">
																						<input type="button" name="Submit" value="戻る" onClick="location.replace('?PID=bbs_sled&sled_id=<?php echo $_REQUEST["sled_id"];?>')">
																						<input name="mode" type="hidden" id="mode">
																						<input name="member_name" type="hidden" id="member_name" value="<?php echo $logindata["member_name"];?>">
																						<input name="log_num" type="hidden" id="log_num" value="<?php echo $logdata["log_num"];?>">
																						<input name="log_id" type="hidden" id="log_id" value="<?php echo $logdata["log_id"];?>">
																						<input name="sled_id" type="hidden" id="sled_id" value="<?php echo $sleddata["sled_id"];?>">
																						<input name="sled_name" type="hidden" id="sled_name" value="<?php echo $sleddata["sled_name"];?>">
																						<input name="writer" type="hidden" id="writer" value="<?php echo $logdata["writer"];?>">
</td>
																		</tr>
																</table>
																</td>
														</form>
												</tr>
											<?php 
							}
							else {
								$bbsobj->Del_Log($_POST["log_id"]);
								
							?><script language="javascript">location.replace('?PID=bbs_sled&sled_id=<?php echo $_REQUEST["sled_id"];?>');</script>	<tr>
														<td bgcolor="#FFFFFF">
																<table width="100%" border="0" cellspacing="2" cellpadding="2">
																		<tr>
																				<td width="100%">&nbsp;</td>
																		</tr>
																		<tr>
																				<td>記事を削除しました。</td>
																		</tr>
																		<tr>
																				<td>&nbsp;</td>
																		</tr>
																		<tr>
																				<td>
																						<input type="button" name="Submit" value="戻る" onClick="location.replace('?PID=bbs_sled&sled_id=<?php echo $_REQUEST["sled_id"];?>')">
																				</td>
																		</tr>
																</table>
														</td>
												</tr>
							<?php
							}
							?>
												<?php
							?>
												<?php 
				?>
										</table>
								</td>
						</tr>
				</table>
				</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp; </td>
		</tr>
	</table>
</div>
<?php 

?>
