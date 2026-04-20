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
		$maxsql="select max(log_id) as maxid from message_logs";
		$maxid3=1;
		$maxdata=$dbobj->GetData($maxsql);
		$maxid3+=$maxdata["maxid"];
		
		$inssql="insert into message_logs (log_id,sled_id,title,comment,member_id,writetime,log_num,res_id) values (".
				      $maxid3.",".$_REQUEST["res_id"].",'".$_REQUEST["title"]."','".$_REQUEST["message"]."',".$logindata["member_id"].
				      ",'".date("Y-m-d H:i:s")."',1,".$_REQUEST["res_id"].")";
		$dbobj->Query($inssql);
		
		$inssql="update message_readlogs set read_status = 1 ,lastreadtime='".date("Y-m-d H:i:s")."' where message_id = ".$_REQUEST["res_id"];
		$dbobj->Query($inssql);
	
		$memsql="select * from member inner join message on member.member_id = message.master_id where message_id =".$_REQUEST["res_id"];
		$memdata=$dbobj->GetData($memsql);
		if($_REQUEST["keitai_send"]==1&&$memdata["kmail"]!=NULL) {
				mb_send_mail($memdata["kmail"],"Re:".$memdata["title"],$_REQUEST["message"]."\n下記URLから確認してください。\nhttp://siteadmin.itcube.ne.jp/keitai/messagesend_details.php?kpass=".$memdata["kpass"]."&message_id=".$_REQUEST["res_id"],"From:".$logindata["mailaddress"]);
		}
?>
<script language="javascript">
	window.location.replace("index.php?PID=message");
</script>
<?php
}

$sql="select * from message where message_id = ".$_GET["message_id"];
$mesdata=$dbobj->GetData($sql);
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
                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                            <tr>
                                <td><strong>受信したメッセージ</strong></td>
                            </tr>
                            <tr>
                                <td bgcolor="#EFF6FF"><?php echo $mesdata["title"] ?></td>
                            </tr>
                            <tr>
                                <td height="30" bgcolor="#FFFFFF"><?php echo nl2br($mesdata["message"]); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="30" bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
                            <form name="add_form" method="post" action="">
                                <tr>
                                    <td>本文 </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%" border="0" cellpadding="1" cellspacing="1">
                                            <tr>
                                                <td>
                                                    <textarea name="message" cols="40" rows="10" style="width:98%"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
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
                                                    <input name="res_id" type="hidden" id="res_id" value="<?php echo $_GET["message_id"];?>">
                                                    <input name="original_id" type="hidden" id="original_id" value="<?php echo $mesdata["original_id"];?>">
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
