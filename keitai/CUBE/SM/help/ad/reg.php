<?php
session_start(); 
mb_language("japanese");
mb_internal_encoding("euc-jp");
$dbname="itcube_admin";
$usedb="postgresql";
$language="japanese";
$charcode="euc-jp";
include "ITC/modules.php";
$dbobj=Cube_DB :: UseDB($usedb);
$dbobj->name=$dbname;
$dbobj->Connect();

$catelist=$dbobj->GetList("select * from help_cate order by turn");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<title>無題ドキュメント</title>
</head>
<body>
<p>
		<select name="cate_id">
		<?php
		for($i=0;$catelist[$i]["cate_id"]!=NULL;$i++) {
		?><option value="<?php echo $catelist[$i]["cate_id"] ?>"><?php echo $catelist[$i]["cate_name"]; ?></option>
		<?php
		}
		?>
		</select>
		<br />
		<input name="title" type="text" id="title" size="60" />
		<br />
		<textarea name="comm" cols="100" rows="50" id="comm"></textarea>
</p>
<p>&nbsp;</p>
</body>
</html>
