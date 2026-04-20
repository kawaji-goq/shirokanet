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
			//$List=$dbobj->GetList("select distinct(address1),address_h1,code from zipcode2 where code like '".$c."%' order by address_h1");
			$List=$dbobj->GetList("select distinct(address1),address_h1 from zipcode2 where pref like '".$c."%' order by address_h1");
			break;
		case "c2":
			$List=$dbobj->GetList("select distinct(address2),address_h2,zipcode from zipcode2 where code ='".$c."'  order by zipcode");
			break;
	}
	
	return $List;
}

function AddSearchName($p,$a) {
	$dbobj=Cube_DB :: UseDB("postgresql");
	$dbobj->name="common";
	$dbobj->Connect();
	$List=$dbobj->GetList("select * from zipcode2 where pref like '".$p."%' and address1 like '".$a."%' order by address_h2");
	//echo "select * from zipcode2 where pref like '".$p."%' and address1 like '".$a."%' and address2 <> '以下に掲載がない場合' order by address_h2";
	return $List;
}

if($_REQUEST["update_area"]=="登録する") {
	$dbobj->Query("delete from re_area_master where area_id= ".$_REQUEST["area_id"]." and pref like '".$_REQUEST["p"]."' and address1 like '".$_REQUEST["a"]."%'");
	
	for($i=0;$_REQUEST["area_name"][$i]!=NULL;$i++) {
		$maxdata=$dbobj->GetData("select max(re_area_id) as maxid from re_area_master");
		$maxid=$maxdata["maxid"]+1;
		if($_REQUEST["area_name"][$i]=="以下に掲載がない場合") {
			$_REQUEST["area_name"][$i]="";
		}
		$dbobj->Query("insert into re_area_master values(".$maxid.",".$_REQUEST["area_id"].",'".$_REQUEST["p"]."','".$_REQUEST["a"]."','".$_REQUEST["area_name"][$i]."',".$maxid.")");
		//echo "insert into re_area_master set values(".$maxid.",".$_REQUEST["area_id"].",'".$_REQUEST["p"]."','".$_REQUEST["a"]."','".$_REQUEST["area_name"][$i]."',".$maxid.")";
	}
	?>
	<script language="javascript">
	location.replace("?PID=re_area_clist&bid=<?php echo $_REQUEST["area_id"];?>");
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
    <TD valign="top"> <form action="" method="post" enctype="multipart/form-data" name="bukken_form"> 
        <table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border"> 
          <tr> 
            <td width="15" bgcolor="#CCCCCC">&nbsp; </td> 
            <td> <table width="100%"  border="0" cellspacing="0" cellpadding="5"> 
                <tr> 
                  <td bgcolor="#FFFFFF" class="font10"> <p><strong><font color="#000000">地域登録</font></strong></p></td> 
                </tr> 
              </table></td> 
          </tr> 
        </table> 
        <br /> 
        <?php 
		if($_REQUEST["step"]==3) {
			$relist=$dbobj->GetList("select address2 from re_area_master where area_id=".$_REQUEST["area_id"]." and pref like '".$_REQUEST["p"]."' and address1='".$_REQUEST["a"]."'");
			$alist=AddSearchName($_GET["p"],$_GET["a"]);
			
			for($i=0;$alist[$i]["address2"]!=NULL;$i++) {
				$arealist[$i/4][$i%4]=str_replace("（","",str_replace("）","",$alist[$i]["address2"]));
			}

		?> 
        <table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC"> 
          <tr> 
            <td colspan="4" bgcolor="#EBEBEB"><?php echo $_GET["p"].$_GET["a"];?></td> 
          </tr> 
          <?php
								for($j=0;$arealist[$j][0]!=NULL;$j++){
								?> 
          <tr> 
            <td width="25%" bgcolor="#FFFFFF"> <?php if($arealist[$j][0]!=NULL) {?> 
              <input name="area_name[]" type="checkbox" id="area_name[]" value="<?php echo $arealist[$j][0];?>"<?php if(AdAry_Search($arealist[$j][0],$relist)==1){ echo " checked" ;}?> /> 
              <?php
		echo $arealist[$j][0];
?> 
              <?php 
}?></td> 
            <td width="25%" bgcolor="#FFFFFF"> <?php if($arealist[$j][1]!=NULL) {?> 
              <input name="area_name[]" type="checkbox" id="area_name[]" value="<?php echo $arealist[$j][1];?>" <?php if(AdAry_Search($arealist[$j][1],$relist)==1){ echo " checked" ;}?>/> 
              <?php
									echo $arealist[$j][1];
									?> 
              <?php 
}?> </td> 
            <td width="25%" bgcolor="#FFFFFF"> <?php if($arealist[$j][2]!=NULL) {?> 
              <input name="area_name[]" type="checkbox" id="area_name[]" value="<?php echo $arealist[$j][2];?>"<?php if(AdAry_Search($arealist[$j][2],$relist)==1){ echo " checked" ;}?> /> 
              <?php
									echo $arealist[$j][2];
									?> 
              <?php 
}?> </td> 
            <td width="25%" bgcolor="#FFFFFF"> <?php if($arealist[$j][3]!=NULL) {?> 
              <input name="area_name[]" type="checkbox" id="area_name[]" value="<?php echo $arealist[$j][3];?>"<?php if(AdAry_Search($arealist[$j][3],$relist)==1){ echo " checked" ;}?> /> 
              <?php
									echo $arealist[$j][3];
									?> 
              <?php 
}?> </td> 
          </tr> 
          <?php
								}								
								?> 
        </table> 
        <br /> 
        <input name="update_area" type="submit" id="update_area" value="登録する" /> 
        <input type="button" name="Submit" value="戻る" onclick="history.back()" /> 
        <input name="re_area_id" type="hidden" id="re_area_id" value="<?php echo $_REQUEST["area_id"];?>" /> 
        <input name="p" type="hidden" id="p" value="<?php echo $_REQUEST["p"];?>" /> 
        <input name="a" type="hidden" id="a" value="<?php echo $_REQUEST["a"];?>" /> 
        <?php 
		}
		else if($_REQUEST["step"]==2) {
		$alist=AddSearch("c1",$_GET["p"]);
		for($i=0;$alist[$i]["address1"]!=NULL;$i++) {
			$arealist[$i/4][$i%4]=str_replace("（","",str_replace("）","",$alist[$i]["address1"]));
		}		
		?>
        <table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td colspan="4" bgcolor="#EBEBEB"><?php echo $_GET["p"];?></td>
          </tr>
          <?php
								for($j=0;$arealist[$j][0]!=NULL;$j++){
								?>
          <tr>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=3&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($_REQUEST["p"]);?>&a=<?php echo urlencode($arealist[$j][0]);?>">
              <?php if($arealist[$j]!=NULL) {
		echo $arealist[$j][0];
}?>
            </a></td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&area_id=<?php echo $_REQUEST["area_id"];?>&step=3&p=<?php echo urlencode($_REQUEST["p"]);?>&a=<?php echo urlencode($arealist[$j][1]);?>">
              <?php if($arealist[$j][1]!=NULL) {
									echo $arealist[$j][1];
									
}?>
            </a> </td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=3&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($_REQUEST["p"]);?>&a=<?php echo urlencode($arealist[$j][2]);?>">
              <?php if($arealist[$j][2]!=NULL) {
									echo $arealist[$j][2];
									
}?>
            </a> </td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=3&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($_REQUEST["p"]);?>&a=<?php echo urlencode($arealist[$j][3]);?>">
              <?php if($arealist[$j][3]!=NULL) {
									echo $arealist[$j][3];
									
}?>
            </a> </td>
          </tr>
          <?php
								}								
								?>
        </table>
		<?php
		}
		else {
		$alist=AddSearch($m,$c);
		for($i=0;$alist[$i]["pref"]!=NULL;$i++) {
			$arealist[$i/4][$i%4]=str_replace("（","",str_replace("）","",$alist[$i]["pref"]));
		}		
		?>

		<table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <td colspan="4" bgcolor="#EBEBEB"><strong>都道府県を選択してください。</strong></td>
          </tr>
          <?php
								for($j=0;$arealist[$j][0]!=NULL;$j++){
								?>
          <tr>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=2&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($arealist[$j][0]);?>"><?php if($arealist[$j]!=NULL) {
		echo $arealist[$j][0];
}?></a></td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=2&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($arealist[$j][1]);?>"><?php if($arealist[$j][1]!=NULL) {
									echo $arealist[$j][1];
									
}?></a>
            </td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=2&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($arealist[$j][2]);?>"><?php if($arealist[$j][2]!=NULL) {
									echo $arealist[$j][2];
									
}?></a>
            </td>
            <td width="25%" bgcolor="#FFFFFF">
              <a href="?PID=re_area_chiiki_reg&step=2&area_id=<?php echo $_REQUEST["area_id"];?>&p=<?php echo urlencode($arealist[$j][3]);?>"><?php if($arealist[$j][3]!=NULL) {
									echo $arealist[$j][3];
									
}?></a>
            </td>
          </tr>
          <?php
								}								
								?>
        </table>
		<?php
		}
		?> 
      </form></TD> 
  </TR> 
</TABLE> 
