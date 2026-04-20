<?php
$today=explode("-",date("Y-m-d",time()));


if($_REQUEST["mode"]=="regist") {

	$maxdata=$dbobj->GetData("select max(dm_id) as maxid from direct_mail");
	$maxid=$maxdata["maxid"]+1;
	$rtime=mktime($_REQUEST["rhour"],$_REQUEST["rmin"],0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]);
	$insql="insert into direct_mail values(".$maxid.",'".$_POST["target"]."',".$rtime.",'".$_POST["raddress"]."','".$_POST["rsubjext"]."','".$_POST["rpctxt"]."','".$_POST["rktxt"]."',".$maxid.",0)";
	$chkres=$dbobj->Query($insql);
	
	if($chkres){
		$memlist=$dbobj->GetList("select * from mail_customer");
		for($memi=0;$memlist[$memi]["id"]!=NULL;$memi++) {
			if($_POST["target"]==$memlist[$memi]["mail_type"]||$_POST["target"]=="pk") {
				$maxdata=$adminobj->GetData("select max(queue_id) as maxid from mail_queue");
				$maxid2=$maxdata["maxid"]+1;
				
				switch($memlist[$memi]["mail_type"]) {
					case "k":
						$txt=$_POST["rktxt"];
						break;
					case "p":
						$txt=$_POST["rpctxt"];
						break;
				}
				
				$insql="insert into mail_queue values(".$maxid2.",".$rtime.",'".$_POST["raddress"]."','".$memlist[$memi]["email"]."','".$_POST["rsubjext"]."','".$txt."','".$_SESSION["DomainData"]["dbname"]."',".$maxid.")";
				$chkres=$adminobj->Query($insql);
			}
		}	
	}
	else {
		$_POST["mode"]="";
		$errmess="登録に失敗しました。";
	}
	
	$exday=explode("-",date("Y-m-d-H-i",$rtime));
	$RDATE=date("Ymd",$rtime); 
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
	ks=document.update_form.rsubjext.value.length;
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
		res=confirm("この内容で登録しますか？");
		if(res) {
			frm.submit();
		}
		
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
		frm.target.value="<?php echo $dmcondata[$dmci]["temp_target"];?>";
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
										<td class="font10"> <strong>DM登録</strong> </td>
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
								if($_POST["mode"]=="regist") {
								?> 
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB">対象</td> 
            <td bgcolor="#FFFFFF"><?php 
														 if($_REQUEST["target"]=="p") { echo "PCアドレス";} 
														 if($_REQUEST["target"]=="k") { echo "携帯アドレス";} 
														 if($_REQUEST["target"]=="pk"||$_REQUEST["target"]==NULL) { echo "すべて";} ?></td> 
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
            <td bgcolor="#FFFFFF"> <?php echo $_REQUEST["raddress"];?> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">件名</td> 
            <td bgcolor="#FFFFFF"> <?php echo $_REQUEST["rsubjext"];?> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td> 
            <td bgcolor="#FFFFFF"> <?php echo nl2br($_REQUEST["rpctxt"]);?> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">携帯用本文</td> 
            <td bgcolor="#FFFFFF"> <label> <?php echo nl2br($_REQUEST["rktxt"]);?> </label> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td> 
            <td bgcolor="#FFFFFF"> <input type="button" name="Submit" value="続けて登録する" onclick="location.replace('?PID=promo_dm_reg');" /> 
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" /> 
              <input name="mode" type="hidden" id="mode" value="regist" /> </td> 
          </tr> 
        </table> 
        <?php 
								}
								else {?> 
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
								?> <?php

?>
        <table width="700" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB">ﾃﾝﾌﾟﾚｰﾄ選択</td> 
            <td bgcolor="#FFFFFF"> <select name="temp_id" id="temp_id" onchange="chtemp()">
            		<option>使用しない</option>
            	<?php
								for($dmci=0;$dmcondata[$dmci]["temp_id"]!=NULL;$dmci++) {
								?>	<option value="<?php echo $dmcondata[$dmci]["temp_id"]; ?>"><?php echo $dmcondata[$dmci]["temp_name"]; ?></option>
           <?php
								}
								?> 
            </select> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">対象</td> 
            <td bgcolor="#FFFFFF"> <select name="target" id="target"> 
                <option value="p"<?php if($_REQUEST["target"]=="p") { echo " selected";} ?>>PCアドレス</option> 
                <option value="k"<?php if($_REQUEST["target"]=="k") { echo " selected";} ?>>携帯アドレス</option> 
                <option value="pk"<?php if($_REQUEST["target"]=="pk"||$_REQUEST["target"]==NULL) { echo " selected";} ?>>すべて</option> 
              </select> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">予定日
              <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"> </td> 
            <td bgcolor="#FFFFFF"> <select name="ryear" id="ryear" onChange="check3()"> 
                <?php
			for($yi=0;$yi<2;$yi++) {
				?><option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option> 
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

			?></select> 
              日</td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">予定時刻</td> 
            <td bgcolor="#FFFFFF"> <select name="rhour" id="rhour"> 
                <option value="0"<?php if($hour==0||$hour==NULL){ echo " selected";}?>>00</option> 
                <option value="1"<?php if($hour==1) { echo " selected";}?>>01</option> 
                <option value="2"<?php if($hour==2) { echo " selected";}?>>02</option> 
                <option value="3"<?php if($hour==3) { echo " selected";}?>>03</option> 
                <option value="4"<?php if($hour==4) { echo " selected";}?>>04</option> 
                <option value="5"<?php if($hour==5) { echo " selected";}?>>05</option> 
                <option value="6"<?php if($hour==6) { echo " selected";}?>>06</option> 
                <option value="7"<?php if($hour==7) { echo " selected";}?>>07</option> 
                <option value="8"<?php if($hour==8) { echo " selected";}?>>08</option> 
                <option value="9"<?php if($hour==9) { echo " selected";}?>>09</option> 
                <option value="10"<?php if($hour==10) { echo " selected";}?>>10</option> 
                <option value="11"<?php if($hour==11) { echo " selected";}?>>11</option> 
                <option value="12"<?php if($hour==12) { echo " selected";}?>>12</option> 
                <option value="13"<?php if($hour==13) { echo " selected";}?>>13</option> 
                <option value="14"<?php if($hour==14) { echo " selected";}?>>14</option> 
                <option value="15"<?php if($hour==15) { echo " selected";}?>>15</option> 
                <option value="16"<?php if($hour==16) { echo " selected";}?>>16</option> 
                <option value="17"<?php if($hour==17) { echo " selected";}?>>17</option> 
                <option value="18"<?php if($hour==18) { echo " selected";}?>>18</option> 
                <option value="19"<?php if($hour==19) { echo " selected";}?>>19</option> 
                <option value="20"<?php if($hour==20) { echo " selected";}?>>20</option> 
                <option value="21"<?php if($hour==21) { echo " selected";}?>>21</option> 
                <option value="22"<?php if($hour==22) { echo " selected";}?>>22</option> 
                <option value="23"<?php if($hour==23) { echo " selected";}?>>23</option> 
              </select> 
              ：
              <select name="rmin" id="rmin"> 
                <option value="00"<?php if($rmin==0||$rmin==NULL){ echo " selected";}?>>00</option> 
                <option value="30"<?php if($rmin==30){ echo " selected";}?>>30</option> 
              </select> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">送信アドレス</td> 
            <td bgcolor="#FFFFFF"> <input name="raddress" type="text" id="raddress" size="40" value="<?php echo $_REQUEST["raddress"];?>" style="ime-mode:disabled;" /> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">件名（15文字以内）</td> 
            <td bgcolor="#FFFFFF"> <input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $_REQUEST["rsubjext"];?>" /> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td> 
            <td bgcolor="#FFFFFF"> <textarea name="rpctxt" cols="60" rows="10" id="rpctxt"><?php echo $_REQUEST["rpctxt"];?></textarea> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
            （件名と合わせて<br />
1000文字以内）</td> 
            <td bgcolor="#FFFFFF"> <label> 
              <textarea name="rktxt" cols="20" rows="10" id="rktxt"><?php echo $_REQUEST["rktxt"];?></textarea> 
              </label> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td> 
            <td bgcolor="#FFFFFF"> <input type="button" name="Submit" value="登録する" onclick="datachk()" /> 
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" /> 
              <input name="mode" type="hidden" id="mode" value="regist" /> </td> 
          </tr> 
        </table> 
        <?php 
								}
								?></td> 
    </tr> 
  </form> 
</table> 
