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
	
	while(oprows<document.sche_form.elements[17].length) {
		document.sche_form.elements[17].options[oprows].selected=true;
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
	<table width="740"  border="0" align="center" cellpadding="2" cellspacing="2">
		<tr>
			<td align="left" valign="middle">
				<table width="100%" border="0" cellpadding="2" cellspacing="2">
					<tr>
						<td width="45"><img src="/members/img/sche_sic.gif" width="42" height="38"></td>
						<td>
							<div id="tree"><span class="top">スケジュール</span>　<span class="gt">>></span>　<span class="sub"><?php echo $schedata["title"];?></span></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php 
				if($_REQUEST["mode"]=="update") {
				?><table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
                	<tr>
                		<td>
                			<div align="center"><strong>
               				以下の内容でスケジュールを更新しました。</strong></div>
                		</td>
               		</tr>
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
               	</table>
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td colspan="2">&nbsp;</td>
               		</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>開始日時</strong></div>
                		</td>
               		    <td><?php echo $schedata["syear"]."年".$schedata["smonth"]."月".$schedata["sday"]."日 ".$schedata["stime"];?></td>
                	</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>終了日時</strong></div>
                		</td>
                		<td><?php echo $schedata["fyear"]."年".$schedata["fmonth"]."月".$schedata["fday"]."日 ".$schedata["ftime"];?></td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>表示</strong></div>
                		</td>
                		<td>
                			<?php 
						switch($schedata["view_type"]) {
						case 0:
							echo "会員専用";
							break;
						case 1:
							echo "全てに表示";
							break;
						 
						}?>
                		</td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>日付表示</strong></div>
                		</td>
                		<td>
                			<?php 
						switch($_REQUEST["view_type"]) {
						case 0:
							echo "会員専用";
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
                		<td width="100" align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>参加者</strong></td>
               		    <td><?php
								$mrows=0;
								while($mselList[$mrows]["member_id"]!=NULL) {
								?>
                                				 <?php echo $mselList[$mrows]["member_name"] ?> 
												 
												 <br>
                                				<?php
									$mrows++;
								}?></td>
                	</tr>
                	<tr>
                		<td colspan="2">
                			<input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
                		</td>
           		    </tr>
               	</table>
				<?php 
				}
				else if($_REQUEST["mode"]=="delete"){
				?><table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
                	<tr>
                		<td>
                			<div align="center"><strong>
               				以下のスケジュールを削除しました。</strong></div>
                		</td>
               		</tr>
                	<tr>
                		<td>&nbsp;</td>
               		</tr>
               	</table>
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
                	<tr>
                		<td colspan="2">&nbsp;</td>
               		</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>開始日時</strong></div>
                		</td>
               		    <td><?php echo $_REQUEST["syear"]."年".$_REQUEST["smonth"]."月".$_REQUEST["sday"]."日 ".$_REQUEST["stime"];?></td>
                	</tr>
                	<tr>
                		<td width="100" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>終了日時</strong></div>
                		</td>
                		<td><?php echo $_REQUEST["fyear"]."年".$_REQUEST["fmonth"]."月".$_REQUEST["fday"]."日 ".$_REQUEST["ftime"];?></td>
               		</tr>
                	<tr>
                		<td valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>タイトル</strong></div>
                		</td>
                		<td><?php echo nl2br($_REQUEST["title"]);?></td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                			<div align="right"><strong>内容</strong></div>
                		</td>
               		    <td><?php echo nl2br($_REQUEST["comment"]);?></td>
                	</tr>
                	<tr>
                		<td>&nbsp;</td>
               		    <td>&nbsp;</td>
                	</tr>
                	<tr>
                		<td colspan="2">&nbsp;               			</td>
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
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
					<form action="" method="post" name="sche_form" id="sche_form">
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td width="100" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>開始日時</strong></div>
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
								</select>
								時
								<select name="smin">
									<option value="0"<?php if($sstime[1]==0){ echo " selected";}?>>00</option>
									<option value="30"<?php if($sstime[1]==30){ echo " selected";}?>>30</option>
								</select>
								分〜 </strong></td>
						</tr>
						<tr>
							<td width="100" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>終了日時</strong></div>
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
								</select>
								時
								<select name="fmin">
									<option value="0"<?php if($sftime[1]==0){ echo " selected";}?>>00</option>
									<option value="30"<?php if($sftime[1]==30){ echo " selected";}?>>30</option>
								</select>
								分</strong></td>
						</tr>
						<tr>
							<td background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>タイトル</strong></div>
							</td>
							<td>
								<input name="title" type="text" id="title" value="<?php echo $schedata["title"] ?>" size="50">
							</td>
						</tr>
						<tr>
							<td valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>表示 </strong></div>
							</td>
							<td>
								<select name="view_type" id="view_type">
                                	<option value="0"<?php 
									if($schedata["view_type"]==0||$schedata["view_type"]==NULL) {
										echo " selected";
									} ?>>会員専用</option>
                                	<option value="1"<?php 
									if($schedata["view_type"]==1) {
										echo " selected";
									}
									?>>全てに表示</option>
                               	</select>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" background="/members/img/filemenu_bg.gif"><strong>日付表示</strong></td>
							<td>
								<select name="day_view" id="day_view">
                                	<option value="0"<?php 
									if($schedata["day_view"]==0) {
										echo " selected";
									}
									?>>表示しない</option>
                                	<option value="1"<?php 
									if($schedata["day_view"]==1) {
										echo " selected";
									}
									?>>表示する</option>
                               	</select>
							</td>
						</tr>
						<tr>
							<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
								<div align="right"><strong>
									<input name="mail_send" type="hidden" id="mail_send" value="1">
								内容</strong></div>
							</td>
							<td>
								<?php 
								$fckobject=new FCKeditor("comment");
								$fckobject->BasePath="/FCKeditor/";
								$fckobject->Width=500;
								$fckobject->Height=400;
								$fckobject->ToolbarSet='Mymenu';
								$fckobject->Value=$schedata["comment"];
								$fckobject->Create();
								?>
							</td>
						</tr>
						<tr>
							<th width="100" align="right" valign="top" background="/members/img/filemenu_bg.gif">参加者 </th>
						    <td>
						    	<table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0">
                                	<tr>
                                		<th>&nbsp;</th>
                                		<td>&nbsp;</td>
                                		<th align="left">&nbsp;                                		</th>
                               		</tr>
                                	<tr>
                                		<td width="200">
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
                                		<td width="200">
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
								<?php if($schedata["mail_send"]==1){?><input name="attend" type="button" id="attend" value="出欠表確認" onClick="window.location.href='index.php?PID=sche_attend&sche_id=<?php echo $_REQUEST["sche_id"]; ?>'">
								<input type="button" name="Submit" value="メールを作成する" onClick="window.location.href='index.php?PID=sche_mail_send&sche_id=<?php echo $_REQUEST["sche_id"];?>'">
								<?php }?>
								<input name="sche_del" type="submit" id="sche_del" value="削除する" onClick="delchk(this.form)">
								<input name="hisback" type="button" id="hisback" value="戻る" onClick="window.location.href='index.php?PID=schedule'">
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
