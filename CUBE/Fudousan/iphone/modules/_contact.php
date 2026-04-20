<?php
mb_language("japanese");
mb_internal_encoding("EUC-JP");
session_start();
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "Cube/Fudousan/config.php";
include "ITC/modules.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
// クラスライブラリ読込
$path = '/usr/share/pear';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("Mail.php");
require_once("Mail/mime.php");
function sendMail ($subject, $to, $body, $encode, $replyto = null, $replyto_name = null, $cc = null, $cc_name = null)
{	
	$params = array(
		"host" => "mail.sougou-net.jp",
		"port" => 587,
		"auth" => true,
		"username" => "info@sougou-net.jp",
		"password" => "itc7310",
		"timeout" => "30"
	);
//	$params = array(
//		"host" => "mail4.itcube.jp",
//		"port" => 587,
//		"auth" => true,
//		"username" => "hiromoto@itcube.jp",
//		"password" => "ltq7Q46^",
//		"timeout" => "30"
//	);
	$headers = array(
		"To" => $to,
		"From" => mb_encode_mimeheader(mb_convert_encoding("総合不動産","iso-2022-jp","auto"))." <{$params["username"]}>",
		"Subject" => mb_encode_mimeheader(mb_convert_encoding($subject,"iso-2022-jp","auto"))
	);
	if ($cc)
	{
		if ($cc_name)
		{
			$headers["Cc"] = mb_encode_mimeheader($cc_name)." <{$cc}>";
		} else {
			$headers["Cc"] = $cc;
		}
	}
	if ($replyto)
	{
		if ($replyto_name)
		{
			$headers["Reply-To"] = mb_encode_mimeheader($replyto_name)." <{$replyto}>";
		} else {
			$headers["Reply-To"] = $replyto;
		}
	}
//	print_r($params);
//	print_r($headers);
//	echo $body;
//	echo  mb_convert_encoding(mb_convert_kana($body,"KV"), "utf-8", $encode);
	
	$mailObject = Mail::factory("smtp", $params);
	$mailObject -> send($to, $headers, mb_convert_encoding(mb_convert_kana($body,"KV"), "utf-8", mb_detect_encoding($body)));
//	print_r($mailObject);
	
	
}
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
	
//	if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
//	}
$dbobj->Connect();
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
	
	$text= 		"会社名・お名前　：".$_POST["corpname"]."\n".
				"ご担当者　　　　：".$_POST["tantouname"]."\n".
				"メールアドレス　：".$_POST["email"]."\n".
				"お電話番号　　　：".$_POST["telnumber"]."\n".
				"---------------------------------------\n".
				"ご意見・お問い合わせ等\n".
				"---------------------------------------\n".
				$_POST["comment"].$_POST["psbukken"]."\n";
				$mtxt= "お客様から以下の内容でお問い合わせが有りました。\n".
				"---------------------------------------\n".
				$text;
				$ctxt= "以下の内容でお問い合わせを送信しました。\n".
				"---------------------------------------\n".
				$text.
				"---------------------------------------\n".
				$tenpodata["name"]." \n".
				$tenpodata["jyusyo"]."\n".
				" TEL ".str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"])."　FAX ".$tenpodata["fax"]."\n".
				" E-mail ".str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"])."\n".
				" H.P ".$tenpodata["url"]."\n".
				"---------------------------------------\n".
				
	$csbj=mb_convert_kana($csbj,"KV");
	$ctxt=mb_convert_kana($ctxt,"KV");
	$msbj=mb_convert_kana($msbj,"KV");
	$mtxt=mb_convert_kana($mtxt,"KV");
	
//$tenpodata["email"]="yusaku.kawaji@gmail.com";
	mb_language("ja");
	mb_internal_encoding("EUC-JP");
	$csbj=mb_convert_encoding($csbj,"iso-2022-jp","auto");
	$msbj=mb_convert_encoding($msbj,"iso-2022-jp","auto");
	//$ctxt = mb_convert_encoding($ctxt,"iso-2022-jp","auto");
//	$mtxt = mb_convert_encoding($mtxt,"iso-2022-jp","auto");
//$tenpodata["email"] = "kawaji@itcube.jp";
	sendMail (
			$csbj,	// タイトル 
			$_POST["email"],		// 送信先s
			$ctxt,		// 本文
			$encode			// 文字コード
			);
//	mb_send_mail("info@ark-plan.com",$msbj,$mtxt,"From:".$_POST["email"]."\n");
	sendMail (
			$msbj,	// タイトル
			$tenpodata["email"],		// 送信先
			$mtxt,		// 本文
			$encode			// 文字コード
			);

//	mb_send_mail($_POST["email"],$csbj,$ctxt,"From:".str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]));
//	mb_send_mail(str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]),$msbj,$mtxt,"From:".$_POST["email"]."\n");
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
<?php
}
?>
<title><?php echo $tenpodata["pagetitle"];?>/お問合せ</title>
<?php include $_SERVER['DOCUMENT_ROOT']. '/CUBE/Fudousan/template/meta.php'; ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-capable" content="no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-icon" href="/iphone/icon/icon.PNG">
<link rel="stylesheet" type="text/css" href="css/fudousan.css" >
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">

<script type="text/JavaScript">
<!--
function datachk(frm)
{
	alertchk=0;
	alerttxt="";
	if(frm.corpname.value=="")
	{
		alertchk=1;
		alerttxt=alerttxt+"会社名・お名前が入力されていません。\n";
	}
	if(frm.email.value=="")
	{
		alertchk=1;
		alerttxt=alerttxt+"メールアドレスが入力されていません。\n";
	}
	if(frm.comment.value=="")
	{
		alertchk=1;
		alerttxt=alerttxt+"お問い合わせ内容が入力されていません。\n";
	}
	if(alertchk==0)
	{
		res=confirm("この内容でお問合せを送信してもよろしいですか？");
		if(res)
		{
			frm.mode.value="send";
			frm.submit();
		}
	}
	else
	{
		alert(alerttxt);
	}
}
//-->
</script>
</head>
<body bgcolor="#DDDDDD"><a href="/iphone/index.php"><?php if($tenpodata["headerimage"]) {?><img src="<?php echo $tenpodata["headerimage"] ?>" border="0" width="100%"><?php }?></a>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="物件検索" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="会社案内" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="トピックス" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="お問合せ" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<?php
if($_POST["mode"]=="send" && $_SESSION["toiawase"]!="on")
{
	Normal($_POST,$tenpodata);
	$_SESSION["toiawase"]="on";
?>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="contact">
	<tr>
		<td class="contact_top">
			<strong>お問合せ</strong>
		</td>
	</tr>
	<tr>
		<td class="contact_body">
			以下の内容でお問合せメールを送信しました。<br>
			<?php echo $_POST["email"]; ?><br>
			宛てに確認メールをお送りしましたので<br>
			ご確認下さい。<br>
			<br>
			2,3日以内にご確認メールが届かない場合は、<br>
			お手数ですがメール又はお電話にてご連絡下さい。<br>
			<br>
			TEL :<a href="tel:<?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?></a><br>
			<br>
			MAIL:<a href="mailto:<?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?></a><br>
		</td>
	</tr>
	<tr>
		<td>
			<form action="/iphone/index.php" method="post" name="contact_back" id="contact_back">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="contact_form">
				<tr>
					<td class="contact_form_left">
						<font color="#FF0000">※必須項目</font>
					</td>
					<td class="contact_form_right">
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						会社名・お名前<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right">
						<?php echo $_POST["corpname"];?>
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						メールアドレス<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right">
						<?php echo $_POST["email"];?>
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お電話番号
					</td>
					<td class="contact_form_right">
						<?php echo $_POST["telnumber"];?>
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お問合せ件名
					</td>
					<td class="contact_form_right">
						<?php echo $_POST["subject"];?>
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お問い合わせ内容<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right">
						<?php echo str_replace("\n","<br>",$_POST["comment"]);?>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding-top:20px;padding-bottom:20px;">
						<input name="btm_back" type="submit" id="btm_back" value="戻る" class="submit" />
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<?php
}
else if($_POST["mode"]=="send"&&$_SESSION["toiawase"]=="on")
{
$_SESSION["toiawase"]="";
?>
<script language="JavaScript" type="text/javascript">
alert("このページはリロードできません。");
window.location.replace("/iphone/");
</script>
<?php
}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0" align="center" class="contact">
	<tr>
		<td class="contact_top">
			<strong>お問合せ</strong>
		</td>
	</tr>
	<tr>
		<td class="contact_body">
			●以下のフォームに入力しメールを送信して下さい。<br>
			　また、以下のアドレス・電話番号から<br>　直接メール又はお電話で問合せ頂く事も可能です。<br>
			<br>
			<font color=#0099FF>当サイトに掲載されている物件はサンプルです。<br>物件に対するお問い合わせにはお答えできませんのでご了承ください。</font><br>
			<br>
			TEL :<a href="tel:<?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?></a><br>
			<br>
			MAIL:<a href="mailto:<?php echo str_replace("  当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?></a><br>
		</td>
	</tr>
	<tr>
		<td>
			<div id="ma_form"></div>
			<!--
			<form action="" method="post" name="contact_form" id="contact_form">
			<table border="0" cellpadding="0" cellspacing="0" align="center" class="contact_form">
				<tr>
					<td class="contact_form_left">
						<font color="#FF0000">※必須項目</font>
					</td>
					<td class="contact_form_right">
					</td>
				</tr>
				<tr>
					<td class="contact_form_left" style="padding-top:0px;">
						会社名・お名前<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right" style="padding-top:0px;">
						<input name="corpname" type="text" id="corpname" class="contact_form_text" />
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						メールアドレス<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right">
						<input name="email" type="email" id="email" class="contact_form_text" style="ime-mode:disabled;" />
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お電話番号
					</td>
					<td class="contact_form_right">
						<input name="telnumber" type="number" id="telnumber" class="contact_form_text" style="ime-mode:disabled;" />
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お問合せ件名
					</td>
					<td class="contact_form_right">
						<input name="subject" type="text" id="subject" value="<?php
							if($_GET["bid"]!=NULL)
							{
								$sbj="";
								if($re1data["bunrui"]==1)
								{
									$sbj="賃貸物件";
								}
								else if($re1data["bunrui"]==2)
								{
									$sbj="売買物件";
								}
								if($re1data["bukken_mei"]!="")
								{
									$sbj.="[".$re1data["bukken_mei"]."]";
								}
								echo $sbj.="についてのお問い合わせ[物件番号：".$re1data["bukkenn_id"]."]";
							}
						?>" class="contact_form_text" />
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
						お問い合わせ内容<font color="#FF0000">※</font>
					</td>
					<td class="contact_form_right">
						<textarea name="comment" cols="25" rows="10" id="comment"></textarea>
					</td>
				</tr>
				<tr>
					<td class="contact_form_left">
					</td>
					<td class="contact_form_right">
<?php
						if($_GET["rurl"]!=NULL)
						{
							echo 	"<br />"."物件URL：http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
						}
?>
						<input name="psbukken" type="hidden" id="psbukken" value="<?php 
							if($_GET["rurl"]!=NULL)
							{
								echo "\n\n------------------------------------------------------------\n".
								"物件URL：http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
							}
						?>" />
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding-bottom:20px;">
						<input name="btm_send" type="button" id="btm_send" onClick="datachk(this.form)" value="お問合せ" class="submit" />
					</td>
				</tr>
			</table>
			<input name="mode" type="hidden" id="mode" />
			</form>
			-->
		</td>
	</tr>
</table>
<?php
}
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:20px;">
	<tr align="center">
		<td width="20%">
			<input type="button" class="link" value="HOME" onClick="location.href='/iphone/index.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="物件検索" onClick="location.href='/iphone/chintai.php?cid=1'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="会社案内" onClick="location.href='/iphone/company.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="トピックス" onClick="location.href='/iphone/topics.php'">
		</td>
		<td width="20%">
			<input type="button" class="link" value="お問合せ" onClick="location.href='/iphone/contact.php'">
		</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-top:10px;">
	<tr>
		<td align="center" style="font-size:9px; color:#555555">copyright(c)2007 ITCUBE-FUDOUSAN all reserved.</td>
	</tr>
	<tr>
		<td align="center"><img src="/iphone/img/footerlogo.jpg" border="0" style="margin-top:1px;"></td>
	</tr>
</table>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-102425275-1', 'auto');
  ga('send', 'pageview');

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://secure.goq.jp/masystem/api.php/generate_form/script/?ms=MGl0Y3ViZV9jb250YWN0&form=17"></script>
<script>
	generate_form.export();
</script>

</body>
</html>