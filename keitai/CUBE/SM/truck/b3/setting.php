<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;


if($_REQUEST["update_re"]=="更新する") {
	if($_REQUEST["bukken_id_admin"]==NULL) {
		$_REQUEST["bukken_id_admin"]=0;
	}
	if($_REQUEST["bukken_id_view"]==NULL) {
		$_REQUEST["bukken_id_view"]=0;
	}
	if($_REQUEST["syumoku_admin"]==NULL) {
		$_REQUEST["syumoku_admin"]=0;
	}
	if($_REQUEST["syumoku_view"]==NULL) {
		$_REQUEST["syumoku_view"]=0;
	}
	if($_REQUEST["bukken_mei_admin"]==NULL) {
		$_REQUEST["bukken_mei_admin"]=0;
	}
	if($_REQUEST["bukken_mei_view"]==NULL) {
		$_REQUEST["bukken_mei_view"]=0;
	}

	if($_REQUEST["bukken_hurigana_admin"]==NULL) {
		$_REQUEST["bukken_hurigana_admin"]=0;
	}
	if($_REQUEST["bukken_hurigana_view"]==NULL) {
		$_REQUEST["bukken_hurigana_view"]=0;
	}
	if($_REQUEST["heya_bangou_admin"]==NULL) {
		$_REQUEST["heya_bangou_admin"]=0;
	}
	if($_REQUEST["heya_bangou_view"]==NULL) {
		$_REQUEST["heya_bangou_view"]=0;
	}
	if($_REQUEST["jyusyo_admin"]==NULL) {
		$_REQUEST["jyusyo_admin"]=0;
	}
	if($_REQUEST["jyusyo_view"]==NULL) {
		$_REQUEST["jyusyo_view"]=0;
	}
	if($_REQUEST["ensen_admin"]==NULL) {
		$_REQUEST["ensen_admin"]=0;
	}
	if($_REQUEST["ensen_view"]==NULL) {
		$_REQUEST["ensen_view"]=0;
	}
	if($_REQUEST["basu_admin"]==NULL) {
		$_REQUEST["basu_admin"]=0;
	}
	if($_REQUEST["basu_view"]==NULL) {
		$_REQUEST["basu_view"]=0;
	}
	if($_REQUEST["kuruma_admin"]==NULL) {
		$_REQUEST["kuruma_admin"]=0;
	}
	if($_REQUEST["kuruma_view"]==NULL) {
		$_REQUEST["kuruma_view"]=0;
	}
	if($_REQUEST["syougakkouku_admin"]==NULL) {
		$_REQUEST["syougakkouku_admin"]=0;
	}
	if($_REQUEST["syougakkouku_view"]==NULL) {
		$_REQUEST["syougakkouku_view"]=0;
	}
	if($_REQUEST["chuugakouku_admin"]==NULL) {
		$_REQUEST["chuugakouku_admin"]=0;
	}
	if($_REQUEST["chuugakouku_view"]==NULL) {
		$_REQUEST["chuugakouku_view"]=0;
	}
	if($_REQUEST["kakaku_admin"]==NULL) {
		$_REQUEST["kakaku_admin"]=0;
	}
	if($_REQUEST["kakaku_view"]==NULL) {
		$_REQUEST["kakaku_view"]=0;
	}
	if($_REQUEST["kouzou_admin"]==NULL) {
		$_REQUEST["kouzou_admin"]=0;
	}
	if($_REQUEST["kouzou_view"]==NULL) {
		$_REQUEST["kouzou_view"]=0;
	}
	if($_REQUEST["kaisou_admin"]==NULL) {
		$_REQUEST["kaisou_admin"]=0;
	}
	if($_REQUEST["kaisou_view"]==NULL) {
		$_REQUEST["kaisou_view"]=0;
	}
	if($_REQUEST["chiku_nen_admin"]==NULL) {
		$_REQUEST["chiku_nen_admin"]=0;
	}
	if($_REQUEST["chiku_nen_view"]==NULL) {
		$_REQUEST["chiku_nen_view"]=0;
	}
	if($_REQUEST["shinchiku_admin"]==NULL) {
		$_REQUEST["shinchiku_admin"]=0;
	}
	if($_REQUEST["shinchiku_view"]==NULL) {
		$_REQUEST["shinchiku_view"]=0;
	}
	if($_REQUEST["shikikin_admin"]==NULL) {
		$_REQUEST["shikikin_admin"]=0;
	}
	if($_REQUEST["shikikin_view"]==NULL) {
		$_REQUEST["shikikin_view"]=0;
	}
	if($_REQUEST["reikin_admin"]==NULL) {
		$_REQUEST["reikin_admin"]=0;
	}
	if($_REQUEST["reikin_view"]==NULL) {
		$_REQUEST["reikin_view"]=0;
	}
	if($_REQUEST["kanrihi_admin"]==NULL) {
		$_REQUEST["kanrihi_admin"]=0;
	}
	if($_REQUEST["kanrihi_view"]==NULL) {
		$_REQUEST["kanrihi_view"]=0;
	}
	if($_REQUEST["kyouekihi_admin"]==NULL) {
		$_REQUEST["kyouekihi_admin"]=0;
	}
	if($_REQUEST["kyouekihi_view"]==NULL) {
		$_REQUEST["kyouekihi_view"]=0;
	}
	if($_REQUEST["syuzenhi_tsumitate_admin"]==NULL) {
		$_REQUEST["syuzenhi_tsumitate_admin"]=0;
	}
	if($_REQUEST["syuzenhi_tsumitate_view"]==NULL) {
		$_REQUEST["syuzenhi_tsumitate_view"]=0;
	}
	if($_REQUEST["zappi_admin"]==NULL) {
		$_REQUEST["zappi_admin"]=0;
	}
	if($_REQUEST["zappi_view"]==NULL) {
		$_REQUEST["zappi_view"]=0;
	}
	if($_REQUEST["hosyoukin_admin"]==NULL) {
		$_REQUEST["hosyoukin_admin"]=0;
	}
	if($_REQUEST["hosyoukin_view"]==NULL) {
		$_REQUEST["hosyoukin_view"]=0;
	}
	if($_REQUEST["chusyajou_admin"]==NULL) {
		$_REQUEST["chusyajou_admin"]=0;
	}
	if($_REQUEST["chusyajou_view"]==NULL) {
		$_REQUEST["chusyajou_view"]=0;
	}
	if($_REQUEST["menseki_admin"]==NULL) {
		$_REQUEST["menseki_admin"]=0;
	}
	if($_REQUEST["menseki_view"]==NULL) {
		$_REQUEST["menseki_view"]=0;
	}
	if($_REQUEST["senyumenseki_admin"]==NULL) {
		$_REQUEST["senyumenseki_admin"]=0;
	}
	if($_REQUEST["senyumenseki_view"]==NULL) {
		$_REQUEST["senyumenseki_view"]=0;
	}
	if($_REQUEST["kenrikin_admin"]==NULL) {
		$_REQUEST["kenrikin_admin"]=0;
	}
	if($_REQUEST["kenrikin_view"]==NULL) {
		$_REQUEST["kenrikin_view"]=0;
	}
	if($_REQUEST["tochi_kenri_admin"]==NULL) {
		$_REQUEST["tochi_kenri_admin"]=0;
	}
	if($_REQUEST["tochi_kenri_view"]==NULL) {
		$_REQUEST["tochi_kenri_view"]=0;
	}
	if($_REQUEST["shidoumenseki_admin"]==NULL) {
		$_REQUEST["shidoumenseki_admin"]=0;
	}
	if($_REQUEST["shidoumenseki_view"]==NULL) {
		$_REQUEST["shidoumenseki_view"]=0;
	}
	if($_REQUEST["tsubotanka_admin"]==NULL) {
		$_REQUEST["tsubotanka_admin"]=0;
	}
	if($_REQUEST["tsubotanka_view"]==NULL) {
		$_REQUEST["tsubotanka_view"]=0;
	}
	if($_REQUEST["kenpei_ritsu_admin"]==NULL) {
		$_REQUEST["kenpei_ritsu_admin"]=0;
	}
	if($_REQUEST["kenpei_ritsu_view"]==NULL) {
		$_REQUEST["kenpei_ritsu_view"]=0;
	}
	if($_REQUEST["youseki_ritsu_admin"]==NULL) {
		$_REQUEST["youseki_ritsu_admin"]=0;
	}
	if($_REQUEST["youseki_ritsu_view"]==NULL) {
		$_REQUEST["youseki_ritsu_view"]=0;
	}
	if($_REQUEST["toshikeikaku_admin"]==NULL) {
		$_REQUEST["toshikeikaku_admin"]=0;
	}
	if($_REQUEST["toshikeikaku_view"]==NULL) {
		$_REQUEST["toshikeikaku_view"]=0;
	}
	if($_REQUEST["youtochiiki_admin"]==NULL) {
		$_REQUEST["youtochiiki_admin"]=0;
	}
	if($_REQUEST["youtochiiki_view"]==NULL) {
		$_REQUEST["youtochiiki_view"]=0;
	}
	if($_REQUEST["chimoku_view"]==NULL) {
		$_REQUEST["chimoku_view"]=0;
	}
	if($_REQUEST["chimoku_admin"]==NULL) {
		$_REQUEST["chimoku_admin"]=0;
	}
	if($_REQUEST["chisei_admin"]==NULL) {
		$_REQUEST["chisei_admin"]=0;
	}
	if($_REQUEST["chisei_view"]==NULL) {
		$_REQUEST["chisei_view"]=0;
	}
	if($_REQUEST["syakuchikikan_chidai_admin"]==NULL) {
		$_REQUEST["syakuchikikan_chidai_admin"]=0;
	}
	if($_REQUEST["syakuchikikan_chidai_view"]==NULL) {
		$_REQUEST["syakuchikikan_chidai_view"]=0;
	}
	if($_REQUEST["ichijikin_admin"]==NULL) {
		$_REQUEST["ichijikin_admin"]=0;
	}
	if($_REQUEST["ichijikin_view"]==NULL) {
		$_REQUEST["ichijikin_view"]=0;
	}
	if($_REQUEST["barukoni_houkou_admin"]==NULL) {
		$_REQUEST["barukoni_houkou_admin"]=0;
	}
	if($_REQUEST["barukoni_houkou_view"]==NULL) {
		$_REQUEST["barukoni_houkou_view"]=0;
	}
	if($_REQUEST["madori_admin"]==NULL) {
		$_REQUEST["madori_admin"]=0;
	}
	if($_REQUEST["madori_view"]==NULL) {
		$_REQUEST["madori_view"]=0;
	}
	if($_REQUEST["madori_syousai_admin"]==NULL) {
		$_REQUEST["madori_syousai_admin"]=0;
	}
	if($_REQUEST["madori_syousai_view"]==NULL) {
		$_REQUEST["madori_syousai_view"]=0;
	}
	if($_REQUEST["tatemono_chintaisyaku_kubun_admin"]==NULL) {
		$_REQUEST["tatemono_chintaisyaku_kubun_admin"]=0;
	}
	if($_REQUEST["tatemono_chintaisyaku_kubun_view"]==NULL) {
		$_REQUEST["tatemono_chintaisyaku_kubun_view"]=0;
	}
	if($_REQUEST["photo_admin"]==NULL) {
		$_REQUEST["photo_admin"]=0;
	}
	if($_REQUEST["photo_view"]==NULL) {
		$_REQUEST["photo_view"]=0;
	}
	if($_REQUEST["madorizu_admin"]==NULL) {
		$_REQUEST["madorizu_admin"]=0;
	}
	if($_REQUEST["madorizu_view"]==NULL) {
		$_REQUEST["madorizu_view"]=0;
	}
	if($_REQUEST["genkyou_admin"]==NULL) {
		$_REQUEST["genkyou_admin"]=0;
	}
	if($_REQUEST["genkyou_view"]==NULL) {
		$_REQUEST["genkyou_view"]=0;
	}
	if($_REQUEST["hikiwatashi_admin"]==NULL) {
		$_REQUEST["hikiwatashi_admin"]=0;
	}
	if($_REQUEST["hikiwatashi_view"]==NULL) {
		$_REQUEST["hikiwatashi_view"]=0;
	}
	if($_REQUEST["kokudohou_admin"]==NULL) {
		$_REQUEST["kokudohou_admin"]=0;
	}
	if($_REQUEST["kokudohou_view"]==NULL) {
		$_REQUEST["kokudohou_view"]=0;
	}
	if($_REQUEST["setsubi_naka_admin"]==NULL) {
		$_REQUEST["setsubi_naka_admin"]=0;
	}
	if($_REQUEST["setsubi_naka_view"]==NULL) {
		$_REQUEST["setsubi_naka_view"]=0;
	}
	if($_REQUEST["setsumi_soto_admin"]==NULL) {
		$_REQUEST["setsumi_soto_admin"]=0;
	}
	if($_REQUEST["setsumi_soto_view"]==NULL) {
		$_REQUEST["setsumi_soto_view"]=0;
	}
	if($_REQUEST["jouken_admin"]==NULL) {
		$_REQUEST["jouken_admin"]=0;
	}
	if($_REQUEST["jouken_view"]==NULL) {
		$_REQUEST["jouken_view"]=0;
	}
	if($_REQUEST["torihikitaiyou_admin"]==NULL) {
		$_REQUEST["torihikitaiyou_admin"]=0;
	}
	if($_REQUEST["torihikitaiyou_view"]==NULL) {
		$_REQUEST["torihikitaiyou_view"]=0;
	}
	if($_REQUEST["setsudou_admin"]==NULL) {
		$_REQUEST["setsudou_admin"]=0;
	}
	if($_REQUEST["setsudou_view"]==NULL) {
		$_REQUEST["setsudou_view"]=0;
	}
	$upsql="update bukken_setting2 set ".
					"bukken_id_name='".$_REQUEST["bukken_id_name"]."',".
					"bukken_id_admin=".$_REQUEST["bukken_id_admin"].",".
					"bukken_id_view=".$_REQUEST["bukken_id_view"].",".
					"syumoku_name='".$_REQUEST["syumoku_name"]."',".
					"syumoku_admin=".$_REQUEST["syumoku_admin"].",".
					"syumoku_view=".$_REQUEST["syumoku_view"].",".
					"bukken_mei_name='".$_REQUEST["bukken_mei_name"]."',".
					"bukken_mei_admin=".$_REQUEST["bukken_mei_admin"].",".
					"bukken_mei_view=".$_REQUEST["bukken_mei_view"].",".
					"bukken_hurigana_name='".$_REQUEST["bukken_hurigana_name"]."',".
					"bukken_hurigana_admin=".$_REQUEST["bukken_hurigana_admin"].",".
					"bukken_hurigana_view=".$_REQUEST["bukken_hurigana_view"].",".
					"heya_bangou_name='".$_REQUEST["heya_bangou_name"]."',".
					"heya_bangou_admin=".$_REQUEST["heya_bangou_admin"].",".
					"heya_bangou_view=".$_REQUEST["heya_bangou_view"].",".
					"jyusyo_name='".$_REQUEST["jyusyo_name"]."',".
					"jyusyo_admin=".$_REQUEST["jyusyo_admin"].",".
					"jyusyo_view=".$_REQUEST["jyusyo_view"].",".
					"ensen_name='".$_REQUEST["ensen_name"]."',".
					"ensen_admin=".$_REQUEST["ensen_admin"].",".
					"ensen_view=".$_REQUEST["ensen_view"].",".
					"basu_name='".$_REQUEST["basu_name"]."',".
					"basu_admin=".$_REQUEST["basu_admin"].",".
					"basu_view=".$_REQUEST["basu_view"].",".
					"kuruma_name='".$_REQUEST["kuruma_name"]."',".
					"kuruma_admin=".$_REQUEST["kuruma_admin"].",".
					"kuruma_view=".$_REQUEST["kuruma_view"].",".
					"syougakkouku_name='".$_REQUEST["syougakkouku_name"]."',".
					"syougakkouku_admin=".$_REQUEST["syougakkouku_admin"].",".
					"syougakkouku_view =".$_REQUEST["syougakkouku_view"].",".
					"chuugakouku_name='".$_REQUEST["chuugakouku_name"]."',".
					"chuugakouku_admin=".$_REQUEST["chuugakouku_admin"].",".
					"chuugakouku_view=".$_REQUEST["chuugakouku_view"].",".
					"kakaku_name='".$_REQUEST["kakaku_name"]."',".
					"kakaku_admin=".$_REQUEST["kakaku_admin"].",".
					"kakaku_view =".$_REQUEST["kakaku_view"].",".
					"kouzou_name='".$_REQUEST["kouzou_name"]."',".
					"kouzou_admin=".$_REQUEST["kouzou_admin"].",".
					"kouzou_view=".$_REQUEST["kouzou_view"].",".
					"kaisou_name='".$_REQUEST["kaisou_name"]."',".
					"kaisou_admin=".$_REQUEST["kaisou_admin"].",".
					"kaisou_view=".$_REQUEST["kaisou_view"].",".
					"chiku_nen_name='".$_REQUEST["chiku_nen_name"]."',".
					"chiku_nen_admin=".$_REQUEST["chiku_nen_admin"].",".
					"chiku_nen_view=".$_REQUEST["chiku_nen_view"].",".
					"shinchiku_name='".$_REQUEST["shinchiku_name"]."',".
					"shinchiku_admin=".$_REQUEST["shinchiku_admin"].",".
					"shinchiku_view =".$_REQUEST["shinchiku_view"].",".
					"shikikin_name='".$_REQUEST["shikikin_name"]."',".
					"shikikin_admin=".$_REQUEST["shikikin_admin"].",".
					"shikikin_view =".$_REQUEST["shikikin_view"].",".
					"reikin_name ='".$_REQUEST["reikin_name"]."',".
					"reikin_admin=".$_REQUEST["reikin_admin"].",".
					"reikin_view=".$_REQUEST["reikin_view"].",".
					"kanrihi_name='".$_REQUEST["kanrihi_name"]."',".
					"kanrihi_admin=".$_REQUEST["kanrihi_admin"].",".
					"kanrihi_view=".$_REQUEST["kanrihi_view"].",".
					"kyouekihi_name='".$_REQUEST["kyouekihi_name"]."',".
					"kyouekihi_admin=".$_REQUEST["kyouekihi_admin"].",".
					"kyouekihi_view=".$_REQUEST["kyouekihi_view"].",".
					"syuzenhi_tsumitate_name='".$_REQUEST["syuzenhi_tsumitate_name"]."',".
					"syuzenhi_tsumitate_admin =".$_REQUEST["syuzenhi_tsumitate_admin"].",".
					"syuzenhi_tsumitate_view =".$_REQUEST["syuzenhi_tsumitate_view"].",".
					"zappi_name='".$_REQUEST["zappi_name"]."',".
					"zappi_admin=".$_REQUEST["zappi_admin"].",".
					"zappi_view=".$_REQUEST["zappi_view"].",".
					"hosyoukin_name='".$_REQUEST["hosyoukin_name"]."',".
					"hosyoukin_admin=".$_REQUEST["hosyoukin_admin"].",".
					"hosyoukin_view=".$_REQUEST["hosyoukin_view"].",".
					"chusyajou_name='".$_REQUEST["chusyajou_name"]."',".
					"chusyajou_admin =".$_REQUEST["chusyajou_admin"].",".
					"chusyajou_view =".$_REQUEST["chusyajou_view"].",".
					"menseki_name='".$_REQUEST["menseki_name"]."',".
					"menseki_admin=".$_REQUEST["menseki_admin"].",".
					"menseki_view=".$_REQUEST["menseki_view"].",".
					"senyumenseki_name='".$_REQUEST["senyumenseki_name"]."',".
					"senyumenseki_admin=".$_REQUEST["senyumenseki_admin"].",".
					"senyumenseki_view=".$_REQUEST["senyumenseki_view"].",".
					"kenrikin_name='".$_REQUEST["kenrikin_name"]."',".
					"kenrikin_admin=".$_REQUEST["kenrikin_admin"].",".
					"kenrikin_view=".$_REQUEST["kenrikin_view"].",".
					"tochi_kenri_name ='".$_REQUEST["tochi_kenri_name"]."',".
					"tochi_kenri_admin=".$_REQUEST["tochi_kenri_admin"].",".
					"tochi_kenri_view=".$_REQUEST["tochi_kenri_view"].",".
					"shidoumenseki_name='".$_REQUEST["shidoumenseki_name"]."',".
					"shidoumenseki_admin=".$_REQUEST["shidoumenseki_admin"].",".
					"shidoumenseki_view=".$_REQUEST["shidoumenseki_view"].",".
					"tsubotanka_name='".$_REQUEST["tsubotanka_name"]."',".
					"tsubotanka_admin=".$_REQUEST["tsubotanka_admin"].",".
					"tsubotanka_view =".$_REQUEST["tsubotanka_view"].",".
					"kenpei_ritsu_name='".$_REQUEST["kenpei_ritsu_name"]."',".
					"kenpei_ritsu_admin=".$_REQUEST["kenpei_ritsu_admin"].",".
					"kenpei_ritsu_view=".$_REQUEST["kenpei_ritsu_view"].",".
					"youseki_ritsu_name='".$_REQUEST["youseki_ritsu_name"]."',".
					"youseki_ritsu_admin=".$_REQUEST["youseki_ritsu_admin"].",".
					"youseki_ritsu_view=".$_REQUEST["youseki_ritsu_view"].",".
					"toshikeikaku_name='".$_REQUEST["toshikeikaku_name"]."',".
					"toshikeikaku_admin=".$_REQUEST["toshikeikaku_admin"].",".
					"toshikeikaku_view =".$_REQUEST["toshikeikaku_view"].",".
					"youtochiiki_name='".$_REQUEST["youtochiiki_name"]."',".
					"youtochiiki_admin =".$_REQUEST["youtochiiki_admin"].",".
					"youtochiiki_view =".$_REQUEST["youtochiiki_view"].",".
					"chimoku_name='".$_REQUEST["chimoku_name"]."',".
					"chimoku_view=".$_REQUEST["chimoku_view"].",".
					"chimoku_admin=".$_REQUEST["chimoku_admin"].",".
					"chisei_name='".$_REQUEST["chisei_name"]."',".
					"chisei_admin=".$_REQUEST["chisei_admin"].",".
					"chisei_view =".$_REQUEST["chisei_view"].",".
					"syakuchikikan_chidai_name='".$_REQUEST["syakuchikikan_chidai_name"]."',".
					"syakuchikikan_chidai_admin=".$_REQUEST["syakuchikikan_chidai_admin"].",".
					"syakuchikikan_chidai_view =".$_REQUEST["syakuchikikan_chidai_view"].",".
					"ichijikin_name='".$_REQUEST["ichijikin_name"]."',".
					"ichijikin_admin=".$_REQUEST["ichijikin_admin"].",".
					"ichijikin_view=".$_REQUEST["ichijikin_view"].",".
					"barukoni_houkou_name='".$_REQUEST["barukoni_houkou_name"]."',".
					"barukoni_houkou_admin=".$_REQUEST["barukoni_houkou_admin"].",".
					"barukoni_houkou_view=".$_REQUEST["barukoni_houkou_view"].",".
					"madori_name='".$_REQUEST["madori_name"]."',".
					"madori_admin=".$_REQUEST["madori_admin"].",".
					"madori_view=".$_REQUEST["madori_view"].",".
					"madori_syousai_name='".$_REQUEST["madori_syousai_name"]."',".
					"madori_syousai_admin=".$_REQUEST["madori_syousai_admin"].",".
					"madori_syousai_view=".$_REQUEST["madori_syousai_view"].",".
					"tatemono_chintaisyaku_kubun_name='".$_REQUEST["tatemono_chintaisyaku_kubun_name"]."',".
					"tatemono_chintaisyaku_kubun_admin=".$_REQUEST["tatemono_chintaisyaku_kubun_admin"].",".
					"tatemono_chintaisyaku_kubun_view=".$_REQUEST["tatemono_chintaisyaku_kubun_view"].",".
					"photo_name='".$_REQUEST["photo_name"]."',".
					"photo_admin=".$_REQUEST["photo_admin"].",".
					"photo_view=".$_REQUEST["photo_view"].",".
					"madorizu_name='".$_REQUEST["madorizu_name"]."',".
					"madorizu_admin =".$_REQUEST["madorizu_admin"].",".
					"madorizu_view=".$_REQUEST["madorizu_view"].",".
					"genkyou_name='".$_REQUEST["genkyou_name"]."',".
					"genkyou_admin=".$_REQUEST["genkyou_admin"].",".
					"genkyou_view=".$_REQUEST["genkyou_view"].",".
					"hikiwatashi_name='".$_REQUEST["hikiwatashi_name"]."',".
					"hikiwatashi_admin=".$_REQUEST["hikiwatashi_admin"].",".
					"hikiwatashi_view=".$_REQUEST["hikiwatashi_view"].",".
					"kokudohou_name='".$_REQUEST["kokudohou_name"]."',".
					"kokudohou_admin=".$_REQUEST["kokudohou_admin"].",".
					"kokudohou_view=".$_REQUEST["kokudohou_view"].",".
					"setsubi_naka_name='".$_REQUEST["setsubi_naka_name"]."',".
					"setsubi_naka_admin=".$_REQUEST["setsubi_naka_admin"].",".
					"setsubi_naka_view =".$_REQUEST["setsubi_naka_view"].",".
					"setsumi_soto_name ='".$_REQUEST["setsumi_soto_name"]."',".
					"setsumi_soto_admin=".$_REQUEST["setsumi_soto_admin"].",".
					"setsumi_soto_view=".$_REQUEST["setsumi_soto_view"].",".
					"jouken_name='".$_REQUEST["jouken_name"]."',".
					"jouken_admin=".$_REQUEST["jouken_admin"].",".
					"jouken_view=".$_REQUEST["jouken_view"].",".
					"torihikitaiyou_name ='".$_REQUEST["torihikitaiyou_name"]."',".
					"torihikitaiyou_admin=".$_REQUEST["torihikitaiyou_admin"].",".
					"torihikitaiyou_view=".$_REQUEST["torihikitaiyou_view"].",".
					"setsudou_name='".$_REQUEST["setsudou_name"]."',".
					"setsudou_admin=".$_REQUEST["setsudou_admin"].",".
					"setsudou_view=".$_REQUEST["setsudou_view"]." ".
					" where cate_id =6";
			$dbobj->Query($upsql);		
}
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =6");


?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
	history.back();
}
</script>
<style type="text/css">
<!--
.btmwidth_100 {
	width: 100px;
	font-weight: bold;
	text-transform: uppercase;
	text-align: center;
	height: 40px;
}
-->
</style>
<script language="javascript">
function realestate_move(mode) {
	location.replace("index.php?mode=lease_"+mode+"&realestate_id=");
}
function chsyougaku(){
	//alert(data.value);
	document.bukken_form.syougakkouku.value=document.bukken_form.syougakkou.value;
}
function chchugaku(){
	//alert(data.value);
	document.bukken_form.chuugakouku.value=document.bukken_form.chugakkou.value;
}
function zipcode() {
	var zipcode;
	var address;
	zipcode=document.bukken_form.yubinbangou.value;
	result=showModalDialog("tool/zipsearch.php?zipcode="+zipcode,"test");
	address=result.split(",");
	document.bukken_form.todouhuken.value=address[0];
	document.bukken_form.jyusyo1.value=address[1];
	document.bukken_form.jyusyo2.value=address[2];
}

function realestate_move(mode) {
	location.replace("index.php?PAGEID=realestate&mode=lease_"+mode+"&realestate_id=");
}

function  gotolist() {
	location.replace("index.php?PID=re_b3");
}

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td>
						<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="0" bgcolor="#CCCCCC" class="realestate_bgcolor1">
								<TR class="realestate_bgcolor2">
										<TD width="95" valign="top" bgcolor="#ECECFF">
												<div align="center"><font color="#000000"><strong><font color="#333333">表示項目設定</font></strong></font></div>
										</TD>
										<TD width="114" valign="top" bgcolor="#FFECEC">
												<div align="center"><a href="?PID=re_osetting"><font color="#000000">その他の設定</font></a></div>
										</TD>
										<TD width="119" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
										<TD width="28" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
										<TD width="314" valign="top" bgcolor="#FFFFFF">&nbsp;</TD>
								</TR>
								<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
								</form>
						</TABLE>
				</td>
		</tr>
		<tr>
				<td>
						<TABLE width="700"  border="0" align="left" cellpadding="5" cellspacing="0" class="realestate_bgcolor1">
								<TR class="realestate_bgcolor2">
										<TD colspan="2" valign="top" bgcolor="#ECECFF"><font color="#000000"><a href="?PID=re_c1_set">賃貸アパート・マンション</a>　<font color="#333333"><a href="?PID=re_c2_set">賃貸戸建て</a></font>　<font color="#333333"><a href="?PID=re_c3_set">賃貸事業用</a></font>　<font color="#333333"><a href="?PID=re_b1_set">売買マンション・戸建て</a></font>　<font color="#333333"><a href="?PID=re_b2_set">売買土地</a></font>　<font color="#333333"><strong>売買事業用</strong></font></font></TD>
								</TR>
								<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
										<TR class="realestate_bgcolor2">
												<TD align="center" valign="top">
														<table cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																<tr>
																		<td width="97" rowspan="2" bgcolor="#ececec">初期の項目名</td>
																		<td width="130" rowspan="2" bgcolor="#ececec" class="font12">現在の項目名</td>
																		<td height="22" colspan="2" bgcolor="#ececec" class="font12">
																				<div align="center">表示</div>
																		</td>
																</tr>
																<tr>
																		<td height="22" bgcolor="#ececec" class="font12">管理</td>
																		<td bgcolor="#ececec" class="font12">公開</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">物件番号</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="bukken_id_name" type="text" value="<?php echo $bsetdata["bukken_id_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="bukken_id_admin" type="checkbox" id="bukken_id_admin" value="1"<?php if($bsetdata["bukken_id_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="bukken_id_view" type="checkbox" id="bukken_id_view" value="1"<?php if($bsetdata["bukken_id_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">物件種目</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="syumoku_name" type="text" id="syumoku_name" value="<?php echo $bsetdata["syumoku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="syumoku_admin" type="hidden" id="syumoku_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="syumoku_view" type="hidden" id="syumoku_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">物件名称</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="bukken_mei_name" type="text" id="bukken_mei_name" value="<?php echo $bsetdata["bukken_mei_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="bukken_mei_admin" type="checkbox" id="bukken_mei_admin" value="1"<?php if($bsetdata["bukken_id_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="bukken_mei_view" type="checkbox" id="bukken_mei_view" value="1"<?php if($bsetdata["bukken_mei_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">物件所在地</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="jyusyo_name" type="text" id="jyusyo_name" value="<?php echo $bsetdata["jyusyo_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="jyusyo_admin" type="hidden" id="jyusyo_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="jyusyo_view" type="hidden" id="jyusyo_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">価格</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kakaku_name" type="text" id="kakaku_name" value="<?php echo $bsetdata["kakaku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kakaku_admin" type="hidden" id="kakaku_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kakaku_view" type="hidden" id="kakaku_view" value="1">
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">沿線</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="ensen_name" type="text" id="ensen_name" value="<?php echo $bsetdata["ensen_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="ensen_admin" type="hidden" id="ensen_admin" value="1">
																		  </div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="ensen_view" type="hidden" id="ensen_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">交通バス</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="basu_name" type="text" id="basu_name" value="<?php echo $bsetdata["basu_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="basu_admin" type="checkbox" id="basu_admin" value="1"<?php if($bsetdata["basu_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="basu_view" type="checkbox" id="basu_view" value="1"<?php if($bsetdata["basu_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">車</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kuruma_name" type="text" id="kuruma_name" value="<?php echo $bsetdata["kuruma_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kuruma_admin" type="checkbox" id="kuruma_admin" value="1"<?php if($bsetdata["kuruma_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kuruma_view" type="checkbox" id="kuruma_view" value="1"<?php if($bsetdata["kuruma_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">小学校区</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="syougakkouku_name" type="text" id="syougakkouku_name" value="<?php echo $bsetdata["syougakkouku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="syougakkouku_admin" type="checkbox" id="syougakkouku_id_admin" value="1"<?php if($bsetdata["syougakkouku_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="syougakkouku_view" type="checkbox" id="syougakkouku_view" value="1"<?php if($bsetdata["syougakkouku_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">中学校区</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="chuugakouku_name" type="text" value="<?php echo $bsetdata["chuugakouku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chuugakouku_admin" type="checkbox" id="chuugakouku_admin" value="1"<?php if($bsetdata["chuugakouku_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chuugakouku_view" type="checkbox" id="chuugakouku_view" value="1"<?php if($bsetdata["chuugakouku_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">建物構造</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kouzou_name" type="text" value="<?php echo $bsetdata["kouzou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																		          <input name="kouzou_admin" type="hidden" id="kouzou_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="kouzou_view" type="hidden" id="kouzou_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">階建・階</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kaisou_name" type="text" value="<?php echo $bsetdata["kaisou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kaisou_admin" type="checkbox" id="kaisou_admin" value="1"<?php if($bsetdata["kaisou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kaisou_view" type="checkbox" id="kaisou_view" value="1"<?php if($bsetdata["kaisou_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">築年月</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="chiku_nen_name" type="text" value="<?php echo $bsetdata["chiku_nen_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="chiku_nen_admin" type="hidden" id="chiku_nen_admin" value="1">
																		  </div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="chiku_nen_view" type="hidden" id="chiku_nen_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">新築</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="shinchiku_name" type="text" value="<?php echo $bsetdata["shinchiku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="shinchiku_admin" type="checkbox" id="shinchiku_admin" value="1"<?php if($bsetdata["shinchiku_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="shinchiku_view" type="checkbox" id="shinchiku_view" value="1"<?php if($bsetdata["shinchiku_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">保証金</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="hosyoukin_name" type="text" value="<?php echo $bsetdata["hosyoukin_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="hosyoukin_admin" type="checkbox" id="hosyoukin_admin" value="1"<?php if($bsetdata["hosyoukin_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="hosyoukin_view" type="checkbox" id="hosyoukin_view" value="1"<?php if($bsetdata["hosyoukin_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">権利金</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kenrikin_name" type="text" value="<?php echo $bsetdata["kenrikin_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kenrikin_admin" type="checkbox" id="kenrikin_admin" value="1"<?php if($bsetdata["kenrikin_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kenrikin_view" type="checkbox" id="kenrikin_view" value="1"<?php if($bsetdata["kenrikin_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">その他利用金</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="zappi_name" type="text" value="<?php echo $bsetdata["zappi_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="zappi_admin" type="checkbox" id="zappi_admin" value="1"<?php if($bsetdata["zappi_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="zappi_view" type="checkbox" id="zappi_view" value="1"<?php if($bsetdata["zappi_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">駐車場</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="chusyajou_name" type="text" value="<?php echo $bsetdata["chusyajou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chusyajou_admin" type="checkbox" id="chusyajou_admin" value="1"<?php if($bsetdata["chusyajou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chusyajou_view" type="checkbox" id="chusyajou_view" value="1"<?php if($bsetdata["chusyajou_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
														</table>
														<br>
														<span class="font12"> </span> </TD>
												<TD align="center" valign="top">
														<table cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
																<tr>
																		<td width="97" rowspan="2" bgcolor="#ececec">初期の項目名</td>
																		<td width="130" rowspan="2" bgcolor="#ececec" class="font12">現在の項目名</td>
																		<td height="22" colspan="2" bgcolor="#ececec" class="font12">
																				<div align="center">表示</div>
																		</td>
																</tr>
																<tr>
																		<td height="22" bgcolor="#ececec" class="font12">管理</td>
																		<td bgcolor="#ececec" class="font12">公開</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">土地権利</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="tochi_kenri_name" type="text" value="<?php echo $bsetdata["tochi_kenri_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="tochi_kenri_admin" type="checkbox" id="tochi_kenri_admin" value="1"<?php if($bsetdata["tochi_kenri_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="tochi_kenri_view" type="checkbox" id="tochi_kenri_view" value="1"<?php if($bsetdata["tochi_kenri_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">土地面積</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="menseki_name" type="text" value="<?php echo $bsetdata["menseki_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="menseki_admin" type="checkbox" id="menseki_admin" value="1"<?php if($bsetdata["menseki_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="menseki_view" type="checkbox" id="menseki_view" value="1"<?php if($bsetdata["menseki_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">建物面積</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="senyumenseki_name" type="text" value="<?php echo $bsetdata["senyumenseki_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="senyumenseki_admin" type="hidden" id="senyumenseki_admin" value="1">
																		  </div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="senyumenseki_view" type="hidden" id="senyumenseki_view" value="1">
																		  </div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">私道面積</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="shidoumenseki_name" type="text" value="<?php echo $bsetdata["shidoumenseki_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="shidoumenseki_admin" type="checkbox" id="shidoumenseki_admin" value="1"<?php if($bsetdata["shidoumenseki_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="shidoumenseki_view" type="checkbox" id="shidoumenseki_view" value="1"<?php if($bsetdata["shidoumenseki_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">建蔽率</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kenpei_ritsu_name" type="text" value="<?php echo $bsetdata["kenpei_ritsu_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kenpei_ritsu_admin" type="checkbox" id="kenpei_ritsu_admin" value="1"<?php if($bsetdata["kenpei_ritsu_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kenpei_ritsu_view" type="checkbox" id="kenpei_ritsu_view" value="1"<?php if($bsetdata["kenpei_ritsu_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">容積率</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="youseki_ritsu_name" type="text" value="<?php echo $bsetdata["youseki_ritsu_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="youseki_ritsu_admin" type="checkbox" id="youseki_ritsu_admin" value="1"<?php if($bsetdata["youseki_ritsu_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="youseki_ritsu_view" type="checkbox" id="youseki_ritsu_view" value="1"<?php if($bsetdata["youseki_ritsu_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">地目</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="chimoku_name" type="text" value="<?php echo $bsetdata["chimoku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chimoku_admin" type="checkbox" id="chimoku_admin" value="1"<?php if($bsetdata["chimoku_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chimoku_view" type="checkbox" id="chimoku_view" value="1"<?php if($bsetdata["chimoku_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">地勢</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="chisei_name" type="text" value="<?php echo $bsetdata["chisei_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chisei_admin" type="checkbox" id="chisei_admin" value="1"<?php if($bsetdata["chisei_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="chisei_view" type="checkbox" id="chisei_view" value="1"<?php if($bsetdata["chisei_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">用途地域</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="youtochiiki_name" type="text" value="<?php echo $bsetdata["youtochiiki_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="youtochiiki_admin" type="checkbox" id="youtochiiki_admin" value="1"<?php if($bsetdata["youtochiiki_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="youtochiiki_view" type="checkbox" id="youtochiiki_view" value="1"<?php if($bsetdata["youtochiiki_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">都市計画</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="toshikeikaku_name" type="text" value="<?php echo $bsetdata["toshikeikaku_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="toshikeikaku_admin" type="checkbox" id="toshikeikaku_admin" value="1"<?php if($bsetdata["toshikeikaku_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="toshikeikaku_view" type="checkbox" id="toshikeikaku_view" value="1"<?php if($bsetdata["toshikeikaku_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">借地期間・地代</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="syakuchikikan_chidai_name" type="text" value="<?php echo $bsetdata["syakuchikikan_chidai_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="syakuchikikan_chidai_admin" type="checkbox" id="syakuchikikan_chidai_admin" value="1"<?php if($bsetdata["syakuchikikan_chidai_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="syakuchikikan_chidai_view" type="checkbox" id="syakuchikikan_chidai_view" value="1"<?php if($bsetdata["syakuchikikan_chidai_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">間取り</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="madori_name" type="text" value="<?php echo $bsetdata["madori_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madori_admin" type="hidden" id="madori_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madori_view" type="hidden" id="madori_view" value="1">
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">間取り詳細</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="madori_syousai_name" type="text" value="<?php echo $bsetdata["madori_syousai_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madori_syousai_admin" type="checkbox" id="madori_syousai_admin" value="1"<?php if($bsetdata["madori_syousai_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madori_syousai_view" type="checkbox" id="madori_syousai_view" value="1"<?php if($bsetdata["madori_syousai_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">接道状況</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="setsudou_name" type="text" value="<?php echo $bsetdata["setsudou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="setsudou_admin" type="checkbox" id="setsudou_admin" value="1"<?php if($bsetdata["setsudou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="setsudou_view" type="checkbox" id="setsudou_view" value="1"<?php if($bsetdata["setsudou_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">写真</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="photo_name" type="text" value="<?php echo $bsetdata["photo_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="photo_admin" type="hidden" id="photo_admin" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="photo_view" type="hidden" id="photo_view" value="1">
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">間取図</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="madorizu_name" type="text" value="<?php echo $bsetdata["madorizu_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madorizu_admin" type="hidden" value="1">
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="madorizu_view" type="hidden" value="1">
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">現況</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="genkyou_name" type="text" value="<?php echo $bsetdata["genkyou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="genkyou_admin" type="checkbox" id="genkyou_admin" value="1"<?php if($bsetdata["genkyou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="genkyou_view" type="checkbox" id="genkyou_view" value="1"<?php if($bsetdata["genkyou_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">引渡し可能日</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="hikiwatashi_name" type="text" value="<?php echo $bsetdata["hikiwatashi_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="hikiwatashi_admin" type="checkbox" id="hikiwatashi_admin" value="1"<?php if($bsetdata["hikiwatashi_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="hikiwatashi_view" type="checkbox" id="hikiwatashi_view" value="1"<?php if($bsetdata["hikiwatashi_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">国土法</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="kokudohou_name" type="text" value="<?php echo $bsetdata["kokudohou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kokudohou_admin" type="checkbox" id="kokudohou_admin" value="1"<?php if($bsetdata["kokudohou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="kokudohou_view" type="checkbox" id="kokudohou_view" value="1"<?php if($bsetdata["kokudohou_view"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																</tr>
																<tr>
																		<td height="20" bgcolor="#FFFFFF">
																				<div align="left">取引態様</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<input name="torihikitaiyou_name" type="text" value="<?php echo $bsetdata["torihikitaiyou_name"] ?>">
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">
																				<div align="center">
																						<input name="torihikitaiyou_admin" type="checkbox" id="torihikitaiyou_admin" value="1"<?php if($bsetdata["torihikitaiyou_admin"]==1){ echo " checked";} ?>>
																				</div>
																		</td>
																		<td bgcolor="#FFFFFF" class="font12">																		  <div align="center">
																						<input name="torihikitaiyou_view" type="hidden" value="1">
																		  </div>
																		</td>
																</tr>
														</table>
												</TD>
										</TR>
										<TR class="realestate_bgcolor2">
												<TD colspan="2" align="center" valign="top">
														<table width="95%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<td width="10%">
																				<input name="update_re" type="submit" id="update_re" value="更新する" />
																		</td>
																		<td width="90%">
																				<input name="btm" type="button" id="btm" onClick="gotolist()" value="戻る" />
																		</td>
																</tr>
														</table>
												</TD>
										</TR>
								</form>
						</TABLE>
				</td>
		</tr>
</table>
