<?php
include "../config.php";
include "../class/realestate_keitai.php";
include "../class/RailwayTracksStation_Keitai.php";
include "../class/keitai_diary.php";
mb_internal_encoding("SJIS");
pg_set_client_encoding($dbhandle,"SJIS");
$data=Realestate_Keitai :: display_Recommendation($dbhandle);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ｱｰｸﾌﾟﾗﾝ物件検索</title>
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
</head>

<body>
<div align="center"><font color="#FF0000">ｵｽｽﾒ＆最新情報</font></div>
<hr>
<div align="center">ｵｽｽﾒ物件</div>
<br>
<font color="#FF0000"><strong>おすすめ賃貸ｱﾊﾟｰﾄﾏﾝｼｮﾝ</strong></font><br>
<?php 
		$roomlist_rows=0;
		while($data[apaman][$roomlist_rows][lease_apaman_id]!=NULL) {
		 echo $data[apaman][$roomlist_rows]["lease_apaman_type"]; ?><br>
		<?php echo $data[apaman][$roomlist_rows][lease_apaman_address1].$data[apaman][$roomlist_rows][lease_apaman_address2];
		if($data[apaman][$roomlist_rows][lease_apaman_address3]!=NULL&&$data[apaman][$roomlist_rows][lease_apaman_address2]!=NULL) {
			echo "-";
		}
		echo $data[apaman][$roomlist_rows][lease_apaman_address3];
		 ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$data[apaman][$roomlist_rows][station_id]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$roomlist_data[$roomlist_rows][railway_tracks]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}	
		?>
		<br>
		徒歩
		<?php if($data[apaman][$roomlist_rows][walk]!=0) {echo $data[apaman][$roomlist_rows][walk];?>
		分/<strong><?php }
		if($data[apaman][$roomlist_rows][arrangement]!=0) {
			echo $data[apaman][$roomlist_rows][arrangement].$data[apaman][$roomlist_rows][arrangement_unit];
		} ?></strong></span><br>
		 
		<?php if($data[apaman][$roomlist_rows][rent]!=0) {echo number_format($data[apaman][$roomlist_rows][rent]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $data[apaman][$roomlist_rows][parking];
									if($data[apaman][$roomlist_rows][parking]=="有り　有料"&&$data[apaman][$roomlist_rows][parking_cost]!=0) {
										 echo "(".number_format($data[apaman][$roomlist_rows][parking_cost])."円)";
									 }?><br>
		<?php if($data[apaman][$roomlist_rows][photo1]!=NULL&&file_exists("../tmp/".$data[apaman][$roomlist_rows][photo1])) {?> <a href="/keitai/photo.php?photoname=<?php echo $data[apaman][$roomlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
		<?php }?>
		<?php if($data[apaman][$roomlist_rows][arrangement_img1]!=NULL&&file_exists("../tmp/".$data[apaman][$roomlist_rows][arrangement_img1])) {?>・ <a href="/keitai/madoriimage.php?photoname=<?php echo $data[apaman][$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
		<?php }?>
		<?php
			$roomlist_rows++;
			if($roomlist_rows>10) {
				exit();
			}
		}
		?>
		<hr>
        <font color="#FF0000"><strong>おすすめ賃貸一戸建て</strong></font>		<?php 
		$roomlist_rows=0;
		while($data[lhome][$roomlist_rows][lease_home_id]!=NULL) {
		?>
		<br>
		<?php echo $data[lhome][$roomlist_rows]["lease_home_type"]; ?><br>
		<?php echo $data[lhome][$roomlist_rows][lease_home_address1].$data[lhome][$roomlist_rows][lease_home_address2].$data[lhome][$roomlist_rows][lease_home_address3]; ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$data[lhome][$roomlist_rows][station_id]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$data[lhome][$roomlist_rows][railway_tracks]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}
		?>
		<br>
		徒歩
		<?php if($data[lhome][$roomlist_rows][walk]!=0) {echo $data[lhome][$roomlist_rows][walk];?>
		分/<?php
		}
		 if($data[lhome][$roomlist_rows][arrangement]!=0) { echo $data[lhome][$roomlist_rows][arrangement].$data[lhome][$roomlist_rows][arrangement_unit];} ?></strong></span><br>
		 
		<?php if($data[lhome][$roomlist_rows][rent]!=0) {echo number_format($data[lhome][$roomlist_rows][rent]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $data[lhome][$roomlist_rows][parking];
		if($data[lhome][$roomlist_rows][parking]=="有り　有料"&&number_format($data[lhome][$roomlist_rows][parking_cost])!=0) {
			 echo "(".number_format($data[lhome][$roomlist_rows][parking_cost])."円)";
		 }?><br>
		<?php if($data[lhome][$roomlist_rows][photo1]!=NULL&&file_exists("../tmp/".$data[lhome][$roomlist_rows][photo1])) {?>
		 <a href="/keitai/photo.php?photoname=<?php echo $data[lhome][$roomlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
		<?php }?>
        <?php if($data[lhome][$roomlist_rows][arrangement_img1]!=NULL&&file_exists("../tmp/".$data[lhome][$roomlist_rows][arrangement_img1])) {?>
        ・ <a href="/keitai/madoriimage.php?photoname=<?php echo $data[lhome][$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
        <?php }?><?php
			$roomlist_rows++;
			if($roomlist_rows>10) {
				exit();
			}
		}
		?>
        <hr>


		<font color="#FF0000"><strong>おすすめ賃貸事務所・店舗</strong></font>
<?php 
		$roomlist_rows=0;
		while($data[ltenpo][$roomlist_rows][lease_tenpo_id]!=NULL) {
		?>
		<br>
		<?php echo $data[ltenpo][$roomlist_rows]["lease_tenpo_type"]; ?><br>
		<?php echo $data[ltenpo][$roomlist_rows][lease_tenpo_address1].$data[ltenpo][$roomlist_rows][lease_tenpo_address2];
		if($data[ltenpo][$roomlist_rows][lease_tenpo_address3]!=NULL&&$data[ltenpo][$roomlist_rows][lease_tenpo_address2]!=NULL) {
			echo "-";
		}
		echo $data[ltenpo][$roomlist_rows][lease_tenpo_address3]; ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$data[ltenpo][$roomlist_rows][station_id]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$data[ltenpo][$roomlist_rows][railway_tracks]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}
		?>
		<br>
		徒歩
		<?php if($data[ltenpo][$roomlist_rows][walk]!=0) {echo $data[ltenpo][$roomlist_rows][walk];?>
		分/<?php
		}?>
		<?php 
		if($data[ltenpo][$roomlist_rows][arrangement]!=0) {
			echo $data[ltenpo][$roomlist_rows][arrangement].$data[ltenpo][$roomlist_rows][arrangement_unit];?></strong></span>
		<?php
		}
		?><br>
		<?php if($data[ltenpo][$roomlist_rows][rent]!=0) {echo number_format($data[ltenpo][$roomlist_rows][rent]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $data[ltenpo][$roomlist_rows][parking];
									if($data[ltenpo][$roomlist_rows][parking]=="有り　有料"&&$data[ltenpo][$roomlist_rows][parking_cost]!=0) {
										 echo "(".number_format($data[ltenpo][$roomlist_rows][parking_cost])."円)";
									 }?><br>
		<?php if($data[ltenpo][$roomlist_rows][photo1]!=NULL&&file_exists("../tmp/".$data[ltenpo][$roomlist_rows][photo1])) {?>
		 <a href="/keitai/photo.php?photoname=<?php echo $data[ltenpo][$roomlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
		<?php }?>
        <?php if($data[ltenpo][$roomlist_rows][arrangement_img1]!=NULL&&file_exists("../tmp/".$data[ltenpo][$roomlist_rows][arrangement_img1])) {?>
        ・ <a href="/keitai/madoriimage.php?photoname=<?php echo $data[ltenpo][$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
        <?php }?>
        <?php
			$roomlist_rows++;
			if($roomlist_rows>10) {
				exit();
			}
		}
		?>		
        <hr>
		<font color="#FF0000"><strong>おすすめ 売りﾏﾝｼｮﾝ・戸建</strong></font>
		<?php 
		$saleslandlist_rows=0;
		while($data[sbuilding][$saleslandlist_rows][sales_building_id]!=NULL) {
		?><br>
		<?php echo $data[sbuilding][$saleslandlist_rows]["sales_type"]; ?><br>
		<?php echo $data[sbuilding][$saleslandlist_rows][sales_building_address1].$data[sbuilding][$saleslandlist_rows][sales_building_address2];
		if($data[sbuilding][$saleslandlist_rows][sales_building_address3]!=NULL&&$data[sbuilding][$saleslandlist_rows][sales_building_address2]!=NULL) {
			echo "-";
		}
		echo $data[sbuilding][$saleslandlist_rows][sales_building_address3]; ?><br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$data[sbuilding][$saleslandlist_rows][station_name1]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$data[sbuilding][$saleslandlist_rows][closest_station1]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}	
		?>
		<br>
		徒歩
		<?php if($data[sbuilding][$saleslandlist_rows][walk1]!=0) {echo $data[sbuilding][$saleslandlist_rows][walk1];?>
		分/<?php 
		} 
		if($data[sbuilding][$saleslandlist_rows][arrangement]!=NULL) {
			echo $data[sbuilding][$saleslandlist_rows][arrangement].$data[sbuilding][$saleslandlist_rows][arrangement_unit].$data[sbuilding][$saleslandlist_rows][service_room] ?>
		<?php
		}
		?></strong></span><br> 
		<?php 
		if($data[sbuilding][$saleslandlist_rows][cost]!=0) {echo number_format($data[sbuilding][$saleslandlist_rows][cost]/10000,1)."万円";} ?>
		</span><br>
		 <?php echo $data[sbuilding][$saleslandlist_rows][parking];
		if($data[sbuilding][$saleslandlist_rows][parking]=="有り　有料"&&$data[sbuilding][$saleslandlist_rows][parking_cost]!=0) {
			 echo "(".number_format($data[sbuilding][$saleslandlist_rows][parking_cost])."円)";
		 }?><br>
		<?php 
		if($data[sbuilding][$saleslandlist_rows][photo1]!=NULL&&file_exists("../tmp/".$data[sbuilding][$saleslandlist_rows][photo1])) {
		?>
		 <a href="/keitai/photo.php?photoname=<?php echo $roomlist_data[$saleslandlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
        <?php 
		}
		?>
        <?php 
		if($data[sbuilding][$saleslandlist_rows][arrangement_img1]!=NULL&&file_exists("../tmp/".$data[sbuilding][$saleslandlist_rows][arrangement_img1])) {
		?>
・ <a href="/keitai/madoriimage.php?photoname=<?php echo $data[sbuilding][$roomlist_rows][arrangement_img1]; ?>&madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">間取り図</a><br>
<?php 
		}
			$saleslandlist_rows++;
			if($saleslandlist_rows>10) {
				exit();
			}
		}
		?>
        <hr>
        <font color="#FF0000"><strong>おすすめ 売り土地</strong></font><br>

		<?php 
		
		$saleslandlist_rows=0;
		while($data[sland][$saleslandlist_rows][sales_land_id]!=NULL) {
		echo "土地"; ?>
		<br>
		<?php 
		echo $data[sland][$saleslandlist_rows][sales_land_address1].$data[sland][$saleslandlist_rows][sales_land_address2];
		if($data[sland][$saleslandlist_rows][sales_land_address3]!=NULL&&$data[sland][$saleslandlist_rows][sales_land_address2]!=NULL ){
			echo "-";
		}
		echo $data[sland][$saleslandlist_rows][sales_land_address3]; ?>
		<br>
		
		<?php 					
		$station_data=Railway_Tracks_Station :: view_Station_Data($dbhandle,$data[sland][$saleslandlist_rows][station_id1]);
		$closest_station_data=Railway_Tracks_Station :: view_Railway_Tracks_Data($dbhandle,$data[sland][$saleslandlist_rows][railway_tracks1]);
		echo $station_data[station_name];
		if($closest_station_data[railway_tracks_name]!=NULL) {
			echo "[".$closest_station_data[railway_tracks_name]."]";
		}
		?>
		<br>
		徒歩
		<?php if($data[sland][$saleslandlist_rows][walk1]!=0) {echo $data[sland][$saleslandlist_rows][walk1];?>
		分/<?php }?><strong><?php echo $data[sland][$saleslandlist_rows][room_arrangement].$data[sland][$saleslandlist_rows][room_arrangement_unit].$data[sland][$saleslandlist_rows][service_room] ?></strong></span><br>
		
		<?php if($data[sland][$saleslandlist_rows][cost]!=0) {echo number_format($data[sland][$saleslandlist_rows][cost]/10000,1)."万円";} ?>
		</span><br>
		<?php if($data[sland][$saleslandlist_rows][photo1]!=NULL&&file_exists("../tmp/".$data[sland][$saleslandlist_rows][photo1])) {?>
		 <a href="/keitai/photo.php?photoname=<?php echo $data[sland][$saleslandlist_rows][photo1]; ?>&madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>&pagenum=<?php echo $pagenum;?>">外観写真</a><br>
        <?php }?>
<?php
			$saleslandlist_rows++;
			if($saleslandlist_rows>10) {
				exit();
			}
		}
		?>
<hr>
<div align="center">最新情報</div><br>
<?php 
						$diary_obj=new KeitaiDiary($dbhandle);
						$diary_data=$diary_obj->Load_Diarydata(0,10);
						$diary_rows=0;
						while($diary_data[$diary_rows][diary_id]!=NULL) {
						?>
<a href="/keitai/diary.php?pagenum=<?php echo $diary_rows+1;?>"><font color="#AB384A"><?php echo "・".$diary_data[$diary_rows][title]."[".str_replace("-",".",$diary_data[$diary_rows][write_date])."]"; ?></font></a><font color="#000000"> <br>
</font> 
<?php
								$diary_rows++;
								if($diary_rows>2) {
								break;
								}
							}
							?>

<br>

  <a href="/keitai/index.php">TOPへ戻る</a>
  <hr>  
<div align="center"></div>
<br>
<br>
</body>
</html>
