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
// 送信内容設定
$TOLIST = array(
'1-o-1y-o00@ezweb.ne.jp' => '河地　佑策',
);
$CCLIST = array();
$BCCLIST = array();
$form_name = '有限会社　アイティーキューブ';
$form_address = 'info@itcube.jp';
$subject = 'テストメール';
$body_plain = '絵文字テストメール';
$body_html = '<絵文字>{emj_d_0110}{emj_d_0028}{emj_d_0091}{emj_d_0089}{emj_d_0109}{emj_d_0130}{emj_d_0153}{emj_d_0149}{emj_d_0050}{emj_d_0195}{emj_d_1021}{emj_d_1046}{emj_d_1050}{emj_d_1046}{emj_d_0090}{emj_d_0128}{emj_d_0095}{emj_d_0050}{emj_d_0130}{emj_d_0129}{emj_d_0044}{emj_d_0089}{emj_d_0071}{emj_d_0066}{emj_d_0066}{emj_d_0068}{emj_d_0068}{emj_d_0108}{emj_d_0150}{emj_d_0148}<br>';
$UPFILE = array('./img/template/tabmenu/gw_1.jpg'=> 'img_cid_000');

// 絵文字メール送信
if ($emoji_obj -> emoji_send_mail3($TOLIST,$CCLIST,$BCCLIST,$form_name,$form_address,$subject,$body_plain,$body_html)) {
echo "結果：送信成功";
} else {
echo "結果：送信失敗";
}
?>

</body>
</html>
