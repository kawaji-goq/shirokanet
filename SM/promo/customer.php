<?php
if($_GET["lim"]!=NULL) {
	$_SESSION["cm"]["lim"]=$_GET["lim"];
}
else {
	$_SESSION["cm"]["lim"]=20;
}
if($_GET["page"]!=NULL) {
	$_SESSION["cm"]["page"]=$_GET["page"];
}
else if($_SESSION["cm"]["page"]==NULL) {
	$_SESSION["cm"]["page"]=1;
}

if($_GET["selmenu"]!=NULL) {
	$_SESSION["dmtemp"]["selmenu"]=$_GET["selmenu"];
}


$mcusdata=$dbobj->GetList("select * from mail_customer order by regdate desc offset ".$_SESSION["cm"]["lim"]*($_SESSION["cm"]["page"]-1)." limit ".$_SESSION["cm"]["lim"]);
$dmres=$dbobj->Query("select * from mail_customer");
$maxcount=$dbobj->NumRows($dmres);
$maxpage=ceil(($maxcount)/$_SESSION["cm"]["lim"]);

?>
<?php
$today=explode("-",date("Y-m-d",time()));

if($newsdata["rdate"]!=NULL) {
	$exday=explode("-",$newsdata["rdate"]);
}
else {
	$exday=explode("-",date("Y-m-d-H-i"));
}
$RDATE=date("Ymd",mktime(0,0,0,$exday[1],$exday[2],$exday[0])); 
$year=$exday[0];
$month=$exday[1];
$day=$exday[2];
$hour=$exday[3];
$minite=$exday[4];

if($_POST["mode"]=="regist") {
include_once('./lib/mobile_class_7.php');
	$chksql="select * from mail_customer where email = '".$_POST["email"]."'";
	$chkres=$dbobj->Query($chksql);
	$chknumrows=$dbobj->NumRows($chkres);
	
	if($chknumrows!=0) {
		$_POST["mode"]="";
		$errmess="このメールアドレスは既に登録されています。";
	}
	else {
		$maxdata=$dbobj->GetData("select max(id) as maxid from mail_customer");
		$maxid=$maxdata["maxid"]+1;
		$carrer=$emoji_obj -> get_mail_career($_POST["email"]);
		
		if($carrer!='PC') 
		{
			$carrer="k";
		}
		else 
		{
			$carrer="p";
		}
		
		$insql="insert into mail_customer values(".$maxid.",'".$_POST["email"]."','".$_POST["name"]."','".date("Y-m-d")."','".(User_Model :: MailType($_POST["email"]))."')";
		$chkres=$dbobj->Query($insql);
		if(!$chkres){
			$_POST["mode"]="";
			$errmess="登録に失敗しました。";
		}
	}
}

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
	if(frm.email.value==null||frm.email.value=="") {
		alertchk=1;
		alerttxt="メールアドレスを入力してください。";
	}
	else if(frm.email.value!=frm.email2.value) {
		alertchk=1;
		alerttxt="メールアドレスとメールアドレス確認のアドレスが異なります。\n正確なメールアドレスを入力してください。";
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
.helper1 {	line-height:25px;
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
						<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
										<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="5">
														<tr>
																<td class="font10"> <strong>メール会員TOP</strong> </td>
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
		    <td>
		        <div class="helper">メール会員を登録する場合には<a href="?PID=promo_customer_reg"><font color="#0000FF">こちらをクリック</font></a>してください。 <br>
                                登録したメール会員情報を変更したい場合には<strong>「変更」</strong>ボタンをクリックしてください。<br>
                                登録したメール会員情報を削除したい場合には<strong>「削除」</strong>ボタンをクリックしてください。<br>
		        </div>
</td>
    </tr>
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<td>
												<table border="0" align="left" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
														<tr>
																<td width="100" bgcolor="#EBEBEB">全会員数</td>
																<td width="50" bgcolor="#FFFFFF">
																		<div align="right"><?php echo $dbobj->Count("select * from mail_customer"); ?></div>
																</td>
																<td width="100" bgcolor="#EBEBEB">PC会員数</td>
																<td width="50" bgcolor="#FFFFFF">
																		<div align="right"><?php echo $dbobj->Count("select * from mail_customer where mail_type = 'p'"); ?></div>
																</td>
																<td width="100" bgcolor="#EBEBEB">携帯会員数</td>
																<td width="50" bgcolor="#FFFFFF">
																		<div align="right"><?php echo $dbobj->Count("select * from mail_customer where mail_type = 'k'"); ?></div>
																</td>
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
				<td>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<td width="26%" bgcolor="#EBEBEB">メールアドレス</td>
										<td width="36%" bgcolor="#EBEBEB">会員名</td>
										<td width="24%" bgcolor="#EBEBEB">登録日</td>
										<td width="6%" bgcolor="#EBEBEB">
										    <div align="center">変更</div>
									</td>
										<td width="8%" bgcolor="#EBEBEB">
										    <div align="center">削除</div>
									</td>
								</tr>
								<?php
								for($mci=0;$mcusdata[$mci]["email"]!=NULL;$mci++) {
								?><tr>
										<td bgcolor="#FFFFFF"><?php echo $mcusdata[$mci]["email"]; ?>&nbsp;</td>
										<td width="36%" bgcolor="#FFFFFF"><?php echo $mcusdata[$mci]["name"]; ?>&nbsp;</td>
										<td width="24%" bgcolor="#FFFFFF"><?php echo str_replace("-",".",$mcusdata[$mci]["regdate"]); ?>&nbsp;</td>
										<td width="6%" bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="変更" onClick="location.href='?PID=promo_customer_up&id=<?php echo $mcusdata[$mci]["id"]; ?>'" />
								            </div>
									</td>
										<td width="8%" bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="削除" onClick="location.href='?PID=promo_customer_del&id=<?php echo $mcusdata[$mci]["id"]; ?>'" />
								            </div>
									</td>
								</tr>
								<?php
								}
								?>
					</table>
				</td>
		</tr>
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<td>
												<input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=promo_customer_reg'">
										</td>
								</tr>
					</table>
				</td>
		</tr>		<tr>
				<td height="33">
						<div align="center">
								<?php if($_SESSION["cm"]["page"]!=NULL&&$_SESSION["cm"]["page"]!=1){  ?>
								<a href="?PID=promo_customer&page=<?php echo $_SESSION["cm"]["page"]-1;?>">
								<?php }?>
		&lt;&lt;　前の10件
		<?php 
		if($_SESSION["cm"]["page"]!=NULL&&$_SESSION["cm"]["page"]!=1){  ?>
								</a>
		<?php 
		}
		for($prows=1;$prows<=$maxpage;$prows++) { 
		  if($prows==$_SESSION["cm"]["page"]) {
		  		echo " <strong><font color=\"#FF6600\">".$prows."</font></strong> ";
			}
			else {
		  		echo " <a href=\"?PID=promo_customer&page=".$prows."\">".$prows."</a> ";
			}
		  
		  }?>
								<?php if($maxpage!=$_SESSION["cm"]["page"]) {?>
								<a href="?PID=promo_customer&page=<?php echo $_SESSION["cm"]["page"]+1;?>">
								<?php } ?>
								次の10件　&gt;&gt;
								<?php if($maxpage!=$_SESSION["cm"]["page"]) {?>
								</a>
								<?php } ?>
						</div>
				</td>
		</tr>
		<tr>
		    <td>&nbsp;</td>
    </tr>
		<tr>
		    <td>&nbsp;</td>
    </tr>
</table>
