<?php
include("./lib/mobile_class_7.php");

$today=explode("-",date("Y-m-d",time()));

if($_POST["mode"]=="regist") {
	
	$maxdata=$dbobj->GetData("select max(temp_id) as maxid from dm_temp");
	$maxid=$maxdata["maxid"]+1;
	
	$insql="insert into dm_temp values(".$maxid.",'".$_POST["temp_name"]."','".$_POST["target"]."','".$_POST["raddress"]."','".$_POST["rsubjext"]."','".$_POST["rpctxt"]."','".$_POST["rktxt"]."',".$maxid.",'".$_POST["ksubjext"]."')";
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="登録に失敗しました。";
	}
}

?>
<script>
function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(frm.raddress.value==null||frm.raddress.value=="") {
		alertchk=1;
		alerttxt="メールアドレスを入力してください。";
	}
	if(alertchk==0) {
		res=confirm("この内容で登録しますか？");
		if(res) {
			frm.submit();
		}
		
	}else {
			alert(alerttxt);
		}
}
//-->

</script><script language="JavaScript" type="text/javascript" src="/CrBrow/richtext.js"></script>
<script language="JavaScript" type="text/javascript" src="/CrBrow/emojiin2.js"></script>
<script language="JavaScript" type="text/javascript" src="/CrBrow/emojichg.js"></script>
<script language="JavaScript" type="text/javascript">
<!--
// Cross-Browser Rich Text Editor初期化
initRTE("/CrBrow/images/", "", "");
//-->
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
				<tr>
						<td>
								<table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
										<tr>
												<td><strong>メール配信テンプレート登録</strong></td>
										</tr>
								</table>
						</td>
				</tr>
				<tr>
						<td>&nbsp;</td>
				</tr>
				<tr>
						<td>
								<?php 
								if($_POST["mode"]=="regist") {
								?>
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">テンプレート名</td>
												<td bgcolor="#FFFFFF"> <?php echo $_REQUEST["temp_name"];?> </td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">対象</td>
												<td bgcolor="#FFFFFF"><?php echo $_REQUEST["target"];?></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">送信元のアドレス </td>
												<td bgcolor="#FFFFFF"> <?php echo $_REQUEST["raddress"];?> </td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用件名</td>
												<td bgcolor="#FFFFFF"> <?php echo $_REQUEST["rsubjext"];?> </td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用本文</td>
												<td bgcolor="#FFFFFF"> <?php echo nl2br($_REQUEST["rpctxt"]);?> </td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
												<td bgcolor="#FFFFFF"><?php echo $_REQUEST["ksubjext"];?></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
												<td bgcolor="#FFFFFF">
														<label><?php 
						$DECODE_DATA=$emoji_obj->emj_decode($_REQUEST["rktxt"]);
						echo nl2br($DECODE_DATA["web"]);
						?> </label>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="続けて登録する" onclick="location.replace('?PID=promo_dmtemp_reg');" />
														<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dmtemp');" />
														<input name="mode" type="hidden" id="mode" value="regist" />
												</td>
										</tr>
							</table>
								<?php 
								}
								else {?>
								<?php
								if($errmess!=NULL) {
								?>
								<table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
										<tr>
												<td>&nbsp;</td>
										</tr>
										<tr>
												<td><font color="#FF0000"><strong><?php echo $errmess; ?></strong></font></td>
										</tr>
										<tr>
												<td>&nbsp;</td>
										</tr>
								</table>
								<?php 
								}
								?>
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
									<form id="update_form" name="update_form" method="post" action="" onsubmit="updateRTEs();">
			<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">テンプレート名</td>
												<td bgcolor="#FFFFFF">
														<input name="temp_name" type="text" id="temp_name" value="<?php echo $_REQUEST["temp_name"];?>" size="40" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">対象アドレス</td>
												<td bgcolor="#FFFFFF">
														<select name="target" id="target">
																<option value="p"<?php if($_REQUEST["target"]=="p") { echo " selected";} ?>>PCアドレス</option>
																<option value="k"<?php if($_REQUEST["target"]=="k") { echo " selected";} ?>>携帯アドレス</option>
																<option value="pk"<?php if($_REQUEST["target"]=="pk"||$_REQUEST["target"]==NULL) { echo " selected";} ?>>すべて</option>
														</select>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td>
												<td bgcolor="#FFFFFF">
														<input name="raddress" type="text" id="raddress" size="40" value="<?php echo $_REQUEST["raddress"];?>" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用件名</td>
												<td bgcolor="#FFFFFF">
														<input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $_REQUEST["rsubjext"];?>"  style="width:98%;"/>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="rpctxt" cols="60" rows="10" id="rpctxt" style="width:98%;"><?php echo $_REQUEST["rpctxt"];?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
												<td bgcolor="#FFFFFF">
													
											<script language="JavaScript" type="text/javascript">
<!--
writeRichText('textfield', 'update_form', 'rktxt', '<?php echo $emoji_obj -> replace_emoji_form($str_replace("\r","",str_replace("\n","\\n",$_REQUEST["ksubjext"])));?>', 450, 200, false, false ,'side', 12);
//-->
</script>	</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
												<td bgcolor="#FFFFFF">
														<script language="JavaScript" type="text/javascript">
<!--
writeRichText('textfield', 'update_form', 'rktxt', '<?php echo str_replace("\r","",str_replace("\n","\\n",$_REQUEST["rktxt"]));?>', 450, 200, false, false ,'side', 12);
//-->
</script>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="submit" name="Submit" value="登録する"/>
														<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dmtemp');" />
														<input name="mode" type="hidden" id="mode" value="regist" />
												</td>
										</tr>
		</form>
							</table>
								<?php 
								}
								?>
						</td>
				</tr>
</table>
