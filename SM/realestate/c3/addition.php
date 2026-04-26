<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;
$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =3");
	$maxdata=$dbobj->GetData("select max(id) as maxid from bukken");
	$maxid=1+$maxdata["maxid"];
if($_REQUEST["update_re"]=="更新する") {
	$dbobj->Query("update lastupdate set lastupdate=".time()."");

	if($_REQUEST["menseki"]==NULL||$_REQUEST["menseki"]==""){
		$_REQUEST["menseki"]="null";
	}
	
	if($_REQUEST["tsubosu"]==NULL||$_REQUEST["tsubosu"]==""){
		$_REQUEST["tsubosu"]="null";
	}
	if($_REQUEST["tsubotanka"]==NULL||$_REQUEST["tsubotanka"]==""){
		$_REQUEST["tsubotanka"]="null";
	}
	if($_REQUEST["kakaku"]==NULL||$_REQUEST["kakaku"]==""){
		$_REQUEST["kakaku"]="null";
	}
	if($_REQUEST["madori"]==NULL||$_REQUEST["madori"]==""){
		$_REQUEST["madori"]="null";
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

	$fary[]="id";
	$dary[]=$maxid;
	$fary[]="kaiin_id";
	$dary[]="'".$_SESSION["login_id"]."'";
	$fary[]="bukkenn_id";
	$dary[]="'".$_REQUEST["bukkenn_id"]."'";
	$fary[]="bunrui";
	$dary[]=1;
	$fary[]="tourokubi";
	$dary[]="'".date("Y-m-d")."'";
	$fary[]="syumoku";
	$dary[]="'".$_REQUEST["syumoku"]."'";
	$fary[]="bukken_mei";
	$dary[]="'".$_REQUEST["bukken_mei"]."'";
	$fary[]="bukken_hurigana";
	$dary[]="'".$_REQUEST["bukken_hurigana"]."'";
	$fary[]="heya_bangou";
	$dary[]="'".$_REQUEST["heya_bangou"]."'";
	$fary[]="shinchiku";
	$dary[]="'".$_REQUEST["shinchiku"]."'";
	$fary[]="kouzou";
	$dary[]="'".$_REQUEST["kouzou"]."'";
	$fary[]="tatemono_muki";
	$dary[]="'".$_REQUEST["tatemono_muki"]."'";
	$fary[]="kaisou";
	$dary[]="'".$_REQUEST["kaisou"]."'";
	$fary[]="chijoukaisou";
	$dary[]="'".$_REQUEST["chijoukaisou"]."'";
	$fary[]="chikakaisou";
	$dary[]="'".$_REQUEST["chikakaisou"]."'";
	$fary[]="kosu";
	$dary[]="'".$_REQUEST["kosu"]."'";
	$fary[]="menseki";
	$dary[]="".$_REQUEST["menseki"]."";
	$fary[]="tsubosu";
	$dary[]="".$_REQUEST["tsubosu"]."";
	$fary[]="tsubotanka";
	$dary[]="".$_REQUEST["tsubotanka"]."";
	$fary[]="buntankin";
	$dary[]="".$_REQUEST["buntankin"]."";
	$fary[]="kenpei_ritsu";
	$dary[]="".$_REQUEST["kenpei_ritsu"]."";
	$fary[]="youseki_ritsu";
	$dary[]="".$_REQUEST["youseki_ritsu"]."";
	$fary[]="chiku_nen";
	$dary[]="".$_REQUEST["chiku_nen"]."";
	$fary[]="chiku_tsuki";
	$dary[]="".$_REQUEST["chiku_tsuki"]."";
	$fary[]="chimoku";
	$dary[]="'".$_REQUEST["chimoku"]."'";
	$fary[]="chisei";
	$dary[]="'".$_REQUEST["chisei"]."'";
	$fary[]="youtochiiki";
	$dary[]="'".$_REQUEST["youtochiiki"]."'";
	$fary[]="toshikeikaku";
	$dary[]="'".$_REQUEST["toshikeikaku"]."'";
	$fary[]="saitekiyouto";
	$dary[]="'".$_REQUEST["saitekiyouto"]."'";
	$fary[]="syozaichikodo";
	$dary[]="'".$_REQUEST["syozaichikodo"]."'";
	$fary[]="yubinbangou";
	$dary[]="'".$_REQUEST["yubinbangou"]."'";
	$fary[]="todouhuken";
	$dary[]="'".$_REQUEST["todouhuken"]."'";
	$fary[]="jyusyo1";
	$dary[]="'".$_REQUEST["jyusyo1"]."'";
	$fary[]="jyusyo2";
	$dary[]="'".$_REQUEST["jyusyo2"]."'";
	$fary[]="jyusyo3";
	$dary[]="'".$_REQUEST["jyusyo3"]."'";
	$fary[]="syougakkouku";
	$dary[]="'".$_REQUEST["syougakkouku"]."小学校'";
	$fary[]="chuugakouku";
	$dary[]="'".$_REQUEST["chuugakouku"]."中学校'";
	$fary[]="ensen";
	$dary[]="'".$_REQUEST["ensen"]."'";
	$fary[]="eki";
	$dary[]="'".$_REQUEST["eki"]."'";
	$fary[]="ekiho";
	$dary[]="".$_REQUEST["ekiho"]."";
	$fary[]="basu";
	$dary[]="'".$_REQUEST["basu"]."'";
	$fary[]="basutei";
	$dary[]="'".$_REQUEST["basutei"]."'";
	$fary[]="basu_hun";
	$dary[]="".$_REQUEST["basu_hun"]."";
	$fary[]="basu_ho";
	$dary[]="".$_REQUEST["basu_ho"]."";
	$fary[]="kuruma";
	$dary[]="".$_REQUEST["kuruma"]."";
	$fary[]="kyori";
	$dary[]="".$_REQUEST["kyori"]."";
	$fary[]="michi_houkou";
	$dary[]="'".$_REQUEST["michi_houkou"]."'";
	$fary[]="kakaku";
	$dary[]="".$_REQUEST["kakaku"]."";
	$fary[]="shikikin";
	$dary[]="".$_REQUEST["shikikin"]."";
	$fary[]="sikikintani";
	$dary[]="'".$_REQUEST["sikikintani"]."'";
	$fary[]="shikibiki_kakaku";
	$dary[]="".$_REQUEST["shikibiki_kakaku"]."";
	$fary[]="shikibiki_tsuki";
	$dary[]="".$_REQUEST["shikibiki_tsuki"]."";
	$fary[]="shikibiki_jippi";
	$dary[]="".$_REQUEST["shikibiki_jippi"]."";
	$fary[]="reikin";
	$dary[]="".$_REQUEST["reikin"]."";
	$fary[]="reikin_tani";
	$dary[]="'".$_REQUEST["reikin_tani"]."'";
	$fary[]="kyouekihi_tani";
	$dary[]="'".$_REQUEST["kyouekihi_tani"]."'";
	$fary[]="kyouekihi";
	$dary[]="".$_REQUEST["kyouekihi"]."";
	$fary[]="hosyoukin_kikan";
	$dary[]="'".$_REQUEST["hosyoukin_kikan"]."'";
	$fary[]="hosyoukin_kakaku";
	$dary[]="'".$_REQUEST["hosyoukin_kakaku"]."'";
	$fary[]="hosyoukin_syoukyaku";
	$dary[]="'".$_REQUEST["hosyoukin_syoukyaku"]."'";
	$fary[]="hosyoukin_syoukyaku_per";
	$dary[]="'".$_REQUEST["hosyoukin_syoukyaku_per"]."'";
	$fary[]="kenrikin";
	$dary[]="'".$_REQUEST["kenrikin"]."'";
	$fary[]="kenrikin_tani";
	$dary[]="'".$_REQUEST["kenrikin_tani"]."'";
	$fary[]="syuzenhi_tsumitate";
	$dary[]="'".$_REQUEST["syuzenhi_tsumitate"]."'";
	$fary[]="zappi";
	$dary[]="'".$_REQUEST["zappi"]."'";
	$fary[]="syakuchisyou";
	$dary[]="'".$_REQUEST["syakuchisyou"]."'";
	$fary[]="kanrihi";
	$dary[]="'".$_REQUEST["kanrihi"]."'";
	$fary[]="zousajouto";
	$dary[]="'".$_REQUEST["zousajouto"]."'";
	$fary[]="chusyajou";
	$dary[]="'".$_REQUEST["chusyajou"]."'";
	$fary[]="chusya_ryoukin";
	$dary[]="'".$_REQUEST["chusya_ryoukin"]."'";
	$fary[]="chusya_shikikin_kikan";
	$dary[]="'".$_REQUEST["chusya_shikikin_kikan"]."'";
	$fary[]="chusya_shikikin_kakaku";
	$dary[]="'".$_REQUEST["chusya_shikikin_kakaku"]."'";
	$fary[]="daimeikou";
	$dary[]="'".$_REQUEST["daimeikou"]."'";
	$fary[]="daimeikou_kakaku";
	$dary[]="'".$_REQUEST["daimeikou_kakaku"]."'";
	$fary[]="syoukyakukin_sentaku";
	$dary[]="'".$_REQUEST["syoukyakukin_sentaku"]."'";
	$fary[]="syoukyakukin_kakaku";
	$dary[]="'".$_REQUEST["syoukyakukin_kakaku"]."'";
	$fary[]="madori";
	$dary[]="".$_REQUEST["madori"]."";
	$fary[]="madori_tani";
	$dary[]="'".$_REQUEST["madori_tani"]."'";
	$fary[]="madori_syousai";
	$dary[]="'".$_REQUEST["madori_syousai"]."'";
	$fary[]="senyumenseki";
	$dary[]="'".$_REQUEST["senyumenseki"]."'";
	$fary[]="barukoni_houkou";
	$dary[]="'".$_REQUEST["barukoni_houkou"]."'";
	$fary[]="barukoni_menseki";
	$dary[]="'".$_REQUEST["barukoni_menseki"]."'";
	$fary[]="shidoumenseki";
	$dary[]="'".$_REQUEST["shidoumenseki"]."'";
	$fary[]="setsudou1";
	$dary[]="'".$_REQUEST["setsudou1"]."'";
	$fary[]="setsudou2";
	$dary[]="'".$_REQUEST["setsudou2"]."'";
	$fary[]="setsudou3";
	$dary[]="'".$_REQUEST["setsudou3"]."'";
	$fary[]="setsudou_joukyou";
	$dary[]="'".$_REQUEST["setsudou_joukyou"]."'";
	$fary[]="keisoku_houshiki";
	$dary[]="'".$_REQUEST["keisoku_houshiki"]."'";
	$fary[]="tochi_kenri";
	$dary[]="'".$_REQUEST["tochi_kenri"]."'";
	$fary[]="syakutiken_syurui";
	$dary[]="'".$_REQUEST["syakutiken_syurui"]."'";
	$fary[]="tatemono_chintaisyaku_kubun";
	$dary[]="'".$_REQUEST["tatemono_chintaisyaku_kubun"]."'";
	$fary[]="torihikitaiyou";
	$dary[]="'".$_REQUEST["torihikitaiyou"]."'";
	$fary[]="genkyou";
	$dary[]="'".$_REQUEST["genkyou"]."'";
	$fary[]="hikiwatashi";
	$dary[]="'".$_REQUEST["hikiwatashi"]."'";
	$fary[]="hikiwatashi_nen";
	$dary[]="'".$_REQUEST["hikiwatashi_nen"]."'";
	$fary[]="hikiwatashi_tsuki";
	$dary[]="'".$_REQUEST["hikiwatashi_tsuki"]."'";
	$fary[]="hikiwatashi_syun";
	$dary[]="'".$_REQUEST["hikiwatashi_syun"]."'";
	$fary[]="kokudohou";
	$dary[]="'".$_REQUEST["kokudohou"]."'";
	$fary[]="bikou";
	$dary[]="'".$_REQUEST["bikou"]."'";
	$fary[]="jouken";
	$dary[]="'".$_REQUEST["jouken"]."'";
	$fary[]="kensetsukakunin";
	$dary[]="'".$_REQUEST["kensetsukakunin"]."'";
	$fary[]="tokki1";
	$dary[]="'".$_REQUEST["tokki1"]."'";
	$fary[]="tokki2";
	$dary[]="'".$_REQUEST["tokki2"]."'";
	$fary[]="tokki3";
	$dary[]="'".$_REQUEST["tokki3"]."'";
	$fary[]="tokki4";
	$dary[]="'".$_REQUEST["tokki4"]."'";
	$fary[]="tokki5";
	$dary[]="'".$_REQUEST["tokki5"]."'";
	$fary[]="hokankanyugimu";
	$dary[]="'".$_REQUEST["hokankanyugimu"]."'";
	$fary[]="hokenkikan";
	$dary[]="'".$_REQUEST["hokenkikan"]."'";
	$fary[]="hokenkingaku";
	$dary[]="'".$_REQUEST["hokenkingaku"]."'";
	$fary[]="tesuryou_hutan_kashi";
	$dary[]="'".$_REQUEST["tesuryou_hutan_kashi"]."'";
	$fary[]="tesuryou_hutan_kari";
	$dary[]="'".$_REQUEST["tesuryou_hutan_kari"]."'";
	$fary[]="tesuryou_haibun_moto";
	$dary[]="'".$_REQUEST["tesuryou_haibun_moto"]."'";
	$fary[]="tesuryou_haibun_kyaku";
	$dary[]="'".$_REQUEST["tesuryou_haibun_kyaku"]."'";
	$fary[]="housyu_keitai";
	$dary[]="'".$_REQUEST["housyu_keitai"]."'";
	$fary[]="tesuryou_ritsu";
	$dary[]="'".$_REQUEST["tesuryou_ritsu"]."'";
	$fary[]="tesuryou_kingaku";
	$dary[]="'".$_REQUEST["tesuryou_kingaku"]."'";
	$fary[]="keiyaku_kikan";
	$dary[]="'".$_REQUEST["keiyaku_kikan"]."'";
	$fary[]="admin_bikou";
	$dary[]="'".$_REQUEST["admin_bikou"]."'";
	$fary[]="osusume";
	$dary[]="".$_REQUEST["osusume"]."";
	$fary[]="setsubi_naka1";
	$dary[]="".$_REQUEST["setsubi_naka1"]."";
	$fary[]="setsubi_naka2";
	$dary[]="".$_REQUEST["setsubi_naka2"]."";
	$fary[]="setsubi_naka3";
	$dary[]="".$_REQUEST["setsubi_naka3"]."";
	$fary[]="setsubi_naka4";
	$dary[]="".$_REQUEST["setsubi_naka4"]."";
	$fary[]="setsubi_naka5";
	$dary[]="".$_REQUEST["setsubi_naka5"]."";
	$fary[]="setsubi_naka6";
	$dary[]="".$_REQUEST["setsubi_naka6"]."";
	$fary[]="setsubi_naka7";
	$dary[]="".$_REQUEST["setsubi_naka7"]."";
	$fary[]="setsubi_naka8";
	$dary[]="".$_REQUEST["setsubi_naka8"]."";
	$fary[]="setsubi_naka9";
	$dary[]="".$_REQUEST["setsubi_naka9"]."";
	$fary[]="setsubi_naka10";
	$dary[]="".$_REQUEST["setsubi_naka10"]."";
	$fary[]="setsubi_naka11";
	$dary[]="".$_REQUEST["setsubi_naka11"]."";
	$fary[]="setsubi_naka12";
	$dary[]="".$_REQUEST["setsubi_naka12"]."";
	$fary[]="setsubi_naka13";
	$dary[]="".$_REQUEST["setsubi_naka13"]."";
	$fary[]="setsubi_naka14";
	$dary[]="".$_REQUEST["setsubi_naka14"]."";
	$fary[]="setsubi_naka15";
	$dary[]="".$_REQUEST["setsubi_naka15"]."";
	$fary[]="setsubi_naka16";
	$dary[]="".$_REQUEST["setsubi_naka16"]."";
	$fary[]="setsubi_naka17";
	$dary[]="".$_REQUEST["setsubi_naka17"]."";
	$fary[]="setsubi_naka18";
	$dary[]="".$_REQUEST["setsubi_naka18"]."";
	$fary[]="setsubi_naka19";
	$dary[]="".$_REQUEST["setsubi_naka19"]."";
	$fary[]="setsubi_naka20";
	$dary[]="".$_REQUEST["setsubi_naka20"]."";
	$fary[]="setsubi_soto1";
	$dary[]="".$_REQUEST["setsubi_soto1"]."";
	$fary[]="setsubi_soto2";
	$dary[]="".$_REQUEST["setsubi_soto2"]."";
	$fary[]="setsubi_soto3";
	$dary[]="".$_REQUEST["setsubi_soto3"]."";
	$fary[]="setsubi_soto4";
	$dary[]="".$_REQUEST["setsubi_soto4"]."";
	$fary[]="setsubi_soto5";
	$dary[]="".$_REQUEST["setsubi_soto5"]."";
	$fary[]="setsubi_soto6";
	$dary[]="".$_REQUEST["setsubi_soto6"]."";
	$fary[]="setsubi_soto7";
	$dary[]="".$_REQUEST["setsubi_soto7"]."";
	$fary[]="setsubi_soto8";
	$dary[]="".$_REQUEST["setsubi_soto8"]."";
	$fary[]="setsubi_soto9";
	$dary[]="".$_REQUEST["setsubi_soto9"]."";
	$fary[]="setsubi_soto10";
	$dary[]="".$_REQUEST["setsubi_soto10"]."";
	$fary[]="jouken1";
	$dary[]="".$_REQUEST["jouken1"]."";
	$fary[]="jouken2";
	$dary[]="".$_REQUEST["jouken2"]."";
	$fary[]="jouken3";
	$dary[]="".$_REQUEST["jouken3"]."";
	$fary[]="jouken4";
	$dary[]="".$_REQUEST["jouken4"]."";
	$fary[]="jouken5";
	$dary[]="".$_REQUEST["jouken5"]."";
	$fary[]="jouken6";
	$dary[]="".$_REQUEST["jouken6"]."";
	$fary[]="jouken7";
	$dary[]="".$_REQUEST["jouken7"]."";
	$fary[]="jouken8";
	$dary[]="".$_REQUEST["jouken8"]."";
	$fary[]="jouken9";
	$dary[]="".$_REQUEST["jouken9"]."";
	$fary[]="banchichk";
	$dary[]="'".$_REQUEST["banchichk"]."'";
	$fary[]="del_chk";
	$dary[]="".$_REQUEST["del_chk"]."";
	$fary[]="oneclick1";
	$dary[]="".$_REQUEST["oneclick1"]."";
	$fary[]="oneclick2";
	$dary[]="".$_REQUEST["oneclick2"]."";
	$fary[]="oneclick3";
	$dary[]="".$_REQUEST["oneclick3"]."";
	$fary[]="oneclick4";
	$dary[]="".$_REQUEST["oneclick4"]."";
	$fary[]="oneclick5";
	$dary[]="".$_REQUEST["oneclick5"]."";
	$fary[]="oneclick6";
	$dary[]="".$_REQUEST["oneclick6"]."";
	$fary[]="oneclick7";
	$dary[]="".$_REQUEST["oneclick7"]."";
	$fary[]="oneclick8";
	$dary[]="".$_REQUEST["oneclick8"]."";
	$fary[]="oneclick9";
	$dary[]="".$_REQUEST["oneclick9"]."";
	$fary[]="oneclick10";
	$dary[]="".$_REQUEST["oneclick10"]."";
	
	if($imagefile1["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
				@chmod($imagefile1["filepath"],0777);
				@chmod("k_".$imagefile1["filepath"],0777);
				@chmod("o_".$imagefile1["filepath"],0777);
				@chmod("300".$imagefile1["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","pop1".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/pop1".$imagefile1["name"],"b");
				}
				$fary[]="photo1";
				$dary[]="'300".$imagefile1["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			}

	}
	if($imagefile2["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile2["filepath"]!=NULL) {
			
				@chmod($imagefile2["filepath"],0777);
				@chmod("k_".$imagefile2["filepath"],0777);
				@chmod("o_".$imagefile2["filepath"],0777);
				@chmod("300".$imagefile2["filepath"],0777);
				@chmod("pop1".$imagefile2["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile2["name"],"b");
				}
				$fary[]="photo2";
				$dary[]="'300".$imagefile2["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			
			}

	}
	
	if($imagefile3["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile3["filepath"]!=NULL) {
			
				@chmod($imagefile3["filepath"],0777);
				@chmod("k_".$imagefile3["filepath"],0777);
				@chmod("o_".$imagefile3["filepath"],0777);
				@chmod("300".$imagefile3["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile3["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile3["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile3["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile3["name"],"b");
}
				$fary[]="photo3";
				$dary[]="'300".$imagefile3["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			}

	}
	if($imagefile4["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile4["filepath"]!=NULL) {
			
				@chmod($imagefile4["filepath"],0777);
				@chmod("k_".$imagefile4["filepath"],0777);
				@chmod("o_".$imagefile4["filepath"],0777);
				@chmod("300".$imagefile4["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile4["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile4["name"],"b");

				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile4["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile4["name"],"b");

				}
				$fary[]="photo4";
				$dary[]="'300".$imagefile4["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			}


	}
	if($imagefile5["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile5["filepath"]!=NULL) {
			
				@chmod($imagefile5["filepath"],0777);
				@chmod("k_".$imagefile5["filepath"],0777);
				@chmod("o_".$imagefile5["filepath"],0777);
				@chmod("300".$imagefile5["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile5["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile5["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile5["name"],"b");
				}
				$fary[]="photo5";
				$dary[]="'300".$imagefile5["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			}

	}
	
	if($mimagefile1["filepath"]!=NULL||$data["delimage"]==1){
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($mimagefile1["filepath"]!=NULL) {
			
				@chmod($mimagefile1["filepath"],0777);
				@chmod("k_".$mimagefile1["filepath"],0777);
				@chmod("o_".$mimagefile1["filepath"],0777);
				@chmod("300".$mimagefile1["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$mimagefile1["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$mimagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","pop1".$mimagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/pop1".$mimagefile1["name"],"b");
				}
				$fary[]="madorizu1";
				$dary[]="'300".$mimagefile1["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			}

	}
	
	if($mimagefile2["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($mimagefile2["filepath"]!=NULL) {
			
				@chmod($mimagefile2["filepath"],0777);
				@chmod("k_".$mimagefile2["filepath"],0777);
				@chmod("o_".$mimagefile2["filepath"],0777);
				@chmod("300".$mimagefile2["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$mimagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$mimagefile2["name"],"b");

				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$mimagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$mimagefile2["name"],"b");
					}
				$fary[]="madorizu2";
				$dary[]="'300".$mimagefile2["name"]."'";
				
			}
			else if($setdata["listimg_defalt"]!=NULL){
				if($data["delimage"]==1) {

				}
			}
			else if($data["delimage"]==1) {
			
			}
	}
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/300photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/k_photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_madorizu1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_madorizu2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/o_photo5.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/photo1.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/photo2.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/photo3.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/photo4.jpg",0777);
	@chmod($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid."/photo5.jpg",0777);
	$fary[]="pop_txt";
	$dary[]="'".implode(",",$_REQUEST["pop_txt"])."'";
		$fary[]="keyword";
	$dary[]="'".implode(" ",$_POST)."'";

	$insql="insert into bukken(".
	implode(",",$fary).
	") values (".
	implode(",",$dary).
	")";
	$dbobj->Query($insql);
	?>
<script language="javascript">
	location.replace("index.php?PID=re_c3");
	</script>
<?php
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
                                  <p>賃貸事業用物件登録 </p>
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
    </TR><?php
	if(str_replace("www.","",$_SERVER['HTTP_HOST'])!="nest-h.com"){
		?>
		<TR class="realestate_bgcolor2">
		    <TD valign="top"><div class="helper">賃貸事業用物件に表示する項目を設定するには<a href="?PID=re_c3_set">こちらをクリック</a>してください。
		            <br>
      データの入力されていない項目をお客様用の物件詳細ページで表示しない場合は<a href="?PID=re_osetting">こちらをクリック</a>してください。<br>
      <font color="#FF0000">※この設定は全ての種別で共通になっております。</font></div></TD>
    </TR>
		<TR class="realestate_bgcolor2">
		    <TD valign="top">&nbsp;</TD>
    </TR>
		<?php
	}
	?>
		<TR class="realestate_bgcolor2">
				<TD valign="top">
						<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
						    <table width="100%" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
 <?php 
					if($bsetdata["bukken_id_admin"]==1) {
					?><tr>
										  <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"><div align="right"><?php echo $bsetdata["bukken_id_name"] ?><!--物件番号 --></div>
										  </td>
										  <td bgcolor="#FFFFFF" class="font12"><input name="bukkenn_id" type="text" class="noime" id="bukkenn_id" value="<?php echo $_REQUEST["bukkenn_id"];?>">
										  </td>
								  </tr>
															<?php
					}
					if($bsetdata["syumoku_admin"]==1) {
					?>										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["syumoku_name"] ?><font color="#FF0000">（※必須）</font></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<select name="syumoku" id="syumoku">
																<option<?php if($re1data["syumoku"]=="店舗（一戸建）"){echo " selected";}?>>店舗（一戸建）</option>
																<option<?php if($re1data["syumoku"]=="店舗（建物一部）"){echo " selected";}?>>店舗（建物一部）</option>
																<option<?php if($re1data["syumoku"]=="事務所"){echo " selected";}?>>事務所</option>
																<option<?php if($re1data["syumoku"]=="店舗・事務所"){echo " selected";}?>>店舗・事務所</option>
																<option<?php if($re1data["syumoku"]=="工場"){echo " selected";}?>>工場</option>
																<option<?php if($re1data["syumoku"]=="倉庫"){echo " selected";}?>>倉庫</option>
																<option<?php if($re1data["syumoku"]=="旅館"){echo " selected";}?>>旅館</option>
																<option<?php if($re1data["syumoku"]=="寮"){echo " selected";}?>>寮</option>
																<option<?php if($re1data["syumoku"]=="別荘"){echo " selected";}?>>別荘</option>
																<option<?php if($re1data["syumoku"]=="土地"){echo " selected";}?>>土地</option>
																<option<?php if($re1data["syumoku"]=="駐車場"){echo " selected";}?>>駐車場</option>
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
					?>		<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14"><?php echo $bsetdata["bukken_mei_name"] ?><!--物件名称 --></div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="bukken_mei" type="text" class="ime-active" id="bukken_mei" value="<?php echo $re1data["bukken_mei"];?>" size="50" />
												</td>
										</tr>
											<?php
					}
					if($bsetdata["bukken_hurigana_admin"]==1) {
					?>				<tr>
												<td width="150" height="24" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14"><?php echo $bsetdata["bukken_hurigana_name"] ?><!--物件フリガナ --></div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="bukken_hurigana" type="text" class="ime-active" id="bukken_hurigana" value="<?php echo $re1data["bukken_hurigana"];?>" size="50" />
												</td>
										</tr>
													<?php
					}
					if($bsetdata["jyusyo_admin"]==1) {
					?>		
													<tr>
                                                      <td valign="top" bgcolor="#EBEBEB" class="font14">
                                                        <div align="right" class="font14"><?php echo $bsetdata["jyusyo_name"] ?></div></td>
                                                      <td bgcolor="#FFFFFF" class="font12">
                                                        <input name="yubinbangou" type="text" class="noime" id="yubinbangou" value="<?php echo $re1data["yubinbangou"];?>" size="15" />
                                                        <input type="button" name="Submit2" value="郵便番号から住所を入力" onclick="zipcode()" />
                                                      </td>
							  </tr>
													<tr>
                                                      <td valign="top" bgcolor="#EBEBEB" class="font14">
                                                        <div align="right"><span class="font12">都道府県</span></div></td>
                                                      <td bgcolor="#FFFFFF" class="font12">
                                                        <input name="todouhuken" type="text" class="ime-active" id="todouhuken" value="<?php echo $re1data["todouhuken"];?>" size="10" />
                                                      </td>
							  </tr>
													<tr>
                                                      <td valign="top" bgcolor="#EBEBEB" class="font14">
                                                        <div align="right"><span class="font12">市区郡</span></div></td>
                                                      <td bgcolor="#FFFFFF" class="font12">
                                                        <input name="jyusyo1" type="text" class="ime-active" id="jyusyo1" value="<?php echo $re1data["jyusyo1"];?>" size="8" />
                                                      </td>
							  </tr>
													<tr>
                                                      <td valign="top" bgcolor="#EBEBEB" class="font14">
                                                        <div align="right"><span class="font12">町名</span></div></td>
                                                      <td bgcolor="#FFFFFF" class="font12">
                                                        <input name="jyusyo2" type="text" class="ime-active" id="jyusyo2" value="<?php echo $re1data["jyusyo2"];?>" size="30" />
                                                      </td>
							  </tr>
													<tr>
                                                      <td bgcolor="#EBEBEB" class="font14">
                                                        <div align="right">番地</div></td>
                                                      <td valign="middle" bgcolor="#FFFFFF" class="font12">
                                                        <input name="jyusyo3" type="text" class="ime-active" id="jyusyo3" value="<?php echo $re1data["jyusyo3"];?>" size="30" />
                                                        <label>
                                                        <input name="banchichk" type="checkbox" id="banchichk" value="1" checked="checked" />
    番地を公開</label>
                                                      </td>
							  </tr>
												<?php
					}
						if($bsetdata["kakaku_admin"]==1) {
					?> <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right" class="font14"><?php echo $bsetdata["kakaku_name"] ?></div>
			</td> 
            <td bgcolor="#FFFFFF" class="font12">  
              <input name="kakaku" type="text" class="noime" id="kakaku" value="<?php echo $re1data["kakaku"];?>" size="15" /> 
              万円 </td> 
          </tr> 
          <?php 
					}
					if($bsetdata["ensen_admin"]==1) {
					?><tr> 

												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["ensen_name"] ?></div>            
            </td> 
            <td bgcolor="#FFFFFF" class="font12"> 
            		<input type="text" name="ensen" id="ensen" value="<?php echo $re1data["ensen"];?>" /> 
       		</td> 
          </tr>
          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right">最寄駅</div>            
            </td> 
            <td bgcolor="#FFFFFF" class="font12"> 
            		<input name="eki" type="text" id="eki" value="<?php echo $re1data["eki"];?>" />
駅       		</td> 
          </tr> 
          <tr> 
            <td width="150" height="21" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><span class="font12">徒歩</span></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12">
                <input name="ekiho" type="text" class="noime" id="ekiho" value="<?php echo $re1data["ekiho"];?>" size="6" /> 
              分 </td> 
          </tr> 
          <tr>
              <td valign="top" bgcolor="#EBEBEB" class="font14">
                  <div align="right">距離</div>
              </td>
              <td bgcolor="#FFFFFF" class="font12">
                  <input name="kyori" type="text" class="noime" id="kyori" value="<?php echo $re1data["kyori"];?>" size="10" />
m </td>
          </tr>
          <?php 
					}
					if($bsetdata["basu_admin"]==1) {
					?> 
          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["basu_name"] ?></div>            
            </td> 
            <td bgcolor="#FFFFFF" class="font12">  
              最寄駅から乗車
                  <input name="basu" type="text" class="noime" id="basu" value="<?php echo $re1data["basu"];?>" size="6" />
                  分　 バス停
                  <input name="basutei" type="text" class="ime-active" id="basutei" value="<?php echo $re1data["basutei"];?>" /> 
              から徒歩
              <input name="basu_ho" type="text" class="noime" id="basu_ho" value="<?php echo $re1data["basu_ho"];?>" size="6" /> 
              分 </td> 
          </tr> 
          <?php 
					}
					if($bsetdata["kuruma_admin"]==1) {
					?><tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["kuruma_name"] ?></div>            
            </td> 
            <td bgcolor="#FFFFFF" class="font12">  
              最寄駅から乗車
                  <input name="kuruma" type="text" class="noime" id="kuruma" value="<?php echo $re1data["kuruma"];?>" size="6" /> 
              分</td> 
          </tr> 
          <?php 
					}
					if($bsetdata["syougakkouku_admin"]==1) {
					?><tr>
          		<td width="150" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
          				<div align="right"><?php echo $bsetdata["syougakkouku_name"] ?></div>       		
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
          				<input name="syougakkouku" type="text" id="syougakkouku" size="12" />小学校</td>
   		  </tr>
           <?php 
					}
					if($bsetdata["chuugakouku_admin"]==1) {
					?><tr>
          		<td width="150" rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
          				<div align="right"><?php echo $bsetdata["chuugakouku_name"] ?></div>       		
          		</td>
          		<td bgcolor="#FFFFFF" class="font12">
          				<select name="chugakkou" id="chugakkou" onchange="chchugaku()">
											<option value="">　</option>
											<?php
											for($i=0;$chuugakoulist[$i]["chuugakouku"]!=NULL;$i++) {
											?>
											<option value="<?php echo str_replace("中学校","",$chuugakoulist[$i]["chuugakouku"]); ?>"><?php echo str_replace("中学校","",$chuugakoulist[$i]["chuugakouku"]); ?></option>
											<?php
											}
											?>
				  </select>
          		</td>
   		  </tr>
          <tr>
          		<td bgcolor="#FFFFFF" class="font12"><input name="chuugakouku" type="text" id="chuugakouku" size="12" />中学校</td>
   		  </tr>
       <?php 
					}
					if($bsetdata["kouzou_admin"]==1) {
					?>    
       <?php 
					}
					if($bsetdata["kouzou_admin"]==1) {
					?>    <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right" class="font14"><?php echo $bsetdata["kouzou_name"] ?></div>            
            </td> 
            <td bgcolor="#FFFFFF" class="font12"> 
            		<select name="kouzou" id="kouzou"> 
            				<option<?php if($re1data["kouzou"]=="ＲＣ"){echo " selected";}?>>ＲＣ</option> 
            				<option<?php if($re1data["kouzou"]=="ＳＲＣ"){echo " selected";}?>>ＳＲＣ</option> 
            				<option<?php if($re1data["kouzou"]=="ブロック造"){echo " selected";}?>>ブロック造</option> 
            				<option<?php if($re1data["kouzou"]=="鉄骨造"){echo " selected";}?>>鉄骨造</option> 
					<option<?php if($re1data["kouzou"]=="軽量鉄骨造"){echo " selected";}?>>軽量鉄骨造</option> 
           				<option<?php if($re1data["kouzou"]=="木造"){echo " selected";}?>>木造</option> 
            				<option<?php if($re1data["kouzou"]==""){echo " selected";}?>></option> 
			  </select>
			</td> 
          </tr> 
       <?php 
					}
					if($bsetdata["kaisou_admin"]==1) {
					?>           <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       					<div align="right"><?php echo $bsetdata["kaisou_name"] ?></div>
            </td> 
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
					if($bsetdata["chiku_nen_admin"]==1) {
					?>			<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14"><?php echo $bsetdata["chiku_nen_name"] ?><!--築年月 --></div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span> 
														西暦
														<input name="chiku_nen" type="text" class="noime" id="chiku_nen" value="<?php echo $re1data["chiku_nen"];?>" size="8" />
														年
														<input name="chiku_tsuki" type="text" class="noime" id="chiku_tsuki" value="<?php echo $re1data["chiku_tsuki"];?>" size="8" />
														月 </span> </td>
										</tr>
					<?php
					}
					if($bsetdata["shinchiku_admin"]==1) {
					?>										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right"><?php echo $bsetdata["shinchiku_name"] ?><!--新築チェック --></div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="shinchiku" type="checkbox" id="shinchiku" value="1" />
												</td>
										</tr>
					<?php
					}
					if($bsetdata["shikikin_admin"]==1) {
					?>					<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14">
										  		<div align="right"><?php echo $bsetdata["shikikin_name"] ?></div>
										  </div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12">  <span class="realestate_bgcolor3">
														<input name="shikikin" type="text" class="noime" id="shikikin" value="<?php echo $re1data["shikikin"];?>" size="6" />
														ヶ月 </span> <span class="realestate_bgcolor3">
																<input name="sikikintani" type="text" class="noime" id="sikikintani" value="<?php echo $re1data["sikikintani"];?>" size="6" />
																万円</span></td>
										</tr>
					<?php 
					}
					if($bsetdata["reikin_admin"]==1) {
					?>					<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14">
										  		<div align="right"><?php echo $bsetdata["reikin_name"] ?></div>
										  </div>										  
												</td>
												<td bgcolor="#FFFFFF" class="font12">  <span class="realestate_bgcolor3">
														<input name="reikin" type="text" class="noime" id="reikin" value="<?php echo $re1data["reikin"];?>" size="6" />
														ヶ月
														<input name="reikin_tani" type="text" class="noime" id="reikin_tani" value="<?php echo $re1data["reikin_tani"];?>" size="6" />
														万円 </span> </td>
										</tr>
<?php 
					}
					if($bsetdata["kanrihi_admin"]==1) {
					?>											
										<tr>
												<td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["kanrihi_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
														<input name="kanrihi" type="text" class="noime" id="kanrihi" value="<?php echo $re1data["kanrihi"];?>" size="20" />
円 </span></td>
										</tr>
<?php 
					}
					if($bsetdata["kyouekihi_admin"]==1) {
					?>											<tr>
												<td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["kyouekihi_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
														<input name="kyouekihi" type="text" class="noime" id="kyouekihi" value="<?php echo $re1data["kyouekihi"];?>" size="20" />
円</span></td>
										</tr>
<?php 
					}
					if($bsetdata["syuzenhi_tsumitate_admin"]==1) {
					?>										<tr>
												<td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["syuzenhi_tsumitate_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="syuzenhi_tsumitate" type="text" class="noime" id="syuzenhi_tsumitate" value="<?php echo $re1data["syuzenhi_tsumitate"];?>">
												<span class="realestate_bgcolor3">円</span>												</td>
										</tr>
<?php 
					}
					if($bsetdata["zappi_admin"]==1) {
					?>										<tr>
												<td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["zappi_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="zappi" type="text" id="zappi" class="noime" value="<?php echo $re1data["zappi"];?>">
														<span class="realestate_bgcolor3">円</span></td>
										</tr>
<?php 
					}
					if($bsetdata["hosyoukin_admin"]==1) {
					?>										<tr>
												<td align="right" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["hosyoukin_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3"> 
														<input name="hosyoukin_kikan" type="text" class="noime" id="hosyoukin_kikan" value="<?php echo $re1data["hosyoukin_kikan"];?>" size="6" />
ヶ月
<input name="hosyoukin_kakaku" type="text" class="noime" id="hosyoukin_kakaku" value="<?php echo $re1data["hosyoukin_kakaku"];?>" size="6" />万円 </span></td>
										</tr>
	<?php 
										}
					if($bsetdata["zappi_admin"]==1) {
					?>
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
       		<div align="right" class="font14"><?php echo $bsetdata["chusyajou_name"] ?></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12">  
              <input name="chusyajou" type="text" id="chusyajou" value="<?php echo $re1data["chusyajou"];?>" /> 
              <input name="chusya_ryoukin" type="text" class="noime" id="chusya_ryoukin" value="<?php echo $re1data["chusya_ryoukin"];?>" size="10" /> 
              円</td> 
          </tr><?php 
					}
																			if($bsetdata["kenrikin_admin"]==1){
														?>
																				<tr bgcolor="#ffffff">
																						<td bgcolor="#ECECFF">
																						    <div align="right"><?php echo $bsetdata["kenrikin_name"] ?></div>
																						</td>
																						<td>
																								<input name="kenrikin" type="text" id="kenrikin" value="<?php echo $re1data["kenrikin"] ?>">円
																						</td>
																				</tr>
															<?php
															}

					if($bsetdata["menseki_admin"]==1) {
					?><tr>
										
												<td valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["menseki_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="menseki" type="text" class="noime" id="menseki" value="<?php echo $re1data["menseki"];?>" size="6" />
														m<sup>2</sup> </td>
										</tr>
<?php 
					}
					if($bsetdata["senyumenseki_admin"]==1) {
					?><tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
										  <div align="right" class="font14"><?php echo $bsetdata["senyumenseki_name"] ?></div>										  </td>
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
														<div align="right"><?php echo $bsetdata["chimoku_name"] ?></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="chimoku" type="text" id="chimoku" value="<?php echo $re1data["chimoku"];?>" />
												</td>
										</tr>
<?php 
					}
					if($bsetdata["youtochiiki_admin"]==1) {
					?>										<tr>
												<td valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["youtochiiki_name"] ?><!--用途地域 --></div>
												</td>
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
												<div align="right"><?php echo $bsetdata["toshikeikaku_name"] ?></div>
										</td>
										<td bgcolor="#FFFFFF" class="font12"><input name="toshikeikaku" type="text" id="toshikeikaku" value="<?php echo $re1data["toshikeikaku"];?>" />&nbsp;</td>
								</tr>
							<?php 
					}
					if($bsetdata["tatemono_chintaisyaku_kubun_admin"]==1) {
					?>			<tr>
												<td valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["tatemono_chintaisyaku_kubun_name"] ?><!--賃貸借区分 --></div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="tatemono_chintaisyaku_kubun" type="text" id="tatemono_chintaisyaku_kubun" value="<?php echo $re1data["tatemono_chintaisyaku_kubun"];?>" />
												</td>
										</tr>
						<?php 
					}
					if($bsetdata["setsudou_admin"]==1) {
					?>				<tr>
												<td valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right"><?php echo $bsetdata["setsudou_name"] ?><!--接道状況 --></div>
												</td>
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
														</table>
												</td>
										</tr>
						<?php 
					}
					if($bsetdata["photo_admin"]==1) {
					?>											<tr>
						  <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                            <div align="right" class="font14"><?php echo $bsetdata["photo_name"] ?>１ </div></td>
												<td bgcolor="#FFFFFF" class="font12">
														<?php if($re1data["photo1"]!=NULL) {?>
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["photo1"];?>" />
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
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["photo2"];?>" />
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
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["photo3"];?>" />
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
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["photo4"];?>" />
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
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["photo5"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
														<input name="photo5" type="file" id="photo5" />
														</span> </td>
										</tr><?php
					}
					if($bsetdata["madorizu_admin"]==1) {
					?>
										<tr>
										  <td rowspan="2" valign="top" bgcolor="#EBEBEB" class="font14">
                                            <div align="right" class="font14"><?php echo $bsetdata["madorizu_name"] ?>1 </div></td>
												<td bgcolor="#FFFFFF" class="font12">
														<?php if($re1data["madorizu1"]!=NULL) {?>
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["madorizu1"];?>" />
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
														<img src="http://<?php echo $_SESSION["DomainData"]["domain_name"].$re1data["madorizu2"];?>" />
														<?php }
																		?>
												</td>
										</tr>
										<tr>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="madorizu2" type="file" id="madorizu2" />
												</td>
										</tr><?php
					}
					if($bsetdata["genkyou_admin"]==1) {
					?>          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right" class="font14"><?php echo $bsetdata["genkyou_name"] ?></div>            </td> 
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
					?>          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["hikiwatashi_name"] ?></div>            </td> 
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
					?>           <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["setsubi_naka_name"] ?></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12"> <input name="setsubi_naka1" type="checkbox" id="setsubi_naka1" value="1"<?php if($re1data["setsubi_naka1"]==1) {echo " checked"; }?> /> 
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
              <label for="setsubi_naka16"></label> </td> 
          </tr> 
<?php 
					}
					if($bsetdata["setsumi_soto_admin"]==1) {
					?>           <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["setsumi_soto_name"] ?></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12"> <input name="setsubi_soto1" type="checkbox" id="setsubi_soto1" value="1"<?php if($re1data["setsubi_soto1"]==1) {echo " checked"; }?> /> 
              <label for="setsubi_soto1">駐輪場</label> 
              <input name="setsubi_soto2" type="checkbox" id="setsubi_soto2" value="1"<?php if($re1data["setsubi_soto2"]==1) {echo " checked"; }?> /> 
              <label for="setsubi_soto2">駐車場2台可</label> 
              <br /> 
              <input name="setsubi_soto3" type="checkbox" id="setsubi_soto3" value="1"<?php if($re1data["setsubi_soto3"]==1) {echo " checked"; }?> /> 
              <label for="setsubi_soto3">オートロック</label> 
              <input name="setsubi_soto4" type="checkbox" id="setsubi_soto4" value="1"<?php if($re1data["setsubi_soto4"]==1) {echo " checked"; }?> /> 
              <label for="setsubi_soto4">エレベータ</label> 
              <input name="setsubi_soto5" type="checkbox" id="setsubi_soto5" value="1"<?php if($re1data["setsubi_soto5"]==1) {echo " checked"; }?> /> 
              <label for="setsubi_soto5">宅配ボックス</label> </td> 
          </tr> 
<?php 
					}
					if($bsetdata["jouken_admin"]==1) {
					?>          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right"><?php echo $bsetdata["jouken_name"] ?></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12"> <input name="jouken1" type="checkbox" id="jouken1" value="1"<?php if($re1data["jouken1"]==1) {echo " checked"; }?> /> 
              <label for="jouken1">法人希望・限定</label> 
              <input name="jouken2" type="checkbox" id="jouken2" value="1"<?php if($re1data["jouken2"]==1) {echo " checked"; }?> /> 
              <label for="jouken2">女性専用</label> 
              <input name="jouken3" type="checkbox" id="jouken3" value="1"<?php if($re1data["jouken3"]==1) {echo " checked"; }?> /> 
              <label for="jouken3">ペット相談可</label> 
              <input name="jouken4" type="checkbox" id="jouken4" value="1"<?php if($re1data["jouken4"]==1) {echo " checked"; }?> /> 
              <label for="jouken4">ピアノ相談可</label> </td> 
          </tr>
<?php 
					}
					?>					<?php
					if($bukkensetdata["chintai_oneclick"]==1) {
					?>
          <tr>
          		<td valign="top" bgcolor="#EBEBEB" class="font14">
          				<div align="right">ワンクリック検索</div>
          		</td>
          		<td bgcolor="#FFFFFF" class="font12">
          				<input name="oneclick1" type="checkbox" id="oneclick1" value="1"><label for="oneclick1">
          				新築</label>
          				<input name="oneclick2" type="checkbox" id="oneclick2" value="1">
          				<label for="oneclick2">築浅</label>
          				<input name="oneclick3" type="checkbox" id="oneclick3" value="1">
          				<label for="oneclick3">シングル向け</label>
          				<input name="oneclick4" type="checkbox" id="oneclick4" value="1">
          				<label for="oneclick4">ファミリー向け</label>
          				<input name="oneclick5" type="checkbox" id="oneclick5" value="1">
          				<label for="oneclick5">ペット相談可</label>
          				<input name="oneclick6" type="checkbox" id="oneclick6" value="1">
          				<label for="oneclick6">楽器相談可</label></td>
          		</tr>
					<?php
					}
					?>

										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">お勧め</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="osusume" type="checkbox" id="osusume" value="1"<?php if($re1data["osusume"]==1) {echo " checked"; }?> />
												</td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">公開用備考</div>
												</td>
												<td bgcolor="#FFFFFF" class="font12"> <span class="realestate_bgcolor3">
														<textarea name="bikou" cols="60" rows="6" class="ime-active" id="bikou"><?php echo $re1data["bikou"];?></textarea>
														</span> </td>
										</tr>
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">
														<div align="right">非公開用備考</div>
												</td>
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
														※全角30文字以内														</div>
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
            <td width="150" valign="top" bgcolor="#EBEBEB" class="font14"> 
       		<div align="right" class="font14"><?php echo $bsetdata["torihikitaiyou_name"] ?></div>            </td> 
            <td bgcolor="#FFFFFF" class="font12"> 
            		<select name="torihikitaiyou"> 
            				<option<?php if($re1data["torihikitaiyou"]=="媒介"){echo " selected";}?>>媒介</option> 
            				<option<?php if($re1data["torihikitaiyou"]=="貸主"){echo " selected";}?>>貸主</option> 
            				<option<?php if($re1data["torihikitaiyou"]=="代理"){echo " selected";}?>>代理</option> 
            				<option<?php if($re1data["torihikitaiyou"]==" "||$re1data["torihikitaiyou"]==""){echo " selected";}?>> </option> 
			  </select>
			</td> 
          </tr><?php 
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
												<td width="150" valign="top" bgcolor="#EBEBEB" class="font14">&nbsp; </td>
												<td bgcolor="#FFFFFF" class="font12">
														<input name="update_re" type="submit" id="update_re" value="更新する" />
														<input type="reset" name="Submit" value="リセット" />
														<span class="realestate_bgcolor3">
														<input name="btm" type="button" id="btm" onclick="gotolist()" value="一覧へ戻る" />
														</span>
														<input name="bid" type="hidden" id="bid" value="<?php echo $maxid;?>" />
												</td>
										</tr>
								</table>
						</form>
				</TD>
		</TR>
</TABLE>
