<?php
$sql="select * from message inner join message_readlogs on message.message_id = message_readlogs.message_id where master_id = ".$logindata["member_id"]." "." order by senddate desc,sendtime desc";
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
                    <td bgcolor="#DCDCFF"><strong>送信済みメッセージ一覧</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="38%" nowrap bgcolor="#ececec">タイトル</td>
                                <td width="21%" nowrap bgcolor="#ececec">送信先</td>
                                <td width="7%" nowrap bgcolor="#ececec">
                                    <div align="center">状態</div>
                                </td>
                                <td width="26%" nowrap bgcolor="#ececec">送信日時</td>
                                <td width="7%" nowrap bgcolor="#ececec">
                                    <div align="center">編集</div>
                                </td>
                                <td width="8%" nowrap bgcolor="#ececec">
                                    <div align="center">削除</div>
                                </td>
                            </tr>
																												<?php
																												for($i=0;$messagelist[$i]["message_id"]!=NULL;$i++) {
																												?>
            <tr>
                                <td bgcolor="#FFFFFF"><?php echo $messagelist[$i]["title"];?></td>
                                <td bgcolor="#FFFFFF"><?php
																																	$sql="select * from member where member_id =".$messagelist[$i]["member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>	</td>
                                <td bgcolor="#FFFFFF">
                                    <div align="center">
                                        <?php 
																																				switch($messagelist[$i]["read_status"]) {
																																					case 0:
																																						echo "未確認";
																																						break;
																																						case 1:
																																						echo "確認済";
																																						break;
																																						default:
																																							echo "";
																																							break;
																																				} ?>
                                    </div>
                                </td>
                                <td bgcolor="#FFFFFF"><?php echo date("Y.m.d",strtotime($messagelist[$i]["senddate"]));?>　<?php echo date("H:i",strtotime($messagelist[$i]["sendtime"]));?></td>
                                <td bgcolor="#FFFFFF">
                                    <div align="center"><a href="?PID=mes_up&message_id=<?php echo $messagelist[$i]["message_id"];?>"> <img src="img/template/bbs/edit.gif" width="15" height="16" border="0"></a></div>
                                </td>
                                <td bgcolor="#FFFFFF">
                                    <div align="center"><a href="?PID=message_del&message_id=<?php echo $messagelist[$i]["message_id"] ?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div>
                                </td>
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
                                <td>送信先　<?php
																																	$sql="select * from member where member_id =".$messagelist[$i]["member_id"];
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
                                                <div align="right"><a href="?PID=mes_up&message_id=<?php echo $meslist[$j]["message_id"];?>"><img src="img/template/bbs/rep.gif" width="76" height="23" border="0"></a> <a href="?PID=message_del&message_id=<?php echo $meslist[$j]["message_id"];?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div>
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
                                            <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment"><?php echo nl2br($meslist[$j]["comment"]);?><br><div>
                                                <div align="right">確認日時：<?php echo $meslist[$j]["writetime"];?></div>
                                            </div>
                                            </td>
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
