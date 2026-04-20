<?php
$re1obj=new Ad_RealEstate($dbobj);
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
$dbobj->Query("update tenpo_data set b2lastupid =".$_REQUEST["bid"]);

$re1obj->type=1;
if($_REQUEST["update_re"]=="¹¹¿·¤¹¤ë"||$_REQUEST["update_re"]=="¹¹¿·¤·¤Æ°ìÍ÷¤ØÌá¤ë") {
	$dbobj->Query("update lastupdate set lastupdate=".time()."");
if($_REQUEST["banchichk"]==NULL||$_REQUEST["banchichk"]==""){
$_REQUEST["banchichk"]=0;
}
	if($_REQUEST["menseki"]==NULL||$_REQUEST["menseki"]==""){
		$_REQUEST["menseki"]="null";
	}
	else {
		$_REQUEST["menseki"]=str_replace(",","",$_REQUEST["menseki"]);
	}

	if($_REQUEST["tsubosu"]==NULL||$_REQUEST["tsubosu"]==""){
		$_REQUEST["tsubosu"]="null";
	}
	else {
		$_REQUEST["tsubosu"]=str_replace(",","",$_REQUEST["tsubosu"]);
	}

	if($_REQUEST["tsubotanka"]==NULL||$_REQUEST["tsubotanka"]==""){
		$_REQUEST["tsubotanka"]="null";
	}
	else {
		$_REQUEST["tsubotanka"]=str_replace(",","",$_REQUEST["tsubotanka"]);
	}

	if($_REQUEST["kakaku"]==NULL||$_REQUEST["kakaku"]==""){
		$_REQUEST["kakaku"]="null";
	}
	else {		$_REQUEST["kakaku"]=str_replace(",",".",$_REQUEST["kakaku"]);
}

	if($_REQUEST["madori"]==NULL||$_REQUEST["madori"]==""){
		$_REQUEST["madori"]="null";
	}
	else {
		$_REQUEST["madori"]=str_replace(",","",$_REQUEST["madori"]);
	}

	if($_REQUEST["buntankin"]==NULL||$_REQUEST["buntankin"]==""){
		$_REQUEST["buntankin"]="null";
	}
	else {
		$_REQUEST["buntankin"]=str_replace(",","",$_REQUEST["buntankin"]);
	}

	if($_REQUEST["kenpei_ritsu"]==NULL||$_REQUEST["kenpei_ritsu"]==""){
		$_REQUEST["kenpei_ritsu"]="null";
	}
	else {
		$_REQUEST["kenpei_ritsu"]=str_replace(",","",$_REQUEST["kenpei_ritsu"]);
	}

	if($_REQUEST["youseki_ritsu"]==NULL||$_REQUEST["youseki_ritsu"]==""){
		$_REQUEST["youseki_ritsu"]="null";
	}
	else {
		$_REQUEST["youseki_ritsu"]=str_replace(",","",$_REQUEST["youseki_ritsu"]);
	}

	if($_REQUEST["chiku_nen"]==NULL||$_REQUEST["chiku_nen"]==""){
		$_REQUEST["chiku_nen"]="null";
	}
	else {
		$_REQUEST["chiku_nen"]=str_replace(",","",$_REQUEST["chiku_nen"]);
	}

	if($_REQUEST["chiku_tsuki"]==NULL||$_REQUEST["chiku_tsuki"]==""){
		$_REQUEST["chiku_tsuki"]="null";
	}
	else {
		$_REQUEST["chiku_tsuki"]=str_replace(",","",$_REQUEST["chiku_tsuki"]);
	}

	if($_REQUEST["ekiho"]==NULL||$_REQUEST["ekiho"]==""){
		$_REQUEST["ekiho"]="null";
	}
	else {
		$_REQUEST["ekiho"]=str_replace(",","",$_REQUEST["ekiho"]);
	}

	if($_REQUEST["basu_hun"]==NULL||$_REQUEST["basu_hun"]==""){
		$_REQUEST["basu_hun"]="null";
	}
	else {
		$_REQUEST["basu_hun"]=str_replace(",","",$_REQUEST["basu_hun"]);
	}

	if($_REQUEST["basu_ho"]==NULL||$_REQUEST["basu_ho"]==""){
		$_REQUEST["basu_ho"]="null";
	}
	else {
		$_REQUEST["basu_ho"]=str_replace(",","",$_REQUEST["basu_ho"]);
	}

	if($_REQUEST["kuruma"]==NULL||$_REQUEST["kuruma"]==""){
		$_REQUEST["kuruma"]="null";
	}
	else {
		$_REQUEST["kuruma"]=str_replace(",","",$_REQUEST["kuruma"]);
	}

	if($_REQUEST["kyori"]==NULL||$_REQUEST["kyori"]==""){
		$_REQUEST["kyori"]="null";
	}
	else {
		$_REQUEST["kyori"]=str_replace(",","",$_REQUEST["kyori"]);
	}

	if($_REQUEST["shikikin"]==NULL||$_REQUEST["shikikin"]==""){
		$_REQUEST["shikikin"]="null";
	}
	else {
		$_REQUEST["shikikin"]=str_replace(",","",$_REQUEST["shikikin"]);
	}

	if($_REQUEST["shikibiki_kakaku"]==NULL||$_REQUEST["shikibiki_kakaku"]==""){
		$_REQUEST["shikibiki_kakaku"]="null";
	}
	else {
		$_REQUEST["shikibiki_kakaku"]=str_replace(",","",$_REQUEST["shikibiki_kakaku"]);
	}

	if($_REQUEST["shikibiki_tsuki"]==NULL||$_REQUEST["shikibiki_tsuki"]==""){
		$_REQUEST["shikibiki_tsuki"]="null";
	}
	else {
		$_REQUEST["shikibiki_tsuki"]=str_replace(",","",$_REQUEST["shikibiki_tsuki"]);
	}

	if($_REQUEST["shikibiki_jippi"]==NULL||$_REQUEST["shikibiki_jippi"]==""){
		$_REQUEST["shikibiki_jippi"]="null";
	}
	else {
		$_REQUEST["shikibiki_jippi"]=str_replace(",","",$_REQUEST["shikibiki_jippi"]);
	}

	if($_REQUEST["reikin"]==NULL||$_REQUEST["reikin"]==""){
		$_REQUEST["reikin"]="null";
	}
	else {
		$_REQUEST["reikin"]=str_replace(",","",$_REQUEST["reikin"]);
	}

	if($_REQUEST["kyouekihi"]==NULL||$_REQUEST["kyouekihi"]==""){
		$_REQUEST["kyouekihi"]="null";
	}
	else {
		$_REQUEST["kyouekihi"]=str_replace(",","",$_REQUEST["kyouekihi"]);
	}
	

	if($_REQUEST["setsubi_naka1"]==NULL||$_REQUEST["setsubi_naka1"]==""){
		$_REQUEST["setsubi_naka1"]="null";
	}
	if($_REQUEST["setsubi_naka2"]==NULL||$_REQUEST["setsubi_naka2"]==""){
		$_REQUEST["setsubi_naka2"]="null";
	}
	if($_REQUEST["setsubi_naka3"]==NULL||$_REQUEST["setsubi_naka3"]==""){
		$_REQUEST["setsubi_naka3"]="null";
	}
	if($_REQUEST["setsubi_naka4"]==NULL||$_REQUEST["setsubi_naka4"]==""){
		$_REQUEST["setsubi_naka4"]="null";
	}
	if($_REQUEST["setsubi_naka5"]==NULL||$_REQUEST["setsubi_naka5"]==""){
		$_REQUEST["setsubi_naka5"]="null";
	}
	if($_REQUEST["setsubi_naka6"]==NULL||$_REQUEST["setsubi_naka6"]==""){
		$_REQUEST["setsubi_naka6"]="null";
	}
	if($_REQUEST["setsubi_naka7"]==NULL||$_REQUEST["setsubi_naka7"]==""){
		$_REQUEST["setsubi_naka7"]="null";
	}
	if($_REQUEST["setsubi_naka8"]==NULL||$_REQUEST["setsubi_naka8"]==""){
		$_REQUEST["setsubi_naka8"]="null";
	}
	if($_REQUEST["setsubi_naka9"]==NULL||$_REQUEST["setsubi_naka9"]==""){
		$_REQUEST["setsubi_naka9"]="null";
	}
	if($_REQUEST["setsubi_naka10"]==NULL||$_REQUEST["setsubi_naka10"]==""){
		$_REQUEST["setsubi_naka10"]="null";
	}
	if($_REQUEST["setsubi_naka11"]==NULL||$_REQUEST["setsubi_naka11"]==""){
		$_REQUEST["setsubi_naka11"]="null";
	}
	if($_REQUEST["setsubi_naka12"]==NULL||$_REQUEST["setsubi_naka12"]==""){
		$_REQUEST["setsubi_naka12"]="null";
	}
	if($_REQUEST["setsubi_naka13"]==NULL||$_REQUEST["setsubi_naka13"]==""){
		$_REQUEST["setsubi_naka13"]="null";
	}
	if($_REQUEST["setsubi_naka14"]==NULL||$_REQUEST["setsubi_naka14"]==""){
		$_REQUEST["setsubi_naka14"]="null";
	}
	if($_REQUEST["setsubi_naka15"]==NULL||$_REQUEST["setsubi_naka15"]==""){
		$_REQUEST["setsubi_naka15"]="null";
	}
	if($_REQUEST["setsubi_naka16"]==NULL||$_REQUEST["setsubi_naka16"]==""){
		$_REQUEST["setsubi_naka16"]="null";
	}
	if($_REQUEST["setsubi_naka17"]==NULL||$_REQUEST["setsubi_naka17"]==""){
		$_REQUEST["setsubi_naka17"]="null";
	}
	if($_REQUEST["setsubi_naka18"]==NULL||$_REQUEST["setsubi_naka18"]==""){
		$_REQUEST["setsubi_naka18"]="null";
	}
	if($_REQUEST["setsubi_naka19"]==NULL||$_REQUEST["setsubi_naka19"]==""){
		$_REQUEST["setsubi_naka19"]="null";
	}
	if($_REQUEST["setsubi_naka20"]==NULL||$_REQUEST["setsubi_naka20"]==""){
		$_REQUEST["setsubi_naka20"]="null";
	}
	if($_REQUEST["setsubi_soto1"]==NULL||$_REQUEST["setsubi_soto1"]==""){
		$_REQUEST["setsubi_soto1"]="null";
	}
	if($_REQUEST["setsubi_soto2"]==NULL||$_REQUEST["setsubi_soto2"]==""){
		$_REQUEST["setsubi_soto2"]="null";
	}
	if($_REQUEST["setsubi_soto3"]==NULL||$_REQUEST["setsubi_soto3"]==""){
		$_REQUEST["setsubi_soto3"]="null";
	}
	if($_REQUEST["setsubi_soto4"]==NULL||$_REQUEST["setsubi_soto4"]==""){
		$_REQUEST["setsubi_soto4"]="null";
	}
	if($_REQUEST["setsubi_soto5"]==NULL||$_REQUEST["setsubi_soto5"]==""){
		$_REQUEST["setsubi_soto5"]="null";
	}
	if($_REQUEST["setsubi_soto6"]==NULL||$_REQUEST["setsubi_soto6"]==""){
		$_REQUEST["setsubi_soto6"]="null";
	}
	if($_REQUEST["setsubi_soto7"]==NULL||$_REQUEST["setsubi_soto7"]==""){
		$_REQUEST["setsubi_soto7"]="null";
	}
	if($_REQUEST["setsubi_soto8"]==NULL||$_REQUEST["setsubi_soto8"]==""){
		$_REQUEST["setsubi_soto8"]="null";
	}
	if($_REQUEST["setsubi_soto9"]==NULL||$_REQUEST["setsubi_soto9"]==""){
		$_REQUEST["setsubi_soto9"]="null";
	}
	if($_REQUEST["setsubi_soto10"]==NULL||$_REQUEST["setsubi_soto10"]==""){
		$_REQUEST["setsubi_soto10"]="null";
	}
	if($_REQUEST["jouken1"]==NULL||$_REQUEST["jouken1"]==""){
		$_REQUEST["jouken1"]="null";
	}
	if($_REQUEST["jouken2"]==NULL||$_REQUEST["jouken2"]==""){
		$_REQUEST["jouken2"]="null";
	}
	if($_REQUEST["jouken3"]==NULL||$_REQUEST["jouken3"]==""){
		$_REQUEST["jouken3"]="null";
	}
	if($_REQUEST["jouken4"]==NULL||$_REQUEST["jouken4"]==""){
		$_REQUEST["jouken4"]="null";
	}
	if($_REQUEST["jouken5"]==NULL||$_REQUEST["jouken5"]==""){
		$_REQUEST["jouken5"]="null";
	}
	if($_REQUEST["jouken6"]==NULL||$_REQUEST["jouken6"]==""){
		$_REQUEST["jouken6"]="null";
	}
	if($_REQUEST["jouken7"]==NULL||$_REQUEST["jouken7"]==""){
		$_REQUEST["jouken7"]="null";
	}
	if($_REQUEST["jouken8"]==NULL||$_REQUEST["jouken8"]==""){
		$_REQUEST["jouken8"]="null";
	}
	if($_REQUEST["jouken9"]==NULL||$_REQUEST["jouken9"]==""){
		$_REQUEST["jouken9"]="null";
	}
	if($_REQUEST["jouken10"]==NULL||$_REQUEST["jouken10"]==""){
		$_REQUEST["jouken10"]="null";
	}
	if($_REQUEST["osusume"]==NULL||$_REQUEST["osusume"]==""){
		$_REQUEST["osusume"]="null";
	}
	if($_REQUEST["banchichk"]==NULL||$_REQUEST["banchichk"]==""){
		$_REQUEST["banchichk"]=0;
	}
	if($_REQUEST["setsubi_other1"]==NULL||$_REQUEST["setsubi_other1"]==""){
		$_REQUEST["setsubi_other1"]="null";
	}
	if($_REQUEST["setsubi_other2"]==NULL||$_REQUEST["setsubi_other2"]==""){
		$_REQUEST["setsubi_other2"]="null";
	}
	if($_REQUEST["setsubi_other3"]==NULL||$_REQUEST["setsubi_other3"]==""){
		$_REQUEST["setsubi_other3"]="null";
	}
	if($_REQUEST["setsubi_other4"]==NULL||$_REQUEST["setsubi_other4"]==""){
		$_REQUEST["setsubi_other4"]="null";
	}
	if($_REQUEST["setsubi_other5"]==NULL||$_REQUEST["setsubi_other5"]==""){
		$_REQUEST["setsubi_other5"]="null";
	}
	if($_REQUEST["setsubi_other6"]==NULL||$_REQUEST["setsubi_other6"]==""){
		$_REQUEST["setsubi_other6"]="null";
	}
	if($_REQUEST["setsubi_other7"]==NULL||$_REQUEST["setsubi_other7"]==""){
		$_REQUEST["setsubi_other7"]="null";
	}
	if($_REQUEST["setsubi_other8"]==NULL||$_REQUEST["setsubi_other8"]==""){
		$_REQUEST["setsubi_other8"]="null";
	}
	if($_REQUEST["setsubi_other9"]==NULL||$_REQUEST["setsubi_other9"]==""){
		$_REQUEST["setsubi_other9"]="null";
	}
	if($_REQUEST["setsubi_other10"]==NULL||$_REQUEST["setsubi_other10"]==""){
		$_REQUEST["setsubi_other10"]="null";
	}
					if($_REQUEST["rains_chk"]==NULL||$_REQUEST["rains_chk"]==""){
		$_REQUEST["rains_chk"]="0";
	}

	$imgobj=new Upload();
	$bname="bukken";
	$setdata["listimg_w"]=800;
	$setdata["listimg_h"]=0;
	$imagesize["big"]["w"]=800;
	$imagesize["big"]["h"]=0;
	$imagesize["top"]["w"]=145;
	$imagesize["top"]["h"]=102;
	$imagesize["normal"]["w"]=300;
	$imagesize["normal"]["h"]=211;
	$imagesize["osusume"]["w"]=120;
	$imagesize["osusume"]["h"]=84;
	$imagesize["keitai"]["w"]=250;
	$imagesize["keitai"]["h"]=176;
	$imagesize["pop1"]["w"]=230;
	$imagesize["pop1"]["h"]=161;
	$imagesize["list"]["w"]=70;
	$imagesize["list"]["h"]=50;
	
	
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/");
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/",0777);
	
	@system("chmod -Rf 0777 ".$_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid);
	
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile1=$imgobj->UpImgAndResize("photo1",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"top".$fdata["basename"],$fdata["dirname"]."/",$imagesize["top"]["w"],$imagesize["top"]["h"]);
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"list".$fdata["basename"],$fdata["dirname"]."/",$imagesize["list"]["w"],$imagesize["list"]["h"]);
	}

	$imgobj2=new Upload();
	$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj2->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile2=$imgobj2->UpImgAndResize("photo2",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"])&&$imagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
	
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
	
	}
	
	$imgobj3=new Upload();
	$imgobj3->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj3->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile3=$imgobj3->UpImgAndResize("photo3",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"])&&$imagefile3["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}
	
	
	$imgobj4=new Upload();
	$imgobj4->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj4->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile4=$imgobj4->UpImgAndResize("photo4",$imagesize["big"]["w"],$imagesize["big"]["h"]);
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"])&&$imagefile4["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
	}
	
	$imgobj5=new Upload();
	$imgobj5->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj5->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile5=$imgobj5->UpImgAndResize("photo5",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"])&&$imagefile5["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}
	
	$mimgobj1=new Upload();
	$mimgobj1->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$mimgobj1->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$mimagefile1=$mimgobj1->UpImgAndResize("madorizu1",$imagesize["big"]["w"],$imagesize["big"]["h"]);

	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"])&&$mimagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
	}

	$mimgobj2=new Upload();
	$mimgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$mimgobj2->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$mimagefile2=$mimgobj2->UpImgAndResize("madorizu2",$imagesize["big"]["w"],$imagesize["big"]["h"]);
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"])&&$mimagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",300,211);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
	}
	
	$upsql=	"update bukken set ".
					"syumoku='".$_REQUEST["syumoku"]."',".
					"bukkenn_id='".$_REQUEST["bukkenn_id"]."',".
					"bukken_mei='".$_REQUEST["bukken_mei"]."',".
					"bukken_hurigana='".$_REQUEST["bukken_hurigana"]."',".
					"heya_bangou='".$_REQUEST["heya_bangou"]."',".
					"shinchiku='".$_REQUEST["shinchiku"]."',".
					"kouzou='".$_REQUEST["kouzou"]."',".
					"tatemono_muki='".$_REQUEST["tatemono_muki"]."',".
					"kaisou='".$_REQUEST["kaisou"]."',".
					"chijoukaisou='".$_REQUEST["chijoukaisou"]."',".
					"chikakaisou='".$_REQUEST["chikakaisou"]."',".
					"kosu='".$_REQUEST["kosu"]."',".
					"menseki=".$_REQUEST["menseki"].",".
					"tsubosu=".$_REQUEST["tsubosu"].",".
					"tsubotanka=".$_REQUEST["tsubotanka"].",".
					"buntankin=".$_REQUEST["buntankin"].",".
					"kenpei_ritsu=".$_REQUEST["kenpei_ritsu"].",".
					"youseki_ritsu=".$_REQUEST["youseki_ritsu"].",".
					"chiku_nen=".$_REQUEST["chiku_nen"].",".
					"chiku_tsuki=".$_REQUEST["chiku_tsuki"].",".
					"chimoku='".$_REQUEST["chimoku"]."',".
					"chisei='".$_REQUEST["chisei"]."',".
					"youtochiiki='".$_REQUEST["youtochiiki"]."',".
					"toshikeikaku='".$_REQUEST["toshikeikaku"]."',".
					"saitekiyouto='".$_REQUEST["saitekiyouto"]."',".
					"syozaichikodo='".$_REQUEST["syozaichikodo"]."',".
					"yubinbangou='".$_REQUEST["yubinbangou"]."',".
					"todouhuken='".$_REQUEST["todouhuken"]."',".
					"jyusyo1='".$_REQUEST["jyusyo1"]."',".
					"jyusyo2='".$_REQUEST["jyusyo2"]."',".
					"jyusyo3='".$_REQUEST["jyusyo3"]."',".
					"syougakkouku='".$_REQUEST["syougakkouku"].$_REQUEST["syougakkou"]."¾®³Ø¹»',".
					"chuugakouku='".$_REQUEST["chuugakouku"].$_REQUEST["chugakkou"]."Ãæ³Ø¹»',".
					"ensen='".$_REQUEST["ensen"]."',".
					"eki='".$_REQUEST["eki"]."',".
					"ekiho=".$_REQUEST["ekiho"].",".
					"basu='".$_REQUEST["basu"]."',".
					"basutei='".$_REQUEST["basutei"]."',".
					"basu_hun=".$_REQUEST["basu_hun"].",".
					"basu_ho=".$_REQUEST["basu_ho"].",".
					"kuruma=".$_REQUEST["kuruma"].",".
					"kyori=".$_REQUEST["kyori"].",".
					"michi_houkou='".$_REQUEST["michi_houkou"]."',".
					"kakaku=".$_REQUEST["kakaku"].",".
//					"syouhizei_kubun='".$_REQUEST["syouhizei_kubun"]."',".
					"shikikin=".$_REQUEST["shikikin"].",".
					"sikikintani='".$_REQUEST["sikikintani"]."',".
					"shikibiki_kakaku=".$_REQUEST["shikibiki_kakaku"].",".
					"shikibiki_tsuki=".$_REQUEST["shikibiki_tsuki"].",".
					"shikibiki_jippi=".$_REQUEST["shikibiki_jippi"].",".
					"reikin=".$_REQUEST["reikin"].",".
					"reikin_tani='".$_REQUEST["reikin_tani"]."',".
					"kyouekihi_tani='".$_REQUEST["kyouekihi_tani"]."',".
					"kyouekihi=".$_REQUEST["kyouekihi"].",".
					"hosyoukin_kikan='".$_REQUEST["hosyoukin_kikan"]."',".
					"hosyoukin_kakaku='".$_REQUEST["hosyoukin_kakaku"]."',".
					"hosyoukin_syoukyaku='".$_REQUEST["hosyoukin_syoukyaku"]."',".
					"hosyoukin_syoukyaku_per='".$_REQUEST["hosyoukin_syoukyaku_per"]."',".
					"kenrikin='".$_REQUEST["kenrikin"]."',".
					"kenrikin_tani='".$_REQUEST["kenrikin_tani"]."',".
					"syuzenhi_tsumitate='".$_REQUEST["syuzenhi_tsumitate"]."',".
					"zappi='".$_REQUEST["zappi"]."',".
					"zappi2='".$_REQUEST["zappi2"]."',".
					"syakuchisyou='".$_REQUEST["syakuchisyou"]."',".
					"kanrihi='".$_REQUEST["kanrihi"]."',".
					"zousajouto='".$_REQUEST["zousajouto"]."',".
					"chusyajou='".$_REQUEST["chusyajou"]."',".
					"chusya_ryoukin='".$_REQUEST["chusya_ryoukin"]."',".
					"chusya_shikikin_kikan='".$_REQUEST["chusya_shikikin_kikan"]."',".
					"chusya_shikikin_kakaku='".$_REQUEST["chusya_shikikin_kakaku"]."',".
					"daimeikou='".$_REQUEST["daimeikou"]."',".
					"daimeikou_kakaku='".$_REQUEST["daimeikou_kakaku"]."',".
					"syoukyakukin_sentaku='".$_REQUEST["syoukyakukin_sentaku"]."',".
					"syoukyakukin_kakaku='".$_REQUEST["syoukyakukin_kakaku"]."',".
					"madori=".$_REQUEST["madori"].",".
					"madori_tani='".$_REQUEST["madori_tani"]."',".
					"madori_syousai='".$_REQUEST["madori_syousai"]."',".
					"senyumenseki='".$_REQUEST["senyumenseki"]."',".
					"barukoni_houkou='".$_REQUEST["barukoni_houkou"]."',".
					"barukoni_menseki='".$_REQUEST["barukoni_menseki"]."',".
					"shidoumenseki='".$_REQUEST["shidoumenseki"]."',".
					"setsudou1='".$_REQUEST["setsudou1"]."',".
					"setsudou2='".$_REQUEST["setsudou2"]."',".
					"setsudou3='".$_REQUEST["setsudou3"]."',".
					"setsudou_joukyou='".$_REQUEST["setsudou_joukyou"]."',".
					"keisoku_houshiki='".$_REQUEST["keisoku_houshiki"]."',".
					"tochi_kenri='".$_REQUEST["tochi_kenri"]."',".
					"syakutiken_syurui='".$_REQUEST["syakutiken_syurui"]."',".
					"tatemono_chintaisyaku_kubun='".$_REQUEST["tatemono_chintaisyaku_kubun"]."',".
					"torihikitaiyou='".$_REQUEST["torihikitaiyou"]."',".
					"genkyou='".$_REQUEST["genkyou"]."',".
					"hikiwatashi='".$_REQUEST["hikiwatashi"]."',".
					"hikiwatashi_nen='".$_REQUEST["hikiwatashi_nen"]."',".
					"hikiwatashi_tsuki='".$_REQUEST["hikiwatashi_tsuki"]."',".
					"hikiwatashi_syun='".$_REQUEST["hikiwatashi_syun"]."',".
					"kokudohou='".$_REQUEST["kokudohou"]."',".
					"bikou='".$_REQUEST["bikou"]."',".
					"jouken='".$_REQUEST["jouken"]."',".
					"kensetsukakunin='".$_REQUEST["kensetsukakunin"]."',".
					"tokki1='".$_REQUEST["tokki1"]."',".
					"tokki2='".$_REQUEST["tokki2"]."',".
					"tokki3='".$_REQUEST["tokki3"]."',".
					"tokki4='".$_REQUEST["tokki4"]."',".
					"tokki5='".$_REQUEST["tokki5"]."',".
					"hokankanyugimu='".$_REQUEST["hokankanyugimu"]."',".
					"hokenkikan='".$_REQUEST["hokenkikan"]."',".
					"hokenkingaku='".$_REQUEST["hokenkingaku"]."',".
					"tesuryou_hutan_kashi='".$_REQUEST["tesuryou_hutan_kashi"]."',".
					"tesuryou_hutan_kari='".$_REQUEST["tesuryou_hutan_kari"]."',".
					"tesuryou_haibun_moto='".$_REQUEST["tesuryou_haibun_moto"]."',".
					"tesuryou_haibun_kyaku='".$_REQUEST["tesuryou_haibun_kyaku"]."',".
					"housyu_keitai='".$_REQUEST["housyu_keitai"]."',".
					"tesuryou_ritsu='".$_REQUEST["tesuryou_ritsu"]."',".
					"tesuryou_kingaku='".$_REQUEST["tesuryou_kingaku"]."',".
					"keiyaku_kikan='".$_REQUEST["keiyaku_kikan"]."',".
					"admin_bikou='".$_REQUEST["admin_bikou"]."',".
					"ichijikin='".$_REQUEST["ichijikin"]."',".
					"syakuchikikan_chidai='".$_REQUEST["syakuchikikan_chidai"]."',".
					"osusume=".$_REQUEST["osusume"].",".
					"setsubi_naka1=".$_REQUEST["setsubi_naka1"].",".
					"setsubi_naka2=".$_REQUEST["setsubi_naka2"].",".
					"setsubi_naka3=".$_REQUEST["setsubi_naka3"].",".
					"setsubi_naka4=".$_REQUEST["setsubi_naka4"].",".
					"setsubi_naka5=".$_REQUEST["setsubi_naka5"].",".
					"setsubi_naka6=".$_REQUEST["setsubi_naka6"].",".
					"setsubi_naka7=".$_REQUEST["setsubi_naka7"].",".
					"setsubi_naka8=".$_REQUEST["setsubi_naka8"].",".
					"setsubi_naka9=".$_REQUEST["setsubi_naka9"].",".
					"setsubi_naka10=".$_REQUEST["setsubi_naka10"].",".
					"setsubi_naka11=".$_REQUEST["setsubi_naka11"].",".
					"setsubi_naka12=".$_REQUEST["setsubi_naka12"].",".
					"setsubi_naka13=".$_REQUEST["setsubi_naka13"].",".
					"setsubi_naka14=".$_REQUEST["setsubi_naka14"].",".
					"setsubi_naka15=".$_REQUEST["setsubi_naka15"].",".
					"setsubi_naka16=".$_REQUEST["setsubi_naka16"].",".
					"setsubi_naka17=".$_REQUEST["setsubi_naka17"].",".
					"setsubi_naka18=".$_REQUEST["setsubi_naka18"].",".
					"setsubi_naka19=".$_REQUEST["setsubi_naka19"].",".
					"setsubi_naka20=".$_REQUEST["setsubi_naka20"].",".
					"setsubi_soto1=".$_REQUEST["setsubi_soto1"].",".
					"setsubi_soto2=".$_REQUEST["setsubi_soto2"].",".
					"setsubi_soto3=".$_REQUEST["setsubi_soto3"].",".
					"setsubi_soto4=".$_REQUEST["setsubi_soto4"].",".
					"setsubi_soto5=".$_REQUEST["setsubi_soto5"].",".
					"setsubi_soto6=".$_REQUEST["setsubi_soto6"].",".
					"setsubi_soto7=".$_REQUEST["setsubi_soto7"].",".
					"setsubi_soto8=".$_REQUEST["setsubi_soto8"].",".
					"setsubi_soto9=".$_REQUEST["setsubi_soto9"].",".
					"setsubi_soto10=".$_REQUEST["setsubi_soto10"].",".
					"setsubi_other1=".$_REQUEST["setsubi_other1"].",".
					"setsubi_other2=".$_REQUEST["setsubi_other2"].",".
					"setsubi_other3=".$_REQUEST["setsubi_other3"].",".
					"setsubi_other4=".$_REQUEST["setsubi_other4"].",".
					"setsubi_other5=".$_REQUEST["setsubi_other5"].",".
					"setsubi_other6=".$_REQUEST["setsubi_other6"].",".
					"setsubi_other7=".$_REQUEST["setsubi_other7"].",".
					"setsubi_other8=".$_REQUEST["setsubi_other8"].",".
					"setsubi_other9=".$_REQUEST["setsubi_other9"].",".
					"setsubi_other10=".$_REQUEST["setsubi_other10"].",".
					"jouken1=".$_REQUEST["jouken1"].",".
					"jouken2=".$_REQUEST["jouken2"].",".
					"jouken3=".$_REQUEST["jouken3"].",".
					"jouken4=".$_REQUEST["jouken4"].",".
					"jouken5=".$_REQUEST["jouken5"].",".
					"jouken6=".$_REQUEST["jouken6"].",".
					"jouken7=".$_REQUEST["jouken7"].",".
					"jouken8=".$_REQUEST["jouken8"].",".
					"jouken9=".$_REQUEST["jouken9"].",".
					"del_chk=".$_REQUEST["del_chk"].",".
										"rains_chk=".$_REQUEST["rains_chk"].",".					

					"keyword='".implode(" ",$_POST)."',".
					"banchichk=".$_REQUEST["banchichk"].",";
					
	if($imagefile1["filepath"]!=NULL||$_REQUEST["delimage1"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
					$ftp->MkDir("tmp/",$bname."_data");
					$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","pop1".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/pop1".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","list".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/list".$imagefile1["name"],"b");
				}
				$upsql.="photo1='300".$imagefile1["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage1"]==1) {
				$upsql.="photo1=null,";

				}
			}
			else if($_REQUEST["delimage1"]==1) {
				$upsql.="photo1=null,";
			}
	}
	if($imagefile2["filepath"]!=NULL||$_REQUEST["delimage2"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile2["filepath"]!=NULL) {
			
				@chmod($imagefile2["filepath"],0777);
				@chmod("k_".$imagefile2["filepath"],0777);
				@chmod("o_".$imagefile2["filepath"],0777);
				@chmod("300".$imagefile2["filepath"],0777);
				@chmod("pop1".$imagefile2["filepath"],0777);
				@chmod("top".$imagefile2["filepath"],0777);
				
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile2["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile2["name"],"b");
				}
				$upsql.="photo2='300".$imagefile2["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage2"]==1) {
				$upsql.="photo2=null,";
				}
			}
			else if($_REQUEST["delimage2"]==1) {
				$upsql.="photo2=null,";
			}

	}
	
	if($imagefile3["filepath"]!=NULL||$_REQUEST["delimage3"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile3["filepath"]!=NULL) {
				@chmod($imagefile3["filepath"],0777);
				@chmod("k_".$imagefile3["filepath"],0777);
				@chmod("o_".$imagefile3["filepath"],0777);
				@chmod("300".$imagefile3["filepath"],0777);
				@chmod("pop1".$imagefile3["filepath"],0777);
				@chmod("top".$imagefile3["filepath"],0777);
				
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile3["name"],"b");
			}
				$upsql.="photo3='300".$imagefile3["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage3"]==1) {
				$upsql.="photo3=null,";
				}
			}
			else if($_REQUEST["delimage3"]==1) {
				$upsql.="photo3=null,";
			}

	}
	if($imagefile4["filepath"]!=NULL||$_REQUEST["delimage4"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile4["filepath"]!=NULL) {

				@chmod($imagefile4["filepath"],0777);
				@chmod("k_".$imagefile4["filepath"],0777);
				@chmod("o_".$imagefile4["filepath"],0777);
				@chmod("300".$imagefile4["filepath"],0777);
				@chmod("pop1".$imagefile4["filepath"],0777);
				@chmod("top".$imagefile4["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile4["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile4["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile4["name"],"b");
				}
				$upsql.="photo4='300".$imagefile4["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage4"]==1) {
				$upsql.="photo4=null,";

				}
			}
			else if($_REQUEST["delimage4"]==1) {
				$upsql.="photo4=null,";
			}


	}
	if($imagefile5["filepath"]!=NULL||$_REQUEST["delimage5"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile5["filepath"]!=NULL) {

				@chmod($imagefile5["filepath"],0777);
				@chmod("k_".$imagefile5["filepath"],0777);
				@chmod("o_".$imagefile5["filepath"],0777);
				@chmod("300".$imagefile5["filepath"],0777);
				@chmod("pop1".$imagefile5["filepath"],0777);
				@chmod("top".$imagefile5["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile5["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile5["name"],"b");
	}
				$upsql.="photo5='300".$imagefile5["name"]."',";
								
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage5"]==1) {
				$upsql.="photo5=null,";

				}
			}
			else if($_REQUEST["delimage5"]==1) {
				$upsql.="photo5=null,";
			}

	}
	
	if($mimagefile1["filepath"]!=NULL||$_REQUEST["delimage6"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			@chmod($mimagefile1["filepath"],0777);
			@chmod("k_".$mimagefile1["filepath"],0777);
			@chmod("o_".$mimagefile1["filepath"],0777);
			@chmod("300".$mimagefile1["filepath"],0777);
				@chmod("pop1".$mimagefile1["filepath"],0777);
				@chmod("top".$mimagefile1["filepath"],0777);
			
			if($mimagefile1["filepath"]!=NULL) {
				
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","pop1".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/pop1".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$mimagefile1["name"],"b");
				}
				$upsql.="madorizu1='300".$mimagefile1["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage6"]==1) {
				$upsql.="madorizu1=null,";

				}
			}
			else if($_REQUEST["delimage6"]==1) {
				$upsql.="madorizu1=null,";
			}
	}
	
	if($mimagefile2["filepath"]!=NULL||$_REQUEST["delimage7"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($mimagefile2["filepath"]!=NULL) {
			
				@chmod($mimagefile2["filepath"],0777);
				@chmod("k_".$mimagefile2["filepath"],0777);
				@chmod("o_".$mimagefile2["filepath"],0777);
				@chmod("300".$mimagefile2["filepath"],0777);
				@chmod("pop1".$mimagefile2["filepath"],0777);
				@chmod("top".$mimagefile2["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$mimagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$mimagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","pop1".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/pop1".$mimagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$mimagefile2["name"],"b");
				
				}
				$upsql.="madorizu2='300".$mimagefile2["name"]."',";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage7"]==1) {
				$upsql.="madorizu2=null,";

				}
			}
			else if($_REQUEST["delimage7"]==1) {
				$upsql.="madorizu2=null,";
			}
	}

	@system("chmod -Rf 0777 ".$_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid);

	$upsql.="pop_txt='".implode(",",$_REQUEST["pop_txt"])."',";
	$upsql.="jouken10=".$_REQUEST["jouken10"]."";
	$upsql.=" where id='".$_REQUEST["bid"]."'";
	$dbobj->Query($upsql);
	if($_REQUEST["update_re"]=="¹¹¿·¤·¤Æ°ìÍ÷¤ØÌá¤ë") {
	?>
	<script language="javascript">
	location.replace("index.php?PID=re_b2");
	</script>
	<?php
	}
}

$re1data=$re1obj->GetReData($_GET["bid"]);
$syougakulist=$dbobj->GetList("select distinct syougakkouku from bukken where syougakkouku <>''");
$chuugakoulist=$dbobj->GetList("select distinct chuugakouku from bukken where chuugakouku <>''");
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
	if(document.bukken_form.syougakkou.value==null) {
		document.bukken_form.syougakkouku.value="";
		document.bukken_form.syougakkouku.disabled=true;
	}
	else {
		document.bukken_form.syougakkouku.value="";
		document.bukken_form.syougakkouku.style.disabled=false;
	}
}
function chchugaku(){
	//alert(data.value);
	//document.bukken_form.chuugakouku.value=document.bukken_form.chugakkou.value;
	//alert(data.value);
	if(document.bukken_form.chugakkou.value==null) {
		document.bukken_form.chuugakouku.value="";
		document.bukken_form.chuugakouku.disabled=true;
	}
	else {
		document.bukken_form.chuugakouku.value="";
		document.bukken_form.chuugakouku.style.disabled=false;
	}
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
//¥ê¥¹¥ÈÆâ¤Î°ÜÆ°¤ò¤¹¤ë´Ø¿ô
function func(elenum1,elenum2) {
	var devneko;
			switch(document.bukken_form.elements[elenum1].value) {
				case "1":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "1";
					var str = document.createTextNode("ÂçÃÝ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("´ä¹ñ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "3";
					var str = document.createTextNode("Æî´ä¹ñ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "4";
					var str = document.createTextNode("Æ£À¸±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "5";
					var str = document.createTextNode("ÄÌÄÅ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "6";
					var str = document.createTextNode("Í³±§±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "7";
					var str = document.createTextNode("¿ÀÂå±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "8";
					var str = document.createTextNode("ÂçÈ«±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "9";
					var str = document.createTextNode("Ìø°æ¹Á±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "10";
					var str = document.createTextNode("Ìø°æ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "2":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("´ä¹ñ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("ÀîÀ¾±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "12";
					var str = document.createTextNode("¸æ¾±±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								break;
					case "3":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("´ä¹ñ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("ÀîÀ¾±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "13";
					var str = document.createTextNode("À¾´ä¹ñ±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "14";
					var str = document.createTextNode("ÃìÌî±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "15";
					var str = document.createTextNode("¶ÖÌÀÏ©±Ø");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "16";
					var str = document.createTextNode("¶ê²Ñ±Ø ");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								break;
					default:
				document.bukken_form.elements[elenum2].length=0;
				var ele = document.createElement("option");
				ele.value = "0";
				var str = document.createTextNode("±Ø¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤");
				ele.appendChild(str);
				document.bukken_form.elements[elenum2].appendChild(ele);
	}
}

function  gotolist() {
	location.replace("index.php?PID=re_b2");
}

</script>
<script language="javascript">
<!--
ns4 = (document.layers)? true:false
ie4 = (document.all)? true:false
function cf() {
				for (i = 0; i < document.forms[0].elements.length; i++) {
					if ((ns4) && (document.forms[0].elements[i].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i].type != "hidden" )) {
						document.forms[0].elements[i].focus()
						break
					}
				}
}
function keyDown(e) {
	if (ns4) {PKey=e.which; el = e.target.type ; sk = e.modifiers}
	if (ie4) {PKey=event.keyCode; el = event.srcElement.tagName; sk = event.shiftKey}
	if (PKey == "13") {
		if (el.toLowerCase() != "textarea") {
			keyDowntest(e)
			return false;
		} else {
			if ((ns4) && (sk == '4') || (ie4) && (sk)) {
				keyDowntest(e)
				return false;
			}
		}
	}
}
function keyDowntest(e) {
	for (var i = 0; i < document.forms[0].elements.length; i++) {
		if ((ie4) && (document.forms[0].elements[i] == event.srcElement)
		||  (ns4) && (document.forms[0].elements[i] == e.target)) {
			if ((i + 1) == document.forms[0].elements.length)
				document.forms[0].elements[0].focus()
			else
				for (; i < document.forms[0].elements.length; i++) {
					if ((ns4) && (document.forms[0].elements[i+1].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i+1].type != "hidden" )) {
						document.forms[0].elements[i+1].focus()
						break
					}
					if ((ns4) && (document.forms[0].elements[i+1].type != "hidden")
					|| (ie4) && (document.forms[0].elements[i+1].type != "hidden" )) {
						document.forms[0].elements[i+1].focus()
						break
					}
				}
			break
		}
	}
//			if (i == document.forms[0].elements.length)
//				document.forms[0].elements[0].focus()
}
document.onkeydown = keyDown
if (ns4) document.captureEvents(Event.KEYDOWN)
//-->

</script>

<TABLE width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="realestate_bgcolor1">
    <form action="" method="post" enctype="multipart/form-data" name="bukken_form">
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
                    <tr>
                        <td width="15" bgcolor="#CCCCCC">&nbsp; </td>
                        <td>
                            <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font10">
                                        <p><font color="#000000">ÇäÇãÅÚÃÏÊª·ï½¤Àµ</font></p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <div class="helper">
                    <table width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
                            <th bgcolor="#CCCCCC">
                                <div align="left">¶¦ÄÌÀßÄê</div>
                            </th>
                        </tr>
                        <tr>
                            <td bgcolor="#FFFFFF"> <font color="#000000">ÇäÇãÅÚÃÏ</font>¤ËÉ½¼¨¤¹¤ë¹àÌÜ¤òÀßÄê¤¹¤ë¤Ë¤Ï<a href="?PID=re_b2_set">¤³¤Á¤é¤ò¥¯¥ê¥Ã¥¯</a>¤·¤Æ¤¯¤À¤µ¤¤¡£ <br>
                                ¥Ç¡¼¥¿¤ÎÆþÎÏ¤µ¤ì¤Æ¤¤¤Ê¤¤¹àÌÜ¤ò¤ªµÒÍÍÍÑ¤ÎÊª·ï¾ÜºÙ¥Ú¡¼¥¸¤ÇÉ½¼¨¤·¤Ê¤¤¾ì¹ç¤Ï<a href="?PID=re_osetting">¤³¤Á¤é¤ò¥¯¥ê¥Ã¥¯</a>¤·¤Æ¤¯¤À¤µ¤¤¡£<br>
                            <font color="#FF0000">¢¨¤³¤ÎÀßÄê¤ÏÁ´¤Æ¤Î¼ïÊÌ¤Ç¶¦ÄÌ¤Ë¤Ê¤Ã¤Æ¤ª¤ê¤Þ¤¹¡£</font></td>
                        </tr>
                    </table>
                </div>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left">Êª·ï´ðËÜ¾ðÊó</div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php 
					if($bsetdata["bukken_id_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["bukken_id_name"] ?></div>
                                    </td>
                                    <td width="491" class="font12">
                                        <input name="bukkenn_id" type="text" id="bukkenn_id" class="noime" value="<?php echo $re1data["bukkenn_id"]."";?>">
                                    </td>
                                </tr>
                                <?php
					}
					if($bsetdata["syumoku_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["syumoku_name"] ?><font color="#FF0000">¡Ê¢¨É¬¿Ü¡Ë</font></div>
                                    </td>
                                    <td class="font12">
                                        <select name="syumoku" id="syumoku">
                                            <option<?php if($re1data["syumoku"]=="ÇäÃÏ"){echo " selected";}?>>ÇäÃÏ</option>
                                            <option<?php if($re1data["syumoku"]=="¼ÚÃÏ¸¢¾ùÅÏ"){echo " selected";}?>>¼ÚÃÏ¸¢¾ùÅÏ</option>
                                            <option<?php if($re1data["syumoku"]=="ÄìÃÏ¸¢¾ùÅÏ"){echo " selected";}?>>ÄìÃÏ¸¢¾ùÅÏ</option>
                                        </select>
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["bukken_mei_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["bukken_mei_name"] ?></div>
                                    </td>
                                    <td class="font12">
                                        <input name="bukken_mei" type="text" class="ime-active" id="bukken_mei" value="<?php echo $re1data["bukken_mei"];?>" size="50" />
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["bukken_hurigana_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["bukken_hurigana_name"] ?></div>
                                    </td>
                                    <td class="font12">
                                        <input name="bukken_hurigana" type="text" class="ime-active" id="bukken_hurigana" value="<?php echo $re1data["bukken_hurigana"];?>" size="50" />
                                    </td>
                                </tr>
                                <?php
					}?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#EBEBEB">
                            <div align="left"><span class="font14"><?php echo $bsetdata["jyusyo_name"] ?></span></div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php
					if($bsetdata["jyusyo_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14">¢©</div>
                                    </td>
                                    <td width="491" bgcolor="#FFFFFF" class="font12">
                                        <input name="yubinbangou" type="text" class="noime" id="yubinbangou" value="<?php echo $re1data["yubinbangou"];?>" size="15" />
                                        <input type="button" name="Submit2" value="Í¹ÊØÈÖ¹æ¤«¤é½»½ê¤òÆþÎÏ" onclick="zipcode()" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><span class="font12">ÅÔÆ»ÉÜ¸©</span></div>
                                    </td>
                                    <td width="491" bgcolor="#FFFFFF" class="font12">
                                        <input name="todouhuken" type="text" class="ime-active" id="todouhuken" value="<?php echo $re1data["todouhuken"];?>" size="10" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><span class="font12">»Ô¶è·´</span></div>
                                    </td>
                                    <td width="491" bgcolor="#FFFFFF" class="font12">
                                        <input name="jyusyo1" type="text" class="ime-active" id="jyusyo1" value="<?php echo $re1data["jyusyo1"];?>" size="8" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><span class="font12">Ä®Ì¾</span></div>
                                    </td>
                                    <td width="491" bgcolor="#FFFFFF" class="font12">
                                        <input name="jyusyo2" type="text" class="ime-active" id="jyusyo2" value="<?php echo $re1data["jyusyo2"];?>" size="30" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" class="font14">
                                        <div align="right">ÈÖÃÏ</div>
                                    </td>
                                    <td width="491" valign="middle" bgcolor="#FFFFFF" class="font12">
                                        <input name="jyusyo3" type="text" class="ime-active" id="jyusyo3" value="<?php echo $re1data["jyusyo3"];?>" size="30" />
                                        <label>
                                            <input name="banchichk" type="checkbox" id="banchichk" value="1"<?php if($re1data["banchichk"]==1){ echo ' checked';}?> />
                                        ÈÖÃÏ¤ò¸ø³«</label>
                                    </td>
                                </tr>
                                <?php 
					}
?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left">¸òÄÌ</div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php
					if($bsetdata["ensen_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["ensen_name"] ?></div>
                                    </td>
                                    <td width="491" class="font12">
                                        <input type="text" name="ensen" id="ensen" value="<?php echo $re1data["ensen"];?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right">ºÇ´ó±Ø</div>
                                    </td>
                                    <td class="font12">
                                        <input name="eki" type="text" id="eki" value="<?php echo $re1data["eki"];?>" />
                                    ±Ø                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" height="21" valign="top" class="font14">
                                        <div align="right"><span class="font12">ÅÌÊâ</span></div>
                                    </td>
                                    <td class="font12">
                                        <input name="ekiho" type="text" class="noime" id="ekiho" value="<?php echo $re1data["ekiho"];?>" size="6" />
                                        Ê¬ </td>
                                </tr>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right">µ÷Î¥</div>
                                    </td>
                                    <td class="font12">
                                        <input name="kyori" type="text" class="noime" id="kyori" value="<?php echo $re1data["kyori"];?>" size="10" />
                                        m </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["basu_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["basu_name"] ?></div>
                                    </td>
                                    <td class="font12"> ºÇ´ó±Ø¤«¤é¾è¼Ö
                                        <input name="basu" type="text" class="noime" id="basu" value="<?php echo $re1data["basu"];?>" size="6" />
                                        Ê¬¡¡ ¥Ð¥¹Ää
                                        <input name="basutei" type="text" class="ime-active" id="basutei" value="<?php echo $re1data["basutei"];?>" />
                                        ¤«¤éÅÌÊâ
                                        <input name="basu_ho" type="text" class="noime" id="basu_ho" value="<?php echo $re1data["basu_ho"];?>" size="6" />
                                        Ê¬ </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["kuruma_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["kuruma_name"] ?></div>
                                    </td>
                                    <td class="font12"> ºÇ´ó±Ø¤«¤é¾è¼Ö
                                        <input name="kuruma" type="text" class="noime" id="kuruma" value="<?php echo $re1data["kuruma"];?>" size="6" />
                                        Ê¬</td>
                                </tr>
                                <?php 
					}
?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left">³Ø¹»¶è</div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                              <?php
					if($bsetdata["syougakkouku_admin"]==1) {
					?>
                              <tr>
                                <td width="150" valign="top" class="font14">
                                  <div align="right"><?php echo $bsetdata["syougakkouku_name"] ?></div></td>
                                <td bgcolor="#FFFFFF" class="font12">
                                    <select name="syougakkou" id="syougakkou" onchange="chsyougaku()">
                                        <?php
											for($i=0;$syougakulist[$i]["syougakkouku"]!=NULL;$i++) {
											if(str_replace("¾®³Ø¹»","",$syougakulist[$i]["syougakkouku"]) !=NULL) {
											?>
                                        <option value="<?php echo str_replace("¾®³Ø¹»","",$syougakulist[$i]["syougakkouku"]) ?>"<?php if(str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])==str_replace("¾®³Ø¹»","",$syougakulist[$i]["syougakkouku"])){echo " selected";}?>><?php echo str_replace("¾®³Ø¹»","",$syougakulist[$i]["syougakkouku"]) ?></option>
                                        <?php
											}
											}
											?>
                                        <option value=""<?php if(str_replace("¾®³Ø¹»","",$re1data["syougakkouku"])==NULL){echo " selected";}?>>¿·µ¬</option>
                                    </select>
                                    ¾®³Ø¹» ¡¡ ¿·µ¬ÅÐÏ¿
    <input name="syougakkouku" type="text" id="syougakkouku" size="12" />
                                </td>
                              </tr>
                              <?php 
					}
					if($bsetdata["chuugakouku_admin"]==1) {
					?>
                              <tr>
                                <td width="150" valign="top" class="font14">
                                  <div align="right"><?php echo $bsetdata["chuugakouku_name"] ?></div></td>
                                <td bgcolor="#FFFFFF" class="font12">
                                    <select name="chugakkou" id="chugakkou" onchange="chchugaku()">
                                        <?php
											for($i=0;$chuugakoulist[$i]["chuugakouku"]!=NULL;$i++) {
												if(str_replace("Ãæ³Ø¹»","",$chuugakoulist[$i]["chuugakouku"])!=NULL) {
											?>
                                        <option value="<?php echo str_replace("Ãæ³Ø¹»","",$chuugakoulist[$i]["chuugakouku"]); ?>"<?php if(str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])==str_replace("Ãæ³Ø¹»","",$chuugakoulist[$i]["chuugakouku"])) { echo " selected";}?>><?php echo str_replace("Ãæ³Ø¹»","",$chuugakoulist[$i]["chuugakouku"]) ?></option>
                                        <?php
											}
											}
											?>
                                        <option value=""<?php if(str_replace("Ãæ³Ø¹»","",$re1data["chuugakouku"])==NULL){echo " selected";}?>>¿·µ¬</option>
                                    </select>
                                    Ãæ³Ø¹»¡¡¡¡¿·µ¬ÅÐÏ¿
    <input name="chuugakouku" type="text" id="chuugakouku" size="12" />
                                </td>
                              </tr>
                              <?php 
					}
?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left">
                                <p>ÅÚÃÏ¾ðÊó</p>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php
					if($bsetdata["kouzou_admin"]==1) {
					?>
                                <?php 
					}
					if($bsetdata["kaisou_admin"]==1) {
					?>
                                <?php 
					}
					if($bsetdata["chiku_nen_admin"]==1) {
					?>
                                <?php 
					}
?>
                                <?php
																																					if($bsetdata["tochi_kenri_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["tochi_kenri_name"] ?>
                                                <!--ÅÚÃÏ¸¢Íø -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="tochi_kenri" type="text" id="tochi_kenri" value="<?php echo $re1data["tochi_kenri"];?>" />
                                    </td>
                                </tr>
                                <?php 
					}

					if($bsetdata["menseki_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["menseki_name"] ?></div>
                                    </td>
                                    <td class="font12">
                                        <input name="menseki" type="text" class="noime" id="menseki" value="<?php echo $re1data["menseki"];?>" size="6" />
                                        m<sup>2</sup> </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["kenpei_ritsu_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["kenpei_ritsu_name"] ?>
                                                <!--·úÊÃÎ¨ -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="kenpei_ritsu" type="text" id="kenpei_ritsu" value="<?php echo $re1data["kenpei_ritsu"];?>" size="8" />
                                        ¡ó</td>
                                </tr>
                                <?php 
					}
					if($bsetdata["youseki_ritsu_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["youseki_ritsu_name"] ?>
                                                <!--ÍÆÀÑÎ¨ -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="youseki_ritsu" type="text" class="noime" id="youseki_ritsu" value="<?php echo $re1data["youseki_ritsu"];?>" size="8" />
                                        ¡ó</td>
                                </tr>
                                <?php 
					}
					if($bsetdata["shidoumenseki_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["shidoumenseki_name"] ?>
                                                <!--»äÆ»ÌÌÀÑ -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="shidoumenseki" type="text" class="noime" id="shidoumenseki" value="<?php echo $re1data["shidoumenseki"];?>" size="6" />
                                        m<sup>2</sup></td>
                                </tr>
                                <?php 
					}
					if($bsetdata["toshikeikaku_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["toshikeikaku_name"] ?>
                                                <!--ÅÔ»Ô·×²è -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="toshikeikaku" type="text" id="toshikeikaku" value="<?php echo $re1data["toshikeikaku"];?>" />
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["youtochiiki_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["youtochiiki_name"] ?>
                                                <!--ÍÑÅÓÃÏ°è -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="youtochiiki" type="text" id="youtochiiki" value="<?php echo $re1data["youtochiiki"];?>" />
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["chimoku_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["chimoku_name"] ?>
                                                <!--ÃÏÌÜ -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="chimoku" type="text" id="chimoku" value="<?php echo $re1data["chimoku"];?>" />
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["chisei_admin"]==1) {
					
?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["chisei_name"] ?>
                                                <!--ÃÏÀª -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="chisei" type="text" id="chisei" value="<?php echo $re1data["chisei"];?>" />
                                    </td>
                                </tr>
                                <?php
										}
					if($bsetdata["tochi_kenri_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["tochi_kenri_name"] ?>
                                                <!--ÅÚÃÏ¸¢Íø -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="tochi_kenri" type="text" id="tochi_kenri" value="<?php echo $re1data["tochi_kenri"];?>" />
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["setsudou_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["setsudou_name"] ?>
                                                <!--ÀÜÆ»¾õ¶· -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <table border="0" cellspacing="0" cellpadding="3">
                                            <tr>
                                                <td>¾õ¶·</td>
                                                <td>
                                                    <input name="setsudou_joukyou" type="text" id="setsudou_joukyou" value="<?php echo $re1data["setsudou_joukyou"];?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ÀÜÆ»1</td>
                                                <td>
                                                    <input name="setsudou1" type="text" id="setsudou1" value="<?php echo $re1data["setsudou1"];?>" size="50" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ÀÜÆ»2</td>
                                                <td>
                                                    <input name="setsudou2" type="text" id="setsudou2" value="<?php echo $re1data["setsudou2"];?>" size="50" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>ÀÜÆ»3</td>
                                                <td>
                                                    <input name="setsudou3" type="text" id="setsudou3" value="<?php echo $re1data["setsudou3"];?>" size="50" />
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["genkyou_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["genkyou_name"] ?></div>
                                    </td>
                                    <td class="font12">
                                        <select name="genkyou" id="genkyou">
                                            <option<?php if($re1data["genkyou"]=="¶õ²È"){echo " selected";}?>>¶õ²È</option>
                                            <option<?php if($re1data["genkyou"]=="¹¹ÃÏ"){echo " selected";}?>>¹¹ÃÏ</option>
                                            <option<?php if($re1data["genkyou"]=="½êÍ­¼Ôµï½»Ãæ"){echo " selected";}?>>½êÍ­¼Ôµï½»Ãæ</option>
                                            <option<?php if($re1data["genkyou"]=="¾åÊªÍ­"){echo " selected";}?>>¾åÊªÍ­</option>
                                            <option<?php if($re1data["genkyou"]=="ÄÂÂßÃæ"){echo " selected";}?>>ÄÂÂßÃæ</option>
																																												<option<?php if($re1data["genkyou"]=="¾¦ÃÌÃæ") {echo  " selected";}?>>¾¦ÃÌÃæ</option>
																																												<option <?php if($re1data["genkyou"]=="À®ÌóºÑ") {echo  " selected";}?>>À®ÌóºÑ</option>
             			<option<?php if($re1data["genkyou"]==" "||$re1data["genkyou"]==NULL){echo " selected";}?>> </option> </select>
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["hikiwatashi_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["hikiwatashi_name"] ?></div>
                                    </td>
                                    <td class="font12">
                                        <select name="hikiwatashi" id="hikiwatashi">
                                            <option<?php if($re1data["hikiwatashi"]=="Â¨»þ"){echo " selected";}?>>Â¨»þ</option>
                                            <option<?php if($re1data["hikiwatashi"]=="ÁêÃÌ"){echo " selected";}?>>ÁêÃÌ</option>
                                            <option<?php if($re1data["hikiwatashi"]=="´üÆü»ØÄê"){echo " selected";}?>>´üÆü»ØÄê</option>
                                            <option<?php if($re1data["hikiwatashi"]==" "||$re1data["hikiwatashi"]==""){echo " selected";}?>> </option>
                                        </select>
                                        À¾Îñ
                                        <input name="hikiwatashi_nen" type="text" class="noime" id="hikiwatashi_nen" value="<?php echo $re1data["hikiwatashi_nen"];?>" size="8" />
                                        Ç¯
                                        <input name="hikiwatashi_tsuki" type="text" class="noime" id="hikiwatashi_tsuki" value="<?php echo $re1data["hikiwatashi_tsuki"];?>" size="4" />
                                        ·î
                                        <select name="hikiwatashi_syun" id="hikiwatashi_syun">
                                            <option<?php if($re1data["hikiwatashi_syun"]=="Â¨»þ"){echo " selected";}?>>¾å½Ü</option>
                                            <option<?php if($re1data["hikiwatashi_syun"]=="Ãæ½Ü"){echo " selected";}?>>Ãæ½Ü</option>
                                            <option<?php if($re1data["hikiwatashi_syun"]=="²¼½Ü"){echo " selected";}?>>²¼½Ü</option>
                                            <option<?php if($re1data["hikiwatashi_syun"]==" "||$re1data["hikiwatashi_syun"]==""){echo " selected";}?>> </option>
                                        </select>
                                    </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["setsubi_naka_admin"]==1) {
					?>
                                <?php 
					}
					if($bsetdata["setsumi_soto_admin"]==1) {
					?>
                                <?php 
					}
					if($bsetdata["jouken_admin"]==1) {
					?>
                                <?php 
					}
					?>
                                <?php
					if($bukkensetdata["chintai_oneclick"]==1) {
					?>
                                <?php
					}
					?>          <tr>
              <td valign="top" class="font14">
                  <div align="right">µëÇÓ¿å¡¦¥¬¥¹</div>
              </td>
              <td class="font12">
                  <label><input type="checkbox" name="setsubi_other1" value="1"<?php if($re1data["setsubi_other1"]==1) {echo " checked"; }?>>
                  ¾å¿åÆ»</label>
                 <label> <input type="checkbox" name="setsubi_other2" value="1"<?php if($re1data["setsubi_other2"]==1) {echo " checked"; }?>>
                  °æ¸Í</label>
                  <label><input type="checkbox" name="setsubi_other3" value="1"<?php if($re1data["setsubi_other3"]==1) {echo " checked"; }?>>
                  ²¼¿åÆ»</label>
                  <label><input type="checkbox" name="setsubi_other4" value="1"<?php if($re1data["setsubi_other4"]==1) {echo " checked"; }?>>
                  ¾ô²½Áå</label>
                  <label><input type="checkbox" name="setsubi_other5" value="1"<?php if($re1data["setsubi_other5"]==1) {echo " checked"; }?>>
                  µâ¼è</label><br>
                  <label><input type="checkbox" name="setsubi_other6" value="1"<?php if($re1data["setsubi_other6"]==1) {echo " checked"; }?>>
                  ÅÔ»Ô¥¬¥¹</label>
                  <label><input type="checkbox" name="setsubi_other7" value="1"<?php if($re1data["setsubi_other7"]==1) {echo " checked"; }?>>
                  ¥×¥í¥Ñ¥ó¥¬¥¹</label>
                  <label><input type="checkbox" name="setsubi_other8" value="1"<?php if($re1data["setsubi_other8"]==1) {echo " checked"; }?>>
                  ½¸Ãæ¥×¥í¥Ñ¥ó¥¬¥¹</label></td>
          </tr>

                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left">¶â³Û¾ðÊó</div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php					if($bsetdata["kakaku_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["kakaku_name"] ?></div>
                                    </td>
                                    <td width="491" class="font12">
                                        <input name="kakaku" type="text" class="noime" id="kakaku" value="<?php echo $re1data["kakaku"];?>" size="15" onChange="pricechange()" />
                                        Ëü±ß </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["hosyoukin_admin"]==1) {
					?>
                                <tr>
                                    <td align="right" valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["hosyoukin_name"] ?></div>
                                    </td>
                                    <td class="font12"><span class="realestate_bgcolor3">
                                        <input name="hosyoukin_kikan" type="text" class="noime" id="hosyoukin_kikan" value="<?php echo $re1data["hosyoukin_kikan"];?>" size="6" />
                                        ¥ö·î
                                        <input name="hosyoukin_kakaku" type="text" class="noime" id="hosyoukin_kakaku" value="<?php echo $re1data["hosyoukin_kakaku"];?>" size="6" />
                                        Ëü±ß </span></td>
                                </tr>
                                <?php 
					}
					if($bsetdata["kenrikin_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["kenrikin_name"] ?>
                                                <!--¸¢Íø¶â -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="kenrikin" type="text" class="noime" id="kenrikin" value="<?php echo $re1data["kenrikin"];?>" size="10" />
                                        ±ß </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["tsubotanka_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["tsubotanka_name"] ?>
                                                <!--ÄÚÃ±²Á -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="tsubotanka" type="text" class="noime" id="tsubotanka" value="<?php echo $re1data["tsubotanka"];?>" size="6" />
                                       Ëü±ß<sup></sup> </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["syakuchikikan_chidai_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["syakuchikikan_chidai_name"] ?>
                                                <!--¼ÚÃÏ´ü´Ö¡¦ÃÏÂå -->
                                        </div>
                                    </td>
                                    <td class="font12">
                                        <input name="syakuchikikan_chidai" type="text" class="ime-active" id="syakuchikikan_chidai" value="<?php echo $re1data["syakuchikikan_chidai"];?>" size="40" />
                                        ±ß </td>
                                </tr>
                                <?php 
					}
					if($bsetdata["zappi_admin"]==1) {
					?>
                                <tr>
                                    <td valign="top" class="font14">
                                        <div align="right"><?php echo $bsetdata["zappi_name"] ?>
                                                <!--¤½¤ÎÂ¾°ì»þ¶â -->
                                        </div>
                                    </td>
                                    <td class="font12"><input name="zappi2" type="text" id="zappi2" value="<?php echo $re1data["zappi2"];?>" class="ime-active">
                                        <input name="zappi" type="text" class="noime" id="zappi" value="<?php echo $re1data["zappi"];?>" />
                                        ±ß </td>
                                </tr>
                                <?php
										}
?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">
                <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th bgcolor="#ECECEC">
                            <div align="left"><?php echo $bsetdata["photo_name"] ?></div>
                        </th>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="648" border="0" cellpadding="1" cellspacing="1">
                                <?php
					if($bsetdata["photo_admin"]==1) {
					?>
                                <tr>
                                    <td width="150" rowspan="2" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>£± </div>
                                    </td>
                                    <td width="491" bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["photo1"]!=NULL) {?>
                                        <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"]."?".time();?>" /><br />
                                        <input name="delimage1" type="checkbox" id="delimage1" value="1" />
                                        ¼Ì¿¿¤òºï½ü¤¹¤ë
                                        <?php 
												}
												?>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <input name="photo1" type="file" id="photo1" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" rowspan="2" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>£² </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["photo2"]!=NULL) {?>
                                        <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"]."?".time();?>" /><br />
                                        <input name="delimage2" type="checkbox" id="delimage2" value="1" />
                                        ¼Ì¿¿¤òºï½ü¤¹¤ë
                                        <?php 
														}
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <input name="photo2" type="file" id="photo2" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" rowspan="2" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>£³ </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["photo3"]!=NULL) {?>
                                        <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"]."?".time();?>" /> <br />
                                        <input name="delimage3" type="checkbox" id="delimage3" value="1" />
                                        ¼Ì¿¿¤òºï½ü¤¹¤ë
                                        <?php }
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                        <input name="photo3" type="file" id="photo3" />
                                    </span> </td>
                                </tr>
                                <tr>
                                    <td width="150" rowspan="2" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>£´</div>
                                    </td>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["photo4"]!=NULL) {?>
                                        <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"]."?".time();?>" /><br />
                                        <input name="delimage4" type="checkbox" id="delimage4" value="1" />
                                        ¼Ì¿¿¤òºï½ü¤¹¤ë
                                        <?php }
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <input name="photo4" type="file" id="photo4" />
                                    </td>
                                </tr>
                                <tr>
                                    <td width="150" rowspan="2" valign="top" class="font14">
                                        <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>£µ </div>
                                    </td>
                                    <td bgcolor="#FFFFFF" class="font12">
                                        <?php if($re1data["photo5"]!=NULL) {?>
                                        <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"]."?".time();?>" /> <br />
                                        <input name="delimage5" type="checkbox" id="delimage5" value="1" />
                                        ¼Ì¿¿¤òºï½ü¤¹¤ë
                                        <?php }
																		?>
                                    </td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                        <input name="photo5" type="file" id="photo5" />
                                    </span> </td>
                                </tr>
                                <?php 
					}
?>
                            </table>
                        </td>
                    </tr>
                </table>
            </TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top">&nbsp;</TD>
        </TR>
        <TR class="realestate_bgcolor2">
            <TD valign="top"> <span class="font12"> </span>
                    <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                        <tr>
                            <th bgcolor="#ECECEC">
                                <div align="left">¤½¤ÎÂ¾¾ðÊó</div>
                            </th>
                        </tr>
                        <tr>
                            <td bgcolor="#FFFFFF">
                                <table width="648" border="0" cellpadding="1" cellspacing="1">
                                    <?php
																																					if($bsetdata["kokudohou_admin"]==1) {
					?>
                                    <tr>
                                        <td valign="top" class="font14">
                                            <div align="right"><?php echo $bsetdata["kokudohou_name"] ?>
                                                    <!--¹ñÅÚË¡ -->
                                            </div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <input name="kokudohou" type="text" id="kokudohou" value="<?php echo $re1data["kokudohou"];?>" />
                                        </td>
                                    </tr>
                                    <?php 
					}
?>
                                    <tr>
                                        <td width="150" valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right">¤ª¤¹¤¹¤á</div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <input name="osusume" type="checkbox" id="osusume" value="1"<?php if($re1data["osusume"]==1) {echo " checked"; }?> />
                                        </td>
                                    </tr><?php
										if(str_replace("www.","",$_SERVER['SERVER_NAME'])=="f-ourhouse.com"||str_replace("www.","",$_SERVER['SERVER_NAME'])=="e-altus.com"){
										?>
          <tr>
          				<td valign="top" bgcolor="#FFFFFF" class="font14">
          								<div align="right">°ì¸À¥³¥á¥ó¥È</div>
          				</td>
          				<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">	<textarea name="tokki5" cols="24" rows="2" class="ime-active" id="tokki5"><?php echo $re1data["tokki5"];?></textarea>
          				</span></td>
          				</tr>
														<?php
														}
														?>
                                    <tr>
                                        <td width="150" valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right">¸ø³«È÷¹Í</div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                            <textarea name="bikou" cols="60" rows="6" class="ime-active" id="bikou"><?php echo $re1data["bikou"];?></textarea>
                                        </span> </td>
                                    </tr>
                                    <tr>
                                        <td width="150" valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right">Èó¸ø³«È÷¹Í</div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
                                            <textarea name="admin_bikou" cols="60" rows="6" class="ime-active" id="admin_bikou"><?php echo $re1data["admin_bikou"];?></textarea>
                                        </span></td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right">POPÍÑ¥Æ¥­¥¹¥È
                                                <?php 
																				$pop_txt=explode(",",$re1data["pop_txt"]);
																				?>
                                                    <br>
                                                ¢¨Á´³Ñ30Ê¸»ú°ÊÆâ</div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>
                                                        <input name="pop_txt[0]" type="text" id="pop_txt[0]" value="<?php echo $pop_txt[0];?>" size="60" maxlength="30" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php 
					if($bsetdata["torihikitaiyou_admin"]==1) {
					?>
                                    <tr>
                                        <td width="150" valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right" class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12">
                                            <select name="torihikitaiyou">
                                                <option<?php if($re1data["torihikitaiyou"]=="ÀìÇ¤ÇÞ²ð"){echo " selected";}?>>ÀìÇ¤ÇÞ²ð</option>
                                                <option<?php if($re1data["torihikitaiyou"]=="ÀìÂ°ÀìÇ¤ÇÞ²ð"){echo " selected";}?>>ÀìÂ°ÀìÇ¤ÇÞ²ð</option>
                                                <option<?php if($re1data["torihikitaiyou"]=="°ìÈÌÇÞ²ð"){echo " selected";}?>>°ìÈÌÇÞ²ð</option>
                                                <option<?php if($re1data["torihikitaiyou"]=="Çä¼ç"){echo " selected";}?>>Çä¼ç</option>
                                                <option<?php if($re1data["torihikitaiyou"]=="ÂåÍý"){echo " selected";}?>>ÂåÍý</option>
                                                <option<?php if($re1data["torihikitaiyou"]=="ÇÞ²ð"){echo " selected";}?>>ÇÞ²ð</option>
                                                <option<?php if($re1data["torihikitaiyou"]==" "||$re1data["torihikitaiyou"]==""){echo " selected";}?>> </option>
                                            </select>
                                        </td>
                                    </tr>
                                    <?php 
					}
					?>
                                    <tr>
																																								<td class="font14">
																																												<div align="right">¥ì¥¤¥ó¥º¥Ç¡¼¥¿</div>
																																								</td>
                                    				<td bgcolor="#FFFFFF" class="font12">
																																												<input name="rains_chk" type="checkbox" id="rains_chk" value="1"<?php if($re1data["rains_chk"]==1) {echo  " checked";}?>>
																																								</td>
                                				</tr>
                                    <tr>
                                        <td valign="top" bgcolor="#FFFFFF" class="font14">
                                            <div align="right">¸ø³«¡¦Èó¸ø³«</div>
                                        </td>
                                        <td bgcolor="#FFFFFF" class="font12">
                                          <select name="del_chk" id="del_chk">
                                              <option value="0"<?php if($re1data["del_chk"]==0||$re1data["del_chk"]==NULL) {echo " selected";}?>>¸ø³«</option>
                                              <option value="1"<?php if($re1data["del_chk"]==1) {echo  " selected";}?>>Èó¸ø³«</option>
                                            </select>
                                        </td>
                                    </tr>																																				              <tr>
                  <td valign="top" class="font14">
                      <div align="right">¤ªÌä¤¤¹ç¤ï¤»Àè</div>
                  </td>
                  <td bgcolor="#FFFFFF" class="font12">
                      <?php 
							echo $re1data["kaiin_shougou"]."<br />";
							echo $re1data["kaiin_denwa"];
							?>
                  </td>
              </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                <table width="100%" cellpadding="1" cellspacing="1">
                        <tr>
                            <td valign="top" class="font14">&nbsp;</td>
                            <td bgcolor="#FFFFFF" class="font12">&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="150" valign="top" class="font14">&nbsp; </td>
                            <td bgcolor="#FFFFFF" class="font12">
                                <input name="update_re" type="submit" id="update_re" value="¹¹¿·¤¹¤ë" />
                                <span class="realestate_bgcolor3">
                                <input name="update_re" type="submit" id="update_re" value="¹¹¿·¤·¤Æ°ìÍ÷¤ØÌá¤ë" />
                                <input name="btm" type="button" id="btm" onclick="gotolist()" value="¹¹¿·¤»¤º¤Ë°ìÍ÷¤ØÌá¤ë">
                                </span>
                                <input name="bid" type="hidden" id="bid" value="<?php echo $_REQUEST["bid"];?>" />
</td>
                        </tr>
                    </table>
            </TD>
        </TR>
    </form>
</TABLE>
