<?php 
$ad_link=new Ad_Links($dbobj);
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
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
<table width="800" border="0" align="left" cellpadding="1" cellspacing="1">
    <tr>
        <td colspan="3" align="left">
            <table width="700" border="0" align="left">
                <tr>
                    <td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
                    <td width="412" align="left">
                        <p><strong>　リンク管理　&gt;&gt;　カテゴリ登録</strong></p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
        <td width="200" align="left" valign="top">
            <table width="200" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCFF">
                <tr>
                    <th align="left" bgcolor="#ECECFF"><strong>ｶﾃｺﾞﾘ名</strong></th>
                </tr>
                <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　施工実績カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$linkcatedata=$ad_link->GetCateList($_GET["link_id"],$lim,$setnum,$orderby);
for($linkrow=0;$linkcatedata[$linkrow];$linkrow++){ 
$linkcate=new Ary_Viewer($linkcatedata[$linkrow]);
?>
                <tr>
                    <td align="left" valign="top" bgcolor="#FFFFFF"> ・<a href="?PID=link_details&cate_id=<?php echo $linkcatedata[$linkrow]["cate_id"];?>">
                        <?php $linkcate->Moji("cate_name"); ?>
                        </a>
                            <input name="cate_id[<?php echo $linkrow; ?>]" type="hidden" id="cate_id[<?php echo $linkrow; ?>]" value="<?php echo $linkcatedata[$linkrow]["cate_id"];?>" />
                    </td>
                </tr>
                <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　施工実績カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
                <tr>
                    <td align="left" valign="top" bgcolor="#FFFFFF">&nbsp;</td>
                </tr>
                <tr>
                    <td align="left" valign="top" bgcolor="#FFFFFF"><a href="?PID=link_category">■カテゴリを編集する</a></td>
                </tr>
            </table>
        </td>
        <td width="10" align="left" valign="top">&nbsp;</td>
        <td width="500" align="left" valign="top">
            <table width="600" border="0" align="left" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <form id="form1" name="form1" method="post" action="">
                            <?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_link->AdditionCate($_POST);
	$linkcdata=$ad_link->GetDetailsCate($newid);

?>
<script language="javascript">
location.replace('?PID=link_category');
</script>
                            <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <th width="112" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
                                    <td width="473" align="left" bgcolor="#FFFFFF"> <?php echo $_POST["new_cate_name"];?></td>
                                </tr>
                                <?php
		 if($linksetting["cate_comm_chk"]==1) {
		 ?>
                                <tr>
                                    <th width="112" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                                    <td align="left" valign="top" bgcolor="#FFFFFF"> <?php echo $_POST["new_cate_comm"];?> </td>
                                </tr>
                                <tr>
                                    <th width="112" align="left" valign="top" bgcolor="#ECECEC">公開</th>
                                    <td align="left" valign="top" bgcolor="#FFFFFF">
                                        <?php 
			switch($_POST["view_chk"]) {
				case 0:
					echo "公開しない";
					break;
				case 1:
					echo "公開する";
					break;
				default:
					break;
			}
			
			?>
                                    </td>
                                </tr>
                                <?php
		  }
		  ?>
                                <tr>
                                    <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                                    <td align="left" valign="top" bgcolor="#FFFFFF">
                                        <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=link_add')">
                                        <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=link_category')">
                                    </td>
                                </tr>
                            </table>
                            <?php
		}
		else {
		?>
                            <table width="600" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                                <tr>
                                    <th width="112" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
                                    <td width="473" align="left" bgcolor="#FFFFFF">
                                        <input name="new_cate_name" type="text" id="new_cate_name" value="" size="50">
                                    </td>
                                </tr>
                                <?php
		 if($linksetting["cate_comm_chk"]==1) {
		 ?>
                                <tr>
                                    <th width="112" align="left" valign="top" bgcolor="#ECECEC"><strong>内容</strong></th>
                                    <td align="left" valign="top" bgcolor="#FFFFFF">
                                        <textarea name="new_cate_comm" cols="50" rows="15" id="new_cate_comm"></textarea>
                                    </td>
                                </tr>
                                <?php
		  }
		  ?>
                                <tr>
                                    <th width="112" align="left" valign="top" bgcolor="#ECECEC">公開</th>
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
                                        <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk(this.form)">
                                        <input name="pmode" type="hidden" id="pmode" value="regist">
                                        <input name="cate_id" type="hidden" id="cate_id" value="0">
                                        <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=link_category')" />
                                    </td>
                                </tr>
                            </table>
                            <?php 
		}
		?>
                        </form>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
