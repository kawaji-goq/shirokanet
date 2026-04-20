<?php 
class MyAdmin_Blog extends Admin_Blog{
		function UpdateCateList($data) {
				for($i=0;$data["cate_id"][$i]!=NULL;$i++) {
					$this->dbobj->Query("update blog_cate set cate_name='".$data["cate_name"][$i]."',turn=".$data["turn"][$i]." where cate_id = ".$data["cate_id"][$i]);
				}
		}
}
$ad_blog=new MyAdmin_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();

if($_GET["pmode"]=="delete"&&$_GET["delid"]!=NULL) {

	$ad_blog->DeleteCate($_GET["delid"]);
	
}

if($_REQUEST["btm_up_data"]=="更新する") {
	$ad_blog->UpdateCateList($_POST);
}

?><script language="javascript">
function delchk(name,id) {
	var res=confirm(name+"を削除してもよろしいですか？");
	
	if(res) {
		location.href="?PID=hp_basic_blog_cate&pmode=delete&cate_id=<?php echo $_GET["cate_id"];?>&delid="+id;
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
.style3 {line-height: 18px; font-size: 12px;}
.style4 {line-height: 18px; color:#333333; font-size: 14px;}
.style5 {color: #666666}
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
        <td><?php include"tmp_left_topics.html" ?></td>
      </tr>
    </table>
    <table width="0" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td align="left" valign="top"><?php include"tmp_left_main.html" ?></td>
      </tr>
    </table></td>
    <td width="15"><img src="/img/sp/15_15.jpg" width="15" height="15" /></td>
    <td width="640" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        
        <tr>
          <td width="600" height="35" align="left" valign="middle" background="/img/main/title_bg.jpg"><table width="99%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="15">&nbsp;</td>
              <td width="622" class="text2">
                  <p>活動報告・トピックス　カテゴリ一覧</p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
            <td align="left" valign="top" background="/img/main/sideline.jpg">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    
                    <tr>
                        <td align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top">
                            <form name="form1" method="post" action="">
                                <table width="100%" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
                                    <tr>
                                        <th width="9%" align="center" bgcolor="#ECECEC">表示順</th>
                                        <th width="61%" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
                                        <th width="14%" align="left" bgcolor="#ECECEC">
                                            <div align="center">公開設定</div>
                                        </th>
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
                                        <td height="20" align="left" valign="top" bgcolor="#FFFFFF"> <a href="?PID=blog_up&cate_id=<?php echo $blogcatedata[$blogrow]["cate_id"];?>"></a>
                                                <input name="cate_name[<?php echo $blogrow; ?>]" type="text" id="cate_name[<?php echo $blogrow; ?>]" value="<?php $blogcate->Moji("cate_name"); ?>" size="60">
                                        </td>
                                        <td align="left" valign="top" bgcolor="#FFFFFF">
                                            <div align="center">
                                                <select name="view_chk[<?php echo $blogrow; ?>]">
                                                    <option value="1"<?php if($blogcatedata[$blogrow]["view_chk"]==1) {echo " selected";}?>>公開する</option>
                                                    <option value="0"<?php if($blogcatedata[$blogrow]["view_chk"]==0) {echo " selected";}?>>公開しない</option>
                                                </select>
                                                </div>
                                        </td>
                                        <td width="9%" align="left" valign="top" bgcolor="#FFFFFF">
                                            <div align="center">
                                                <input type="button" name="Submit" value="削除" onclick="delchk('<?php  echo $blogcatedata[$blogrow]["cate_name"]; ?>','<?php echo $blogcatedata[$blogrow]["cate_id"];?>')" />
                                                </div>
                                        </td>
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
                                            <input type="button" name="Submit" value="新規登録" onClick="location.href='?PID=hp_basic_blog_cate_reg'" />
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                </table>
                                    </form>
                            </td>
                    </tr>
                    <tr>
                        <td width="2%" align="left" valign="top">&nbsp;</td>
                        <td align="left" valign="top">&nbsp;</td>
                        </tr>
                    
                    <tr>
                        <td colspan="2" align="center" valign="top"><img src="/img/sp/7_7.jpg" width="7" height="7" /></td>
                    </tr>
                    </table>
          </td></tr>
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
