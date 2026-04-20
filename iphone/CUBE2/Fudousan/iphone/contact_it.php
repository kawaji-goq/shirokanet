<?php
session_start();
include "Cube/Fudousan/config.php";
include "ITC/modules.php";
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
			$dbobj->user="admin";
			$dbobj->pass="itc7310";
	}
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
	
	$csbj=$tenpodata["name"]."にお問い合わせを送信しました。";
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
	mb_send_mail($_POST["email"],$csbj,$ctxt,"From:".str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]));
	mb_send_mail(str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]),$msbj,$mtxt,"From:".$_POST["email"]."\n");
}
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
	<meta name="robots" content="noindex,nofollow">
	<meta name="robots" content="noarchive">
<?php
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<head> 
<meta http-equiv="Pragma" content="no-cache"> 
<meta http-equiv="Cache-Control" content="no-cache"> 
<meta http-equiv="Expires" content="0"> 
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" /> 
<title>物件検索</title> 
<meta name="keywords" content="不動産,スマートフォン,物件.検索" /> 
<meta name="description" content="スマホで不動産物件検索" /> 
<link href="fdssp.css" rel="stylesheet" type="text/css" media="screen,print"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="format-detection" content="telephone=no"/>
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
<body> 

  
<div id="header">
<?php include"header.html" ?>
</div> 

<div id="title">
<h1 style="font-size:15px;"><a href="index.php">TOP</a> > お問合わせ</h1>

</div> 

<div id="menu">
<?php include"menu.html" ?>
</div>

<div>
<img src="img/main/ttl_contact.jpg" width="100%" border="0"/></div>
<div id="button">
<?php
if($_POST["mode"]=="send" && $_SESSION["toiawase"]!="on")
{
	Normal($_POST,$tenpodata);
	$_SESSION["toiawase"]="on";
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr>
		<td style="font-size:12px; padding-top:10px; padding-left:10px;" align="left">
			以下の内容でお問合せメールを送信しました。<br>
			<?php echo $_POST["email"]; ?><br>
			宛てに確認メールをお送りしましたので<br>
			ご確認下さい。<br>
			<br>
			2,3日以内にご確認メールが届かない場合は、<br>
			お手数ですがメール又はお電話にてご連絡下さい。<br>
			<br>
			TEL :<a href="tel:<?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?></a><br>
			MAIL:<a href="mailto:<?php echo str_replace("  当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?></a><br><br>
		</td>
	</tr>
	<tr>
		<td>
			<form action="index.php" method="post" name="contact_back" id="contact_back">
			<table border="0" cellpadding="0" cellspacing="0" align="center" style="margin:0px;padding:0px;border:none;width:95%;">
				<tr>
					<td style="font-size:12px;" width="45%">
						<font color="#FF0000">※必須項目</font>
					</td>
					<td style="padding-top:0px; font-size:12px;" width="55%">
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						会社名・お名前<font color="#FF0000">※</font>
					</td>
					<td style="padding-top:5px; font-size:12px;">
						<?php echo $_POST["corpname"];?>
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						メールアドレス<font color="#FF0000">※</font>
					</td>
					<td style="padding-top:5px; font-size:12px;">
						<?php echo $_POST["email"];?>
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お電話番号
					</td>
					<td style="padding-top:5px; font-size:12px;">
						<?php echo $_POST["telnumber"];?>
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お問合せ件名
					</td>
					<td style="padding-top:5px; font-size:12px;">
						<?php echo $_POST["subject"];?>
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お問合わせ内容<font color="#FF0000">※</font>
					</td>
					<td style="padding-top:5px; font-size:12px;">
						<?php echo str_replace("\n","<br>",$_POST["comment"]);?>
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
window.location.replace("/iphone2/");
</script>
<?php
}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%" align="center">
	<tr>
		<td style="font-size:12px; padding-top:10px; padding-left:10px;" align="left">
			●以下のフォームからメールを送信して下さい。<br>
			　また、以下のアドレス・電話番号から<br>　直接問合せ頂く事も可能です。<br>
			<br>
			<font color=#0099FF>当サイトに掲載されている物件はサンプルです。<br>物件に対するお問い合わせにはお答えできませんのでご了承ください。</font><br>
			<br>
			TEL :<a href="tel:<?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["denwa"]); ?></a><br>
			MAIL:<a href="mailto:<?php echo str_replace("  当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?>"><?php echo str_replace(" 当サイトに掲載されている物件はサンプルです。　物件に対するお問い合わせにはお答えできませんのでご了承ください。","",$tenpodata["email"]); ?></a><br><br>
		</td>
	</tr>
	<tr>
		<td align="center">
			<form action="" method="post" name="contact_form" id="contact_form">
			<table border="0" cellpadding="0" cellspacing="0" align="center" style="margin:0px;padding:0px;border:none;width:95%;">
				<tr>
					<td style="font-size:12px;" width="45%" nowrap="nowrap">
						<font color="#FF0000">※必須項目</font>
					</td>
					<td width="55%">
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						会社名・お名前<font color="#FF0000">※</font>
					</td>
					<td style="padding-top:5px;">
						<input name="corpname" type="text" id="corpname" style="height:25px;font-size:12px;" width="90%" />
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						メールアドレス<font color="#FF0000">※</font>					</td>
					<td style="padding-top:5px;">
						<input name="email" type="email" id="email" style="height:25px;font-size:12px;ime-mode:disabled;" width="90%" />
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お電話番号
					</td>
					<td style="padding-top:5px;">
						<input name="telnumber" type="number" id="telnumber" style="height:25px;font-size:12px;ime-mode:disabled;" width="90%" />
					</td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お問合せ件名
					</td>
					<td style="padding-top:5px;"><input name="subject" type="text" id="subject" value="<?php
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
						?>" style="height:25px;font-size:12px;" width="90%" /></td>
				</tr>
				<tr>
					<td style="padding-top:0px; font-size:12px;" nowrap="nowrap">
						お問合わせ内容<font color="#FF0000">※</font>
					</td>
					<td style="padding-top:5px;">
						<textarea name="comment" cols="25" rows="10" id="comment"></textarea>
					</td>
				</tr>
				<tr>
					<td>
					</td>
					<td>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center" style="padding-top:20px;">	
						<a href="#" onClick="datachk(contact_form); return false;"><img src="img/main/go_contact.jpg" width="40%" border="0" /></a>
					</td>
				</tr>
			</table>
			<input name="mode" type="hidden" id="mode" />
  			</form>
		</td>
	</tr>
</table>
<?php
}
?>
</div>
<div id="footer">
<?php include"footer.html" ?>

</div>













</body> 
</html> 