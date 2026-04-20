<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");
$dbobj->Query("update tenpo_data set c1lastupid =".$_REQUEST["bid"]);

if($_REQUEST["update_re"]=="更新する"||$_REQUEST["update_re"]=="更新して一覧へ戻る") {
	
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
	if($_REQUEST["chiku_tsuki"]==NULL||$_REQUEST["chiku_tsuki"]==""){
		$_REQUEST["chiku_tsuki"]="null";
	}
	if($_REQUEST["ekiho"]==NULL||$_REQUEST["ekiho"]==""){
		$_REQUEST["ekiho"]="null";
	}
	if($_REQUEST["basu_hun"]==NULL||$_REQUEST["basu_hun"]==""){
		$_REQUEST["basu_hun"]="null";
	}
	if($_REQUEST["basu_ho"]==NULL||$_REQUEST["basu_ho"]==""){
		$_REQUEST["basu_ho"]="null";
	}
	if($_REQUEST["kuruma"]==NULL||$_REQUEST["kuruma"]==""){
		$_REQUEST["kuruma"]="null";
	}
	if($_REQUEST["kyori"]==NULL||$_REQUEST["kyori"]==""){
		$_REQUEST["kyori"]="null";
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
	if($_REQUEST["chisei"]==NULL||$_REQUEST["chisei"]==""){
		$_REQUEST["chisei"]=	$_REQUEST["syumoku"];
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
	if($_REQUEST["oneclick1"]==NULL||$_REQUEST["oneclick1"]==""){
		$_REQUEST["oneclick1"]=0;
	}
	if($_REQUEST["oneclick2"]==NULL||$_REQUEST["oneclick2"]==""){
		$_REQUEST["oneclick2"]=0;
	}
	if($_REQUEST["oneclick3"]==NULL||$_REQUEST["oneclick3"]==""){
		$_REQUEST["oneclick3"]=0;
	}
	if($_REQUEST["oneclick4"]==NULL||$_REQUEST["oneclick4"]==""){
		$_REQUEST["oneclick4"]=0;
	}
	if($_REQUEST["oneclick5"]==NULL||$_REQUEST["oneclick5"]==""){
		$_REQUEST["oneclick5"]=0;
	}
	if($_REQUEST["oneclick6"]==NULL||$_REQUEST["oneclick6"]==""){
		$_REQUEST["oneclick6"]=0;
	}
	if($_REQUEST["oneclick7"]==NULL||$_REQUEST["oneclick7"]==""){
		$_REQUEST["oneclick7"]=0;
	}
	if($_REQUEST["oneclick8"]==NULL||$_REQUEST["oneclick8"]==""){
		$_REQUEST["oneclick8"]=0;
	}
	if($_REQUEST["oneclick9"]==NULL||$_REQUEST["oneclick9"]==""){
		$_REQUEST["oneclick9"]=0;
	}
	if($_REQUEST["oneclick10"]==NULL||$_REQUEST["oneclick10"]==""){
		$_REQUEST["oneclick10"]=0;
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
	$imagesize["top"]["w"]=120;
	$imagesize["top"]["h"]=0;
	$imagesize["normal"]["w"]=555;
	$imagesize["normal"]["h"]=0;
	$imagesize["osusume"]["w"]=90;
	$imagesize["osusume"]["h"]=0;
	$imagesize["keitai"]["w"]=250;
	$imagesize["keitai"]["h"]=176;
	$imagesize["pop1"]["w"]=230;
	$imagesize["pop1"]["h"]=161;
	$imagesize["list"]["w"]=90;
	$imagesize["list"]["h"]=0;
	
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
	
	$imgobj6=new Upload();
	$imgobj6->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj6->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile6=$imgobj6->UpImgAndResize("photo6",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"])&&$imagefile6["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}
	
		
	$imgobj7=new Upload();
	$imgobj7->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj7->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile7=$imgobj7->UpImgAndResize("photo7",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"])&&$imagefile7["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}

			
	$imgobj8=new Upload();
	$imgobj8->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj8->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile8=$imgobj8->UpImgAndResize("photo8",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"])&&$imagefile8["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}


				
	$imgobj9=new Upload();
	$imgobj9->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj9->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile9=$imgobj9->UpImgAndResize("photo9",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"])&&$imagefile9["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}

				
	$imgobj10=new Upload();
	$imgobj10->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj10->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile10=$imgobj10->UpImgAndResize("photo10",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"])&&$imagefile10["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}

	$imgobj11=new Upload();
	$imgobj11->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj11->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile11=$imgobj11->UpImgAndResize("photo11",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"])&&$imagefile11["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
		
	}

	$imgobj12=new Upload();
	$imgobj12->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj12->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile12=$imgobj12->UpImgAndResize("photo12",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"])&&$imagefile12["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"]));
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
		$_REQUEST["jouken1"]=str_replace(",","",@number_format($_REQUEST["daimeikou"],2));

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
					"syougakkouku='".$_REQUEST["syougakkouku"].$_REQUEST["syougakkou"]."小学校',".
					"chuugakouku='".$_REQUEST["chuugakouku"].$_REQUEST["chugakkou"]."中学校',".
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
					"jouken1=".$_REQUEST["jouken1"].",".
					"jouken2=".$_REQUEST["jouken2"].",".
					"jouken3=".$_REQUEST["jouken3"].",".
					"jouken4=".$_REQUEST["jouken4"].",".
					"jouken5=".$_REQUEST["jouken5"].",".
					"jouken6=".$_REQUEST["jouken6"].",".
					"jouken7=".$_REQUEST["jouken7"].",".
					"jouken8=".$_REQUEST["jouken8"].",".
					"jouken9=".$_REQUEST["jouken9"].",".
					"oneclick1=".$_REQUEST["oneclick1"].",".
					"oneclick2=".$_REQUEST["oneclick2"].",".
					"oneclick3=".$_REQUEST["oneclick3"].",".
					"oneclick4=".$_REQUEST["oneclick4"].",".
					"oneclick5=".$_REQUEST["oneclick5"].",".
					"oneclick6=".$_REQUEST["oneclick6"].",".
					"oneclick7=".$_REQUEST["oneclick7"].",".
					"oneclick8=".$_REQUEST["oneclick8"].",".
					"oneclick9=".$_REQUEST["oneclick9"].",".
					"oneclick10=".$_REQUEST["oneclick10"].",".
					"del_chk=".$_REQUEST["del_chk"].",".
					"setsubi_other1=".$_REQUEST["setsubi_other1"].",".
					"setsubi_other2=".$_REQUEST["setsubi_other2"].",".
					"setsubi_other3=".$_REQUEST["setsubi_other3"].",".
					"setsubi_other4=".$_REQUEST["setsubi_other4"].",".
					"setsubi_other5=".$_REQUEST["setsubi_other5"].",".
					"setsubi_other6=".$_REQUEST["setsubi_other6"].",".
					"setsubi_other7=".$_REQUEST["setsubi_other7"].",".
					"setsubi_other8=".$_REQUEST["setsubi_other8"].",".
					"setsubi_other9=".$_REQUEST["setsubi_other9"].",".
					"keyword='".implode(" ",$_POST)."',".
					"setsubi_other10=".$_REQUEST["setsubi_other10"].",".
					"rains_chk=".$_REQUEST["rains_chk"].",".					
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
				$dbobj->Query("update bukken_photo set photo='300".$imagefile1["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=1");
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage1"]==1) {
					$upsql.="photo1=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=1");
				}
			}
			else if($_REQUEST["delimage1"]==1) {
				$upsql.="photo1=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=1");
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
				$dbobj->Query("update bukken_photo set photo='300".$imagefile2["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=2");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage2"]==1) {
				$upsql.="photo2=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=2");
				}
			}
			else if($_REQUEST["delimage2"]==1) {
				$upsql.="photo2=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=2");
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
				$dbobj->Query("update bukken_photo set photo='300".$imagefile3["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=3");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage3"]==1) {
				$upsql.="photo3=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=3");
				}
			}
			else if($_REQUEST["delimage3"]==1) {
				$upsql.="photo3=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=3");
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
				$dbobj->Query("update bukken_photo set photo='300".$imagefile4["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=4");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage4"]==1) {
				$upsql.="photo4=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=4");

				}
			}
			else if($_REQUEST["delimage4"]==1) {
				$upsql.="photo4=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=4");
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
								$dbobj->Query("update bukken_photo set photo='300".$imagefile5["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=5");

			}
			else if($setdata["listimg_defalt"]!=NULL){
				
				if($_REQUEST["delimage5"]==1) {
					$upsql.="photo5=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=5");
				}				
			}
			else if($_REQUEST["delimage5"]==1) {
				$upsql.="photo5=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=5");
			}
	}
	
	
		if($imagefile6["filepath"]!=NULL||$_REQUEST["delimage6"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile6["filepath"]!=NULL) {

				@chmod($imagefile6["filepath"],0777);
				@chmod("k_".$imagefile6["filepath"],0777);
				@chmod("o_".$imagefile6["filepath"],0777);
				@chmod("300".$imagefile6["filepath"],0777);
				@chmod("pop1".$imagefile6["filepath"],0777);
				@chmod("top".$imagefile6["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile6["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile6["name"],"b");
			}
				$upsql.="photo6='300".$imagefile6["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile6["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=6");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage6"]==1) {
					$upsql.="photo6=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=6");
				}				
			}
			else if($_REQUEST["delimage6"]==1) {
				$upsql.="photo6=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=6");
			}
	}

			if($imagefile7["filepath"]!=NULL||$_REQUEST["delimage7"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile7["filepath"]!=NULL) {

				@chmod($imagefile7["filepath"],0777);
				@chmod("k_".$imagefile7["filepath"],0777);
				@chmod("o_".$imagefile7["filepath"],0777);
				@chmod("300".$imagefile7["filepath"],0777);
				@chmod("pop1".$imagefile7["filepath"],0777);
				@chmod("top".$imagefile7["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile7["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile7["name"],"b");
			}
				$upsql.="photo7='300".$imagefile7["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile7["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=7");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage7"]==1) {
					$upsql.="photo7=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=7");
				}				
			}
			else if($_REQUEST["delimage7"]==1) {
				$upsql.="photo7=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=7");
			}
			
	}

	
				if($imagefile8["filepath"]!=NULL||$_REQUEST["delimage8"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile8["filepath"]!=NULL) {

				@chmod($imagefile8["filepath"],0777);
				@chmod("k_".$imagefile8["filepath"],0777);
				@chmod("o_".$imagefile8["filepath"],0777);
				@chmod("300".$imagefile8["filepath"],0777);
				@chmod("pop1".$imagefile8["filepath"],0777);
				@chmod("top".$imagefile8["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile8["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile8["name"],"b");
			}
				$upsql.="photo8='300".$imagefile8["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile8["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=8");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage8"]==1) {
					$upsql.="photo8=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=8");
				}				
			}
			else if($_REQUEST["delimage8"]==1) {
				$upsql.="photo8=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=8");
			}			
	}

					if($imagefile9["filepath"]!=NULL||$_REQUEST["delimage9"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile9["filepath"]!=NULL) {

				@chmod($imagefile9["filepath"],0777);
				@chmod("k_".$imagefile9["filepath"],0777);
				@chmod("o_".$imagefile9["filepath"],0777);
				@chmod("300".$imagefile9["filepath"],0777);
				@chmod("pop1".$imagefile9["filepath"],0777);
				@chmod("top".$imagefile9["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile9["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile9["name"],"b");
			}
				$upsql.="photo9='300".$imagefile9["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile9["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=9");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage9"]==1) {
					$upsql.="photo9=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=9");
				}				
			}
			else if($_REQUEST["delimage9"]==1) {
				$upsql.="photo9=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=9");
			}			
	}

						if($imagefile10["filepath"]!=NULL||$_REQUEST["delimage10"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile10["filepath"]!=NULL) {

				@chmod($imagefile10["filepath"],0777);
				@chmod("k_".$imagefile10["filepath"],0777);
				@chmod("o_".$imagefile10["filepath"],0777);
				@chmod("300".$imagefile10["filepath"],0777);
				@chmod("pop1".$imagefile10["filepath"],0777);
				@chmod("top".$imagefile10["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile10["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile10["name"],"b");
			}
				$upsql.="photo10='300".$imagefile10["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile10["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=10");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage10"]==1) {
					$upsql.="photo10=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=10");
				}				
			}
			else if($_REQUEST["delimage10"]==1) {
				$upsql.="photo10=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=10");
			}			
	}

						if($imagefile11["filepath"]!=NULL||$_REQUEST["delimage11"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile11["filepath"]!=NULL) {

				@chmod($imagefile11["filepath"],0777);
				@chmod("k_".$imagefile11["filepath"],0777);
				@chmod("o_".$imagefile11["filepath"],0777);
				@chmod("300".$imagefile11["filepath"],0777);
				@chmod("pop1".$imagefile11["filepath"],0777);
				@chmod("top".$imagefile11["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile11["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile11["name"],"b");
			}
				$upsql.="photo11='300".$imagefile11["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile11["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=11");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage11"]==1) {
					$upsql.="photo11=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=11");
				}				
			}
			else if($_REQUEST["delimage11"]==1) {
				$upsql.="photo11=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=11");
			}			
	}
	
		if($imagefile12["filepath"]!=NULL||$_REQUEST["delimage12"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile12["filepath"]!=NULL) {

				@chmod($imagefile12["filepath"],0777);
				@chmod("k_".$imagefile12["filepath"],0777);
				@chmod("o_".$imagefile12["filepath"],0777);
				@chmod("300".$imagefile12["filepath"],0777);
				@chmod("pop1".$imagefile12["filepath"],0777);
				@chmod("top".$imagefile12["filepath"],0777);
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile12["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","top".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/top".$imagefile12["name"],"b");
			}
				$upsql.="photo12='300".$imagefile12["name"]."',";
				$dbobj->Query("update bukken_photo set photo='300".$imagefile12["name"]."' where bukken_id=".$_REQUEST["bid"]." and nums=12");
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($_REQUEST["delimage12"]==1) {
					$upsql.="photo12=null,";
					$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=12");
				}				
			}
			else if($_REQUEST["delimage12"]==1) {
				$upsql.="photo12=null,";
				$dbobj->Query("update bukken_photo set photo='' where bukken_id=".$_REQUEST["bid"]." and nums=12");
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
	
	//$upsql.="pop_txt='".implode(",",$_POST["pop_txt"])."',";
	$upsql.="jouken10=".$_REQUEST["jouken10"]."";
	$upsql.=" where id='".$_REQUEST["bid"]."'";
	$dbobj->Query($upsql);
	// $upsql;
	if($_REQUEST["update_re"]=="更新して一覧へ戻る") {
	?>
	<script language="javascript">
	location.replace("index.php?PID=re_c1");
	</script>
	<?php
	}
	
}

$re1data=$re1obj->GetReData($_GET["bid"]);
$syougakulist=$dbobj->GetList("select distinct syougakkouku from bukken where syougakkouku <>''");
$chuugakoulist=$dbobj->GetList("select distinct chuugakouku from bukken where chuugakouku <>''");
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
/*

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
	*/
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

//リスト内の移動をする関数

function  gotolist() {
	location.replace("index.php?PID=re_c1");
}

</script><?php
$ctype="";
switch($_SESSION["cid"])
{
	case 1:
	$ctype="ウィング・バン";
	break;
	case 2:
	$ctype="冷凍車・冷凍ウィング";
	break;
	case 3:
	$ctype="平ボディ";
	break;
	case 4:
	$ctype="ダンプ";
	break;
	case 5:
	$ctype="クレーン付き・セルフクレーン付き";
	break;
	case 6:
	$ctype="セルフローダー車載車";
	break;
	case 7:
	$ctype="バス・特殊車";
	break;
	case 8:
	$ctype="その他";
	break;
	
}

?>
<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="realestate_bgcolor1">
		<form action="" method="post" enctype="multipart/form-data" name="bukken_form" id="bukken_form">
				<tr class="realestate_bgcolor2">
						<td valign="top"><table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp;</td>
										<td><table width="100%"  border="0" cellspacing="0" cellpadding="5">
												<tr>
														<td bgcolor="#FFFFFF" class="font10"><p><font color="#000000"> 車両変更 </font><font color="#000000"><?php echo $ctype;?></font></p></td>
												</tr>
										</table></td>
								</tr>
						</table></td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<th bgcolor="#ECECEC"> <div align="left">車両情報</div>
										</th>
								</tr>
								<tr>
										<td bgcolor="#FFFFFF"><table width="648" border="0" cellpadding="1" cellspacing="1">
												
												<tr>
														<td width="150" align="right" valign="top" class="font14"><div align="right">管理番号</div></td>
														<td width="491" class="font12"><input name="bukkenn_id" type="text" id="bukkenn_id"  value="<?php echo $re1data["bukkenn_id"];?>" /></td>
												</tr>
												
												<tr>
														<td align="right" valign="top">年式</td>
														<td class="font12"><select name="chiku_nen" id="chiku_nen">
														<?php
														for($ys=date("Y");$ys>1980;$ys--){
														?>
																<option value="<?php echo $ys;?>"<?php if($ys==$re1data["chiku_nen"]){ echo " selected";}?>><?php 
																
																if($ys==1989){
																		echo "H 元年";
																}
																else if($ys>1988){
																echo "H ".($ys-1988)."年";
																}
																else {
																		echo "S ".($ys-1925)."年";
																}
																?></option>
																<?php
																}
																?>
																<option value="1979">S 54年以前</option>
														</select>
																<input name="chiku_tsuki" type="text" class="noime" id="chiku_tsuki" value="<?php echo $re1data["chiku_tsuki"];?>" size="8" />
																月																</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">メーカー</td>
														<td class="font12"><input name="chimoku" type="text" id="chimoku" value="<?php echo $re1data["chimoku"];?>" />
																<input name="bid" type="hidden" id="bid" value="<?php echo $_GET["bid"];?>" /></td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">型式</td>
														<td class="font12"><input name="kosu" type="text" class="ime-active" id="kosu" value="<?php echo $re1data["kosu"];?>" size="20" /></td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">ボディ形状</td>
														<td class="font12"><select name="syumoku" id="syumoku">
														<?php
														switch($_SESSION["cid"]){
															case 1:
															?>
																<option<?php if($re1data["syumoku"]=="ウィング"){ echo " selected";}?>>ウィング</option>
																<option<?php if($re1data["syumoku"]=="バン"){ echo " selected";}?>>バン</option>
																<?php
																break;
																case 2:
																?>
																<option<?php if($re1data["syumoku"]=="冷凍車"){ echo " selected";}?>>冷凍車</option>
																<option<?php if($re1data["syumoku"]=="冷凍ウィング"){ echo " selected";}?>>冷凍ウィング</option>
																	<?php
																break;
																case 3:
																?>
																<option<?php if($re1data["syumoku"]=="平ボディ"){ echo " selected";}?>>平ボディ</option>
																	<?php
																break;
																case 4:
																?>
																<option<?php if($re1data["syumoku"]=="ダンプ"){ echo " selected";}?>>ダンプ</option>
																	<?php
																break;
																case 5:
																?>
																<option<?php if($re1data["syumoku"]=="クレーン付"){ echo " selected";}?>>クレーン付</option>
																	<option<?php if($re1data["syumoku"]=="セルフクレーン付"){ echo " selected";}?>>クレーン付</option>
																	<?php
																break;
																case 6:
																?>
																<option<?php if($re1data["syumoku"]=="セルフローダー車載車"){ echo " selected";}?>>セルフローダー車載車</option>
																	<?php
																break;
																case 7:
																?>
																<option<?php if($re1data["syumoku"]=="バス"){ echo " selected";}?>>バス</option>
																<option<?php if($re1data["syumoku"]=="特殊車"){ echo " selected";}?>>特殊車</option>
																	<?php
																break;
																case 8:
																?>
																<option<?php if($re1data["syumoku"]=="その他"){ echo " selected";}?>>その他</option>
																<?php
																break;
														}?>
														</select>
														　詳細
																<input name="chisei" type="text" id="chisei" value="<?php echo $re1data["chisei"];?>" size="40" /></td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">走行距離</td>
														<td class="font12"><input name="kyori" type="text" id="kyori" class="noime" value="<?php echo $re1data["kyori"];?>" size="20" />
																km</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">積載クラス</td>
														<td class="font12" id="daimeikou"><input name="daimeikou" type="text" class="ime-active" id="daimeikou" value="<?php echo $re1data["daimeikou"];?>" size="20" />
														t</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">車検</td>
														<td class="font12"><input name="zousajouto" type="text"  id="zousajouto" value="<?php echo $re1data["zousajouto"];?>" size="40" /></td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">馬力</td>
														<td class="font12"><input name="reikin" type="text"  id="reikin" value="<?php echo $re1data["reikin"];?>" size="20" />
																ps</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">排気量</td>
														<td class="font12"><input name="kyouekihi_tani" type="text"  id="kyouekihi_tani" value="<?php echo $re1data["kyouekihi_tani"];?>" size="20" />
																cc</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">積載量</td>
														<td class="font12"><input name="kenrikin" type="text" class="ime-active" id="kenrikin" value="<?php echo $re1data["kenrikin"];?>" size="20" />
																kg</td>
												</tr>
												<tr>
														<td align="right" valign="top" class="font14">荷台内寸<br />
																（ｍｍ）</td>
														<td class="font12"><textarea name="shidoumenseki" cols="60"  id="shidoumenseki"><?php echo $re1data["shidoumenseki"];?></textarea></td>
												</tr>
						
										</table></td>
								</tr>
						</table></td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<th bgcolor="#ECECEC"> <div align="left">装備・備考</div>
										</th>
								</tr>
								<tr>
										<td bgcolor="#FFFFFF"><table width="648" border="0" cellpadding="1" cellspacing="1">
												<?php
										if(str_replace("www.","",$_SERVER['SERVER_NAME'])=="f-ourhouse.com"||str_replace("www.","",$_SERVER['SERVER_NAME'])=="e-altus.com"){
										?>
												<?php
														}
														?>
												<tr>
														<td width="150" valign="top" bgcolor="#FFFFFF" class="font14"><div align="right">公開装備・備考</div></td>
														<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
																<textarea name="bikou" cols="60" rows="6" class="ime-active" id="bikou"><?php echo $re1data["bikou"];?></textarea>
																<textarea name="admin_bikou" cols="60" rows="6" class="ime-active" id="admin_bikou"><?php echo $re1data["admin_bikou"];?></textarea>
														</span></td>
												</tr>
												<tr>
														<td width="150" valign="top" bgcolor="#FFFFFF" class="font14"><div align="right">非公開備考</div></td>
														<td bgcolor="#FFFFFF" class="font12">&nbsp;</td>
												</tr>
												<?php 
					if($bsetdata["torihikitaiyou_admin"]==1) {
					?>
												<?php 
					}
					?>
										</table></td>
								</tr>
						</table></td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<th bgcolor="#ECECEC"> <div align="left"><?php echo $bsetdata["photo_name"] ?></div>
										</th>
								</tr>
								<tr>
										<td bgcolor="#FFFFFF"><table width="648" border="0" cellpadding="1" cellspacing="1">
												<?php
												
												$photolist=$dbobj->GetList("select * from bukken_photo where bukken_id=".$re1data["id"]." order by turn");
					for($row=0;$row<12;$row++) {
						
					?>
												<tr>
														<td width="150" rowspan="3" valign="top" class="font14"><div align="right" class="font14">写真<?php echo $row+1;?> </div></td>
														<td width="491" bgcolor="#FFFFFF" class="font12"><?php if($photolist[$row]["photo"]!=NULL) {?>
																<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$photolist[$row]["photo"]."?".time();?>" alt="" /><br />
																<input name="delimage<?php echo $photolist[$row]["nums"];?>" type="checkbox" id="delimage<?php echo $photolist[$row]["nums"];?>" value="1" />
																写真を削除する
													
																<?php 
												}
												?></td>
												</tr>
												<tr>
														<td bgcolor="#FFFFFF" class="font12"><input name="photo<?php echo $photolist[$row]["nums"];?>" type="file" id="photo<?php echo $photolist[$row]["nums"];?>" /></td>
												</tr>
												<tr>
														<td bgcolor="#FFFFFF" class="font12"><input name="turn<?php echo $photolist[$row]["nums"];?>" type="hidden" id="turn<?php echo $photolist[$row]["nums"];?>" value="<?php echo $photolist[$row]["turn"];?>" size="6" /></td>
												</tr>
												<?php 
					}
?>
										</table></td>
								</tr>
						</table></td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top">&nbsp;</td>
				</tr>
				<tr class="realestate_bgcolor2">
						<td valign="top"><span class="font12"> </span>
								<table width="100%" cellpadding="1" cellspacing="1">
										<tr>
												<td valign="top" bgcolor="#FFFFFF" class="font14"><div align="right">おすすめ</div></td>
												<td bgcolor="#FFFFFF" class="font12"><input name="osusume" type="checkbox" id="osusume" value="1"<?php if($re1data["osusume"]==1) {echo " checked"; }?> /></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#FFFFFF" class="font14"><div align="right">公開・非公開</div></td>
												<td bgcolor="#FFFFFF" class="font12"><select name="del_chk" id="del_chk">
														<option value="0"<?php if($re1data["del_chk"]==0||$re1data["del_chk"]==NULL) {echo " selected";}?>>公開</option>
														<option value="1"<?php if($re1data["del_chk"]==1) {echo  " selected";}?>>非公開</option>
												</select></td>
										</tr>
										<tr>
												<td valign="top" class="font14">&nbsp;</td>
												<td bgcolor="#FFFFFF" class="font12">&nbsp;</td>
										</tr>
										<tr>
												<td width="150" valign="top" class="font14">&nbsp;</td>
												<td bgcolor="#FFFFFF" class="font12"><input name="update_re" type="submit" id="update_re" value="更新する" />
														<input name="update_re" type="submit" id="update_re" value="更新して一覧へ戻る" />
														<span class="realestate_bgcolor3">
																<input name="btm" type="button" id="btm" onclick="gotolist()" value="一覧へ戻る" />
														</span>
														</td>
										</tr>
								</table></td>
				</tr>
		</form>
</table>
