<?php
$today=explode("-",date("Y-m-d",time()));

if($newsdata["rdate"]!=NULL) {
	$exday=explode("-",$newsdata["rdate"]);
}
else {
	$exday=explode("-",date("Y-m-d-H-i"));
}
$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$minite=$exday[4];

if($_POST["mode"]=="regist") {
include_once('./lib/mobile_class_7.php');
	$chksql="select * from mail_customer where email = '".$_POST["email"]."'";
	$chkres=$dbobj->Query($chksql);
	$chknumrows=$dbobj->NumRows($chkres);
	
	if($chknumrows!=0) {
		$_POST["mode"]="";
		$errmess="このメールアドレスは既に登録されています。";
	}
	else {
		$maxdata=$dbobj->GetData("select max(id) as maxid from mail_customer");
		$maxid=$maxdata["maxid"]+1;
		$carrer=$emoji_obj -> get_mail_career($_POST["email"]);
		
		if($carrer!='PC') 
		{
			$carrer="k";
		}
		else 
		{
			$carrer="p";
		}
		
		$insql="insert into mail_customer values(".$maxid.",'".$_POST["email"]."','".$_POST["name"]."','".date("Y-m-d")."','".(User_Model :: MailType($_POST["email"]))."')";
		$chkres=$dbobj->Query($insql);
		if(!$chkres){
			$_POST["mode"]="";
			$errmess="登録に失敗しました。";
		}
	}
}

?>
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
	if(frm.email.value==null||frm.email.value=="") {
		alertchk=1;
		alerttxt="メールアドレスを入力してください。";
	}
	else if(frm.email.value!=frm.email2.value) {
		alertchk=1;
		alerttxt="メールアドレスとメールアドレス確認のアドレスが異なります。\n正確なメールアドレスを入力してください。";
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

</script>		
		<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
		<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
<form name="update_form" method="post" action="">
				
				<tr>
						<td>
								<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
										<tr>
												<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
												<td>
														<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																<tr>
																		<td class="font10"> <strong>メール会員登録</strong> </td>
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
						<td>
								<?php 
								if($_POST["mode"]=="regist") {
								?>
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">お名前</td>
												<td bgcolor="#FFFFFF">
													<?php echo $_REQUEST["name"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">メールアドレス</td>
												<td bgcolor="#FFFFFF">
														<?php echo $_REQUEST["email"];?>												</td>
										</tr>
										
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="続けて登録する" onClick="location.replace('?PID=promo_customer_reg');">
														<input type="button" name="Submit" value="一覧へ戻る"onClick="location.replace('?PID=promo_customer');">
														<input name="mode" type="hidden" id="mode" value="regist">
												</td>
										</tr>
							</table>
								<?php 
								}
								else {?>
								<?php
								if($errmess!=NULL) {
								?><table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
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
<div class="helper"> メール会員を登録します。    。<br>
          各項目を入力して<strong>「登録する」</strong>ボタンをクリックしてください。<br>
メールアドレスとメールアドレス確認には同じメールアドレスを入力してください。</div>
            <br>								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">名前</td>
												<td bgcolor="#FFFFFF">
														<input name="name" type="text" id="name" value="<?php echo $_REQUEST["name"];?>" style=" width:98%;">
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">メールアドレス</td>
												<td bgcolor="#FFFFFF">
														<input name="email" type="text" id="email" size="40" value="<?php echo $_REQUEST["email"];?>" style="ime-mode:disabled; width:98%;">
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">メールアドレス確認</td>
												<td bgcolor="#FFFFFF">
														<input name="email2" type="text" id="email2" size="40" value="<?php echo $_REQUEST["email2"];?>" style="ime-mode:disabled;width:98%;">
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="登録する" onClick="datachk()">
														<input type="button" name="Submit" value="一覧へ戻る"onClick="location.replace('?PID=promo_customer');">
														<input name="mode" type="hidden" id="mode" value="regist">
												</td>
										</tr>
							</table>
								<?php 
								}
								?>
						</td>
				</tr>
</form>
		</table>
