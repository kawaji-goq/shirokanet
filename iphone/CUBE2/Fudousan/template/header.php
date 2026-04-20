<?php
$tenpodata=$dbobj->GetData("select * from tenpo_data");
if($_REQUEST["key"]!=NULL) {
	$mentesql="select * from member where login_pw ='".$_REQUEST["key"]."' and member_id =0";
	$mentedata=$dbobj->GetData($mentesql);
	if($mentedata["member_id"]==0&&$mentedata["member_id"]!=NULL) {
		$_SESSION["mente"]=1;
	}
	else {
		$_SESSION["mente"]=0;
	}
}

if($tenpodata["status"]==1&&$_SESSION["mente"]!=1) {
?>
<script language="javascript">
location.replace("/maintenance.php");
</script>
<?php
}

if($tenpodata["header"]!=NULL) {

	echo "<center>".$tenpodata["header"]."</center>";
	
}
else {

function numberformat($number) {
		if($number==(int)($number)) {
				return $number=number_format($number);
		}
		else {
			for($i=0;!is_int($number*pow(10,$i));$i++) {
					if(substr_count(($number*pow(10,$i)),".")==0){						
						return number_format($number,$i);
						break;
					}
					if($i>10) {
						return $number;
						break;
					}
			}
		}	
}
?>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/prototype.js"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="/JSLIBS/lightbox/2.03.3/js/lightbox.js"></script>
<link rel="stylesheet" href="/JSLIBS/lightbox/2.03.3/css/lightbox.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style>
td {
	font-size:12px;
}
.nowpagenum {
	font-size:16px;
	color:#FF8800;
	font-weight:bold;
}
.hd{
	color:#999999;
	font-size:10px;
}
h1{
	margin:0px;
	padding:0px;
	text-decoration:none;
	font-weight:normal;
}
</style>
<table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <h1 class="hd">&nbsp;</h1>
        </td>
        <td colspan="4">
            <div align="left"><span class="hd"><?php echo $tenpodata["headertext"];?></span></div>
        </td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="6">
            <div align="left"><img src="/img/template/headers.jpg" width="816" height="23"></div>
        </td>
    </tr>
    <tr>
        <td width="25" rowspan="2" background="/img/template/TemplateLeft.jpg">
            <div align="left"></div>
        </td>
        <td width="620" valign="bottom"><a href="index.php"><?php if($tenpodata["headerimage"]) {?><img src="<?php echo $tenpodata["headerimage"] ?>" border="0"><?php }?></a></td>
        <td width="69"><img src="/img/template/HeaderLinkToMobile.jpg" width="69" height="71"></td>
        <td width="75"><img src="/tmp/qrdata.jpg" width="75" height="71"></td>
        <td width="4"><img src="/img/template/2_r1_c17.jpg" width="4" height="71"></td>
        <td width="25" background="/img/template/TemplateRight.jpg">
            <div align="right"></div>
        </td>
    </tr>
    <tr>
        <td colspan="4">
            <table width="768" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="112"><a href="/index.php"><img src="/img/template/HeaderMenuHome.jpg" width="112" height="34" border="0"></a></td>
                    <td width="109"><a href="/chintai.php?cid=1"><img src="/img/template/HeaderMenuBukken.jpg" width="109" height="34" border="0"></a></td>
                    <td width="109"><a href="/company.php"><img src="/img/template/HeaderMenuCompany.jpg" width="109" height="34" border="0"></a></td>
                    <td width="110"><a href="/topics.php"><img src="/img/template/HeaderMenuTopics.jpg" width="110" height="34" border="0"></a></td>
                    <td width="108"><a href="/qanda.php"><img src="/img/template/HeaderMenuQandA.jpg" width="108" height="34" border="0"></a></td>
                    <td width="110"><a href="/link.php"><img src="/img/template/HeaderMenuLink.jpg" width="110" height="34" border="0"></a></td>
                    <td width="110"><a href="/contact.php"><img src="/img/template/HeaderMenuContact.jpg" width="110" height="34" border="0"></a></td>
<!--                    <td width="112"><a href="/index.php"><img src="http://cubes.jp/img/template/HeaderMenuHome.jpg" width="112" height="34" border="0"></a></td>
                    <td width="109"><a href="/chintai.php?cid=1"><img src="http://cubes.jp/img/template/HeaderMenuBukken.jpg" width="109" height="34" border="0"></a></td>
                    <td width="109"><a href="/company.php"><img src="http://cubes.jp/img/template/HeaderMenuCompany.jpg" width="109" height="34" border="0"></a></td>
                    <td width="110"><a href="/topics.php"><img src="http://cubes.jp/img/template/HeaderMenuTopics.jpg" width="110" height="34" border="0"></a></td>
                    <td width="108"><a href="/qanda.php"><img src="http://cubes.jp/img/template/HeaderMenuQandA.jpg" width="108" height="34" border="0"></a></td>
                    <td width="110"><a href="/link.php"><img src="http://cubes.jp/img/template/HeaderMenuLink.jpg" width="110" height="34" border="0"></a></td>
                    <td width="110"><a href="/contact.php"><img src="http://cubes.jp/img/template/HeaderMenuContact.jpg" width="110" height="34" border="0"></a>
--></td>
                </tr>
            </table>
        </td>
        <td background="../img/template/TemplateRight.jpg">&nbsp;</td>
    </tr>
</table>
<?php
}
?>
