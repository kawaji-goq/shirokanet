<?php 
$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="addition"||$_REQUEST["mode"]=="additionandmail") {
	$upresult=$scheobj->Addition1($_POST);
}
$sql="select * from member where member_id =".$_GET["mem_id"]." order by turn";
$smdata=$dbobj->GetData($sql);

/*
if($_REQUEST["mode"]=="additionandmail") {
	$upresult=$scheobj->Addition($_POST);
}
*/

if($_REQUEST["PROCCESS"]=="tmpdel"&&$_REQUEST["temp_id"]!=NULL) {
	$tmpsql="delete from sche_temp  where temp_id= ".$_REQUEST["temp_id"];
	$tmpdata=$dbobj->GetData($tmpsql);
}

$sregdate=explode("-",$_REQUEST["rdate"]);
$gobj=new Group($dbobj);
$mobj=new Member($dbobj);

$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
$stmpsql="select * from sche_temp order by temp_id";
$stmpdata=$dbobj->GetData($stmpsql);

//$schedata=temp_id  sche_title  sche_text  view_chk  date_view  
//$scheobj->GetData($_REQUEST["sche_id"]);

?>
<script language="javascript">
function tempdel(frm) {
	var num1=frm.elements[10].selectedIndex;
	var num2=frm.elements[10].options[num1].value;
	window.location.href="/admin/index.php?PID=sche_add&rdate=<?php echo $_REQUEST["rdate"];?>&PROCCESS=tmpdel&temp_id="+num2;
}

function tmpchange(frm) {
	var num1=document.sche_form.elements[10].selectedIndex;
	var num2=document.sche_form.elements[10].options[num1].value;
	switch(num2) {
	<?php
	$tmprows=0;
	while($stmpdata[$tmprows]["temp_id"]!=NULL) {
	?>
		case "<?php echo $stmpdata[$tmprows]["temp_id"];?>":
			frm.title.value="<?php echo $stmpdata[$tmprows]["sche_title"];?>";
			frm.comment.value="<?php echo str_replace("\n","\\n",str_replace("\r","",$stmpdata[$tmprows]["sche_text"]));?>";
			frm.m_sbj.value="<?php echo $stmpdata[$tmprows]["m_sbj"];?>";
			frm.m_txt.value="<?php echo str_replace("\n","\\n",str_replace("\r","",$stmpdata[$tmprows]["m_txt"]));?>";
			frm.m_cc.value="<?php echo $stmpdata[$tmprows]["m_cc"];?>";
			frm.mail_type.value="<?php echo $stmpdata[$tmprows][send_type];?>";
			break;
		<?php
		$tmprows++;
	}
	?>
	}
}

function Groupchange(num) {

	var selnum=document.sche_form.elements[17].options[document.sche_form.elements[17].options.selectedIndex].value;
	createlist(num,selnum);
}

function Groupchange1(num) {

	var selnum=document.sche_form.elements[18].options[document.sche_form.elements[18].options.selectedIndex].value;
	createlist1(num,selnum);
}

function Groupchange2(num) {
	var selnum=document.sche_form.elements[22].options[document.sche_form.elements[22].options.selectedIndex].value;
	createlist2(num,selnum);
}

function createlist(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(19);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
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
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
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

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(22);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
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
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
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

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(26);
	var i=document.sche_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
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
			$GSList=$gobj->GetAllSelList($GAList[$grows-1]["group_id"]);
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
	
	while(oprows<document.sche_form.elements[19].length) {
		document.sche_form.elements[19].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
}

function datachk(frm) {
	if(frm.title.value=="") {
		alert("タイトルを入力して下さい。");
	}
	else{
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			
			frm.mode.value="addition";
			senddata();
		}
	}
}

function datachk2(frm) {
	if(frm.title.value=="") {
		alert("タイトルを入力して下さい。");
	}
	else{
		res=confirm("この内容で更新してもよろしいですか？");
		if(res) {
			
			frm.mode.value="additionandmail";
			senddata();
		}
	}
}

function txtcopy(frm) {
	frm.m_sbj.value=frm.title.value;
	frm.m_txt.value=frm.comment.value;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<div id="calender">
		<table width="100%"  border="0" align="left" cellpadding="3" cellspacing="1">
				<form action="" method="post" name="sche_form" id="sche_form">
						
						<tr>
								<td align="left" valign="middle">
										<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
												<tr>
														<td width="4%"><img src="/GW/img/template/icon_sche.jpg" width="40" height="42"></td>
														<td width="96%" class="title"><font color="#333333">スケジュール登録</font></td>
												</tr>
										</table>
								</td>
						</tr>
						<tr>
								<td align="left" valign="middle">
										<table width="625"  border="0" align="left" cellpadding="3" cellspacing="1">
												<tr>
														<td align="left" valign="middle">通常予定　|　<a href="?PID=sche_add2&rdate=<?php echo $_REQUEST["rdate"]; ?>&mem_id=<?php echo $_REQUEST["mem_id"]; ?>">翌日まで続く予定</a>　|　<a href="?PID=sche_add3&rdate=<?php echo $_REQUEST["rdate"]; ?>&mem_id=<?php echo $_REQUEST["mem_id"]; ?>">バナー予定</a></td>
												</tr>
												<tr>
														<td align="left" valign="top">
																<?php 
				if($_REQUEST["mode"]=="additionandmail") {
			
				}
				else {
?>
																<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>日付：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<select name="syear" id="syear">
																								<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
																								<option value="<?php echo ($sregdate[0]+$yrows);?>"<?php if(($sregdate[0]+$yrows)==$sregdate[0]) { echo "selected";}?>><?php echo ($sregdate[0]+$yrows);?>年</option>
																								<?php
									$yrows++;
								}
							?>
																						</select>
																						<strong>
																						<select name="smonth">
																								<option value="1"<?php if($sregdate[1]==1) { echo " selected";}?>>1月</option>
																								<option value="2"<?php if($sregdate[1]==2) { echo " selected";}?>>2月</option>
																								<option value="3"<?php if($sregdate[1]==3) { echo " selected";}?>>3月</option>
																								<option value="4"<?php if($sregdate[1]==4) { echo " selected";}?>>4月</option>
																								<option value="5"<?php if($sregdate[1]==5) { echo " selected";}?>>5月</option>
																								<option value="6"<?php if($sregdate[1]==6) { echo " selected";}?>>6月</option>
																								<option value="7"<?php if($sregdate[1]==7) { echo " selected";}?>>7月</option>
																								<option value="8"<?php if($sregdate[1]==8) { echo " selected";}?>>8月</option>
																								<option value="9"<?php if($sregdate[1]==9) { echo " selected";}?>>9月</option>
																								<option value="10"<?php if($sregdate[1]==10) { echo " selected";}?>>10月</option>
																								<option value="11"<?php if($sregdate[1]==11) { echo " selected";}?>>11月</option>
																								<option value="12"<?php if($sregdate[1]==12) { echo " selected";}?>>12月</option>
																						</select>
																						<select name="sday" id="sday">
																								<option<?php if($sregdate[2]==1) { echo " selected";}?> value="1">1日</option>
																								<option<?php if($sregdate[2]==2) { echo " selected";}?> value="2">2日</option>
																								<option<?php if($sregdate[2]==3) { echo " selected";}?> value="3">3日</option>
																								<option<?php if($sregdate[2]==4) { echo " selected";}?> value="4">4日</option>
																								<option<?php if($sregdate[2]==5) { echo " selected";}?> value="5">5日</option>
																								<option<?php if($sregdate[2]==6) { echo " selected";}?> value="6">6日</option>
																								<option<?php if($sregdate[2]==7) { echo " selected";}?> value="7">7日</option>
																								<option<?php if($sregdate[2]==8) { echo " selected";}?> value="8">8日</option>
																								<option<?php if($sregdate[2]==9) { echo " selected";}?> value="9">9日</option>
																								<option<?php if($sregdate[2]==10) { echo " selected";}?> value="10">10日</option>
																								<option<?php if($sregdate[2]==11) { echo " selected";}?> value="11">11日</option>
																								<option<?php if($sregdate[2]==12) { echo " selected";}?> value="12">12日</option>
																								<option<?php if($sregdate[2]==13) { echo " selected";}?> value="13">13日</option>
																								<option<?php if($sregdate[2]==14) { echo " selected";}?> value="14">14日</option>
																								<option<?php if($sregdate[2]==15) { echo " selected";}?> value="15">15日</option>
																								<option<?php if($sregdate[2]==16) { echo " selected";}?> value="16">16日</option>
																								<option<?php if($sregdate[2]==17) { echo " selected";}?> value="17">17日</option>
																								<option<?php if($sregdate[2]==18) { echo " selected";}?> value="18">18日</option>
																								<option<?php if($sregdate[2]==19) { echo " selected";}?> value="19">19日</option>
																								<option<?php if($sregdate[2]==20) { echo " selected";}?> value="20">20日</option>
																								<option<?php if($sregdate[2]==21) { echo " selected";}?> value="21">21日</option>
																								<option<?php if($sregdate[2]==22) { echo " selected";}?> value="22">22日</option>
																								<option<?php if($sregdate[2]==23) { echo " selected";}?> value="23">23日</option>
																								<option<?php if($sregdate[2]==24) { echo " selected";}?> value="24">24日</option>
																								<option<?php if($sregdate[2]==25) { echo " selected";}?> value="25">25日</option>
																								<option<?php if($sregdate[2]==26) { echo " selected";}?> value="26">26日</option>
																								<option<?php if($sregdate[2]==27) { echo " selected";}?> value="27">27日</option>
																								<option<?php if($sregdate[2]==28) { echo " selected";}?> value="28">28日</option>
																								<option<?php if($sregdate[2]==29) { echo " selected";}?> value="29">29日</option>
																								<option<?php if($sregdate[2]==30) { echo " selected";}?> value="30">30日</option>
																								<option<?php if($sregdate[2]==31) { echo " selected";}?> value="31">31日</option>
																						</select>
																						<input type="hidden" name="hiddenField">
																						<input type="hidden" name="hiddenField">
																						<input type="hidden" name="hiddenField">
																				</strong></td>
																		</tr>
																		<tr>
																				<td width="140" height="26" bgcolor="#ececec">
																						<div align="right"><strong>時刻：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF"><strong>
																						<?php 
								$nowhour=date("H");
								
								?>
																						<select name="shour" id="shour">
																								<option selected>--</option>
																								<option value="0">0時</option>
																								<option value="1">1時</option>
																								<option value="2">2時</option>
																								<option value="3">3時</option>
																								<option value="4">4時</option>
																								<option value="5"<?php if($nowhour==5){ echo " ";}?>>5時</option>
																								<option value="6"<?php if($nowhour==6){ echo " ";}?>>6時</option>
																								<option value="7"<?php if($nowhour==7){ echo " ";}?>>7時</option>
																								<option value="8"<?php if($nowhour==8){ echo " ";}?>>8時</option>
																								<option value="9"<?php if($nowhour==9){ echo " ";}?>>9時</option>
																								<option value="10"<?php if($nowhour==10){ echo " ";}?>>10時</option>
																								<option value="11"<?php if($nowhour==11){ echo " ";}?>>11時</option>
																								<option value="12"<?php if($nowhour==12){ echo " ";}?>>12時</option>
																								<option value="13"<?php if($nowhour==13){ echo " ";}?>>13時</option>
																								<option value="14"<?php if($nowhour==14){ echo " ";}?>>14時</option>
																								<option value="15"<?php if($nowhour==15){ echo " ";}?>>15時</option>
																								<option value="16"<?php if($nowhour==16){ echo " ";}?>>16時</option>
																								<option value="17"<?php if($nowhour==17){ echo " ";}?>>17時</option>
																								<option value="18"<?php if($nowhour==18){ echo " ";}?>>18時</option>
																								<option value="19"<?php if($nowhour==19){ echo " ";}?>>19時</option>
																								<option value="20"<?php if($nowhour==20){ echo " ";}?>>20時</option>
																								<option value="21"<?php if($nowhour==21){ echo " ";}?>>21時</option>
																								<option value="22"<?php if($nowhour==22){ echo " ";}?>>22時</option>
																								<option value="23"<?php if($nowhour==23){ echo " ";}?>>23時</option>
																								<option value="24"<?php if($nowhour==24){ echo " ";}?>>24時</option>
																						</select>
																						<select name="smin">
																								<option value="--" selected>--</option>
																								<option value="00" >00分</option>
																								<option value="30">30分</option>
																						</select>
																						〜
																						<?php 
							//$sftime=explode(":",$schedata["ftime"]);
							
							?>
																						<select name="fhour">
																								<option selected>--</option>
																								<option value="0">0時</option>
																								<option value="1">1時</option>
																								<option value="2">2時</option>
																								<option value="3">3時</option>
																								<option value="4">4時</option>
																								<option value="5"<?php if($nowhour==5){ echo " ";}?>>5時</option>
																								<option value="6"<?php if($nowhour==6){ echo " ";}?>>6時</option>
																								<option value="7"<?php if($nowhour==7){ echo " ";}?>>7時</option>
																								<option value="8"<?php if($nowhour==8){ echo " ";}?>>8時</option>
																								<option value="9"<?php if($nowhour==9){ echo " ";}?>>9時</option>
																								<option value="10"<?php if($nowhour==10){ echo " ";}?>>10時</option>
																								<option value="11"<?php if($nowhour==11){ echo " ";}?>>11時</option>
																								<option value="12"<?php if($nowhour==12){ echo " ";}?>>12時</option>
																								<option value="13"<?php if($nowhour==13){ echo " ";}?>>13時</option>
																								<option value="14"<?php if($nowhour==14){ echo " ";}?>>14時</option>
																								<option value="15"<?php if($nowhour==15){ echo " ";}?>>15時</option>
																								<option value="16"<?php if($nowhour==16){ echo " ";}?>>16時</option>
																								<option value="17"<?php if($nowhour==17){ echo " ";}?>>17時</option>
																								<option value="18"<?php if($nowhour==18){ echo " ";}?>>18時</option>
																								<option value="19"<?php if($nowhour==19){ echo " ";}?>>19時</option>
																								<option value="20"<?php if($nowhour==20){ echo " ";}?>>20時</option>
																								<option value="21"<?php if($nowhour==21){ echo " ";}?>>21時</option>
																								<option value="22"<?php if($nowhour==22){ echo " ";}?>>22時</option>
																								<option value="23"<?php if($nowhour==23){ echo " ";}?>>23時</option>
																								<option value="24"<?php if($nowhour==24){ echo " ";}?>>24時</option>
																						</select>
																						<select name="fmin">
																								<option value="--" selected>--</option>
																								<option value="00" >00分</option>
																								<option value="30">30分</option>
																						</select>
																				</strong></td>
																		</tr>
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>タイトル：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
																						<input name="tmp_id" type="hidden" id="tmp_id" />
																						<input type="hidden" name="day_view" id="day_view" value="1" />
																				</td>
																		</tr>
																		<tr>
																				<td width="140" valign="top" bgcolor="#ececec">
																						<div align="right"><strong> 内容：</strong></div>
																						<input name="mode" type="hidden" id="mode" value=" ">
																						<input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
																						<input name="member_id" type="hidden" id="member_id" value="<?php echo $logindata["member_id"]; ?>">
																				</td>
																				<td bgcolor="#FFFFFF">
																						<textarea name="comment" cols="50" rows="10" id="comment" style="width:98%;"></textarea>
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
																				<th width="140" align="right" valign="top" bgcolor="#ececec">参加者<strong>：</strong></th>
																				<td bgcolor="#FFFFFF">
																						<table  border="0" align="left" cellpadding="0" cellspacing="0">
																								<tr>
																										<th align="left">
																										    <select name="menu1" onChange="Groupchange(19)">
                                  <option value="0">全ユーザー</option>
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
																										<th align="left">
																												<select name="menu1" onChange="Groupchange1(22)">
																														<option value="0">全ユーザー</option>
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
																														<option value="<?php echo $_GET["mem_id"];?>"><?php echo $smdata["member_name"];?></option>
																												</select>
																										</td>
																										<td width="75">
																												<table width="95%"  border="0" cellspacing="5" cellpadding="5">
																														<tr>
																																<td align="center">
																																		<input type="button" name="Submit" value="←追加" onClick="func(22,19)">
																																</td>
																														</tr>
																														<tr>
																																<td align="center">
																																		<input type="button" name="Submit" value="削除→" onClick="func(19,22)">
																																</td>
																														</tr>
																												</table>
																										</td>
																										<td width="150">
																												<select name="nrlist" size="10" multiple id="nrlist" style="width:100%;">
																														<?php
								$mrows=0;
								while($mdata[$mrows]["member_id"]!=NULL) {
								?>
																														<option value="<?php echo $mdata[$mrows]["member_id"] ?>"> <?php echo $mdata[$mrows]["member_name"] ?> </option>
																														<?php
									$mrows++;
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
																<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
																		<TR>
																				<TD>
																						<input name="view_type" type="hidden" id="view_type" value="1" />
																				</TD>
																		</TR>
																		<TR>
																				<TD>
																						<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
																						<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
																						<input name="sche_add" type="button" id="sche_add" value="登録する" onClick="datachk(this.form)">
																						<input name="hisback" type="button" id="hisback" value="戻る" onClick="history.back()">
																				</TD>
																		</TR>
																</TABLE>
																<?php
				}
				?>
														</td>
												</tr>
												<tr>
														<td align="left" valign="top">
																<div id="div"> </div>
														</td>
												</tr>
										</table>
								</td>
						</tr>
				</form>
		</table>
</div>
