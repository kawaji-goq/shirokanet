<?php

###############################################################################
# 携帯絵文字変換ﾗｲﾌﾞﾗﾘ 2007
# Potora/inaken(C) 2003-2007.
# MAIL: support@potora.dip.jp
#       inaken@jomon.ne.jp
# URL : http://potora.dip.jp/
#       http://www.jomon.ne.jp/~inaken/
###############################################################################
# 2007.08.01 v.7.00.00 全面改訂
# 2007.08.08 v.7.00.01 ｸﾗｽ変数宣言不具合修正
# 2007.08.08 v.7.00.02 au表示不具合対策
# 2007.08.09 v.7.00.03 DBﾌｧｲﾙ読込み不具合処理,au入力不具合修正
# 2007.08.10 v.7.00.04 絵文字ｴﾝｺｰﾄﾞ時ｺｰﾄﾞ変換不具合修正
# 2007.08.11 v.7.01.00 emj_strimwidth,emj_change関数追加
# 2007.08.16 v.7.01.01 DoCoMo扱い絵文字ｺｰﾄﾞShift_JISﾃｷｽﾄ→Unicodeﾃｷｽﾄ変更
# 2007.08.17 v.7.01.02 絵文字変換(ﾒｰﾙ用)不具合修正
# 2007.08.24 v.7.01.03 出力文字ｺｰﾄﾞ処理不具合修正
# 2007.08.25 v.7.02.00 UTF-8ｺｰﾄﾞ対応不具合修正
# 2007.08.27 v.7.02.01 SoftBank UTF-8ｺｰﾄﾞ対応不具合,auﾒｰﾙｺｰﾄﾞ設定不具合修正
# 2007.08.28 v.7.02.02 絵文字ｴﾝｺｰﾄﾞ不具合修正
# 2007.08.28 v.7.02.03 ﾗｲﾌﾞﾗﾘ初期化不具合修正
# 2007.08.28 v.7.02.04 SoftBank絵文字ｴﾝｺｰﾄﾞﾊﾞｸﾞ修正
# 2007.08.28 v.7.02.05 絵文字ｴﾝｺｰﾄﾞ不具合修正(UTF-8ｺｰﾄﾞ対応による不具合対策)
# 2007.09.05 v.7.02.06 ﾃﾞｰﾀﾍﾞｰｽｵﾌﾞｼﾞｪｸﾄ指定不具合修正
###############################################################################
# これまでの来歴
###############################################################################
# 2003.05.01 v.1.00.00 新規
# 2003.05.07 v.1.00.01 携帯絵文字表示不具合修正
# 2003.07.18 v.1.00.02 未対応文字適用不具合修正、PC画像枠消去
# 2003.07.24 v.1.00.03 au携帯HTML対応化
# 2003.09.01 v.1.01.00 au携帯HTML自動対応化
# 2003.09.05 v.1.01.01 URLｴﾝｺｰﾄﾞ見直し
# 2003.10.02 v.1.01.02 ﾊﾞｸﾞ修正
# 2003.11.11 v.1.01.03 AU認識修正
# 2004.02.06 v.2.00.00 ﾊｯｼｭ展開見直し、EUCｺｰﾄﾞ対応化
# 2004.09.17 v.3.00.00 PHP版作成
# 2005.01.17 v.3.01.00 PHP版au機種絵文字表示不具合修正
# 2005.01.22 v.3.02.00 処理見直し、一括変換機能、絵文字削除機能追加
# 2005.01.23 v.4.00.00 新ﾊﾞｰｼﾞｮﾝﾃﾞｰﾀﾍﾞｰｽ対応
# 2005.01.28 v.4.00.01 DoCoMo,au絵文字変換順序見直し
# 2005.02.04 v.4.00.02 ｴﾝｺｰﾄﾞ,ﾃﾞｺｰﾄﾞ変換不具合見直し
# 2005.02.07 v.4.00.03 ｸﾞﾛｰﾊﾞﾙ変数処理方法変更
# 2005.02.07 v.4.00.04 au拡張絵文字一時ﾌｨﾙﾀｰ処理追加
# 2005.02.13 v.4.00.05 au端末認識ﾊﾞｸﾞ修正
# 2005.02.13 v.4.01.00 固定絵文字ﾃﾞｰﾀ生成機能追加
# 2005.03.04 v.4.02.00 Vodafone新ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ対応
# 2005.03.24 v.5.00.00 ﾃﾞｰﾀﾍﾞｰｽ ver.6 対応
# 2005.04.20 v.5.00.01 絵文字ｴﾝｺｰﾄﾞ不具合修正
# 2005.04.22 v.5.00.02 携帯ﾃﾞｰﾀ取得時の不足ﾃﾞｰﾀに対する処理方法変更
# 2005.05.24 v.5.01.00 DoCoMo絵文字ｶﾗｰ化、DoCoMo拡張絵文字処理適正化、au絵文字ﾌｫｰﾑ表示対応化
# 2005.06.13 v.5.01.01 au固定絵文字表示不具合修正
# 2005.07.28 v.5.01.02 DoCoMo絵文字Unicode記述対応不具合修正
# 2005.08.18 v.5.01.03 DoCoMo絵文字Unicode記述処理不具合修正
# 2005.09.23 v.6.00.00 ｸﾗｽﾗｲﾌﾞﾗﾘ化
# 2005.11.08 v.6.00.03 文字ｺｰﾄﾞ扱い不具合修正
# 2006.02.02 v.6.01.00 ﾒｰﾙ対応
# 2006.02.14 v.6.01.01 旧ｴﾝｺｰﾄﾞﾃﾞｰﾀ対応追加
# 2006.02.14 v.6.01.02 指定ｷｬﾘｱ強制変換機能追加
# 2006.02.15 v.6.01.03 携帯無限ﾙｰﾌﾟ不具合修正
# 2006.02.20 v.6.01.04 自動初期化時の機種判別結果の変数渡し追加、au携帯処理不具合修正
# 2006.02.21 v.6.01.05 DoCoMo絵文字ｺｰﾄﾞUnicode扱いﾊﾞｸﾞ修正
# 2006.03.01 v.6.01.06 固定絵文字格納変数ｸﾞﾛｰﾊﾞﾙ変数化
# 2006.03.13 v.6.01.07 Vodafone 3G UTF-8ｺｰﾄﾞ絵文字対応
# 2006.03.18 v.6.01.08 携帯詳細情報取得関数追加
# 2006.04.05 v.6.01.09 ﾃﾞｺｰﾄﾞ状態絵文字削除処理追加
# 2006.05.09 v.6.01.10 絵文字ﾒｰﾙ送信関数不具合修正
# 2006.05.09 v.6.01.11 DoCoMo固体識別番号取得不具合修正
# 2006.05.12 v.6.01.12 PCﾌｫｰﾑ表示不具合暫定対策
# 2006.05.14 v.6.01.13 DoCoMo宛絵文字ﾒｰﾙ変換不具合修正
# 2006.05.15 v.6.01.14 ﾒｰﾙ絵文字変換不具合、ﾒｰﾙ送信関数不具合修正
# 2006.05.18 v.6.01.15 auﾒｰﾙｴﾝｺｰﾄﾞ→ﾃﾞｺｰﾄﾞ不具合修正
# 2006.05.18 v.6.01.16 携帯絵文字変換不具合修正
# 2006.05.29 v.6.01.17 初期化(DoCoMoﾒｰﾙ用ﾃﾞｰﾀﾊｯｼｭ展開)不具合修正
# 2006.06.10 v.6.01.18 ﾒｰﾙ処理不具合(au絵文字ｺｰﾄﾞ誤判定)修正
# 2006.06.12 v.6.01.19 絵文字HTMLﾒｰﾙ送信機能追加
# 2006.06.14 v.6.01.20 Vodafone 3G UTF-8ｺｰﾄﾞ絵文字変換不具合修正
# 2006.06.18 v.6.01.21 絵文字ﾒｰﾙ送信ｺｰﾄﾞ不具合修正
# 2006.08.14 v.6.01.22 Willcomﾌﾗｸﾞ追加、PC HTMLﾒｰﾙ処理不具合修正
# 2006.08.18 v.6.01.23 DoCoMo個体識別番号取得不具合修正
# 2006.08.19 v.6.01.24 絵文字ﾌｫｰﾑ表示不具合修正
# 2006.10.05 v.6.02.00 SoftBank対応,Get_PhoneData関数修正,Get_Hardware関数追加
# 2006.10.18 v.6.02.01 絵文字数ｶｳﾝﾄ不具合修正
# 2006.10.19 v.6.02.02 絵文字ﾒｰﾙ送信関数不具合修正
# 2006.10.22 v.6.02.03 絵文字ﾒｰﾙBASE64ｴﾝｺｰﾄﾞ対応
# 2006.11.13 v.6.02.04 au宛ﾒｰﾙ送信絵文字ｺｰﾄﾞ不具合修正
# 2006.11.22 v.6.02.05 絵文字ﾒｰﾙ送信関数不具合修正
# 2006.11.24 v.6.02.06 絵文字削除関数、下駄変換関数不具合修正
# 2006.11.28 v.6.02.07 ﾊﾞｰｼﾞｮﾝ処理、初期化不具合修正
# 2006.12.26 v.6.02.08 DoCoMo拡張文字ｶﾗｰ処理不具合修正
# 2006.12.27 v.6.02.09 携帯情報取得不具合修正
# 2007.01.09 v.6.02.10 DoCoMo拡張文字ﾌｫｰﾑ表示置換え処理不具合修正
# 2007.01.15 v.6.02.11 DoCoMo拡張文字ﾌｫｰﾑ表示置換え処理不具合修正2
# 2007.01.16 v.6.02.12 DoCoMo拡張文字処理、絵文字削除不具合修正
# 2007.01.16 v.6.02.13 絵文字削除不具合修正2
# 2007.02.09 v.6.02.15 ﾒｰﾙ送信関数ﾌｧｲﾙ添付機能追加
# 2007.02.11 v.6.02.16 ﾒｰﾙ送信関数不具合修正
# 2007.06.24 v.6.02.17 個体識別番号取得関数引渡し変数追加
###############################################################################

###############################################################################
# 値設定 ######################################################################
###############################################################################
# 絵文字設定ﾌｧｲﾙ位置設定 //////////////////////////////////////////////////////
$emj_setting_file = "./data/setting.cgi";

###############################################################################
# 値設定ｺｺまで ################################################################
###############################################################################

# ｵﾌﾞｼﾞｪｸﾄ生成 ////////////////////////////////////////////////////////////////
# 絵文字変換ﾗｲﾌﾞﾗﾘｵﾌﾞｼﾞｪｸﾄ作成
#if (!isset($set_db_obj)) {
  $emoji_obj = new emoji($emj_setting_file);
#}
# DB処理ｸﾗｽｵﾌﾞｼﾞｪｸﾄ作成
if (isset($set_db_obj)) {
  $db_obj = new emj_db();
} else {
  if (is_object($emoji_obj)) {
    if (isset($emoji_obj->db_flag)) {
      if ($emoji_obj->db_flag == '1') {
        # DB処理ﾗｲﾌﾞﾗﾘ初期化
        $db_obj = new emj_db();
        # ﾃﾞｰﾀﾍﾞｰｽ値設定
        $db_obj->db_set_connection_data(array('dbd'            => $emoji_obj->dbd,
                                              'db_hostname'    => $emoji_obj->db_hostname,
                                              'db_hostport'    => $emoji_obj->db_hostport,
                                              'db_name'        => $emoji_obj->db_name,
                                              'db_username'    => $emoji_obj->db_username,
                                              'db_usrpassword' => $emoji_obj->db_usrpassword
                                              ));
      }
    }
  }
}

# DB指定時初期化自動実行 //////////////////////////////////////////////////////
if (isset($set_db_obj)) {
} else {
  if ($emoji_obj->db_flag == '1') {
    # ﾌｧｲﾙ仕様
    $emoji_obj->_auto_init();
  }
}

# 絵文字処理ｸﾗｽ ///////////////////////////////////////////////////////////////
class emoji {
  # ﾊﾞｰｼﾞｮﾝ設定
  var $ver = 'v.7.02.06';

  #############################################################################
  # ﾒｲﾝｽｸﾘﾌﾟﾄからﾗｲﾌﾞﾗﾘ設定ﾌｧｲﾙへの位置を指定します
  var $settingc_file = "../kemoji/data/setting.cgi";
  #############################################################################

  # ﾃﾞｰﾀﾍﾞｰｽﾌｧｲﾙ設定
  var $emj_path_b;       # 絵文字対応ﾃﾞｰﾀﾍﾞｰｽ
  var $emj_path_d;       # DoCoMo絵文字ﾃﾞｰﾀﾍﾞｰｽ
  var $emj_path_v;       # SoftBank絵文字ﾃﾞｰﾀﾍﾞｰｽ
  var $emj_path_a;       # au絵文字ﾃﾞｰﾀﾍﾞｰｽ
  var $emj_path_am;      # auﾒｰﾙ用絵文字ﾃﾞｰﾀﾍﾞｰｽ
  var $mob_path;         # 携帯情報ﾃﾞｰﾀﾍﾞｰｽ

  var $emj_path;         # 絵文字ﾃﾞｰﾀﾍﾞｰｽ位置設定
  var $emjimg_path;      # 絵文字画像位置設定
  var $emoji_non;        # 未対応絵文字対応
  var $emoji_chr;        # 未対応絵文字潰し文字
  var $fitimg_path;      # 画像変換ｽｸﾘﾌﾟﾄ指定
  var $chr_code;         # ｽｸﾘﾌﾟﾄ扱い文字ｺｰﾄﾞ指定(Shift_JIS,EUC-JP)
  var $emojiset;         # 固定絵文字ﾊﾟﾀｰﾝ指定
  var $init_flag;        # ﾗｲﾌﾞﾗﾘ初期化設定
  var $color_flag;       # DoCoMo絵文字ｶﾗｰ化設定
  var $enc_type;         # ｴﾝｺｰﾄﾞﾀｲﾌﾟ設定
  var $old_enc_flag;     # 旧ｴﾝｺｰﾄﾞﾀｲﾌﾟ処理設定
  var $geta_str;         # 下駄文字設定
  var $htmlarea_flag;    # HTMLArea使用設定
  var $html_mail_flag;   # PC宛HTMLﾒｰﾙ送信設定
  var $cont_trs_enc;     # ﾒｰﾙ送信ｴﾝｺｰﾄﾞ設定

  var $img_onry_flag;    # 画像表示のみﾌﾗｸﾞ
  var $dec_to_code_flag; # DoCoMo,auﾃﾞｺｰﾄﾞ後復元ｺｰﾄﾞ処理ﾌﾗｸﾞ

  var $hard;             # ｷｬﾘｱ判別
  var $hard_k;           # 区分
  var $ez_flag;          # au機種ﾌﾗｸﾞ
  var $cac;              # ｷｬｯｼｭ容量
  var $mheight;          # ﾃﾞｨｽﾌﾟﾚｲ高さ
  var $mwidth;           # ﾃﾞｨｽﾌﾟﾚｲ幅
  var $mcolor;           # 解像度
  var $will_flag;        # Willcomﾌﾗｸﾞ
  var $chg_code_sjis;    # Shift-JISｺｰﾄﾞの扱いｺｰﾄﾞﾀｲﾌﾟ
  var $chg_code_euc;     # EUC-JPｺｰﾄﾞの扱いｺｰﾄﾞﾀｲﾌﾟ

  # 携帯機種情報保存配列初期化
  var $HARD_DATA  = array();  # 端末情報ﾃﾞｰﾀ
  var $PHONE_DATA = array();  # 携帯情報ﾃﾞｰﾀ

  # DoCoMo用配列初期化
  var $DOCOMO_NO_TO_NAME       = array();
  var $DOCOMO_NO_TO_FILE       = array();
  var $DOCOMO_NO_TO_IMG        = array();
  var $DOCOMO_NO_TO_IMG_MAIL   = array();
  var $DOCOMO_SJIS10_TO_NO     = array();
  var $DOCOMO_UTF8_TO_NO       = array();
  var $DOCOMO_UNI_TO_SIS10     = array();
  var $DOCOMO_NO_TO_BIN        = array();
  var $DOCOMO_NO_TO_BIN_UTF8   = array();
  var $DOCOMO_NO_TO_TXT        = array();
  var $DOCOMO_NO_TO_UTXT       = array();
  var $DOCOMO_NO_TO_BIN_COLOR  = array();
  var $DOCOMO_NO_TO_TXT_COLOR  = array();
  var $DOCOMO_NO_TO_UTXT_COLOR = array();

  # SoftBank用配列初期化
  var $SOFT_NO_TO_NAME       = array();
  var $SOFT_NO_TO_FILE       = array();
  var $SOFT_NO_TO_IMG        = array();
  var $SOFT_NO_TO_IMG_MAIL   = array();
  var $SOFT_NO_TO_WEBCODE    = array();
  var $SOFT_WEBCODE_TO_NO    = array();
  var $SOFT3G_DEC_TO_WEBCODE = array();
  var $SOFT3G_DEC_TO_NO      = array();

  # au用配列初期化
  var $AU_NO_TO_NAME     = array();
  var $AU_NO_TO_FILE     = array();
  var $AU_NO_TO_IMG      = array();
  var $AU_NO_TO_IMG_MAIL = array();
  var $AU_NO_TO_SJIS10   = array();
  var $AU_SJIS10_TO_NO   = array();
  var $AU_UTF8_TO_NO     = array();
  var $AU_NO_TO_MAILCODE = array();
  var $AU_NO_TO_BIN      = array();
  var $AU_NO_TO_BIN_UTF8 = array();
  var $AU_NO_TO_BIN_MAIL = array();
  var $AU_NO_TO_TXT      = array();
  var $AU_NO_TO_TXT_WIN  = array();

  # 変換対応配列初期化
  var $DOCOMO_TO_SOFT = array();
  var $DOCOMO_TO_AU   = array();
  var $SOFT_TO_DOCOMO = array();
  var $SOFT_TO_AU     = array();
  var $AU_TO_DOCOMO   = array();
  var $AU_TO_SOFT     = array();

  # ｴﾝｺｰﾄﾞ/ﾃﾞｺｰﾄﾞ用配列初期化
  var $ENC_TYPE1 = array();   # ｴﾝｺｰﾄﾞﾊﾟﾀｰﾝﾃﾞｰﾀ - ﾀｲﾌﾟ1
  var $ENC_TYPE2 = array();   # ｴﾝｺｰﾄﾞﾊﾟﾀｰﾝﾃﾞｰﾀ - ﾀｲﾌﾟ2
  var $DEC_TYPE1 = array();   # ﾃﾞｺｰﾄﾞﾊﾟﾀｰﾝﾃﾞｰﾀ - ﾀｲﾌﾟ1
  var $DEC_TYPE2 = array();   # ﾃﾞｺｰﾄﾞﾊﾟﾀｰﾝﾃﾞｰﾀ - ﾀｲﾌﾟ2

  # 固定絵文字用配列初期化
  var $FIX_EMJ = array();

  # ﾒｰﾙ送信用配列初期化
  var $MAIL_HASH = array();   # ﾒｰﾙ用置換え絵文字ﾃﾞｰﾀ

  # DB文字変換ﾊﾟﾀｰﾝ設定
  var $save_ptn = '';
  var $read_ptn = '';

  # ﾃﾞｰﾀﾍﾞｰｽｵﾌﾞｼﾞｪｸﾄ
  var $db_obj;

  # ｺﾝｽﾄﾗｸﾀ ///////////////////////////////////////////////////////////////////
  # [引渡し値]
  # 　$setting_file : 設定ﾌｧｲﾙ指定
  # 　$auto_flag    : 自動実行指定(1:ｷｬﾝｾﾙ)
  # [返り値]
  # 　なし
  #////////////////////////////////////////////////////////////////////////////
  function emoji ($setting_file='',$auto_flag='') {
    # 設定ﾌｧｲﾙ設定
    if ($setting_file != '') {
      $this->setting_file = $setting_file;
    } else {
      if ($this->setting_file == '') { $this->setting_file = $settingc_file; }
    }
    # 設定ﾌｧｲﾙ読込み
    if (file_exists($this->setting_file)) {
      $SETTING_DATA = array();
      $SETTING_DATA = file($this->setting_file);
      foreach ($SETTING_DATA as $sdt) {
        if ($sdt == '') { break; }
        list($namedt,$setdt) = explode("\t",$sdt);
        $this->$namedt = $setdt;
      }
      if ($this->geta_str == '') { $this->geta_str = '〓'; }
    } else {
      # 設定ﾌｧｲﾙが見つからない場合
      print 'Emoji Change Library Setting Data File Error.';
      exit();
    }

    # 文字ｺｰﾄﾞ変換設定
    if ($this->db_flag == '1') {
      # ﾃﾞｰﾀﾍﾞｰｽ仕様
      if ($this->db_code == 'SJIS') {
      } elseif ($this->db_code == 'EUC-JP') {
        $this->save_ptn = 'StoE';
        $this->read_ptn = 'EtoS';
      } elseif ($this->db_code == 'UTF-8') {
        $this->save_ptn = 'StoU';
        $this->read_ptn = 'UtoS';
      }
    }

    # ﾃﾞｰﾀﾍﾞｰｽﾌｧｲﾙ設定
    $this->emj_path_b  = $this->emj_path.'/emoji.cgi';         # 絵文字対応ﾃﾞｰﾀﾍﾞｰｽ
    $this->emj_path_d  = $this->emj_path.'/docomo.cgi';        # DoCoMo絵文字ﾃﾞｰﾀﾍﾞｰｽ
    $this->emj_path_v  = $this->emj_path.'/vodafone.cgi';      # SoftBank絵文字ﾃﾞｰﾀﾍﾞｰｽ
    $this->emj_path_a  = $this->emj_path.'/au.cgi';            # au絵文字ﾃﾞｰﾀﾍﾞｰｽ
    $this->emj_path_am = $this->emj_path.'/au_mail.cgi';       # auﾒｰﾙ用絵文字ﾃﾞｰﾀﾍﾞｰｽ
    $this->mob_path    = $this->emj_path.'/mobile.cgi';        # 携帯情報ﾃﾞｰﾀﾍﾞｰｽ

    # 初期化自動実行
    if ($this->db_flag != '1') {
      # ﾌｧｲﾙ仕様
      $this->_auto_init();
    }
  }

  # 絵文字変換ﾗｲﾌﾞﾗﾘ初期化自動実行 ////////////////////////////////////////////
  # ﾗｲﾌﾞﾗﾘ初期化時に自動実行する関数を指定します。
  # [引渡し値]
  # 　なし
  # [返り値]
  # 　なし
  #////////////////////////////////////////////////////////////////////////////
  function _auto_init() {
    # 機種判別、情報取得
    $HARDDATA = $this->Get_Hardware();   # 機種判別,auﾌﾗｸﾞ,ｷｬｯｼｭ,高さ,幅,色数
    # ﾗｲﾌﾞﾗﾘ初期化
    $this->read_emojidata();             # 絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
  }

  # 絵文字変換ﾗｲﾌﾞﾗﾘﾊﾞｰｼﾞｮﾝ取得 ///////////////////////////////////////////////
  # ｷｬﾘｱ判別と機種情報を取得します。(新処理->推奨)
  # [引渡し値]
  # 　なし
  # [返り値]
  # 　$this->ver : ﾗｲﾌﾞﾗﾘﾊﾞｰｼﾞｮﾝ
  #////////////////////////////////////////////////////////////////////////////
  function Get_Emj_Version() {
    return $this->ver;
  }

  # 機種判別・携帯情報取得 ////////////////////////////////////////////////////
  # ｷｬﾘｱ判別と機種情報を取得します。(新処理->推奨)
  # [引渡し値]
  # 　$huag            : ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ指定(指定無しの場合ｱｸｾｽ端末のﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ)
  # 　$career_get_flag : ｷｬﾘｱ識別方法指定(標準3ｷｬﾘｱ識別の場合"3"(ﾃﾞﾌｫﾙﾄ),Willcomも識別の場合"4")
  # [返り値]
  # 　$RETURNDATA['hard']           : ｷｬﾘｱ判別結果(PC,DoCoMo,au,SoftBank or Vodafone,Willcom)
  # 　$RETURNDATA['will_flag']      : Willcom携帯の場合"1"
  # 　$RETURNDATA['tg_flag']        : DoCoMo 3G -> "FOMA",au 3G -> "WIN",SoctBank 3G -> "3G"
  # 　$RETURNDATA['cache_size']     : 携帯ｷｬｯｼｭｻｲｽﾞ(KB)(PCの場合無し)
  # 　$RETURNDATA['display_height'] : 携帯ﾃﾞｨｽﾌﾟﾚｲ高さ(pt)
  # 　$RETURNDATA['display_width']  : 携帯ﾃﾞｨｽﾌﾟﾚｲ幅(pt)
  # 　$RETURNDATA['display_color']  : 携帯ﾃﾞｨｽﾌﾟﾚｲ表示色数
  #////////////////////////////////////////////////////////////////////////////
  function Get_Hardware($huag='',$career_get_flag='3') {
    if ($huag == '') { $huag = $_SERVER['HTTP_USER_AGENT']; }
    $hard       = 'PC';
    $tg_flag    = '';
    $will_flag  = 0;
    $user_agent = explode('/', $huag);
    if (preg_match('/KDDI/',$user_agent[0])) {
      # au
      $hard    = 'au';
      $tg_flag = 'WIN';
    } elseif ($user_agent[0] == 'DoCoMo') {
      # DoCoMo
      $hard    = 'DoCoMo';
      if ($user_agent[1] == '2.0') { $tg_flag = 'FOMA'; }
    } elseif ($user_agent[0] == 'L-mode') {
      # Lﾓｰﾄﾞ
      $hard    = 'DoCoMo';
    } elseif ($user_agent[0] == 'ASTEL') {
      # ASTEL
      $hard    = 'DoCoMo';
    } elseif ($user_agent[0] == 'UP.Browser') {
      # au(旧機種)
      $hard    = 'au';
    } elseif (($user_agent[0] == 'DDIPOCKET') or ($user_agent[0] == 'PDXGW')) {
      # PDXGW(Willcom)
      if ($career_get_flag == '4') {
        $hard  = 'DoCoMo';
      } else {
        $hard  = 'Willcom';
      }
      $will_flag = 1;
    } elseif (preg_match("/(J-PHONE)|(Vodafone)|(MOT)/",$user_agent[0]) or ($user_agent[0] == 'SoftBank')) {
      # Vodafone,SoftBank
      $hard    = $this->softbank_name;
      if (preg_match('/(Vodafone)|(MOT)/',$user_agent[0]) or ($user_agent[0] == 'SoftBank')) { $tg_flag = '3G'; }
    } else {
      $hard    = 'PC';
    }

    # 機種情報取得
    $cache_size_s     = '';
    $display_height_s = '';
    $display_width_s  = '';
    $display_color_s  = '';
    $PHONEDATA = array();
    if ($hard != 'PC') { $PHONEDATA = $this->Get_PhoneData(); }

    # 携帯個体識別番号取得
    $career = '';
    $model  = '';
    $devid  = '';
    $ser    = '';
    $icc    = '';
    $SER_RETDATA = array();
    if ($hard != 'PC') { $SER_RETDATA = $this->get_ser_no($huag); }

    # 返り値設定
    $RETURNDATA = array();
    $RETURNDATA['hard']           = '';
    $RETURNDATA['will_flag']      = '';
    $RETURNDATA['tg_flag']        = '';
    $RETURNDATA['cache_size']     = '';
    $RETURNDATA['display_height'] = '';
    $RETURNDATA['display_width']  = '';
    $RETURNDATA['display_color']  = '';
    $RETURNDATA['model']          = '';
    $RETURNDATA['devid']          = '';
    $RETURNDATA['ser']            = '';
    $RETURNDATA['icc']            = '';
    if (isset($hard))                        { $RETURNDATA['hard']           = $hard; }
    if (isset($will_flag))                   { $RETURNDATA['will_flag']      = $will_flag; }
    if (isset($tg_flag))                     { $RETURNDATA['tg_flag']        = $tg_flag; }
    if (isset($PHONEDATA['cache_size']))     { $RETURNDATA['cache_size']     = $PHONEDATA['cache_size']; }
    if (isset($PHONEDATA['display_height'])) { $RETURNDATA['display_height'] = $PHONEDATA['display_height']; }
    if (isset($PHONEDATA['display_width']))  { $RETURNDATA['display_width']  = $PHONEDATA['display_width']; }
    if (isset($PHONEDATA['display_color']))  { $RETURNDATA['display_color']  = $PHONEDATA['display_color']; }
    if (isset($SER_RETDATA['model']))        { $RETURNDATA['model']          = $SER_RETDATA['model']; }
    if (isset($SER_RETDATA['devid']))        { $RETURNDATA['devid']          = $SER_RETDATA['devid']; }
    if (isset($SER_RETDATA['ser']))          { $RETURNDATA['ser']            = $SER_RETDATA['ser']; }
    if (isset($SER_RETDATA['icc']))          { $RETURNDATA['icc']            = $SER_RETDATA['icc']; }

    # ﾗｲﾌﾞﾗﾘ値設定
    $this->HARD_DATA           = array();
    $this->PHONE_DATA          = array();
    $this->PHONE_DATA['model'] = '';
    $this->PHONE_DATA['devid'] = '';
    $this->PHONE_DATA['ser']   = '';
    $this->PHONE_DATA['icc']   = '';
    if (is_array($RETURNDATA))        { $this->HARD_DATA           = $RETURNDATA; }
    if (is_array($PHONEDATA))         { $this->PHONE_DATA          = $PHONEDATA; }
    if (isset($SER_RETDATA['model'])) { $this->PHONE_DATA['model'] = $SER_RETDATA['model']; }
    if (isset($SER_RETDATA['devid'])) { $this->PHONE_DATA['devid'] = $SER_RETDATA['devid']; }
    if (isset($SER_RETDATA['ser']))   { $this->PHONE_DATA['ser']   = $SER_RETDATA['ser']; }
    if (isset($SER_RETDATA['icc']))   { $this->PHONE_DATA['icc']   = $SER_RETDATA['icc']; }

    return $RETURNDATA;
  }

  # ﾒｰﾙｱﾄﾞﾚｽｷｬﾘｱ解析 //////////////////////////////////////////////////////////
  # ﾒｰﾙｱﾄﾞﾚｽよりｷｬﾘｱ情報を取得します
  # [引渡し値]
  # 　$mail_address : ﾒｰﾙｱﾄﾞﾚｽ
  # [返り値]
  # 　$career : ｷｬﾘｱ判別結果(DoCoMo,au,SoftBank or Vodafone)
  #////////////////////////////////////////////////////////////////////////////
  function get_mail_career($mail_address) {
    $career = '';
    if (preg_match('/^(.+?)\@(.*)docomo(.+)$/',$mail_address)) {
      # DoCoMo携帯
      $career = 'DoCoMo';
    } elseif (preg_match('/^(.+?)\@(.*)vodafone(.+)$/',$mail_address) or preg_match('/^(.+?)\@softbank(.+)$/',$mail_address)) {
      # SoftBank(Vodafone)携帯
      $career = $this->softbank_name;
    } elseif (preg_match('/^(.+?)\@(.*)ezweb(.+)$/',$mail_address)) {
      # au携帯
      $career = 'au';
    } else {
      # その他
      $career = 'PC';
    }
    return $career;
  }

  # 機種名・固体識別番号取得 //////////////////////////////////////////////////
  # 携帯の機種名と個体識別番号を取得します。
  # [引渡し値]
  # 　$user_agent : ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ指定(指定無しの場合ｱｸｾｽ端末のﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ)
  # [返り値]
  # 　$RETURNDATA['career'] : ｷｬﾘｱ(DoCoMo,au,SoftBank or Vodafone)
  # 　$RETURNDATA['model']  : 機種名
  # 　$RETURNDATA['devid']  : ﾃﾞﾊﾞｲｽID
  # 　$RETURNDATA['ser']    : 個体識別番号(ｻﾌﾞｽｸﾗｲﾊﾞID)
  # 　$RETURNDATA['icc']    : FOMAカード個体識別子
  #////////////////////////////////////////////////////////////////////////////
  function get_ser_no($user_agent='') {
    $career = '';
    $model  = '';
    $devid  = '';
    $ser    = '';
    $icc    = '';
    # ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ設定
    if ($user_agent == '') {
      $user_agent = explode('/',$_SERVER['HTTP_USER_AGENT']);
    }
    # 機種名、個体識別番号取得
    if ($user_agent[0] == 'DoCoMo') {
      # DoCoMo
      if (preg_match('/^1\..$/', $user_agent[1])) {
        # ﾌﾞﾗｳｻﾞﾊﾞｰｼﾞｮﾝ 1.0
        $model = $user_agent[2];
        $devid = '';
        if (preg_match('/^ser(.+)/',$user_agent[4],$MATCH)) { $ser   = $MATCH[1]; }
        $icc   = '';
#      } elseif (preg_match('/^2\..\s(.+?)\(c.*?;ser(.+?)[\s;]icc(.+?)\)/', $user_agent[1],$MATCH)) {
      } elseif (preg_match('/^2\..\s/', $user_agent[1],$MATCH)) {
        # ﾌﾞﾗｳｻﾞﾊﾞｰｼﾞｮﾝ 2.0(FOMA)
        if (preg_match('/^2\..\s(.+?)\(/', $user_agent[1],$MATCH)) { $model = $MATCH[1]; }
        if (preg_match('/ser(.+?)[\s;]/' , $user_agent[1],$MATCH)) { $ser   = $MATCH[1]; }
        if (preg_match('/icc(.+?)\)/'    , $user_agent[1],$MATCH)) { $icc   = $MATCH[1]; }
      }
      $career  = 'DoCoMo';
    } elseif (preg_match('/KDDI/',$user_agent[0]) or ($user_agent[0] == 'UP.Browser')) {
      # au(旧機種)
      $model = '';
      if ($user_agent[0] == 'UP.Browser') {
        $devid = preg_replace('/(.+?)-(.+)/','\\2',$user_agent[1]);
      } elseif (preg_match('/KDDI/',$user_agent[1])) {
        $devid = preg_replace('/^KDDI-(.+?)\sUP(.+)/','\\1',$user_agent[0]);
      }
      $ser   = preg_replace('/^(.+?)_t.+/','\\1',$_SERVER['HTTP_X_UP_SUBNO']);
      $icc   = '';
      $career  = 'au';
    } elseif (preg_match('/(J-PHONE)|(Vodafone)|(MOT)|(SoftBank)/',$user_agent[0])) {
      # Vodafone,SoftBank
      $model = preg_replace('/^(.+?)[\s_]*/','\\1',$_SERVER['HTTP_X_JPHONE_MSNAME']);
      if ($model == '') {
        if (preg_match('/SoftBank/',$user_agent[0])) {
          $model = $user_agent[2];
        } else {
          $model = preg_replace('/^(.+?)\s*/','\\1',$user_agent[2]);
        }
      }
      if (preg_match('/J-PHONE/',$user_agent[0])) {
        # 'J-PHONE'ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ
        if (preg_match('/^SN(.+?)\s.+$/',$user_agent[3],$MATCH)) { $ser = $MATCH[1]; }
      } elseif (preg_match('/Vodafone/',$user_agent[0]) or preg_match('/SoftBank/',$user_agent[0])) {
        # 'Vodafone','SoftBank'ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ
        if (preg_match('/^SN(.+?)\s.+$/',$user_agent[4],$MATCH)) { $ser = $MATCH[1]; }
      } elseif (preg_match('/MOT/',$user_agent[0])) {
        $ser = '';
      }
      $devid = '';
      $icc = '';
      $career  = $this->softbank_name;
    } else {
      $career = 'PC';
      $model  = $user_agent[0].' '.$user_agent[1];
      $devid  = '';
      $ser    = '';
      $icc    = '';
    }
    # 返り値設定
    $RETURNDATA = array();
    $RETURNDATA['career'] = $career;
    $RETURNDATA['model']  = $model;
    $RETURNDATA['devid']  = $devid;
    $RETURNDATA['ser']    = $ser;
    $RETURNDATA['icc']    = $icc;
    return $RETURNDATA;
  }

  # ﾗｲﾌﾞﾗﾘ初期化 //////////////////////////////////////////////////////////////
  # ﾗｲﾌﾞﾗﾘを初期化します。
  # [引渡し値]
  # 　なし
  # [返り値]
  # 　なし
  #////////////////////////////////////////////////////////////////////////////
  function read_emojidata() {

    # 基本ﾃﾞｰﾀﾍﾞｰｽ読込み
    $EMJDATA_BASE   = array();
    $EMJDATA_DOCOMO = array();
    $EMJDATA_SOFT   = array();
    $EMJDATA_AU     = array();

    if ($this->db_flag == '1') {
      # ﾃﾞｰﾀﾍﾞｰｽ使用
      # DB接続
      $GLOBALS['db_obj']->db_connect();
      # 絵文字変換対応ﾃﾞｰﾀﾍﾞｰｽ読込み
      $sql = "SELECT * FROM emj_emoji ORDER BY Base_emj_id";
      $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$this->save_ptn);
      while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$this->read_ptn)) {
        $EMJDATA_BASE[] = $GETDATA['Base_emj_id']."\t".$GETDATA['script_code']."\t".$GETDATA['DoCoMo_no']."\t".$GETDATA['SoftBank_no']."\t".$GETDATA['au_no']."\t".$GETDATA['yusen_no']."\t";
      }
      # DoCoMo絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      $sql = "SELECT * FROM emj_DoCoMo ORDER BY DoCoMo_emj_id";
      $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$this->save_ptn);
      while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$this->read_ptn)) {
        $EMJDATA_DOCOMO[] = $GETDATA['DoCoMo_emj_id']."\t".$GETDATA['emj_name']."\t".$GETDATA['emj_file']."\t".$GETDATA['sjis16']."\t".$GETDATA['sjis10']."\t".$GETDATA['web_code']."\t".$GETDATA['unicode']."\t".$GETDATA['color']."\t\n";
      }
      # au絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      $sql = "SELECT * FROM emj_au ORDER BY au_emj_id";
      $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$this->save_ptn);
      while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$this->read_ptn)) {
        $EMJDATA_AU[] = $GETDATA['au_emj_id']."\t".$GETDATA['emj_name']."\t".$GETDATA['emj_file']."\t".$GETDATA['sjis16']."\t".$GETDATA['sjis10']."\t".$GETDATA['web_code']."\t".$GETDATA['unicode']."\t".$GETDATA['mail_code']."\t".$GETDATA['mail_code']."\t\n";
      }
      # au絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      $sql = "SELECT * FROM emj_SoftBank ORDER BY SoftBank_emj_id";
      $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$this->save_ptn);
      while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$this->read_ptn)) {
        $EMJDATA_SOFT[] = $GETDATA['SoftBank_emj_id']."\t".$GETDATA['emj_name']."\t".$GETDATA['emj_file']."\t".$GETDATA['sjis16']."\t".$GETDATA['mail_code']."\t".$GETDATA['web_code']."\t".$GETDATA['unicode']."\t".$GETDATA['utf_8']."\t\n";
      }
      # DB切断
#      $GLOBALS['db_obj']->db_disconnect();
    } else {
      # ﾌｧｲﾙﾃﾞｰﾀﾍﾞｰｽ使用
      # 絵文字変換対応ﾃﾞｰﾀﾍﾞｰｽ読込み
      if (file_exists($this->emj_path_b)) {
        if (!$EMJDATA_BASE = @file($this->emj_path_b)) {
          print 'Emoji DataBase File Read Error.';
          exit();
        }
      } else {
        print 'Emoji DataBase File Read Error.';
        exit();
      }
      # DoCoMo絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      if (file_exists($this->emj_path_d)) {
        if (!$EMJDATA_DOCOMO = @file($this->emj_path_d)) {
          print 'DoCoMo Emoji DataBase File Read Error.';
          exit();
        }
      } else {
        print 'DoCoMo Emoji DataBase File Read Error.';
        exit();
      }
      # SoftBank絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      if (file_exists($this->emj_path_v)) {
        if (!$EMJDATA_SOFT = file($this->emj_path_v)) {
          print 'SoftBank Emoji DataBase File Read Error.';
          exit();
        }
      } else {
        print 'SoftBank Emoji DataBase File Read Error.';
        exit();
      }
      # au絵文字ﾃﾞｰﾀﾍﾞｰｽ読込み
      if (file_exists($this->emj_path_a)) {
        if (!$EMJDATA_AU = file($this->emj_path_a)) {
          print 'au Emoji DataBase File Read Error.';
          exit();
        }
      } else {
        print 'au Emoji DataBase File Read Error.';
        exit();
      }
      # ﾗﾍﾞﾙ削除
      array_shift($EMJDATA_DOCOMO);
      array_shift($EMJDATA_SOFT);
      array_shift($EMJDATA_AU);
      # 絵文字変換対応ﾃﾞｰﾀﾍﾞｰｽﾊﾞｰｼﾞｮﾝ取得
      $e_ver = $EMJDATA_BASE[0];
      if ($e_ver != '') { array_splice($EMJDATA_BASE,0,2); }
    }

    # DoCoMo用絵文字ﾃﾞｰﾀ配列展開
    foreach ($EMJDATA_DOCOMO as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$color,$eutf8) = explode("\t",$edt);
        if (isset($eutf8)) {
          if (preg_match('/^[0-9a-fA-F]{6}$/',$eutf8)) {
            $utf8c = substr($eutf8,2);
          }
        }
        # 絵文字名設定
        $this->DOCOMO_NO_TO_NAME[$eno]  = $ename;
        # 絵文字画像ﾌｧｲﾙ設定
        $this->DOCOMO_NO_TO_FILE[$eno]  = $efile;
        # 絵文字画像表示設定
        $img_opt = '';
        if ($this->img_title_flag == '1') { $img_opt .= ' title="'.$ename.'"'; }
        if ($this->img_alt_flag   == '1') { $img_opt .= ' alt="'.$ename.'"'; }
        if ($this->fitimg_path) {
          # Fitimg使用する場合
          $this->DOCOMO_NO_TO_IMG[$eno]      = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center"'.$img_opt.'>';
          $this->DOCOMO_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center">';
        } else {
          # Fitimg使用しない場合
          $this->DOCOMO_NO_TO_IMG[$eno]      = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center"'.$img_opt.'>';
          $this->DOCOMO_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center">';
        }
        $this->DOCOMO_SJIS10_TO_NO[$esjis10] = $eno;
        if (isset($utf8c)) {
          $decdt = hexdec($utf8c);
          $this->DOCOMO_UTF8_TO_NO[$decdt]   = $eno;
        } else {
          $this->DOCOMO_UTF8_TO_NO[0]        = '';
        }
        $this->DOCOMO_UNI_TO_SIS10[$euni]    = $esjis10;
        # ﾊﾞｲﾅﾘｺｰﾄﾞ設定
        $this->DOCOMO_NO_TO_BIN[$eno]        = pack("H4",$esjis16);
        if (isset($eutf8)) {
          if (preg_match('/^[0-9a-fA-F]{6}$/',$eutf8)) {
            $this->DOCOMO_NO_TO_BIN_UTF8[$eno] = pack("H6",$eutf8);
          }
        }
        # ﾃｷｽﾄｺｰﾄﾞ設定
        if ($eno < 1000) {
          # SJIS(基本絵文字)
          $this->DOCOMO_NO_TO_TXT[$eno]      = '&#'.$esjis10.';';
        } else {
          # Unicode(拡張絵文字)
          $this->DOCOMO_NO_TO_TXT[$eno]      = '&#x'.$euni.';';
        }
        $this->DOCOMO_NO_TO_UTXT[$eno]      = '&#x'.$euni.';';
        # ｶﾗｰ設定
        if (($this->color_flag == 1) and preg_match('/#[0-9a-fA-F]{6}/',$color)) {
          # ｶﾗｰ指定あり
          $this->DOCOMO_NO_TO_BIN_COLOR[$eno]  = '<font color="'.$color.'">'.$this->DOCOMO_NO_TO_BIN[$eno].'</font>';
          $this->DOCOMO_NO_TO_TXT_COLOR[$eno]  = '<font color="'.$color.'">'.$this->DOCOMO_NO_TO_TXT[$eno].'</font>';
          $this->DOCOMO_NO_TO_UTXT_COLOR[$eno] = '<font color="'.$color.'">'.$this->DOCOMO_NO_TO_UTXT[$eno].'</font>';
        } else {
          # ｶﾗｰ指定なし
          $this->DOCOMO_NO_TO_BIN_COLOR[$eno]  = $this->DOCOMO_NO_TO_BIN[$eno];
          $this->DOCOMO_NO_TO_TXT_COLOR[$eno]  = $this->DOCOMO_NO_TO_TXT[$eno];
          $this->DOCOMO_NO_TO_UTXT_COLOR[$eno] = $this->DOCOMO_NO_TO_UTXT[$eno];
        }
        # ｴﾝｺｰﾄﾞ展開
        # ﾃｷｽﾄｺｰﾄﾞ展開(SJISｷｰ)
        $this->ENC_TYPE1[$esjis10] = '{emj_d_'.$eno.'}';
        $this->ENC_TYPE2[$esjis10] = '{d'.$eno.'}';
        # ﾃｷｽﾄｺｰﾄﾞ展開(Unicodeｷｰ)
        $this->ENC_TYPE1[$euni]    = '{emj_d_'.$eno.'}';
        $this->ENC_TYPE2[$euni]    = '{d'.$eno.'}';
        # ﾊﾞｲﾅﾘ展開
        $this->ENC_TYPE1[$this->DOCOMO_NO_TO_BIN[$eno]] = '{emj_d_'.$eno.'}';
        $this->ENC_TYPE2[$this->DOCOMO_NO_TO_BIN[$eno]] = '{d'.$eno.'}';
        if (isset($this->DOCOMO_NO_TO_BIN_UTF8[$eno])) {
          if ($this->DOCOMO_NO_TO_BIN_UTF8[$eno] != '') {
            $this->ENC_TYPE1[$this->DOCOMO_NO_TO_BIN_UTF8[$eno]] = '{emj_d_'.$eno.'}';
            $this->ENC_TYPE2[$this->DOCOMO_NO_TO_BIN_UTF8[$eno]] = '{d'.$eno.'}';
          }
        }
      }
    }
    # SoftBank用絵文字ﾃﾞｰﾀ配列展開
    foreach ($EMJDATA_SOFT as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$emailcd,$eweb,$euni,$eutf8) = explode("\t",$edt);
        # 絵文字名設定
        $this->SOFT_NO_TO_NAME[$eno]  = $ename;
        # 絵文字画像ﾌｧｲﾙ設定
        $this->SOFT_NO_TO_FILE[$eno]  = $efile;
        # 絵文字画像表示設定
        $img_opt = '';
        if ($this->img_title_flag == '1') { $img_opt .= ' title="'.$ename.'"'; }
        if ($this->img_alt_flag   == '1') { $img_opt .= ' alt="'.$ename.'"'; }
        if ($this->fitimg_path) {
          # Fitimg使用する場合
          $this->SOFT_NO_TO_IMG[$eno]      = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center"'.$img_opt.'>';
          $this->SOFT_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center">';
        } else {
          # Fitimg使用しない場合
          $this->SOFT_NO_TO_IMG[$eno]      = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center"'.$img_opt.'>';
          $this->SOFT_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center">';
        }
        $this->SOFT_NO_TO_WEBCODE[$eno]     = $eweb;
        $this->SOFT_WEBCODE_TO_NO[$eweb]    = $eno;
        $decdt = hexdec(substr($eutf8,2));
        $this->SOFT3G_DEC_TO_WEBCODE[$decdt] = $eweb;
        $this->SOFT3G_DEC_TO_NO[$decdt]      = $eno;
        # ｴﾝｺｰﾄﾞ用展開
        $this->ENC_TYPE1[$eweb] = '{emj_v_'.$eno.'}';
        $this->ENC_TYPE2[$eweb] = '{v'.$eno.'}';
      }
    }
    # au用絵文字ﾃﾞｰﾀ配列展開
    foreach ($EMJDATA_AU as $edt) {
      if ($edt != '') {
        list($eno,$ename,$efile,$esjis16,$esjis10,$eweb,$euni,$esjis16m,$eutf8) = explode("\t",$edt);
        if (isset($eutf8)) {
          if (preg_match('/^[0-9a-fA-F]{6}$/',$eutf8)) {
            $utf8c = substr($eutf8,2);
          }
        }
        # 絵文字名設定
        $this->AU_NO_TO_NAME[$eno] = $ename;
        # 絵文字画像ﾌｧｲﾙ設定
        $this->AU_NO_TO_FILE[$eno] = $efile;
        # 絵文字画像表示設定
        $img_opt = '';
        if ($this->img_title_flag == '1') { $img_opt .= ' title="'.$ename.'"'; }
        if ($this->img_alt_flag   == '1') { $img_opt .= ' alt="'.$ename.'"'; }
        if ($this->fitimg_path) {
          # Fitimg使用する場合
          $this->AU_NO_TO_IMG[$eno]      = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center"'.$img_opt.'>';
          $this->AU_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->fitimg_path.'/fitimg.php?file='.$this->emjimg_path.'/'.$efile.'&w='.$this->fitimg_size.'" border="0" align="center">';
        } else {
          # Fitimg使用しない場合
          $this->AU_NO_TO_IMG[$eno]      = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center"'.$img_opt.'>';
          $this->AU_NO_TO_IMG_MAIL[$eno] = '<img src="'.$this->emjimg_path.'/'.$efile.'" border="0" align="center">';
        }
        $this->AU_NO_TO_SJIS10[$eno]     = $esjis10;
        $this->AU_SJIS10_TO_NO[$esjis10] = $eno;
        $this->AU_NO_TO_MAILCODE[$eno]   = hexdec($esjis16m);
        $this->AU_SJIS10_TO_NO[$this->AU_NO_TO_MAILCODE[$eno]] = $eno;
        if (isset($utf8c)) {
          if ($utf8c != '') {
            $decdt = hexdec($utf8c);
            $this->AU_UTF8_TO_NO[$decdt] = $eno;
          }
        }
        # ﾊﾞｲﾅﾘｺｰﾄﾞ設定
        $this->AU_NO_TO_BIN[$eno]        = pack("H4",$esjis16);
        if (isset($eutf8)) {
          if (preg_match('/^[0-9a-fA-F]{6}$/',$eutf8)) {
            $this->AU_NO_TO_BIN_UTF8[$eno] = pack("H6",$eutf8);
          }
        }
        $this->AU_NO_TO_BIN_MAIL[$eno]   = pack("H4",$esjis16m);
        # ﾃｷｽﾄｺｰﾄﾞ設定
 #       $this->AU_NO_TO_TXT[$eno]        = '&#'.$esjis10.';';
        $enos = preg_replace('/^0*/','',$eno);
        $this->AU_NO_TO_TXT_WIN[$eno]    = '<img localsrc="'.$enos.'">';
        $this->AU_NO_TO_TXT[$eno]        = '<IMG ICON="'.$enos.'">';
        # ｴﾝｺｰﾄﾞ展開
        $this->ENC_TYPE1[$esjis10]                  = '{emj_a_'.$eno.'}';
        $this->ENC_TYPE2[$esjis10]                  = '{a'.$eno.'}';
        $this->ENC_TYPE1[$this->AU_NO_TO_BIN[$eno]] = '{emj_a_'.$eno.'}';
        $this->ENC_TYPE2[$this->AU_NO_TO_BIN[$eno]] = '{a'.$eno.'}';
        # ﾒｰﾙｺｰﾄﾞｴﾝｺｰﾄﾞ用展開
        $this->DEC_TYPE1[$this->AU_NO_TO_MAILCODE[$eno]] = '{emj_am_'.$eno.'}';
        $this->DEC_TYPE2[$this->AU_NO_TO_MAILCODE[$eno]] = '{am'.$eno.'}';
        $this->DEC_TYPE1[$this->AU_NO_TO_BIN_MAIL[$eno]] = '{emj_am_'.$eno.'}';
        $this->DEC_TYPE2[$this->AU_NO_TO_BIN_MAIL[$eno]] = '{am'.$eno.'}';
      }
    }

    # 変換対応ﾃﾞｰﾀ準備
    foreach ($EMJDATA_BASE as $edt) {
      if ($edt != '') {
        list($enob,$enameb,$d_nob,$v_nob,$a_nob,$junib) = explode("\t", $edt);
        $this->DOCOMO_TO_SOFT[$d_nob] = $v_nob;
        $this->DOCOMO_TO_AU[$d_nob]   = $a_nob;
        $this->SOFT_TO_DOCOMO[$v_nob] = $d_nob;
        $this->SOFT_TO_AU[$v_nob]     = $a_nob;
        $this->AU_TO_DOCOMO[$a_nob]   = $d_nob;
        $this->AU_TO_SOFT[$a_nob]     = $v_nob;
      }
    }

    # 固定絵文字設定(ｱｸｾｽｷｬﾘｱに応じて設定)
    foreach ($EMJDATA_BASE as $edt) {
      if ($edt != '') {
        list($enob,$enameb,$d_nob,$v_nob,$a_nob,$junib) = explode("\t", $edt);
        if (preg_match('/^pc$/i',$this->HARD_DATA['hard'])) {
          # PC表示時
          $check_flag = False;
          if (($this->emojiset == "DoCoMo") and ($d_nob != '')) {
            # DoCoMo絵文字画像に変換(対応絵文字設定がある場合)
            $this->FIX_EMJ[$enob] = $this->DOCOMO_NO_TO_IMG[$d_nob];
            $check_flag = True;
          } elseif (($this->emojiset == "au") and ($a_nob != '')) {
            # au絵文字画像に変換(対応絵文字設定がある場合)
            $this->FIX_EMJ[$enob] = $this->AU_NO_TO_IMG[$a_nob];
            $check_flag = True;
          } elseif (($this->emojiset == "SoftBank") and ($v_nob != '')) {
            # SoftBank絵文字画像に変換(対応絵文字設定がある場合)
            $this->FIX_EMJ[$enob] = $this->SOFT_NO_TO_IMG[$v_nob];
            $check_flag = True;
          }
          # 対応絵文字設定が無い場合
          if ($check_flag == False) { $this->FIX_EMJ[$enob] = $this->emoji_chr; }
        } elseif (preg_match('/^docomo$/i',$this->HARD_DATA['hard'])) {
          # DoCoMo携帯表示時
          if ($d_nob != '') {
            # 対応絵文字設定がある場合
            if ($this->color_flag == 1) {
              # ｶﾗｰ指定有りの場合
#              $this->FIX_EMJ[$enob] = $this->DOCOMO_NO_TO_BIN_COLOR[$d_nob];
              $this->FIX_EMJ[$enob] = $this->DOCOMO_NO_TO_UTXT_COLOR[$d_nob];
            } else {
              # ｶﾗｰ指定無しの場合
#              $this->FIX_EMJ[$enob] = $this->DOCOMO_NO_TO_BIN[$d_nob];
              $this->FIX_EMJ[$enob] = $this->DOCOMO_NO_TO_UTXT[$d_nob];
            }
          } else {
            # 対応絵文字設定が無い場合
            $this->FIX_EMJ[$enob] = $this->emoji_chr;
          }
        } elseif (preg_match('/^'.$this->softbank_name.'$/i',$this->HARD_DATA['hard'])) {
          # Vodafone,Softbank携帯表示時
          if ($v_nob != '') {
            # 対応絵文字設定がある場合
            $this->FIX_EMJ[$enob] = $this->SOFT_NO_TO_WEBCODE[$v_nob];
          } else {
            # 対応絵文字設定が無い場合
            $this->FIX_EMJ[$enob] = $this->emoji_chr;
          }
        } elseif (preg_match('/^au$/i',$this->HARD_DATA['hard'])) {
          # au携帯表示時
          if ($a_nob != '') {
            # 対応絵文字設定がある場合
            if ($this->HARD_DATA['tg_flag'] == 'WIN') {
              $this->FIX_EMJ[$enob] = $this->AU_NO_TO_TXT_WIN[$a_nob];
            } else {
              $this->FIX_EMJ[$enob] = $this->AU_NO_TO_TXT[$a_nob];
            }
#            $this->FIX_EMJ[$enob] = $this->AU_NO_TO_BIN[$a_nob];
          } else {
            # 対応絵文字設定が無い場合
            $this->FIX_EMJ[$enob] = $this->emoji_chr;
          }
        }
      }
    }

  }

  # ﾘｸｴｽﾄﾃﾞｰﾀ前処理(ｴｽｹｰﾌﾟｺｰﾄﾞ削除,文字変換,絵文字ｴﾝｺｰﾄﾞ) /////////////////
  # ﾘｸｴｽﾄﾃﾞｰﾀの前処理をします。
  # [引渡し値]
  # 　$mode     : ﾘｸｴｽﾄ処理区分を指定
  # 　　　　　　　'p':$_POSTのみ
  # 　　　　　　　'g':$_GETのみ
  # 　　　　　　　'r':$_REQUESTのみ
  # 　　　　　　　'p','g','r'の組合せにより複数指定可能
  # 　$kana     : 文字列変換指定
  # 　　　　　　　指定なし→変換なし
  # 　　　　　　　全角数字→半角数字 'n'
  # 　　　　　　　全角英字→半角英字 'r'
  # 　　　　　　　全角英数字→半角英数字 'a'
  # 　　　　　　　全角ｶﾀｶﾅ→半角ｶﾀｶﾅ 'kv'
  # 　　　　　　　全角英数字ｶﾀｶﾅ→半角英数字ｶﾀｶﾅ 'kva'
  # 　　　　　　　半角数字→全角数字 'N' 
  # 　　　　　　　半角英字→全角英字 'R'
  # 　　　　　　　半角英数字→全角英数字 'A'
  # 　　　　　　　半角ｶﾀｶﾅ→全角ｶﾀｶﾅ 'KV'
  # 　　　　　　　半角英数字ｶﾀｶﾅ→全角英数字ｶﾀｶﾅ 'KVA'
  # 　$out_code : 出力文字ｺｰﾄﾞ指定(ﾃﾞﾌｫﾙﾄ 'Shift_JIS')
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　なし
  #////////////////////////////////////////////////////////////////////////////
  function reqest_data_conv($mode='r',$kana='',$out_code='SJIS',$input_code='') {
    if (($out_code == 'SJIS') and ($out_code != $this->chg_code_sjis)) { $out_code = $this->chg_code_sjis; }
    if (($out_code == 'EUC')  and ($out_code != $this->chg_code_euc))  { $out_code = $this->chg_code_euc; }
    $quote_flag = ini_get('magic_quotes_gpc');
    if (preg_match('/r/',$mode)) {
      $RQT = array();
      $RQT = array_keys($_REQUEST);
      foreach ($RQT as $rdt) {
        if ($_REQUEST[$rdt] != '') {
          # ｴｽｹｰﾌﾟ処理
          if ($quote_flag == '1') { $_REQUEST[$rdt] = stripslashes($_REQUEST[$rdt]); }
          # Vodafon3G UTF-8対応
          $_REQUEST[$rdt] = $this->v3_utf8_sjis($_REQUEST[$rdt]);
          # 絵文字ｴﾝｺｰﾄﾞ
          $_REQUEST[$rdt] = $this->emj_encode($_REQUEST[$rdt],'','',$input_code);
          # ﾃﾞｰﾀｴﾝｺｰﾃﾞｨﾝｸﾞ取得
          $this_code = mb_detect_encoding($_REQUEST[$rdt],'auto');
          # 出力ｺｰﾄﾞ変換
          if ($this_code) {
            if (mb_preferred_mime_name($this_code) != mb_preferred_mime_name($out_code)) { $_REQUEST[$rdt] = @mb_convert_encoding($_REQUEST[$rdt],$out_code,$this_code); }
          }
          # 文字変換
          if ($kana != '') { $_REQUEST[$rdt] = mb_convert_kana($_REQUEST[$rdt],$kana,$out_code); }
        }
      }
    }

    if (preg_match('/g/',$mode)) {
      $RQT = array();
      $RQT = array_keys($_GET);
      foreach ($RQT as $rdt) {
        if ($_GET[$rdt] != '') {
          # ﾃﾞｰﾀｴﾝｺｰﾃﾞｨﾝｸﾞ取得
          $this_code = mb_detect_encoding($_GET[$rdt],'auto');
          # ｴｽｹｰﾌﾟ処理
          if ($quote_flag == '1') { $_GET[$rdt] = stripslashes($_GET[$rdt]); }
          # Vodafon3G UTF-8対応
          $_GET[$rdt] = $this->v3_utf8_sjis($_GET[$rdt]);
          # 絵文字ｴﾝｺｰﾄﾞ
          $_GET[$rdt] = $this->emj_encode($_GET[$rdt],'','',$input_code);
          # 出力ｺｰﾄﾞ変換
          if ($this_code) {
            if (mb_preferred_mime_name($this_code) != mb_preferred_mime_name($out_code)) { $_GET[$rdt] = @mb_convert_encoding($_GET[$rdt],$out_code,$this_code); }
          }
          # 文字変換
          if ($kana != '') { $_GET[$rdt] = mb_convert_kana($_GET[$rdt],$kana,$out_code); }
        }
      }
    }

    if (preg_match('/p/',$mode)) {
      $RQT = array();
      $RQT = array_keys($_POST);
      foreach ($RQT as $rdt) {
        if ($_POST[$rdt] != '') {
          # ﾃﾞｰﾀｴﾝｺｰﾃﾞｨﾝｸﾞ取得
          $this_code = mb_detect_encoding($_POST[$rdt],'auto');
          # ｴｽｹｰﾌﾟ処理
          if ($quote_flag == '1') { $_POST[$rdt] = stripslashes($_POST[$rdt]); }
          # Vodafon3G UTF-8対応
          $_POST[$rdt] = $this->v3_utf8_sjis($_POST[$rdt]);
          # 絵文字ｴﾝｺｰﾄﾞ
          $_POST[$rdt] = $this->emj_encode($_POST[$rdt],'','',$input_code);
          # 出力ｺｰﾄﾞ変換
          if ($this_code) {
            if (mb_preferred_mime_name($this_code) != mb_preferred_mime_name($out_code)) { $_POST[$rdt] = @mb_convert_encoding($_POST[$rdt],$out_code,$this_code); }
          }
          # 文字変換
          if ($kana != '') { $_POST[$rdt] = mb_convert_kana($_POST[$rdt],$kana,$out_code); }
        }
      }
    }

  }

  # 絵文字変換(Web用) /////////////////////////////////////////////////////////
  # 絵文字ｺｰﾄﾞをｱｸｾｽｷｬﾘｱに応じてWeb表示用に絵文字変換して出力します。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$out_code : 変換後出力ｺｰﾄﾞ指定
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr  : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function replace_emoji($textstr,$out_code='',$input_code='') {
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      $textstr = $this->emj_encode($textstr,'',1,$input_code);
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 絵文字ﾃﾞｺｰﾄﾞ
      $TEXTSTR = $this->emj_decode($textstr,'',$out_code,'');
      $textstr = $TEXTSTR['web'];
    }
    return $textstr;
  }

  # 絵文字変換(Web用ｷｬﾘｱ指定) /////////////////////////////////////////////////
  # 絵文字ｺｰﾄﾞを指定ｷｬﾘｱに応じてWeb表示用に絵文字変換して出力します。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$career   : 変換対象ｷｬﾘｱ指定(指定無い場合ｱｸｾｽｷｬﾘｱ,'DoCoMo','au','SoftBank'or'Vodafone')
  # 　$out_code : 変換後出力ｺｰﾄﾞ指定
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr  : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function replace_emoji_career($textstr,$career='DoCoMo',$out_code='',$input_code='') {
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      $textstr = $this->emj_encode($textstr,'',1,$input_code);
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 絵文字ﾃﾞｺｰﾄﾞ
      $TEXTSTR = $this->emj_decode($textstr,$career,$out_code,'');
      $textstr = $TEXTSTR['web'];
    }
    return $textstr;
  }

  # 絵文字変換(ﾒｰﾙ送信用) /////////////////////////////////////////////////////
  # 絵文字ｺｰﾄﾞを指定ｷｬﾘｱに応じてﾒｰﾙ送信用に絵文字変換して出力します。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$out_code : 変換後出力ｺｰﾄﾞ指定
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr  : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function replace_emoji_mail($textstr,$career='PC',$input_code='') {
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      $textstr = $this->emj_encode($textstr,'',1,$input_code);
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 絵文字ﾃﾞｺｰﾄﾞ
      $TEXTSTR = $this->emj_decode($textstr,$career,'JIS','');
      $textstr = $TEXTSTR['mail'];
    }
    return $textstr;
  }

  # 絵文字変換(ﾌｫｰﾑ表示用) ////////////////////////////////////////////////////
  # 絵文字ｺｰﾄﾞをｱｸｾｽｷｬﾘｱに応じてﾌｫｰﾑ表示用に絵文字変換して出力します。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$out_code : 変換後出力ｺｰﾄﾞ指定
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr  : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function replace_emoji_form($textstr,$out_code='',$input_code='') {
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      $textstr = $this->emj_encode($textstr,'',1,$input_code);
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 絵文字ﾃﾞｺｰﾄﾞ
      $TEXTSTR = $this->emj_decode($textstr,$career,$out_code,'');
      $textstr = $TEXTSTR['form'];
    }
    return $textstr;
  }

  # 絵文字ｺｰﾄﾞ削除 ////////////////////////////////////////////////////////////
  # 文字列から絵文字を削除します。
  # [引渡し値]
  # 　$textstr     : 変換対象文字列
  # 　$docomo_flag : DoCoMo絵文字削除(0:削除する,1:削除しない)
  # 　$voda_flag   : SoftBank絵文字削除(0:削除する,1:削除しない)
  # 　$au_flag     : au絵文字削除(0:削除する,1:削除しない)
  # 　$out_code    : 変換後出力ｺｰﾄﾞ指定
  # 　$enc_cancel  : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr     : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function delete_emoji_code($textstr,$docomo_flag='0',$voda_flag='0',$au_flag='0',$out_code='',$enc_cancel='',$input_code='') {
    # 絵文字削除
    $textstr = $this->emoji_str_replace($textstr,'',$docomo_flag,$voda_flag,$au_flag,$out_code,$enc_cancel,$input_code);
    return $textstr;
  }

  # 絵文字ｺｰﾄﾞ下駄変換 ////////////////////////////////////////////////////////
  # 文字列中の絵文字を下駄変換します。
  # [引渡し値]
  # 　$textstr     : 変換対象文字列
  # 　$docomo_flag : DoCoMo絵文字下駄変換(0:変換する,1:変換しない)
  # 　$voda_flag   : SoftBank絵文字下駄変換(0:変換する,1:変換しない)
  # 　$au_flag     : au絵文字下駄変換(0:変換する,1:変換しない)
  # 　$out_code    : 変換後出力ｺｰﾄﾞ指定
  # 　$enc_cancel  : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr     : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function emoji2geta($textstr,$docomo_flag='0',$voda_flag='0',$au_flag='0',$out_code='',$enc_cancel='',$input_code='') {
    # 絵文字下駄変換
    $textstr = $this->emoji_str_replace($textstr,$this->geta_str,$docomo_flag,$voda_flag,$au_flag,$out_code,$enc_cancel,$input_code);
    return $textstr;
  }

  # 絵文字ｺｰﾄﾞ指定ﾃｷｽﾄ変換 ////////////////////////////////////////////////////
  # 文字列中の絵文字を指定の文字列に変換します。
  # [引渡し値]
  # 　$textstr     : 変換対象文字列
  # 　$replace_str : 変換対象文字列
  # 　$docomo_flag : DoCoMo絵文字下駄変換(0:変換する,1:変換しない)
  # 　$voda_flag   : SoftBank絵文字下駄変換(0:変換する,1:変換しない)
  # 　$au_flag     : au絵文字下駄変換(0:変換する,1:変換しない)
  # 　$out_code    : 変換後出力ｺｰﾄﾞ指定
  # 　$enc_cancel  : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code  : 入力文字ｺｰﾄﾞ指定(指定なし:SJIS、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr     : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function emoji_str_replace($textstr,$replace_str,$docomo_flag='0',$voda_flag='0',$au_flag='0',$out_code='',$enc_cancel='',$input_code='') {
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      if ($enc_cancel != '1') { $textstr = $this->emj_encode($textstr,'',1,$input_code); }
      # 変換対象文字列ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 置換え文字列ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($replace_str,'auto');
      if ($de) {
        $replace_str_code = mb_preferred_mime_name($de);
        if ($replace_str_code != mb_preferred_mime_name($this->chg_code_sjis)) { $replace_str = @mb_convert_encoding($replace_str,$this->chg_code_sjis,$text_code); }
      }
      # DoCoMo絵文字置換え
      if ($docomo_flag == '0') {
        $textstr = preg_replace('/{emj_d_(\d+?)}/',$replace_str,$textstr);
        $textstr = preg_replace('/{d(\d+?)}/',$replace_str,$textstr);
      }
      # au絵文字置換え
      if ($au_flag == '0') {
        $textstr = preg_replace('/{emj_a_(\d+?)}/',$replace_str,$textstr);
        $textstr = preg_replace('/{a(\d+?)}/',$replace_str,$textstr);
        $textstr = preg_replace('/{emj_am_(\d+?)}/',$replace_str,$textstr);
        $textstr = preg_replace('/{am(\d+?)}/',$replace_str,$textstr);
      }
      # SoftBank絵文字置換え
      if ($voda_flag == '0') {
        $textstr = preg_replace('/{emj_v_(\d+?)}/',$replace_str,$textstr);
        $textstr = preg_replace('/{v(\d+?)}/',$replace_str,$textstr);
      }
      # ﾃｷｽﾄｺｰﾄﾞ変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        # 出力ｺｰﾄﾞ設定
        if ($out_code == '') { $oc = $this->chr_code; } else { $oc = $out_code; }
        if ($text_code != mb_preferred_mime_name($oc)) {
          # 文字列ｺｰﾄﾞが指定出力ｺｰﾄﾞと異なる場合
          if (mb_preferred_mime_name($oc) != mb_preferred_mime_name($this->chg_code_sjis)) {
            # SJIS指定の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$this->chg_code_sjis);
          } else {
            # SJIS以外の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$text_code);
          }
        }
      }
    } else {
      $textstr = '';
    }
    return $textstr;
  }

  # 文字数ｶｳﾝﾄ ////////////////////////////////////////////////////////////////
  # 文字列の絵文字を加味した文字数をｶｳﾝﾄします。
  # ﾊﾞｲﾅﾘｶｳﾝﾄは絵文字を2ﾊﾞｲﾄとしてｶｳﾝﾄします。
  # [引渡し値]
  # 　$textstr    : ﾁｪｯｸ対象文字列
  # 　$enc_cancel : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$COUNTDATA['mb_strlen']   : 全文字数(ﾏﾙﾁﾊﾞｲﾄも1文字としてｶｳﾝﾄ)
  # 　$COUNTDATA['mb_strwidth'] : 全ﾊﾞｲﾄ数(半角:1,全角:2,絵文字:2)
  # 　$COUNTDATA['total']       : 全絵文字数
  # 　$COUNTDATA['DoCoMo']      : DoCoMo絵文字数
  # 　$COUNTDATA['au']          : au絵文字数
  # 　$COUNTDATA['SoftBank']    : SoftBank絵文字数
  #////////////////////////////////////////////////////////////////////////////
  function emj_check($textstr,$enc_cancel='',$input_code='') {
    $COUNTDATA = array();
    $COUNTDATA['mb_strlen']   = 0;
    $COUNTDATA['mb_strwidth'] = 0;
    $COUNTDATA['total']       = 0;
    $COUNTDATA['DoCoMo']      = 0;
    $COUNTDATA['au']          = 0;
    $COUNTDATA['SoftBank']    = 0;
    if (isset($textstr)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      if ($enc_cancel != '1') { $textstr = $this->emj_encode($textstr,'',1,$input_code); }
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 文字ｶｳﾝﾄ準備
      $textstr_str = $textstr;
      while (preg_match('/\{(emj_._|d|a|am|v)[0-9]{4}\}/',$textstr_str)) {
        $textstr_str = preg_replace('/\{(emj_._|d|a|am|v)[0-9]{4}\}/',"\x82\xA0",$textstr_str);
      }
      # 全文字数ｶｳﾝﾄ
      $COUNTDATA['mb_strlen']   = mb_strlen($textstr_str,'SJIS');
      # 全ﾊﾞｲﾄ数ｶｳﾝﾄ
      $COUNTDATA['mb_strwidth'] = mb_strwidth($textstr_str,'SJIS');
      # DoCoMo絵文字ｶｳﾝﾄ
      while (preg_match('/\{(emj_d_|d)[0-9]{4}\}/', $textstr)) {
        $textstr = preg_replace('/\{(emj_d_|d)[0-9]{4}\}/','',$textstr,1);
        $COUNTDATA['DoCoMo']++;
        $COUNTDATA['total']++;
      }
      # au絵文字ｶｳﾝﾄ
      while (preg_match('/\{(emj_a_|a|emj_am_|am)[0-9]{4}\}/', $textstr)) {
        $textstr = preg_replace('/\{(emj_a_|a|emj_am_|am)[0-9]{4}\}/','',$textstr,1);
        $COUNTDATA['au']++;
        $COUNTDATA['total']++;
      }
      # SoftBank絵文字ｶｳﾝﾄ
      while (preg_match('/\{(v|emj_v_)[0-9]{4}\}/', $textstr)) {
        $textstr = preg_replace('/\{(emj_v_|v)[0-9]{4}\}/','',$textstr,1);
        $COUNTDATA['SoftBank']++;
        $COUNTDATA['total']++;
      }
    }
    return $COUNTDATA;
  }

  # 文字切り詰め //////////////////////////////////////////////////////////////
  # 絵文字を含む文字列を指定した幅に切り詰めます。
  # ※絵文字は2ﾊﾞｲﾄとして処理されます。
  # [引渡し値]
  # 　$textstr    : 処理対象文字列
  # 　$offset     : 開始位置
  # 　$width      : 文字列の幅
  # 　$end_str    : 切り詰めた場合の目印の文字列
  # 　$out_code   : 出力文字ｺｰﾄﾞ
  # 　$enc_cancel : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr    : 指定された幅の文字列
  #////////////////////////////////////////////////////////////////////////////
  function emj_strimwidth($textstr,$offset,$width,$end_str,$out_code='',$enc_cancel='',$input_code='') {
    if (isset($textstr)) {
      $offset = 0;
      # 絵文字ｴﾝｺｰﾄﾞ
      if ($enc_cancel != '1') { $textstr = $this->emj_encode($textstr,'',1,$input_code); }
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 文字処理準備
      $textstr_str = $textstr;
      $LISTUPDT = array();
      while (preg_match('/\{(emj_._|d|a|am|v)([0-9]{4})\}/',$textstr_str,$MATCH)) {
        $LISTUPDT[]  = '{'.$MATCH[1].$MATCH[2].'}';
        $textstr_str = preg_replace('/\{(emj_._|d|a|am|v)([0-9]{4})\}/',"\xEA\x9C",$textstr_str,1);
      }
      # 文字列切り詰め
      $textstr_str = mb_strimwidth($textstr_str,$offset,$width,$end_str);
      # 絵文字戻し
      $loop_no = 0;
      while (preg_match('/\xEA\x9C/',$textstr_str,$MATCH)) {
        $textstr_str = preg_replace('/\xEA\x9C/',$LISTUPDT[$loop_no],$textstr_str,1);
        $loop_no++;
      }
      $textstr = $textstr_str;
      # ﾃｷｽﾄｺｰﾄﾞ変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        # 出力ｺｰﾄﾞ設定
        if ($out_code == '') { $oc = $this->chr_code; } else { $oc = $out_code; }
        if ($text_code != mb_preferred_mime_name($oc)) {
          # 文字列ｺｰﾄﾞが指定出力ｺｰﾄﾞと異なる場合
          if (mb_preferred_mime_name($oc) != mb_preferred_mime_name($this->chg_code_sjis)) {
            # SJIS指定の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$this->chg_code_sjis);
          } else {
            # SJIS以外の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$text_code);
          }
        }
      }
    }
    return $textstr;
  }

  # 絵文字変換 ////////////////////////////////////////////////////////////////
  # 指定の絵文字を別の指定した絵文字に置き換えます。
  # [引渡し値]
  # 　$textstr      : 処理対象文字列
  # 　$original_emj : 元絵文字
  # 　$change_emj   : 変換絵文字
  # 　$out_code     : 出力文字ｺｰﾄﾞ
  # 　$enc_cancel   : 内部ｴﾝｺｰﾄﾞ処理ｷｬﾝｾﾙ指定(1:ｷｬﾝｾﾙ)
  # 　$input_code : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr             : 指定された幅の文字列
  #////////////////////////////////////////////////////////////////////////////
  function emj_change($textstr,$original_emj,$change_emj,$out_code='',$enc_cancel='',$input_code='') {
    if (isset($textstr) and isset($original_emj) and isset($change_emj)) {
      # 絵文字ｴﾝｺｰﾄﾞ
      if ($enc_cancel != '1') { $textstr = $this->emj_encode($textstr,'',1,$input_code); }
      $original_emj = $this->emj_encode($original_emj,'',1,$input_code);
      $change_emj   = $this->emj_encode($change_emj,'',1,$input_code);
      # 絵文字ﾁｪｯｸ
      if (!preg_match('/\{(emj_d_|emj_a_|emj_am_|emj_v_|d|a|am|v)(\d{4})\}/',$original_emj)) { return $textstr; }
      if (!preg_match('/\{(emj_d_|emj_a_|emj_am_|emj_v_|d|a|am|v)(\d{4})\}/',$change_emj))   { return $textstr; }
      # 元絵文字指定分解
      $ORIGINAL = array();
      $original_emj_sub = $original_emj;
      while (preg_match('/\{(emj_d_|emj_a_|emj_am_|emj_v_|d|a|am|v)(\d{4})\}/',$original_emj_sub,$MATCH)) {
        $ORIGINAL[] = '{'.$MATCH[1].$MATCH[2].'}';
        $original_emj_sub = preg_replace('/\{'.$MATCH[1].$MATCH[2].'\}/','',$original_emj_sub,1);
      }
      if (count($ORIGINAL) < 1) { return $textstr; }
      # 変換絵文字指定分解
      $CHANGE = array();
      $change_emj_sub = $change_emj;
      while (preg_match('/\{(emj_d_|emj_a_|emj_am_|emj_v_|d|a|am|v)(\d{4})\}/',$change_emj_sub,$MATCH)) {
        $CHANGE[] = '{'.$MATCH[1].$MATCH[2].'}';
        $change_emj_sub = preg_replace('/\{'.$MATCH[1].$MATCH[2].'\}/','',$change_emj_sub,1);
      }
      if (count($CHANGE) < 1) {
        return $textstr;
      } elseif (count($CHANGE) == 1) {
        $mode = 0;
      } elseif (count($CHANGE) > 1) {
        if ((count($ORIGINAL) != count($CHANGE))) { return $textstr; }
        $mode = 1;
      }
      # ﾃｷｽﾄShift_JIS変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
      }
      # 絵文字変換
      $lpno = 0;
      foreach ($ORIGINAL as $odt) {
        if ($mode == 0) {
          $textstr = preg_replace('/'.$odt.'/',$CHANGE[0],$textstr);
        } elseif ($mode == 1) {
          $textstr = preg_replace('/'.$odt.'/',$CHANGE[$lpno],$textstr);
        }
        $lpno++;
      }
      # ﾃｷｽﾄｺｰﾄﾞ変換
      $de = mb_detect_encoding($textstr,'auto');
      if ($de) {
        $text_code = mb_preferred_mime_name($de);
        # 出力ｺｰﾄﾞ設定
        if ($out_code == '') { $oc = $this->chr_code; } else { $oc = $out_code; }
        if ($text_code != mb_preferred_mime_name($oc)) {
          # 文字列ｺｰﾄﾞが指定出力ｺｰﾄﾞと異なる場合
          if (mb_preferred_mime_name($oc) != mb_preferred_mime_name($this->chg_code_sjis)) {
            # SJIS指定の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$this->chg_code_sjis);
          } else {
            # SJIS以外の場合
            $textstr = @mb_convert_encoding($textstr,$oc,$text_code);
          }
        }
      }
    }
    return $textstr;
  }

  # 絵文字ｺｰﾄﾞｴﾝｺｰﾄﾞ //////////////////////////////////////////////////////////
  # 文字列中の絵文字をｴﾝｺｰﾄﾞします。
  # [引渡し値]
  # 　$textstr     : 変換対象文字列
  # 　$out_code    : 変換後出力ｺｰﾄﾞ指定
  # 　$encode_pass : 文字ｺｰﾄﾞ変換無効化('1')
  # 　$input_code  : 入力文字ｺｰﾄﾞ指定(指定なし:全ｺｰﾄﾞﾁｪｯｸ、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　$textstr     : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function emj_encode($textstr,$out_code='',$encode_pass='',$input_code='') {
    if (isset($textstr)) {
#      # ﾃｷｽﾄShift_JIS変換
#      if ($encode_pass == '') {
#        $de = mb_detect_encoding($textstr,'auto');
#        if ($de) {
#          $text_code = mb_preferred_mime_name($de);
#          if ($text_code != mb_preferred_mime_name($this->chg_code_sjis)) { $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,$text_code); }
#        }
#      }

      # 入力文字ｺｰﾄﾞ設定
      if ($input_code == '') {
        if ($this->chr_code == 'UTF-8') { $input_code = 'UTF-8'; }
      }
      if ($input_code != 'UTF-8') { $input_code = 'SJIS'; }

      # SoftBank絵文字UTF-8ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'UTF-8')) {
        $textstr = $this->_replace_v_emoji_utf8($textstr);
      }
      # SoftBank絵文字ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'SJIS')) {
        $textstr = $this->_replace_v_emoji($textstr);
      }

      # DoCoMo絵文字UTF-8ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'UTF-8')) {
        $textstr = $this->_replace_d_emoji_utf8($textstr);
      }
      # DoCoMo絵文字ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'SJIS')) {
        $textstr = $this->_replace_d_emoji($textstr);
      }

      # au絵文字UTF-8ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'UTF-8')) {
        $textstr = $this->_replace_a_emoji_utf8($textstr);
      }
      # au絵文字ｴﾝｺｰﾄﾞ
      if (($input_code == '') or ($input_code == 'SJIS')) {
        $textstr = $this->_replace_a_emoji($textstr);
      }

      # ﾃｷｽﾄｺｰﾄﾞ変換
      if ($encode_pass == '') {
        $de = mb_detect_encoding($textstr,'auto');
        if ($de) {
          $text_code = mb_preferred_mime_name($de);
          # 出力ｺｰﾄﾞ設定
          if ($out_code == '') { $oc = $this->chr_code; } else { $oc = $out_code; }
          if ($text_code != mb_preferred_mime_name($oc)) {
            # 文字列ｺｰﾄﾞが指定出力ｺｰﾄﾞと異なる場合
            if (mb_preferred_mime_name($oc) != mb_preferred_mime_name($this->chg_code_sjis)) {
              # SJIS指定の場合
              $textstr = @mb_convert_encoding($textstr,$oc,$this->chg_code_sjis);
            } else {
              # SJIS以外の場合
              $textstr = @mb_convert_encoding($textstr,$oc,$text_code);
            }
          }
        }
      }
    } else {
      $textstr = '';
    }
    return $textstr;
  }

  # 絵文字ｺｰﾄﾞﾃﾞｺｰﾄﾞ //////////////////////////////////////////////////////////
  # 文字列中の絵文字をﾃﾞｺｰﾄﾞします。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$career   : 変換対象ｷｬﾘｱ指定(指定無い場合ｱｸｾｽｷｬﾘｱ,'DoCoMo','au','SoftBank'or'Vodafone')
  # 　$out_code : 変換後出力ｺｰﾄﾞ指定
  # 　$img_mode : 画像変換強制指定(1:強制画像変換)
  # [返り値]
  # 　$DECODE_DATA['web']  : 変換後文字列(Web用)
  # 　$DECODE_DATA['form'] : 変換後文字列(Form用)
  # 　$DECODE_DATA['mail'] : 変換後文字列(Mail用)
  # 　$DECODE_DATA['text'] : 変換後文字列(ﾃｷｽﾄｺｰﾄﾞ)
  # 　$DECODE_DATA['bin']  : 変換後文字列(ﾊﾞｲﾅﾘｺｰﾄﾞ)
  #////////////////////////////////////////////////////////////////////////////
  function emj_decode($textstr,$career='',$out_code='',$img_mode='') {
    if ($out_code == '') { $oc = $this->chr_code; } else { $oc = $out_code; }
    $DECODE_DATA = array();
    $DECODE_DATA['web']  = $textstr;
    $DECODE_DATA['form'] = $textstr;
    $DECODE_DATA['mail'] = $textstr;
    $DECODE_DATA['text'] = $textstr;
    $DECODE_DATA['bin']  = $textstr;
    if (isset($textstr)) {
      # 変換先ｷｬﾘｱ設定
      if ($career == '') {
        # 変換先ｷｬﾘｱ指定無し(ｱｸｾｽｷｬﾘｱ変換)
        $set_career = $this->HARD_DATA['hard'];
      } else {
        # 変換先ｷｬﾘｱ指定有り(指定ｷｬﾘｱ変換)
        $set_career = $career;
      }

      # 絵文字ｴﾝｺｰﾄﾞ変換
      $textstr_img = $textstr;
      if (($this->img_onry_flag != '1') and ($img_mode != '1')) {
        # PC又は強制画像変換指定以外について絵文字対応変換
        $textstr = $this->_emj_enc_change($textstr,$set_career);
      }

      # ﾃｷｽﾄｺｰﾄﾞ変換
      $text_code = mb_detect_encoding($textstr,'auto');
      if ($text_code != '') {
        if ($out_code == '') {
          # 出力ｺｰﾄﾞ指定なしの場合(ﾃﾞﾌｫﾙﾄ設定ｺｰﾄﾞ出力)
          if (mb_preferred_mime_name($this->chr_code) != mb_preferred_mime_name($text_code)) {
            $textstr = @mb_convert_encoding($textstr,$this->chr_code,$text_code);
          }
        } else {
          # 出力ｺｰﾄﾞ指定有りの場合
          if (mb_preferred_mime_name($out_code) != mb_preferred_mime_name($text_code)) {
            $textstr = @mb_convert_encoding($textstr,$out_code,$text_code);
          }
        }
      }
      # ﾃｷｽﾄ準備
      $DECODE_DATA['web']  = $textstr;
      $DECODE_DATA['form'] = $textstr;
      $DECODE_DATA['mail'] = $textstr;
      $DECODE_DATA['text'] = $textstr;
      $DECODE_DATA['bin']  = $textstr;
      # ﾙｰﾌﾟ用ﾃｷｽﾄ設定
      $loop_string = $textstr;
      if (preg_match('/^pc$/i',$set_career)) {
        # PC変換時
        while (preg_match('/\{(emj_d_|d|emj_a_|a|emj_am_|am|emj_v_|v)(\d{4})\}/',$loop_string,$PM)) {
          # Web表示用ﾃﾞｺｰﾄﾞ(画像変換)
          # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ(本関数での処理なし)
          if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
            # DoCoMoｴﾝｺｰﾄﾞ
            $set_data = $this->DOCOMO_NO_TO_IMG[$PM[2]];
          } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
            # auｴﾝｺｰﾄﾞ
            $set_data = $this->AU_NO_TO_IMG[$PM[2]];
          } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
            # SoftBankｴﾝｺｰﾄﾞ
            $set_data = $this->SOFT_NO_TO_IMG[$PM[2]];
          }
          $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_data,$DECODE_DATA['web']);
          $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_data,$DECODE_DATA['web']);
          # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ(絵文字ｴﾝｺｰﾄﾞのまま出力)
#          $DECODE_DATA['form'] = $textstr;
          $DECODE_DATA['form'] = $this->form_htmlentities($textstr);
          # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
          if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
            # DoCoMoｴﾝｺｰﾄﾞ
#            $set_data = $this->DOCOMO_NO_TO_TXT[$PM[2]];
            $set_data = $this->DOCOMO_NO_TO_UTXT[$PM[2]];
          } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
            # auｴﾝｺｰﾄﾞ
            $set_data = $this->AU_NO_TO_TXT_WIN[$PM[2]];
          } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
            # SoftBankｴﾝｺｰﾄﾞ
            $set_data = $this->SOFT_NO_TO_WEBCODE[$PM[2]];
          }
          $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_data,$DECODE_DATA['text']);
          # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
          if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
            # DoCoMoｴﾝｺｰﾄﾞ
            $set_data = $this->DOCOMO_NO_TO_BIN[$PM[2]];
          } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
            # auｴﾝｺｰﾄﾞ
            $set_data = $this->AU_NO_TO_BIN[$PM[2]];
          } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
            # SoftBankｴﾝｺｰﾄﾞ
            $set_data = $this->SOFT_NO_TO_WEBCODE[$PM[2]];
          }
          $DECODE_DATA['bin'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_data,$DECODE_DATA['bin']);
          # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
          $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
        }
      } elseif (preg_match('/^docomo$/i',$set_career)) {
        # DoCoMoｷｬﾘｱに対しての絵文字ﾃﾞｺｰﾄﾞ
        while (preg_match('/\{(emj_d_|d)(\d{4})\}/',$loop_string,$PM)) {
          # Web表示用
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            # 強制画像変換指定
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_IMG[$PM[2]],$DECODE_DATA['web']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
#            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_TXT_COLOR[$PM[2]],$DECODE_DATA['web']);
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_UTXT_COLOR[$PM[2]],$DECODE_DATA['web']);
          }
          # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
#          $DECODE_DATA['form'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_TXT[$PM[2]],$DECODE_DATA['form']);
          $DECODE_DATA['form'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_UTXT[$PM[2]],$DECODE_DATA['form']);
          # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_IMG_MAIL[$PM[2]],$DECODE_DATA['mail']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_BIN[$PM[2]],$DECODE_DATA['mail']);
          }
          # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
#          $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_TXT[$PM[2]],$DECODE_DATA['text']);
          $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_UTXT[$PM[2]],$DECODE_DATA['text']);
          # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
          if ($oc == 'UTF-8') {
            $DECODE_DATA['bin']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_BIN_UTF8[$PM[2]],$DECODE_DATA['bin']);
          } else {
            $DECODE_DATA['bin']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->DOCOMO_NO_TO_BIN[$PM[2]],$DECODE_DATA['bin']);
          }
          # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
          $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
        }
        if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
          # 強制画像変換指定
          while (preg_match('/\{(emj_a_|a|emj_am_|am|emj_v_|v)(\d{4})\}/',$loop_string,$PM)) {
            if (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
              $set_text      = $this->AU_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->AU_NO_TO_IMG_MAIL[$PM[2]];
            } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
              $set_text      = $this->SOFT_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->SOFT_NO_TO_IMG_MAIL[$PM[2]];
            }
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text,$DECODE_DATA['web']);
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text_mail,$DECODE_DATA['mail']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
          }
        } else {
          # 未対応文字が存在する場合
          while (preg_match('/#(emj_a_|a|emj_am_|am|emj_v_|v)(\d{4})#/',$loop_string,$PM)) {
            if ($this->emoji_non == 0) {
              # 文字列で潰して表示
              $set_text = $this->emoji_chr;
            } elseif ($this->emoji_non == 1) {
              # 説明文で表示
              if (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
                $set_text = $this->AU_NO_TO_NAME[$PM[2]];
              } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
                $set_text = $this->SOFT_NO_TO_NAME[$PM[2]];
              }
            } elseif ($this->emoji_non == 2) {
              # 画像で表示
              if (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
                $set_text = $this->AU_NO_TO_IMG[$PM[2]];
              } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
                $set_text = $this->SOFT_NO_TO_IMG[$PM[2]];
              }
            }
            # Web表示用
            $DECODE_DATA['web']  = preg_replace('|#'.$PM[1].$PM[2].'#|',$set_text,$DECODE_DATA['web']);
            # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['form'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['form']);
            # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['mail'] = preg_replace('|#'.$PM[1].$PM[2].'#|',$this->emoji_chr,$DECODE_DATA['mail']);
            # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
            $DECODE_DATA['text'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['text']);
            # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
            $DECODE_DATA['bin']  = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['bin']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|#'.$PM[1].$PM[2].'#|','',$loop_string);
          }
        }
      } elseif (preg_match('/^au$/i',$set_career)) {
        # auｷｬﾘｱに対しての絵文字ﾃﾞｺｰﾄﾞ
        while (preg_match('/\{(emj_a_|a|emj_am_|am)(\d{4})\}/',$loop_string,$PM)) {
          # Web表示用
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            # 強制画像変換指定
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_IMG[$PM[2]],$DECODE_DATA['web']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
            if ($career == '') {
              # ｱｸｾｽｷｬﾘｱ変換の場合
              if ($this->HARD_DATA['tg_flag'] == 'WIN') {
                $set_data = $this->AU_NO_TO_TXT_WIN[$PM[2]];
              } else {
                $set_data = $this->AU_NO_TO_TXT[$PM[2]];
              }
#              $set_data = $this->AU_NO_TO_BIN[$PM[2]];
            } else {
              # 変換ｷｬﾘｱ指定の場合(WIN用に変換)
              $set_data = $this->AU_NO_TO_TXT_WIN[$PM[2]];
            }
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_data,$DECODE_DATA['web']);
          }
          # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
          if ($oc == 'UTF-8') {
            $DECODE_DATA['form'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_BIN_UTF8[$PM[2]],$DECODE_DATA['form']);
          } else {
            $DECODE_DATA['form'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_BIN[$PM[2]],$DECODE_DATA['form']);
          }
          $DECODE_DATA['form'] = $this->form_htmlentities($DECODE_DATA['form']);
          # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            # 強制画像変換指定
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_IMG_MAIL[$PM[2]],$DECODE_DATA['mail']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_BIN_MAIL[$PM[2]],$DECODE_DATA['mail']);
          }
          # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
          if ($this->HARD_DATA['tg_flag'] == 'WIN') {
            $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_TXT_WIN[$PM[2]],$DECODE_DATA['text']);
          } else {
            $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_TXT[$PM[2]],$DECODE_DATA['text']);
          }
          # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
          if ($oc == 'UTF-8') {
            $DECODE_DATA['bin']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_BIN_UTF8[$PM[2]],$DECODE_DATA['bin']);
          } else {
            $DECODE_DATA['bin']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->AU_NO_TO_BIN[$PM[2]],$DECODE_DATA['bin']);
          }
          # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
          $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
        }
        if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
          # 強制画像変換指定
          while (preg_match('/\{(emj_d_|d|emj_v_|v)(\d{4})\}/',$loop_string,$PM)) {
            if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
              $set_text      = $this->DOCOMO_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->DOCOMO_NO_TO_IMG_MAIL[$PM[2]];
            } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
              $set_text      = $this->SOFT_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->SOFT_NO_TO_IMG_MAIL[$PM[2]];
            }
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text,$DECODE_DATA['web']);
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text_mail,$DECODE_DATA['mail']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
          }
        } else {
          # 未対応文字が存在する場合
          while (preg_match('/#(emj_d_|d|emj_v_|v)(\d{4})#/',$loop_string,$PM)) {
            if ($this->emoji_non == 0) {
              # 文字列で潰して表示
              $set_text = $this->emoji_chr;
            } elseif ($this->emoji_non == 1) {
              # 説明文で表示
              if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
                $set_text = $this->DOCOMO_NO_TO_NAME[$PM[2]];
              } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
                $set_text = $this->SOFT_NO_TO_NAME[$PM[2]];
              }
            } elseif ($this->emoji_non == 2) {
              # 画像で表示
              if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
                $set_text = $this->DOCOMO_NO_TO_IMG[$PM[2]];
              } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
                $set_text = $this->SOFT_NO_TO_IMG[$PM[2]];
              }
            }
            # Web表示用
            $DECODE_DATA['web']  = preg_replace('|#'.$PM[1].$PM[2].'#|',$set_text,$DECODE_DATA['web']);
            # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['form'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['form']);
            # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['mail'] = preg_replace('|#'.$PM[1].$PM[2].'#|',$this->emoji_chr,$DECODE_DATA['mail']);
            # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
            $DECODE_DATA['text'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['text']);
            # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
            $DECODE_DATA['bin']  = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['bin']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|#'.$PM[1].$PM[2].'#|','',$loop_string);
          }
        }
      } elseif (preg_match('/^'.$this->softbank_name.'$/i',$set_career)) {
        # SoftBankｷｬﾘｱに対しての絵文字ﾃﾞｺｰﾄﾞ
        while (preg_match('/\{(emj_v_|v)(\d{4})\}/',$loop_string,$PM)) {
          # Web表示用
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            # 強制画像変換指定
            $DECODE_DATA['web'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_IMG[$PM[2]],$DECODE_DATA['web']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
            $DECODE_DATA['web'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_WEBCODE[$PM[2]],$DECODE_DATA['web']);
          }
          # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
          $DECODE_DATA['form'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_WEBCODE[$PM[2]],$DECODE_DATA['form']);
          # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
          if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
            # 強制画像変換指定
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_IMG_MAIL[$PM[2]],$DECODE_DATA['mail']);
          } else {
            # 絵文字ｺｰﾄﾞ変換
#          $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_WEBCODE[$PM[2]],$DECODE_DATA['mail']);
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_IMG_MAIL[$PM[2]],$DECODE_DATA['mail']);
          }
          # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
          $DECODE_DATA['text'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_WEBCODE[$PM[2]],$DECODE_DATA['text']);
          # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
          $DECODE_DATA['bin']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$this->SOFT_NO_TO_WEBCODE[$PM[2]],$DECODE_DATA['bin']);
          # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
          $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
        }
        if (($this->img_onry_flag == '1') or ($img_mode == '1')) {
          # 強制画像変換指定
          while (preg_match('/\{(emj_d_|d|emj_a_|a|emj_am_|am)(\d{4})\}/',$loop_string,$PM)) {
            if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
              $set_text      = $this->DOCOMO_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->DOCOMO_NO_TO_IMG_MAIL[$PM[2]];
            } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
              $set_text      = $this->AU_NO_TO_IMG[$PM[2]];
              $set_text_mail = $this->AU_NO_TO_IMG_MAIL[$PM[2]];
            }
            $DECODE_DATA['web']  = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text,$DECODE_DATA['web']);
            $DECODE_DATA['mail'] = preg_replace('|\{'.$PM[1].$PM[2].'\}|',$set_text_mail,$DECODE_DATA['mail']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_string);
          }
        } else {
          # 未対応文字が存在する場合
          while (preg_match('/#(emj_d_|d|emj_a_|a|emj_am_|am)(\d{4})#/',$loop_string,$PM)) {
            if ($this->emoji_non == 0) {
              # 文字列で潰して表示
              $set_text = $this->emoji_chr;
            } elseif ($this->emoji_non == 1) {
              # 説明文で表示
              if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
                $set_text = $this->DOCOMO_NO_TO_NAME[$PM[2]];
              } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
                $set_text = $this->AU_NO_TO_NAME[$PM[2]];
              }
            } elseif ($this->emoji_non == 2) {
              # 画像で表示
              if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
                $set_text = $this->DOCOMO_NO_TO_IMG[$PM[2]];
              } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
                $set_text = $this->AU_NO_TO_IMG[$PM[2]];
              }
            }
            # Web表示用
            $DECODE_DATA['web']  = preg_replace('|#'.$PM[1].$PM[2].'#|',$set_text,$DECODE_DATA['web']);
            # ﾌｫｰﾑ表示用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['form'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['form']);
            # ﾒｰﾙ用ﾃﾞｺｰﾄﾞ
            $DECODE_DATA['mail'] = preg_replace('|#'.$PM[1].$PM[2].'#|',$this->emoji_chr,$DECODE_DATA['mail']);
            # ﾃｷｽﾄﾃﾞｺｰﾄﾞ
            $DECODE_DATA['text'] = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['text']);
            # ﾊﾞｲﾅﾘﾃﾞｺｰﾄﾞ
            $DECODE_DATA['bin']  = preg_replace('|#'.$PM[1].$PM[2].'#|','{'.$PM[1].$PM[2].'}',$DECODE_DATA['bin']);
            # ﾙｰﾌﾟ用ﾃｷｽﾄ処理
            $loop_string = preg_replace('|#'.$PM[1].$PM[2].'#|','',$loop_string);
          }
        }
      }
      $DECODE_DATA['form'] = $this->form_htmlentities($DECODE_DATA['form']);
    } else {
      $DECODE_DATA['web']  = '';
      $DECODE_DATA['form'] = '';
      $DECODE_DATA['mail'] = '';
      $DECODE_DATA['text'] = '';
      $DECODE_DATA['bin']  = '';
    }
    return $DECODE_DATA;
  }

  # 絵文字ｴﾝｺｰﾄﾞ絵文字変換 ////////////////////////////////////////////////////
  # 絵文字ｴﾝｺｰﾄﾞされた文字列をｱｸｾｽｷｬﾘｱ、或いは指定のｷｬﾘｱの絵文字に変換します。
  # [引渡し値]
  # 　$textstr  : 変換対象文字列
  # 　$career   : ｷｬﾘｱ指定(指定無い場合ｱｸｾｽｷｬﾘｱ,'DoCoMo','au','SoftBank'or'Vodafone')
  # [返り値]
  # 　$textstr  : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function _emj_enc_change($textstr,$career='') {
    if (isset($textstr)) {
      # 変換先ｷｬﾘｱ設定
      if ($career == '') {
        # 変換先ｷｬﾘｱ指定無し(ｱｸｾｽｷｬﾘｱ変換)
        $career = $this->HARD_DATA['hard'];
      } else {
        # 変換先ｷｬﾘｱ指定有り(指定ｷｬﾘｱ変換)
      }
      if (!preg_match('/^pc$/i',$career)) {
        # PC以外変換
        $loop_text = $textstr;
        # ｴﾝｺｰﾄﾞﾀｲﾌﾟ指定
        $etype_top = '';
        $etype_sec = '';
        if ($this->enc_type == '1') {
          # ｴﾝｺｰﾄﾞﾀｲﾌﾟ'{emj_#_****}'
          $etype_top = 'emj_';
          $etype_sec = '_';
        } elseif ($this->enc_type == '2') {
          # ｴﾝｺｰﾄﾞﾀｲﾌﾟ'{#****}'
        }
        while (preg_match('/\{(emj_d_|d|emj_a_|a|emj_am_|am|emj_v_|v)(\d{4})\}/',$loop_text,$PM)) {
          $check_flag = False;
          if (($PM[1] == 'emj_d_') or ($PM[1] == 'd')) {
            # DoCoMo絵文字変換
            if (preg_match('/^docomo$/i',$career)) {
              # DoCoMo変換
              $check_flag = True;
            } elseif (preg_match('/^au$/i',$career)) {
              # au変換
              if (isset($this->DOCOMO_TO_AU[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->DOCOMO_TO_AU[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'a'.$etype_sec.$this->DOCOMO_TO_AU[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            } elseif (preg_match('/'.$this->softbank_name.'/i',$career)) {
              # SoftBank変換
              if (isset($this->DOCOMO_TO_SOFT[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->DOCOMO_TO_SOFT[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'v'.$etype_sec.$this->DOCOMO_TO_SOFT[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            }
            if ($check_flag == False) {
              # 対応絵文字が無い場合
              $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','#'.$PM[1].$PM[2].'#',$textstr);
            }
          } elseif (($PM[1] == 'emj_a_') or ($PM[1] == 'a') or ($PM[1] == 'emj_am_') or ($PM[1] == 'am')) {
            # au絵文字変換
            if (preg_match('/^docomo$/i',$career)) {
              # DoCoMo変換
              if (isset($this->AU_TO_DOCOMO[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->AU_TO_DOCOMO[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'d'.$etype_sec.$this->AU_TO_DOCOMO[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            } elseif (preg_match('/^au$/i',$career)) {
              # au変換
              $check_flag = True;
            } elseif (preg_match('/'.$this->softbank_name.'/i',$career)) {
              # SoftBank変換
              if (isset($this->AU_TO_SOFT[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->AU_TO_SOFT[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'v'.$etype_sec.$this->AU_TO_SOFT[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            }
            if ($check_flag == False) {
              # 対応絵文字が無い場合
              $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','#'.$PM[1].$PM[2].'#',$textstr);
            }
          } elseif (($PM[1] == 'emj_v_') or ($PM[1] == 'v')) {
            # SoftBank絵文字変換
            if (preg_match('/^docomo$/i',$career)) {
              # DoCoMoｴﾝｺｰﾄﾞ変換
              if (isset($this->SOFT_TO_DOCOMO[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->SOFT_TO_DOCOMO[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'d'.$etype_sec.$this->SOFT_TO_DOCOMO[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            } elseif (preg_match('/^au$/i',$career)) {
              # au変換
              if (isset($this->SOFT_TO_AU[$PM[2]])) {
                if (preg_match('/^[0-9]{4}$/',$this->SOFT_TO_AU[$PM[2]])) {
                  $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','{'.$etype_top.'a'.$etype_sec.$this->SOFT_TO_AU[$PM[2]].'}',$textstr);
                  $check_flag = True;
                }
              }
            } elseif (preg_match('/'.$this->softbank_name.'/i',$career)) {
              # SoftBank変換
              $check_flag = True;
            }
            if ($check_flag == False) {
              # 対応絵文字が無い場合
              $textstr = preg_replace('|\{'.$PM[1].$PM[2].'\}|','#'.$PM[1].$PM[2].'#',$textstr);
            }
          }
          $loop_text = preg_replace('|\{'.$PM[1].$PM[2].'\}|','',$loop_text);
        }
      }

    } else {
      $textstr = '';
    }
    return $textstr;
  }

  # SoftBank 3G UTF-8ｺｰﾄﾞ対応 /////////////////////////////////////////////////
  # 絵文字ｴﾝｺｰﾄﾞされた文字列をｱｸｾｽｷｬﾘｱ、或いは指定のｷｬﾘｱの絵文字に変換します。
  # [引渡し値]
  # 　$textstr     : 変換対象文字列
  # 　$change_mode : 強制処理指定(1:強制変換処理)
  # [返り値]
  # 　$textstr     : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function v3_utf8_sjis($textstr,$change_mode='') {
    if (($this->HARD_DATA['hard'] == $this->softbank_name) and ($this->HARD_DATA['tg_flag'] == '3G') and (($change_mode == '1') or (mb_detect_encoding($textstr,'auto') == 'UTF-8'))) {
      # SoftBank絵文字ｴﾝｺｰﾄﾞ
      $no = 1;
      while (preg_match('/\xEE([\x80\x81\x84\x85\x88\x89\x8C\x8D\x90\x91\x94][\x80-\xBF])/',$textstr,$PM)) {
        $pms = quotemeta($PM[1]);
        $DEC = unpack('n1int', $PM[1]);
        if (isset($this->SOFT3G_DEC_TO_NO[$DEC['int']])) {
          $textstr = preg_replace('|'.$PM[1].'|','{emj_v_'.$this->SOFT3G_DEC_TO_NO[$DEC['int']].'}', $textstr);
        } else {
          $textstr = preg_replace('|'.$PM[1].'|',$this->emoji_chr, $textstr);
        }
      }
      # 文字ｺｰﾄﾞ変換
      $textstr = @mb_convert_encoding($textstr,$this->chg_code_sjis,'UTF-8');
      # Vofadone絵文字ﾃﾞｺｰﾄﾞ
      $TEXTSTR = $this->emj_decode($textstr);
      $textstr = $TEXTSTR['web'];
    }
    return $textstr;
  }

  # SoftBank 3G UTF-8ｺｰﾄﾞ変換(内部処理用) /////////////////////////////////////
  # SoftBank絵文字(UTF-8ｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞします。
  # [引渡し値]
  # 　$textstr : 変換対象文字列
  # [返り値]
  # 　$textstr : 変換後文字列
  #////////////////////////////////////////////////////////////////////////////
  function _replace_v_emoji_utf8($textstr) {
    # SoftBank絵文字ｴﾝｺｰﾄﾞ
    $ptn = '';
    $no = 1;
    $NEWDT = array();
    $OLDDT = array();
    $OLDDT = explode("\n", $textstr);
    foreach ($OLDDT as $str) {
      if (preg_match('/\xEE[\x80\x81\x84\x85\x88\x89\x8C\x8D\x90\x91\x94][\x80-\xBF]/',$str)) {
        while (preg_match('/\xEE([\x80\x81\x84\x85\x88\x89\x8C\x8D\x90\x91\x94][\x80-\xBF])/',$str,$PM)) {
          $pms = quotemeta($PM[1]);
          $DEC = unpack('n1int', $PM[1]);
          if (isset($this->SOFT3G_DEC_TO_NO[$DEC['int']])) {
            $NEWDT[] = preg_replace('|\xEE'.$PM[1].'|','{emj_v_'.$this->SOFT3G_DEC_TO_NO[$DEC['int']].'}', $str);
          } else {
            $NEWDT[] = preg_replace('|\xEE'.$PM[1].'|',$this->emoji_chr, $str);
          }
        }
      } else {
        $NEWDT[] = $str;
      }
    }
    $news = join("\n", $NEWDT);
    return $news;
  }

  # DoCoMo絵文字ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用) /////////////////////////////////////
  # DoCoMo絵文字(SJISﾊﾞｲﾅﾘｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ又はSJISﾃｷｽﾄ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_d_emoji($str, $mode = '') {
    $no = 0;
    $news = '';
    $OLDDT = array();
    $NEWDT = array();
    $OLDDT = explode("\n", $str);
    foreach ($OLDDT as $str) {
      $old = $str;
      $new = '';
      if (preg_match('/[\xF8\xF9]/', $old)) {
        while (1) {
          $RES = array();
          if (preg_match('/^[\xF8\xF9][\x40-\xFC]/', $old , $RES)) {
            $old = preg_replace('/^[\xF8\xF9][\x40-\xFC]/', '', $old);
            if ($mode == '') {
              # 絵文字置換え
              $bin = unpack('n1int', $RES[0]);
#              $new .= '&#'.$bin["int"].';';
              if (($this->enc_type == '') or ($this->enc_type == '1')) {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ1({emj_v_****})
                if (isset($this->DOCOMO_SJIS10_TO_NO[$bin["int"]])) {
                  $new .= '{emj_d_'.$this->DOCOMO_SJIS10_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } elseif ($this->enc_type == '1') {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ2({v****})
                if (isset($this->DOCOMO_SJIS10_TO_NO[$bin["int"]])) {
                  $new .= '{d'.$this->DOCOMO_SJIS10_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } else {
                $new .= '&#'.$bin["int"].';';
              }
            } elseif ($mode == 1) {
              # 絵文字削除
            } elseif ($mode == 2) {
              # 絵文字ｶｳﾝﾄ
              $no++;
            } elseif ($mode == 3) {
              # 絵文字下駄変換
              $new .= $this->geta_str;
            }
          } elseif (preg_match('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', $old, $RES)) {
            $old = preg_replace('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', '', $old);
            $new .= $RES[0];
          } elseif (preg_match('/^./', $old, $RES)) {
            $old = preg_replace('/^./', '', $old);
            $new .= $RES[0];
          } else {
            break;
          }
        }
      } else {
        $new = $old;
      }
      $NEWDT[] = $new;
    }
    if ($mode == 2) {
      $news = $no;
    } else {
      $news = join("\n", $NEWDT);
    }
    return $news;
  }

  # DoCoMo絵文字UTF-8ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用) ///////////////////////////////
  # DoCoMo絵文字(UTF-8ﾊﾞｲﾅﾘｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ又はSJISﾃｷｽﾄ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_d_emoji_utf8($str, $mode = '') {
    $no = 0;
    $news = '';
    $OLDDT = array();
    $NEWDT = array();
    $OLDDT = explode("\n", $str);
    foreach ($OLDDT as $str) {
      $old = $str;
      $new = '';
      if (preg_match('/\xEE([\x98-\x9D][\x80-\xBF])/', $old)) {
        while (1) {
          $RES = array();
          if (preg_match('/^\xEE([\x98-\x9D][\x80-\xBF])/', $old , $RES)) {
            $old = preg_replace('/^\xEE[\x98-\x9D][\x80-\xBF]/', '', $old);
            if ($mode == '') {
              # 絵文字置換え
              $bin = unpack('n1int', $RES[1]);
              if (($this->enc_type == '') or ($this->enc_type == '1')) {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ1({emj_v_****})
                if (isset($this->DOCOMO_UTF8_TO_NO[$bin["int"]])) {
                  $new .= '{emj_d_'.$this->DOCOMO_UTF8_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } elseif ($this->enc_type == '1') {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ2({v****})
                if (isset($this->DOCOMO_UTF8_TO_NO[$bin["int"]])) {
                  $new .= '{d'.$this->DOCOMO_UTF8_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } else {
                $new .= '&#'.$bin["int"].';';
              }
            } elseif ($mode == 1) {
              # 絵文字削除
            } elseif ($mode == 2) {
              # 絵文字ｶｳﾝﾄ
              $no++;
            } elseif ($mode == 3) {
              # 絵文字下駄変換
              $new .= $this->geta_str;
            }
          } elseif (preg_match('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', $old, $RES)) {
            $old = preg_replace('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', '', $old);
            $new .= $RES[0];
          } elseif (preg_match('/^./', $old, $RES)) {
            $old = preg_replace('/^./', '', $old);
            $new .= $RES[0];
          } else {
            break;
          }
        }
      } else {
        $new = $old;
      }
      $NEWDT[] = $new;
    }
    if ($mode == 2) {
      $news = $no;
    } else {
      $news = join("\n", $NEWDT);
    }
    return $news;
  }

  # au絵文字ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用) /////////////////////////////////////////
  # au絵文字(SJISﾊﾞｲﾅﾘｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ又はSJISﾃｷｽﾄ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_a_emoji($str, $mode = '') {
    $no = 0;
    $news = '';
    $OLDDT = array();
    $NEWDT = array();
    $OLDDT = explode("\n", $str);
    foreach ($OLDDT as $str) {
      $old = $str;
      $new = '';
      if (preg_match('/[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7]/', $old)) {
        while (1) {
          $RES = array();
          if (preg_match('/^[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7][\x40-\xFC]/', $old , $RES)) {
            $old = preg_replace('/^[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7][\x40-\xFC]/', '', $old);

            if ($mode == '') {
              # 絵文字置換え
              $bin = unpack('n1int', $RES[0]);
#              $new .= '&#'.$bin["int"].';';
              if (($this->enc_type == '') or ($this->enc_type == '1')) {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ1({emj_v_****})
                if (isset($this->AU_SJIS10_TO_NO[$bin["int"]])) {
                  $new .= '{emj_a_'.$this->AU_SJIS10_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } elseif ($this->enc_type == '1') {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ2({v****})
                if (isset($this->AU_SJIS10_TO_NO[$bin["int"]])) {
                  $new .= '{a'.$this->AU_SJIS10_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } else {
                $new .= '&#'.$bin["int"].';';
              }
            } elseif ($mode == 1) {
              # 絵文字削除
            } elseif ($mode == 2) {
              # 絵文字ｶｳﾝﾄ
              $no++;
            } elseif ($mode == 3) {
              # 絵文字下駄変換
              $new .= $this->geta_str;
            }

          } elseif (preg_match('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', $old, $RES)) {
            $old = preg_replace('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', '', $old);
            $new .= $RES[0];
          } elseif (preg_match('/^./', $old, $RES)) {
            $old = preg_replace('/^./', '', $old);
            $new .= $RES[0];
          } else {
            break;
          }
        }
      } else {
        $new = $old;
      }
      $NEWDT[] = $new;
    }
    if ($mode == 2) {
      $news = $no;
    } else {
      $news = join("\n", $NEWDT);
    }
    return $news;
  }

  # au絵文字UTF-8ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用) ////////////////////////////////////
  # au絵文字(UTF-8ﾊﾞｲﾅﾘｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ又はSJISﾃｷｽﾄ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_a_emoji_utf8($str, $mode = '') {
    $no = 0;
    $news = '';
    $OLDDT = array();
    $NEWDT = array();
    $OLDDT = explode("\n", $str);
    foreach ($OLDDT as $str) {
      $old = $str;
      $new = '';
      if (preg_match('/\xEE([\x81-\x83\xB1-\xB3\xB5\xB6\xBD-\xBF][\x80-\xBF])/', $old)) {
        while (1) {
          $RES = array();
          if (preg_match('/^\xEE([\x81-\x83\xB1-\xB3\xB5\xB6\xBD-\xBF][\x80-\xBF])/', $old , $RES)) {
            $old = preg_replace('/^\xEE([\x81-\x83\xB1-\xB3\xB5\xB6\xBD-\xBF][\x80-\xBF])/', '', $old);
            if ($mode == '') {
              # 絵文字置換え
              $bin = unpack('n1int', $RES[1]);
              if (($this->enc_type == '') or ($this->enc_type == '1')) {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ1({emj_v_****})
                if (isset($this->AU_UTF8_TO_NO[$bin["int"]])) {
                  $new .= '{emj_a_'.$this->AU_UTF8_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } elseif ($this->enc_type == '1') {
                # ｴﾝｺｰﾄﾞﾀｲﾌﾟ2({v****})
                if (isset($this->AU_UTF8_TO_NO[$bin["int"]])) {
                  $new .= '{a'.$this->AU_UTF8_TO_NO[$bin["int"]].'}';
                } else {
                  $new .= $this->emoji_chr;
                }
              } else {
                $new .= '&#'.$bin["int"].';';
              }
            } elseif ($mode == 1) {
              # 絵文字削除
            } elseif ($mode == 2) {
              # 絵文字ｶｳﾝﾄ
              $no++;
            } elseif ($mode == 3) {
              # 絵文字下駄変換
              $new .= $this->geta_str;
            }

          } elseif (preg_match('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', $old, $RES)) {
            $old = preg_replace('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', '', $old);
            $new .= $RES[0];
          } elseif (preg_match('/^./', $old, $RES)) {
            $old = preg_replace('/^./', '', $old);
            $new .= $RES[0];
          } else {
            break;
          }
        }
      } else {
        $new = $old;
      }
      $NEWDT[] = $new;
    }
    if ($mode == 2) {
      $news = $no;
    } else {
      $news = join("\n", $NEWDT);
    }
    return $news;
  }

  # au絵文字ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用ｻﾌﾞ処理) //////////////////////////////////
  # au絵文字(SJISﾊﾞｲﾅﾘｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ又はSJISﾃｷｽﾄ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_a_emoji_sub($str, $mode = '') {
    $no = 0;
    $news = '';
    $OLDDT = array();
    $NEWDT = array();
    $OLDDT = explode("\n", $str);
    foreach ($OLDDT as $str) {
      $old = $str;
      $new = '';
      if (preg_match('/[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7]/', $old)) {
        while (1) {
          $RES = array();
          if (preg_match('/^[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7][\x40-\xFC]/', $old , $RES)) {
            $old = preg_replace('/^[\xEB\xEC\xED\xEE\xF3\xF4\xF6\xF7][\x40-\xFC]/', '', $old);

            if ($mode == '') {
              # 絵文字置換え
              $bin = unpack('n1int', $RES[0]);
              $new .= '&#'.$bin["int"].'_sub;';
            } elseif ($mode == 1) {
              # 絵文字削除
            } elseif ($mode == 2) {
              # 絵文字ｶｳﾝﾄ
              $no++;
            } elseif ($mode == 3) {
              # 絵文字下駄変換
              $new .= $this->geta_str;
            }

          } elseif (preg_match('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', $old, $RES)) {
            $old = preg_replace('/^[\x81-\x9F\xE0-\xF7\xFA-\xFC][\x40-\x7E\x80-\xFC]/', '', $old);
            $new .= $RES[0];
          } elseif (preg_match('/^./', $old, $RES)) {
            $old = preg_replace('/^./', '', $old);
            $new .= $RES[0];
          } else {
            break;
          }
        }
      } else {
        $new = $old;
      }
      $NEWDT[] = $new;
    }
    if ($mode == 2) {
      $news = $no;
    } else {
      $news = join("\n", $NEWDT);
    }
    return $news;
  }

  # SoftBank絵文字ﾊﾞｲﾅﾘｺｰﾄﾞ変換(内部処理用) ///////////////////////////////////
  # SoftBank絵文字(SJISWebｺｰﾄﾞ)を絵文字ｴﾝｺｰﾄﾞ変換します。
  # [引渡し値]
  # 　$str  : 変換対象文字列
  # 　$mode : 処理指定(指定なし:ｺｰﾄﾞ変換,1:削除,2:ｶｳﾝﾄ,3:下駄変換)
  # [返り値]
  # 　$news : 処理後文字列(ｶｳﾝﾄﾓｰﾄﾞの場合はｶｳﾝﾄ数)
  #////////////////////////////////////////////////////////////////////////////
  function _replace_v_emoji($str, $mode = '') {
    $str .= chr(0x0F);
    # 絵文字第一ﾊﾞｲﾄ展開
    while (preg_match('/(\x1B\$[GEFOPQ])([\x21-\x7A])([\x21-\x7A]+)(\x0F)/', $str)) {
      $str = preg_replace('/(\x1B\$[GEFOPQ])([\x21-\x7A])([\x21-\x7A]+)(\x0F)/', '\\1\\2\\4\\1\\3\\4', $str);
    }
    # 絵文字置換え
    while (preg_match('/(\x1B\$[GEFOPQ][\x21-\x7A]\x0F)/', $str, $PM)) {
      $pms = quotemeta($PM[1]);
      if ($mode == '') {
        # 絵文字置換え
        if (($this->enc_type == '') or ($this->enc_type == '1')) {
          # ｴﾝｺｰﾄﾞﾀｲﾌﾟ1({emj_v_****})
          $str = preg_replace('|'.$pms.'|', '{emj_v_'.$this->SOFT_WEBCODE_TO_NO[$PM[1]].'}', $str);
        } elseif  ($this->enc_type == '2') {
          # ｴﾝｺｰﾄﾞﾀｲﾌﾟ2({v****})
          $str = preg_replace('|'.$pms.'|', '{v'.$this->SOFT_WEBCODE_TO_NO[$PM[1]].'}', $str);
        }
      } elseif ($mode == 1) {
        # 絵文字削除
        $str = preg_replace('|'.$pms.'|', '', $str);
      } elseif ($mode == 2) {
        # 絵文字ｶｳﾝﾄ
        $no++;
      } elseif ($mode == 3) {
        # 絵文字下駄変換
        $str = preg_replace('|'.$pms.'|', $this->geta_str, $str);
      }
    }
    # SI消去
    $str = preg_replace('/\x0F$/', '', $str);
    if ($mode == 2) { $str = $no; }
    return $str;
  }

  # ﾒｰﾙ送信(mail関数送信) /////////////////////////////////////////////////////
  # ﾒｰﾙ送信関数 emoji_send_mail のｴｲﾘｱｽです。(旧ﾊﾞｰｼﾞｮﾝとの互換性保持のため)
  # [引渡し値]
  # 　$to_name                   : 送信先名
  # 　$to_add                    : 送信先ﾒｰﾙｱﾄﾞﾚｽ
  # 　$from_name                 : 送信元名
  # 　$from_add                  : 送信元ﾒｰﾙｱﾄﾞﾚｽ
  # 　$repry_name                : 返信先名
  # 　$repry_to                  : 返信先ﾒｰﾙｱﾄﾞﾚｽ
  # 　$return_path               : 不達ﾒｰﾙ送信先ｱﾄﾞﾚｽ
  # 　$subject                   : 件名
  # 　$body                      : 本文
  # 　$to_career                 : 送信先ｷｬﾘｱ
  # 　$html_flag                 : HTMLﾒｰﾙﾌﾗｸﾞ
  # 　$content_transfer_encoding : ﾒｰﾙｴﾝｺｰﾃﾞｨﾝｸﾞ指定
  # 　$upfile                    : 添付ﾌｧｲﾙ保存ﾊﾟｽ
  # 　$file_name                 : 添付ﾌｧｲﾙ名
  # [返り値]
  # 　True : 送信成功、False : 送信失敗
  #////////////////////////////////////////////////////////////////////////////
  function emoji_send_mail2($to_name,$to_add,$from_name,$from_add,$repry_name,$repry_to,$return_path,$subject,$body,$to_career='DoCoMo',$html_flag='0',$content_transfer_encoding='',$upfile='',$file_name='') {
    # ﾒｰﾙ送信関数呼出
    $flag = $this->emoji_send_mail($to_name,$to_add,$from_name,$from_add,$subject,$body,$repry_name,$repry_to,$return_path,$html_flag,$content_transfer_encoding,'JIS',$upfile,$file_name);
    return $flag;
  }

  # 絵文字ﾒｰﾙ送信(mail関数送信) ///////////////////////////////////////////////
  # 絵文字ﾒｰﾙを送信します。
  # [引渡し値]
  # 　$to_name                   : 送信先名
  # 　$to_add                    : 送信先ﾒｰﾙｱﾄﾞﾚｽ
  # 　$from_name                 : 送信元名
  # 　$from_add                  : 送信元ﾒｰﾙｱﾄﾞﾚｽ
  # 　$subject                   : 件名
  # 　$body                      : 本文
  # 　$repry_name                : 返信先名(指定無い場合は送信元名)
  # 　$repry_to                  : 返信先ﾒｰﾙｱﾄﾞﾚｽ(指定無い場合は送信元ﾒｰﾙｱﾄﾞﾚｽ)
  # 　$return_path               : 不達ﾒｰﾙ送信先ｱﾄﾞﾚｽ(指定無い場合は送信元ﾒｰﾙｱﾄﾞﾚｽ)
  # 　$html_flag                 : HTMLﾒｰﾙﾌﾗｸﾞ(指定なし又は'0':ﾃｷｽﾄﾒｰﾙ、'1':HTMLﾒｰﾙ、'2':HTMLﾒｰﾙ(ｲﾝﾅｰ画像-ﾃﾞｺﾒﾀｲﾌﾟ))
  # 　$content_transfer_encoding : ﾒｰﾙｴﾝｺｰﾃﾞｨﾝｸﾞ指定(指定なし又は'7bit':ﾃﾞﾌｫﾙﾄ又は7bit、'base64':base64)
  # 　$mail_code                 : ﾒｰﾙ本文文字ｺｰﾄﾞ指定(指定なし又は'JIS':JIS)
  # 　$upfile                    : 添付ﾌｧｲﾙ保存ﾊﾟｽ
  # 　$file_name                 : 添付ﾌｧｲﾙ名
  # 　$encode_pass               : ｴﾝｺｰﾄﾞ処理無効化('1')
  # 　$input_code                : 入力文字ｺｰﾄﾞ指定(指定なし:設定による、UTF-8ｺｰﾄﾞ:UTF-8、その他ｺｰﾄﾞ:SJIS)
  # [返り値]
  # 　True : 送信成功、False : 送信失敗
  #////////////////////////////////////////////////////////////////////////////
  function emoji_send_mail($to_name,$to_add,$from_name,$from_add,$subject,$body,$repry_name='',$repry_to='',$return_path='',$html_flag='0',$content_transfer_encoding='',$mail_code='JIS',$upfile='',$file_name='',$encode_pass='',$input_code='') {
    # 送信先、送信元ﾁｪｯｸ
    if (($to_add == '') or ($from_add == '')) { return False; }
    # 返信先名ﾁｪｯｸ
    if ($repry_name == '')  { $repry_name  = $from_name; }
    # 返信先名ﾁｪｯｸ
    if ($repry_to == '')    { $repry_to    = $from_add; }
    # 不達ﾒｰﾙ戻り先ﾁｪｯｸ
    if ($return_path == '') { $return_path = $from_add; }
    # 送信ｴﾝｺｰﾄﾞ設定
    if ($content_transfer_encoding == '') {
      if ($this->cont_trs_enc) {
        $content_transfer_encoding = $this->cont_trs_enc;
      } else {
        $content_transfer_encoding = '7bit';
      }
    }
    # 送信先ｷｬﾘｱ取得
    $to_career = $this->get_mail_career($to_add);

    # 送信先(To句)生成
    $set_to = '';
    if ($to_name != '') {
      # 送信者名の指定がある場合
      $str_code = mb_detect_encoding($to_name,'auto');
      if ($str_code == 'JIS') {
        $set_to  = $to_name;
      } else {
        $set_to  = @mb_convert_encoding($to_name,'JIS',$str_code);
      }
      $set_to  = mb_convert_kana($set_to,'KV','JIS');
      $set_to  = mb_encode_mimeheader($set_to,'JIS');
      $set_to .= ' <'.$to_add.'>';
    } else {
      # 送信者名の指定が無い場合
      $set_to = $to_add;
    }
    # 送信元(From句)生成
    $set_form = '';
    if ($from_name != '') {
      $str_code = mb_detect_encoding($from_name,'auto');
      if ($str_code == 'JIS') {
        $set_form  = $from_name;
      } else {
        $set_form  = @mb_convert_encoding($from_name,'JIS',$str_code);
      }
      $set_form  = mb_convert_kana($set_form,'KV','JIS');
      $set_form  = mb_encode_mimeheader($set_form,'JIS');
      $set_form .= ' <'.$from_add.'>';
    } else {
      $set_form = $from_add;
    }
    # 返信先(Repry_to句)生成
    $set_repry_to = '';
    if ($repry_name != '') {
      $str_code = mb_detect_encoding($repry_name,'auto');
      if ($str_code == 'JIS') {
        $set_repry_to  = $repry_name;
      } else {
        $set_repry_to  = @mb_convert_encoding($repry_name,'JIS',$str_code);
      }
      $set_repry_to  = mb_convert_kana($set_repry_to,'KV','JIS');
      $set_repry_to  = mb_encode_mimeheader($set_repry_to,'JIS');
      $set_repry_to .= " <".$repry_to.">";
    } else {
      $set_repry_to = $repry_to;
    }
    # ﾒｰﾙ送信用絵文字変換(ｴﾝｺｰﾄﾞ)
    if ($encode_pass != '1') {
      $subject = $this->emj_encode($subject,'','',$input_code);
      $body    = $this->emj_encode($body,'','',$input_code);
    }
    # 文字ｺｰﾄﾞ取得
    $subject_code = mb_detect_encoding($subject,'auto');
    $body_code    = mb_detect_encoding($body,'auto');
    # 文字ｺｰﾄﾞ変換
    if ($subject_code != $mail_code) { $subject = @mb_convert_encoding($subject,$mail_code,$subject_code); }
    if ($body != $mail_code)         { $body    = @mb_convert_encoding($body,$mail_code,$subject_code); }
    # ｶﾀｶﾅ変換
    $subject = mb_convert_kana($subject,'KV',$mail_code);
    $body    = mb_convert_kana($body,'KV',$mail_code);

    # 件名処理
    # 絵文字変換(ﾃﾞｺｰﾄﾞ)
    $SUBJECT = $this->emj_decode($subject,$to_career,$mail_code);
    $subject = $SUBJECT['mail'];
    # 件名処理
    if ($subject == '') { $subject = @mb_convert_encoding('無題','JIS','SJIS'); }
    $subject = base64_encode($subject);
    $subject = '=?ISO-2022-JP?B?'.$subject.'?=';

    # 本文処理
    # 本文絵文字認識
    $EMJ_COUNT = $this->emj_check($body,'1');
    if ($EMJ_COUNT['total'] > 0) { $body_emj_flag = True; } else { $body_emj_flag = False; }
    # ﾒｰﾙ送信用絵文字変換(ﾃﾞｺｰﾄﾞ)
    $BODY = $this->emj_decode($body,$to_career,$mail_code,$html_flag);
    $body = $BODY['mail'];
#    if (preg_match('/^pc$/i',$to_career) or preg_match('/^'.$this->softbank_name.'$/i',$to_career) or ($this->html_mail_flag == '1') or ($html_flag == '1')) {
    if ((preg_match('/^pc$/i',$to_career) or preg_match('/^'.$this->softbank_name.'$/i',$to_career)) and (($body_emj_flag == True) or ($html_flag == '1'))) {
      # HTMLﾀｸﾞ有無ﾁｪｯｸ
      $tag_flag = False;
      if ($body != strip_tags($body)) { $tag_flag = True; }
      # 本文HTML化処理
      $body = preg_replace('/\r/','',$body);
      if ($tag_flag == False) { $body = preg_replace('/\n/',"<br>\n",$body); }
#      $body = preg_replace('/=/','=3D',$body);
    }
    # Base64ﾃﾞｺｰﾄﾞ
    if ($content_transfer_encoding == 'base64') { $body = base64_encode($body); }

    # ﾍｯﾀﾞｰ、本文処理
    $msg  = '';
    $add_mail_header  = '';
    $add_mail_header .= "From: ".$set_form."\r\n";
    $add_mail_header .= "Reply-To: ".$set_repry_to."\r\n";
    $add_mail_header .= "MIME-Version: 1.0\r\n";

    # 添付ﾌｧｲﾙﾁｪｯｸ
    $upfile_type = '';
    $tail        = '';
    $upfile_flag = 0;
    if (file_exists($upfile)) {
      if ($fp = @fopen($upfile,"r")) {
        @fclose($fp);
        if (preg_match('/.gif$/i',$upfile)) {
          $upfile_type = 'image/gif';
          $tail        = '.gif';
        } elseif (preg_match('/.jpe*g$/i',$upfile)) {
          $upfile_type = 'image/jpeg';
          $tail        = '.jpg';
        } elseif (preg_match('/.png$/i',$upfile)) {
          $upfile_type = 'image/png';
          $tail        = '.png';
        }
        $FDT = split('/',$upfile);
        $upfile_name = $FDT[count($FDT) - 1];
        $upfile_flag = 1;
      }
    }

    if ($upfile_flag == 1) {
      # 添付ﾌｧｲﾙ有る場合
      # ﾊﾞｳﾝﾀﾞﾘｰ文字(ﾊﾟｰﾄの境界)
      $boundary = md5(uniqid(rand()));
      # ﾍｯﾀﾞｰ設定
      $header .= "Content-Type: multipart/mixed;\n";
      $header .= "\tboundary=\"".$boundary."\"\n";
      # 本文生成
      $msg .= "This is a multi-part message in MIME format.\n\n";
      $msg .= "--".$boundary."\n";
    }
    $ht = '';
#    if (preg_match('/^pc$/i',$to_career) or preg_match('/^'.$this->softbank_name.'$/i',$to_career) or ($this->html_mail_flag == '1') or ($html_flag == '1')) {
    if ((preg_match('/^pc$/i',$to_career) or preg_match('/^'.$this->softbank_name.'$/i',$to_career)) and (($body_emj_flag == True) or ($html_flag == '1'))) {
      # HTMLﾒｰﾙの場合
      $ht .= "Content-Type: text/html; charset=\"ISO-2022-JP\"\r\n";
    } else {
      # ﾃｷｽﾄﾒｰﾙの場合
      $ht .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\r\n";
    }
    $ht .= "Content-Transfer-Encoding: ".$content_transfer_encoding;
    if ($upfile_flag == 1) {
      # 添付ﾌｧｲﾙ有る場合
      $msg .= $ht;
      $msg .= $body;
      # ﾌｧｲﾙ読込み
      $fp = fopen($upfile,"r");
      $fdata = fread($fp, filesize($upfile));
      fclose($fp);
      # ﾌｧｲﾙ名設定
      if ($file_name) { $upfile_name = $file_name.$tail; }
      # ｴﾝｺｰﾄﾞして分割
      $f_encoded = chunk_split(base64_encode($fdata));
      $msg .= "\n\n--".$boundary."\n";
      $msg .= "Content-Type: ".$upfile_type.";\n";
      $msg .= "\tname=\"".$upfile_name."\"\n";
      $msg .= "Content-Transfer-Encoding: base64\n";
      $msg .= "Content-Disposition: attachment;\n";
      $msg .= "\tfilename=\"".$upfile_name."\"\n\n";
      $msg .= $f_encoded."\n";
      $msg .= "--".$boundary."--";
      $body = $msg;
    } else {
      # 添付ﾌｧｲﾙ無い場合
      $add_mail_header .= $ht;
    }

    $success = @mail($set_to,$subject,$body,$add_mail_header,'-f'.$return_path);
    if ($success) { return True; } else { return False; }

  }

  # 携帯情報取得 //////////////////////////////////////////////////////////////
  # 本関数は携帯の詳細情報を取得するための関数です。
  # [引渡し値]
  # 　$user_agent : ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ指定(指定無しの場合ｱｸｾｽ端末のﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ)
  # [返り値]
  # 　$RETURNDATA['hard']           : ｷｬﾘｱ(PC,DoCoMo,au,Vodafone)
  # 　$RETURNDATA['career']         : ｷｬﾘｱ(PC,PSP,DoCoMo,au,Vodafone)
  # 　$RETURNDATA['kubun']          : 区分(DoCoMo:FOMA/mova,au:win,SoftBank:3G)
  # 　$RETURNDATA['meka_name']      : ﾒｰｶｰ名
  # 　$RETURNDATA['kisyu_type']     : 機種名
  # 　$RETURNDATA['image_mime']     : 画像MIME
  # 　$RETURNDATA['image_kaku']     : ﾃﾞﾌｫﾙﾄ画像拡張子
  # 　$RETURNDATA['movie_mime']     : 動画MIME
  # 　$RETURNDATA['movie_kaku']     : ﾃﾞﾌｫﾙﾄ動画拡張子
  # 　$RETURNDATA['movie_size']     : ﾃﾞﾌｫﾙﾄ動画ｻｲｽﾞ
  # 　$RETURNDATA['down_size']      : ﾀﾞｳﾝﾛｰﾄﾞ動画最大ｻｲｽﾞ(KB)
  # 　$RETURNDATA['str_size']       : ｽﾄﾘｰﾐﾝｸﾞ動画最大ｻｲｽﾞ(KB)
  # 　$RETURNDATA['display_width']  : ﾃﾞｨｽﾌﾟﾚｲ幅(pt)
  # 　$RETURNDATA['display_height'] : ﾃﾞｨｽﾌﾟﾚｲ高さ(pt)
  # 　$RETURNDATA['display_color']  : ﾃﾞｨｽﾌﾟﾚｲ表示色数
  # 　$RETURNDATA['cache_size']     : ｷｬｯｼｭｻｲｽﾞ
  # 　$RETURNDATA['export_type']    : 動画処理用ﾀｲﾌﾟ指定1
  # 　$RETURNDATA['export_type2']   : 動画処理用ﾀｲﾌﾟ指定2
  #////////////////////////////////////////////////////////////////////////////
  function Get_PhoneData($user_agent='') {
    # 返り値初期化
    $RETURNDATA = array();
    $RETURNDATA['hard']           = '';
    $RETURNDATA['career']         = '';
    $RETURNDATA['kubun']          = '';
    $RETURNDATA['meka_name']      = '';
    $RETURNDATA['kisyu_type']     = '';
    $RETURNDATA['image_mime']     = '';
    $RETURNDATA['image_kaku']     = '';
    $RETURNDATA['movie_mime']     = '';
    $RETURNDATA['movie_kaku']     = '';
    $RETURNDATA['movie_size']     = '';
    $RETURNDATA['down_size']      = '';
    $RETURNDATA['str_size']       = '';
    $RETURNDATA['display_width']  = '';
    $RETURNDATA['display_height'] = '';
    $RETURNDATA['display_color']  = '';
    $RETURNDATA['cache_size']     = '';
    $RETURNDATA['export_type']    = '';
    $RETURNDATA['export_type2']   = '';
    $KTDATA = array();

    # ﾕｰｻﾞｰｴｰｼﾞｪﾝﾄ処理
    if ($user_agent == '') { $user_agent = $_SERVER['HTTP_USER_AGENT']; }

    # 判定ﾃﾞｰﾀ生成
    $USRAGENT = array();
    $USRAGENT = explode('/',$user_agent);
    $maxnum   = count($USRAGENT) - 1;

    if ($this->db_flag == '1') {
      # ﾃﾞｰﾀﾍﾞｰｽ使用
      # DB接続
      $GLOBALS['db_obj']->db_connect();
      # 携帯情報ﾃﾞｰﾀﾍﾞｰｽ読込み
      $sql = "SELECT * FROM Phone_Spec";
      $sth = $GLOBALS['db_obj']->sql_set_data(0,$sql,'','',$this->save_ptn);
      while ($GETDATA = $GLOBALS['db_obj']->sql_get_data(0,$sth,'','','loop','ass','1',$this->read_ptn)) {
        $editdate = substr($GETDATA['editdate'],0,4).'/'.substr($GETDATA['editdate'],4,2).'/'.substr($GETDATA['editdate'],6,2).' '.substr($GETDATA['editdate'],8,2).':'.substr($GETDATA['editdate'],10,2);
        $KTDATA[] = $GETDATA['career']."\t".$GETDATA['kubun']."\t".$GETDATA['maker']."\t".$GETDATA['model']."\t".$GETDATA['yusen']."\t".$GETDATA['user_agent_patt']."\t".$GETDATA['sikibetu']."\t".$GETDATA['check_point']."\t".$GETDATA['check_string']."\t".$GETDATA['img_mime']."\t".$GETDATA['img_ext']."\t".$GETDATA['mov_mime']."\t".$GETDATA['mov_ext']."\t".$GETDATA['mov_size']."\t".$GETDATA['mov_download_max_size']."\t".$GETDATA['mov_stream_max_size']."\t".$GETDATA['display_width']."\t".$GETDATA['display_height']."\t".$GETDATA['display_color']."\t".$GETDATA['cache_size']."\t".$GETDATA['fitmov_patt_name1']."\t".$GETDATA['fitmov_patt_name2']."\t".$GETDATA['biko0']."\t".$GETDATA['biko1']."\t".$GETDATA['biko2']."\t".$editdate."\t\t\n";
      }
      # DB切断
      $GLOBALS['db_obj']->db_disconnect();
    } else {
      # ﾌｧｲﾙﾃﾞｰﾀﾍﾞｰｽ使用
      # 携帯ﾃﾞｰﾀﾍﾞｰｽ読込み
      if (($this->mob_path == '') or !@file_exists($this->mob_path)) {
        $RETURNDATA['hard'] = 'PC';
        return $RETURNDATA;
      }
      $KTDATA = file($this->mob_path);
    }

    # ﾃﾞｰﾀ判定
    for ($ix = 1; $ix <= 2; $ix++) {
      $cfl = 0;
      foreach ($KTDATA as $kdt) {
        list($career,$kubun,$meka_name,$kisyu_type,$yusendo,$ue_pat,$hoho,$ichi,$patn,$image_mime,$image_kaku,$movie_mime,$movie_kaku,$movie_size,$down_size,$str_size,$display_width,$display_height,$display_color,$cache_size,$export_type,$export_type2,$biko0,$biko1,$biko2,$editdate) = explode("\t",$kdt);
        $patn = preg_replace('|/|','\/',$patn);
        $patn = preg_replace('|\(|','\(',$patn);
        if ($yusendo == $ix) {
          if ($hoho == 0) {
            # 部分一致
            if ($ichi == 0) {
              # 全文字列判定
              if (preg_match('/'.$patn.'/',$user_agent)) { $cfl = 1; break; }
            } else {
              # 部分文字列判定
              if ($maxnum >= $ichi - 1) {
                if (preg_match('/'.$patn.'/',$USRAGENT[$ichi - 1])) { $cfl = 1; break; }
              }
            }
          } elseif ($hoho == 1) {
            # 完全一致
            if ($ichi == 0) {
              # 全文字列判定
              if ($user_agent == $patn) { $cfl = 1; break; }
            } else {
              # 部分文字列判定
              if ($maxnum >= $ichi - 1) {
                if ($USRAGENT[$ichi - 1] == $patn) { $cfl = 1; break; }
              }
            }
          }
        }
      }
      if ($cfl == 1) { break; }
    }

    if ($cfl == 0) {
      if (preg_match('/PSP/',$user_agent)) {
        $hard         = 'PSP';
      } else {
        $hard         = 'PC';
      }
      $career         = 'PC';
      $kubun          = '';
      $meka_name      = '';
      $kisyu_type     = '';
      $image_mime     = '';
      $image_kaku     = '';
      $movie_mime     = '';
      $movie_kaku     = '';
      $movie_size     = '';
      $down_size      = '';
      $str_size       = '';
      $display_width  = '';
      $display_height = '';
      $display_color  = '';
      $cache_size     = '';
      $export_type    = '';
      $export_type2   = '';
    } else {
      $hard           = $career;
    }

    # 返り値設定
    $RETURNDATA = array();
    $RETURNDATA['hard']           = $hard;
    $RETURNDATA['career']         = $career;
    $RETURNDATA['kubun']          = $kubun;
    $RETURNDATA['meka_name']      = $meka_name;
    $RETURNDATA['kisyu_type']     = $kisyu_type;
    $RETURNDATA['image_mime']     = $image_mime;
    $RETURNDATA['image_kaku']     = $image_kaku;
    $RETURNDATA['movie_mime']     = $movie_mime;
    $RETURNDATA['movie_kaku']     = $movie_kaku;
    $RETURNDATA['movie_size']     = $movie_size;
    $RETURNDATA['down_size']      = $down_size;
    $RETURNDATA['str_size']       = $str_size;
    $RETURNDATA['display_width']  = $display_width;
    $RETURNDATA['display_height'] = $display_height;
    $RETURNDATA['display_color']  = $display_color;
    $RETURNDATA['cache_size']     = $cache_size;
    $RETURNDATA['export_type']    = $export_type;
    $RETURNDATA['export_type2']   = $export_type2;

    return $RETURNDATA;
  }

  # ﾌｫｰﾑ処理用 ////////////////////////////////////////////////////////////////
  # ﾌｫｰﾑで表示する際のｴﾝﾃｨﾃｨ処理を行います。
  # [引渡し値]
  # 　$html : ｴﾝﾃｨﾃｨ対象文字列
  # [返り値]
  # 　$html : ｴﾝﾃｨﾃｨ処理後文字列
  #////////////////////////////////////////////////////////////////////////////
  function form_htmlentities($html) {
    $html = preg_replace('/</','&lt;',$html);
    $html = preg_replace('/>/','&gt;',$html);
    $html = preg_replace('/"/','&#34;',$html);
    $html = preg_replace("/'/",'&#39;',$html);
    return $html;
  }

  # 絵文字入力ﾌｫｰﾑ用ｴｽｹｰﾌﾟ処理 ////////////////////////////////////////////////
  # 絵文字入力ﾌｫｰﾑで表示するための前処理を行います。
  # [引渡し値]
  # 　$html : ｴｽｹｰﾌﾟ対象文字列
  # [返り値]
  # 　$html : ｴｽｹｰﾌﾟ処理後文字列
  #////////////////////////////////////////////////////////////////////////////
  function emj_form_escape($html) {
    $html = preg_replace("/'/","\\'",$html);
    $html = preg_replace('/\r/','\\r',$html);
    $html = preg_replace('/\n/','\\n',$html);
    $html = preg_replace('/<br>/','',$html);
#    $html = preg_replace('/"/','&#34;',$html);
#    $html = preg_replace('/'/','&#39;',$html);
    return $html;
  }

}

###############################################################################
# ﾃﾞｰﾀﾍﾞｰｽ処理ｸﾗｽ #############################################################
###############################################################################
class emj_db {

  # 変数設定
  var $DB_TYPE;
  var $DBH;

  # ﾃﾞｰﾀﾍﾞｰｽ接続設定値設定
  var $dbd            = '';
  var $db_hostname    = '';
  var $db_hostport    = '';
  var $db_name        = '';
  var $db_username    = '';
  var $db_usrpassword = '';

  var $emj_obj_flag   = 0;

  # ﾃﾞｰﾀﾍﾞｰｽ処理ｺﾝｽﾄﾗｸﾀ ///////////////////////////////////////////////////////
  function db() {
    $this->DB_TYPE = array();
    $this->DBH     = array();

    # 絵文字変換ﾗｲﾌﾞﾗﾘｵﾌﾞｼﾞｪｸﾄﾁｪｯｸ
    if (is_object($GLOBALS['emoji_obj'])) { $this->emj_obj_flag = 1; }

  }

  # ﾃﾞｰﾀﾍﾞｰｽ接続設定 //////////////////////////////////////////////////////////
  function db_set_connection_data($SETTINGDATA) {
    # ﾃﾞｰﾀﾍﾞｰｽ値設定
    if (isset($SETTINGDATA['dbd']))            { $this->dbd            = $SETTINGDATA['dbd']; }
    if (isset($SETTINGDATA['db_hostname']))    { $this->db_hostname    = $SETTINGDATA['db_hostname']; }
    if (isset($SETTINGDATA['db_hostport']))    { $this->db_hostport    = $SETTINGDATA['db_hostport']; }
    if (isset($SETTINGDATA['db_name']))        { $this->db_name        = $SETTINGDATA['db_name']; }
    if (isset($SETTINGDATA['db_username']))    { $this->db_username    = $SETTINGDATA['db_username']; }
    if (isset($SETTINGDATA['db_usrpassword'])) { $this->db_usrpassword = $SETTINGDATA['db_usrpassword']; }
  }

  # ﾃﾞｰﾀﾍﾞｰｽ接続 //////////////////////////////////////////////////////////////
  # ﾃﾞｰﾀﾍﾞｰｽへ接続します。(設定ﾌｧｲﾙでDB接続設定されている必要有り)
  # MySQLの場合、DBが存在しない場合は新規にDBを生成します。
  # 引渡値：$connect_no   => 接続番号
  # 　　　　$sub_dbname   => 別DB指定
  # 返り値：$connect_flag => 接続ｽﾃｰﾀｽ '1'→接続成功、'-1'→接続失敗
  function db_connect($connect_no='',$sub_dbname='') {
    if ($connect_no == '') { $connect_no = 0; }
    $cfl = 0;
    $connect_flag = 1;
    if ($sub_dbname != '') { $dbn = $sub_dbname; } else { $dbn = $this->db_name; }
    if ($this->dbd == 'Pg') {
      # PostgreSQL接続
      if ($this->db_hostname != '') {
        $host = 'host='.$this->db_hostname.' ';
        if ($this->db_hostport != '') { $port = 'port='.$this->db_hostport.' '; }
      } else {
        $host = '';
        $port = '';
      }
      if ($this->DBH[$connect_no] = pg_connect($host.$port.'dbname='.$dbn.' user='.$this->db_username.' password='.$this->db_usrpassword)) {
      } else {
        $this->DBH[$connect_no] = -1;
        $connect_flag = 0;
      }
    } elseif ($this->dbd == 'mysql') {
      # MySQL接続
      if ($this->db_hostname != '') {
        $host = $this->db_hostname;
        if ($this->db_hostport != '') { $host = $host.':'.$this->db_hostport; }
      } else {
        $host = 'localhost';
      }
      if ($this->DBH[$connect_no] = mysql_connect($host,$this->db_username,$this->db_usrpassword)) {
        # ﾃﾞｰﾀﾍﾞｰｽ指定
        if (!($dbst = mysql_select_db($dbn))) {
          $sth = mysql_query('create database '.$dbn, $this->DBH[$connect_no]);
          if (!($dbst = mysql_select_db($dbn))) { $this->DBH[$connect_no] = -1; $connect_flag = 0; }
        }
      } else {
        $this->DBH[$connect_no] = -1;
        $connect_flag = 0;
      }
    }
    $this->DB_TYPE[$connect_no] = $this->dbd;
    return $connect_flag;
  }

  # ﾃﾞｰﾀﾍﾞｰｽ切断 ////////////////////////////////////////////////////////////////
  # ﾃﾞｰﾀﾍﾞｰｽへ接続を切断します。
  # 引渡値：$connect_no => 接続番号
  # 返り値：$cfl        => 切断成功→'1'、切断失敗→'0'
  function db_disconnect ($connect_no='') {
    if ($connect_no == '') { $connect_no = 0; }
    $cfl = 0;
    if ($this->DBH[$connect_no] != -1) {
      if ($this->dbd == 'Pg') {
        # PostgreSQL切断
        if ($dbst = pg_close($this->DBH[$connect_no])) { $cfl = 1; }
      } elseif ($this->dbd == 'mysql') {
        # MySQL切断
        if ($dbst = mysql_close($this->DBH[$connect_no])) { $cfl = 1; }
      }
    }
    $this->DB_TYPE[$connect_no] = '';
    return $cfl;
  }

  # ﾃｰﾌﾞﾙﾁｪｯｸ /////////////////////////////////////////////////////////////////
  # ﾃｰﾌﾞﾙの有無をﾁｪｯｸし、ﾃｰﾌﾞﾙが存在しない場合、新規にﾃｰﾌﾞﾙを作成します。
  # 引渡値：$connect_no      => 接続番号
  # 　　　　$check_tablename => ﾃｰﾌﾞﾙ名
  # 　　　　$field_list      => ﾌｨｰﾙﾄﾞﾘｽﾄ
  # 　　　　$maketable_flag  => 指定なしor'0':ﾃｰﾌﾞﾙの有無のみﾁｪｯｸ、'1':新規にﾃｰﾌﾞﾙを生成する
  # 　　　　$dbnm            => 別DB名
  # 　　　　$heap_flag       => ﾋｰﾌﾟﾃｰﾌﾞﾙの場合指定('0'又は指定なし:通常ﾃｰﾌﾞﾙ、'1':ﾋｰﾌﾟﾃｰﾌﾞﾙ)
  # 　　　　$INDEXLIST       => ｲﾝﾃﾞｯｸｽ生成
  # 返り値：$cfl             => ﾁｪｯｸ結果 '0'→ﾃｰﾌﾞﾙ無し、'1'→ﾃｰﾌﾞﾙ有り
  function db_check($connect_no,$check_tablename,$field_list,$maketable_flag,$dbnm='',$heap_flag='',$INDEXLIST='') {
    $cfl = 0;
    if ($connect_no == '') { $connect_no = 0; }
    if ($heap_flag == '1') {
      # Heapﾃｰﾌﾞﾙ生成(MySQLのみ)
      if ($this->DB_TYPE[$connect_no] == 'mysql') {
        $cfl = $this->db_heap_check($connect_no,$check_tablename,$field_list,$maketable_flag,$dbnm,$INDEXLIST);
      }
    } else {
      # 通常ﾃｰﾌﾞﾙ生成
      if ($this->DB_TYPE[$connect_no] == 'Pg') {
        # PostgreSQLﾃｰﾌﾞﾙﾁｪｯｸ
        $tables = $this->pg_list_tables($this->DBH[$connect_no]);
        while ($row = pg_fetch_array($tables)) {
          if ($check_tablename == $row[0]) { $cfl = 1; break; }
        }
      } elseif ($this->DB_TYPE[$connect_no] == 'mysql') {
        # MySQLﾃｰﾌﾞﾙﾁｪｯｸ
        if ($dbnm == '') {
          $dbn = $this->db_name;
          $dbst = mysql_select_db($this->db_name,$this->DBH[$connect_no]);
        } else {
          $dbn = $dbnm;
          $dbst = mysql_select_db($dbnm,$this->DBH[$connect_no]);
        }
        $tables = mysql_list_tables($dbn,$this->DBH[$connect_no]);
        while ($row = mysql_fetch_array($tables,MYSQL_BOTH)) {
          if ($check_tablename == $row[0]) { $cfl = 1; break; }
        }
      }
      if (($maketable_flag == 1) and ($cfl == 0)) {
        # ﾃｰﾌﾞﾙ新規作成
        $query = 'CREATE TABLE '.$check_tablename.' ('.$field_list.')';
        if ($this->DB_TYPE[$connect_no] == 'Pg') {
          # PostgreSQLﾃｰﾌﾞﾙ新規作成
          $result = pg_query($this->DBH[$connect_no],$query);
        } elseif ($this->DB_TYPE[$connect_no] == 'mysql') {
          # MySQLﾃｰﾌﾞﾙ新規作成
          $result = mysql_query($query,$this->DBH[$connect_no]);
          # ｲﾝﾃﾞｯｸｽ作成
          if ($result and is_array($INDEXLIST)) {
            foreach ($INDEXLIST as $idt) {
              if ($idt) {
                $query  = 'ALTER TABLE '.$check_tablename.' ADD INDEX ('.$idt.')';
                $result = mysql_query($query,$this->DBH[$connect_no]);
              }
            }
          }
        }
        $cfl = 1;
      }
    }
    return $cfl;
  }

  # Heapﾃｰﾌﾞﾙｻｲｽﾞ取得 /////////////////////////////////////////////////////////
  # Heapﾃｰﾌﾞﾙ最大ｻｲｽﾞを取得します。(MySQL専用)
  # 引渡値：$connect_no      => 接続番号
  # 　　　　$check_tablename => ﾃｰﾌﾞﾙ名
  # 　　　　$dbnm            => 別DB名
  # 返り値：$max_heap_table_size => Heapﾃｰﾌﾞﾙｻｲｽﾞ
  function get_heap_size($connect_no,$check_tablename,$dbnm='') {
    if ($connect_no == '') { $connect_no = 0; }
    $max_heap_table_size = 0;
    $cfl = 0;
    if ($this->DB_TYPE[$connect_no] == 'mysql') {
      # Heapﾃｰﾌﾞﾙ最大ｻｲｽﾞ取得
      $result = mysql_query("show variables",$this->DBH[$connect_no]);
      while ($row = mysql_fetch_array($result,MYSQL_BOTH)) {
        if ($row[0] == 'max_heap_table_size') { $max_heap_table_size = $row[1]; break; }
      }
    }
    return $max_heap_table_size;
  }

  # Heapﾃｰﾌﾞﾙﾁｪｯｸ /////////////////////////////////////////////////////////////
  # Heapﾃｰﾌﾞﾙの有無をﾁｪｯｸし、ﾃｰﾌﾞﾙが存在しない場合、新規にﾃｰﾌﾞﾙを作成します。(MySQL専用)
  # 引渡値：$connect_no      => 接続番号
  # 　　　　$check_tablename => ﾃｰﾌﾞﾙ名
  # 　　　　$field_list      => ﾌｨｰﾙﾄﾞﾘｽﾄ
  # 　　　　$maketable_flag  => ﾃｰﾌﾞﾙの有無のみﾁｪｯｸし新規にﾃｰﾌﾞﾙを生成しない場合"1"指定
  # 　　　　$dbnm            => 別DB名
  # 返り値：$cfl             => ﾁｪｯｸ結果 '0'→ﾃｰﾌﾞﾙ無し、'1'→ﾃｰﾌﾞﾙ有り
  function db_heap_check($connect_no,$check_tablename,$field_list,$maketable_flag,$dbnm='',$INDEXLIST='') {
    if ($connect_no == '') { $connect_no = 0; }
    $cfl = 0;
    if ($this->DB_TYPE[$connect_no] == 'mysql') {
      # MySQLﾃｰﾌﾞﾙﾁｪｯｸ
      if ($dbnm == '') {
        $dbn = $this->db_name;
        $dbst = mysql_select_db($this->db_name,$this->DBH[$connect_no]);
      } else {
        $dbn = $dbnm;
        $dbst = mysql_select_db($dbnm,$this->DBH[$connect_no]);
      }
      $tables = mysql_list_tables($dbn,$this->DBH[$connect_no]);
      while ($row = mysql_fetch_array($tables,MYSQL_BOTH)) {
        if ($check_tablename == $row[0]) { $cfl = 1; break; }
      }

      if (($maketable_flag == 1) and ($cfl == 0)) {
        # Heapﾃｰﾌﾞﾙ最大ｻｲｽﾞ取得
#        $max_heap_table_size = $this->get_heap_size($connect_no,$check_tablename,$dbnm);

        # ﾃｰﾌﾞﾙ新規作成
#        $query = 'CREATE TABLE '.$check_tablename.' ('.$field_list.') type=heap max_rows='.$GLOBALS['max_rows'];
        $query = 'CREATE TABLE '.$check_tablename.' ('.$field_list.') type=heap';
        $result = mysql_query($query,$this->DBH[$connect_no]);
        # ｲﾝﾃﾞｯｸｽ作成
        if ($result and is_array($INDEXLIST)) {
          foreach ($INDEXLIST as $idt) {
            if ($idt) {
              $query  = 'ALTER TABLE '.$check_tablename.' ADD INDEX ('.$idt.')';
              $result = mysql_query($query,$this->DBH[$connect_no]);
            }
          }
        }
      }
    }
    return $cfl;
  }

  # ﾃｰﾌﾞﾙﾘｽﾄ取得 //////////////////////////////////////////////////////////////
  # ﾃｰﾌﾞﾙの有無をﾁｪｯｸし、ﾃｰﾌﾞﾙが存在しない場合、新規にﾃｰﾌﾞﾙを作成します。
  # 引渡値：$connect_no      => 接続番号
  # 　　　　$check_tablename => ﾃｰﾌﾞﾙ名
  # 　　　　$field_list      => ﾌｨｰﾙﾄﾞﾘｽﾄ
  # 　　　　$maketable_flag  => ﾃｰﾌﾞﾙの有無のみﾁｪｯｸし新規にﾃｰﾌﾞﾙを生成しない場合"1"指定
  # 　　　　$dbnm            => 別DB名
  # 返り値：$cfl             => ﾁｪｯｸ結果 '0'→ﾃｰﾌﾞﾙ無し、'1'→ﾃｰﾌﾞﾙ有り
  function get_table_list($connect_no,$dbnm='') {
    if ($connect_no == '') { $connect_no = 0; }
    $TABLES = array();
    if ($this->DB_TYPE[$connect_no] == 'Pg') {
      # PostgreSQLﾃｰﾌﾞﾙﾁｪｯｸ
      $tables = $this->pg_list_tables($this->DBH[$connect_no]);
      while ($row = pg_fetch_array($tables)) {
        $TABLES[] = $row[0];
      }
    } elseif ($this->DB_TYPE[$connect_no] == 'mysql') {
      # MySQLﾃｰﾌﾞﾙﾁｪｯｸ
      if ($dbnm == '') {
        $dbn = $GLOBALS['db_name'];
        $dbst = mysql_select_db($GLOBALS['db_name'],$this->DBH[$connect_no]);
      } else {
        $dbn = $dbnm;
        $dbst = mysql_select_db($dbnm,$this->DBH[$connect_no]);
      }
      $tables = mysql_list_tables($dbn,$this->DBH[$connect_no]);
      while ($row = mysql_fetch_array($tables,MYSQL_BOTH)) {
        $TABLES[] = $row[0];
      }
    }
    return $TABLES;
  }

  # PostgreSQL用ﾃｰﾌﾞﾙ一覧取得 /////////////////////////////////////////////////
  # PostgreSQL用にﾃｰﾌﾞﾙ一覧を取得します。
  # 引渡値：$connect_no      => 接続番号
  # 返り値：ﾃｰﾌﾞﾙ一覧取得結果
  function pg_list_tables($connect_no='') {
    if ($connect_no == '') { $connect_no = 0; }
    assert(is_resource($dbh));
    $query = "
  SELECT
   c.relname as \"Name\", 
   CASE c.relkind WHEN 'r' THEN
    'table' WHEN 'v' THEN 'view' WHEN
    'i' THEN 'index' WHEN 'S' THEN 'special'
    END as \"Type\",
   u.usename as \"Owner\" 
  FROM
   pg_class c LEFT JOIN pg_user u ON
   c.relowner = u.usesysid 
  WHERE
   c.relkind IN ('r','v','S','')
   AND c.relname !~ '^pg_' 
  ORDER BY 1;
";
    return pg_query($this->DBH[$connect_no],$query);
  }

  # ｸｴﾘｰ送信 //////////////////////////////////////////////////////////////////
  # SELECT(複数ﾃﾞｰﾀ取得時),INSERT,SELECT実行
  # 引渡値：$connect_no => 接続No
  # 　　　　$sql0       => PostgreSQL用ｸｴﾘｰ(指定が無い場合MySQL共用のｸｴﾘｰ)
  # 　　　　$sql1       => MySQL用ｸｴﾘｰ
  # 　　　　$dbnm       => 接続ﾃﾞｰﾀﾍﾞｰｽ名
  # 返り値：ｸｴﾘｰ送信ﾘｿｰｽ
  function sql_set_data($connect_no,$sql0,$sql1='',$dbnm='',$code_change='') {
    if ($connect_no == '') { $connect_no = 0; }
    if ($this->emj_obj_flag == 1) {
      if ($GLOBALS['emoji_obj']->chg_code_sjis != '') {
        $sjis_type = $GLOBALS['emoji_obj']->chg_code_sjis;
      } else {
        $sjis_type = 'SJIS';
      }
      if ($GLOBALS['emoji_obj']->chg_code_euc != '') {
        $euc_type = $GLOBALS['emoji_obj']->chg_code_euc;
      } else {
        $euc_type = 'EUC';
      }
    } else {
      $sjis_type = 'SJIS';
      $euc_type  = 'EUC';
    }
    # ｸｴﾘｰ送信
    if ($sql1 == '') { $sql1 = $sql0; }
    # ﾃﾞｰﾀﾍﾞｰｽ名設定
    if ($dbnm == '') { $dbnm = $this->db_name; }
    if ($this->DB_TYPE[$connect_no] == 'Pg') {
      # PostgrSQL
      if ($code_change == 'EtoS') {
        $sql0 = @mb_convert_encoding($sql0,$sjis_type,$euc_type);
      } elseif ($code_change == 'EtoU') {
        $sql0 = @mb_convert_encoding($sql0,'UTF-8',$euc_type);
      } elseif ($code_change == 'StoE') {
        $sql0 = @mb_convert_encoding($sql0,$euc_type,$sjis_type);
      } elseif ($code_change == 'StoU') {
        $sql0 = @mb_convert_encoding($sql0,'UTF-8',$sjis_type);
      } elseif ($code_change == 'UtoS') {
        $sql0 = @mb_convert_encoding($sql0,$sjis_type,'UTF-8');
      } elseif ($code_change == 'UtoE') {
        $sql0 = @mb_convert_encoding($sql0,$euc_type,'UTF-8');
      } elseif ($code_change == 'autoS') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name($de) != mb_preferred_mime_name('SJIS')) {
            $sql0 = @mb_convert_encoding($sql0,$sjis_type,mb_detect_encoding($sql0,'auto'));
          }
        }
      } elseif ($code_change == 'autoE') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name($de) != mb_preferred_mime_name('EUC')) {
            $sql0 = @mb_convert_encoding($sql0,$euc_type,mb_detect_encoding($sql0,'auto'));
          }
        }
      } elseif ($code_change == 'autoU') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name($de) != mb_preferred_mime_name('UTF-8')) {
            $sql0 = @mb_convert_encoding($sql0,'UTF-8',mb_detect_encoding($sql0,'auto'));
          }
        }
      }
      $sth = pg_query($this->DBH[$connect_no],$sql0);
    } else {
      # MySQL
      if ($code_change == 'EtoS') {
        $sql1 = @mb_convert_encoding($sql1,$sjis_type,$euc_type);
      } elseif ($code_change == 'EtoU') {
        $sql1 = @mb_convert_encoding($sql1,'UTF-8',$euc_type);
      } elseif ($code_change == 'StoE') {
        $sql1 = @mb_convert_encoding($sql1,$euc_type,$sjis_type);
      } elseif ($code_change == 'StoU') {
        $sql1 = @mb_convert_encoding($sql1,'UTF-8',$sjis_type);
      } elseif ($code_change == 'UtoS') {
        $sql1 = @mb_convert_encoding($sql1,$sjis_type,'UTF-8');
      } elseif ($code_change == 'UtoE') {
        $sql1 = @mb_convert_encoding($sql1,$euc_type,'UTF-8');
      } elseif ($code_change == 'autoS') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name($de) != mb_preferred_mime_name('SJIS')) {
            $sql1 = @mb_convert_encoding($sql0,$sjis_type,mb_detect_encoding($sql1,'auto'));
          }
        }
      } elseif ($code_change == 'autoE') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name($de) != mb_preferred_mime_name('EUC')) {
            $sql1 = @mb_convert_encoding($sql0,$euc_type,mb_detect_encoding($sql1,'auto'));
          }
        }
      } elseif ($code_change == 'autoU') {
        $de = mb_detect_encoding($sql0,'auto');
        if ($de) {
          if (mb_preferred_mime_name() != mb_preferred_mime_name('UTF-8')) {
            $sql1 = @mb_convert_encoding($sql0,'UTF-8',mb_detect_encoding($sql1,'auto'));
          }
        }
      }
      $dbst = mysql_select_db($dbnm,$this->DBH[$connect_no]);
      $sth  = mysql_query($sql1,$this->DBH[$connect_no]);
    }
    return $sth;
  }

  # ﾃﾞｰﾀ取得用ｸｴﾘｰ送信 ////////////////////////////////////////////////////////
  # SELECT(特定ﾃﾞｰﾀ取得時)-ﾌｨｰﾙﾄﾞNo+ﾌｨｰﾙﾄﾞ名でﾃﾞｰﾀ取得
  # 引渡値：$connect_no   => 接続No
  # 　　　　$sql0         => PostgreSQL用ｸｴﾘｰ
  # 　　　　　　　　　　　　 $sql1の指定が無い場合MySQL共用のｸｴﾘｰ
  # 　　　　　　　　　　　　 $get_mode = '' 又は '0' の場合はDB接続ﾘｿｰｽ
  # 　　　　$sql1         => MySQL用ｸｴﾘｰ
  # 　　　　$dbnm         => 接続ﾃﾞｰﾀﾍﾞｰｽ名
  # 　　　　$get_mode     => 指定無し 又は 'single' →単一ﾃﾞｰﾀ取得ﾓｰﾄﾞ、'loop'→複数ﾃﾞｰﾀ取得
  # 　　　　$data_mode    => 指定無し→ﾌｨｰﾙﾄﾞNo+ﾌｨｰﾙﾄﾞ名、'num'→ﾌｨｰﾙﾄﾞNo、'ass'→ﾌｨｰﾙﾄﾞ名
  # 　　　　$data_chanege => 指定無し 又は 0 →処理なし、1→ｱﾝｴｽｹｰﾌﾟ処理有り
  # 返り値：$GETDATA      => 取得ﾃﾞｰﾀ
  function sql_get_data($connect_no,$sql0,$sql1='',$dbnm='',$get_mode='',$data_mode='',$data_change='',$code_change='') {
    if ($connect_no == '') { $connect_no = 0; }
    if ($this->emj_obj_flag == 1) {
      if ($GLOBALS['emoji_obj']->chg_code_sjis != '') {
        $sjis_type = $GLOBALS['emoji_obj']->chg_code_sjis;
      } else {
        $sjis_type = 'SJIS';
      }
      if ($GLOBALS['emoji_obj']->chg_code_euc != '') {
        $euc_type = $GLOBALS['emoji_obj']->chg_code_euc;
      } else {
        $euc_type = 'EUC';
      }
    } else {
      $sjis_type = 'SJIS';
      $euc_type  = 'EUC';
    }
    # ｸｴﾘｰ・ﾘｿｰｽ設定
    if (($get_mode == '') or ($get_mode == 'single')) {
      # 特定ﾃﾞｰﾀ取得ﾓｰﾄﾞ→ｸｴﾘｰ設定
      if ($sql1 == '') { $sql1 = $sql0; }
    } else {
      # 複数ﾃﾞｰﾀ取得ﾓｰﾄﾞ→ﾘｿｰｽ設定
      $sth = $sql0;
    }
    # ﾃﾞｰﾀﾍﾞｰｽ名設定
    if ($dbnm == '') { $dbnm = $this->db_name; }
    $GETDATA = array();
    if ($this->DB_TYPE[$connect_no] == 'Pg') {
      # PostgreSQL
      # 単一ﾃﾞｰﾀ取得時ｸｴﾘｰ送信
      if (($get_mode == '') or ($get_mode == 'single')) { $sth = pg_query($this->DBH[$connect_no],$sql0); }
      # ﾃﾞｰﾀ取得
      if ($sth) {
        if ($data_mode == '') {
          # ﾌｨｰﾙﾄﾞNo+ﾌｨｰﾙﾄﾞ名取得ﾓｰﾄﾞ
          $GETDATA = pg_fetch_array($sth,PGSQL_BOTH);
        } elseif ($data_mode == 'num') {
          # ﾌｨｰﾙﾄﾞNo取得ﾓｰﾄﾞ
          $GETDATA = pg_fetch_array($sth,PGSQL_NUM);
        } elseif ($data_mode == 'ass') {
          # ﾌｨｰﾙﾄﾞ名取得ﾓｰﾄﾞ
          $GETDATA = pg_fetch_array($sth,PGSQL_ASSOC);
        }
      }
    } else {
      # MySQL
      # ﾃﾞｰﾀﾍﾞｰｽ選択
      $dbst = mysql_select_db($dbnm,$this->DBH[$connect_no]);
      # 単一ﾃﾞｰﾀ取得時ｸｴﾘｰ送信
      if (($get_mode == '') or ($get_mode == 'single')) { $sth = mysql_query($sql1,$this->DBH[$connect_no]); }
      # ﾃﾞｰﾀ取得
      if ($sth) {
        if ($data_mode == '') {
          # ﾌｨｰﾙﾄﾞNo+ﾌｨｰﾙﾄﾞ名取得ﾓｰﾄﾞ
          $GETDATA = mysql_fetch_array($sth,MYSQL_BOTH);
        } elseif ($data_mode == 'num') {
          # ﾌｨｰﾙﾄﾞNo取得ﾓｰﾄﾞ
          $GETDATA = mysql_fetch_array($sth,MYSQL_NUM);
        } elseif ($data_mode == 'ass') {
          # ﾌｨｰﾙﾄﾞ名取得ﾓｰﾄﾞ
          $GETDATA = mysql_fetch_array($sth,MYSQL_ASSOC);
        }
      }
    }
    # ｱﾝｴｽｹｰﾌﾟ処理
    if ($data_change == '1') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) { $GETDATA[$kdt] = stripslashes($GETDATA[$kdt]); }
      }
    }
    # ｺｰﾄﾞ変換
    if ($code_change == 'EtoS') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$sjis_type,$euc_type);
        }
      }
    } elseif ($code_change == 'UtoS') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$sjis_type,'UTF-8');
        }
      }
    } elseif ($code_change == 'StoE') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$euc_type,$sjis_type);
        }
      }
    } elseif ($code_change == 'UtoE') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$euc_type,'UTF-8');
        }
      }
    } elseif ($code_change == 'StoU') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],'UTF-8',$sjis_type);
        }
      }
    } elseif ($code_change == 'EtoU') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],'UTF-8',$euc_type);
        }
      }
    } elseif ($code_change == 'autoS') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $de = mb_detect_encoding($GETDATA[$kdt],'auto');
          if ($de) {
            if (mb_preferred_mime_name($de) != mb_preferred_mime_name('SJIS')) {
              $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$sjis_type,mb_detect_encoding($GETDATA[$kdt],'auto'));
            }
          }
        }
      }
    } elseif ($code_change == 'autoE') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $de = mb_detect_encoding($GETDATA[$kdt],'auto');
          if ($de) {
            if (mb_preferred_mime_name() != mb_preferred_mime_name('EUC')) {
              $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],$euc_type,mb_detect_encoding($GETDATA[$kdt],'auto'));
            }
          }
        }
      }
    } elseif ($code_change == 'autoU') {
      if (is_array($GETDATA)) {
        $KEYDT = array();
        $KEYDT = array_keys($GETDATA);
        foreach ($KEYDT as $kdt) {
          $de = mb_detect_encoding($GETDATA[$kdt],'auto');
          if ($de) {
            if (mb_preferred_mime_name() != mb_preferred_mime_name('UTF-8')) {
              $GETDATA[$kdt] = @mb_convert_encoding($GETDATA[$kdt],'UTF-8',mb_detect_encoding($GETDATA[$kdt],'auto'));
            }
          }
        }
      }
    }
    return $GETDATA;
  }

  # ﾃｰﾌﾞﾙﾁｪｯｸ ///////////////////////////////////////////////////////////////////
  function table_check($connect_no,$table_name='',$dbnm='') {
    $RTNDATA = array();
    # ｺﾏﾝﾄﾞ調整
    if ($this->dbd == 'Pg') { $auto_no = 'serial'; } elseif ($this->dbd == 'mysql') { $auto_no = 'auto_increment'; }
    # 絵文字変換対象'emj_emoji'ﾃｰﾌﾞﾙﾁｪｯｸ
    if (($table_name == '') or ($table_name == 'emj_emoji')) {
      $check_tablename = 'emj_emoji';
      $field_list      = "Base_emj_id char(10) primary key,script_code char(20),DoCoMo_no char(10),SoftBank_no char(10),au_no char(10),yusen_no char(10),sub0 text,sub1 text,sub2 text,sub3 text,sub4 text,regdate int8,editdate int8";
      $INDEXLIST       = array();
      $INDEXLIST[]     = 'DoCoMo_no';
      $INDEXLIST[]     = 'SoftBank_no';
      $INDEXLIST[]     = 'au_no';
      $sts             = $this->db_check($connect_no,$check_tablename,$field_list,'1',$dbnm,'',$INDEXLIST);
      $RTNDATA[$check_tablename] = $sts;
    }
    # DoCoMo絵文字情報'emj_DoCoMo'ﾃｰﾌﾞﾙﾁｪｯｸ
    if (($table_name == '') or ($table_name == 'emj_DoCoMo')) {
      $check_tablename = 'emj_DoCoMo';
      $field_list      = "DoCoMo_emj_id char(10) primary key,emj_name char(50),emj_file char(255),sjis16 char(10),sjis10 char(10),web_code char(10),unicode char(10),color char(10),mail_code char(10),utf_8 char(10),sub0 text,sub1 text,sub2 text,sub3 text,sub4 text,regdate int8,editdate int8";
      $INDEXLIST       = array();
      $INDEXLIST[]     = 'sjis16';
      $INDEXLIST[]     = 'sjis10';
      $sts             = $this->db_check($connect_no,$check_tablename,$field_list,'1',$dbnm,'',$INDEXLIST);
      $RTNDATA[$check_tablename] = $sts;
    }
    # au絵文字情報'emj_au'ﾃｰﾌﾞﾙﾁｪｯｸ
    if (($table_name == '') or ($table_name == 'emj_au')) {
      $check_tablename = 'emj_au';
      $field_list      = "au_emj_id char(10) primary key,emj_name char(50),emj_file char(255),sjis16 char(10),sjis10 char(10),web_code char(10),unicode char(10),color char(10),mail_code char(10),utf_8 char(10),sub0 text,sub1 text,sub2 text,sub3 text,sub4 text,regdate int8,editdate int8";
      $INDEXLIST       = array();
      $INDEXLIST[]     = 'sjis16';
      $INDEXLIST[]     = 'sjis10';
      $INDEXLIST[]     = 'mail_code';
      $sts             = $this->db_check($connect_no,$check_tablename,$field_list,'1',$dbnm,'',$INDEXLIST);
      $RTNDATA[$check_tablename] = $sts;
    }
    # SoftBank絵文字情報'emj_SoftBank'ﾃｰﾌﾞﾙﾁｪｯｸ
    if (($table_name == '') or ($table_name == 'emj_SoftBank')) {
      $check_tablename = 'emj_SoftBank';
      $field_list      = "SoftBank_emj_id char(10) primary key,emj_name char(50),emj_file char(255),sjis16 char(10),sjis10 char(10),web_code char(10),unicode char(10),color char(10),mail_code char(10),utf_8 char(10),sub0 text,sub1 text,sub2 text,sub3 text,sub4 text,regdate int8,editdate int8";
      $INDEXLIST       = array();
      $INDEXLIST[]     = 'sjis16';
      $sts             = $this->db_check($connect_no,$check_tablename,$field_list,'1',$dbnm,'',$INDEXLIST);
      $RTNDATA[$check_tablename] = $sts;
    }
    # 携帯端末情報'Phone_Spec'ﾃｰﾌﾞﾙﾁｪｯｸ
    if (($table_name == '') or ($table_name == 'Phone_Spec')) {
      $check_tablename = 'Phone_Spec';
      $field_list      = "career char(20),kubun char(10),maker char(20),model char(10),yusen char(5),user_agent_patt char(255),sikibetu char(5),check_point char(5),check_string char(100),img_mime char(20),img_ext char(20),mov_mime char(20),mov_ext char(20),mov_size char(10),mov_download_max_size char(10),mov_stream_max_size char(10),display_width char(5),display_height char(5),display_color char(10),cache_size char(10),fitmov_patt_name1 char(255),fitmov_patt_name2 char(255),biko0 char(255),biko1 char(255),biko2 char(255),sub0 text,sub1 text,sub2 text,sub3 text,sub4 text,regdate int8,editdate int8";
      $INDEXLIST       = array();
      $INDEXLIST[]     = 'model';
      $INDEXLIST[]     = 'check_string';
      $sts             = $this->db_check($connect_no,$check_tablename,$field_list,'1',$dbnm,'',$INDEXLIST);
      $RTNDATA[$check_tablename] = $sts;
    }
    return $RTNDATA;
  }

}

?>