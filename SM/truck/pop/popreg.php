<?php
if($_REQUEST["btmregist"]=="保存してPOPを表示") {
		$maxdata=$dbobj->GetData("select max(pop_id) as maxid from popdata");
		$maxid = $maxdata["maxid"]+1;
		$sql="insert into popdata values (".$maxid.",'".$_REQUEST["title"]."','".date("Y-m-d")."','',".$_REQUEST["num"].",1)";
		$dbobj->Query($sql);
		$sellist=$dbobj->GetList("select * from poptmp where session_id= '".session_id()."'");

		for($i=0;$sellist[$i]["bukken_id"]!=NULL;$i++){
				$maxdata2=$dbobj->GetData("select max(popsub_id) as maxid from popsubdata");
				$maxid2 = $maxdata2["maxid"]+1;
				$sql="insert into popsubdata values (".$maxid2.",".$sellist[$i]["bukken_id"].",".$maxid.",".$sellist[$i]["turn"].")";
				$dbobj->Query($sql);
		}
		$dbobj->Query("delete from poptmp where session_id='".session_id()."'");
		
?>
<script language="javascript">
window.open("http://siteadmin.itcube.ne.jp/sm/realestate/pop/print<?php echo $_REQUEST["num"]."_".$_REQUEST["type"];?>.php?domain=<?php echo $_SESSION["DomainData"]["domain_name"] ?>&pop_id=<?php echo $maxid;?>");
location.replace("?PID=pop");
</script>
<?php
}
?>

<script language="javascript">
function seldes(num,type) {
	document.reg_form1.num.value=num;
	document.reg_form1.type.value=type;
	document.all("layout4_1").style.background="#ffffff";
	document.all("layout4_2").style.background="#ffffff";
	document.all("layout8_1").style.background="#ffffff";
	document.all("layout8_2").style.background="#ffffff";
	document.all("layout"+num+"_"+type).style.background="#FF0000";
}
</script><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
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
                        <td width="28%" height="50" valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                        <td width="29%" valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td width="27%" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP3　分割タイプの選択・保存</strong></font></td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
    <tr>
        <td align="left">
            <hr>
        </td>
    </tr>
    <tr>
        <td align="left">&nbsp;</td>
    </tr>
    <tr>
        <td height="300" align="left" valign="top">
            <form name="reg_form1" method="post" action="">
                <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <td width="10%" bgcolor="#ECECEC"><strong>保存名
                            
                        </strong></td>
                        <td width="90%" bgcolor="#FFFFFF">
                            <input name="title" type="text" id="title" value="<?php echo date("Y年m月d日H時i分に作成");?>" size="40">
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" bgcolor="#FFFFFF">
                            <table width="100%" border="0" cellspacing="1" cellpadding="2">
                                <tr>
                                    <td width="100%">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td><strong>デザインを選択してください。
                                        <input name="btmregist" type="hidden" id="btmregist" value="保存してPOPを表示">
                                        <input name="num" type="hidden" id="num" value="4">
                                        <input name="type" type="hidden" id="type" value="1">
                                    </strong></td>
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
                                                <td width="371" align="center" bgcolor="#FFFFFF">
                                                    <div align="center">
                                                        <table border="0" cellpadding="4" cellspacing="1" id="layout4_1">
                                                            <tr>
                                                                <td width="100%"><a href="javascript:seldes('4','1')"><img src="http://tanaka1616.co.jp/admin/img/pop/pop4_2.jpg" width="200" height="142" border="0"></a></td>
                                                            </tr>
                                                        </table>
                                                    <a href="#" target="_blank"></a></div>
                                                </td>
                                                <td width="371" align="center" bgcolor="#FFFFFF">
                                                    <div align="center">
                                                        <table border="0" cellpadding="4" cellspacing="1" id="layout4_2">
                                                            <tr>
                                                                <td width="100%"><a href="javascript:seldes('4','2')"><img src="http://tanaka1616.co.jp/admin/img/pop/pop4_3.jpg" width="200" height="142" border="0"></a></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                            <tr>
                                                <td width="100%" colspan="2" bgcolor="#ECECEC"><strong>8分割</strong></td>
                                            </tr>
                                            <tr>
                                                <td width="33%" bgcolor="#FFFFFF">
                                                    <div align="center">
                                                        <table border="0" cellpadding="4" cellspacing="1" id="layout8_1">
                                                            <tr>
                                                                <td width="100%"><a href="javascript:seldes('8','1')"><img src="http://tanaka1616.co.jp/admin/img/pop/pop8_2.jpg" width="200" height="285" border="0"></a></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                                <td width="33%" bgcolor="#FFFFFF">
                                                    <div align="center">
                                                        <table border="0" cellpadding="4" cellspacing="1" id="layout8_2">
                                                            <tr>
                                                                <td width="100%"><a href="javascript:seldes('8','2')"><img src="http://tanaka1616.co.jp/admin/img/pop/pop8_3.jpg" width="200" height="284" border="0"></a></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" bgcolor="#FFFFFF">
                            <input name="btmregists" type="submit" id="btmregists" value="保存してPOPを表示">
                            <input type="button" name="Submit" value="戻る" onClick="history.back()">
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
                        <td width="29%" valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td width="27%" valign="middle" nowrap><font color="#FF6600" size="+1"><strong>&gt;&gt;STEP3　分割タイプの選択・保存</strong></font></td>
                        <td width="0%" valign="middle" nowrap>&nbsp;</td>
                        <td width="1%" valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
</table>
