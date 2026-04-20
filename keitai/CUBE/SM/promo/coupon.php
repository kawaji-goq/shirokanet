<?php
include("./lib/mobile_class_7.php");
unset($_SESSION["coupon"]["lim"]);
$_SESSION["coupon"]["lim"]=20;

if($_GET["page"]!=NULL) {
	$_SESSION["coupon"]["page"]=$_GET["page"];
}
else if($_SESSION["coupon"]["page"]==NULL) {
	$_SESSION["coupon"]["page"]=1;
}

if($_GET["selmenu"]!=NULL) {
	$_SESSION["dmtemp"]["selmenu"]=$_GET["selmenu"];
}
$today=explode("-",date("Y-m-d"));
switch($_SESSION["dmtemp"]["selmenu"]) {;
	case 1:
		$coupondata=$dbobj->GetList("select * from promo_coupon where stime > ".mktime(0,0,0,$today[1],$today[2],$today[0])." order by etime desc offset ".(20*($_SESSION["coupon"]["page"]-1))." limit 20");
		$dmres=$dbobj->Query("select * from promo_coupon where stime > ".mktime(0,0,0,$today[1],$today[2],$today[0]));
		$maxcount=$dbobj->NumRows($dmres);
	break;
	case 2:
		$coupondata=$dbobj->GetList("select * from promo_coupon where stime  < ".mktime(0,0,0,$today[1],$today[2]+1,$today[0])." and etime > ".mktime(0,0,0,$today[1],$today[2]-1,$today[0])." order by etime desc offset ".(20*($_SESSION["coupon"]["page"]-1))." limit 20");
		$dmres=$dbobj->Query("select * from promo_coupon where stime  < ".mktime(0,0,0,$today[1],$today[2]+1,$today[0])." and etime > ".mktime(0,0,0,$today[1],$today[2]-1,$today[0]));
		$maxcount=$dbobj->NumRows($dmres);
	break;
	case 3:
		$coupondata=$dbobj->GetList("select * from promo_coupon where etime < ".mktime(0,0,0,$today[1],$today[2],$today[0])." order by etime desc offset ".(20*($_SESSION["coupon"]["page"]-1))." limit 20");
		$dmres=$dbobj->Query("select * from promo_coupon where stime < ".mktime(0,0,0,$today[1],$today[2],$today[0]));
		$maxcount=$dbobj->NumRows($dmres);
	break;
	default:
		$coupondata=$dbobj->GetList("select * from promo_coupon order by etime desc offset ".(20*($_SESSION["coupon"]["page"]-1))." limit 20");
		$dmres=$dbobj->Query("select * from promo_coupon");
		$maxcount=$dbobj->NumRows($dmres);
	break;
}
$maxpage=ceil(($maxcount)/20);
unset($_SESSION["coupon"]["target"]);
unset($_SESSION["coupon"]["ryear"]);
unset($_SESSION["coupon"]["rmonth"]);
unset($_SESSION["coupon"]["rday"]);
unset($_SESSION["coupon"]["raddress"]);
unset($_SESSION["coupon"]["rsubjext"]);
unset($_SESSION["coupon"]["rpctxt"]);
unset($_SESSION["coupon"]["rktxt"]);
unset($_SESSION["coupon"]["sendtime"]);
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
</style>
<table width="740" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
				<td>
						<table width="700"  border="0" align="left" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
										<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="5">
														<tr>
																<td class="font10"> <strong>クーポン管理</strong> </td>
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
<div class="helper">クーポン情報を登録登録する場合には<a href="#reg"><font color="#0000FF">こちらをクリック</font></a>してください。 <br>
登録したクーポンの内容を確認したい場合には<strong>「プレビュー」</strong>ボタンをクリックしてください。<br>
                                登録したクーポンの内容を変更したい場合には<strong>「変更」</strong>ボタンをクリックしてください。<br>
                                登録したクーポンの内容を削除したい場合には<strong>「削除」</strong>ボタンをクリックしてください。<br>
	                            リストの左上にあるプルダウンから期限待のクーポン・使用中のクーポン・終了したクーポン・すべてのリストを選択出来ます。			</div>
		    </td>
    </tr>
		<tr>
				<td>&nbsp;</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<form name="form1" id="form1">
												<td>
														<div align="left">
																<select name="selmenu" id="selmenu" onChange="MM_jumpMenu('parent',this,0)">
																		<option value="?PID=promo_coupon&selmenu=1&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==1){ echo " selected";}?>>期限待のクーポン</option>
																		<option value="?PID=promo_coupon&selmenu=2&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==2){ echo " selected";}?>>使用中のクーポン</option>
																		<option value="?PID=promo_coupon&selmenu=3&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==3){ echo " selected";}?>>終了したクーポン</option>
																		<option value="?PID=promo_coupon&selmenu=0&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==0){ echo " selected";}?>>すべてのクーポン</option>
																</select>
														</div>
												</td>
										</form>
								</tr>
					</table>
				</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<td width="41%" bgcolor="#EBEBEB"><strong>クーポン名</strong></td>
										<td width="19%" bgcolor="#EBEBEB"><strong>開始日</strong></td>
										<td width="17%" bgcolor="#EBEBEB"><strong>有効期限</strong></td>
										<td width="9%" nowrap bgcolor="#EBEBEB">
									        <div align="center"><strong>プレビュー</strong></div>
										</td>
										<td width="6%" bgcolor="#EBEBEB">
									        <div align="center"><strong>変更</strong></div>
										</td>
										<td width="8%" bgcolor="#EBEBEB">
									        <div align="center"><strong>削除</strong></div>
										</td>
								</tr>
								<?php
								for($mci=0;$coupondata[$mci]["coupon_id"]!=NULL;$mci++) {
								?>
								<tr>
										<td bgcolor="#FFFFFF"><a href="?PID=promo_coupon_up&coupon_id=<?php echo $coupondata[$mci]["coupon_id"]; ?>"><?php echo $coupondata[$mci]["coupon_name"] ?></a></td>
										<td width="19%" nowrap="nowrap" bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$coupondata[$mci]["stime"]); ?></td>
										<td width="17%" nowrap="nowrap" bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$coupondata[$mci]["etime"]); ?></td>
										<td width="9%" bgcolor="#FFFFFF">
												
										    <div align="center">
										        <input type="button" name="Submit" value="プレビュー" onclick="window.open('coupon.php?coupon_id=<?php echo $coupondata[$mci]["coupon_id"]; ?>&dname=<?php echo $_SESSION["DomainData"]["dbname"]; ?>')" />
									            </div>
										</td>
										<td width="6%" bgcolor="#FFFFFF">
												
										    <div align="center">
										        <input type="button" name="Submit" value="変更" onClick="location.href='?PID=promo_coupon_up&coupon_id=<?php echo $coupondata[$mci]["coupon_id"]; ?>'" />
									            </div>
										</td>
										<td width="8%" bgcolor="#FFFFFF">
												
										    <div align="center">
										        <input type="button" name="Submit" value="削除" onClick="location.href='?PID=promo_coupon_del&coupon_id=<?php echo $coupondata[$mci]["coupon_id"]; ?>'" />
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
				<td height="33">
						<div align="center">
								<?php if($_SESSION["coupon"]["page"]!=NULL&&$_SESSION["coupon"]["page"]!=1){  ?>
								<a href="?PID=promo_coupon&page=<?php echo $_SESSION["coupon"]["page"]-1;?>">
										<?php }?>
										&lt;&lt;　前の10件
										<?php if($_SESSION["coupon"]["page"]!=NULL&&$_SESSION["coupon"]["page"]!=1){  ?>
								</a>
								<?php }?>
								<?php for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["coupon"]["page"]) {
		  		echo " <strong><font color=\"#FF6600\">".$prows."</font></strong> ";
			}
			else {
		  		echo " <a href=\"?PID=promo_coupon&page=".$prows."\">".$prows."</a> ";
			}
		  
		  }?>
								<?php if($maxpage!=$_SESSION["coupon"]["page"]) {?>
								<a href="?PID=promo_coupon&page=<?php echo $_SESSION["coupon"]["page"]+1;?>">
										<?php } ?>
										次の10件　&gt;&gt;
										<?php if($maxpage!=$_SESSION["coupon"]["page"]) {?>
								</a>
								<?php } ?>
						</div>
				</td>
		</tr>
		<tr>
		    <td>&nbsp;</td>
    </tr>
		<tr>
		    <td height="33">
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
                                                            <td class="font10"> <strong>クーポン情報登録</strong> <a name="reg"></a></td>
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
								if($_GET["mode"]=="regist") {
								?>
                            <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <td width="150" valign="top" bgcolor="#EBEBEB">有効期限</td>
                                    <td bgcolor="#FFFFFF"><?php echo $_REQUEST["ryear"];?>年<?php echo $_REQUEST["rmonth"];?>月<?php echo $_REQUEST["rday"];?>日〜<?php echo $_REQUEST["eyear"];?>年<?php echo $_REQUEST["emonth"];?>月<?php echo $_REQUEST["eday"];?>日</td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#EBEBEB">クーポン名</td>
                                    <td bgcolor="#FFFFFF"><?php echo $_REQUEST["coupon_name"];?></td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#EBEBEB">PC用タイトル</td>
                                    <td bgcolor="#FFFFFF"><?php echo $_REQUEST["pc_title"];?></td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#EBEBEB">PC用本文</td>
                                    <td bgcolor="#FFFFFF"> <?php echo $_REQUEST["pc_comm"];?> </td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#EBEBEB">携帯タイトル</td>
                                    <td bgcolor="#FFFFFF"> <?php echo $_REQUEST["k_title"];?> </td>
                                </tr>
                                <tr>
                                    <td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
                                    </td>
                                    <td bgcolor="#FFFFFF"> <?php echo $_REQUEST["k_comm"];?> </td>
                                </tr>
                            </table>
                            <?php 
				}
				else {
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
<?php
$today=explode("-",date("Y-m-d",time()));
if($_REQUEST["mode"]=="regist") {
	$maxdata=$dbobj->GetData("select max(coupon_id) as maxid from promo_coupon");
	$maxid=$maxdata["maxid"]+1;
	$rtime=mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"]);
	$etime=mktime(0,0,0,$_REQUEST["emonth"],$_REQUEST["eday"],$_REQUEST["eyear"]);
	
	$insql="insert into promo_coupon values(".$maxid.",'".$_REQUEST["coupon_name"]."','".$_REQUEST["pc_title"]."','".$_REQUEST["pc_comm"]."','','".$_REQUEST["k_title"]."','".$_REQUEST["k_comm"]."','',$rtime,$etime)";
	$chkres=$dbobj->Query($insql);
		$_REQUEST="";
		?>
<script language="javascript">
		location.replace("index.php?PID=promo_coupon");
		</script>
<?php
	$exday=explode("-",date("Y-m-d-H-i",$rtime));
	$RDATE=date("Ymd",$rtime); 
}
else if($_GET["sendtime"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",$_GET["sendtime"]));
	$RDATE=date("Ymd",$_GET["sendtime"]); 
	$_REQUEST["sendtime"]=$_GET["sendtime"];
}
else if($_REQUEST["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])); 
}
else if($_REQUEST["ryear"]!=NULL){
	$exday=explode("-",date("Y-m-d-H-i",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])));
	$RDATE=date("Ymd",mktime(0,0,0,$_REQUEST["rmonth"],$_REQUEST["rday"],$_REQUEST["ryear"])); 
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
</script>
<script><!--
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
		alert(dft_date);
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
	if(alertchk==0) {
		updateRTEs();
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
                            <script language="JavaScript" type="text/javascript" src="/CrBrow/richtext.js"></script>
                            <script language="JavaScript" type="text/javascript" src="/CrBrow/emojiin2.js"></script>
                            <script language="JavaScript" type="text/javascript" src="/CrBrow/emojichg.js"></script>
                            <script language="JavaScript" type="text/javascript">
				<!--
				// Cross-Browser Rich Text Editor初期化
				initRTE("/CrBrow/images/", "", "");
				//-->
				</script>
<div class="helper"> クーポンを登録します。<br>
各項目を入力して<strong>「登録する」</strong>ボタンをクリックしてください。<br>
携帯用タイトルと携帯用本文の項目では右側の携帯各社のアイコンをクリックすると絵文字を利用する事が出来ます。<br>
会員登録時のクーポンの設定は<a href="?PID=promo_setting"><font color="#0000FF">初期設定ページ</font></a>の登録時ｸｰﾎﾟﾝﾀｲﾄﾙと登録時ｸｰﾎﾟﾝ本文で入力してください。</div>                                
<br>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                            <form name="update_form" method="post" action="" onsubmit="datachk()">
                                    <tr>
                                        <td width="150" valign="top" bgcolor="#EBEBEB">有効期限</td>
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
                                        <td valign="top" bgcolor="#EBEBEB">クーポン名
                                            <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
                                        </td><td bgcolor="#FFFFFF">
                                            <input name="coupon_name" type="text" id="coupon_name" size="40" value="<?php echo $_REQUEST["coupon_name"];?>"  style="width:98%;"/>
                                            <br>
                                            <div>管理ページでの識別用ですので分かりやすい名前をつけてください。</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#EBEBEB">PC用タイトル</td>
                                        <td bgcolor="#FFFFFF">
                                            <input name="pc_title" type="text" id="pc_title" size="40" value="<?php echo $_REQUEST["pc_title"];?>" style="width:98%;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#EBEBEB">PC用本文</td>
                                        <td bgcolor="#FFFFFF">
                                            <textarea name="pc_comm" cols="60" rows="10" id="pc_comm" style="width:98%;"><?php echo $_REQUEST["pc_comm"];?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#EBEBEB">携帯用タイトル</td>
                                        <td bgcolor="#FFFFFF">
                                            <script language="JavaScript" type="text/javascript">
<!--
writeRichText('text', 'update_form', 'k_title', '<?php echo str_replace("\r","",str_replace("\n","\\n",$_REQUEST["k_title"]));?>', 450, 20, false, false ,'side', 12);
//-->
                </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
                                        </td>
                                        <td bgcolor="#FFFFFF">
                                            <script language="JavaScript" type="text/javascript">
<!--
writeRichText('textfield', 'update_form', 'k_comm', '<?php echo nl2br($_REQUEST["k_comm"]);?>', 450, 200, false, false ,'side', 12);
//-->
                </script>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
                                        <td bgcolor="#FFFFFF">
                                            <input type="submit" name="Submit" value="登録する" />
                                            <input name="mode" type="hidden" id="mode" value="regist" />
                                        </td>
                                    </tr>
                            </form>
                            </table>
                            <?php 
								}
								?>
                        </td>
                    </tr>
                </table>
		    </td>
    </tr>
</table>
