<?php 
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
  