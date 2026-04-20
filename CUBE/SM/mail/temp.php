<?php
if($_GET["mode"]=="tempdel") {
	$delsql="delete from mail_templete where temp_id = ".$_GET["temp_id"];
	$dbobj->Query($delsql);
}
$tmpsql="select * from mail_templete order by temp_id";
$tmplist=$dbobj->GetList($tmpsql);

?>
<script language ="javascript">
function deletetemp(id,name){
	var res=confirm("テンプレート["+name+"]を削除しますか？");
	if(res) {
		location.href="?PID=mail_template&mode=tempdel&temp_id="+id;
	}
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
    <tr>
        <td>
            <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FCFCFC">
                <tr>
                    <td width="4%"><img src="/GW/img/template/icon_mail.jpg" width="40" height="42"></td>
                    <td width="96%" class="title"><font color="#333333">メールテンプレート一覧</font></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <form action="" method="POST" enctype="multipart/form-data" name="mail_form" id="mail_form">
                <TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
                    <TR>
                        <TD>&nbsp;</TD>
                    </TR>
                    <TR>
                        <TD>
                            <input type="button" name="Submit" value="新規にテンプレートを登録" onClick="location.href='?PID=mailtemp_reg'">
                            <table width="600" border="0" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <td width="192" bgcolor="#ECECEC">件名</td>
                                    <td width="253" bgcolor="#ECECEC">送信元アドレス</td>
                                    <td width="63" bgcolor="#ECECEC">
                                        <div align="center">修正</div>
                                    </td>
                                    <td width="63" bgcolor="#ECECEC">
                                        <div align="center">削除</div>
                                    </td>
                                </tr>
                                <?php
																																for($temprows=0;$tmplist[$temprows]["temp_id"]!=NULL;$temprows++) {
																																?><tr>
                                    <td bgcolor="#FFFFFF"><a href="?PID=mailtemp_up&temp_id=<?php echo $tmplist[$temprows]["temp_id"];?>"><?php echo $tmplist[$temprows]["subject"];?></a></td>
                                    <td bgcolor="#FFFFFF"><?php echo $tmplist[$temprows]["check_address"];?></td>
                                    <td bgcolor="#FFFFFF">
                                        <input type="button" name="Submit" value="修正する" onClick="location.href='?PID=mailtemp_up&temp_id=<?php echo $tmplist[$temprows]["temp_id"];?>'">
                                    </td>
                                    <td bgcolor="#FFFFFF">
                                        <input type="button" name="Submit" value="削除する" onClick="deletetemp(<?php echo $tmplist[$temprows]["temp_id"];?>,'<?php echo $tmplist[$temprows]["subject"];?>')">
                                    </td>
                                </tr>
																																<?php
																																}
																																?>
                            </table>
                        </TD>
                    </TR>
                    <TR>
                        <TD>
                            <TABLE width="100%"  border="0" align="center" cellpadding="1" cellspacing="1">
                                <TR>
                                    <TD>
                                        <input name="Submit" type="button" id="Submit" value="メール配信へ戻る" onClick="location.href='?PID=mail'">
                                    </TD>
                                </TR>
                            </TABLE>
                        </TD>
                    </TR>
                </TABLE>
            </form>
        </td>
    </tr>
</table>
