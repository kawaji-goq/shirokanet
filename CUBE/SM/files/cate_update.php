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
$flobj=new Files($dbobj);

if($_REQUEST["mode"]=="update") {
	$result=$flobj->Update_Cate($_POST);
	?>
			<script language="javascript">
	window.location.replace("index.php?PID=files_cate&cate_id=<?php echo $_REQUEST["parents_id"];?>");
																</script>
	<?php
}

$fldata=$flobj->Get_CateList();
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<script language="javascript">
function datachk(frm) {
	if(frm.dir_name.value!=null&&frm.dir_name.value!="") {
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			frm.mode.value="update";
			frm.submit();
		}
	}
	else {
		alert("フォルダ名が入力されていません。");
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
										<table width="100%"  border="0" cellspacing="1" cellpadding="1">
												<tr>
														<td valign="top">
																<table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
																		<tr>
																				<td bgcolor="#DCDCFF">
																						<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="0">
																								<?php 
						if($_REQUEST["mode"]!="addtion") {
						?>
																								<tr>
																										<td>
																												<table width="100%"  border="0" cellpadding="2" cellspacing="2" bgcolor="#EFF6FF">
																														<tr>
																																<td><strong>親フォルダ</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<select name="parents_id" id="parents_id">
																																				<option value="0">home</option>
																																				<?php
				$flrows=0;
				while($fldata[$flrows]["dir_id"]!=NULL) {
				?>
																																				<option value="<?php echo $fldata[$flrows]["dir_id"];?>"<?php if($fcdata["parents_id"]==$fldata[$flrows]["dir_id"]) {echo " selected";}?>><?php echo $fldata[$flrows]["dir_name"];?></option>
																																				<?php 
					$flrows++;
				}
				?>
																																		</select>
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																								<tr>
																										<td>
																												<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
																														<tr>
																																<td><strong>
																																		<input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_REQUEST["cate_id"];?>">
																																		<input name="mode" type="hidden" id="mode">
																																		フォルダ名</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<input name="dir_name" type="text" id="dir_name" value="<?php echo $fcdata["dir_name"] ?>" size="50">
																																</td>
																														</tr>
																														<tr>
																																<td height="30">
																																		<input name="btm_up" type="button" id="btm_up" value="更新する" onClick="datachk(this.form)">
																																		<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=files_cate'">
																																</td>
																														</tr>
																												</table>
																										</td>
																								</tr>
																								<?php 
							}
							else {
							?>
																								<?php
							}
							?>
																						</table>
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
