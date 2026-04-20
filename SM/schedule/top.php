<?php
$countsql="select count(message_id) as countnum from message_readlogs group by member_id,message_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}


?><script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>

<div id="calender">
    <table width="100%" border="0" cellspacing="1" cellpadding="3">
        <tr>
            <td>
                <table border="0" align="left" cellpadding="3" cellspacing="1">
                    <form name="form2" method="get" action="">
                        <tr>
                            <td width="18" valign="middle"><img src="/CUBE_IMG/search_icon.jpg" width="18" height="20"></td>
                            <td width="117" valign="middle"><strong>¥¹¥±¥¸¥å¡¼¥ë¸¡º÷</strong></td>
                            <td valign="middle" bgcolor="#FFFFFF">
                                <input name="keyword" type="text" id="keyword" value="<?php echo $_GET["keyword"];?>" size="40">
                                <input type="submit" name="Submit" value="¸¡º÷">
                                <input name="PID" type="hidden" id="PID" value="ScheduleSearch">
                                <input name="mode" type="hidden" id="mode" value="search">
                            </td>
                        </tr>
                    </form>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <?php
if($_REQUEST["scheview"]!=NULL) {
	$_SESSION["scheview"]=$_REQUEST["scheview"];
}

if($_GET["mem_id"]==NULL&&$_SESSION["sche_mid"]==NULL) {
	$_SESSION["sche_mid"]=$_SESSION["mem_id"];
	$_GET["mem_id"]=$_SESSION["mem_id"];
}
else if($_GET["mem_id"]!=NULL){
	$_SESSION["sche_mid"]=$_GET["mem_id"];
}
else {
	$_GET["mem_id"]=$_SESSION["sche_mid"];
}

$inssql="select * from member order by turn ";
$memberdata2=$dbobj->GetList($inssql);

if($_SESSION["scheview"]==1||$_SESSION["scheview"]==NULL){

/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<link href="../GW/style.css" rel="stylesheet" type="text/css">
<?php 
*/

if($_REQUEST["y"]==NULL) {
	$_REQUEST["y"]=date("Y",time());
}

if($_REQUEST["m"]==NULL) {
	$_REQUEST["m"]=date("m",time());
}


$scheobj=new Schedule($dbobj);
$calobj=new Calendar();

if($_GET["scheview"]!=NULL){
	$_SESSION["scheview"]=$_GET["scheview"];
}
else if($_SESSION["scheview"]==NULL){
	$_SESSION["scheview"]=1;
}


if($_REQUEST["sday"]==NULL&&$_SESSION["sday"]==NULL) {
	$sday=date("Y-m-d");
	$_SESSION["sday"]=$sday;
}
else if($_REQUEST["sday"]!=NULL) {
	$_SESSION["sday"]=$_REQUEST["sday"];
	$sday==$_REQUEST["sday"];
}
$sday=$_SESSION["sday"];


$spdate=explode("-",$sday);
$beforeweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]-7,$spdate[0]));
$yesterday=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]-1,$spdate[0]));
$tomorrow=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+1,$spdate[0]));
$nextweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+7,$spdate[0]));
$fday=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+6,$spdate[0]));
$caldata=$calobj->CreateOneWeek($sday,7,1);
$wday=$calobj->e_wday;
$inssql="select * from member where member_id <> ".$logindata["member_id"]." order by turn ";
$memberdata=$dbobj->GetList($inssql);

?>
                <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                        <td>
                            <div align="center"><strong><a href="index.php?PID=schedule&sday=<?php echo $beforeweek;?>"></a></strong>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <form name="form1" id="form1">
                                            <td width="250">
                                                <select name="scheview" onchange="MM_jumpMenu('parent',this,0)">
                                                    <option value="index.php?PID=schedule&amp;scheview=1"<?php if($_SESSION["scheview"]==1||$_SESSION["scheview"]==NULL) { echo "selected";}?>>½µ(Á´°÷)</option>
                                                    <?php
																				for($memi=0;$memberdata2[$memi]["member_id"]!=NULL;$memi++){
																				?>
                                                    <option value="index.php?PID=schedule&amp;scheview=2&amp;mem_id=<?php echo $memberdata2[$memi]["member_id"];?>"<?php if($_SESSION["sche_mid"]==$memberdata2[$memi]["member_id"]&&$_SESSION["scheview"]==2) { echo "selected";}?>><?php echo $memberdata2[$memi]["member_name"]; ?></option>
                                                    <?php 
																				}
																				?>
                                                </select>
                                            </td>
                                        </form>
                                        <td align="center" nowrap="nowrap">
                                            <div align="center"><strong>&nbsp;¥¹¥±¥¸¥å¡¼¥ë¡¡(<?php echo $sday;?>¡Á)¡¡ </strong></div>
                                        </td>
                                        <td width="250">
                                            <div align="right"><strong>
                                                <input type="button" name="Submit" value=" &lt;&lt; " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $beforeweek;?>'" />
                                                <a href="">
                                                <input type="button" name="Submit" value="  &lt;  " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $yesterday;?>'"  />
                                                <input type="submit" name="Submit" value="º£Æü" onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo date("Y-m-d");?>'" />
                                                <input type="button" name="Submit" value="  &gt;  " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $tomorrow;?>'"  />
                                                </a></strong><strong>
                                                <input type="button" name="Submit" value=" &gt;&gt; " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $nextweek;?>'" />
                                                </strong></div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <table width="100%"  border="0" align="center" cellpadding="5" cellspacing="1" class="tb_outline">
                                <?php 
					$rows=0;
					while($caldata[$rows][0]["day"]!=NULL) {
					?>
                                <tr align="center" class="title">
                                    <td<?php 
					switch($caldata[$rows][0]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>&nbsp;</td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][0]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][0]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][1]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][1]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][2]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][2]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][3]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][3]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][4]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][4]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][5]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][5]["ewday"];?> </div>
                                    </td>
                                    <td width="13%" height="30"<?php 
					switch($caldata[$rows][6]["wday"]) {
						case 0:
							echo " class=\"holiday\"";
							break;
							
						case 6:
							echo " class=\"satday\"";
							break;
						
						default:
							echo " class=\"nday\"";
							break;
					}
					?>>
                                        <div align="center"><?php echo $caldata[$rows][6]["ewday"];?> </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td valign="top" nowrap bgcolor="#FFFFFF" ><a href="index.php?PID=schedule&amp;mem_id=<?php echo $logindata["member_id"]?>"><?php echo $logindata["member_name"] ?></a><?php 
														if($countunreaddata["countnum"]!=0) {
														?><div align="right">
														<a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a>
														</div>
														<?php
														}
														?>		</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="90%" height="20" align="left" valign="top"><span class="day"><?php echo $caldata[$rows][0]["day"];?></span></td>
                                                <td width="10%" valign="top"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
																						unset($schedata);
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][0]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												$maxr4=0;
												
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}
														else {
															$a[$rows][0][$r4]=$schedata[$r2];
															$r4++;
														}				
													$r2++;
												}
												if($r4>$maxr4) {
													$maxr4=$r4;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][0]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?><div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div><?php
														}
														else if($countunreaddata["countnum"]!=0){
														?><div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
														<?php
														}
														?>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td height="20"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
                                                <td width="10%">
                                                    <div align="right"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></div>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][1]["eday"],$logindata["member_id"]);
												
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}
														else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][0][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][1][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][1][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][1][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][1]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
																						unset($schedata);
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][2]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][1][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][2][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][2][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][2][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][2]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][3]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][2][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][3][$r3]=$schedata[$r2];
																	$chk=1;
																	
																}
															}
															if($chk==0) {
																while($a[$rows][3][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][3][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][3]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][4]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"> <a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][3][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][4][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][4][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][4][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][4]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][5]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
												 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][4][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][5][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][5][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][5][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][5]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr align="left" valign="top">
                                                <td width="91%" height="20"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
                                                <td width="9%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][6]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												unset($schedata2);
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][5][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$chk=1;
																	$a[$rows][6][$r3]=$schedata[$r2];
																}
															}
															if($chk==0) {
																while($a[$rows][6][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][6][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][6]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                                <?php
										//print_r($a);
										$maxr4-=1;
								for($x=0;$x<=$maxr4;$x++) {
									for($y=0;$y<7;$y++) {
									if($a[$rows][$y][$x]["schedule_id"]==NULL) {
										$a[$rows][$y][$x]["schedule_id"]=0;
									}
									}
								}
								for($x=0;$x<=$maxr4;$x++) {
										$z=0;
										for($y=0;$y<7;$y++) {
											if($y==0) {
												if($a[$rows][$y][$x]["schedule_id"]!=0) {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
												}
												else {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]="";
												}
											}
											else if($a[$rows][$y][$x]["schedule_id"]==0&&$a[$rows][$y-1][$x]["schedule_id"]==0) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]==$a[$rows][$y-1][$x]["schedule_id"]) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]&&$a[$rows][$y][$x]["schedule_id"]!=0) {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]){
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]!=""&&$a[$rows][$y-1][$x]=="") {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
											}
											else {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
										}
										if($col[$rows][$x][0]["colspan"]!=NULL) {
										?>
                                <tr bgcolor="#FFFFFF">
                                    <?php 
										if($x==0){?>
                                    <td valign="top" rowspan="<?php echo $maxr4+1 ?>">¡¡</td>
                                    <?php
										}
												?>
                                    <?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["schedata"]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													else {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ecffec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													unset($col[$rows][$x][$z]);
												}
												?>
                                </tr>
                                <?php
										}
										}
										unset($a);												
					$rows++; 
					}?>
                                <?php
					$rows=0;
					while($caldata[$rows][0]["day"]!=NULL) {
																for($memrows=0;$memberdata[$memrows]["member_id"]!=NULL;$memrows++) {
																?>
                                <tr>
                                    <td valign="top" nowrap bgcolor="#FFFFFF"><a href="index.php?PID=schedule&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"]?>"><?php echo $memberdata[$memrows]["member_name"] ?></a></td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="90%" height="20" align="left" valign="top"> <span class="day"><?php echo $caldata[$rows][0]["day"];?> </span></td>
                                                <td width="10%" valign="top"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][0]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												$maxr4=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
														}
														else {
															$a[$rows][0][$r4]=$schedata[$r2];
															$r4++;
														}				
													$r2++;
												}
												if($r4>$maxr4) {
													$maxr4=$r4;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td height="20"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
                                                <td width="10%">
                                                    <div align="right"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></div>
                                                </td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][1]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][0][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][1][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][1][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][1][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][2]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}
																						else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][1][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][2][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][2][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][2][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][3]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][2][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][3][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][3][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][3][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][4]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][3][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][4][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][4][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][4][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr valign="top">
                                                <td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
                                                <td width="10%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][5]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}
																						else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][4][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][5][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][5][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][5][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="13%" height="75" valign="top" class="box">
                                        <table width="100%"  border="0" cellpadding="0" cellspacing="0">
                                            <tr align="left" valign="top">
                                                <td width="91%" height="20"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
                                                <td width="9%"><a href="#" onClick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
                                            </tr>
                                            <tr valign="top">
                                                <td colspan="2">
                                                    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                                        <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][6]["eday"],$memberdata[$memrows]["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                                        <tr>
                                                            <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                                <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                            </a></td>
                                                        </tr>
                                                        <tr>
                                                            <td height="5" valign="top"><span></span></td>
                                                        </tr>
                                                        <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][5][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][6][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][6][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][6][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <?php
								
										$maxr4-=1;
								for($x=0;$x<=$maxr4;$x++) {
									for($y=0;$y<7;$y++) {
										if($a[$rows][$y][$x]["schedule_id"]==NULL) {
											$a[$rows][$y][$x]["schedule_id"]=0;
										}
									}
								}
								for($x=0;$x<=$maxr4;$x++) {
										$z=0;
										for($y=0;$y<7;$y++) {
											if($y==0) {
												if($a[$rows][$y][$x]["schedule_id"]!=0) {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];	
												}
												else {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]="";
												}
											}
											else if($a[$rows][$y][$x]["schedule_id"]==0&&$a[$rows][$y-1][$x]["schedule_id"]==0) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]==$a[$rows][$y-1][$x]["schedule_id"]) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]&&$a[$rows][$y][$x]["schedule_id"]!=0) {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]){
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]!=""&&$a[$rows][$y-1][$x]=="") {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
											}
											else {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
										}
										if($col[$rows][$x][0]["colspan"]!=NULL) {
										?>
                                <tr bgcolor="#FFFFFF">
                                    <?php 
										if($x==0){?>
                                    <td valign="top" rowspan="<?php echo $maxr4+1 ?>">¡¡</td>
                                    <?php
										}
												?>
                                    <?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["schedata"]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													
													else {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ecffec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													unset($col[$rows][$x][$z]);									
												}
												?>
                                </tr>
                                <?php
										}
										}	
											unset($a);
											unset($col);			
										}
					
					$rows++; 
					}
					?>
                            </table>
                            <br />
                        </td>
                    </tr>
                </table>
                <?php
}
else if($_SESSION["scheview"]==2){
if($_REQUEST["y"]==NULL) {
	$_REQUEST["y"]=date("Y",time());
}

if($_REQUEST["m"]==NULL) {
	$_REQUEST["m"]=date("m",time());
}
$before=explode("-",date("Y-m",mktime(0,0,0,$_REQUEST["m"]-1,1,$_REQUEST["y"])));
$next=explode("-",date("Y-m",mktime(0,0,0,$_REQUEST["m"]+1,1,$_REQUEST["y"])));
$thismonth=explode("-",date("Y-m"));

if($_GET["mem_id"]==NULL) {
	$_GET["mem_id"]=$_SESSION["mem_id"];
}

$scheobj=new Schedule($dbobj);
$schedata=$scheobj->GetList($_REQUEST["y"],$_REQUEST["m"]);

$calobj=new Calendar();
$calobj->year=$_REQUEST["y"];
$calobj->month=$_REQUEST["m"];

$caldata=$calobj->Create(2);
$wday=$calobj->e_wday;
?>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <form name="form1" id="form1">
                            <td width="250">
                                <select name="scheview" onchange="MM_jumpMenu('parent',this,0)">
                                    <option value="index.php?PID=schedule&amp;scheview=1"<?php if($_SESSION["scheview"]==1||$_SESSION["scheview"]==NULL) { echo "selected";}?>>½µ(Á´°÷)</option>
                                    <?php
																				for($memi=0;$memberdata2[$memi]["member_id"]!=NULL;$memi++){
																				?>
                                    <option value="index.php?PID=schedule&amp;scheview=2&amp;mem_id=<?php echo $memberdata2[$memi]["member_id"];?>"<?php if($_SESSION["sche_mid"]==$memberdata2[$memi]["member_id"]&&$_SESSION["scheview"]==2) { echo "selected";}?>><?php echo $memberdata2[$memi]["member_name"]; ?></option>
                                    <?php 
																				}
																				?>
                                </select>
                            </td>
                        </form>
                        <td align="center" nowrap="nowrap">
                            <div align="center"><strong>&nbsp;¥¹¥±¥¸¥å¡¼¥ë¡¡(<?php echo $_REQUEST["y"]."Ç¯".$_REQUEST["m"]."·î";?>)¡¡ </strong></div>
                        </td>
                        <td width="250">
                            <div align="right"><strong>
                                <input type="button" name="Submit" value=" &lt;&lt; " onclick="window.location.href='index.php?PID=schedule&y=<?php echo $before[0];?>&m=<?php echo $before[1];?>'" />
                                <a href="">
                                <input type="submit" name="Submit" value="º£·î" onclick="window.location.href='index.php?PID=schedule&y=<?php echo $thismonth[0];?>&m=<?php echo $thismonth[1];?>'" />
                                </a></strong><strong>
                                <input type="button" name="Submit" value=" &gt;&gt; " onclick="window.location.href='index.php?PID=schedule&y=<?php echo $next[0];?>&m=<?php echo $next[1];?>'" />
                                </strong></div>
                        </td>
                    </tr>
                </table>
                <?php 
										if($_GET["mem_id"]==$_SESSION["mem_id"]) {
										?>
                <table width="100%"  border="0" align="center" cellpadding="5" cellspacing="1" class="tb_outline">
                    <tr align="center" class="title">
                        <td width="14%" align="center" valign="middle" class="holiday">
                            <div align="center"><?php echo $wday[0];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[1];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[2];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[3];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[4];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[5];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="satday">
                            <div align="center"><?php echo $wday[6];?> </div>
                        </td>
                    </tr>
                    <?php 
												$rows=0;
												while($caldata[$rows][0]["day"]!=NULL) {
												?>
                    <tr>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][0]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][0]["day"];?> </span></td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][0]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												$maxr4=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}
														else {
															$a[$rows][0][$r4]=$schedata[$r2];
															$r4++;
														}				
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][0]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][1]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
                                    <td width="10%" valign="top">
                                        <div align="right"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></div>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][1]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}
														else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][0][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][1][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][1][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][1][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][1]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][2]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][2]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][1][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][2][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][2][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][2][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][2]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][3]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][3]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][2][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][3][$r3]=$schedata[$r2];
																	$chk=1;
																	
																}
															}
															if($chk==0) {
																while($a[$rows][3][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][3][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][3]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][4]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][4]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"> <a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][3][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][4][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][4][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][4][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][4]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][5]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][5]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
												 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][4][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][5][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][5][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][5][$r4]=$schedata[$r2];
															}
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][5]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][6]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="91%" height="20" valign="top"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
                                    <td width="9%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][6]["eday"],$logindata["member_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
												$schedata2=$schedata[$r2];
												if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
														}								
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																if($a[$rows][5][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$chk=1;
																	$a[$rows][6][$r3]=$schedata[$r2];
																}
															}
															if($chk==0) {
																while($a[$rows][6][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][6][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,member_id having member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][6]["eday"]."'";
														$countunreaddata=$dbobj->GetData($countsql);
														if($countunreaddata["countnum"]==NULL) {
															$countunreaddata["countnum"]=0;
														}
														//echo $countunreaddata["minstatus"];
														//echo 	$countunreaddata["countnum"];
														if($countunreaddata["countnum"]!=0&&$countunreaddata["minstatus"]==0) {
														?>
                                        <div align="right"> <a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														else if($countunreaddata["countnum"]!=0){
														?>
                                        <div align="right"> <a href="?PID=message_readbox"><img src="img/template/oshirase_icon.jpg" width="18" height="16" border="0"></a> </div>
                                        <?php
														}
														?>
</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
										//print_r($a);
										$maxr4-=1;
										unset($col);
								for($x=0;$x<=$maxr4;$x++) {
									for($y=0;$y<7;$y++) {
									if($a[$rows][$y][$x]["schedule_id"]==NULL) {
										$a[$rows][$y][$x]["schedule_id"]=0;
									}
									}
								}
								for($x=0;$x<=$maxr4;$x++) {
										$z=0;
										for($y=0;$y<7;$y++) {
											if($y==0) {
												if($a[$rows][$y][$x]["schedule_id"]!=0) {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];	
												}
												else {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]="";
												}
											}
											else if($a[$rows][$y][$x]["schedule_id"]==0&&$a[$rows][$y-1][$x]["schedule_id"]==0) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]==$a[$rows][$y-1][$x]["schedule_id"]) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]&&$a[$rows][$y][$x]["schedule_id"]!=0) {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]){
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]!=""&&$a[$rows][$y-1][$x]=="") {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
											}
											else {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
										}
										if($col[$rows][$x][0]["colspan"]!=NULL) {
										?>
                    <tr>
                        <?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													else {
													}
													unset($col[$rows][$x][$z]["colspan"]);
												}
												?>
                    </tr>
                    <?php
										}
										}									
					$rows++; 
					}?>
                </table>
                <?php 
										}
										else {
										?>
                <table width="100%"  border="0" align="center" cellpadding="5" cellspacing="1" class="tb_outline">
                    <tr align="center" class="title">
                        <td width="14%" align="center" valign="middle" class="holiday">
                            <div align="center"><?php echo $wday[0];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[1];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[2];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[3];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[4];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="nday">
                            <div align="center"><?php echo $wday[5];?> </div>
                        </td>
                        <td width="14%" align="center" valign="middle" class="satday">
                            <div align="center"><?php echo $wday[6];?> </div>
                        </td>
                    </tr>
                    <?php 
												$rows=0;
												while($caldata[$rows][0]["day"]!=NULL) {
												?>
                    <tr>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][0]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][0]["day"];?> </span></td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>'"></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][0]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												$maxr4=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][0]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}
																						else {
															$a[$rows][0][$r4]=$schedata[$r2];
															$r4++;
														}				
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][1]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][1]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][1]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}
														else {
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][0][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][1][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][1][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][1][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][2]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][3]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][2]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}
																						else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][1][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][2][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][2][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][2][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][3]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][3]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][3]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][2][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][3][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][3][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][3][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][4]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_up&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>'"></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][4]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][4]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][3][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][4][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][4][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][4][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][5]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="90%" height="20" valign="top"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
                                    <td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>'"></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][5]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][5]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}
																						else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][4][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][5][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][5][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][5][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td width="14%" height="75" align="center" valign="top"<?php if($_REQUEST["m"]!=$caldata[$rows][6]["month"]) { echo " bgcolor=\"#f6f6f6\"";}else {echo " class=\"box\"";}?>>
                            <table width="100%"  border="0" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td width="91%" height="20" valign="top"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
                                    <td width="9%" valign="top"><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $_GET["mem_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" border="0" /></a><a href="#" onclick="window.location.href='index.php?sday=<?php echo $sday;?>&PID=sche_up&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>'"></a></td>
                                </tr>
                                <tr valign="top">
                                    <td colspan="2">
                                        <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                                            <?php 
												$schedata=$scheobj->Get_MyDayList($caldata[$rows][6]["eday"],$_GET["mem_id"]);
												$r2=0;
												$r4=0;
												$r5=0;
												while($schedata[$r2]["schedule_id"]!=NULL) {
													$schedata2=$schedata[$r2];
													if($schedata2["sche_type"]!=3) {
												?>
                                            <tr>
                                                <td valign="top"><a href="index.php?sday=<?php echo $sday;?>&PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
                                                    <?php 
													if($schedata2["sdate"]==$schedata2["fdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á".$schedata2["ftime"];
														}
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["sdate"]) {
														if($schedata2["stime"]==":") {
															echo "";
														}
														else {
															echo $schedata2["stime"]."¡Á";
														}
													
													}
													else if($caldata[$rows][6]["eday"]==$schedata2["fdate"]){
													
														if($schedata2["ftime"]==":") {
															echo "";
														}
														else {
																echo "¡Á".$schedata2["ftime"];
														}
													}
													
													 echo $schedata2["title"];?>
                                                    </a></td>
                                            </tr>
                                            <tr>
                                                <td height="5" valign="top"><span></span></td>
                                            </tr>
                                            <?php 
																						}else {
															
															$chk=0;
															for($r3=0;$r3<=$maxr4;$r3++) {
																
																if($a[$rows][5][$r3]["schedule_id"]==$schedata[$r2]["schedule_id"]) {
																	$a[$rows][6][$r3]=$schedata[$r2];
																	$chk=1;
																}
															}
															if($chk==0) {
																while($a[$rows][6][$r4]["schedule_id"]!=NULL) {
																	$r4++;
																}
																$a[$rows][6][$r4]=$schedata[$r2];
															}
															$r5++;
														}						
													$r2++;
												}
												if($r5>$maxr4) {
													$maxr4=$r5;
												}
												?>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php
										//print_r($a);
										$maxr4-=1;
										unset($col);
								for($x=0;$x<=$maxr4;$x++) {
									for($y=0;$y<7;$y++) {
									if($a[$rows][$y][$x]["schedule_id"]==NULL) {
										$a[$rows][$y][$x]["schedule_id"]=0;
									}
									}
								}
								for($x=0;$x<=$maxr4;$x++) {
										$z=0;
										for($y=0;$y<7;$y++) {
											if($y==0) {
												if($a[$rows][$y][$x]["schedule_id"]!=0) {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];	
												}
												else {
													$col[$rows][$x][$z]["colspan"]=1;
													$col[$rows][$x][$z]["schedata"]="";
												}
											}
											else if($a[$rows][$y][$x]["schedule_id"]==0&&$a[$rows][$y-1][$x]["schedule_id"]==0) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]==$a[$rows][$y-1][$x]["schedule_id"]) {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]&&$a[$rows][$y][$x]["schedule_id"]!=0) {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]["schedule_id"]!=$a[$rows][$y-1][$x]["schedule_id"]){
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
												$col[$rows][$x][$z]["schedata"]=$a[$rows][$y][$x];
											}
											else if($a[$rows][$y][$x]!=""&&$a[$rows][$y-1][$x]=="") {
												$z+=1;
												$col[$rows][$x][$z]["colspan"]=1;
											}
											else {
												$col[$rows][$x][$z]["colspan"]+=1;
											}
										}
										if($col[$rows][$x][0]["colspan"]!=NULL) {
										?>
                    <tr>
                        <?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["schedata"]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													else {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ecffec\"><a href=\"index.php?sday=<?php echo $sday;?>&PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
												}
												?>
                    </tr>
                    <?php
										}			
										}
										unset($col);
										unset($a);			
					$rows++; 
					}?>
                </table>
                <?php 
										}
										?>
                <table width="100%" border="0" cellspacing="0" cellpadding="10">
                    <tr>
                        <td><a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=1">1·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=2">2·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=3">3·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=4">4·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=5">5·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=6">6·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=7">7·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=8">8·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=9">9·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=10">10·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=11">11·î</a>¡¡¡¡<a href="?PID=schedule&y=<?php echo $_REQUEST["y"];?>&m=12">12·î</a></td>
                    </tr>
                </table>
                <?php
}

?>
            </td>
        </tr>
    </table>
</div>
