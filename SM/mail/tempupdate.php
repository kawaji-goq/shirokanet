<?php 

$gobj=new Group($dbobj);
$mobj=new Member($dbobj);
$gdata=$gobj->GetList(" turn ");
$mdata=$mobj->GetList();
$tmpsql="select * from mail_templete where temp_id= ".$_GET["temp_id"];
$tmpdata=$dbobj->GetData($tmpsql);
?><?php ?>
<script language="javascript">

function data_chk (frm) {
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
		res=confirm("この内容で修正してよろしいですか？");
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
									<td width="96%" class="title"><font color="#333333">メールテンプレート更新</font></td>
							</tr>
					</table>
			</td>
	</tr>
	<tr>
		<td>
			<form action="" method="POST" enctype="multipart/form-data" name="mail_form" id="mail_form">
	<?php 
	if($_REQUEST["PROCCESS"]=="update") {
		$send_address=$_REQUEST["m_raddress"];
			$inssql="update mail_templete set ".
											"subject='".$_REQUEST["m_sbj"]."',".
											"check_address='".$_REQUEST["m_raddress"]."',".
											"m_text = '".$_REQUEST["m_txt"]."'".
											" where temp_id = ".$_REQUEST["temp_id"]."";
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
										<input name="m_sbj" type="text" id="m_sbj" style="width:98%;" value="<?php echo $tmpdata["subject"] ?>" size="40">
									</TD>
								</TR>
								<TR>
									<TD width="140" align="right" bgcolor="#ececec">
											<div align="right"><strong>送信元アドレス：</strong></div>
									</TD>
									<TD align="left" bgcolor="#FFFFFF">
										<input name="m_raddress" type="text" id="m_raddress" style="width:98%;ime-mode:disabled;" value="<?php echo $tmpdata["check_address"] ?>" size="40">
									</TD>
								</TR>
								<TR>
									<TD width="140" align="right" valign="top" bgcolor="#ececec">
								  		<div align="right"><strong>メール本文：</strong></div>
									</TD>
									<TD align="left" bgcolor="#FFFFFF">
									    <textarea name="m_txt" cols="60" rows="20" id="m_txt" style="width:98%;"><?php echo $tmpdata["m_text"] ?></textarea>
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
															<input name="btm_update" type="button" id="btm_update" onClick="data_chk(this.form)" value="更新する">
															<input name="PROCCESS" type="hidden" id="PROCCESS" value="update">
															<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
															<input name="temp_id" type="hidden" id="PID" value="<?php echo $_REQUEST["temp_id"];?>">
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
