<?php 
include "../class/Image.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<TITLE>無題ドキュメント</TITLE>
</head>

<body>
写真<br>
<?php 

if(@file_exists("../../tmp/".$photoname)) {
	$fdata=(pathinfo("../../tmp/".$photoname));
	if(@!file_exists($fdata["dirname"]."/k_".$fdata["basename"])){
		ImgMagic :: cpandconv_Size($fdata["dirname"]."/".$fdata["basename"],"k_".$fdata["basename"],$fdata["dirname"]."/",250,250);
	}
	echo "<img src='".$fdata["dirname"]."/k_".str_replace("300","",$fdata["basename"])."'>";
}
?>
<br>
<a href="/keitai/lease_house/list.phpmadorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">戻る</a></body>
</html>
