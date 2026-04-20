<?php
if($_POST["mode"]=="update") {
	$insql="delete from direct_mail where dm_id=".$_REQUEST["dm_id"];
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="削除に失敗しました。";
	}
}

$dmdata=$dbobj->GetData("select * from direct_mail where dm_id=".$_REQUEST["dm_id"]."");

$exday=explode("-",date("Y-m-d-H-i",$dmdata["sendtime"]));
$RDATE=date("Ymd",$dmdata["sendtime"]); 
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script>
<!--
//****月によって、日付のselect.optionを削除****
function check3(){
	year=document.delete_form.ryear.value;
	month=document.delete_form.rmonth.value;
	day=document.delete_form.rday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.delete_form.rday") 
			del_cnt=document.delete_form.rday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.delete_form.rday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//****月によって、日付のselect.optionを削除****
function set_date_dft(){
		dft_date=document.all.dft_dat.value;
		document.delete_form.ryear.value=dft_date.substr(0,4);
		document.delete_form.rmonth.value=dft_date.substr(4,2);
		document.delete_form.rday.value=dft_date.substr(6,2);
}
function day_chk() {
	if(document.delete_form.day_view.checked){
		document.delete_form.ryear.value="";
		document.delete_form.rmonth.value="";
		document.delete_form.rday.value="";
	}
	else {
		set_date_dft();
	}
}

function datachk() {
	var frm=document.delete_form;
	var alertchk=0;
	var alerttxt="";
	if(alertchk==0) {
		res=confirm("この内容で削除しますか？");
		if(res) {
			frm.submit();
		}
		
	}else {
			alert(alerttxt);
		}
}
//-->


//-->
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0"> 
  <form name="delete_form" method="post" action=""> 
    <tr> 
      <td> <table width="740" border="0" align="center" cellpadding="3" cellspacing="0"> 
          <tr> 
            <td>削除</td> 
          </tr> 
        </table></td> 
    </tr> 
    <tr> 
      <td>&nbsp;</td> 
    </tr> 
    <tr> 
      <td> <?php
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
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
          <tr> 
            <td width="150" valign="top" bgcolor="#EBEBEB">対象</td> 
            <td bgcolor="#FFFFFF"> <select name="dm_target" id="dm_target"> 
                <option value="p"<?php if($dmdata["dm_target"]=="p") { echo " selected";} ?>>PCアドレス</option> 
                <option value="k"<?php if($dmdata["dm_target"]=="k") { echo " selected";} ?>>携帯アドレス</option> 
                <option value="pk"<?php if($dmdata["dm_target"]=="pk"||$dmdata["dm_target"]==NULL) { echo " selected";} ?>>すべて</option> 
              </select> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">予定日
              <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"> </td> 
            <td bgcolor="#FFFFFF"> <select name="ryear" id="ryear" onChange="check3()"> 
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
            <td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td> 
            <td bgcolor="#FFFFFF"> <input name="raddress" type="text" id="raddress" size="40" value="<?php echo $dmdata["raddress"];?>" /> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">件名</td> 
            <td bgcolor="#FFFFFF"> <input name="rsubjext" type="text" id="rsubjext" size="40" value="<?php echo $dmdata["rsubjext"];?>" /> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td> 
            <td bgcolor="#FFFFFF"> <textarea name="rpctxt" cols="60" rows="10" id="rpctxt"><?php echo $dmdata["rpctxt"];?></textarea> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">携帯用本文</td> 
            <td bgcolor="#FFFFFF"> <label> 
              <textarea name="rktxt" cols="20" rows="10" id="rktxt"><?php echo $dmdata["rktxt"];?></textarea> 
              </label> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td> 
            <td bgcolor="#FFFFFF"> <input type="button" name="Submit" value="削除する" onclick="datachk()" /> 
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" /> 
              <input name="mode" type="hidden" id="mode" value="update" /> <input name="dm_id" type="hidden" id="dm_id" value="<?php echo $_REQUEST["dm_id"];?>" /></td> 
          </tr> 
      </table>      </td> 
    </tr> 
  </form> 
</table> 
