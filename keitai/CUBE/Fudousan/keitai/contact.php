<?php

//include "Cube/Fudousan/config.php";
ini_set("display_errors",1);
//include "Cube/Fudousan/config.php";
$path = '/tmp/CUBE/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);

include "/tmp/CUBE/ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);
mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	//echo $usedb;
	$dbobj=Cube_DB :: UseDB($usedb);	
	//echo $usedb;
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	//echo $dbobj->name;
	
	//if($usedb=="mysql") {
			$dbobj->user="goq";
			$dbobj->pass="itc2011";
	//}
$dbobj->Connect();

$re1obj=new Keitai_RealEstate($dbobj);
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
	$textobj=new Cube_KeitaiTextEdit("SJIS", "EUCJP");
//	$tenpodata["email"]="yusaku@itcube.jp";
	if($pdata["subject"]==NULL) {
		$msbj="ホームページからお問合せがありました。";
	}
	else {
		$msbj=$pdata["subject"];
	}
	
	$csbj=$textobj->setText($tenpodata["name"])."に送信しました。";
	$mtxt="";
	$ctxt="";
	
	$text= 	"会社名・お名前　：".$_POST["corpname"]."\n".
									"ご担当者　　　　：".$_POST["tantouname"]."\n".
									"メールアドレス　：".$_POST["email"]."\n".
									"お電話番号　　　：".$_POST["telnumber"]."\n".
									"FAX番号　　　　 ：".$_POST["faxnumber"]."\n".
									"〒　　　　　　　：".$_POST["zipcode"]."\n".
									"所在地　　　　　：".$_POST["address"]."\n".
									"-------------------------------------------------------\n".
									"ご意見・お問い合わせ等\n".
									"-------------------------------------------------------\n".
									$_REQUEST["comment"].$_POST["psbukken"]."\n";
									if($_POST["bid"]!=NULL) {
										$text.="物件URL:http://".$_SERVER['HTTP_HOST']."/".$_REQUEST["btype"].".php?bid=".$_REQUEST["bid"]."\n";
									}
									$mtxt= "お客様から以下の内容でお問い合わせが有りました。\n".
									"-------------------------------------------------------\n".
									$text;
									$ctxt= "以下の内容でお問い合わせを送信しました。\n".
									"-------------------------------------------------------\n".
									$text.
									"-------------------------------------------------------\n".
									$textobj->setText($tenpodata["name"])." \n".
									$textobj->setText($tenpodata["jyusyo"])."\n".
									" TEL ".$tenpodata["denwa"]."　FAX ".$tenpodata["fax"]."\n".
									" E-mail ".$tenpodata["email"]."\n".
									" HP ".$tenpodata["url"]."\n".
									"-------------------------------------------------------";
				
	$csbj=mb_convert_kana($csbj,"KV");
	$ctxt=mb_convert_kana($ctxt,"KV");
	$msbj=mb_convert_kana($msbj,"KV");
	$mtxt=mb_convert_kana($mtxt,"KV");
	mb_send_mail($_POST["email"],$csbj,$ctxt,"From:".$tenpodata["email"]."\n");
	mb_send_mail($tenpodata["email"],$msbj,$mtxt,"From:".$_POST["email"]."\n");
	
}
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$textobj=new Cube_KeitaiTextEdit("SJIS", "EUCJP");
if($_POST["btm_send"]=="お問合せ") {
	$errorchk=0;
	if($_POST["corpname"]==NULL){
		$errorary[]="会社名・お名前が入力されていません。";
		$errorchk=1;
	}
	if($_POST["email"]==NULL){
		$errorary[]="メールアドレスが入力されていません。";
		$errorchk=1;
	}
	else if($_POST["email2"]==NULL) {
		$errorary[]="メールアドレス確認が入力されていません。";
		$errorchk=1;
	}
	else if($_POST["email"]!=$_POST["email2"]) {
		$errorary[]="メールアドレスとメールアドレス確認が異なります。";
		$errorchk=1;
	}
	if($_POST["comment"]==NULL){
		$errorary[]="お問い合わせ内容が入力されていません。";
		$errorchk=1;
	}
	if($errorchk==1) {
		$_POST["btm_send"]="";
	}
}
$re1obj->type=$_REQUEST["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>お問合せ</title>
</head>

<body>
<?php
include "template/header.php";
?><div align="center"><font color="#FF0000">
    
お問い合わせ</font></div>
<hr>
<?php 
if($_POST["btm_send"]=="お問合せ") {
@Normal($_POST,$tenpodata);
$_SESSION["toiawase"]="on";
?>
            <br>
このメールを送って2,3日以内に返信メールが届かない場合はお手数ですがメール又はお電話にてご連絡下さい。
            <p>お問合せ先<br>
                <span class="title">
            <?php $textobj->printt($tenpodata["name"]); ?></span>　<br />
                    <span class="fudousan"><span class="noda1">
                    <?php $textobj->printc($tenpodata["denwa"]); ?>
                    </span>  <?php echo $tenpodata["fax"]; ?></span><br />
<a href="mailto:<?php echo $tenpodata["email"]; ?>"><?php echo $tenpodata["email"]; ?></a></p>
            <hr>
会社名・お名前<font color="#FF0000">※<br>
</font><?php echo $_POST["corpname"];?> 
<br>
ご担当者<br>
<?php echo $_POST["tantouname"];?> <br>
メールアドレス<font color="#FF0000">※<br>
</font>
<?php echo $_POST["email"];?> 
<br>
お電話番号<br>

<?php echo $_POST["telnumber"];?> 
<br>
FAX番号<br>
<?php echo $_POST["faxnumber"];?> 
<br>
〒<br>

<?php echo $_POST["zipcode"];?> 
<br>
所在地
                        <input name="mode" type="hidden" id="mode3" />
                        <br>
                    </font><?php echo $_POST["address"];?><br>

																					お問い合わせ件名<br>
<?php echo $_POST["subject"];?>
																					<br>
																					お問い合わせ内容<font color="#FF0000">※<br>
																					</font>
<?php echo nl2br($_POST["comment"].$_POST["psbukken"]);?> 
                     <br>
<?php
}
else {
?>
                        <div align="left"><span class="noda2">お問合せ先<br />
                                        <span class="title">
                                        <?php $textobj->printt($tenpodata["name"]); ?>
                                        </span><br />
                                            </span> <span class="noda1"> <?php $textobj->printc($tenpodata["denwa"]); ?> </span><span class="noda1"> <?php echo $tenpodata["fax"]; ?></span><span class="noda2"><br />
                                            </span><?php $textobj->printc($tenpodata["email"]); ?></span>
                                            <hr>
                        </div>
                            <form action="contact.php" method="post" name="contact_form" id="contact_form">
フォーム入力にてお問合せの方は下記を入力・送信下さい。</td>
<span class="noda3"><font color="#FF0000"><br>
※必須項目</font></span>
<hr>
<span class="noda3"><font color="#FF0000"><?php
for($i=0;$errorary[$i]!=NULL;$i++) {
	echo $errorary[$i]."<br>";
}
if($errorary[0]!=NULL) {
echo "<hr>";
}
?>
</font></span>

会社名・お名前<font color="#FF0000">※<br>
</font>
<input name="corpname" type="text" id="corpname" value="<?php echo $_POST[corpname]; ?>" />
<br>
ご担当者<br>

<input name="tantouname" type="text" id="tantouname" value="<?php echo $_POST["tantouname"]; ?>" />
<br>
メールアドレス<font color="#FF0000">※<br>
</font>
<input name="email" type="text" id="email" style="ime-mode:disabled;" value="<?php echo $_POST["email"]; ?>" />
<br>
メールアドレス確認<font color="#FF0000">※<br>
</font>
</td>
<input name="email2" type="text" id="email2" style="ime-mode:disabled;" value="<?php echo $_POST["email2"];?>" />
<br>
お電話番号<br>

<input name="telnumber" type="text" id="telnumber" value="<?php echo $_POST["telnumber"] ?>" />
<br>
FAX番号
                                        <br>
                                        <input name="faxnumber" type="text" id="faxnumber" value="<?php echo $_POST["faxnumber"]; ?>" />
                                        <br>
                                〒
                                        <input name="mode" type="hidden" id="mode" />
 <br>
<input name="zipcode" type="text" id="zipcode" value="<?php echo $_POST["zipcode"]; ?>" />
<br>
所在地 <br>
                                        <input name="address" type="text" id="address" value="<?php echo $_POST["address"]; ?>" />
                                  <br>
お問い合わせ件名<br>
                                        <input name="subject" type="text" id="subject" value="<?php 
																																								if($_REQUEST["subject"]!=NULL) {
																																									echo $_REQUEST[subject];
																																									}else if($_GET["bid"]!=NULL) {
																			$sbj="";
																			if($re1data["bunrui"]==1) {
																				$sbj="賃貸物件";
																			}
																			else if($re1data["bunrui"]==2){ 
																				$sbj="売買物件";
																			}
																			if($re1data["bukken_mei"]!="") {
																				$sbj.="[".$textobj->setText($re1data["bukken_mei"])."]";
																			}
																			echo $sbj.="についてのお問い合わせ[物件番号：".$re1data["bukkenn_id"]."]";
																		}
																		
																		?>" /><br>
お問い合わせ内容<font color="#FF0000">※</font><br>
                                        <textarea name="comment" rows="10" id="comment"><?php echo $_POST["comment"]; ?></textarea>
                                   <br>
                                        <br>
                                        <input name="btm_send" type="submit" id="btm_send" value="お問合せ" />
                                        <input name="bid" type="hidden" id="bid" value="<?php echo $_REQUEST["bid"];?>"> 
                                        <input name="btype" type="hidden" id="btype" value="<?php echo $_REQUEST["btype"];?>">
                            </form>
                    
<?php 
}
?>
<br>
<br> 

  <a href="index.php">TOPへ戻る</a><br>
  <?php
include "template/footer.php";
?>
  <br>
</body>
</html>
