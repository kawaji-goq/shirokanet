<?php
$sql="select * from message inner join message_readlogs on message.message_id = message_readlogs.message_id where member_id = ".$logindata["member_id"]." and message_readlogs.read_status <> 1"." order by senddate desc,sendtime desc";
$messagelist=$dbobj->GetList($sql);
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

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_message.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">お知らせ</td>
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
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                <tr>
                    <td bgcolor="#DCDCFF"><strong>未読メッセージ一覧</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="38%" nowrap bgcolor="#ececec">タイトル</td>
                                <td width="21%" nowrap bgcolor="#ececec">送信者</td>
                                <td width="26%" nowrap bgcolor="#ececec">受信日時</td>
                                <td nowrap bgcolor="#ececec">
                                    <div align="center"></div>
                                    <div align="center"></div>
                                </td>
                            </tr>
                            <?php
																												for($i=0;$messagelist[$i]["message_id"]!=NULL;$i++) {
																												?>
                            <tr>
                                <td bgcolor="#FFFFFF"><?php echo $messagelist[$i]["title"];?></td>
                                <td bgcolor="#FFFFFF"><?php
																																	$sql="select * from member where member_id =".$messagelist[$i]["master_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>	</td>
                                <td bgcolor="#FFFFFF"><?php echo $messagelist[$i]["senddate"];?>　<?php echo $messagelist[$i]["sendtime"];?></td>
                                <td bgcolor="#FFFFFF"></td>
                            </tr>
                            <?php
																												}
																												?>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
																												for($i=0;$messagelist[$i]["message_id"]!=NULL;$i++) {
																												?>
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                            <?php
																												$messql="select * from message inner join message_logs on message.message_id=message_logs.sled_id where sled_id = ".$messagelist[$i]["message_id"]." order by senddate,sendtime";
																													$meslist=$dbobj->GetList($messql);
																													for($j=0;$meslist[$j]["message_id"]!=NULL;$j++) {
																												if($j==0) {
																												?>
                            <tr>
                                <td height="40" bgcolor="#EFF6FF">
                                    <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#EFF6FF">
                                        <tr>
                                            <td><?php echo $meslist[$j]["title"];?></font></td>
                                            <td>
                                                <div align="right"><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"></a><a href="index.php?PID=add_log&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>&res_id=1"></a></div>
                                                <div align="right"></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align="right"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>送信者　<?php
																																	$sql="select * from member where member_id =".$meslist[$j]["master_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>　<?php echo str_replace("-",".",$meslist[$j]["senddate"]);?>　<?php echo str_replace("-",".",$meslist[$j]["sendtime"]);?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["message"])?>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div align="right"><a href="?PID=message_res&message_id=<?php echo $meslist[$j]["message_id"];?>"><img src="/CUBE_IMG/btn_reply_s_over.gif" width="76" height="23" border="0"></a> </div>
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
                        </table>
                    </td>
                </tr>
            </table>
            <?php 
												}
												?>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
