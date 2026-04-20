<?php
//print_r($_REQUEST);
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


$flobj=new Files($dbobj);
	$delrows=0;
	while($_REQUEST["delfile"][$delrows]!=NULL) {
		$delsql="delete from files where file_path = '".$_REQUEST["delfile"][$delrows]."'";
		$result=$dbobj->Query($delsql);
		if($result) {
			@unlink($_REQUEST["delfile"][$delrows]);
		}
		$delrows++;
	}
	

$fldata=$flobj->Get_CateList();
$fdata=$flobj->GetFileList($_REQUEST["dir_id"]);
$fcdata=$flobj->Get_CateData($_REQUEST["dir_id"]);
?>
<script language="javascript">
function delchk(frm) {
	res=confirm("選択したファイルを削除してもよろしいですか？");
	
	if(res) {
		frm.mode.value="delete";
		frm.submit();
	}
	
}
</script>
<div id="files">
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
												<td bgcolor="#DCDCFF"><strong>ファイル一覧</strong></td>
										</tr>
										<tr>
												<td height="100" valign="top" bgcolor="#FFFFFF">
														<table width="100%"  border="0" cellspacing="1" cellpadding="1">
																<tr>
																		<td colspan="2">
																				<table width="100%"  border="0" cellpadding="5" cellspacing="0" bgcolor="#CCCCCC">
																						<tr>
																								<td width="5%" nowrap bgcolor="#ececec">
																										<div align="center">削</div>
																								</td>
																								<td width="41%" nowrap bgcolor="#ececec">
																										<div align="left">ファイル名</div>
																								</td>
																								<td width="15%" nowrap bgcolor="#ececec">
																										<div align="left">サイズ</div>
																								</td>
																								<td width="20%" nowrap bgcolor="#ececec">
																										<div align="left">登録日時</div>
																								</td>
																								<td width="12%" nowrap bgcolor="#ececec">
																										<div align="center">ダウンロード</div>
																								</td>
																								<td width="7%" nowrap bgcolor="#ececec">
																										<div align="center">修正</div>
																								</td>
																						</tr>
																						<?php 
											$frows=0;
											while($fdata[$frows]["files_id"]!=NULL) {
											?>
																						<tr>
																								<td align="center" bgcolor="#FFFFFF">
																										<div align="center">
																												<input name="delfile[]" type="checkbox" id="delfile[]" value="<?php echo $fdata[$frows]["file_path"] ?>">
																										</div>
																								</td>
																								<td align="left" bgcolor="#FFFFFF"><?php echo $fdata[$frows]["files_name"] ?></td>
																								<td align="left" bgcolor="#FFFFFF"><?php echo number_format($fdata[$frows]["files_size"]/1000,2) ?>MB</td>
																								<td align="left" bgcolor="#FFFFFF"><?php echo $fdata[$frows]["registdate"] ?></td>
																								<td bgcolor="#FFFFFF">
																										<table  border="0" align="center" cellpadding="0" cellspacing="0">
																												<tr>
																														<td>
																																<div align="center">
																																		<?php 
													
													switch($fdata[$frows]["file_type"]) {
														case "jpg":
															$viewicon="http://".$_SESSION["DomainData"]["domain_name"].$fdata[$frows]["file_path"];
															break;
														case "gif":
															$viewicon="http://".$_SESSION["DomainData"]["domain_name"].$fdata[$frows]["file_path"];
															break;
														case "png":
															$viewicon="http://".$_SESSION["DomainData"]["domain_name"].$fdata[$frows]["file_path"];
															break;
														case "bmp":
															$viewicon="http://".$_SESSION["DomainData"]["domain_name"].$fdata[$frows]["file_path"];
															break;
														case "doc":
															$viewicon="http://siteadmin.itcube.ne.jp/img/word.gif";
															break;
														case "xls":
															$viewicon="http://siteadmin.itcube.ne.jp/img/excel.gif";
															break;
														case "pdf":
															$viewicon="http://siteadmin.itcube.ne.jp/img/pdf.gif";
															break;
														default:
															$viewicon="http://siteadmin.itcube.ne.jp/gw/img/file_ic.gif";
															break;
														}	
													?>
																																<a href="<?php echo "http://".$_SESSION["DomainData"]["domain_name"].$fdata[$frows]["file_path"]; ?>" target="_blank" type="application/x-msdownload"><img src="<?php echo $viewicon; ?>" alt="<?php echo $fdata[$frows]["files_name"] ?>" width="50" border="0" /></a></div>
																														</td>
																												</tr>
																										</table>
																								</td>
																								<td bgcolor="#FFFFFF">
																										<div align="center">
																												<input name="btm_up" type="button" id="btm_up" value="修正" onClick="window.location.href='index.php?PID=files_up&files_id=<?php echo $fdata[$frows]["files_id"];?>'">
																										</div>
																								</td>
																						</tr>
																						<?php 
												$frows++;
											}
											?>
																				</table>
																		</td>
																</tr>
																<tr>
																		<td height="17" colspan="2"><strong><font color="#<?php 
																				if($sumsize<50000) {
																					echo "003300";
																				}
																				else {
																					echo "FF0000";
																				}
																				?>">現在 50 MB 中 <?php echo number_format((($sumsize/1000)),2); ?> MB (<?php echo  number_format(($sumsize*100/50000),2); ?> %) を使用しています。
																																		  <?php 
if($sumsize>50000){
?>
                                    <font color="#FF0000"><strong>容量をオーバーしていますのでファイルを変更できません。<br>
登録・修正する場合は不要なファイルを削除してください。</strong></font><br>
<?php
}
?>
</font></strong></td>
																</tr>
																<tr>
																		<td width="50%" colspan="2">
																				<input name="btm_del" type="submit" id="btm_del" value="選択したファイルを削除する" onclick="delchk(this.form)" />
																				<?php 
																				if($sumsize<50000) {
																				?>
																				<input name="btm_add" type="button" id="btm_add" value="ファイルを登録する" onclick="window.location.href='index.php?PID=files_add'" />
																				<?php 
																				}
																				?><input name="mode" type="hidden" id="mode">
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
</div>
