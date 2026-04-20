<?php
if($_REQUEST["mode"]=="delbukken") {
	if($_REQUEST["id"]!=NULL) {
		$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
		$maxid = $maxdata["maxturn"]+1;
		$sql="insert into poptmp values ('".session_id()."',".time().",".$_REQUEST["id"].",".$maxid.")";
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
$keysql=" bukken_id is not null";

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
function BukkenCount($dbobj) {
	$now=date("Y-m-d");
	$snow=explode("-",$now);
	$wheretxt=CreateKey();
	$sql="select * from bukken where ".$wheretxt." order by ".$_SESSION["sortnum"]." limit ".$_SESSION["plmt"]." offset ".($_SESSION["plmt"]*($_SESSION["pnum"]-1));
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

function SelChk($bukken_id) {
	global $dbobj;
	$sql="select * from poptmp where session_id = '".session_id()."' and bukken_id = ".$bukken_id;
	$data=$dbobj->GetData($sql);
	if($data["id"]!=NULL) {
		return 1;
	}
}
//物件リスト
$BukkenList=BukkenList($dbobj);
//全部の数
$MaxNum=BukkenMaxNum($dbobj);
//ページ数
$MaxPage=(int)($MaxNum/$_SESSION["plmt"]);
if($MaxNum%$_SESSION["plmt"]!=0) {
	$MaxPage+=1;
}
//行数
$BCnt=BukkenCount($dbobj);
?>
<style>
td {
	font-size:12px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<script type="text/JavaScript">
<!--
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
//-->
</script>
<a name="top"></a>
<table width="759" border="0" align="center" cellpadding="0" cellspacing="0">
    
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td align="left" bgcolor="#FFFFDC">
            <table width="83%" border="0" cellpadding="3" cellspacing="1">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td width="15%" valign="middle" nowrap><a href="?PID=pop"><strong>POPの管理</strong></a></td>
                        <td width="28%" height="50" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 物件の選択</strong></font> </td>
                        <td width="29%" valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td width="27%" valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択</a></strong></td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
                </table>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    
    <tr>
        <td align="left">
            <table width="759" border="0" cellpadding="0" cellspacing="0">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td colspan="6" valign="middle"><font size="2">
                            <input name="srcreset" type="submit" id="srcreset" value="　　検索結果のリセット　　">
                        </font></td>
                        <td width="275" valign="middle">
                            <div align="right"><font size="2">キーワード検索<br>
                                (物件名、地域) </font></div>
                        </td>
                        <td width="12" valign="middle"><font size="2">→</font></td>
                        <td width="200" valign="middle"> <font size="2">
                            <input name="key" type="text" id="key" value="<?php echo $_SESSION["key"];?>" size="40">
                        </font> </td>
                        <td width="18" valign="middle"><font size="2"><img src="/admin_new/html/management/img/megane.jpg" width="17" height="17"></font></td>
                        <td width="43" valign="middle"><font size="2">
                            <input name="b_search" type="submit" id="b_search" value="検索">
                        </font></td>
                        <td width="211"></td>
                    </tr>
                </form>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left">
            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td width="41%">
                        <?php if($_SESSION["pnum"]>1){ ?>
                        <a href="?PID=popselect&pnum=<?php echo $_SESSION["pnum"]-1;?>">前のページ</a>
                        <?php }?>
                        <?php $prows=1;
while($prows<=$MaxPage) {
	if($prows!=$_SESSION["pnum"]) {
?>
                        <a href="?PID=popselect&pnum=<?php echo $prows ?>"><?php echo $prows ?></a>
                        <?php 
			}
			else {
				echo $prows;
			}
			
			$prows++;
}?>
                        <?php if($MaxNum > ($_SESSION["pnum"]-1)*$_SESSION["plmt"]+1+$BCnt-1) {?>
                        <a href="?PID=popselect&pnum=<?php echo $_SESSION["pnum"]+1;?>">次のページ</a>
                        <?php } ?>
                    </td>
                    <td width="17%">
                        <div align="right">並べ替え→</div>
                    </td>
                    <td width="10%">
                        <select name="itemSort" id="itemSort" onChange="MM_jumpMenu('parent',this,0)">
                            <option value="?PID=popselect"<?php if($_SESSION["sortnum"]=="") echo " selected";?>>指定なし</option>
                            <option value="?PID=popselect&sortnum=price"<?php if($_SESSION["sortnum"]=="price") echo " selected";?>>賃料</option>
                            <option value="?PID=popselect&sortnum=madori"<?php if($_SESSION["sortnum"]=="madori") echo " selected";?>>間取り</option>
                        </select>
                    </td>
                    <td width="11%">表示件数→</td>
                    <td width="21%">
                        <select name="menu1" onChange="MM_jumpMenu('parent',this,0)">
                            <option value="?PID=popselect&plmt=10"<?php if($_SESSION["plmt"]==10) echo " selected";?>>10件</option>
                            <option value="?PID=popselect&plmt=20"<?php if($_SESSION["plmt"]==20) echo " selected";?>>20件</option>
                            <option value="?PID=popselect&plmt=30"<?php if($_SESSION["plmt"]==30) echo " selected";?>>30件</option>
                            <option value="?PID=popselect&plmt=40"<?php if($_SESSION["plmt"]==40) echo " selected";?>>40件</option>
                        </select>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left">
            <hr>
        </td>
    </tr>
    <tr>
        <td align="left">
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="9%">
                        <div align="center"><font size="2">物件項目</font></div>
                    </td>
                    <td width="29%">
                        <div align="center">物件内容</div>
                    </td>
                    <td>&nbsp;</td>
                    <td width="18%" align="center" valign="middle">
                        <div align="center">写真1</div>
                    </td>
                    <td width="9%" align="center" valign="middle">
                        <div align="center">検討中</div>
                    </td>
                    <td width="11%" align="center" valign="middle">
                        <div align="center">表示状態</div>
                    </td>
                    <td width="12%">&nbsp; </td>
                    <td width="7%">
                        <div align="center"><font size="2">削除 </font></div>
                    </td>
                    <td width="2%"><font size="2">&nbsp;</font></td>
                </tr>
            </table>
            <?php 
	$brows=0;
	while($BukkenList[$brows]["id"]!=NULL){
	?>
            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="9"><font size="2"><img src="/admin_new/html/management/img/line.jpg" width="745" height="5"></font></td>
                </tr>
                <tr<?php if(SelChk($BukkenList[$brows]["id"])==1){ echo ' bgcolor="#FFECEC"';}?>>
                    <td width="9%" nowrap>物件NO</td>
                    <td width="29%"><?php echo $BukkenList[$brows]["id"] ?><font size="2">&nbsp;</font></td>
                    <td rowspan="4"><font size="2">&nbsp;</font></td>
                    <td width="18%" rowspan="4" align="center" valign="middle">
                        <table width="105" height="79" border="0" cellpadding="0" cellspacing="0">
                            <tr<?php if(SelChk($BukkenList[$brows]["id"])==1){ echo ' bgcolor="#FFECEC"';}?>>
                                <td>
                                    <?php if(file_exists("../tmp/".$BukkenList[$brows]["id"]."/photo_01.jpg")) {
						if(!file_exists("../tmp/".$BukkenList[$brows]["id"]."/photo_01_s.jpg")) {
			magic_Image :: cpandconv_Size("../tmp/".$BukkenList[$brows]["id"]."/photo_01.jpg","photo_01_s.jpg","../tmp/".$BukkenList[$brows]["id"]."/",150,150);
		}
				?>
                                    <img src="/tmp/<?php echo $BukkenList[$brows]["id"]; ?>/photo_01_s.jpg" alt="" width="105" border="0" class="imageBorder" />
                                    <?php }?>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="9%" rowspan="4" align="center" valign="middle">
                        <?php 
			if($BukkenList[$brows]["kentou"]==1) {
			?>
                        <img src="/admin_new/html/management/img/flag.jpg" width="14" height="23">
                        <?php }?>
                    </td>
                    <td width="11%" rowspan="4" align="center" valign="middle">
                        <div align="center"><font size="2">
                            <?php if($BukkenList[$brows]["viewchk"]==1){echo "○";}else {echo "×";}?>
                            </font></div>
                    </td>
                    <td width="12%" rowspan="4">
                        <div align="center"><font size="2">
                            <input type="button" name="Submit32" value="プレビュー" onClick="window.open('http://tanaka1616.co.jp/index.php?PID=search_d<?php echo $BukkenList[$brows]["cate2"] ?>&bukken_id=<?php echo $BukkenList[$brows]["id"];?>')">
                            </font></div>
                    </td>
                    <td width="7%" rowspan="4"><font size="2">
                        <input type="button" name="Submit3" value="掲載" onClick="location.href='?PID=<?php echo $_GET["PID"];?>&mode=delbukken&bukken_id=<?php echo $BukkenList[$brows]["id"];?>'">
                        </font></td>
                    <td width="2%" rowspan="4"><font size="2">&nbsp;</font></td>
                </tr>
                <tr<?php if(SelChk($BukkenList[$brows]["id"])==1){ echo ' bgcolor="#FFECEC"';}?>>
                    <td nowrap>物件名</td>
                    <td><strong><font color="#009900"><?php echo $BukkenList[$brows]["bukken_name"] ?></font></strong></td>
                </tr>
                <tr<?php if(SelChk($BukkenList[$brows]["id"])==1){ echo ' bgcolor="#FFECEC"';}?>>
                    <td nowrap>地域</td>
                    <td><font color="#FF6600"><?php echo $BukkenList[$brows]["place"] ?> </font></td>
                </tr>
                <tr<?php if(SelChk($BukkenList[$brows]["id"])==1){ echo ' bgcolor="#FFECEC"';}?>>
                    <td nowrap>賃料・価格</td>
                    <td>
                        <?php 
				if(is_integer($BukkenList[$brows]["price"]/1000)) {
		echo number_format($BukkenList[$brows]["price"]/10000,1);
		}
		else {
		echo number_format($BukkenList[$brows]["price"]/10000,2);
		}?>
                        万円</td>
                </tr>
            </table>
            <?php
	$brows++;
	}
	?>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
            <table width="83%" border="0" cellpadding="3" cellspacing="1">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td width="15%" valign="middle" nowrap><strong>新規POPの作成</strong></td>
                        <td width="28%" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 物件の選択</strong></font> </td>
                        <td width="29%" valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td width="27%" valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択</a></strong></td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
</table>
