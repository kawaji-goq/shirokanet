<?php 
function srhkana($text){
	$text=trim($text);
	$text=mb_substr($text,0,1);
	switch($text) {
		case "あ":
			$rnum=0;
			break;
		case "い":
			$rnum=0;
			break;
		case "う":
			$rnum=0;
			break;
		case "え":
			$rnum=0;
			break;
		case "お":
			$rnum=0;
			break;
		case "か":
			$rnum=1;
			break;
		case "き":
			$rnum=1;
			break;
		case "く":
			$rnum=1;
			break;
		case "け":
			$rnum=1;
			break;
		case "こ":
			$rnum=1;
			break;
		case "が":
			$rnum=1;
			break;
		case "ぎ":
			$rnum=1;
			break;
		case "ぐ":
			$rnum=1;
			break;
		case "げ":
			$rnum=1;
			break;
		case "ご":
			$rnum=1;
			break;
		case "さ":
			$rnum=2;
			break;
		case "し":
			$rnum=2;
			break;
		case "す":
			$rnum=2;
			break;
		case "せ":
			$rnum=2;
			break;
		case "そ":
			$rnum=2;
			break;
		case "ざ":
			$rnum=2;
			break;
		case "じ":
			$rnum=2;
			break;
		case "ず":
			$rnum=2;
			break;
		case "ぜ":
			$rnum=2;
			break;
		case "ぞ":
			$rnum=2;
			break;
		case "た":
			$rnum=3;
			break;
		case "ち":
			$rnum=3;
			break;
		case "つ":
			$rnum=3;
			break;
		case "て":
			$rnum=3;
			break;
		case "と":
			$rnum=3;
			break;
		case "だ":
			$rnum=3;
			break;
		case "ぢ":
			$rnum=3;
			break;
		case "づ":
			$rnum=3;
			break;
		case "で":
			$rnum=3;
			break;
		case "ど":
			$rnum=3;
			break;
		case "な":
			$rnum=4;
			break;
		case "に":
			$rnum=4;
			break;
		case "ぬ":
			$rnum=4;
			break;
		case "ね":
			$rnum=4;
			break;
		case "の":
			$rnum=4;
			break;
		case "は":
			$rnum=5;
			break;
		case "ひ":
			$rnum=5;
			break;
		case "ふ":
			$rnum=5;
			break;
		case "へ":
			$rnum=5;
			break;
		case "ほ":
			$rnum=5;
			break;
		case "ば":
			$rnum=5;
			break;
		case "び":
			$rnum=5;
			break;
		case "ぶ":
			$rnum=5;
			break;
		case "べ":
			$rnum=5;
			break;
		case "ぼ":
			$rnum=5;
			break;
		case "ぱ":
			$rnum=5;
			break;
		case "ぴ":
			$rnum=5;
			break;
		case "ぷ":
			$rnum=5;
			break;
		case "ぺ":
			$rnum=5;
			break;
		case "ぽ":
			$rnum=5;
			break;
		case "ま":
			$rnum=6;
			break;
		case "み":
			$rnum=6;
			break;
		case "む":
			$rnum=6;
			break;
		case "め":
			$rnum=6;
			break;
		case "も":
			$rnum=6;
			break;
		case "や":
			$rnum=7;
			break;
		case "ゆ":
			$rnum=7;
			break;
		case "よ":
			$rnum=7;
			break;
		case "ら":
			$rnum=8;
			break;
		case "り":
			$rnum=8;
			break;
		case "る":
			$rnum=8;
			break;
		case "れ":
			$rnum=8;
			break;
		case "ろ":
			$rnum=8;
			break;
		case "わ":
			$rnum=9;
			break;
		case "を":
			$rnum=9;
			break;
		case "ん":
			$rnum=9;
			break;
		default:
			$rnum=999;
			break;
	}
	return $rnum;
}
?><script language="javascript">
function datachk(frm) {
 if(frm.member_password.value=="") {
		alert("ログインパスワードが入力されていません。");
	}
	else {
		frm.PROCCESS.value="regist";
		frm.submit();
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
		<TR valign="top">
				<TD width="100%" colspan="2"> <strong> </strong>
						<?php
  	if($_POST["PROCCESS"]=="regist") {
		$sql1="select max(member_id) as maxid from member";
		$result1=$dbobj->Query($sql1);
		$resultnumrows1=$dbobj->NumRows($result1);
		$maxid=1;
		if($resultnumrows1!=0) {
			$data1=$dbobj->FetchArray($result1,0);
			$maxid+=$data1["maxid"];
			
		}
		
		if($_REQUEST["new_b_nengou"]!=NULL&&$_REQUEST["new_b_year"]!=NULL&&$_REQUEST["new_b_month"]!=NULL&&$_REQUEST["new_b_day"]!=NULL){
			$b_day="'".($_REQUEST["new_b_nengou"]+$_REQUEST["new_b_year"])."-".$_REQUEST["new_b_month"]."-".$_REQUEST["new_b_day"]."'";
		}
		else {
			$b_day="null";
		}
		$_REQUEST["memberid"]=$_SESSION["DomainData"]["domain_name"].$maxid;
		$sql="insert into member (member_id,member_name,zipcode,address,telnumber,faxnumber,homepage,mailaddress,turn,hurigana,login_id,login_pw,kmail,corpname,sname,kpass,opname,birthday,bloodtype,corppost,corpzipcode,corpaddress,corptel,corpfax,k_tel,kana,wether_area) values ".
			 "('".$maxid."','".$_REQUEST["new_membername"]."','".$_REQUEST["new_zipcode"]."','".$_REQUEST["new_address"]."','".$_REQUEST["new_telnumber"].
			 "','".$_REQUEST["new_faxnumber"]."','".$_REQUEST["new_url"]."','".$_REQUEST["new_mail"]."','".$maxid."','".$_REQUEST["new_hurigana"]."','".
			 $_REQUEST["memberid"]."','".$_REQUEST["member_password"]."','".$_REQUEST["new_kmail"]."','".$_REQUEST["new_corpname"]."','".$_REQUEST["new_sname"]."','".md5($_REQUEST["memberid"].$maxid.$_REQUEST["member_password"])."','".
			  $_REQUEST["new_opname"]."',".$b_day.",'".$_REQUEST["new_bloodtype"]."','".$_REQUEST["new_corppost"]."','".$_REQUEST["new_corpzipcode"]."','".$_REQUEST["new_corpaddress"]."','".$_REQUEST["new_corptel"]."','".$_REQUEST["new_corpfax"]."','".$_REQUEST["new_ktel"]."',".srhkana($_REQUEST["new_hurigana"]).",'".$_REQUEST["wether_area"]."'".
			 ")";
		$result=$dbobj->Query($sql);
		
		$insql="insert into login(login_id,login_pw,login_type,domain,kpass) values (".
						"'".$_REQUEST["memberid"]."','".$_REQUEST["member_password"]."',".$_REQUEST["admin_type"].",'".$_SESSION["DomainData"]["domain_name"]."','".md5($_REQUEST["memberid"].$maxid.$_REQUEST["member_password"])."'".
						")";
		$result=$adminobj->Query($insql);
	?>
						<script language="javascript">
	window.location.replace("index.php?PID=members");
						</script>
						<?php
	
  
	}
	?>
</TD>
		</TR>
		<TR valign="top">
				<TD colspan="2">
						<form name="form1" method="post" action="">
								<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
										<TR>
												<th width="50%" valign="top">
														<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
																<TR>
																		<th width="100%">基本情報</th>
																</TR>
																<TR>
																		<TD>
																				<TABLE width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>名前</strong>：</div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_membername" type="text" id="new_membername" value="<?php echo $new_membername;?>" size="40" style="ime-mode:active">
																								</TD>
																						</TR>
																						<TR>
																								<td align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>ふりがな：</strong></div>
																								</td>
																								<TD bgcolor="#FFFFFF">
																										<input name="new_hurigana" type="text" id="new_hurigana" value="<?php echo $new_hurigana;?>" size="40" style="ime-mode:active">
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>パスワード：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="member_password" type="text" id="member_password" value="<?php echo $member_password;?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>肩書き：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_opname" type="text" id="new_opname" value="<?php echo $new_opname;?>" size="40" style="ime-mode:active">
																										<input name="new_op_ryear" type="hidden" id="new_op_ryear" value="<?php echo $new_opyear;?>" style="ime-mode:disabled" />
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>生年月日：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<select name="new_b_nengou" id="new_b_nengou">
																												<option value="1925" selected>昭和</option>
																												<option value="1989">平成</option>
																										</select>
																										<input name="new_b_year" type="text" id="new_b_year" value="<?php echo $new_b_year;?>" size="8" style="ime-mode:disabled">
																										年
																										<input name="new_b_month" type="text" id="new_b_month" value="<?php echo $new_b_month;?>" size="8" style="ime-mode:disabled">
																										月
																										<input name="new_b_day" type="text" id="new_b_day" value="<?php echo $new_b_day;?>" size="8" style="ime-mode:disabled">
																										日</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>血液型：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<select name="new_bloodtype" id="new_bloodtype">
																												<option value="--" selected>--</option>
																												<option value="A">A</option>
																												<option value="B">B</option>
																												<option value="O">O</option>
																												<option value="AB">AB</option>
																										</select>
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>ホームページ： </strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_url" type="text" id="new_url" value="<?php echo $new_url;?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>メールアドレス： </strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_mail" type="text" id="new_mail" value="<?php echo $new_mail;?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>携帯TEL：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_ktel" type="text" id="new_ktel" value="<?php echo $new_ktel;?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>携帯メールアドレス：</strong></div>
																								</td>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_kmail" type="text" id="new_kmail" value="<?php echo $new_kmail;?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																				</TABLE>
																		</TD>
																</TR>
														</TABLE>
												</th>
												<th width="50%" valign="top">
														<TABLE width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
																<TR>
																		<th>連絡先</th>
																</TR>
																<TR>
																		<TD>
																				<TABLE width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																						<TR>
																								<TD width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>郵便番号： </strong></div>
																								</TD>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_zipcode" type="text" id="new_zipcode" value="<?php echo $new_zipcode;?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<TD width="25%" align="right" valign="top" bgcolor="#ECECEC">
																										<div align="right"><strong>所在地： </strong></div>
																								</TD>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<textarea name="new_address" cols="40" id="new_address" style="ime-mode:active"><?php echo $new_address;?></textarea>
																								</TD>
																						</TR>
																						<TR>
																								<TD width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>電話番号： </strong></div>
																								</TD>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_telnumber" type="text" id="new_telnumber" value="<?php echo $new_telnumber;?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<TD width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>FAX番号： </strong></div>
																								</TD>
																								<TD width="75%" bgcolor="#FFFFFF">
																										<input name="new_faxnumber" type="text" id="new_faxnumber" value="<?php echo $new_faxnumber;?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																				</TABLE>
																		</TD>
																</TR>
																<TR>
																		<TD>&nbsp;</TD>
																</TR>
																<TR>
																		<TD>
																				<table width="100%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																						<tr>
																								<td width="25%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>権限： </strong></div>
																								</td>
																								<td width="75%" bgcolor="#FFFFFF">
																										<select name="admin_type">
																												<option value="20"<?php if($mdata["admin_type"]==20){echo " selected";}?>>一般</option>
																												<option value="10"<?php if($mdata["admin_type"]==10){echo " selected";}?>>管理</option>
																										</select>
																								</td>
																						</tr>
																				</table>
																		</TD>
																</TR>
														</TABLE>
												</th>
										</TR>
										<TR>
												<TD>&nbsp;</TD>
												<TD>&nbsp;</TD>
										</TR>
										<TR>
												<TD height="30">
														<input name="btm_chk" type="button" id="btm_chk" value="登録する" onClick="datachk(this.form)">
														<input name="btm_back" type="button" id="btm_back" onClick="window.location.replace('index.php?PID=members')" value="戻る">
														<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
														<input name="PID" type="hidden" id="PID" value="members_add">
												</TD>
												<TD>&nbsp;</TD>
										</TR>
								</TABLE>
												</form>
				</TD>
		</TR>
</TABLE>
