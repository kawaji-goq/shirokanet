<?php 
include_once("../master/config.php");
include("../FCKeditor/fckeditor.php");
include "./login.php";
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script language="javascript">

function back_toppage() {
	location.replace("index.php");
}

function data_correct() {
	document.shiken_correct_form.PROCCESS.value="";
	document.shiken_correct_form.submit();
}

</script>
<TITLE>山口宅地建物取引業協会 岩国支部</TITLE>
</head>
<body><?php 
switch($_POST["mode"]) {
	case "addition":
		include "./kaiin/addition.php";
		break;
	case "correction":
		include "./kaiin/correction.php";
		break;
	case "delete":
		include "./kaiin/delete.php";
		break;
	case "list":
		include "./kaiin/list.php";
		break;
	default:
		include "./kaiin/list.php";
		break;
}
?>
</body>
</html>
