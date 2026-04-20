<?php
if($_REQUEST["mode"]=="delbukken") {
	if($_REQUEST["id"]!=NULL) {
		$dbobj->Query("ALTER TABLE poptmp drop  CONSTRAINT poptmp_pkey");
		$maxdata=$dbobj->GetData("select max(turn) as maxturn from poptmp where session_id= '".session_id()."'");
		$maxid = $maxdata["maxturn"]+1;
		$sql="insert into poptmp values ('".session_id()."',".time().",".$_REQUEST["id"].",".$maxid.")";
		$dbobj->Query($sql);
	/*
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
			$keysql.="";
			break;
	}
	
	
	if($_SESSION["key"]!=NULL) {
			$keysql.=" and (";
			$keysql.=" bukken_mei like '%".$_SESSION["key"]."%' or  jyusyo1 like '%".$_SESSION["key"]."%'";
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
	echo $sql="select * from poptmp where session_id = '".session_id()."' and bukken_id = ".$id;
	$data=$dbobj->GetData($sql);
	if($data["bukken_id"]!=NULL) {
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
<?php
$re1obj=new Ad_RealEstate($dbobj);
$tenpodata=$dbobj->GetData("select * from tenpo_data");
/* 暫定的 */

$dbobj->Query("update bukken set mnum = 0 where madori_tani='ROOM'");
$dbobj->Query("update bukken set mnum = 1 where madori_tani='K'");
$dbobj->Query("update bukken set mnum = 2 where madori_tani='DK'");
$dbobj->Query("update bukken set mnum = 3 where madori_tani='LDK'");
$dbobj->Query("update bukken set mnum = 5 where madori_tani='SLDK'");
$dbobj->Query("update bukken set mnum = 4 where madori_tani='SDK'");

if($_GET["sort"]!=NULL) {
	$_SESSION["sort"]=$_GET["sort"];
}

/*
else if($_SESSION["sort"]==NULL){
	$_SESSION["sort"]="kakaku";
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

}

if(substr_count($_SERVER['HTTP_REFERER'],"popselectb1")==0) {

	$_SESSION["madori"]="";
	$_SESSION["lowcost"]="";
	$_SESSION["hicost"]="";
	$_SESSION["keyword"]="";
	$_SESSION["chiiki"]="";
	$_SESSION["nophoto"]=0;
	$_SESSION["vchk"]="";

	
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
	
	$_SESSION["page"]=1;
}

$re1obj->type=4;
$re1data=$re1obj->GetReList(2,$_SESSION["sort"]);
$maxpage=ceil(($re1obj->numrows)/$_SESSION["lim"]);

$bsetdata=$dbobj->GetData("select * from bukken_setting2 where cate_id =1 ");

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
                        <td valign="middle" nowrap><a href="?PID=pop"><strong>POPの管理</strong></a></td>
                        <td height="50" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 物件の選択</strong></font> </td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択</a></strong></td>
                        <td valign="middle" nowrap>&nbsp;</td>
                        <td valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left"> </td>
    </tr>
    <tr>
        <td align="left"></td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
            <TABLE cellSpacing="0" cellPadding="0" align="left" border="0">
                <TBODY>
                    <TR>
                        <TD></TD>
                    </TR>
                    <TR>
                        <TD background="i">
                            <TABLE cellSpacing="0" cellPadding="0" align="center" border="0">
                                <TBODY>
                                    <TR>
                                        <TD colSpan="5"><IMG height="35" src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_type_link1.jpg" width="702"></TD>
                                    </TR>
                                    <TR>
                                        <TD width="89" bgColor="#fafbfc"><IMG height="27" src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_type_link2.jpg" width="89" border="0"></TD>
                                        <TD width="258" bgColor="#fafbfc">
                                            <p><A href="?PID=popselectc1&rp=1">・アパート・マンション</A>　<A href="?PID=popselectc2&rp=1">・戸建て</A>　<A href="?PID=popselectc3&rp=1">・事業用</A></p>
                                        </TD>
                                        <TD width="80" bgColor="#fafbfc"><IMG height="27" src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_type_link3.jpg" width="87"></TD>
                                        <TD width="258" bgColor="#fafbfc"><A href="?PID=popselectb1&rp=1">・戸建て・マンション</A>　<A href="?PID=popselectb3&rp=1">・事業用物件</A>　<A href="?PID=popselectb2&rp=1">・土地</A></TD>
                                        <TD align="right" width="10"><IMG height="27" src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_type_link4.jpg" width="10"></TD>
                                    </TR>
                                    <TR>
                                        <TD colSpan="5"><IMG height="9" src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_type_link5.jpg" width="702"></TD>
                                    </TR>
                                </TBODY>
                            </TABLE>
                        </TD>
                    </TR>
                </TBODY>
            </TABLE>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
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
                                    <div align="center">間取り</div>
                                </td>
                                <td width="38%">
                                    <select id="madori" name="madori">
                                        <option value="1"<?php if($_SESSION["madori"]==1){echo " selected";}?>>1Ｒ,Ｋ,ＤＫ,ＬＤＫ</option>
                                        <option value="2"<?php if($_SESSION["madori"]==2){echo " selected";}?>>2Ｋ,ＤＫ,ＬＤＫ</option>
                                        <option value="3"<?php if($_SESSION["madori"]==3){echo " selected";}?>>3ＤＫ,ＬＤＫ</option>
                                        <option value="4">
                                        <?php if($_SESSION["madori"]==4){echo " selected";}?>
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
                                <td>
                                    <select name="nophoto" id="nophoto">
                                        <option value="2"<?php if($_SESSION["nophoto"]==2) { echo " selected";}?>>登録済み</option>
                                        <option value="1"<?php if($_SESSION["nophoto"]==1) { echo " selected";}?>>未登録</option>
                                        <option value="0"<?php if($_SESSION["nophoto"]==0||$_SESSION["nophoto"]==NULL) { echo " selected";}?>>指定なし</option>
                                    </select>
                                </td>
                                <td align="center">状態</td>
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
                        </table>
                    </td>
                    <td width="10" align="right" background="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search3.jpg" width="10" height="51" /></td>
                </tr>
                <tr>
                    <td colspan="3"><img src="http://fudousan.itcube.ne.jp/asp/img_f/ver2/bd_search4.jpg" width="702" height="6" /></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
            <hr>
        </td>
    </tr>
    <tr>
        <td align="left">
            <TABLE width="100%"  border="0" cellpadding="2" cellspacing="1" class="bukkentable">
                <TR class="realestate_bgcolor2">
                    <th width="8%" rowspan="2">
                        <div align="center"></div>
                        <strong><?php echo $bsetdata["photo_name"] ?></strong></th>
                    <th width="22%">
                        <div align="center"><strong><a href="?PID=popselectb1&cid=<?php echo $_SESSION["cid"];?>&sort=bukkenn_id<?php if($_SESSION["sort"]=="bukkenn_id") { echo " desc";}?>">物件番号</a>
                                    <?php if($_SESSION["sort"]=="bukkenn_id") { echo "▼";}elseif($_SESSION["sort"]=="bukkenn_id desc") { echo "▲";}?>
                        </strong></div>
                    </th>
                    <th width="15%" rowspan="2">
                        <div align="center"><strong><a href="?PID=popselectb1&cid=<?php echo $_SESSION["cid"];?>&sort=kakaku<?php if($_SESSION["sort"]=="kakaku") { echo " desc";}?>">価格
                                        <?php if($_SESSION["sort"]=="kakaku") { echo "▼";}elseif($_SESSION["sort"]=="kakaku desc") { echo "▲";}?>
                        </a></strong></div>
                    </th>
                    <th width="13%" rowspan="2">
                        <div align="center"><strong><a href="?PID=popselectb1&cid=<?php echo $_SESSION["cid"];?>&sort=madori<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>,mnum<?php if($_SESSION["sort"]=="madori,mnum") { echo " desc";}?>">間取り
                                        <?php if($_SESSION["sort"]=="madori,mnum") { echo "▼";}elseif($_SESSION["sort"]=="madori desc,mnum desc") { echo "▲";}?>
                            </a></strong><br>
                            <?php echo $bsetdata["senyumenseki_name"] ?></div>
                    </th>
                    <th colspan="2" class="font12">
                        <div align="center"><?php echo $bsetdata["ensen_name"] ?></div>
                    </th>
                    <th width="5%" rowspan="2"><strong>公開</strong></th>
                    <th width="5%" rowspan="2">
                        <div align="center" class="font12">
                            <div align="center"><strong><font color="#000000">掲載</font></strong></div>
                        </div>
                    </th>
                </TR>
                
                <TR class="realestate_bgcolor2">
                    <th>
                        <div class="font14">
                            <div align="center"><strong><font color="#000000"><?php echo $bsetdata["bukken_mei_name"] ?><br>
                                            <div align="center"><strong><font color="#000000">
                                                <div align="center" class="st"><a href="?PID=<?php echo $_REQUEST["PID"];?>&cid=<?php echo $_SESSION["cid"];?><?php if($_SESSION["sort"]=="todouhuken,jyusyo1,jyusyo2,jyusyo3") { echo "&sort=todouhuken desc,jyusyo1 desc,jyusyo2 desc,jyusyo3 desc";}else {?>&sort=todouhuken,jyusyo1,jyusyo2,jyusyo3<?php }?>"><?php echo $bsetdata["jyusyo_name"] ?></a></div>
                                            </font></strong></div>
                            </font></strong></div>
                        </div>
                    </th>
                    <th width="13%" align="center" class="font12"><?php echo $bsetdata["youtochiiki_name"] ?></th>
                    <th width="8%" align="center" class="font12">
                        <div align="center"><?php echo $bsetdata["chiku_nen_name"] ?></div>
                    </th>
                </TR>
                <?php 
	$brows=0;
													for($re1rows=0;$re1data[$re1rows]["id"]!=NULL;$re1rows++) {
	?>
                <TR class="realestate_bgcolor3"<?php if(SelChk($re1data[$re1rows]["id"])==1){ echo ' bgcolor="#FFECEC"';}else { echo ' bgcolor="#FFFFFF"';}?>>
                    <TD width="8%" rowspan="2" valign="top" class="font12" >
                        <div align="center"><a href="?PID=popselectb1_rep&bid=<?php echo $re1data[$re1rows]["id"]; ?>">
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
                    <TD nowrap class="font14"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center"><span class="font12"><?php echo $re1data[$re1rows]["bukkenn_id"];?></span></div>
                    </TD>
                    <TD rowspan="2" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <table width="75%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td nowrap>
                                    <div align="right">
                                        <?php if($re1data[$re1rows]["kakaku"]!=NULL) {echo "<span class=\"list_price\">".number_format($re1data[$re1rows]["kakaku"])."</span><span class=\"list_price_tani\">万円</span>"; }else {echo "-";}?>
                                        <br />
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </TD>
                    <TD width="13%" rowspan="2" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center"><?php echo $re1data[$re1rows]["madori"].$re1data[$re1rows]["madori_tani"];?><br>
                                <strong>
                                <?php if($re1data[$re1rows]["senyumenseki"]!=NULL) {echo $re1data[$re1rows]["senyumenseki"]."m<sup>2</sup>";}else{ echo "-";}?>
                            </strong></div>
                    </TD>
                    <td colspan="2" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center">
                            <?php if($re1data[$re1rows]["eki"]!=NULL) {echo $re1data[$re1rows]["eki"]."駅";} ?>
                            <?php if($re1data[$re1rows]["ensen"]!=NULL) {echo "(".$re1data[$re1rows]["ensen"].")";} ?>
                            <?php if($re1data[$re1rows]["ekiho"]!=NULL) {echo "・徒歩".$re1data[$re1rows]["ekiho"]."分";} ?>
                        </div>
                    </td>
                    <TD width="5%" rowspan="2" valign="middle" >
                        <div align="center"><font size="2">
                            <?php if($re1data[$re1rows]["del_chk"]==0){echo "○";}else {echo "×";}?>
                        </font></div>
                    </TD>
                    <TD width="5%" rowspan="2" valign="middle" bgcolor="#FFFFFF">
                        <div align="center"><font size="2">
                            <input type="button" name="Submit3" value="掲載" onClick="location.href='?PID=<?php echo $_GET["PID"];?>&mode=delbukken&id=<?php echo $re1data[$re1rows]["id"];?>'">
                        </font></div>
                    </TD>
                </TR>
                
                <TR class="realestate_bgcolor3"<?php if(SelChk($re1data[$re1rows]["id"])==1){ echo ' bgcolor="#FFECEC"';}else { echo ' bgcolor="#FFFFFF"';}?>>
                    <TD nowrap class="font14"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center"><span class="font12"><?php echo $re1data[$re1rows]["bukken_mei"];?><br>
                                    <?php echo $re1data[$re1rows]["jyusyo1"].$re1data[$re1rows]["jyusyo2"].$re1data[$re1rows]["jyusyo3"];?></span></div>
                    </TD>
                    <td align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center"><?php echo $re1data[$re1rows]["youtochiiki"]; ?></div>
                    </td>
                    <td align="center" nowrap class="font12"<?php if($re1data[$re1rows]["del_chk"]==1) {echo " bgcolor=\"#EEEEEE\"";}else {echo " bgcolor=\"#ffffff\"";}?>>
                        <div align="center">
                            <?php if($re1data[$re1rows]["chiku_nen"]!=NULL){ echo $re1data[$re1rows]["chiku_nen"]."年";}else{ echo "-";} ?>
                        </div>
                    </td>
                </TR>
                <?php
									}
									?>
            </TABLE>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td align="left">
            <table border="0" align="center" cellpadding="3" cellspacing="0">
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
                        <td valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP1 物件の選択</strong></font> </td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択</a></strong></td>
                        <td valign="middle" nowrap>&nbsp;</td>
                        <td valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
</table>
