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
<table width="700" border="0" align="left" cellpadding="0" cellspacing="0">
  <tr>
  		<td>
  				<table width="700" border="0" align="center">
							<tr>
									<td width="278"><img src="./img/siteadmin/edit_menu.gif" alt="編集中のエリア" width="278" height="18" /></td>
									<td width="412" align="left">
											<p><strong>　<?php echo $menudata[6]["data_name"]; ?>　&gt;&gt;　カテゴリ登録</strong></p>
									</td>
							</tr>
					</table>
  		</td>
 		</tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
      <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
<?php 
if($_REQUEST["pmode"]=="regist") {
	$newid=$ad_blog->AdditionCate($_POST);
	$blogcdata=$ad_blog->GetDetailsCate($newid);

?>
        <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
             <?php echo $_POST["new_cate_name"];?></td>
          </tr>
   <?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?>
          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF"><?php 
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
          <tr>
            <td align="left" valign="top" bgcolor="#ECECEC">&nbsp;</td>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="続けて登録する" onClick="location.replace('?PID=blog_add')">
              <input name="bbtm_regist" type="button" id="bbtm_regist" value="一覧へもどる" onClick="location.replace('?PID=blog')">
            </td>
          </tr>
        </table>
		<?php
		}
		else {
		?>
		<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
          <tr>
            <th width="100" align="left" bgcolor="#ECECEC"><strong>カテゴリ名</strong></th>
            <td width="400" align="left" bgcolor="#FFFFFF">
              <textarea name="new_cate_name" cols="50" id="new_cate_name"></textarea>
            </td>
          </tr>
         <?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?><?php
		  }
		  ?><?php
		 if($blogsetting["cate_image_chk"]==1) {
		 ?>
          <?php
		  }
		  ?>
          

          <tr>
            <th width="100" align="left" valign="top" bgcolor="#ECECEC">公開</th>
            <td align="left" valign="top" bgcolor="#FFFFFF">
              <select name="view_chk" id="view_chk">
                <option value="1">公開する</option>
                <option value="0" selected>公開しない</option>
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
      </form>
    </td>
  </tr>
</table>
