<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php

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

//include("./lib/mobile_class_7.php");
ini_set('display_errors',0);
if($_REQUEST["update_turn"]=="更新する") {
	for($i=0;$_REQUEST["mem_id"][$i]!=NULL;$i++) {
		
		if($_REQUEST["turn"][$i]==NULL) {
			$_REQUEST["turn"][$i]="null";
		}
	//	echo "update member set turn =".$_REQUEST["turn"][$i]." where member_id = ".$_REQUEST["mem_id"][$i];
		$dbobj->Query("update member set turn =".$_REQUEST["turn"][$i]." where member_id = ".$_REQUEST["mem_id"][$i]);
		
		
	}
	
}
$mailsend_chk=0;
for($i=0;$_REQUEST["mem_id"][$i]!=NULL;$i++) {
	if($_REQUEST["url_send"][$i]=="通知する") {
		$memberdata=$dbobj->GetData("select * from member where member_id = ".$_REQUEST["mem_id"][$i]);
		if($_REQUEST["pcmail"][$i]==1&&$memberdata["mailaddress"]!="") {
				$mess="下記URLからグループウェアにアクセスしてください。\nhttp://".$_SESSION["DomainData"]["domain_name"]."/GW/\n\nパスワード：".$memberdata["login_pw"];
				mb_send_mail($memberdata["mailaddress"],"グループウェアのURL",$mess,"From:info@".$_SESSION["DomainData"]["domain_name"]);
				$mailsend_chk=1;
		}
		
		if($_REQUEST["pcdmail"][$i]==1&&$memberdata["mailaddress"]!="") {
				$mess="下記URLからグループウェアに直接ログインすることが出来ます。\nhttp://".$_SESSION["DomainData"]["domain_name"]."/GW/logon.php?admin_id=".$memberdata["login_id"]."&admin_pass=".$memberdata["login_pw"]."&btm_login=%A5%ED%A5%B0%A5%A4%A5%F3\n\n".
				"パスワード入力不要ショートカットの作り方を添付いたしましたのでお試しください。";				
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
require_once('Mail.php');
require_once('Mail/mime.php');

$subject = "グループウェアのURL";  // 題名
$text    = $mess;  // テキスト本文
$html = '
<html>
<HEAD>
<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=EUC-JP">
</HEAD>
<body>'.
$mess.'
<br />
<img src="http://'.$_SESSION['DomainData']['domain_name'].'/SM/img/help.jpg" />
</body>
</html>';

// EUC-JP => JIS
$original = mb_internal_encoding();
$subject = mb_convert_encoding( $subject, "ISO-2022-JP", "EUC-JP" );
mb_internal_encoding( "ISO-2022-JP" );
$subject = mb_encode_mimeheader( $subject, "ISO-2022-JP" );
mb_internal_encoding( $original );

$text = mb_convert_encoding( $text, "ISO-2022-JP", "EUC-JP" );

$file = './fudousan.css'; // application/octet-stream
$img  = './img/help.jpg'; // image/gif
$crlf = "\n"; // 現在の改行コード

// ヘッダー情報
$hdrs = array(
	'From'    => 'info@'.$_SESSION["DomainData"]["domain_name"],
	'Sender'    => 'info@'.$_SESSION["DomainData"]["domain_name"],
	'Subject' => $subject,
	);
// インスタンス生成
//$mime = & new Mail_mime($crlf);

//$mime->setTXTBody($text); // 
//$mime->setHTMLBody($html);
//$mime->addAttachment($img, 'image/gif');
//$mime->addHTMLImage($img, 'image/gif');

// 出力用パラメータ
$build_param = array(
"html_charset" => "EUC-JP",
"text_charset" => "ISO-2022-JP",
"head_charset" => "ISO-2022-JP",
);

$body = $mime->get( $build_param );
$hdrs = $mime->headers($hdrs);

$mail =& Mail::factory('mail');
$mail->send($memberdata["mailaddress"], $hdrs, $body);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
/*

				$mess='<a href="#" onclick="javascript:window.external.AddFavorite(\''.$_SESSION["DomainData"]["domain_name"].'/GW/logon.php?admin_id='.$memberdata["login_id"].'&admin_pass='.$memberdata["login_pw"].'&btm_login=%A5%ED%A5%B0%A5%A4%A5%F3\',\'グループウェア\')">グループウェアのURLをブックマークする</a>';
*/
		}
		
		if($_REQUEST["kmail"][$i]==1&&$memberdata["kmail"]!="") {
				$mess="下記URLからグループウェアにアクセスしてください。\nhttp://siteadmin.itcube.ne.jp/keitai/?kpass=".$memberdata["kpass"];
				mb_send_mail($memberdata["kmail"],"グループウェアのURL",$mess,"From:info@".$_SESSION["DomainData"]["domain_name"]);
				$mailsend_chk=1;
		}
		
	}
}

$sql="select * from member order by turn ";
$result=$dbobj->Query($sql);
$resultnumrows=$dbobj->NumRows($result);

if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data[$rows]=$dbobj->FetchArray($result,$rows);
		$rows++;
	}
}

?>
<table width="100%" border="0" align="left" cellpadding="3" cellspacing="0">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<form name="form1" method="post" action="">
					<table width="100%" border="0" align="left" cellpadding="3" cellspacing="1">
	<?php
if($mailsend_chk==1) {
	
	?>						<tr>
							    <td align="left" valign="top"><div class="helper">URLを通知しました。</div> </td>
							    </tr>
<?php
}
?>							<tr>
									<td align="left" valign="top">
											  <strong>
											  <input type="button" name="Submit" value="新規追加" onClick="location.href='?PID=members_add'">
											  </strong>
											  <table border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
													<tr>
															<td width="4%" rowspan="2" nowrap bgcolor="#ECECEC"><strong>順序</strong></td>
															<td width="7%" rowspan="2" nowrap bgcolor="#ECECEC">
																	<div align="center"><strong>氏　　名</strong></div>
															</td>
															<td width="24%" rowspan="2" bgcolor="#ECECEC">
																	<div align="center"><strong>住　　　　所</strong></div>
															</td>
															<td width="12%" rowspan="2" bgcolor="#ECECEC">
																	<div align="center"><strong>電話番号<br>
																			FAX番号 </strong></div>
															</td>
															<td width="3%" rowspan="2" bgcolor="#ECECEC">
																	<div align="center"><strong>HP</strong></div>
															</td>
															<td width="4%" rowspan="2" bgcolor="#ECECEC">
																	<div align="center"><strong>Mail</strong></div>
															</td>
															<td rowspan="2" bgcolor="#ECECEC">
															    <div align="center"><strong>修正</strong></div>
															</td>
													  <td rowspan="2" bgcolor="#ECECEC">
													      <div align="center"><strong>削除</strong></div>
													  </td>
													  <td colspan="4" bgcolor="#ECECEC">
													      <div align="center"><strong>URLを通知</strong></div>
													  </td>
													  </tr>
													<tr>
													    <td bgcolor="#ECECEC">
													        <div align="center"><strong>PC</strong></div>
													    </td>
													    <td bgcolor="#ECECEC">
													        <div align="center"><strong>PC</strong></div>
													            <div align="center"><strong>IDパス付</strong></div>
													    </td>
													    <td bgcolor="#ECECEC">
													        <div align="center"><strong>携帯</strong></div>
													    </td>
													    <td bgcolor="#ECECEC">
													        <div align="center"><strong>通知</strong></div>
													    </td>
													</tr>
													<?php
$rows=0;
while($data[$rows][member_id]!=NULL) {
?>
													<tr>
															<td align="left" valign="top" bgcolor="#FFFFFF">
																	<div align="center">
																			<input name="turn[<?php echo $rows ?>]" type="text" id="turn[]" size="4" value="<?php echo $data[$rows]["turn"];?>">
																			<input name="mem_id[<?php echo $rows ?>]" type="hidden" id="mem_id[<?php echo $rows ?>]" value="<?php echo $data[$rows]["member_id"];?>">
																	</div>
															</td>
															<td align="left" valign="top" nowrap bgcolor="#FFFFFF"> <font size="2"><?php echo $data[$rows][member_name];?><br>
															</font></td>
															<td valign="top" bgcolor="#FFFFFF">
																	<div align="left"><font size="2"><?php echo $data[$rows]["zipcode"]."<br>
".$data[$rows]["address"];?></font></div>
															</td>
															<td valign="top" bgcolor="#FFFFFF">
																	<div align="center"><font size="2"><?php echo $data[$rows]["telnumber"];?><br>
																							<?php echo $data[$rows]["faxnumber"];?><br>
																	</font></div>
															</td>
															<td valign="top" bgcolor="#FFFFFF">
																	<div align="center"><font size="2">
																			<?php if($data[$rows][homepage]!=NULL) {echo "<a href=\"".$data[$rows][homepage]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
																	</font></div>
															</td>
															<td valign="top" bgcolor="#FFFFFF">
																	<div align="center"><font size="2">
																			<?php if($data[$rows][mailaddress]!=NULL) {echo "<a href=\"mailto:".$data[$rows][mailaddress]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
																	</font></div>
															</td>
															<td width="9%" bgcolor="#FFFFFF">
																	<div align="center">
																			<input type="button" name="Submit" value="修正する" onClick="location.href='?PID=members_correct&member_id=<?php echo $data[$rows][member_id];?>'">
																	</div>
															</td>
															<td width="11%" bgcolor="#FFFFFF">
																	<div align="center">
																			
																			<input type="button" name="Submit" value="削除する" onClick="location.href='?PID=members_del&member_id=<?php echo $data[$rows][member_id];?>'" <?php
										if($data[$rows][member_id]==0) {
										?>disabled="disabled"<?php
										}
										?>>
																	</div>
															</td>
													  <td width="3%" bgcolor="#FFFFFF">
												       <div align="center">
												           <input name="pcmail[<?php echo $rows ?>]" type="checkbox" id="pcmail[<?php echo $rows ?>]" value="1">
												       </div>
													  </td>
													  <td width="9%" bgcolor="#FFFFFF">
													      <div align="center">
													          <input name="pcdmail[<?php echo $rows ?>]" type="checkbox" id="pcdmail[<?php echo $rows ?>]" value="1">
													              </div>
													  </td>
													  <td width="5%" bgcolor="#FFFFFF">
													      <div align="center">
													          <input name="kmail[<?php echo $rows ?>]" type="checkbox" id="kmail[<?php echo $rows ?>]" value="1">
													      </div>
													  </td>
													  <td width="9%" bgcolor="#FFFFFF">
													      <input name="url_send[<?php echo $rows ?>]" type="submit" id="url_send[<?php echo $rows ?>]" value="通知する">
													  </td>
													</tr>
													<?php
$rows++;
}
?>
											</table>
									</td>
							</tr>
							
							<tr>
									<td align="left" valign="top">
											<input name="update_turn" type="submit" id="update_turn" value="更新する">
									</td>
							</tr>
					</table>
						</form>
			</td>
	</tr>
</table>
<br>
