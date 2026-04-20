<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>無題ドキュメント</title>
</head>

<body>
<?php
// ライブラリ読込み
include_once('./lib/mobile_class_7.php');
// 送信内容設定
//1-o-1y-o00@ezweb.ne.jp
$MAIL_DATA = array();
$MAIL_DATA['TODATA'] = array();
$MAIL_DATA['CCDATA'] = array();
$MAIL_DATA['BCCDATA'] = array();
$MAIL_DATA['TODATA']['1-o-1y-o00@ezweb.ne.jp'] = '河地　佑策';
$MAIL_DATA['from_name'] = '有限会社　アイティーキューブ';
$MAIL_DATA['from_add'] = 'info@itcube.jp';
$MAIL_DATA['repry_name'] = '有限会社　アイティーキューブ';
$MAIL_DATA['repry_to'] = 'info@itcube.jp';
$MAIL_DATA['return_path'] = 'info@itcube.jp';
$MAIL_DATA['subject'] = 'テストメール';
$MAIL_DATA['body_plain'] = '絵文字テストメール';
$MAIL_DATA['body_html'] = '<html><head><meta http-equiv="Content-Type" content="text/html; charset=iso-2022-jp"></head><body>テスト(HTML本文)<br><img src="img_cid_000"><br></body></html>';

$SETTING_DATA['decome_mode'] = '1';
$SETTING_DATA['to_career'] = 'au';
$SETTING_DATA['content_transfer_encoding'] = '7bit';
$SETTING_DATA['mail_code'] = 'JIS';
$SETTING_DATA['encode_pass'] = '';
$SETTING_DATA['input_code'] = 'SJIS';

$UPFILE = array('./img/template/tabmenu/gw_1.jpg'=> 'img_cid_000'
);

// 絵文字デコメ送信
if ($emoji_obj->emoji_decome($MAIL_DATA,$SETTING_DATA,$UPFILE)) {
echo "結果：送信成功";
} else {
echo "結果：送信失敗";
}
?>

</body>
</html>
