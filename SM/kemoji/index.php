<?php

  # 言語,内部ｴﾝｺｰﾃﾞｨﾝｸﾞ
  mb_language('ja');
  mb_internal_encoding('SJIS');

  # ｴﾗｰ表示設定
  ini_set('display_errors', 1);
#  ini_set('error_reporting', 2039); // E_ALL & ~E_NOTICE
  ini_set('error_reporting', 2047); // E_ALL
  ini_set('log_errors', 1);

  include('./lib/mobile_class_7.php');

  if ($GLOBALS['emoji_obj']->HARD_DATA['tg_flag'] == '3G') {
    $cs = 'UTF-8';
  } else {
    $cs = 'Shift_JIS';
  }

  $pdata = "<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html;charset=".$cs."\">
    <title>Potora - PHP版絵文字変換ﾗｲﾌﾞﾗﾘ2007(ver.7) ﾃｽﾄ</title>
";
  if ($GLOBALS['emoji_obj']->HARD_DATA['hard'] == 'PC') {
    $pdata .= "
<script language=\"JavaScript\" type=\"text/javascript\" src=\"/CrBrow/richtext.js\"></script>
<script language=\"JavaScript\" type=\"text/javascript\" src=\"/CrBrow/emojiin2.js\"></script>
<script language=\"JavaScript\" type=\"text/javascript\" src=\"/CrBrow/emojichg.js\"></script>
<script language=\"JavaScript\" type=\"text/javascript\">
<!--
// Cross-Browser Rich Text Editor初期化
initRTE(\"/CrBrow/images/\", \"\", \"\");
//-->
</script>
";
  }
  $pdata .= "  </head>
  <body>
    <center><b>PHP版 絵文字変換ﾗｲﾌﾞﾗﾘ2007(ver.7) ﾃｽﾄ</b></center>
    <hr>
    ここから絵文字変換機能(PHP版)を確認できます。<br>
    <input type=\"text\" size=\"40\" value=\"http://potora.dip.jp/php/emjtest7/\"><br>
    同URLを携帯からｱｸｾｽして絵文字を入力してみてください。<br>
    <br>
";

  if ($GLOBALS['emoji_obj']->HARD_DATA['hard'] == 'PC') {
    $pdata .= "    <form name=\"form00\" action=\"test.php\" method=\"post\" onsubmit=\"return updateRTEs();\">
    文字入力：
    <script language=\"JavaScript\" type=\"text/javascript\">
<!--
writeRichText('textfield', 'form00', 'textstr', '', 200, 200, false, false ,'side', 12);
//-->
</script><br>
※『Cross-Browser Rich Text Editor』絵文字対応改造版による表示<br>
　iframe、JavaScriptが有効であることが条件。また一部ブラウザで正常に処理できない可能性あり。<br>
";
  } else {
    $pdata .= "    <form name=\"form00\" action=\"test.php\" method=\"post\" utn>
    文字入力：
    <input type=\"text\" size=\"50\" name=\"textstr\" value=\"\">
";
  }
    $pdata .= "  </head>
    <input type=\"submit\" value=\"送　信\"> <input type=\"reset\" value=\"リセット\"><br>
    <br>
    *何も入力しないで\"送信\"をｸﾘｯｸした場合、これまでの来歴のみ表示されます。<br>
    *絵文字が入力されませんと来歴には追加されません。<br>
    </form>
    <hr>
    <center>[<a href=\"http://potora.dip.jp/\">TOPに戻る</a>]</center>
    <hr>
    <center>(C)2005-2007 <a href=\"http://potora.dip.jp/\">Potora</a>.</center>
  </body>
</html>
";

if ($GLOBALS['emoji_obj']->HARD_DATA['tg_flag'] == '3G') {
  $pdata = mb_convert_encoding($pdata,'UTF-8','SJIS-win');
}

print $pdata;
?>
