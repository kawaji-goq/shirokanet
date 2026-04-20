<?php 
/*
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<link href="../GW/style.css" rel="stylesheet" type="text/css">
<?php 
*/
$scheobj=new Schedule($dbobj);
$memberobj=new Members($dbobj);
$memberlist=$memberobj->getList2();
$sql="select min(syear) as minyear,max(fyear) as maxyear from schedule";
$yeardata=$dbobj->GetData($sql);

	if($_GET["syear"]==NULL){
		$_GET["syear"]=$yeardata["minyear"];
	}
	if($_GET["smonth"]==NULL){
		$_GET["smonth"]=1;
	}
	if($_GET["sday"]==NULL) {
		$_GET["sday"]=1;			
	}
	
	if($_GET["fyear"]==NULL){
		$_GET["fyear"]=$yeardata["maxyear"];
	}
	if($_GET["fmonth"]==NULL){
		$_GET["fmonth"]=12;
	}
	if($_GET["fday"]==NULL) {
		$_GET["fday"]=31;
	}
if($_GET["memberid"]==NULL) {
	$_GET["memberid"]=$logindata["member_id"];
}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
    
    <tr>
        <td>
    <table width="98%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
     <form name="form1" method="get" action="">   <tr>
            <td bgcolor="#ECECEC"><strong>スケジュール検索            </strong></td>
        </tr>
        <tr>
            <td bgcolor="#FFFFFF">
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                    
                    <tr>
                        <td width="9%">キーワード</td>
                        <td width="91%">
                            <input name="keyword" type="text" id="keyword" value="<?php echo $_GET["keyword"];?>" size="40">
                            <input type="submit" name="Submit" value="検索">
                            <input name="PID" type="hidden" id="PID" value="ScheduleSearch">
                            <input name="mode" type="hidden" id="PID" value="search">
                        </td>
                    </tr>
                    <tr>
                        <td>検索期間</td>
                        <td>
                            <select name="syear" id="syear">
                                <?php 
																																		
																																$sregdate[0]=date("Y");
								$yrows=-5;
							for($yrows=$yeardata["minyear"];$yrows<=$yeardata["maxyear"];$yrows++) {
								?>
                                <option value="<?php echo ($yrows);?>"<?php if($yrows==$_GET["syear"]) { echo "selected";}?>><?php echo $yrows;?>年</option>
                                <?php
								}
							?>
                            </select>
                            <strong>
                            <select name="smonth">
                                <option value="1"<?php if($_GET["smonth"]==1||$_GET["smonth"]==NULL) { echo " selected";}?>>1月</option>
                                <option value="2"<?php if($_GET["smonth"]==2) { echo " selected";}?>>2月</option>
                                <option value="3"<?php if($_GET["smonth"]==3) { echo " selected";}?>>3月</option>
                                <option value="4"<?php if($_GET["smonth"]==4) { echo " selected";}?>>4月</option>
                                <option value="5"<?php if($_GET["smonth"]==5) { echo " selected";}?>>5月</option>
                                <option value="6"<?php if($_GET["smonth"]==6) { echo " selected";}?>>6月</option>
                                <option value="7"<?php if($_GET["smonth"]==7) { echo " selected";}?>>7月</option>
                                <option value="8"<?php if($_GET["smonth"]==8) { echo " selected";}?>>8月</option>
                                <option value="9"<?php if($_GET["smonth"]==9) { echo " selected";}?>>9月</option>
                                <option value="10"<?php if($_GET["smonth"]==10) { echo " selected";}?>>10月</option>
                                <option value="11"<?php if($_GET["smonth"]==11) { echo " selected";}?>>11月</option>
                                <option value="12"<?php if($_GET["smonth"]==12) { echo " selected";}?>>12月</option>
                            </select>
                            <select name="sday" id="sday">
                                <option<?php if($_GET["sday"]==1||$_GET["sday"]==NULL) { echo " selected";}?> value="1">1日</option>
                                <option<?php if($_GET["sday"]==2) { echo " selected";}?> value="2">2日</option>
                                <option<?php if($_GET["sday"]==3) { echo " selected";}?> value="3">3日</option>
                                <option<?php if($_GET["sday"]==4) { echo " selected";}?> value="4">4日</option>
                                <option<?php if($_GET["sday"]==5) { echo " selected";}?> value="5">5日</option>
                                <option<?php if($_GET["sday"]==6) { echo " selected";}?> value="6">6日</option>
                                <option<?php if($_GET["sday"]==7) { echo " selected";}?> value="7">7日</option>
                                <option<?php if($_GET["sday"]==8) { echo " selected";}?> value="8">8日</option>
                                <option<?php if($_GET["sday"]==9) { echo " selected";}?> value="9">9日</option>
                                <option<?php if($_GET["sday"]==10) { echo " selected";}?> value="10">10日</option>
                                <option<?php if($_GET["sday"]==11) { echo " selected";}?> value="11">11日</option>
                                <option<?php if($_GET["sday"]==12) { echo " selected";}?> value="12">12日</option>
                                <option<?php if($_GET["sday"]==13) { echo " selected";}?> value="13">13日</option>
                                <option<?php if($_GET["sday"]==14) { echo " selected";}?> value="14">14日</option>
                                <option<?php if($_GET["sday"]==15) { echo " selected";}?> value="15">15日</option>
                                <option<?php if($_GET["sday"]==16) { echo " selected";}?> value="16">16日</option>
                                <option<?php if($_GET["sday"]==17) { echo " selected";}?> value="17">17日</option>
                                <option<?php if($_GET["sday"]==18) { echo " selected";}?> value="18">18日</option>
                                <option<?php if($_GET["sday"]==19) { echo " selected";}?> value="19">19日</option>
                                <option<?php if($_GET["sday"]==20) { echo " selected";}?> value="20">20日</option>
                                <option<?php if($_GET["sday"]==21) { echo " selected";}?> value="21">21日</option>
                                <option<?php if($_GET["sday"]==22) { echo " selected";}?> value="22">22日</option>
                                <option<?php if($_GET["sday"]==23) { echo " selected";}?> value="23">23日</option>
                                <option<?php if($_GET["sday"]==24) { echo " selected";}?> value="24">24日</option>
                                <option<?php if($_GET["sday"]==25) { echo " selected";}?> value="25">25日</option>
                                <option<?php if($_GET["sday"]==26) { echo " selected";}?> value="26">26日</option>
                                <option<?php if($_GET["sday"]==27) { echo " selected";}?> value="27">27日</option>
                                <option<?php if($_GET["sday"]==28) { echo " selected";}?> value="28">28日</option>
                                <option<?php if($_GET["sday"]==29) { echo " selected";}?> value="29">29日</option>
                                <option<?php if($_GET["sday"]==30) { echo " selected";}?> value="30">30日</option>
                                <option<?php if($_GET["sday"]==31) { echo " selected";}?> value="31">31日</option>
                            </select>
                            </strong>〜<strong>
                            <select name="fyear" id="fyear">
                                <?php 
																																$sregdate[0]=date("Y");
								$yrows=-5;
							for($yrows=$yeardata["minyear"];$yrows<=$yeardata["maxyear"];$yrows++) {
								?>
                                <option value="<?php echo ($yrows);?>"<?php if($yrows==$_GET["fyear"]) { echo "selected";}?>><?php echo $yrows;?>年</option>
                                <?php
								}
							?>
                            </select>
                            <select name="fmonth">
                                <option value="1"<?php if($_GET["fmonth"]==1) { echo " selected";}?>>1月</option>
                                <option value="2"<?php if($_GET["fmonth"]==2) { echo " selected";}?>>2月</option>
                                <option value="3"<?php if($_GET["fmonth"]==3) { echo " selected";}?>>3月</option>
                                <option value="4"<?php if($_GET["fmonth"]==4) { echo " selected";}?>>4月</option>
                                <option value="5"<?php if($_GET["fmonth"]==5) { echo " selected";}?>>5月</option>
                                <option value="6"<?php if($_GET["fmonth"]==6) { echo " selected";}?>>6月</option>
                                <option value="7"<?php if($_GET["fmonth"]==7) { echo " selected";}?>>7月</option>
                                <option value="8"<?php if($_GET["fmonth"]==8) { echo " selected";}?>>8月</option>
                                <option value="9"<?php if($_GET["fmonth"]==9) { echo " selected";}?>>9月</option>
                                <option value="10"<?php if($_GET["fmonth"]==10) { echo " selected";}?>>10月</option>
                                <option value="11"<?php if($_GET["fmonth"]==11) { echo " selected";}?>>11月</option>
                                <option value="12"<?php if($_GET["fmonth"]==12||$_GET["fmonth"]==NULL) { echo " selected";}?>>12月</option>
                            </select>
                            <select name="fday" id="fday">
                                <option<?php if($_GET["fday"]==1) { echo " selected";}?> value="1">1日</option>
                                <option<?php if($_GET["fday"]==2) { echo " selected";}?> value="2">2日</option>
                                <option<?php if($_GET["fday"]==3) { echo " selected";}?> value="3">3日</option>
                                <option<?php if($_GET["fday"]==4) { echo " selected";}?> value="4">4日</option>
                                <option<?php if($_GET["fday"]==5) { echo " selected";}?> value="5">5日</option>
                                <option<?php if($_GET["fday"]==6) { echo " selected";}?> value="6">6日</option>
                                <option<?php if($_GET["fday"]==7) { echo " selected";}?> value="7">7日</option>
                                <option<?php if($_GET["fday"]==8) { echo " selected";}?> value="8">8日</option>
                                <option<?php if($_GET["fday"]==9) { echo " selected";}?> value="9">9日</option>
                                <option<?php if($_GET["fday"]==10) { echo " selected";}?> value="10">10日</option>
                                <option<?php if($_GET["fday"]==11) { echo " selected";}?> value="11">11日</option>
                                <option<?php if($_GET["fday"]==12) { echo " selected";}?> value="12">12日</option>
                                <option<?php if($_GET["fday"]==13) { echo " selected";}?> value="13">13日</option>
                                <option<?php if($_GET["fday"]==14) { echo " selected";}?> value="14">14日</option>
                                <option<?php if($_GET["fday"]==15) { echo " selected";}?> value="15">15日</option>
                                <option<?php if($_GET["fday"]==16) { echo " selected";}?> value="16">16日</option>
                                <option<?php if($_GET["fday"]==17) { echo " selected";}?> value="17">17日</option>
                                <option<?php if($_GET["fday"]==18) { echo " selected";}?> value="18">18日</option>
                                <option<?php if($_GET["fday"]==19) { echo " selected";}?> value="19">19日</option>
                                <option<?php if($_GET["fday"]==20) { echo " selected";}?> value="20">20日</option>
                                <option<?php if($_GET["fday"]==21) { echo " selected";}?> value="21">21日</option>
                                <option<?php if($_GET["fday"]==22) { echo " selected";}?> value="22">22日</option>
                                <option<?php if($_GET["fday"]==23) { echo " selected";}?> value="23">23日</option>
                                <option<?php if($_GET["fday"]==24) { echo " selected";}?> value="24">24日</option>
                                <option<?php if($_GET["fday"]==25) { echo " selected";}?> value="25">25日</option>
                                <option<?php if($_GET["fday"]==26) { echo " selected";}?> value="26">26日</option>
                                <option<?php if($_GET["fday"]==27) { echo " selected";}?> value="27">27日</option>
                                <option<?php if($_GET["fday"]==28) { echo " selected";}?> value="28">28日</option>
                                <option<?php if($_GET["fday"]==29) { echo " selected";}?> value="29">29日</option>
                                <option<?php if($_GET["fday"]==30) { echo " selected";}?> value="30">30日</option>
                                <option<?php if($_GET["fday"]==31||$_GET["fday"]==NULL) { echo " selected";}?> value="31">31日</option>
                            </select>
                            </strong></td>
                    </tr>
                    <tr>
                        <td>検索対象</td>
                        <td>
                            <select name="memberid">
																												<?php
																												for($memrows=0;$memberlist[$memrows]["member_id"]!=NULL;$memrows++) {
																												?>
																												<option value="<?php echo $memberlist[$memrows]["member_id"] ?>"<?php if($_GET["memberid"]==$memberlist[$memrows]["member_id"]) {echo " selected";}?>><?php echo $memberlist[$memrows]["member_name"] ?></option>
																												<?php
																												}
																												?>
                            </select>
                            </td>
                    </tr>
                </table>
            </td>
        </tr>
</form>    </table>
</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
<?php 
if($_GET["mode"]=="search") {
	$wheretxt=" and ";
	
	
	$startdate=date("Y-m-d",mktime(0,0,0,$_GET["smonth"],$_GET["sday"],$_GET["syear"]));
	$enddate=date("Y-m-d",mktime(0,0,0,$_GET["fmonth"],$_GET["fday"],$_GET["fyear"]));
	
	$sql="select schedule.*,schedule_master.* from schedule inner join schedule_master on schedule.schedule_id =schedule_master.schedule_id where (title like '%".$_GET["keyword"]."%' or comment like '%".trim($_GET["keyword"])."%') and fdate >='".$startdate."' and  sdate <='".$enddate."' and schedule_master.member_id = ".$_GET["memberid"]." order by sdate";
	$schelist=$dbobj->GetList($sql);
?>
<table width="98%"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#DCDCFF">
    <tr>
        <td bgcolor="#DCDCFF"><strong>検索結果一覧</strong></td>
    </tr>
    <tr>
        <td valign="top" bgcolor="#FFFFFF">
            <table width="100%" border="0" cellspacing="0" cellpadding="3">
                <tr>
                    <td width="11%" bgcolor="#ececec">日付</td>
                    <td width="34%" bgcolor="#ececec">タイトル</td>
                    <td width="55%" bgcolor="#ececec">内容</td>
                </tr>
                <?php
																for($i=0;$schelist[$i]["schedule_id"]!=NULL;$i++) {
																?>
                <tr>
                    <td valign="top"><?php echo str_replace("-",".",$schelist[$i]["sdate"]); ?></td>
                    <td valign="top"><a href="?PID=sche_up&sche_id=<?php echo  $schelist[$i]["schedule_id"];?>"><?php echo $schelist[$i]["title"]; ?></a></td>
                    <td valign="top"><?php echo nl2br($schelist[$i]["comment"]); ?></td>
                </tr>
                <?php
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
</table>
