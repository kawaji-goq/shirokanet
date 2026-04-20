<?php /*?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
$today=date("Y-m-d",time());
$gobj=new Group($dbobj);
$mobj=new Member($dbobj);
$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
if($_REQUEST["mode"]=="addition") {
		for($j=0;$_REQUEST["rlist"][$j]!=NULL;$j++) {
			$maxsql="select max(message_id) as maxid from message";
			$maxid=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid+=$maxdata["maxid"];
			$inssql="insert into  message (message_id,title,message,senddate,master_id,sendtime,res_id,original_id) values (".
					"$maxid,'".$_REQUEST["title"]."','".$_REQUEST["message"]."','".$_REQUEST["senddate"]."',".$logindata["member_id"].
					",'".date("H:i:s")."',0,".$maxid.")";
			$dbobj->Query($inssql);
			
			$maxsql="select max(log_id) as maxid from message_logs";
			$maxid3=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid3+=$maxdata["maxid"];
			
			$inssql="insert into message_logs (log_id,sled_id,title,comment,member_id,writetime,log_num,res_id) values (".
					$maxid3.",".$maxid.",'".$_REQUEST["title"]."','".$_REQUEST["message"]."',".$logindata["member_id"].
					",'".date("Y-m-d H:i:s")."',0,".$maxid.")";
					
			$dbobj->Query($inssql);
			
			$maxsql="select max(logs_id) as maxid from message_readlogs";
			$maxid2=1;
			$maxdata=$dbobj->GetData($maxsql);
			$maxid2+=$maxdata["maxid"];
			$inssql="insert into  message_readlogs (logs_id,message_id,member_id,read_status,lastreaddate,lastreadtime) values (".
					$maxid2.",".$maxid.",".$_REQUEST["rlist"][$j].",0,'".date("Y-m-d")."','".date("Y-m-d H:i:s")."'".
					")";
			$dbobj->Query($inssql);
			$memsql="select * from member where member_id =".$_REQUEST["rlist"][$j];
			$memdata=$dbobj->GetData($memsql);
			
			if($_REQUEST["keitai_send"]==1&&$memdata["kmail"]!=NULL) {
					mb_send_mail($memdata["kmail"],$_REQUEST["title"],$_REQUEST["message"]."\n下記URLから確認してください。\nhttp://siteadmin.itcube.ne.jp/keitai/message_details.php?kpass=".$memdata["kpass"]."&message_id=".$maxid,"From:".$logindata["mailaddress"]);
			}
		}
					
?>
<script language="javascript">
	window.location.replace("index.php?PID=message");
</script>
<?php
}
$countsql="select count(message_id) as countnum from message_readlogs group by member_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}
$messagelist=$dbobj->GetList($sql);
$countsql="select count(message_id) as countnum from message_readlogs group by member_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status = 1";
$countreaddata=$dbobj->GetData($countsql);
if($countreaddata["countnum"]==NULL) {
	$countreaddata["countnum"]=0;
}

$countsql="select count(message_id) as countnum from message group by master_id having master_id = ".$logindata["member_id"];
$countsenddata=$dbobj->GetData($countsql);
if($countsenddata["countnum"]==NULL) {
	$countsenddata["countnum"]=0;
}

?>
<script language="javascript">

function Groupchange(num) {

	var selnum=document.add_form.elements[2].options[document.add_form.elements[2].options.selectedIndex].value;
	createlist(num,selnum);
}

function Groupchange1(num) {

	var selnum=document.add_form.elements[3].options[document.add_form.elements[3].options.selectedIndex].value;
	createlist1(num,selnum);
}


function createlist(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(4);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
	clearlist(7);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
	clearlist(7);
	var i=document.add_form.elements[num].length;
	var j=0;
	switch(num2) {
		case "0":
<?php
			$grows2=0;
			while($GSList[$grows2]["member_id"]!=NULL) {
?>
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
				document.add_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
	var i=document.add_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.add_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

function clearlist(num) {
	var i=document.add_form.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.add_form.elements[num].options[j]!=null) {
			document.add_form.elements[num].options[j]=null;
			j++;
		}
		i=document.add_form.elements[num].length;
		if(i!=0) {
			clearlist(num);
		}
	}
}

//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.add_form.elements[selectnum].selectedIndex != -1) {
		var test=document.add_form.elements[selectnum2].length;
		var res=chklist(selectnum2,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		
		if(res) {
			document.add_form.elements[selectnum2].options[test]
			= new Option(document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].text,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		}
		
		if(selectnum<selectnum2) {
			document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex] = new Option(document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].text,document.add_form.elements[selectnum].options[document.add_form.elements[selectnum].selectedIndex].value);
		}
		
	}
}

//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.add_form.elements[4].length) {
		document.add_form.elements[4].options[oprows].selected=true;
		oprows++;
	}
	
	document.add_form.submit();
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
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_message.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">お知らせ</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="220" valign="top">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                            <tr>
                                <td>
                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><strong>メッセージBOX</strong></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                            <td><a href="?PID=message">未読（<?php echo $countunreaddata["countnum"] ?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=message_readbox">既読（<?php echo $countreaddata["countnum"] ?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=message_sendbox">送信済み（<?php echo $countsenddata["countnum"];?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=mes_add">新しいメッセージの作成</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr>
                    <td height="30" bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                        <form name="add_form" method="post" action="">
                                <tr>
                                    <td height="40" bgcolor="#EFF6FF">件
                                        
                                        名<br>
                                                <input name="title" type="text" size="40" style="width:98%">
                                                </span> </td>
                                </tr>
                           
                                <tr>
                                    <td>本文</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <textarea name="message" cols="40" rows="10" style="width:98%"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>宛先</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="700" border="0" cellpadding="1" cellspacing="1">
                                            <tr>
                                                <td height="30">
                                                    <table  border="0" align="left" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <th align="left">
                                                                <select name="menu1" onChange="Groupchange(4)">
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
                                                                <select name="menu1" onChange="Groupchange1(7)">
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
                                                                </select>
                                                            </td>
                                                            <td width="75">
                                                                <table width="95%"  border="0" cellspacing="5" cellpadding="5">
                                                                    <tr>
                                                                        <td align="center">
                                                                            <input type="button" name="Submit" value="←追加" onClick="func(7,4)">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">
                                                                            <input type="button" name="Submit" value="削除→" onClick="func(4,7)">
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
                                            <tr>
                                                <td>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td height="30">
                                                    <input name="keitai_send" type="checkbox" id="keitai_send" value="1" checked>
                                                携帯アドレスに通知する</td>
                                            </tr>
                                            <tr>
                                                <td height="30">
                                                    <input name="btm_addition" type="button" id="btm_addition" value="送信する" onClick="datachk(this.form)">
                                                    <input name="btm_back" type="button" id="btm_back" value="戻る" onClick="window.location.href='index.php?PID=message'">
                                                    <input name="senddate" type="hidden" id="senddate" value="<?php echo $today; ?>">
                                                    <input name="member_id" type="hidden" id="member_id" value="<?php echo $_GET["member_id"]; ?>">
                                                    <strong>
                                                    <input name="mode" type="hidden" id="mode">
                                                                                                    </strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                                </form>
                            </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td height="30">&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
