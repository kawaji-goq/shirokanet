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
.helper1 {	line-height:25px;
	margin:1px;
	padding:4px;
	background-color:#fcfcfc;
	border:solid;
	border:#ECECEC;
	border:1px;"
}
</style>

<?php
unset($_SESSION["dm"]);
if($_GET["lim"]!=NULL) {
	$_SESSION["dm"]["lim"]=$_GET["lim"];
}
else {
	$_SESSION["dm"]["lim"]=20;
}
if($_GET["page"]!=NULL) {
	$_SESSION["dm"]["page"]=$_GET["page"];
}
else if($_SESSION["dm"]["page"]==NULL) {
	$_SESSION["dm"]["page"]=1;
}

if($_GET["selmenu"]!=NULL) {
	$_SESSION["dmtemp"]["selmenu"]=$_GET["selmenu"];
}
else if($_SESSION["dmtemp"]["selmenu"]==NULL) {
	$_SESSION["dmtemp"]["selmenu"]=1;
}
switch($_SESSION["dmtemp"]["selmenu"]) {;
	case 2:
		$dmdata=$dbobj->GetList("select * from direct_mail where sendtime < ".time()." order by sendtime desc offset ".$_SESSION["dm"]["lim"]*($_SESSION["dm"]["page"]-1)." limit ".$_SESSION["dm"]["lim"]);
		$dmres=$dbobj->Query("select * from direct_mail where sendtime < ".time());
		$maxcount=$dbobj->NumRows($dmres);
	break;
	case 1:
		$dmdata=$dbobj->GetList("select * from direct_mail where sendtime >= ".time()." order by sendtime desc  offset ".$_SESSION["dm"]["lim"]*($_SESSION["dm"]["page"]-1)." limit ".$_SESSION["dm"]["lim"]);
		$dmres=$dbobj->Query("select * from direct_mail where sendtime >= ".time());
		$maxcount=$dbobj->NumRows($dmres);
	break;
	default:
		$dmdata=$dbobj->GetList("select * from direct_mail order by sendtime desc  offset ".$_SESSION["dm"]["lim"]*($_SESSION["dm"]["page"]-1)." limit ".$_SESSION["dm"]["lim"]);
		$dmres=$dbobj->Query("select * from direct_mail");
		$maxcount=$dbobj->NumRows($dmres);
	break;
}

$maxpage=ceil(($maxcount)/$_SESSION["dm"]["lim"]);

unset($_SESSION["dm"]["target"]);
unset($_SESSION["dm"]["ryear"]);
unset($_SESSION["dm"]["rmonth"]);
unset($_SESSION["dm"]["rday"]);
unset($_SESSION["dm"]["raddress"]);
unset($_SESSION["dm"]["rsubjext"]);
unset($_SESSION["dm"]["rpctxt"]);
unset($_SESSION["dm"]["rktxt"]);
unset($_SESSION["dm"]["sendtime"]);

?>
<table width="800" border="0" align="left" cellpadding="0" cellspacing="0">
		<tr>
				<td>
						<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
								  <td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="5">
														<tr>
																<td class="font10"> <strong>メール配信TOP</strong> </td>
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
				<td>                                    <div  class="helper">メールを配信するにはリストの下にある<strong>「配信登録」</strong>ボタン、または<a href="?PID=promo_dm_reg"><font color="#0000FF">こちらをクリック</font></a>してください。<br>
				  以前配信したメールを元に新規に配信登録する場合は「<strong>コピーして配信登録</strong>」
				  をクリックしてください。<br>
                                登録したメール配信の内容を確認したい場合には<strong>「確認」</strong>ボタンをクリックしてください。<br>
                                登録したメール配信の内容を変更したい場合には<strong>「変更」</strong>ボタンをクリックしてください。<br>
                                登録したメール配信の内容を削除したい場合には<strong>「削除」</strong>ボタンをクリックしてください。<br>
	                            リストの左上にあるプルダウンから配信待リスト・配信済リスト・すべてのリストを選択出来ます。	                            
			</div>
				<br>
</td>
		</tr>
		<tr>
				<td>
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<form name="form1" id="form1">
												<td>
														<div align="left">
																<select name="selmenu" id="selmenu" onchange="MM_jumpMenu('parent',this,0)">
																		<option value="?PID=promo_dm&selmenu=1&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==1||$_SESSION["dmtemp"]["selmenu"]==NULL){ echo " selected";}?>>配信待リスト</option>
																		<option value="?PID=promo_dm&selmenu=2&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==2){ echo " selected";}?>>配信済リスト</option>
																		<option value="?PID=promo_dm&selmenu=0&page=1"<?php if($_SESSION["dmtemp"]["selmenu"]==0){ echo " selected";}?>>すべてのリスト</option>
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
						<table width="800" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
								<tr>
										<td width="260" bgcolor="#EBEBEB">件名</td>
										<td width="100" bgcolor="#EBEBEB">予定日</td>
										<td width="77" bgcolor="#EBEBEB">予定時刻</td>
										<td width="63" bgcolor="#EBEBEB">状況</td>
										<td bgcolor="#EBEBEB">
										    <div align="center">確認</div>
										</td>
								        <td bgcolor="#EBEBEB">
								            <div align="center">コピーして新規登録</div>
								        </td>
								        <td bgcolor="#EBEBEB">
								            <div align="center">変更</div>
								        </td>
								        <td bgcolor="#EBEBEB">
								            <div align="center">削除</div>
								        </td>
								</tr>
								<?php
								for($mci=0;$dmdata[$mci]["sendtime"]!=NULL;$mci++) {
		$res=$adminobj->Query("select * from mail_queue where dm_id = ".$dmdata[$mci]["dm_id"]." and dbname = '".$_SESSION["DomainData"]["dbname"]."'");
										$resnumrows=$adminobj->NumRows($res);								?>
							<?php if($resnumrows!=0&&$resnumrows!=NULL) {?>	<tr>
										<td bgcolor="#FFFFFF"><?php if($resnumrows!=0) {?><a href="?PID=promo_dm_up&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>"><?php echo $dmdata[$mci]["rsubjext"] ?></a><?php }
										else {?><?php echo $dmdata[$mci]["rsubjext"] ?><?php }?></td>
										<td width="100" bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$dmdata[$mci]["sendtime"]); ?></td>
										<td width="77" bgcolor="#FFFFFF"><?php echo date("H:i",$dmdata[$mci]["sendtime"]); ?></td>
										<td width="63" bgcolor="#FFFFFF">
												<?php 
								
										if($resnumrows==0) {
											echo "配信済";
										}
										else if($dmdata[$mci]["sendtime"]<time()){
											echo "配信中";
										}
										else {
											echo "配信待";
										}
										?>
										</td>
										<td width="42" bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="確認" onClick="location.href='?PID=promo_dm_preview&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
							              </div>
								</td>
										<td width="117" bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="コピーして配信登録" onClick="location.href='?PID=promo_dm_copy&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
							              </div>
								</td>
										<td width="42" bgcolor="#FFFFFF">
												
										    <div align="center">
										        <input type="button" name="Submit" value="変更" onclick="location.href='?PID=promo_dm_up&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
									        </div>
								</td>
										<td width="42" bgcolor="#FFFFFF">
												
										    <div align="center">
										        <input type="button" name="Submit" value="削除" onclick="location.href='?PID=promo_dm_del&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
									        </div>
								</td>
								</tr><?php }
								else {?>
<tr>
										<td bgcolor="#FFFFFF"><?php if($resnumrows!=0) {?><a href="?PID=promo_dm_up&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>"><?php echo $dmdata[$mci]["rsubjext"] ?></a><?php }
										else {?><?php echo $dmdata[$mci]["rsubjext"] ?><?php }?></td>
										<td width="100" bgcolor="#FFFFFF"><?php echo date("Y年m月d日",$dmdata[$mci]["sendtime"]); ?></td>
										<td width="77" bgcolor="#FFFFFF"><?php echo date("H:i",$dmdata[$mci]["sendtime"]); ?></td>
										<td width="63" bgcolor="#FFFFFF">
												<?php 
								
										if($resnumrows==0) {
											echo "配信済";
										}
										else if($dmdata[$mci]["sendtime"]<time()){
											echo "配信中";
										}
										else {
											echo "配信待";
										}
										?>
										</td>
										<td bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="確認" onClick="location.href='?PID=promo_dm_preview&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
							              </div>
										</td>
										<td bgcolor="#FFFFFF">
												<div align="center">
												    <input type="button" name="Submit" value="コピーして配信登録" onClick="location.href='?PID=promo_dm_copy&dm_id=<?php echo $dmdata[$mci]["dm_id"]; ?>'" />
							              </div>
										</td>
										<td colspan="2" bgcolor="#FFFFFF">
										    <div align="center"></div>
										</td>
						  </tr>								<?php
								}
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
						<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
								<tr>
										<td>
												<input type="button" name="Submit" value="配信登録" onclick="location.href='?PID=promo_dm_reg'" />
										</td>
								</tr>
					</table>
				</td>
		</tr>
		<tr>
				<td height="33">
						<div align="center">
								<?php if($_SESSION["dm"]["page"]!=NULL&&$_SESSION["dm"]["page"]!=1){  ?>
								<a href="?PID=promo_dm&page=<?php echo $_SESSION["dm"]["page"]-1;?>">
								<?php }?>
		&lt;&lt;　前の<?php echo $_SESSION["dm"]["lim"] ?>件
		<?php if($_SESSION["dm"]["page"]!=NULL&&$_SESSION["dm"]["page"]!=1){  ?>
								</a>
								<?php }?>
								<?php for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["dm"]["page"]) {
		  		echo " <strong><font color=\"#FF6600\">".$prows."</font></strong> ";
			}
			else {
		  		echo " <a href=\"?PID=promo_dm&page=".$prows."\">".$prows."</a> ";
			}
		  
		  }?>
								<?php if($maxpage!=$_SESSION["dm"]["page"]) {?>
								<a href="?PID=promo_dm&page=<?php echo $_SESSION["dm"]["page"]+1;?>">
								<?php } ?>
								次の<?php echo $_SESSION["dm"]["lim"] ?>件　&gt;&gt;
								<?php if($maxpage!=$_SESSION["dm"]["page"]) {?>
								</a>
								<?php } ?>
						</div>
				</td>
		</tr>
		<tr>
		    <td height="33">&nbsp;</td>
    </tr>
</table>
