<?php 
/* 
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php
*/

$gobj=new Group($dbobj);

if($_POST["btmgroup_delete"]=="選択したグループを削除する") {
	$delrows=0;
	while($_POST["group_id"][$delrows]!=NULL) {
		if($_POST["delchk"][$delrows]==1) {
			$gobj->Delete($_POST["group_id"][$delrows]);
		}
		$delrows++;
	}
}

$gdata=$gobj->GetList(" turn ");

?>
<link href="/admin/style.css" rel="stylesheet" type="text/css">
<br>
<div id="files">
<table width="700"  border="0" align="left" cellpadding="1" cellspacing="1">
	<form name="form1" method="post" action="">
		<tr>
			<td>
				<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
					<tr>
						<th width="52" align="left" bgcolor="#ECECEC">削除</th>
						<th width="559" align="left" bgcolor="#ECECEC">
							<div align="left">グループ名</div>
						</th>
						<th width="63" bgcolor="#ECECEC">
								<div align="center">修正</div>
						</th>
					</tr>
					<?php 
				$rows=0;
				while($gdata[$rows]["group_id"]!=NULL) {
				?>
					<tr>
						<td width="52" align="left" bgcolor="#FFFFFF">
							<div align="center">
								<input name="delchk[<?php echo $rows;?>]" type="checkbox" id="delchk[<?php echo $rows;?>]" value="1">
							    <input name="group_id[<?php echo $rows;?>]" type="hidden" id="group_id[<?php echo $rows;?>]" value="<?php echo $gdata[$rows]["group_id"]?>">
							</div>
						</td>
						<td align="left" bgcolor="#FFFFFF"> <a href="index.php?PID=group_up&group_id=<?php echo $gdata[$rows]["group_id"]?>"><?php echo $gdata[$rows]["group_name"]?></a> </td>
						<td bgcolor="#FFFFFF">
							<div align="center">
								<input type="button" name="Submit" value="修正する" onClick="window.location.href='index.php?PID=group_up&group_id=<?php echo $gdata[$rows]["group_id"]?>'">
							</div>
						</td>
					</tr>
					
					<?php 
					$rows++;
				}
				?>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td align="left">
				<input type="button" name="Submit" value="新規グループ登録" onClick="window.location.href='index.php?PID=group_add'">
				<input name="btmgroup_delete" type="submit" id="btmgroup_delete" value="選択したグループを削除する">
				<input name="btmgroup_update" type="button" id="btmgroup_update" value="戻る" onClick="window.location.href='index.php'">
			</td>
		</tr>
	</form>
</table>
</div>