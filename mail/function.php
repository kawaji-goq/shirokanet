<?php
////////////////////////////////////////////////////////////////////
//      関数追加
////////////////////////////////////////////////////////////////////
$path = '/usr/share/pear';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once("Mail.php");
require_once("Mail/mime.php");
function sendMail2 ($subject, $to, $body, $encode, $host, $username, $password, $fromname, $frommail)
{
	$params = array(
		"host" => $host,
		"port" => 587,
		"auth" => true,
		"username" => $username,
		"password" => $password,
		"timeout" => "30"
	);

	$headers = array(
		"To" => $to,
		"From" => mb_encode_mimeheader(mb_convert_kana($fromname))." <".$frommail.">",
		"Subject" => mb_encode_mimeheader(mb_convert_kana($subject)),
		"Content-Type" => "text/plain;charset=\"{$encode}\""
	);
	if ($cc)
	{
		if ($cc_name)
		{
			$headers["Cc"] = mb_encode_mimeheader($cc_name);
		}
		else
		{
			$headers["Cc"] = $cc;
		}
	}
	if ($replyto)
	{
		if ($replyto_name)
		{
			$headers["Reply-To"] = mb_encode_mimeheader($replyto_name);
		}
		else
		{
			$headers["Reply-To"] = $replyto;
		}
	}

	$mailObject = Mail::factory("smtp", $params);
//	$mailObject -> send($to, $headers, mb_convert_encoding(mb_convert_kana($body,"KV"), "utf-8", mb_detect_encoding($body)));
	$mailObject -> send($to, $headers, mb_convert_kana($body,"KV"));
}
?>