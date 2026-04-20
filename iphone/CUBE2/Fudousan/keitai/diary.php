<?php
include "../config.php";
include "../class/realestate_keitai.php";
include "../class/RailwayTracksStation_Keitai.php";
include "../class/keitai_diary.php";
mb_internal_encoding("SJIS");
pg_set_client_encoding($dbhandle,"SJIS");
if($pagenum==NULL) {
	$pagenum=1;
}
else if($pagenum<1) {
	$pagenum=1;
}
$page_limit=1;
$sql_limitter=" offset ".($pagenum-1)*$page_limit." limit ".$page_limit;
$sql="select * from shopmasters_diary order by write_date desc";
$result=pg_query($dbhandle,$sql.$sql_limitter);
$resultnumrows=pg_num_rows($result);
if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data[$rows]=pg_fetch_array($result);
		$rows++;
	}
}
$result2=pg_query($dbhandle,$sql);
$resultnumrows2=pg_num_rows($result2);
$max_page=ceil($resultnumrows2/$page_limit);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>ｱｰｸﾌﾟﾗﾝ物件検索</title>
</head>

<body>
<div align="center" class="style1">ｵｽｽﾒ＆最新情報</div>
<hr>
<div align="center"></div>
<div align="center">店長の日記</div>
<?php
$diary_rows=0;
while($data[$diary_rows][diary_id]!=NULL) {
?>
<br>
<strong><font color="#AB384A"><?php echo $data[$diary_rows][title]; ?></font></strong>
<font color="#000000">[</font><font color="#000000"><?php echo str_replace("-",".",$data[$diary_rows][write_date]) ?>]</font><br>
<span class="font14"><?php echo nl2br(mb_convert_kana(strip_tags($data[$diary_rows][comment]),"AKSHV","sjis")); ?></span>
<br>
	<?php
	$diary_rows++;
}
if($pagenum>1) {
	echo "　<a href=\"diary.php?pagenum=".($pagenum-1)."\">&lt;&lt;　前の日記</a>　<br>";
}
else {
	echo "　<font color=\"#CCCCCC\">&lt;&lt;　前の日記</font>　<br>";
}
$pagecount_rows=1;
while($max_page>=$pagecount_rows) {

	if($pagecount_rows!=$pagenum) {
		echo "<a href=\"diary.php?pagenum=".$pagecount_rows."\">".$pagecount_rows."</a>　";
	}
	else {
		echo "<font color=\"#FF0000\">".$pagecount_rows."</font>　";
	}
	
	$pagecount_rows++;
}	
if($max_page>$pagenum) {
	echo "<br><a href=\"diary.php?pagenum=".($pagenum+1)."\">次の日記　&gt;&gt;</a>　";
}
else {
	echo "<br><font color=\"#CCCCCC\">  次の日記　&gt;&gt;  </font>　";
}
?>

<br>
<br>

  <a href="/keitai/index.php">TOPへ戻る</a>
  <hr>
  <div align="center"></div>
<br>
<br>
</body>
</html>
