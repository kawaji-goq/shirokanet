<?php
$today=explode("-",date("Y-m-d",time()));

$mailopobj=new Mail_Option($adminobj);

if($_REQUEST["mode"]=="regist") {
	$mailopobj->UpDate($_POST);
	$dbobj->Query("update first_coupon set coupon_title = '".$_REQUEST["coupon_title"]."',coupon_com = '".$_REQUEST["coupon_com"]."'");
}

$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];

$mailopdata=$mailopobj->GetData($_SESSION["DomainData"]["dbname"]);
$fcouopndata=$dbobj->GetData("select * from first_coupon");
if($fcouopndata["coupon_id"]==NULL) {
	$dbobj->GetData("insert into first_coupon(coupon_id) values (1)");	
}
?>
<script>
<!--
//****月によって、日付のselect.optionを変更****
function check3(){
	year=document.update_form.ryear.value;
	month=document.update_form.rmonth.value;
	day=document.update_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.rday") 
			del_cnt=document.update_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを変更****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.update_form.ryear.value=dft_date.substr(0,4);
		document.update_form.rmonth.value=dft_date.substr(4,2);
		document.update_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
	if(document.update_form.day_view.checked){
		document.update_form.ryear.value="";
		document.update_form.rmonth.value="";
		document.update_form.rday.value="";
	}
	else {
		set_date_dft();
	}
}

function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(alertchk==0) {
		res=confirm("この内容で更新しますか？");
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
</style>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
		<form name="update_form" method="post" action="">
				<tr>
						<td>
								<table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
										<tr>
												<td>
														<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
																<tr>
																		<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
																		<td>
																				<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																						<tr>
																								<td class="font10"> <strong>初期設定</strong> </td>
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
										  <td><div class="helper">メール会員の登録時・退会時の自動へ返信メールの設定が出来ます。<br>
										    登録用アドレスと解約用アドレスの右にあるQRCODEをクリックするとメールアドレスの入ったQRコードの画像が表示されますのでダウンロードしてご利用できます。</div>
										  </td>
								  </tr>
										<tr>
												<td>&nbsp;</td>
										</tr>
								</table>
						</td>
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
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="152" valign="top" bgcolor="#EBEBEB">登録用アドレス</td>
												<td width="533" bgcolor="#FFFFFF"><?php echo $mailopdata["tmailaddress"]; ?>&nbsp;<a href="#" onclick="window.open('http://siteadmin.itcube.ne.jp/qrcode/index2.php?qrdata=<?php echo $mailopdata["tmailaddress"]; ?>','qrcode','width=300,height=300')"><font color="#0000FF">QRCODE </font></a></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">
														<p>解約用アドレス</p>
												</td>
												<td bgcolor="#FFFFFF"><?php echo $mailopdata["kmailaddress"]; ?>&nbsp;<a href="#" onclick="window.open('http://siteadmin.itcube.ne.jp/qrcode/index2.php?qrdata=<?php echo $mailopdata["kmailaddress"]; ?>','qrcode','width=300,height=300')"><font color="#0000FF">QRCODE</font></a></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">登録時の件名</td>
												<td bgcolor="#FFFFFF">
														<input name="reg_subject" type="text" value="<?php echo $mailopdata["reg_subject"]; ?>" size="40" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">登録時の本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="reg_message" cols="40" rows="10" style="width:98%;"><?php echo $mailopdata["reg_message"]; ?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">登録時ｸｰﾎﾟﾝﾀｲﾄﾙ</td>
												<td bgcolor="#FFFFFF">
														<input name="coupon_title" type="text" value="<?php echo $fcouopndata["coupon_title"]; ?>" size="40" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">登録時ｸｰﾎﾟﾝ本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="coupon_com" cols="40" rows="10" style="width:98%;"><?php echo $fcouopndata["coupon_com"]; ?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">既に登録している時の件名</td>
												<td bgcolor="#FFFFFF">
														<input name="dreg_subject" type="text" style="width:98%;" value="<?php echo $mailopdata["dreg_subject"]; ?>" size="40" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">既に登録している時の本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="dreg_message" cols="40" rows="10" style="width:98%;"><?php echo $mailopdata["dreg_message"]; ?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">解約時の件名</td>
												<td bgcolor="#FFFFFF">
														<input name="unreg_subject" type="text" value="<?php echo $mailopdata["unreg_subject"]; ?>" size="40" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">解約時の本文</td>
												<td bgcolor="#FFFFFF">
														<textarea name="unreg_message" cols="40" rows="10" style="width:98%;"><?php echo $mailopdata["unreg_message"]; ?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="更新する" onclick="datachk()" />
														<input name="mode" type="hidden" id="mode" value="regist" />
												</td>
										</tr>
							</table>
						</td>
				</tr>
		</form>
</table>
