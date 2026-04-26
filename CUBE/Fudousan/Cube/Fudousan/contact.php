<?php
include "/tmp/CUBE/Fudousan/config.php";
include "ITC/modules.php";
	include $_SERVER["DOCUMENT_ROOT"]."/config/config.php";
;
$tenpodata=$dbobj->GetData("select * from tenpo_data");
$re1obj=new RealEstate($dbobj);
$re1obj->type=$_REQUEST["cid"];
$re1data=$re1obj->GetReData($_GET["bid"]);
$tenpodata=$dbobj->GetData("select * from tenpo_data");

switch($re1data["syumoku"]) {
	case "����":
		$btype=3;
		break;
	case "���ϸ�����":
		$btype=3;
		break;
	case "���۰�ͷ�����":
		$btype=2;
		break;
	case "��Ű�ͷ�����":
		$btype=2;
		break;
	case "���ۥƥ饹�ϥ���":
		$btype=2;
		break;
	case "��ťƥ饹�ϥ���":
		$btype=2;
		break;
	case "���ۥޥ󥷥��":
		$btype=1;
		break;
	case "��ťޥ󥷥��":
		$btype=1;
		break;
	case "���۰�ͷ���":
		$btype=1;
		break;
	case "���۸��Ľ���":
		$btype=1;
		break;
	case "��Ÿ��Ľ���":
		$btype=1;
		break;
	case "���۸��ҽ���":
		$btype=1;
		break;
	case "��Ÿ��ҽ���":
		$btype=1;
		break;
	case "���ۥ�����ϥ���":
		$btype=1;
		break;
	case "��ť�����ϥ���":
		$btype=1;
		break;
	case "�꥾���ȥޥ󥷥��":
		$btype=1;
		break;
	case "Ź��":
		$btype=4;
		break;
	case "Ź���ս���":
		$btype=4;
		break;
	case "������Ź��":
		$btype=4;
		break;
	case "��̳��":
		$btype=4;
		break;
	case "Ź�޻�̳��":
		$btype=4;
		break;
	case "�ӥ�":
		$btype=4;
		break;
	case "����":
		$btype=4;
		break;
	case "�ޥ󥷥��":
		$btype=4;
		break;
	case "�Ҹ�":
		$btype=4;
		break;
	case "���ѡ���":
		$btype=4;
		break;
	case "��":
		$btype=4;
		break;
	case "ι��":
		$btype=4;
		break;
	case "�ۥƥ�":
		$btype=4;
		break;
	case "����":
		$btype=4;
		break;
	case "�꥾���ȥޥ󥷥��":
		$btype=4;
		break;
	case "����¾":
		$btype=4;
		break;
	case "Ź��":
		$btype=4;
		break;
	case "��̳��":
		$btype=4;
		break;
	case "Ź�ޡ���̳��":
		$btype=4;
		break;
	case "����¾":
		$btype=4;
		break;
}

function Normal($pdata,$tenpodata) {
	
	if($pdata["subject"]==NULL) {
		$msbj="�ۡ���ڡ������餪��礻������ޤ�����";
	}
	else {
		$msbj=$pdata["subject"];
	}
	
	$csbj=$tenpodata["name"]."���������ޤ�����";
	$mtxt="";
	$ctxt="";
	
	$text= 	"���̾����̾��������������".$_POST["corpname"]."\n".
				"��ô���ԡ���������".$_POST["tantouname"]."\n".
				"�᡼�륢�ɥ쥹����".$_POST["email"]."\n".
				"�������ֹ桡������".$_POST["telnumber"]."\n".
				"FAX�ֹ桡������ ��".$_POST["faxnumber"]."\n".
				"���� ��".$_POST["zipcode"]."\n".
				"����ϡ� ��".$_POST["address"]."\n".
				"-------------------------------------------------------\n".
				"���ո������䤤��碌��\n".
				"-------------------------------------------------------\n".
				$_POST["comment"].$_POST["psbukken"]."\n";
				$mtxt= "�����ͤ���ʲ������ƤǤ��䤤��碌��ͭ��ޤ�����\n".
				"-------------------------------------------------------\n".
				$text;
				$ctxt= "�ʲ������ƤǤ��䤤��碌���������ޤ�����\n".
				"-------------------------------------------------------\n".
				$text.
				"-------------------------------------------------------\n".
				$tenpodata["name"]." \n".
				$tenpodata["jyusyo"]."\n".
				" TEL ".$tenpodata["denwa"]."��FAX ".$tenpodata["fax"]."\n".
				" E-mail ".$tenpodata["email"]."\n".
				" H.P ".$tenpodata["url"]."\n".
				"-------------------------------------------------------";
				
	$csbj=mb_convert_kana($csbj,"KV");
	$ctxt=mb_convert_kana($ctxt,"KV");
	$msbj=mb_convert_kana($msbj,"KV");
	$mtxt=mb_convert_kana($mtxt,"KV");
	mb_send_mail($_POST["email"],$csbj,$ctxt,"From:".$tenpodata["email"]."\nReply-To: ".$tenpodata["email"]."","-f ".$tenpodata["email"]."");
	mb_send_mail($tenpodata["email"],$msbj,$mtxt,"From:".$_POST["email"]."\nReply-To: ".$_POST["email"]."","-f ".$_POST["email"]."");
	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<?php
if(str_replace("www.","",$_SERVER['HTTP_HOST'])=="cubes.jp"){
?>
<meta name="robots" content="noindex,nofollow">��
<meta name="robots" content="noarchive">
<?php
}?><title><?php echo $tenpodata["pagetitle"];?> /  ���䤤��碌</title>
<style type="text/css">
<!--
body {
	background-color: #E9F1AF;
}
-->
</style>
<link href="fudousan.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 2px}

-->
</style><script type="text/JavaScript">
<!--
function zipsearch(frm) {
zip=frm.zipcode.value;
if(zip==null||zip=="") {
alert("�������Ϥ���Ƥ��ޤ���");
}
else {
window.open("./tool/zipsearch.php?zipcode="+zip,"zipsearch","width=400,height=200");
}
}
function datachk(frm) {
alertchk=0;
alerttxt="";
if(frm.corpname.value=="") {
alertchk=1;
alerttxt=alerttxt+"���̾����̾�������Ϥ���Ƥ��ޤ���\n";
}
if(frm.email.value=="") {
alertchk=1;
alerttxt=alerttxt+"�᡼�륢�ɥ쥹�����Ϥ���Ƥ��ޤ���\n";
}
else if(frm.email2.value=="") {
alertchk=1;
alerttxt=alerttxt+"�᡼�륢�ɥ쥹��ǧ�����Ϥ���Ƥ��ޤ���\n";

}
else if(frm.email.value!=frm.email2.value) {
alertchk=1;
alerttxt=alerttxt+"�᡼�륢�ɥ쥹�ȥ᡼�륢�ɥ쥹��ǧ���ۤʤ�ޤ���\n";
}
if(frm.comment.value=="") {
alertchk=1;
alerttxt=alerttxt+"���䤤��碌���Ƥ����Ϥ���Ƥ��ޤ���\n";
}
if(alertchk==0) {
res=confirm("�������ƤǤ���礻���������Ƥ������Ǥ�����");
if(res) {
frm.mode.value="send";
frm.submit();
}
}
else {
alert(alerttxt);
}
}
//-->
</script></head>
<body> 
<?php
include "/tmp/CUBE/Fudousan/template/header.php";
?>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg"><img src="img/template/TemplateLeft.jpg" width="25" height="650" /></td>
        <td align="left" valign="top">
            <table width="678" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="3"><img src="img/contact/ToiawaseHeader.jpg" width="770" height="61" /></td>
                </tr>
                <tr>
                    <td width="49" background="img/contact/ToiawaseLeft.jpg"><img src="img/contact/ToiawaseLeft.jpg" width="49" height="64" /></td>
                    <td width="675">
                        <?php 
if($_POST["mode"]=="send"&&$_SESSION["toiawase"]!="on") {
@Normal($_POST,$tenpodata);
$_SESSION["toiawase"]="on";
?>
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                            <tr>
                                <td width="100%" align="left" class="text">
                                    <p>�ʲ������ƤǤ���礻�᡼����������ޤ�����<br />
                                            <?php
$_REQUEST["email"];
?>
                                        ���Ƥ˳�ǧ�᡼������ꤷ�ޤ����ΤǤ���ǧ�������� <br />
                                        �⤷���Υ᡼������ä�2,3��������ֿ��᡼�뤬�Ϥ��ʤ����Ϥ�����Ǥ����᡼�����Ϥ����äˤƤ�Ϣ��������</p>
                                    <p>����礻�衧<span class="title"><?php echo $tenpodata["name"]; ?></span>��<br />
                                            <span class="fudousan">TEL : <?php echo $tenpodata["denwa"]; ?> FAX : <?php echo $tenpodata["fax"]; ?></span><br />
                                        E-mail��<a href="mailto:<?php echo $tenpodata["email"]; ?>"><?php echo $tenpodata["email"]; ?></a></p>
                                </td>
                            </tr>
							<tr>
								<td>
<font color="#FF0000">�������Ȥ˷Ǻܤ���Ƥ���ʪ��ϥ���ץ�Ǥ���<br>ʪ����Ф��뤪�䤤��碌�ˤϤ������Ǥ��ޤ���ΤǤ�λ������������</font>
								</td>
							</tr>
                            <tr>
                                <td align="left" class="text">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="150" height="20" align="left"><font size="2">���̾����̾��<font color="#FF0000">��</font></font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["corpname"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left"><font size="2">�᡼�륢�ɥ쥹<font color="#FF0000">��</font></font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["email"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left"><font size="2">�������ֹ�</font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["telnumber"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left"><font size="2">FAX�ֹ�</font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["faxnumber"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left"><font size="2">��</font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["zipcode"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left" valign="top"><font size="2">�����
                                                <input name="mode" type="hidden" id="mode3" />
                                            </font></td>
                                            <td align="left"> <font size="2"><?php echo $_POST["address"];?> </font></td>
                                        </tr>
                                        <tr>
                                            <td height="20" align="left" valign="top">���䤤��碌��̾</td>
                                            <td align="left"><font size="2"><?php echo $_POST["subject"];?></font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left" valign="top"><font size="2">���䤤��碌����<font color="#FF0000">��</font></font></td>
                                            <td align="left"> <font size="2"><?php echo nl2br($_POST["comment"].$_POST["psbukken"]);?> </font></td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" align="left" valign="top"><font size="2">&nbsp;</font></td>
                                            <td align="left">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td width="150" height="20" valign="top"><font size="2">&nbsp;</font></td>
                                            <td>&nbsp; </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <?php
}
else if($_POST["mode"]=="send"&&$_SESSION["toiawase"]=="on") {
$_SESSION["toiawase"]="";
?>
                        <script language="JavaScript" type="text/javascript">
alert("���Υڡ����ϥ���ɤǤ��ޤ���");
window.location.replace("/");
                        </script>
                        <?php
}
else {
?>
                        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                            <tr>
                                <td width="100%" align="center">
                                    <table width="100%" border="0" cellpadding="5" cellspacing="5">
                                        <tr>
                                            <td>
                                                <div align="left"><font size="2"><strong>���䤤��碌�ˤĤ���</strong><br />
                                                            <br />
                                                    </font><span class="noda2">���䤤��碌�ˤϽ��������ᤤ�����򿴤����Ƥ���ޤ��������Ƥˤ�äƤϲ����˻��֤���������⤴�����ޤ���<br />
                                                        �ޤ������䤤��碌���Ƥˤ�äƤϡ�����ô���Ԥ���ľ��Ϣ�����Ƥ���������礬�������ޤ���</span><span class="text"><br />
                                                            </span><span class="noda2">ͽ��λ����������</span><span class="text"><br />
                                                                <br />
                                                                </span><span class="noda2">����礻��<br />
                                                                    <?php echo $tenpodata["name"]; ?><br />
                                                                    </span>TEL :<span class="noda1"> <?php echo $tenpodata["denwa"]; ?> </span>FAX :<span class="noda1"> <?php echo $tenpodata["fax"]; ?></span><span class="noda2"><br />
                                                                    </span>E-mail��<a href="mailto:<?php echo $tenpodata["email"]; ?>"></a><span class="noda1"><a href="mailto:<?php echo $tenpodata["email"]; ?>"><?php echo $tenpodata["email"]; ?></a></span></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
                                        <tr>
                                            <td>
                                                <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                                    <form action="" method="post" name="contact_form" id="contact_form">
                                                        <tr>
                                                            <td height="20" colspan="2" align="left" nowrap="nowrap" class="noda1">���ե��������ϤˤƤ���礻�����ϲ��������ϡ�������������</td>
                                                        </tr>
                                                        <tr>
                                                            <td height="20" colspan="2" align="left" nowrap="nowrap"><span class="noda3"><font color="#FF0000">��ɬ�ܹ���</font></span></td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">���̾����̾��<font color="#FF0000">��</font></font></td>
                                                            <td align="left">
                                                                <input name="corpname" type="text" id="corpname" size="40" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">��ô����</font></td>
                                                            <td align="left">
                                                                <input name="tantouname" type="text" id="tantouname" size="40" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">�᡼�륢�ɥ쥹<font color="#FF0000">��</font></font></td>
                                                            <td align="left">
                                                                <input name="email" type="text" id="email" style="ime-mode:disabled;" size="40" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">�᡼�륢�ɥ쥹��ǧ<font color="#FF0000">��</font></font></td>
                                                            <td align="left">
                                                                <input name="email2" type="text" id="email2" style="ime-mode:disabled;" size="40" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">�������ֹ�</font></td>
                                                            <td align="left">
                                                                <input name="telnumber" type="text" id="telnumber" size="16" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">FAX�ֹ�</font></td>
                                                            <td align="left">
                                                                <input name="faxnumber" type="text" id="faxnumber" size="16" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" nowrap="nowrap"><font size="2">��
                                                                <input name="mode" type="hidden" id="mode" />
                                                            </font></td>
                                                            <td align="left">
                                                                <input name="zipcode" type="text" id="zipcode" size="14" />
                                                                <input name="zsearch" type="button" id="zsearch" onclick="zipsearch(this.form)" value="͹���ֹ椫�齻��򸡺�" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" valign="top" nowrap="nowrap"><font size="2">����� </font></td>
                                                            <td align="left">
                                                                <input name="address" type="text" id="address" size="60" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="20" align="left" valign="top" nowrap="nowrap">���䤤��碌��̾</td>
                                                            <td align="left">
                                                                <input name="subject" type="text" id="subject" value="<?php 
																		if($_GET["bid"]!=NULL) {
																			$sbj="";
																			if($re1data["bunrui"]==1) {
																				$sbj="����ʪ��";
																			}
																			else if($re1data["bunrui"]==2){ 
																				$sbj="����ʪ��";
																			}
																			if($re1data["bukken_mei"]!="") {
																				$sbj.="[".$re1data["bukken_mei"]."]";
																			}
																			echo $sbj.="�ˤĤ��ƤΤ��䤤��碌[ʪ���ֹ桧".$re1data["bukkenn_id"]."]";
																		}
																		
																		?>" size="80" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" align="left" valign="top" nowrap="nowrap"><font size="2">���䤤��碌����<font color="#FF0000">��</font></font></td>
                                                            <td align="left">
                                                                <textarea name="comment" cols="60" rows="10" id="comment"></textarea>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                            <td align="left"><?php 
																		if($_GET["rurl"]!=NULL) {
																			echo 	"<br />".
																						"ʪ��URL��http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
																		}
																		?>
                                                                <input name="psbukken" type="hidden" id="psbukken" value="<?php 
																		if($_GET["rurl"]!=NULL) {
																			echo 	"\n\n------------------------------------------------------------\n".
																									"ʪ��URL��http://".$_SERVER['HTTP_HOST'].$_REQUEST["rurl"]."";
																		}
																		?>" />
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                            <td align="left">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                            <td width="150" height="20" valign="top" nowrap="nowrap">&nbsp;</td>
                                                            <td align="left">
                                                                <input name="btm_send" type="button" id="btm_send" onclick="datachk(this.form)" value="����礻" />
                                                            </td>
                                                        </tr>
                                                    </form>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <?php 
}
?>
                    </td>
                    <td width="46" background="img/contact/ToiawaseRight.jpg"> <img src="img/contact/ToiawaseRight.jpg" width="46" height="64" /></td>
                </tr>
                
                <tr>
                    <td colspan="3"><img src="img/contact/ToiawaseFooter.jpg" width="770" height="51" /></td>
                </tr>
            </table>
        </td>
        <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg"><img src="img/template/TemplateRight.jpg" width="25" height="71" /></td>
    </tr>
</table>
<?php
include "/tmp/CUBE/Fudousan/template/footer.php";
?>
</body>
</html>
