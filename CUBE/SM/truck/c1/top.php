<?php

$re1obj=new Ad_Truck($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
/* 暫定的 */
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
$ctype="";
switch($_SESSION["cid"])
{
	case 1:
	$ctype="ウィング・バン";
	break;
	case 2:
	$ctype="冷凍車・冷凍ウィング";
	break;
	case 3:
	$ctype="平ボディ";
	break;
	case 4:
	$ctype="ダンプ";
	break;
	case 5:
	$ctype="クレーン付き・セルフクレーン付き";
	break;
	case 6:
	$ctype="セルフローダー車載車";
	break;
	case 7:
	$ctype="バス・特殊車";
	break;
	case 8:
	$ctype="その他";
	break;
	
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
	$dbobj->Query("delete from bukken_photo where bukken_id = ".$_REQUEST["bukkenid"][$bis]);
	}
	
}
if($_SESSION["page"]==NULL) {
	$_SESSION["page"]=1;
}
$re1obj->type=$_SESSION["cid"];
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
																    <p class="font14"><strong>車両管理</strong> <strong><?php echo $ctype;?></strong></p>
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
    </TR>
		<TR>
				<TD>
						<form name="form1" method="post" action="">
								<TABLE width="100%"  border="0" cellspacing="0" cellpadding="5">
										<TR>
												<TD width="75%">&nbsp;</TD>
												<TD width="25%">&nbsp;</TD>
										</TR>
										<TR bgcolor="#CCCCFF">
												<TD bgcolor="#DDDDFF">
										  <input type="button" name="Submit" value="新規登録" onClick="location.href='index.php?PID=re_c1_add'"></TD>
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
												<th width="5%" rowspan="2" nowrap><div align="center"><a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&adc1sort=osusume<?php if($_SESSION["adc1sort"]=="osusume") { echo " desc";}?>"><strong>オス<br>
												スメ</strong></a></div></th>
												<th width="9%" rowspan="2">
														<div align="center">写真</div>
										  </th>

<th width="6%" rowspan="2" align="center" class="font12"><a href="?PID=re_c1&adc1sort=jouken1<?php if($_SESSION["adc1sort"]=="jouken1"){ echo " desc";}?>">積載クラス</a></th>
		<th width="8%" rowspan="2"><a href="?PID=re_c1&adc1sort=bukkenn_id<?php if($_SESSION["adc1sort"]=="bukkenn_id"){ echo " desc";}?>">管理番号</a></th>
												<th width="8%" rowspan="2">
														<div class="font12">
																<div align="center"><a href="?PID=re_c1&adc1sort=chiku_nen<?php if($_SESSION["adc1sort"]=="chiku_nen,chiku_tsuki"){ echo " desc";}?>,chiku_tsuki<?php if($_SESSION["sort"]=="chiku_nen,chiku_tsuki"){ echo " desc";}?>">年式</a></div>
														</div>
														<div align="center"></div></th>
												<th width="17%" class="font12">
														<div align="center"><a href="?PID=re_c1&adc1sort=chimoku<?php if($_SESSION["adc1sort"]=="chimoku"){ echo " desc";}?>&amp;truck_id=<?php echo $_REQUEST["truck_id"];?>">メーカー</a></div>
												</th>
												<th width="12%" rowspan="2" align="center" class="font12"><a href="?PID=re_c1&adc1sort=chisei<?php if($_SESSION["adc1sort"]=="chisei"){ echo " desc";}?>&amp;truck_id=<?php echo $_REQUEST["truck_id"];?>">ボディ形状</a></th>
												<th width="9%" rowspan="2" align="center" class="font12"><a href="?PID=re_c1&adc1sort=kyori<?php if($_SESSION["adc1sort"]=="kyori"){ echo " desc";}?>">走行距離</a></th>
												<th width="12%" rowspan="2" align="center" class="font12"><a href="?PID=re_c1&adc1sort=zousajouto<?php if($_SESSION["adc1sort"]=="zousajouto"){ echo " desc";}?>">車検</a></th>
												<th width="7%">
														<div align="center" class="font12">
																<div align="center"><strong><font color="#000000">修正</font></strong></div>
														</div>
												
														<div align="center"></div>
												</th>
												<th width="4%" rowspan="2">
														<div align="center"><font color="#000000"><strong>公開</strong></font></div>
												</th>
												<th width="3%" rowspan="2">
														<div align="center" class="font12"><strong><font color="#000000">削除</font></strong></div>
												</th>
										</TR>
										<TR class="realestate_bgcolor2">
												<th width="17%" align="center" class="font12"><a href="?PID=re_c1&sort=kosu<?php if($_SESSION["sort"]=="kosu"){ echo " desc";}?>&amp;truck_id=<?php echo $_REQUEST["truck_id"];?>">型式</a></th>
												<th width="7%">
														<div align="center"><strong>複製</strong></div>
												</th>
										</TR>
										<?php
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
													?>
										<TR class="realestate_bgcolor3">
												<TD width="5%" rowspan="2" valign="middle" class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input name="osusume[<?php echo $re1rows;?>]" type="checkbox" id="osusume[<?php echo $re1rows;?>]" value="1" <?php if($re1data[$re1rows]["osusume"]==1){echo " checked";}?>>
																<input name="bukkenid[<?php echo $re1rows;?>]" type="hidden" id="bukkenid[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["id"]; ?>" />
														</div>
												</TD>
												<TD width="9%" rowspan="2" valign="top" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><a href="?PID=re_c1_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
																<?php
if($re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo($_SERVER['DOCUMENT_ROOT']."/tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='/tmp/bukken_data/".$re1data[$re1rows]["id"]."/".str_replace("300","list",$re1data[$re1rows]["photo1"])."?".time()."' border='0' width='70'>";
}
else {
?>
														<img src="http://siteadmin.itcube.ne.jp/img/0707icon/noimg_s.gif" width="70" height="55" border="0" /></a><a href="?PID=re_c1_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
														<?php
}
?>
														</a></div>
												</TD>
												<td rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><div align="center"><?php if( $re1data[$re1rows]["daimeikou"]!=NULL){echo $re1data[$re1rows]["daimeikou"]."t";}?></div></td>												<TD rowspan="2" align="center" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><?php echo $re1data[$re1rows]["bukkenn_id"];?></TD>
												<TD rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div class="font12"> 
																<div align="center"><?php if($re1data[$re1rows]["chiku_nen"]!=NULL){ 
																
																	$ys=$re1data[$re1rows]["chiku_nen"];
																if($ys==1989){
																		echo "H 元年";
																}
																else if($ys>1988){
																echo "H ".($ys-1988)."年";
																}
																else {
																		echo "S ".($ys-1925)."年";
																}
																?>
																<?php
																
																echo date("m月",mktime(0,0,0,$re1data[$re1rows]["chiku_tsuki"],1,date("Y")));}?></div>
														</div>
														<div align="center"></div>
												</TD>
												<td align="left" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><?php echo $re1data[$re1rows]["chimoku"];?></td>
												<td rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><?php echo $re1data[$re1rows]["chisei"];?><br /></div>
												</td>
												<td rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><div align="right"><?php if( $re1data[$re1rows]["kyori"]!=NULL){echo number_format($re1data[$re1rows]["kyori"])."km";} ?></div></td>

												<td rowspan="2" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><div align="center"><?php echo $re1data[$re1rows]["zousajouto"];?></div></td>
												<TD width="7%" valign="middle" bgcolor="#FFECEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
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
												<TD width="4%" rowspan="2" valign="middle" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input name="del_chk[<?php echo $re1rows;?>]" type="checkbox" id="del_chk[<?php echo $re1rows;?>]" value="0"<?php if($re1data[$re1rows]["del_chk"]==0&&$re1data[$re1rows]["del_chk"]!=NULL) {echo " checked";}?>>
														</div>
												</TD>
												<TD width="3%" rowspan="2" valign="middle" bgcolor="#ECFFEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center"><span class="font12">
																<input name="del[<?php echo $re1rows;?>]" type="checkbox" id="del[<?php echo $re1rows;?>]" value="1">
														</span></div>
														<div align="center"></div>
												</TD>
										</TR>
										<TR class="realestate_bgcolor3">
												<td align="left" valign="middle" class="font12" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>><?php echo $re1data[$re1rows]["kosu"];?></td>
												<TD width="7%" valign="middle" bgcolor="#FFECEC" <?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
														<div align="center">
																<input type="button" name="Submit" value="複製" onClick="gocopy('<?php echo $re1data[$re1rows]["id"];?>')">
														</div>
												</TD>
										</TR>
										<?php
									}
									?>
								</TABLE>
								<TABLE width="100%" border="0" cellspacing="1" cellpadding="1">
										<TR>
												<TD>&nbsp;</TD>
										</TR>
										<TR>
												<TD width="100%">
														<div align="center">
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
												</TD>
										</TR>
								</TABLE>
								<br>
								<input name="btm_update_osusume" type="submit" id="btm_update_osusume" value="変更を適用する">
						</form>
				</TD>
		</TR>
</TABLE>
