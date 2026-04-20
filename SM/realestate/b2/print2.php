<?php
define('FPDF_FONTPATH',$_SERVER['DOCUMENT_ROOT'].'/fpdf2/font/');

require($_SERVER['DOCUMENT_ROOT'].'/fpdf2/mbfpdf.php');

$GLOBALS['EUC2SJIS'] = "EUC-JP";
if($_GET["did"]==NULL) {
$_GET["did"]="fudousan_itc";
}
if($_REQUEST["domain"]==NULL) {
$_REQUEST["domain"]="fudousan.itcube.ne.jp";
}
if($_GET["bid"]==NULL) {
$_GET["bid"]=996;
}
$dbhandle=pg_connect("dbname=".$_GET["did"]);
$sql="select * from bukken where id =".$_GET["bid"];

$res=pg_query($dbhandle,$sql);
$resnum=pg_num_rows($res);
$sql2="select * from tenpo_data";
$res2=pg_query($dbhandle,$sql2);
$resnum2=pg_num_rows($res2);

if($resnum2!=0) {
	$tenpodata=pg_fetch_array($res2,0);
}

if($resnum!=NULL){
$data=pg_fetch_array($res,0);

$pdf = new MBFPDF();
$pdf->AddFont('Arial-Black','','ariblk.php');
$pdf->SetAutoPageBreak(0,1);
//set font
$pdf->AddMBFont(GOTHIC ,'SJIS');
$pdf->AddMBFont(PGOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO ,'SJIS');
$pdf->AddMBFont(PMINCHO,'SJIS');
//$pdf->AddFont('DFGothic-UB-WIN-RKSJ-H','','DfGokuButoGthic.php');

//margine 
$pdf->SetMargins(0.5,0.5,0.5);
//create pdf 
$pdf->Open();
// 
$pdf->AddPage("L");

$pdf->SetLineWidth(0.0);
//set square
//1-1 
$pdf->SetDrawColor(0x8E, 0xC3, 0x1F); 
$pdf->SetFillColor(0x8E, 0xC3, 0x1F); 
$pdf->Rect(8,7.0,5.0,32,DF);
//1-2
$pdf->SetDrawColor(0x3F, 0x3B, 0x3A); 
$pdf->SetFillColor(0x3F, 0x3B, 0x3A); 
$pdf->Rect(13,7.0,54,32,DF);
//1-3
$pdf->SetDrawColor(0x00, 0x68, 0xB6); 
$pdf->SetFillColor(0x00, 0x68, 0xB6); 
$pdf->Rect(67,7.0,225,32,DF);
//2-1
$pdf->SetDrawColor(0x4F, 0x4C, 0x4C); 
$pdf->SetFillColor(0x4F, 0x4C, 0x4C); 
$pdf->Rect(8,39,100,14,DF);
//2-2
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(108,39,184,14,DF);

//3-1
$pdf->SetDrawColor(0xEB, 0x61, 0x00); 
$pdf->SetFillColor(0xEB, 0x61, 0x00); 
$pdf->Rect(8,57,37,11,DF);

//3-2
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(48,57,160,11,DF);

//4bg
$pdf->SetDrawColor(0xE2, 0xE2, 0xE2); 
$pdf->SetFillColor(0xE2, 0xE2, 0xE2); 
$pdf->Rect(8,132,200,47,DF);

//4-1
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(10,135,35,7,DF);

//4-2
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(55,135,27,7,DF);

//4-3
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(110,135,27,7,DF);
//4-4
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(158,135,27,7,DF);

//5bg
$pdf->SetDrawColor(0x89, 0x89, 0x89); 
$pdf->SetFillColor(0x89, 0x89, 0x89); 
$pdf->Rect(8,178,285,8,DF);


//$pdf->line(150.5,98,295.5,98);
//$pdf->line(150.5,106,295.5,106);
//$pdf->line(150.5,114,295.5,114);
//$pdf->line(150.5,122,295.5,122);
//$pdf->line(150.5,130,295.5,130);
//$pdf->line(150.5,138,295.5,138);

//set chars

//住所名
$pdf->SetFont(PGOTHIC,'B',20);
$jusyostr=str_replace("　","",str_replace(" ","",$data["jyusyo1"].$data["jyusyo2"]));
if($data["banchichk"]==1) {
	$jusyostr.=str_replace("　","",str_replace(" ","",$data["jyusyo3"]));
}
for($i=0;$pdf->GetStringWidth($jusyostr)>95;$i++) {
	$pdf->SetFont(PGOTHIC,'B',20-$i);
	if($i>40) {
		exit("住所が長いためPDFの作成に失敗しました。");
	}
}

$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetXY(10,41);
$pdf->Write(10,str_replace("　","",str_replace(" ","",$jusyostr)));



$pdf->SetTextColor(0x00, 0x00, 0x00); //前景色

/*if($data["madori_tani"]!="SLDK"){

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
$pdf->SetTextColor(0x3F, 0x3B, 0x3A); //前景色


if($data["kakaku"]<10&&is_integer($data["kakaku"]*10)) {
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(60,98);
	$kakakudata=explode(".",number_format($data["kakaku"],2));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(100,100);
	$pdf->Write(10,".",2);
	$pdf->SetFont('Arial-Black','',145);
	$pdf->Write(10,$kakakudata[1],2);
}
else if($data["kakaku"]<10&&!is_integer($data["kakaku"]*10)) {
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(60,98);
	$kakakudata=explode(".",number_format($data["kakaku"],2));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(100,100);
	$pdf->Write(10,".",2);
	$pdf->SetFont('Arial-Black','',145);
	$pdf->Write(10,$kakakudata[1],2);
}
else if($data["kakaku"]>9999) {
	$pdf->SetFont('Arial-Black','',150);
	$pdf->SetXY(10,98);
	$kakakudata=explode(",",number_format($data["kakaku"],0));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',80);
	$pdf->SetXY(80,100);
	$pdf->Write(10,",",2);	
	$pdf->SetFont('Arial-Black','',125);
	$pdf->Write(10,$kakakudata[1],2);
}
else if($data["kakaku"]>999){
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(15,98);
	$kakakudata=explode(",",number_format($data["kakaku"],0));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(50,100);
	$pdf->Write(10,",",2);	
	$pdf->SetFont('Arial-Black','',170);
	$pdf->Write(10,$kakakudata[1],2);
}
else if($data["kakaku"]>99&&is_integer($data["kakaku"]*10)) {
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(10,98);
	$kakakudata=explode(".",number_format($data["kakaku"],1));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(130,100);
	$pdf->Write(10,".",2);
	$pdf->SetFont('Arial-Black','',145);
	$pdf->Write(10,$kakakudata[1],2);
}
else if($data["kakaku"]>99) {
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(10,98);
	$kakakudata=explode(".",number_format($data["kakaku"],1));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(130,100);
	$pdf->Write(10,".",2);
	$pdf->SetFont('Arial-Black','',145);
	$pdf->Write(10,$kakakudata[1],2);
}
else{
	$pdf->SetFont('Arial-Black','',170);
	$pdf->SetXY(15,98);
	$kakakudata=explode(".",number_format($data["kakaku"],2));
	$pdf->Write(10,$kakakudata[0],2);
	$pdf->SetFont('Arial-Black','',100);
	$pdf->SetXY(100,100);
	$pdf->Write(10,".",2);
	$pdf->SetFont('Arial-Black','',145);
	$pdf->Write(10,$kakakudata[1],2);
}

$pdf->SetTextColor(0x00, 0x00, 0x00); //前景色
$pdf->SetFont(PGOTHIC,'B',40);
$pdf->SetXY(180,110);
$pdf->Write(10,"万円");


//物件名
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'',50);
$pdf->SetXY(75,22);
for($i=0;$pdf->GetStringWidth($data["bukken_mei"])>170;$i++) {
	$pdf->SetFont(PGOTHIC,'',50-$i);
	$pdf->SetXY(75,22-($i/8));
	if($i>40) {
		exit();
	}
}
$pdf->Write(0,$data["bukken_mei"]);

if($data["ensen"]!=NULL) {
	for($i=0;$pdf->GetStringWidth($data["ensen"])>45;$i++) {
		$pdf->SetFont(PGOTHIC,'B',25-$i);
		if($i>25) {
			exit("駅名が長いためPDFの作成に失敗しました。");
		}
	}

	$pdf->SetXY(15,17);
	$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
	$pdf->Write(0,$data["ensen"]);
}


//eki
if($data["eki"]!=NULL) { 
	$eki.=str_replace("駅","",$data["eki"])."駅";
$pdf->SetFont(PGOTHIC,'B',25);
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetXY(248,17);
$pdf->Write(0,$eki);
}
//ekiho
if($data["ekiho"]!=NULL) {
	$ekiho="徒歩 ".$data["ekiho"]." 分";
	$pdf->SetXY(248,30);
	$pdf->Write(0,$ekiho);
}

if($data["ekiho"]!=NULL) {
	//$eki.=" 徒歩 ".$data["ekiho"]." 分";
}

//
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'',25);
$pdf->SetXY(225,46);

for($i=0;$pdf->GetStringWidth($data["syumoku"]."/".$data["menseki"]."m2")>65;$i++) {
	$pdf->SetFont(PGOTHIC,'B',25-$i);
		$pdf->SetXY(225-$i/4,46-$i/4);
	if($i>25) {
		exit("駅名が長いためPDFの作成に失敗しました。");
	}
}
$pdf->write(0,$data["syumoku"]."/".$data["menseki"]."m2"); 

$pdf->SetFont(PGOTHIC,'B',25);
	for($i=0;$pdf->GetStringWidth($data["kouzou"])>30;$i++) {
		$pdf->SetFont(PGOTHIC,'B',25-$i);
		if($i>25) {
			exit("駅名が長いためPDFの作成に失敗しました。");
		}
	}
	
$pdf->write(0," ".$data["kouzou"]); 
//
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'B',18);
$pdf->SetXY(15,58);
$pdf->Cell(20,10,'売　買',0,0,'C'); 
$pdf->Cell(80);
$pop_txt=explode(",",$data["pop_txt"]);

$pdf->Cell(20,10,$pop_txt[0],0,0,'C'); 


//DATA
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'B',18);
$pdf->SetXY(18,138.5);
$pdf->Write(0,"DATA");

//敷金
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'',14);
$pdf->SetXY(58,138.5);
$pdf->Write(0,"土地面積");
$pdf->SetXY(87,138.5);
$pdf->SetTextColor(0x00, 0x00, 0x00); //前景色
$pdf->SetFont(PGOTHIC,'B',14);
if($data["menseki"]!=NULL) {
$pdf->Write(0,str_replace("　"," ",$data["menseki"])."m2");
}


//礼金
$reikin="";
$pdf->SetFont(PGOTHIC,'',14);
$pdf->SetXY(116,138.5);
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->Write(0,"建蔽率");
$pdf->SetFont(PGOTHIC,'B',14);

$pdf->SetTextColor(0x00, 0x00, 0x00); //前景色
$pdf->SetXY(140,138.5);
//占有面積
if($data["kenpei_ritsu"]!=NULL) {
$pdf->Write(0,"".str_replace("　"," ",$data["kenpei_ritsu"])."％",2);
}
//容積率
$pdf->SetFont(PGOTHIC,'',14);
$pdf->SetXY(163,138.5);
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->Write(0,"容積率");
$pdf->SetXY(190,138.5);
$pdf->SetTextColor(0x00, 0x00, 0x00); //前景色
$pdf->SetFont(PGOTHIC,'B',14);
if($data["youseki_ritsu"]!=NULL) { 
	$kyouekihi.=$data["youseki_ritsu"]."％";
}
$pdf->Write(0,$kyouekihi);

$pdf->SetFont(PGOTHIC,'B',12);
$pdf->SetXY(10,147);
//地目
if($data["chimoku"]) {
	$pdf->Cell(40,5,"地目:".str_replace("　"," ",$data["chimoku"]),0,2,'L');
}
//地勢
if($data["chimoku"]) {
	$pdf->Cell(40,5,"地勢:".str_replace("　"," ",$data["chisei"]),0,2,'L');
}
//地目
if($data["toshikeikaku"]) {
	$pdf->Cell(40,5,"都市計画:".str_replace("　"," ",$data["toshikeikaku"]),0,2,'L');
}
//土地面積
if($data["youtochiiki"]) {
	$pdf->Cell(40,5,"用途地域:".str_replace("　"," ",$data["youtochiiki"]),0,2,'L');
}
//駐車場
if($data["chusyajou"]) {
	$pdf->Cell(40,5,"駐車場:".str_replace("　"," ",$data["chusyajou"]),0,2,'L');
}




//設備
$pdf->SetFont(PGOTHIC,'B',12);
$pdf->SetXY(88,147);
$pdf->Write(0,"条件等");
$pdf->SetXY(108,145);
//$pdf->Cell(52)

$pdf->MultiCell(95,5,$data["jouken"],0,2,'L');


//問い合わせ
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //前景色
$pdf->SetFont(PGOTHIC,'',14);
$pdf->SetXY(10,182);
$pdf->Write(0,"お問合せ");

//社名
$pdf->SetTextColor(0x4C, 0x49, 0x48); //前景色
$pdf->SetFont(PGOTHIC,'B',20);
$pdf->SetXY(8,192);
$pdf->Write(0,$tenpodata["name"]);

$pdf->Write(0," TEL ");
$pdf->Write(0,$tenpodata["denwa"]);
$pdf->SetFont(PGOTHIC,'',12);

$pdf->SetXY(8,205);
$pdf->Write(0,$tenpodata["jyusyo"]);

$pdf->Write(0,"　E-mail ");
$pdf->Write(0,$tenpodata["email"]);

$pdf->SetXY(10,188);
$pdf->SetFont(PGOTHIC,'',10);
$pdf->Cell(195);
$pdf->Cell(40,5,$tenpodata["poptext1"],0,2,'L'); 
$pdf->Cell(40,5,$tenpodata["poptext2"],0,2,'L'); 
$pdf->Cell(40,5,$tenpodata["poptext3"],0,2,'L'); 
$pdf->Cell(40,5,$tenpodata["poptext4"],0,2,'L'); 

/*
if($data["senyumenseki"]!=NULL) {
$pdf->SetXY(10,159);
$pdf->Write(0,"専有面積:".str_replace("　"," ",$data["senyumenseki"])."m2");
}
*/


/*
$hikiwatashi="入居/";

if($data["hikiwatashi"]=="期日指定") {
	if($data["hikiwatashi_nen"]!=NULL) {
		$hikiwatashi.=$data["hikiwatashi_nen"]."年";
	} 
	if($data["hikiwatashi_tsuki"]!=NULL) {
		$hikiwatashi.=$data["hikiwatashi_tsuki"]."月";
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
*/
/*
$pdf->SetXY(151,142.5);
$pdf->Write(6,"日当たり良好！入居時壁紙・フローリング新装！");
$pdf->SetXY(151,150.5);
$pdf->Write(6,"駐車場￥1.000/月2台までok！コンビニ2分。");
$pdf->SetXY(151,158.5);
$pdf->Write(6,"交通の便よし。おすすめ物件、早いもの勝ちです！");
$pdf->SetXY(151,166.5);
$pdf->Write(6,"ご相談はお早めに！");
$pdf->SetXY(151,174.5);
$pdf->Write(6,"交通の便よし。おすすめ物件、早いもの勝ちです！");
$pdf->SetXY(151,182.5);
$pdf->Write(6,"交通の便よし。おすすめ物件、早いもの勝ちです！");
*/

//set images
if($data["photo1"]!=NULL) {
	@$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$data["id"]."/".str_replace("300","pop1",$data["photo1"]),210.5,55.5);
}
if($data["photo2"]!=NULL) {
	@$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$data["id"]."/".str_replace("300","pop1",$data["photo2"]),210.5,114);
}

//$pdf->Image("http://fudousan.itcube.ne.jp/asp/img_f/pop.jpg",0,0);
$pdf->Output();
/*
?>
 <meta http-equiv="content-type" content="text/html; charset=euc-jp"/>
<?php
*/
}
?>