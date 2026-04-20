<?php 

class Ary_Viewer{
	var $ary;
	var $type;
	
	function Ary_Viewer($ary) {
		$this->ary=$ary;
	}
	
	function Moji($txt){
		$agent=GetAgent();
		
		if($agent["type"]=="other") {
			if($this->ary["html_chk"]==0) {
				echo nl2br($this->ary[$txt]);
			}
			else {
				echo $this->ary[$txt];
			}
		}
		else {
			if($this->ary[$txt]!=NULL) {
				echo nl2br(mb_convert_kana(strip_tags(mb_convert_encoding($this->ary[$txt],"sjis","eucjp")),"ksa"))."<br />";
			}
		}
	}
	
	function STitle($txt){
		$agent=GetAgent();
		if($agent["type"]=="other") {
			echo nl2br($this->ary[$txt]);
		}
		else {
			if($this->ary[$txt]!=NULL) {
				echo mb_strimwidth(nl2br(mb_convert_kana(strip_tags(mb_convert_encoding($this->ary[$txt],"sjis","eucjp")),"ksa","sjis")),0,20,"...","sjis")."<br />";
			}
		}
	}
	
	function LMoji($txt){
		$agent=GetAgent();
		$this->ary[$txt]=str_replace("\r","",str_replace("\n","",$this->ary[$txt]));
		if($agent["type"]=="other") {
			echo trim(str_replace("\\r","",str_replace("\\n","",$this->ary[$txt])));
		}
		else {
			if($this->ary[$txt]!=NULL) {
				echo trim(str_replace("\\r","",str_replace("\\n","",(mb_convert_kana(strip_tags(mb_convert_encoding($this->ary[$txt],"sjis","eucjp")),"ksa")))));
			}
		}
	}
	function Seisu($txt){
	
		echo number_format($this->ary[$txt]);
		
	}
	function Image($txt){
	
		if($this->ary[$txt]!=NULL){
		
			$agent=GetAgent();
			if($agent["type"]=="other") {
					echo ('<img src="'.$this->ary[$txt].'" border=0>');
			}
			else {
				if(@file_exists("..".$this->ary[$txt])) {
					$fdata=(pathinfo("..".$this->ary[$txt]));
					if($fdata["basename"]!="detailsimg_defalt.gif") {
						if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
							ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",200,200);
						}
						echo "<img src='".$fdata["dirname"]."/k_".$fdata["basename"]."'>";
					}
				}
			}
			
		}
		
	}
	function Image2($txt,$alt){
	
		if($this->ary[$txt]!=NULL){
		
			$agent=GetAgent();
			if($agent["type"]=="other") {
					echo ('<img src="'.$this->ary[$txt].'" border=0 alt="'.$alt.'">');
			}
			else {
				if(@file_exists("..".$this->ary[$txt])) {
					$fdata=(pathinfo("..".$this->ary[$txt]));
					if($fdata["basename"]!="detailsimg_defalt.gif") {
						if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
							ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",200,200);
						}
						echo "<img src='".$fdata["dirname"]."/k_".$fdata["basename"]."' alt='".$alt."'>'>";
					}
				}
			}
			
		}
		
	}
	
	function Image3($txt){
	
		if($this->ary[$txt]!=NULL){
		
			$agent=GetAgent();
			if($agent["type"]=="other") {
					echo ('<img src="'.$this->ary[$txt].'" border=0>');
			}
			else {
				if(@file_exists("..".$this->ary[$txt])) {
					$fdata=(pathinfo("..".$this->ary[$txt]));
					if($fdata["basename"]!="detailsimg_defalt.gif") {
						if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
							ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",200,200);
						}
						echo "<img src='".$fdata["dirname"]."/k_".$fdata["basename"]."'>";
					}
				}
			}
			
		}
		
	}

	function Image4($txt,$alt,$w){
	
		if($this->ary[$txt]!=NULL){
		
			$agent=GetAgent();
			if($agent["type"]=="other") {
					echo ('<img src="'.$this->ary[$txt].'" border=0 alt="'.$alt.'" width="'.$w.'">');
			}
			else {
				if(@file_exists("..".$this->ary[$txt])) {
					$fdata=(pathinfo("..".$this->ary[$txt]));
					if($fdata["basename"]!="detailsimg_defalt.gif") {
						if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
							ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",200,200);
						}
						echo "<img src='".$fdata["dirname"]."/k_".$fdata["basename"]."' alt='".$alt."'>'>";
					}
				}
			}
			
		}
		
	}
	function Image5($txt,$alt,$w,$h){
	
		if($this->ary[$txt]!=NULL){
		
			$agent=GetAgent();
			if($agent["type"]=="other") {
					echo ('<img src="'.$this->ary[$txt].'" border=0 alt="'.$alt.'">');
			}
			else {
				if(@file_exists("..".$this->ary[$txt])) {
					$fdata=(pathinfo("..".$this->ary[$txt]));
					if($fdata["basename"]!="detailsimg_defalt.gif") {
						if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
							ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",200,200);
						}
						echo "<img src='".$fdata["dirname"]."/k_".$fdata["basename"]."' alt='".$alt."'>'>";
					}
				}
			}
			
		}
		
	}
	
	function Date($txt,$year,$month,$day){
	
		if($this->ary[$txt]!=NULL) {
			$date=explode("-",$this->ary[$txt]);
			echo ($date[0].$year.$date[1].$month.$date[2].$day);
		}
		
	}
}


/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php  
*/

?>