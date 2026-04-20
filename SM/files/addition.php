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
$sumfiledata=$dbobj->GetData("select sum(files_size) as sumsize from files");
$sumsize = $sumfiledata["sumsize"];

if($_REQUEST["mode"]=="addition") {
	if(($_FILES["uploadfile"]["size"]+$sumsize*1000)<50000000) {

	$fupobj=new Upload();
	$fupobj->fdata=$_FILES["uploadfile"];
	$fupobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/files/";
	$fupobj->rpath="/tmp/files/";
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/files/");
	

	$upfile=$fupobj->Upfile();
	
	$result=$flobj->Addition_File($_POST,$upfile);
	$ftp=new Cube_FTP();
	$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
	if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
		if($upfile[0]["filepath"]!=NULL) {
		
			@chmod($upfile[0]["filepath"],0777);
				$ftp->MkDir("tmp/","files");
				$ftp->UpData("tmp/files/",$upfile[0]["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/files/".$upfile[0]["name"],"b");
		}
		}
		?>
<script language="javascript">
window.location.replace("index.php?PID=files&dir_id=<?php echo $_REQUEST["parents_id"];?>");
</script>
		<?php
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
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<script language="javascript">
function datachk(frm) {
	if(frm.files_name.value!=null&&frm.files_name.value!="") {
		res=confirm("この内容で登録してもよろしいですか？");
		if(res) {
			frm.mode.value="addition";
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
								<form action="" method="post" enctype="multipart/form-data" name="up_form" id="up_form">
										<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
																												<table width="100%" border="0" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																														<tr>
																																<td><strong>
																																<input name="mode" type="hidden" id="mode">
ファイル名</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<input name="files_name" type="text" id="files_name" size="50">
																																</td>
																														</tr>
																														
																														<tr>
																																<td><strong>ファイル</strong></td>
																														</tr>
																														<tr>
																																<td>
																																		<input name="uploadfile" type="file" id="uploadfile">
																																		<input name="oldfile" type="hidden" id="oldfile">
                                  <br>
                                  <br>
																																※一度に登録できるファイルは10ＭＢ迄です。</td>
																														</tr>
																														
																														<tr>
																																<td height="30">
																																		  <?php 
																				if($sumsize<50000) {
																				?>
																																		  <input name="btm_add" type="button" id="btm_add" value="登録する" onClick="datachk(this.form)">
                                    <?php 
}
else {
?>
                                    <font color="#FF0000"><strong>容量をオーバーしていますのでファイルを登録できません。<br>
不要なファイルを削除して再度お試しください。</strong></font><br>
<?php
}
?>
<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=files'">
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
