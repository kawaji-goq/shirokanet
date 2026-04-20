<?php 
$_GET["cate_id"]=1;
$ad_link=new Ad_Links($dbobj);
$linkcdata=$ad_link->GetDetailsCate($_GET["cate_id"]);
$linksetting=$ad_link->LoadSetting();

?>
<script language="javascript">
function datachk(frm) {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		frm.submit();
	}
	
}
</script>
<eta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<style type="text/css">
<!--
body {
	background-color:white;
	margin:0px;
	padding:0px;
}
-->
</style>
<link href="/afiss.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
a:link {
	color:#0000CC;
}
a:visited {
	color:#000099;
}
a:hover {
	color: #0066FF;
}
a:active {
	color: #000099;
}
.style6 {color: #999999}
.style7 {
	color: #999999;
	font-size: 12px;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="600" border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td width="2%" align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">
            <table width="97%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td class="texttitle_1"><?php echo $linkacatedata["cate_name"] ?></td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
                <?php 
if($_REQUEST["pmode"]=="regist") {
	$new_id=$ad_link->AdditionData($_POST);
	$linkdata=$ad_link->GetDetailsData($new_id);
	$linkcdata=$ad_link->GetDetailsCate($linkdata["cate_id"]);
	
?>
                <script language="javascript">
location.replace("?PID=link&cate=<?php echo $_REQUEST["cate_id"];?>");
</script>
                <?php
		}
		else {
		?>
                <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                    <tr>
                        <th align="left" bgcolor="#ECECEC">カテゴリ名</th>
                        <td align="left" bgcolor="#FFFFFF"><?php echo $linkcdata["cate_name"];?></td>
                    </tr>
                    <tr>
                        <th width="20%" align="left" bgcolor="#ECECEC"><strong>タイトル</strong></th>
                        <td width="80%" align="left" bgcolor="#FFFFFF">
                            <input name="new_data_name" type="text" id="new_data_name" value="" size="50">
                        </td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">URL</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="new_data_url" type="text" id="new_data_url" size="50" style="ime-mode:disabled;" />
                        </td>
                    </tr>
                    <tr>
                        <th align="left" valign="top" bgcolor="#ECECEC">ウィンドウ</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <select name="new_link_type" id="new_link_type">
                                <option value="0"<?php if($linkdata[$linkrow]["link_type"]==0){ echo " selected";}?>>新規ウィンドウで開く</option>
                                <option value="1"<?php if($linkdata[$linkrow]["link_type"]==1){ echo " selected";}?>>同じウィンドウで開く</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <select name="new_view_chk" id="new_view_chk">
                                <option value="1" selected>公開する</option>
                                <option value="0">公開しない</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                        <td align="left" valign="top" bgcolor="#FFFFFF">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="登録する" onClick="datachk(this.form)">
                            <input name="pmode" type="hidden" id="pmode" value="regist">
                            <input name="cate_id" type="hidden" id="cate_id" value="<?php echo $_GET["cate_id"];?>">
                            <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=hp_basic_link_d&cate=<?php echo $_GET["cate_id"];?>')" />
                        </td>
                    </tr>
                </table>
                <?php 
		}
		?>
            </form>
        </td>
    </tr>
    <tr>
        <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
    </tr>
</table>
