<?php
$re1obj=new Ad_RealEstate($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
/* 暫定的 */

$dbobj->Query("update bukken set mnum = 0 where madori_tani='ROOM'");
$dbobj->Query("update bukken set mnum = 1 where madori_tani='K'");
$dbobj->Query("update bukken set mnum = 2 where madori_tani='DK'");
$dbobj->Query("update bukken set mnum = 3 where madori_tani='LDK'");
$dbobj->Query("update bukken set mnum = 6 where madori_tani='SLDK'");
$dbobj->Query("update bukken set mnum = 5 where madori_tani='SDK'");
$dbobj->Query("update bukken set mnum = 4 where madori_tani='SK'");

if($_GET["adc1sort"]!=NULL) {
	$_SESSION["adc1sort"]=$_GET["adc1sort"];
}

/*
else if($_SESSION["adc1sort"]==NULL){
	$_SESSION["adc1sort"]="kakaku";
}
*/

if($_GET["cid"]!=NULL) {

	$_SESSION["cid"]=$_GET["cid"];

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
	$_SESSION["page"]=1;
	$_GET["page"]=1;

}

$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");

if($_REQUEST["btm_search"]=="検索する") {
	$_SESSION["madori"]=$_POST["madori"];
	$_SESSION["lowcost"]=$_POST["lowcost"];
	$_SESSION["hicost"]=$_POST["hicost"];
	$_SESSION["keyword"]=$_POST["keyword"];
	$_SESSION["chiiki"]=$_POST["chiiki"];
	$_SESSION["nophoto"]=$_POST["nophoto"];
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
if($_SESSION["page"]==NULL) {
	$_SESSION["page"]=1;
}
$re1obj->type=1;
$re1data=$re1obj->GetReList(1,$_SESSION["adc1sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);
$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1");

?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<script language="JavaScript" src="/tool/keypress.js" type="text/javascript">
function hback() {
history.back();
}
</script>
<script language="javascript">
<!--
function goreplace(bid) {
	location.href="index.php?PID=re_c1_rep&bid="+bid;
}
function gocopy(bid) {
	location.href="index.php?PID=re_c1_copy&bid="+bid;
}
function godelete(bid) {
	location.href="index.php?PID=re_c1_del&bid="+bid;
}

function gorealestatetop() {
	location.replace("index.php?PAGEID=realestate");
}

function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
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
.nowpagenum {
	font-size:16px;
	color:#FF3300;
	font-weight:bold;
}
-->
</style>
<TABLE width="100%"  border="0" align="left" cellpadding="0" cellspacing="0">
		<TR>
				<TD>
						<table width="100%"  border="0" cellpadding="0" cellspacing="0" class="border">
								<tr>
										<td width="15" bgcolor="#CCCCCC">&nbsp; </td>
										<td>
												<table width="100%"  border="0" cellspacing="0" cellpadding="5">
														<tr>
																<td class="font10"> 
																    <strong class="font14">賃貸アパート・マンション　物件管理</strong> 
																    </td>
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
		    <TD><div class="helper">
		        <table width="100%" border="0" cellpadding="3" cellspacing="1" id="helper">
              <tr>
                  <th bgcolor="#CCCCCC">
                      <div align="left">共通設定</div>
                  </th>
              </tr>
              <tr>
                  <td bgcolor="#FFFFFF">賃貸アパート・マンションに表示する項目を設定するには<a href="?PID=re_c1_set">こちらをクリック</a>してください。
		            <br>
      データの入力されていない項目をお客様用の物件詳細ページで表示しない場合は<a href="?PID=re_osetting">こちらをクリック</a>してください。<br>
      <font color="#FF0000">※この設定は全ての種別で共通になっております。</font></td>
              </tr>
          </table>
		    </div>
		    </TD>
    </TR>
		<TR>
				<TD>&nbsp;</TD>
		</TR>
	
		<TR>
				<TD>
						<table border="0" align="left" cellpadding="0" cellspacing="0">
								<tr>
										<td colspan="3"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search1.jpg" width="702" height="33" /></td>
								</tr>
								<tr>
										<td width="6" background="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search2.jpg" bgcolor="#FAFBFC"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search2.jpg" width="6" height="51" /></td>
										<td width="686" bgcolor="#FAFBFC">
												<table width="100%" align="center" cellpadding="1" cellspacing="1">
														<form id="form1" name="form1" method="post" action="">
																<tr>
																		<td width="11%" height="15">
																				<div align="center">間取り</div>
																		</td>
																		<td width="38%">
																				<select id="madori" name="madori">
																						<option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
																						<option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
																						<option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
																						<option value="4"
																						<?php if($_SESSION["madori"]==4){echo " selected";}?>>
																								4ＤＫ以上</option>
																						<option value="0"<?php if($_SESSION["madori"]==0){echo " selected";}?>>指定無し</option>
																				</select>
																		</td>
																		<td width="11%">
																				<div align="center">地域名</div>
																		</td>
																		<td width="40%">
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
																		</td>
																</tr>
																<tr>
																		<td width="11%">
																				<div align="center">賃料</div>
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
																		<td>
																				<select name="nophoto" id="nophoto">
																						<option value="2"<?php if($_SESSION["nophoto"]==2) { echo " selected";}?>>登録済み</option>
																						<option value="1"<?php if($_SESSION["nophoto"]==1) { echo " selected";}?>>未登録</option>
																						<option value="0"<?php if($_SESSION["nophoto"]==0||$_SESSION["nophoto"]==NULL) { echo " selected";}?>>指定なし</option>
																				</select>
																		</td>
																		<td align="center" bgcolor="#ffffff">
																				<div align="center">状態</div>
																		</td>
																		<td>
																				<select name="vchk">
																						<option value="0"<?php if($_SESSION["vchk"]==0&&$_SESSION["vchk"]!=NULL){ echo " selected"; } 	?>>公開中</option>
																						<option value="1"<?php if($_SESSION["vchk"]==1){ echo " selected"; } 	?>>非公開</option>
																						<option value=""<?php if($_SESSION["vchk"]==NULL){ echo " selected"; } 	?>>指定無し</option>
																				</select>
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
														</form>
												</table>
										</td>
										<td width="10" align="right" background="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg" width="10" height="51" /></td>
								</tr>
								<tr>
										<td colspan="3"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search4.jpg" width="702" height="6" /></td>
								</tr>
						</table>
				</TD>
		</TR>	<?php
	}?>
		<TR>
				<TD>
						<form name="form1" method="post" action="">
								<TABLE width="100%"  border="0" cellspacing="0" cellpadding="5">
										<TR>
												<TD>&nbsp;</TD>
												<TD>&nbsp;</TD>
										</TR>
										<TR bgcolor="#CCCCFF">
												<TD bgcolor="#DDDDFF">
										  <input type="button" name="Submit" value="新規物件登録" onClick="location.href='index.php?PID=re_c1_add'"></TD>
												<TD bgcolor="#DDDDFF">
										  <div align="right"></div>										  </TD>
								  </TR>
										<TR>
										  <TD><?php 
												
												if($maxpage!=0) {
												?>全<strong>　<?php 
												
												echo $maxpage;
												?>　</strong>ページ中　<strong><?php echo $_SESSION["page"];?></strong>　ページ目を表示中<strong><?php }?>&nbsp;</strong></TD>
										  <TD><div align="right"><strong>表示件数</strong>
                                              <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
                                                <option value="?PID=re_c1&lim=10&page=1"<?php if($_SESSION["lim"]==10||$_SESSION["lim"]==NULL) { echo " selected";}?>>10件</option>
                                                <option value="?PID=re_c1&lim=20&page=1"<?php if($_SESSION["lim"]==20) { echo " selected";}?>>20件</option>
                                                <option value="?PID=re_c1&lim=30&page=1"<?php if($_SESSION["lim"]==30) { echo " selected";}?>>30件</option>
                                                <option value="?PID=re_c1&lim=40&page=1"<?php if($_SESSION["lim"]==40) { echo " selected";}?>>40件</option>
                                                <option value="?PID=re_c1&lim=50&page=1"<?php if($_SESSION["lim"]==50) { echo " selected";}?>>50件</option>
                                                <option value="?PID=re_c1&lim=100&page=1"<?php if($_SESSION["lim"]==100) { echo " selected";}?>>100件</option>
                                              </select>
</div></TD>
								  </TR>
						  </TABLE>
								<TABLE width="100%"  border="0" cellpadding="2" cellspacing="1" class="bukkentable">
										<TR class="realestate_bgcolor2">
												<th width="5%" rowspan="3" nowrap><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&adc1sort=osusume<?php if($_SESSION["adc1sort"]=="osusume") { echo " desc";}?>"><strong>オス<br>
												スメ</strong></a></th>
												<th width="6%" rowspan="3">
														<div align="center"><?php echo $bsetdata["photo_name"] ?></div>
										  </th>
												<th width="27%">
														<div class="font12">
																<div align="center"><strong><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&adc1sort=bukkenn_id<?php if($_SESSION["adc1sort"]=="bukkenn_id") { echo " desc";}?>">物件番号</a><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&adc1sort=bukkenn_id<?php if($_SESSION["adc1sort"]=="bukkenn_id") { echo " desc";}?>">
																		<?php if($_SESSION["adc1sort"]=="bukkenn_id") { echo "▼";}elseif($_SESSION["adc1sort"]=="bukkenn_id desc") { echo "▲";}?>
																</a></strong></div>
														</div>
												</th>
												<th width="14%" rowspan="3" class="font12">
														<div align="center"><span class="st"><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&amp;adc1sort=kakaku<?php if($_SESSION["adc1sort"]=="kakaku") { echo " desc";}?>"><?php echo $bsetdata["kakaku_name"] ?></a></span><br />
																<?php echo $bsetdata["kanrihi_name"] ?></div>
												</th>
												<th width="7%" rowspan="3" align="center" class="font12"><span class="st"><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&amp;adc1sort=madori<?php if($_SESSION["adc1sort"]=="madori,mnum") { echo " desc";}?>,mnum<?php if($_SESSION["adc1sort"]=="madori,mnum") { echo " desc";}?>"><?php echo $bsetdata["madori_name"] ?></a><br />
												</span><?php echo $bsetdata["senyumenseki_name"] ?></th>
												<th colspan="2" rowspan="2" align="center" class="font12"><?php echo $bsetdata["ensen_name"] ?></th>
												<th width="4%" rowspan="3" align="center" class="font12">
														  <div align="center">POP</div>
												</th>
												<th width="4%" rowspan="2">
														<div align="center" class="font12">
																<div align="center"><strong><font color="#000000">修正</font></strong></div>
														</div>
												
														<div align="center"></div>
												</th>
												<th width="6%" rowspan="3">
														<div align="center"><font color="#000000"><strong>公開</strong></font></div>
												</th>
												<th width="6%" rowspan="3">
														<div align="center" class="font12"><strong><font color="#000000">削除</font></strong></div>
												</th>
												<th width="6%" rowspan="3"><div align="center"><font color="#000000"><strong>選択削除</strong></font></div></th>
										</TR>
										<TR class="realestate_bgcolor2">
												<th rowspan="2">
														<div align="center"><strong><font color="#000000">物件名</font></strong></div>
												
														<div align="center"><strong><font color="#000000">					<div align="center" class="st"><a href="?PID=<?php echo $_REQUEST["PID"];?>&cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["adc1sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&adc1sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&adc1sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div></font></strong></div>
												</th>
										</TR>
										<TR class="realestate_bgcolor2">
												<th width="4%" align="center" class="font12"><?php echo $bsetdata["reikin_name"] ?><br />
												<?php echo $bsetdata["shikikin_name"] ?></th>
												<th width="11%" class="font12">
														<div align="center">
																<p><?php echo $bsetdata["syumoku_name"] ?><br />
																		<?php echo $bsetdata["kouzou_name"] ?></p>
														</div>
												</th>
												<th>
														<div align="center"><strong>複製</strong></div>
												</th>
										</TR>
										<?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
										<TR class="realestate_bgcolor3">
												<TD rowspan="3" valign="middle" class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input name="osusume[<?php echo $re1rows;?>]" type="checkbox" id="osusume[<?php echo $re1rows;?>]" value="1" <?php if($re1data[$re1rows]["osusume"]==1){echo " checked";}?>>
														</div>
												</TD>
												<TD rowspan="3" valign="top" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><a href="?PID=re_c1_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
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
														</a></div>
												</TD>
												<TD valign="top" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div class="font12"> 
																<div align="center"><?php echo $re1data[$re1rows]["bukkenn_id"];?></div>
														</div>
												</TD>
												<td rowspan="3" align="left" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
																		<tr>
																				<td nowrap>
																						<div align="right">
																								<?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".numberformat($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?><br />
																								<?php 
																				if($re1data[$re1rows]["kanrihi"]!=NULL) {
																				?>
																								<?php echo numberformat($re1data[$re1rows]["kanrihi"]); ?>円
																								<?php 
																								}
																								else {
																								echo "-";
																								}
																								?>
																						</div>
																				</td>
																		</tr>
																</table>
														</div>
												</td>
												<td rowspan="3" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><span class="st">
																<?php 
																														if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0) {
																														echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"]; }else{ echo "-";}?>
																<br />
																</span>
																<?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>";}else{ echo "-";}?>
														</div>
												</td>
												<td colspan="2" rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><?php if($re1data[$re1rows]["eki"]!=NULL) {echo str_replace("駅","",$re1data[$re1rows]["eki"])."駅";} ?>
																<?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
																<?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
														</div>
												</td>
												<td rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
												    <div align="center">
												        <input type="button" name="Submit" value="設定" onClick="location.href='?PID=re_osetting'">
									              </div>
												</td>
												<TD rowspan="2" valign="middle" bgcolor="#FFECEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
												    <table border="0" align="center" cellpadding="0" cellspacing="3"<?php if($tenpodata["c1lastupid"]==$re1data[$re1rows]["id"]) {?> style="background-color:#666666;"<?php }?>>
                    <tr>
                        <td>
                            <input type="button" name="Submit" value="修正" onClick="goreplace('<?php echo $re1data[$re1rows]["id"];?>')">
</td>
                    </tr>
                </table>
														  <div align="center" ></div>
												
														<div align="center"></div>
												</TD>
												<TD rowspan="3" valign="middle" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input name="del_chk[<?php echo $re1rows;?>]" type="checkbox" id="del_chk[<?php echo $re1rows;?>]" value="0"<?php if($re1data[$re1rows]["del_chk"]==0&&$re1data[$re1rows]["del_chk"]!=NULL) {echo " checked";}?>>
														</div>
												</TD>
												<TD rowspan="3" valign="middle" bgcolor="#ECFFEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><div align="center"><span class="font12">
																<input type="button" name="Submit" value="削除" onClick="godelete('<?php echo $re1data[$re1rows]["id"];?>')">
																</span></div>
												</TD>
												<TD rowspan="3" align="center" valign="middle" bgcolor="#ECFFEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><span class="font12">
													<div align="center">	<input name="del[<?php echo $re1rows;?>]" type="checkbox" id="del[<?php echo $re1rows;?>]" value="1" />
												</div></span></TD>
										</TR>
										<TR class="realestate_bgcolor3">
												<TD rowspan="2" valign="top" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><?php echo $re1data[$re1rows]["bukken_mei"];?><br>
																<?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"].$re1data[$re1rows]["jyusyo3"];?>
																<input name="bukkenid[<?php echo $re1rows;?>]" type="hidden" id="bukkenid[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["id"]; ?>">
														</div>
												</TD>
										</TR>
										<TR class="realestate_bgcolor3">
												<td align="center" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<?php if($re1data[$re1rows]["reikin"]!=NULL){echo $re1data[$re1rows]["reikin"]."ヶ月 ";} ?>
																<?php 
																																		if($re1data[$re1rows]["reikin_tani"]!=NULL){
																																		echo $re1data[$re1rows]["reikin_tani"]."万円";
																																		}
																																		?>
																<br />
																<?php 
																																		if($re1data[$re1rows]["shikikin"]!=NULL){
																																			echo $re1data[$re1rows]["shikikin"]."ヶ月 ";
																																			}
																																			 ?>
																<?php 
																																		if($re1data[$re1rows]["sikikintani"]!=NULL){
																																			echo $re1data[$re1rows]["sikikintani"]."万円";
																																		}?>
														</div>
												</td>
												<td align="center" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
																<?php echo $re1data[$re1rows]["kouzou"]; ?></div>
												</td>
												<td align="center" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														
														    <div align="center">
														        <input type="button" name="Submit" value="POP" onclick="window.open('http://siteadmin.itcube.ne.jp/sm/realestate/c1/print<?php echo $tenpodata["poptype"];?>.php?bid=<?php echo $re1data[$re1rows]["id"];?>&did=<?php echo urlencode($_SESSION["DomainData"]["dbname"]);?>&domain=<?php echo $_SESSION["DomainData"]["domain_name"];if($_SESSION["DomainData"]["dbtype"]=="mysql") { echo "&dtype=mysql";}?>')" />
									              </div>
												</td>
												<TD valign="middle" bgcolor="#FFECEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input type="button" name="Submit" value="複製" onClick="gocopy('<?php echo $re1data[$re1rows]["id"];?>')">
														</div>
												</TD>
										</TR>
										<?php
									}
									?>
								</TABLE>
								<br>
								<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
												<td width="39%"><input name="btm_update_osusume" type="submit" id="btm_update_osusume" value="変更を適用する" /></td>
												<td width="4%">&nbsp;</td>
												<td width="57%" align="right"><div align="right"><input name="btm_update_osusume" type="submit" id="btm_update_osusume" value="選択した物件を削除する" /></div></td>
										</tr>
								</table>
								<table width="100%" border="0" cellspacing="1" cellpadding="1">
										<tr>
												<td>&nbsp;</td>
										</tr>
										<tr>
												<td width="100%"><div align="center">
														<table border="0" cellpadding="3" cellspacing="0">
																<tr>
																		<td width="100" nowrap="nowrap"><div align="right">
																				<?php if($_SESSION["page"]!=NULL&&$_SESSION["page"]!=1){  ?>
																				<a href="?PID=<?php echo $_REQUEST["PID"];?>&amp;cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]-1;?>">&lt;&lt;　前の10件 </a>
																				<?php }?>
																		</div></td>
																		<td><div align="center">
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
																		</div></td>
																		<td width="100" nowrap="nowrap"><div align="left">
																				<?php if($maxpage!=$_SESSION["page"]&&$maxpage>1) {?>
																				<a href="?PID=<?php echo $_REQUEST["PID"];?>&amp;cid=<?php echo $_SESSION["cid"];?>&amp;page=<?php echo $_SESSION["page"]+1;?>"> 次の10件　&gt;&gt;</a>
																				<?php } ?>
																		</div></td>
																</tr>
														</table>
												</div></td>
										</tr>
								</table>
						</form>
				</TD>
		</TR>
</TABLE>
