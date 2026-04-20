<?php 

$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="update"||$_REQUEST["mode"]=="updateandmail") {

	$upresult=$scheobj->Update($_POST);
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
$mAttendList=$scheobj->GetSelAttendList($_REQUEST["sche_id"]);

?>
<script language="javascript">
function Groupchange(num) {
	var selnum=document.sche_form.elements[14].options[document.sche_form.elements[14].options.selectedIndex].value;
	createlist(num,selnum);
}
function createlist(num,num2) {
//	var addary2=new Array();
<?php
$newary1="";
$newary2="";

$GAList=$Gobj->GetAllList();
$GSList=$Gobj->GetAllSelList("");

?>
	clearlist(15);
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
	
	while(oprows<document.sche_form.elements[15].length) {
		document.sche_form.elements[15].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
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
<div id="files">
	<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
		<tr>
				<td align="left" valign="middle">&nbsp; </td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php 
				if($_REQUEST["mode"]=="update") {
				/*?>
				<script language="javascript">
				window.location.replace("index.php?PID=schedule");
				</script>
				<?php 
				*/
				}
				if($_REQUEST["mode"]=="delete"){
				?>
				<script language="javascript">
				window.location.replace("index.php?PID=schedule");
				</script>
				<table width="99%" border="0" align="center" cellpadding="2" cellspacing="2">
					<tr>
						<td width="100%">&nbsp;</td>
					</tr>
					<tr>
						<td>
							<div align="center"><strong> 以下のスケジュールを削除しました。</strong></div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
					</tr>
				</table>
				<table width="99%"  border="0" align="center" cellpadding="3" cellspacing="1">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="20%" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>開始日時</strong></div>
						</td>
						<td width="80%"><?php echo $_REQUEST["syear"]."年".$_REQUEST["smonth"]."月".$_REQUEST["sday"]."日 ".$_REQUEST["stime"];?></td>
					</tr>
					<tr>
						<td width="20%" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>終了日時</strong></div>
						</td>
						<td><?php echo $_REQUEST["fyear"]."年".$_REQUEST["fmonth"]."月".$_REQUEST["fday"]."日 ".$_REQUEST["ftime"];?></td>
					</tr>
					<tr>
						<td width="20%" valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>タイトル</strong></div>
						</td>
						<td><?php echo nl2br($_REQUEST["title"]);?></td>
					</tr>
					<tr>
						<td width="20%" valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>内容</strong></div>
						</td>
						<td><?php echo nl2br($_REQUEST["comment"]);?></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">&nbsp; </td>
					</tr>
					<tr>
						<td colspan="2">
							<input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
						</td>
					</tr>
				</table>
				<?php
				}
				else {
				?>
				<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
					<form action="" method="post" name="sche_form" id="sche_form">
						<tr>
							<td width="140">&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>開始日時：</strong></div>
							</td>
							<td>
								<select name="syear" id="syear">
									<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
									<option value="<?php echo ($schedata["syear"]+$yrows);?>"<?php if(($schedata["syear"]+$yrows)==$schedata["syear"]) { echo "selected";}?>><?php echo ($schedata["syear"]+$yrows);?></option>
									<?php
									$yrows++;
								}
							?>
								</select>
								<strong>年
								<select name="smonth">
									<option value="1"<?php if($schedata["smonth"]==1) { echo " selected";}?>>1</option>
									<option value="2"<?php if($schedata["smonth"]==2) { echo " selected";}?>>2</option>
									<option value="3"<?php if($schedata["smonth"]==3) { echo " selected";}?>>3</option>
									<option value="4"<?php if($schedata["smonth"]==4) { echo " selected";}?>>4</option>
									<option value="5"<?php if($schedata["smonth"]==5) { echo " selected";}?>>5</option>
									<option value="6"<?php if($schedata["smonth"]==6) { echo " selected";}?>>6</option>
									<option value="7"<?php if($schedata["smonth"]==7) { echo " selected";}?>>7</option>
									<option value="8"<?php if($schedata["smonth"]==8) { echo " selected";}?>>8</option>
									<option value="9"<?php if($schedata["smonth"]==9) { echo " selected";}?>>9</option>
									<option value="10"<?php if($schedata["smonth"]==10) { echo " selected";}?>>10</option>
									<option value="11"<?php if($schedata["smonth"]==11) { echo " selected";}?>>11</option>
									<option value="12"<?php if($schedata["smonth"]==12) { echo " selected";}?>>12</option>
								</select>
								月
								<select name="sday" id="sday">
									<option<?php if($schedata["sday"]==1) { echo " selected";}?>>1</option>
									<option<?php if($schedata["sday"]==2) { echo " selected";}?>>2</option>
									<option<?php if($schedata["sday"]==3) { echo " selected";}?>>3</option>
									<option<?php if($schedata["sday"]==4) { echo " selected";}?>>4</option>
									<option<?php if($schedata["sday"]==5) { echo " selected";}?>>5</option>
									<option<?php if($schedata["sday"]==6) { echo " selected";}?>>6</option>
									<option<?php if($schedata["sday"]==7) { echo " selected";}?>>7</option>
									<option<?php if($schedata["sday"]==8) { echo " selected";}?>>8</option>
									<option<?php if($schedata["sday"]==9) { echo " selected";}?>>9</option>
									<option<?php if($schedata["sday"]==10) { echo " selected";}?>>10</option>
									<option<?php if($schedata["sday"]==11) { echo " selected";}?>>11</option>
									<option<?php if($schedata["sday"]==12) { echo " selected";}?>>12</option>
									<option<?php if($schedata["sday"]==13) { echo " selected";}?>>13</option>
									<option<?php if($schedata["sday"]==14) { echo " selected";}?>>14</option>
									<option<?php if($schedata["sday"]==15) { echo " selected";}?>>15</option>
									<option<?php if($schedata["sday"]==16) { echo " selected";}?>>16</option>
									<option<?php if($schedata["sday"]==17) { echo " selected";}?>>17</option>
									<option<?php if($schedata["sday"]==18) { echo " selected";}?>>18</option>
									<option<?php if($schedata["sday"]==19) { echo " selected";}?>>19</option>
									<option<?php if($schedata["sday"]==20) { echo " selected";}?>>20</option>
									<option<?php if($schedata["sday"]==21) { echo " selected";}?>>21</option>
									<option<?php if($schedata["sday"]==22) { echo " selected";}?>>22</option>
									<option<?php if($schedata["sday"]==23) { echo " selected";}?>>23</option>
									<option<?php if($schedata["sday"]==24) { echo " selected";}?>>24</option>
									<option<?php if($schedata["sday"]==25) { echo " selected";}?>>25</option>
									<option<?php if($schedata["sday"]==26) { echo " selected";}?>>26</option>
									<option<?php if($schedata["sday"]==27) { echo " selected";}?>>27</option>
									<option<?php if($schedata["sday"]==28) { echo " selected";}?>>28</option>
									<option<?php if($schedata["sday"]==29) { echo " selected";}?>>29</option>
									<option<?php if($schedata["sday"]==30) { echo " selected";}?>>30</option>
									<option<?php if($schedata["sday"]==31) { echo " selected";}?>>31</option>
								</select>
								日
								<?php 
							$sstime=explode(":",$schedata["stime"]);
							?>
								<select name="shour" id="shour">
									<option<?php if($sstime[0]==NULL){ echo " selected";}?>>--</option>
									<option<?php if($sstime[0]==0&&$sstime[0]!=NULL){ echo " selected";}?>>0</option>
									<option<?php if($sstime[0]==1){ echo " selected";}?>>1</option>
									<option<?php if($sstime[0]==2){ echo " selected";}?>>2</option>
									<option<?php if($sstime[0]==3){ echo " selected";}?>>3</option>
									<option<?php if($sstime[0]==4){ echo " selected";}?>>4</option>
									<option<?php if($sstime[0]==5){ echo " selected";}?>>5</option>
									<option<?php if($sstime[0]==6){ echo " selected";}?>>6</option>
									<option<?php if($sstime[0]==7){ echo " selected";}?>>7</option>
									<option<?php if($sstime[0]==8){ echo " selected";}?>>8</option>
									<option<?php if($sstime[0]==9){ echo " selected";}?>>9</option>
									<option<?php if($sstime[0]==10){ echo " selected";}?>>10</option>
									<option<?php if($sstime[0]==11){ echo " selected";}?>>11</option>
									<option<?php if($sstime[0]==12){ echo " selected";}?>>12</option>
									<option<?php if($sstime[0]==13){ echo " selected";}?>>13</option>
									<option<?php if($sstime[0]==14){ echo " selected";}?>>14</option>
									<option<?php if($sstime[0]==15){ echo " selected";}?>>15</option>
									<option<?php if($sstime[0]==16){ echo " selected";}?>>16</option>
									<option<?php if($sstime[0]==17){ echo " selected";}?>>17</option>
									<option<?php if($sstime[0]==18){ echo " selected";}?>>18</option>
									<option<?php if($sstime[0]==19){ echo " selected";}?>>19</option>
									<option<?php if($sstime[0]==20){ echo " selected";}?>>20</option>
									<option<?php if($sstime[0]==21){ echo " selected";}?>>21</option>
									<option<?php if($sstime[0]==22){ echo " selected";}?>>22</option>
									<option<?php if($sstime[0]==23){ echo " selected";}?>>23</option>
									<option<?php if($sstime[0]==24){ echo " selected";}?>>24</option>
								</select>
								時
								<select name="smin">
									<option<?php if($sstime[1]==NULL){ echo " selected";}?>>--</option>
									<option value="00"<?php if($sstime[1]==0&&$sstime[1]!=NULL){ echo " selected";}?>>00</option>
									<option value="30"<?php if($sstime[1]==30){ echo " selected";}?>>30</option>
								</select>
								分〜</strong></td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>終了日時：</strong></div>
							</td>
							<td><strong>
								<select name="fyear" id="fyear">
									<?php 
								$yrows=-5;
								while($yrows<=5) {
								?>
									<option value="<?php echo ($schedata["fyear"]+$yrows);?>"<?php if(($schedata["fyear"]+$yrows)==$schedata["fyear"]) { echo "selected";}?>><?php echo ($schedata["fyear"]+$yrows);?></option>
									<?php
									$yrows++;
								}
							?>
								</select>
								年
								<select name="fmonth">
									<option value="1"<?php if($schedata["fmonth"]==1) { echo " selected";}?>>1</option>
									<option value="2"<?php if($schedata["fmonth"]==2) { echo " selected";}?>>2</option>
									<option value="3"<?php if($schedata["fmonth"]==3) { echo " selected";}?>>3</option>
									<option value="4"<?php if($schedata["fmonth"]==4) { echo " selected";}?>>4</option>
									<option value="5"<?php if($schedata["fmonth"]==5) { echo " selected";}?>>5</option>
									<option value="6"<?php if($schedata["fmonth"]==6) { echo " selected";}?>>6</option>
									<option value="7"<?php if($schedata["fmonth"]==7) { echo " selected";}?>>7</option>
									<option value="8"<?php if($schedata["fmonth"]==8) { echo " selected";}?>>8</option>
									<option value="9"<?php if($schedata["fmonth"]==9) { echo " selected";}?>>9</option>
									<option value="10"<?php if($schedata["fmonth"]==10) { echo " selected";}?>>10</option>
									<option value="11"<?php if($schedata["fmonth"]==11) { echo " selected";}?>>11</option>
									<option value="12"<?php if($schedata["fmonth"]==12) { echo " selected";}?>>12</option>
								</select>
								月
								<select name="fday" id="fday">
									<option<?php if($schedata["fday"]==1) { echo " selected";}?>>1</option>
									<option<?php if($schedata["fday"]==2) { echo " selected";}?>>2</option>
									<option<?php if($schedata["fday"]==3) { echo " selected";}?>>3</option>
									<option<?php if($schedata["fday"]==4) { echo " selected";}?>>4</option>
									<option<?php if($schedata["fday"]==5) { echo " selected";}?>>5</option>
									<option<?php if($schedata["fday"]==6) { echo " selected";}?>>6</option>
									<option<?php if($schedata["fday"]==7) { echo " selected";}?>>7</option>
									<option<?php if($schedata["fday"]==8) { echo " selected";}?>>8</option>
									<option<?php if($schedata["fday"]==9) { echo " selected";}?>>9</option>
									<option<?php if($schedata["fday"]==10) { echo " selected";}?>>10</option>
									<option<?php if($schedata["fday"]==11) { echo " selected";}?>>11</option>
									<option<?php if($schedata["fday"]==12) { echo " selected";}?>>12</option>
									<option<?php if($schedata["fday"]==13) { echo " selected";}?>>13</option>
									<option<?php if($schedata["fday"]==14) { echo " selected";}?>>14</option>
									<option<?php if($schedata["fday"]==15) { echo " selected";}?>>15</option>
									<option<?php if($schedata["fday"]==16) { echo " selected";}?>>16</option>
									<option<?php if($schedata["fday"]==17) { echo " selected";}?>>17</option>
									<option<?php if($schedata["fday"]==18) { echo " selected";}?>>18</option>
									<option<?php if($schedata["fday"]==19) { echo " selected";}?>>19</option>
									<option<?php if($schedata["fday"]==20) { echo " selected";}?>>20</option>
									<option<?php if($schedata["fday"]==21) { echo " selected";}?>>21</option>
									<option<?php if($schedata["fday"]==22) { echo " selected";}?>>22</option>
									<option<?php if($schedata["fday"]==23) { echo " selected";}?>>23</option>
									<option<?php if($schedata["fday"]==24) { echo " selected";}?>>24</option>
									<option<?php if($schedata["fday"]==25) { echo " selected";}?>>25</option>
									<option<?php if($schedata["fday"]==26) { echo " selected";}?>>26</option>
									<option<?php if($schedata["fday"]==27) { echo " selected";}?>>27</option>
									<option<?php if($schedata["fday"]==28) { echo " selected";}?>>28</option>
									<option<?php if($schedata["fday"]==29) { echo " selected";}?>>29</option>
									<option<?php if($schedata["fday"]==30) { echo " selected";}?>>30</option>
									<option<?php if($schedata["fday"]==31) { echo " selected";}?>>31</option>
								</select>
								日
								<?php 
							$sftime=explode(":",$schedata["ftime"]);
							
							?>
								<select name="fhour">
									<option<?php if($sftime[0]==NULL){ echo " selected";}?>>--</option>
									<option<?php if($sftime[0]==0&&$sftime[0]!=NULL){ echo " selected";}?>>0</option>
									<option<?php if($sftime[0]==1){ echo " selected";}?>>1</option>
									<option<?php if($sftime[0]==2){ echo " selected";}?>>2</option>
									<option<?php if($sftime[0]==3){ echo " selected";}?>>3</option>
									<option<?php if($sftime[0]==4){ echo " selected";}?>>4</option>
									<option<?php if($sftime[0]==5){ echo " selected";}?>>5</option>
									<option<?php if($sftime[0]==6){ echo " selected";}?>>6</option>
									<option<?php if($sftime[0]==7){ echo " selected";}?>>7</option>
									<option<?php if($sftime[0]==8){ echo " selected";}?>>8</option>
									<option<?php if($sftime[0]==9){ echo " selected";}?>>9</option>
									<option<?php if($sftime[0]==10){ echo " selected";}?>>10</option>
									<option<?php if($sftime[0]==11){ echo " selected";}?>>11</option>
									<option<?php if($sftime[0]==12){ echo " selected";}?>>12</option>
									<option<?php if($sftime[0]==13){ echo " selected";}?>>13</option>
									<option<?php if($sftime[0]==14){ echo " selected";}?>>14</option>
									<option<?php if($sftime[0]==15){ echo " selected";}?>>15</option>
									<option<?php if($sftime[0]==16){ echo " selected";}?>>16</option>
									<option<?php if($sftime[0]==17){ echo " selected";}?>>17</option>
									<option<?php if($sftime[0]==18){ echo " selected";}?>>18</option>
									<option<?php if($sftime[0]==19){ echo " selected";}?>>19</option>
									<option<?php if($sftime[0]==20){ echo " selected";}?>>20</option>
									<option<?php if($sftime[0]==21){ echo " selected";}?>>21</option>
									<option<?php if($sftime[0]==22){ echo " selected";}?>>22</option>
									<option<?php if($sftime[0]==23){ echo " selected";}?>>23</option>
									<option<?php if($sftime[0]==24){ echo " selected";}?>>24</option>
								</select>
								時
								<select name="fmin">
									<option<?php if($sftime[1]==NULL){ echo " selected";}?>>--</option>
									<option value="0"<?php if($sftime[1]==0&&$sftime[1]!=NULL){ echo " selected";}?>>00</option>
									<option value="30"<?php if($sftime[1]==30){ echo " selected";}?>>30</option>
								</select>
								分</strong></td>
						</tr>
						<tr>
							<td width="140" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>タイトル：</strong></div>
							</td>
							<td>
								<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
								<input name="day_view" type="hidden" id="day_view" value="0" />
								<input name="view_type" type="hidden" id="view_type" value="1" />
							</td>
						</tr>
						
						
						<tr>
							<td width="140" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong> 内容：</strong></div>
							</td>
							<td>
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
								<textarea name="comment" cols="60" rows="10" id="comment"><?php echo $schedata["comment"]; ?></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						<tr>
							<td colspan="2">
								<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                                	<tr>
                                		<th width="140" align="right" valign="top" background="/members/img/filemenu_bg.gif">参加者 <strong>：</strong></th>
                                		<td>
                                				<table  border="0" cellpadding="0" cellspacing="0">
                                				<tr>
                                					<th align="left">
                                						<select name="menu1" onChange="Groupchange(15)">
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
                                					<th align="left">&nbsp;</th>
                               					</tr>
                                				<tr>
                                					<td width="42%">
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
                                					<td width="16%">
                                						<table width="95%"  border="0" cellspacing="5" cellpadding="5">
                                							<tr>
                                								<td align="center">
                                									<input type="button" name="Submit" value="←追加" onClick="func(18,15)">
                                									</td>
                               								</tr>
                                							<tr>
                                								<td align="center">
                                									<input type="button" name="Submit" value="削除→" onClick="func(15,18)">
                                									</td>
                               								</tr>
                                							</table>
                               						</td>
                                					<td width="42%">
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
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<table  border="0" cellspacing="2" cellpadding="2">
									<tr align="left" background="/members/img/filemenu_bg.gif">
										<td width="150" nowrap background="/members/img/filemenu_bg.gif"><strong>お名前</strong></td>
										<td width="50" nowrap background="/members/img/filemenu_bg.gif"><strong>参加</strong></td>
										<td width="75" nowrap background="/members/img/filemenu_bg.gif"><strong>メール送信</strong></td>
										<th width="75" nowrap background="/members/img/filemenu_bg.gif">コメント</th>
									</tr>
									<?php
								$mrows=0;
								while($mAttendList[$mrows]["member_id"]!=NULL) {
								?>
									<tr>
										<td><?php echo $mAttendList[$mrows]["member_name"] ?></td>
										<td align="center">
											<?php 
									switch($mAttendList[$mrows]["attend_chk"]) {
										case 0:
											echo "未";
											break;
										case 1:
											echo "出席";
											break;
										case 2:
											echo "欠席";
											break;
											
									}?>
										</td>
										<td align="center">
											<?php 
									switch($mAttendList[$mrows]["mail_send"]) {
										case 0:
											echo "未";
											break;
										case 1:
											echo "送信済";
											break;
										case 2:
											echo "PC（未）";
											break;
										case 3:
											echo "携帯（未）";
											break;
										default:
											echo "登録エラー";
											break;
									} ?>
										</td>
										<td align="center"><?php echo $mAttendList[$mrows]["members_memo"] ?></td>
									</tr>
									<tr>
										<td colspan="4" class="line">&nbsp;</td>
									</tr>
									<?php
									$mrows++;
								}
								?>
								</table>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<input name="mode" type="hidden" id="mode" value=" ">
								<input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"]; ?>">
								<input name="member_id" type="hidden" id="member_id" value="0">
							</td>
						</tr>
						<tr>
							<td height="30" colspan="2">
								<input name="sche_up" type="button" id="sche_up" value="更新する" onClick="datachk(this.form)">
								<input type="button" name="Submit" value="更新してメールを送信する" onClick="datachk2(this.form)">
								<input name="sche_del" type="submit" id="sche_del" value="削除する" onClick="delchk(this.form)">
								<input name="hisback" type="button" id="hisback" value="戻る" onClick="history.back()">
							</td>
						</tr>
					</form>
				</table>
				<?php
				}
				 ?>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<div id="calender"> </div>
			</td>
		</tr>
	</table>
</div>
