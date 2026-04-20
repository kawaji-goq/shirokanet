<?php

  # ｴﾗｰ表示設定
  ini_set('display_errors', 1);
#  ini_set('error_reporting', 2039); // E_ALL & ~E_NOTICE
  ini_set('error_reporting', 2047); // E_ALL
  ini_set('log_errors', 1);

  # ｽﾀｰﾄ
  $start_time = microtime();

  # 言語,内部ｴﾝｺｰﾃﾞｨﾝｸﾞ
  mb_language('ja');
  mb_internal_encoding('SJIS');

  $check_flag = True;
  if (!isset($_REQUEST['to'])) {
    $check_flag = False;
  } else {
    if ($_REQUEST['to'] == '') { $check_flag = False; }
  }
  if ($check_flag == False) {
    print "送信先指定なしエラー<br>\n";
    exit();
  }

  # ﾗｲﾌﾞﾗﾘ読込み(ｵﾌﾞｼﾞｪｸﾄ生成,ｱｸｾｽｷｬﾘｱ取得,端末情報取得,ﾗｲﾌﾞﾗﾘ初期化)
  include_once('./lib/mobile_class_7.php');
  $init_time = microtime();

  # 入力ﾃﾞｰﾀ前処理($_REQUEST対象,ｴｽｹｰﾌﾟ処理,絵文字ｴﾝｺｰﾄﾞ,Shift-JISｺｰﾄﾞ変換指定)
  $emoji_obj->reqest_data_conv('r','','SJIS');

  # 送信内容指定
  $to_name     = 'テスト送信先';
  $to_add      = $_REQUEST['to'];
  $from_name   = 'テスト送信元';
  $from_add    = 'hogehoge@hogehoge.jp';
  $subject     = '絵文字メールTESTです';
  $body        = '{emj_d_0001}{emj_a_0001}{emj_v_0001}<font color="#0000ff">テスト</font>です。';
  $repry_name  = 'テスト返信先';
  $repry_to    = 'hogehoge@hogehoge.jp';
  $return_path = 'hogehoge@hogehoge.jp';
  $html_flag   = '1';
  $content_transfer_encoding = '';
  $mail_code   = 'JIS';
  $upfile      = '';
  $file_name   = '';
  $encode_pass = '';

  # ﾒｰﾙ送信
  if ($rtn = $emoji_obj->emoji_send_mail($to_name,$to_add,$from_name,$from_add,$subject,$body,$repry_name,$repry_to,$return_path,$html_flag,$content_transfer_encoding,$mail_code,$upfile,$file_name,$encode_pass)) {
    # 送信成功
    print "メール送信完了<br>\n";
  } else {
    # 送信失敗
    print "メール送信失敗<br>\n";
  }
  print "<hr>\n";

  # 終了
  $end_time = microtime();
  list($start_msec,$start_etime) = explode(' ',$start_time);
  list($init_msec,$init_etime)   = explode(' ',$init_time);
  list($end_msec,$end_etime)     = explode(' ',$end_time);
  $init_width = ($init_etime + $init_msec) - ($start_etime + $start_msec);
  $time_width = ($end_etime + $end_msec) - ($start_etime + $start_msec);

print "<br>\n";
print "INIT Time:".$init_width."<br>\n";
print "Time:".$time_width."<br>\n";

exit();

?>
