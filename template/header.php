<?php
$tenpodata=$dbobj->GetData("select * from tenpo_data");
if($tenpodata["header"]!=NULL) {
	echo "<center>".$tenpodata["header"]."</center>";
}
else {

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
.hd {
    color: #999999;
    font-size: 10px;
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
            <div align="left"><img src="http://cubes.jp/img/template/headers.jpg" width="816" height="23"></div>
        </td>
    </tr>
    <tr>
        <td width="25" rowspan="2"><img src="../img/template/TemplateLeft.jpg" width="25" height="105"></td>
        <td width="615" valign="bottom"><a href="index.php"><?php if($tenpodata["headerimage"]) {?><img src="<?php echo $tenpodata["headerimage"] ?>?ver" width="620" height="70" border="0"><?php }?></a></td>
        <td width="69"><img src="../img/template/HeaderLinkToMobile.jpg" width="69" height="71"></td>
        <td><img src="http://siteadmin.itcube.ne.jp/qrcode/index.php?qrdata=http://<?php echo $_SERVER['HTTP_HOST']; ?>" width="75" height="71"></td>
        <td><img src="../img/template/2_r1_c17.jpg" width="4" height="71"></td>
        <td width="25"><img src="../img/template/TemplateRight.jpg" width="25" height="71"></td>
    </tr>
    <tr>
        <td colspan="4">
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="130"><a href="index.php"><img src="../img/template/HeaderMenuHome.jpg" width="130" height="34" border="0"></a></td>
                    <td width="127"><a href="chintai.php?cid=1"><img src="../img/template/HeaderMenuBukken.jpg" width="127" height="34" border="0"></a></td>
                    <td width="127"><a href="company.php"><img src="../img/template/HeaderMenuCompany.jpg" width="127" height="34" border="0"></a></td>
                    <td width="127"><a href="../topics.php"><img src="../img/template/HeaderMenuTopics.jpg" width="127" height="34" border="0"></a></td>
                    <td><a href="../qanda.php"><img src="../img/template/HeaderMenuQandA.jpg" width="127" height="34" border="0"></a></td>
                    <td><a href="contact.php"><img src="../img/template/HeaderMenuContact.jpg" width="130" height="34" border="0"></a></td>
                </tr>
            </table>
        </td>
        <td background="../img/template/TemplateRight.jpg">&nbsp;</td>
    </tr>
</table>
<?php
}
?>
