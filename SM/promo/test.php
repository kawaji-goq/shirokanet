<?php
include "ITC/modules.php";
$usedb="postgresql";
$adminobj=Cube_DB :: UseDB($usedb);
$adminobj->name="itcube_admin";
$adminobj->Connect();
if($_GET["day"]!=NULL) {
	$exday=explode("-",$_GET["day"]);
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}
else {
	$exday=explode("-",date("Y-m-d"));
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}	

$res=$adminobj->Query("select sendtime,count(sendtime) from mail_queue GROUP BY sendtime having sendtime between  $stime and $etime");
$resnum=$adminobj->NumRows($res);
if($resnum!=0) {
	for($i=0;$i<$resnum;$i++){
		$tdata=$adminobj->FetchArray($res,$i);
		$rdata[$tdata["sendtime"]]=$tdata;
	}
}
?>
<?php
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
<?php
for($i=0;$i<=360;$i+=10) {
				$ttime1=mktime(0,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime2=mktime(6,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime3=mktime(12,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime4=mktime(18,$i,0,$exday[1],$exday[2],$exday[0]);
?>
<tr>
				<td><?php echo date("H:i",$ttime1); ?></td>
				<td><?php 
				if($ttime1<=time()) {
					echo "Žó•tI—¹";
				}
				else if($rdata[$ttime1]["count"]<100&&$rdata[$ttime1]["count"]!=NULL) {
					echo "›";
					
				}else if($rdata[$ttime1]["count"]<500&&$rdata[$ttime1]["count"]!=NULL)	{
					echo "£";
				}
				else if($rdata[$ttime1]["count"]>=500&&$rdata[$ttime1]["count"]!=NULL){
					echo "~";
				}
				else {
					echo "";
				}
				?></td>
				<td><?php echo date("H:i",$ttime2); ?></td>
				<td><?php 
				if($ttime2<=time()) {
					echo "Žó•tI—¹";
				}
				else if($rdata[$ttime2]["count"]<100&&$rdata[$ttime2]["count"]!=NULL) {
					echo "›";
					
				}else if($rdata[$ttime2]["count"]<500&&$rdata[$ttime2]["count"]!=NULL)	{
					echo "£";
				}
				else if($rdata[$ttime2]["count"]>=500&&$rdata[$ttime2]["count"]!=NULL){
					echo "~";
				}
				else {
					echo "";
				}
				
				 ?></td>
				<td><?php echo date("H:i",$ttime3); ?></td>
				<td><?php 
				if($ttime3<=time()) {
					echo "Žó•tI—¹";
				}
				else if($rdata[$ttime3]["count"]<100&&$rdata[$ttime3]["count"]!=NULL) {
					echo "›";
					
				}else if($rdata[$ttime3]["count"]<500&&$rdata[$ttime3]["count"]!=NULL)	{
					echo "£";
				}
				else if($rdata[$ttime3]["count"]>=500&&$rdata[$ttime3]["count"]!=NULL){
					echo "~";
				}
				else {
					echo "";
				}
				
				
				 ?></td>
				<td><?php echo date("H:i",$ttime4); ?></td>
				<td><?php 
				if($ttime4<=time()) {
					echo "Žó•tI—¹";
				}
				else if($rdata[$ttime4]["count"]<100&&$rdata[$ttime4]["count"]!=NULL) {
					echo "›";
					
				}else if($rdata[$ttime4]["count"]<500&&$rdata[$ttime4]["count"]!=NULL)	{
					echo "£";
				}
				else if($rdata[$ttime4]["count"]>=500&&$rdata[$ttime4]["count"]!=NULL){
					echo "~";
				}
				else {
					echo "";
				}
				
				
				 ?></td>
		</tr>
<?php
}
?></table>
