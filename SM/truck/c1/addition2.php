<?php
$re1obj=new Ad_RealEstate($dbobj);
$re1obj->type=1;

$bukkensetdata=$dbobj->GetData("select * from bukken_setting");
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");

$maxdata=$dbobj->GetData("select max(id) as maxid from bukken");
$maxid=1+$maxdata["maxid"];

if($_REQUEST["update_re"]=="更新する") {
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
		if($_REQUEST["chisei"]==NULL||$_REQUEST["chisei"]==""){
		$_REQUEST["chisei"]=	$_REQUEST["syumoku"];
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
	else {
	$_REQUEST["kakaku"]=str_replace(",",".",$_REQUEST["kakaku"]);
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
	
	$bname="bukken";
	$setdata["listimg_w"]=800;
	$setdata["listimg_h"]=0;
	$imagesize["big"]["w"]=800;
	$imagesize["big"]["h"]=0;
	$imagesize["top"]["w"]=120;
	$imagesize["top"]["h"]=0;
	$imagesize["normal"]["w"]=550;
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
	
	$imgobj=new Upload();
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
	$_REQUEST["jouken1"]=str_replace(",","",@number_format($_REQUEST["daimeikou"]));
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
	$fary[]="banchichk";
	$dary[]="".$_REQUEST["banchichk"]."";
	$fary[]="syougakkouku";
	$dary[]="'".$_REQUEST["syougakkouku"].$_REQUEST["syougakkou"]."小学校'";
	$fary[]="chuugakouku";
	$dary[]="'".$_REQUEST["chuugakouku"].$_REQUEST["chugakkou"]."中学校'";
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
	$fary[]="zappi2";
	$dary[]="'".$_REQUEST["zappi2"]."'";
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
	$fary[]="setsubi_other1";
	$dary[]="".$_REQUEST["setsubi_other1"]."";
	$fary[]="setsubi_other2";
	$dary[]="".$_REQUEST["setsubi_other2"]."";
	$fary[]="setsubi_other3";
	$dary[]="".$_REQUEST["setsubi_other3"]."";
	$fary[]="setsubi_other4";
	$dary[]="".$_REQUEST["setsubi_other4"]."";
	$fary[]="setsubi_other5";
	$dary[]="".$_REQUEST["setsubi_other5"]."";
	$fary[]="setsubi_other6";
	$dary[]="".$_REQUEST["setsubi_other6"]."";
	$fary[]="setsubi_other7";
	$dary[]="".$_REQUEST["setsubi_other7"]."";
	$fary[]="setsubi_other8";
	$dary[]="".$_REQUEST["setsubi_other8"]."";
	$fary[]="setsubi_other9";
	$dary[]="".$_REQUEST["setsubi_other9"]."";
	$fary[]="setsubi_other10";
	$dary[]="".$_REQUEST["setsubi_other10"]."";
	$fary[]="keyword";
	$dary[]="'".implode(" ",$_POST)."'";
	$fary[]="del_chk";
	$dary[]="".$_REQUEST["del_chk"]."";
	
	
	$dbobj->Query("delete from bukken_photo where bukken_id=".$maxid);
	
	
	if($imagefile1["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile1["filepath"]!=NULL) {
			
				@chmod($imagefile1["filepath"],0777);
				@chmod("k_".$imagefile1["filepath"],0777);
				@chmod("o_".$imagefile1["filepath"],0777);
				@chmod("300".$imagefile1["filepath"],0777);
				@chmod("pop1".$imagefile1["filepath"],0777);
				@chmod("top".$imagefile1["filepath"],0777);
				@chmod("list".$imagefile1["filepath"],0777);
				
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","pop1".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/pop1".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","top".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/pop1".$imagefile1["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","list".$imagefile1["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/list".$imagefile1["name"],"b");
				}
				$fary[]="photo1";
				$dary[]="'300".$imagefile1["name"]."'";
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",1,'300".$imagefile1["name"]."',1)");
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",1,'',1)");
			}


	}	else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",1,'',1)");
			}
	if($imagefile2["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile2["filepath"]!=NULL) {
			
				@chmod($imagefile2["filepath"],0777);
				@chmod("k_".$imagefile2["filepath"],0777);
				@chmod("o_".$imagefile2["filepath"],0777);
				@chmod("300".$imagefile2["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile2["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile2["name"],"b");
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","pop1".$imagefile2["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/pop1".$imagefile2["name"],"b");
				}
				$fary[]="photo2";
				$dary[]="'300".$imagefile2["name"]."'";
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",2,'300".$imagefile2["name"]."',2)");
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",2,'',2)");
			}

	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",2,'',2)");
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
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",3,'300".$imagefile3["name"]."',3)");
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",3,'',3)");
			}


	}	else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",3,'',3)");
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
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",4,'300".$imagefile4["name"]."',4)");
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",4,'',4)");
			}



	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",4,'',4)");
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
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",5,'300".$imagefile5["name"]."',5)");
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",5,'',5)");
			}


	}	else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",5,'',5)");
			}
	
	if($imagefile6["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile6["filepath"]!=NULL) {
			
				@chmod($imagefile6["filepath"],0777);
				@chmod("k_".$imagefile6["filepath"],0777);
				@chmod("o_".$imagefile6["filepath"],0777);
				@chmod("300".$imagefile6["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile6["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile6["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile6["name"],"b");
				}
			$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",6,'300".$imagefile6["name"]."',6)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",6,'',6)");
			}


	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",6,'',6)");
			}

	if($imagefile7["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile7["filepath"]!=NULL) {
			
				@chmod($imagefile7["filepath"],0777);
				@chmod("k_".$imagefile7["filepath"],0777);
				@chmod("o_".$imagefile7["filepath"],0777);
				@chmod("300".$imagefile7["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile7["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile7["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile7["name"],"b");
				}
			$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",7,'300".$imagefile7["name"]."',7)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",7,'',7)");
			}

	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",7,'',7)");
			}

	if($imagefile8["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile8["filepath"]!=NULL) {
			
				@chmod($imagefile8["filepath"],0777);
				@chmod("k_".$imagefile8["filepath"],0777);
				@chmod("o_".$imagefile8["filepath"],0777);
				@chmod("300".$imagefile8["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile8["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile8["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile8["name"],"b");
				}
			$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",8,'300".$imagefile8["name"]."',8)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",8,'',8)");
			}


	}	else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",8,'',8)");
			}


	if($imagefile9["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile9["filepath"]!=NULL) {
			
				@chmod($imagefile9["filepath"],0777);
				@chmod("k_".$imagefile9["filepath"],0777);
				@chmod("o_".$imagefile9["filepath"],0777);
				@chmod("300".$imagefile9["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile9["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile9["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile9["name"],"b");
				}
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",9,'300".$imagefile9["name"]."',9)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",9,'',9)");
			}

	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",9,'',9)");
			}
	
		if($imagefile10["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile10["filepath"]!=NULL) {
			
				@chmod($imagefile10["filepath"],0777);
				@chmod("k_".$imagefile10["filepath"],0777);
				@chmod("o_".$imagefile10["filepath"],0777);
				@chmod("300".$imagefile10["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile10["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile10["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile10["name"],"b");
				}
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",10,'300".$imagefile10["name"]."',10)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",10,'',10)");
			}


	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",10,'',10)");
			}
	
	
			if($imagefile11["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile11["filepath"]!=NULL) {
			
				@chmod($imagefile11["filepath"],0777);
				@chmod("k_".$imagefile11["filepath"],0777);
				@chmod("o_".$imagefile11["filepath"],0777);
				@chmod("300".$imagefile11["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile11["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile11["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile11["name"],"b");
				}
			$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",11,'300".$imagefile11["name"]."',11)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",11,'',11)");
			}


	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",11,'',11)");
			}


		if($imagefile12["filepath"]!=NULL||$data["delimage"]==1){
		
		$ftp=new Cube_FTP();
		$ftp->Connect($_SESSION["DomainData"]["id"],$_SESSION["DomainData"]["pass"]);
		
			if($imagefile12["filepath"]!=NULL) {
			
				@chmod($imagefile12["filepath"],0777);
				@chmod("k_".$imagefile12["filepath"],0777);
				@chmod("o_".$imagefile12["filepath"],0777);
				@chmod("300".$imagefile12["filepath"],0777);
		if($_SERVER['HTTP_HOST']=="siteadmin.itcube.ne.jp"){
				$ftp->MkDir("tmp/",$bname."_data");
				$ftp->MkDir("tmp/".$bname."_data",$maxid);
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/",$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","o_".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/o_".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","k_".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/k_".$imagefile12["name"],"b");
				
				$ftp->UpData("tmp/".$bname."_data/".$maxid."/","300".$imagefile12["name"],$_SERVER['DOCUMENT_ROOT']."/tmp/".$bname."_data/".$maxid."/300".$imagefile12["name"],"b");
				}
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",12,'300".$imagefile12["name"]."',12)");
				
			}
			else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",12,'',12)");
			}


	}else {
				
				$dbobj->Query("insert into bukken_photo(bukken_id,turn,photo,nums) values(".$maxid.",12,'',12)");
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
	
	@system("chmod -Rf 0777 ".$_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$maxid);
	
	//$fary[]="pop_txt";
	//$dary[]="'".implode(",",$_REQUEST["pop_txt"])."'";
	
	$insql="insert into bukken(".
	implode(",",$fary).
	") values (".
	implode(",",$dary).
	")";
	$dbobj->Query($insql);
	//echo $insql;
	?>
	<script language="javascript">
	location.replace("index.php?PID=re_c1");
	</script>
	<?php
}

$re1data=$re1obj->GetReData($_GET["bid"]);
$syougakulist=$dbobj->GetList("select distinct syougakkouku from bukken where syougakkouku <>'' and syougakkouku <>'小学校'");
$chuugakoulist=$dbobj->GetList("select distinct chuugakouku from bukken where chuugakouku <>'' and chuugakouku <>'中学校'");

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
	history.back();
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
<style type="text/css">
<!--
.btmwidth_100 {
	width: 100px;
	font-weight: bold;
	text-transform: uppercase;
	text-align: center;
	height: 40px;
}
.realestate_bgcolor1 form .realestate_bgcolor2 td table tr td table tr .font14 {
	text-align: right;
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
		document.bukken_form.syougakkouku.disabled="disabled";
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

function  gotolist() {
	location.replace("index.php?PID=re_c1");
}

function calprice(frmnum) {
	//alert(frmnum.elements);

/*	switch(frmnum) {
		case "hosyoukin_kakaku":
			document.bukken_form.hosyoukin_kakaku.value=(document.bukken_form.kakaku.value)*(document.bukken_form.hosyoukin_kikan.value);
			break;
		case "reikin_tani":
			document.bukken_form.reikin_tani.value=(document.bukken_form.kakaku.value)*(document.bukken_form.reikin.value);
			break;
	}
	*/
	
}
function pricechange() {
	//calprice('hosyoukin_kakaku');
	//calprice('reikin_tani');
}
</script>
<?php
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
                                  <p><font color="#000000"> 車両登録 </font> <font color="#000000"><?php echo $ctype;?></font></p>
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
  				<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
  						<tr>
  								<th bgcolor="#ECECEC">
  										<div align="left">車両情報</div>
  										</th>
  								</tr>
  						<tr>
  								<td bgcolor="#FFFFFF">
  										<table width="648" border="0" cellpadding="1" cellspacing="1">
  												<?php 
					if($bsetdata["bukken_id_admin"]==1) {
					?>
  												<tr>
  														<td width="150" align="right" valign="top" class="font14">
  																<div align="right">管理番号</div>
  																</td>
  														<td width="491" class="font12">
  																<input name="bukkenn_id" type="text" id="bukkenn_id"  value="<?php echo $_REQUEST["bukkenn_id"];?>">
  																</td>
  														</tr>
  												<?php
					}
					if($bsetdata["syumoku_admin"]==1) {
					?>
  												<tr>
  														<td align="right" valign="top" class="font14">年式</td>
  														<td class="font12"><select name="chiku_nen" id="chiku_nen">
  																<?php
														for($ys=date("Y");$ys>1980;$ys--){
														?>
  																<option value="<?php echo $ys;?>"<?php if($ys==$re1data["chiku_nen"]){ echo " selected";}?>>
  																		<?php 
																
																if($ys==1989){
																		echo "H 元年";
																}
																else if($ys>1988){
																echo "H ".($ys-1988)."年";
																}
																else {
																		echo "S ".($ys-1925)."年";
																}
																?>
  																		</option>
  																<?php
																}
																?>
  																<option value="1979">S 54年以前</option>
  																</select>
  																<input name="chiku_tsuki" type="text" class="noime" id="chiku_tsuki" value="<?php echo $re1data["chiku_tsuki"];?>" size="8" />
  																月 </td>
  														</tr>
  												<tr>
  														<td align="right" valign="top" class="font14">メーカー</td>
  														<td class="font12"><input name="chimoku" type="text" id="chimoku" value="<?php echo $re1data["chimoku"];?>" /></td>
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
  																<option<?php if($re1data["syumoku"]=="セルフクレーン付"){ echo " selected";}?>>セルフクレーン付</option>
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
  														<td class="font12"><input name="kyori" type="text" class="noime" id="kyori" value="<?php echo $re1data["kyori"];?>" size="20" />
  																km</td>
  														</tr>
  												<tr>
  														<td align="right" valign="top" class="font14">積載クラス</td>
  														<td class="font12"><input name="daimeikou" type="text" class="ime-active" id="daimeikou" value="<?php echo $re1data["daimeikou"];?>" size="20" style="ime-mode:disabled;" />
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
  												<tr>
  														<td align="right" valign="top" class="font14">形状</td>
  														<td class="font12"><input name="chisei" type="text"  id="chisei" value="<?php echo $re1data["chisei"];?>" size="60" /></td>
  														</tr>
  												<?php 
					}
					if($bsetdata["bukken_mei_admin"]==1) {
					?>
  												<?php 
					}
					if($bsetdata["bukken_hurigana_admin"]==1) {
					?>
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
  		<TD valign="top"><table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
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
  												</span></td>
  										</tr>
  								<tr>
  										<td width="150" valign="top" bgcolor="#FFFFFF" class="font14"><div align="right">非公開備考</div></td>
  										<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  												<textarea name="admin_bikou" cols="60" rows="6" class="ime-active" id="admin_bikou"><?php echo $re1data["admin_bikou"];?></textarea>
  												</span></td>
  										</tr>
  								<?php 
					if($bsetdata["torihikitaiyou_admin"]==1) {
					?>
  								<?php 
					}
					?>
  								</table></td>
  						</tr>
  				</table></TD>
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
  								<td bgcolor="#FFFFFF"><table width="648" border="0" cellpadding="1" cellspacing="1">
  										<?php
					if($bsetdata["photo_admin"]==1) {
					?>
  										<tr>
  												<td width="150" rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真１ </div></td>
  												<td width="491" bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo1"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo1"];?>" alt="" /><br />
  														<input name="delimage1" type="checkbox" id="delimage1" value="1" />
  														写真を削除する
  														<?php 
												}
												?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><input name="photo1" type="file" id="photo1" /></td>
  												</tr>
  										<tr>
  												<td width="150" rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真２ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo2"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo2"];?>" alt="" /><br />
  														<input name="delimage2" type="checkbox" id="delimage2" value="1" />
  														写真を削除する
  														<?php 
														}
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><input name="photo2" type="file" id="photo2" /></td>
  												</tr>
  										<tr>
  												<td width="150" rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真３ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo3"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo3"];?>" alt="" /> <br />
  														<input name="delimage3" type="checkbox" id="delimage3" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo3" type="file" id="photo3" />
  														</span></td>
  												</tr>
  										<tr>
  												<td width="150" rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真４</div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo4"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo4"];?>" alt="" /><br />
  														<input name="delimage4" type="checkbox" id="delimage4" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><input name="photo4" type="file" id="photo4" /></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真５ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo5"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo5"];?>" alt="" /> <br />
  														<input name="delimage5" type="checkbox" id="delimage5" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo5" type="file" id="photo5" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真６ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo6"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo6"];?>" alt="" /> <br />
  														<input name="delimage6" type="checkbox" id="delimage6" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo6" type="file" id="photo6" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真７ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo7"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo7"];?>" alt="" /> <br />
  														<input name="delimage7" type="checkbox" id="delimage7" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo7" type="file" id="photo7" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真８ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo8"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo8"];?>" alt="" /> <br />
  														<input name="delimage8" type="checkbox" id="delimage8" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo8" type="file" id="photo8" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真９ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo9"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo9"];?>" alt="" /> <br />
  														<input name="delimage9" type="checkbox" id="delimage9" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo9" type="file" id="photo9" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真１０ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo10"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo10"];?>" alt="" /> <br />
  														<input name="delimage10" type="checkbox" id="delimage10" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo10" type="file" id="photo10" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真１１ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo11"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo11"];?>" alt="" /> <br />
  														<input name="delimage11" type="checkbox" id="delimage11" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo11" type="file" id="photo11" />
  														</span></td>
  												</tr>
  										<tr>
  												<td rowspan="2" valign="top" class="font14"><div align="right" class="font14">写真１２ </div></td>
  												<td bgcolor="#FFFFFF" class="font12"><?php if($re1data["photo12"]!=NULL) {?>
  														<img src="<?php echo "/tmp/bukken_data/".$re1data["id"]."/".$re1data["photo12"];?>" alt="" /> <br />
  														<input name="delimage12" type="checkbox" id="delimage12" value="1" />
  														写真を削除する
  														<?php }
																		?></td>
  												</tr>
  										<tr>
  												<td bgcolor="#FFFFFF" class="font12"><span class="realestate_bgcolor3">
  														<input name="photo12" type="file" id="photo12" />
  														</span></td>
  												</tr>
  										<?php 
					}
?>
  										</table></td>
  								</tr>
  						</table>
  				</TD>
  		</TR>
  <TR class="realestate_bgcolor2">
  		<TD valign="top">&nbsp;</TD>
  		</TR>
  <TR class="realestate_bgcolor2"> 
  		<TD valign="top"> 
  				<span class="font12">        </span>
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
  								<td width="150" valign="top" class="font14">&nbsp; </td> 
  								<td bgcolor="#FFFFFF" class="font12"> <input name="update_re" type="submit" id="update_re" value="更新する" />
  										<span class="realestate_bgcolor3"> 
  												
  												<input name="btm" type="button" id="btm" onclick="gotolist()" value="一覧へ戻る" /> 
  												</span> 
  										<input name="bid" type="hidden" id="bid" value="<?php echo $maxid;?>" /> </td> 
		</tr> 
  						</table> 
  				</TD> 
  		</TR> 
</form></TABLE> 
