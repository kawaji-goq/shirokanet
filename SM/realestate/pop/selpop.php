<?php
if($_REQUEST["mode"]=="delbukken") {
	if($_REQUEST["id"]!=NULL) {
		$sql="delete from poptmp where session_id = '".session_id()."' and rtime=".$_REQUEST["t"]." and id = ".$_REQUEST["id"];
		$dbobj->Query($sql);
	}
}
if($_REQUEST["upturn"]=="表示順を更新する"){
	for($i=0;$_REQUEST["id"][$i]!=NULL;$i++){
			$dbobj->Query("update poptmp set turn=".$_REQUEST["popturn"][$i]." where session_id= '".session_id()."' and rtime='".$_REQUEST["poprtime"][$i]."' and id=".$_REQUEST["id"][$i]);
			
	}
}
if($_GET["pcopy_id"]!=NULL) {
	$dbobj->Query("delete from poptmp where session_id ='".session_id()."'");
	$blist=$dbobj->GetList("select * from popsubdata where pop_id = ".$_GET["pcopy_id"]);
	// "select * from popsubdata where pop_id = ".$_GET["pcopy_id"];
	for($j=0;$blist[$j]["id"]!=NULL;$j++) {
		$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
		$maxid = $maxdata["maxturn"]+1;
		$sql="insert into poptmp values ('".session_id()."',".time().",".$blist[$j]["id"].",".((int)$blist[$j]["turn"]).")";
		$dbobj->Query($sql);
	}
	?>
	<script language="javascript">
	location.replace("?PID=<?php echo $_REQUEST["PID"];?>");
	</script>
	<?php
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
	$sql="select *,poptmp.turn as popturn,poptmp.rtime as poprtime from poptmp inner join bukken on poptmp.id = bukken.id where poptmp.session_id = '".session_id()."' order by turn";
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
	$sql="select * from poptmp inner join bukken on poptmp.id = bukken.id where poptmp.session_id = '".session_id()."'";
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
	$sql="select * from poptmp inner join bukken on poptmp.id = bukken.id where poptmp.session_id = '".session_id()."'";
	$result=$dbobj->Query($sql);
	$resultnumrows=$dbobj->NumRows($result);
	return $resultnumrows;
	
}

//物件リスト
$BukkenList=SelBukkenList($dbobj);
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
<style>
td {
	font-size:12px;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<a name="top"></a>
<table width="759" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><img src="/admin_new/html/top/img/y.jpg" width="759" height="15"></td>
  </tr>
  <tr>
    <td><img src="/admin_new/html/management/img/maintitle.jpg" width="759" height="50"></td>
  </tr>
  
  <tr>
      <td align="left" bgcolor="#FFFFDC">
          <table width="83%" border="0" cellpadding="3" cellspacing="1">
              <form name="form1" method="post" action="">
                  <tr valign="middle">
                      <td width="15%" valign="middle" nowrap><a href="?PID=pop"><strong>POPの管理</strong></a></td>
                      <td width="28%" height="50" valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                      <td width="29%" valign="middle" nowrap><strong><font color="#FF6600" size="+1">&gt;&gt;STEP2</font></strong><font color="#FF6600" size="+1"> <strong>選択した物件の確認</strong></font></td>
                      <td width="27%" valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                      <td width="0%" valign="middle" nowrap>&nbsp;</td>
                      <td width="1%" valign="middle" nowrap>&nbsp;</td>
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
            <table width="759" border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td width="58">
                        <div align="center"><font size="2">物件項目</font></div>
                    </td>
                    <td width="210">
                        <div align="center">物件内容</div>
                    </td>
                    <td width="15">&nbsp;</td>
                    <td width="126" align="center" valign="middle">
                        <div align="center">写真1</div>
                    </td>
                    <td width="58" align="center" valign="middle">
                        <div align="center">検討中</div>
                    </td>
                    <td width="73" align="center" valign="middle">
                        <div align="center">表示状態</div>
                    </td>
                    <td width="81">
                        <div align="center">表示順</div>
                    </td>
                    <td width="43">
                        <div align="center"><font size="2">削除 </font></div>
                    </td>
                    <td width="5"><font size="2">&nbsp;</font></td>
                </tr>
            </table>
            <?php 
	$brows=0;
	while($BukkenList[$brows]["id"]!=NULL){
	?>
            <table width="759" border="0" cellpadding="5" cellspacing="0">
                <tr>
                    <td colspan="9"><font size="2"><img src="/admin_new/html/management/img/line.jpg" width="745" height="5"></font></td>
                </tr>
                <tr>
                    <td width="61" nowrap>物件NO</td>
                    <td width="217"><?php echo $BukkenList[$brows]["id"] ?><font size="2">&nbsp;</font></td>
                    <td width="14" rowspan="4"><font size="2">&nbsp;</font></td>
                    <td width="131" rowspan="4" align="center" valign="middle">
                        <table width="105" height="79" border="0" cellpadding="0" cellspacing="0">
                            <tr>
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
                    <td width="50" rowspan="4" align="center" valign="middle">
                        <?php 
			if($BukkenList[$brows]["kentou"]==1) {
			?>
                        <img src="/admin_new/html/management/img/flag.jpg" width="14" height="23">
                        <?php }?>
                    </td>
                    <td width="67" rowspan="4" align="center" valign="middle">
                        <div align="center"><font size="2">
                            <?php if($BukkenList[$brows]["viewchk"]==1){echo "○";}else {echo "×";}?>
                        </font></div>
                    </td>
                    <td width="77" rowspan="4">
                        <div align="center">
                            <input name="popturn[<?php echo $brows;?>]" type="text" id="popturn[<?php echo $brows;?>]" value="<?php echo $BukkenList[$brows]["popturn"];?>" size="8">
                            <input name="poprtime[<?php echo $brows;?>]" type="hidden" id="poprtime[<?php echo $brows;?>]" value="<?php echo $BukkenList[$brows]["poprtime"];?>">
                            <input name="id[<?php echo $brows;?>]" type="hidden" id="id[<?php echo $brows;?>]" value="<?php echo $BukkenList[$brows]["id"];?>">
                        </div>
                    </td>
                    <td width="47" rowspan="4"><font size="2">
                        <input type="button" name="Submit3" value="削除" onClick="location.href='?PID=<?php echo $_GET["PID"];?>&mode=delbukken&id=<?php echo $BukkenList[$brows]["id"];?>&t=<?php echo $BukkenList[$brows]["rtime"];?>'">
                    </font></td>
                    <td width="5" rowspan="4"><font size="2">&nbsp;</font></td>
                </tr>
                <tr>
                    <td width="61" nowrap>物件名</td>
                    <td width="217"><strong><font color="#009900"><?php echo $BukkenList[$brows]["bukken_name"] ?></font></strong></td>
                </tr>
                <tr>
                    <td width="61" nowrap>地域</td>
                    <td width="217"><font color="#FF6600"><?php echo $BukkenList[$brows]["place"] ?> </font></td>
                </tr>
                <tr>
                    <td width="61" nowrap>賃料・価格</td>
                    <td width="217">
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
          <table width="83%" border="0" cellpadding="3" cellspacing="1">
              <form name="form1" method="post" action="">
                  <tr valign="middle">
                      <td width="15%" valign="middle" nowrap><strong>新規POPの作成</strong></td>
                      <td width="28%" valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                      <td width="29%" valign="middle" nowrap><strong><font color="#FF6600" size="+1">&gt;&gt;STEP2</font></strong><font color="#FF6600" size="+1"> <strong>選択した物件の確認</strong></font></td>
                      <td width="27%" valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                      <td width="0%" valign="middle" nowrap>&nbsp;</td>
                      <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
              </table>
      </td>
  </tr>
</table>
