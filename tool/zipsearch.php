<?php
header("Content-type: text/html; charset=sjis");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis">
<title>郵便番号検索</title>
<script language="javascript">
function lone() {
	window.focus();
}
function add_return(frm) {
		opener.contact_form.address.value=frm;
		window.close();
}
</script>
</head>

<body onLoad="lone()">
<form name="form1" method="post" action="">
<?php
if($_GET["zipcode"]!=NULL) {

	$dbhandle=@pg_connect("host=localhost dbname=common user=goq password=itc2011");
	pg_set_client_encoding($dbhandle,"SJIS");
	$zipcode=str_replace("\"","",$_GET["zipcode"]);
	$zipcode=str_replace(";","",$_GET["zipcode"]);
	$zipcode=str_replace("'","",$_GET["zipcode"]);
	$zipcode=@str_replace("-","",$zipcode);
	$sql="select * from zipcode where zipcode = '".$zipcode."'";
	$result=@pg_query($dbhandle,$sql);
	if($result) {
		$numrows=@pg_num_rows($result);
		if($numrows!=0) {?>入力する住所を選択してください。<br>
	<?php
			$rows=0;
			while($rows<$numrows) {
				$data[$rows]=@pg_fetch_array($result,$rows);
				?>
<input name="sel_address" type="radio" value="" onClick="add_return('<?php echo $data[$rows]["pref"].$data[$rows]["address1"].$data[$rows]["address2"];?>')">
				<?php echo $data[$rows]["pref"].$data[$rows]["address1"].$data[$rows]["address2"];?><br>
				<?php
				$rows++;
			}
		}
		else {
			exit("郵便番号を検索できませんでした。");
		}
	}
	else {
		exit("検索に失敗しました。");
	}
	
}
else {
	exit("このページは表示できません。");
}
?>
                <br>
                <br>
                <input type="button" name="Submit" value="閉じる" onClick="window.close()">
</form>
<map name="Map3"><area shape="rect" coords="78,12,250,31" href="http://itcube.jp" target="_blank"></map><script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
</body>
</html>
