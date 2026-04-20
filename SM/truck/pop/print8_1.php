<?php
define('FPDF_FONTPATH',$_SERVER['DOCUMENT_ROOT'].'/fpdf2/font/');
if($_GET["pop_id"]==NULL){
//exit();
}
include "ITC/modules.php";
require($_SERVER['DOCUMENT_ROOT'].'/fpdf2/mbfpdf.php');

$GLOBALS['EUC2SJIS'] = "EUC-JP";
if($_GET["did"]==NULL) {
$_GET["did"]="fudousan_itc";
}
if($_REQUEST["domain"]==NULL) {
$_REQUEST["domain"]="cubes.jp";
}
if($_GET["bid"]==NULL) {
$_GET["bid"]=996;
}

function gettown($text){		
		$text=	mb_convert_kana(str_replace("´ä¹ñ»Ô","",$text),"nr");
		$text=str_replace("1","",$text);
		$text=str_replace("2","",$text);
		$text=str_replace("3","",$text);
		$text=str_replace("4","",$text);
		$text=str_replace("5","",$text);
		$text=str_replace("6","",$text);
		$text=str_replace("7","",$text);
		$text=str_replace("8","",$text);
		$text=str_replace("9","",$text);
		$text=str_replace("0","",$text);
		$text=str_replace("£±","",$text);
		$text=str_replace("£²","",$text);
		$text=str_replace("£³","",$text);
		$text=str_replace("£´","",$text);
		$text=str_replace("£µ","",$text);
		$text=str_replace("£¶","",$text);
		$text=str_replace("£·","",$text);
		$text=str_replace("£¸","",$text);
		$text=str_replace("£¹","",$text);
		$text=str_replace("£°","",$text);		
		$text=str_replace("-","",$text);
		$text=str_replace("¡¼","",$text);
		$text=str_replace("ÃúÌÜ","",$text);
		$text=str_replace("ÈÖÃÏ","",$text);
			if(substr_count($text,"¼şËÉÂçÅçÄ®")>0){
			$text="¼şËÉÂçÅçÄ®";

		}
		if(substr_count($text,"Ä®")>0){
		$machipos=mb_strpos($text,"Ä®");
		$text=mb_substr($text,0,$machipos);
		$text.="Ä®";
		}
		return $text;
}
$usedb="postgresql";
$adminobj=Cube_DB :: UseDB($usedb);
$adminobj->name="itcube_admin";
$adminobj->Connect();

$domaindata=$adminobj->GetData("select * from domain where domain_name ='".$_REQUEST["domain"]."'");

$dbobj=Cube_DB :: UseDB($domaindata["dbtype"]);
$dbobj->name=$domaindata["domain_name"];
$dbobj->Connect();

$pdf = new MBFPDF();
$pdf->AddFont('Arial-Black','','ariblk.php');
$pdf->SetAutoPageBreak(0,1);
//set font
$pdf->AddMBFont(GOTHIC ,'SJIS');
$pdf->AddMBFont(PGOTHIC,'SJIS');
$pdf->AddMBFont(MINCHO ,'SJIS');
$pdf->AddMBFont(PMINCHO,'SJIS');
$pdf->AddMBFont(KOZMIN ,'SJIS');
//$pdf->AddFont('DFGothic-UB-WIN-RKSJ-H','','DfGokuButoGthic.php');

//margine 
$pdf->SetMargins(0.5,0.5,0.5);
//create pdf 
$pdf->Open();


$sql="select * from bukken order by bunrui limit 24";


$sql="select * from popdata inner join popsubdata on popdata.pop_id = popsubdata.pop_id inner join bukken on popsubdata.bukken_id = bukken.id where popdata.pop_id = ".$_GET["pop_id"]." order by popsubdata.turn";
$blist=$dbobj->GetList($sql);
for($i=0;$blist[$i]["id"]!=NULL;$i++) {
	$bukkenlist[floor($i/8)][floor($i%8)]=$blist[$i];
}
$tenpodata=$dbobj->GetData("select * from tenpo_data");

	// 
//for($x=0;$x<1;$x++) {
for($x=0;$bukkenlist[$x][0]!=NULL;$x++) {
	$pdf->AddPage("P");
	$pdf->SetLineWidth(0.0);
	
	$pdf->SetXY(9.3,0);
	$pdf->SetFont(PGOTHIC,'B',25);
	$pdf->SetFont(PGOTHIC,'B',15);
	
	$leftbasic=5;
	$topbasic=5;
	$height=65;
	$width=100;
	$num_h=0;
	$num_w=0;
		
for($xy=0;$bukkenlist[$x][$xy]["id"]!=NULL;$xy++) {
		if($bukkenlist[$x][$xy]["id"]!=NULL) {				
	
				//1-1 
				$pdf->SetDrawColor(0xaa, 0xab, 0xab); 
				$pdf->SetFillColor(0xaa, 0xab, 0xab); 
				$pdf->Rect($leftbasic+$width*$num_w,$topbasic+(($height-1)*$num_h),2.5,8,DF);
				
				//1-2
				$pdf->SetDrawColor(0x1D, 0x20, 0x88); 
				$pdf->SetFillColor(0x1D, 0x20, 0x88); 
				$pdf->Rect($leftbasic+2+$width*$num_w,$topbasic+(($height-1)*$num_h),20,8,DF);
				
				//1-3
				$pdf->SetDrawColor(0x00, 0x00, 0x00); 
				$pdf->SetFillColor(0x00, 0x00, 0x00); 
				$pdf->Rect($leftbasic+22+$width*$num_w,$topbasic+(($height-1)*$num_h),75,8,DF);
				
				//2-1
				$pdf->SetDrawColor(0x66, 0x64, 0x64); 
				$pdf->SetFillColor(0x66, 0x64, 0x64); 
				$pdf->Rect($leftbasic+$width*$num_w,$topbasic+9+(($height-1)*$num_h),26,5,DF);
				
				//2-2
				$pdf->SetDrawColor(0xC9, 0xCA, 0xCA); 
				$pdf->SetFillColor(0xC9, 0xCA, 0xCA); 
				$pdf->Rect($leftbasic+25+$width*$num_w,$topbasic+9+(($height-1)*$num_h),46,5,DF);

//3-1
$pdf->SetDrawColor(0xE6, 0x00, 0x12); 
$pdf->SetFillColor(0xE6, 0x00, 0x12); 
$pdf->Rect($leftbasic+$width*$num_w,$topbasic+15+(($height-1)*$num_h),13,5,DF);

//3-2
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect($leftbasic+14+$width*$num_w,$topbasic+15+(($height-1)*$num_h),57,5,DF);

//4bg
$pdf->SetDrawColor(0xE2, 0xE2, 0xE2); 
$pdf->SetFillColor(0xE2, 0xE2, 0xE2); 
$pdf->Rect($leftbasic+$width*$num_w,$topbasic+41+(($height-1)*$num_h),70,23,DF);
		if($bukkenlist[$x][$xy]["bunrui"]==1) {

//4-1
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect($leftbasic+2+$width*$num_w,$topbasic+42+(($height-1)*$num_h),8,4,DF);

//4-2
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect($leftbasic+22+$width*$num_w,$topbasic+42+(($height-1)*$num_h),8,4,DF);

//4-3
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect($leftbasic+41+$width*$num_w,$topbasic+42+(($height-1)*$num_h),12,4,DF);
}
		//Êª·ïÌ¾
		$pdf->SetFont(PGOTHIC,'B',20);
		$pdf->SetXY($leftbasic+27+$width*$num_w,$topbasic+2+(($height-1)*$num_h));
			for($v=0;$pdf->GetStringWidth(($bukkenlist[$x][$xy]["bukken_mei"]))>50;$v++){
				$pdf->SetFont(PGOTHIC,'B',20-($v/2));
			}
		$pdf->Write(5,($bukkenlist[$x][$xy]["bukken_mei"]));

/*
//4-4
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect($leftbasic+75+$width*$num_w,$topbasic+56+(($height-1)*$num_h),12,6,DF);
*/		
		//¥¤¥á¡¼¥¸
		
				//¥¤¥á¡¼¥¸
		if($bukkenlist[$x][$xy]["photo1"]!=NULL) {
					$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$bukkenlist[$x][$xy]["id"]."/".$bukkenlist[$x][$xy]["photo1"],$leftbasic+72+$width*$num_w,$topbasic+10+(($height-1)*$num_h),25);
		}
		
		if($bukkenlist[$x][$xy]["madorizu1"]!=NULL) {
					$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$bukkenlist[$x][$xy]["id"]."/".$bukkenlist[$x][$xy]["madorizu1"],$leftbasic+72+$width*$num_w,$topbasic+37+(($height-1)*$num_h),25);
		}
		else if($bukkenlist[$x][$xy]["photo2"]!=NULL) {
					$pdf->Image("http://".$_REQUEST["domain"]."/tmp/bukken_data/".$bukkenlist[$x][$xy]["id"]."/".$bukkenlist[$x][$xy]["photo2"],$leftbasic+72+$width*$num_w,$topbasic+37+(($height-1)*$num_h),25);
		
		}
		
		$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
		$pdf->SetFont(PGOTHIC,'B',11);
		if($bukkenlist[$x][$xy]["bunrui"]==1) {
			$pdf->SetXY($leftbasic-(0.5)+$width*$num_w,$topbasic+16.5+(($height-1)*$num_h));
			$pdf->Write(2,"ÄÂ¡¡Âß");
		}
		else if($bukkenlist[$x][$xy]["bunrui"]==2) {
			$pdf->SetXY($leftbasic-(0.5)+$width*$num_w,$topbasic+16.5+(($height-1)*$num_h));
			$pdf->Write(2,"Çä¡¡Çã");
		}
		$pdf->SetFont(PGOTHIC,'B',12);
		$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
		
		//½êºßÃÏ
		$pdf->SetFont(PGOTHIC,'B',10);
		$pdf->SetXY($leftbasic+2+$width*$num_w,$topbasic+9+(($height-1)*$num_h));
			
			for($v=0;$pdf->GetStringWidth(gettown($bukkenlist[$x][$xy]["jyusyo1"].$bukkenlist[$x][$xy]["jyusyo2"]))>20;$v++){
				$pdf->SetFont(PGOTHIC,'B',10-($v/2));
				if($v>6) {
					break;
				}
			}
			
		$pdf->Write(5,gettown($bukkenlist[$x][$xy]["jyusyo1"].$bukkenlist[$x][$xy]["jyusyo2"]));
		
		
	if($bukkenlist[$x][$xy]["ekiho"]!=0&&$bukkenlist[$x][$xy]["ekiho"]<=30&&$domaindata["domain_name"]!="tabuse.itcube.ne.jp") {
		//±ØÌ¾
		$pdf->SetFont(PGOTHIC,'B',9);
		$pdf->SetXY($leftbasic+2+$width*$num_w,$topbasic+0.5+(($height-1)*$num_h));
			for($v=0;$pdf->GetStringWidth(str_replace("±Ø±Ø","±Ø",$bukkenlist[$x][$xy]["eki"]."±Ø"))>15;$v++){
				$pdf->SetFont(PGOTHIC,'B',10-($v/2));
			}
		$pdf->Write(4,(str_replace("±Ø±Ø","±Ø",$bukkenlist[$x][$xy]["eki"]."±Ø")));
	
		//ÅÌÊâ
		$pdf->SetFont(PGOTHIC,'B',9);
		$pdf->SetXY($leftbasic+2+$width*$num_w,$topbasic+4+(($height-1)*$num_h));
		
		for($v=0;$pdf->GetStringWidth("ÅÌÊâ".$bukkenlist[$x][$xy]["ekiho"]."Ê¬")>15;$v++){
			$pdf->SetFont(PGOTHIC,'B',10-($v/2));
		}
		
		$pdf->Write(5,("ÅÌÊâ".$bukkenlist[$x][$xy]["ekiho"]."Ê¬"));
		}
		else {
			//±ØÌ¾
			$pdf->SetFont(PGOTHIC,'B',18);
			$pdf->SetXY($leftbasic+2+$width*$num_w,$topbasic+2+(($height-1)*$num_h));
				for($v=0;$pdf->GetStringWidth(str_replace("±Ø±Ø","±Ø",$bukkenlist[$x][$xy]["eki"]."±Ø"))>18;$v++){
					$pdf->SetFont(PGOTHIC,'B',18-($v/2));
				}
			$pdf->Write(4,(str_replace("±Ø±Ø","±Ø",$bukkenlist[$x][$xy]["eki"]."±Ø")));
		}
		
		//syumoku 		
		$pdf->SetFont(PGOTHIC,'B',9);
		$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
		$syumokutxt="";
		$pdf->SetXY($leftbasic+25+$width*$num_w,$topbasic+9+(($height-1)*$num_h));
		$syumokutxt=$bukkenlist[$x][$xy]["syumoku"];
	
		//¹½Â¤
		if(($bukkenlist[$x][$xy]["madori"]==0||$bukkenlist[$x][$xy]["madori"]==NULL)&&$bukkenlist[$x][$xy]["senyumenseki"]!=NULL) {
		$syumokutxt.="/".$bukkenlist[$x][$xy]["senyumenseki"]."Ê¿ÊÆ";
		}
		else if($bukkenlist[$x][$xy]["madori"]==0||$bukkenlist[$x][$xy]["madori"]==NULL) {
		$syumokutxt.="/".$bukkenlist[$x][$xy]["menseki"]."Ê¿ÊÆ";
		}
		else {
			$syumokutxt.="/".$bukkenlist[$x][$xy]["madori"].$bukkenlist[$x][$xy]["madori_tani"];
		}

		//¹½Â¤
			$pdf->SetFont(PGOTHIC,'B',9);
			$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
			$syumokutxt.="/".$bukkenlist[$x][$xy]["kouzou"];
			for($v=0;$pdf->GetStringWidth(($syumokutxt))>40;$v++){
				$pdf->SetFont(PGOTHIC,'B',9-($v/2));
				if($v>6) {
					break;
				}
			}
			$pdf->Write(5,$syumokutxt);
		
		//¹½Â¤
		$pdf->SetTextColor(0xff, 0xff, 0xff); //Á°·Ê¿§
		$pdf->SetXY($leftbasic+12+$width*$num_w,$topbasic+(15.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',10);

		for($v=0;$pdf->GetStringWidth(str_replace("\r","",str_replace("\n","",$bukkenlist[$x][$xy]["pop_txt"])))>55;$v++){
			$pdf->SetFont(PGOTHIC,'B',10-($v/2));
		}

		$pdf->Write(4,"¡¡".str_replace("\r","",str_replace("\n","",$bukkenlist[$x][$xy]["pop_txt"])));
		$pdf->SetFont(PGOTHIC,'B',10);
		
		if($bukkenlist[$x][$xy]["bunrui"]==1) {
	
		//¹½Â¤
		$pdf->SetXY($leftbasic+(-0.7)+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',8);
		$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
		$pdf->Write(5,"¡¡"."Éß¶â");

		//¹½Â¤
		$pdf->SetXY($leftbasic+10+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',8);
		$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
		if($bukkenlist[$x][$xy]["shikikin"]!=NULL) {
		$pdf->Write(5,$bukkenlist[$x][$xy]["shikikin"]."¥ö·î");
		}
		//¹½Â¤
		$pdf->SetXY($leftbasic+19.4+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',8);
		$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
		$pdf->Write(5,"¡¡"."Îé¶â");
		//¹½Â¤
		$pdf->SetXY($leftbasic+30+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',8);
		$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
		if($bukkenlist[$x][$xy]["reikin"]!=NULL) {
		$pdf->Write(5,$bukkenlist[$x][$xy]["reikin"]."¥ö·î");
		}


		//¹½Â¤
		$pdf->SetXY($leftbasic+37.5+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$pdf->SetFont(PGOTHIC,'B',8);
		$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
		$pdf->Write(5,"¡¡"."¶¦±×ÈñÅù");
		$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§

		$pdf->SetXY($leftbasic+54+$width*$num_w,$topbasic+(41.5)+(($height-1)*$num_h));
		$sumcost=0;
		$tmpdata="";
		$tmpdata=$bukkenlist[$x][$xy];
		$sumcost=number_format($tmpdata["kanrihi"]+$tmpdata["kyouekihi"]+$tmpdata["syuzenhi_tsumitate"]+$tmpdata["zappi"]+($tmpdata["hosyoukin_kakaku"]*10000));
		if($sumcost!=0){
			for($v=0;$pdf->GetStringWidth(str_replace("\r","",str_replace("\n","",$sumcost)))>35;$v++){
				$pdf->SetFont(PGOTHIC,'B',13-($v/2));
			}
			$pdf->Write(5,$sumcost."±ß");
			}

}
			//¶â³Û
			$pdf->SetTextColor(0xFF, 0x00, 0x00); //Á°·Ê¿§
		//	$pdf->SetFont(PGOTHIC,'B',50);
			$pdf->SetFont('Arial-Black','',60);
			
			$pdf->SetXY($leftbasic+9+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$data="";
				$kakakudata="";
				$data["kakaku"]=$bukkenlist[$x][$xy]["kakaku"];
				
			if($data["kakaku"]<10&&is_integer($data["kakaku"])) {
				$kakakudata=explode(".",number_format($data["kakaku"],2));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',55);
				$pdf->SetXY($leftbasic+22+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,".",2);
				$pdf->Write(5,$kakakudata[1],2);
			}
			else if($data["kakaku"]<10) {
				$kakakudata=explode(".",number_format($data["kakaku"],2));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',55);
				$pdf->SetXY($leftbasic+22+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,".",2);
				$pdf->Write(5,$kakakudata[1],2);
			}
			else if($data["kakaku"]<100) {
				$kakakudata=explode(".",number_format($data["kakaku"],2));
				$pdf->SetFont('Arial-Black','',50);
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',50);
				$pdf->SetXY($leftbasic+25+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,".",2);
				$pdf->Write(5,$kakakudata[1],2);
			}
			else if($data["kakaku"]>9999) {
			
				$pdf->SetFont('Arial-Black','',45);
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$kakakudata=explode(",",number_format($data["kakaku"]));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',40);
				$pdf->SetXY($leftbasic+20+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,",",2);
				$pdf->Write(5,$kakakudata[1],2);
				}		
			else if($data["kakaku"]>999&&is_integer($data["kakaku"])) {
				$pdf->SetXY($leftbasic+(-2)+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$kakakudata=explode(",",number_format($data["kakaku"]));
				$pdf->SetFont('Arial-Black','',60);
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',54);
				$pdf->SetXY($leftbasic+15+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,",",2);
				$pdf->Write(5,$kakakudata[1],2);
				}
			else if($data["kakaku"]>999) {
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$kakakudata=explode(",",number_format($data["kakaku"]));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->SetFont('Arial-Black','',51);
				$pdf->SetXY($leftbasic+14+$width*$num_w,$topbasic+31+(($height-1)*$num_h));
				$pdf->Write(5,",",2);
				$pdf->Write(5,$kakakudata[1],2);
			}
			else if($data["kakaku"]>99&&is_integer($data["kakaku"])) {
				$pdf->SetXY($leftbasic+5+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$pdf->SetFont('Arial-Black','',50);
				$kakakudata=explode(".",number_format($data["kakaku"]));
				$pdf->Write(5,$kakakudata[0],2);
				}
			else if($data["kakaku"]>99) {
				$pdf->SetXY($leftbasic+12+$width*$num_w,$topbasic+30+(($height-1)*$num_h));
				$pdf->SetFont('Arial-Black','',60);
				$pdf->Write(5,$data["kakaku"],2);	
			}
			else if(!is_integer($data["kakaku"]*10)) {
				$pdf->Write(5,$data["kakaku"],2);
			}
			else{
				$kakakudata=explode(".",number_format($data["kakaku"],2));
				$pdf->Write(5,$kakakudata[0],2);
				$pdf->Write(5,".",2);
				$pdf->Write(5,$kakakudata[1],2);
			}
			//¶â³ÛÃ±°Ì
			$pdf->SetTextColor(0x00, 0x00, 0x00); //Á°·Ê¿§
			$pdf->SetFont(PGOTHIC,'B',20);
			$pdf->SetXY($leftbasic+55+$width*$num_w,$topbasic+33+(($height-1)*$num_h));
			$pdf->Write(5,"Ëü");
			$pdf->Write(5,"±ß");

			$pdf->SetFont(PGOTHIC,'B',6);
				if($bukkenlist[$x][$xy]["bunrui"]==1) {

			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+47+(($height-1)*$num_h));
		if($bukkenlist[$x][$xy]["madori"]==0||$bukkenlist[$x][$xy]["madori"]==NULL) {
		if($bukkenlist[$x][$xy]["bunrui"]==1) {
			}
			else if($bukkenlist[$x][$xy]["bunrui"]==2) {
				$pdf->Write(5,"¢£·úÊÃÎ¨/".$bukkenlist[$x][$xy]["kenpei_ritsu"]."%");
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+51+(($height-1)*$num_h));
				$pdf->Write(5,"¢£ÍÆÀÑÎ¨/".$bukkenlist[$x][$xy]["youseki_ritsu"]."%");
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+55+(($height-1)*$num_h));
				$pdf->Write(5,"¢£ÄÚÃ±²Á/".($bukkenlist[$x][$xy]["tsubo_tanka"]/10000)."Ëü±ß");
			}
		}
		else {
			$spnen[$x][$xy]=explode("-",$bukkenlist[$x][$xy]["chiku_nen"]);
			$chiku="";
			
			if($bukkenlist[$x][$xy]["chiku_nen"]!=NULL) {
				$chiku.=$bukkenlist[$x][$xy]["chiku_nen"]."Ç¯";
			}
			
			if($bukkenlist[$x][$xy]["chiku_tsuki"]!=NULL) {
				$bukkenlist[$x][$xy]["chiku_tsuki"]."·î";
			}
				
			$pdf->Write(4,"¢£ÃÛÇ¯·î/".$chiku);
			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+51+(($height-1)*$num_h));
			$pdf->Write(4,"¢£Ãó¼Ö¾ì/".$bukkenlist[$x][$xy]["chusyajou"]);
			
			for($v=0;$pdf->GetStringWidth($bukkenlist[$x][$xy]["chusyajou"])>15;$v++){
				$pdf->SetFont(PGOTHIC,'B',7-($v/2));
				if($v>6) {
					break;
				}
			}
			
			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+55+(($height-1)*$num_h));
						if($bukkenlist[$x][$xy]["chusya_ryoukin"]!=NULL) {

			$pdf->Write(4,"¡¡¡¡¡¡¡¡ ".$bukkenlist[$x][$xy]["chusya_ryoukin"]."±ß");
			}
			}
		$pdf->SetXY($leftbasic+25+$width*$num_w,$topbasic+47+(($height-1)*$num_h));
			$pdf->SetFont(PGOTHIC,'B',7);
$setsubi="";
if($tmpdata["setsubi_naka1"]==1){ 
$setsubi[]="µëÅò";
}
if($tmpdata["setsubi_naka2"]==1){ 
$setsubi[]="ÎäÂ¢¸Ë";
}
if($tmpdata["setsubi_naka3"]==1){ 
$setsubi[]="¥ª¡¼¥ëÅÅ²½";
}
if($tmpdata["setsubi_naka4"]==1){ 
$setsubi[]="¾ÈÌÀ";
}
if($tmpdata["setsubi_naka5"]==1){ 
$setsubi[]="Í­Àş";
}
if($tmpdata["setsubi_naka6"]==1){ 
$setsubi[]="¹°ÌŞÙÃÚËŞ";
}
if($tmpdata["setsubi_naka7"]==1){ 
$setsubi[]="²İÀ°È¯ÄÂĞ±ş";
}
if($tmpdata["setsubi_naka8"]==1){ 
$setsubi[]="TV";
}
if($tmpdata["setsubi_naka9"]==1){ 
$setsubi[]="µï´ÖÌÛ°Øİ¸Ş";
}
if($tmpdata["setsubi_naka10"]==1){ 
$setsubi[]="¼½ÃÑ·¯Áİ";
}
if($tmpdata["setsubi_naka11"]==1){ 
$setsubi[]="¼¼ÆâÀöÂõµ¡";
}
if($tmpdata["setsubi_naka12"]==1){ 
$setsubi[]="³«¯¼­Ú¯Ä";
}
if($tmpdata["setsubi_naka13"]==1){ 
$setsubi[]="É÷Ï¤Ä²ÚÊÌ";
}
if($tmpdata["setsubi_naka14"]==1){ 
$setsubi[]="¼¬Ü°";
}
if($tmpdata["setsubi_naka15"]==1){ 
$setsubi[]="¼¬İÌß°ÄŞÚ¯»°";
}
if($tmpdata["setsubi_naka16"]==1){ 
$setsubi[]="´±ºİÉÕ";
}
$setubitxt="";
if($setsubi[0]!=NULL) {
$setubitxt=implode(" ",$setsubi);
	

		for($v=0;$pdf->GetStringWidth($setubitxt)>200;$v++){
			$pdf->SetFont(PGOTHIC,'B',7-$v);
			if($v>5) {
			break;
			}
		}
		
		$pdf->MultiCell(45,4-($v/3),$setubitxt,0,"L",0);
}
}
else {
			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+42+(($height-1)*$num_h));
		if($bukkenlist[$x][$xy]["madori"]==0||$bukkenlist[$x][$xy]["madori"]==NULL) {
		if($bukkenlist[$x][$xy]["bunrui"]==1) {
			}
			else if($bukkenlist[$x][$xy]["bunrui"]==2) {
				$pdf->Write(5,"¢£·úÊÃÎ¨/".$bukkenlist[$x][$xy]["kenpei_ritsu"]."%");
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+46+(($height-1)*$num_h));
				$pdf->Write(5,"¢£ÍÆÀÑÎ¨/".$bukkenlist[$x][$xy]["youseki_ritsu"]."%");
				$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+50+(($height-1)*$num_h));
				$pdf->Write(5,"¢£ÄÚÃ±²Á/".($bukkenlist[$x][$xy]["tsubo_tanka"]/10000)."Ëü±ß");
			}
		}
		else {
			$spnen[$x][$xy]=explode("-",$bukkenlist[$x][$xy]["chiku_nen"]);
			$chiku="";
			
			if($bukkenlist[$x][$xy]["chiku_nen"]!=NULL) {
				$chiku.=$bukkenlist[$x][$xy]["chiku_nen"]."Ç¯";
			}
			
			if($bukkenlist[$x][$xy]["chiku_tsuki"]!=NULL) {
				$bukkenlist[$x][$xy]["chiku_tsuki"]."·î";
			}
				
			$pdf->Write(4,"¢£ÃÛÇ¯·î/".$chiku);
			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+46+(($height-1)*$num_h));
			$pdf->Write(4,"¢£Ãó¼Ö¾ì/".$bukkenlist[$x][$xy]["chusyajou"]);
			
			for($v=0;$pdf->GetStringWidth($bukkenlist[$x][$xy]["chusyajou"])>15;$v++){
				$pdf->SetFont(PGOTHIC,'B',7-($v/2));
				if($v>6) {
					break;
				}
			}
			
			$pdf->SetXY($leftbasic+$width*$num_w,$topbasic+50+(($height-1)*$num_h));
						if($bukkenlist[$x][$xy]["chusya_ryoukin"]!=NULL) {

			$pdf->Write(4,"¡¡¡¡¡¡¡¡ ".$bukkenlist[$x][$xy]["chusya_ryoukin"]."±ß");
			}
			}
		$pdf->SetXY($leftbasic+25+$width*$num_w,$topbasic+42+(($height-1)*$num_h));
			$pdf->SetFont(PGOTHIC,'B',7);
$setsubi="";
/*
if($tmpdata["setsubi_naka1"]==1){ 
$setsubi[]="µëÅò";
}
if($tmpdata["setsubi_naka2"]==1){ 
$setsubi[]="ÎäÂ¢¸Ë";
}
if($tmpdata["setsubi_naka3"]==1){ 
$setsubi[]="¥ª¡¼¥ëÅÅ²½";
}
if($tmpdata["setsubi_naka4"]==1){ 
$setsubi[]="¾ÈÌÀ";
}
if($tmpdata["setsubi_naka5"]==1){ 
$setsubi[]="Í­Àş";
}
if($tmpdata["setsubi_naka6"]==1){ 
$setsubi[]="¥±¡¼¥Ö¥ë¥Æ¥ì¥Ó";
}
if($tmpdata["setsubi_naka7"]==1){ 
$setsubi[]="¥¤¥ó¥¿¡¼¥Í¥Ã¥ÈÂĞ±ş";
}
if($tmpdata["setsubi_naka8"]==1){ 
$setsubi[]="TV";
}
if($tmpdata["setsubi_naka9"]==1){ 
$setsubi[]="µï´Ö¥Õ¥í¡¼¥ê¥ó¥°";
}
if($tmpdata["setsubi_naka10"]==1){ 
$setsubi[]="¥·¥¹¥Æ¥à¥­¥Ã¥Á¥ó";
}
if($tmpdata["setsubi_naka11"]==1){ 
$setsubi[]="¼¼ÆâÀöÂõµ¡";
}
if($tmpdata["setsubi_naka12"]==1){ 
$setsubi[]="¥¦¥©¥Ã¥·¥å¥ì¥Ã¥È";
}
if($tmpdata["setsubi_naka13"]==1){ 
$setsubi[]="É÷Ï¤¥È¥¤¥ìÊÌ";
}
if($tmpdata["setsubi_naka14"]==1){ 
$setsubi[]="¥·¥ã¥ï¡¼";
}
if($tmpdata["setsubi_naka15"]==1){ 
$setsubi[]="¥·¥ã¥ó¥×¡¼¥É¥ì¥Ã¥µ¡¼";
}
if($tmpdata["setsubi_naka16"]==1){ 
$setsubi[]="¥¨¥¢¥³¥óÉÕ¤­";
}
$setubitxt="";
if($setsubi[0]!=NULL) {
$setubitxt=implode("¡¡",$setsubi);
}
	*/

		for($v=0;$pdf->GetStringWidth($bukkenlist[$x][$xy]["bikou"])>200;$v++){
			$pdf->SetFont(PGOTHIC,'B',7-$v);
			if($v>5) {
			break;
			}
		}
		
		$pdf->MultiCell(45,4-($v/3),$bukkenlist[$x][$xy]["bikou"],0,"L",0);
	
}
//ÆâÍÆ¤Ï¤³¤³¤è¤êÁ°¤Ë½ñ¤¯		
		}
		$num_h++;
			if($num_h>3) {
				$num_h=0;
				$num_w++;
		}
	}
		
			/*
				*settext
				*/
//Ìä¤¤¹ç¤ï¤»
$pdf->SetDrawColor(0x8E, 0xC3, 0x1F); 
$pdf->SetFillColor(0x8E, 0xC3, 0x1F); 
$pdf->SetTextColor(0xFF, 0xFF, 0xFF); //Á°·Ê¿§
$pdf->SetFont(PGOTHIC,'',14);
//5bg
$pdf->SetDrawColor(0x66, 0x64, 0x64); 
$pdf->SetFillColor(0x66, 0x64, 0x64); 
$pdf->Rect(0,261,285,7,DF);
$pdf->SetXY(5,265);
$pdf->Write(0,$tenpodata["name"]);
//¼ÒÌ¾
$pdf->SetTextColor(0x4C, 0x49, 0x48); //Á°·Ê¿§
$pdf->SetFont('Arial-Black','',28);
$pdf->SetXY(3,277);

$pdf->Write(0," TEL ");
$pdf->SetFont('Arial-Black','',30);
$pdf->Write(0,$tenpodata["denwa"]);
$pdf->SetFont(PGOTHIC,'',11);
$pdf->SetXY(3,287);
$pdf->Write(0,$tenpodata["jyusyo"]);
$pdf->Write(0,"¡¡URL ");
$pdf->Write(0,$tenpodata["url"]);
$pdf->SetXY(10,270);
$pdf->SetFont(PGOTHIC,'',10);
$pdf->Cell(120);
$pdf->Cell(40,5,"ÌÈµöÈÖ¹æ¡¡".$tenpodata["poptext1"],0,2,'L'); 
$pdf->Cell(40,5,"½êÂ°ÃÄÂÎ¡¡".$tenpodata["poptext2"],0,2,'L'); 
$pdf->Cell(40,5,"¡¡¡¡¡¡¡¡¡¡".$tenpodata["poptext3"],0,2,'L'); 
$pdf->Cell(40,5,"¡¡¡¡¡¡¡¡¡¡".$tenpodata["poptext4"],0,2,'L'); 
}
$bukkenlist="";
$pdf->Output();
/*
?>
 <meta http-equiv="content-type" content="text/html; charset=euc-jp"/>
<?php
*/

?>