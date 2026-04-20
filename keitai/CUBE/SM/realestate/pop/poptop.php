<?php 
if($_GET["mode"]=="delete"){
	$dbobj->Query("delete from popsubdata where pop_id=".$_GET["del_id"]);
	$dbobj->Query("delete from popdata where pop_id=".$_GET["del_id"]);
	?>
	<script language="javascript">
	location.replace("?PID=pop");
	</script>
	<?php
}
$sql="select * from popdata order by rdate desc";
$poplist=$dbobj->GetList($sql);
?>
<script language="javascript">
function delchk(num) {
	var res=confirm("このPOPを削除してもよろしいですか？")	;
	if(res){
		location.href="?PID=pop&mode=delete&del_id="+num;
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>&nbsp;</td>
    </tr>
    
    <tr>
        <td align="left" bgcolor="#FFFFDC">
            <table border="0" cellpadding="3" cellspacing="1">
                <form name="form1" method="post" action="">
                    <tr valign="middle">
                        <td valign="middle" nowrap><font color="#FF6600" size="+1"><strong>POPの管理</strong></font></td>
                        <td height="50" valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                        <td valign="middle" nowrap>&nbsp;</td>
                        <td valign="middle" nowrap>&nbsp;</td>
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
            <form name="form1" method="post" action="">
                <table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                        <td><strong>POPの管理</strong></td>
                    </tr>
                    <tr>
                        <td>
                            <table border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <td nowrap bgcolor="#ECECEC"><strong>保存名</strong></td>
                                    <td bgcolor="#ECECEC"><strong>保存日時</strong></td>
                                    <td width="75" bgcolor="#ECECEC">
                                        <div align="center"></div>
                                    </td>
                                    <td width="125" bgcolor="#ECECEC">
                                        <div align="center"></div>
                                    </td>
                                    <td width="75" bgcolor="#ECECEC">
                                        <div align="center"></div>
                                    </td>
                                </tr>
                                <?php																
																for($i=0;$poplist[$i]["pop_id"]!=NULL;$i++) {
																?>
                                <tr>
                                    <td bgcolor="#FFFFFF"><?php echo $poplist[$i]["title"];?></td>
                                    <td bgcolor="#FFFFFF"><?php echo $poplist[$i]["rdate"];?></td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center">
                                            <input type="button" name="Submit" value="POP選択" onClick="location.href='?PID=popdesign&pop_id=<?php echo $poplist[$i]["pop_id"];?>'">
                                            </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center">
                                            <input type="button" name="Submit" value="コピーから新規作成" onClick="location.href='?PID=selpop&pcopy_id=<?php echo $poplist[$i]["pop_id"];?>'">
                                            </div>
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <div align="center">
                                            <input type="button" name="Submit" value="POP削除" onClick="delchk(<?php echo $poplist[$i]["pop_id"];?>)">
                                            </div>
                                    </td>
                                </tr>
                                <?php
																}
																?>
                            </table>
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
                        <td valign="middle" nowrap><font color="#FF6600" size="+1"><strong>POPの管理</strong></font></td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP1 <a href="?PID=popselect">物件の選択</a></strong> </td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP2</strong><strong></strong> <a href="?PID=selpop"><strong>選択した物件の確認</strong></a></td>
                        <td valign="middle" nowrap><strong>&gt;&gt;STEP3　<a href="?PID=popreg">分割タイプの選択・保存</a></strong></td>
                        <td valign="middle" nowrap>&nbsp;</td>
                        <td valign="middle" nowrap>&nbsp;</td>
                </form>
            </table>
        </td>
    </tr>
</table>
