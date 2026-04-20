<?php
	mb_language("japanese");
	mb_internal_encoding("EUC-JP");
//$re1obj=new Admin_RE_Area($dbobj);
if(!class_exists("Cube_DB")) {
	include "ITC/modules.php";
}
function AddSearch($m,$c) {
	if($m==NULL) {
		$m="p";
	}
	$dbobj=Cube_DB :: UseDB("postgresql");
	$dbobj->name="common";
	$dbobj->Connect();
	
	switch($m) {
		case "p":
			$List=$dbobj->GetList("select pref,code from prefcode order by code");
			break;
		case "c1":
			$List=$dbobj->GetList("select distinct(address1),address_h1,code from zipcode2 where code like '".$c."%' order by address_h1");
			break;
		case "c2":
			$List=$dbobj->GetList("select distinct(address2),address_h2 from zipcode2 where code ='".$c."' and address2 <> '以下に掲載がない場合' order by address_h2");
			break;
	}
	
	return $List;
}

function AddSearchName($p,$a) {
	$dbobj=Cube_DB :: UseDB("postgresql");
	$dbobj->name="common";
	$dbobj->Connect();
	$List=$dbobj->GetList("select * from zipcode2 where pref like '".$p."%' and address1 like '".$a."%' and address2 <> '以下に掲載がない場合' order by address_h2");
	//echo "select * from zipcode2 where pref like '".$p."%' and address1 like '".$a."%' and address2 <> '以下に掲載がない場合' order by address_h2";
	return $List;
}

if($_REQUEST["update_area"]=="削除する") {
	$dbobj->Query("delete from re_area_master where area_id= ".$_REQUEST["area_id"]." and pref like '".$_REQUEST["p"]."' and address1 like '".$_REQUEST["a"]."%'");
?>
<script language="javascript">
location.replace('?PID=re_area_clist&bid=<?php echo $_REQUEST["area_id"];?>');
</script>
<?php
}
function AdAry_Search($text,$ary) {
	for($i=0;$ary[$i]["address2"]!=NULL;$i++) {
		if($ary[$i]["address2"]==$text) {
			return 1;
		}
	}
	return 0;
}
//$re1data=$re1obj->GetDataList(1);
$alist=$dbobj->GetList("select address2 from re_area_master where area_id=".$_REQUEST["area_id"]." and pref like '".$_REQUEST["p"]."' and address1='".$_REQUEST["a"]."'");
//$alist=AddSearchName($_GET["p"],$_GET["a"]);

for($i=0;$alist[$i]["address2"]!=NULL;$i++) {
	$arealist[$i/4][$i%4]=str_replace("（","",str_replace("）","",$alist[$i]["address2"]));
}

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

	location.href="?PID=re_area_up&bid="+bid;
	
}

function godelete(bid) {

	location.href="index.php?PID=re_b1_del&bid="+bid;
	
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
																				<p><strong><font color="#000000">地域削除</font> </strong></p>
																		</td>
																</tr>
														</table>
												</td>
										</tr>
								</table>
								<br />
								<table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								
								<tr>
										<td colspan="4" bgcolor="#EBEBEB"><?php echo $_GET["p"].$_GET["a"];?></td>
								  </tr>
								
								<?php
								for($j=0;$arealist[$j][0]!=NULL;$j++){
								?><tr>
								<td width="25%" bgcolor="#FFFFFF">
<?php if($arealist[$j][0]!=NULL) {?>
<?php
		echo $arealist[$j][0];
?><?php 
}?></td>
								<td width="25%" bgcolor="#FFFFFF">
									<?php if($arealist[$j][1]!=NULL) {?>
									<?php
									echo $arealist[$j][1];
									?>
									<?php 
}?>
</td>
								<td width="25%" bgcolor="#FFFFFF">
											<?php if($arealist[$j][2]!=NULL) {?>
											<?php
									echo $arealist[$j][2];
									?>
											<?php 
}?>
</td>
								<td width="25%" bgcolor="#FFFFFF">	
													<?php if($arealist[$j][3]!=NULL) {?>
													<?php
									echo $arealist[$j][3];
									?>
													<?php 
}?>
</td>
								</tr><?php
								}								
								?>
						</table>
								<br />
								<input name="update_area" type="submit" id="update_area" value="削除する" />
								<input type="button" name="Submit" value="戻る" onclick="history.back()" />
								<input name="re_area_id" type="hidden" id="re_area_id" value="<?php echo $_REQUEST["area_id"];?>" />
								<input name="p" type="hidden" id="p" value="<?php echo $_REQUEST["p"];?>" />
								<input name="a" type="hidden" id="a" value="<?php echo $_REQUEST["a"];?>" />
						</form>
				</TD>
		</TR>
</TABLE>
