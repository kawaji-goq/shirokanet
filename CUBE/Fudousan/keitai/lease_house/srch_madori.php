<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ｱｰｸﾌﾟﾗﾝ物件検索</title>

</head>
<?php
?>
<body>
<div align="center"><span class="style1"><font color="red">広さから探す</font></span></div>
<hr>
 <a href="/keitai/lease_house/list.php?madorinum=1&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">1Ｒ,Ｋ,ＤＫ,ＬＤＫ<br>
</a>
 <a href="/keitai/lease_house/list.php?madorinum=2&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">2ＤＫ,ＬＤＫ</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=3&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">3ＤＫ,ＬＤＫ</a><br> 
 <a href="/keitai/lease_house/list.php?madorinum=4&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">4ＤＫ以上</a><br>
<a href="/keitai/lease_house/list.php?madorinum=&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">指定無し</a><br>
<br>

・<a href="/keitai/lease_house/srch_cost.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >価格で絞る</a><br>
・<a href="/keitai/lease_house/srch_chiki.php?madorinum=<?php echo $madorinum;?>&madoritype=<?php echo $madoritype;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">地域で絞る</a> <br>
<br> 
<a href="/keitai/lease_house/list.php">戻る</a><br>
 <a href="/keitai/index.php">TOPへ戻る</a><br>
<hr>
<div align="center"></div>
</body>
</html>
