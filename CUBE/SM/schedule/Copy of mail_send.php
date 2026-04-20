<?php 

$scheobj=new Schedule($dbobj);
$schedata=$scheobj->GetData($_REQUEST["sche_id"]);
$mselList=$scheobj->GetSelList($_REQUEST["sche_id"]);
$mList=$scheobj->GetMList();
$Gobj=new Group($dbobj);
$GAList=$Gobj->GetAllList();
$mAttendList=$scheobj->GetSelAttendList2($_REQUEST["sche_id"],1);

if($_REQUEST["btm_mailsend"]=="メールを送信する") {
	$atrows=0;
	while($mAttendList[$atrows]["member_id"]!=NULL) {
		$sbj=$_REQUEST["mail_title"];
		$mailtxt=$_REQUEST["mailtxt"];
		$addtxt="\n-----------------\n".
				"下記urlから出欠を登録してください。\n".
				"http://".$_SERVER['HTTP_HOST']."/keitai/schedule_detail.php?kpass=".$mAttendList[$atrows]["kpass"]."&sche_id=".$_REQUEST["sche_id"]."";
		if($mAttendList[$atrows]["kpass"]) {
			mb_send_mail($mAttendList[$atrows]["kmail"],$sbj,$mailtxt.$addtxt,"From:info@otakejc.com\n");
			$upsql="update schedule_master  set mail_send =1 ".
					" where member_id=".$mAttendList[$atrows]["member_id"]." and schedule_id =".$_REQUEST["sche_id"];
			$dbobj->Query($upsql);		
		}
		$atrows++;
	}
	
}

$sql="SELECT schedule.*, member.*, schedule_master.schedule_id
		FROM member INNER JOIN (schedule INNER JOIN schedule_master ON 
		schedule.schedule_id = schedule_master.schedule_id) ON member.member_id = schedule_master.member_id
		WHERE (((schedule_master.schedule_id)=".$_REQUEST["sche_id"]."))";

$data=$dbobj->GetData($sql);


?>
<script language="javascript">
function datachk(frm) {
	var alertchk=0;
	var alerttxt="";
	if(frm.mail_title.value==""){
		alerttxt="タイトルを入力してください。\n";
		alertchk=1;
	}
	if(frm.mail_title.value==""){
		alerttxt="タイトルを入力してください。\n";
		alertchk=1;
	}
	if(alertchk==0) {
			frm.submit();
	}
	else {
		alert(alerttxt);
	}
}

function delchk(frm) {
	res=confirm("このスケジュールを削除してもよろしいですか？");
	if(res) {
		frm.mode.value="delete";
		frm.submit();
	}
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
				if($_REQUEST["mode"]=="mailchk") {
				?>
				
					<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
                    	<form name="form2" method="get" action=""><tr>
                    		<td colspan="2">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>タイトル</strong></div>
                   			</td>
                    		<td width="600">
                    			<input name="mail_title" type="hidden" id="mail_title" value="<?php echo $_REQUEST["mail_title"];?>">
                    			<?php echo $_REQUEST["mail_title"];?> </td>
                   		</tr>
                    	<tr>
                    		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>内容 </strong></div>
                   			</td>
                    		<td>
                    			<input name="mailtxt" type="hidden" value="<?php echo $_REQUEST["mailtxt"]?>">
                    			<?php echo nl2br($_REQUEST["mailtxt"]);?> </td>
                   		</tr>
                    	<tr>
                    		<td background="/members/img/filemenu_bg.gif">&nbsp; </td>
                    		<td>
                    			<p>
                    				<?php if($_REQUEST["d_chk"]==1){ echo " 送信済みの人にも送信する";}else { echo " 送信済みの人には送信しない";}?>
                                    <input name="d_chk" type="hidden" value="<?php echo $_REQUEST["d_chk"]?>">
</p>
                   			</td>
                   		</tr>
                    	<tr>
                    		<td colspan="2">&nbsp;</td>
                    		</tr>
                    	<tr>
                    		<td colspan="2">
                    			<table  border="0" cellspacing="2" cellpadding="2">
                                	<tr background="/members/img/filemenu_bg.gif">
                                		<td width="150" nowrap background="/members/img/filemenu_bg.gif"><strong>お名前</strong></td>
                                		<td width="50" nowrap background="/members/img/filemenu_bg.gif"><strong>出欠</strong></td>
                                		<td width="75" nowrap background="/members/img/filemenu_bg.gif"><strong>メール送信</strong></td>
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
                    		<td colspan="2">
                    			<input type="submit" name="Submit" value="戻る">
                    			<input name="btm_mailsend" type="submit" id="btm_mailsend" value="メールを送信する">
                                <input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"];?>">
                                <input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
                   			</td>
                   		</tr>
        				</form>
            	</table>
				<?php 
					}
					else {
					?>
				<table width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
				<form name="form1" method="get" action="">
                    	<tr>
                    		<td colspan="2">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td width="100" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>日時</strong></div>
                   			</td>
                    		<td width="600"><?php echo $schedata["syear"]."年".$schedata["smonth"]."月".$schedata["sday"]."日 ".$schedata["stime"];?>〜<?php echo $schedata["fyear"]."年".$schedata["fmonth"]."月".$schedata["fday"]."日 ".$schedata["ftime"];?></td>
                   		</tr>
                    	<tr>
                    		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>タイトル</strong></div>
                   			</td>
                    		<td>
                    			<input name="mail_title" type="text" id="mail_title" value="<?php if($_REQUEST["mail_title"]==NULL){echo $schedata["title"];}else {
							echo $_REQUEST["mail_title"];};?>" size="40">
                   			</td>
                   		</tr>
                    	<tr>
                    		<td width="100" valign="top" background="/members/img/filemenu_bg.gif">
                    			<div align="right"><strong>内容</strong></div>
                   			</td>
                    		<td>
                    			<textarea name="mailtxt" cols="30" rows="10"><?php if($_REQUEST["mailtxt"]==NULL){echo strip_tags(str_replace("<br />","\n",$schedata["comment"]));}else {echo $_REQUEST["mailtxt"];}?></textarea>
                   			</td>
                   		</tr>
                    	<tr>
                    		<td background="/members/img/filemenu_bg.gif">&nbsp;</td>
                    		<td>
                    			<p>
                    				<input name="d_chk" type="checkbox" id="d_chk" value="1"<?php if($_REQUEST["d_chk"]==1){ echo " checked";}?>>
				送信済みの人にも送信する
				<input name="mode" type="hidden" id="mode" value="mailchk">
                <input name="sche_id" type="hidden" id="sche_id" value="<?php echo $_REQUEST["sche_id"];?>">
                    			<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
                    			</p>
                   			</td>
                   		</tr>
                    	<tr>
                    		<td colspan="2">&nbsp;</td>
                   		</tr>
                    	<tr>
                    		<td colspan="2">
                    			<table  border="0" cellspacing="2" cellpadding="2">
                                	<tr background="/members/img/filemenu_bg.gif">
                                		<td width="150" nowrap background="/members/img/filemenu_bg.gif"><strong>お名前</strong></td>
                                		<td width="50" nowrap background="/members/img/filemenu_bg.gif"><strong>出欠</strong></td>
                                		<td width="75" nowrap background="/members/img/filemenu_bg.gif"><strong>メール送信</strong></td>
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
                    		<td colspan="2">
                    			<input type="button" name="Submit" value="リストへ戻る" onClick="window.location.href='index.php?PID=sche_up&sche_id=<?php echo $_REQUEST["sche_id"];?>'">
                    			<input type="button" name="Submit" value="確認する" onClick="datachk(this.form)">
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
