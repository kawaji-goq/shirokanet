<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<?php 
$bbsobj=new Cube_BBS($dbobj);
$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);

$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
$sledlist=$bbsobj->Get_TopicsList($_REQUEST["sled_id"]);
$topicslist=$bbsobj->Get_TopicsList($_REQUEST["sled_id"]);
//$logdata=$bbsobj->Get_LogData($_REQUEST["sled_id"],20,$pagenum,$searkey);

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
											<td width="96%" ><font color="#333333">BBS　<?php echo $sleddata["sled_name"];?></font></td>
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
																<div align="right"><a href="?PID=bbs_allsled"><img src="img/template/bbs/thema_list.gif" width="76" height="23" border="0"></a></div>
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
				<br>
				<table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
						<tr>
								<td bgcolor="#DCDCFF"><span class="subtitle"><strong><?php echo $sleddata["sled_name"];?></strong></span><strong>のトピックス一覧</strong></td>
						</tr>
						<tr>
								<td valign="top" bgcolor="#FFFFFF">
										<table width="100%" border="0" cellpadding="5" cellspacing="0">
												<tr>
														<td width="31%" nowrap bgcolor="#ececec">トピックス</td>
														<td width="14%" nowrap bgcolor="#ececec">トピックス作成者</td>
														<td width="10%" nowrap bgcolor="#ececec">最終書込者</td>
														<td width="7%" nowrap bgcolor="#ececec">
																<div align="right">書込数</div>
														</td>
														<td width="28%" nowrap bgcolor="#ececec">
																<div align="right">最終書込日時</div>
														</td>
														<td width="5%" nowrap bgcolor="#ececec">
														    <div align="center">編集</div>
														</td>
														<td width="5%" nowrap bgcolor="#ececec">
																<div align="center">削除</div>
														</td>
												</tr>
											<?php 

				for($topi=0;$sledlist[$topi]["sled_id"]!=NULL;$topi++) {
				?>
												<tr>
														<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><?php echo $sledlist[$topi]["sled_name"];?>
																		
</a><?php
				$bbsreadstatus[$topi]=$bbsobj->get_ReadCheck($sledlist[$topi]["sled_id"],$logindata["member_id"]);

																if($bbsreadstatus[$topi]["read_status"]!=1) {
																?>
																		<font color="#FF0000"><strong>New!</strong></font>
																		<?php
																}
																?></td>
														<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><?php echo $sledlist[$topi]["master_name"];?></a></td>
														<td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><?php echo $sledlist[$topi]["last_name"];?></a></td>
														<td bgcolor="#FFFFFF">
																<div align="right"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><?php echo $sledlist[$topi]["maxcount"] ?></a></div>
														</td>
														<td bgcolor="#FFFFFF">
																<div align="right"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><?php echo str_replace("-",".",$sledlist[$topi]["last_update"]) ?></a></div>
														</td>
													<td bgcolor="#FFFFFF">
												    <div align="center"><a href="?PID=up_topics&sled_id=<?php echo $sledlist[$topi]["sled_id"];?>">
														        
													        <img src="img/template/bbs/edit.gif" width="15" height="16" border="0"></a></div>
														    </td>
														<td bgcolor="#FFFFFF">
														    <div align="center"><a href="?PID=del_topics&sled_id=<?php echo $sledlist[$topi]["sled_id"] ?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div>
														</td>
												</tr>
															<?php 				
				}
				?>
										<tr>
														<td colspan="7" bgcolor="#FFFFFF">
																<div align="right"><a href="index.php?PID=bbs_addtopics&sled_id=<?php echo $_REQUEST["sled_id"];?>"><img src="img/template/bbs/new_topics.gif" width="106" height="29" border="0"></a></div>
														</td>
											</tr>
									</table>
								</td>
						</tr>
				</table>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <?php 
							$maxpage=$bbsobj->get_PagerData("topics_max");
							if($maxpage==NULL) {
								$maxpage=1;
							}
							if($_GET["PAGE"]!=NULL&&$_GET["PAGE"]!=1) { ?>
                                <a href="?PID=bbs_topics&sled_id=<?php echo $_GET["sled_id"];?>&PAGE=<?php echo $_GET["PAGE"]-1; ?>">
                                <?php }?>
＜＜前のページ　
<?php if($_GET["PAGE"]!=NULL&&$_GET["PAGE"]!=1) { ?>
                                </a>
                                <?php }?>
                                <?php
								for($p=1;$p<=$maxpage;$p++) {
									if($p==$_GET["PAGE"]) {
										echo '<strong> '.$p." </strong>";
									}else {
								?>
                                <a href="?PID=bbs_topics&sled_id=<?php echo $_GET["sled_id"];?>&&PAGE=<?php echo $p; ?>"><?php echo $p; ?></a>
                                <?php  }} ?>
                                <?php if($_GET["PAGE"]!=$maxpage) {?>
                                <a href="?PID=bbs_topics&sled_id=<?php echo $_GET["sled_id"];?>&PAGE=<?php echo $_GET["PAGE"]+1; ?>">
                                <?php }?>
　次のページ＞＞
<?php if($_GET["PAGE"]>=$maxpage) {?>
                                </a>
                                <?php }?>
</div>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                </table>
				<?php 

				for($topi=0;$sledlist[$topi]["sled_id"]!=NULL;$topi++) {
				$sleddata[$topi]=$bbsobj->Get_SledData($sledlist[$topi]["sled_id"]);
				$logdata[$topi]=$bbsobj->Get_LogData($sledlist[$topi]["sled_id"],9999,$pagenum,$searkey);
				?>
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
														<td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"><font color="#333333" class="sledtitle"><?php echo $sleddata[$topi]["sled_name"];?></font></a></td>
														<td>
																<div align="right"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"></a><a href="index.php?PID=add_log&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>&res_id=1"><img src="img/template/bbs/new_topics.gif" width="106" height="29" border="0"></a></div>
														
																<div align="right"></div>
														</td>
											</tr>
										</table>
										<div align="right"></div>
								</td>
								</tr>
							<tr>
								<td><?php echo $sleddata[$topi]["master_name"]?><?php echo str_replace("-",".",$sleddata[$topi]["registdate"]);?></td>
							</tr>
							<tr>
									<td bgcolor="#FFFFFF">
											<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
													<tr>
															<td colspan="2" class="comment"><?php echo nl2br($sleddata[$topi]["master_comment"])?>&nbsp;</td>
													</tr>
										<tr>
															<td colspan="2">
																	<div align="right"><a href="?PID=up_topics&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a><?php 
							if($sleddata[$topi]["upfiles"]!=NULL){
							?>
																			<a href="<?php echo $sleddata[$topi]["upfiles"]?>" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" alt="添付ファイルを表示する" width="16" height="20" border="0"></a>
																<?php 
							}
							?><a href="index.php?PID=del_log&sled_id=<?php echo $sleddata[$topi]["sled_id"]?>&log_id=<?php echo $logdata[$topi][$rows]["log_id"];?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
															</td>
												</tr>
											</table>
									</td>
							</tr>
											<?php 
				$rows=0;
				while($logdata[$topi][$rows]["log_id"]!=NULL) {
				?>			
											<tr>
													<td><?php echo $logdata[$topi][$rows]["writer"];?><?php echo str_replace("-",".",$logdata[$topi][$rows]["writetime"]);?></td>
											</tr>
											<tr>
					<td>
						<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
							
							<tr>
								<td width="100%" colspan="2" bgcolor="#FFFFFF" class="comment"><?php echo nl2br($logdata[$topi][$rows]["comment"]);?></td>
							</tr>
							<tr>
								<td colspan="2">
										<div align="right">
												<a href="index.php?PID=add_log&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>&res_id=<?php echo $logdata[$topi][$rows]["log_num"];?>"><img src="/CUBE_IMG/btn_reply_s_over.gif" width="76" height="26" border="0"></a><a href="?PID=up_log&log_id=<?php echo $logdata[$topi][$rows]["log_id"];?>&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a><?php
							if($logdata[$topi][$rows]["upfiles"]!=NULL) {
							?>
												<a href="<?php echo $logdata[$topi][$rows]["upfiles"]?>" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" width="16" height="20" border="0"></a>
												<?php
							}
							?><a href="index.php?PID=del_log&sled_id=<?php echo $sleddata[$topi]["sled_id"]?>&log_id=<?php echo $logdata[$topi][$rows]["log_id"];?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
								</td>
							</tr>
							<tr>
							    <td colspan="2"><?php echo $bbsobj->get_SubLogList($logdata[$topi][$rows]["sled_id"] ,$logdata[$topi][$rows]["log_num"],""); ?></td>
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
			</table><?php }?>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
</table>
</div>
<?php 

?>
