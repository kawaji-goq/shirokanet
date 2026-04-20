<?php
$re1obj=new Ad_RealEstate($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");

if($_GET["adb2sort"]!=NULL) {
	$_SESSION["adb2sort"]=$_GET["adb2sort"];
}

if($_GET["cid"]!=NULL) {
	$_SESSION["cid"]=$_GET["cid"];
	
}
if(substr_count($_SERVER['HTTP_REFERER'],"re_b2")==0) {
	$_SESSION["madori"]="";
	$_SESSION["lowcost"]="";
	$_SESSION["hicost"]="";
	$_SESSION["keyword"]="";
	$_SESSION["chiiki"]="";
	$_SESSION["nophoto"]=0;
		$_SESSION["vchk"]="";

	
}
if($_REQUEST["rq"]==1) {
	$_SESSION["page"]=1;
	$_SESSION["madori"]="";
	$_SESSION["lowcost"]="";
	$_SESSION["hicost"]="";
	$_SESSION["keyword"]="";
	$_SESSION["chiiki"]="";
	$_SESSION["nophoto"]=0;
	$_SESSION["vchk"]="";
	$_GET["page"]=1;
	$_SESSION["page"]=1;

}

if($_REQUEST["btm_search"]=="検索する") {
	$_SESSION["madori"]=$_REQUEST["madori"];
	$_SESSION["lowcost"]=$_REQUEST["lowcost"];
	$_SESSION["hicost"]=$_REQUEST["hicost"];
	$_SESSION["keyword"]=$_REQUEST["keyword"];
	$_SESSION["chiiki"]=$_REQUEST["chiiki"];
	$_SESSION["nophoto"]=$_REQUEST["nophoto"];
	$_SESSION["vchk"]=$_REQUEST["vchk"];
	
	$_GET["page"]=1;
	$_SESSION["page"]=1;
}

if($_REQUEST["btm_hikaku"]=="選択した物件を比較する") {

	for($a=0;$_REQUEST["comparison"][$a]!=NULL;$a++) {
		$chksql="select * from hikaku where sessionid = '".session_id()."' and bid=".$_REQUEST["comparison"][$a]."";
		$res=$dbobj->Query($chksql);
		$resrows=$dbobj->NumRows($res);
		if($resrows==0) {
			$selsql="select max(hikaku_id) as maxid from hikaku";
			$rdata=$dbobj->GetData($selsql);
		
			$maxid=$rdata["maxid"]+1;
			$inssql="insert into hikaku(hikaku_id,sessionid,cid,bid,rtime) values(".$maxid.",'".session_id()."',".$_SESSION["cid"].",".$_REQUEST["comparison"][$a].",'".date("Y-m-d H:i:s",time())."')";
			$res=$dbobj->Query($inssql);
		}
	}
}
for($bis=0;$_REQUEST["bukkenid"][$bis]!=NULL;$bis++) {
	
	if($_REQUEST["osusume"][$bis]==NULL) {
		$_REQUEST["osusume"][$bis]=0;
	}
	if($_REQUEST["del_chk"][$bis]==NULL) {
		$_REQUEST["del_chk"][$bis]=1;
	}
	$upsql="update bukken set osusume = ".$_REQUEST["osusume"][$bis].",del_chk=".$_REQUEST["del_chk"][$bis]." where id = ".$_REQUEST["bukkenid"][$bis];
	$dbobj->Query($upsql);
	
	if($_REQUEST["del"][$bis]!=NULL) {
	$upsql="delete from bukken where id = ".$_REQUEST["bukkenid"][$bis];
	$dbobj->Query($upsql);
	
	}
	
}
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =5");
$re1obj->type=5;
$re1data=$re1obj->GetReList(2,$_SESSION["adb2sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);

?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">

function hback() {
history.back();
}

function goreplacex(bid) {
	location.href="index.php?PID=re_b2_rep&bid="+bid;
}

function godelete(bid) {
	location.href="index.php?PID=re_b2_del&bid="+bid;
}


</script>
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function gocopy2(bid) {
	location.href="index.php?PID=re_b2_copy&bid="+bid;
}

//-->
</script>
<style type="text/css">
<!--
.st {	font-size:14px;
	font-weight:bold;
}
#helper a:link ,#helper a:visited {
font-weight:bold;
	color:#FF0000;
	text-decoration: none;	
}
#helper a:hover,#helper a:active{
font-weight:bold;
	color:#FF6600;
	text-decoration: none;
}

-->
</style>
<TABLE width="100%"  border="0" align="left" cellpadding="0" cellspacing="0"> 
  <TR>
  		<TD>
  				<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="border">
							<tr>
									<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
									<td>
											<table width="100%"  border="0" cellspacing="0" cellpadding="5">
													<tr>
															<td class="font10"> <strong>売買土地物件 管理 </strong> </td>
													</tr>
											</table>
									</td>
							</tr>
					</table>
  		</TD>
 		</TR>
  <TR>
      <TD>&nbsp;</TD>
  </TR><?php
	if(str_replace("www.","",$_SERVER['HTTP_HOST'])!="nest-h.com"){
		?>
  <TR>
      <TD>
          <div class="helper"><table width="100%" border="0" cellpadding="3" cellspacing="1" id="helper">
              <tr>
                  <th bgcolor="#CCCCCC">
                      <div align="left">共通設定</div>
                  </th>
              </tr>
              <tr>
                  <td bgcolor="#FFFFFF">売買土地物件に表示する項目を設定するには<a href="?PID=re_b2_set">こちらをクリック</a>してください。
		            <br>
      データの入力されていない項目をお客様用の物件詳細ページで表示しない場合は<a href="?PID=re_osetting">こちらをクリック</a>してください。<br>
      <font color="#FF0000">※この設定は全ての種別で共通になっております。</font></td>
              </tr>
          </table></div>
      </TD>
  </TR>
  <TR>
  		<TD>&nbsp;</TD>
 		</TR>
		
  <TR>
  		<TD>    		<form name="form2" method="post" action="">
      		<table border="0" align="left" cellpadding="0" cellspacing="0">
							<tr>
									<td colspan="3"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search1.jpg" width="702" height="33" /></td>
							</tr>
							<tr>
									<td width="6" background="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search2.jpg" bgcolor="#FAFBFC"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search2.jpg" width="6" height="51" /></td>
									<td width="686" bgcolor="#FAFBFC">
											<table width="100%" align="center" cellpadding="1" cellspacing="1">
													<tr>
															<td width="11%" height="15">
																	<div align="center">地域名</div>
															</td>
															<td colspan="3">
																	<select id="chiiki" name="chiiki">
																			<?php
												$arealist=$dbobj->GetList("select * from re_area order by turn");
												for($areai=0;$arealist[$areai]["area_id"]!=NULL;$areai++) {
												?>
																			<option value="<?php echo $arealist[$areai]["area_id"];?>"<?php if($_SESSION["chiiki"]==$arealist[$areai]["area_id"]){echo " selected";}?>><?php echo $arealist[$areai]["area_name"];?></option>
																			<?php
												}
												?>
																			<option value=""<?php if($_SESSION["chiiki"]==""){echo " selected";}?>>指定無し</option>
																	</select>
																	<div align="center"></div>
															</td>
													</tr>
													<tr>
															<td width="11%">
																	<div align="center">価格</div>
															</td>
															<td colspan="3">
																	<input name="lowcost" id="lowcost" value="<?php echo $_SESSION["lowcost"];?>" size="16" />
																	<strong>万円 〜
																			<input id="hicost" size="16" name="hicost" value="<?php echo $_SESSION["hicost"];?>" />
																			万円 </strong></td>
													</tr>
													<tr>
															<td>
																	<div align="center">外観写真</div>
															</td>
															<td width="38%">
																	<select name="nophoto" id="nophoto">
																			<option value="2"<?php if($_SESSION["nophoto"]==2) { echo " selected";}?>>登録済み</option>
																			<option value="1"<?php if($_SESSION["nophoto"]==1) { echo " selected";}?>>未登録</option>
																			<option value="0"<?php if($_SESSION["nophoto"]==0||$_SESSION["nophoto"]==NULL) { echo " selected";}?>>指定なし</option>
																	</select>
															</td>
															<td width="12%" align="center">状態</td>
															<td width="39%">
																	<div align="left">
																			<select name="vchk">
																					<option value="0"<?php if($_SESSION["vchk"]==0&&$_SESSION["vchk"]!=NULL){ echo " selected"; } 	?>>公開中</option>
																					<option value="1"<?php if($_SESSION["vchk"]==1){ echo " selected"; } 	?>>非公開</option>
																					<option value=""<?php if($_SESSION["vchk"]==NULL){ echo " selected"; } 	?>>指定無し</option>
																			</select>
																			</div>
															</td>
													</tr>
													<tr>
															<td width="11%">
																	<div align="center">キーワード</div>
															</td>
															<td colspan="3">
																	<table cellspacing="1" cellpadding="1" width="100%" border="0">
																			<tbody>
																					<tr>
																							<td width="50%">
																							    <table border="0" cellspacing="0" cellpadding="0">
                               <tr>
                                   <td>
                                       <input name="keyword" id="keyword" size="60" value="<?php echo $_SESSION["keyword"];?>" />
                                   </td>
                                   <td>&nbsp;</td>
                                   <td>
                                       <input type="image" name="seach_bukken" id="seach_bukken" src="http://fudousan.itcube.ne.jp/asp/img_f/kensaku.jpg" />
                                       <input name="btm_search" type="hidden" id="btm_search" value="検索する" />
                                       <input name="page" type="hidden" id="page" value="1" />
                                   </td>
                               </tr>
                           </table>
																							</td>
																					</tr>
																			</tbody>
																	</table>
															</td>
													</tr>
											</table>
									</td>
									<td width="10" align="right" background="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg" width="10" height="51" /></td>
							</tr>
							<tr>
									<td colspan="3"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search4.jpg" width="702" height="6" /></td>
							</tr>
					</table>
      		</form> 
</TD>
 		</TR>
  <TR>
  		<TD>&nbsp;</TD>
 		</TR><?php
	}
	?>
  <TR> 
    <TD>
      <form name="form1" method="post" action=""> 
        <TABLE width="100%"  border="0" align="center" cellpadding="0" cellspacing="0"> 
          <TR> 
            <TD>
            		<TABLE width="100%"  border="0" cellspacing="0" cellpadding="5">
                      <TR>
                        <TD>&nbsp;</TD>
                        <TD>&nbsp;</TD>
                      </TR>
                      <TR bgcolor="#CCCCFF">
                        <TD bgcolor="#DDDDFF">
                          <input type="button" name="Submit" value="新規物件登録" onClick="location.href='index.php?PID=re_b2_add'"></TD>
                        <TD bgcolor="#DDDDFF">
                          <div align="right"></div></TD>
                      </TR>
                      <TR>
                        <TD>
                            <?php 
												
												if($maxpage!=0) {
												?>
全<strong>
<?php 
												
												echo $maxpage;
												?>
</strong>ページ中 <strong><?php echo $_SESSION["page"];?></strong> ページ目を表示中<strong>
<?php }?>
&nbsp;</strong></TD>
                        <TD><div align="right"><strong>表示件数</strong>
                          <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
                            <option value="?PID=re_b2&lim=10&page=1"<?php if($_SESSION["lim"]==10||$_SESSION["lim"]==NULL) { echo " selected";}?>>10件</option>
                            <option value="?PID=re_b2&lim=20&page=1"<?php if($_SESSION["lim"]==20) { echo " selected";}?>>20件</option>
                            <option value="?PID=re_b2&lim=30&page=1"<?php if($_SESSION["lim"]==30||$_SESSION["lim"]==NULL) { echo " selected";}?>>30件</option>
                            <option value="?PID=re_b2&lim=40&page=1"<?php if($_SESSION["lim"]==40||$_SESSION["lim"]==NULL) { echo " selected";}?>>40件</option>
                            <option value="?PID=re_b2&lim=50&page=1"<?php if($_SESSION["lim"]==50||$_SESSION["lim"]==NULL) { echo " selected";}?>>50件</option>
                            <option value="?PID=re_b2&lim=100&page=1"<?php if($_SESSION["lim"]==100||$_SESSION["lim"]==NULL) { echo " selected";}?>>100件</option>
                          </select>
                        </div></TD>
                      </TR>
                    </TABLE>       		</TD> 
          </TR> 
        </TABLE> 
        <TABLE width="100%"  border="0" align="center" cellpadding="3" cellspacing="1" class="bukkentable"> 
          <TR class="realestate_bgcolor2">
          		<th width="3%" rowspan="2" align="center" valign="middle"><a href="?PID=re_b2&cid=<?php echo $_SESSION["cid"];?>&adb2sort=osusume<?php if($_SESSION["adb2sort"]=="osusume") { echo " desc";}?>"><strong>オス<br>
スメ </strong></a></th>
          		<th width="7%" rowspan="2" align="center" valign="middle" class="font12">
									<div align="center"><?php echo $bsetdata["photo_name"] ?></div>
			</th>
          		<th width="19%">
          				<div align="center"><strong><a href="?PID=re_b2&cid=<?php echo $_SESSION["cid"];?>&adb2sort=bukkenn_id<?php if($_SESSION["adb2sort"]=="bukkenn_id") { echo " desc";}?>">物件番号</a>
          						<?php if($_SESSION["adb2sort"]=="bukkenn_id") { echo "▼";}elseif($_SESSION["adb2sort"]=="bukkenn_id desc") { echo "▲";}?>
          						</strong></div>
          		</th>
          		<th width="11%" rowspan="2">
									<div align="center"><strong><a href="?PID=re_b2&cid=<?php echo $_SESSION["cid"];?>&adb2sort=kakaku<?php if($_SESSION["adb2sort"]=="kakaku") { echo " desc";}?>">価格<?php if($_SESSION["adb2sort"]=="kakaku") { echo "▼";}elseif($_SESSION["adb2sort"]=="kakaku desc") { echo "▲";}?></a></strong></div>
          		</th>
          		<th width="10%" rowspan="2">
									<div align="center"><strong><a href="?PID=re_b2&cid=<?php echo $_SESSION["cid"];?>&adb2sort=menseki<?php if($_SESSION["adb2sort"]=="menseki") { echo " desc";}?>">土地面積<?php if($_SESSION["adb2sort"]=="menseki") { echo "▼";}elseif($_SESSION["adb2sort"]=="menseki desc") { echo "▲";}?></a></strong></div>
          		</th>
          		<th colspan="2" class="font12">
									<div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
			</th>
          		<th width="4%" rowspan="2" class="font12">
            		  <div align="center"><font color="#000000"><strong>POP</strong></font></div>
          		</th>
          		<th>
          				<div align="center"><span class="font14"><strong>修正</strong></span></div>
          		</th>
          		<th width="4%" rowspan="2">公開</th>
          		<th width="6%" rowspan="2"> 
              		<div align="center" class="font14"><strong>削除</strong></div>
          		</th>
          		<th width="8%" rowspan="2"><div align="center" class="font14"><strong>選択削除</strong></div></th>
   		  	</TR>
          <TR class="realestate_bgcolor2">
          		<th> 
              <div class="font14"> 
                	<div align="center"><strong><font color="#000000"><?php echo $bsetdata["bukken_mei_name"] ?><br>
                				<a href="?PID=<?php echo $_REQUEST["PID"];?>&cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["adb2sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&adb2sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&adb2sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></font></strong></div>
              </div> 
            </th> 
            <th width="10%" class="font12">
								<div align="center"><?php echo $bsetdata["syumoku_name"] ?></div>
            </th>
            <th width="13%" class="font12">
								<div align="center"><?php echo $bsetdata["chimoku_name"] ?></div>
            </th>
            <th width="5%">
            		<div align="center"><strong>複製</strong></div>
            </th>
          </TR> 
                     <?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?> 
          <TR class="realestate_bgcolor3">
          		<TD width="3%" rowspan="2" align="center" valign="middle" class="font14"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center"><span class="font12">
          						<input name="osusume[<?php echo $re1rows;?>]" type="checkbox" id="osusume[<?php echo $re1rows;?>]" value="1" <?php if($re1data[$re1rows]["osusume"]==1){echo " checked";}?> />
          						<input name="bukkenid[<?php echo $re1rows;?>]" type="hidden" id="bukkenid[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["id"]; ?>" />
          								</span></div>
          		</TD>
          		<td width="7%" rowspan="2" align="center" valign="middle"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center"><a href="?PID=re_b2_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
          				    <?php
if($re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='/tmp/bukken_data/".$re1data[$re1rows]["id"]."/".str_replace("300","list",$re1data[$re1rows]["photo1"])."?".time()."' border='0' width='70'>";
}
else {
?>
                  <img src="http://fudousan.itcube.ne.jp/img/noimage_120_120.gif" width="70" border="0" />
                  <?php
}
?>
              </a><a href="?PID=re_b2_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>"></a></div>
          		</td>
          		<TD nowrap class="font14"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center"><span class="font12"><?php echo $re1data[$re1rows]["bukkenn_id"];?></span></div>
          		</TD>
          		<TD rowspan="2" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
											<tr>
													<td nowrap>
															<div align="right">
																	<?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?>
																	<br />
															</div>
													</td>
											</tr>
				  </table>
          		</TD>
          		<TD rowspan="2" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
									<div align="center"><?php if($re1data[$re1rows]["menseki"]!=NULL) {echo $re1data[$re1rows]["menseki"]."m<sup>2</sup>";}?></div>
          		</TD>
          		<td colspan="2" align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo str_replace("駅","",$re1data[$re1rows]["eki"])."駅";} ?>
          						<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
          						<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
				  </div>
          		</td>
          		<td align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          		    <div align="center">
          		        <input type="button" name="Submit" value="設定" onClick="location.href='?PID=re_osetting'">
      		        </div>
          		</td>
          		<TD bgcolor="#FFECEC" nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center">
          				    <table border="0" align="center" cellpadding="0" cellspacing="3"<?php if($tenpodata["b2lastupid"]==$re1data[$re1rows]["id"]) {?> style="background-color:#666666;"<?php }?>>
                      <tr>
                          <td>
                              <input name="btm" type="button" id="btm" onClick="location.href='index.php?PID=re_b2_rep&bid=<?php echo $re1data[$re1rows]["id"];?>'" value="修正" />
                          </td>
                      </tr>
                  </table>
          				</div>
          		</TD>
          		<TD rowspan="2" nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
									<div align="center">
											<input name="del_chk[<?php echo $re1rows;?>]" type="checkbox" id="del_chk[<?php echo $re1rows;?>]" value="0"<?php if($re1data[$re1rows]["del_chk"]==0&&$re1data[$re1rows]["del_chk"]!=NULL) {echo " checked";}?>>
									</div>
			</TD>
          		<TD rowspan="2" bgcolor="#ECFFEC" nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>> 
            		<div align="center"> 
            				<input type="button" name="Submit" value="削除" onClick="location.href='index.php?PID=re_b2_del&bid=<?php echo $re1data[$re1rows]["id"];?>'"> 
            				</div>            		</TD>
          		<TD rowspan="2" bgcolor="#ECFFEC" nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><div align="center"><span class="font14"><span class="font12">
          				<input name="del[<?php echo $re1rows;?>]" type="checkbox" id="del[<?php echo $re1rows;?>]" value="1" />
          				</span></span></div></TD>
   		  	</TR>
          <TR class="realestate_bgcolor3">
          		<TD nowrap class="font14"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
          				<div align="center"><span class="font12"><?php echo $re1data[$re1rows]["bukken_mei"];?><br>
          											<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"].$re1data[$re1rows]["jyusyo3"];?></span></div>
          		</TD> 
            <td align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
            		<div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?></div>
            </td>
            <td align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
								<div align="center">
										<?php if($re1data[$re1rows]["chimoku"]!=NULL){ echo $re1data[$re1rows]["chimoku"];}else{ echo "-";} ?>
			  </div>
            </td>
            <TD nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
            		
            						<div align="center">
            						    <input type="button" name="Submit" value="POP" onClick="window.open('http://siteadmin.itcube.ne.jp/sm/realestate/b2/print<?php echo $tenpodata["poptype"];?>.php?bid=<?php echo $re1data[$re1rows]["id"];?>&did=<?php echo urlencode($_SESSION["DomainData"]["dbname"]);?>&domain=<?php echo $_SESSION["DomainData"]["domain_name"];if($_SESSION["DomainData"]["dbtype"]=="mysql") { echo "&dtype=mysql";}?>')" />
        						    </div>
            </TD>
            <TD bgcolor="#FFECEC" nowrap<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
            		
            		<div align="center">
            				<input type="button" name="sSubmit" value="複製" onClick="gocopy2('<?php echo $re1data[$re1rows]["id"];?>')">
            				</div>
            		</TD>
            </TR> 
					<?php
					}
					?>
        </TABLE> 
        <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0" class="font12">
						<tr>
								<td>&nbsp;</td>
						</tr>
						<tr>
								<td>
										<div align="center">
										    <table width="100%" border="0" cellspacing="0" cellpadding="0">
										    		<tr>
										    				<td>&nbsp;</td>
										    				<td>&nbsp;</td>
										    				<td align="right">&nbsp;</td>
								    				</tr>
										    		<tr>
										    				<td width="39%"><input name="btm_update_osusume" type="submit" id="btm_update_osusume" value="変更を適用する" /></td>
										    				<td width="4%">&nbsp;</td>
										    				<td width="57%" align="right"><div align="right">
										    						<input name="btm_update_osusume" type="submit" id="btm_update_osusume" value="選択した物件を削除する" />
								    						</div></td>
								    				</tr>
								    		</table>
										    <table border="0" cellpadding="3" cellspacing="0">
                  <tr>
                      <td width="100" nowrap="nowrap">
                          <div align="right">
                              <?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
                              <a href="?PID=<?php echo $_REQUEST["PID"];?>&cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a>
                              <?php }?>
                          </div>
                      </td>
                      <td>
                          <div align="center">
                              <?php 
if($maxpage>1&&$maxpage!=NULL){
for($prows=1;$prows<=$maxpage;$prows++) { 
		  	if($prows==$_SESSION["page"]) {
		  		echo '　<span class="nowpagenum">'.$prows.'</span>　';
			}
			else {
		  		echo "　<a href=\"?PID=".$_REQUEST["PID"]."&cid=".$_SESSION["cid"]."&page=".$prows."\">".$prows."</a>　";
			}
		  
		  }
}				?>
                          </div>
                      </td>
                      <td width="100" nowrap="nowrap">
                          <div align="left">
                              <?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
                              <a href="?PID=<?php echo $_REQUEST["PID"];?>&cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
                              <?php } ?>
                          </div>
                      </td>
                  </tr>
              </table>
										</div>
								</td>
						</tr>
		</table>
      </form> 
    </TD> 
  </TR> 
</TABLE> 
