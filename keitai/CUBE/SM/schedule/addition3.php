<?php 
$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="addition"||$_REQUEST["mode"]=="additionandmail") {
	$upresult=$scheobj->Addition3($_POST);
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

	var selnum=document.sche_form.elements[18].options[document.sche_form.elements[18].options.selectedIndex].value;
	createlist(num,selnum);
}

function Groupchange1(num) {

	var selnum=document.sche_form.elements[19].options[document.sche_form.elements[19].options.selectedIndex].value;
	createlist1(num,selnum);
}

function Groupchange2(num) {
	var selnum=document.sche_form.elements[23].options[document.sche_form.elements[23].options.selectedIndex].value;
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
	clearlist(20);
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
	clearlist(23);
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
	clearlist(27);
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
	
	while(oprows<document.sche_form.elements[20].length) {
		document.sche_form.elements[20].options[oprows].selected=true;
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
		<table width="100%" border="0" cellspacing="1" cellpadding="3">
				
				<tr>
						<td>
								<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
										<tr>
												<td width="4%"><img src="/GW/img/template/icon_sche.jpg" width="40" height="42"></td>
												<td width="96%" class="title"><font color="#333333">スケジュール登録</font></td>
										</tr>
								</table>
						</td>
				</tr>
				<tr>
						<td>
								<table width="625"  border="0" align="left" cellpadding="3" cellspacing="1">
										<form action="" method="post" name="sche_form" id="sche_form">
												
												<tr>
														<td width="617" align="left" valign="middle"><a href="?PID=sche_add&rdate=<?php echo $_REQUEST["rdate"]; ?>&mem_id=<?php echo $_REQUEST["mem_id"]; ?>">通常予定</a>　|　<a href="?PID=sche_add2&rdate=<?php echo $_REQUEST["rdate"]; ?>&mem_id=<?php echo $_REQUEST["mem_id"]; ?>">翌日まで続く予定</a>　|　バナー予定</td>
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
																								〜
																								<input type="hidden" name="hiddenField">
																								<input type="hidden" name="hiddenField">
																								<select name="fyear" id="fyear">
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
																								<select name="fmonth">
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
																								<select name="fday" id="fday">
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
																				</strong></td>
																		</tr>
																		<tr>
																				<td width="140" bgcolor="#ececec">
																						<div align="right"><strong>予定：</strong></div>
																				</td>
																				<td bgcolor="#FFFFFF">
																						<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
																						<input name="tmp_id" type="hidden" id="tmp_id" />
																						<input type="hidden" name="day_view" id="day_view" value="1" />
																				</td>
																		</tr>
																		<tr>
																				<td width="140" valign="top" bgcolor="#ececec">
																						<div align="right"><strong>メモ：</strong></div>
																						<input name="mode" type="hidden" id="mode" value=" ">
																						<input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
																						<input name="member_id" type="hidden" id="member_id" value="<?php echo $logindata["member_id"]; ?>">
																				</td>
																				<td bgcolor="#FFFFFF">
																						<textarea name="comment" cols="50" rows="10" id="comment" style="width:98%;"></textarea>
																				</td>
																		</tr>
																		<tr>
																		    <td valign="top" bgcolor="#ececec">
																		        <div align="right"><strong>状況</strong></div>
																		    </td>
																		    <td bgcolor="#FFFFFF">
																		        <select name="view_type" id="view_type">
																		            <option value="2">作業中</option>
																		            <option value="99">終了</option>
																		            <option value="5">待ち</option>
																		            <option value="1">準備中</option>
																		            </select>
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
																				    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <th width="150" align="left">
                                    <select name="menu1" onChange="Groupchange(20)">
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
                                <th width="150" align="left">
                                    <select name="menu1" onChange="Groupchange1(23)">
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
                                                <input type="button" name="Submit" value="←追加" onClick="func(23,20)">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center">
                                                <input type="button" name="Submit" value="削除→" onClick="func(20,23)">
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
																				<TD>&nbsp;</TD>
																		</TR>
																		<TR>
																				<TD>
																						<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
																						<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
																						<input name="sche_add" type="button" id="sche_add" value="登録する" onClick="datachk(this.form)">
																						<input name="hisback" type="button" id="hisback" value="戻る" onClick="">
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
										</form>
								</table>
						</td>
				</tr>
		</table>
</div>
