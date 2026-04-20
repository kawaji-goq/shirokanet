<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ｱｰｸﾌﾟﾗﾝ物件検索</title>

</head>

<body>
<div align="center"><span class="style1">価格帯から探す</span></div>
<hr>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=0&hicost=3&chiiki=<?php echo $chiiki;?>" accesskey="1"> 3万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=3&hicost=4&chiiki=<?php echo $chiiki;?>" accesskey="2"> 3万円～4万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=4&hicost=5&chiiki=<?php echo $chiiki;?>" accesskey="3">4万円～5万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=5&hicost=6&chiiki=<?php echo $chiiki;?>" accesskey="4">5万円～6万円未満</a><br> 
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=6&hicost=7&chiiki=<?php echo $chiiki;?>" accesskey="5">6万円～7万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=7>&hicost=8&chiiki=<?php echo $chiiki;?>" accesskey="6">7万円～8万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=8&hicost=9&chiiki=<?php echo $chiiki;?>" accesskey="7">8万円～9万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=9&hicost=10&chiiki=<?php echo $chiiki;?>" accesskey="8">9万円～10万円未満</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=10&hicost=&chiiki=<?php echo $chiiki;?>" accesskey="9">10万円以上</a><br>
 <a href="/keitai/lease_house/list.php?madorinum=<?php echo $madorinum;?>&lowcost=&hicost=&chiiki=<?php echo $chiiki;?>" accesskey="0">指定無し</a><br>


<form name="form1" method="get" action="/keitai/lease_house/list.php">
  <select name="cowcost" id="cowcost">
  	<option value="0" selected>下限なし</option>
    <option value="4">4万円</option>
    <option value="5">5万円</option>
    <option value="6">6万円</option>
    <option value="7">7万円</option>
    <option value="8">8万円</option>
    <option value="9">9万円</option>
    <option value="10">10万円</option>
  </select>
以上<br>
<select name="hicost" id="hicost">
  <option selected>上限なし</option>
  <option value="5">5万円</option>
  <option value="6">6万円</option>
  <option value="7">7万円</option>
  <option value="8">8万円</option>
  <option value="9">9万円</option>
  <option value="10">10万円</option>
  <option value="12">12万円</option>
  <option value="14">14万円</option>
  <option value="16">16万円</option>
  <option value="20">20万円</option>
</select>
以下<br>
<br>
<input type="submit" name="Submit" value="検索開始">
<input type="hidden" name="hiddenField">
<input type="hidden" name="hiddenField">
<input type="hidden" name="hiddenField">
<input type="hidden" name="hiddenField">
</form>
<p>・<a href="/keitai/lease_house/srch_madori.php?madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >広さで絞る</a><br>
	・<a href="/keitai/lease_house/srch_cost.php?madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >価格で絞る</a><br>
・<a href="/keitai/lease_house/srch_chiki.php?madorinum=<?php echo $madorinum;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>">地域で絞る</a> </p>
<p><a href="/keitai/lease_house/list.php">戻る</a><br>
		
<a href="/keitai/index.php">TOPへ戻る</a><br>
</p>
<hr>
<div align="center"></div>
</body>
</html>
