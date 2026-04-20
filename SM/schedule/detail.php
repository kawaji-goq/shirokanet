<?php 
$scheobj=new Schedule($dbobj);
$schedata=$scheobj->GetMemData($_REQUEST["sche_id"]);
$schedata=$schedata[0];
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<div id="files">
	<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
		<tr>
				<td align="left" valign="middle">&nbsp; </td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                	
                	<tr>
                		<td width="100" bgcolor="#ececec">
                			<div align="right"><strong>開始日時</strong></div>
                		</td>
               		    <td bgcolor="#FFFFFF"><?php echo $schedata["syear"]."年".$schedata["smonth"]."月".$schedata["sday"]."日 ".$schedata["stime"];?></td>
                	</tr>
                	<tr>
                		<td width="100" bgcolor="#ececec">
                			<div align="right"><strong>終了日時</strong></div>
                		</td>
                		<td bgcolor="#FFFFFF"><?php echo $schedata["fyear"]."年".$schedata["fmonth"]."月".$schedata["fday"]."日 ".$schedata["ftime"];?></td>
               		</tr>
                	<tr>
                		<td valign="top" bgcolor="#ececec">
                			<div align="right"><strong>タイトル</strong></div>
                		</td>
                		<td bgcolor="#FFFFFF"><?php echo nl2br($schedata["title"]);?></td>
               		</tr>
                	<tr>
                		<td valign="top" bgcolor="#ececec">
                			<div align="right"><strong>表示</strong></div>
                		</td>
                		<td bgcolor="#FFFFFF">
                			<?php 
						switch($schedata["view_type"]) {
							case 0:
								echo "会員用";
								break;
							case 1:
								echo "全てに表示";
								break;
								
						}?>
                		</td>
               		</tr>
                	<tr>
                		<td width="100" valign="top" bgcolor="#ececec">
                			<div align="right"><strong>内容</strong></div>
                		</td>
               		    <td bgcolor="#FFFFFF"><?php echo nl2br($schedata["comment"]);?></td>
                	</tr>
               	</table>
				<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
						<tr>
								<td colspan="2">&nbsp; </td>
						</tr>
						<tr>
								<td colspan="2"><a href="#" onClick="history.back()">リストへ戻る</a></td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<div id="calender">				</div>
			</td>
		</tr>
	</table>
</div>
