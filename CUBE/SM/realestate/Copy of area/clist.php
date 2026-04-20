<?php
$re1obj=new Admin_RE_Area($dbobj);
$re1obj->type=1;
if($_REQUEST["update_re"]=="更新する") {
	
}

//$re1data=$re1obj->GetDataList(1);
//print_r($re1data);
$re1data=$dbobj->GetList("select distinct(area_id),pref,address1 from re_area_master where area_id =".$_REQUEST["bid"]);

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
history.back();
}
</script>
<style type="text/css">
<!--
.btmwidth_100 {
	width: 100px;
	font-weight: bold;
	text-transform: uppercase;
	text-align: center;
	height: 40px;
}
-->
</style>
<script language="javascript">
function realestate_move(mode) {
	location.replace("index.php?mode=lease_"+mode+"&realestate_id=");
}
function chsyougaku(){
	//alert(data.value);
	document.bukken_form.syougakkouku.value=document.bukken_form.syougakkou.value;
}
function chchugaku(){
	//alert(data.value);
	document.bukken_form.chuugakouku.value=document.bukken_form.chugakkou.value;
}
function zipcode() {
	var zipcode;
	var address;
	zipcode=document.bukken_form.yubinbangou.value;
	result=showModalDialog("tool/zipsearch.php?zipcode="+zipcode,"test");
	address=result.split(",");
	document.bukken_form.todouhuken.value=address[0];
	document.bukken_form.jyusyo1.value=address[1];
	document.bukken_form.jyusyo2.value=address[2];
}

function realestate_move(mode) {
	location.replace("index.php?PAGEID=realestate&mode=lease_"+mode+"&realestate_id=");
}

function gotolist() {
	location.replace("index.php?PID=re_b1");
}
function goreplace(bid,pref,add) {

	location.href="?PID=re_area_up&area_id="+bid+"&p="+pref+"&a="+add;
	
}

function godelete(bid,pref,add) {

	location.href="index.php?PID=re_area_del&area_id="+bid+"&p="+pref+"&a="+add;
	
}

function gorealestatetop() {

 location.replace("index.php?PAGEID=realestate");
 
}

</script>
<TABLE width="700"  border="0" align="left" cellpadding="3" cellspacing="1" class="realestate_bgcolor1">
		<TR class="realestate_bgcolor2">
				<TD valign="top">
						<form action="" method="post" enctype="multipart/form-data" name="bukken_form">
								<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
										<tr>
												<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
												<td>
														<table width="100%"  border="0" cellspacing="0" cellpadding="5">
																<tr>
																		<td bgcolor="#FFFFFF" class="font10">
																				<p><strong><font color="#000000">地域修正 </font> </strong></p>
																		</td>
																</tr>
														</table>
												</td>
										</tr>
								</table>
								<br />
								<table width="700"  border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC" class="realestate_bgcolor1">
										<tr bgcolor="#EABFC7" class="realestate_bgcolor2">
												<td bgcolor="#EBEBEB"> 
														<div class="font14">
																<div align="left"><strong>地域</strong></div>
												</div>														<div align="center" class="font14"></div></td>
												<td bgcolor="#EBEBEB"><div align="center"><strong>修正</strong></div></td>
												<td width="50" bgcolor="#EBEBEB">
														<div align="center" class="font14"><strong>削除</strong></div>
												</td>
										</tr>
										<?php
													for($re1rows=0;$re1data[$re1rows]["area_id"]!=NULL;$re1rows++) {
													?>
										<tr bgcolor="#EABFC7" class="realestate_bgcolor3">
												<td width="570" bgcolor="#FFFFFF" class="font14"><span class="font12">
										  </span><?php echo $re1data[$re1rows]["pref"].$re1data[$re1rows]["address1"].$re1data[$re1rows]["address2"];?>
										  <div align="center">														</div></td>
												<td width="58" bgcolor="#FFFFFF" class="font14"><div align="center">
												  <input type="button" name="Submit" value="修正" onclick="goreplace('<?php echo $re1data[$re1rows]["area_id"];?>','<?php echo urlencode($re1data[$re1rows]["pref"]);?>','<?php echo urlencode($re1data[$re1rows]["address1"]);?>')" />
											    </div></td>
												<td bgcolor="#FFFFFF">
														<div align="center">
																<input type="button" name="Submit" value="削除" onclick="godelete('<?php echo $re1data[$re1rows]["area_id"];?>','<?php echo urlencode($re1data[$re1rows]["pref"]);?>','<?php echo urlencode($re1data[$re1rows]["address1"]);?>')" />
														</div>
												</td>
										</tr>
										<?php
					}
					?>
								</table>
								<br>
								<input type="button" name="Submit" value="新規地域登録" onClick="location.replace('?PID=re_area_chiiki_reg&area_id=<?php echo $_REQUEST["bid"]
								;?>')">
								<input type="button" name="Submit" value="エリア一覧に戻る" onClick="location.href='?PID=re_area'">
								<br>
								<br>
						</form>
				</TD>
		</TR>
</TABLE>
