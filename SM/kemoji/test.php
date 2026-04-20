<?php

  # 保存ﾛｸﾞ数設定
  $log_num = 3;

  # ｴﾗｰ表示設定
  ini_set('display_errors', 1);
#  ini_set('error_reporting', 2039); // E_ALL & ~E_NOTICE
  ini_set('error_reporting', 2047); // E_ALL
  ini_set('log_errors', 1);

  # 言語,内部ｴﾝｺｰﾃﾞｨﾝｸﾞ
  mb_language('ja');
  mb_internal_encoding('SJIS');

#$_SERVER['HTTP_USER_AGENT'] = 'DoCoMo/2.0 D904i(c100;TB;W24H12)';

  # ﾗｲﾌﾞﾗﾘ読込み(ｵﾌﾞｼﾞｪｸﾄ生成,ｱｸｾｽｷｬﾘｱ取得,端末情報取得,ﾗｲﾌﾞﾗﾘ初期化)
  include_once('./lib/mobile_class_7.php');

  # 入力ﾃﾞｰﾀ前処理($_REQUEST対象,ｴｽｹｰﾌﾟ処理,絵文字ｴﾝｺｰﾄﾞ,Shift-JISｺｰﾄﾞ変換指定)
  $emoji_obj->reqest_data_conv('r','','SJIS-win');

  # 入力絵文字ﾁｪｯｸ
  $textstr = '';
  if (isset($_REQUEST['textstr'])) {
    $textstr   = $_REQUEST['textstr'];
    $EMJ_CHECK = $emoji_obj->emj_check($_REQUEST['textstr'],'1');
  }

  # 来歴ﾌｧｲﾙ読込み
  $fn = './data/emj.cgi';
  $FILEDT = array();
  $FILEDT = @file($fn);
  if (isset($EMJ_CHECK['total'])) {
    if ($EMJ_CHECK['total'] > 0) {
      # 入力ﾃﾞｰﾀに絵文字が含まれている場合
      # 旧ﾛｸﾞ削除
      if (count($FILEDT) >= $log_num) { array_shift($FILEDT); }
      # 新ﾛｸﾞ追加
      $FILEDT[] = $_REQUEST['textstr']."\n";
      # 履歴保存
      data_save($fn, $FILEDT);
    }
  }
  $filedata = '';
  if (is_array($FILEDT) and (count($FILEDT) > 0)) {
    # 逆並び替え
    $FILEDT_REV = array_reverse($FILEDT);
    # 配列ﾃﾞｰﾀ連結
    $filedata = join("",$FILEDT_REV);
  }

  # 絵文字ｴﾝｺｰﾄﾞ
  $text_enc = $emoji_obj->emj_encode($filedata);

  # 絵文字数ｶｳﾝﾄ
  $EMJ_COUNT = $emoji_obj->emj_check($filedata,'1');

  # 絵文字削除
  $del_text = $emoji_obj->delete_emoji_code($filedata,'0','0','0','','1');

  # 絵文字下駄変換
  $geta_text = $emoji_obj->emoji2geta($filedata,'0','0','0','','1');

  # 絵文字ﾃﾞｺｰﾄﾞ
  $DECODEDATA = $emoji_obj->emj_decode($filedata);

  # ﾍｯﾀﾞｰ出力(ｷｬｯｼｭを完全に無効にする)
  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
  header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Cache-Control: post-check=0, pre-check=0",false);
  header("Pragma: no-cache");

  # 結果表示
  print "<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=Shift_JIS\">
<title>Potora - PHP版絵文字変換ﾗｲﾌﾞﾗﾘ2007(ver.7) ﾃｽﾄ</title>
</head>
<body>
<center><b>PHP版 絵文字変換ﾗｲﾌﾞﾗﾘ2007(ver.7) ﾃｽﾄ</b></center>
<hr>
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>元ﾃﾞｰﾀ:</b></font><br>
".$textstr."<br>
<hr>
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>ｴﾝｺｰﾄﾞﾃﾞｰﾀ:</b></font><br>
".nl2br($text_enc)."<br>
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>ﾃﾞｺｰﾄﾞﾃﾞｰﾀ:</b></font><br>
".nl2br($DECODEDATA['web'])."<br>
<form name=\"fm00\" action=\"\" method=\"POST\">
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>ﾌｫｰﾑ用ﾃﾞｺｰﾄﾞﾃﾞｰﾀ:</b></font><br>
<textarea rows=\"3\" cols=\"50\">".$DECODEDATA['form']."</textarea></form>
<br>
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>絵文字削除:</b></font><br>
".nl2br($del_text)."<br>
".$emoji_obj->FIX_EMJ['0001']."<font color=\"#808080\"><b>下駄変換:</b></font><br>
".nl2br($geta_text)."<br>
<br>
<font color=\"#808080\"><b>全文字数:</b></font> ".$EMJ_COUNT['mb_strlen']."<br>
<font color=\"#808080\"><b>全ﾊﾞｲﾄ数:</b></font> ".$EMJ_COUNT['mb_strwidth']."<br>
<font color=\"#808080\"><b>DoCoMo絵文字数:</b></font> ".$EMJ_COUNT['DoCoMo']."<br>
<font color=\"#808080\"><b>au絵文字数:</b></font> ".$EMJ_COUNT['au']."<br>
<font color=\"#808080\"><b>SoftBank絵文字数:</b></font> ".$EMJ_COUNT['SoftBank']."<br>
<hr>
<center>[<a href=\"http://potora.dip.jp/php/emjtest7/\">戻る</a>]</center>
<hr>
<center>(C)2005-2007 <a href=\"http://potora.dip.jp/\">Potora</a>.</center>
</body>
</html>
";

  exit();

  # ﾌｧｲﾙ保存 //////////////////////////////////////////////////////////////////
  function data_save($datafile, $DATA) {
    $flag = 0;
    # ﾌｧｲﾙﾛｯｸｱﾘ(Win,Unix共用)
    for ($no = 1; $no <= 10; $no++) {    # 10秒待っても書き込めない場合は諦める
      if ($fp = fopen($datafile, 'w')) {
        if (flock($fp, 2)) {
          if (is_array($DATA)) {
            # 値が配列の場合
            if (count($DATA) > 0) {
              foreach ($DATA as $dt) {
                $dt = preg_replace('/[\r\n]/', '', $dt);
                fwrite($fp, $dt."\n");
              }
            }
          } else {
            # 値が変数の場合
            fwrite($fp, $DATA);
          }
          flock($fp, 3);
          fclose($fp);
          $flag = 1;
          break;
        }
      }
      sleep(1);   # ﾛｯｸ中なら1秒待つ
    }
    if (file_exists($datafile)) { chmod($datafile, 0777); }
    return $flag;
  }

?>
