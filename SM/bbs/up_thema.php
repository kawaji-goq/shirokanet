<?php 

$bbsobj=new Cube_BBS($dbobj);

$updata=$bbsobj->Get_UpSledList(10);
$updata2=$bbsobj->get_NoReadList($logindata["member_id"]);
$sleddata=$bbsobj->Get_SledData($_REQUEST["sled_id"]);
$logdata=$bbsobj->Get_SelLog($_REQUEST["log_id"]);

?>
<script language="javascript">

function delchk(frm) {
	alerttxt="";
	alertchk=0;
	if(alertchk==0) {
		res=confirm("この内容で更新を送信してよろしいですか？");
		if(res) {
			frm.mode.value="up_logs";
			frm.submit();
		}
	}
	else {
		alert(alerttxt);
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp"/>
<div id="bbs">
    <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="2">
        <tr>
            <td colspan="2">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                    <tr>
                        <td width="4%"><img src="/GW/img/template/icon_bbs.jpg" width="40" height="42"></td>
                        <td width="96%" class="title"><font color="#333333">BBS書き込み削除</font></td>
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
                                    <td bgcolor="#DCDCFF"><strong>テーマ一覧
                                        <?php $updata=$bbsobj->Get_TehmaList2(10);  ?>
                                        </strong></td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#FFFFFF">
                                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                            <?php 
				$rows=0;
				while($updata[$rows]["sled_id"]!=NULL) {
				?>
                                            <tr>
                                                <td bgcolor="#FFFFFF"><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"><?php echo $updata[$rows]["sled_name"];?></a><a href="index.php?PID=bbs_topics&sled_id=<?php echo $updata[$rows]["sled_id"] ?>"> (
                                                    <?php
										$themamax=$dbobj->GetData("select count(sled_id) as maxcount from bbs_sled where parents=".$updata[$rows]["sled_id"]);							
																	 echo $themamax["maxcount"] ?>
                                                    ) </a>
                                                    <div align="right"></div>
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
                                    <td valign="top" bgcolor="#FFFFFF"><a href="index.php?PID=add_theme"><img src="/GW/img/template/addthema.jpg" border="0"></a><br>
                                        <a href="index.php?PID=bbs_allsled"><img src="/GW/img/template/display_allthema.jpg" width="169" height="23" border="0"></a></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
                                <tr>
                                    <td>
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><strong><span class="subtitle">最近の書き込み</span></strong></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php 
				$rows=0;
				while($updata2[$rows]["sled_id"]!=NULL) {
				$bbsreadstatus[$rows]=$bbsobj->get_ReadCheck($updata2[$rows]["sled_id"],$logindata["member_id"]);
				?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <table width="100%"  border="0" cellspacing="1" cellpadding="1">
                                            <tr>
                                                <td><?php echo str_replace("-",".",$updata2[$rows]["last_update"]); ?>
                                                    <?php
																if($bbsreadstatus[$rows]["read_status"]!=1) {
																?>
                                                    <font color="#FF0000"><strong>New!</strong></font>
                                                    <?php
																}
																?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="index.php?PID=bbs_sled&sled_id=<?php echo $updata2[$rows]["sled_id"] ?>"><?php echo $updata2[$rows]["sled_name"] ?></a>(<?php echo $updata2[$rows]["maxcount"] ?>)</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php 
					$rows++;
				}
				?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
            <td valign="top">
                <table width="98%" border="0" align="center" cellpadding="3" cellspacing="0">
                    <tr>
                        <td valign="top" bgcolor="#DCDCFF">
                            <table width="100%"  border="0" align="center" cellpadding="2" cellspacing="1">
                                <form name="delform" method="post" action="">
                                    <tr>
                                        <td height="40" bgcolor="#EFF6FF"> <font color="#333333" class="sledtitle">
                                            <input name="sled_name" type="text" id="sled_name" value="<?php echo $sleddata["sled_name"];?>" style="width:50%;">
                                            </font></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $sleddata["master_name"]?><?php echo str_replace("-",".",$sleddata["registdate"]);?></td>
                                    </tr>
                                    <?php 
								?>
                                    <?php 
							if($_REQUEST["mode"]!="up_logs") {
							?>
                                    <tr>
                                        <td bgcolor="#FFFFFF">
                                            <input type="button" name="Submit" value="更新する" onClick="delchk(this.form)">
                                            <input type="button" name="Submit" value="戻る" onClick="history.back()">
                                            <input name="mode" type="hidden" id="mode">
                                            <input name="sled_id" type="hidden" id="sled_id" value="<?php echo $sleddata["sled_id"];?>">
                                            <input name="writer" type="hidden" id="writer" value="<?php echo $logdata["writer"];?>">
                                        </td>
                                    </tr>
                                </form>
                                <?php 
							}
							else {
								$bbsobj->up_Theme($_POST);
								
							?>
                                <tr>
                                    <td bgcolor="#FFFFFF">
                                        <script language="javascript">location.replace("?PID=bbs_allsled");</script>
                                    </td>
                                </tr>
                                <?php
							}
							?>
                                <?php
							?>
                                <?php 
				?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp; </td>
        </tr>
    </table>
</div>
<?php 

?>
