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

if($_POST["mode"]=="delete") {
		$mcusdata=$dbobj->GetData("select * from mail_customer where id='".$_REQUEST["id"]."'");
	
		$insql="delete from  mail_customer where id = '".$_POST["id"]."'";
		$chkres=$dbobj->Query($insql);
		$sql="delete from firstcoupon_log where mailcode = '".($mcusdata["mailcode"]."'");
		//echo $sql;
		$result=$dbobj->Query($sql);
		if($chkres) {
			?>
			<script language="javascript">
			location.replace("?PID=promo_customer");
			</script>
			<?php
			
		}
}
$mcusdata=$dbobj->GetData("select * from mail_customer where id='".$_REQUEST["id"]."'");
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
	frm=document.update_form;
	res=confirm("このアドレスを削除します。");
	if(res) {
		frm.submit();
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
																		<td class="font10"> <strong>メール会員削除</strong> </td>
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
								if($errmess!=NULL) {
								?>
								<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
												<td width="150" valign="top" bgcolor="#EBEBEB">名前</td>
												<td bgcolor="#FFFFFF">
														<?php echo $mcusdata["name"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">メールアドレス</td>
												<td bgcolor="#FFFFFF">
														<?php echo $mcusdata["email"];?>												</td>
										</tr>
										
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="削除する" onClick="datachk()">
														<input type="button" name="Submit" value="一覧へ戻る"onClick="location.replace('?PID=promo_customer');">
														<input name="mode" type="hidden" id="mode" value="delete">
														<input name="oldemail" type="hidden" id="oldemail" value="<?php echo $mcusdata["email"];?>">
														<input name="id" type="hidden" id="id" value="<?php echo $_REQUEST["id"]; ?>">
												</td>
										</tr>
							</table>
						</td>
				</tr>
</form>
		</table>
