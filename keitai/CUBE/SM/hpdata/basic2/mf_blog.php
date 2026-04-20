<?php
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
	$newsobj=new Site_News($dbobj);
	$nblim=4;											
	$now=explode("-",date("Y-m-d"));
	$newblogsql="select * from blog_data where view_chk = 1 order by rdate desc limit $nblim ";
	$newblogdata=$dbobj->GetList($newblogsql);
	$tenpodata=$dbobj->GetData("select * from tenpo_data");
$ad_contents=new Admin_Info1($dbobj);
$contentssetting=$ad_contents->LoadSetting();

?>
<script language="javascript">
function datachk() {
	res=confirm("この内容で登録してもよろしいですか?");
	
	if(res) {
		document.form1.submit();
	}
	
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=euc-jp" />
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
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_header.html" ?></td>
  </tr>
</table>
<table width="855" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="200" align="left" valign="top"><table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
        <tr>
          <td width="600" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2">
                  <p>カテゴリ登録</p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="/img/main/sideline.jpg"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="2%" align="left" valign="top">&nbsp;</td>
                <td align="left" valign="top"><table width="97%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="texttitle_1">&nbsp;</td>
                  </tr>
                </table>
                    <table width="100%" border="0" align="center">
                        <tr>
                            <td>
      <form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="64" align="center" bgcolor="#ECECEC">表示順</th>
            <th width="378" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <th width="116" align="left" bgcolor="#ECECEC">公開</th>
            <th align="left" bgcolor="#ECECEC">
                <div align="center">削除</div>
            </th>
          </tr>
          <?php
/****************************************************************/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*　　　　　　　　　　情報１カテゴリ一覧開始　　　　　　　　　*/
/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
/*↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓*/
$blogcatedata=$ad_blog->GetCateList($_GET["blog_id"],$lim,$setnum,$orderby);
for($blogrow=0;$blogcatedata[$blogrow];$blogrow++){ 
$blogcate=new Ary_Viewer($blogcatedata[$blogrow]);
?>
          <tr>
            <td align="center" valign="top" bgcolor="#FFFFFF">
              <input name="turn[<?php echo $blogrow; ?>]" type="text" id="turn[<?php echo $blogrow; ?>]" value="<?php $blogcate->Moji("turn"); ?>" size="6" />
              <input name="cate_id[<?php echo $blogrow; ?>]" type="hidden" id="cate_id[<?php echo $blogrow; ?>]" value="<?php echo $blogcatedata[$blogrow]["cate_id"];?>" />
            </td>
            <td height="20" align="left" valign="top" bgcolor="#FFFFFF">
              <a href="?PID=blog_up&cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"];?>"></a>
              <input name="cate_name[<?php echo $blogrow; ?>]" type="text" id="cate_name[<?php echo $blogrow; ?>]" value="<?php $blogcate->Moji("cate_name"); ?>" size="60">
            </td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk[<?php echo $blogrow; ?>]">
                <option value="1"<?php if($blogcatedata[$blogrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                <option value="0"<?php if($blogcatedata[$blogrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
              </select>
            </td>
            <td width="43" align="left" valign="top" bgcolor="#FFFFFF">
            		<input type="button" name="Submit" value="削除" onclick="delchk('<?php  echo $blogcatedata[$blogrow]["cate_name"]; ?>','<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" /></td>
          </tr>
          <?php 
				}
				/*↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/*　　　　　　　　　情報１カテゴリ一覧終了　　　　　　　　　　*/
				/*　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　　*/
				/****************************************************************/
				?>
        </table>
        <table width="100%" border="0">
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left">
              <input name="btm_up_data" type="submit" id="btm_up_data" value="更新する" />
              <input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=blog_add'" />
            </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      </form>
                            </td>
                        </tr>
                    </table>
                </td>
              </tr>
              <tr>
                <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="/img/main/title_lower.jpg" width="640" height="12" /></td>
        </tr>
    </table></td>
  </tr>
</table>
<table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top"><?php include"tmp_footer.html" ?></td>
  </tr>
</table>
