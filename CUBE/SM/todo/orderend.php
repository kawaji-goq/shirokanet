<?php

if($_GET["pmode"]=="logdel") {
	$sql="delete from todo_logs where log_id = ".$_REQUEST["delid"];
	$dbobj->Query($sql);
	?>
	<script language="javascript">
	location.replace("?PID=todo_orderendbox");
	</script>
	<?php
}

$sql="select * from todo inner join member on member.member_id = todo.to_member_id where from_member_id = ".$logindata["member_id"]."  and to_member_id<>".$logindata["member_id"]." "."and status = 10 order by status,hopedate,id desc";
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

$countsql="select * from todo where to_member_id=".$logindata["member_id"]." and status = 10";
$countenddata["countnum"]=$dbobj->Count($countsql);
if($countenddata["countnum"]==NULL) {
	$countenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]."  and status <> 10";
$countorderunenddata["countnum"]=$dbobj->Count($countsql);
if($countorderunenddata["countnum"]==NULL) {
	$countorderunenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and to_member_id<>".$logindata["member_id"]." and status = 10";
$countorderenddata["countnum"]=$dbobj->Count($countsql);
if($countorderenddata["countnum"]==NULL) {
	$countorderenddata["countnum"]=0;
}


?>
<script type="text/JavaScript">
<!--

function delchk(id) {
	res=confirm("削除してもよろしいですか？");
	if(res) {
		location.replace("?PID=todo_endbox&pmode=logdel&delid="+id);
	}
}
//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2" id="bbs">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">未完了TODO </td>
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
                    <td height="25" bgcolor="#DCDCFF">
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><strong>TODO一覧</strong></td>
                                <form name="form1" method="post" action="">
                                    <td>
                                        <div align="right"></div>
                                    </td>
                                </form>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" bgcolor="#FFFFFF">
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tr>
                                <td width="38%" nowrap bgcolor="#ececec">タイトル</td>
                                <td width="21%" nowrap bgcolor="#ececec">
                                    <p>依頼先</p>                                </td>
                                <td width="20%" nowrap bgcolor="#ececec">終了予定</td>
                                <td width="20%" nowrap bgcolor="#ececec">依頼期限</td>
                                <td width="8%" nowrap bgcolor="#ececec">
                                    <div align="left">状態</div>
                                    <div align="center"></div>                                </td>
                                <td width="13%" nowrap bgcolor="#ececec">
                                    <div align="center">削除</div>                                </td>
                            </tr>
                            <?php
																												for($i=0;$todolist[$i]["id"]!=NULL;$i++) {
																												
																												

$plan_date=$todolist[$i]["plan_date"];

$to_day=date("Y-m-d");


$count_date=strtotime($to_day)-strtotime($plan_date);
$hope_count_date = (strtotime($to_day)-strtotime($todolist[$i]["hopedate"]))/(24*60*60);

if($todolist[$i]["status"]==1) {
$color="009900";
	
}
else if($count_date>=0&&$plan_date!=""){
$color="ff0000";
	
}
else{
$color="3366ff";
}																												
																												?>
                            <tr>
                                <td bgcolor="#FFFFFF"><a href="#<?php echo $todolist[$i]["title"];?>"><strong><font color="#<?php echo $color;?>"><?php echo $todolist[$i]["title"];
																
																
																
																?>
                                  <?php if($todolist[$i]["status"]==1) {?>
                                <font color='red'><strong>  New!</strong></font>
                                  <?php } ?>
                                  <?php 
																	
																		
																		if($count_date>0){
																			echo "<font color='red'><strong>(+".$count_date/(60*60*24)."日)</strong></font>";
																		}
																		else if($count_date==0&&$plan_date!="") {
																				echo "<font color='red'><strong>(今日)</strong></font>";
																		}
																		else if($count_date/(60*60*24)==-1){
																			echo "<font color='red'><strong>(明日)</strong></font>";
																		}
																		?>
                                  <?php 
																?>
                              </font></strong></a></td>
                                <td bgcolor="#FFFFFF"><?php
																																echo $todolist[$i]["member_name"];
																																?>	</td>
                                <td bgcolor="#FFFFFF"><?php echo str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["plan_date"]));?></td>
                                <td bgcolor="#FFFFFF"><?php 
							  if($todolist[$i]["hopedate"]!=""){
							  if($hope_count_date>=0){
							  echo '<font color = "red"><strong>'.str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["hopedate"]))."</strong></font>";
							  }
							  else{
							  echo str_replace("-",".",str_replace("00:00:00","",$todolist[$i]["hopedate"]));
							  }
							  }?></td>
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
                                <td bgcolor="#FFFFFF">
                                    <div align="center"><a href="?PID=todo_del&id=<?php echo $todolist[$i]["id"] ?>"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" width="16" height="20" border="0"></a></div>                                </td>
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
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <table  border="0" cellpadding="5" cellspacing="5" bgcolor="#EFF6FF" class="sledtitle">
                                                    <tr>
                                                        <td><font color="#333333" class="sledtitle"><?php echo $meslist[$j]["title"];?> </font>
                                                                <?php if($todolist[$i]["status"]==1) {?>
                                                                <strong><font color="#FF0000">New!</font></strong>
                                                                <?php } ?>
                                                        </td>
                                                        <td><font color="#333333"><span class="">期限　<?php echo str_replace("-",".",str_replace("00:00:00","",	$meslist[$j]["hopedate"]));?></span></font>
                                                                <div align="right"></div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <div align="right"><a href="?PID=todo_res&todo_id=<?php echo $meslist[$j]["id"];?>"><img src="/GW/img/changestatus.gif" width="76" height="23" border="0"></a></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align="right"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>依頼先 　
                                    <?php
																																	$sql="select * from member where member_id =".$meslist[$j]["to_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>
                                    　 <?php echo str_replace("-",".",$meslist[$j]["registdate"]);?></td>
                            </tr>
                            
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["comment"])?>&nbsp;</td>
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
																																								<?php
																																								if($meslist[$j]["comment"]!=NULL) {
																																								?>
                                        <tr>
                                            <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment">
                                            <?php echo nl2br($meslist[$j]["comment"]);?></td>
                                        </tr>
																																								<?php
																																								}
																																								?><?php
																																								if($meslist[$j]["member_id"]==$logindata["member_id"]) {
																																								?>
                                        <tr>
                                            <td colspan="2" bgcolor="#FFFFFF" class="comment">
                                                <div align="right"><a href="#" onClick="delchk(<?php echo $meslist[$j]["log_id"] ?>)"><img src="http://siteadmin.itcube.ne.jp/gw/img/trashbox.gif" alt="この書き込みを削除する" width="16" height="20" border="0"></a></div>
                                            </td>
                                        </tr>	<?php
																																								}
																																								?>
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
