<?php

/*
if($_REQUEST["subm"]=="送信する") {
	$fp=ftp_connect("localhost");
	if($fp) {
		echo "サーバーに接続しました。<br>";
		$ftphd=ftp_login($fp,"takken-iwakuni","vh47JEbv");
		if($ftphd) {
			echo "認証に成功しました。<br>";
			$res=ftp_chact($fp,"/httpdocs/members/tmp/file");
			//ftp_put($fp,"ugau.jpg",$_REQUEST["file1"],FTP_BINARY);
			$actlist=ftp_nlist($fp,"./");
			print_r($actlist);
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

$flobj=new Acts($dbobj);
if($_REQUEST["dphoto1"]!=NULL) {
	$sql="update act set act_path='' where act_path='".$_REQUEST["dphoto1"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto1"]);	
}
if($_REQUEST["dphoto2"]!=NULL) {
	$sql="update act set photo2='' where photo2='".$_REQUEST["dphoto2"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto2"]);	
}

if($_REQUEST["dphoto3"]!=NULL) {
	$sql="update act set photo3='' where photo3='".$_REQUEST["dphoto3"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto3"]);	
}
if($_REQUEST["dphoto4"]!=NULL) {
	$sql="update act set photo4=''  where photo4='".$_REQUEST["dphoto4"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto4"]);	
}
if($_REQUEST["dphoto5"]!=NULL) {
	$sql="update act set photo5=''  where photo5='".$_REQUEST["dphoto5"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto5"]);	
}
if($_REQUEST["dphoto6"]!=NULL) {
	$sql="update act set photo6=''  where photo6='".$_REQUEST["dphoto6"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto6"]);	
}
if($_REQUEST["dphoto7"]!=NULL) {
	$sql="update act set photo7=''  where photo7='".$_REQUEST["dphoto7"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto7"]);	
}
if($_REQUEST["dphoto8"]!=NULL) {
	$sql="update act set photo8=''  where photo8='".$_REQUEST["dphoto8"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto8"]);	
}
if($_REQUEST["dphoto9"]!=NULL) {
	$sql="update act set photo9=''  where photo9='".$_REQUEST["dphoto9"]."'";
	$dbobj->Query($sql);
	@unlink($_REQUEST["dphoto9"]);	
}

if($_REQUEST["mode"]=="update") {

	$fupobj=new Upload();
	$fupobj->fdata=$_FILES["uploadfile"];
	$sname=pathinfo($fupobj->fdata["name"]);
	$fupobj->newname=date("Ymdhis",time())."_1.".$sname["extension"];
	$upfile=$fupobj->Upfile();
	if($upfile[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj->newname,"../tmp/",400);
	}
	
	$fupobj2=new Upload();
	$fupobj2->fdata=$_FILES["uploadfile2"];
	$sname=pathinfo($fupobj2->fdata["name"]);
	$fupobj2->newname=date("Ymdhis",time())."_2.".$sname["extension"];
	$upfile2=$fupobj2->Upfile();
	if($upfile2[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj2->newname,"../tmp/",400);
	}
	
	$fupobj3=new Upload();
	$fupobj3->fdata=$_FILES["uploadfile3"];
	$sname=pathinfo($fupobj3->fdata["name"]);
	$fupobj3->newname=date("Ymdhis",time())."_3.".$sname["extension"];
	$upfile3=$fupobj3->Upfile();
	if($upfile3[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj3->newname,"../tmp/",400);
	}
	
	$fupobj4=new Upload();
	$fupobj4->fdata=$_FILES["uploadfile4"];
	$sname=pathinfo($fupobj4->fdata["name"]);
	$fupobj4->newname=date("Ymdhis",time())."_4.".$sname["extension"];
	$upfile4=$fupobj4->Upfile();
	if($upfile4[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj4->newname,"../tmp/",400);
	}
	
	$fupobj5=new Upload();
	$fupobj5->fdata=$_FILES["uploadfile5"];
	$sname=pathinfo($fupobj5->fdata["name"]);
	$fupobj5->newname=date("Ymdhis",time())."_5.".$sname["extension"];
	$upfile5=$fupobj5->Upfile();
	if($upfile5[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj5->newname,"../tmp/",400);
	}
	
	$fupobj6=new Upload();
	$fupobj6->fdata=$_FILES["uploadfile6"];
	$sname=pathinfo($fupobj6->fdata["name"]);
	$fupobj6->newname=date("Ymdhis",time())."_6.".$sname["extension"];
	$upfile6=$fupobj6->Upfile();
	if($upfile6[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj6->newname,"../tmp/",400);
	}
	
	$fupobj7=new Upload();
	$fupobj7->fdata=$_FILES["uploadfile7"];
	$sname=pathinfo($fupobj7->fdata["name"]);
	$fupobj7->newname=date("Ymdhis",time())."_7.".$sname["extension"];
	$upfile7=$fupobj7->Upfile();
	if($upfile7[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj7->newname,"../tmp/",400);
	}
	$fupobj8=new Upload();
	$fupobj8->fdata=$_FILES["uploadfile8"];
	$sname=pathinfo($fupobj8->fdata["name"]);
	$fupobj8->newname=date("Ymdhis",time())."_8.".$sname["extension"];
	$upfile8=$fupobj8->Upfile();
	if($upfile8[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj8->newname,"../tmp/",400);
	}
	
	$fupobj9=new Upload();
	$fupobj9->fdata=$_FILES["uploadfile9"];
	$sname=pathinfo($fupobj9->fdata["name"]);
	$fupobj9->newname=date("Ymdhis",time())."_9.".$sname["extension"];
	$upfile9=$fupobj9->Upfile();
	if($upfile9[0]["filepath"]!=NULL) {
		@magic_Image :: convert_Width2($fupobj9->newname,"../tmp/",400);
	}
	
	$result=$flobj->Update_Act($_POST,$upfile,$upfile2,$upfile3,$upfile4,$upfile5,$upfile6,$upfile7,$upfile8,$upfile9);
	
}

$fldata=$flobj->Get_CateList();
$fdata=$flobj->Get_ActData($_REQUEST["act_id"]);
?>
<script language="javascript">
function datachk(frm) {
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			p_unload();
			frm.mode.value="update";
			frm.submit();
		}
}
</script>
<div id="act">
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="2" align="left" valign="top">
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
					<tr>
						<td width="6%"><img src="/members/img/topics_pt.gif" width="35" height="31"></td>
						<td width="94%">
							<div id="tree"><span class="top">活動予定・報告管理</span>　<span class="gt">>></span>　<span class="sub">活動予定・報告更新</span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp; </td>
		</tr>
		<tr>
			<td width="200" align="left" valign="top"><strong> 活動予定・報告種別 </strong></td>
			<td align="left" valign="top">
				<div align="left"></div>
			</td>
		</tr>
		<tr>
			<td width="200" align="left" valign="top">
				<table width="100%"  border="0" cellpadding="2" cellspacing="2" background="/members/img/message_bg1.gif" class="menu">
					<tr>
						<td colspan="2">
							<input type="button" name="Submit" value="活動予定・報告種別管理" onClick="window.location.href='index.php?PID=act_cate'">
						</td>
					</tr>					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?>
						<td colspan="2"><a href="index.php?PID=act&cate_id=<?php echo $fldata[$flrows]["cate_id"];?>"><?php echo $fldata[$flrows]["cate_name"];?></a></td>
					</tr>
					<?php 
					$flrows++;
				}
				?>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
				</table>
			</td>
			<form action="" method="post" enctype="multipart/form-data" name="up_form" id="up_form">
				<td align="center" valign="top">
					<?php 
					if($_REQUEST["mode"]=="update"&&$result=="") {
					
					?><script language="javascript">
					window.location.replace('index.php?PID=act&cate_id=<?php echo $_REQUEST["cate_id"];?>');
					</script>
					<table width="95%" border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="50%">&nbsp;</td>
							<td width="50%">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><strong>以下の内容で更新しました。</strong></div>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
					<table width="95%"  border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>親種別</strong></div>
							</td>
							<td width="335" colspan="6" valign="top">
								<?php 
							$updata=$flobj->Get_CateData($_REQUEST["parents_id"]);
							echo $updata["act_name"];
?>
							</td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong> 活動予定・報告名</strong></div>
							</td>
							<td colspan="6"> <?php echo $_REQUEST["act_name"] ?> </td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong> 写真1</strong></div>
							</td>
							<td colspan="6"> <?php echo $upfile[0]["filepath"];?> </td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真2</strong></div>
							</td>
							<td colspan="6"> <?php echo $upfile2[0]["filepath"];?> </td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"> <strong>写真3</strong></div>
							</td>
							<td colspan="6"> <?php echo $upfile3[0]["filepath"];?> </td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真4</strong></td>
							<td colspan="6"><?php echo $upfile4[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真5</strong></td>
							<td colspan="6"><?php echo $upfile5[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真6</strong></td>
							<td colspan="6"><?php echo $upfile6[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真7</strong></td>
							<td colspan="6"><?php echo $upfile7[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真8</strong></td>
							<td colspan="6"><?php echo $upfile8[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"> <strong>写真9</strong></td>
							<td colspan="6"><?php echo $upfile9[0]["filepath"];?></td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>コメント</strong></div>
							</td>
							<td colspan="6"><?php echo nl2br($_REQUEST["comm"]); ?> </td>
						</tr>
						<tr>
							<td width="150" align="right" background="/members/img/filemenu_bg.gif"><strong>公開</strong></td>
							<td colspan="6">
								<?php 
							switch($_REQUEST["view_chk"]) {
								case 0:
									echo "非公開";
									break;
									
								case 1:
									echo "公開";
									break;
							} ?>
							</td>
						</tr>
					</table>
					<table width="95%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="50%">&nbsp;</td>
						</tr>
						<tr>
							<td height="30" background="/members/img/bukken_bg.gif">
								<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=act'">
							</td>
						</tr>
					</table>
					<?php 
					}
					else {?>
                    <table width="95%"  border="0" cellspacing="0" cellpadding="0">
                    	<tr>
                    		<td align="left"><img src="/img/step3_ic.gif" width="55" height="29"></td>
                   		</tr>
                    	</table>					
                    <table width="95%"  border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>親種別</strong></div>
							</td>
							<td colspan="6" valign="top">
								<select name="parents_id" id="parents_id">
									<option value="0">home</option>
									<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?>
									<option value="<?php echo $fldata[$flrows]["cate_id"];?>"<?php if($fdata["cate_id"]==$fldata[$flrows]["cate_id"]) {echo " selected";}?>><?php echo $fldata[$flrows]["cate_name"];?></option>
									<?php 
					$flrows++;
				}
				?>
								</select>
							</td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>
									<input name="mode" type="hidden" id="mode">
									活動予定・報告名</strong></div>
							</td>
							<td colspan="6">
								<input name="act_name" type="text" id="act_name" value="<?php echo $fdata["act_name"] ?>" size="50">
							</td>
						</tr>
						<tr>
							<td width="150" rowspan="2" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>
									<input name="act_id" type="hidden" id="act_id" value="<?php echo $_REQUEST["act_id"];?>">
									写真1</strong></div>
							</td>
							<td colspan="6">
								<?php if($fdata["act_path"]!=NULL) {?>
								<img src="<?php echo $fdata["act_path"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile" type="file" id="uploadfile">
								<br>
								<font color="#FF0000">								<input name="dphoto1" type="checkbox" id="dphoto1" value="<?php echo $fdata["act_path"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真2</strong></div>
							</td>
							<td colspan="6">
								<?php if($fdata["photo2"]!=NULL) {?>
								<img src="<?php echo $fdata["photo2"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile2" type="file" id="uploadfile2">
								<br>
								<font color="#FF0000">								<input name="dphoto2" type="checkbox" id="dphoto2" value="<?php echo $fdata["photo2"] ?>">
								</font><strong>この写真を削除</strong> <font color="#FF0000">&nbsp; </font></td>
						</tr>
						<tr>
							<td width="150" rowspan="2" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"> <strong>写真3</strong>								</div>
							</td>
							<td colspan="6">
								<?php if($fdata["photo3"]!=NULL) {?>
								<img src="<?php echo $fdata["photo3"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile3" type="file" id="uploadfile3">
								<br>
								<font color="#FF0000">								<input name="dphoto3" type="checkbox" id="dphoto3" value="<?php echo $fdata["photo3"] ?>">
								</font><strong>この写真を削除</strong> <font color="#FF0000">&nbsp; </font></td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真4</strong></td>
							<td colspan="6">
								<?php if($fdata["photo4"]!=NULL) {?>
								<img src="<?php echo $fdata["photo4"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile4" type="file" id="uploadfile4">
								<br>
								<font color="#FF0000"><br>
								<input name="dphoto4" type="checkbox" id="dphoto4" value="<?php echo $fdata["photo4"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真5</strong></td>
							<td colspan="6">
								<?php if($fdata["photo5"]!=NULL) {?>
								<img src="<?php echo $fdata["photo5"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile5" type="file" id="uploadfile5">
								<br>
								<font color="#FF0000"><br>
								<input name="dphoto5" type="checkbox" id="dphoto5" value="<?php echo $fdata["photo5"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真6</strong></td>
							<td colspan="6">
								<?php if($fdata["photo6"]!=NULL) {?>
								<img src="<?php echo $fdata["photo6"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile6" type="file" id="uploadfile6">
								<br>
								<font color="#FF0000"><br>
								<input name="dphoto6" type="checkbox" id="dphoto6" value="<?php echo $fdata["photo6"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真7</strong></td>
							<td colspan="6">
								<?php if($fdata["photo7"]!=NULL) {?>
								<img src="<?php echo $fdata["photo7"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile7" type="file" id="uploadfile7">
								<br>
								<font color="#FF0000"><br>
								<input name="dphoto7" type="checkbox" id="dphoto7" value="<?php echo $fdata["photo7"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真8</strong></td>
							<td colspan="6">
								<?php if($fdata["photo8"]!=NULL) {?>
								<img src="<?php echo $fdata["photo8"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile8" type="file" id="uploadfile8">
								<br>
								<font color="#FF0000"><br>
								<input name="dphoto8" type="checkbox" id="dphoto8" value="<?php echo $fdata["photo8"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" rowspan="2" align="right" valign="top" background="/members/img/filemenu_bg.gif"> <strong>写真9</strong></td>
							<td colspan="6">
								<?php if($fdata["photo9"]!=NULL) {?>
								<img src="<?php echo $fdata["photo9"] ?>" width="100">
								<?php }?>
							</td>
						</tr>
						<tr>
							<td colspan="6">
								<input name="uploadfile9" type="file" id="uploadfile9">
								<br>
								<font color="#FF0000">								<input name="dphoto9" type="checkbox" id="dphoto9" value="<?php echo $fdata["photo9"] ?>">
								</font><strong>この写真を削除</strong> </td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>コメント</strong></div>
							</td>
							<td colspan="6">
								<textarea name="comment" cols="45" rows="10" id="comment"><?php echo $fdata["comm"] ?></textarea>
							</td>
						</tr>
						<tr>
							<th align="right" valign="top" background="/members/img/filemenu_bg.gif">公開</th>
							<td colspan="6">
								<select name="view_chk" id="view_chk">
									<option value="1"<?php if($fdata["view_chk"]==1) { echo " selected";} ?>>公開</option>
									<option value="0"<?php if($fdata["view_chk"]==0) { echo " selected";} ?>>非公開</option>
								</select>
							</td>
						</tr>
					</table>
					<table width="95%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="50%">&nbsp;</td>
						</tr>
						<tr>
							<td height="30" background="/members/img/bukken_bg.gif">
								<input name="btm_up" type="button" id="btm_up" value="更新する" onClick="datachk(this.form)">
								<input name="btm_back" type="button" id="btm_back" value="リストへ戻る" onClick="window.location.href='index.php?PID=act'">
							</td>
						</tr>
					</table>
					<?php
						} ?>
				</td>
			</form>
		</tr>
	</table>
</div>
