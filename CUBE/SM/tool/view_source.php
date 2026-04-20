<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>ソース表示</title>
<style>
body{
margin:0px;
padding:0px;
}
</style>
</head>

<body>
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
								<td>
												<textarea name="textarea" cols="100" rows="50"><?php echo str_replace("\\\"","\"",str_replace("<br>","\n",str_replace("<p>","",str_replace("</p>","",$_REQUEST["source"]))));?></textarea>
								</td>
				</tr>
</table>
</body>
</html>
