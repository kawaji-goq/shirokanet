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

if($_GET['lease_tenpo__turn']!=NULL) {
	$_SESSION['lease_tenpo__turn']=$_GET['lease_tenpo__turn'];
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
$maxpage=ceil($realestate_resultnumrows[leasetenpo]/$page_limit);
//データ取得
$roomlist_data=Realestate_Keitai :: load_LeaseTenpo_keitai($dbhandle,3,$_SESSION['lease_tenpo__turn'],$_GET);
?>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ｱｰｸﾌﾟﾗﾝ物件検索</title>
</head>
<body>
<div align="center"><font color="RED">物件リスト</font> </div>
<hr>
<div align="left">
	<div align="left"><font color="#FF3300">検索条件</font><br>
価格：<a href="/keitai/lease_tenpo/srch_cost.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
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
地域：<a href="/keitai/lease_tenpo/srch_chiki.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
<?php
if($chiiki!=NULL) {
	echo $chiiki;
}
else {
	echo "指定無し";
}
?>
</a><br>
<font color="#FF0000">該当物件<?php echo $realestate_resultnumrows[tenpo] ?>件</font><br>
<hr>		<?php 
		$roomlist_rows=0;
		while($roomlist_data[$roomlist_rows][lease_tenpo_id]!=NULL) {
		?>
		
		<?php echo $roomlist_data[$roomlist_rows]["lease_tenpo_type"]; ?><br>
		<?php echo $roomlist_data[$roomlist_rows][lease_tenpo_address1].$roomlist_data[$roomlist_rows][lease_tenpo_address2];
		if($roomlist_data[$roomlist_rows][lease_tenpo_address3]!=NULL&&$roomlist_data[$roomlist_rows][lease_tenpo_address2]!=NULL) {
			echo "-";
		}
		echo $roomlist_data[$roomlist_rows][lease_tenpo_address3]; ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$roomlist_data[$roomlist_rows][station_id]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$roomlist_data[$roomlist_rows][railway_tracks]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}
		?>
		<br>
		<?php if($roomlist_data[$roomlist_rows][walk]!=0) {?>徒歩
		<?php echo $roomlist_data[$roomlist_rows][walk];?>
		分/<?php
		}?>
		<strong><font color="#0000FF">
		<?php 
		if($roomlist_data[$roomlist_rows][arrangement]!=0) {
			echo $roomlist_data[$roomlist_rows][arrangement].$roomlist_data[$roomlist_rows][arrangement_unit];
		}
		?>
		</font></strong><br>
		
		<?php if($roomlist_data[$roomlist_rows][rent]!=0) {echo number_format($roomlist_data[$roomlist_rows][rent]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $roomlist_data[$roomlist_rows][parking];
									if($roomlist_data[$roomlist_rows][parking]=="有り　有料"&&$roomlist_data[$roomlist_rows][parking_cost]!=0) {
										 echo "(".number_format($roomlist_data[$roomlist_rows][parking_cost])."円)";
									 }?><br>
		<?php if($roomlist_data[$roomlist_rows][photo1]!=NULL&&file_exists("../../tmp/".$roomlist_data[$roomlist_rows][photo1])) {?>
		 <a href="/keitai/lease_tenpo/photo.php?photoname=<?php echo $roomlist_data[$roomlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
		<?php }?>
        <?php if($roomlist_data[$roomlist_rows][arrangement_img1]!=NULL&&file_exists("../../tmp/".$roomlist_data[$roomlist_rows][arrangement_img1])) {?>
        ・ <a href="/keitai/lease_tenpo/madoriimage.php?photoname=<?php echo $roomlist_data[$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
        <?php }?>
     <hr>
   <?php
			$roomlist_rows++;
			if($roomlist_rows>10) {
				exit();
			}
		}
		?>
		
		<?php 
		if($pagenum>1) {
			echo "<a href=\"list.php?pagenum=".($pagenum-1)."&monopolyarea=".$monopolyarea."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">&lt;&lt;前の5件</a><br>";
		}
		else {
			echo "<font color=\"#CCCCCC\">&lt;&lt;前の5件</font>";
		}
		$pagecount_rows=1;
		while($maxpage>=$pagecount_rows) {
		
			if($pagecount_rows!=$pagenum) {
				echo "<a href=\"list.php?pagenum=".$pagecount_rows."&monopolyarea=".$monopolyarea."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">".$pagecount_rows."</a>";
			}
			else {
				echo "<font color=\"#FF0000\">".$pagecount_rows."</font>";
			}
			
			$pagecount_rows++;
		}	
		if($maxpage>$pagenum) {
			echo "<br><a href=\"list.php?pagenum=".($pagenum+1)."&monopolyarea=".$monopolyarea."&madoritype=".$madoritype."&lowcost=".$lowcost."&hicost=".$hicost."&chiiki=".$chiiki."\">次の5件&gt;&gt;</a>";
		}
		else {
			echo "<br><font color=\"#CCCCCC\">次の5件&gt;&gt;</font>　";
		}
		?>
		<br>
		<font color="#FF3300">検索条件</font><br>

価格：<a href="/keitai/lease_tenpo/srch_cost.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
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
地域：<a href="/keitai/lease_tenpo/srch_chiki.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">
<?php
if($chiiki!=NULL) {
	echo $chiiki;
}
else {
	echo "指定無し";
}
?>
</a><br>
<br>
		 <a href="/keitai/index.php">TOPへ戻る</a><br>
  </div>
</div>
<hr>
<div align="center"></div>
</body>
</html>
