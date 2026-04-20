<?php
include("./lib/mobile_class_7.php");

$today=explode("-",date("Y-m-d",time()));
if($_POST["mode"]=="regist") {
	$maxdata=$dbobj->GetData("select max(dm_id) as maxid from direct_mail");
	$maxid=$maxdata["maxid"]+1;
	
	$rtime=mktime($_SESSION["dm"]["rhour"],$_SESSION["dm"]["rmin"],0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"]);
	
	$insql="insert into direct_mail(dm_id,dm_target,sendtime,raddress,rsubjext,rpctxt,rktxt,turn,finchk,status,ksubjext,qoupon) values(".$maxid.",'".$_SESSION["dm"]["target"]."',".$_SESSION["dm"]["sendtime"].",'".$_SESSION["dm"]["raddress"]."','".$_SESSION["dm"]["rsubjext"]."','".$_SESSION["dm"]["rpctxt"]."','".$_SESSION["dm"]["rktxt"]."',".$maxid.",0,0,'".$_SESSION["dm"]["ksubjext"]."',".$_SESSION["dm"]["coupon_id"].")";
	$chkres=$dbobj->Query($insql);

	if($chkres){
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
							$coupon="\nクーポン券はこちら↓↓\nhttp://".$_SESSION["DomainData"]["domain_name"]."/coupon/k.php?coupon_id=".$_SESSION["dm"]["coupon_id"];
						}
						else {
						$coupon="";
						}
						break;
					case "p":
						$txt=$_SESSION["dm"]["rpctxt"];
						$sbj=$_SESSION["dm"]["rsubjext"];
						
						if($_SESSION["dm"]["coupon_id"]!=0) {
							$coupon="\nクーポン券はこちら↓↓\nhttp://".$_SESSION["DomainData"]["domain_name"]."/coupon/index.php?coupon_id=".$_SESSION["dm"]["coupon_id"];
						}						
						else {
						$coupon="";
						}
						break;
				}
				
				$insql="insert into mail_queue values(".$maxid2.",".$_SESSION["dm"]["sendtime"].",'".$_SESSION["dm"]["raddress"]."','".$memlist[$memi]["email"]."','".$sbj."','".$txt.$coupon."','".$_SESSION["DomainData"]["dbname"]."',".$maxid.")";
				$chkres=$adminobj->Query($insql);
			}
		}
			$_SESSION["dm"]="";
			$_SESSION["dm"]["rpctxt"]="";
			$_SESSION["dm"]["rsubjext"]="";
			$_SESSION["dm"]["rktxt"]="";
			$_SESSION["dm"]["ksubjext"]="";
			
		?>
<script language="javascript">
		location.replace("index.php?PID=promo_dm");
		</script>
<?php
	}
	else {
		$_POST["mode"]="";
		$errmess="登録に失敗しました。";
	}
	
	$exday=explode("-",date("Y-m-d-H-i",$_SESSION["dm"]["sendtime"]));
	$RDATE=date("Ymd",$rtime); 
}
else if($_GET["sendtime"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",$_GET["sendtime"]));
	$RDATE=date("Ymd",$_GET["sendtime"]); 
	$_SESSION["dm"]["sendtime"]=$_GET["sendtime"];
}
else if($_POST["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])); 
}
else if($_SESSION["dm"]["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_SESSION["dm"]["rmonth"],$_SESSION["dm"]["rday"],$_SESSION["dm"]["ryear"])); 
}
else {
	$exday=explode("-",date("Y-m-d-H-i"));
	$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
}

$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];
$dmcondata=$dbobj->GetList("select * from dm_temp order by turn");
$coupondata=$dbobj->GetList("select * from promo_coupon order by coupon_id");
?>
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
	if(ka>1000){
		alerttxt=alerttxt+"件名と携帯用本文で全角1000文字以内で入力してください。";
		var alertchk=1;
	}
	if(frm.raddress.value==null||frm.raddress.value=="") {
		alertchk=1;
		alerttxt=alerttxt+"送信アドレスを入力してください。";
	}
	
	if(alertchk==0) {
		updateRTEs();
		frm.submit();
	}else {
			alert(alerttxt);
	}
}

//-->
</script>
<style>
.helper{
	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
.helper1 {	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
</style>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                    <td>
                        <table width="100%"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
                            <tr>
                                <td width="15" bgcolor="#CCCCCC">&nbsp; </td>
                                <td>
                                    <table width="100%"  border="0" cellspacing="0" cellpadding="5">
                                        <tr>
                                            <td class="font10"> <strong>メール配信登録</strong> </td>
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
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td valign="top">
            
            <?php 
								if($_GET["mode"]=="step4") {
								$emoji_obj->reqest_data_conv('r','','EUC-JP');
								?><div class="helper"> 内容を確認して問題がなければ<strong>「登録する」</strong>ボタンをクリックしてください。</div>
            <form name="update_form" method="post" action="">
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <td width="150" valign="top" bgcolor="#EBEBEB">対象</td>
                        <td bgcolor="#FFFFFF">
                            <?php 
														 if($_SESSION["dm"]["target"]=="p") { echo "PCアドレス";} 
														 if($_SESSION["dm"]["target"]=="k") { echo "携帯アドレス";} 
														 if($_SESSION["dm"]["target"]=="pk"||$_SESSION["dm"]["target"]==NULL) { echo "すべて";} ?>
                        </td>
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
                        <td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td>
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
                        <td bgcolor="#FFFFFF">
                            <?php 
						$DECODE_DATA=$emoji_obj->emj_decode($_SESSION["dm"]["ksubjext"]);
						echo nl2br($DECODE_DATA["web"]);
						?>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">携帯用本文</td>
                        <td bgcolor="#FFFFFF">
                            <label></label>
                            <table width="200" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="200">
                                        <?php 
						$DECODE_DATA=$emoji_obj->emj_decode($_SESSION["dm"]["rktxt"]);
						echo nl2br(str_replace("<p>","",(str_replace("</p>","<br >",$DECODE_DATA["web"]))));
						?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
                        <td bgcolor="#FFFFFF">
                            <input type="submit" name="Submit" value="登録する"/>
                            <input type="button" name="Submit" value="戻る" onclick="location.replace('?PID=promo_dm_reg&mode=step3');" />
                            <input type="button" name="Submit" value="一覧へ戻る" onclick="location.replace('?PID=promo_dm');" />
                            <input name="mode" type="hidden" id="mode" value="regist" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php 
								}
								else if($_POST["mode"]=="step3"){
								$_SESSION["dm"]["target"]=$_POST["target"];
								$_SESSION["dm"]["ryear"]=$_POST["ryear"];
								$_SESSION["dm"]["rmonth"]=$_POST["rmonth"];
								$_SESSION["dm"]["rday"]=$_POST["rday"];
								$_SESSION["dm"]["raddress"]=$_POST["raddress"];
								$_SESSION["dm"]["rsubjext"]=$_POST["rsubjext"];
								$_SESSION["dm"]["coupon_id"]=$_POST["coupon_id"];
								$_SESSION["dm"]["rpctxt"]=$_POST["rpctxt"];
								$_SESSION["dm"]["rktxt"]=$_POST["rktxt"];
								$_SESSION["dm"]["ksubjext"]=$_POST["ksubjext"];
								?><br>
            <div class="helper"> メールを配信する時間の枠をクリックしてください。<br>
              配信日を変更するには予定日項目で配信日を選択して<strong>「変更」</strong>ボタンをクリックしてください。</div>
            <form id="form1" name="form1" method="post" action="">
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <td width="150" valign="top" bgcolor="#EBEBEB">予定日
                            <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
                            <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
                            <input name="rktxt" type="hidden" id="rktxt" value="<?php echo str_replace("<br />","</p><p>",str_replace("\r","",str_replace("\n","\\n",nl2br($_SESSION["dm"]["rktxt"]))));?>" size="60" />
                            <input name="ksubjext" type="hidden" id="ksubjext" size="40" value="<?php echo $_SESSION["dm"]["ksubjext"];?>" />
                            <input name="raddress" type="hidden" id="raddress" size="40" value="<?php echo $_SESSION["dm"]["raddress"];?>" style="ime-mode:disabled;" />
                            <input name="rsubjext" type="hidden" id="rsubjext" size="40" value="<?php echo $_SESSION["dm"]["rsubjext"];?>" />
                            <input name="target" type="hidden" id="target" size="40" value="<?php echo $_SESSION["dm"]["target"];?>" />
                            <input name="rpctxt" type="hidden" id="rpctxt" size="40" value="<?php echo $_SESSION["dm"]["rpctxt"];?>" />
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
                            <input name="mode" type="hidden" id="mode" value="step3" />
                        </td>
                    </tr>
                </table>
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <?php
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
                        <td width="50" align="center" bgcolor="#FFFFFF"> <a href="index.php?PID=promo_dm_reg&amp;mode=step3">
                            <?php 
				if($ttime1<=time()) {
					echo "×";
				}
				else if($trdata[$ttime1]["count"]<100&&$trdata[$ttime1]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime1\">○</a>";
					
				}else if($trdata[$ttime1]["count"]<500&&$trdata[$ttime1]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime1\">▲</a>";
				}
				else if($trdata[$ttime1]["count"]>=500&&$trdata[$ttime1]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime1\">◎<a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime2\">○</a>";
					
				}else if($trdata[$ttime2]["count"]<500&&$trdata[$ttime2]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime2\">▲</a>";
				}
				else if($trdata[$ttime2]["count"]>=500&&$trdata[$ttime2]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime2\">◎</a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime3\">○</a>";
					
				}else if($trdata[$ttime3]["count"]<500&&$trdata[$ttime3]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime3\">▲</a>";
				}
				else if($trdata[$ttime3]["count"]>=500&&$trdata[$ttime3]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime3\">◎</a>";
				}
				
				
				 ?>
                            </a> </td>
                        <td width="50" align="center" bgcolor="#EBEBEB"><?php echo date("H:i",$ttime4); ?></td>
                        <td width="50" align="center" bgcolor="#FFFFFF">
                            <?php 
				if($ttime4<=time()) {
					echo "×";
				}
				else if($trdata[$ttime4]["count"]<100&&$trdata[$ttime4]["count"]!=NULL) {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime4\">○</a>";
					
				}else if($trdata[$ttime4]["count"]<500&&$trdata[$ttime4]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime4\">▲</a>";
				}
				else if($trdata[$ttime4]["count"]>=500&&$trdata[$ttime4]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime4\">◎</a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime5\">○</a>";
					
				}else if($trdata[$ttime5]["count"]<500&&$trdata[$ttime5]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime5\">▲</a>";
				}
				else if($trdata[$ttime5]["count"]>=500&&$trdata[$ttime5]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime5\">◎</a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime6\">○</a>";
					
				}else if($trdata[$ttime6]["count"]<500&&$trdata[$ttime6]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime6\">▲</a>";
				}
				else if($trdata[$ttime6]["count"]>=500&&$trdata[$ttime6]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime6\">◎</a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime7\">○</a>";
					
				}else if($trdata[$ttime7]["count"]<500&&$trdata[$ttime7]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime7\">▲</a>";
				}
				else if($trdata[$ttime7]["count"]>=500&&$trdata[$ttime7]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime7\">◎</a>";
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
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime8\">○</a>";
					
				}else if($trdata[$ttime8]["count"]<500&&$trdata[$ttime8]["count"]!=NULL)	{
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime8\">▲</a>";
				}
				else if($trdata[$ttime8]["count"]>=500&&$trdata[$ttime8]["count"]!=NULL){
					echo "×";
				}
				else {
					echo "<a href=\"index.php?PID=promo_dm_reg&mode=step4&sendtime=$ttime8\">◎</a>";
				}
				
				
				 ?>
                        </td>
                    </tr>
                    <?php
}
?>
                </table>
                <br />
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
                    <tr>
                        <td bgcolor="#FFFFFF">
                            <input type="button" name="Submit" value="戻る" onclick="location.replace('?PID=promo_dm_reg');" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
				}
				else {
				if($_GET["temp_id"]!=NULL) {
						$dmtmpdata=$dbobj->GetData("select * from dm_temp where temp_id=".$_REQUEST["temp_id"]."");

						$_SESSION["dm"]["target"]=$dmtmpdata["target"];
						$_SESSION["dm"]["ryear"]=$dmtmpdata["ryear"];
						$_SESSION["dm"]["rmonth"]=$dmtmpdata["rmonth"];
						$_SESSION["dm"]["rday"]=$dmtmpdata["rday"];
						$_SESSION["dm"]["raddress"]=$dmtmpdata["raddress"];
						$_SESSION["dm"]["rsubjext"]=$dmtmpdata["rsubjext"];
						$_SESSION["dm"]["coupon_id"]=$dmtmpdata["coupon_id"];
						$_SESSION["dm"]["rpctxt"]=$dmtmpdata["rpctxt"];
						$_SESSION["dm"]["rktxt"]=$dmtmpdata["rktxt"];
						$_SESSION["dm"]["ksubjext"]=$dmtmpdata["ksubjext"];

				}
				?>
            <script language="JavaScript" type="text/javascript" src="/CrBrow/richtext.js"></script>
            <script language="JavaScript" type="text/javascript" src="/CrBrow/emojiin2.js"></script>
            <script language="JavaScript" type="text/javascript" src="/CrBrow/emojichg.js"></script>
            <script language="JavaScript" type="text/javascript">
				<!--
				// Cross-Browser Rich Text Editor初期化
				initRTE("/CrBrow/images/", "", "");
				//-->
				</script>
            <form name="update_form" method="post" action="" onsubmit="">
                <?php
				if($errmess!=NULL) {
				?>
                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
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
?><div class="helper"> メール配信を登録します。<br>
          各項目を入力して<strong>「次へ＞＞」</strong>ボタンをクリックしてください。<br>
携帯用件名と携帯用本文の項目では右側の携帯各社のアイコンをクリックすると絵文字を利用する事が出来ます。<br>
テンプレートを使用してメール配信の登録を行う場合は<a href="?PID=promo_dmtemp"><font color="#0000FF">こちらをクリック</font></a>してください。<br>
                クーポンの登録は<a href="?PID=promo_coupon&page=1"><font color="#0000FF">こちらから</font></a>行えます。 </div>
                <br>
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    
                    <tr>
                        <td width="150" valign="top" bgcolor="#EBEBEB">対象</td>
                        <td bgcolor="#FFFFFF">
                            <select name="target" id="target">
                                <option value="p"<?php if($_SESSION["dm"]["target"]=="p") { echo " selected";} ?>>PCアドレス</option>
                                <option value="k"<?php if($_SESSION["dm"]["target"]=="k") { echo " selected";} ?>>携帯アドレス</option>
                                <option value="pk"<?php if($_SESSION["dm"]["target"]=="pk"||$_SESSION["dm"]["target"]==NULL) { echo " selected";} ?>>すべて</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">送信元のアドレス
    <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
                        </td><td bgcolor="#FFFFFF">
                            <input name="raddress" type="text" id="raddress" size="40" value="<?php echo $_SESSION["dm"]["raddress"];?>" style="ime-mode:disabled;width:98%;" />
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">件名</td>
                        <td bgcolor="#FFFFFF">
                            <input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $_SESSION["dm"]["rsubjext"];?>" style="width:98%;"/>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">PC用本文</td>
                        <td bgcolor="#FFFFFF">
                            <textarea name="rpctxt" cols="60" rows="10" id="rpctxt" style="width:98%;"><?php echo $_SESSION["dm"]["rpctxt"];?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">携帯用件名（15文字以内）</td>
                        <td bgcolor="#FFFFFF">
<script language="JavaScript" type="text/javascript">
<!--
writeRichText('text', 'update_form', 'ksubjext', '<?php echo str_replace("\r","",str_replace("\n","\\n",$_SESSION["dm"]["ksubjext"]));?>', 450, 20, false, false ,'side', 12);
//-->
</script>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
                            （件名と合わせて<br />
                            1000文字以内）</td>
                        <td bgcolor="#FFFFFF"><script language="JavaScript" type="text/javascript">
<!--
writeRichText('textfield', 'update_form', 'rktxt', '<?php 
$DECODE_DATA=$emoji_obj->emj_decode($_SESSION["dm"]["rktxt"]);
$DECODE_DATA["form"]=str_replace("\r","",$DECODE_DATA["form"]);
$DECODE_DATA["form"]=str_replace("\n","",$DECODE_DATA["form"]);
$DECODE_DATA["form"]=trim($DECODE_DATA["form"]);
echo (str_replace("<p>","",(str_replace("</p>","<br >",nl2br($DECODE_DATA["form"])))));?>', 450, 200, false, false ,'side', 12);
//-->
</script></td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">クーポン選択<br>
                        </td>
                        <td bgcolor="#FFFFFF">
                            <select name="coupon_id" id="coupon_id">
                                <option value="0">使用しない</option>
                                <?php
								for($dmci=0;$coupondata[$dmci]["coupon_id"]!=NULL;$dmci++) {
								?>
                                <option value="<?php echo $coupondata[$dmci]["coupon_id"]; ?>"><?php echo $coupondata[$dmci]["coupon_name"]; ?></option>
                                <?php
								}
								?>
                            </select>
                            <br>
                        クーポンの登録は<a href="?PID=promo_coupon&page=1"><font color="#0000FF">こちらから</font></a>行えます。                        </td>
                    </tr>
                    <tr>
                        <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
                        <td bgcolor="#FFFFFF">
                            <input type="button" name="Submit" value="次　へ　&gt;&gt;" onclick="datachk()" />
                            <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" />
                            <input name="mode" type="hidden" id="mode" value="step3" />
                        </td>
                    </tr>
                </table>
            </form>
            <script language="javascript">
								function chtemp() {
	var frm=document.update_form;
	var id=frm.temp_id.value;
	switch(id) {	
<?php
	for($dmci=0;$dmcondata[$dmci]["temp_id"]!=NULL;$dmci++) {
?>
	case "<?php echo $dmcondata[$dmci]["temp_id"];?>":
		alert(frm.chkSrcrktxt.value);
		frm.raddress.value="<?php echo $dmcondata[$dmci]["raddress"];?>";
		frm.rsubjext.value="<?php echo $dmcondata[$dmci]["rsubjext"];?>";
		frm.ksubjext.value="<?php echo $dmcondata[$dmci]["ksubjext"];?>";
		frm.target.value="<?php echo $dmcondata[$dmci]["temp_target"];?>";
		
		frm.rpctxt.value="<?php echo str_replace("\r","",str_replace("\n","\\n",$dmcondata[$dmci]["rpctxt"]));?>";
		frm.rktxt.value="<?php echo  str_replace("<br />","</p><p>",str_replace("\r","",str_replace("\n","\\n",nl2br($dmcondata[$dmci]["rktxt"]))));?>";
	break;
<?php
	}
?>
	default:
		frm.raddress.value="";
		frm.rsubjext.value="";
		frm.rpctxt.value="";
		frm.rktxt.value="";
		break;
	}	
}

								</script>
            <?php
								}
								?>
        </td>
    </tr>
</table>
