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
	?>
<script language="javascript">
function datachk(frm) {
	if(frm.member_password.value=="") {
		alert("ログインパスワードが入力されていません。");
	}
	else {
		frm.submit();
	}
}
</script><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<form action="" method="POST" enctype="multipart/form-data" name="shiken_correct_form">
		<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
				<TR valign="top">
						<TD width="100%" colspan="2"> <strong> </strong>
										<?php
  	if($_POST["PROCCESS"]=="regist") {
		if($_REQUEST["new_b_nengou"]!=NULL&&$_REQUEST["new_b_year"]!=NULL&&$_REQUEST["new_b_month"]!=NULL&&$_REQUEST["new_b_day"]!=NULL){
			$b_day=$_REQUEST["new_b_nengou"]+$_REQUEST["new_b_year"]."-".$_REQUEST["new_b_month"]."-".$_REQUEST["new_b_day"];
		}
		else {
			$b_day="1967-11-11";
		}
		$sql="update member set ".
			 "member_name='".$_REQUEST["new_membername"]."',".
			 "hurigana='".$_REQUEST["new_hurigana"]."',".
			 "login_pw='".$_REQUEST["member_password"]."',".
			 "zipcode='".$_REQUEST["new_zipcode"]."',".
			 "address='".$_REQUEST["new_address"]."',".
			 "telnumber='".$_REQUEST["new_telnumber"]."',".
			 "faxnumber='".$_REQUEST["new_faxnumber"]."',".
			 "homepage='".$_REQUEST["new_url"]."',".
			 "mailaddress='".$_REQUEST["new_mail"]."',".
			 "corpname='".$_REQUEST["new_corpname"]."',".
//			 "sname='".$_REQUEST["new_sname"]."',".
			// "kpass='".md5($_SESSION["memberid"].$_REQUEST["member_id"].$_SESSION["member_password"])."',".
			 "kmail='".$_REQUEST["new_kmail"]."',".
			 "k_tel='".$_REQUEST["new_ktel"]."',".
			 "sname='".$_REQUEST["new_sname"]."',".
			 "opname='".$_REQUEST["new_opname"]."',".
//			 "opyear='".$_REQUEST["new_op_ryear"]."',".
			 "birthday='".$b_day."',".
			 "bloodtype='".$_REQUEST["new_bloodtype"]."',".
			 "corppost='".$_REQUEST["new_corppost"]."',".
			 "corpzipcode='".$_REQUEST["new_corpzipcode"]."',".
			 "corpaddress='".$_REQUEST["new_corpaddress"]."',".
			 "corptel='".$_REQUEST["new_corptel"]."',".
			 "kana=".srhkana($_REQUEST["new_hurigana"]).",".
			 "admin_type=".($_REQUEST["admin_type"]).",".
			 "wether_area='".$_REQUEST["wether_area"]."',".
			 "corpfax='".$_REQUEST["new_corpfax"]."'".
			 " where member_id = ".$_REQUEST["member_id"];
			 $result=$dbobj->Query($sql);
			 
			 $upsql2="update login set login_pw = '".$_REQUEST["member_password"]."',login_type=".$_REQUEST["admin_type"]." where login_id = '".$_POST["dloginid"]."'";
			//	exit();
			 $result=$adminobj->Query($upsql2);
			 if($logindata["member_id"]==$_POST["member_id"]) {
					$_SESSION["login_pass"]=$_POST["member_password"];
			 }
	?>
	
										<?php
  
	}
	
	$sql="select * from member where member_id =".$_REQUEST["member_id"];
	$mdata=$dbobj->GetData($sql);
	$exb_day=explode("-",$mdata["birthday"]);
	?>
						</TD>
				</TR>
				<TR valign="top">
						<TD colspan="2">
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
																								<th align="right" bgcolor="#ececec"><strong>名前</strong>：</th>
																								<TD align="left" bgcolor="#FFFFFF">
																										<input name="new_membername" type="text" id="new_membername" value="<?php echo  $mdata["member_name"];?>" size="40" style="ime-mode:active">
																										<input name="member_id" type="hidden" id="member_id" value="<?php echo  $mdata["member_id"];?>">
																								</TD>
																						</TR>
																						<TR>
																								<th align="right" bgcolor="#ececec"><strong>ふりがな：</strong></th>
																								<TD align="left" bgcolor="#FFFFFF">
																										<input name="new_hurigana" type="text" id="new_hurigana" value="<?php echo  $mdata["hurigana"];?>" size="40" style="ime-mode:active">
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>パスワード：</strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="member_password" type="text" id="member_password" value="<?php echo  $mdata["login_pw"];?>" style="ime-mode:disabled;">
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>肩書き：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="new_opname" type="text" id="new_opname" value="<?php echo  $mdata["opname"];?>" size="40" style="ime-mode:active">
																								</TD>
																						</TR>
																						<!--<TR>
													<td align="right"><strong>JC入会年：</strong></td>
													<TD align="left">
														<input name="new_op_ryear" type="text" id="new_op_ryear" value="<?php echo  $mdata["opyear"];?>" style="ime-mode:disabled">
													</TD>
												</TR>-->
																						
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>生年月日：</strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<?php
															$exb_day=explode("-",$mdata["birthday"]);

														if($exb_day[0]-1989>=0) {
															$g_type=1989;
															$b_year=$exb_day[0]-1989;
															
														}
														else if($exb_day[0]-1925>=0) {
															$g_type=1925;
															$b_year=$exb_day[0]-1925;
														}
														 ?>
																										<select name="new_b_nengou" id="new_b_nengou">
																												<option value="1925"<?php if($g_type==1925) {echo " selected";}?>>昭和</option>
																												<option value="1989"<?php if($g_type==1989) {echo " selected";}?>>平成</option>
																										</select>
																										<input name="new_b_year" type="text" id="new_b_year" value="<?php echo $b_year;?>" size="8" style="ime-mode:disabled">
																										年
																										<input name="new_b_month" type="text" id="new_b_month" value="<?php echo $exb_day[1];?>" size="8" style="ime-mode:disabled">
																										月
																										<input name="new_b_day" type="text" id="new_b_day" value="<?php echo $exb_day[2];?>" size="8" style="ime-mode:disabled">
																										日</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>血液型：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<select name="new_bloodtype" id="new_bloodtype">
																												<option value="--">--</option>
																												<option value="A"<?php if($mdata["bloodtype"]=="A"){ echo " selected";}?>>A</option>
																												<option value="B"<?php if($mdata["bloodtype"]=="B"){ echo " selected";}?>>B</option>
																												<option value="O"<?php if($mdata["bloodtype"]=="O"){ echo " selected";}?>>O</option>
																												<option value="AB"<?php if($mdata["bloodtype"]=="AB"){ echo " selected";}?>>AB</option>
																										</select>
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>ホームページ： </strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="new_url" type="text" id="new_url" value="<?php echo  $mdata["homepage"];?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>メールアドレス： </strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="new_mail" type="text" id="new_mail" value="<?php echo  $mdata["mailaddress"];?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>携帯TEL：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="new_ktel" type="text" id="new_ktel" value="<?php echo  $mdata["k_tel"];?>" size="40" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>携帯メールアドレス：</strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<input name="new_kmail" type="text" id="new_kmail" value="<?php echo  $mdata["kmail"];?>" size="40" style="ime-mode:disabled">
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
																								<TD width="20%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>郵便番号： </strong></div>
																								</TD>
																								<TD width="80%" bgcolor="#FFFFFF">
																										<input name="new_zipcode" type="text" id="new_zipcode" value="<?php echo  $mdata["zipcode"];?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<TD align="right" valign="top" bgcolor="#ECECEC">
																										<div align="right"><strong>所在地： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF">
																										<textarea name="new_address" cols="40" id="new_address" style="ime-mode:active"><?php echo  $mdata["address"];?></textarea>
																								</TD>
																						</TR>
																						<TR>
																								<TD align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>電話番号： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF">
																										<input name="new_telnumber" type="text" id="new_telnumber" value="<?php echo  $mdata["telnumber"];?>" style="ime-mode:disabled">
																								</TD>
																						</TR>
																						<TR>
																								<TD align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>FAX番号： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF">
																										<input name="new_faxnumber" type="text" id="new_faxnumber" value="<?php echo  $mdata["faxnumber"];?>" style="ime-mode:disabled">
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
																								<td width="20%" align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>権限： </strong></div>
																								</td>
																								<td width="80%" bgcolor="#FFFFFF">
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
														<input name="btm_chk" type="button" id="btm_chk" value="更新する" onClick="datachk(this.form)">
														<input name="btm_back" type="button" id="btm_back" onClick="location.href='?PID=members'" value="戻る">
														<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
														<input name="PID" type="hidden" id="PID" value="members_correct">
												  <input name="dloginid" type="hidden" id="dloginid" value="<?php echo $mdata["login_id"];?>">
												</TD>
												<TD>&nbsp;</TD>
										</TR>
								</TABLE>
						</TD>
				</TR>
		</TABLE>
</form>
