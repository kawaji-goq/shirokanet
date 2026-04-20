<?php
define('FPDF_FONTPATH','font/');

require($_SERVER['DOCUMENT_ROOT'].'/fpdf/mbfpdf.php');

$GLOBALS['EUC2SJIS'] = true;

$dbhandle=pg_connect("dbname=".$_GET["did"]);
$sql="select * from bukken where id =".$_GET["bid"];

$res=pg_query($dbhandle,$sql);
$resnum=pg_num_rows($res);

if($resnum!=NULL){
$data=pg_fetch_array($res,0);
$pdf = new MBFPDF();

//set font
$pdf->AddMBFont(GOTHIC ,'SJIS');
$pdf->AddMBFont(PGOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO ,'SJIS');
$pdf->AddMBFont(PMINCHO,'SJIS');
$pdf->AddMBFont(KOZMIN ,'SJIS');
//margine 
$pdf->SetMargins(0.5,0.5,0.5);
//create pdf 
$pdf->Open();
// 
$pdf->AddPage("L");
//set line 
$pdf->SetDrawColor(0xff, 0x00, 0x00); 
$pdf->SetLineWidth(2.0);
$pdf->line(151,24,295,24);
$pdf->SetLineWidth(5.0);
$pdf->line(152.5,74,293.5,74);
$pdf->SetDrawColor(0x00, 0x00, 0x00); 
$pdf->SetLineWidth(0.5);

$pdf->line(150.5,98,295.5,98);
$pdf->line(150.5,106,295.5,106);
$pdf->line(150.5,114,295.5,114);
$pdf->line(150.5,122,295.5,122);
$pdf->line(150.5,130,295.5,130);
$pdf->line(150.5,138,295.5,138);

//set chars
$pdf->SetFont(PGOTHIC,'',40);
$jusyostr=str_replace("¡¡","",str_replace(" ","",$data["jyusyo1"].$data["jyusyo2"]));
if($data["banchichk"]==1) {
	$jusyostr.=str_replace("¡¡","",str_replace(" ","",$data["jyusyo3"]));
}
for($i=0;$pdf->GetStringWidth($jusyostr)>140;$i++) {
	$pdf->SetFont(PGOTHIC,'',40-$i);
	if($i>40) {
		exit("½»½ê¤¬Ä¹¤¤¤¿¤áPDF¤ÎºîÀ®¤Ë¼ºÇÔ¤·¤Þ¤·¤¿¡£");
	}
}
$pdf->SetTextColor(0x00, 0x66, 0x33); //Á°·Ê¿§
$pdf->SetXY(151,10);
$pdf->Write(10,str_replace("¡¡","",str_replace(" ","",$jusyostr)));

$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
/*
if($data["madori_tani"]!="SLDK"){
	$pdf->SetFont(PGOTHIC,'',50);
	$pdf->SetXY(151,58);
	$pdf->Write(10,$data["madori"].str_replace("ROOM","R",$data["madori_tani"]));
}
else {
	$pdf->SetFont(PGOTHIC,'',40);
	$pdf->SetXY(151,59);
	$pdf->Write(10,$data["madori"].str_replace("ROOM","R",$data["madori_tani"]));
	
}
*/
$pdf->SetTextColor(0xff, 0x00, 0x00); //Á°·Ê¿§

if($data["kakaku"]<10&&($data["kakaku"]*10/1==0)) {
	$pdf->SetFont(PGOTHIC,'',150);
	$pdf->SetXY(151,48);
	$pdf->Write(10,number_format($data["kakaku"],1));
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(240,58);
	$pdf->Write(10,"Ëü±ß");
}
else if($data["kakaku"]>9999) {
	$pdf->SetFont(PGOTHIC,'',110);
	$pdf->SetXY(151,50);
	$pdf->Write(10,number_format($data["kakaku"]));
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(260,58);
	$pdf->Write(10,"Ëü±ß");
}
else if($data["kakaku"]>999) {
	$pdf->SetFont(PGOTHIC,'',140);
	$pdf->SetXY(151,48);
	$pdf->Write(10,number_format($data["kakaku"]));
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(260,58);
	$pdf->Write(10,"Ëü±ß");
}
else if($data["kakaku"]>99) {
	$pdf->SetFont(PGOTHIC,'',150);
	$pdf->SetXY(151,48);
	$pdf->Write(10,number_format($data["kakaku"]));
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(240,58);
	$pdf->Write(10,"Ëü±ß");
}
else if(($data["kakaku"]*10/1!=0)) {
	$pdf->SetFont(PGOTHIC,'',100);
	$pdf->SetXY(200,52);
	$pdf->Write(10,$data["kakaku"],2);
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(260,58);
	$pdf->Write(10,"Ëü±ß");
}
else{
	$pdf->SetFont(PGOTHIC,'',150);
	$pdf->SetXY(195,48);
	$pdf->Write(10,$data["kakaku"]);
	$pdf->SetTextColor(0x66, 0x66, 0x66); //Á°·Ê¿§
	$pdf->SetFont(PGOTHIC,'',45);
	$pdf->SetXY(260,58);
	$pdf->Write(10,"Ëü±ß");
}


$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
$pdf->SetFont(PGOTHIC,'',40);
$pdf->SetXY(151,90);
for($i=0;$pdf->GetStringWidth($data["bukken_mei"])>140;$i++) {
	$pdf->SetFont(PGOTHIC,'',40-$i);
	$pdf->SetXY(151,90+($i/5));
	if($i>40) {
		exit();
	}
}

$pdf->Write(0,$data["bukken_mei"]);

$pdf->SetFont(PGOTHIC,'',18);
$pdf->SetXY(151,102.5);
$pdf->Write(0,"¼ïÌÜ");
$pdf->SetXY(175,102.5);
$pdf->Write(0,$data["syumoku"]);

$pdf->SetFont(PGOTHIC,'',18);
$pdf->SetXY(151,110.5);
$pdf->Write(0,"¸òÄÌ");
$eki="";

if($data["eki"]!=NULL) { 
	$eki.=$data["eki"]."±Ø";
}

if($data["ensen"]!=NULL) {
	$eki.="[".$data["ensen"]."]";
}

if($data["ekiho"]!=NULL) {
	$eki.=" ÅÌÊâ ".$data["ekiho"]." Ê¬";
}

$pdf->SetXY(175,110.5);
$pdf->Write(0,$eki);

$pdf->SetFont(PGOTHIC,'',18);
$pdf->SetXY(151,118.5);
$pdf->Write(0,"´Ö¼è¤ê");

$pdf->SetXY(175,118.5);
$pdf->Write(0,$data["madori"].str_replace("ROOM","R",$data["madori_tani"]));

$pdf->SetFont(PGOTHIC,'',18);
$pdf->SetXY(151,126.5);
$pdf->Write(0,"ÌÌÀÑ");
if($data["menseki"]!=NULL) {
	$pdf->SetFont(PGOTHIC,'',18);
	$pdf->SetXY(175,126.5);
	$pdf->Write(0,$data["menseki"]."­Ö");
}

$pdf->SetFont(PGOTHIC,'',16);
$pdf->SetXY(205,126.5);
$pdf->Write(0,"·úÊªÌÌÀÑ");

if($data["senyumenseki"]!=NULL) {
	$pdf->SetFont(PGOTHIC,'',16);
	$pdf->SetXY(230,126.5);
	$pdf->Write(0,$data["senyumenseki"]."­Ö");
}

$pdf->SetFont(PGOTHIC,'',18);
$pdf->SetXY(151,134.5);
$pdf->Write(0,"ÃÛÇ¯·î");
$pdf->SetXY(175,134.5);
$chikunengetsu="";

if($data["chiku_nen"]) {
	$chikunengetsu.=$data["chiku_nen"]."Ç¯";
}

if($data["chiku_tsuki"]) {
	$chikunengetsu.=$data["chiku_tsuki"]."·î";
}

$pdf->Write(0,$chikunengetsu);

$hikiwatashi="Æþµï/";

if($data["hikiwatashi"]=="´üÆü»ØÄê") {
	if($data["hikiwatashi_nen"]!=NULL) {
		$hikiwatashi.=$data["hikiwatashi_nen"]."Ç¯";
	} 
	if($data["hikiwatashi_tsuki"]!=NULL) {
		$hikiwatashi.=$data["hikiwatashi_tsuki"]."·î";
	}
	$hikiwatashi.=$data["hikiwatashi_syun"];
}
else {
$hikiwatashi.=$data["hikiwatashi"];
}
$pdf->SetXY(210,134.5);
$pdf->Write(0,$hikiwatashi);

$pdf->SetFont(PGOTHIC,'',15);
$pdf->SetTextColor(0x00, 0x66, 0x33); 

$bikouy[0]=142.5;
$bikouy[1]=150.5;
$bikouy[2]=158.5;
$bikouy[3]=166.5;
$bikouy[4]=174.5;
$bikouy[5]=182.5;
$pop_txt=explode(",",$data["pop_txt"]);

for($i=0;$i<6;$i++) {
	$pdf->SetXY(151,$bikouy[$i]);
	$pdf->Write(6,$pop_txt[$i]);
}

/*
$pdf->SetXY(151,142.5);
$pdf->Write(6,"ÆüÅö¤¿¤êÎÉ¹¥¡ªÆþµï»þÊÉ»æ¡¦¥Õ¥í¡¼¥ê¥ó¥°¿·Áõ¡ª");
$pdf->SetXY(151,150.5);
$pdf->Write(6,"Ãó¼Ö¾ì¡ï1.000/·î2Âæ¤Þ¤Çok¡ª¥³¥ó¥Ó¥Ë2Ê¬¡£");
$pdf->SetXY(151,158.5);
$pdf->Write(6,"¸òÄÌ¤ÎÊØ¤è¤·¡£¤ª¤¹¤¹¤áÊª·ï¡¢Áá¤¤¤â¤Î¾¡¤Á¤Ç¤¹¡ª");
$pdf->SetXY(151,166.5);
$pdf->Write(6,"¤´ÁêÃÌ¤Ï¤ªÁá¤á¤Ë¡ª");
$pdf->SetXY(151,174.5);
$pdf->Write(6,"¸òÄÌ¤ÎÊØ¤è¤·¡£¤ª¤¹¤¹¤áÊª·ï¡¢Áá¤¤¤â¤Î¾¡¤Á¤Ç¤¹¡ª");
$pdf->SetXY(151,182.5);
$pdf->Write(6,"¸òÄÌ¤ÎÊØ¤è¤·¡£¤ª¤¹¤¹¤áÊª·ï¡¢Áá¤¤¤â¤Î¾¡¤Á¤Ç¤¹¡ª");
*/

//set images
if($data["madorizu1"]!=NULL) {
	$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$data["id"]."/".$data["madorizu1"],10,25);
}

if($data["photo1"]!=NULL) {
	$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$data["id"]."/".$data["photo1"],10,110);
}

$pdf->Image("http://fudousan.itcube.ne.jp/asp/img_f/pop.jpg",0,0);
$pdf->Output();
/*
?>
    <meta http-equiv="content-type" content="text/html; charset=euc-jp"/>
<?php
*/
}
?>