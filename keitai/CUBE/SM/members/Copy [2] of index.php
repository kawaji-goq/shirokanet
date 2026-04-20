<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<?php

$_SESSION["memberid"]="";
$_SESSION["member_password"]="";
$_SESSION["new_membername"]="";
$_SESSION["new_zipcode"]="";
$_SESSION["new_address"]="";
$_SESSION["new_telnumber"]="";
$_SESSION["new_faxnumber"]="";
$_SESSION["new_url"]="";
$_SESSION["new_mail"]="";
$_SESSION["new_hurigana"]="";

$sql="select * from member order by turn ";
$result=$dbobj->Query($sql);
$resultnumrows=$dbobj->NumRows($result);

if($resultnumrows!=0) {
	$rows=0;
	while($rows<$resultnumrows) {
		$data[$rows]=$dbobj->FetchArray($result,$rows);
		$rows++;
	}
}

?>
<table width="700" border="0" align="center" cellpadding="2" cellspacing="2">
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<table width="98%" border="0" align="center" cellpadding="2" cellspacing="2">
            	<tr>
            		<td width="23%" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            			<div align="center"><strong>名　　　　称</strong></div>
           			</td>
            		<td width="23%" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            			<div align="center"><strong>住　　　　所</strong></div>
           			</td>
            		<td width="20%" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            			<div align="center"><strong>電話番号<br>
           				FAX番号            			</strong></div>
           			</td>
            		<td width="4%" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            			<div align="center"><strong>HP</strong></div>
           			</td>
            		<td width="4%" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            			<div align="center"><strong>Mail</strong></div>
           			</td>
            		<form name="form3" method="get" action="">
            			<td colspan="2" background="http://siteadmin.itcube.ne.jp/gw/img/filemenu_bg.gif">
            				<table border="0" align="right" cellpadding="0" cellspacing="0">
            					<tr>
            						<td>
            							<div align="right"> <strong>
            								<input name="PID" type="hidden" id="PID" value="members_add">
            								<input type="submit" name="Submit" value="新規追加">
            								</strong></div>
           							</td>
           						</tr>
            					</table>
           				</td>
           			</form>
           		</tr>
            	<?php
$rows=0;
while($data[$rows][member_id]!=NULL) {
?>
            	<tr>
            		<td colspan="7" class="line"></td>
           		</tr>
            	<tr>
            		<td align="left" valign="top">
            			<font size="2"><?php echo $data[$rows][member_name];?><br>
       				</font></td>
            		<td valign="top">
            			<div align="left"><font size="2"><?php echo $data[$rows]["zipcode"]."<br>
".$data[$rows]["address"];?></font></div>
           			</td>
            		<td valign="top">
            			<div align="center"><font size="2"><?php echo $data[$rows]["telnumber"];?><br>
            					<?php echo $data[$rows]["faxnumber"];?><br>
            			</font></div>
           			</td>
            		<td valign="top">
            			<div align="center"><font size="2">
            				<?php if($data[$rows][homepage]!=NULL) {echo "<a href=\"".$data[$rows][homepage]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
            				</font></div>
           			</td>
            		<td valign="top">
            			<div align="center"><font size="2">
            				<?php if($data[$rows][mailaddress]!=NULL) {echo "<a href=\"mailto:".$data[$rows][mailaddress]."\" target=\"_blank\">○</a>";}else {echo "-";}?>
            				</font></div>
           			</td>
            		<form name="form1" method="get" action="">
            			<td width="11%">
            				<div align="center">
            						<input type="button" name="Submit" value="修正する" onClick="location.href='?PID=members_correct&member_id=<?php echo $data[$rows][member_id];?>'">
           					</div>
           				</td>
           			</form>
            		<form name="form2" method="get" action="">
            			<td width="15%">
            				<div align="center"><?php
										if($data[$rows][member_id]!=0) {
										?>
            					<input type="button" name="Submit" value="削除する" onClick="location.href='?PID=members_del&member_id=<?php echo $data[$rows][member_id];?>'">
           					<?php
										}
										?></div>
           				</td>
           			</form>
           		</tr>
            	<?php
$rows++;
}
?>
           	</table>
		</td>
	</tr>
</table>
<br>
