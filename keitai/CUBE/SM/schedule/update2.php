<?php 

$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="update"||$_REQUEST["mode"]=="updateandmail") {

	$upresult=$scheobj->Update2($_POST);
	if($_REQUEST["mode"]=="updateandmail"){
	?>
<script language="javascript">
	window.location.replace('index.php?PID=sche_mail_send&sche_id=<?php echo $_POST["sche_id"]; ?>');
	</script>
	<?php
	}
	else {
	?>
<script language="javascript">
	window.location.replace('index.php?PID=schedule');
	</script>
	<?php
	}
}
if($_REQUEST["mode"]=="mail_send") {
		$upresult=$scheobj->Mail_Send($_POST);
}

if($_REQUEST["mode"]=="delete") {
	$upresult=$scheobj->Delete($_POST);
}

$sql="SELECT schedule.*, member.*, schedule_master.schedule_id
			FROM member INNER JOIN (schedule INNER JOIN schedule_master ON 
			schedule.schedule_id = schedule_master.schedule_id) ON member.member_id = schedule_master.member_id
			WHERE (((schedule_master.schedule_id)=".$_REQUEST["sche_id"]."))";
$schedata=$dbobj->GetData($sql);

$schedata=$scheobj->GetList11($_REQUEST["sche_id"]);
$schedata=$schedata[0];

if($schedata["fyear"]==NULL) {
	$schedata["fyear"]=$schedata["syear"];
	$schedata["fmonth"]=$schedata["smonth"];
	$schedata["fday"]=$schedata["sday"];
}

$mselList=$scheobj->GetSelList($_REQUEST["sche_id"]);
$mList=$scheobj->GetMList();

$Gobj=new Group($dbobj);
$GAList=$Gobj->GetAllList();
$mAttendList=$scheobj->GetMailLogList($_REQUEST["sche_id"],"");

?>
<script language="javascript">
function Groupchange(num) {
	var selnum=document.sche_form.elements[14].options[document.sche_form.elements[14].options.selectedIndex].value;
	createlist(num,selnum);
}
function Groupchange1(num) {
	var selnum=document.sche_form.elements[15].options[document.sche_form.elements[15].options.selectedIndex].value;
	createlist1(num,selnum);
}
function Groupchange2(num) {
	var selnum=document.mail_sendform1.elements[0].options[document.mail_sendform1.elements[0].options.selectedIndex].value;
	createlist2(num,selnum);
}
function datachk5() {
	senddata2();
	document.mail_sendform1.submit();
}

function createlist(num,num2) {
//	var addary2=new Array();
<?php
$newary1="";
$newary2="";

$GAList=$Gobj->GetAllList();
$GSList=$Gobj->GetAllSelList("");

?>
	clearlist(16);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
			<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
				if($grows2!=0){
				//$newary1.=",";
				//$newary2.=",";		
				}?>
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$Gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
			<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}
function createlist1(num,num2) {
//	var addary2=new Array();
<?php
$newary1="";
$newary2="";

$GAList=$Gobj->GetAllList();
$GSList=$Gobj->GetAllSelList("");

?>
	clearlist(19);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
			<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
				if($grows2!=0){
				//$newary1.=",";
				//$newary2.=",";		
				}?>
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$Gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.sche_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
			<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}

function createlist2(num,num2) {
//	var addary2=new Array();
<?php
$newary1="";
$newary2="";

$GAList=$Gobj->GetAllList();
$GSList=$Gobj->GetAllSelList("");

?>
	clearlist2(4);
	var i=document.mail_sendform1.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
			<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
				if($grows2!=0){
				//$newary1.=",";
				//$newary2.=",";		
				}?>
				document.mail_sendform1.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
				<?php
				$grows2++;
			}
			?>
		break;
		<?php 
		$grows=1;
		while($GAList[$grows-1]["group_id"]!=NULL) {
			$GSList="";
			$newary1="";
			$newary2="";
			$GSList=$Gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
			$grows2=0;
			?>
			case "<?php echo $GAList[$grows-1]["group_id"];?>" :
			<?php 
			while($GSList[$grows2]["member_id"]!=NULL) {
			?>
				document.mail_sendform1.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
			<?php
				$grows2++;
			}
			?>
			break;
			<?php
			$grows++;
		}
		?>
	}
}

function chklist(num,id) {
	var i=document.sche_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.sche_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

function chklist2(num,id) {
	var i=document.mail_sendform1.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.mail_sendform1.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

function clearlist(num) {
	var i=document.sche_form.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.sche_form.elements[num].options[j]!=null) {
			document.sche_form.elements[num].options[j]=null;
			j++;
		}
		i=document.sche_form.elements[num].length;
		if(i!=0) {
			clearlist(num);
		}
	}
}
function clearlist2(num) {
	var i=document.mail_sendform1.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.mail_sendform1.elements[num].options[j]!=null) {
			document.mail_sendform1.elements[num].options[j]=null;
			j++;
		}
		i=document.mail_sendform1.elements[num].length;
		if(i!=0) {
			clearlist2(num);
		}
	}
}

function datachk(frm) {
	res=confirm("この内容で更新してもよろしいですか？");
	if(res) {
		frm.mode.value="update";
		senddata();
		frm.submit();
	}
}

function datachk2(frm) {
	res=confirm("この内容で更新してもよろしいですか？");
	if(res) {
		frm.mode.value="updateandmail";
		senddata();
		frm.submit();
	}
}
function delchk(frm) {
	res=confirm("このスケジュールを削除してもよろしいですか？");
	if(res) {
		frm.mode.value="delete";
		frm.submit();
	}
}

function chklist(num,id) {
	var i=document.sche_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.sche_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}
function chklist2(num,id) {
	var i=document.mail_sendform1.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.mail_sendform1.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.sche_form.elements[selectnum].selectedIndex != -1) {
		var test=document.sche_form.elements[selectnum2].length;
		var res=chklist(selectnum2,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		if(res) {
			document.sche_form.elements[selectnum2].options[test]
			= new Option(document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].text,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		}
		if(selectnum<selectnum2) {
			document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex] = new Option(document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].text,document.sche_form.elements[selectnum].options[document.sche_form.elements[selectnum].selectedIndex].value);
		}
	}
	
}
//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.sche_form.elements[16].length) {
		document.sche_form.elements[16].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
}
//リスト内の移動をする関数
function func2(selectnum,selectnum2) {
	while (document.mail_sendform1.elements[selectnum].selectedIndex != -1) {
		var test=document.mail_sendform1.elements[selectnum2].length;
		var res=chklist2(selectnum2,document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex].value);
		if(res) {
			document.mail_sendform1.elements[selectnum2].options[test]
			= new Option(document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex].text,document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex].value);
		}
		if(selectnum<selectnum2) {
			document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex] = new Option(document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex].text,document.mail_sendform1.elements[selectnum].options[document.mail_sendform1.elements[selectnum].selectedIndex].value);
		}
	}
	
}
function senddata2() {
	var oprows=0;
	while(oprows<document.mail_sendform1.elements[1].length) {
		document.mail_sendform1.elements[1].options[oprows].selected=true;
		oprows++;
	}
	
	document.mail_sendform1.submit();
}

function txtcopy(frm) {
	frm.m_sbj.value=frm.title.value;
	frm.m_txt.value=frm.comment.value;
	frm
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<div id="calender">
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
				
				<tr>
						<td>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
										<tr>
												<td width="4%"><img src="/GW/img/template/icon_sche.jpg" width="40" height="42"></td>
												<td width="96%" class="title"><font color="#333333">スケジュール変更</font></td>
										</tr>
								</table>
						</td>
				</tr>
				<tr>
						<td>
								<table width="625"  border="0" align="left" cellpadding="3" cellspacing="1">
										<tr>
												<td align="left" valign="middle">&nbsp; </td>
										</tr>
										<tr>
												<td align="left" valign="top">
														<form action="" method="post" name="sche_form" id="sche_form">
																<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>開始日時：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<select name="syear" id="syear">
																								<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
																								<option value="<?php echo ($schedata["syear"]+$yrows);?>"<?php if(($schedata["syear"]+$yrows)==$schedata["syear"]) { echo "selected";}?>><?php echo ($schedata["syear"]+$yrows);?>年</option>
																								<?php
									$yrows++;
								}
							?>
																						</select>
																						<strong>
																						<select name="smonth">
																								<option value="1"<?php if($schedata["smonth"]==1) { echo " selected";}?>>1月</option>
																								<option value="2"<?php if($schedata["smonth"]==2) { echo " selected";}?>>2月</option>
																								<option value="3"<?php if($schedata["smonth"]==3) { echo " selected";}?>>3月</option>
																								<option value="4"<?php if($schedata["smonth"]==4) { echo " selected";}?>>4月</option>
																								<option value="5"<?php if($schedata["smonth"]==5) { echo " selected";}?>>5月</option>
																								<option value="6"<?php if($schedata["smonth"]==6) { echo " selected";}?>>6月</option>
																								<option value="7"<?php if($schedata["smonth"]==7) { echo " selected";}?>>7月</option>
																								<option value="8"<?php if($schedata["smonth"]==8) { echo " selected";}?>>8月</option>
																								<option value="9"<?php if($schedata["smonth"]==9) { echo " selected";}?>>9月</option>
																								<option value="10"<?php if($schedata["smonth"]==10) { echo " selected";}?>>10月</option>
																								<option value="11"<?php if($schedata["smonth"]==11) { echo " selected";}?>>11月</option>
																								<option value="12"<?php if($schedata["smonth"]==12) { echo " selected";}?>>12月</option>
																						</select>
																						<select name="sday" id="sday">
																								<option<?php if($schedata["sday"]==1) { echo " selected";}?> value="1">1日</option>
																								<option<?php if($schedata["sday"]==2) { echo " selected";}?> value="2">2日</option>
																								<option<?php if($schedata["sday"]==3) { echo " selected";}?> value="3">3日</option>
																								<option<?php if($schedata["sday"]==4) { echo " selected";}?> value="4">4日</option>
																								<option<?php if($schedata["sday"]==5) { echo " selected";}?> value="5">5日</option>
																								<option<?php if($schedata["sday"]==6) { echo " selected";}?> value="6">6日</option>
																								<option<?php if($schedata["sday"]==7) { echo " selected";}?> value="7">7日</option>
																								<option<?php if($schedata["sday"]==8) { echo " selected";}?> value="8">8日</option>
																								<option<?php if($schedata["sday"]==9) { echo " selected";}?> value="9">9日</option>
																								<option<?php if($schedata["sday"]==10) { echo " selected";}?> value="10">10日</option>
																								<option<?php if($schedata["sday"]==11) { echo " selected";}?> value="11">11日</option>
																								<option<?php if($schedata["sday"]==12) { echo " selected";}?> value="12">12日</option>
																								<option<?php if($schedata["sday"]==13) { echo " selected";}?> value="13">13日</option>
																								<option<?php if($schedata["sday"]==14) { echo " selected";}?> value="14">14日</option>
																								<option<?php if($schedata["sday"]==15) { echo " selected";}?> value="15">15日</option>
																								<option<?php if($schedata["sday"]==16) { echo " selected";}?> value="16">16日</option>
																								<option<?php if($schedata["sday"]==17) { echo " selected";}?> value="17">17日</option>
																								<option<?php if($schedata["sday"]==18) { echo " selected";}?> value="18">18日</option>
																								<option<?php if($schedata["sday"]==19) { echo " selected";}?> value="19">19日</option>
																								<option<?php if($schedata["sday"]==20) { echo " selected";}?> value="20">20日</option>
																								<option<?php if($schedata["sday"]==21) { echo " selected";}?> value="21">21日</option>
																								<option<?php if($schedata["sday"]==22) { echo " selected";}?> value="22">22日</option>
																								<option<?php if($schedata["sday"]==23) { echo " selected";}?> value="23">23日</option>
																								<option<?php if($schedata["sday"]==24) { echo " selected";}?> value="24">24日</option>
																								<option<?php if($schedata["sday"]==25) { echo " selected";}?> value="25">25日</option>
																								<option<?php if($schedata["sday"]==26) { echo " selected";}?> value="26">26日</option>
																								<option<?php if($schedata["sday"]==27) { echo " selected";}?> value="27">27日</option>
																								<option<?php if($schedata["sday"]==28) { echo " selected";}?> value="28">28日</option>
																								<option<?php if($schedata["sday"]==29) { echo " selected";}?> value="29">29日</option>
																								<option<?php if($schedata["sday"]==30) { echo " selected";}?> value="30">30日</option>
																								<option<?php if($schedata["sday"]==31) { echo " selected";}?> value="31">31日</option>
																						</select>
																						<?php 
							$sstime=explode(":",$schedata["stime"]);
							?>
																						<select name="shour" id="shour">
																								<option<?php if($sstime[0]==NULL){ echo " selected";}?>>--</option>
																								<option<?php if($sstime[0]==0&&$sstime[0]!=NULL){ echo " selected";}?> value="0">0時</option>
																								<option<?php if($sstime[0]==1){ echo " selected";}?> value="1">1時</option>
																								<option<?php if($sstime[0]==2){ echo " selected";}?> value="2">2時</option>
																								<option<?php if($sstime[0]==3){ echo " selected";}?> value="3">3時</option>
																								<option<?php if($sstime[0]==4){ echo " selected";}?> value="4">4時</option>
																								<option<?php if($sstime[0]==5){ echo " selected";}?> value="5">5時</option>
																								<option<?php if($sstime[0]==6){ echo " selected";}?> value="6">6時</option>
																								<option<?php if($sstime[0]==7){ echo " selected";}?> value="7">7時</option>
																								<option<?php if($sstime[0]==8){ echo " selected";}?> value="8">8時</option>
																								<option<?php if($sstime[0]==9){ echo " selected";}?> value="9">9時</option>
																								<option<?php if($sstime[0]==10){ echo " selected";}?> value="10">10時</option>
																								<option<?php if($sstime[0]==11){ echo " selected";}?> value="11">11時</option>
																								<option<?php if($sstime[0]==12){ echo " selected";}?> value="12">12時</option>
																								<option<?php if($sstime[0]==13){ echo " selected";}?> value="13">13時</option>
																								<option<?php if($sstime[0]==14){ echo " selected";}?> value="14">14時</option>
																								<option<?php if($sstime[0]==15){ echo " selected";}?> value="15">15時</option>
																								<option<?php if($sstime[0]==16){ echo " selected";}?> value="16">16時</option>
																								<option<?php if($sstime[0]==17){ echo " selected";}?> value="17">17時</option>
																								<option<?php if($sstime[0]==18){ echo " selected";}?> value="18">18時</option>
																								<option<?php if($sstime[0]==19){ echo " selected";}?> value="19">19時</option>
																								<option<?php if($sstime[0]==20){ echo " selected";}?> value="20">20時</option>
																								<option<?php if($sstime[0]==21){ echo " selected";}?> value="21">21時</option>
																								<option<?php if($sstime[0]==22){ echo " selected";}?> value="22">22時</option>
																								<option<?php if($sstime[0]==23){ echo " selected";}?> value="23">23時</option>
																								<option<?php if($sstime[0]==24){ echo " selected";}?> value="24">24時</option>
																						</select>
																						<select name="smin">
																								<option<?php if($sstime[1]==NULL){ echo " selected";}?>>--</option>
																								<option value="00"<?php if($sstime[1]==0&&$sstime[1]!=NULL){ echo " selected";}?>>00分</option>
																								<option value="30"<?php if($sstime[1]==30){ echo " selected";}?>>30分</option>
																						</select>
																								〜</strong></td>
																		</tr>
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>終了日時：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF"><strong>
																						<select name="fyear" id="fyear">
																								<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
																								<option value="<?php echo ($schedata["fyear"]+$yrows);?>"<?php if(($schedata["fyear"]+$yrows)==$schedata["fyear"]) { echo "selected";}?>><?php echo ($schedata["fyear"]+$yrows);?>年</option>
																								<?php
									$yrows++;
								}
							?>
																						</select>
																						<select name="fmonth">
																								<option value="1"<?php if($schedata["fmonth"]==1) { echo " selected";}?>>1月</option>
																								<option value="2"<?php if($schedata["fmonth"]==2) { echo " selected";}?>>2月</option>
																								<option value="3"<?php if($schedata["fmonth"]==3) { echo " selected";}?>>3月</option>
																								<option value="4"<?php if($schedata["fmonth"]==4) { echo " selected";}?>>4月</option>
																								<option value="5"<?php if($schedata["fmonth"]==5) { echo " selected";}?>>5月</option>
																								<option value="6"<?php if($schedata["fmonth"]==6) { echo " selected";}?>>6月</option>
																								<option value="7"<?php if($schedata["fmonth"]==7) { echo " selected";}?>>7月</option>
																								<option value="8"<?php if($schedata["fmonth"]==8) { echo " selected";}?>>8月</option>
																								<option value="9"<?php if($schedata["fmonth"]==9) { echo " selected";}?>>9月</option>
																								<option value="10"<?php if($schedata["fmonth"]==10) { echo " selected";}?>>10月</option>
																								<option value="11"<?php if($schedata["fmonth"]==11) { echo " selected";}?>>11月</option>
																								<option value="12"<?php if($schedata["fmonth"]==12) { echo " selected";}?>>12月</option>
																						</select>
																						<select name="fday" id="fday">
																								<option<?php if($schedata["fday"]==1) { echo " selected";}?> value="1">1日</option>
																								<option<?php if($schedata["fday"]==2) { echo " selected";}?> value="2">2日</option>
																								<option<?php if($schedata["fday"]==3) { echo " selected";}?> value="3">3日</option>
																								<option<?php if($schedata["fday"]==4) { echo " selected";}?> value="4">4日</option>
																								<option<?php if($schedata["fday"]==5) { echo " selected";}?> value="5">5日</option>
																								<option<?php if($schedata["fday"]==6) { echo " selected";}?> value="6">6日</option>
																								<option<?php if($schedata["fday"]==7) { echo " selected";}?> value="7">7日</option>
																								<option<?php if($schedata["fday"]==8) { echo " selected";}?> value="8">8日</option>
																								<option<?php if($schedata["fday"]==9) { echo " selected";}?> value="9">9日</option>
																								<option<?php if($schedata["fday"]==10) { echo " selected";}?> value="10">10日</option>
																								<option<?php if($schedata["fday"]==11) { echo " selected";}?> value="11">11日</option>
																								<option<?php if($schedata["fday"]==12) { echo " selected";}?> value="12">12日</option>
																								<option<?php if($schedata["fday"]==13) { echo " selected";}?> value="13">13日</option>
																								<option<?php if($schedata["fday"]==14) { echo " selected";}?> value="14">14日</option>
																								<option<?php if($schedata["fday"]==15) { echo " selected";}?> value="15">15日</option>
																								<option<?php if($schedata["fday"]==16) { echo " selected";}?> value="16">16日</option>
																								<option<?php if($schedata["fday"]==17) { echo " selected";}?> value="17">17日</option>
																								<option<?php if($schedata["fday"]==18) { echo " selected";}?> value="18">18日</option>
																								<option<?php if($schedata["fday"]==19) { echo " selected";}?> value="19">19日</option>
																								<option<?php if($schedata["fday"]==20) { echo " selected";}?> value="20">20日</option>
																								<option<?php if($schedata["fday"]==21) { echo " selected";}?> value="21">21日</option>
																								<option<?php if($schedata["fday"]==22) { echo " selected";}?> value="22">22日</option>
																								<option<?php if($schedata["fday"]==23) { echo " selected";}?> value="23">23日</option>
																								<option<?php if($schedata["fday"]==24) { echo " selected";}?> value="24">24日</option>
																								<option<?php if($schedata["fday"]==25) { echo " selected";}?> value="25">25日</option>
																								<option<?php if($schedata["fday"]==26) { echo " selected";}?> value="26">26日</option>
																								<option<?php if($schedata["fday"]==27) { echo " selected";}?> value="27">27日</option>
																								<option<?php if($schedata["fday"]==28) { echo " selected";}?> value="28">28日</option>
																								<option<?php if($schedata["fday"]==29) { echo " selected";}?> value="29">29日</option>
																								<option<?php if($schedata["fday"]==30) { echo " selected";}?> value="30">30日</option>
																								<option<?php if($schedata["fday"]==31) { echo " selected";}?> value="31">31日</option>
																						</select>
																						<?php 
							$sftime=explode(":",$schedata["ftime"]);
							
							?>
																						<select name="fhour">
																								<option<?php if($sftime[0]==NULL){ echo " selected";}?>>--</option>
																								<option<?php if($sftime[0]==0&&$sstime[0]!=NULL){ echo " selected";}?> value="0">0時</option>
																								<option<?php if($sftime[0]==1){ echo " selected";}?> value="1">1時</option>
																								<option<?php if($sftime[0]==2){ echo " selected";}?> value="2">2時</option>
																								<option<?php if($sftime[0]==3){ echo " selected";}?> value="3">3時</option>
																								<option<?php if($sftime[0]==4){ echo " selected";}?> value="4">4時</option>
																								<option<?php if($sftime[0]==5){ echo " selected";}?> value="5">5時</option>
																								<option<?php if($sftime[0]==6){ echo " selected";}?> value="6">6時</option>
																								<option<?php if($sftime[0]==7){ echo " selected";}?> value="7">7時</option>
																								<option<?php if($sftime[0]==8){ echo " selected";}?> value="8">8時</option>
																								<option<?php if($sftime[0]==9){ echo " selected";}?> value="9">9時</option>
																								<option<?php if($sftime[0]==10){ echo " selected";}?> value="10">10時</option>
																								<option<?php if($sftime[0]==11){ echo " selected";}?> value="11">11時</option>
																								<option<?php if($sftime[0]==12){ echo " selected";}?> value="12">12時</option>
																								<option<?php if($sftime[0]==13){ echo " selected";}?> value="13">13時</option>
																								<option<?php if($sftime[0]==14){ echo " selected";}?> value="14">14時</option>
																								<option<?php if($sftime[0]==15){ echo " selected";}?> value="15">15時</option>
																								<option<?php if($sftime[0]==16){ echo " selected";}?> value="16">16時</option>
																								<option<?php if($sftime[0]==17){ echo " selected";}?> value="17">17時</option>
																								<option<?php if($sftime[0]==18){ echo " selected";}?> value="18">18時</option>
																								<option<?php if($sftime[0]==19){ echo " selected";}?> value="19">19時</option>
																								<option<?php if($sftime[0]==20){ echo " selected";}?> value="20">20時</option>
																								<option<?php if($sftime[0]==21){ echo " selected";}?> value="21">21時</option>
																								<option<?php if($sftime[0]==22){ echo " selected";}?> value="22">22時</option>
																								<option<?php if($sftime[0]==23){ echo " selected";}?> value="23">23時</option>
																								<option<?php if($sftime[0]==24){ echo " selected";}?> value="24">24時</option>
																						</select>
																						<select name="fmin">
																								<option<?php if($sftime[1]==NULL){ echo " selected";}?>>--</option>
																								<option value="0"<?php if($sftime[1]==0&&$sftime[1]!=NULL){ echo " selected";}?>>00分</option>
																								<option value="30"<?php if($sftime[1]==30){ echo " selected";}?>>30分</option>
																						</select>
																				</strong></td>
																		</tr>
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>予定：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
																						<input name="day_view" type="hidden" id="day_view" value="0" />
																						<input name="view_type" type="hidden" id="view_type" value="1" />
																				</td>
																		</tr>
																		<tr>
																				<td width="140" valign="top" bgcolor="#ececec">
																						<div align="right"><strong> メモ：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<?php /*
								$fckobject=new FCKeditor("comment");
								$fckobject->BasePath="/FCKeditor/";
								$fckobject->Width=500;
								$fckobject->Height=400;
								$fckobject->ToolbarSet='Mymenu';
								$fckobject->Value=$schedata["comment"];
								$fckobject->Create();
								*/
								?>
																						<textarea name="comment" cols="50" rows="10" id="comment"><?php echo $schedata["comment"]; ?></textarea>
																				</td>
																		</tr>
																</table>
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																				<td>&nbsp;</td>
																		</tr>
																</table>
																<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																		<tr>
																				<th width="140" align="right" valign="top" bgcolor="#ececec">参加者 <strong>：</strong></th>
																				<td bgcolor="#FFFFFF">
																				    <table width="375"  border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <th width="150" align="left">
                                    <select name="menu1" onChange="Groupchange(16)">
                                        <option value="" selected>個別選択</option>
                                        <option value="0">全会員</option>
                                        <?php
										   	$GAROWS=0;
											while($GAList[$GAROWS]["group_id"]!=NULL) {
												echo "<option value=\"".$GAList[$GAROWS]["group_id"]."\">".$GAList[$GAROWS]["group_name"]."</option>";
												$GAROWS++;
											}
										   ?>
                                    </select>
                                </th>
                                <td>&nbsp;</td>
                                <th width="150" align="left">
                                    <select name="menu1" onChange="Groupchange1(19)">
                                        <option value="" selected>個別選択</option>
                                        <option value="0">全会員</option>
                                        <?php
										   	$GAROWS=0;
											while($GAList[$GAROWS]["group_id"]!=NULL) {
												echo "<option value=\"".$GAList[$GAROWS]["group_id"]."\">".$GAList[$GAROWS]["group_name"]."</option>";
												$GAROWS++;
											}
										   ?>
                                    </select>
                                </th>
                            </tr>
                            <tr>
                                <td width="150">
                                    <select name="rlist[]" size="10" multiple id="rlist[]" style="width:100%;">
                                        <?php
								$mrows=0;
								while($mselList[$mrows]["member_id"]!=NULL) {
								?>
                                        <option value="<?php echo $mselList[$mrows]["member_id"] ?>"> <?php echo $mselList[$mrows]["member_name"] ?> </option>
                                        <?php
									$mrows++;
								}
								?>
                                    </select>
                                </td>
                                <td width="75">
                                    <table width="95%"  border="0" cellspacing="5" cellpadding="5">
                                        <tr>
                                            <td align="center">
                                                <input type="button" name="Submit" value="←追加" onClick="func(19,16)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <input type="button" name="Submit" value="削除→" onClick="func(16,19)">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="150">
                                    <select name="nrlist" size="10" multiple id="nrlist" style="width:100%;">
                                        <?php
$GSList=$Gobj->GetAllSelList("");
$grows2=0;
while($GSList[$grows2]["member_id"]!=NULL) {
	echo "<option value=\"".$GSList[$grows2]["member_id"]."\">".$GSList[$grows2]["member_name"]."</option>";
	$grows2++;
}
?>
                                    </select>
                                </td>
                            </tr>
                        </table>
																				</td>
																		</tr>
																</table>
																<table width="100%" border="0" cellspacing="0" cellpadding="0">
																		<tr>
																				<td>&nbsp;</td>
																		</tr>
																</table>
																<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
																		<tr>
																				<td width="140">
																						<input name="mode" type="hidden" id="mode" value=" ">
																						<input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
																						<input name="member_id" type="hidden" id="member_id" value="0">
																				</td>
																		</tr>
																		<tr>
																				<td height="30">
																						<input name="sche_up" type="button" id="sche_up" value="更新する" onClick="datachk(this.form)">
																						<input name="sche_del" type="submit" id="sche_del" value="削除する" onClick="delchk(this.form)">
																						<input name="hisback" type="button" id="hisback" value="戻る" onClick="history.back()">
																				</td>
																		</tr>
																		<tr>
																				<td>&nbsp;</td>
																		</tr>
																</table>
														</form>
												</td>
										</tr>
										<tr>
												<td align="left" valign="top">
														<div id="div">
																<form name="mail_sendform1" method="post" action="">
																</form>
														</div>
												</td>
										</tr>
								</table>
						</td>
				</tr>
		</table>
</div>
