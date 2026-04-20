<?php
if($_REQUEST["mode"]=="delbukken") {
	if($_REQUEST["id"]!=NULL) {
		echo $sql="delete from poptmp where session_id = '".session_id()."' and rtime=".$_REQUEST["t"]." and bukken_id = ".$_REQUEST["id"];
		$dbobj->Query($sql);
	}
}
if($_REQUEST["upturn"]=="表示順を更新する"){
	for($i=0;$_REQUEST["id"][$i]!=NULL;$i++){
			$dbobj->Query("update poptmp set turn=".$_REQUEST["popturn"][$i]." where session_id= '".session_id()."' and rtime='".$_REQUEST["poprtime"][$i]."' and bukken_id=".$_REQUEST["id"][$i]);
			
	}
}
if($_GET["pcopy_id"]!=NULL) {
	$dbobj->Query("delete from poptmp where session_id ='".session_id()."'");
	$blist=$dbobj->GetList("select * from popsubdata where pop_id = ".$_GET["pcopy_id"]);
	"select * from popsubdata where pop_id = ".$_GET["pcopy_id"];
	for($j=0;$blist[$j]["bukken_id"]!=NULL;$j++) {
		$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
		$maxid = $maxdata["maxturn"]+1;
		$sql="insert into poptmp values ('".session_id()."',".time().",".$blist[$j]["bukken_id"].",".$maxid.")";
		$dbobj->Query($sql);
	}
}
if($_REQUEST["srcreset"]=="　　検索結果のリセット　　") {
	$_SESSION["key"]="";
}
if($_GET["syumoku"]!=NULL) {
	$_SESSION["syumoku"]=$_GET["syumoku"];
}
if($_POST["key"]!=NULL) {
	$_SESSION["key"]=$_POST["key"];
}
if($_GET["plmt"]!=NULL) {
	$_SESSION["plmt"]=$_GET["plmt"];
} 
if($_SESSION["plmt"]==NULL) {
	$_SESSION["plmt"]=20;
}
if($_GET["pnum"]!=NULL) {
	$_SESSION["pnum"]=$_GET["pnum"];
}
if($_SESSION["pnum"]==NULL) {
	$_SESSION["pnum"]=1;
}

if($_REQUEST["selid"]!=NULL) {
	$_SESSION["selid"]=$_REQUEST["selid"];
}
if($_GET["sortnum"]!=NULL) {
	$_SESSION["sortnum"]=$_GET["sortnum"];
}
if($_SESSION["sortnum"]==NULL) {
	$_SESSION["sortnum"]="id";
}
if($_GET["kanasrh"]!=NULL) {
	$_SESSION["kanasrh"]=$_GET["kanasrh"];
}

function CreateKey() {
$keysql=" id is not null";

	switch($_SESSION["syumoku"]) {
		case "1_1":
			$keysql.=" and (cate2=1)";
			break;
		case "1_2":
			$keysql.=" and (cate2=2)";
			break;
		case "1_3":
			$keysql.=" and (cate2=3)";
			break;
		case "1_4":
			$keysql.=" and (cate2=4)";
			break;
		case "2_1":
			$keysql.=" and (";
			$keysql.=" cate2=5 ";
			$keysql.=")";
			break;
		case "2_2":
			$keysql.=" and (";
			$keysql.=" cate2=6";
			$keysql.=")";
			break;
		case "2_3":
			$keysql.=" and (";
			$keysql.=" cate2=7";
			$keysql.=")";
			break;
		case "2_4":
			$keysql.=" and (";
			$keysql.=" cate2=8";
			$keysql.=")";
			break;
		default:
			$keysql.=" and (";
			$keysql.=" cate2=0";
			$keysql.=")";
			break;
	}
	
	if($_SESSION["kanasrh"]!=NULL) {
	/*		$kanaary["あ"]=array("あ","い","う","え","お");
			$kanaary["か"]=array("か","き","く","け","こ","が","ぎ","ぐ","げ","ご");
			$kanaary["さ"]=array("さ","し","す","せ","そ","ざ","じ","ず","ぜ","ぞ");
			$kanaary["た"]=array("た","ち","つ","て","と","だ","ぢ","づ","で","ど");
			$kanaary["な"]=array("な","に","ぬ","ね","の");
			$kanaary["は"]=array("は","ひ","ふ","へ","ほ","ば","び","ぶ","べ","ぼ","ぱ","ぴ","ぷ","ぺ","ぽ");
			$kanaary["ま"]=array("ま","み","む","め","も");
			$kanaary["や"]=array("や","ゆ","よ");
			
			$chkana[0]=$_SESSION["kanasrh"];
			$chkana[1]=mb_convert_kana($_SESSION["kanasrh"],"h");
			$chkana[2]=mb_convert_kana($_SESSION["kanasrh"],"C");
			$chkana[3]=mb_convert_kana($_SESSION["kanasrh"],"C");
			
			$keysql.=" and (";
			$keysql.=" bukken_name like 'あ%' or  place like '%".$_SESSION["key"]."%'";
			$keysql.=")";
	*/	
	}
	
	if($_SESSION["key"]!=NULL) {
			$keysql.=" and (";
			$keysql.=" bukken_name like '%".$_SESSION["key"]."%' or  place like '%".$_SESSION["key"]."%'";
			$keysql.=")";
	}
	
	return $keysql;
}
function BukkenList($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from bukken where ".$wheretxt." order by ".$_SESSION["sortnum"]." limit ".$_SESSION["plmt"]." offset ".($_SESSION["plmt"]*($_SESSION["pnum"]-1));
	$data=$dbobj->GetList($sql);
	return $data;
}
function SelBukkenList($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select *,poptmp.turn as popturn,poptmp.rtime as poprtime from poptmp inner join bukken on poptmp.bukken_id = bukken.id where poptmp.session_id = '".session_id()."' order by turn";
	$data=$dbobj->GetList($sql);
	return $data;
}
function BukkenCount($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from bukken where ".$wheretxt." order by ".$_SESSION["sortnum"]." limit ".$_SESSION["plmt"]." offset ".($_SESSION["plmt"]*($_SESSION["pnum"]-1));
	$result=$dbobj->Query($sql);
	$resultnumrows=$dbobj->NumRows($result);
	return $resultnumrows;
}
function SelBukkenCount($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from poptmp inner join bukken on poptmp.bukken_id = bukken.id where poptmp.session_id = '".session_id()."'";
	$result=$dbobj->Query($sql);
	$resultnumrows=$dbobj->NumRows($result);
	return $resultnumrows;
}
function BukkenMaxNum($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from bukken where ".$wheretxt;
	$result=$dbobj->Query($sql);
	$resultnumrows=$dbobj->NumRows($result);
	return $resultnumrows;
	
}
function SelBukkenMaxNum($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from poptmp inner join bukken on poptmp.bukken_id = bukken.id where poptmp.session_id = '".session_id()."'";
	$result=$dbobj->Query($sql);
	$resultnumrows=$dbobj->NumRows($result);
	return $resultnumrows;
	
}

//物件リスト
$re1data=SelBukkenList($dbobj);
//全部の数
$MaxNum=SelBukkenMaxNum($dbobj);
//ページ数
$MaxPage=(int)($MaxNum/$_SESSION["plmt"]);
if($MaxNum%$_SESSION["plmt"]!=0) {
	$MaxPage+=1;
}
//行数
$BCnt=SelBukkenCount($dbobj);
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<a name="top"></a>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>&nbsp;</td>
  </tr>
  
  
  <tr>
      <td align="left" bgcolor="#FFFFDC">
          <table border="0" cellpadding="3" cellspacing="1">
              <form name="form1" method="post" action="">
                  <tr valign="middle">
                      <td valign="middle" nowrap><strong>新規POPの作成</strong></td>
                      <td height="50" valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                      <td valign="middle" nowrap><strong><font color="#FF6600" size="+1">&gt;&gt;STEP2</font></strong><font color="#FF6600" size="+1"> <strong>選択した物件の確認</strong></font></td>
                      <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                      <td valign="middle" nowrap>&nbsp;</td>
                      <td valign="middle" nowrap>&nbsp;</td>
                </form>
          </table>
      </td>
  </tr>
  <tr>
    <td align="left">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="21%">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="11%">&nbsp;</td>
          <td width="8%">&nbsp;</td>
        </tr>
        <tr valign="middle">
          <td>（全<?php echo $MaxNum; ?>件）<?php echo $_SESSION["pnum"] ?>〜<?php echo $_SESSION["pnum"]+$BCnt-1; ?>件を表示</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
  <tr>
    <td align="left"><hr></td>
  </tr>
  <tr>
    <td align="left">
        <form name="form2" method="post" action="">

<TABLE width="100%"  border="0" cellpadding="2" cellspacing="1" class="bukkentable">
                <TR class="realestate_bgcolor2">
                    <th width="8%" rowspan="3">
                        <strong>外観写真</strong></th>
                    <th width="26%">
                        <div class="font12">
                            <div align="center"><strong>物件番号<a href="?PID=re_c1&cid=<?php echo $_SESSION["cid"];?>&sort=bukkenn_id<?php if($_SESSION["sort"]=="bukkenn_id") { echo " desc";}?>"></a></strong></div>
                        </div>
                    </th>
                    <th width="15%" rowspan="3">
                        <div align="center"><strong><span class="st">賃料・価格</span><br />
                            管理費・共益費</strong></div>
                    </th>
                    <th width="10%" rowspan="3" align="center"><strong><span class="st">間取り<br />
                    </span></strong></th>
                    <th colspan="2" rowspan="2" align="center"><strong>沿線</strong></th>
                    <th width="5%" rowspan="3"><strong>表示順</strong></th>
                    <th width="5%" rowspan="3">
                        <div align="center" class="font12">
                            <div align="center"><strong><font color="#000000">掲載</font></strong></div>
                        </div>
                    </th>
                </TR>
                <TR class="realestate_bgcolor2">
                    <th width="26%" rowspan="2">
                        <div align="center"><strong><font color="#000000">物件名</font></strong></div>
                        <div align="center"><strong><font color="#000000">
                            </font></strong>
                        <div align="center" class="st"><strong><font color="#000000">所在地</font></strong></div>
                        </div>
                    </th>
                </TR>
                <TR class="realestate_bgcolor2">
                    <th width="11%" align="center"><strong>礼金<br />
                        敷金</strong></th>
                    <th width="9%">
                        <div align="center">
                            <p><strong>種目<br />
                                    構造</strong></p>
                        </div>
                    </th>
                </TR>
                <?php 
	$re1rows=0;
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
	?>
                <TR class="realestate_bgcolor3">
                    <TD width="8%" rowspan="3" valign="top" bgcolor="#FFFFFF" class="font12" >
                        <div align="center"><a href="?PID=re_c1_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
                            <?php
if($re1data[$re1rows]["photo1"]!=NULL) {
	$fdata=(pathinfo("http://".$_SESSION["DomainData"]["domain_name"]."/tmp/bukken_data/".$re1data[$re1rows]["id"]."/".$re1data[$re1rows]["photo1"]));
	echo "<img src='".$fdata["dirname"]."/o_".str_replace("300","",$fdata["basename"])."?".time()."' border='0' width='70'>";
}
else {
?>
                            <img src="http://fudousan.itcube.ne.jp/img/noimage_120_120.gif" width="70" border="0" />
                            <?php
}
?>
                        </a></div>
                    </TD>
                    <TD valign="top" bgcolor="#FFFFFF" class="font12" >
                        <div class="font12">
                            <div align="center"><?php echo $re1data[$re1rows]["bukkenn_id"];?></div>
                        </div>
                    </TD>
                    <td rowspan="3" align="left" valign="middle" bgcolor="#FFFFFF" class="font12" >
                        <div align="center">
                            <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td nowrap>
                                        <div align="right">
                                            <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".$re1data[$re1rows]["kakaku"]."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?>
                                            <br />
                                            <?php 
																				if($re1data[$re1rows]["kanrihi"]!=NULL) {
																				?>
                                            <?php echo number_format($re1data[$re1rows]["kanrihi"]); ?>円
                                            <?php 
																								}
																								else if($re1data[$re1rows]["kyouekihi"]!=NULL) {
																				?>
                                            <?php echo number_format($re1data[$re1rows]["kanrihi"]); ?>円
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
                    <td rowspan="3" valign="middle" bgcolor="#FFFFFF" class="font12" >
                        <div align="center"><span class="st">
                            <?php 
																														if($re1data[$re1rows]["madori"]!=NULL&&$re1data[$re1rows]["madori"]!=0) {
																														echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"]; }else{ echo "-";}?>
                            <br />
                            </span>
                                <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>";}else{ echo "-";}?>
                        </div>
                    </td>
                    <td colspan="2" rowspan="2" valign="middle" bgcolor="#FFFFFF" class="font12" >
                        <div align="center">
                            <?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
                            <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                            <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
                        </div>
                    </td>
                    <TD width="5%" rowspan="3" valign="middle" bgcolor="#FFFFFF" >
                        <div align="center">
                            <input name="popturn[<?php echo $re1rows;?>]" type="text" id="popturn[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["popturn"];?>" size="8">
                            <input name="poprtime[<?php echo $re1rows;?>]" type="hidden" id="poprtime[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["poprtime"];?>">
                            <input name="bukken_id[<?php echo $re1rows;?>]" type="hidden" id="bukken_id[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["bukken_id"];?>">
                        </div>
                    </TD>
                    <TD width="5%" rowspan="3" valign="middle" bgcolor="#FFFFFF">
                        <div align="center"><font size="2">
                            <input type="button" name="Submit3" value="削除" onClick="location.href='?PID=<?php echo $_GET["PID"];?>&mode=delbukken&id=<?php echo $re1data[$re1rows]["id"];?>&t=<?php echo $re1data[$re1rows]["rtime"];?>'">
                        </font></div>
                    </TD>
                </TR>
                <TR class="realestate_bgcolor3">
                    <TD rowspan="2" valign="top" bgcolor="#FFFFFF" class="font12" >
                        <div align="center"><?php echo $re1data[$re1rows]["bukken_mei"];?><br>
                                <?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"].$re1data[$re1rows]["jyusyo3"];?>
                                <input name="bukkenid[<?php echo $re1rows;?>]" type="hidden" id="bukkenid[<?php echo $re1rows;?>]" value="<?php echo $re1data[$re1rows]["id"]; ?>">
                        </div>
                    </TD>
                </TR>
                <TR class="realestate_bgcolor3">
                    <td align="center" valign="middle" bgcolor="#FFFFFF" class="font12" >
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
                    <td align="center" bgcolor="#FFFFFF" class="font12" >
                        <div align="center"><?php echo $re1data[$re1rows]["syumoku"]; ?><br />
                                <?php echo $re1data[$re1rows]["kouzou"]; ?></div>
                    </td>
                </TR>
                <?php
									}
									?>
            </TABLE>
            <table width="100%" border="0" cellspacing="0" cellpadding="4">
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input name="upturn" type="submit" id="upturn" value="表示順を更新する">
                    </td>
                </tr>
            </table>
            </form>
        </td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
  </tr>
  <tr>
      <td align="left">
          <table border="0" cellpadding="3" cellspacing="1">
              <form name="form1" method="post" action="">
                  <tr valign="middle">
                      <td valign="middle" nowrap><strong>新規POPの作成</strong></td>
                      <td valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                      <td valign="middle" nowrap><strong><font color="#FF6600" size="+1">&gt;&gt;STEP2</font></strong><font color="#FF6600" size="+1"> <strong>選択した物件の確認</strong></font></td>
                      <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                      <td valign="middle" nowrap>&nbsp;</td>
                      <td valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
      </td>
  </tr>
</table>
