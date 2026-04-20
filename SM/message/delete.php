<?php
$countsql="select count(message_id) as countnum from message_readlogs group by member_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}
$messagelist=$dbobj->GetList($sql);
$countsql="select count(message_id) as countnum from message_readlogs group by member_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status = 1";
$countreaddata=$dbobj->GetData($countsql);
if($countreaddata["countnum"]==NULL) {
	$countreaddata["countnum"]=0;
}

$countsql="select count(message_id) as countnum from message group by master_id having master_id = ".$logindata["member_id"];
$countsenddata=$dbobj->GetData($countsql);
if($countsenddata["countnum"]==NULL) {
	$countsenddata["countnum"]=0;
}
if($_REQUEST["delmessage"]=="このメッセージを削除する"){
	$sql="delete from message where message_id = ".$_REQUEST["message_id"];
	$dbobj->Query($sql);
	$sql2="delete from message_readlogs where message_id = ".$_REQUEST["message_id"];
	$dbobj->Query($sql2);
	$sql3="delete from message_logs where sled_id = ".$_REQUEST["message_id"];
	$dbobj->Query($sql3);
?>
<script language="javascript">
location.replace("?PID=message_sendbox");
</script>
<?php
}
$messql="select * from message where message_id = ".$_REQUEST["message_id"];
$messagedata=$dbobj->GetData($messql);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title>無題ドキュメント</title>
</head>

<body>
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_message.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">お知らせ削除</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="220" valign="top">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                            <tr>
                                <td>
                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td><strong>メッセージBOX</strong></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                            <td><a href="?PID=message">未読（<?php echo $countunreaddata["countnum"] ?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=message_readbox">既読（<?php echo $countreaddata["countnum"] ?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=message_sendbox">送信済み（<?php echo $countsenddata["countnum"];?>）</a></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td><a href="?PID=mes_add">新しいメッセージの作成</a></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                
                <tr>
                    <td bgcolor="#DCDCFF">
                        <form name="form1" method="post" action="">
                            <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                                <?php
																												$messql="select * from message inner join message_logs on message.message_id=message_logs.sled_id where sled_id = ".$_REQUEST["message_id"]." order by senddate,sendtime";
																													$meslist=$dbobj->GetList($messql);
																													for($j=0;$meslist[$j]["message_id"]!=NULL;$j++) {
																												if($j==0) {
																												?>
                                <tr>
                                    <td height="40" bgcolor="#EFF6FF">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#EFF6FF">
                                            <tr>
                                                <td><font color="#333333" class="sledtitle"><?php echo $meslist[$j]["title"];?></font></td>
                                                <td>
                                                    <div align="right"></div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div align="right"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>送信先　
                                        <?php
																																	$sql="select * from member where member_id =".$messagelist[$i]["member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>
                                        <?php echo str_replace("-",".",$meslist[$j]["senddate"]);?>　<?php echo str_replace("-",".",$meslist[$j]["sendtime"]);?></td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                            <tr>
                                                <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["message"])?>&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <div align="right"></div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
																												}
																												else {
																												?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                                            <tr>
                                                <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment"><?php echo nl2br($meslist[$j]["comment"]);?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
																												}
													}
																											?>
                                <tr>
                                    <td bgcolor="#FFFFFF">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <input name="delmessage" type="submit" id="delmessage" value="このメッセージを削除する">
                                        <input name="message_id" type="hidden" id="message_id" value="<?php echo $_REQUEST["message_id"];?>">
                                    </td>
                                </tr>
                            </table>
                                                </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
</body>
</html>
