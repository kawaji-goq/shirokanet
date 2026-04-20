<?php

/*
if($_REQUEST["subm"]=="送信する") {
	$fp=ftp_connect("localhost");
	if($fp) {
		echo "サーバーに接続しました。<br>";
		$ftphd=ftp_login($fp,"takken-iwakuni","vh47JEbv");
		if($ftphd) {
			echo "認証に成功しました。<br>";
			$res=ftp_chcate($fp,"/httpdocs/members/tmp/act");
			//ftp_put($fp,"ugau.jpg",$_REQUEST["act1"],FTP_BINARY);
			$catelist=ftp_nlist($fp,"./");
			print_r($catelist);
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

if($_REQUEST["mode"]=="addition") {
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
	

	$result3=$flobj->Addition_Act($_POST,$upfile,$upfile2,$upfile3,$upfile4,$upfile5,$upfile6,$upfile7,$upfile8,$upfile9);
}

$fldata=$flobj->Get_CateList();
$fcdata=$flobj->Get_CateData($_REQUEST["cate_id"]);

?>
<script language="javascript">
function datachk(frm) {
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			p_unload();
			frm.mode.value="addition";
			frm.submit();
		}
}
</script>
<div id="acts">
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td colspan="2" align="left" valign="top">
				<table width="100%" border="0" cellspacing="2" cellpadding="2">
					<tr>
						<td width="35"><img src="/members/img/topics_pt.gif" width="35" height="31"></td>
						<td>
							<div id="tree"><span class="top">活動予定・報告管理</span>　<span class="gt">>></span>　<span class="sub">活動予定・報告登録</span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="left" valign="top">&nbsp; </td>
		</tr>
		<tr>
			<td align="left" valign="top"><strong> 活動予定・報告種別 </strong></td>
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
					</tr>
					<tr>
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
					if($_REQUEST["mode"]=="addition"&&$result=="") {
					?>
					<script language="javascript">
					window.location.replace('index.php?PID=act&cate_id=<?php echo $_REQUEST["cate_id"];?>');
					</script>
					<table width="95%" border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="50%">&nbsp;</td>
							<td width="50%">&nbsp;</td>
						</tr>
						<tr>
							<td colspan="2">
								<div align="center"><strong>以下の内容で登録しました。</strong></div>
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
							<td colspan="6" valign="top">
								<?php 
							$updata=$flobj->Get_CateData($_REQUEST["parents_id"]);
							echo $updata["cate_name"];
?>
 </td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong> 活動予定・報告名</strong></div>
							</td>
							<td colspan="6"> <?php echo $_REQUEST["acts_name"] ?> </td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真1</strong></div>
							</td>
							<td colspan="6"><?php echo $upfile[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真2</strong></div>
							</td>
							<td colspan="6"><?php echo $upfile2[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真3</strong></div>
							</td>
							<td colspan="6"><?php echo $upfile3[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真4</strong></td>
							<td colspan="6"><?php echo $upfile4[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真5</strong></td>
							<td colspan="6"><?php echo $upfile5[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真6</strong></td>
							<td colspan="6"><?php echo $upfile6[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真7</strong></td>
							<td colspan="6"><?php echo $upfile7[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真8</strong></td>
							<td colspan="6"><?php echo $upfile8[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真9</strong></td>
							<td colspan="6"><?php echo $upfile9[0]["filepath"]; ?></td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>コメント</strong></div>
							</td>
							<td colspan="6"><?php echo $_REQUEST["comment"] ?></td>
						</tr>
						<tr>
							<th align="right" background="/members/img/filemenu_bg.gif">公開</th>
							<td colspan="6"><?php 
							
							switch($_REQUEST["view_chk"]) {
								case 0:
									echo "非公開";
									break;
								case 1:
									echo "公開";
									break;
									
							}
							?></td>
						</tr>
					</table>
					<table width="95%" border="0" cellspacing="2" cellpadding="2">
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
									<?php
				$flrows=0;
				while($fldata[$flrows]["cate_id"]!=NULL) {
				?>
									<option value="<?php echo $fldata[$flrows]["cate_id"];?>"<?php if($_REQUEST["cate_id"]==$fldata[$flrows]["cate_id"]) {echo " selected";}?>><?php echo $fldata[$flrows]["cate_name"];?></option>
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
								<input name="acts_name" type="text" id="acts_name" size="50">
							</td>
						</tr>
						<tr>
							<td width="150" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真1</strong></div>
							</td>
							<td colspan="6">
								<input name="uploadfile" type="file" id="uploadfile">
								<input name="oldact" type="hidden" id="oldact">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真2</strong></div>
							</td>
							<td colspan="6">
								<input name="uploadfile2" type="file" id="uploadfile2">
							</td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>写真3</strong></div>
							</td>
							<td colspan="6">
								<input name="uploadfile3" type="file" id="uploadfile3">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真4</strong></td>
							<td colspan="6">
								<input name="uploadfile4" type="file" id="uploadfile4">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真5</strong></td>
							<td colspan="6">
								<input name="uploadfile5" type="file" id="uploadfile5">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真6</strong></td>
							<td colspan="6">
								<input name="uploadfile6" type="file" id="uploadfile6">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真7</strong></td>
							<td colspan="6">
								<input name="uploadfile7" type="file" id="uploadfile7">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真8</strong></td>
							<td colspan="6">
								<input name="uploadfile8" type="file" id="uploadfile8">
							</td>
						</tr>
						<tr>
							<td width="150" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>写真9</strong></td>
							<td colspan="6">
								<input name="uploadfile9" type="file" id="uploadfile9">
							</td>
						</tr>
						<tr>
							<td width="150" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>コメント</strong></div>
							</td>
							<td colspan="6">
								<textarea name="comment" cols="45" rows="10" id="comment"></textarea>
</td>
						</tr>
						<tr>
							<th align="right" valign="top" background="/members/img/filemenu_bg.gif">公開</th>
							<td colspan="6">
								<select name="view_chk" id="view_chk">
									<option value="1">公開</option>
									<option value="0" selected>非公開</option>
								</select>
								<input name="new_turn" type="hidden" id="new_turn" value="<?php echo $_REQUEST["new_turn"];?>">
							</td>
						</tr>
					</table>
					<table width="95%" border="0" cellspacing="2" cellpadding="2">
						<tr>
							<td width="50%">&nbsp;</td>
						</tr>
						<tr>
							<td height="30" background="/members/img/bukken_bg.gif">
								<input name="btm_add" type="button" id="btm_add" value="登録する" onClick="datachk(this.form)">
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
