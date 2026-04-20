<?php
$countsql="select count(todo_id) as countnum from todo_readlogs group by member_id,todo_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}
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

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and status <> 10";
$countorderunenddata["countnum"]=$dbobj->Count($countsql);
if($countorderunenddata["countnum"]==NULL) {
	$countorderunenddata["countnum"]=0;
}

$countsql="select * from todo where from_member_id=".$logindata["member_id"]." and status = 10";
$countorderenddata["countnum"]=$dbobj->Count($countsql);
if($countorderenddata["countnum"]==NULL) {
	$countorderenddata["countnum"]=0;
}



if($_REQUEST["deltodo"]=="TODO､・・ｹ､・){
	$sql="delete from todo where id = ".$_REQUEST["id"];
	$dbobj->Query($sql);
//	$sql2="delete from todo_readlogs where todo_id = ".$_REQUEST["todo_id"];
//	$dbobj->Query($sql2);
	$sql3="delete from todo_logs where sled_id = ".$_REQUEST["id"];
	$dbobj->Query($sql3);
?>
<script language="javascript">
history.go(-2);
//location.replace("?PID=todo");
</script>
<?php
}
$messql="select * from todo where id = ".$_REQUEST["id"];
$tododata=$dbobj->GetData($messql);

?>
<div id="bbs">
<table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
    
    <tr>
        <td colspan="2">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td >
                        <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                            <tr>
                                <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                                <td width="96%" class="title">TODOｺ・・/td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td width="220" valign="top">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                                        <tr>
                                            <td>
                                                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><strong><?php echo $logindata["member_name"];?>､ｵ､ﾎTODO</strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                                    <tr>
                                                        <td><a href="?PID=todo">ﾌ､ｴｰﾎｻ｡ﾊ<?php echo $countunreaddata["countnum"] ?>｡ﾋ</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="?PID=todo_endbox">ｴｰﾎｻ｡ﾊ<?php echo $countenddata["countnum"];?>｡ﾋ</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td>
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                                        <tr>
                                            <td>
                                                <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><strong>ｰﾍﾍ熙ｷ､ｿTODO</strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                                    <tr>
                                                        <td><a href="?PID=todo_orderunendbox">ﾌ､ｴｰﾎｻ｡ﾊ<?php echo $countorderunenddata["countnum"] ?>｡ﾋ</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="?PID=todo_orderendbox">ｴｰﾎｻ｡ﾊ<?php echo $countorderenddata["countnum"];?>｡ﾋ</a></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table width="100%" border="0" cellspacing="3" cellpadding="3">
            		<tr>
            				<td><a href="?PID=todo_cate_reg"><img src="/GW/img/regist_todo.gif" width="142" height="24" border="0" /></a></td>
            				</tr>
            		<tr>
            				<td><a href="?PID=todo_add"><img src="/GW/img/regist_todo.gif" width="142" height="24" border="0" /></a></td>
            				</tr>
         		</table></td>
        <td valign="top">
            <table width="98%"  border="0" align="center" cellpadding="3" cellspacing="0">
                
                <tr>
                        <form name="form1" method="post" action="">
                    <td bgcolor="#DCDCFF">
                        <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                            <?php
																												$messql="select * from todo inner join todo_logs on todo.id=todo_logs.sled_id where todo.id = ".$_REQUEST["id"]." order by writetime";
																													$meslist=$dbobj->GetList($messql);
																													for($j=0;$meslist[$j]["id"]!=NULL;$j++) {
																												if($j==0) {
																												?>
                            <tr>
                                <td height="40" bgcolor="#EFF6FF">
                                    <table  border="0" cellpadding="5" cellspacing="5" bgcolor="#EFF6FF">
                                        <tr>
                                            <td><?php echo $meslist[$j]["title"];?></font></td>
                                            <td>
                                                <div align="right"></div>
                                                <div align="right"></div>
                                            </td>
                                        </tr>
                                    </table>
                                    <div align="right"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>ｰﾍﾍ・・｡｡
                                    <?php
																																	$sql="select * from member where member_id =".$meslist[$j]["to_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>
                                </td>
                            </tr>
                            <tr>
                                <td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>"></a><a href="index.php?PID=add_log&sled_id=<?php echo $sleddata[$topi]["sled_id"];?>&res_id=1"></a><span class="comment">ｴ・ﾂ｡｡<?php echo $meslist[$j]["hopedate"];?></span></td>
                            </tr>
                            <tr>
                                <td><span class="comment">ｰﾍﾍ・・｡｡
                                    <?php
																																	$sql="select * from member where member_id =".$meslist[$j]["from_member_id"];
																																	$mdata=$dbobj->GetData($sql);

																																echo $mdata["member_name"];
																																?>
                                    <?php echo str_replace("-",".",$meslist[$j]["registdate"]);?></span></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF">
                                    <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3">
                                        <tr>
                                            <td colspan="2" class="comment"><?php echo nl2br($meslist[$j]["comment"])?>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div align="right"><a href="?PID=todo_res&todo_id=<?php echo $meslist[$j]["id"];?>"><img src="/CUBE_IMG/btn_reply_s_over.gif" width="76" height="23" border="0"></a> </div>
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
                                            <td colspan="2" bgcolor="#FFFFFF" class="comment">ｾﾖ｡ｧ
                                                <?php 
																																switch($meslist[$j]["status"]) {
																																 case 1:
																																		echo "ﾌ､ｳﾎﾇｧ";
																																		break;
																																 case 2:
																																		echo "ｳﾎﾇｧｺﾑ";
																																		break;
																																		case 5:
																																		echo "ｺ鋐ﾈﾃ・;
																																		break;
																																	case 10:
																																		echo "ｴｰﾎｻ";
																																	break;
																																}	?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="200%" colspan="2" bgcolor="#FFFFFF" class="comment"> <br>
                                                    <?php echo nl2br($meslist[$j]["comment"]);?></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                             <?php
																												}
													}
																											?>
                           <tr>
                                <td bgcolor="#FFFFFF">
                                    <input name="deltodo" type="submit" id="deltodo" value="TODO､・・ｹ､・>
                                    <input type="button" name="Submit" value="ﾌ皃・ onClick="history.back()">
                                </td>
                            </tr>
                        </table>
                    </td>
                        </form>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="2">&nbsp;</td>
    </tr>
</table>
</div>