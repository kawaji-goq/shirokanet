<?php

/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php 
*/
$flobj=new Files($dbobj);
$sumfiledata=$dbobj->GetData("select sum(files_size) as sumsize from files");
$sumsize = $sumfiledata["sumsize"];

if($_REQUEST["mode"]=="update") {
	$fupobj=new Upload();
	if(($_FILES["uploadfile"]["size"]+$sumsize*1000)<50000000) {
	
	$fupobj->fdata=$_FILES["uploadfile"];
	$fupobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/files/";
	$fupobj->rpath="/tmp/files/";
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/files/");

	$upfile=$fupobj->Upfile("");
	$result=$flobj->Update_File($_POST,$upfile);
if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp") {
	$ftp=new Cube_FTP();
	$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	
		if($upfile[0]["filepath"]!=NULL) {
		
			@chmod($upfile[0]["filepath"],0777);
				$ftp->MkDir("tmp/","files");
				$ftp->UpData("tmp/files/",$upfile[0]["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/files/".$upfile[0]["name"],"b");
			}
	}			
			?><script language="javascript">
	window.location.replace("index.php?PID=files&dir_id=<?php echo $_REQUEST["parents_id"];?>");
</script><?php
			}
			else {
				?>
				<script language="javascript">
				alert("ファイルの合計サイズが50ＭＢを超えた為更新を中止いたしました。");
				</script>
				<?php
			}
}

$fldata=$flobj->Get_CateList();
$fdata=$flobj->Get_FileData($_REQUEST["files_id"]);
?>
<script language="javascript">
function datachk(frm) {
	if(frm.files_name.value!=null&&frm.files_name.value!="") {
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
                  <td height="25" colspan="2" bgcolor="#FFFFFF"><a href="index.php?PID=files&dir_id=<?php echo $fldata[$flrows]["dir_id"];?>"><?php echo $fldata[$flrows]["dir_name"];
																		?></a></td>
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
								<form action="" method="post" enctype="multipart/form-data" name="form2">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
												<tr>
														<td valign="middle">
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
																																				<option value="<?php echo $fldata[$flrows]["dir_id"];?>"<?php if($fdata["dir_id"]==$fldata[$flrows]["dir_id"]) {echo " selected";}?>><?php echo $fldata[$flrows]["dir_name"];?></option>
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
																												<table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																														<tr>
																																<td><strong>
																																		
																																		ファイル名
																																		<input name="mode" type="hidden" id="mode">
																																</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<input name="files_name" type="text" id="files_name" value="<?php echo $fdata["files_name"] ?>" size="50">
																																</td>
																														</tr>
																														<tr>
																																<td><strong>ファイル</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<?php 
																				if($sumsize<50000) {
																				?>
																																		<input name="uploadfile" type="file" id="uploadfile">
																																		<br>
																																		※一度に登録できるファイルは10ＭＢ迄です<br>
																																		<font color="#FF0000">※ファイルを更新しない場合は選択しないで下さい。 
																																		<?php 
}
else {
?>
                                  <font color="#FF0000"><strong>容量をオーバーしていますのでファイルを変更できません。<br>
不要なファイルを削除して再度お試しください。</strong></font><br>
<?php
}
?>
																																		</font></td>
																														</tr>
																														<tr>
																																<td height="30">
																																    <strong>
                                    <input name="files_id" type="hidden" id="files_id" value="<?php echo $_REQUEST["files_id"];?>">
                                    </strong>
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
												<tr>
														<td>&nbsp;</td>
												</tr>
												<tr>
														<td>&nbsp;</td>
												</tr>
										</table>
								</form>
						</td>
				</tr>
		</table>
</div>
