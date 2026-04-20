<?php
include "../../config/config.php";
include "../../class/realestate_keitai.php";
include "../../class/RailwayTracksStation_Keitai.php";
mb_internal_encoding("SJIS");
pg_set_client_encoding($dbhandle,"SJIS");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 
if($_GET['article_turn']!=NULL) {
	$_SESSION['article_turn']=$_GET['article_turn'];
}

/*
 * ページ番号
 */
if($pagenum==NULL) {
	$pagenum=1;
}

// １ページに表示する件数
$page_limit=5;

// 検索結果数を取得
$realestate_resultnumrows=Realestate_Keitai :: count_RealestateSearchResult($dbhandle,$_GET);

//最大ページ数計算
$maxpage=ceil($realestate_resultnumrows[salesbuilding]/$page_limit);

//データ取得
$SalesBuilding_data=Realestate_Keitai :: load_Sales_Building($dbhandle,"",$_SESSION['article_turn'],$_GET);
?>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件リスト(賃貸一戸建て)</title>
</head>
<body>
<div align="center"><font color="RED">物件リスト</font>
</div>
<hr>
<div align="left">
	<div align="left"><font color="#FF3300">検索条件</font><br>
広さ：<a href="/keitai/sales_building/srch_madori.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
<?php 
switch($madorinum) {
	case 1:
		echo "1R,K,DK,LDK";
		break;
	case 2:
		echo "2DK,LDK";
		break;
	case 3:
		echo "3DK,LDK";
		break;
	case 4:
		echo "4DK以上";
		break;
	default :
		echo "指定無し";
		break;
}
?>
</a><br>
価格：<a href="/keitai/sales_building/srch_cost.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
<?php
if($lowcost!=NULL&&$lowcost!=0&&$hicost!=NULL) {
	echo $lowcost."万円以上".$hicost."万円未満";
}
else if($lowcost!=NULL&&$hicost==NULL){
	echo $lowcost."万円以上";
}
else if(($lowcost==NULL||$lowcost==0)&&$hicost!=NULL) {
	echo $hicost."万円未満";
}
else {
	echo "指定無し";
}
?>
</a><br>
地域：<a href="/keitai/sales_building/srch_chiki.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
<?php
if($chiiki!=NULL) {
	echo $chiiki;
}
else {
	echo "指定無し";
}
?></a>
<br>
<font color="#FF0000">該当物件<?php echo $realestate_resultnumrows[salesbuilding] ?>件</font><br>
<hr>

		<?php 
		$saleslandlist_rows=0;
		while($SalesBuilding_data[$saleslandlist_rows][sales_building_id]!=NULL) {
		?>
		
		<?php echo $SalesBuilding_data[$saleslandlist_rows]["sales_type"]; ?><br>
		<?php echo $SalesBuilding_data[$saleslandlist_rows][sales_building_address1].$SalesBuilding_data[$saleslandlist_rows][sales_building_address2];
		if($SalesBuilding_data[$saleslandlist_rows][sales_building_address3]!=NULL&&$SalesBuilding_data[$saleslandlist_rows][sales_building_address2]!=NULL) {
			echo "-";
		}
		echo $SalesBuilding_data[$saleslandlist_rows][sales_building_address3]; ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$SalesBuilding_data[$saleslandlist_rows][station_name1]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$SalesBuilding_data[$saleslandlist_rows][closest_station1]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}	
		?>
		<br>
		<?php if($SalesBuilding_data[$saleslandlist_rows][walk1]!=0) {?>徒歩
		<?php echo $SalesBuilding_data[$saleslandlist_rows][walk1];?>
		分/<?php 
		} 
		if($SalesBuilding_data[$saleslandlist_rows][arrangement]!=NULL) {
			echo $SalesBuilding_data[$saleslandlist_rows][arrangement].$SalesBuilding_data[$saleslandlist_rows][arrangement_unit].$SalesBuilding_data[$saleslandlist_rows][service_room] ?>
		<strong><font color="#0000FF"><?php
		}
		?>
		</strong></span></font></strong><br>
		 
		<?php 
		if($SalesBuilding_data[$saleslandlist_rows][cost]!=0) {echo number_format($SalesBuilding_data[$saleslandlist_rows][cost]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $SalesBuilding_data[$saleslandlist_rows][parking];
		if($SalesBuilding_data[$saleslandlist_rows][parking]=="有り　有料"&&$SalesBuilding_data[$saleslandlist_rows][parking_cost]!=0) {
			 echo "(".number_format($SalesBuilding_data[$saleslandlist_rows][parking_cost])."円)";
		 }?><br>
		<?php 
		if($SalesBuilding_data[$saleslandlist_rows][photo1]!=NULL&&file_exists("../../tmp/".$SalesBuilding_data[$saleslandlist_rows][photo1])) {
		?>
		 <a href="/keitai/sales_building/photo.php?photoname=<?php echo $roomlist_data[$saleslandlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
        <?php 
		}
		?>
        <?php 
		if($SalesBuilding_data[$saleslandlist_rows][arrangement_img1]!=NULL&&file_exists("../../tmp/".$SalesBuilding_data[$saleslandlist_rows][arrangement_img1])) {
		?>
・ <a href="/keitai/sales_building/madoriimage.php?photoname=<?php echo $SalesBuilding_data[$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
<?php 
		}?>
		<hr><?php

			$saleslandlist_rows++;
			if($saleslandlist_rows>10) {
				exit();
			}
		}
		?>
		
		<?php 
		if($pagenum>1) {
			echo "<a href=\"list.php?pagenum=".($pagenum-1)."&madorinum=".$madorinum."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">&lt;&lt;前の5件</a><br>";
		}
		else {
			echo "<font color=\"#CCCCCC\">&lt;&lt;前の5件</font><br>";
		}
		$pagecount_rows=1;
		while($maxpage>=$pagecount_rows) {
		
			if($pagecount_rows!=$pagenum) {
				echo "<a href=\"list.php?pagenum=".$pagecount_rows."&madorinum=".$madorinum."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">".$pagecount_rows."</a>";
			}
			else {
				echo "<font color=\"#FF0000\">".$pagecount_rows."</font>";
			}
			
			$pagecount_rows++;
		}	
		if($maxpage>$pagenum) {
			echo "<br><a href=\"list.php?pagenum=".($pagenum+1)."&madorinum=".$madorinum."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">次の5件&gt;&gt;</a>";
		}
		else {
			echo "<br><font color=\"#CCCCCC\">次の5件&gt;&gt;</font>";
		}
		?>
		<br>
		<font color="#FF3300">検索条件<br>
		</font>広さ：<a href="/keitai/sales_building/srch_madori.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php 
switch($madorinum) {
	case 1:
		echo "1R,K,DK,LDK";
		break;
	case 2:
		echo "2DK,LDK";
		break;
	case 3:
		echo "3DK,LDK";
		break;
	case 4:
		echo "4DK以上";
		break;
	default :
		echo "指定無し";
		break;
}
?>
        </a><br>
価格：<a href="/keitai/sales_building/srch_cost.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php
if($lowcost!=NULL&&$lowcost!=0&&$hicost!=NULL) {
	echo $lowcost."万円以上".$hicost."万円未満";
}
else if($lowcost!=NULL&&$hicost==NULL){
	echo $lowcost."万円以上";
}
else if(($lowcost==NULL||$lowcost==0)&&$hicost!=NULL) {
	echo $hicost."万円未満";
}
else {
	echo "指定無し";
}
?>
</a><br>
地域：<a href="/keitai/sales_building/srch_chiki.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>"><?php
if($chiiki!=NULL) {
	echo $chiiki;
}
else {
	echo "指定無し";
}
?>
</a> <br>
		<br>
		 <a href="/keitai/index.php">TOPへ戻る</a><br>
  </div>
</div>
<hr>
<div align="center"></div>
</body>
</html>
