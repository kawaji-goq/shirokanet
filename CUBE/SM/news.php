<?php 
include_once("../master/config.php");
//include("../FCKeditor/fckeditor.php");
include "./login.php";

if($_REQUEST["btm_newsupdate"]=="更新する") {
	$delsql="delete from news";
	$result=pg_query($dbhandle,$delsql);
	if($_REQUEST["new_news"]!=NULL) {
		$insql="insert into news values(1,'".$_REQUEST["new_news"]."','".$_REQUEST["new_url"]."')";
	$result=pg_query($dbhandle,$insql);
	}
	$rows=0;
	while($_REQUEST["news_id"][$rows]!=NULL) {
		if($_REQUEST["old_news"][$rows]!=NULL) {
			$sql="insert into news values(".($rows+2).",'".$_REQUEST["old_news"][$rows]."','".$_REQUEST["old_url"][$rows]."')";
			$result=pg_query($dbhandle,$sql);
		}
		$rows++;
	}
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script language="javascript">
function back_toppage() {
	location.replace("index.php");
}
function data_correct() {
	document.index_correct_form.PROCCESS.value="";
	document.index_correct_form.submit();
}
</script>
<TITLE>山口宅地建物取引業協会 岩国支部</TITLE>
</head>
<body>
<table width="740" border="0" align="center" cellpadding="1" cellspacing="1">
	<form name="index_correct_form" method="POST" action="">
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0">
                	<tr>
                		<td width="45"><img src="/members/img/news_sic.gif" width="45" height="40"></td>
                		<td>
                			<div id="tree"><span class="top">News管理</span>　<span class="gt">>></span>　<span class="sub">News更新</span></div>
               			</td>
               		</tr>
               	</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellspacing="1" cellpadding="1">
					<tr>
						<td><strong> </strong>
							<table width="100%" border="0" cellpadding="2" cellspacing="2">
                            	<tr>
                            		<td width="45"><img src="/members/img/takken_iwakuni_mark.gif" width="69" height="50"></td>
                            		<td><strong>新規追加 </strong>&nbsp;</td>
                           		</tr>
                           	</table>
						</td>
					</tr>
					<tr>
						<td>
							<table width="100%" border="0" cellspacing="2" cellpadding="2">
								<tr>
									<td width="22%" background="/members/img/filemenu_bg.gif">
										<div align="right"><strong>インフォメーション </strong></div>
									</td>
									<td width="78%">
										<input name="new_news" type="text" id="new_news" size="80">
									</td>
								</tr>
								<tr>
									<td background="/members/img/filemenu_bg.gif">
										<div align="right"><strong>リンク先</strong></div>
									</td>
									<td>
										<input name="new_url" type="text" id="new_url" size="80">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
					//必要な処理を実行
$sql="select * from news order by news_id";
$result=pg_query($dbhandle,$sql);
$resultnumrows=pg_num_rows($result);
if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data=pg_fetch_array($result,$rows);
?>
					<?php
		$rows++;
	}
}
?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
					<tr>
						<td> <strong> </strong>
							<table width="100%" border="0" cellpadding="2" cellspacing="2">
                            	<tr>
                            		<td width="45"><img src="/members/img/takken_iwakuni_mark.gif" width="69" height="50"></td>
                            		<td><strong>修正</strong>&nbsp;</td>
                           		</tr>
                           	</table> 
						</td>
					</tr>
					<?php
					//必要な処理を実行
$sql="select * from news order by news_id";
$result=pg_query($dbhandle,$sql);
$resultnumrows=pg_num_rows($result);
if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data=pg_fetch_array($result,$rows);
?>
					<tr>
						<td bgcolor="#FFFFFF">
							<table width="100%" border="0" cellspacing="2" cellpadding="2">
								<tr>
									<td width="22%" background="/members/img/filemenu_bg.gif">
										<div align="right"><strong>インフォメーション </strong></div>
									</td>
									<td width="78%">
										<input name="old_news[]" type="text" id="old_news[]" value="<?php echo $data["text"];?>" size="80">
										<input name="news_id[]" type="hidden" id="news_id[]" value="<?php echo $data["news_id"];?>">
									</td>
								</tr>
								<tr>
									<td background="/members/img/filemenu_bg.gif">
										<div align="right"><strong>リンク先</strong></div>
									</td>
									<td>
										<input name="old_url[]" type="text" id="old_url[]" value="<?php echo $data["url"];?>" size="80">
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
		$rows++;
	}
}
?>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<input name="btm_newsupdate" type="submit" id="btm_newsupdate" value="更新する">
				<input type="button" name="Submit" value="戻る" onClick="location.replace('index.php')">
			</td>
		</tr>
	</form>
</table>
</body>
</html>
