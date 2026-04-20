<?php
mb_language("japanese");
mb_internal_encoding("EUC-JP");
require_once("Mail.php");
require_once("Mail/mime.php");
$mailpara=array(
"host="=>"mail.itcube.jp",
"port"=>"587",
"auth"=>FALSE);

$headers=array(
	"From"=>mb_encode_mimeheader("有限会社アイティーキューブ","ISO-2022-JP")."<info@itcube.jp>",
	"To"=>mb_encode_mimeheader("河地 佑策","ISO-2022-JP")."<yusaku@itcube.jp>",
	"Subject"=>mb_encode_mimeheader("メール配信テスト","ISO-2022-JP"));

$htmlpara=array(
	"html_encoding"=>"base64",
	"html_charset"=>"Shift-JIS");

$o_mime=new Mail_mime();
$o_mime->setHTMLBODY(mb_convert_encoding("<html><head><title>メルマガ</title></head><body><img src=\"http://itcube.ne.jp/shiharai/img/logo.gif\"></body></html>","SJIS","auto"));
$body=$o_mime->get($htmlpara);
$headers=$o_mime->headers($headers);
$o_mail=Mail::factory("smtp",$mailpara);
$o_mail->send("yusaku@itcube.jp",$headers,$body);

?>
