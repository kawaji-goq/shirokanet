<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
$bbsobj=new Cube_BBS($dbobj);
$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->Get_UpSledList(5);
?>
<div id="bbs">
	<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
		
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td background="http://siteadmin.itcube.ne.jp/gw/img/bbs_mark_bg.gif">
							<table width="100%"  border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="20">&nbsp;</td>
									<td width="92"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_mark.gif" width="88" height="67"></td>
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
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>
				<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="69">&nbsp;</td>
						<td>　<span class="subtitle">最近の書き込み</span></td>
						<td width="135">
							<div align="right"><a href="#"><img src="http://siteadmin.itcube.ne.jp/gw/img/bbs_reload.gif" width="134" height="50" border="0" onClick="window.location.reload()"></a></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="90%"  border="0" align="center" cellpadding="5" cellspacing="5" background="http://siteadmin.itcube.ne.jp/gw/img/bbs_new_bg.gif">
					<?php 
				$rows=0;
				while($updata2[$rows]["sled_id"]!=NULL) {
				?>
					<tr>
						<td width="24%"><?php echo $updata2[$rows]["last_update"]; ?></td>
						<td width="29%"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata2[$rows]["sled_id"]; ?>"><?php echo $updata2[$rows]["sled_name"] ?></a>(<?php echo $updata2[$rows]["maxcount"] ?>)</td>
						<td width="47%"><?php echo $updata2[$rows]["last_name"] ?></td>
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
			<td align="left">
					<table width="100%"  border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td width="20">&nbsp;</td>
						<td width="69">&nbsp;</td>
						<td>　<span class="subtitle">投稿テーマ</span>
							<div align="right"></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="90%"  border="0" align="center" cellpadding="5" cellspacing="5">
					<tr>
						<td width="100%">
							<?php 
				$rows=0;
				while($updata[$rows]["sled_id"]!=NULL) {
				?>
							<a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata2[$rows]["sled_id"] ?>"><?php echo $updata[$rows]["sled_name"] ?></a>(<?php echo $updata[$rows]["maxcount"] ?>)　
							<?php 
				
					$rows++;
				}
				?>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>
