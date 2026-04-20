<?php 
if($_POST["PROCCESS"]=="check") {
	$idchksql="select * from member where member_id <> ".$_POST["member_id"]." and login_id = '".$_POST["memberid"]."'";
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
<table width="740" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td>
			<table width="740" border="0" align="center" cellpadding="2" cellspacing="2">
            	<tr>
            		<td width="45"><img src="/members/img/members_sic.gif" width="45" height="40"></td>
            		<td>
            			<div id="tree"><span class="top">会員管理</span>　<span class="gt">>></span>　<span class="sub">会員情報修正</span></div>
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
		
		$sql="update member set ".
			 "member_name='".$_SESSION["new_membername"]."',".
			 "login_id='".$_SESSION["memberid"]."',".
			 "hurigana='".$_SESSION["new_memberhurigana"]."',".
			 "login_pw='".$_SESSION["member_password"]."',".
			 "zipcode='".$_SESSION["new_zipcode"]."',".
			 "address='".$_SESSION["new_address"]."',".
			 "telnumber='".$_SESSION["new_telnumber"]."',".
			 "faxnumber='".$_SESSION["new_faxnumber"]."',".
			 "homepage='".$_SESSION["new_url"]."',".
			 "mailaddress='".$_SESSION["new_mail"]."',".
			 "corpname='".$_SESSION["new_corpname"]."',".
			 "sname='".$_SESSION["new_sname"]."',".
			 "kpass='".md5($_SESSION["memberid"].$_REQUEST["member_id"].$_SESSION["member_password"])."',".
			 "kmail='".$_SESSION["new_kmail"]."'".
			 " where member_id = ".$_REQUEST["member_id"];
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
		$_SESSION["member_id"]="";
		$_SESSION["new_corpname"]="";
		$_SESSION["new_sname"]="";
		?>
            	<TABLE width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
            		<TR>
            			<TD>&nbsp;</TD>
           			</TR>
            		<TR>
            			<TD>
            				<div align="center">更新しました。</div>
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
		$_SESSION["new_membername"]=$_REQUEST["new_membername"];
		$_SESSION["new_zipcode"]=$_REQUEST["new_zipcode"];
		$_SESSION["new_address"]=$_REQUEST["new_address"];
		$_SESSION["new_telnumber"]=$_REQUEST["new_telnumber"];
		$_SESSION["new_faxnumber"]=$_REQUEST["new_faxnumber"];
		$_SESSION["new_url"]=$_REQUEST["new_url"];
		$_SESSION["new_mail"]=$_REQUEST["new_mail"];
		$_SESSION["memberid"]=$_REQUEST["memberid"];
		$_SESSION["member_password"]=$_REQUEST["member_password"];
		$_SESSION["new_kmail"]=$_REQUEST["new_kmail"];
		$_SESSION["new_corpname"]=$_REQUEST["new_corpname"];
		$_SESSION["new_sname"]=$_REQUEST["new_sname"];
		$_SESSION["new_memberhurigana"]=$_REQUEST["new_memberhurigana"];
		
	?>
            	<TABLE width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
            		<TR>
            			<TD height="320">
            				<TABLE width="700"  border="0" cellspacing="2" cellpadding="2">
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>ログインID：</strong></div>
           							</TD>
            						<TD> <?php echo $_SESSION["memberid"];?> </TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>パスワード：</strong></div>
           							</TD>
            						<TD> <?php echo $_SESSION["member_password"];?> </TD>
           						</TR>
            					<TR>
            						<th align="right" background="/members/img/filemenu_bg.gif">会社名：</th>
            						<TD><?php echo $_SESSION["new_corpname"];?></TD>
           						</TR>
            					<TR>
            						<TD width="20%" background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>名前：</strong></div>
           							</TD>
            						<TD width="80%"> <?php echo $_SESSION["new_membername"];?> </TD>
           						</TR>
            					<TR>
            						<th align="right" background="/members/img/filemenu_bg.gif">ふりがな：</th>
            						<TD><?php echo $_SESSION["new_memberhurigana"];?></TD>
           						</TR>
            					<TR>
            						<TD align="right" background="/members/img/filemenu_bg.gif"><strong>携帯表示用略称：</strong></TD>
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
            						<th align="right" background="/members/img/filemenu_bg.gif">携帯メール：</th>
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
            				<input type="submit" name="Submit" value="更新する">
            				<input type="button" name="Submit" value="戻る" onClick="data_correct()">
            				<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
            				<input name="mode" type="hidden" id="mode" value="<?php echo $_REQUEST["mode"];?>">
            				<input name="member_id" type="hidden" id="member_id" value="<?php echo $_REQUEST["member_id"];?>">
           				</TD>
           			</TR>
           		</TABLE>
            	<?php 
	}
	else {
		if($_REQUEST["submit"]!="更新する") {
			$sql="select * from member where member_id= ".$_REQUEST["member_id"];
			$result=$dbobj->Query($sql);
			$resultnumrows=$dbobj->NumRows($result);
			if($resultnumrows!=0) {
				$data=$dbobj->FetchArray($result,0);
				$_SESSION["new_membername"]=$data["member_name"];
				$_SESSION["new_zipcode"]=$data["zipcode"];
				$_SESSION["new_address"]=$data["address"];
				$_SESSION["new_telnumber"]=$data["telnumber"];
				$_SESSION["new_faxnumber"]=$data["faxnumber"];
				$_SESSION["new_memberhurigana"]=$data["hurigana"];
				
				$_SESSION["new_url"]=$data["homepage"];
				$_SESSION["new_mail"]=$data["mailaddress"];
				$_SESSION["memberid"]=$data["login_id"];
				$_SESSION["member_password"]=$data["login_pw"];
				$_SESSION["new_corpname"]=$data["corpname"];
				$_SESSION["new_sname"]=$data["sname"];
			}
		}		
	?>
            	<TABLE width="700"  border="0" align="center" cellpadding="2" cellspacing="2">
            		<TR>
            			<TD>
            				<TABLE width="700"  border="0" cellspacing="2" cellpadding="2">
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>ログインID：</strong></div>
           							</TD>
            						<TD>
            							<input name="memberid" type="text" id="memberid" value="<?php echo $_SESSION["memberid"];?>">
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>パスワード：</strong></div>
           							</TD>
            						<TD>
            							<input name="member_password" type="text" id="member_password" value="<?php echo $_SESSION["member_password"];?>">
           							</TD>
           						</TR>
            					<TR>
            						<th align="right" background="/members/img/filemenu_bg.gif">会社名：</th>
            						<TD>
            							<input name="new_corpname" type="text" id="new_corpname" value="<?php echo $_SESSION["new_corpname"];?>">
            						</TD>
           						</TR>
            					<TR>
            						<TD width="20%" background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>名前： </strong></div>
           							</TD>
            						<TD width="80%">
            							<input name="new_membername" type="text" id="new_membername" value="<?php echo $_SESSION["new_membername"];?>" size="40">
           							</TD>
           						</TR>
            					<TR>
            						<th align="right" background="/members/img/filemenu_bg.gif">ふりがな：</th>
            						<TD>
            							<input name="new_memberhurigana" type="text" id="new_memberhurigana" value="<?php echo $_SESSION["new_memberhurigana"];?>" size="40">
</TD>
           						</TR>
            					<TR>
            						<TD align="right" background="/members/img/filemenu_bg.gif"><strong>携帯表示用略称：</strong></TD>
            						<TD>
            							<input name="new_sname" type="text" id="new_sname" value="<?php echo $_SESSION["new_sname"];?>">
            						</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>郵便番号： </strong></div>
           							</TD>
            						<TD>
            							<input name="new_zipcode" type="text" id="new_zipcode" value="<?php echo $_SESSION["new_zipcode"];?>">
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>住所： </strong></div>
           							</TD>
            						<TD>
            							<textarea name="new_address" cols="40" id="new_address"><?php echo $_SESSION["new_address"];?></textarea>
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>電話番号： </strong></div>
           							</TD>
            						<TD>
            							<input name="new_telnumber" type="text" id="new_telnumber" value="<?php echo $_SESSION["new_telnumber"];?>">
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>FAX番号： </strong></div>
           							</TD>
            						<TD>
            							<input name="new_faxnumber" type="text" id="new_faxnumber" value="<?php echo $_SESSION["new_faxnumber"];?>">
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>ホームページ： </strong></div>
           							</TD>
            						<TD>
            							<input name="new_url" type="text" id="new_url" value="<?php echo $_SESSION["new_url"];?>" size="40">
           							</TD>
           						</TR>
            					<TR>
            						<TD background="/members/img/filemenu_bg.gif">
            							<div align="right"><strong>メールアドレス： </strong></div>
           							</TD>
            						<TD>
            							<input name="new_mail" type="text" id="new_mail" value="<?php echo $_SESSION["new_mail"];?>" size="40">
           							</TD>
           						</TR>
            					<TR>
            						<th background="/members/img/filemenu_bg.gif">
            							<div align="right">携帯メール：</div>
            						</th>
            						<TD>
            							<input name="new_kmail" type="text" id="new_kmail" value="<?php echo $_SESSION["new_kmail"];?>" size="40">
            						</TD>
           						</TR>
           					</TABLE>
           				</TD>
           			</TR>
            		<TR>
            			<TD>&nbsp;</TD>
           			</TR>
            		<TR>
            			<TD height="30" background="/members/img/bukken_bg.gif">
            				<input name="btm_chk" type="button" id="btm_chk" value="確認する" onClick="datachk(this.form)">
            				<input name="btm_back" type="button" id="btm_back" onClick="window.location.replace('index.php?PID=members')" value="戻る">
            				<input name="PROCCESS" type="hidden" id="PROCCESS" value="check">
            				<input name="mode" type="hidden" id="mode" value="<?php echo $_REQUEST["mode"];?>">
            				<input name="member_id" type="hidden" id="member_id" value="<?php echo $_REQUEST["member_id"];?>">
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
