<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<?php 
$bbsobj=new Cube_BBS($dbobj);
$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$logdata=$bbsobj->Get_DelLogData();

?>
<div id="bbs">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td colspan="2">
			<table width="100%" border="0" cellspacing="2" cellpadding="2">
            	<tr>
            		<td width="45"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_sic.gif" width="44" height="40"></td>
            		<td><div id="tree"><span class="top">BBS</span>　<span class="gt">>></span>　<span class="sub"><?php echo $sleddata["sled_name"] ?></span></div>
            		</td>
            		</tr>
            	</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="2">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td background="http://siteadmin.itcube.ne.jp/gw/img/bbs_mark_bg.gif">
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="20">&nbsp;</td>
								<td width="88"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_mark.gif" width="88" height="67"></td>
								<td>&nbsp;</td>
								<td width="311">
									<div align="right"><a href="index.php?PID=add_theme"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_btm_createtheme.gif" width="311" height="46" border="0"></a></div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td width="220" valign="top">
			<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="2">
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">&nbsp;</td>
								<td>&nbsp;</td>
								<td><span class="subtitle">　最近の書き込み</span></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="90%"  border="0" align="center" cellpadding="2" cellspacing="2" background="http://siteadmin.itcube.ne.jp/gw/img/bbs_new_bg.gif">
							<?php 
				$rows=0;
				while($updata2[$rows]["sled_id"]!=NULL) {
				?>
							<tr>
								<td>
									<table width="100%"  border="0" cellspacing="1" cellpadding="1">
										<tr>
											<td><?php echo $updata2[$rows]["last_update"] ?></td>
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
					<td colspan="2">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="10">&nbsp;</td>
								<td>&nbsp;</td>
								<td><span class="subtitle">　投稿テーマ</span>								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<table width="90%"  border="0" align="center" cellpadding="3" cellspacing="3">
							<?php 
				$rows=0;
				while($updata[$rows]["sled_id"]!=NULL) {
				?>
							<tr>
								<td> <a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"><?php echo $updata[$rows]["sled_name"] ?></a>(<?php echo $updata[$rows]["maxcount"] ?>)　 </td>
							</tr>
							<?php 
				
					$rows++;
				}
				?>
						</table>
					</td>
				</tr>
				<tr>
					<td width="10">&nbsp;</td>
					<td><img src="http://siteadmin.itcube.ne.jp/gw/img/right_cur.gif" width="14" height="12"><a href="index.php?PID=bbs_allsled">すべてのテーマを表示する</a></td>
				</tr>
			</table>
		</td>
		<td valign="top">
				<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="52%">&nbsp;</td>
								<td width="21%">
									<div align="right"></div>
								</td>
								<td width="27%">
									<div align="right"><a href="#"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_reload.gif" width="134" height="50" border="0" onClick="window.location.reload()"></a></div>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
				<?php 
				$rows=0;
				while($logdata[$rows]["log_id"]!=NULL) {
				?>
				<tr>
					<td>
						<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" background="http://siteadmin.itcube.ne.jp/gw/img/bbs_sled_bg2.gif">
							<tr>
								<td colspan="2">&nbsp;</td>
								</tr>
							<tr>
								<td width="53%"><span class="nickname"><?php echo $logdata[$rows]["writer"];?></span></td>
								<td width="47%">
									<div align="right"><?php echo $logdata[$rows]["writetime"];?></div>
								</td>
							</tr>
							<tr>
								<td colspan="2"><?php echo $logdata[$rows]["comment"];?></td>
							</tr>
							<tr>
								<td colspan="2">
									<?php
							if($logdata[$rows]["upfiles"]!=NULL) {
							?>
                                    <a href="<?php echo $logdata[$rows]["upfiles"]?>" target="_blank"><img src="http://siteadmin.itcube.ne.jp/gw/img/clip_sic.gif" width="16" height="20" border="0"></a>
                                    <?php
							}
							?>
                                    <a href="index.php?PID=del_log&sled_id=<?php echo $_REQUEST["sled_id"]?>&log_id=<?php echo $logdata[$rows]["log_id"];?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a> </td>
							</tr>
						</table>
						<br>
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
					<td>
						<table width="100%"  border="0" cellspacing="0" cellpadding="0">
                        	<tr>
                        		<td width="52%">&nbsp;</td>
                        		<td width="21%">
                        			<div align="right"></div>
                        			</td>
                        		<td width="27%">
                        			<div align="right"><a href="#"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_reload.gif" width="134" height="50" border="0" onClick="window.location.reload()"></a></div>
                        			</td>
                        		</tr>
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

?>
