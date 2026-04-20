<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
function Normal($pdata,$tenpodata) {
	
	if($pdata["subject"]==NULL) {
		$msbj="ホームページからお問合せがありました。";
	}
	else {
		$msbj=$pdata["subject"];
	}
	
	$csbj=$tenpodata["name"]."に送信しました。";
	$mtxt="";
	$ctxt="";
	
	$text= 	"会社名・お名前　　　　　：".$_POST["corpname"]."\n".
				"ご担当者　　　　：".$_POST["tantouname"]."\n".
				"メールアドレス　：".$_POST["email"]."\n".
				"お電話番号　　　：".$_POST["telnumber"]."\n".
				"FAX番号　　　　 ：".$_POST["faxnumber"]."\n".
				"〒　 ：".$_POST["zipcode"]."\n".
				"所在地　 ：".$_POST["address"]."\n".
				"-------------------------------------------------------\n".
				"ご意見・お問い合わせ等\n".
				"-------------------------------------------------------\n".
				$_POST["comment"].$_POST["psbukken"]."\n";
				$mtxt= "お客様から以下の内容でお問い合わせが有りました。\n".
				"-------------------------------------------------------\n".
				$text;
				$ctxt= "以下の内容でお問い合わせを送信しました。\n".
				"-------------------------------------------------------\n".
				$text.
				"-------------------------------------------------------\n".
				$tenpodata["name"]." \n".
				$tenpodata["jyusyo"]."\n".
				" TEL ".$tenpodata["denwa"]."　FAX ".$tenpodata["fax"]."\n".
				" E-mail ".$tenpodata["email"]."\n".
				" H.P ".$tenpodata["url"]."\n".
				"-------------------------------------------------------";
				
	$csbj=mb_convert_kana($csbj,"KV");
	$ctxt=mb_convert_kana($ctxt,"KV");
	$msbj=mb_convert_kana($msbj,"KV");
	$mtxt=mb_convert_kana($mtxt,"KV");
	mb_send_mail($_POST["email"],$csbj,$ctxt,"From:".$tenpodata["email"]."\n");
	mb_send_mail($tenpodata["email"],$msbj,$mtxt,"From:".$_POST["email"]."\n");
	
}
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style><script type="text/JavaScript">
<!--
function zipsearch(frm) {
zip=frm.zipcode.value;
if(zip==null||zip=="") {
alert("〒が入力されていません。");
}
else {
window.open("./tool/zipsearch.php?zipcode="+zip,"zipsearch","width=400,height=200");
}
}
function datachk(frm) {
alertchk=0;
alerttxt="";
if(frm.corpname.value=="") {
alertchk=1;
alerttxt=alerttxt+"会社名・お名前が入力されていません。\n";
}
if(frm.email.value=="") {
alertchk=1;
alerttxt=alerttxt+"メールアドレスが入力されていません。\n";
}
else if(frm.email2.value=="") {
alertchk=1;
alerttxt=alerttxt+"メールアドレス確認が入力されていません。\n";

}
else if(frm.email.value!=frm.email2.value) {
alertchk=1;
alerttxt=alerttxt+"メールアドレスとメールアドレス確認が異なります。\n";
}
if(frm.comment.value=="") {
alertchk=1;
alerttxt=alerttxt+"お問い合わせ内容が入力されていません。\n";
}
if(alertchk==0) {
res=confirm("この内容でお問合せを送信してもよろしいですか？");
if(res) {
frm.mode.value="send";
frm.submit();
}
}
else {
alert(alerttxt);
}
}
//-->
</script>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
.style3 {line-height: 18px; font-size: 12px;}
.style4 {line-height: 18px; color:#333333; font-size: 14px;}
.style5 {color: #666666}
-->
</style></head>

<body>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include "tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include "tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_contact.jpg" alt="ニュース＆リリース" width="640" height="35" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top" class="text2">
                    <?php 
if($_POST["mode"]=="send"&&$_SESSION["toiawase"]!="on") {
@Normal($_POST,$tenpodata);
$_SESSION["toiawase"]="on";
?>
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                        <tr>
                            <td width="100%" align="left" class="text">
                                <p>以下の内容でお問合せメールを送信しました。<br />
                                        <?php
$_REQUEST["email"];
?>
                                    宛てに確認メールをお送りしましたのでご確認下さい。 <br />
                                    もしこのメールを送って2,3日以内に返信メールが届かない場合はお手数ですがメール又はお電話にてご連絡下さい。</p>
                                <p>お問合せ先：<span class="title"><?php echo $tenpodata["name"]; ?></span>　<br />
                                        <span class="fudousan">TEL : <?php echo $tenpodata["denwa"]; ?> FAX : <?php echo $tenpodata["fax"]; ?></span><br />
                                    E-mail：<a href="mailto:<?php echo $tenpodata["email"]; ?>"><?php echo $tenpodata["email"]; ?></a></p>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" class="text">
                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="150" height="20" align="left"><font size="2">会社名・お名前<font color="#FF0000">※</font></font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["corpname"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left"><font size="2">メールアドレス<font color="#FF0000">※</font></font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["email"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left"><font size="2">お電話番号</font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["telnumber"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left"><font size="2">FAX番号</font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["faxnumber"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left"><font size="2">〒</font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["zipcode"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left" valign="top"><font size="2">所在地
                                            <input name="mode" type="hidden" id="mode3" />
                                        </font></td>
                                        <td align="left"> <font size="2"><?php echo $_POST["address"];?> </font></td>
                                    </tr>
                                    <tr>
                                        <td height="20" align="left" valign="top">お問い合わせ件名</td>
                                        <td align="left"><font size="2"><?php echo $_POST["subject"];?></font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left" valign="top"><font size="2">お問い合わせ内容<font color="#FF0000">※</font></font></td>
                                        <td align="left"> <font size="2"><?php echo nl2br($_POST["comment"].$_POST["psbukken"]);?> </font></td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" align="left" valign="top"><font size="2">&nbsp;</font></td>
                                        <td align="left">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="150" height="20" valign="top"><font size="2">&nbsp;</font></td>
                                        <td>&nbsp; </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <?php
}
else if($_POST["mode"]=="send"&&$_SESSION["toiawase"]=="on") {
$_SESSION["toiawase"]="";
?>
                    <script language="JavaScript" type="text/javascript">
alert("このページはリロードできません。");
window.location.replace("/");
                        </script>
                    <?php
}
else {
?>
                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                        <tr>
                            <td width="100%" align="center">
                                <table width="100%" border="0" cellpadding="5" cellspacing="5">
                                    <tr>
                                        <td>
                                            <div align="left"><font size="2"><strong>お問い合わせについて</strong><br />
                                                        <br />
                                                </font><span class="noda2">お問い合わせには出来るだけ早い回答を心がけておりますが、内容によっては回答に時間がかかる場合もございます。<br />
                                                    また、お問い合わせ内容によっては、当社担当者から直接連絡させていただく場合がございます。</span><span class="text"><br />
                                                        </span><span class="noda2">予め了承下さい。</span><span class="text"><br />
                                                            <br />
                                                            </span><span class="noda2">お問合せ先<br />
                                                                <?php echo $tenpodata["name"]; ?><br />
                                                                </span>TEL :<span class="noda1"> <?php echo $tenpodata["denwa"]; ?> </span>FAX :<span class="noda1"> <?php echo $tenpodata["fax"]; ?></span><span class="noda2"><br />
                                                                </span>E-mail：<a href="mailto:<?php echo $tenpodata["email"]; ?>"></a><span class="noda1"><a href="mailto:<?php echo $tenpodata["email"]; ?>"><?php echo $tenpodata["email"]; ?></a></span></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                <form action="" method="post" name="contact_form" id="contact_form">
                                                    <tr>
                                                        <td height="20" colspan="2" align="left" nowrap="nowrap" class="noda1">●フォーム入力にてお問合せの方は下記を入力・送信下さい。</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20" colspan="2" align="left" nowrap="nowrap"><span class="noda3"><font color="#FF0000">※必須項目</font></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">会社名・お名前<font color="#FF0000">※</font></font></td>
                                                        <td align="left">
                                                            <input name="corpname" type="text" id="corpname" size="40" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">ご担当者</font></td>
                                                        <td align="left">
                                                            <input name="tantouname" type="text" id="tantouname" size="40" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">メールアドレス<font color="#FF0000">※</font></font></td>
                                                        <td align="left">
                                                            <input name="email" type="text" id="email" style="ime-mode:disabled;" size="40" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">メールアドレス確認<font color="#FF0000">※</font></font></td>
                                                        <td align="left">
                                                            <input name="email2" type="text" id="email2" style="ime-mode:disabled;" size="40" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">お電話番号</font></td>
                                                        <td align="left">
                                                            <input name="telnumber" type="text" id="telnumber" size="16" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">FAX番号</font></td>
                                                        <td align="left">
                                                            <input name="faxnumber" type="text" id="faxnumber" size="16" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">〒
                                                            <input name="mode" type="hidden" id="mode" />
                                                        </font></td>
                                                        <td align="left">
                                                            <input name="zipcode" type="text" id="zipcode" size="14" />
                                                            <input name="zsearch" type="button" id="zsearch" onclick="zipsearch(this.form)" value="郵便番号から住所を検索" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" valign="top" nowrap="nowrap"><font size="2">所在地 </font></td>
                                                        <td align="left">
                                                            <input name="address" type="text" id="address" size="60" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20" align="left" valign="top" nowrap="nowrap">お問い合わせ件名</td>
                                                        <td align="left">
                                                            <input name="subject" type="text" id="subject" value="<?php 
																		if($_GET["bid"]!=NULL) {
																			$sbj="";
																			if($re1data["bunrui"]==1) {
																				$sbj="賃貸物件";
																			}
																			else if($re1data["bunrui"]==2){ 
																				$sbj="売買物件";
																			}
																			if($re1data["bukken_mei"]!="") {
																				$sbj.="[".$re1data["bukken_mei"]."]";
																			}
																			echo $sbj.="についてのお問い合わせ[物件番号：".$re1data["bukkenn_id"]."]";
																		}
																		
																		?>" size="80" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" align="left" valign="top" nowrap="nowrap"><font size="2">お問い合わせ内容<font color="#FF0000">※</font></font></td>
                                                        <td align="left">
                                                            <textarea name="comment" cols="60" rows="10" id="comment"></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                        <td align="left">
                                                            <?php 
																		if($_GET["rurl"]!=NULL) {
																			echo 	"<br />".
																						"物件URL：http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
																		}
																		?>
                                                            <input name="psbukken" type="hidden" id="psbukken" value="<?php 
																		if($_GET["rurl"]!=NULL) {
																			echo 	"\n\n------------------------------------------------------------\n".
																									"物件URL：http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
																		}
																		?>" />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                        <td align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td width="150" height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                        <td align="left">
                                                            <input name="btm_send" type="button" id="btm_send" onclick="datachk(this.form)" value="お問合せ" />
                                                        </td>
                                                    </tr>
                                                </form>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <?php 
}
?>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>
</body>
</html>
