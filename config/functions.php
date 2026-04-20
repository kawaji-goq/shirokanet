<?php

	function cube_text2php($path,$pagedata){
global	$tenpodata;
	$fdata=file_get_contents($_SERVER['DOCUMENT_ROOT'].$path.".php");
		$fdata=str_replace("[テンプレートタイトル背景]",$tenpodata["mc_title_bgimg"],$fdata);
	$fdata=str_replace("[タイトル1]",$pagedata["name"],$fdata);	
	$fdata=str_replace("[テキスト1]",$pagedata["title1"],$fdata);
	$fdata=str_replace("[テキスト2]",$pagedata["title2"],$fdata);
	$fdata=str_replace("[テキスト3]",$pagedata["title3"],$fdata);
	$fdata=str_replace("[テキスト4]",$pagedata["title4"],$fdata);
	$fdata=str_replace("[テキスト5]",$pagedata["title5"],$fdata);
	$fdata=str_replace("[画像1]",images($pagedata["image1_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像1S]",images($pagedata["image1_s"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像1M]",images($pagedata["image1_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像1L]",images($pagedata["image1_l"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像2]",images($pagedata["image2_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像2S]",images($pagedata["image2_s"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像2M]",images($pagedata["image2_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像2L]",images($pagedata["image2_l"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像3]",images($pagedata["image3_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像3S]",images($pagedata["image3_s"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像3M]",images($pagedata["image3_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像3L]",images($pagedata["image3_l"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像4]",images($pagedata["image4_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像4S]",images($pagedata["image4_s"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像4M]",images($pagedata["image4_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像4L]",images($pagedata["image4_l"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像5]",images($pagedata["image5_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像5S]",images($pagedata["image5_s"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像5M]",images($pagedata["image5_m"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[画像5L]",images($pagedata["image5_l"],$pagedata["name"]),$fdata);
	$fdata=str_replace("[コメント1]",$pagedata["comm1"],$fdata);
	$fdata=str_replace("[コメント2]",$pagedata["comm2"],$fdata);
	$fdata=str_replace("[コメント3]",$pagedata["comm3"],$fdata);
	$fdata=str_replace("[コメント4]",$pagedata["comm4"],$fdata);
	$fdata=str_replace("[コメント5]",$pagedata["comm5"],$fdata);

return $fdata;

}
	
function convert_contents_text2php($path,$pagelist){
	global	$tenpodata;
	for($i=0;$pagelist[$i]["data_id"]!=NULL;$i++){
			$fdata=file_get_contents($_SERVER['DOCUMENT_ROOT'].$path."/".$pagelist[$i]["designtype"].".php");
		$fdata=str_replace("[テンプレートタイトル背景]",$tenpodata["mc_title_bgimg"],$fdata);
			$pagedata=$pagelist[$i];
				$fdata=str_replace("[タイトル1]",$pagedata["name"],$fdata);
				$fdata=str_replace("[テキスト1]",$pagedata["title1"],$fdata);
				$fdata=str_replace("[テキスト2]",$pagedata["title2"],$fdata);
				$fdata=str_replace("[テキスト3]",$pagedata["title3"],$fdata);
				$fdata=str_replace("[テキスト4]",$pagedata["title4"],$fdata);
				$fdata=str_replace("[テキスト5]",$pagedata["title5"],$fdata);
				$fdata=str_replace("[画像1]",images($pagedata["image1_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像1S]",images($pagedata["image1_s"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像1M]",images($pagedata["image1_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像1L]",images($pagedata["image1_l"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像2]",images($pagedata["image2_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像2S]",images($pagedata["image2_s"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像2M]",images($pagedata["image2_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像2L]",images($pagedata["image2_l"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像3]",images($pagedata["image3_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像3S]",images($pagedata["image3_s"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像3M]",images($pagedata["image3_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像3L]",images($pagedata["image3_l"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像4]",images($pagedata["image4_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像4S]",images($pagedata["image4_s"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像4M]",images($pagedata["image4_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像4L]",images($pagedata["image4_l"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像5]",images($pagedata["image5_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像5S]",images($pagedata["image5_s"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像5M]",images($pagedata["image5_m"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[画像5L]",images($pagedata["image5_l"],$pagedata["name"]),$fdata);
				$fdata=str_replace("[コメント1]",$pagedata["comm1"],$fdata);
				$fdata=str_replace("[コメント2]",$pagedata["comm2"],$fdata);
				$fdata=str_replace("[コメント3]",$pagedata["comm3"],$fdata);
				$fdata=str_replace("[コメント4]",$pagedata["comm4"],$fdata);
				$fdata=str_replace("[コメント5]",$pagedata["comm5"],$fdata);
				echo $fdata;
			}
return $fdata;

}


function loadmod($modulename){
	global	$tenpodata;
$filename="";
		switch($modulename){
			case "[アクセスマップ]":
			$filename="accessmap.php";
			break;
			default:
			echo "読み込みに失敗しました。";
			return ;
			break;
		}	
		if(!include $_SERVER['DOCUMENT_ROOT']."/TemplateData/".$filename){
			echo "読み込みに失敗しました。";
		}
}

function loadmod_exp($modulename,$fary,$dary){
	global	$tenpodata;
$filename="";
		switch($modulename){
			case "[アクセスマップ]":
			$filename="accessmap.php";
			break;
			default:
			echo "読み込みに失敗しました。";
			return ;
			break;
		}	
		if(!include $_SERVER['DOCUMENT_ROOT']."/TemplateData/".$filename){
			echo "読み込みに失敗しました。";
		}
		
}
function dataconvert($data,$number){
for($i=0;$data[$i]["data_id"]!=NULL;$i++){

	$rdata[floor($i/$number)][($i%$number)]=$data[$i];
}
return $rdata;
}

/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
*/

?>
