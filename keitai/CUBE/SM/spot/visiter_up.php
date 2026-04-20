<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="javascript">
function datachkx() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(frm.counter==null||frm.counter=="") {
		 alerttxt="来場数を入力してください。";
		 alertchk=1;
	}
	
	if(alertchk==0) {
		res=confirm("この内容で登録します。");
		if(res) {
			frm.pmode.value="regist";
			frm.submit();
		}
	}
	else {
		alert(alerttxt);
	}
}
</script>
<?php
$today=explode("-",date("Y-m-d"));
$bdate=mktime(0,0,0,$today[1],$today[2],$today[0]);
$edate=mktime(0,0,0,$today[1],$today[2]-7,$today[0]);
if($_REQUEST["pmode"]=="regist") {
	$chkres=$dbobj->Query("select * from number_of_visitors where rdate=".mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]));
	
	$chknum=$dbobj->NumRows($chkres);
	$sumdata=$dbobj->GetData("select sum(counter) as sumcount from number_of_visitors where rdate <= ".mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]));
	
	if($chknum==0){
	
		$insql="insert into number_of_visitors values(".mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]).",".$_POST["counter"].",".$sumdata["sumcount"].")";
		$chkres=$dbobj->Query($insql);
	}
	else {
		$insql="update number_of_visitors set counter = ".$_POST["counter"].",sumcounter=".$sumdata["sumcount"]." where rdate = ".mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]);
		$chkres=$dbobj->Query($insql);
	}		
}
$countdata=$dbobj->GetData("select * from number_of_visitors where rdate=".$_REQUEST["rdate"]);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700" border="0" align="left">
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<form id="update_form" name="update_form" method="post" action="">
								<?php 
if($_REQUEST["pmode"]=="regist") {
?>
								<table width="510" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td align="left" bgcolor="#EBEBEB">日付</td>
												<td align="left" bgcolor="#FFFFFF"><?php echo $ryear."-".$rmonth."-".$rday;?></td>
										</tr>
										<tr>
												<td width="100" align="left" bgcolor="#EBEBEB">来訪数</td>
												<td width="400" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["counter"];?></td>
										</tr>
										<tr>
												<td align="left" bgcolor="#EBEBEB">&nbsp;</td>
												<td align="left" bgcolor="#FFFFFF">
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=spot_visiter')" />
												</td>
										</tr>
										<?php if($newssetting["image_chk"]==1) {?>
										<?php }?>
								</table>
								<?php
		}
		else {
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
//-->
</script>
								<table width="510" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<?php
		if($countdata["rdate"]!=NULL) {
			$exday=explode("-",date("Y-m-d",$countdata["rdate"]));
		}
		else {
			$exday=explode("-",date("Y-m-d"));
		}
		
		$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
		$year=$exday[0];
		$month=$exday[1];
		$day=$exday[2];
		?>
										<tr>
												<td rowspan="1" align="left" valign="top" bgcolor="#EBEBEB">日付
														<input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
												</td>
												<td align="left" bgcolor="#FFFFFF">
														<select name="ryear" id="ryear" onchange="check3()">
																<option value="">--</option>
																<?php
			for($yi=-1;$yi<2;$yi++) {
				?>
																<option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
																<?php
			}
			?>
														</select>
														年
														<select name="rmonth" id="rmonth" onchange="check3()">
																<option value="">--</option>
																<?php
			for($mi=1;$mi<13;$mi++) {
				?>
																<option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>>
																<?php if($mi<10) {echo "0";}echo $mi;?>
																</option>
																<?php
			}

			?>
														</select>
														月
														<select name="rday" id="rday">
																<option value="">--</option>
																<?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
																<option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>>
																<?php if($di<10) {echo "0";}echo $di;?>
																</option>
																<?php
			}

			?>
														</select>
														日 </td>
										</tr>
										<tr>
												<td width="100" align="left" valign="top" bgcolor="#EBEBEB">来訪数</td>
												<td width="400" align="left" bgcolor="#FFFFFF">
														<input name="counter" type="text" id="counter" value="<?php echo $countdata["counter"]; ?>" size="20" style="ime-mode:disabled"/>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td align="left" bgcolor="#FFFFFF">
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onclick="datachkx()" />
														<input name="pmode" type="hidden" id="pmode" value="regist" />
														<input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=spot_visiter')" />
												</td>
										</tr>
								</table>
								<script>
		day_chk();
					</script>
								<?php
		  }
		  ?>
						</form>
				</td>
		</tr>
</table>
