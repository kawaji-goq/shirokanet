<?php

  # ´×°•\¦İ’è
  ini_set('display_errors', 1);
#  ini_set('error_reporting', 2039); // E_ALL & ~E_NOTICE
  ini_set('error_reporting', 2047); // E_ALL
  ini_set('log_errors', 1);

  # ½À°Ä
  $start_time = microtime();

  # Œ¾Œê,“à•”´İº°ÃŞ¨İ¸Ş
  mb_language('ja');
  mb_internal_encoding('SJIS');

  # ×²ÌŞ×Ø“Ç‚İ(µÌŞ¼Şª¸Ä¶¬,±¸¾½·¬Ø±æ“¾,’[––î•ñæ“¾,×²ÌŞ×Ø‰Šú‰»)
  include_once('./lib/mobile_class_7.php');
  $init_time = microtime();

  # “ü—ÍÃŞ°À‘Oˆ—($_REQUEST‘ÎÛ,´½¹°Ìßˆ—,ŠG•¶š´İº°ÄŞ,Shift-JISº°ÄŞ•ÏŠ·w’è)
  $emoji_obj->reqest_data_conv('r','','SJIS');

  $text = '{emj_d_0001}{emj_a_0001}{emj_v_0001}ƒeƒXƒg‚Å‚·B';

  # ŠG•¶š´İº°ÄŞ
  $text_enc = $emoji_obj->emj_encode($text);

  # ŠG•¶š”¶³İÄ
  $EMJ_COUNT = $emoji_obj->emj_check($text,'1');

  # ŠG•¶šíœ
  $del_text = $emoji_obj->delete_emoji_code($text,'0','0','0','','1');

  # ŠG•¶š‰º‘Ê•ÏŠ·
  $geta_text = $emoji_obj->emoji2geta($text,'0','0','0','','1');

  # •¶šØ‚è‹l‚ß
  $cut_text = $emoji_obj->emj_strimwidth($text,0,10,'c','','1');

  # ŠG•¶š•ÏŠ·
  $chg_text = $emoji_obj->emj_change($text,'{emj_d_0001}{emj_a_0001}{emj_v_0001}','{emj_v_0002}{emj_v_0003}{emj_v_0004}','','1');

  # ŠG•¶šÃŞº°ÄŞ
  $DECODEDATA     = $emoji_obj->emj_decode($text);
  $DECODEDATA_CUT = $emoji_obj->emj_decode($cut_text);
  $DECODEDATA_CHG = $emoji_obj->emj_decode($chg_text);

print "<font color=\"#808080\"><b>Œ³ÃŞ°À =&gt;</b></font> ".$text."<br>\n";
print "<hr>\n";
print "<font color=\"#808080\"><b>Enc =&gt;</b></font> ".$text_enc."<br>\n";
print "<font color=\"#808080\"><b>Dec(Web) =&gt;</b></font> ".$DECODEDATA['web']."<br>\n";
print "<form name=\"form\" action=\"\" method=\"POST\">\n";
print "<font color=\"#808080\"><b>Dec(FORM-TEXT) =&gt;</b></font> <br>\n";
print "<input type=\"text\" size=\"50\" name=\"text\" value=\"".$DECODEDATA['form']."\"><br>\n";
print "<font color=\"#808080\"><b>Dec(FORM-TEXTAREA) =&gt;</b></font> <br>\n";
print "<textarea rows=\"3\" cols=\"50\" name=\"area\">".$DECODEDATA['form']."</textarea></form>\n";
print "<font color=\"#808080\"><b>Dec(Mail) =&gt;</b></font> ".$DECODEDATA['mail']."<br>\n";
print "<font color=\"#808080\"><b>Dec(Text) =&gt;</b></font> ".$DECODEDATA['text']."<br>\n";
print "<font color=\"#808080\"><b>Dec(Bin) =&gt;</b></font> ".$DECODEDATA['bin']."<br>\n";
print "<br>\n";
print "<font color=\"#808080\"><b>ŠG•¶šíœ =&gt;</b></font> ".$del_text."<br>\n";
print "<font color=\"#808080\"><b>‰º‘Ê•ÏŠ· =&gt;</b></font> ".$geta_text."<br>\n";
print "<font color=\"#808080\"><b>•¶šØ‹l(æ“ª‚©‚ç5•¶š) =&gt;</b></font> ".$DECODEDATA_CUT['web']."<br>\n";
print "<font color=\"#808080\"><b>ŠG•¶š•ÏŠ· =&gt;</b></font> ".$DECODEDATA_CHG['web']."<br>\n";
print "<br>\n";
print "<font color=\"#808080\"><b>‘S•¶š” =&gt;</b></font> ".$EMJ_COUNT['mb_strlen']."<br>\n";
print "<font color=\"#808080\"><b>‘SÊŞ²Ä” =&gt;</b></font> ".$EMJ_COUNT['mb_strwidth']."<br>\n";
print "<font color=\"#808080\"><b>DoCoMoŠG•¶š” =&gt;</b></font> ".$EMJ_COUNT['DoCoMo']."<br>\n";
print "<font color=\"#808080\"><b>auŠG•¶š” =&gt;</b></font> ".$EMJ_COUNT['au']."<br>\n";
print "<font color=\"#808080\"><b>SoftBankŠG•¶š” =&gt;</b></font> ".$EMJ_COUNT['SoftBank']."<br>\n";
print "<hr>\n";
print "<font color=\"#808080\"><b>ŒÅ’èŠG•¶š =&gt;</b></font> ".$emoji_obj->FIX_EMJ['0001'].$emoji_obj->FIX_EMJ['0002'].$emoji_obj->FIX_EMJ['0003']."<br>\n";

  # I—¹
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
