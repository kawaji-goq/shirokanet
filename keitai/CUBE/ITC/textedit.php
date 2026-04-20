<?php
class Cube_TextEdit{

	var $newenc;
 var $oldenc;
	var $text;
	var $strary;
	function Cube_TextEdit($strnewenc, $stroldenc){
		$this->text="文字列が入力されていません。";
		$this->setEncode($strnewenc, $stroldenc);
	}
	
	function setText($text){
			$this->text=$text;
			$this->convertEncoding();
			return $this->text;
	}
	
	function setEncode($strnewenc, $stroldenc) {
		$this->newenc=$strnewenc;
		$this->oldenc=$stroldenc;
		$this->convertEncoding();
	}
	
	function convertEncoding(){
			$this->text=mb_convert_encoding($this->text,$this->newenc,$this->oldenc);
	} 
	
	function getStrWidth() {
		
	}
	
	function getStrImWidth($intpos,$intwdh, $strtrm) {
			return mb_strimwidth($this->text, $intpos, $intwdh, $strtrm, $this->newenc);
	}
	
	function printShortStr($intwdh, $strtrm) {
			echo mb_strimwidth($this->text, 0, $intwdh*2, $strtrm, $this->newenc);
	}
	
	function nltobr() {
		$this->text=nl2br($this->text);
	}
	
	function convKana($strOpt) {
		$this->text=mb_convert_kana($this->text,$strOpt,$this->newenc);
	}
	
	function texttomap() {
			global $tenpodata;
			preg_match_all("/<map>(.+?)<\/map>/x",$this->text, $retxt);
			
			for($i=0;$retxt[0][$i]!=NULL;$i++){
		$repbtext='<a href="#" onclick="window.open(\'./mapout.php?name='.urlencode(mb_convert_encoding($tenpodata["name"],"utf8","euc-jp")).'&address='.urlencode(mb_convert_encoding($retxt[1][$i],"utf8","euc-jp")).'\',\'maps\',\'width=640,height=540\')"><img src="/img_f/google_map.gif" width="174" height="20" border="0" /></a>';

					$this->text=str_replace($retxt[0][$i],$repbtext,$this->text);
			}
	}
	function texttotel() {
			preg_match_all("/\(? \d{2,4}[\-]{1}\d{2,4}[-]{1}\d{4}/x",$this->text, $retxt);
			
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="tel:'.($retxt[0][$i]).'">'.$retxt[0][$i].'</a><br>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	function texttomail(){
			preg_match_all("/[_a-zA-Z0-9.-]+[\@]{1}[_a-z0-9.-]+[\.]{1}[_a-z0-9.-]+[_a-z0-9]{1}/x",$this->text, $retxt);
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="mailto:'.($retxt[0][$i]).'">'.$retxt[0][$i].'</a>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	function texttourl(){
			preg_match_all("/\http:\/\/[_a-z0-9]{1}[_a-z0-9.-]+[\.]{1}[_a-z0-9.-]+[_a-z0-9]{1}/x",$this->text, $retxt);
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="'.($retxt[0][$i]).'" target="_blank">'.$retxt[0][$i].'</a>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	
	function printt($text) {		
			$this->setText($text);
			$this->convKana("krns");
			echo $this->text;
	}
	
	function printc($text) {
			$this->setText($text);			
			$this->texttourl();
			$this->texttomap();
			$this->texttomail();
			$this->nltobr();
			echo $this->text;
	}
	
	function arrayconv($strary) {
		for($i=0;$strary[$i]!=NULL;$i++) {
				$strary[$i]=mb_convert_encoding($strary[$i],$this->newenc,$this->oldenc);
		}
		return $strary;
	}
	
}
class Cube_KeitaiTextEdit extends Cube_TextEdit{
	function texttomap() {
			preg_match_all("/<map>(.+?)<\/map>/x",$this->text, $retxt);
			
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="http://map.mobile.yahoo.co.jp/msearch?p='.urlencode($retxt[1][$i]).'&r=0&k="><img src="http://cubes.jp/img_f/google_map.gif"></a>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	
	function texttotel() {
			preg_match_all("/\(? \d{2,4}[\-]{1}\d{2,4}[-]{1}\d{4}/x",$this->text, $retxt);
			
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="tel:'.($retxt[0][$i]).'">'.$retxt[0][$i].'</a><br>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	
	function texttomail(){
			preg_match_all("/[_a-zA-Z0-9.-]+[\@]{1}[_a-z0-9.-]+[\.]{1}[_a-z0-9.-]+[_a-z0-9]{1}/x",$this->text, $retxt);
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="mailto:'.($retxt[0][$i]).'">'.$retxt[0][$i].'</a>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	
	function texttourl(){
			preg_match_all("/\http:\/\/[_a-z0-9]{1}[_a-z0-9.-]+[\.]{1}[_a-z0-9.-]+[_a-z0-9]{1}/x",$this->text, $retxt);
			for($i=0;$retxt[0][$i]!=NULL;$i++){
						$repstr='<a href="'.($retxt[0][$i]).'">'.$retxt[0][$i].'</a>';

					$this->text=str_replace($retxt[0][$i],$repstr,$this->text);
			}
	}
	
	function printShortStr($text,$intwdh, $strtrm) {
			$this->setText($text);
			$this->convKana("krns");
			echo mb_strimwidth($this->text, 0, $intwdh*2, $strtrm, $this->newenc);
	}
	
	function printt($text) {		
			$this->setText($text);
			$this->convKana("krns");
			echo $this->text;
	}
	
	function printc($text) {
			$this->setText($text);			
			$this->convKana("krns");
			$this->texttourl();
			$this->texttomap();
			$this->texttotel();
			$this->texttomail();
			$this->nltobr();
			echo $this->text;
	}
		
}
?>