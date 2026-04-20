<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<?php 
$bbsobj=new Cube_BBS($dbobj);
$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
$logdata=$bbsobj->Get_LogData($_REQUEST["sled_id"],9999,$pagenum,$searkey);
$psleddata=$bbsobj->Get_SledData($sleddata["parents"]);

$bbsstatus=$bbsobj->get_ReadCheck($sleddata["sled_id"],$logindata["member_id"]);

?>
<div id="bbs">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
	
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td background="

BBS投稿テーマ一覧

">
							<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
									<tr>
											<td width="4%"><img src="/GW/img/template/icon_bbs.jpg" width="40" height="42"></td>
											<td width="96%" ><font color="#333333">BBS　</font><a href="?PID=bbs_topics&sled_id=<?php echo $psleddata["sled_id"];?>"><font color="#0000FF"><?php echo $psleddata["sled_name"];?></font></a>　＞　<font color="#333333"><?php echo $sleddata["sled_name"];?></font></td>
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
													<td><font color="#333333" class="sledtitle"><a href="?PID=bbs_topics&sled_id=<?php echo $psleddata["sled_id"];?>"><?php echo $psleddata["sled_name"];?></a></font></td>
													<td>
															<div align="right"><a href="?PID=bbs_topics&sled_id=<?php echo $psleddata["sled_id"];?>"><img src="img/template/bbs/backlist.gif" width="76" height="23" border="0"></a></div>
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
			<table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
				
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr>
					<td bgcolor="#DCDCFF">
							<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
							<tr>
								<td height="40" bgcolor="#EFF6FF">
										<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#EFF6FF">
												<tr>
														<td><font color="#333333" class="sledtitle"><?php echo $sleddata["sled_name"];?></font></td>
														<td>
																<div align="right"><a href="index.php?PID=add_log&sled_id=<?php echo $_REQUEST["sled_id"];?>"></a><a href="index.php?PID=add_log&sled_id=<?php echo $_REQUEST["sled_id"];?>&res_id=1"><img src="img/template/bbs/new_topics.gif" width="106" height="29" border="0"></a></div>
														
																<div align="right"></div>
														</td>
											</tr>
										</table>
										<div align="right"></div>
								</td>
								</tr>
							<tr>
								<td><?php echo $sleddata["master_name"]?><?php echo str_replace("-",".",$sleddata["registdate"]);?></td>
							</tr>
							<tr>
									<td bgcolor="#FFFFFF">
											<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
													<tr>
															<td colspan="2" class="comment"><?php echo nl2br($sleddata["master_comment"])?>&nbsp;</td>
													</tr>
										<tr>
															<td colspan="2">
																	<div align="right"><a href="?PID=up_topics&sled_id=<?php echo $sleddata["sled_id"];?>"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a><?php 
							if($sleddata["upfiles"]!=NULL){
							?>
																			<a href="<?php echo $sleddata["upfiles"]?>" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" alt="添付ファイルを表示する" width="16" height="20" border="0"></a>
																<?php 
							}
							?><a href="index.php?PID=del_topics&sled_id=<?php echo $_REQUEST["sled_id"]?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
															</td>
													</tr>
											</table>
									</td>
							</tr>
											<?php 
				$rows=0;
				while($logdata[$rows]["log_id"]!=NULL) {
				?>			
											<tr>
													<td><?php echo $logdata[$rows]["writer"];?><?php echo str_replace("-",".",$logdata[$rows]["writetime"]);?><?php if(strtotime($bbsstatus["lastreadtime"])-strtotime($logdata[$rows]["writetime"])<0||$bbsstatus["lastreadtime"]==NULL) { echo '   <font color="#FF0000"><strong>New!</strong></font>';}?></td>
											</tr>
											<tr>
					<td>
						<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
							
							<tr>
								<td width="100%" colspan="2" bgcolor="#FFFFFF" class="comment"><?php echo nl2br($logdata[$rows]["comment"]);?></td>
							</tr>
							<tr>
								<td colspan="2">
										<div align="right">
												<a href="index.php?PID=add_log&sled_id=<?php echo $_REQUEST["sled_id"];?>&res_id=<?php echo $logdata[$rows]["log_num"];?>"><img src="/CUBE_IMG/btn_reply_s_over.gif" width="76" height="26" border="0"></a><a href="?PID=up_log&log_id=<?php echo $logdata[$rows]["log_id"];?>&sled_id=<?php echo $_REQUEST["sled_id"];?>"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a><?php
							if($logdata[$rows]["upfiles"]!=NULL) {
							?><a href="<?php echo $logdata[$rows]["upfiles"]?>" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" width="16" height="20" border="0"></a><?php
							}
							?><a href="index.php?PID=del_log&sled_id=<?php echo $_REQUEST["sled_id"]?>&log_id=<?php echo $logdata[$rows]["log_id"];?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
								</td>
							</tr>
							<tr>
							    <td colspan="2"><?php echo $bbsobj->get_SubLogList($logdata[$rows]["sled_id"] ,$logdata[$rows]["log_num"],""); ?></td>
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
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
</div>
<?php 
$bbsobj->set_ReadCheck($sleddata["sled_id"],$logindata["member_id"],1);
?>
<?php 

?>
