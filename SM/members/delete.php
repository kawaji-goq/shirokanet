<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
		<TR valign="top">
				<TD width="100%" colspan="2"> <strong> </strong>
						<?php 
	if($_REQUEST["PROCCESS"]=="regist") {
		$sql="select * from member where member_id = ".$_REQUEST["member_id"];
		$memdata=$dbobj->GetData($sql);
		$sql="delete from login where login_id = '".$memdata["login_id"]."'";
		$result=$adminobj->Query($sql);
		$sql="delete from member where member_id = ".$_REQUEST["member_id"];
		$result=$dbobj->Query($sql);
		$sql="delete from firstcoupon_log where mailcode = '".md5($memdata["email"]."'");
		$result=$dbobj->Query($sql);
		
		$_SESSION["new_membername"]="";
		$_SESSION["new_zipcode"]="";
		$_SESSION["new_address"]="";
		$_SESSION["new_telnumber"]="";
		$_SESSION["new_faxnumber"]="";
		$_SESSION["new_url"]="";
		$_SESSION["new_mail"]="";
		$_SESSION["member_id"]="";
		
		?>
		<script type="text/javascript">
		location.replace("?PID=members");
		</script>
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
																								<th align="right" bgcolor="#ececec"><strong>名前</strong>：</th>
																								<TD align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["member_name"];?> </TD>
																						</TR>
																						<TR>
																								<th align="right" bgcolor="#ececec"><strong>ふりがな：</strong></th>
																								<TD align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["hurigana"];?> </TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>パスワード：</strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["login_pw"];?> </TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>肩書き：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["opname"];?> </TD>
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
																										<?php if($g_type==1925) {echo "昭和";}?>
																										<?php if($g_type==1989) {echo "平成";}?>
																										<?php echo $b_year;?> 年 <?php echo $exb_day[1];?> 月 <?php echo $exb_day[2];?> 日</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>血液型：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF">
																										<?php if($mdata["bloodtype"]=="A"){ echo " A";}?>
																										<?php if($mdata["bloodtype"]=="B"){ echo " B";}?>
																										<?php if($mdata["bloodtype"]=="O"){ echo " O";}?>
																										<?php if($mdata["bloodtype"]=="AB"){ echo " AB";}?>
																								</TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>ホームページ： </strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["homepage"];?> </TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>メールアドレス： </strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["mailaddress"];?> </TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec"><strong>携帯TEL：</strong></th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["k_tel"];?> </TD>
																						</TR>
																						<TR>
																								<th width="25%" align="right" bgcolor="#ececec">
																										<div align="right"><strong>携帯メールアドレス：</strong></div>
																								</th>
																								<TD width="75%" align="left" bgcolor="#FFFFFF"> <?php echo  $mdata["kmail"];?> </TD>
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
																								<TD width="80%" bgcolor="#FFFFFF"> <?php echo  $mdata["zipcode"];?> </TD>
																						</TR>
																						<TR>
																								<TD align="right" valign="top" bgcolor="#ECECEC">
																										<div align="right"><strong>所在地： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF"> <?php echo  $mdata["address"];?> </TD>
																						</TR>
																						<TR>
																								<TD align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>電話番号： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF"> <?php echo  $mdata["telnumber"];?> </TD>
																						</TR>
																						<TR>
																								<TD align="right" bgcolor="#ECECEC">
																										<div align="right"><strong>FAX番号： </strong></div>
																								</TD>
																								<TD bgcolor="#FFFFFF"> <?php echo  $mdata["faxnumber"];?> </TD>
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
																										<?php if($mdata["admin_type"]==20){echo " 一般";}?>
																										<?php if($mdata["admin_type"]==10){echo " 管理";}?>
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
														<input type="submit" name="Submit" value="削除する">
														<input type="button" name="Submit" value="戻る" onClick="window.location.replace('index.php?PID=members')">
														<input name="PROCCESS" type="hidden" id="PROCCESS" value="regist">
														<input name="PID" type="hidden" id="PID" value="<?php echo $_REQUEST["PID"];?>">
														<input name="member_id" type="hidden" id="member_id" value="<?php echo $_REQUEST["member_id"];?>">
												</TD>
												<TD>&nbsp;</TD>
										</TR>
								</TABLE>
												</form>
				</TD>
		</TR>
</TABLE>
