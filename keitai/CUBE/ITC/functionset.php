<?php
/*<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">*/
?>
<?php
/*
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<?php
*/
if(class_exists("ImgMagic")) {
	
	function cvimg($pname,$width,$height) {
		$imgsize["h"]=$height;
		$imgsize["w"]=$width;
		
		if($imgsize["h"]==NULL){
			$imgsize["h"]=768;
		}
		if($imgsize["w"]==NULL){
			$imgsize["w"]=1024;
		}
		
		if($pname!=NULL) {		
			$res=pathinfo($_SERVER['DOCUMENT_ROOT'].$pname);
			if(file_exists($_SERVER['DOCUMENT_ROOT'].$pname)) {
				$newname=str_replace(".".$res["extension"],"_".$imgsize["w"]."_".$imgsize["h"].".".$res["extension"],$res["basename"]);
				
				if(substr_count($pname,"(")!=0) {
					@copy($_SERVER['DOCUMENT_ROOT'].$pname,$_SERVER['DOCUMENT_ROOT'].str_replace(")","",str_replace("(","",$pname)));
					$pname=str_replace(")","",str_replace("(","",$pname));
				}
				
				$newname=str_replace("(","_",$newname);
				$newname=str_replace(")","_",$newname);
				
				if(!file_exists($_SERVER['DOCUMENT_ROOT']."/tmp/".$newname)) {
							ImgMagic :: cpandconv_ReSize($_SERVER['DOCUMENT_ROOT'].$pname,$newname,$_SERVER['DOCUMENT_ROOT']."/tmp/",$imgsize["w"],$imgsize["h"]);
				}
			}
		}
		return "/tmp/".$newname;
	}
	function cvimgx($pname,$width,$height) {
		$imgsize["h"]=$height;
		$imgsize["w"]=$width;
		
		if($imgsize["h"]==NULL){
			$imgsize["h"]=768;
		}
		if($imgsize["w"]==NULL){
			$imgsize["w"]=1024;
		}
		
		if($pname!=NULL) {		
			$res=pathinfo($_SERVER['DOCUMENT_ROOT'].$pname);
			if(file_exists($_SERVER['DOCUMENT_ROOT'].$pname)) {
				$newname=str_replace(".".$res["extension"],"_".$imgsize["w"]."_".$imgsize["h"].".".$res["extension"],$res["basename"]);
					$pathx=str_replace($res["basename"],"",$_SERVER['DOCUMENT_ROOT'].$pname);
				if(substr_count($pname,"(")!=0) {
					@copy($_SERVER['DOCUMENT_ROOT'].$pname,$_SERVER['DOCUMENT_ROOT'].str_replace(")","",str_replace("(","",$pname)));
					$pname=str_replace(")","",str_replace("(","",$pname));
				}
				
				$newname=str_replace("(","_",$newname);
				$newname=str_replace(")","_",$newname);
				
				@unlink($pathx.$newname);
							ImgMagic :: cpandconv_ReSize($_SERVER['DOCUMENT_ROOT'].$pname,$newname,$pathx,$imgsize["w"],$imgsize["h"]);
				
			}
		}
		return str_replace($_SERVER['DOCUMENT_ROOT'],"",$pathx).$newname;
	}
	
function convert_imgdata($str) {
	preg_match_all("/<img (.+?)>/",$str,$out, PREG_SET_ORDER);
	for($i=0;$out[$i][0]!=NULL;$i++) {
			preg_match_all("/width=\"(.+?)\"/",$out[$i][1],$width[$i], PREG_SET_ORDER);
			preg_match_all("/height=\"(.+?)\"/",$out[$i][1],$height[$i], PREG_SET_ORDER);
			preg_match_all("/src\=\"(.+?)\"/",$out[$i][1],$src[$i], PREG_SET_ORDER);
			preg_match_all("/alt\=\"(.+?)\"/",$out[$i][1],$alt[$i], PREG_SET_ORDER);
			preg_match_all("/style\=\"(.+?)\"/",$out[$i][1],$style[$i], PREG_SET_ORDER);

			if($height[$i][0][1]!=NULL&&$width[$i][0][1]!=NULL) {
				$width[$i][0][1]=trim($width[$i][0][1]);
				$height[$i][0][1]=trim($height[$i][0][1]);
					$src[$i][0][1]=cvimg($src[$i][0][1],$width[$i][0][1],$height[$i][0][1]);

				if($width[$i][0][1]>600) {
						$tw=0;
						$tw=$width[$i][0][1];
						
						$width[$i][0][1]=600;
						$height[$i][0][1]=ceil((600/$tw)*$height[$i][0][1]);
						
						$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				}
				else {
				$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				}
				$str=str_replace($out[$i][0],$convertdata[$i],$str);
			}
	}
	$str=str_replace(" width=\">",">",$str);
	$str=str_replace(" height=\">",">",$str);
	$str=str_replace(" alt=\">",">",$str);
	$str=str_replace(" src=\">",">",$str);
	return $str;
}
function convert_imghtml($str,$widths) {
	preg_match_all("/<img (.+?)>/",$str,$out, PREG_SET_ORDER);
	for($i=0;$out[$i][0]!=NULL;$i++) {
			preg_match_all("/width=\"(.+?)\"/",$out[$i][1],$width[$i], PREG_SET_ORDER);
			preg_match_all("/height=\"(.+?)\"/",$out[$i][1],$height[$i], PREG_SET_ORDER);
			preg_match_all("/src\=\"(.+?)\"/",$out[$i][1],$src[$i], PREG_SET_ORDER);
			preg_match_all("/alt\=\"(.+?)\"/",$out[$i][1],$alt[$i], PREG_SET_ORDER);
			preg_match_all("/style\=\"(.+?)\"/",$out[$i][1],$style[$i], PREG_SET_ORDER);

			if($height[$i][0][1]!=NULL&&$width[$i][0][1]!=NULL) {
				$width[$i][0][1]=trim($width[$i][0][1]);
				$height[$i][0][1]=trim($height[$i][0][1]);
					$src[$i][0][1]=cvimg($src[$i][0][1],$width[$i][0][1],$height[$i][0][1]);

				if($width[$i][0][1]>$widths) {
						$tw=0;
						$tw=$width[$i][0][1];
						
						$width[$i][0][1]=$widths;
						$height[$i][0][1]=ceil(($widths/$tw)*$height[$i][0][1]);
						
						$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				}
				else {
				$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				}
				$str=str_replace($out[$i][0],$convertdata[$i],$str);
			}
	}
	$str=str_replace(" width=\">",">",$str);
	$str=str_replace(" height=\">",">",$str);
	$str=str_replace(" alt=\">",">",$str);
	$str=str_replace(" src=\">",">",$str);
	return $str;
}

function convert_imghtmlk($str,$widths) {
	preg_match_all("/<img (.+?)>/",$str,$out, PREG_SET_ORDER);
	for($i=0;$out[$i][0]!=NULL;$i++) {
			preg_match_all("/width=\"(.+?)\"/",$out[$i][1],$width[$i], PREG_SET_ORDER);
			preg_match_all("/height=\"(.+?)\"/",$out[$i][1],$height[$i], PREG_SET_ORDER);
			preg_match_all("/src\=\"(.+?)\"/",$out[$i][1],$src[$i], PREG_SET_ORDER);
			preg_match_all("/alt\=\"(.+?)\"/",$out[$i][1],$alt[$i], PREG_SET_ORDER);
			preg_match_all("/style\=\"(.+?)\"/",$out[$i][1],$style[$i], PREG_SET_ORDER);
			if($height[$i][0][1]!=NULL&&$width[$i][0][1]!=NULL) {
				$width[$i][0][1]=trim($width[$i][0][1]);
				$height[$i][0][1]=trim($height[$i][0][1]);
					$src[$i][0][1]=cvimg($src[$i][0][1],$width[$i][0][1],$height[$i][0][1]);

				if($width[$i][0][1]>$widths) {
					
						$tw=0;
						$tw=$width[$i][0][1];
						
						$width[$i][0][1]=$widths;
						$height[$i][0][1]=ceil(($widths/$tw)*$height[$i][0][1]);
						
						$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				
				}
				else {
				$convertdata[$i]="<img src=\"".$src[$i][0][1]."\" width=\"".$width[$i][0][1]."\" height=\"".$height[$i][0][1]."\" border=\"0\"  alt=\"".$alt[$i][0][1]."\" style=\"".$style[$i][0][1]."\">";
				
				}
				
				$str=str_replace($out[$i][0],$convertdata[$i],$str);
			
			}
			
	}
	
	$str=str_replace(" width=\">",">",$str);
	$str=str_replace(" height=\">",">",$str);
	$str=str_replace(" alt=\">",">",$str);
	$str=str_replace(" src=\">",">",$str);
	return $str;
}

}
else {
	echo "This module needs ImgMagic Class";
	function cvimg($pname,$width,$height){
		return $pname;
	
	}
}


/*
	* Ex(1
	* 
	*  <img src="<?php cvimg($pname,$width,$height) ?>">
	*
	*
	*
	*
	* 
 */
	

	
?>
