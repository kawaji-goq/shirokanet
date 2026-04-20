<?php
$sql="select * from todo inner join member on member.member_id = todo.from_member_id where to_member_id = ".$logindata["member_id"]." "."and status =5 order by registdate desc";
$todolist=$dbobj->GetList($sql);

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status <> 10";
$countunreaddata["countnum"]=$dbobj->Count($countsql);

if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status = 5";
$countdoingdata["countnum"]=$dbobj->Count($countsql);

if($countdoingdata["countnum"]==NULL) {
	$countdoingdata["countnum"]=0;
}

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]." and status = 10";
$countenddata["countnum"]=$dbobj->Count($countsql);
if($countenddata["countnum"]==NULL) {
	$countenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]." and status <> 10";
$countorderunenddata["countnum"]=$dbobj->Count($countsql);
if($countorderunenddata["countnum"]==NULL) {
	$countorderunenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]."  and status = 10";
$countorderenddata["countnum"]=$dbobj->Count($countsql);
if($countorderenddata["countnum"]==NULL) {
	$countorderenddata["countnum"]=0;
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
                                <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">作業中のTODO </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="220" valign="top"><?php
		
		include "leftmenu.php";
		?></td>
        <td valign="top">
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                <tr>
                    <td bgcolor="#DCDCFF"><strong>TODO一覧</strong></td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="38%" nowrap bgcolor="#ececec">タイトル</td>
                                <td width="21%" nowrap bgcolor="#ececec">依頼主</td>
                                <td width="26%" nowrap bgcolor="#ececec">期限</td>
                                <td nowrap bgcolor="#ececec">
                                    <div align="left">状態</div>
                                    <div align="center"></div>
                                </td>
                            </tr>
                            <?php
																												for($i=0;$todolist[$i]["id"]!=NULL;$i++) {
																												?>
                            <tr>
                                <td bgcolor="#FFFFFF"><?php echo $todolist[$i]["title"];?></td>
                                <td bgcolor="#FFFFFF"><?php
																																echo $todolist[$i]["member_name"];
																																?>	</td>
                                <td bgcolor="#FFFFFF"><?php echo str_replace("00:00:00","",$todolist[$i]["hopedate"]);?></td>
                                <td bgcolor="#FFFFFF"><?php 
																																switch($todolist[$i]["status"]) {
																																 case 1:
																																		echo "未確認";
																																		break;
																																 case 2:
																																		echo "確認済";
																																		break;
																																		case 5:
																																		echo "作業中";
																																		break;
																																	case 10:
																																		echo "完了";
																																	break;
																																}	?></td>
                            </tr>
                            <?php
																												}
																												?>
                        </table>
                    </td>
                </tr>
            </table>
            <?php
													for($i=0;$todolist[$i]["id"]!=NULL;$i++) {
													?>
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                            <?php
																												$messql="select * from todo inner join todo_logs on todo.id=todo_logs.sled_id where sled_id = ".$todolist[$i]["id"]." order by registdate";
																													$meslist=$dbobj->GetList($messql);
																													for($j=0;$meslist[$j]["id"]!=NULL;$j++) {
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
                                <td>依頼主　
                                <?php
																																	$sql="select * from member where member_id =".$meslist[$j]["from_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>　<?php echo str_replace("-",".",$meslist[$j]["registdate"]);?></td>
                            </tr>
                            <tr>
                                <td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"></a><a href="index.php?PID=add_log&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>&res_id=1"></a><span class="comment">期限　<?php echo $meslist[$j]["hopedate"];?></span></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["comment"])?>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div align="right"><a href="?PID=todo_res&todo_id=<?php echo $meslist[$j]["id"];?>"><img src="/GW/img/changestatus.gif" width="76" height="23" border="0"></a></div>
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
                                <td><span class="comment">
                                    <?php 
																																	$sql="select * from member where member_id =".$meslist[$j]["member_id"];
																																	$mdata=$dbobj->GetData($sql);
echo $mdata["member_name"];
																																												?>
　
<?php 
echo str_replace("-",".",$meslist[$j]["writetime"]);
																																												?>
                                </span></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF" class="comment">状態：
                                                <?php 
																																switch($meslist[$j]["status"]) {
																																 case 1:
																																		echo "未確認";
																																		break;
																																 case 2:
																																		echo "確認済";
																																		break;
																																		case 5:
																																		echo "作業中";
																																		break;
																																	case 10:
																																		echo "完了";
																																	break;
																																}	?>
</td>
                                        </tr>
                                        <tr>
                                            <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment"><br>
                                            <?php echo nl2br($meslist[$j]["comment"]);?></td>
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
