<?php
$inssql="select * from member order by turn ";
$memberlist=$dbobj->GetList($inssql);
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
		<tr>
				<td width="4%"><img src="/GW/img/template/icon_message.jpg" width="40" height="42"></td>
				<td width="96%" class="title">お知らせ</td>
		</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
				<td>&nbsp;</td>
		</tr>
</table>
<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
		<tr>
				<td width="18%" bgcolor="#DCDCFF">名前</td>
				<td width="6%" bgcolor="#DCDCFF">
				    <div align="center">伝言メモ</div>
				</td>
				<td width="52%" bgcolor="#DCDCFF">現在の予定</td>
				<td width="24%" bgcolor="#DCDCFF">連絡先</td>
		</tr>
<?php
for($i=0;$memberlist[$i]["member_id"]!=NULL;$i++) {
?>		<tr>
				<td bgcolor="#FFFFFF"><?php echo $memberlist[$i]["member_name"]; ?></td>
				<td align="center" valign="middle" bgcolor="#FFFFFF">
				    <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="50%">
                    <div align="center"><a href="?PID=mes_add&member_id=<?php echo $memberlist[$i]["member_id"];?>"><img src="/GW/img/telmemosicon.jpg" width="15" height="15" border="0"></a></div>
                </td>
                <td width="50%">
                    <div align="center"><img src="/GW/img/telmemo2.jpg" width="15" height="15"></div>
                </td>
            </tr>
        </table>
				</td>
				<td bgcolor="#FFFFFF"><?php 
				
				$today=date("Y-m-d",time());
				$nowtime=date("H:i:s",time());
				
				$sql="select schedule.*,schedule_master.* from schedule inner join schedule_master on ".
						 "schedule_master.schedule_id = schedule.schedule_id where ".
						 "schedule_master.member_id=".$memberlist[$i]["member_id"]." and sdate <= '".$today."' and  fdate >= '".$today."' and ".
						 "stime <= '".$nowtime."' and ftime >= '".$nowtime."'";
				$schelist=$dbobj->GetList($sql);
				//print_r($schelist);
				for($j=0;$schelist[$j]["schedule_id"];$j++) {
				?><a href="?PID=sche_up&sche_id=<?php echo $schelist[$j]["schedule_id"] ?>">
				<?php
					if($j==0) {
						echo $schelist[$j]["title"];
					}
					else {
						echo "<br>".$schelist[$j]["title"];
						
					}
					?>
					</a>
					<?php
				}			
				?>&nbsp;</td>
				<td bgcolor="#FFFFFF"><?php echo $memberlist[$i]["k_tel"]; ?></td>
		</tr>
<?php
}
?>
</table>
</body>
</html>
