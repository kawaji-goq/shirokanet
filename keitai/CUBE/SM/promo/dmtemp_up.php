<?php

include("./lib/mobile_class_7.php");

$today=explode("-",date("Y-m-d",time()));

if($_POST["mode"]=="update") {
	
	$insql="update dm_temp set ".
			"temp_name='".$_POST["temp_name"]."',".
			"temp_target='".$_POST["temp_target"]."',".
			"raddress = '".$_POST["raddress"]."',".
			"rsubjext='".$_POST["rsubjext"]."',".
			"rpctxt='".$_POST["rpctxt"]."',".
			"ksubjext='".$_POST["ksubjext"]."',".
			"rktxt='".$_POST["rktxt"]."'".
			" where temp_id=".$_REQUEST["temp_id"];
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="変更に失敗しました。";
	}
}
$dmtmpdata=$dbobj->GetData("select * from dm_temp where temp_id=".$_REQUEST["temp_id"]."");

?><script>
function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(frm.raddress.value==null||frm.raddress.value=="") {
		alertchk=1;
		alerttxt="メールアドレスを入力してください。";
	}
	if(alertchk==0) {
		res=confirm("この内容で変更しますか？");
		if(res) {
			frm.submit();
		}
		
	}else {
			alert(alerttxt);
		}
}
//-->

</script>
<style>
.helper{
	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
.helper1 {	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
.helper1 {	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
</style>
<script language="JavaScript" type="text/javascript" src="/CrBrow/richtext.js"></script>
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
										    <td width="15" bgcolor="#CCCCCC">&nbsp;</td>
												<td><strong>メール配信テンプレート変更</strong></td>
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
            <div class="helper"> 登録した<span class="helper1">メール配信</span>テンプレートの内容を変更します。<br>
            各項目を入力して<strong>「変更する」</strong>ボタンをクリックしてください。
			<br>
携帯用件名と携帯用本文の項目では右側の携帯各社のアイコンをクリックすると絵文字を利用する事が出来ます。<br>
            変更をしない場合は「<a href="#" onclick="location.replace('?PID=promo_dmtemp')"><strong>一覧に戻る</strong></a>」ボタンをクリックするとテンプレートの一覧ページに戻れます。</div>
            <br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<form id="update_form" name="update_form" method="post" action="" onsubmit="updateRTEs();">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">テンプレート名</td>
												<td bgcolor="#FFFFFF">
														<input name="temp_name" type="text" id="temp_name" value="<?php echo $dmtmpdata["temp_name"];?>" size="40" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">対象アドレス</td>
												<td bgcolor="#FFFFFF">
												  <select name="temp_target" id="temp_target">
                                                          <option value="p"<?php if($dmtmpdata["temp_target"]=="p") { echo " selected";} ?>>PCアドレス</option>
                                                          <option value="k"<?php if($dmtmpdata["temp_target"]=="k") { echo " selected";} ?>>携帯アドレス</option>
                                                          <option value="pk"<?php if($dmtmpdata["temp_target"]=="pk"||$dmtmpdata["temp_target"]==NULL) { echo " selected";} ?>>すべて</option>
                            </select>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">送信アドレス</td>
												<td bgcolor="#FFFFFF">
														<input name="raddress" type="text" id="raddress" size="40" value="<?php echo $dmtmpdata["raddress"];?>"  style="width:98%;"/>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用件名</td>
												<td bgcolor="#FFFFFF">
														<input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $dmtmpdata["rsubjext"];?>"  style="width:98%;"/>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="rpctxt" cols="60" rows="10" id="rpctxt" style="width:98%;"><?php echo $dmtmpdata["rpctxt"];?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
												<td bgcolor="#FFFFFF">
														<?php
						$DECODE = $emoji_obj -> emj_decode($dmtmpdata["ksubjext"]);
														?><script language="JavaScript" type="text/javascript"><!--
writeRichText('textfield', 'update_form', 'ksubjext', '<p><?php echo $emoji_obj -> emj_form_escape(str_replace("<br />","</p><p>",str_replace("\r","",str_replace("\n","\\n",(nl2br($DECODE["form"]))))));?></p>', 450, 20, false, false ,'side', 12);
//-->
</script>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
												<td bgcolor="#FFFFFF">
														<?php
												
						$DECODE = $emoji_obj -> emj_decode($dmtmpdata["rktxt"]);
														?><label><script language="JavaScript" type="text/javascript"><!--
writeRichText('textfield', 'update_form', 'rktxt', '<p><?php echo str_replace("<br />","</p><p>",str_replace("\r","",str_replace("\n","\\n",(nl2br($DECODE["form"])))));?></p>', 450, 200, false, false ,'side', 12);
//-->
</script></label></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
										  <td bgcolor="#FFFFFF">
														<input type="submit" name="Submit" value="変更する" />
														<input type="button" name="Submit" value="一覧へ戻る" onclick="location.replace('?PID=promo_dmtemp');" />
														<input name="mode" type="hidden" id="mode" value="update" />
                                                        <input name="temp_id" type="hidden" id="temp_id" value="<?php echo $dmtmpdata["temp_id"];?>" />
</td>
										</tr>
</form>
						  </table>				  
						</td>
				</tr>
		</table>
