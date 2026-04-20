<?php
if($_POST["mode"]=="update") {
	$insql="delete from direct_mail where dm_id=".$_REQUEST["dm_id"];
	$chkres=$dbobj->Query($insql);
	if($chkres) {
		$chkres=$adminobj->Query("delete from mail_queue where dm_id=".$_REQUEST["dm_id"]." and dbname='".$_SESSION["DomainData"]["dbname"]."'");
		if($chkres){
			
		?>
		<script language="javascript">
		location.replace("?PID=promo_dm");
		</script>
		<?php
		}
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
            <td bgcolor="#FFFFFF"> 
                <?php if($dmdata["dm_target"]=="p") { echo "PCアドレス";} ?>
                <?php if($dmdata["dm_target"]=="k") { echo "携帯アドレス";} ?>
               <?php if($dmdata["dm_target"]=="pk"||$dmdata["dm_target"]==NULL) { echo "すべて";} ?>
        </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">予定日
              <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>"> </td> 
            <td bgcolor="#FFFFFF"> 
                <?php
echo $year;			?> 
              年
                <?php
echo $month;
			?> 
              月
              
                <?php
echo $day;

			?> 
              日</td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">予定時刻</td> 
            <td bgcolor="#FFFFFF"> <?php echo $hour;?>
              ：
              <?php echo $minite;?></td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">送信元のアドレス</td> 
            <td bgcolor="#FFFFFF"><?php echo $dmdata["raddress"];?></td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">件名</td> 
            <td bgcolor="#FFFFFF"><?php echo $dmdata["rsubjext"];?></td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">PC用本文</td> 
            <td bgcolor="#FFFFFF"><?php echo nl2br($dmdata["rpctxt"]);?></td> 
          </tr> 
          <tr>
          		<td valign="top" bgcolor="#EBEBEB">携帯用件名</td>
          		<td bgcolor="#FFFFFF"><?php echo $dmdata["ksubjext"];?></td>
          		</tr>
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">携帯用本文</td> 
            <td bgcolor="#FFFFFF"> <label> 
              <?php echo nl2br($dmdata["rktxt"]);?>
              </label> </td> 
          </tr> 
          <tr> 
            <td valign="top" bgcolor="#EBEBEB">&nbsp;</td> 
            <td bgcolor="#FFFFFF"> <input type="button" name="Submit" value="削除する" onclick="datachk()" /> 
              <input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_dm');" /> 
              <input name="mode" type="hidden" id="mode" value="update" /> <input name="dm_id" type="hidden" id="dm_id" value="<?php echo $_REQUEST["dm_id"];?>" /></td> 
          </tr> 
      </table>      
      </td> 
    </tr> 
  </form> 
</table> 
