<?php /*?><meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
*/
if($_REQUEST["todo_id"]!=NULL) {
$sql="select * from todo where todo_id = ".$_REQUEST["todo_id"];
$rdata=$dbobj->GetData($sql);
?>
<table width="100%"  border="0" align="center" cellpadding="3" cellspacing="1">
    
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                <tr>
                    <td width="4%"><img src="/GW/img/template/icon_todo.jpg" width="40" height="42"></td>
                    <td width="96%" class="title"><font color="#333333">お知らせ詳細</font></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            <table width="98%"  border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                    <td align="left" bgcolor="#ececec"><?php echo $rdata["title"]; ?>　<?php echo $rdata["senddate"]; ?></td>
                </tr>
                <tr>
                    <td align="left" bgcolor="#FFFFFF">
                        <table width="100%"  border="0" cellpadding="3" cellspacing="1">
                            <tr>
                                <td width="958" align="left" bgcolor="#FFFFFF"><?php echo nl2br($rdata["todo"]); ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td><a href="index.php?PID=todo">リストに戻る</a></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
</table>
<?php
	}
	else {
		echo "メッセージを指定してください。";
	}
	?>
