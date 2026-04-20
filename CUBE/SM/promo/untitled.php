<?php
// ライブラリ読込み
include_once('../kemoji/lib/mobile_class_7.php');
// 文字列設定
$string = "hogehoge@docomo.co.jp";
// 入力表示
echo "入力：".$string;
// メールアドレス解析
$string = $emoji_obj -> get_mail_career($string);
// 結果表示
echo "結果：".$string;
?>