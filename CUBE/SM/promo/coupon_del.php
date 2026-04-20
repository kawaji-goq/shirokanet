<?php

if($_POST["mode"]=="update") {
	$insql=	"delete from promo_coupon where coupon_id=".$_REQUEST["coupon_id"];
	$chkres=$dbobj->Query($insql);
	if(!$chkres){
		$_POST["mode"]="";
		$errmess="変更に失敗しました。";
	}
	else {
	?>
	<script language="javasctipt">
	location.replace("index.php?PID=promo_coupon");
	</script>
	<?php	
	}
	?>
	<script language="javasctipt">
	location.replace("index.php?PID=promo_coupon");
	</script>
	<?php	
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
<script>

function datachk() {
	var frm=document.update_form;
	var alertchk=0;
	var alerttxt="";
	if(alertchk==0) {
			frm.submit();
		
	}else {
			alert(alerttxt);
		}
}
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
		<form name="update_form" method="post" action="">
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
																								<td class="font10"> <strong>クーポン情報削除</strong> </td>
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
								if($_REQUEST["mode"]=="update") {
								
								?>	<script language="javascript">
	location.replace("index.php?PID=promo_coupon");
	</script>
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
							<div class="helper"> クーポン情報を削除します。<br>
内容を確認して削除してもよければ<strong>「削除する」</strong>ボタンをクリックしてください。<br>
							</div>
								<br>
								<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
										<tr>
												<td width="150" valign="top" bgcolor="#EBEBEB">有効期限</td>
												<td bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$_REQUEST["stime"]);?>〜												<?php echo date("Y年m月d日",$_REQUEST["etime"]);?></td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">クーポン名</td>
												<td bgcolor="#FFFFFF">
														<?php echo $_REQUEST["coupon_name"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用タイトル</td>
												<td bgcolor="#FFFFFF">
													<?php echo $_REQUEST["pc_title"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">PC用本文</td>
												<td bgcolor="#FFFFFF">
														<?php echo nl2br($_REQUEST["pc_comm"]);?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用タイトル
														      <input name="dft_dat" type="hidden" id="dft_dat" value="<?php echo $RDATE;?>" />
														      <input name="dft_dat2" type="hidden" id="dft_dat2" value="<?php echo $RDATE2;?>" />
												</td>
												<td bgcolor="#FFFFFF">
														<?php echo $_REQUEST["k_title"];?>												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">携帯用本文<br />
												</td>
												<td bgcolor="#FFFFFF">
														<label>
														<?php echo nl2br($_REQUEST["k_comm"]);?>														</label>
												</td>
										</tr>
										<tr>
												<td valign="top" bgcolor="#EBEBEB">&nbsp;</td>
												<td bgcolor="#FFFFFF">
														<input type="button" name="Submit" value="削除する" onclick="datachk()" />
														<input type="button" name="Submit" value="一覧へ戻る"onclick="location.replace('?PID=promo_coupon&page=1');" />
														<input name="mode" type="hidden" id="mode" value="update" />
														<input name="coupon_id" type="hidden" id="coupon_id" value="<?php echo $_REQUEST["coupon_id"];?>" />
												</td>
										</tr>
							</table>
								<script language="javascript">
</script><?php 
								}
								?>
						</td>
				</tr>
		</form>
</table>
