<?php
include "CUBE/Fudousan/config.php";
include "CUBE/ITC/modules.php";
include $_SERVER['DOCUMENT_ROOT']."/mail/function.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	
	$dbobj=Cube_DB :: UseDB($usedb);	
	
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	
	if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
	}
$dbobj->Connect();
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$re1obj=new RealEstate($dbobj);
$re1obj->type=$_REQUEST["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);
$tenpodata=$dbobj->GetData("select * from tenpo_data");

switch($re1data["syumoku"]) {
	case "売地":
		$btype=3;
		break;
	case "借地権譲渡":
		$btype=3;
		break;
	case "新築一戸建住宅":
		$btype=2;
		break;
	case "中古一戸建住宅":
		$btype=2;
		break;
	case "新築テラスハウス":
		$btype=2;
		break;
	case "中古テラスハウス":
		$btype=2;
		break;
	case "新築マンション":
		$btype=1;
		break;
	case "中古マンション":
		$btype=1;
		break;
	case "新築一戸建て":
		$btype=1;
		break;
	case "新築公団住宅":
		$btype=1;
		break;
	case "中古公団住宅":
		$btype=1;
		break;
	case "新築公社住宅":
		$btype=1;
		break;
	case "中古公社住宅":
		$btype=1;
		break;
	case "新築タウンハウス":
		$btype=1;
		break;
	case "中古タウンハウス":
		$btype=1;
		break;
	case "リゾートマンション":
		$btype=1;
		break;
	case "店舗":
		$btype=4;
		break;
	case "店舗付住宅":
		$btype=4;
		break;
	case "住宅付店舗":
		$btype=4;
		break;
	case "事務所":
		$btype=4;
		break;
	case "店舗事務所":
		$btype=4;
		break;
	case "ビル":
		$btype=4;
		break;
	case "工場":
		$btype=4;
		break;
	case "マンション":
		$btype=4;
		break;
	case "倉庫":
		$btype=4;
		break;
	case "アパート":
		$btype=4;
		break;
	case "寮":
		$btype=4;
		break;
	case "旅館":
		$btype=4;
		break;
	case "ホテル":
		$btype=4;
		break;
	case "別荘":
		$btype=4;
		break;
	case "リゾートマンション":
		$btype=4;
		break;
	case "その他":
		$btype=4;
		break;
	case "店舗":
		$btype=4;
		break;
	case "事務所":
		$btype=4;
		break;
	case "店舗・事務所":
		$btype=4;
		break;
	case "その他":
		$btype=4;
		break;
}

function Normal($pdata,$tenpodata)
{
	//////////////////////////////////////////////////////////////////
	//                          メール送信                          //
	//////////////////////////////////////////////////////////////////
	
	$cmail=$tenpodata["email"];//会社宛メールアドレス
	//$cmail="info@itcube.jp";
	$csbj="";//会社宛タイトル
	if($pdata["subject"]==NULL)
	{
		$csbj="ホームページからお問合せがありました。";
	}
	else
	{
		$csbj=$pdata["subject"];
	}
	$ctxt="お客様から以下の内容でお問い合わせが有りました。\n".
	"-------------------------------------------------------\n".
	"会社名・お名前　　　　　：".$_POST["corpname"]."\n".
	"ご担当者　　　　：".$_POST["tantouname"]."\n".
	"メールアドレス　：".$_POST["email"]."\n".
	"お電話番号　　　：".$_POST["telnumber"]."\n".
	"FAX番号　　　　 ：".$_POST["faxnumber"]."\n".
	"〒　 ：".$_POST["zipcode"]."\n".
	"所在地　 ：".$_POST["address"]."\n".
	"-------------------------------------------------------\n".
	"ご意見・お問い合わせ等\n".
	"-------------------------------------------------------\n".
	$_POST["comment"].$_POST["psbukken"];//会社宛本文
	
	$mmail=$_POST["email"];//返信用メールアドレス
	$msbj=$tenpodata["name"]."にお問い合わせを送信しました。";//返信用タイトル
	$mtxt="以下の内容でお問い合わせを送信しました。\n".
	"-------------------------------------------------------\n".
	"会社名・お名前　　　　　：".$_POST["corpname"]."\n".
	"ご担当者　　　　：".$_POST["tantouname"]."\n".
	"メールアドレス　：".$_POST["email"]."\n".
	"お電話番号　　　：".$_POST["telnumber"]."\n".
	"FAX番号　　　　 ：".$_POST["faxnumber"]."\n".
	"〒　 ：".$_POST["zipcode"]."\n".
	"所在地　 ：".$_POST["address"]."\n".
	"-------------------------------------------------------\n".
	"ご意見・お問い合わせ等\n".
	"-------------------------------------------------------\n".
	$_POST["comment"].$_POST["psbukken"]."\n".
	"-------------------------------------------------------\n".
	$tenpodata["name"]." \n".
	$tenpodata["jyusyo"]."\n".
	" TEL ".$tenpodata["denwa"]."　FAX ".$tenpodata["fax"]."\n".
	" E-mail ".$tenpodata["email"]."\n".
	" H.P ".$tenpodata["url"]."\n".
	"-------------------------------------------------------";//返信用本文
	
	$encode = "EUC-JP";//文字コード
	$host = "mail.saito-s.jp";//ホスト
	$username = "info@saito-s.jp";//メールサーバ
	$password = "Wdg96k&3";//パスワード
	$fromname = "有限会社　斎藤商事";//送信者名

	mb_language("ja");
	mb_internal_encoding("EUC-JP");

	//会社へ送信
	sendMail2(
		$csbj,
		$cmail,
		$ctxt,
		$encode,
		$host,
		$username,
		$password,
		$_REQUEST["corpname"]
	);
	//送信者へ返信
	sendMail2 (
		$msbj,
		$mmail,
		$mtxt,
		$encode,
		$host,
		$username,
		$password,
		$fromname
	);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">。
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?> /  お問い合わせ</title>
<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 2px}

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
</script></head>
<body> 
<?php
include "CUBE/Fudousan/template/header.php";
?>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="678" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3"><img src="img/contact/ToiawaseHeader.jpg" width="770" height="61" /></td>
                </tr>
                <tr>
                    <td width="49" background="img/contact/ToiawaseLeft.jpg"><img src="img/contact/ToiawaseLeft.jpg" width="49" height="64" /></td>
                    <td width="675">
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
		<!--					<tr>
								<td>
<font color="#FF0000">当サイトに掲載されている物件はサンプルです。<br>物件に対するお問い合わせにはお答えできませんのでご了承ください。</font>
								</td>
							</tr>
                    -->        <tr>
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
																<script src="/js/ajaxzip3-source.js"></script>
																<input type="button" value="郵便番号から検索" onclick="AjaxZip3.zip2addr('zipcode',this,'address', 'address');" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" valign="top" nowrap="nowrap"><font size="2">所在地 </font></td>
                                                            <td align="left">
                                                                <input name="address" type="text" id="address" size="40" />
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
																		
																		?>" size="40" />
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
                                                            <td align="left"><?php 
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
                    <td width="46" background="img/contact/ToiawaseRight.jpg"> <img src="img/contact/ToiawaseRight.jpg" width="46" height="64" /></td>
                </tr>
                
                <tr>
                    <td colspan="3"><img src="img/contact/ToiawaseFooter.jpg" width="770" height="51" /></td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
<?php
include "CUBE/Fudousan/template/footer.php";
?>
</body>
</html>
