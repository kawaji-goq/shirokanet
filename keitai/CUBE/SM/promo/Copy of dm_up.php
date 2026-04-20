<?php
$dmdata=$dbobj->GetData("select * from direct_mail where dm_id=".$_REQUEST["dm_id"]."");

if($_POST["mode"]=="update") {
	$rtime=mktime($_SESSION["dm"]["rhour"],$_SESSION["dm"]["rmin"],0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"]);
	$insql="update direct_mail set ".
			"dm_target='".$_SESSION["dm"]["target"]."',".
			"sendtime = ".$_REQUEST["sendtime"].",".
			"raddress = '".$_SESSION["dm"]["raddress"]."',".
			"rsubjext='".$_SESSION["dm"]["rsubjext"]."',".
			"rpctxt='".$_SESSION["dm"]["rpctxt"]."',".
			"ksubjext='".$_SESSION["dm"]["ksubjext"]."',".
			"qoupon='".$_SESSION["dm"]["coupon_id"]."',".
			"rktxt='".$_SESSION["dm"]["rktxt"]."'".
			" where dm_id=".$_REQUEST["dm_id"];
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="変更に失敗しました。";
	}
	else {
		$chkres=$adminobj->Query("delete from mail_queue where dm_id=".$_REQUEST["dm_id"]." and dbname='".$_SESSION["DomainData"]["dbname"]."'");
		if(!$chkres){
			$_POST["mode"]="";
			$errmess="変更に失敗しました。";
		}
		else {
			$memlist=$dbobj->GetList("select * from mail_customer");
			for($memi=0;$memlist[$memi]["id"]!=NULL;$memi++) {
				if($_SESSION["dm"]["target"]==$memlist[$memi]["mail_type"]||$_SESSION["dm"]["target"]=="pk") {
					$maxdata=$adminobj->GetData("select max(queue_id) as maxid from mail_queue");
					$maxid2=$maxdata["maxid"]+1;
					switch($memlist[$memi]["mail_type"]) {
						case "k":
							$txt=$_SESSION["dm"]["rktxt"];
							$sbj=$_SESSION["dm"]["ksubjext"];
						if($_SESSION["dm"]["coupon_id"]!=0) {
							$coupon="\nhttp://".$_SESSION["DomainData"]["domain_name"]."/coupon/k.php?coupon_id=".$_SESSION["dm"]["coupon_id"];
						}
							break;
						case "p":
							$txt=$_SESSION["dm"]["rpctxt"];
							$sbj=$_SESSION["dm"]["rsubjext"];
						if($_SESSION["dm"]["coupon_id"]!=0) {
							$coupon="\nhttp://".$_SESSION["DomainData"]["domain_name"]."/coupon/index.php?coupon_id=".$_SESSION["dm"]["coupon_id"];
						}
							break;
					}
					
					 $insql="insert into mail_queue values(".$maxid2.",".$_SESSION["dm"]["sendtime"].",'".$_SESSION["dm"]["raddress"]."','".$memlist[$memi]["email"]."','".$sbj."','".$txt.$coupon."','".$_SESSION["DomainData"]["dbname"]."',".$_REQUEST["dm_id"].")";
					$chkres=$adminobj->Query($insql);?>
<script language="javasctipt">
location.replace("index.php?PID=promo_dm");
</script><?php	

					
					//echo date("Y-m-d H:i",$_SESSION["dm"]["sendtime"]);
				}
			}
		}
	}		
	$exday=explode("-",date("Y-m-d-H-i",$_SESSION["dm"]["sendtime"]));
	$RDATE=date("Ymd",$rtime); 
}
else if($_GET["sendtime"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",$_GET["sendtime"]));
	$RDATE=date("Ymd",$_GET["sendtime"]); 
	$_SESSION["dm"]["sendtime"]=$_GET["sendtime"];
}
else if($_REQUEST["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])); 
}
else if($_SESSION["dm"]["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"])); 
}
else {
	if($_REQUEST["mode"]==NULL) {
		$_SESSION["dm"]=$dmdata;
	}
	$exday=explode("-",date("Y-m-d-H-i",$_SESSION["dm"]["sendtime"]));
	$RDATE=date("Ymd",$_SESSION["dm"]["sendtime"]); 
}

if($_GET["day"]!=NULL) {
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}
else {
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}	
$res=$adminobj->Query("select sendtime,count(sendtime) from mail_queue GROUP BY sendtime having sendtime between  $stime and $etime");
$resnum=$adminobj->NumRows($res);
if($resnum!=0) {
	for($i=0;$i<$resnum;$i++){
		$tdata=$adminobj->FetchArray($res,$i);
		$trdata[$tdata["sendtime"]]=$tdata;
	}
}
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];
$dmcondata=$dbobj->GetList("select * from dm_temp order by turn");
$coupondata=$dbobj->GetList("select * from promo_coupon order by coupon_id");
?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script>
<!--
//****月によって、日付のselect.optionを変更****
function check3(){
	year=document.update_form.ryear.value;
	month=document.update_form.rmonth.value;
	day=document.update_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.rday") 
			del_cnt=document.update_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを変更****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.update_form.ryear.value=dft_date.substr(0,4);
		document.update_form.rmonth.value=dft_date.substr(4,2);
		document.update_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
	if(document.update_form.day_view.checked){
		document.update_form.ryear.value="";
		document.update_form.rmonth.value="";
		document.update_form.rday.value="";
	}
	else {
		set_date_dft();
	}
}

function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	kt=document.update_form.rktxt.value.length;
	ks=document.update_form.ksubjext.value.length;
	ka=kt+ks;
	if(ks>15){
		alerttxt=alerttxt+"件名は全角15文字以内で入力してください。";
		var alertchk=1;
	}
	if(ka>1000){
		alerttxt=alerttxt+"件名と携帯用本文で全角1000文字以内で入力してください。";
		var alertchk=1;
	}
	if(frm.raddress.value==null||frm.raddress.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"送信アドレスを入力してください。";
	}
	
	if(alertchk==0) {
			frm.submit();
		
	}else {
			alert(alerttxt);
		}
}
function chtemp() {
	var frm=document.update_form;
	var id=frm.temp_id.value;
	switch(id) {	
<?php
	for($dmci=0;$dmcondata[$dmci]["temp_id"]!=NULL;$dmci++) {
?>
	case "<?php echo $dmcondata[$dmci]["temp_id"];?>":
		frm.raddress.value="<?php echo $dmcondata[$dmci]["raddress"];?>";
		frm.rsubjext.value="<?php echo $dmcondata[$dmci]["rsubjext"];?>";
		frm.ksubjext.value="<?php echo $dmcondata[$dmci]["ksubjext"];?>";
		frm.dm_target.value="<?php echo $dmcondata[$dmci]["temp_dm_target"];?>";
		frm.rpctxt.value="<?php echo str_replace("\r","",str_replace("\n","\\n",$dmcondata[$dmci]["rpctxt"]));?>";
		frm.rktxt.value="<?php echo str_replace("\r","",str_replace("\n","\\n",$dmcondata[$dmci]["rktxt"]));?>";
	break;
<?php
	}
?>
	default:
		frm.raddress.value="";
		frm.rsubjext.value="";
		frm.rpctxt.value="";
		frm.ksubjext.value="";
		frm.rktxt.value="";
		break;
	}	
}
//-->


//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="700"  border="0" align="center" cellpadding="0" cellspacing="0" class="border">
		<tr>
				<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
				<td>
						<table width="100%"  border="0" cellspacing="0" cellpadding="5">
								<tr>
										<td class="font10"> <strong>DM変更</strong> </td>
								</tr>
						</table>
				</td>
		</tr>
</table>
<table width="740" border="0" align="center" cellpadding="0" cellspacing="0"> 
  <form name="update_form" method="post" action=""> 
    <tr> 
      <td> <table width="740" border="0" align="center" cellpadding="3" cellspacing="0"> 
          <tr> 
            <td>&nbsp;</td> 
          </tr> 
        </table></td> 
    </tr> 
     
    <tr> 
      <td> <?php 
								if($_GET["mode"]=="step3") {
								
								?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="150" valign="top" bgcolor="#EBEBEB">対象</td>
            <td bgcolor="#FFFFFF"><?php 
														 if($_SESSION["dm"]["target"]=="p") { echo "PCアドレス";} 
														 if($_SESSION["dm"]["target"]=="k") { echo "携帯アドレス";} 
														 if($_SESSION["dm"]["target"]=="pk"||$_SESSION["dm"]["target"]==NULL) { echo "すべて";} ?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定日</td>
            <td bgcolor="#FFFFFF"><?php echo $year;?>年<?php echo $month;?>月<?php echo $day;?>日</td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定時刻</td>
            <td bgcolor="#FFFFFF"><?php echo $hour;?>：<?php echo $minite;?></td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">送信アドレス</td>
            <td bgcolor="#FFFFFF"> <?php echo $_SESSION["dm"]["raddress"];?> </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">件名</td>
            <td bgcolor="#FFFFFF"> <?php echo $_SESSION["dm"]["rsubjext"];?> </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td>
            <td bgcolor="#FFFFFF"> <?php echo nl2br($_SESSION["dm"]["rpctxt"]);?> </td>
          </tr>
          <tr>
          		<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
          		<td bgcolor="#FFFFFF"><?php echo $_SESSION["dm"]["ksubjext"];?></td>
          		</tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
            <td bgcolor="#FFFFFF">
              <label> <?php echo nl2br($_SESSION["dm"]["rktxt"]);?> </label>
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
            <td bgcolor="#FFFFFF">
              <input type="submit" name="Submit" value="更新する" />
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" />
              <input name="mode" type="hidden" id="mode" value="update" />
              <input name="dm_id" type="hidden" id="dm_id" value="<?php echo $_REQUEST["dm_id"];?>" />
</td>
          </tr>
        </table>
        <?php 
								}
								else if($_REQUEST["mode"]=="step2"){
								if($_REQUEST["s1"]==1) {
								$_SESSION["dm"]["target"]=$_REQUEST["target"];
								$_SESSION["dm"]["ryear"]=$_REQUEST["ryear"];
								$_SESSION["dm"]["rmonth"]=$_REQUEST["rmonth"];
								$_SESSION["dm"]["rday"]=$_REQUEST["rday"];
								$_SESSION["dm"]["raddress"]=$_REQUEST["raddress"];
								$_SESSION["dm"]["rsubjext"]=$_REQUEST["rsubjext"];
								$_SESSION["dm"]["rpctxt"]=$_REQUEST["rpctxt"];
								mb_internal_encoding("sjis");
								$_SESSION["dm"]["rktxt"]=$_REQUEST["rktxt"];
								mb_internal_encoding("eucjp");
								$_SESSION["dm"]["ksubjext"]=$_REQUEST["ksubjext"];
								$_SESSION["dm"]["coupon_id"]=$_REQUEST["coupon_id"];
								}
								?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定日
                <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
            </td>
            <td bgcolor="#FFFFFF">
              <select name="ryear" id="ryear" onchange="check3()">
                <?php
			for($yi=0;$yi<2;$yi++) {
				?>
                <option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
                <?php
			}
			?>
              </select>
      年
      <select name="rmonth" id="rmonth" onchange="check3()">
        <?php
			for($mi=1;$mi<13;$mi++) {
				?>
        <option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>>
        <?php if($mi<10) {echo "0";}echo $mi;?>
        </option>
        <?php
			}

			?>
      </select>
      月
      <select name="rday" id="rday">
        <?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
        <option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>>
        <?php if($di<10) {echo "0";}echo $di;?>
        </option>
        <?php
			}

			?>
      </select>
      日　
      <input type="submit" name="Submit" value="変更" />
      <input name="mode" type="hidden" id="mode" value="step2" />
            </td>
          </tr>
        </table>
        <br />
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <?php
		  $mday=date("t",mktime(0,0,0,$month,$day,$year));
for($i=0;$i<180;$i+=10) {
				$ttime1=mktime(0,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime2=mktime(3,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime3=mktime(6,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime4=mktime(9,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime5=mktime(12,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime6=mktime(15,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime7=mktime(18,$i,0,$exday[1],$exday[2],$exday[0]);
				$ttime8=mktime(21,$i,0,$exday[1],$exday[2],$exday[0]);
?>
          <tr>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime1); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF"> <a href="index.php?PID=promo_dm_up&mode=step3">
              <?php 
				if($ttime1<=time()) {
					echo "×";
				}
				else if($trdata[$ttime1]["count"]<100&&$trdata[$ttime1]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime1&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime1]["count"]<500&&$trdata[$ttime1]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime1&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime1]["count"]>=500&&$trdata[$ttime1]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime1&dm_id=".$_REQUEST["dm_id"]."\">◎<a>";
				}
				?>
            </a> </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime2); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime2<=time()) {
					echo "×";
				}
				else if($trdata[$ttime2]["count"]<100&&$trdata[$ttime2]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime2&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime2]["count"]<500&&$trdata[$ttime2]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime2&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime2]["count"]>=500&&$trdata[$ttime2]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime2&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime3); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime3<=time()) {
					echo "×";
				}
				else if($trdata[$ttime3]["count"]<100&&$trdata[$ttime3]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime3&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime3]["count"]<500&&$trdata[$ttime3]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime3&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime3]["count"]>=500&&$trdata[$ttime3]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime3&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime4); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime4<=time()) {
					echo "×";
				}
				else if($trdata[$ttime4]["count"]<100&&$trdata[$ttime4]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime4&dm_id=".$_REQUEST["dm_id"]."&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime4]["count"]<500&&$trdata[$ttime4]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime4&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime4]["count"]>=500&&$trdata[$ttime4]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime4&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime5); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime5<=time()) {
					echo "×";
				}
				else if($trdata[$ttime5]["count"]<100&&$trdata[$ttime5]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime5&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime5]["count"]<500&&$trdata[$ttime5]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime5&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime5]["count"]>=500&&$trdata[$ttime5]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime5&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime6); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime6<=time()) {
					echo "×";
				}
				else if($trdata[$ttime6]["count"]<100&&$trdata[$ttime6]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime6&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime6]["count"]<500&&$trdata[$ttime6]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime6&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime6]["count"]>=500&&$trdata[$ttime6]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime6&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime7); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime7<=time()) {
					echo "×";
				}
				else if($trdata[$ttime7]["count"]<100&&$trdata[$ttime7]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime7&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime7]["count"]<500&&$trdata[$ttime7]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime7&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime7]["count"]>=500&&$trdata[$ttime7]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime7&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
            <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime8); ?></td>
            <td width="50" align="center" bgcolor="#FFFFFF">
              <?php 
				if($ttime8<=time()) {
					echo "×";
				}
				else if($trdata[$ttime8]["count"]<100&&$trdata[$ttime8]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime8&dm_id=".$_REQUEST["dm_id"]."\">○</a>";
					
				}else if($trdata[$ttime8]["count"]<500&&$trdata[$ttime8]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime8&dm_id=".$_REQUEST["dm_id"]."\">▲</a>";
				}
				else if($trdata[$ttime8]["count"]>=500&&$trdata[$ttime8]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_up&mode=step3&sendtime=$ttime8&dm_id=".$_REQUEST["dm_id"]."\">◎</a>";
				}
				
				
				 ?>
            </td>
          </tr>
          <?php
}
?>
        </table>
        <br />
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1">
          <tr>
            <td bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="戻る" onclick="location.replace('?PID=promo_dm_up&mode=step1&dm_id=<?php echo $_REQUEST["dm_id"];?>');" />
            </td>
          </tr>
        </table>
        <br />
        <?php
								}
								else {
								?>
        <?php
								if($errmess!=NULL) {
								?>
        <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><font color="#FF0000"><strong><?php echo $errmess; ?></strong></font></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>
        <?php 
								}
								

?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td width="150" valign="top" bgcolor="#EBEBEB">ﾃﾝﾌﾟﾚｰﾄ選択</td>
            <td bgcolor="#FFFFFF">
              <select name="temp_id" id="temp_id" onchange="chtemp()">
                <option>使用しない</option>
                <?php
								for($dmci=0;$dmcondata[$dmci]["temp_id"]!=NULL;$dmci++) {
								?>
                <option value="<?php echo $dmcondata[$dmci]["temp_id"]; ?>"><?php echo $dmcondata[$dmci]["temp_name"]; ?></option>
                <?php
								}
								?>
              </select>
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">対象</td>
            <td bgcolor="#FFFFFF">
              <select name="target" id="target">
                <option value="p"<?php if($_SESSION["dm"]["target"]=="p") { echo " selected";} ?>>PCアドレス</option>
                <option value="k"<?php if($_SESSION["dm"]["target"]=="k") { echo " selected";} ?>>携帯アドレス</option>
                <option value="pk"<?php if($_SESSION["dm"]["target"]=="pk"||$_SESSION["dm"]["target"]==NULL) { echo " selected";} ?>>すべて</option>
              </select>
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">予定日</td>
            <td bgcolor="#FFFFFF">
              <select name="ryear" id="ryear" onChange="check3()">
                <?php
			for($yi=0;$yi<2;$yi++) {
				?>
                <option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
                <?php
			}
			?>
              </select>
      年
      <select name="rmonth" id="rmonth" onChange="check3()">
        <?php
			for($mi=1;$mi<13;$mi++) {
				?>
        <option value="<?php if($mi<10) {echo "0";}echo $mi;?>"<?php if($mi==$month){echo " selected";}?>>
        <?php if($mi<10) {echo "0";}echo $mi;?>
        </option>
        <?php
			}

			?>
      </select>
      月
      <select name="rday" id="rday">
        <?php
			$mday=date("t",mktime(0,0,0,$month,$day,$year));
			for($di=1;$di<=$mday;$di++) {
				?>
        <option value="<?php if($di<10) {echo "0";}echo $di;?>"<?php if($di==$day){echo " selected";}?>>
        <?php if($di<10) {echo "0";}echo $di;?>
        </option>
        <?php
			}

			?>
      </select>
      日</td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">送信アドレス
                <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
            </td>
            <td bgcolor="#FFFFFF">
              <input name="raddress" type="text" id="raddress" size="40" value="<?php echo $_SESSION["dm"]["raddress"];?>" style="ime-mode:disabled;" />
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">件名</td>
            <td bgcolor="#FFFFFF">
              <input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $_SESSION["dm"]["rsubjext"];?>" />
            </td>
          </tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">PC用本文
            <input name="s1" type="hidden" id="s1" value="1"></td>
            <td bgcolor="#FFFFFF">
              <textarea name="rpctxt" cols="60" rows="10" id="rpctxt"><?php echo $_SESSION["dm"]["rpctxt"];?></textarea>
            </td>
          </tr>
          <tr>
          		<td valign="top" bgcolor="#EBEBEB">携帯用件名（15文字以内）</td>
          		<td bgcolor="#FFFFFF">
          				<input name="ksubjext" type="text" id="ksubjext" size="40" value="<?php echo $_SESSION["dm"]["ksubjext"];?>" />
          		</td>
          		</tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
      （件名と合わせて<br />
      1000文字以内）</td>
            <td bgcolor="#FFFFFF">
              <label><?php
							mb_internal_encoding("sjis");
							?>
              <textarea name="rktxt" cols="20" rows="10" id="rktxt"><?php echo $_SESSION["dm"]["rktxt"];?></textarea>
							<?php
							mb_internal_encoding("euc-jp"); 
							?>
              </label>
            </td>
          </tr>
          <tr>
							<td valign="top" bgcolor="#EBEBEB">クーポン選択</td>
          		<td bgcolor="#FFFFFF">
									<select name="coupon_id" id="coupon_id">
											<option value="0">使用しない</option>
											<?php
								for($dmci=0;$coupondata[$dmci]["coupon_id"]!=NULL;$dmci++) {
								?>
											<option value="<?php echo $coupondata[$dmci]["coupon_id"]; ?>"<?php if($coupondata[$dmci]["coupon_id"]== $_SESSION["dm"]["qoupon"]){ echo " selected";}?>><?php echo $coupondata[$dmci]["coupon_name"]; ?></option>
											<?php
								}
								?>
									</select>
          		</td>
          		</tr>
          <tr>
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
            <td bgcolor="#FFFFFF">
              <input type="button" name="Submit" value="次　へ　&gt;&gt;" onclick="datachk()" />
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" />
              <input name="mode" type="hidden" id="mode" value="step2" />
              <input name="dm_id" type="hidden" id="dm_id" value="<?php echo $_REQUEST["dm_id"];?>" />
</td>
          </tr>
        </table>
      <?php 
								}
								?></td> 
    </tr> 
  </form> 
</table> 
