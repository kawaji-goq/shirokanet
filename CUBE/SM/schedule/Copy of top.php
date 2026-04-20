<?php

/*
if($_REQUEST["subm"]=="送信する") {
	$fp=ftp_connect("localhost");
	if($fp) {
		echo "サーバーに接続しました。<br>";
		$ftphd=ftp_login($fp,"takken-iwakuni","vh47JEbv");
		if($ftphd) {
			echo "認証に成功しました。<br>";
			$res=ftp_chdir($fp,"/httpdocs/members/tmp/file");
			//ftp_put($fp,"ugau.jpg",$_REQUEST["file1"],FTP_BINARY);
			$dirlist=ftp_nlist($fp,"./");
			print_r($dirlist);
		}
		else {
			echo "認証に失敗しました。<br>";
		}
	}
	else {
		echo "サーバーの接続に失敗しました。<br>";
	}
}

//print_r($_REQUEST);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
*/

if($_REQUEST["y"]==NULL) {
	$_REQUEST["y"]=date("Y",time());
}
if($_REQUEST["m"]==NULL) {
	$_REQUEST["m"]=date("m",time());
}
$scheobj=new Schedule($dbobj);

$schedata=$scheobj->GetList($_REQUEST["y"],$_REQUEST["m"]);

$calobj=new Calendar();
$calobj->year=$_REQUEST["y"];
$calobj->month=$_REQUEST["m"];
$caldata=$calobj->Create(2);
$wday=$calobj->e_wday;

?>
<div id="files">
	<table width="750"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td align="left" valign="middle"> </td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td width="45"><img src="/members/img/sche_sic.gif" width="42" height="38"></td>
						<td>
							<div id="tree"><span class="top">スケジュール</span>　<span class="gt">>></span>　<span class="sub"><?php echo $_REQUEST["y"]."年".$_REQUEST["m"]."月のスケジュール"; ?></span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">&nbsp;</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<div id="calender">
					<table width="735"  border="0" align="center" cellpadding="1" cellspacing="1" class="tb_outline">
						<tr align="center" class="title">
							<td width="100" height="30" class="holiday"><?php echo $wday[0];?> </td>
							<td width="100" height="30" class="nday"><?php echo $wday[1];?> </td>
							<td width="100" height="30" class="nday"><?php echo $wday[2];?> </td>
							<td width="100" height="30" class="nday"><?php echo $wday[3];?> </td>
							<td width="100" height="30" class="nday"><?php echo $wday[4];?> </td>
							<td width="100" height="30" class="nday"><?php echo $wday[5];?> </td>
							<td width="100" height="30" class="satday"><?php echo $wday[6];?> </td>
						</tr>
						<?php 
					$rows=0;
					while($caldata[$rows][0]["day"]!=NULL) {
					?>
						<tr>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][0]["day"];?> </span></td>
									    <td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][0]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][0]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][0]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][0]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?> </td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
									    <td width="10%">
									    	<div align="right"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][1]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></div>
									    </td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][1]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][1]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][1]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
									    <td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][2]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][2]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][2]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][2]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
									    <td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][3]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][3]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][3]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][3]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
									    <td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][4]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][4]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][4]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][4]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
									    <td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][5]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][5]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][5]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][5]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
							<td height="75" valign="top" class="box">
								<table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
									<tr>
										<td width="91%" height="20"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
									    <td width="9%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&rdate=<?php echo $caldata[$rows][6]["eday"];?>'"><img src="/admin/img/sche_ssic.gif" width="21" height="15" border="0"></a></td>
									</tr>
									<tr valign="top">
										<td colspan="2">
											<table width="100%"  border="0" cellspacing="0" cellpadding="0">
												<?php 
												$r2=0;
												while($schedata[($caldata[$rows][6]["eday"])][$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[($caldata[$rows][6]["eday"])][$r2];
												?>
												<tr>
													<td>・<a href="index.php?PID=sche_up&sche_id=<?php echo $schedata[($caldata[$rows][6]["eday"])][$r2]["schedule_id"] ?>"><?php echo $schedata2["title"];?></a></td>
												</tr>
												<tr>
													<td><?php echo $schedata2["stime"]."〜".$schedata2["ftime"]; ?></td>
												</tr>
												<?php 
													$r2++;
												}
												?>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<?php
					$rows++; 
					}?>
						<tr>
							<td colspan="7"><a href="index.php?PID=schedule&y=<?php echo $calobj->r_year; ?>&m=<?php echo $calobj->r_month; ?>">&lt;&lt;前の月</a>　<a href="index.php?PID=schedule&y=<?php echo $calobj->n_year; ?>&m=<?php echo $calobj->n_month; ?>">次の月 &gt;&gt;</a> </td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>
