<?php
//require_once("XML/RSS.php");
//$rss =& new XML_RSS("http://pheedo.nikkeibp.co.jp/f/nikkeibp_news_index");
//$rss->parse();
//$rssnews=$rss->getItems();
$messql="select message.*,message_readlogs.*,member.* from message inner join message_readlogs on message_readlogs.message_id =message.message_id inner join member on member.member_id = message.master_id where master_id = ".$logindata["member_id"]." or message_readlogs.member_id = ".$logindata["member_id"]."  order by senddate desc";
$mesdata=$dbobj->GetList($messql);
$scheobj=new Schedule($dbobj);
$bbsobj=new Cube_BBS($dbobj);
$upbbsdata=$bbsobj->get_NoReadList($logindata["member_id"]);
$calobj=new Calendar();
$vupdata=$adminobj->GetList("select vup_data.*,vup_cate.* from vup_data inner join vup_cate on vup_data.cate_id=vup_cate.cate_id  where  vup_data.view_chk =1 and vup_data.cate_id =1 order by rdate desc limit 5");
$vupdata2=$adminobj->GetList("select vup_data.*,vup_cate.* from vup_data inner join vup_cate on vup_data.cate_id=vup_cate.cate_id  where  vup_data.view_chk =1 and vup_data.cate_id =2 order by rdate desc limit 5");

if($_GET["scheview"]!=NULL){
	$_SESSION["scheview"]=$_GET["scheview"];
}
else if($_SESSION["scheview"]==NULL){
	$_SESSION["scheview"]=1;
}

if($_REQUEST["sday"]==NULL) {
	$sday=date("Y-m-d");
}
else  {
	$sday=$_REQUEST["sday"];
}

$spdate=explode("-",$sday);
$beforeweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]-7,$spdate[0]));
$nextweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+7,$spdate[0]));

$caldata=$calobj->CreateOneWeek($sday,7,1);
$wday=$calobj->e_wday;
$inssql="select * from member where member_id <> ".$logindata["member_id"]." order by turn ";
$memberdata=$dbobj->GetList($inssql);

$countsql="select count(message_id) as countnum from message_readlogs group by member_id,message_id,member_id,read_status having member_id=".$logindata["member_id"]." and read_status <> 1";
$countunreaddata=$dbobj->GetData($countsql);
if($countunreaddata["countnum"]==NULL) {
	$countunreaddata["countnum"]=0;
}
$sql="select * from message inner join message_readlogs on message.message_id = message_readlogs.message_id where member_id = ".$logindata["member_id"]." and message_readlogs.read_status <> 1"." order by senddate desc,sendtime desc";
$messagelist=$dbobj->GetList($sql);

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<table width="100%" border="0" align="center" cellpadding="10" cellspacing="0"> 
  <tr> 
    <td colspan="2"> <div id="calender">
    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
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
      </table>
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

if($_REQUEST["sday"]==NULL) {
	$sday=date("Y-m-d");
}
else  {
	$sday=$_REQUEST["sday"];
}

$spdate=explode("-",$sday);
$beforeweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]-7,$spdate[0]));
$yesterday=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]-1,$spdate[0]));
$tomorrow=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+1,$spdate[0]));
$nextweek=date("Y-m-d",mktime(0,0,0,$spdate[1],$spdate[2]+7,$spdate[0]));

$caldata=$calobj->CreateOneWeek($sday,7,1);
$wday=$calobj->e_wday;
$inssql="select * from member where member_id <> ".$logindata["member_id"]." order by turn ";
$memberdata=$dbobj->GetList($inssql);

?>
				<table width="100%" border="0" cellpadding="1" cellspacing="1">
						<tr>
								<td>
										<div align="center"><strong><a href="index.php?PID=schedule&amp;sday=<?php echo $beforeweek;?>"></a></strong>
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
																<tr>
																		<form name="form1" id="form1">
																				<td width="250">
																						<select name="scheview" onchange="MM_jumpMenu('parent',this,0)">
																								<option value="index.php?PID=schedule&amp;scheview=1" selected="selected">½µ(Á´°÷)</option>
																								<?php
																				for($memi=0;$memberdata2[$memi]["member_id"]!=NULL;$memi++){
																				?>
																								<option value="index.php?PID=schedule&amp;scheview=2&amp;mem_id=<?php echo $memberdata2[$memi]["member_id"];?>"><?php echo $memberdata2[$memi]["member_name"]; ?></option>
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
																						<input type="button" name="Submit" value="  &lt;  " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $yesterday;?>'" />
																						<input type="submit" name="Submit" value="º£Æü" onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo date("Y-m-d");?>'" />
																						<input type="button" name="Submit" value="  &gt;  " onclick="window.location.href='index.php?PID=schedule&amp;sday=<?php echo $tomorrow;?>'" />
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
														<td valign="top" nowrap bgcolor="#FFFFFF" ><a href="index.php?PID=schedule&amp;mem_id=<?php echo $logindata["member_id"]?>"><?php echo $logindata["member_name"] ?></a><br>
														<?php 
														if($countunreaddata["countnum"]!=0) {
														?><div align="right">
														<a href="?PID=message"><img src="img/template/oshirasenew_icon.jpg" width="18" height="16" border="0"></a>
														</div>
														<?php
														}
														?>										</td>
														<td width="13%" height="75" valign="top" class="box">
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr>
																				<td width="90%" height="20" align="left" valign="top"><span class="day"><?php echo $caldata[$rows][0]["day"];?></span></td>
																				<td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																		<tr valign="top">
																		    <td colspan="2">
																		        <?php 
														$countsql="select count(logs_id) as countnum,min(read_status) as minstatus from message_readlogs inner join message on message_readlogs.message_id = message.message_id group by message.senddate,message_readlogs.member_id having message_readlogs.member_id=".$logindata["member_id"]." and senddate = '".$caldata[$rows][0]["eday"]."'";
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
														<td width="13%" height="75" valign="top" class="box">
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td height="20"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
																				<td width="10%">
																						<div align="right"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></div>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"> <a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
												if($r4>$maxr4) {
													$maxr4=$r4;
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr align="left" valign="top">
																				<td width="91%" height="20"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
																				<td width="9%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $logindata["member_id"]?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
												<tr>
														<?php 
										if($x==0){?>
														<td valign="top" class="box" rowspan="<?php echo $maxr4+1 ?>">¡¡</td>
														<?php
										}
												?>
														<?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["schedata"]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													else {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ecffec\"><a href=\"index.php?PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
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
														<td valign="top" nowrap bgcolor="#FFFFFF"><a href="index.php?PID=schedule&amp;mem_id=<?php echo $logindata["member_id"]?>"><?php echo $memberdata[$memrows]["member_name"] ?></a></td>
														<td width="13%" height="75" valign="top" class="box">
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr>
																				<td width="90%" height="20" align="left" valign="top"> <span class="day"><?php echo $caldata[$rows][0]["day"];?> </span></td>
																				<td width="10%" valign="top"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][0]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td height="20"> <span class="day"><?php echo $caldata[$rows][1]["day"];?></span> </td>
																				<td width="10%">
																						<div align="right"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][1]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></div>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][2]["day"];?></span> </td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][2]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"><span class="day"> <?php echo $caldata[$rows][3]["day"];?></span> </td>
																				<td width="10%"><a href="#" onClick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][3]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"><span class="day"><?php echo $caldata[$rows][4]["day"];?></span></td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][4]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr valign="top">
																				<td width="90%" height="20"> <span class="day"><?php echo $caldata[$rows][5]["day"];?></span> </td>
																				<td width="10%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][5]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="box">
																		<tr align="left" valign="top">
																				<td width="91%" height="20"><span class="day"> <?php echo $caldata[$rows][6]["day"];?></span></td>
																				<td width="9%"><a href="#" onclick="window.location.href='index.php?PID=sche_add&amp;rdate=<?php echo $caldata[$rows][6]["eday"];?>&amp;mem_id=<?php echo $memberdata[$memrows]["member_id"];?>'"><img src="/GW/img/sche_ssic.gif" width="21" height="15" border="0" /></a></td>
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
																										<td valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>">
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
																										<td height="5" valign="top"><a href="index.php?PID=sche_up<?php echo $schedata2["sche_type"] ?>&amp;sche_id=<?php echo $schedata2["schedule_id"] ?>"></a> </td>
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
												<tr>
														<?php 
										if($x==0){?>
														<td valign="top" class="box" rowspan="<?php echo $maxr4+1 ?>">¡¡</td>
														<?php
										}
												?>
														<?php
												for($z=0;$col[$rows][$x][$z]["colspan"]!=NULL;$z++) {
													if($col[$rows][$x][$z]["schedata"]["schedule_id"]==0) {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ffffff\">¡¡</td>";
													}
													else if($col[$rows][$x][$z]["schedata"]["view_type"]==99){
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ececec\"><a href=\"index.php?PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
													}
													
													else {
														echo "<td colspan=\"".$col[$rows][$x][$z]["colspan"]."\" bgcolor=\"#ecffec\"><a href=\"index.php?PID=sche_up".$col[$rows][$x][$z]["schedata"]["sche_type"]."&sche_id=".$col[$rows][$x][$z]["schedata"]["schedule_id"]."\">".$col[$rows][$x][$z]["schedata"]["title"]."</a></td>";
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
				</div>
    </td> 
  </tr> 
  <tr> 
    <td width="50%" valign="top"> 
    		<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
								<td><?php if($debagtype==1) {?>
										<table width="100%" border="0" cellpadding="1" cellspacing="1">
												<tr>
														<td width="" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><strong>&nbsp;</strong><img src="http://siteadmin.itcube.ne.jp/img/0707icon/banner_info.jpg" width="174" height="65"></td>
												</tr>
												<tr>
														<td>
																<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																		<?php
			$rows=0;
			while($messagelist[$rows]["message_id"]!=NULL) {
			?>
																		<tr>
																				<td width="100" valign="top"><?php echo $messagelist[$rows]["senddate"] ?>&nbsp;</td>
																				<td valign="top"><a href="index.php?PID=message&message_id=<?php echo $messagelist[$rows]["message_id"] ?>"><?php echo $messagelist[$rows]["title"] ?></a>&nbsp;</td>
																		</tr>
																		<?php
				$rows++;
			}
			?>
																</table>
																<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
																		<tr>
																				<td>
																						<div align="right">¡¦¡¦¡¦ <a href="index.php?PID=message">more</a> </div>
																				</td>
																		</tr>
																</table>
														</td>
												</tr>
										</table>
										<?php
										}
										?>
										<table width="100%" border="0" cellpadding="1" cellspacing="1">
												<tr>
														<td width="" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><strong>&nbsp;<img src="img/infofromitcube.jpg" width="221" height="65"></strong></td>
												</tr>
												<tr>
														<td>
																<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																		<?php
			$rows=0;
			while($vupdata[$rows]["vup_id"]!=NULL) {
			?>
																		<tr>
																				<td width="100" valign="top"><?php echo str_replace("-",".",$vupdata[$rows]["rdate"]); ?>&nbsp;</td>
																				<td valign="top"><a href="index.php?PID=vup_d&vup_id=<?php echo $vupdata[$rows]["vup_id"] ?>"><?php echo $vupdata[$rows]["title"] ?></a>&nbsp;</td>
																		</tr>
																		<?php
				$rows++;
			}
			?>
																</table>
																<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
																		<tr>
																				<td>
																						<div align="right">¡¦¡¦¡¦ <a href="index.php?PID=vup&cate_id=1">more</a> </div>
																				</td>
																		</tr>
																</table>
														</td>
												</tr>
										</table>
										<table width="100%" border="0" cellpadding="1" cellspacing="1">
												<tr>
														<td width="" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><strong>&nbsp;<img src="img/versionoup.jpg" width="221" height="65"></strong></td>
												</tr>
												<tr>
														<td>
																<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
																		<?php
			$rows=0;
			while($vupdata2[$rows]["vup_id"]!=NULL) {
			?>
																		<tr>
																				<td width="100" valign="top"><?php echo str_replace("-",".",$vupdata2[$rows]["rdate"]); ?>&nbsp;</td>
																				<td valign="top"><a href="index.php?PID=vup_d&vup_id=<?php echo $vupdata2[$rows]["vup_id"] ?>"><?php echo $vupdata2[$rows]["title"] ?></a>&nbsp;</td>
																		</tr>
																		<?php
				$rows++;
			}
			?>
																</table>
																<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
																		<tr>
																				<td>
																						<div align="right">¡¦¡¦¡¦ <a href="index.php?PID=vup&cate_id=2">more</a> </div>
																				</td>
																		</tr>
																</table>
														</td>
												</tr>
										</table>
								</td>
						</tr>
				</table>
    		</td>
    <td width="50%" valign="top"> 
    		<table width="100%" border="0" cellpadding="1" cellspacing="1">
						<tr>
								<td width="" align="left" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/banner_bbs.jpg" width="174" height="65"></td>
						</tr>
						<tr>
								<td align="left">
										<table width="100%" border="0" align="center" cellpadding="2" cellspacing="2" bgcolor="#FFFFFF">
												<?php 
				$rows=0;
				while($upbbsdata[$rows]["sled_id"]!=NULL) {
				?>
												<tr bgcolor="#FFFFFF">
														<td width="100" align="left">
																<?php 
					$date=explode(" ",$upbbsdata[$rows]["last_update"]);
					echo $date[0]; ?>
														</td>
														<td align="left"><a href="index.php?PID=bbs_sled&amp;sled_id=<?php echo $upbbsdata[$rows]["sled_id"]; ?>"><?php echo $upbbsdata[$rows]["sled_name"] ?></a>(<?php echo $upbbsdata[$rows]["maxcount"] ?>)
														    <?php
															
																if(time()-strtotime($upbbsdata[$rows]["last_update"])<60*60*24*3) {
																?>
                                                            <font color="#FF0000"><strong>New!</strong></font>
                                                            <?php
																}
																?>
														</td>
												</tr>
												<?php
				$rows++;
				}
				?>
										</table>
										<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF">
												<tr>
														<td>
																<div align="right">¡¦¡¦¡¦ <a href="index.php?PID=bbs">more</a> </div>
														</td>
												</tr>
										</table>
								</td>
						</tr>
				</table>
    		<table width="100%" border="0" cellpadding="1" cellspacing="1"> 
        <tr> 
          <td width="" align="left" background="http://siteadmin.itcube.ne.jp/img/0707icon/c1.jpg"><img src="http://siteadmin.itcube.ne.jp/img/0707icon/benner_sam.jpg" width="174" height="65"></td> 
        </tr> 
        <tr> 
          <td align="left"> <table width="100%" border="0" align="center" cellpadding="1" cellspacing="2" bgcolor="#FFFFFF"> 
              <?php 
				$rows=0;
				for($rssrows=0;$rssrows<5;$rssrows++) {
				?> 
              <tr> 
                <td align="left"> <a href="<?php 
					echo mb_convert_encoding($rssnews[$rssrows]["link"],mb_internal_encoding(),"auto"); ?>" target="_blank"> 
                  <?php 
					echo mb_convert_encoding($rssnews[$rssrows]["title"],mb_internal_encoding(),"auto"); ?> 
                  </a> </td> 
              </tr> 
              <tr> 
                <td align="left"> <hr /> </td> 
              </tr> 
              <?php
				}
				?> 
            </table> 
            <table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#FFFFFF"> 
              <tr> 
                <td> <div align="right">¡¦¡¦¡¦ <a href="http://www.nikkeibp.co.jp/" target="_blank">more</a> </div></td> 
              </tr> 
            </table></td> 
        </tr> 
      </table></td> 
  </tr> 
  <tr> 
    <td colspan="2">&nbsp;</td> 
  </tr> 
  <tr> 
    <td colspan="2">&nbsp;</td> 
  </tr> 
</table> 
