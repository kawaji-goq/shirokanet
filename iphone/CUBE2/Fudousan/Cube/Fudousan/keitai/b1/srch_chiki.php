<?php

//include "Cube/Fudousan/config.php";
include "ITC/modules.php";
//include $_SERVER["DOCUMENT_ROOT"]."/config.php";
include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
include  "ITC/keitai.php";

$agenttype=($_SERVER['HTTP_USER_AGENT']);

mb_internal_encoding("SJIS");

	if($usedb==NULL||$usedb=="") {
		$usedb="postgresql";
	}
	
	$dbobj=Cube_DB :: UseDB($usedb);	
	
	if($dbname!=NULL&&$dbname!="") {
			$dbobj->name=$dbname;
	}
	else {
		$dbobj->name=str_replace("www.","",$_SERVER["HTTP_HOST"]);
	}
	
	if($usedb=="mysql") {
			$dbobj->user="admin";
			$dbobj->pass="itc7310";
	}
$dbobj->Connect();

$re1obj=new Keitai_RealEstate($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>物件検索</title>
</head>

<body>
<?php
include "../template/header.php";
?><div align="center" class="style1"><font color="red"><?php echo $Emoji["SEARCH"];?>地域物件検索ﾒﾆｭｰ</font></div>
<hr>
<!-- 地域リスト -->
<?php
												$arealist=$dbobj->GetList("select * from re_area order by turn");
												for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++) {
												?>
													<a href="/keitai/b1/list.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $arealist[$areai]["area_id"];?>"><?php echo mb_convert_encoding($arealist[$areai]["area_name"],"SJIS","EUC-JP");?></a><br>
													<?php
												}
												?><a href="/keitai/b1/list.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=">指定無し</a><br><br>
													<!-- 物件リスト -->
<!--  絞込みメニュー -->
・ <a href="/keitai/b1/srch_madori.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >広さで絞る</a><br>
・ <a href="/keitai/b1/srch_cost.php?madori=<?php echo $madori;?>&lowcost=<?php echo $lowcost;?>&hicost=<?php echo $hicost;?>&chiiki=<?php echo $chiiki;?>" >価格で絞る</a><br>
<a href="/keitai/b1/list.php">戻る</a><br>
<a href="/keitai/index.php">TOPへ戻る</a><br>
<?php
include "../template/footer.php";
?>
</body>
</html>
