<?php

###############################################################################
# 管理ｽｸﾘﾌﾟﾄ
# 2005.04.01 山ノ内　謙吾
#            mail:inaken@jomon.ne.jp
#            url :http://www.jomon.ne.jp/~inaken/
###############################################################################
# 2005.04.01 v.1.00.00 新規
# 2005.04.22 v.1.00.01 DoCoMo絵文字ｶﾗｰ化対応、ﾃﾞｰﾀ更新ﾊﾞｸﾞ修正
# 2005.09.26 v.1.00.02 潰し文字画像化、画像変換ｽｸﾘﾌﾟﾄ対応化
# 2006.02.14 v.1.00.03 ｴﾝｺｰﾄﾞ関係ｵﾌﾟｼｮﾝ設定追加
# 2006.03.02 v.1.00.04 ﾀﾞｳﾝﾛｰﾄﾞﾌｧｲﾙ名設定不具合修正
# 2006.05.14 v.1.00.05 HTMLArea(絵文字対応改造版)対応化
# 2006.06.06 v.1.00.06 下駄設定項目修正
# 2006.06.12 v.1.00.06 PC宛絵文字ﾒｰﾙ設定追加
# 2006.07.26 v.1.00.07 対応絵文字無し処理ｺﾒﾝﾄ追加
# 2006.10.05 v.1.00.08 SoftBank対応による設定追加
# 2006.11.22 v.1.00.09 送信ﾒｰﾙｴﾝｺｰﾄﾞ設定追加
# 2007.08.01 v.2.00.00 Ver.7用改訂
# 2007.08.24 v.2.00.01 出力文字ｺｰﾄﾞ編集表示不具合修正
###############################################################################
$ver = 'v.2.00.00';
###############################################################################
# 絵文字変換ﾗｲﾌﾞﾗﾘﾌｧｲﾙ設置場所設定 ////////////////////////////////////////////
# 絵文字変換ﾗｲﾌﾞﾗﾘの設置場所を設定してください。
# (本管理ｽｸﾘﾌﾟﾄからの相対ﾊﾟｽ或いはｻｰﾊﾞｰ上の絶対ﾊﾟｽで指定)
$lib_file = './lib/mobile_class_7.php';
###############################################################################
# ※本管理ｽｸﾘﾌﾟﾄはJavaScriptをONにしｸｯｷｰを有効にしてください。
###############################################################################

# 言語,内部ｴﾝｺｰﾃﾞｨﾝｸﾞ /////////////////////////////////////////////////////////
mb_language('ja');
mb_internal_encoding('SJIS');

# ｴﾗｰ表示設定 /////////////////////////////////////////////////////////////////
ini_set('display_errors', 1);
#ini_set('error_reporting', 2039); // E_ALL & ~E_NOTICE
ini_set('error_reporting', 2047); // E_ALL
ini_set('log_errors', 1);

# 絵文字変換ﾗｲﾌﾞﾗﾘ読込み //////////////////////////////////////////////////////
$set_db_obj = '1';
include_once($lib_file);

# 定数 ////////////////////////////////////////////////////////////////////////
$cgi_name = "eadmin7.php";
$pro_name = "絵文字変換ライブラリ管理";

# ｾｯｼｮﾝ設定 ///////////////////////////////////////////////////////////////////
session_name('SID');   # ｾｯｼｮﾝID設定
session_cache_limiter('nocache');
session_cache_expire(10);
session_start();       # ｾｯｼｮﾝｽﾀｰﾄ

# ﾊﾟｽ設定 /////////////////////////////////////////////////////////////////////
$emj_path_b = $emoji_obj->emj_path.'/emoji.cgi';
$emj_path_d = $emoji_obj->emj_path.'/docomo.cgi';
$emj_path_v = $emoji_obj->emj_path.'/vodafone.cgi';
$emj_path_a = $emoji_obj->emj_path.'/au.cgi';
$mob_path   = $emoji_obj->emj_path.'/mobile.cgi';

# ﾃﾞｰﾀﾍﾞｰｽ操作 ////////////////////////////////////////////////////////////////
if ($GLOBALS['emoji_obj']->db_flag == '1') {
  # ﾃﾞｰﾀﾍﾞｰｽ値設定
  $db_obj->db_set_connection_data(array('dbd'            => $emoji_obj->dbd,
                                        'db_hostname'    => $emoji_obj->db_hostname,
                                        'db_hostport'    => $emoji_obj->db_hostport,
                                        'db_name'        => $emoji_obj->db_name,
                                        'db_username'    => $emoji_obj->db_username,
                                        'db_usrpassword' => $emoji_obj->db_usrpassword
                                        ));

  # ﾃﾞｰﾀﾍﾞｰｽ接続確認
  if ($db_obj->db_connect() == '1') {
    $sts = '接続成功';
  } elseif ($db_obj->db_connect() == '-1') {
    $sts = '接続失敗';
  }
  # 文字ｺｰﾄﾞ変換設定
  $save_ptn = '';
  $read_ptn = '';
  if ($GLOBALS['emoji_obj']->db_code == 'SJIS') {
  } elseif ($GLOBALS['emoji_obj']->db_code == 'EUC-JP') {
    $save_ptn = 'StoE';
    $read_ptn = 'EtoS';
  } elseif ($GLOBALS['emoji_obj']->db_code == 'UTF-8') {
    $save_ptn = 'StoU';
    $read_ptn = 'UtoS';
  }

  # 絵文字ﾗｲﾌﾞﾗﾘ初期化
  $emoji_obj->_auto_init();

}

# ﾘｸｴｽﾄﾃﾞｰﾀ前処理(ｴｽｹｰﾌﾟｺｰﾄﾞ削除) /////////////////////////////////////////////
$RQT = array();
$RQT = array_keys($_REQUEST);
foreach ($RQT as $rdt) {
  if (ini_get('magic_quotes_gpc') == '1') { $_REQUEST[$rdt] = stripslashes($_REQUEST[$rdt]); }
}

# ﾒｲﾝ処理 /////////////////////////////////////////////////////////////////////
if (isset($_REQUEST['m'])) {
  # ﾛｸﾞｲﾝﾁｪｯｸ
  if ($_REQUEST['m'] != '') { login_check(); }

  if ($_REQUEST['m'] == '') {
    # ﾛｸﾞｲﾝ表示
    login_vew();
  } elseif ($_REQUEST['m'] == 'menu') {
    # 処理ﾒﾆｭｰ表示
    menu_vew();

  } elseif ($_REQUEST['m'] == 'manual') {
    # ﾏﾆｭｱﾙ表示
    manual_vew();

  } elseif ($_REQUEST['m'] == 'set_chg') {
    # 設定更新表示
    set_vew();
  } elseif ($_REQUEST['m'] == 'set_chg_save') {
    # 設定更新
    set_save();

  } elseif ($_REQUEST['m'] == 'emj_vew') {
    # 一覧表示
    list_vew();

  } elseif ($_REQUEST['m'] == 'db_down') {
    # ﾀﾞｳﾝﾛｰﾄﾞﾒﾆｭｰ表示
    down_vew();
  } elseif ($_REQUEST['m'] == 'backup') {
    # ﾊﾞｯｸｱｯﾌﾟ実行
    backup();
  } elseif ($_REQUEST['m'] == 'restor') {
    # 復元実行
    restor();
  } elseif ($_REQUEST['m'] == 'down_chg') {
    # 変換対応DBﾀﾞｳﾝﾛｰﾄﾞ実行
    down_chg();
  } elseif ($_REQUEST['m'] == 'down_base') {
    # 基本DBﾀﾞｳﾝﾛｰﾄﾞ実行
    down_base();

  } elseif ($_REQUEST['m'] == 'pass_chg') {
    # ﾊﾟｽﾜｰﾄﾞ更新表示
    pass_vew();
  } elseif ($_REQUEST['m'] == 'pass_chg_save') {
    # ﾊﾟｽﾜｰﾄﾞ更新
    pass_save();

  } elseif ($_REQUEST['m'] == 'db_menu') {
    # ﾃﾞｰﾀﾍﾞｰｽ操作ﾒﾆｭｰ
    db_menu();
  } elseif ($_REQUEST['m'] == 'db_make') {
    # ﾃﾞｰﾀﾍﾞｰｽ新規生成
    db_make();
  } elseif ($_REQUEST['m'] == 'db_emjb_remake') {
    # 絵文字変換対応ﾃｰﾌﾞﾙ再生成
    db_emjb_remake();
  } elseif ($_REQUEST['m'] == 'db_emj_remake') {
    # 絵文字ﾃｰﾌﾞﾙ再生成
    db_emj_remake();
  } elseif ($_REQUEST['m'] == 'db_mob_remake') {
    # 携帯ﾃｰﾌﾞﾙ再生成
    db_mob_remake();
  } elseif ($_REQUEST['m'] == 'db_emjb_delete') {
    # 絵文字変換対応ﾃｰﾌﾞﾙ削除
    db_emjb_delete();
  } elseif ($_REQUEST['m'] == 'db_emj_delete') {
    # 絵文字ﾃｰﾌﾞﾙ削除
    db_emj_delete();
  } elseif ($_REQUEST['m'] == 'db_mob_delete') {
    # 携帯ﾃｰﾌﾞﾙ削除
    db_mob_delete();

  }

} else {
  # ﾛｸﾞｲﾝ表示
  login_vew();
}

exit();

###############################################################################
# ｻﾌﾞﾙｰﾁﾝ
###############################################################################

# ﾛｸﾞｲﾝ表示 ///////////////////////////////////////////////////////////////////
function login_vew() {
  tag_header("管理ログイン", "<b>管理ログイン</b>");
  $print_data = '';
  $print_data .= "<center>
<br>
<form action=\"".$GLOBALS['cgi_name']."\" method=\"POST\">
<input type=\"hidden\" name=\"m\" value=\"menu\">
<input type=\"hidden\" name=\"ms\" value=\"1\">
管理パスワード：
<input type=\"text\" size=\"16\" name=\"syspass\"> 
<input type=\"submit\" value=\"認 証\"><br>
</form>
</center>
";

  $print_data .= "<hr>\n";
  $print_data .= copyright_tag();
  $print_data .= '</body></html>';

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

#  tag_futter($GLOBALS['home_add'].'/');
}

# 管理ﾒﾆｭｰ表示 ////////////////////////////////////////////////////////////////
function menu_vew() {

  # ﾗｲﾌﾞﾗﾘﾊﾞｰｼﾞｮﾝ取得
  $ver = @$GLOBALS['emoji_obj']->Get_Emj_Version();
  if ($ver == '') { $ver = '-'; }

  # ﾒﾆｭｰ画面表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">絵文字変換ライブラリ管理メニュー</font>");
  $print_data = '';
  $print_data .= "<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"500pt\">
  <tr>
    <td colspan=\"2\" bgcolor=\"#000080\"><font style=\"font-weight:bold; color:#f0f0ff\">絵文字変換ライブラリバージョン ".$ver."</font><br></td>
  </tr>
  <tr><td colspan=\"2\"><font style=\"font-size:1pt\"><br></font></td></tr>

  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>オンラインマニュアル</font><br></td>
  </tr>
  <tr>
    <form name=\"form100\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      絵文字変換ライブラリのマニュアルを確認できます。<br>
      <center><input type=\"button\" value=\"オンラインマニュアル表示\" style=\"width: 200px;\" onClick=\"pgjp('http://potora.dip.jp/manual_7/manual.html',1)\"></center>
    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>設定値変更</font><br></td>
  </tr>
  <tr>
    <form name=\"form101\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      絵文字変換ライブラリの設定値を更新します。<br>
      <center><input type=\"button\" value=\"設定値変更\" style=\"width: 200px;\" onClick=\"pgjp('".$GLOBALS['cgi_name']."?m=set_chg',0)\"></center>
    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>固定絵文字用変換リスト表示</font><br></td>
  </tr>
  <tr>
    <form name=\"form102\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      固定絵文字用の一覧を確認できます。<br>
      固定絵文字を使用する場合の参考にしてください。<br>
      <center><input type=\"button\" value=\"固定絵文字リスト表示\" style=\"width: 200px;\" onClick=\"pgjp('".$GLOBALS['cgi_name']."?m=emj_vew',0)\"></center>
    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>絵文字変換データベースメンテナンス</font><br></td>
  </tr>
  <tr>
    <form name=\"form103\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      絵文字変換データベースをメンテナンスします。<br>
      Pororaサイトの絵文字データベースメンテナンスサービスにジャンプします。<br>
";
  if (($GLOBALS['emoji_obj']->usr_id != '') and ($GLOBALS['emoji_obj']->usr_pass != '')) {
    $print_data .= "      <center><input type=\"button\" value=\"絵文字変換DBメンテ\" style=\"width: 200px;\" onClick=\"pgjp('http://potora.dip.jp/emojimente/edit.php?mode=login&uid=".$GLOBALS['emoji_obj']->usr_id."&pass=".$GLOBALS['emoji_obj']->usr_pass."',1)\"></center>\n";
  } else {
    $print_data .= "      <center><input type=\"button\" value=\"絵文字変換DBメンテ\" style=\"width: 200px;\" onClick=\"pgjp('http://potora.dip.jp/emojimente/edit.php',1)\"></center>\n";
  }
  $print_data .= "    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>絵文字データベースダウンロード</font><br></td>
  </tr>
  <tr>
    <form name=\"form104\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      絵文字データベースをダウンロードし最新の状態にします。<br>
      Pororaサイトより直接ダウンロードし、データフォルダ内のデータベースを自動的に更新します。<br>
      <center><input type=\"button\" value=\"絵文字DBダウンロード更新\" style=\"width: 200px;\" onClick=\"pgjp('".$GLOBALS['cgi_name']."?m=db_down',0)\"></center>
    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>管理者パスワード変更</font><br></td>
  </tr>
  <tr>
    <form name=\"form105\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      管理者ログインのパスワードを更新します。<br>
      <center><input type=\"button\" value=\"管理者パスワード変更\" style=\"width: 200px;\" onClick=\"pgjp('".$GLOBALS['cgi_name']."?m=pass_chg',0)\"></center>
    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>データベース管理</font><br></td>
  </tr>
  <tr>
    <form name=\"form106\" action=\"\" method=\"POST\">
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      データベースを管理します。<br>
";
  if ($GLOBALS['emoji_obj']->db_flag == '1') {
    $print_data .= "      <center><input type=\"button\" value=\"データベース管理\" style=\"width: 200px;\" onClick=\"pgjp('".$GLOBALS['cgi_name']."?m=db_menu',0)\"></center>\n";
  } else {
    $print_data .= "      <center><input type=\"button\" value=\"データベース管理\" style=\"width: 200px;\" onClick=\"db_massage()\"></center>\n";
  }
  $print_data .= "    </td>
    </form>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
</table>
<script language=\"JavaScript\">
<!--
function pgjp(PGURL,MODE) {
  if (MODE == 0) {
    // 新たにｳｨﾝﾄﾞｳを開かない
    location.href = PGURL;
  } else {
    // 新たにｳｨﾝﾄﾞｳを開く
    w = window.open(PGURL,'newwindow');
  }
}
function db_massage() {
  alert('データベース使用について設定されていませんのでデータベースの操作はできません。');
}
//-->
</script>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾏﾆｭｱﾙ表示 ///////////////////////////////////////////////////////////////////
function manual_vew() {

  # ﾏﾆｭｱﾙﾌｧｲﾙ読込み
  $MDATA = array();
  if (!file_exists($GLOBALS['emoji_obj']->emj_path.'/manual.html')) { err('マニュアルデータが見つかりません。'); }
  $MDATA = file($GLOBALS['emoji_obj']->emj_path.'/manual.html');
  $print_data = join("\n",$MDATA);

  # 値ｾｯﾄ
  $GLOBALS['back_url'] = $GLOBALS['cgi_name'].'?m=menu';
  $GLOBALS['back_add'] = $GLOBALS['cgi_name'];

  # 値置換え
  $print_data = preg_replace_callback('/_%%(.+?)%%_/', 'callback_00', $print_data);

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

}

# 置換えｺｰﾙﾊﾞｯｸ ///////////////////////////////////////////////////////////////
function callback_00($matchs) {
  return $GLOBALS[$matchs[1]];
}

# 設定更新表示 ////////////////////////////////////////////////////////////////
function set_vew() {

  # 値準備
  $emoji_non_0 = '';
  $emoji_non_1 = '';
  $emoji_non_2 = '';
  ${'emoji_non_'.$GLOBALS['emoji_obj']->emoji_non} = 'selected';
  $emojiset_DoCoMo   = '';
  $emojiset_au       = '';
  $emojiset_SoftBank = '';
  $emojiset = preg_replace('/\-/','_',$GLOBALS['emoji_obj']->emojiset);
  ${'emojiset_'.$emojiset} = 'selected';
  $chr_code_Shift_JIS = '';
  $chr_code_EUC_JP    = '';
  $chr_code_UTF_8     = '';
  $chr_code = preg_replace('/\-/','_',$GLOBALS['emoji_obj']->chr_code);
  ${'chr_code_'.$chr_code} = 'selected';
  $color_flag_0 = '';
  $color_flag_1 = '';
  ${'color_flag_'.$GLOBALS['emoji_obj']->color_flag} = 'selected';
  if ($GLOBALS['emoji_obj']->fitimg_size == '') { $GLOBALS['emoji_obj']->fitimg_size = '10'; }
  $enc_type_1 = '';
  $enc_type_2 = '';
  ${'enc_type_'.$GLOBALS['emoji_obj']->enc_type} = 'selected';
  $html_mail_flag_0 = '';
  $html_mail_flag_1 = '';
  ${'html_mail_flag_'.$GLOBALS['emoji_obj']->html_mail_flag} = 'selected';
  $softbank_name_Vodafone = '';
  $softbank_name_SoftBank = '';
  ${'softbank_name_'.$GLOBALS['emoji_obj']->softbank_name} = 'selected';
  if ($GLOBALS['emoji_obj']->geta_str == '') { $GLOBALS['emoji_obj']->geta_str = '〓'; }
  $cont_trs_enc_7bit   = '';
  $cont_trs_enc_base64 = '';
  ${'cont_trs_enc_'.$GLOBALS['emoji_obj']->cont_trs_enc} = 'selected';
  $img_onry_flag_0 = '';
  $img_onry_flag_1 = '';
  ${'img_onry_flag_'.$GLOBALS['emoji_obj']->img_onry_flag} = 'selected';
  $img_title_flag_0 = '';
  $img_title_flag_1 = '';
  ${'img_title_flag_'.$GLOBALS['emoji_obj']->img_title_flag} = 'selected';
  $img_alt_flag_0 = '';
  $img_alt_flag_1 = '';
  ${'img_alt_flag_'.$GLOBALS['emoji_obj']->img_alt_flag} = 'selected';
  $db_flag_0 = '';
  $db_flag_1 = '';
  ${'db_flag_'.$GLOBALS['emoji_obj']->db_flag} = 'selected';
  $dbd_mysql = '';
  $dbd_Pg    = '';
  ${'dbd_'.$GLOBALS['emoji_obj']->dbd} = 'selected';
  $db_code_SJIS   = '';
  $db_code_EUC_JP = '';
  $db_code_UTF_8  = '';
  $db_code = preg_replace('/\-/','_',$GLOBALS['emoji_obj']->db_code);
  ${'db_code_'.$db_code} = 'selected';
  $chg_code_sjis_SJIS     = '';
  $chg_code_sjis_SJIS_win = '';
  $chg_code_sjis = preg_replace('/\-/','_',$GLOBALS['emoji_obj']->chg_code_sjis);
  ${'chg_code_sjis_'.$chg_code_sjis} = 'selected';
  $chg_code_euc_EUC        = '';
  $chg_code_euc_eucJP_win  = '';
  $chg_code_euc = preg_replace('/\-/','_',$GLOBALS['emoji_obj']->chg_code_euc);
  ${'chg_code_euc_'.$chg_code_euc} = 'selected';

  # 更新画面表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">絵文字変換ライブラリ設定更新</font>");
  $print_data = '';
  $print_data .= "<table bgcolor=\"#808080\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"800pt\">
  <form action=\"".$GLOBALS['cgi_name']."\" method=\"POST\">
  <input type=\"hidden\" name=\"m\" value=\"set_chg_save\">
  <tr bgcolor=\"#000080\">
    <th width=\"20pt\"><font color=\"#ffffff\">No<br></font></th>
    <th width=\"180pt\"><font color=\"#ffffff\">項目<br></font></th>
    <th width=\"320pt\"><font color=\"#ffffff\">値設定<br></font></th>
    <th width=\"280pt\"><font color=\"#ffffff\">説明<br></font></th>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">00<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">お客様情報設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      ◆お客様コード：<br>
      <input type=\"text\" size=\"20\" name=\"usr_id\" value=\"".$GLOBALS['emoji_obj']->usr_id."\"><br>
      ◆パスワード：<br>
      <input type=\"text\" size=\"20\" name=\"usr_pass\" value=\"".$GLOBALS['emoji_obj']->usr_pass."\"><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      ライブラリ購入時に頂いたお客様コードとパスワードを指定してください。<br>
      尚、本設定はPotoraサイトのサービスログインアカウントと連動していません。
      サイトサービス内でパスワードを変更した際には、本項目のパスワードも合わせて変更してください。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">01<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字データベース<br>パス設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <input type=\"text\" size=\"40\" name=\"emj_path\" value=\"".$GLOBALS['emoji_obj']->emj_path."\"><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      スクリプト本体(ライブラリを組込むスクリプト)からの絵文字データベースへのディレクトリパスを設定します。<br>
      <table bgcolor=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              相対URLで指定で指定してください。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              末尾に'/'(スラッシュ)は入れないでください。<br>
            </font>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">02<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字画像パス設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <input type=\"text\" size=\"40\" name=\"emjimg_path\" value=\"".$GLOBALS['emoji_obj']->emjimg_path."\"><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      スクリプト本体(ライブラリを組込むスクリプト)からの絵文字画像へのパスを設定します。<br>
      <table bgcolor=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              絶対URLでの指定も可能です。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              末尾に'/'(スラッシュ)は入れないでください。<br>
            </font>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">03<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">未対応絵文字対応<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"emoji_non\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$emoji_non_0.">No.04で指定した文字列で潰して表示</option>
        <option value=\"1\" ".$emoji_non_1.">絵文字名で表示する</option>
        <option value=\"2\" ".$emoji_non_2.">画像で表示する</option>
      </select><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      対応絵文字が存在しない場合に文字列で潰して表示するか、説明文で表示するか、あるいは絵文字画像で表示するか指定します。<br>
      <table bgcolor=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              '画像で表示する'を選択した場合、携帯の場合でも画像で表示します。
              第3世代携帯以外ではパケット数が多くなりアクセス速度が極端に落ちる可能性がありますので設定には十分注意してください。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              '画像で表示する'を選択した場合、No.05で画像変換スクリプトが指定されていない場合、そのままの絵文字画像(GIF,JPEG形式)が出力されます。<br>
              GIF,JPEG形式に対応していない携帯では画像が表示されない場合がありますので注意してください。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              固定絵文字の場合は常にNo.04で設定した文字列で潰されます。<br>
            </font>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">04<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">未対応絵文字潰し文字<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <input type=\"text\" size=\"5\" name=\"emoji_chr\" value=\"".$GLOBALS['emoji_obj']->emoji_chr."\"><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      対応絵文字が存在しない場合に表示する文字列を指定します。<br>
      No.03 の設定によります。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">05<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">携帯画像変換スクリプト<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      スクリプトパス：<br>
      <input type=\"text\" size=\"40\" name=\"fitimg_path\" value=\"".$GLOBALS['emoji_obj']->fitimg_path."\"><br>
      絵文字画像横幅制限：<br>
      <input type=\"text\" size=\"5\" name=\"fitimg_size\" value=\"".$GLOBALS['emoji_obj']->fitimg_size."\"> pt<br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      携帯画像変換スクリプトが使用できる場合指定すると最適なサイズで絵文字画像を表示できます。<br>
      使用する場合、携帯画像変換スクリプトを設置しているディレクトリを指定してください。<br>
      <table bgcolor=\"\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">
        <tr valign=\"top\">
          <td width=\"1pt\"><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              末尾に'/'(スラッシュ)は入れないでください。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              横幅制限を指定しない場合、携帯機種に対応した画像フォーマットのみ行われ画像が出力されます。<br>
            </font>
          </td>
        </tr>
        <tr valign=\"top\">
          <td><font style=\"font-size:10px; color:#ff0000\">※<br></font></td>
          <td>
            <font style=\"font-size:10px; color:#ff0000\">
              携帯画像変換スクリプトについては <a href=\"http://potora.dip.jp/hanbai.html#php_img\" target=\"_blank\">コチラ</a> を参照してください。<br>
            </font>
          </td>
        </tr>
      </table>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">06<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">文字コード扱い指定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      Shift-JIS：
      <select name=\"chg_code_sjis\">
        <option value=\"\">▼選択</option>
        <option value=\"SJIS\" ".$chg_code_sjis_SJIS.">SJIS</option>
        <option value=\"SJIS-win\" ".$chg_code_sjis_SJIS_win.">SJIS-win</option>
      </select><br>
      EUC-JP：
      <select name=\"chg_code_euc\">
        <option value=\"\">▼選択</option>
        <option value=\"EUC\" ".$chg_code_euc_EUC.">EUC</option>
        <option value=\"eucJP-win\" ".$chg_code_euc_eucJP_win.">eucJP-win</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      Shift-JIS,EUC-JP文字コードの扱いコードを指定します。<br>
      通常は\"SJIS-win\",\"eucJP-win\"を指定してください。
      不具合が発生する場合には\"SJIS\",\"EUC\"を選択してください。<br>
      ※EUC-JPの設定については現在使用しません。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">07<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">出力文字コード指定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"chr_code\">
        <option value=\"\">▼選択</option>
        <option value=\"Shift_JIS\" ".$chr_code_Shift_JIS.">Shift_JIS</option>
        <option value=\"EUC-JP\" ".$chr_code_EUC_JP.">EUC-JP</option>
        <option value=\"UTF-8\" ".$chr_code_UTF_8.">UTF-8</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      デフォルトの出力文字コードを指定します。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">08<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">固定絵文字パターン指定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"emojiset\">
        <option value=\"\">▼選択</option>
        <option value=\"DoCoMo\" ".$emojiset_DoCoMo.">DoCoMo</option>
        <option value=\"au\" ".$emojiset_au.">au</option>
        <option value=\"SoftBank\" ".$emojiset_SoftBank.">SoftBank(旧Vodafone)</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      固定絵文字表示パターンを指定します。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">09<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">DoCoMo絵文字カラー化<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"color_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$color_flag_0.">白黒で表示する</option>
        <option value=\"1\" ".$color_flag_1.">カラーで表示する</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      DoCoMo絵文字は携帯で表示した場合機種によっては白黒表示になります。<br>
      これをカラー化して表示したい場合にはフラグを設定してください。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">10<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字エンコードモード<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"enc_type\">
        <option value=\"\">▼選択</option>
        <option value=\"1\" ".$enc_type_1.">タイプ1（{emj_#_****}）</option>
        <option value=\"2\" ".$enc_type_2.">タイプ2（{#****}）</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      絵文字エンコードパターンを指定します。<br>
      \"#\"はDoCoMoの場合は\"d\"、Vodafoneの場合は\"v\"、auの場合は\"a\"、auのメール用コード場合は\"am\"になります。<br>
      \"****\"は4桁の絵文字管理Noになります。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">11<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">下駄変換文字列設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <input type=\"test\" name=\"geta_str\" value=\"".$GLOBALS['emoji_obj']->geta_str."\"><br>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      replace_emoji_form関数でPCフォームで表示する際、絵文字を下駄変換する場合の文字列を指定します。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">12<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字メール処理設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"html_mail_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$html_mail_flag_0.">テキストメールで送る</option>
        <option value=\"1\" ".$html_mail_flag_1.">HTMLメールで送る</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      絵文字メールを送信する際、テキストメールで送信するかHTMLメールで送信するかを指定します。<br>
      但し、PC,SoftBank宛てにメールを送信する際には強制的にHTMLメールで送信されます。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">13<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">メール送信エンコード設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"cont_trs_enc\">
        <option value=\"\">▼選択</option>
        <option value=\"7bit\" ".$cont_trs_enc_7bit.">7bit(エンコードなし)</option>
        <option value=\"base64\" ".$cont_trs_enc_base64.">BASE64</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      送信メールの本文をBASE64エンコードするかを指定します。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">14<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">SoftBankキャリア名設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"softbank_name\">
        <option value=\"\">▼選択</option>
        <option value=\"Vodafone\" ".$softbank_name_Vodafone.">Vodafone</option>
        <option value=\"SoftBank\" ".$softbank_name_SoftBank.">SoftBank</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      現SoftBank名を旧名のVodafoneで使用したい場合に指定します。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">15<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">携帯端末絵文字表示設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"img_onry_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$img_onry_flag_0.">No.03の設定に従う</option>
        <option value=\"1\" ".$img_onry_flag_1.">絵文字を全て画像で表示する</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      携帯での絵文字表示をNo.3の設定に従って表示するか、変換対応に依存しない全画像で表示するかを指定します。<br>
      全画像表示する場合、ページ内の絵文字数によってページ表示速度が低下する恐れがありますので、設定には注意してください。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">16<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字画像<br>タイトル属性付加設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"img_title_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$img_title_flag_0.">タイトル属性を付加しない</option>
        <option value=\"1\" ".$img_title_flag_1.">タイトル属性を付加する</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      携帯での絵文字表示をNo.3の設定に従って表示するか、変換対応に依存しない全画像で表示するかを指定します。<br>
      全画像表示する場合、ページ内の絵文字数によってページ表示速度が低下する恐れがありますので、設定には注意してください。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">17<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">絵文字画像<br>代替テキスト属性付加設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"img_alt_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$img_alt_flag_0.">代替テキスト属性を付加しない</option>
        <option value=\"1\" ".$img_alt_flag_1.">代替テキスト属性を付加する</option>
      </select>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      携帯での絵文字表示をNo.3の設定に従って表示するか、変換対応に依存しない全画像で表示するかを指定します。<br>
      全画像表示する場合、ページ内の絵文字数によってページ表示速度が低下する恐れがありますので、設定には注意してください。<br>
    </td>
  </tr>
  <tr style=\"font-size:12px\">
    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">18<br></td>
    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">データベース設定<br></font></td>
    <td bgcolor=\"#f0f0ff\">
      <select name=\"db_flag\">
        <option value=\"\">▼選択</option>
        <option value=\"0\" ".$db_flag_0.">データベースを使用しない</option>
        <option value=\"1\" ".$db_flag_1.">データベースを使用する</option>
      </select>
      <table bgcolor=\"#808080\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"98%\">
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">データベースタイプ</th>
          <td>
            <select name=\"dbd\">
              <option value=\"\">▼選択</option>
              <option value=\"mysql\" ".$dbd_mysql.">MySQL</option>
              <option value=\"Pg\" ".$dbd_Pg.">PostgreSQL</option>
            </select>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">ホスト名</th>
          <td>
            <input type=\"test\" name=\"db_hostname\" value=\"".$GLOBALS['emoji_obj']->db_hostname."\"><br>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">ポート</th>
          <td>
            <input type=\"test\" name=\"db_hostport\" value=\"".$GLOBALS['emoji_obj']->db_hostport."\"><br>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">データベース名</th>
          <td>
            <input type=\"test\" name=\"db_name\" value=\"".$GLOBALS['emoji_obj']->db_name."\"><br>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">ユーザID</th>
          <td>
            <input type=\"test\" name=\"db_username\" value=\"".$GLOBALS['emoji_obj']->db_username."\"><br>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">パスワード</th>
          <td>
            <input type=\"test\" name=\"db_usrpassword\" value=\"".$GLOBALS['emoji_obj']->db_usrpassword."\"><br>
          </td>
        </tr>
        <tr bgcolor=\"#ffffff\" style=\"font-size:12px\">
          <th bgcolor=\"#e0e0ff\">DB保存文字コード</th>
          <td>
            <select name=\"db_code\">
              <option value=\"\">▼選択</option>
              <option value=\"SJIS\" ".$db_code_SJIS.">Shift-JIS</option>
              <option value=\"EUC-JP\" ".$db_code_EUC_JP.">EUC-JP</option>
              <option value=\"UTF-8\" ".$db_code_UTF_8.">UTF-8</option>
            </select>
          </td>
        </tr>
      </table>
    </td>
    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
      データベースを使用する場合指定してください。<br>
      <br>
      ローカルホストの場合\"ホスト名\"の指定は必要ありません。<br>
      デフォルトのポートを使用している場合には\"ポート\"の指定は必要ありません。<br>
      <br>
      現状のライブラリではDBの能力を活用できておりませんのでDBの使用は推奨致しません。<br>
      DBの使用によりライブラリ初期化がファイルベースの初期化に比べ5倍程度の時間が掛かる様になりますので注意してください。<br>
    </td>
  </tr>
";
#  $print_data .= "  <tr style=\"font-size:12px\">
#    <td bgcolor=\"#0000ff\" align=\"right\"><font color=\"#ffffff\">19<br></td>
#    <td bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#ffffff\">ライブラリ自動アップデート<br></font></td>
#    <td bgcolor=\"#f0f0ff\">
#      <select name=\"auto_update\">
#        <option value=\"\">▼選択</option>
#        <option value=\"0\" ".$auto_update_0.">自動でアップデートしない</option>
#        <option value=\"1\" ".$auto_update_1.">自動でアップデートする</option>
#      </select><br>
#      <select name=\"update_width\">
#        <option value=\"\">▼選択</option>
#        <option value=\"week\" ".$update_width_week.">1週間毎にチェックする</option>
#        <option value=\"month\" ".$update_width_month.">1ヶ月毎にチェックする</option>
#      </select><br>
#    </td>
#    <td bgcolor=\"#f0f0ff\" style=\"font-size:10px\" valign=\"top\">
#      ライブラリを自動的にアップデートします。<br>
#      対象ファイルはライブラリ本体(mobile_class_7.php)と携帯データベース(mobile.cgi)、管理スクリプトのみ対象となります。<br>
#      その他のファイルは手動でアップデートを行ってください。<br>
#      <br>
#      尚、大きな更新が行われた場合には、以後自動的にアップデート出来なくなることがありますので、手作業でも定期的にライブラリの更新をご確認ください。<br>
#      <br>
#      <font style=\"font-size:12; font-weight:bold; color:#ff0000\">※現バージョンではこの機能は使用できません。</font><br>
#    </td>
#  </tr>
#";
  $print_data .= "</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"600pt\">
  <tr>
    <td align=\"center\">
      <input type=\"submit\" value=\"更新\" style=\"width: 200px;\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
  </form>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# 設定更新 ////////////////////////////////////////////////////////////////////
function set_save() {

  # お客様ｺｰﾄﾞﾁｪｯｸ
  if ($_REQUEST['usr_id'] == '') { err('お客様コードが入力されていません。'); }
  # ﾊﾟｽﾜｰﾄﾞﾁｪｯｸ
  if ($_REQUEST['usr_pass'] == '') { err('パスワードが入力されていません。'); }
  # 絵文字ﾃﾞｰﾀﾍﾞｰｽﾊﾟｽ設定ﾁｪｯｸ
  if ($_REQUEST['emj_path'] == '') { err('絵文字データベースパス設定が入力されていません。'); }
  if (!file_exists($_REQUEST['emj_path'].'/emoji.cgi'))    { err('絵文字変換対応データベースが見つかりません。'); }
  if (!file_exists($_REQUEST['emj_path'].'/docomo.cgi'))   { err('DoCoMo絵文字データベースが見つかりません。'); }
  if (!file_exists($_REQUEST['emj_path'].'/au.cgi'))       { err('au絵文字データベースが見つかりません。'); }
  if (!file_exists($_REQUEST['emj_path'].'/vodafone.cgi')) { err('SoftBank絵文字データベースが見つかりません。'); }
  if (!file_exists($_REQUEST['emj_path'].'/mobile.cgi'))   { err('携帯データベースが見つかりません。'); }
  # 絵文字画像ﾊﾟｽ設定ﾁｪｯｸ
  if ($_REQUEST['emjimg_path'] == '') { err('絵文字画像パス設定が入力されていません。'); }
  # 未対応絵文字対応ﾁｪｯｸ
  if ($_REQUEST['emoji_non'] == '') { err('未対応絵文字対応が指定されていません。'); }
  # 未対応絵文字潰し文字ﾁｪｯｸ
  if ($_REQUEST['emoji_non'] == '0') {
    if ($_REQUEST['emoji_non'] == '') { err('未対応絵文字潰し文字が入力されていません。'); }
  }
  # 文字ｺｰﾄﾞ扱い指定ﾁｪｯｸ
  if ($_REQUEST['chg_code_sjis'] == '') { err('Shift-JISの扱い文字コード指定が指定されていません。'); }
  if ($_REQUEST['chg_code_euc']  == '') { err('EUC-JPの扱い文字コード指定が指定されていません。'); }
  # ｽｸﾘﾌﾟﾄ扱い文字ｺｰﾄﾞ指定ﾁｪｯｸ
  if ($_REQUEST['chr_code'] == '') { err('スクリプト扱い文字コード指定が指定されていません。'); }
  # 固定絵文字ﾊﾟﾀｰﾝ指定ﾁｪｯｸ
  if ($_REQUEST['emojiset'] == '') { err('固定絵文字パターン指定が指定されていません。'); }
  # DoCoMo絵文字ｶﾗｰ化設定ﾁｪｯｸ
  if ($_REQUEST['color_flag'] == '') { err('DoCoMo絵文字カラー化設定が指定されていません。'); }
  # 携帯画像変換ｽｸﾘﾌﾟﾄ設置場所ﾁｪｯｸ
  if ($_REQUEST['fitimg_path'] == '') {
#    err('携帯画像変換スクリプトの設置場所が指定されていません。');
  } else {
    $_REQUEST['fitimg_path'] = preg_replace('|(.+)/$|','\\1',$_REQUEST['fitimg_path']);
    $_REQUEST['fitimg_path'] = preg_replace('|/fitimg.php$|','',$_REQUEST['fitimg_path']);
    if ($res = @fopen($_REQUEST['fitimg_path'].'/fitimg.php','r')) {
      fclose($res);
    } else {
      err('指定の場所に携帯画像変換スクリプトが見つかりません。');
    }
    if ($_REQUEST['fitimg_size'] == '') {
      err('画像変換での横幅サイズ制限値を指定してください。');
    } else {
      if (!preg_match('/^[0-9]+$/',$_REQUEST['fitimg_size'])) { err('画像変換の横幅サイズ指定は半角数字で指定してください。'); }
    }
  }
  # ｴﾝｺｰﾄﾞ選択指定ﾁｪｯｸ
  if ($_REQUEST['enc_type'] == '')      { $_REQUEST['enc_type'] = '1'; }
  # 下駄文字設定ﾁｪｯｸ
  if ($_REQUEST['geta_str'] == '') { $_REQUEST['geta_str'] = '〓'; }
  # HTMLﾒｰﾙ設定ﾁｪｯｸ
  if ($_REQUEST['html_mail_flag'] == '') { $_REQUEST['html_mail_flag'] = '0'; }
  # SoftBank名設定ﾁｪｯｸ
  if ($_REQUEST['softbank_name'] == '') { $_REQUEST['softbank_name'] = 'SoftBank'; }
  # ﾒｰﾙｴﾝｺｰﾄﾞ設定ﾁｪｯｸ
  if ($_REQUEST['cont_trs_enc'] == '') { $_REQUEST['cont_trs_enc'] = '7bit'; }
  # 画像表示設定ﾁｪｯｸ
  if ($_REQUEST['img_onry_flag'] == '') { $_REQUEST['img_onry_flag'] = '0'; }
  # 画像ﾀｲﾄﾙ表示設定ﾁｪｯｸ
  if ($_REQUEST['img_title_flag'] == '') { $_REQUEST['img_title_flag'] = '1'; }
  # 画像代替ﾃｷｽﾄ表示設定ﾁｪｯｸ
  if ($_REQUEST['img_alt_flag'] == '') { $_REQUEST['img_alt_flag'] = '1'; }
  # ﾃﾞｰﾀﾍﾞｰｽ設定ﾁｪｯｸ
  if ($_REQUEST['db_flag'] == '1') {
    # ﾃﾞｰﾀﾍﾞｰｽﾀｲﾌﾟ設定ﾁｪｯｸ
    if ($_REQUEST['dbd'] == '') { err('データベースタイプが指定されていません。'); }
    # ﾃﾞｰﾀﾍﾞｰｽﾎｽﾄ名設定ﾁｪｯｸ
    if ($_REQUEST['db_hostname'] == '') {  }
    # ﾃﾞｰﾀﾍﾞｰｽﾎﾟｰﾄ設定ﾁｪｯｸ
    if ($_REQUEST['db_hostport'] == '') {  }
    # ﾃﾞｰﾀﾍﾞｰｽ名設定ﾁｪｯｸ
    if ($_REQUEST['db_name'] == '') { err('データベース名が指定されていません。'); }
    # ﾃﾞｰﾀﾍﾞｰｽﾕｰｻﾞｰID設定ﾁｪｯｸ
    if ($_REQUEST['db_username'] == '') { err('データベースユーザーIDが指定されていません。'); }
    # ﾃﾞｰﾀﾍﾞｰｽﾊﾟｽﾜｰﾄﾞ設定ﾁｪｯｸ
    if ($_REQUEST['db_usrpassword'] == '') { err('データベースパスワードが指定されていません。'); }
    # ﾃﾞｰﾀﾍﾞｰｽ保存文字ｺｰﾄﾞ設定ﾁｪｯｸ
    if ($_REQUEST['db_code'] == '') { err('データベース保存文字コードが指定されていません。'); }
  }
#  # 自動ｱｯﾌﾟﾃﾞｰﾄﾁｪｯｸ設定ﾁｪｯｸ
#  if ($_REQUEST['auto_update'] == '1') {
#    if ($_REQUEST['update_width'] == '') { err('自動アップデートを指定した場合はチェック期間を指定してください。'); }
#  }

  # ﾃﾞｰﾀ更新
  $GLOBALS['SETTING_DATA'][] = "usr_id\t".$_REQUEST['usr_id']."\t";
  $GLOBALS['SETTING_DATA'][] = "usr_pass\t".$_REQUEST['usr_pass']."\t";
  $GLOBALS['SETTING_DATA'][] = "epass\t".$GLOBALS['emoji_obj']->epass."\t";
  $GLOBALS['SETTING_DATA'][] = "emj_path\t".$_REQUEST['emj_path']."\t";
  $GLOBALS['SETTING_DATA'][] = "emjimg_path\t".$_REQUEST['emjimg_path']."\t";
  $GLOBALS['SETTING_DATA'][] = "emoji_non\t".$_REQUEST['emoji_non']."\t";
  $GLOBALS['SETTING_DATA'][] = "emoji_chr\t".$_REQUEST['emoji_chr']."\t";
  $GLOBALS['SETTING_DATA'][] = "chr_code\t".$_REQUEST['chr_code']."\t";
  $GLOBALS['SETTING_DATA'][] = "emojiset\t".$_REQUEST['emojiset']."\t";
  $GLOBALS['SETTING_DATA'][] = "color_flag\t".$_REQUEST['color_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "fitimg_path\t".$_REQUEST['fitimg_path']."\t";
  $GLOBALS['SETTING_DATA'][] = "fitimg_size\t".$_REQUEST['fitimg_size']."\t";
  $GLOBALS['SETTING_DATA'][] = "enc_type\t".$_REQUEST['enc_type']."\t";
  $GLOBALS['SETTING_DATA'][] = "geta_str\t".$_REQUEST['geta_str']."\t";
  $GLOBALS['SETTING_DATA'][] = "html_mail_flag\t".$_REQUEST['html_mail_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "softbank_name\t".$_REQUEST['softbank_name']."\t";
  $GLOBALS['SETTING_DATA'][] = "cont_trs_enc\t".$_REQUEST['cont_trs_enc']."\t";
  $GLOBALS['SETTING_DATA'][] = "img_onry_flag\t".$_REQUEST['img_onry_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "img_title_flag\t".$_REQUEST['img_title_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "img_alt_flag\t".$_REQUEST['img_alt_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_flag\t".$_REQUEST['db_flag']."\t";
  $GLOBALS['SETTING_DATA'][] = "dbd\t".$_REQUEST['dbd']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_hostname\t".$_REQUEST['db_hostname']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_hostport\t".$_REQUEST['db_hostport']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_name\t".$_REQUEST['db_name']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_username\t".$_REQUEST['db_username']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_usrpassword\t".$_REQUEST['db_usrpassword']."\t";
  $GLOBALS['SETTING_DATA'][] = "db_code\t".$_REQUEST['db_code']."\t";
  $GLOBALS['SETTING_DATA'][] = "chg_code_sjis\t".$_REQUEST['chg_code_sjis']."\t";
  $GLOBALS['SETTING_DATA'][] = "chg_code_euc\t".$_REQUEST['chg_code_euc']."\t";
#  $GLOBALS['SETTING_DATA'][] = "auto_update\t".$_REQUEST['auto_update']."\t";
#  $GLOBALS['SETTING_DATA'][] = "update_width\t".$_REQUEST['update_width']."\t";
#  $GLOBALS['SETTING_DATA'][] = "auto_update\t0\t";
#  $GLOBALS['SETTING_DATA'][] = "update_width\t\t";

  data_save($GLOBALS['emj_setting_file'], $GLOBALS['SETTING_DATA']);

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">ライブラリ設定更新</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">ライブラリ設定を更新しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"設定に戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=set_chg'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# 一覧表示 ////////////////////////////////////////////////////////////////////
function list_vew() {

  # ﾃﾞｰﾀﾍﾞｰｽ読込み
  $EMJDATA_B = array();
  $EMJDATA_D = array();
  $EMJDATA_V = array();
  $EMJDATA_A = array();
  $DDATA_D0  = array();
  $DDATA_V0  = array();
  $DDATA_A0  = array();
  $DDATA_D1  = array();
  $DDATA_V1  = array();
  $DDATA_A1  = array();

  if ($GLOBALS['emoji_obj']->db_flag != '1') {
    # ﾌｧｲﾙ仕様
    if (file_exists($GLOBALS['emj_path_b'])) {
      $EMJDATA_B = file($GLOBALS['emj_path_b']);
    } else {
      $GLOBALS['emj_path_b'] = $GLOBALS['emj_path'].'/emoji.data6';
      if (file_exists($GLOBALS['emj_path_b'])) { $EMJDATA_B = file($GLOBALS['emj_path_b']); }
    }
    if (file_exists($GLOBALS['emj_path_d'])) {
      $EMJDATA_D = file($GLOBALS['emj_path_d']);
    } else {
      $GLOBALS['emj_path_d'] = $GLOBALS['emj_path'].'/docomo.data';
      if (file_exists($GLOBALS['emj_path_d'])) { $EMJDATA_D = file($GLOBALS['emj_path_d']); }
    }
    if (file_exists($GLOBALS['emj_path_v'])) {
      $EMJDATA_V = file($GLOBALS['emj_path_v']);
    } else {
      $GLOBALS['emj_path_v'] = $GLOBALS['emj_path'].'/vodafone.data';
      if (file_exists($GLOBALS['emj_path_v'])) { $EMJDATA_V = file($GLOBALS['emj_path_v']); }
    }
    if (file_exists($GLOBALS['emj_path_a'])) {
      $EMJDATA_A = file($GLOBALS['emj_path_a']);
    } else {
      $GLOBALS['emj_path_a'] = $GLOBALS['emoji_obj']->emj_path.'/au.data';
      if (file_exists($GLOBALS['emj_path_a'])) { $EMJDATA_A = file($GLOBALS['emj_path_a']); }
    }
    array_splice($EMJDATA_B,0,2);
    array_shift($EMJDATA_D);
    array_shift($EMJDATA_V);
    array_shift($EMJDATA_A);

    # 絵文字ﾃﾞｰﾀ準備
    foreach ($EMJDATA_D as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni) = explode("\t",$edt);
        $esjis10 = preg_replace('/\s/','',$esjis10);
        $DDATA_D0[$eno] = $efile;
        $DDATA_D1[$eno] = $ename;
      }
    }
    foreach ($EMJDATA_V as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni) = explode("\t",$edt);
        $DDATA_V0[$eno] = $efile;
        $DDATA_V1[$eno] = $ename;
      }
    }
    foreach ($EMJDATA_A as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni) = explode("\t",$edt);
        $esjis10 = preg_replace('/\s/','',$esjis10);
        $DDATA_A0[$eno] = $efile;
        $DDATA_A1[$eno] = $ename;
      }
    }
  } elseif ($GLOBALS['emoji_obj']->db_flag == '1') {
    # ﾃﾞｰﾀﾍﾞｰｽ仕様
    $sql = "SELECT * FROM emj_DoCoMo ORDER BY DoCoMo_emj_id";
    $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
    while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$GLOBALS['read_ptn'])) {
      $DDATA_D0[$GETDATA['DoCoMo_emj_id']] = $GETDATA['emj_file'];
      $DDATA_D1[$GETDATA['DoCoMo_emj_id']] = $GETDATA['emj_name'];
    }
    $sql = "SELECT * FROM emj_au ORDER BY au_emj_id";
    $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
    while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$GLOBALS['read_ptn'])) {
      $DDATA_A0[$GETDATA['au_emj_id']] = $GETDATA['emj_file'];
      $DDATA_A1[$GETDATA['au_emj_id']] = $GETDATA['emj_name'];
    }
    $sql = "SELECT * FROM emj_SoftBank ORDER BY SoftBank_emj_id";
    $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
    while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$GLOBALS['read_ptn'])) {
      $DDATA_V0[$GETDATA['SoftBank_emj_id']] = $GETDATA['emj_file'];
      $DDATA_V1[$GETDATA['SoftBank_emj_id']] = $GETDATA['emj_name'];
    }
  }

  # 更新画面表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">固定絵文字一覧</font>");
  $print_data = '';
  $print_data .= "
<table bgcolor=\"#808080\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" align=\"center\" width=\"700pt\">
  <tr bgcolor=\"#0000ff\">
    <th width=\"160pt\"><font color=\"#ffffff\">スクリプト変数名</font><br></th>
    <th width=\"180pt\"><font color=\"#ffffff\">DoCoMo絵文字</font><br></th>
    <th width=\"180pt\"><font color=\"#ffffff\">Vodafone絵文字</font><br></th>
    <th width=\"180pt\"><font color=\"#ffffff\">au絵文字</font><br></th>
  </tr>
";

  if ($GLOBALS['emoji_obj']->db_flag != '1') {
    # ﾌｧｲﾙ仕様
    foreach ($EMJDATA_B as $edtb) {
      if ($edtb == '') { break; }
      list($enob,$enameb,$d_nob,$v_nob,$a_nob,$junib) = explode("\t", $edtb);
      $print_data .= "<tr bgcolor=\"#f0f0ff\" style=\"font-size:12px\">
    <td>
      <b>\$obj-&gt;FIX_EMJ['".$enob."']</b><br>
    </td>\n";
      if (isset($DDATA_D0[$d_nob])) {
        if ($DDATA_D0[$d_nob] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_D0[$d_nob]."\" border=\"0\"> ".$DDATA_D1[$d_nob]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      if (isset($DDATA_V0[$v_nob])) {
        if ($DDATA_V0[$v_nob] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_V0[$v_nob]."\" border=\"0\"> ".$DDATA_V1[$v_nob]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      if (isset($DDATA_A0[$a_nob])) {
        if ($DDATA_A0[$a_nob] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_A0[$a_nob]."\" border=\"0\"> ".$DDATA_A1[$a_nob]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      $print_data .= "  </tr>\n";
    }
  } elseif ($GLOBALS['emoji_obj']->db_flag == '1') {
    # ﾃﾞｰﾀﾍﾞｰｽ仕様
    $sql = "SELECT * FROM emj_emoji ORDER BY Base_emj_id";
    $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
    while ($BASEDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$GLOBALS['read_ptn'])) {
      $print_data .= "<tr bgcolor=\"#f0f0ff\" style=\"font-size:12px\">
      <td>
        <b>\$obj-&gt;FIX_EMJ['".$BASEDATA['Base_emj_id']."']</b><br>
      </td>\n";
      if (isset($DDATA_D0[$BASEDATA['DoCoMo_no']])) {
        if ($DDATA_D0[$BASEDATA['DoCoMo_no']] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_D0[$BASEDATA['DoCoMo_no']]."\" border=\"0\"> ".$DDATA_D1[$BASEDATA['DoCoMo_no']]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      if (isset($DDATA_V0[$BASEDATA['SoftBank_no']])) {
        if ($DDATA_V0[$BASEDATA['SoftBank_no']] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_V0[$BASEDATA['SoftBank_no']]."\" border=\"0\"> ".$DDATA_V1[$BASEDATA['SoftBank_no']]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      if (isset($DDATA_A0[$BASEDATA['au_no']])) {
        if ($DDATA_A0[$BASEDATA['au_no']] != '') {
          $print_data .= "    <td><img src=\"".$GLOBALS['emoji_obj']->emjimg_path."/".$DDATA_A0[$BASEDATA['au_no']]."\" border=\"0\"> ".$DDATA_A1[$BASEDATA['au_no']]."<br></td>\n";
        } else {
          $print_data .= "    <td align=\"center\">-<br></td>\n";
        }
      } else {
        $print_data .= "    <td align=\"center\">-<br></td>\n";
      }
      $print_data .= "  </tr>\n";
    }
  }

  $print_data .= "</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"700pt\">
  <tr>
    <td>
      <font style=\"font-size:8pt; color:#ff0000\">*設定されていない固定絵文字を使用した場合には潰されて表示されますので注意が必要です。</font><br>
      <font style=\"font-size:8pt; color:#ff0000\">*'\$obj'は絵文字変換ライブラリオブジェクトを指定してください。</font><br>
    </td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"550pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
  </form>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}



# ﾀﾞｳﾝﾛｰﾄﾞﾒﾆｭｰ表示 ////////////////////////////////////////////////////////////
function down_vew() {

  # ﾀﾞｳﾝﾛｰﾄﾞﾒﾆｭｰ表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">絵文字データベースダウンロード</font>");
  $print_data = '';
  $print_data .= "
<table bgcolor=\"#808080\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"600pt\">
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\"><font color=\"#ffffff\">絵文字変換データベース<br></th>
    <td>
      絵文字変換対応データベースをバックアップします。<br>
      バックアップされたファイルは\"emoji.cgi.**************\"の形式で'**************'の部分に現日時の数字が入ります。<br>
      <br>
      <center>
        <input type=\"button\" value=\"DBバックアップ\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=backup'\"> 
      </center>
    </td>
  </tr>
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\"><font color=\"#ffffff\">絵文字変換データベース<br></th>
    <td>
      絵文字変換対応データベースを最新のバックアップファイルから復元します。<br>
      バックアップファイルが存在しない場合、処理されません。<br>
      <br>
      <center>
        <input type=\"button\" value=\"DBバックアップ復元\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=restor'\"> 
      </center>
    </td>
  </tr>
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\"><font color=\"#ffffff\">絵文字変換データベース<br></th>
    <td>
      絵文字変換対応データベースをダウンロードして更新します。<br>
      メンテナンスを行っているDBは初期化されてしまいますので、事前にバックアップを取ってから実行することをオススメ致します。<br>
      <center>
        <input type=\"button\" value=\"ダウンロード更新\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=down_chg'\"><br>
      </center>
    </td>
  </tr>
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\"><font color=\"#ffffff\">絵文字データベース<br></th>
    <td>
      絵文字データベース(DoCoMo,SoftBank,au)をダウンロード更新します。<br>
      <center>
        <input type=\"button\" value=\"ダウンロード更新\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=down_base'\"> 
      </center>
    </td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"550pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾊﾞｯｸｱｯﾌﾟ生成 ////////////////////////////////////////////////////////////////
function backup() {

  # ﾌｧｲﾙ名設定
  $backup_file_name = $GLOBALS['emoji_obj']->emj_path.'/emoji.cgi.'.date('YmdHis',time());
  # DBﾊﾞｯｸｱｯﾌﾟ
  if ($GLOBALS['emoji_obj']->db_flag != '1') {
    # ﾌｧｲﾙ仕様
    if (file_exists($GLOBALS['emj_path_b'])) { copy($GLOBALS['emj_path_b'],$backup_file_name); }
  } elseif ($GLOBALS['emoji_obj']->db_flag == '1') {
    # DB仕様
    $FILEDATA   = array();
    $FILEDATA[] = "ver.6\t\t\t\t\t";
    $FILEDATA[] = "関連付けNo\tスクリプト用コード\tDoCoMo絵文字No\tVodafone絵文字No\tau絵文字No\t優先順位\t";
    $sql = "SELECT * FROM emj_emoji ORDER BY Base_emj_id";
    $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
    while ($BASEDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$GLOBALS['read_ptn'])) {
      $FILEDATA[] = $BASEDATA['Base_emj_id']."\t".$BASEDATA['script_code']."\t".$BASEDATA['DoCoMo_no']."\t".$BASEDATA['SoftBank_no']."\t".$BASEDATA['au_no']."\t".$BASEDATA['yusen_no']."\t";
    }
    data_save($backup_file_name,$FILEDATA);
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">バックアップ生成完了</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">バックアップファイルの生成が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"ダウンロードメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_down'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾊﾞｯｸｱｯﾌﾟ復元 ////////////////////////////////////////////////////////////////
function restor() {

  # ﾊﾞｯｸｱｯﾌﾟ最新ﾌｧｲﾙ抽出
  $backup_file_name = '';
  $check_date = 0;
  $FILELIST = sarch_file($GLOBALS['emj_path_b'].'.*');
  if (is_array($FILELIST)) {
    foreach ($FILELIST as $fdt) {
      if (preg_match('/emoji\.cgi\.([0-9]+?)$/',$fdt,$MATCH)) {
        if ($check_date < $MATCH[1]) {
          $check_date       = $MATCH[1];
          $backup_file_name = $fdt;
        }
      }
    }
  }
  if ($backup_file_name != '') {
    if ($GLOBALS['emoji_obj']->db_flag != '1') {
      # ﾌｧｲﾙ仕様
      if (file_exists($GLOBALS['emj_path_b'])) { unlink($GLOBALS['emj_path_b']); }
      if (file_exists($backup_file_name))      { copy($backup_file_name,$GLOBALS['emj_path_b']); }
    } elseif ($GLOBALS['emoji_obj']->db_flag == '1') {
      # DB仕様
      # 絵文字変換対応ﾃｰﾌﾞﾙ削除
      $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_emoji",'','','');
      # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
      $STSDATA   = $GLOBALS['db_obj']->table_check(0,'emj_emoji');
      $base_flag = $STSDATA['emj_emoji'];
      # 絵文字変換対応ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
      if ($base_flag == '1') {
        $EMJDATA_BASE = array();
        if (file_exists($GLOBALS['emj_path_b'])) {
          $EMJDATA_BASE = @file($GLOBALS['emj_path_b']);
          array_shift($EMJDATA_BASE);
          array_shift($EMJDATA_BASE);
          foreach ($EMJDATA_BASE as $edt) {
            if ($edt != '') {
              list($eno,$ename,$d_no,$v_no,$a_no,$juni) = explode("\t", $edt);
              $sql = "INSERT INTO emj_emoji (Base_emj_id,script_code,DoCoMo_no,SoftBank_no,au_no,yusen_no,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($d_no)."','".addslashes($v_no)."','".addslashes($a_no)."','".addslashes($juni)."',".time().",".time().")";
              $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
            }
          }
        }
      }
    }
    $title_comm = '完了';
    $comm       = 'バックアップファイルの復元が完了しました。';
  } else {
    $title_comm = '失敗';
    $comm       = 'バックアップファイルが見つからないためバックアップファイルの復元に失敗しました。。';
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">バックアップ復元".$title_comm."</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">".$comm."<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"ダウンロードメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_down'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# 変換対応DBﾀﾞｳﾝﾛｰﾄﾞ //////////////////////////////////////////////////////////
function down_chg() {

  # ｱｸｾｽｱﾄﾞﾚｽ設定
  $down_url  = 'http://potora.dip.jp/emojimente/down.php?m=b&dm=&uid='.$GLOBALS['emoji_obj']->usr_id.'&ps='.$GLOBALS['emoji_obj']->usr_pass;
  # 絵文字変換対応DBﾀﾞｳﾝﾛｰﾄﾞ
  $BASE_DATA = array();
  if ($BASE_DATA = file($down_url)) {
    if (file_exists($GLOBALS['emoji_obj']->emj_path.'/emoji.cgi')) { unlink($GLOBALS['emoji_obj']->emj_path.'/emoji.cgi'); }
    data_save($GLOBALS['emoji_obj']->emj_path.'/emoji.cgi', $BASE_DATA);
    if ($GLOBALS['emoji_obj']->db_flag == '1') {
      # 絵文字ﾃｰﾌﾞﾙ削除
      $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_emoji",'','','');
      # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
      $STSDATA = $GLOBALS['db_obj']->table_check(0,'emj_emoji');
      # 変換対応絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
      if ($STSDATA['emj_emoji'] == '1') {
        $EMJDATA_BASE = array();
        if (file_exists($GLOBALS['emj_path_b'])) {
          $EMJDATA_BASE = @file($GLOBALS['emj_path_b']);
          array_shift($EMJDATA_BASE);
          array_shift($EMJDATA_BASE);
          foreach ($EMJDATA_BASE as $edt) {
            if ($edt != '') {
              list($eno,$ename,$d_no,$v_no,$a_no,$juni) = explode("\t", $edt);
              $sql = "INSERT INTO emj_emoji (Base_emj_id,script_code,DoCoMo_no,SoftBank_no,au_no,yusen_no,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($d_no)."','".addslashes($v_no)."','".addslashes($a_no)."','".addslashes($juni)."',".time().",".time().")";
              $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
            }
          }
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">絵文字変換DBダウンロード更新完了</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">絵文字変換DBのダウンロード更新が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"ダウンロードメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_down'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# 基本DBﾀﾞｳﾝﾛｰﾄﾞ //////////////////////////////////////////////////////////////
function down_base() {

  # ｱｸｾｽｱﾄﾞﾚｽ設定
  $down_urld  = 'http://potora.dip.jp/emojimente/down.php?m=d&dm=&uid='.$GLOBALS['emoji_obj']->usr_id.'&ps='.$GLOBALS['emoji_obj']->usr_pass;
  $down_urlv  = 'http://potora.dip.jp/emojimente/down.php?m=s&dm=&uid='.$GLOBALS['emoji_obj']->usr_id.'&ps='.$GLOBALS['emoji_obj']->usr_pass;
  $down_urla  = 'http://potora.dip.jp/emojimente/down.php?m=a&dm=&uid='.$GLOBALS['emoji_obj']->usr_id.'&ps='.$GLOBALS['emoji_obj']->usr_pass;
  # DoCoMo絵文字DBﾀﾞｳﾝﾛｰﾄﾞ
  $DOCOMO_DATA = array();
  if ($DOCOMO_DATA = @file($down_urld)) {
    if (file_exists($GLOBALS['emoji_obj']->emj_path.'/docomo.cgi')) { unlink($GLOBALS['emoji_obj']->emj_path.'/docomo.cgi'); }
    data_save($GLOBALS['emoji_obj']->emj_path.'/docomo.cgi',$DOCOMO_DATA);
    if ($GLOBALS['emoji_obj']->db_flag == '1') {
      # 絵文字ﾃｰﾌﾞﾙ削除
      $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_DoCoMo",'','','');
      # DoCoMo絵文字情報'emj_DoCoMo'ﾃｰﾌﾞﾙﾁｪｯｸ
      $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_DoCoMo');
      $docomo_flag = $STSDATA['emj_DoCoMo'];
      # DoCoMo絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
      if ($docomo_flag == '1') {
        $EMJDATA_DOCOMO = array();
        if (file_exists($GLOBALS['emj_path_d'])) {
          $EMJDATA_DOCOMO = @file($GLOBALS['emj_path_d']);
          array_shift($EMJDATA_DOCOMO);
          foreach ($EMJDATA_DOCOMO as $edt) {
            if ($edt != '') {
              list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$color) = explode("\t",$edt);
              $sql = "INSERT INTO emj_DoCoMo (DoCoMo_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','".$color."','','',".time().",".time().")";
              $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
            }
          }
        }
      }
    }
  }
  # SoftBank絵文字DBﾀﾞｳﾝﾛｰﾄﾞ
  $SOFT_DATA = array();
  if ($SOFT_DATA = @file($down_urlv)) {
    if (file_exists($GLOBALS['emoji_obj']->emj_path.'/vodafone.cgi')) { unlink($GLOBALS['emoji_obj']->emj_path.'/vodafone.cgi'); }
    data_save($GLOBALS['emoji_obj']->emj_path.'/vodafone.cgi',$SOFT_DATA);
    if ($GLOBALS['emoji_obj']->db_flag == '1') {
      # 絵文字ﾃｰﾌﾞﾙ削除
      $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_au",'','','');
      # au絵文字情報'emj_au'ﾃｰﾌﾞﾙﾁｪｯｸ
      $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_au');
      $au_flag     = $STSDATA['emj_au'];
      # au絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
      if ($au_flag == '1') {
        $EMJDATA_AU = array();
        if (file_exists($GLOBALS['emj_path_a'])) {
          $EMJDATA_AU = @file($GLOBALS['emj_path_a']);
          array_shift($EMJDATA_AU);
          foreach ($EMJDATA_AU as $edt) {
            if ($edt != '') {
              list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$esjis16m) = explode("\t",$edt);
              $sql = "INSERT INTO emj_au (au_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($esjis16m)."','',".time().",".time().")";
              $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
            }
          }
        }
      }
    }
  }
  # au絵文字DBﾀﾞｳﾝﾛｰﾄﾞ
  $AU_DATA = array();
  if ($AU_DATA = @file($down_urla)) {
    if (file_exists($GLOBALS['emoji_obj']->emj_path.'/au.cgi')) { unlink($GLOBALS['emoji_obj']->emj_path.'/au.cgi'); }
    data_save($GLOBALS['emoji_obj']->emj_path.'/au.cgi', $AU_DATA);
    if ($GLOBALS['emoji_obj']->db_flag == '1') {
      # 絵文字ﾃｰﾌﾞﾙ削除
      $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_SoftBank",'','','');
      # SoftBank絵文字情報'emj_SoftBank'ﾃｰﾌﾞﾙﾁｪｯｸ
      $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_SoftBank');
      $soft_flag   = $STSDATA['emj_SoftBank'];
      # SoftBank絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
      if ($soft_flag == '1') {
        $EMJDATA_SOFT = array();
        if (file_exists($GLOBALS['emj_path_v'])) {
          $EMJDATA_SOFT = @file($GLOBALS['emj_path_v']);
          array_shift($EMJDATA_SOFT);
          foreach ($EMJDATA_SOFT as $edt) {
            if ($edt != '') {
              list($eno,$ename,$efile,$esjis16,$emailcd,$eweb,$euni,$eutf8) = explode("\t",$edt);
              $sql = "INSERT INTO emj_SoftBank (SoftBank_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($emailcd)."','".addslashes($eutf8)."',".time().",".time().")";
              $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
            }
          }
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">絵文字基本DBダウンロード更新完了</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">絵文字基本DBのダウンロード更新が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"ダウンロードメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_down'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾊﾟｽﾜｰﾄﾞ更新表示 /////////////////////////////////////////////////////////////
function pass_vew() {

  # 更新画面表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">管理パスワード更新</font>");
  $print_data = '';
  $print_data .= "
<table bgcolor=\"#808080\" border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <form action=\"".$GLOBALS['cgi_name']."\" method=\"POST\">
  <input type=\"hidden\" name=\"m\" value=\"pass_chg_save\">
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\" width=\"100pt\"><font color=\"#ffffff\">旧パスワード<br></th>
    <td><input type=\"password\" size=\"20\" name=\"old_pass\"><br></td>
  </tr>
  <tr bgcolor=\"#f0f0ff\">
    <th bgcolor=\"#0000ff\" width=\"100pt\"><font color=\"#ffffff\">新パスワード<br></th>
    <td>
      <input type=\"password\" size=\"20\" name=\"new_pass0\"><br>
      <input type=\"password\" size=\"20\" name=\"new_pass1\"> 確認のためもう一度入力<br>
    </td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"submit\" value=\"更新\" style=\"width: 200px;\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
  </form>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾊﾟｽﾜｰﾄﾞ更新 /////////////////////////////////////////////////////////////////
function pass_save() {

  # 旧ﾊﾟｽﾜｰﾄﾞﾁｪｯｸ
  if ($_REQUEST['old_pass'] == '') { err('旧パスワードが入力されていません。'); }
  if ($_REQUEST['old_pass'] != $GLOBALS['emoji_obj']->epass) { err('旧パスワードが一致しません。'); }

  # 新ﾊﾟｽﾜｰﾄﾞﾁｪｯｸ
  if (($_REQUEST['new_pass0'] == '') or ($_REQUEST['new_pass1'] == '')) { err('新パスワードが入力されていません。'); }
  if ($_REQUEST['new_pass0'] != $_REQUEST['new_pass1']) { err('確認用パスワードと一致しません。'); }

  # ﾊﾟｽﾜｰﾄﾞ更新
  $GLOBALS['SETTINGDATA'][2] = "epass\t".$_REQUEST['new_pass0']."\t";
  data_save($GLOBALS['emj_setting_file'], $GLOBALS['SETTINGDATA']);

  # ﾊﾟｽﾜｰﾄﾞ更新
  $_SESSION['syspass'] = $_REQUEST['new_pass0'];
  $_SESSION['ps']      = $_REQUEST['new_pass0'];

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">管理パスワード更新</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">管理パスワードを更新しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾃﾞｰﾀﾍﾞｰｽ操作ﾒﾆｭｰ ////////////////////////////////////////////////////////////
function db_menu() {

  # ﾃｰﾌﾞﾙ有無ﾁｪｯｸ
  $table_check = '';
  # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
  $table_check .= "絵文字変換対象テーブル:";
  if ($GLOBALS['db_obj']->db_check(0,'emj_emoji','','') == '1') {
    $table_check .= "有り<br>\n";
  } else {
    $table_check .= "無し<br>\n";
  }
  # DoCoMo絵文字情報'emj_DoCoMo'ﾃｰﾌﾞﾙﾁｪｯｸ
  $table_check .= "DoCoMo絵文字テーブル:";
  if ($GLOBALS['db_obj']->db_check(0,'emj_DoCoMo','','') == '1') {
    $table_check .= "有り<br>\n";
  } else {
    $table_check .= "無し<br>\n";
  }
  # au絵文字情報'emj_au'ﾃｰﾌﾞﾙﾁｪｯｸ
  $table_check .= "au絵文字テーブル:";
  if ($GLOBALS['db_obj']->db_check(0,'emj_au','','') == '1') {
    $table_check .= "有り<br>\n";
  } else {
    $table_check .= "無し<br>\n";
  }
  # SoftBank絵文字情報'emj_SoftBank'ﾃｰﾌﾞﾙﾁｪｯｸ
  $table_check .= "SoftBank絵文字テーブル:";
  if ($GLOBALS['db_obj']->db_check(0,'emj_SoftBank','','') == '1') {
    $table_check .= "有り<br>\n";
  } else {
    $table_check .= "無し<br>\n";
  }
  # 携帯端末情報'Phone_Spec'ﾃｰﾌﾞﾙﾁｪｯｸ
  $table_check .= "携帯情報テーブル:";
  if ($GLOBALS['db_obj']->db_check(0,'Phone_Spec','','') == '1') {
    $table_check .= "有り<br>\n";
  } else {
    $table_check .= "無し<br>\n";
  }

  # ﾃﾞｰﾀ設定
  if ($GLOBALS['emoji_obj']->dbd == 'Pg') {
    $dbd = 'PostgreSQL';
  } elseif ($GLOBALS['emoji_obj']->dbd == 'mysql') {
    $dbd = 'MySQL';
  }

  # ﾒﾆｭｰ画面表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース操作メニュー</font>");
  $print_data = '';
  $print_data .= "<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"800pt\">
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>データベース情報</font><br></td>
  </tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      ◆接続設定情報◆<br>
      DB TYPE[<b>".$dbd."</b>],
      HOST[<b>".$GLOBALS['emoji_obj']->db_hostname."</b>],
      PORT[<b>".$GLOBALS['emoji_obj']->db_hostport."</b>],
      DB[<b>".$GLOBALS['emoji_obj']->db_name."</b>],
      ID[<b>".$GLOBALS['emoji_obj']->db_username."</b>],
      PASS[<b>".$GLOBALS['emoji_obj']->db_usrpassword."</b>]<br>
      ◆接続ステータス◆<br>
      ".$GLOBALS['sts']."<br>
      ◆テーブル有無チェック◆<br>
      ".$table_check."<br>
    </td>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>データベース新規生成</font><br></td>
  </tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      データベースを新規に作成し、絵文字データ、携帯端末データをデータベースにインポートします。<br>
      ※既に生成されているテーブルは処理されません。<br>
      <center><input type=\"button\" value=\"データベース新規生成\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_make'\"></center>
    </td>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>データベーステーブル再構築</font><br></td>
  </tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      現在のデータベーステーブルを破棄し新規にデータベーステーブルを生成します。<br>
      <center>
        <input type=\"button\" value=\"絵文字変換対応テーブル再構築\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_emjb_remake'\"> 
        <input type=\"button\" value=\"絵文字テーブル再構築\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_emj_remake'\"> 
        <input type=\"button\" value=\"携帯情報テーブル再構築\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_mob_remake'\">
      </center>
    </td>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#0000ff\"><font style=\"font-weight:bold; color:#f0f0ff\"><font color=\"#d00000\">■</font>データベーステーブル破棄</font><br></td>
  </tr>
  <tr>
    <td colspan=\"2\" bgcolor=\"#e0e0ff\">
      現在のデータベーステーブルを破棄します。(データベース自体は削除されません)<br>
      <center>
        <input type=\"button\" value=\"絵文字変換対応テーブル破棄\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_emjb_delete'\"> 
        <input type=\"button\" value=\"絵文字テーブル破棄\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_emj_delete'\"> 
        <input type=\"button\" value=\"携帯情報テーブル破棄\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_mob_delete'\">
      </center>
    </td>
  </tr>
  <tr><td colspan=\"2\"><br></td></tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);

}

# ﾃﾞｰﾀﾍﾞｰｽ新規生成 ////////////////////////////////////////////////////////////
function db_make() {

  # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_emoji');
  $base_flag   = $STSDATA['emj_emoji'];
  # DoCoMo絵文字情報'emj_DoCoMo'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_DoCoMo');
  $docomo_flag = $STSDATA['emj_DoCoMo'];
  # au絵文字情報'emj_au'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_au');
  $au_flag     = $STSDATA['emj_au'];
  # SoftBank絵文字情報'emj_SoftBank'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_SoftBank');
  $soft_flag   = $STSDATA['emj_SoftBank'];
  # 携帯端末情報'Phone_Spec'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'Phone_Spec');
  $mob_flag    = $STSDATA['Phone_Spec'];

  # 絵文字変換対応ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($base_flag == '1') {
    $EMJDATA_BASE = array();
    if (file_exists($GLOBALS['emj_path_b'])) {
      $EMJDATA_BASE = @file($GLOBALS['emj_path_b']);
      array_shift($EMJDATA_BASE);
      array_shift($EMJDATA_BASE);
      foreach ($EMJDATA_BASE as $edt) {
        if ($edt != '') {
          list($eno,$ename,$d_no,$v_no,$a_no,$juni) = explode("\t", $edt);
          $sql = "INSERT INTO emj_emoji (Base_emj_id,script_code,DoCoMo_no,SoftBank_no,au_no,yusen_no,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($d_no)."','".addslashes($v_no)."','".addslashes($a_no)."','".addslashes($juni)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # DoCoMo絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($docomo_flag == '1') {
    $EMJDATA_DOCOMO = array();
    if (file_exists($GLOBALS['emj_path_d'])) {
      $EMJDATA_DOCOMO = @file($GLOBALS['emj_path_d']);
      array_shift($EMJDATA_DOCOMO);
      foreach ($EMJDATA_DOCOMO as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$color) = explode("\t",$edt);
          $sql = "INSERT INTO emj_DoCoMo (DoCoMo_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','".$color."','','',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # SoftBank絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($soft_flag == '1') {
    $EMJDATA_SOFT = array();
    if (file_exists($GLOBALS['emj_path_v'])) {
      $EMJDATA_SOFT = @file($GLOBALS['emj_path_v']);
      array_shift($EMJDATA_SOFT);
      foreach ($EMJDATA_SOFT as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$emailcd,$eweb,$euni,$eutf8) = explode("\t",$edt);
          $sql = "INSERT INTO emj_SoftBank (SoftBank_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($emailcd)."','".addslashes($eutf8)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # au絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($au_flag == '1') {
    $EMJDATA_AU = array();
    if (file_exists($GLOBALS['emj_path_a'])) {
      $EMJDATA_AU = @file($GLOBALS['emj_path_a']);
      array_shift($EMJDATA_AU);
      foreach ($EMJDATA_AU as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$esjis16m) = explode("\t",$edt);
          $sql = "INSERT INTO emj_au (au_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($esjis16m)."','',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # 携帯ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($mob_flag == '1') {
    $MOBDATA = array();
    if (file_exists($GLOBALS['mob_path'])) {
      $MOBDATA = @file($GLOBALS['mob_path']);
      array_shift($MOBDATA);
      foreach ($MOBDATA as $kdt) {
        if ($kdt != '') {
          list($career,$kubun,$meka_name,$kisyu_type,$yusendo,$ue_pat,$hoho,$ichi,$patn,$image_mime,$image_kaku,$movie_mime,$movie_kaku,$movie_size,$down_size,$str_size,$display_width,$display_height,$display_color,$cache_size,$export_type,$export_type2,$biko0,$biko1,$biko2,$editdate) = explode("\t",$kdt);
          $sql = "INSERT INTO Phone_Spec (career,kubun,maker,model,yusen,user_agent_patt,sikibetu,check_point,check_string,img_mime,img_ext,mov_mime,mov_ext,mov_size,mov_download_max_size,mov_stream_max_size,display_width,display_height,display_color,cache_size,fitmov_patt_name1,fitmov_patt_name2,biko0,biko1,biko2,regdate,editdate) VALUES ('".addslashes($career)."','".addslashes($kubun)."','".addslashes($meka_name)."','".addslashes($kisyu_type)."','".addslashes($yusendo)."','".addslashes($ue_pat)."','".addslashes($hoho)."','".addslashes($ichi)."','".addslashes($patn)."','".addslashes($image_mime)."','".addslashes($image_kaku)."','".addslashes($movie_mime)."','".addslashes($movie_kaku)."','".$movie_size."','".$down_size."','".$str_size."','".$display_width."','".$display_height."','".$display_color."','".$cache_size."','".addslashes($export_type)."','".addslashes($export_type2)."','".addslashes($biko0)."','".addslashes($biko1)."','".addslashes($biko2)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース新規生成</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベースを新規生成しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 絵文字変換対応ﾃｰﾌﾞﾙ再生成 ///////////////////////////////////////////////////
function db_emjb_remake() {

  # 絵文字ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_emoji",'','','');

  # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA = $GLOBALS['db_obj']->table_check(0,'emj_emoji');

  # 変換対応絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($STSDATA['emj_emoji'] == '1') {
    $EMJDATA_BASE = array();
    if (file_exists($GLOBALS['emj_path_b'])) {
      $EMJDATA_BASE = @file($GLOBALS['emj_path_b']);
      array_shift($EMJDATA_BASE);
      array_shift($EMJDATA_BASE);
      foreach ($EMJDATA_BASE as $edt) {
        if ($edt != '') {
          list($eno,$ename,$d_no,$v_no,$a_no,$juni) = explode("\t", $edt);
          $sql = "INSERT INTO emj_emoji (Base_emj_id,script_code,DoCoMo_no,SoftBank_no,au_no,yusen_no,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($d_no)."','".addslashes($v_no)."','".addslashes($a_no)."','".addslashes($juni)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース絵文字変換対応テーブル再生成</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース絵文字変換対応テーブルの再生成が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 絵文字ﾃｰﾌﾞﾙ再生成 ///////////////////////////////////////////////////////////
function db_emj_remake() {

  # 絵文字ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_DoCoMo",'','','');
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_au",'','','');
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_SoftBank",'','','');

  # DoCoMo絵文字情報'emj_DoCoMo'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_DoCoMo');
  $docomo_flag = $STSDATA['emj_DoCoMo'];
  # au絵文字情報'emj_au'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_au');
  $au_flag     = $STSDATA['emj_au'];
  # SoftBank絵文字情報'emj_SoftBank'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA     = $GLOBALS['db_obj']->table_check(0,'emj_SoftBank');
  $soft_flag   = $STSDATA['emj_SoftBank'];

  # DoCoMo絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($docomo_flag == '1') {
    $EMJDATA_DOCOMO = array();
    if (file_exists($GLOBALS['emj_path_d'])) {
      $EMJDATA_DOCOMO = @file($GLOBALS['emj_path_d']);
      array_shift($EMJDATA_DOCOMO);
      foreach ($EMJDATA_DOCOMO as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$color) = explode("\t",$edt);
          $sql = "INSERT INTO emj_DoCoMo (DoCoMo_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','".$color."','','',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # SoftBank絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($soft_flag == '1') {
    $EMJDATA_SOFT = array();
    if (file_exists($GLOBALS['emj_path_v'])) {
      $EMJDATA_SOFT = @file($GLOBALS['emj_path_v']);
      array_shift($EMJDATA_SOFT);
      foreach ($EMJDATA_SOFT as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$emailcd,$eweb,$euni,$eutf8) = explode("\t",$edt);
          $sql = "INSERT INTO emj_SoftBank (SoftBank_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($emailcd)."','".addslashes($eutf8)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # au絵文字ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($au_flag == '1') {
    $EMJDATA_AU = array();
    if (file_exists($GLOBALS['emj_path_a'])) {
      $EMJDATA_AU = @file($GLOBALS['emj_path_a']);
      array_shift($EMJDATA_AU);
      foreach ($EMJDATA_AU as $edt) {
        if ($edt != '') {
          list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$esjis16m) = explode("\t",$edt);
          $sql = "INSERT INTO emj_au (au_emj_id,emj_name,emj_file,sjis16,sjis10,web_code,unicode,color,mail_code,utf_8,regdate,editdate) VALUES ('".$eno."','".addslashes($ename)."','".addslashes($efile)."','".addslashes($esjis16)."','".addslashes($esjis10)."','".addslashes($eweb)."','".addslashes($euni)."','','".addslashes($esjis16m)."','',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース絵文字テーブル再生成</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース絵文字テーブルの再生成が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 携帯ﾃｰﾌﾞﾙ再生成 /////////////////////////////////////////////////////////////
function db_mob_remake() {

  # 携帯情報ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE Phone_Spec",'','','');

  # 携帯端末情報'Phone_Spec'ﾃｰﾌﾞﾙﾁｪｯｸ
  $STSDATA = $GLOBALS['db_obj']->table_check(0,'Phone_Spec');

  # 携帯ﾃﾞｰﾀDBｲﾝﾎﾟｰﾄ
  if ($STSDATA['Phone_Spec'] == '1') {
    $MOBDATA = array();
    if (file_exists($GLOBALS['mob_path'])) {
      $MOBDATA = @file($GLOBALS['mob_path']);
      array_shift($MOBDATA);
      foreach ($MOBDATA as $kdt) {
        if ($kdt != '') {
          list($career,$kubun,$meka_name,$kisyu_type,$yusendo,$ue_pat,$hoho,$ichi,$patn,$image_mime,$image_kaku,$movie_mime,$movie_kaku,$movie_size,$down_size,$str_size,$display_width,$display_height,$display_color,$cache_size,$export_type,$export_type2,$biko0,$biko1,$biko2,$editdate) = explode("\t",$kdt);
          $sql = "INSERT INTO Phone_Spec (career,kubun,maker,model,yusen,user_agent_patt,sikibetu,check_point,check_string,img_mime,img_ext,mov_mime,mov_ext,mov_size,mov_download_max_size,mov_stream_max_size,display_width,display_height,display_color,cache_size,fitmov_patt_name1,fitmov_patt_name2,biko0,biko1,biko2,regdate,editdate) VALUES ('".addslashes($career)."','".addslashes($kubun)."','".addslashes($meka_name)."','".addslashes($kisyu_type)."','".addslashes($yusendo)."','".addslashes($ue_pat)."','".addslashes($hoho)."','".addslashes($ichi)."','".addslashes($patn)."','".addslashes($image_mime)."','".addslashes($image_kaku)."','".addslashes($movie_mime)."','".addslashes($movie_kaku)."','".$movie_size."','".$down_size."','".$str_size."','".$display_width."','".$display_height."','".$display_color."','".$cache_size."','".addslashes($export_type)."','".addslashes($export_type2)."','".addslashes($biko0)."','".addslashes($biko1)."','".addslashes($biko2)."',".time().",".time().")";
          $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$GLOBALS['save_ptn']);
        }
      }
    }
  }

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース携帯情報テーブル再生成</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース携帯情報テーブルの再生成が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 絵文字変換対応ﾃｰﾌﾞﾙ削除 /////////////////////////////////////////////////////
function db_emjb_delete() {

  # 絵文字変換対応ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_emoji",'','','');

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース絵文字変換対応テーブル削除</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース絵文字変換対応テーブルの削除が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 絵文字ﾃｰﾌﾞﾙ削除 /////////////////////////////////////////////////////////////
function db_emj_delete() {

  # 絵文字ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_DoCoMo",'','','');
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_au",'','','');
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE emj_SoftBank",'','','');

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース絵文字テーブル削除</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース絵文字テーブルの削除が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

# 携帯ﾃｰﾌﾞﾙ削除 ///////////////////////////////////////////////////////////////
function db_mob_delete() {

  # 携帯情報ﾃｰﾌﾞﾙ削除
  $sth = $GLOBALS['db_obj']->sql_set_data(0,"DROP TABLE Phone_Spec",'','','');

  # 完了表示
  tag_header($GLOBALS['pro_name'],"<font style=\"font-size:12pt; font-weight:bold\">データベース携帯情報テーブル削除</font>");
  $print_data = '';
  $print_data .= "
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">データベース携帯情報テーブルの削除が完了しました。<br></td>
  </tr>
</table>
<table border=\"0\" cellpadding=\"3\" cellspacing=\"1\" align=\"center\" width=\"400pt\">
  <tr>
    <td align=\"center\">
      <input type=\"button\" value=\"データベースメニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=db_menu'\"> 
      <input type=\"button\" value=\"メニューに戻る\" style=\"width: 200px;\" onClick=\"location.href='".$GLOBALS['cgi_name']."?m=menu'\"><br>
    </td>
  </tr>
</table>
";

#  $print_data = mb_convert_encoding($print_data, 'SJIS', 'EUC-JP');
  print $print_data;

  tag_futter($GLOBALS['cgi_name']);
}

###############################################################################
# 基本ｻﾌﾞﾙｰﾁﾝ
###############################################################################

# ﾛｸﾞｲﾝﾁｪｯｸ ///////////////////////////////////////////////////////////////////
function login_check() {
  if (isset($_REQUEST['ms'])) {
    if ($_REQUEST['ms'] == '1') {
      if ($_REQUEST['syspass'] == '') { err('管理パスワードエラー'); }
      if ('a'.$GLOBALS['emoji_obj']->epass == 'a'.$_REQUEST['syspass']) {
        $_SESSION['syspass'] = $_REQUEST['syspass'];
        $_SESSION['ps']      = $_REQUEST['syspass'];
      } else {
        err('管理パスワードエラー');
      }
    } else {
      err('管理パスワードエラー');
    }
  } else {
    if (isset($_REQUEST['syspass'])) {
      if ('a'.$GLOBALS['emoji_obj']->epass == 'a'.$_REQUEST['syspass']) {
        $_SESSION['syspass'] = $_REQUEST['syspass'];
        $_SESSION['ps']      = $_REQUEST['syspass'];
      } else {
        if ($_REQUEST['syspass'] != '') { err('管理パスワードエラー'); }
        if ('a'.$GLOBALS['emoji_obj']->epass == 'a'.$_SESSION['syspass']) {
          $_SESSION['ps'] = $_SESSION['syspass'];
        } else {
          err('管理パスワードエラー');
        }
      }
    } else {
      if ('a'.$GLOBALS['emoji_obj']->epass == 'a'.$_SESSION['syspass']) {
        $_SESSION['ps'] = $_SESSION['syspass'];
      } else {
        err('管理パスワードエラー');
      }
    }
  }
}

# ﾛｸﾞｱｳﾄ //////////////////////////////////////////////////////////////////////
function logout() {
  $_SESSION['syspass'] = '';
  $_SESSION['ps']      = '';
  header('Location:'.$GLOBALS['cgi_name']."\n");
}

# ﾃﾞｰﾀ保存(ﾌｧｲﾙﾛｯｸ) ///////////////////////////////////////////////////////////
# 配列"DATA"の内容を指定ﾌｧｲﾙに保存する(ﾛｯｸ機構付き)
function data_save($datafile, $DATA) {

  $flag = 0;
  # ﾌｧｲﾙﾛｯｸｱﾘ(Win,Unix共用)
  for ($no = 1; $no <= 10; $no++) {                         # 10秒待っても書き込めない場合は諦める
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
    sleep(1);                                               # ﾛｯｸ中なら1秒待つ
  }
  if (file_exists($datafile)) { @chmod($datafile, 0777); }
  return $flag;
}

# ﾌｧｲﾙ検索 ////////////////////////////////////////////////////////////////////
# 指定ﾌｧｲﾙ名を検索する。
# 引渡値：$sarch_filename => ﾌｧｲﾙ名(ﾜｲﾙﾄﾞｶｰﾄﾞ * 指定可能)
# 返り値：$FILENAME       => 取得ﾌｧｲﾙ名ﾘｽﾄ(ﾊﾟｽ付き)
function sarch_file($sarch_filename) {
  $FILENAME = array();
  $DIRDT      = array();
  $DIRDT      = explode('/', $sarch_filename);
  $fn = $DIRDT[count($DIRDT) - 1];
  array_splice($DIRDT, -1);
  $dirnm = join('/',$DIRDT);
  $fns = preg_replace('/\*/', '(.*)', $fn);
  $dir = opendir($dirnm);
  while (($ent = readdir($dir)) !== FALSE) {
    if (preg_match('/'.$fns.'/', $ent)) {
      $FILENAME[] = $dirnm.'/'.$ent;
    }
  }
  return $FILENAME;
}

# HTMLﾍｯﾀﾞｰ///////////////////////////////////////////////////////////////////
function tag_header($t_title,$h_title) {

  $pdt = "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html;charset=Shift_JIS\">
<title>$t_title</title>
<style type=\"text/css\" media=\"all\">
<!--
BODY{
  font-size:10pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
  margin-top: 0px;
  margin-left: 0px;
}
TD,TH{
  font-size:10pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
}
INPUT,SELECT,TEXTAREA{
  font-size:9pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
}
-->
</style>
</head>
<body>
<center>$h_title</center><hr>
";

#  $pdt = mb_convert_encoding($pdt, 'SJIS', 'EUC-JP');

  header('Content-Type: text/html;charset=Shift_JIS');
  print $pdt;

}

# HTMLﾌｯﾀｰ ////////////////////////////////////////////////////////////////////
function tag_futter($back_url) {

  $pdt = "<hr>
<center><input type=\"button\" value=\"戻る\" style=\"width: 200px;\" onClick=\"location.href='".$back_url."'\"></center>
<hr>
";
  $pdt .= copyright_tag();
  $pdt .= '</body></html>';

#  $pdt = mb_convert_encoding($pdt, 'SJIS', 'EUC-JP');
  print $pdt;

}

# ｴﾗｰ処理 /////////////////////////////////////////////////////////////////////
function err($err_mess) {

  $pdt = "<html><head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Shift_JIS\">
<title>エラー</title>
<style type=\"text/css\" media=\"all\">
<!--
BODY{
  font-size:10pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
  margin-top: 0px;
  margin-left: 0px;
}
TD,TH{
  font-size:10pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
}
INPUT,SELECT,TEXTAREA{
  font-size:9pt;
  color:#000000;
  font-family: 'Verdana','MS UI Gothic','ＭＳ Ｐゴシック',sans-serif;
}
-->
</style>
</head>
<body><center>
<font color=\"#ff0000\"><b>エラー!</b></font><br>
<hr><br>
$err_mess<br><br>
ブラウザの\"戻る\"で戻ってください。<br><hr>
";
  $pdt .= copyright_tag();
  $pdt .= '</body></html>';

#  $pdt = mb_convert_encoding($pdt, 'SJIS', 'EUC-JP');
  print $pdt;

  exit();
}

# 著作権表示 //////////////////////////////////////////////////////////////////
function copyright_tag() {
  return '<div align="right" style="font-size:10pt; color:#aaaaaa">Copyright (C) 2005-2007 Potora All Rights Resrved.</div><br>';
}


?>
