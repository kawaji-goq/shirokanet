<?php 

$scheobj=new Schedule($dbobj);

if($_REQUEST["mode"]=="update") {
	$upresult=$scheobj->Update($_POST);
}
if($_REQUEST["mode"]=="delete") {
	$upresult=$scheobj->Delete($_POST);
}

$sql="SELECT schedule.*, member.*, schedule_master.schedule_id
		FROM member INNER JOIN (schedule INNER JOIN schedule_master ON 
		schedule.schedule_id = schedule_master.schedule_id) ON member.member_id = schedule_master.member_id
		WHERE (((schedule_master.schedule_id)=".$_REQUEST["sche_id"]."))";
$data=$dbobj->GetData($sql);

$schedata=$scheobj->GetData($_REQUEST["sche_id"]);
$mselList=$scheobj->GetSelList($_REQUEST["sche_id"]);
$mList=$scheobj->GetMList();
$Gobj=new Group($dbobj);
$GAList=$Gobj->GetAllList();
$mAttendList=$scheobj->GetSelAttendList($_REQUEST["sche_id"]);
?>
<script language="javascript">
function datachk(frm) {
	res=confirm("この内容で更新してもよろしいですか？");
	if(res) {
		frm.mode.value="update";
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
	
	while(oprows<document.sche_form.elements[18].length) {
		document.sche_form.elements[18].options[oprows].selected=true;
		oprows++;
	}
	
	document.sche_form.submit();
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

	<table width="740"  border="0" align="left" cellpadding="2" cellspacing="2">
		<tr>
				<td align="left" valign="middle">&nbsp; </td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<table  border="0" cellspacing="2" cellpadding="2">
                            	<tr align="left" background="/members/img/filemenu_bg.gif">
                            		<td width="150" nowrap background="/members/img/filemenu_bg.gif"><strong>お名前</strong></td>
                            		<td width="50" nowrap background="/members/img/filemenu_bg.gif"><strong>出欠</strong></td>
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
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td width="100" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>開始日時</strong></div>
						</td>
						<td width="600"><?php echo $schedata["syear"]."年".$schedata["smonth"]."月".$schedata["sday"]."日 ".$schedata["stime"];?></td>
					</tr>
					<tr>
						<td width="100" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>終了日時</strong></div>
						</td>
						<td><?php echo $schedata["fyear"]."年".$schedata["fmonth"]."月".$schedata["fday"]."日 ".$schedata["ftime"];?></td>
					</tr>
					<tr>
						<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>タイトル</strong></div>
						</td>
						<td><?php echo nl2br($schedata["title"]);?></td>
					</tr>
					<tr>
						<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>表示</strong></div>
						</td>
						<td>
							<?php 
						switch($schedata["view_type"]) {
							case 0:
								echo "会員用";
								break;
							case 1:
								echo "全てに表示";
								break;
								
						}?>
						</td>
					</tr>
					<tr>
						<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>内容</strong></div>
						</td>
						<td><?php echo nl2br($schedata["comment"]);?></td>
					</tr>
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="button" name="Submit" value="編集へ戻る" onClick="window.location.href='index.php?PID=sche_up&sche_id=<?php echo $_REQUEST["sche_id"];?>'">
							<input type="button" name="Submit" value="メールを作成する" onClick="window.location.href='index.php?PID=sche_mail_send&sche_id=<?php echo $_REQUEST["sche_id"];?>'">
						</td>
					</tr>
				</table>	
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<div id="calender"> </div>
			</td>
		</tr>
	</table>
</div>
