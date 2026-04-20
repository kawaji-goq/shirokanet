<?php 
if($_POST["PROCCESS"]=="check") {
	$idchksql="select * from member where  login_id = '".$_POST["memberid"]."'";
	$idchkres=$dbobj->Query($idchksql);
	$idresnumrows=$dbobj->NumRows($idchkres);
	if($idresnumrows!=0) {
		?>
		<script language="javascript">
		alert("このログインIDは既に使用されています。");
		</script>
		<?php
		$_POST["PROCCESS"]="";
	}
}
?><script language="javascript">
function datachk(frm) {
	if(frm.memberid.value=="") {
		alert("ログインIDが入力されていません。");
	}
	else if(frm.member_password.value=="") {
		alert("ログインパスワードが入力されていません。");
	}
	else {
		frm.submit();
	}
}
</script><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td>
			<table width="740" border="0" align="center" cellpadding="2" cellspacing="2">
            	<tr>
            		<td width="45"><img src="/members/img/members_sic.gif" width="45" height="40"></td>
            		<td>
            			<div id="tree"><span class="top">会員管理</span>　<span class="gt">>></span>　<span class="sub">会員情報登録</span></div>
           			</td>
           		</tr>
            	</table>
		</td>
	</tr>
	<tr>
		<td>
			<form action="" method="POST" enctype="multipart/form-data" name="shiken_correct_form">
	<?php
  	if($_POST["PROCCESS"]=="regist") {
	
		$sql1="select max(member_id) as maxid from member";
		$result1=$dbobj->Query($sql1);
		$resultnumrows1=$dbobj->NumRows($result1);
		$maxid=1;
		
		if($resultnumrows1!=0) {
			$data1=$dbobj->FetchArray($result1,0);
			$maxid+=$data1[maxid];
		}
		
		$sql="insert into member (member_id,member_name,zipcode,address,telnumber,faxnumber,homepage,mailaddress,turn,hurigana,login_id,login_pw,kmail,corpname,sname,kpass) values ".
			 "('".$maxid."','".$_SESSION["new_membername"]."','".$_SESSION["new_zipcode"]."','".$_SESSION["new_address"]."','".$_SESSION["new_telnumber"].
			 "','".$_SESSION["new_faxnumber"]."','".$_SESSION["new_url"]."','".$_SESSION["new_mail"]."','".$maxid."','".$_SESSION["new_hurigana"]."','".
			 $_SESSION["memberid"]."','".$_SESSION["member_password"]."','".$_SESSION["new_kmail"]."','".$_SESSION["new_corpname"]."','".$_SESSION["new_sname"]."','".md5($_SESSION["memberid"].$maxid.$_SESSION["member_password"])."')";
		$result=$dbobj->Query($sql);
		
		$_SESSION["memberid"]="";
		$_SESSION["member_password"]="";
		$_SESSION["new_membername"]="";
		$_SESSION["new_zipcode"]="";
		$_SESSION["new_address"]="";
		$_SESSION["new_telnumber"]="";
		$_SESSION["new_faxnumber"]="";
		$_SESSION["new_url"]="";
		$_SESSION["new_mail"]="";
		$_SESSION["new_hurigana"]="";
		$_SESSION["new_kmail"]="";
		$_SESSION["new_corpname"]="";
		$_SESSION["new_sname"]="";
		
		?>
	<TABLE width="700"  border="0" align="center" cellpadding="1" cellspacing="1">
		<TR>
			<TD>&nbsp; </TD>
		</TR>
		<TR>
			<TD>
				<div align="center">登録しました。</div>
			</TD>
		</TR>
		<TR>
			<TD>
				<input type="button" name="Submit" value="戻る" onClick="window.location.replace('index.php?PID=members')">
			</TD>
		</TR>
	</TABLE>
	<?php 
  
	}
	else if($_POST["PROCCESS"]=="check") {
	
		$_SESSION["memberid"]=$_POST["memberid"];
		$_SESSION["member_password"]=$_POST["member_password"];
		$_SESSION["new_membername"]=$_POST["new_membername"];
		$_SESSION["new_zipcode"]=$_POST["new_zipcode"];
		$_SESSION["new_address"]=$_POST["new_address"];
		$_SESSION["new_telnumber"]=$_POST["new_telnumber"];
		$_SESSION["new_faxnumber"]=$_POST["new_faxnumber"];
		$_SESSION["new_url"]=$_POST["new_url"];
		$_SESSION["new_mail"]=$_POST["new_mail"];
		$_SESSION["new_hurigana"]=$_POST["new_hurigana"];
		$_SESSION["new_kmail"]=$_POST["new_kmail"];
		$_SESSION["new_corpname"]=$_POST["new_corpname"];
		$_SESSION["new_sname"]=$_POST["new_sname"];
		
		
		
	?>
	<TABLE width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
		<TR>
			<TD>
				<TABLE width="100%"  border="0" cellspacing="2" cellpadding="2">
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ログインID：</strong></div>
						</TD>
						<TD><?php echo $_SESSION["memberid"];?></TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>パスワード：</strong></div>
						</TD>
						<TD><?php echo $_SESSION["new_membername"];?></TD>
					</TR>
					<TR>
						<th background="/members/img/filemenu_bg.gif">
							<div align="right">会社名：</div>
						</th>
						<TD><?php echo $_SESSION["new_corpname"];?></TD>
					</TR>
					<TR>
						<TD width="20%" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>名前：</strong></div>
						</TD>
						<TD width="80%"> <?php echo $_SESSION["new_membername"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ふりがな：</strong> </div>
						</TD>
						<TD> <?php echo $_SESSION["new_hurigana"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>携帯表示用略称：</strong></div>
						</TD>
						<TD><?php echo $_SESSION["new_sname"];?></TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>郵便番号：</strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_zipcode"];?> </TD>
					</TR>
					<TR>
						<TD valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>住所： </strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_address"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>電話番号：</strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_telnumber"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>FAX番号： </strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_faxnumber"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ホームページ： </strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_url"];?> </TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>メールアドレス： </strong></div>
						</TD>
						<TD> <?php echo $_SESSION["new_mail"];?> </TD>
					</TR>
					<TR>
						<th background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>携帯メールアドレス：</strong></div>
						</th>
						<TD><?php echo $_SESSION["new_kmail"];?></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
			<TD height="30" background="/members/img/bukken_bg.gif">
				<input type="submit" name="Submit" value="追加する">
				<input type="button" name="Submit" value="戻る" onClick="data_correct()">
				<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
				<input name="PID" type="hidden" id="PID" value="members_add">
			</TD>
		</TR>
	</TABLE>
	<?php 
	}
	else {
	?>
	<TABLE width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
		<TR>
			<TD>
				<TABLE width="100%"  border="0" cellspacing="2" cellpadding="2">
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ログインID：</strong></div>
						</TD>
						<TD>
							<input name="memberid" type="text" id="memberid" value="<?php echo $memberid;?>">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>パスワード：</strong></div>
						</TD>
						<TD>
							<input name="member_password" type="text" id="member_password" value="<?php echo $member_password;?>">
						</TD>
					</TR>
					<TR>
						<th align="right" background="/members/img/filemenu_bg.gif">会社名：</th>
						<TD>
							<input name="new_corpname" type="text" id="new_corpname" value="<?php echo $new_corpname;?>" size="40">
						</TD>
					</TR>
					<TR>
						<TD width="20%" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>名前： </strong></div>
						</TD>
						<TD width="80%">
							<input name="new_membername" type="text" id="new_membername" value="<?php echo $new_membername;?>" size="40">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ふりがな：</strong></div>
						</TD>
						<TD>
							<input name="new_hurigana" type="text" id="new_hurigana" value="<?php echo $new_hurigana;?>" size="40">
						</TD>
					</TR>
					<TR>
						<TD align="right" background="/members/img/filemenu_bg.gif"><strong>携帯表示用略称：</strong></TD>
						<TD>
							<input name="new_sname" type="text" id="new_sname" value="<?php echo $new_sname;?>" size="40">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>郵便番号： </strong></div>
						</TD>
						<TD>
							<input name="new_zipcode" type="text" id="new_zipcode" value="<?php echo $new_zipcode;?>">
						</TD>
					</TR>
					<TR>
						<TD valign="top" background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>住所： </strong></div>
						</TD>
						<TD>
							<textarea name="new_address" cols="40" id="new_address"><?php echo $new_address;?></textarea>
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>電話番号： </strong></div>
						</TD>
						<TD>
							<input name="new_telnumber" type="text" id="new_telnumber" value="<?php echo $new_telnumber;?>">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>FAX番号： </strong></div>
						</TD>
						<TD>
							<input name="new_faxnumber" type="text" id="new_faxnumber" value="<?php echo $new_faxnumber;?>">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>ホームページ： </strong></div>
						</TD>
						<TD>
							<input name="new_url" type="text" id="new_url" value="<?php echo $new_url;?>" size="40">
						</TD>
					</TR>
					<TR>
						<TD background="/members/img/filemenu_bg.gif">
							<div align="right"><strong>メールアドレス： </strong></div>
						</TD>
						<TD>
							<input name="new_mail" type="text" id="new_mail" value="<?php echo $new_mail;?>" size="40">
						</TD>
					</TR>
					<TR>
						<th background="/members/img/filemenu_bg.gif">
							<div align="right">携帯メールアドレス：</div>
						</th>
						<TD>
							<input name="new_kmail" type="text" id="new_kmail" value="<?php echo $new_kmail;?>" size="40">
						</TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
		<TR>
			<TD>&nbsp;</TD>
		</TR>
		<TR>
			<TD height="30" background="/members/img/corpup_bg.gif">
				<input name="btm_chk" type="button" id="btm_chk" value="確認する" onClick="datachk(this.form)">
				<input name="btm_back" type="button" id="btm_back" onClick="window.location.replace('index.php?PID=members')" value="戻る">
				<input name="PROCCESS" type="hidden" id="PROCCESS" value="check">
				<input name="PID" type="hidden" id="PID" value="members_add">
			</TD>
		</TR>
	</TABLE>
	<?php 
	}
	?>
</form>
</td>
	</tr>
</table>
