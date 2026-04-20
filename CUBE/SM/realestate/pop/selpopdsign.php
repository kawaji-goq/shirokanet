<?php
if($_REQUEST["mode"]=="delbukken") {
	if($_REQUEST["id"]!=NULL) {
		$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
		$maxid = $maxdata["maxturn"]+1;
		$sql="insert into poptmp values ('".session_id()."',".time().",".$_REQUEST["id"].",".$maxid.")";
		$dbobj->Query($sql);
	/*
		@unlink("../tmp/".$_REQUEST["id"]."/photo_01.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/photo_01_s.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/photo_01_m.jpg");		
		@unlink("../tmp/".$_REQUEST["id"]."/photo_02.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/photo_02_s.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/photo_02_m.jpg");		
		@unlink("../tmp/".$_REQUEST["id"]."/layout.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout_s.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout_m.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout2.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout2_s.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout2_m.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout3.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout3_s.jpg");
		@unlink("../tmp/".$_REQUEST["id"]."/layout3_m.jpg");
		*/
	}
}
/*
if($_REQUEST["mode"]=="reg") {
				$sellist=$dbobj->GetList("select * from poptmp where session_id= '".session_id()."'");
				$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
				$maxid = $maxdata["maxturn"];
				$sql="insert into poptmp values ('".session_id()."',".time().",".$_REQUEST["id"].",".$maxdata["maxturn"].")";
				$dbobj->Query($sql);
		for($i=0;$sellist[$i]["id"]!=NULL;$i++){
				$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
				$maxid = $maxdata["maxturn"];
				$sql="insert into poptmp values ('".session_id()."',".time().",".$_REQUEST["id"].",".$maxdata["maxturn"].")";
				$dbobj->Query($sql);
		}
}
*/
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

function SelChk($id) {
	global $dbobj;
	$sql="select * from poptmp where session_id = '".session_id()."' and id = ".$id;
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
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>&nbsp;</td>
    </tr>
    
    <tr>
        <td align="left" bgcolor="#FFFFDC">
            <table width="83%" border="0" cellpadding="3" cellspacing="1">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td width="15%" valign="middle" nowrap><a href="?PID=pop"><strong>POPの管理</strong></a></td>
                        <td width="28%" height="50" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 デザインの選択</strong></font> </td>
                        <td width="29%" valign="middle" nowrap>&nbsp;</td>
                        <td width="27%" valign="middle" nowrap>&nbsp;</td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
                </table>
        </td>
    </tr>
    <tr>
        <td align="left">
            <table width="100%" border="0" cellspacing="1" cellpadding="2">
                <tr>
                    <td width="100%">&nbsp;</td>
                </tr>
                <tr>
                    <td><strong>デザインの選択</strong></td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <table width="753" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                                <td colspan="2" bgcolor="#ECECEC"><strong>4分割</strong></td>
                            </tr>
                            <tr>
                                <td width="371" bgcolor="#FFFFFF">
                                    <div align="center"><a href="http://siteadmin.itcube.ne.jp/sm/realestate/pop/print4_1.php?domain=<?php echo $_SESSION["DomainData"]["domain_name"] ?>&pop_id=<?php echo $_REQUEST["pop_id"];?>" target="_blank"><img src="http://tanaka1616.co.jp/admin/img/pop/pop4_2.jpg" width="200" height="142" border="0"></a></div>
                                </td>
                                <td width="371" bgcolor="#FFFFFF">
                                    <div align="center"><a href="http://siteadmin.itcube.ne.jp/sm/realestate/pop/print4_2.php?domain=<?php echo $_SESSION["DomainData"]["domain_name"] ?>&pop_id=<?php echo $_REQUEST["pop_id"];?>" target="_blank"><img src="http://tanaka1616.co.jp/admin/img/pop/pop4_3.jpg" width="200" height="142" border="0"></a></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table width="753" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                            <tr>
                                <td colspan="2" bgcolor="#ECECEC"><strong>8分割</strong></td>
                            </tr>
                            <tr>
                                <td width="371" bgcolor="#FFFFFF">
                                    <div align="center"><a href="http://siteadmin.itcube.ne.jp/sm/realestate/pop/print8_1.php?domain=<?php echo $_SESSION["DomainData"]["domain_name"] ?>&pop_id=<?php echo $_REQUEST["pop_id"];?>" target="_blank"><img src="http://tanaka1616.co.jp/admin/img/pop/pop8_2.jpg" width="200" height="290" border="0"></a></div>
                                </td>
                                <td width="371" bgcolor="#FFFFFF">
                                    <div align="center"><a href="http://siteadmin.itcube.ne.jp/sm/realestate/pop/print8_2.php?domain=<?php echo $_SESSION["DomainData"]["domain_name"] ?>&pop_id=<?php echo $_REQUEST["pop_id"];?>" target="_blank"><img src="http://tanaka1616.co.jp/admin/img/pop/pop8_3.jpg" width="200" height="284" border="0"></a></div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <td>
                        <input type="button" name="Submit" value="一覧へ戻る" onClick="location.href='?PID=pop'">
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left">
            <table width="83%" border="0" cellpadding="3" cellspacing="1">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td width="15%" valign="middle" nowrap><a href="?PID=pop"><strong>POPの管理</strong></a></td>
                        <td width="28%" height="50" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 デザインの選択</strong></font> </td>
                        <td width="29%" valign="middle" nowrap>&nbsp;</td>
                        <td width="27%" valign="middle" nowrap>&nbsp;</td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
</table>
