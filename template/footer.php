<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<div id="footer">
    <table width="818" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="left" valign="top" background="img/template/TemplateLeft.jpg">&nbsp;</td>
            <td align="left" valign="top">&nbsp;</td>
            <td align="left" valign="top" background="img/template/TemplateRight.jpg">&nbsp;</td>
        </tr>
        <tr>
            <td width="25" align="left" valign="top" background="img/template/TemplateLeft.jpg">&nbsp;</td>
            <td width="768" align="left" valign="top">
                <div align="center">| <a href="index.php">HOME</a> | <a href="chintai.php?cid=1">物件検索</a> | <a href="../company.php">会社案内</a> | <a href="../topics.php">トピックス</a> | <a href="../qanda.php">良くある質問</a> | <a href="../contact.php">お問合せ</a> | </div>
            </td>
            <td width="25" align="left" valign="top" background="img/template/TemplateRight.jpg">&nbsp;</td>
        </tr>
        <tr>
            <td align="left" valign="bottom"><img src="img/template/Footer1.jpg" width="25" height="78"></td>
            <td align="left" valign="bottom">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td><?php if ($tenpodata["footerimage"] != NULL) { ?><img src="<?php echo $tenpodata["footerimage"]; ?>" width="768" height="50"><?php } ?></td>
                    </tr>
                    <tr>
                        <td><img src="img/template/Footer4.jpg" width="768" height="28"></td>
                    </tr>
                </table>
            </td>
            <td align="left" valign="bottom"><img src="img/template/Footer3.jpg" width="25" height="78"></td>
        </tr>
    </table>
</div>
<?php include "gcode.php"; ?>
<script>
    (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-102425275-1', 'auto');
    ga('send', 'pageview');
</script>

<?php
    $updateTime = filemtime(__DIR__ . '/footer.js');
?>

<script src="/template/footer.js?v=<?php echo $updateTime; ?>"></script>