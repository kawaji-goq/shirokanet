<?php 

$gobj=new Group($dbobj);
$mobj=new Member($dbobj);
$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();

$tmpsql="select * from mail_templete";
$tmpdata=$dbobj->GetList($tmpsql);
?><?php ?>
<script language="javascript">

function tempdel(frm) {
	var num1=document.mail_form.elements[1].selectedIndex;
	var num2=document.mail_form.elements[1].options[num1].value;
	window.location.href="?PID=mail&PROCCESS=tmpdel&temp_id="+num2;
}

function tmpchange(frm) {
	var num1=document.mail_form.elements[1].selectedIndex;
	var num2=document.mail_form.elements[1].options[num1].value;
	switch(num2) {
	<?php
	$tmprows=0;
	while($tmpdata[$tmprows]["temp_id"]!=NULL) {
	?>
		case "<?php echo $tmpdata[$tmprows]["temp_id"];?>":
		frm.m_sbj.value="<?php echo $tmpdata[$tmprows]["subject"];?>";
		frm.m_txt.value="<?php echo str_replace("\n","\\n",str_replace("\r","",$tmpdata[$tmprows]["m_text"]));?>";
		frm.m_raddress.value="<?php echo $tmpdata[$tmprows]["check_address"];?>";
		break;
		<?php
		$tmprows++;
	}
	?>
	}
}

function Groupchange(num) {
	var selnum=document.mail_form.elements[6].options[document.mail_form.elements[6].options.selectedIndex].value;
	createlist(num,selnum);
}

function createlist(num,num2) {
//	var addary2=new Array();
<?php

$newary1="";
$newary2="";
//echo $newary1.");\n";
//echo $newary2.");\n";

$GAList=$gobj->GetAllList();
$GSList=$gobj->GetAllSelList("");

?>
	clearlist(7);
	var i=document.mail_form.elements[num].length;
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
				document.mail_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
				document.mail_form.elements[num].options[<?php echo $grows2 ?>] = new Option("<?php echo $GSList[$grows2]["member_name"];?>","<?php echo $GSList[$grows2]["member_id"];?>");
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
	var i=document.mail_form.elements[num].length;
	var j=0;
	while(j<i) {
		if(document.mail_form.elements[num].options[j].value==id){
			return false;
		}
		j++;
	}
	return true;
}

function clearlist(num) {
	var i=document.mail_form.elements[num].length;
	if(i!=0) {
		var j=0;
		while(document.mail_form.elements[num].options[j]!=null) {
			document.mail_form.elements[num].options[j]=null;
			j++;
		}
		i=document.mail_form.elements[num].length;
		if(i!=0) {
			clearlist(num);
		}
	}
}

//リスト内の移動をする関数
function func(selectnum,selectnum2) {
	while (document.mail_form.elements[selectnum].selectedIndex != -1) {
		var test=document.mail_form.elements[selectnum2].length;
		var res=chklist(selectnum2,document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex].value);
		if(res) {
			document.mail_form.elements[selectnum2].options[test]
			= new Option(document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex].text,document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex].value);
		}
		if(selectnum<selectnum2) {
			document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex] = null;
		}
		else {
			document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex] = new Option(document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex].text,document.mail_form.elements[selectnum].options[document.mail_form.elements[selectnum].selectedIndex].value);
		}
	}
}

//全リストを選択してデータを送信する関数
function senddata() {
	var oprows=0;
	
	while(oprows<document.mail_form.elements[7].length) {
		document.mail_form.elements[7].options[oprows].selected=true;
		oprows++;
	}
	
	document.mail_form.submit();
}

function datachk (frm) {
	var alertchk=0;
	var alerttxt="";
	
	if(frm.m_sbj.value=="") {
		alertchk=1;
		alerttxt="件名を入力して下さい。\n";		
	}
	
	if(frm.m_txt.value=="") {
		alertchk=1;
		alerttxt="メール本文を入力して下さい。\n";
	}
	
	if(alertchk==0) {
		res=confirm("この内容で登録してよろしいですか？");
		if(res) {
			frm.submit();
		}
	}
	else {
		alert(alerttxt);
	}
	
}

</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
	
	<tr>
			<td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
							<tr>
									<td width="4%"><img src="/GW/img/template/icon_mail.jpg" width="40" height="42"></td>
									<td width="96%" class="title"><font color="#333333">メールテンプレート登録</font></td>
							</tr>
					</table>
			</td>
	</tr>
	<tr>
		<td>
			<form action="" method="POST" enctype="multipart/form-data" name="mail_form" id="mail_form">
	<?php 
	if($_REQUEST["PROCCESS"]=="regist") {
		$send_address=$_REQUEST["m_raddress"];
			$s_sql="select max(temp_id) as maxid from mail_templete ";
			$s_data=$dbobj->GetData($s_sql);
			$maxid=1+$s_data["maxid"];
			$inssql="insert into mail_templete(temp_id,subject,check_address,m_text) ".
					" values (".$maxid.",'".$_REQUEST["m_sbj"]."','".$_REQUEST["m_raddress"]."','".$_REQUEST["m_txt"]."')";
			$dbobj->Query($inssql);
			?>
			<script language="javascript">
			location.replace("?PID=mail_template");
			</script>
			<?php
				}
				else {
				?>
				<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
					<TR>
						<TD>
								<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								
								
								<TR>
									<TD width="140" align="right" bgcolor="#ececec">
								  		<div align="right"><strong>件名：</strong></div>
									</TD>
									<TD align="left" bgcolor="#FFFFFF">
										<input name="m_sbj" type="text" id="m_sbj" size="40" style="width:98%;">
									</TD>
								</TR>
								<TR>
									<TD width="140" align="right" bgcolor="#ececec">
											<div align="right"><strong>送信元アドレス：</strong></div>
									</TD>
									<TD align="left" bgcolor="#FFFFFF">
										<input name="m_raddress" type="text" id="m_raddress" size="40" style="width:98%; ime-mode:disabled;">
									</TD>
								</TR>
								<TR>
									<TD width="140" align="right" valign="top" bgcolor="#ececec">
								  		<div align="right"><strong>メール本文：</strong></div>
									</TD>
									<TD align="left" bgcolor="#FFFFFF">
									    <textarea name="m_txt" cols="60" rows="20" id="m_txt" style="width:98%;"></textarea>
									</TD>
								</TR>
							</TABLE>
						</TD>
					</TR>
					<TR>
							<TD>
									<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
											<TR>
													<TD width="145">&nbsp;</TD>
													<TD>
															<input type="button" name="Submit" value="登録する" onClick="datachk(this.form)">
															<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
															<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
															<input name="back" type="button" id="back" value="戻る" onClick="location.href='?PID=mail_template'">
													</TD>
											</TR>
									</TABLE>
							</TD>
					</TR>
				</TABLE>

<?php 	
}
?>			</form>
		</td>
	</tr>
</table>
