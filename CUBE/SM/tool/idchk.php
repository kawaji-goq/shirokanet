<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>IDチェック</title>
</head>
<body>
<table width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
	<tr>
		<td height="175">
			<div align="center">				<?php
				include "../../master/config.php";
				
				$sql="select * from bukken_number where bukken_number = '".$_REQUEST["id"]."'";
				$result=pg_query($dbhandle,$sql);
				$resultnumrows=pg_num_rows($result);
				$mes="";
				
				if($resultnumrows==0) {
					$mes = "このIDは使用できます。";
				}
				else {
					$mes = "<font color=\"#FF0000\">このIDは既に使用されています。</font>";
				}
				echo $mes;
				
				?>
				<br>
				<br>
				<input type="button" name="Submit" value="閉じる" onClick="window.close()">
			</div>
		</td>
	</tr>
</table>
</body>
</html>
