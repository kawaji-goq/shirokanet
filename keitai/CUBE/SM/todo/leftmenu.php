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
                                                        <td><strong><?php echo $logindata["member_name"];?>¤µ¤ó¤ÎTODO</strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                                    <tr>
                                                        <td><a href="?PID=todo">Ì¤´°Î»¡Ê<?php echo $countunreaddata["countnum"] ?>¡Ë</a></td>
                                                    </tr>
                                                    <tr>
                                                    		<td><a href="?PID=todo_endbox">´°Î»¡Ê<?php echo $countenddata["countnum"];?>¡Ë</a></td>
                                           		  </tr>
                                                    <tr>
                                                    		<td>&nbsp;</td>
                                           		  </tr>
																												<?php
																												$todo_cate_list=$dbobj->GetList("select * from todo_cate where to_member_id = ".$logindata["member_id"]);
																												
																												
																												
																												?>
                                                                                                                <tr>
                                                                                                                  <td><a href="?PID=todo">Á´¤Æ</a></td>
                                                                                                                </tr>
<?php
for($i=0;count($todo_cate_list)>$i;$i++){
?><tr>
                                                    		<td><a href="?PID=todo&cate_id=<?php echo $todo_cate_list[$i]["cate_id"];?>"><?php echo $todo_cate_list[$i]["cate_name"];?></a>¡¡(<?php echo $todo_cate_list[$i]["all_count"]-$todo_cate_list[$i]["over_count"];?>/<?php echo (int)$todo_cate_list[$i]["all_count"]?>)&nbsp; <?php 
																												
																												if($todo_cate_list[$i]["fin_time"]!=""){
																													if($todo_cate_list[$i]["fin_time"]<time()){
																														echo '<font color="red">'.date("Y.m.d",$todo_cate_list[$i]["fin_time"])."</font>";
																													}
																													else{
																														echo date("Y.m.d",$todo_cate_list[$i]["fin_time"]);
																													}
																												}
																												?></td>
                                           		  </tr>
																												<?php
																												}
																												?>
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
                                                        <td><strong>°ÍÍê¤·¤¿TODO</strong></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#FFFFFF">
                                                <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                                    
                                                    <tr>
                                                        <td><a href="?PID=todo_orderunendbox">Ì¤´°Î»¡Ê<?php echo $countorderunenddata["countnum"] ?>¡Ë</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="?PID=todo_orderendbox">´°Î»¡Ê<?php echo $countorderenddata["countnum"];?>¡Ë</a></td>
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
            				<td><a href="?PID=todo_cate_reg"><img src="/GW/img/regist_todo_cate.gif" width="142" height="24" border="0" /></a></td>
			  </tr>
            		<tr>
            				<td><a href="?PID=todo_add"><img src="/GW/img/regist_todo.gif" width="142" height="24" border="0" /></a></td>
            				</tr>
         		</table>
				<?php
				/*
				?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
?>