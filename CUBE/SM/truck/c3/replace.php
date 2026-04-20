<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =3");
if($_REQUEST["update_re"]=="更新する"||$_REQUEST["update_re"]=="更新して一覧へ戻る") {
	$dbobj->Query("update lastupdate set lastupdate=".time()."");

	if($_REQUEST["menseki"]==NULL||$_REQUEST["menseki"]==""){
		$_REQUEST["menseki"]="null";
	}
	if($_REQUEST["kakaku"]==NULL||$_REQUEST["kakaku"]==""){
		$_REQUEST["kakaku"]="null";
	}
	
	if($_REQUEST["tsubosu"]==NULL||$_REQUEST["tsubosu"]==""){
		$_REQUEST["tsubosu"]="null";
	}
	if($_REQUEST["madori"]==NULL||$_REQUEST["madori"]==""){
		$_REQUEST["madori"]="null";
	}
	if($_REQUEST["tsubotanka"]==NULL||$_REQUEST["tsubotanka"]==""){
		$_REQUEST["tsubotanka"]="null";
	}
	if($_REQUEST["buntankin"]==NULL||$_REQUEST["buntankin"]==""){
		$_REQUEST["buntankin"]="null";
	}
	if($_REQUEST["kenpei_ritsu"]==NULL||$_REQUEST["kenpei_ritsu"]==""){
		$_REQUEST["kenpei_ritsu"]="null";
	}
	if($_REQUEST["youseki_ritsu"]==NULL||$_REQUEST["youseki_ritsu"]==""){
		$_REQUEST["youseki_ritsu"]="null";
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
	if($_REQUEST["shikibiki_kakaku"]==NULL||$_REQUEST["shikibiki_kakaku"]==""){
		$_REQUEST["shikibiki_kakaku"]="null";
	}
	if($_REQUEST["shikibiki_tsuki"]==NULL||$_REQUEST["shikibiki_tsuki"]==""){
		$_REQUEST["shikibiki_tsuki"]="null";
	}
	if($_REQUEST["shikibiki_jippi"]==NULL||$_REQUEST["shikibiki_jippi"]==""){
		$_REQUEST["shikibiki_jippi"]="null";
	}
	if($_REQUEST["reikin"]==NULL||$_REQUEST["reikin"]==""){
		$_REQUEST["reikin"]="null";
	}
	if($_REQUEST["kyouekihi"]==NULL||$_REQUEST["kyouekihi"]==""){
		$_REQUEST["kyouekihi"]="null";
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
	$imgobj=new Upload();
	$bname="bukken";
	$setdata["listimg_w"]=800;
	$setdata["listimg_h"]=0;
	$imagesize["big"]["w"]=800;
	$imagesize["big"]["h"]=0;
	$imagesize["normal"]["w"]=300;
	$imagesize["normal"]["h"]=211;
	$imagesize["osusume"]["w"]=120;
	$imagesize["osusume"]["h"]=84;
	$imagesize["keitai"]["w"]=250;
	$imagesize["keitai"]["h"]=176;
	
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/");
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/",0777);
	
	$imgobj=new Upload();
	$bname="bukken";
	$setdata["listimg_w"]=800;
	$setdata["listimg_h"]=0;
	$imagesize["big"]["w"]=800;
	$imagesize["big"]["h"]=0;
	$imagesize["normal"]["w"]=300;
	$imagesize["normal"]["h"]=211;
	$imagesize["osusume"]["w"]=120;
	$imagesize["osusume"]["h"]=84;
	$imagesize["keitai"]["w"]=250;
	$imagesize["keitai"]["h"]=176;
	$imagesize["pop1"]["w"]=230;
	$imagesize["pop1"]["h"]=161;
	
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/");
	@mkdir($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/");
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/",0777);
	
	@chmod($imagefile1["filepath"],0777);
	@chmod("k_".$imagefile1["filepath"],0777);
	@chmod("o_".$imagefile1["filepath"],0777);
	@chmod("300".$imagefile1["filepath"],0777);
	@chmod("pop1".$imagefile1["filepath"],0777);

	@chmod($imagefile2["filepath"],0777);
	@chmod("k_".$imagefile2["filepath"],0777);
	@chmod("o_".$imagefile2["filepath"],0777);
	@chmod("300".$imagefile2["filepath"],0777);
	@chmod("pop1".$imagefile2["filepath"],0777);
	
	@chmod($imagefile3["filepath"],0777);
	@chmod("k_".$imagefile3["filepath"],0777);
	@chmod("o_".$imagefile3["filepath"],0777);
	@chmod("300".$imagefile3["filepath"],0777);
	@chmod("pop1".$imagefile3["filepath"],0777);
	
	@chmod($imagefile4["filepath"],0777);
	@chmod("k_".$imagefile4["filepath"],0777);
	@chmod("o_".$imagefile4["filepath"],0777);
	@chmod("300".$imagefile4["filepath"],0777);
	@chmod("pop1".$imagefile4["filepath"],0777);
	
	@chmod($imagefile5["filepath"],0777);
	@chmod("k_".$imagefile5["filepath"],0777);
	@chmod("o_".$imagefile5["filepath"],0777);
	@chmod("300".$imagefile5["filepath"],0777);
	@chmod("pop1".$imagefile5["filepath"],0777);

	@chmod($mimagefile["filepath"],0777);
	@chmod("k_".$mimagefile1["filepath"],0777);
	@chmod("o_".$mimagefile1["filepath"],0777);
	@chmod("300".$mimagefile1["filepath"],0777);
	@chmod("pop1".$mimagefile1["filepath"],0777);

	@chmod($mimagefile2["filepath"],0777);
	@chmod("k_".$mimagefile2["filepath"],0777);
	@chmod("o_".$mimagefile2["filepath"],0777);
	@chmod("300".$mimagefile2["filepath"],0777);
	@chmod("pop1".$mimagefile2["filepath"],0777);
	
	
	$imgobj->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile1=$imgobj->UpImgAndResize("photo1",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"])&&$imagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"pop1".$fdata["basename"],$fdata["dirname"]."/",$imagesize["pop1"]["w"],$imagesize["pop1"]["h"]);
	}

	$imgobj2=new Upload();
	$imgobj2->path=$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imgobj2->rpath="/tmp/".$bname."_data/".$_REQUEST["bid"]."/";
	$imagefile2=$imgobj2->UpImgAndResize("photo2",$imagesize["big"]["w"],$imagesize["big"]["h"]);	
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"])&&$imagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"])&&$imagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"])&&$imagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"])&&$imagefile2["name"]!=NULL) {
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
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"])&&$imagefile3["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"])&&$imagefile3["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"])&&$imagefile3["name"]!=NULL) {
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
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"])&&$imagefile4["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"])&&$imagefile4["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"])&&$imagefile4["name"]!=NULL) {
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
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"])&&$imagefile5["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"o_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["osusume"]["w"],$imagesize["osusume"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"])&&$imagefile5["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
		
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"])&&$imagefile5["name"]!=NULL) {
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
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"])&&$mimagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"])&&$mimagefile1["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",$imagesize["normal"]["w"],$imagesize["normal"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"])&&$mimagefile1["name"]!=NULL) {
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
	}
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"])&&$mimagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"300".$fdata["basename"],$fdata["dirname"]."/",300,211);
	}
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"])&&$mimagefile2["name"]!=NULL) {
		$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"]));
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",$imagesize["keitai"]["w"],$imagesize["keitai"]["h"]);
	}
	
	if(@file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"])&&$mimagefile2["name"]!=NULL) {
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
					"syougakkouku='".$_REQUEST["syougakkouku"]."小学校',".
					"chuugakouku='".$_REQUEST["chuugakouku"]."中学校',".
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
					"keyword='".implode(" ",$_POST)."',".			
					"del_chk=".$_REQUEST["del_chk"].",".
					"banchichk=".$_REQUEST["banchichk"].",";
					
	if($imagefile1["filepath"]!=NULL||$_REQUEST["delimage1"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
				@chmod($imagefile1["filepath"],0777);
				@chmod("k_".$imagefile1["filepath"],0777);
				@chmod("o_".$imagefile1["filepath"],0777);
				@chmod("300".$imagefile1["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
					$ftp->MkDir("tmp/",$bname."_data");
					$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile1["name"],"b");
					$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","pop1".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/pop1".$imagefile1["name"],"b");
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
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile2["name"],"b");
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
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile3["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile3["name"],"b");
			
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile3["name"],"b");
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
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile4["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile4["name"],"b");
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
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$imagefile5["name"],"b");
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
			
			if($mimagefile1["filepath"]!=NULL) {
				
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","pop1".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/pop1".$mimagefile1["name"],"b");
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
					if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$_REQUEST["bid"]);
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/",$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","o_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/o_".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","k_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/k_".$mimagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$_REQUEST["bid"]."/","300".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$_REQUEST["bid"]."/300".$mimagefile2["name"],"b");
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
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/300photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/k_photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/o_photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$_REQUEST["bid"]."/photo5.jpg",0777);
	$upsql.="pop_txt='".implode(",",$_REQUEST["pop_txt"])."',";
	$upsql.="jouken10=".$_REQUEST["jouken10"]."";
	$upsql.=" where id=".$_REQUEST["bid"]."";
	$dbobj->Query($upsql);
	
	if($_REQUEST["update_re"]=="更新して一覧へ戻る") {
	?>
	<script language="javascript">
	location.replace("index.php?PID=re_c3");
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
//リスト内の移動をする関数
function func(elenum1,elenum2) {
	var devneko;
			switch(document.bukken_form.elements[elenum1].value) {
				case "1":
				devneko="";
				document.bukken_form.elements[elenum2].length=0;
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "1";
					var str = document.createTextNode("大竹駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "2";
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "3";
					var str = document.createTextNode("南岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "4";
					var str = document.createTextNode("藤生駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "5";
					var str = document.createTextNode("通津駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "6";
					var str = document.createTextNode("由宇駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "7";
					var str = document.createTextNode("神代駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "8";
					var str = document.createTextNode("大畠駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "9";
					var str = document.createTextNode("柳井港駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "10";
					var str = document.createTextNode("柳井駅");
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
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "12";
					var str = document.createTextNode("御庄駅");
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
					var str = document.createTextNode("岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
								if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "11";
					var str = document.createTextNode("川西駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "13";
					var str = document.createTextNode("西岩国駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "14";
					var str = document.createTextNode("柱野駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "15";
					var str = document.createTextNode("欽明路駅");
					ele.appendChild(str);
			
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				if (document.createElement) {
					var ele = document.createElement("option");
					ele.value = "16";
					var str = document.createTextNode("玖珂駅 ");
					ele.appendChild(str);
					document.bukken_form.elements[elenum2].appendChild(ele);
				}
				break;
					default:
				document.bukken_form.elements[elenum2].length=0;
				var ele = document.createElement("option");
				ele.value = "0";
				var str = document.createTextNode("駅を選択してください");
				ele.appendChild(str);
				document.bukken_form.elements[elenum2].appendChild(ele);
	}
}

function  gotolist() {
	location.replace("index.php?PID=re_c3");
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
		<TR class="realestate_bgcolor2">
		    <TD valign="top">
		        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
              <tr>
                  <td width="15" bgcolor="#CCCCCC">&nbsp; </td>
                  <td>
                      <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                          <tr>
                              <td bgcolor="#FFFFFF" class="font10">
                                  <p>賃貸事業用物件修正 </p>
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
		    <TD valign="top"><div class="helper">賃貸事業用物件に表示する項目を設定するには<a href="?PID=re_c3_set">こちらをクリック</a>してください。
		            <br>
      データの入力されていない項目をお客様用の物件詳細ページで表示しない場合は<a href="?PID=re_osetting">こちらをクリック</a>してください。<br>
      <font color="#FF0000">※この設定は全ての種別で共通になっております。</font></div></TD>
    </TR>
		<TR class="realestate_bgcolor2">
		    <TD valign="top">&nbsp;</TD>
    </TR>
		<TR class="realestate_bgcolor2">
				<TD valign="top">
						<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
			              <table width="725" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
                            <?php 
					if($bsetdata["bukken_id_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["bukken_id_name"]; ?></div></td>
                              <td width="562" bgcolor="#FFFFFF" class="font12">
                                <input name="bukkenn_id" type="text" class="noime" id="bukkenn_id" value="<?php echo $re1data["bukkenn_id"];?>">
                              </td>
                            </tr>
                            <?php
					}
					if($bsetdata["syumoku_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["syumoku_name"] ?>
                                    <!--種目 -->
                                    <font color="#FF0000">（※必須）</font></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="syumoku" id="syumoku">
                                  <option<?php if($re1data["syumoku"]=="店舗（一戸建）"){echo " selected";}?>>店舗（一戸建）</option>
                                  <option<?php if($re1data["syumoku"]=="店舗（建物一部）"){echo " selected";}?>>店舗（建物一部）</option>
                                  <option<?php if($re1data["syumoku"]=="事務所"){echo " selected";}?>>事務所</option>
                                  <option<?php if($re1data["syumoku"]=="店舗・事務所"){echo " selected";}?>>店舗・事務所</option>
                                  <option<?php if($re1data["syumoku"]=="工場"){echo " selected";}?>>工場</option>
                                  <option<?php if($re1data["syumoku"]=="倉庫"){echo " selected";}?>>倉庫</option>
                                  <option<?php if($re1data["syumoku"]=="マンション"){echo " selected";}?>>マンション</option>
                                  <option<?php if($re1data["syumoku"]=="旅館"){echo " selected";}?>>旅館</option>
                                  <option<?php if($re1data["syumoku"]=="寮"){echo " selected";}?>>寮</option>
                                  <option<?php if($re1data["syumoku"]=="別荘"){echo " selected";}?>>別荘</option>
                                  <option<?php if($re1data["syumoku"]=="土地"){echo " selected";}?>>土地</option>
                                  <option<?php if($re1data["syumoku"]=="ビル"){echo " selected";}?>>ビル</option>
                                  <option<?php if($re1data["syumoku"]=="住宅付店舗（一戸建）"){echo " selected";}?>>住宅付店舗（一戸建）</option>
                                  <option<?php if($re1data["syumoku"]=="住宅付店舗（建物一部）"){echo " selected";}?>>住宅付店舗（建物一部）</option>
                                  <option<?php if($re1data["syumoku"]=="その他"){echo " selected";}?>>その他</option>
                                </select>
                              </td>
                            </tr>
                            <?php
					}
					if($bsetdata["bukken_mei_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["bukken_mei_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="bukken_mei" type="text" class="ime-active" id="bukken_mei" value="<?php echo $re1data["bukken_mei"];?>" size="50" />
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="bukken_mei" id="bukken_mei" value="<?php echo $re1data["bukken_mei"];?>">
                            <?php
					}
					if($bsetdata["bukken_hurigana_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["bukken_hurigana_name"] ?>
                                    <!-- 物件フリガナ-->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="bukken_hurigana" type="text" class="ime-active" id="bukken_hurigana" value="<?php echo $re1data["bukken_hurigana"];?>" size="50" />
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="bukken_hurigana" id="bukken_hurigana" value="<?php echo $re1data["bukken_hurigana"];?>">
                            <?php 
										}
					if($bsetdata["jyusyo_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14">
                                  <!--物件所在地  -->
                                  <?php echo $bsetdata["jyusyo_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="yubinbangou" type="text" class="noime" id="yubinbangou" value="<?php echo $re1data["yubinbangou"];?>" size="15" />
                                <input type="button" name="Submit2" value="郵便番号から住所を入力" onClick="zipcode()" />
                              </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">都道府県</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="todouhuken" type="text" class="ime-active" id="todouhuken" value="<?php echo $re1data["todouhuken"];?>" size="10" />
                              </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">市区郡</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="jyusyo1" type="text" class="ime-active" id="jyusyo1" value="<?php echo $re1data["jyusyo1"];?>" size="8" />
                              </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">町名</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="jyusyo2" type="text" class="ime-active" id="jyusyo2" value="<?php echo $re1data["jyusyo2"];?>" size="30" />
                              </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">番地</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="jyusyo3" type="text" class="ime-active" id="jyusyo3" value="<?php echo $re1data["jyusyo3"];?>" size="30" />
                                <label>
                                <input name="banchichk" type="checkbox" id="banchichk" value="1"<?php if($re1data["banchichk"]==1){ echo ' checked';}?> />
      番地を公開</label>
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="yubinbangou" id="yubinbangou" value="<?php echo $re1data["yubinbangou"];?>">
                            <input type="hidden" name="todouhuken" id="todouhuken" value="<?php echo $re1data["todouhuken"];?>">
                            <input type="hidden" name="jyusyo1" id="jyusyo1" value="<?php echo $re1data["jyusyo1"];?>">
                            <input type="hidden" name="jyusyo2" id="jyusyo2" value="<?php echo $re1data["jyusyo2"];?>">
                            <input type="hidden" name="jyusyo3" id="jyusyo3" value="<?php echo $re1data["jyusyo3"];?>">
                            <input type="hidden" name="banchichk" id="banchichk" value="<?php echo $re1data["banchichk"];?>">
                            <?php 
										}
					if($bsetdata["kakaku_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14">
                                  <!--賃料 -->
                                  <?php echo $bsetdata["kakaku_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="kakaku" type="text" class="noime" id="kakaku" value="<?php echo $re1data["kakaku"];?>" size="15" />
      万円 </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="kakaku" id="kakaku" value="<?php echo $re1data["kakaku"];?>">
                            <?php 
										}
					if($bsetdata["ensen_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right">
                        <!--沿線 -->
                        <?php echo $bsetdata["ensen_name"]  ?></div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <input type="text" name="ensen" id="ensen" value="<?php echo $re1data["ensen"];?>" />
                </td>
            </tr>
            <tr>
                <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right">最寄駅 </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <input name="eki" type="text" id="eki" value="<?php echo $re1data["eki"];?>" />
駅                </td>
            </tr>
            <tr>
                <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right">徒歩 </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <input name="ekiho" type="text" class="noime" id="ekiho" value="<?php echo $re1data["ekiho"];?>" size="6" />
                    分 </td>
            </tr>
            <?php 
					}
					else {
					?>
            <?php 
										}
					if($bsetdata["basu_admin"]==1) {
					?>
            <tr>
                <td valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right">距離</div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <input name="kyori" type="text" class="noime" id="kyori" value="<?php echo $re1data["kyori"];?>" size="10" />
m </td>
            </tr>
            <tr>
                <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right">
                        <!--バス -->
                        <?php echo $bsetdata["basu_name"]  ?> </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    最寄駅から乗車
                        <input name="basu" type="text" class="noime" id="basu" value="<?php echo $re1data["basu"];?>" size="6" />
                    分 バス停
                    <input name="basutei" type="text" class="ime-active" id="basutei" value="<?php echo $re1data["basutei"];?>" />
                    から 徒歩
                    <input name="basu_ho" type="text" class="noime" id="basu_ho" value="<?php echo $re1data["basu_ho"];?>" size="6" />
                    分 </td>
            </tr>
            <?php 
					}
					else {
					?>
            <?php 
					}
					if($bsetdata["kuruma_admin"]==1) {
					?>
            <tr>
                <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right"><?php echo $bsetdata["kuruma_name"]  ?>
                            <!--車 -->
                   </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                     最寄駅から乗車<input name="kuruma" type="text" class="noime" id="kuruma" value="<?php echo $re1data["kuruma"];?>" size="6" />
                    分</td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="kuruma" id="kuruma" value="<?php echo $re1data["kuruma"];?>">
                            <input type="hidden" name="kyori" id="kyori" value="<?php echo $re1data["kyori"];?>">
                            <?php 
										}
					if($bsetdata["syougakkouku_admin"]==1) {
					?>
                            <tr>
<td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right"><?php echo $bsetdata["syougakkouku_name"]  ?>
                            <!--小学校区 -->
                    </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <select name="syougakkou" id="syougakkou" onchange="chsyougaku()">
                        <option value="">　</option>
                        <?php
											for($i=0;$syougakulist[$i]["syougakkouku"]!=NULL;$i++) {
											?>
                        <option value="<?php echo str_replace("小学校","",$syougakulist[$i]["syougakkouku"]) ?>"><?php echo str_replace("小学校","",$syougakulist[$i]["syougakkouku"]) ?></option>
                        <?php
											}
											?>
                    </select>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" class="font12">
                    <input name="syougakkouku" type="text" id="syougakkouku" value="<?php echo str_replace("小学校","",$re1data["syougakkouku"]);?>" size="12" />
                    小学校 </td>
            </tr>
            <?php 
					}
					else {
					?>
            <?php 
										}
					if($bsetdata["chuugakouku_admin"]==1) {
					?>
            <tr>
                <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                    <div align="right"><?php echo $bsetdata["chuugakouku_name"]  ?>
                            <!--中学校区 -->
                    </div>
                </td>
                <td bgcolor="#FFFFFF" class="font12">
                    <select name="chugakkou" id="chugakkou" onchange="chchugaku()">
                        <option value="">　</option>
                        <?php
											for($i=0;$chuugakoulist[$i]["chuugakouku"]!=NULL;$i++) {
											?>
                        <option value="<?php echo str_replace("中学校","",$chuugakoulist[$i]["chuugakouku"]); ?>"><?php echo str_replace("中学校","",$chuugakoulist[$i]["chuugakouku"]) ?></option>
                        <?php
											}
											?>
                    </select>
                </td>
            </tr>
            <tr>
                <td bgcolor="#FFFFFF" class="font12">
                    <input name="chuugakouku" type="text" id="chuugakouku" value="<?php echo str_replace("中学校","",$re1data["chuugakouku"]);?>" size="12" />
                    中学校</td>                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="chuugakouku" id="chuugakouku" value="<?php echo $re1data["chuugakouku"];?>">
                            <?php 
										}
					if($bsetdata["kouzou_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["kouzou_name"]  ?>
                                    <!--構造 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="kouzou" id="kouzou">
                                  <option<?php if($re1data["kouzou"]=="ＲＣ"){echo " selected";}?>>ＲＣ</option>
                                  <option<?php if($re1data["kouzou"]=="ＳＲＣ"){echo " selected";}?>>ＳＲＣ</option>
                                  <option<?php if($re1data["kouzou"]=="ブロック造"){echo " selected";}?>>ブロック造</option>
                                  <option<?php if($re1data["kouzou"]=="鉄骨造"){echo " selected";}?>>鉄骨造</option>
                                  <option<?php if($re1data["kouzou"]=="木造"){echo " selected";}?>>木造</option>
                                  <option<?php if($re1data["kouzou"]==""){echo " selected";}?>></option>
                                </select>
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="kouzou" id="kouzou" value="<?php echo $re1data["kouzou"];?>">
                            <?php 
										}
					if($bsetdata["kaisou_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["kaisou_name"]?>
                                    <!--物件階層 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">地上
                                  <input name="chijoukaisou" type="text" class="noime" id="chijoukaisou" value="<?php echo $re1data["chijoukaisou"];?>" size="6" />
      階<br />
      地下
      <input name="chikakaisou" type="text" class="noime" id="chikakaisou" value="<?php echo $re1data["chikakaisou"];?>" size="6" />
      階<br />
      所在
      <input name="kaisou" type="text" class="noime" id="kaisou" value="<?php echo $re1data["kaisou"];?>" size="6" />
      階 </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="chijoukaisou" id="chijoukaisou" value="<?php echo $re1data["chijoukaisou"];?>">
                            <input type="hidden" name="chikakaisou" id="chikakaisou" value="<?php echo $re1data["chikakaisou"];?>">
                            <input type="hidden" name="kaisou" id="kaisou" value="<?php echo $re1data["kaisou"];?>">
                            <?php 
					}
					if($bsetdata["chiku_nen_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["chiku_nen_name"] ?>
                                    <!--築年月 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"> <span> 西暦
                                    <input name="chiku_nen" type="text" class="noime" id="chiku_nen" value="<?php echo $re1data["chiku_nen"];?>" size="8" />
      年
      <input name="chiku_tsuki" type="text" class="noime" id="chiku_tsuki" value="<?php echo $re1data["chiku_tsuki"];?>" size="8" />
      月 </span> </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="chiku_nen" id="chiku_nen" value="<?php echo $re1data["chiku_nen"];?>">
                            <input type="hidden" name="chiku_tsuki" id="chiku_tsuki" value="<?php echo $re1data["chiku_tsuki"];?>">
                            <?php 
					}
					if($bsetdata["shinchiku_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["shinchiku_name"] ?>
                                    <!--新築チェック -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="shinchiku" type="checkbox" id="shinchiku" value="1" <?php if($re1data["shinchiku"]!=NULL) { echo " checked";}?> />
                              </td>
                            </tr>
                            <?php
					}
					if($bsetdata["shikikin_admin"]==1) {
					?>
                            <tr>
                              <td width="150" align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14">
                                  <div align="right"><?php echo $bsetdata["shikikin_name"] ?>
                                      <!--敷金 -->
                                  </div>
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                <input name="shikikin" type="text" class="noime" id="shikikin" value="<?php echo $re1data["shikikin"];?>" size="6" />
      ヶ月 </span> <span class="realestate_bgcolor3">
      <input name="sikikintani" type="text" class="noime" id="sikikintani" value="<?php echo $re1data["sikikintani"];?>" size="6" />
      万円</span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="shikikin" id="shikikin" value="<?php echo $re1data["shikikin"];?>">
                            <input type="hidden" name="sikikintani" id="sikikintani" value="<?php echo $re1data["sikikintani"];?>">
                            <?php 
										}
					if($bsetdata["reikin_admin"]==1) {
					?>
                            <tr>
                              <td width="150" align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14">
                                  <div align="right"><?php echo $bsetdata["reikin_name"] ?>
                                      <!--礼金 -->
                                  </div>
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                <input name="reikin" type="text" class="noime" id="reikin" value="<?php echo $re1data["reikin"];?>" size="6" />
      ヶ月
      <input name="reikin_tani" type="text" class="noime" id="reikin_tani" value="<?php echo $re1data["reikin_tani"];?>" size="6" />
      万円 </span> </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="reikin" id="reikin" value="<?php echo $re1data["reikin"];?>">
                            <input type="hidden" name="reikin_tani" id="reikin_tani" value="<?php echo $re1data["reikin_tani"];?>">
                            <?php 
										}
					if($bsetdata["kanrihi_admin"]==1) {
					?>
                            <tr>
                              <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["kanrihi_name"] ?>
                                    <!--管理費 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
                                <input name="kanrihi" type="text" class="noime" id="kanrihi" value="<?php echo $re1data["kanrihi"];?>" size="10" />
      円 </span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="kanrihi" id="kanrihi" value="<?php echo $re1data["kanrihi"];?>">
                            <?php 
										}
					if($bsetdata["kyouekihi_admin"]==1) {
					?>
                            <tr>
                              <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["kyouekihi_name"] ?>
                                    <!--共益費 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
                                <input name="kyouekihi" type="text" class="noime" id="kyouekihi" value="<?php echo $re1data["kyouekihi"];?>" size="20" />
      円</span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="kyouekihi" id="kyouekihi" value="<?php echo $re1data["kyouekihi"];?>">
                            <?php 
										}
					if($bsetdata["syuzenhi_tsumitate_admin"]==1) {
					?>
                            <tr>
                              <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["syuzenhi_tsumitate_name"] ?>
                                    <!--修繕積立金 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="syuzenhi_tsumitate" type="text" id="syuzenhi_tsumitate" value="<?php echo $re1data["syuzenhi_tsumitate"];?>">
                                <span class="realestate_bgcolor3">円</span> </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="syuzenhi_tsumitate" id="syuzenhi_tsumitate" value="<?php echo $re1data["syuzenhi_tsumitate"];?>">
                            <?php 
										}
					if($bsetdata["zappi_admin"]==1) {
					?>
                            <tr>
                              <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["zappi_name"] ?>
                                    <!--その他利用料 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="zappi" type="text" id="zappi" class="noime" value="<?php echo $re1data["zappi"];?>">
                                <span class="realestate_bgcolor3">円</span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="zappi" id="zappi" value="<?php echo $re1data["zappi"];?>">
                            <?php 
					}
					if($bsetdata["hosyoukin_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["hosyoukin_name"] ?>
                                    <!--保証金 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
                                <input name="hosyoukin_kikan" type="text" class="noime" id="hosyoukin_kikan" value="<?php echo $re1data["hosyoukin_kikan"];?>" size="6" />
      ヶ月
      <input name="hosyoukin_kakaku" type="text" class="noime" id="hosyoukin_kakaku" value="<?php echo $re1data["hosyoukin_kakaku"];?>" size="6" />
      万円 </span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="hosyoukin_kikan" id="hosyoukin_kikan" value="<?php echo $re1data["hosyoukin_kikan"];?>">
                            <input type="hidden" name="hosyoukin_kakaku" id="hosyoukin_kakaku" value="<?php echo $re1data["hosyoukin_kakaku"];?>">
                            <?php 
										}
					if($bsetdata["zappi_admin"]==1) {
					?>
                            <tr>
                              <td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["zappi_name"] ?>
                                    <!--その他利用料 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="zappi" type="text" id="zappi" class="noime" value="<?php echo $re1data["zappi"];?>">
                                <span class="realestate_bgcolor3">円</span></td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="zappi" id="zappi" value="<?php echo $re1data["zappi"];?>">
                            <?php 
					}
					if($bsetdata["chusyajou_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["chusyajou_name"] ?>
                                    <!--駐車場 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="chusyajou" type="text" id="chusyajou" value="<?php echo $re1data["chusyajou"];?>" />
                                <input name="chusya_ryoukin" type="text" class="noime" id="chusya_ryoukin" value="<?php echo $re1data["chusya_ryoukin"];?>" size="10" />
      円</td>
                            </tr>
                            <?php 
					}
														if($bsetdata["kenrikin_admin"]==1){
														?>
                            <tr bgcolor="#ffffff">
                              <td bgcolor="#EBEBEB">
                                <div align="right"><?php echo $bsetdata["kenrikin_name"] ?></div>
                              </td>
                              <td>
                                <input name="kenrikin" type="text" id="kenrikin" value="<?php echo $re1data["kenrikin"] ?>">
                                円 </td>
                            </tr>
                            <?php
															}

					if($bsetdata["menseki_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["menseki_name"] ?>
                                    <!--土地面積 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="menseki" type="text" class="noime" id="menseki" value="<?php echo $re1data["menseki"];?>" size="6" />
      m<sup>2</sup> </td>
                            </tr>
                            <?php 
										}
					if($bsetdata["senyumenseki_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["senyumenseki_name"] ?>
                                    <!--面積 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="senyumenseki" type="text" class="noime" id="senyumenseki" value="<?php echo $re1data["senyumenseki"];?>" size="6" />
      m<sup>2</sup> </td>
                            </tr>
                            <?php 
					}
					if($bsetdata["chimoku_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["chimoku_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="chimoku" type="text" id="chimoku" value="<?php echo $re1data["chimoku"];?>" />
                              </td>
                            </tr>
                            <?php 
					}
					if($bsetdata["youtochiiki_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["youtochiiki_name"] ?>
                                    <!--用途地域 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="youtochiiki" type="text" id="youtochiiki" value="<?php echo $re1data["youtochiiki"];?>" />
                              </td>
                            </tr>
                            <?php 
					}
					if($bsetdata["toshikeikaku_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["toshikeikaku_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="toshikeikaku" type="text" id="toshikeikaku" value="<?php echo $re1data["toshikeikaku"];?>" />
&nbsp;</td>
                            </tr>
                            <?php 
					}
					if($bsetdata["tatemono_chintaisyaku_kubun_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["tatemono_chintaisyaku_kubun_name"] ?>
                                    <!--賃貸借区分 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="tatemono_chintaisyaku_kubun" type="text" id="tatemono_chintaisyaku_kubun" value="<?php echo $re1data["tatemono_chintaisyaku_kubun"];?>" />
                              </td>
                            </tr>
                            <?php 
					}
					if($bsetdata["setsudou_admin"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["setsudou_name"] ?>
                                    <!--接道状況 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <table border="0" cellspacing="0" cellpadding="3">
                                  <tr>
                                    <td>状況</td>
                                    <td>
                                      <input name="setsudou_joukyou" type="text" id="setsudou_joukyou" value="<?php echo $re1data["setsudou_joukyou"];?>" />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>接道1</td>
                                    <td>
                                      <input name="setsudou1" type="text" id="setsudou1" value="<?php echo $re1data["setsudou1"];?>" size="50" />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>接道2</td>
                                    <td>
                                      <input name="setsudou2" type="text" id="setsudou2" value="<?php echo $re1data["setsudou2"];?>" size="50" />
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>接道3</td>
                                    <td>
                                      <input name="setsudou3" type="text" id="setsudou3" value="<?php echo $re1data["setsudou3"];?>" size="50" />
                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                            <?php
					}
					if($bsetdata["photo_admin"]==1) {
					?>
                            <tr>
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>１ </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["photo1"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"];?>?<?php echo time();?>" /><br />
                                <input name="delimage1" type="checkbox" id="delimage1" value="1" />
      写真を削除する
      <?php }
																		?>
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="photo1" type="file" id="photo1" />
                              </td>
                            </tr>
                            <tr>
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>２ </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["photo2"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"];?>?<?php echo time();?>" /><br />
                                <input name="delimage2" type="checkbox" id="delimage2" value="1" />
      写真を削除する
      <?php }
																		?>
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="photo2" type="file" id="photo2" />
                              </td>
                            </tr>
                            <tr>
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>３ </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["photo3"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"];?>?<?php echo time();?>" /> <br />
                                <input name="delimage3" type="checkbox" id="delimage3" value="1" />
      写真を削除する
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
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>４</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["photo4"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"];?>?<?php echo time();?>" /><br />
                                <input name="delimage4" type="checkbox" id="delimage4" value="1" />
      写真を削除する
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
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>５ </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["photo5"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"];?>?<?php echo time();?>" /> <br />
                                <input name="delimage5" type="checkbox" id="delimage5" value="1" />
      写真を削除する
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
					if($bsetdata["madorizu_admin"]==1) {
					?>
                            <tr>
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["madorizu_name"] ?>1 </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["madorizu1"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu1"];?>?<?php echo time();?>" /> <br />
                                <input name="delimage6" type="checkbox" id="delimage6" value="1" />
      写真を削除する
      <?php }
																		?>
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="madorizu1" type="file" id="madorizu1" />
                              </td>
                            </tr>
                            <tr>
                              <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["madorizu_name"] ?>2</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php if($re1data["madorizu2"]!=NULL) {?>
                                <img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["madorizu2"];?>?<?php echo time();?>" /><br />
                                <input name="delimage7" type="checkbox" id="delimage7" value="1" />
      写真を削除する
      <?php }
																		?>
                              </td>
                            </tr>
                            <tr>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="madorizu2" type="file" id="madorizu2" />
                              </td>
                            </tr>
                            <?php
					}

					if($bsetdata["genkyou_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["setsudou_name"] ?>
                                    <!--現況 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="genkyou" id="genkyou">
                                  <option<?php if($re1data["genkyou"]=="空家"){echo " selected";}?>>空家</option>
                                  <option<?php if($re1data["genkyou"]=="賃貸中"){echo " selected";}?>>賃貸中</option>
                                  <option<?php if($re1data["genkyou"]==" "||$re1data["genkyou"]==NULL){echo " selected";}?>> </option>
                                </select>
                              </td>
                            </tr>
                            <?php
					}
					if($bsetdata["hikiwatashi_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["hikiwatashi_name"];?>
                                    <!--入居可能日 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="hikiwatashi" id="hikiwatashi">
                                  <option<?php if($re1data["hikiwatashi"]=="即時"){echo " selected";}?>>即時</option>
                                  <option<?php if($re1data["hikiwatashi"]=="相談"){echo " selected";}?>>相談</option>
                                  <option<?php if($re1data["hikiwatashi"]=="期日指定"){echo " selected";}?>>期日指定</option>
                                  <option<?php if($re1data["hikiwatashi"]==" "||$re1data["hikiwatashi"]==""){echo " selected";}?>> </option>
                                </select>
      西暦
      <input name="hikiwatashi_nen" type="text" class="noime" id="hikiwatashi_nen" value="<?php echo $re1data["hikiwatashi_nen"];?>" size="8" />
      年
      <input name="hikiwatashi_tsuki" type="text" class="noime" id="hikiwatashi_tsuki" value="<?php echo $re1data["hikiwatashi_tsuki"];?>" size="4" />
      月
      <select name="hikiwatashi_syun" id="hikiwatashi_syun">
        <option<?php if($re1data["hikiwatashi_syun"]=="即時"){echo " selected";}?>>上旬</option>
        <option<?php if($re1data["hikiwatashi_syun"]=="中旬"){echo " selected";}?>>中旬</option>
        <option<?php if($re1data["hikiwatashi_syun"]=="下旬"){echo " selected";}?>>下旬</option>
        <option<?php if($re1data["hikiwatashi_syun"]==" "||$re1data["hikiwatashi_syun"]==""){echo " selected";}?>> </option>
      </select>
                              </td>
                            </tr>
                            <?php 
					}
					if($bsetdata["setsubi_naka_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["setsubi_naka_name"];?>
                                    <!--室内設備 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="setsubi_naka1" type="checkbox" id="setsubi_naka1" value="1"<?php if($re1data["setsubi_naka1"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka1">給湯</label>
                                <input name="setsubi_naka2" type="checkbox" id="setsubi_naka2" value="1"<?php if($re1data["setsubi_naka2"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka2">冷蔵庫</label>
                                <input name="setsubi_naka3" type="checkbox" id="setsubi_naka3" value="1"<?php if($re1data["setsubi_naka3"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka3">オール電化</label>
                                <input name="setsubi_naka4" type="checkbox" id="setsubi_naka4" value="1"<?php if($re1data["setsubi_naka4"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka4">照明</label>
                                <br />
                                <input name="setsubi_naka5" type="checkbox" id="setsubi_naka5" value="1"<?php if($re1data["setsubi_naka5"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka5">有線放送</label>
                                <input name="setsubi_naka6" type="checkbox" id="setsubi_naka6" value="1"<?php if($re1data["setsubi_naka6"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka6">ケーブルテレビ対応</label>
                                <input name="setsubi_naka7" type="checkbox" id="setsubi_naka7" value="1"<?php if($re1data["setsubi_naka7"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka7">インターネット対応</label>
                                <input name="setsubi_naka8" type="checkbox" id="setsubi_naka8" value="1"<?php if($re1data["setsubi_naka8"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka8">TV</label>
                                <br />
                                <input name="setsubi_naka9" type="checkbox" id="setsubi_naka9" value="1"<?php if($re1data["setsubi_naka9"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka9">居間フローリング</label>
                                <input name="setsubi_naka10" type="checkbox" id="setsubi_naka10" value="1"<?php if($re1data["setsubi_naka10"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka10">システムキッチン</label>
                                <input name="setsubi_naka11" type="checkbox" id="setsubi_naka11" value="1"<?php if($re1data["setsubi_naka11"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka11">室内洗濯機置き場</label>
                                <input name="setsubi_naka12" type="checkbox" id="setsubi_naka12" value="1"<?php if($re1data["setsubi_naka12"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka12">ウォッシュレット</label>
                                <br />
                                <input name="setsubi_naka13" type="checkbox" id="setsubi_naka13" value="1"<?php if($re1data["setsubi_naka13"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka13">バス・トイレ別</label>
                                <input name="setsubi_naka14" type="checkbox" id="setsubi_naka14" value="1"<?php if($re1data["setsubi_naka14"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka14">シャワー</label>
                                <input name="setsubi_naka15" type="checkbox" id="setsubi_naka15" value="1"<?php if($re1data["setsubi_naka15"]==1) {echo " checked"; }?> />
                                <label for="setsubi_naka15">シャンプードレッサー</label>
                                <label for="setsubi_naka16"></label>
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="setsubi_naka1" id="setsubi_naka1" value="<?php echo $re1data["setsubi_naka1"];?>">
                            <input type="hidden" name="setsubi_naka2" id="setsubi_naka2" value="<?php echo $re1data["setsubi_naka2"];?>">
                            <input type="hidden" name="setsubi_naka3" id="setsubi_naka3" value="<?php echo $re1data["setsubi_naka3"];?>">
                            <input type="hidden" name="setsubi_naka4" id="setsubi_naka4" value="<?php echo $re1data["setsubi_naka4"];?>">
                            <input type="hidden" name="setsubi_naka5" id="setsubi_naka5" value="<?php echo $re1data["setsubi_naka5"];?>">
                            <input type="hidden" name="setsubi_naka6" id="setsubi_naka6" value="<?php echo $re1data["setsubi_naka6"];?>">
                            <input type="hidden" name="setsubi_naka7" id="setsubi_naka7" value="<?php echo $re1data["setsubi_naka7"];?>">
                            <input type="hidden" name="setsubi_naka8" id="setsubi_naka8" value="<?php echo $re1data["setsubi_naka8"];?>">
                            <input type="hidden" name="setsubi_naka9" id="setsubi_naka9" value="<?php echo $re1data["setsubi_naka9"];?>">
                            <input type="hidden" name="setsubi_naka10" id="setsubi_naka10" value="<?php echo $re1data["setsubi_naka10"];?>">
                            <input type="hidden" name="setsubi_naka11" id="setsubi_naka11" value="<?php echo $re1data["setsubi_naka11"];?>">
                            <input type="hidden" name="setsubi_naka12" id="setsubi_naka12" value="<?php echo $re1data["setsubi_naka12"];?>">
                            <input type="hidden" name="setsubi_naka13" id="setsubi_naka13" value="<?php echo $re1data["setsubi_naka13"];?>">
                            <input type="hidden" name="setsubi_naka14" id="setsubi_naka14" value="<?php echo $re1data["setsubi_naka14"];?>">
                            <?php 
										}
					if($bsetdata["setsumi_soto_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["setsumi_soto_name"];?>
                                    <!--室外・その他設備 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="setsubi_soto1" type="checkbox" id="setsubi_soto1" value="1"<?php if($re1data["setsubi_soto1"]==1) {echo " checked"; }?> />
                                <label for="setsubi_soto1">駐輪場</label>
                                <input name="setsubi_soto2" type="checkbox" id="setsubi_soto2" value="1"<?php if($re1data["setsubi_soto2"]==1) {echo " checked"; }?> />
                                <label for="setsubi_soto2">駐車場2台以上可</label>
                                <br />
                                <input name="setsubi_soto3" type="checkbox" id="setsubi_soto3" value="1"<?php if($re1data["setsubi_soto3"]==1) {echo " checked"; }?> />
                                <label for="setsubi_soto3">オートロック</label>
                                <input name="setsubi_soto4" type="checkbox" id="setsubi_soto4" value="1"<?php if($re1data["setsubi_soto4"]==1) {echo " checked"; }?> />
                                <label for="setsubi_soto4">エレベータ</label>
                                <input name="setsubi_soto5" type="checkbox" id="setsubi_soto5" value="1"<?php if($re1data["setsubi_soto5"]==1) {echo " checked"; }?> />
                                <label for="setsubi_soto5">宅配ボックス</label>
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="setsubi_soto1" id="setsubi_soto1" value="<?php echo $re1data["setsubi_soto1"];?>">
                            <input type="hidden" name="setsubi_soto2" id="setsubi_soto2" value="<?php echo $re1data["setsubi_soto2"];?>">
                            <input type="hidden" name="setsubi_soto3" id="setsubi_soto3" value="<?php echo $re1data["setsubi_soto3"];?>">
                            <input type="hidden" name="setsubi_soto4" id="setsubi_soto4" value="<?php echo $re1data["setsubi_soto4"];?>">
                            <input type="hidden" name="setsubi_soto5" id="setsubi_soto5" value="<?php echo $re1data["setsubi_soto5"];?>">
                            <?php 
										}
					if($bsetdata["jouken_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right"><?php echo $bsetdata["jouken_name"] ?>
                                    <!--条件 -->
                              </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="jouken1" type="checkbox" id="jouken1" value="1"<?php if($re1data["jouken1"]==1) {echo " checked"; }?> />
                                <label for="jouken1">法人希望・限定</label>
                                <input name="jouken2" type="checkbox" id="jouken2" value="1"<?php if($re1data["jouken2"]==1) {echo " checked"; }?> />
                                <label for="jouken2">女性専用</label>
                                <input name="jouken3" type="checkbox" id="jouken3" value="1"<?php if($re1data["jouken3"]==1) {echo " checked"; }?> />
                                <label for="jouken3">ペット相談可</label>
                                <input name="jouken4" type="checkbox" id="jouken4" value="1"<?php if($re1data["jouken4"]==1) {echo " checked"; }?> />
                                <label for="jouken4">ピアノ相談可</label>
                              </td>
                            </tr>
                            <?php 
					}
					else {
					?>
                            <input type="hidden" name="jouken1" id="jouken1" value="<?php echo $re1data["jouken1"];?>">
                            <input type="hidden" name="jouken2" id="jouken2" value="<?php echo $re1data["jouken2"];?>">
                            <input type="hidden" name="jouken3" id="jouken3" value="<?php echo $re1data["jouken3"];?>">
                            <input type="hidden" name="jouken4" id="jouken4" value="<?php echo $re1data["jouken4"];?>">
                            <?php 
					}
					?>
                            <?php
					if($bukkensetdata["chintai_oneclick"]==1) {
					?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">ワンクリック検索</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="oneclick1" type="checkbox" id="oneclick1" value="1"<?php if($re1data["oneclick1"]==1) {echo " checked"; }?>>
                                <label for="oneclick1"> 新築</label>
                                <input name="oneclick2" type="checkbox" id="oneclick2" value="1"<?php if($re1data["oneclick2"]==1) {echo " checked"; }?>>
                                <label for="oneclick2">築浅</label>
                                <input name="oneclick3" type="checkbox" id="oneclick3" value="1"<?php if($re1data["oneclick3"]==1) {echo " checked"; }?>>
                                <label for="oneclick3">シングル向け</label>
                                <input name="oneclick4" type="checkbox" id="oneclick4" value="1"<?php if($re1data["oneclick4"]==1) {echo " checked"; }?>>
                                <label for="oneclick4">ファミリー向け</label>
                                <input name="oneclick5" type="checkbox" id="oneclick5" value="1"<?php if($re1data["oneclick5"]==1) {echo " checked"; }?>>
                                <label for="oneclick5">ペット相談可</label>
                                <input name="oneclick6" type="checkbox" id="oneclick6" value="1"<?php if($re1data["oneclick6"]==1) {echo " checked"; }?>>
                                <label for="oneclick6">楽器相談可</label>
                              </td>
                            </tr>
                            <?php
					}
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">お勧め</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="osusume" type="checkbox" id="osusume" value="1"<?php if($re1data["osusume"]==1) {echo " checked"; }?> />
                              </td>
                            </tr>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">公開用備考</div></td>
                              <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                <textarea name="bikou" cols="60" rows="6" class="ime-active" id="bikou"><?php echo $re1data["bikou"];?></textarea>
                              </span> </td>
                            </tr>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">非公開用備考</div></td>
                              <td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
                                <textarea name="admin_bikou" cols="60" rows="6" class="ime-active" id="admin_bikou"><?php echo $re1data["admin_bikou"];?></textarea>
                              </span> </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">POPタイトル
                                  <?php 
																				$pop_txt=explode(",",$re1data["pop_txt"]);
																				?>
                                  <br>
※全角30文字以内 </div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                  <tr>
                                    <td>
                                      <input name="pop_txt[0]" type="text" id="pop_txt[0]" value="<?php echo $pop_txt[0];?>" size="60" maxlength="30" />
                                    </td>
                                  </tr>
                              </table></td>
                            </tr>
                            <?php 
					if($bsetdata["torihikitaiyou_admin"]==1) {
					?>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right" class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="torihikitaiyou">
                                  <option<?php if($re1data["torihikitaiyou"]=="媒介"){echo " selected";}?>>媒介</option>
                                  <option<?php if($re1data["torihikitaiyou"]=="貸主"){echo " selected";}?>>貸主</option>
                                  <option<?php if($re1data["torihikitaiyou"]=="代理"){echo " selected";}?>>代理</option>
                                  <option<?php if($re1data["torihikitaiyou"]==" "||$re1data["torihikitaiyou"]==""){echo " selected";}?>> </option>
                                </select>
                              </td>
                            </tr>
                            <?php
										}
										?>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">公開・非公開</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <select name="del_chk" id="del_chk">
                                  <option value="0"<?php if($re1data["del_chk"]==0||$re1data["del_chk"]==NULL) {echo " selected";}?>>公開</option>
                                  <option value="1"<?php if($re1data["del_chk"]==1) {echo  " selected";}?>>非公開</option>
                                </select>
                              </td>
                            </tr>
                            <tr>
                              <td valign="top" bgcolor="#EBEBEB" class="font14">
                                <div align="right">お問い合わせ先</div></td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <?php 
							echo $re1data["kaiin_shougou"]."<br />";
							echo $re1data["kaiin_denwa"];
							?>
                              </td>
                            </tr>
                            <tr>
                              <td width="150" valign="top" bgcolor="#EBEBEB" class="font14">&nbsp; </td>
                              <td bgcolor="#FFFFFF" class="font12">
                                <input name="update_re" type="submit" id="update_re" value="更新する" />
                                <span class="realestate_bgcolor3">
                                <input name="update_re" type="submit" id="update_re" value="更新して一覧へ戻る" />
                                <input name="btm" type="button" id="btm" onclick="gotolist()" value="更新せずに一覧へ戻る">
                                </span>
                                <input name="bid" type="hidden" id="bid" value="<?php echo $_REQUEST["bid"];?>" />
</td>
                            </tr>
                          </table>
						</form>
				</TD>
		</TR>
</TABLE>
