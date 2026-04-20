<?php
include("./lib/mobile_class_7.php");
if($_POST["mode"]=="update") {
	$stime=mktime($_REQUEST["rhour"],$_REQUEST["rmin"],0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]);
	$etime=mktime($_REQUEST["ehour"],$_REQUEST["emin"],0,$_REQUEST["emonth"],$_REQUEST["eday"],$_REQUEST["eyear"]);
	
	$insql=	"update promo_coupon set ".
					"coupon_name='".$_REQUEST["coupon_name"]."',".
					"pc_title = '".$_REQUEST["pc_title"]."',".
					"pc_comm = '".$_REQUEST["pc_comm"]."',".
					"k_title='".$_REQUEST["k_title"]."',".
					"k_comm='".$_REQUEST["k_comm"]."',".
					"stime=".$stime.",".
					"etime=".$etime."".
					" where coupon_id=".$_REQUEST["coupon_id"];
	
	
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="変更に失敗しました。";
	?>
<script language="javasctipt">location.replace("index.php?PID=promo_coupon");</script>
<?php	
	}
	else {
	}
	$_REQUEST=$dmdata=$dbobj->GetData("select * from promo_coupon where coupon_id=".$_REQUEST["coupon_id"]."");
	$exday=explode("-",date("Y-m-d-H-i",$dmdata["stime"]));
	$RDATE=date("Ymd",$dmdata["stime"]); 
	$exday2=explode("-",date("Y-m-d-H-i",$dmdata["etime"]));
	$RDATE2=date("Ymd",$dmdata["etime"]); 
	
}
else {
	$_REQUEST=$dmdata=$dbobj->GetData("select * from promo_coupon where coupon_id=".$_REQUEST["coupon_id"]."");
	$exday=explode("-",date("Y-m-d-H-i",$dmdata["stime"]));
	$RDATE=date("Ymd",$dmdata["stime"]); 
	$exday2=explode("-",date("Y-m-d-H-i",$dmdata["etime"]));
	$RDATE2=date("Ymd",$dmdata["etime"]); 
}

if($_GET["day"]!=NULL) {
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}
else {
	$stime=mktime(0,0,0,$exday[1],$exday[2],$exday[0]);
	$etime=mktime(0,0,0,$exday[1],$exday[2]+1,$exday[0]);
}	

$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$hour=$exday[3];
$minite=$exday[4];
$year2=$exday2[0];
$month2=$exday2[1];
$day2=$exday2[2];

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
//****月によって、日付のselect.optionを変更****
function set_date_dft2(){
		dft_date2=document.all.dft_dat2.value;
		document.update_form.eyear.value=dft_date2.substr(0,4);
		document.update_form.emonth.value=dft_date2.substr(4,2);
		document.update_form.eday.value=dft_date2.substr(6,2);
}

function day_chk() {
	set_date_dft();
	set_date_dft2();
}

function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(alertchk==0) {
		updateRTEs();
	}else {
			alert(alerttxt);
		}
}
//-->

function check4(){
	year=document.update_form.eyear.value;
	month=document.update_form.emonth.value;
	day=document.update_form.eday.value;
	day_cnt=31;
	if(month=="02"){
		if((year % 4 )!=0){day_cnt=28}	else{day_cnt=29}}
	if((month=="04")|(month=="06")|(month=="09")|(month=="11")){day_cnt=30}

//		前のSELECTをクリアー
			obj=eval("document.update_form.eday") 
			del_cnt=document.update_form.eday.length;
		for(i=0;i<del_cnt;i++){
			obj.options.remove(0);
		}
//		新しいSELECTを組立
		for(i=1;i<=day_cnt;i++){
			new_option=document.createElement("option");
				if(i<10){date="0" +i;} else {date=""+i;}
			new_option.value=date
			new_option.text=date
			obj=eval("document.update_form.eday") 
			obj.options.add(new_option,eval(obj.length));
		}
}
//-->
</script>

<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
				<td>
						<table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
								<tr>
										<td>
												<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
														<tr>
																<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
																<td>
																		<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																				<tr>
																						<td class="font10"> <strong>クーポン情報変更</strong> </td>
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
						</table>
				</td>
		</tr>
		<tr>
				<td>
						<?php 
								if($_GET["mode"]=="step3") {
								
								?>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<td width="150" valign="top" bgcolor="#EBEBEB"><strong>有効期限</strong></td>
										<td bgcolor="#FFFFFF">
												<?php 
														 if($_REQUEST["target"]=="p") { echo "PCアドレス";} 
														 if($_REQUEST["target"]=="k") { echo "携帯アドレス";} 
														 if($_REQUEST["target"]=="pk"||$_REQUEST["target"]==NULL) { echo "すべて";} ?>
										</td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB"><strong>クーポン名</strong></td>
										<td bgcolor="#FFFFFF"><?php echo $year;?>年<?php echo $month;?>月<?php echo $day;?>日</td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB"><strong>PC用タイトル</strong></td>
										<td bgcolor="#FFFFFF"><?php echo $hour;?>：<?php echo $minite;?></td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB"><strong>PC用本文</strong></td>
										<td bgcolor="#FFFFFF"> <?php echo $_REQUEST["raddress"];?> </td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB"><strong>携帯タイトル</strong></td>
										<td bgcolor="#FFFFFF"><?php 
										$DECODE_DATA=$emoji_obj->emj_decode($_SESSION["dm"]["rsubjext"]);
										 echo $DECODE_DATA["web"];
										 ?></td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB"><strong>携帯用本文<br />
												</strong></td>
										<td bgcolor="#FFFFFF"><?php 
										$DECODE_DATA=$emoji_obj->emj_decode($_SESSION["dm"]["rpctxt"]);
										echo nl2br($DECODE_DATA["web"]);
										?> </td>
								</tr>
								<tr>
										<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
										<td bgcolor="#FFFFFF">
												<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_coupon&page=1');" />
												<input name="mode" type="hidden" id="mode" value="regist" />
										</td>
								</tr>
					</table>
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
								

?><div class="helper"> クーポン情報を変更します。<br>
各項目を入力して<strong>「更新する」</strong>ボタンをクリックしてください。<br>
携帯用タイトルと携帯用本文の項目では右側の携帯各社のアイコンをクリックすると絵文字を利用する事が出来ます。<br>
会員登録時のクーポンの設定は<a href="?PID=promo_setting"><font color="#0000FF">初期設定ページ</font></a>の登録時ｸｰﾎﾟﾝﾀｲﾄﾙと登録時ｸｰﾎﾟﾝ本文で入力してください。</div> 
				<script language="JavaScript" type="text/javascript" src="/CrBrow/richtext.js"></script>
						<script language="JavaScript" type="text/javascript" src="/CrBrow/emojiin2.js"></script>
						<script language="JavaScript" type="text/javascript" src="/CrBrow/emojichg.js"></script>
						<script language="JavaScript" type="text/javascript">
<!--
// Cross-Browser Rich Text Editor初期化
initRTE("/CrBrow/images/", "", "");
//-->
</script>
						<form name="update_form" method="post" action="" onsubmit="datachk()">
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB"><strong>有効期限</strong></td>
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
														日〜
														<select name="eyear" id="eyear" onchange="check4()">
																<?php
			for($yi=0;$yi<2;$yi++) {
				?>
																<option value="<?php echo $year+$yi;?>" <?php if($yi==0) {echo " selected";}?>><?php echo $year+$yi;?></option>
																<?php
			}
			?>
														</select>
														年
														<select name="emonth" id="emonth" onchange="check3()">
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
														<select name="eday" id="eday">
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
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB"><strong>クーポン名</strong></td>
												<td bgcolor="#FFFFFF">
														<input name="coupon_name" type="text" id="coupon_name" size="40" value="<?php echo $_REQUEST["coupon_name"];?>" style="width:98%;" />
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB"><strong>PC用タイトル</strong></td>
												<td bgcolor="#FFFFFF">
														<input name="pc_title" type="text" id="pc_title" size="40" value="<?php echo $_REQUEST["pc_title"];?>" style="width:98%;" /></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB"><strong>PC用本文</strong></td>
												<td bgcolor="#FFFFFF">
														<textarea name="pc_comm" cols="60" rows="10" id="pc_comm" style="width:98%;"><?php echo $_REQUEST["pc_comm"];?></textarea>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB"><strong>携帯タイトル
														      <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
														      <input name="dft_dat2" type="hidden" id="dft_dat2" value="<?php echo $RDATE2;?>" />
														</strong></td>
												<td bgcolor="#FFFFFF">
														<script language="JavaScript" type="text/javascript">
<!--
writeRichText('text', 'update_form', 'k_title', '<?php echo str_replace("\r","",str_replace("\n","\\n",$_REQUEST["k_title"]));?>', 450, 20, false, false ,'side', 12);
//-->
</script>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB"><strong>携帯用本文<br />
														</strong></td>
												<td bgcolor="#FFFFFF">
														<script language="JavaScript" type="text/javascript">
<!--
writeRichText('textfield', 'update_form', 'k_comm', '<?php echo  str_replace("<br />","</p><p>",str_replace("\r","",str_replace("\n","\\n",nl2br($_REQUEST["k_comm"]))));?>', 450, 200, false, false ,'side', 12);
//-->
</script>
														</label>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="submit" name="Submit" value="更新する" onclick="" />
														<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_coupon&page=1');" />
														<input name="mode" type="hidden" id="mode" value="update" />
														<input name="coupon_id" type="hidden" id="coupon_id" value="<?php echo $_REQUEST["coupon_id"];?>" />
												</td>
										</tr>
							</table>
						</form>
						<?php 
								}
								?>
				</td>
		</tr>
</table>
<script language="javascript">
day_chk();
</script>
