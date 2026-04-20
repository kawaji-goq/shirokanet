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
			echo nl2br($this->ary[$txt]);
		}
		else {
			if($this->ary[$txt]!=NULL) {
				echo nl2br(mb_convert_kana(strip_tags($this->ary[$txt]),"ksa","sjis"))."<br />";
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
				echo mb_strimwidth(nl2br(mb_convert_kana(strip_tags($this->ary[$txt]),"ksa","sjis")),0,20,"...","sjis")."<br />";
			}
		}
	}
	
	function LMoji($txt){
		$agent=GetAgent();
		if($agent["type"]=="other") {
			echo nl2br($this->ary[$txt]);
		}
		else {
			if($this->ary[$txt]!=NULL) {
				echo nl2br(strip_tags($this->ary[$txt]));
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
						echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
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