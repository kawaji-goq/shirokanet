<?php 
$ad_blog=new Admin_Blog($dbobj);
$blogsetting=$ad_blog->LoadSetting();

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
                  <p>活動報告・トピックス　カテゴリ登録</p>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
            <td align="left" valign="top" background="/img/main/sideline.jpg">
                <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="left" valign="top">&nbsp;</td>
        <td align="left" valign="top">
            <?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_blog->AdditionCate($_POST);
	$blogcdata=$ad_blog->GetDetailsCate($newid);

?>
            <script language="javascript">
location.replace('?PID=hp_basic_blog_cate');
            </script>
            <?php
		}
		else {
		?>
            <table width="628" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                    <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
                    <td width="513" align="left" bgcolor="#FFFFFF">
                        <input name="new_cate_name" type="text" id="new_cate_name" value="" size="50">
                    </td>
                </tr>
                <?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?>
                <?php
		  }
		  ?>
                <?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?>
                <?php
		  }
		  ?>
                <tr>
                    <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開設定</th>
                    <td align="left" valign="top" bgcolor="#FFFFFF">
                        <select name="view_chk" id="view_chk">
                            <option value="1 selected">公開する</option>
                            <option value="0">公開しない</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
                    <td align="left" valign="top" bgcolor="#FFFFFF">
                        <input name="bbtm_regist" type="submit" id="bbtm_regist" value="登録する" onClick="datachk()">
                        <input name="pmode" type="hidden" id="pmode" value="regist">
                        <input name="cate_id" type="hidden" id="cate_id" value="0">
                        <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onclick="location.replace('?PID=blog')" />
                    </td>
                </tr>
            </table>
            <?php 
		}
		?>
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
                </form>
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
